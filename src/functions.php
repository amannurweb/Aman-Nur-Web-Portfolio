<?php
declare(strict_types=1);

/* ----------------------------------------------------------------------
 | Config
 * ---------------------------------------------------------------------- */

/** Read a config value using dot notation, e.g. config('site.name'). */
function config(?string $key = null, mixed $default = null): mixed
{
    static $config = null;
    $config ??= require APP_ROOT . '/config.php';

    if ($key === null) {
        return $config;
    }
    $value = $config;
    foreach (explode('.', $key) as $segment) {
        if (!is_array($value) || !array_key_exists($segment, $value)) {
            return $default;
        }
        $value = $value[$segment];
    }
    return $value;
}

/* ----------------------------------------------------------------------
 | Output helpers
 * ---------------------------------------------------------------------- */

/** Escape for HTML output. */
function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Base path of the app when installed in a sub-folder ("" at the web root). */
function base_path(): string
{
    static $base = null;
    if ($base === null) {
        $dir  = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
        $base = rtrim($dir, '/.');
    }
    return $base;
}

/** Build an internal URL for a route path such as "/work/pureface". */
function url(string $path = '/', array $query = []): string
{
    $path = '/' . ltrim($path, '/');
    if (config('site.pretty_urls', true)) {
        $href = base_path() . $path;
    } else {
        $href = base_path() . '/index.php';
        if ($path !== '/') {
            $query = ['p' => ltrim($path, '/')] + $query;
        }
    }
    return $query ? $href . '?' . http_build_query($query) : $href;
}

/** Absolute public URL (for canonical, OG and sitemap). */
function absolute_url(string $path = '/'): string
{
    return rtrim((string) config('site.url'), '/') . '/' . ltrim($path, '/');
}

/** Versioned asset URL for cache-busting. */
function asset(string $file): string
{
    $full = APP_ROOT . '/assets/' . $file;
    $v    = is_file($full) ? filemtime($full) : '1';
    return base_path() . '/assets/' . $file . '?v=' . $v;
}

function current_path(): string
{
    return $GLOBALS['route_path'] ?? '/';
}

/** True if the given route is the current section (for nav highlighting). */
function is_active(string $path): bool
{
    $current = current_path();
    return $path === '/' ? $current === '/' : str_starts_with($current . '/', rtrim($path, '/') . '/');
}

function whatsapp_url(string $text = ''): string
{
    $url = 'https://wa.me/' . config('contact.whatsapp');
    return $text !== '' ? $url . '?text=' . rawurlencode($text) : $url;
}

/** Initials from a name, e.g. "Md Aman Ullah" => "MA". */
function initials(string $name): string
{
    $parts = preg_split('/\s+/', trim($name)) ?: [];
    $out   = '';
    foreach (array_slice($parts, 0, 2) as $p) {
        $out .= mb_strtoupper(mb_substr($p, 0, 1));
    }
    return $out;
}

/** Per-request nonce for inline scripts allowed by the CSP. */
function csp_nonce(): string
{
    static $nonce = null;
    return $nonce ??= base64_encode(random_bytes(16));
}

/** Inline SVG icon from a small built-in set. */
function icon(string $name, string $class = 'icon'): string
{
    static $paths = [
        'globe'     => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/>',
        'cart'      => '<circle cx="9" cy="20" r="1.4"/><circle cx="18" cy="20" r="1.4"/><path d="M2 3h3l2.6 12.2a1.5 1.5 0 0 0 1.5 1.2h8.8a1.5 1.5 0 0 0 1.5-1.1L21 7H6"/>',
        'code'      => '<path d="m8 8-5 4 5 4M16 8l5 4-5 4M14 4l-4 16"/>',
        'chart'     => '<path d="M3 20h18M6 16l4-5 3 3 5-7"/><path d="M15 7h3v3"/>',
        'megaphone' => '<path d="M3 10v4a1 1 0 0 0 1 1h3l6 4V5L7 9H4a1 1 0 0 0-1 1Z"/><path d="M17 8.5a5 5 0 0 1 0 7"/>',
        'wrench'    => '<path d="M14.7 6.3a4 4 0 0 0-5.4 5.1L3 17.7 6.3 21l6.3-6.3a4 4 0 0 0 5.1-5.4l-2.6 2.6-2.4-.6-.6-2.4Z"/>',
        'pin'       => '<path d="M12 21s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12Z"/><circle cx="12" cy="9" r="2.5"/>',
        'phone'     => '<path d="M5 3h4l2 5-2.5 1.5a11 11 0 0 0 6 6L16 13l5 2v4a2 2 0 0 1-2 2A17 17 0 0 1 3 5a2 2 0 0 1 2-2Z"/>',
        'mail'      => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
        'brief'     => '<rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 13h18"/>',
        'star'      => '<path d="m12 3 2.7 5.6 6.1.9-4.4 4.3 1 6.1L12 17l-5.4 2.9 1-6.1-4.4-4.3 6.1-.9Z"/>',
        'arrow'     => '<path d="M5 12h14M13 6l6 6-6 6"/>',
        'arrow-up'  => '<path d="M7 17 17 7M8 7h9v9"/>',
        'check'     => '<path d="m5 12 5 5 9-10"/>',
        'chat'      => '<path d="M21 12a8 8 0 0 1-11.6 7.1L4 20l1-4.6A8 8 0 1 1 21 12Z"/>',
        'sun'       => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>',
        'moon'      => '<path d="M20 14.5A8 8 0 0 1 9.5 4a8 8 0 1 0 10.5 10.5Z"/>',
        'menu'      => '<path d="M4 7h16M4 12h16M4 17h16"/>',
        'close'     => '<path d="M6 6l12 12M18 6 6 18"/>',
        'linkedin'  => '<rect x="3" y="3" width="18" height="18" rx="3"/><path d="M8 10v7M8 7v.01M12 17v-4a2 2 0 0 1 4 0v4M12 10v7"/>',
        'github'    => '<path d="M9 19c-4 1.3-4-2-6-2.5M15 21v-3.5a3 3 0 0 0-.9-2.3c3-.3 6-1.5 6-6.5a5 5 0 0 0-1.4-3.5 4.7 4.7 0 0 0-.1-3.5s-1.1-.3-3.6 1.4a12.3 12.3 0 0 0-6.5 0C6 1.4 4.9 1.7 4.9 1.7a4.7 4.7 0 0 0-.1 3.5A5 5 0 0 0 3.4 8.7c0 5 3 6.2 6 6.5a3 3 0 0 0-.9 2.3V21"/>',
        'fiverr'    => '<circle cx="12" cy="12" r="9"/><path d="M10 17v-6h4v6M10 11V9.5A1.5 1.5 0 0 1 11.5 8H12M8.5 11H10M15.5 8v.01"/>',
        'blog'      => '<path d="M4 20h4L19 9l-4-4L4 16v4ZM13.5 6.5l4 4"/>',
        'quote'     => '<path d="M9 7H5v6h4v-2c0 2-1 3.5-3 4.5M19 7h-4v6h4v-2c0 2-1 3.5-3 4.5"/>',
        'bolt'      => '<path d="M13 2 4 14h7l-1 8 9-12h-7l1-8Z"/>',
        'target'    => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/>',
        'shield'    => '<path d="M12 3 4 6v6c0 5 3.4 8 8 9 4.6-1 8-4 8-9V6l-8-3Z"/><path d="m9 12 2 2 4-4"/>',
    ];
    $inner = $paths[$name] ?? $paths['arrow'];
    return '<svg class="' . e($class) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" '
         . 'stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $inner . '</svg>';
}

/* ----------------------------------------------------------------------
 | Session, CSRF & flash messages
 * ---------------------------------------------------------------------- */

function start_session(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }
    $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
           || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');
    session_name('amanweb_sid');
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => base_path() ?: '/',
        'secure'   => $secure,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

function csrf_token(): string
{
    start_session();
    return $_SESSION['_csrf'] ??= bin2hex(random_bytes(32));
}

function csrf_field(): string
{
    return '<input type="hidden" name="_token" value="' . e(csrf_token()) . '">';
}

function verify_csrf(): bool
{
    start_session();
    $token = $_POST['_token'] ?? '';
    return is_string($token) && isset($_SESSION['_csrf']) && hash_equals($_SESSION['_csrf'], $token);
}

function flash(string $key, mixed $value = null): mixed
{
    start_session();
    if (func_num_args() === 2) {
        $_SESSION['_flash'][$key] = $value;
        return null;
    }
    $v = $_SESSION['_flash'][$key] ?? null;
    unset($_SESSION['_flash'][$key]);
    return $v;
}

function redirect(string $to, int $status = 303): never
{
    header('Location: ' . $to, true, $status);
    exit;
}

/* ----------------------------------------------------------------------
 | Content lookups
 * ---------------------------------------------------------------------- */

function find_project(string $slug): ?array
{
    foreach (config('projects', []) as $p) {
        if ($p['slug'] === $slug) {
            return $p;
        }
    }
    return null;
}

/* ----------------------------------------------------------------------
 | Rendering
 * ---------------------------------------------------------------------- */

/**
 * Render a page inside the main layout.
 * Page templates may override $meta (title, description, path, noindex, schema).
 */
function render(string $view, array $data = [], int $status = 200): void
{
    http_response_code($status);
    $meta = [
        'title'       => config('site.title'),
        'description' => config('site.description'),
        'path'        => current_path(),
        'noindex'     => false,
    ];
    extract($data, EXTR_SKIP);

    ob_start();
    require APP_ROOT . '/pages/' . $view . '.php';
    $content = ob_get_clean();

    require APP_ROOT . '/templates/layout.php';
}

function send_security_headers(): void
{
    $nonce = csp_nonce();
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
    header("Content-Security-Policy: default-src 'self'; "
        . "script-src 'self' 'nonce-{$nonce}'; "
        . "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; "
        . "font-src 'self' https://fonts.gstatic.com; "
        . "img-src 'self' data:; "
        . "form-action 'self'; frame-ancestors 'self'; base-uri 'self'");
}
