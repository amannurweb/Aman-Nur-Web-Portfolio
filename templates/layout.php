<?php
/** @var array $meta  @var string $content */
$nav = [
    '/'         => 'Home',
    '/services' => 'Services',
    '/work'     => 'Work',
    '/about'    => 'About',
    '/blog'     => 'Blog',
];
$canonical = absolute_url(ltrim($meta['path'], '/'));
$personSchema = [
    '@context'  => 'https://schema.org',
    '@type'     => 'Person',
    'name'      => config('site.name'),
    'jobTitle'  => config('site.role'),
    'url'       => config('site.url'),
    'email'     => 'mailto:' . config('contact.email'),
    'telephone' => config('contact.phone'),
    'worksFor'  => ['@type' => 'Organization', 'name' => config('contact.company')],
    'address'   => ['@type' => 'PostalAddress', 'addressLocality' => 'Dammam', 'addressCountry' => 'SA'],
    'sameAs'    => array_values(config('social', [])),
    'knowsAbout'=> config('tech', []),
];
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($meta['title']) ?></title>
<meta name="description" content="<?= e($meta['description']) ?>">
<?php if (!empty($meta['noindex'])): ?>
<meta name="robots" content="noindex, nofollow">
<?php else: ?>
<link rel="canonical" href="<?= e($canonical) ?>">
<?php endif; ?>
<meta name="theme-color" content="#07090d">
<meta name="author" content="<?= e(config('site.name')) ?>">

<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= e(config('site.name')) ?>">
<meta property="og:title" content="<?= e($meta['title']) ?>">
<meta property="og:description" content="<?= e($meta['description']) ?>">
<meta property="og:url" content="<?= e($canonical) ?>">
<meta property="og:image" content="<?= e(absolute_url('assets/img/og.svg')) ?>">
<meta property="og:locale" content="<?= e(config('site.locale')) ?>">
<meta name="twitter:card" content="summary_large_image">

<link rel="icon" href="<?= e(asset('img/favicon.svg')) ?>" type="image/svg+xml">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap">
<link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>">

<script nonce="<?= e(csp_nonce()) ?>">
  (function () {
    try { var t = localStorage.getItem('theme'); } catch (e) {}
    if (!t) t = matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
    document.documentElement.setAttribute('data-theme', t);
    document.documentElement.classList.add('js');
  })();
</script>
<script type="application/ld+json"><?= json_encode($personSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) ?></script>
<?php if (!empty($meta['schema'])): ?>
<script type="application/ld+json"><?= json_encode($meta['schema'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) ?></script>
<?php endif; ?>
<script src="<?= e(asset('js/main.js')) ?>" defer></script>
</head>
<body>
<a class="skip-link" href="#main">Skip to content</a>

<header class="site-header" id="top">
  <div class="container header-inner">
    <a href="<?= e(url('/')) ?>" class="logo" aria-label="<?= e(config('site.name')) ?> — home">
      <?= e(config('site.brand')) ?><span>.</span>dev
    </a>

    <nav class="main-nav" id="main-nav" aria-label="Main">
      <ul>
        <?php foreach ($nav as $href => $label): ?>
          <li><a href="<?= e(url($href)) ?>"<?= is_active($href) ? ' aria-current="page"' : '' ?>><?= e($label) ?></a></li>
        <?php endforeach; ?>
      </ul>
      <a href="<?= e(url('/contact')) ?>" class="btn btn-primary btn-sm nav-cta">Hire me <?= icon('arrow') ?></a>
    </nav>

    <div class="header-actions">
      <button class="icon-btn theme-toggle" type="button" aria-label="Toggle colour theme">
        <?= icon('sun', 'icon icon-sun') ?><?= icon('moon', 'icon icon-moon') ?>
      </button>
      <button class="icon-btn menu-toggle" type="button" aria-label="Open menu" aria-controls="main-nav" aria-expanded="false">
        <?= icon('menu', 'icon icon-open') ?><?= icon('close', 'icon icon-close') ?>
      </button>
    </div>
  </div>
</header>

<main id="main">
<?= $content ?>
</main>

<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <a href="<?= e(url('/')) ?>" class="logo"><?= e(config('site.brand')) ?><span>.</span>dev</a>
        <p><?= e(config('site.role')) ?> helping businesses win online — from <?= e(config('contact.location')) ?> to the world.</p>
        <div class="socials">
          <?php foreach (config('social', []) as $label => $href): ?>
            <a href="<?= e($href) ?>" target="_blank" rel="noopener" aria-label="<?= e($label) ?>"><?= icon(strtolower($label)) ?></a>
          <?php endforeach; ?>
        </div>
      </div>
      <div>
        <h3 class="footer-title">Pages</h3>
        <ul class="footer-links">
          <?php foreach ($nav as $href => $label): ?>
            <li><a href="<?= e(url($href)) ?>"><?= e($label) ?></a></li>
          <?php endforeach; ?>
          <li><a href="<?= e(url('/contact')) ?>">Contact</a></li>
        </ul>
      </div>
      <div>
        <h3 class="footer-title">Services</h3>
        <ul class="footer-links">
          <?php foreach (array_slice(config('services', []), 0, 5) as $s): ?>
            <li><a href="<?= e(url('/services')) ?>"><?= e($s['title']) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div>
        <h3 class="footer-title">Get in touch</h3>
        <ul class="footer-links">
          <li><a href="mailto:<?= e(config('contact.email')) ?>"><?= e(config('contact.email')) ?></a></li>
          <li><a href="<?= e(whatsapp_url()) ?>" target="_blank" rel="noopener"><?= e(config('contact.phone')) ?></a></li>
          <li><?= e(config('contact.location')) ?> 🇸🇦</li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© <?= date('Y') ?> <?= e(config('site.name')) ?>. All rights reserved.</span>
      <a href="#top" class="to-top">Back to top <?= icon('arrow-up') ?></a>
    </div>
  </div>
</footer>

<a href="<?= e(whatsapp_url('Hi Aman, I found your portfolio and would like to discuss a project.')) ?>"
   class="wa-float" target="_blank" rel="noopener" aria-label="Chat on WhatsApp"><?= icon('chat') ?></a>
</body>
</html>
