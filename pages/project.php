<?php
/** @var array $project */
$p    = $project;
$cats = config('project_categories', []);

$meta['title']       = $p['title'] . ' — Case Study | ' . config('site.name');
$meta['description'] = $p['summary'];
$meta['schema']      = [
    '@context'    => 'https://schema.org',
    '@type'       => 'CreativeWork',
    'name'        => $p['title'],
    'description' => $p['summary'],
    'creator'     => ['@type' => 'Person', 'name' => config('site.name')],
    'dateCreated' => $p['year'],
    'keywords'    => implode(', ', $p['tags']),
] + ($p['url'] ? ['url' => $p['url']] : []);

// Previous / next navigation
$all  = config('projects', []);
$idx  = array_search($p['slug'], array_column($all, 'slug'), true);
$prev = $all[($idx - 1 + count($all)) % count($all)];
$next = $all[($idx + 1) % count($all)];
?>
<section class="page-hero">
  <div class="container">
    <a href="<?= e(url('/work')) ?>" class="back-link"><?= icon('arrow') ?> All projects</a>
    <span class="eyebrow"><?= e($cats[$p['category']] ?? 'Project') ?> · <?= e($p['country']) ?></span>
    <h1 class="page-title"><?= e($p['title']) ?></h1>
    <p class="section-sub"><?= e($p['summary']) ?></p>
    <?php if ($p['url']): ?>
      <a href="<?= e($p['url']) ?>" target="_blank" rel="noopener" class="btn btn-primary mt-md">Visit live site <?= icon('arrow-up') ?></a>
    <?php endif; ?>
  </div>
</section>

<section class="section pt-0">
  <div class="container">
    <div class="case-cover" data-reveal><?php project_thumb($p); ?></div>

    <div class="case-layout">
      <aside class="case-facts card" data-reveal>
        <dl>
          <div><dt>Client</dt><dd><?= e($p['title']) ?></dd></div>
          <div><dt>Location</dt><dd><?= e($p['country']) ?></dd></div>
          <div><dt>Year</dt><dd><?= e($p['year']) ?></dd></div>
          <div><dt>Type</dt><dd><?= e($cats[$p['category']] ?? '') ?></dd></div>
        </dl>
        <ul class="tags"><?php foreach ($p['tags'] as $t): ?><li><?= e($t) ?></li><?php endforeach; ?></ul>
      </aside>

      <div class="case-body" data-reveal>
        <h2>The challenge</h2>
        <p><?= e($p['challenge']) ?></p>
        <h2>The solution</h2>
        <p><?= e($p['solution']) ?></p>
        <h2>The results</h2>
        <ul class="check-list">
          <?php foreach ($p['results'] as $r): ?><li><?= icon('check') ?><?= e($r) ?></li><?php endforeach; ?>
        </ul>
      </div>
    </div>

    <nav class="case-nav" aria-label="More projects">
      <a href="<?= e(url('/work/' . $prev['slug'])) ?>" class="card"><small>Previous</small><?= e($prev['title']) ?></a>
      <a href="<?= e(url('/work/' . $next['slug'])) ?>" class="card is-next"><small>Next</small><?= e($next['title']) ?></a>
    </nav>
  </div>
</section>

<?php cta_band('Want results <em>like these?</em>', 'Tell me about your project and I’ll send you a clear plan and quote.'); ?>
