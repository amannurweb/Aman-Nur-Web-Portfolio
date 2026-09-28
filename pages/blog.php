<?php
$meta['title']       = 'Blog — Web Development & Digital Marketing Insights | ' . config('site.name');
$meta['description'] = 'Web development tips, SEO and digital marketing strategies, and real case studies from 6+ years of client work.';
$blogIcons = ['SEO' => 'chart', 'E-commerce' => 'cart', 'Freelancing' => 'brief'];
?>
<section class="page-hero">
  <div class="container">
    <span class="eyebrow">Blog</span>
    <h1 class="page-title">Insights &amp; tutorials</h1>
    <p class="section-sub">Web development tips, digital marketing strategies and real case studies from my experience.</p>
  </div>
</section>

<section class="section pt-0">
  <div class="container">
    <div class="grid-3">
      <?php foreach (config('blog') as $i => $post): ?>
        <article class="card blog-card" data-reveal>
          <a href="<?= e($post['url']) ?>" target="_blank" rel="noopener">
            <div class="blog-thumb" style="--h: <?= [200, 20, 150][$i % 3] ?>"><?= icon($blogIcons[$post['category']] ?? 'blog') ?></div>
            <div class="blog-body">
              <div class="project-meta">
                <span><?= e($post['category']) ?></span>
                <time datetime="<?= e($post['date']) ?>"><?= e(date('M Y', strtotime($post['date']))) ?></time>
              </div>
              <h3><?= e($post['title']) ?></h3>
              <p><?= e($post['excerpt']) ?></p>
              <span class="text-link">Read article <?= icon('arrow-up') ?></span>
            </div>
          </a>
        </article>
      <?php endforeach; ?>
    </div>
    <div class="center mt-lg">
      <a href="<?= e(config('social.Blog')) ?>" target="_blank" rel="noopener" class="btn btn-ghost">Read all posts <?= icon('arrow-up') ?></a>
    </div>
  </div>
</section>

<?php cta_band(); ?>
