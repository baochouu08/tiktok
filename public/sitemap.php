
<?php
header('Content-Type: application/xml; charset=utf-8');
require_once 'includes/platform-config.php';

$baseUrl = getBaseUrl();
$today = date('Y-m-d');
$languages = ['ar', 'de', 'en', 'es', 'fr', 'id', 'ja', 'ko', 'th', 'vi', 'zh'];

$urls = [
    ['loc' => '/', 'priority' => '1.0', 'changefreq' => 'daily'],
    
    ['loc' => '/download-tiktok', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/download-instagram', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/download-youtube', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/download-twitter', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/download-facebook', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/download-douyin', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/download-bilibili', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/download-rednote', 'priority' => '0.7', 'changefreq' => 'weekly'],
    ['loc' => '/download-weverse', 'priority' => '0.7', 'changefreq' => 'weekly'],
    
    ['loc' => '/tiktok-no-watermark', 'priority' => '0.85', 'changefreq' => 'weekly'],
    ['loc' => '/tiktok-to-mp3', 'priority' => '0.85', 'changefreq' => 'weekly'],
    ['loc' => '/tiktok-hd-4k', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/download-tiktok-iphone', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/download-tiktok-android', 'priority' => '0.8', 'changefreq' => 'weekly'],
    
    ['loc' => '/instagram-reels-downloader', 'priority' => '0.85', 'changefreq' => 'weekly'],
    ['loc' => '/instagram-story-downloader', 'priority' => '0.85', 'changefreq' => 'weekly'],
    ['loc' => '/instagram-video-downloader', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/instagram-photo-downloader', 'priority' => '0.75', 'changefreq' => 'weekly'],
    ['loc' => '/instagram-no-watermark', 'priority' => '0.8', 'changefreq' => 'weekly'],
    
    ['loc' => '/youtube-to-mp3', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/youtube-shorts-downloader', 'priority' => '0.85', 'changefreq' => 'weekly'],
    ['loc' => '/youtube-hd-downloader', 'priority' => '0.85', 'changefreq' => 'weekly'],
    ['loc' => '/youtube-playlist-downloader', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/youtube-thumbnail-downloader', 'priority' => '0.75', 'changefreq' => 'weekly'],
    
    ['loc' => '/blog', 'priority' => '0.7', 'changefreq' => 'daily'],
    ['loc' => '/blog/best-tiktok-downloader-2025', 'priority' => '0.75', 'changefreq' => 'weekly'],
    ['loc' => '/blog/download-tiktok-without-watermark', 'priority' => '0.75', 'changefreq' => 'weekly'],
    ['loc' => '/blog/instagram-reels-vs-tiktok-2025', 'priority' => '0.75', 'changefreq' => 'weekly'],
    ['loc' => '/blog/top-10-video-downloaders-2025', 'priority' => '0.75', 'changefreq' => 'weekly'],
];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
<?php foreach ($urls as $url): ?>
<?php foreach ($languages as $lang): ?>
    <url>
        <?php if ($lang === 'en'): ?>
        <loc><?php echo htmlspecialchars($baseUrl . $url['loc']); ?></loc>
        <?php else: ?>
        <loc><?php echo htmlspecialchars($baseUrl . '/' . $lang . $url['loc']); ?></loc>
        <?php endif; ?>
        <lastmod><?php echo $today; ?></lastmod>
        <changefreq><?php echo $url['changefreq']; ?></changefreq>
        <priority><?php echo $url['priority']; ?></priority>
        <?php foreach ($languages as $hreflang): ?>
        <?php if ($hreflang === 'en'): ?>
        <xhtml:link rel="alternate" hreflang="<?php echo $hreflang; ?>" href="<?php echo htmlspecialchars($baseUrl . $url['loc']); ?>" />
        <?php else: ?>
        <xhtml:link rel="alternate" hreflang="<?php echo $hreflang; ?>" href="<?php echo htmlspecialchars($baseUrl . '/' . $hreflang . $url['loc']); ?>" />
        <?php endif; ?>
        <?php endforeach; ?>
        <xhtml:link rel="alternate" hreflang="x-default" href="<?php echo htmlspecialchars($baseUrl . $url['loc']); ?>" />
    </url>
<?php endforeach; ?>
<?php endforeach; ?>
</urlset>
