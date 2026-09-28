<?php
$featured = array_values(array_filter(config('projects', []), fn($p) => $p['featured']));
?>
<!-- HERO -->
<section class="hero">
  <div class="hero-glow" aria-hidden="true"></div>
  <div class="hero-grid-bg" aria-hidden="true"></div>
  <div class="container hero-inner">
    <div class="hero-copy">
      <?php if (config('site.available')): ?>
        <span class="pill"><span class="dot"></span> Available for new projects</span>
      <?php endif; ?>
      <h1 class="hero-title">
        I build websites<br>
        <span class="accent">that make</span>
        <span class="outline">money.</span>
      </h1>
      <p class="hero-lead">
        <strong>Full Stack PHP Developer &amp; Digital Marketer</strong> based in Dammam, Saudi Arabia.
        I don’t just build websites — I build systems that bring you clients while you sleep.
      </p>
      <div class="hero-actions">
        <a href="<?= e(url('/work')) ?>" class="btn btn-primary">View my work <?= icon('arrow') ?></a>
        <a href="<?= e(url('/contact')) ?>" class="btn btn-ghost"><?= icon('chat') ?> Let’s talk</a>
      </div>
      <dl class="hero-stats">
        <?php foreach (array_slice(config('stats'), 0, 3) as $s): ?>
          <div>
            <dt><?= e($s['label']) ?></dt>
            <dd><span data-count="<?= (int) $s['value'] ?>"><?= (int) $s['value'] ?></span><?= e($s['suffix']) ?></dd>
          </div>
        <?php endforeach; ?>
      </dl>
    </div>

    <aside class="profile-card" aria-label="Profile summary">
      <div class="profile-top">
        <div class="avatar"><?= e(initials(config('site.name'))) ?></div>
        <div>
          <div class="profile-name"><?= e(config('site.name')) ?></div>
          <div class="profile-role">PHP Developer · Digital Marketer</div>
        </div>
      </div>
      <ul class="tags">
        <?php foreach (config('hero_tags') as $i => $t): ?>
          <li class="<?= $i % 3 === 2 ? 'alt' : '' ?>"><?= e($t) ?></li>
        <?php endforeach; ?>
      </ul>
      <ul class="profile-meta">
        <?php foreach (config('profile_meta') as $m): ?>
          <li>
            <span class="meta-icon"><?= icon($m['icon']) ?></span>
            <span><small><?= e($m['label']) ?></small><?= e($m['value']) ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
    </aside>
  </div>

  <div class="marquee" aria-hidden="true">
    <div class="marquee-track">
      <?php for ($i = 0; $i < 2; $i++): foreach (config('tech') as $t): ?>
        <span><?= e($t) ?></span>
      <?php endforeach; endfor; ?>
    </div>
  </div>
</section>

<!-- STATS -->
<section class="stats-band">
  <div class="container stats-grid">
    <?php foreach (config('stats') as $s): ?>
      <div class="stat" data-reveal>
        <div class="stat-num"><span data-count="<?= (int) $s['value'] ?>"><?= (int) $s['value'] ?></span><em><?= e($s['suffix']) ?></em></div>
        <div class="stat-label"><?= e($s['label']) ?></div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- SERVICES -->
<section class="section">
  <div class="container">
    <?php section_head('What I do', 'Services that<br>drive results', 'From custom PHP apps to full digital marketing — I handle everything your business needs online.'); ?>
    <div class="grid-3">
      <?php foreach (config('services') as $s) service_card($s); ?>
    </div>
    <div class="center mt-lg"><a href="<?= e(url('/services')) ?>" class="btn btn-ghost">See all services <?= icon('arrow') ?></a></div>
  </div>
</section>

<!-- WORK -->
<section class="section section-alt">
  <div class="container">
    <div class="head-row">
      <?php section_head('Selected work', 'Projects that<br>delivered results'); ?>
      <a href="<?= e(url('/work')) ?>" class="btn btn-ghost" data-reveal>All projects <?= icon('arrow') ?></a>
    </div>
    <div class="grid-3">
      <?php foreach ($featured as $p) project_card($p); ?>
    </div>
  </div>
</section>

<!-- PROCESS -->
<section class="section">
  <div class="container">
    <?php section_head('How I work', 'A simple, clear process', 'From first message to live website — clear, fast and stress-free.'); ?>
    <ol class="process">
      <?php foreach (config('process') as $i => $step): ?>
        <li class="card process-step" data-reveal>
          <span class="step-num"><?= sprintf('%02d', $i + 1) ?></span>
          <h3><?= e($step['title']) ?></h3>
          <p><?= e($step['text']) ?></p>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="section section-alt">
  <div class="container">
    <?php section_head('Client reviews', 'What clients say', 'Real feedback from clients across the globe.'); ?>
    <div class="grid-3">
      <?php foreach (config('testimonials') as $t): ?>
        <figure class="card testimonial" data-reveal>
          <div class="stars" aria-label="5 out of 5 stars">★★★★★</div>
          <blockquote>“<?= e($t['quote']) ?>”</blockquote>
          <figcaption>
            <span class="avatar sm"><?= e(initials($t['name'])) ?></span>
            <span><strong><?= e($t['name']) ?></strong><small><?= e($t['role']) ?></small></span>
          </figcaption>
        </figure>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="section">
  <div class="container faq-layout">
    <?php section_head('FAQ', 'Questions,<br>answered', 'Something else on your mind? Message me — I reply within 24 hours.'); ?>
    <div class="faq" data-reveal>
      <?php foreach (config('faq') as $i => $f): ?>
        <details<?= $i === 0 ? ' open' : '' ?>>
          <summary><?= e($f['q']) ?></summary>
          <p><?= e($f['a']) ?></p>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php cta_band(); ?>
