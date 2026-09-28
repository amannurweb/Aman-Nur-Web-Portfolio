<?php
declare(strict_types=1);

/**
 * Flat-file storage for contact messages and rate limiting.
 * No database needed — everything lives in /storage (blocked from the web).
 */

const STORAGE_DIR = APP_ROOT . '/storage';

function storage_path(string $file = ''): string
{
    return STORAGE_DIR . ($file !== '' ? '/' . $file : '');
}

/** Load a JSON file with a shared lock. */
function json_read(string $path): array
{
    if (!is_file($path)) {
        return [];
    }
    $fh = fopen($path, 'rb');
    if (!$fh) {
        return [];
    }
    flock($fh, LOCK_SH);
    $raw = stream_get_contents($fh);
    flock($fh, LOCK_UN);
    fclose($fh);
    $data = json_decode((string) $raw, true);
    return is_array($data) ? $data : [];
}

/** Atomically read-modify-write a JSON file under an exclusive lock. */
function json_update(string $path, callable $fn): mixed
{
    if (!is_dir(dirname($path))) {
        mkdir(dirname($path), 0775, true);
    }
    $fh = fopen($path, 'c+b');
    if (!$fh) {
        throw new RuntimeException('Cannot open storage file: ' . basename($path));
    }
    try {
        flock($fh, LOCK_EX);
        $data   = json_decode((string) stream_get_contents($fh), true);
        $data   = is_array($data) ? $data : [];
        $result = $fn($data);
        ftruncate($fh, 0);
        rewind($fh);
        fwrite($fh, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        fflush($fh);
        flock($fh, LOCK_UN);
        return $result;
    } finally {
        fclose($fh);
    }
}

/* ---------------------------------------------------------------------- */

function messages_file(): string
{
    return storage_path('messages.json');
}

function save_message(array $msg): string
{
    $msg['id']         = bin2hex(random_bytes(8));
    $msg['created_at'] = date('c');
    $msg['read']       = false;
    json_update(messages_file(), function (array &$all) use ($msg) {
        $all[] = $msg;
    });
    return $msg['id'];
}

/** @return array<int, array> newest first */
function all_messages(): array
{
    $all = json_read(messages_file());
    usort($all, fn($a, $b) => strcmp($b['created_at'] ?? '', $a['created_at'] ?? ''));
    return $all;
}

function update_message(string $id, ?array $changes): void
{
    json_update(messages_file(), function (array &$all) use ($id, $changes) {
        foreach ($all as $i => $m) {
            if (($m['id'] ?? '') === $id) {
                if ($changes === null) {
                    unset($all[$i]);
                } else {
                    $all[$i] = array_merge($m, $changes);
                }
            }
        }
        $all = array_values($all);
    });
}

/**
 * Sliding-window rate limit keyed by a hashed identifier (e.g. IP).
 * Returns true if the action is allowed (and records it).
 */
function rate_limit(string $bucket, string $id, int $max, int $windowSeconds): bool
{
    $key = hash('sha256', $bucket . '|' . $id);
    $now = time();
    return json_update(storage_path('ratelimit.json'), function (array &$data) use ($key, $now, $max, $windowSeconds) {
        // Drop expired entries for every key to keep the file small.
        foreach ($data as $k => $hits) {
            $data[$k] = array_values(array_filter($hits, fn($t) => $t > $now - $windowSeconds));
            if (!$data[$k]) {
                unset($data[$k]);
            }
        }
        $hits = $data[$key] ?? [];
        if (count($hits) >= $max) {
            return false;
        }
        $hits[]     = $now;
        $data[$key] = $hits;
        return true;
    });
}

function client_ip(): string
{
    return (string) ($_SERVER['REMOTE_ADDR'] ?? '0.0.0.0');
}
