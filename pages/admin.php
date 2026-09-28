<?php
/** @var string $state  @var array $messages */
$meta['title']   = 'Inbox — ' . config('site.name');
$meta['noindex'] = true;
$error  = flash('admin_error');
$unread = count(array_filter($messages ?? [], fn($m) => empty($m['read'])));
?>
<section class="page-hero">
  <div class="container narrow">
    <?php if ($state === 'disabled'): ?>
      <span class="eyebrow">Admin</span>
      <h1 class="page-title">Inbox is disabled</h1>
      <p class="section-sub">Set <code>admin_password_hash</code> in <code>config.php</code> to enable it. Generate a hash with:</p>
      <pre class="code">php -r "echo password_hash('your-password', PASSWORD_DEFAULT), PHP_EOL;"</pre>

    <?php elseif ($state === 'login'): ?>
      <div class="card form-card login-card">
        <span class="eyebrow">Admin</span>
        <h1 class="page-title sm">Sign in</h1>
        <?php if ($error): ?><div class="alert" role="alert"><?= e($error) ?></div><?php endif; ?>
        <form method="post" action="<?= e(url('/admin')) ?>" class="contact-form">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="login">
          <div class="field">
            <label for="a-pass">Password</label>
            <input id="a-pass" type="password" name="password" autocomplete="current-password" required autofocus>
          </div>
          <button class="btn btn-primary btn-block" type="submit">Sign in <?= icon('arrow') ?></button>
        </form>
      </div>

    <?php else: ?>
      <div class="head-row">
        <div>
          <span class="eyebrow">Admin</span>
          <h1 class="page-title sm">Inbox <span class="muted">(<?= count($messages) ?> · <?= $unread ?> unread)</span></h1>
        </div>
        <form method="post" action="<?= e(url('/admin')) ?>">
          <?= csrf_field() ?><input type="hidden" name="action" value="logout">
          <button class="btn btn-ghost btn-sm" type="submit">Sign out</button>
        </form>
      </div>

      <?php if (!$messages): ?>
        <p class="muted">No messages yet.</p>
      <?php endif; ?>

      <div class="inbox">
        <?php foreach ($messages as $m): ?>
          <article class="card message<?= empty($m['read']) ? ' is-unread' : '' ?>">
            <header>
              <div>
                <strong><?= e($m['name']) ?></strong>
                <a href="mailto:<?= e($m['email']) ?>?subject=<?= rawurlencode('Re: your enquiry') ?>"><?= e($m['email']) ?></a>
              </div>
              <time datetime="<?= e($m['created_at']) ?>"><?= e(date('d M Y, H:i', strtotime($m['created_at']))) ?></time>
            </header>
            <ul class="tags">
              <?php if ($m['service']): ?><li><?= e($m['service']) ?></li><?php endif; ?>
              <?php if ($m['budget']): ?><li class="alt"><?= e($m['budget']) ?></li><?php endif; ?>
            </ul>
            <p class="message-body"><?= nl2br(e($m['message'])) ?></p>
            <footer>
              <?php foreach ([empty($m['read']) ? 'read' : 'unread', 'delete'] as $action): ?>
                <form method="post" action="<?= e(url('/admin')) ?>"<?= $action === 'delete' ? ' data-confirm="Delete this message?"' : '' ?>>
                  <?= csrf_field() ?>
                  <input type="hidden" name="id" value="<?= e($m['id']) ?>">
                  <input type="hidden" name="action" value="<?= $action ?>">
                  <button class="btn btn-ghost btn-sm" type="submit"><?= $action === 'read' ? 'Mark read' : ($action === 'unread' ? 'Mark unread' : 'Delete') ?></button>
                </form>
              <?php endforeach; ?>
            </footer>
          </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
