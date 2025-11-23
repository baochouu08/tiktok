<?php
require_once 'includes/platform-config.php';

$baseUrl = getBaseUrl();
$today = date('Y-m-d');

$urls = [
    ['loc' => '/', 'priority' => '1.0', 'changefreq' => 'daily', 'lastmod' => date('Y-m-d')],
    ['loc' => '/download-tiktok', 'priority' => '0.9', 'changefreq' => 'weekly'],
    ['loc' => '/download-instagram', 'priority' => '0.9', 'changefreq' => 'weekly'],
    ['loc' => '/download-youtube', 'priority' => '0.9', 'changefreq' => 'weekly'],
    ['loc' => '/download-twitter', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/download-facebook', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/download-douyin', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/download-bilibili', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/download-rednote', 'priority' => '0.7', 'changefreq' => 'weekly'],
    ['loc' => '/download-weverse', 'priority' => '0.7', 'changefreq' => 'weekly'],
    // Add blog page
    ['loc' => '/blog.php', 'changefreq' => 'weekly', 'priority' => '0.8', 'lastmod' => date('Y-m-d')]
];

header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($urls as $url): ?>
    <url>
        <loc><?php echo htmlspecialchars($baseUrl . $url['loc']); ?></loc>
        <lastmod><?php echo isset($url['lastmod']) ? $url['lastmod'] : $today; ?></lastmod>
        <changefreq><?php echo $url['changefreq']; ?></changefreq>
        <priority><?php echo $url['priority']; ?></priority>
    </url>
<?php endforeach; ?>
</urlset>