<?php
$meta['title']       = 'Work — Selected Projects & Case Studies | ' . config('site.name');
$meta['description'] = 'Selected WordPress, WooCommerce, Shopify, custom PHP and SEO projects for clients in the USA, Australia, Pakistan and Saudi Arabia.';
$projects = config('projects', []);
$used     = array_unique(array_column($projects, 'category'));
?>
<section class="page-hero">
  <div class="container">
    <span class="eyebrow">Portfolio</span>
    <h1 class="page-title">Projects that<br>delivered results</h1>
    <p class="section-sub">A selection of real client projects across industries and countries.</p>
  </div>
</section>

<section class="section pt-0">
  <div class="container">
    <div class="filters" role="group" aria-label="Filter projects" hidden>
      <button type="button" class="filter is-active" data-filter="all" aria-pressed="true">All</button>
      <?php foreach (config('project_categories') as $key => $label): if (!in_array($key, $used, true)) continue; ?>
        <button type="button" class="filter" data-filter="<?= e($key) ?>" aria-pressed="false"><?= e($label) ?></button>
      <?php endforeach; ?>
    </div>

    <div class="grid-3 project-grid">
      <?php foreach ($projects as $p) project_card($p); ?>
    </div>

    <div class="center mt-lg" data-reveal>
      <p class="muted">Want to see more? I have completed 350+ projects.</p>
      <a href="<?= e(config('social.Fiverr')) ?>" target="_blank" rel="noopener" class="btn btn-ghost">View Fiverr portfolio <?= icon('arrow-up') ?></a>
    </div>
  </div>
</section>

<?php cta_band('Have a project <em>in mind?</em>', 'Tell me what you need — I’ll tell you exactly how to make it succeed.'); ?>
