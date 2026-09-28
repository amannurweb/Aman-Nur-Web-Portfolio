<?php
declare(strict_types=1);

/**
 * Handles POST /contact using the Post/Redirect/Get pattern.
 * Protection: CSRF token, honeypot field, minimum fill time, rate limiting.
 */
function handle_contact_post(): never
{
    $back = url('/contact') . '#form';

    $input = [
        'name'    => trim((string) ($_POST['name'] ?? '')),
        'email'   => trim((string) ($_POST['email'] ?? '')),
        'service' => trim((string) ($_POST['service'] ?? '')),
        'budget'  => trim((string) ($_POST['budget'] ?? '')),
        'message' => trim((string) ($_POST['message'] ?? '')),
    ];

    if (!verify_csrf()) {
        flash('contact_error', 'Your session expired. Please try again.');
        flash('contact_old', $input);
        redirect($back);
    }

    // Bots: honeypot filled in, or form submitted impossibly fast. Pretend success.
    $startedAt = (int) ($_POST['_ts'] ?? 0);
    if (($_POST['website'] ?? '') !== '' || ($startedAt && time() - $startedAt < 3)) {
        flash('contact_success', true);
        redirect($back);
    }

    $services = array_column(config('services', []), 'title');
    $budgets  = config('budgets', []);
    $errors   = [];

    if ($input['name'] === '' || mb_strlen($input['name']) > 100) {
        $errors['name'] = 'Please enter your name.';
    }
    if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL) || mb_strlen($input['email']) > 190) {
        $errors['email'] = 'Please enter a valid email address.';
    }
    if ($input['service'] !== '' && $input['service'] !== 'Other' && !in_array($input['service'], $services, true)) {
        $input['service'] = 'Other';
    }
    if ($input['budget'] !== '' && !in_array($input['budget'], $budgets, true)) {
        $input['budget'] = '';
    }
    $len = mb_strlen($input['message']);
    if ($len < 10) {
        $errors['message'] = 'Tell me a little more about your project (at least 10 characters).';
    } elseif ($len > 5000) {
        $errors['message'] = 'Please keep your message under 5,000 characters.';
    }

    if ($errors) {
        flash('contact_errors', $errors);
        flash('contact_old', $input);
        redirect($back);
    }

    if (!rate_limit('contact', client_ip(), 5, 3600)) {
        flash('contact_error', 'Too many messages from your connection. Please try again later or reach me on WhatsApp.');
        flash('contact_old', $input);
        redirect($back);
    }

    try {
        save_message($input + [
            'ip' => client_ip(),
            'ua' => mb_substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 255),
        ]);
    } catch (Throwable $e) {
        error_log('Contact form storage failed: ' . $e->getMessage());
        flash('contact_error', 'Something went wrong on my side. Please email or WhatsApp me directly.');
        flash('contact_old', $input);
        redirect($back);
    }

    if (config('mail.send')) {
        send_contact_email($input);
    }

    flash('contact_success', true);
    redirect($back);
}

function send_contact_email(array $m): void
{
    // Strip anything that could inject extra headers.
    $clean = fn(string $s) => trim(preg_replace('/[\r\n]+/', ' ', $s));

    $subject = 'New enquiry from ' . $clean($m['name']) . ($m['service'] ? ' — ' . $clean($m['service']) : '');
    $body    = "Name:    {$m['name']}\n"
             . "Email:   {$m['email']}\n"
             . "Service: " . ($m['service'] ?: '-') . "\n"
             . "Budget:  " . ($m['budget'] ?: '-') . "\n\n"
             . $m['message'] . "\n";

    $headers = [
        'From'         => config('site.name') . ' Website <' . config('mail.from') . '>',
        'Reply-To'     => $clean($m['email']),
        'Content-Type' => 'text/plain; charset=UTF-8',
        'X-Mailer'     => 'PHP/' . PHP_VERSION,
    ];

    if (!@mail((string) config('mail.to'), '=?UTF-8?B?' . base64_encode($subject) . '?=', $body, $headers)) {
        error_log('Contact form: mail() failed; message is still saved in storage.');
    }
}
