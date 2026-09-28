<?php
$meta['title']       = 'About — ' . config('site.name') . ', PHP Developer in Dammam';
$meta['description'] = 'Md Aman Ullah is a Full Stack PHP Developer and Digital Marketer in Dammam, Saudi Arabia with 6+ years of experience and 350+ websites delivered.';
$highlightIcons = ['bolt', 'target', 'shield', 'globe'];
?>
<section class="page-hero">
  <div class="container about-layout">
    <aside class="card about-card" data-reveal>
      <div class="avatar lg"><?= e(initials(config('site.name'))) ?></div>
      <h1 class="about-name"><?= e(config('site.name')) ?></h1>
      <p class="muted">PHP Developer · Digital Marketer · Fiverr Level 2</p>
      <ul class="profile-meta">
        <li><span class="meta-icon"><?= icon('pin') ?></span><span><small>Location</small>Dammam, Eastern Province 🇸🇦</span></li>
        <li><span class="meta-icon"><?= icon('phone') ?></span><span><small>Phone / WhatsApp</small><a href="<?= e(whatsapp_url()) ?>" target="_blank" rel="noopener"><?= e(config('contact.phone')) ?></a></span></li>
        <li><span class="meta-icon"><?= icon('mail') ?></span><span><small>Email</small><a href="mailto:<?= e(config('contact.email')) ?>"><?= e(config('contact.email')) ?></a></span></li>
        <li><span class="meta-icon"><?= icon('brief') ?></span><span><small>Current company</small><?= e(config('contact.company')) ?>, Dammam</span></li>
      </ul>
      <div class="socials">
        <?php foreach (config('social', []) as $label => $href): ?>
          <a href="<?= e($href) ?>" target="_blank" rel="noopener" aria-label="<?= e($label) ?>"><?= icon(strtolower($label)) ?></a>
        <?php endforeach; ?>
      </div>
    </aside>

    <div class="about-content" data-reveal>
      <span class="eyebrow">About me</span>
      <h2 class="page-title">I help businesses<br>win online</h2>
      <p>My name is <strong>Md Aman Ullah</strong>. I started my journey in web development in 2018, working on ThemeForest and TemplateMonster. Today I’m a Full Stack PHP Developer and Digital Marketer based in <strong>Dammam, Saudi Arabia</strong>.</p>
      <p>What makes me different? I understand <strong>both sides</strong> — the technical and the marketing. I don’t just build a beautiful website and hand it over. I make sure it actually brings you clients, ranks on Google, and grows your revenue.</p>
      <p>Over <strong>6+ years</strong> I’ve delivered <strong>350+ websites</strong>, <strong>160+ online stores</strong> and <strong>50+ custom PHP applications</strong> for clients in Saudi Arabia, the USA, UK, Australia, Pakistan and more.</p>

      <div class="highlights">
        <?php foreach (config('highlights') as $i => $h): ?>
          <div class="highlight">
            <span class="meta-icon"><?= icon($highlightIcons[$i % 4]) ?></span>
            <div><strong><?= e($h['title']) ?></strong><p><?= e($h['text']) ?></p></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="container narrow">
    <?php section_head('Experience', 'Where I’ve worked'); ?>
    <ol class="timeline">
      <?php foreach (config('experience') as $x): ?>
        <li data-reveal>
          <span class="timeline-date"><?= e($x['date']) ?></span>
          <h3><?= e($x['title']) ?></h3>
          <div class="timeline-company"><?= e($x['company']) ?></div>
          <p><?= e($x['text']) ?></p>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<?php cta_band(); ?>
