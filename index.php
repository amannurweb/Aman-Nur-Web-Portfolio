<?php
/**
 * Md Aman Ullah — Portfolio
 * Standalone PHP front controller. No framework, no database, no Composer.
 */
declare(strict_types=1);

define('APP_ROOT', __DIR__);

require APP_ROOT . '/src/functions.php';
require APP_ROOT . '/src/storage.php';
require APP_ROOT . '/src/contact.php';
require APP_ROOT . '/templates/partials.php';

date_default_timezone_set((string) config('site.timezone', 'UTC'));
send_security_headers();

/* ---------- Resolve the route path ---------- */
if (isset($_GET['p'])) {
    $path = (string) $_GET['p'];
} else {
    $path = (string) (parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/');
    $base = base_path();
    if ($base !== '' && str_starts_with($path, $base)) {
        $path = substr($path, strlen($base));
    }
}
$path = '/' . trim(rawurldecode($path), '/');
if ($path === '/index.php') {
    $path = '/';
}
$GLOBALS['route_path'] = $path;

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

/* ---------- Routes ---------- */
switch (true) {
    case $path === '/':
        render('home');
        break;

    case $path === '/services':
        render('services');
        break;

    case $path === '/work':
        render('work');
        break;

    case (bool) preg_match('#^/work/([a-z0-9-]+)$#', $path, $m):
        $project = find_project($m[1]);
        $project ? render('project', ['project' => $project]) : render('404', [], 404);
        break;

    case $path === '/about':
        render('about');
        break;

    case $path === '/blog':
        render('blog');
        break;

    case $path === '/contact':
        if ($method === 'POST') {
            handle_contact_post();
        }
        start_session();
        render('contact');
        break;

    case $path === '/admin':
        require APP_ROOT . '/src/admin.php';
        handle_admin($method);
        break;

    case $path === '/sitemap.xml':
        require APP_ROOT . '/pages/sitemap.php';
        break;

    case $path === '/robots.txt':
        header('Content-Type: text/plain; charset=UTF-8');
        echo "User-agent: *\nDisallow: /admin\n\nSitemap: " . absolute_url('sitemap.xml') . "\n";
        break;

    // Old single-page links (e.g. /index.html) → home.
    case $path === '/index.html':
        redirect(url('/'), 301);

    default:
        render('404', [], 404);
}
