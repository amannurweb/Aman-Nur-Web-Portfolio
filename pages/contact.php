<?php
$meta['title']       = 'Contact — Hire ' . config('site.name');
$meta['description'] = 'Start your website, online store or marketing project. Free consultation — ' . config('contact.response');

$success = flash('contact_success');
$error   = flash('contact_error');
$errors  = flash('contact_errors') ?? [];
$old     = flash('contact_old') ?? [];
$val     = fn(string $k) => e($old[$k] ?? '');

$channels = [
    ['icon' => 'chat',     'label' => 'WhatsApp / Phone', 'value' => config('contact.phone'), 'href' => whatsapp_url()],
    ['icon' => 'mail',     'label' => 'Email',            'value' => config('contact.email'), 'href' => 'mailto:' . config('contact.email')],
    ['icon' => 'linkedin', 'label' => 'LinkedIn',         'value' => 'linkedin.com/in/amannurweb', 'href' => config('social.LinkedIn')],
    ['icon' => 'fiverr',   'label' => 'Fiverr',           'value' => 'fiverr.com/amanun', 'href' => config('social.Fiverr')],
];
?>
<section class="page-hero">
  <div class="container contact-layout">
    <div>
      <span class="eyebrow">Contact</span>
      <h1 class="page-title">Let’s work<br>together</h1>
      <p class="section-sub">Have a project in mind? Need a new website or digital strategy? Send me a message — <?= e(config('contact.response')) ?></p>

      <ul class="channels">
        <?php foreach ($channels as $c): ?>
          <li>
            <a href="<?= e($c['href']) ?>" class="card channel"<?= str_starts_with($c['href'], 'http') ? ' target="_blank" rel="noopener"' : '' ?>>
              <span class="meta-icon"><?= icon($c['icon']) ?></span>
              <span><small><?= e($c['label']) ?></small><?= e($c['value']) ?></span>
              <?= icon('arrow-up', 'icon channel-arrow') ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <div id="form" class="card form-card">
      <?php if ($success): ?>
        <div class="form-success" role="status">
          <span class="success-icon"><?= icon('check') ?></span>
          <h2>Thank you — message received!</h2>
          <p class="muted"><?= e(config('contact.response')) ?> Need a faster answer? Message me on WhatsApp.</p>
          <div class="cta-actions">
            <a href="<?= e(whatsapp_url()) ?>" class="btn btn-primary" target="_blank" rel="noopener"><?= icon('chat') ?> WhatsApp</a>
            <a href="<?= e(url('/work')) ?>" class="btn btn-ghost">Browse my work</a>
          </div>
        </div>
      <?php else: ?>
        <form method="post" action="<?= e(url('/contact')) ?>#form" class="contact-form" novalidate>
          <?= csrf_field() ?>
          <input type="hidden" name="_ts" value="<?= time() ?>">
          <div class="hp" aria-hidden="true">
            <label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
          </div>

          <?php if ($error): ?><div class="alert" role="alert"><?= e($error) ?></div><?php endif; ?>
          <?php if ($errors): ?><div class="alert" role="alert">Please fix the highlighted fields below.</div><?php endif; ?>

          <div class="form-row">
            <div class="field<?= isset($errors['name']) ? ' has-error' : '' ?>">
              <label for="f-name">Your name</label>
              <input id="f-name" type="text" name="name" value="<?= $val('name') ?>" placeholder="John Smith" autocomplete="name" required maxlength="100">
              <?php if (isset($errors['name'])): ?><small class="error"><?= e($errors['name']) ?></small><?php endif; ?>
            </div>
            <div class="field<?= isset($errors['email']) ? ' has-error' : '' ?>">
              <label for="f-email">Your email</label>
              <input id="f-email" type="email" name="email" value="<?= $val('email') ?>" placeholder="john@company.com" autocomplete="email" required maxlength="190">
              <?php if (isset($errors['email'])): ?><small class="error"><?= e($errors['email']) ?></small><?php endif; ?>
            </div>
          </div>

          <div class="form-row">
            <div class="field">
              <label for="f-service">Service needed</label>
              <select id="f-service" name="service">
                <?php foreach (array_merge(array_column(config('services'), 'title'), ['Other']) as $opt): ?>
                  <option<?= ($old['service'] ?? '') === $opt ? ' selected' : '' ?>><?= e($opt) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="field">
              <label for="f-budget">Budget range</label>
              <select id="f-budget" name="budget">
                <?php foreach (config('budgets') as $opt): ?>
                  <option<?= ($old['budget'] ?? '') === $opt ? ' selected' : '' ?>><?= e($opt) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="field<?= isset($errors['message']) ? ' has-error' : '' ?>">
            <label for="f-message">Tell me about your project</label>
            <textarea id="f-message" name="message" rows="6" placeholder="Describe your project, goals and timeline…" required minlength="10" maxlength="5000"><?= $val('message') ?></textarea>
            <?php if (isset($errors['message'])): ?><small class="error"><?= e($errors['message']) ?></small><?php endif; ?>
          </div>

          <button type="submit" class="btn btn-primary btn-block">Send message <?= icon('arrow') ?></button>
          <p class="form-note muted small">Your details are only used to reply to your enquiry.</p>
        </form>
      <?php endif; ?>
    </div>
  </div>
</section>
