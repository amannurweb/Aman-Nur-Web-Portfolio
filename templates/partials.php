<?php
/**
 * Reusable UI fragments shared by several pages.
 */

function section_head(string $eyebrow, string $title, string $sub = '', string $align = 'left'): void
{ ?>
  <div class="section-head <?= $align === 'center' ? 'is-center' : '' ?>" data-reveal>
    <span class="eyebrow"><?= e($eyebrow) ?></span>
    <h2 class="section-title"><?= $title /* trusted markup from templates */ ?></h2>
    <?php if ($sub !== ''): ?><p class="section-sub"><?= e($sub) ?></p><?php endif; ?>
  </div>
<?php }

function service_card(array $s, bool $detailed = false): void
{ ?>
  <article class="card service-card" data-reveal>
    <div class="service-icon"><?= icon($s['icon']) ?></div>
    <h3><?= e($s['title']) ?></h3>
    <p><?= e($detailed ? $s['long'] : $s['short']) ?></p>
    <?php if ($detailed): ?>
      <ul class="tags"><?php foreach ($s['tags'] as $t): ?><li><?= e($t) ?></li><?php endforeach; ?></ul>
    <?php endif; ?>
    <div class="service-foot">
      <span class="price"><?= e($s['price']) ?></span>
      <?php if ($detailed): ?><span class="muted small"><?= e($s['time']) ?></span><?php endif; ?>
    </div>
  </article>
<?php }

function project_thumb(array $p): void
{ ?>
  <div class="project-thumb" style="--h: <?= (int) $p['hue'] ?>" aria-hidden="true">
    <div class="mock">
      <div class="mock-bar"><i></i><i></i><i></i><span><?= e($p['url'] ? parse_url($p['url'], PHP_URL_HOST) : $p['slug']) ?></span></div>
      <div class="mock-body">
        <strong><?= e($p['title']) ?></strong>
        <span class="mock-line"></span><span class="mock-line short"></span>
        <div class="mock-grid"><i></i><i></i><i></i></div>
      </div>
    </div>
  </div>
<?php }

function project_card(array $p): void
{
    $cats = config('project_categories', []); ?>
  <article class="card project-card" data-reveal data-category="<?= e($p['category']) ?>">
    <a href="<?= e(url('/work/' . $p['slug'])) ?>" class="project-link" aria-label="<?= e($p['title']) ?> case study">
      <?php project_thumb($p); ?>
      <div class="project-body">
        <div class="project-meta"><span><?= e($cats[$p['category']] ?? '') ?></span><span><?= e($p['country']) ?></span></div>
        <h3><?= e($p['title']) ?></h3>
        <p><?= e($p['summary']) ?></p>
        <span class="text-link">Read case study <?= icon('arrow') ?></span>
      </div>
    </a>
  </article>
<?php }

function cta_band(string $title = 'Let’s build something that <em>grows your business</em>', string $sub = 'Free consultation. No commitment. Just results.'): void
{ ?>
  <section class="section cta-wrap">
    <div class="container">
      <div class="cta-band" data-reveal>
        <div>
          <h2><?= $title /* trusted markup */ ?></h2>
          <p><?= e($sub) ?></p>
        </div>
        <div class="cta-actions">
          <a href="<?= e(url('/contact')) ?>" class="btn btn-primary">Get a free quote <?= icon('arrow') ?></a>
          <a href="<?= e(whatsapp_url()) ?>" class="btn btn-ghost" target="_blank" rel="noopener"><?= icon('chat') ?> WhatsApp me</a>
        </div>
      </div>
    </div>
  </section>
<?php }
