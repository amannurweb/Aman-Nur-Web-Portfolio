<?php
header('Content-Type: application/xml; charset=UTF-8');

$urls = ['', 'services', 'work', 'about', 'blog', 'contact'];
foreach (config('projects', []) as $p) {
    $urls[] = 'work/' . $p['slug'];
}
$lastmod = date('Y-m-d', filemtime(APP_ROOT . '/config.php'));

echo '<?xml version="1.0" encoding="UTF-8"?>', "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($urls as $u): ?>
  <url>
    <loc><?= e(absolute_url($u)) ?></loc>
    <lastmod><?= $lastmod ?></lastmod>
    <priority><?= $u === '' ? '1.0' : (str_starts_with($u, 'work/') ? '0.6' : '0.8') ?></priority>
  </url>
<?php endforeach; ?>
</urlset>
