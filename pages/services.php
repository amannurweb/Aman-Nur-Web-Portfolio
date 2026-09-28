<?php
$meta['title']       = 'Services — WordPress, Shopify, PHP & SEO | ' . config('site.name');
$meta['description'] = 'WordPress and Shopify development, custom PHP software, SEO, digital marketing and website maintenance. Transparent starting prices and delivery times.';
?>
<section class="page-hero">
  <div class="container">
    <span class="eyebrow">Services</span>
    <h1 class="page-title">Everything you need<br>to win online</h1>
    <p class="section-sub">I combine development expertise with digital marketing to deliver complete solutions — not just websites.</p>
  </div>
</section>

<section class="section pt-0">
  <div class="container">
    <div class="grid-3">
      <?php foreach (config('services') as $s) service_card($s, true); ?>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="container skills-layout">
    <div data-reveal>
      <span class="eyebrow">Technical skills</span>
      <h2 class="section-title">6+ years of<br>proven skills</h2>
      <p class="section-sub">Building on the web since 2018 — from ThemeForest templates to complex custom PHP applications for companies in Saudi Arabia and worldwide.</p>
      <ul class="chips">
        <?php foreach (config('tech') as $t): ?><li><?= e($t) ?></li><?php endforeach; ?>
      </ul>
    </div>
    <div class="skill-bars" data-reveal>
      <?php foreach (config('skills') as $sk): ?>
        <div class="skill">
          <div class="skill-head"><span><?= e($sk['name']) ?></span><span><?= (int) $sk['level'] ?>%</span></div>
          <div class="skill-track" role="progressbar" aria-label="<?= e($sk['name']) ?>" aria-valuenow="<?= (int) $sk['level'] ?>" aria-valuemin="0" aria-valuemax="100">
            <div class="skill-fill" style="--w: <?= (int) $sk['level'] ?>%"></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <?php section_head('How I work', 'From idea to launch in four steps'); ?>
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

<?php cta_band('Need any of these <em>services?</em>', 'Let’s talk about your project — free consultation, no obligation.'); ?>
