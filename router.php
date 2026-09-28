<?php
/**
 * Router for PHP's built-in server:  php -S localhost:8000 router.php
 * Serves real files from /assets directly and sends everything else to index.php.
 */
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $path;

if (str_starts_with($path, '/assets/') && is_file($file)) {
    return false; // let the built-in server serve the static file
}

$_SERVER['SCRIPT_NAME'] = '/index.php';
require __DIR__ . '/index.php';
