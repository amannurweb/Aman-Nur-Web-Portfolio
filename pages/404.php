<?php
$meta['title']   = 'Page not found — ' . config('site.name');
$meta['noindex'] = true;
?>
<section class="page-hero not-found">
  <div class="container center">
    <div class="big-404" aria-hidden="true">404</div>
    <h1 class="page-title sm">This page took a wrong turn</h1>
    <p class="section-sub">The page you’re looking for doesn’t exist or has moved.</p>
    <div class="cta-actions center-actions">
      <a href="<?= e(url('/')) ?>" class="btn btn-primary">Back to home <?= icon('arrow') ?></a>
      <a href="<?= e(url('/contact')) ?>" class="btn btn-ghost">Contact me</a>
    </div>
  </div>
</section>
