<?php
declare(strict_types=1);

/**
 * Minimal password-protected inbox for contact form messages at /admin.
 */
function handle_admin(string $method): void
{
    start_session();
    header('X-Robots-Tag: noindex, nofollow');
    header('Cache-Control: no-store');

    $hash = (string) config('admin_password_hash', '');
    if ($hash === '') {
        render('admin', ['state' => 'disabled']);
        return;
    }

    $authed = !empty($_SESSION['admin']);

    if ($method === 'POST') {
        if (!verify_csrf()) {
            flash('admin_error', 'Session expired, please try again.');
            redirect(url('/admin'));
        }
        $action = (string) ($_POST['action'] ?? '');

        if ($action === 'login') {
            if (!rate_limit('admin-login', client_ip(), 8, 900)) {
                flash('admin_error', 'Too many attempts. Try again in 15 minutes.');
            } elseif (password_verify((string) ($_POST['password'] ?? ''), $hash)) {
                session_regenerate_id(true);
                $_SESSION['admin'] = true;
            } else {
                flash('admin_error', 'Incorrect password.');
            }
            redirect(url('/admin'));
        }

        if (!$authed) {
            redirect(url('/admin'));
        }

        $id = (string) ($_POST['id'] ?? '');
        match ($action) {
            'logout' => (function () {
                $_SESSION = [];
                session_regenerate_id(true);
            })(),
            'read'   => update_message($id, ['read' => true]),
            'unread' => update_message($id, ['read' => false]),
            'delete' => update_message($id, null),
            default  => null,
        };
        redirect(url('/admin'));
    }

    render('admin', [
        'state'    => $authed ? 'inbox' : 'login',
        'messages' => $authed ? all_messages() : [],
    ]);
}
