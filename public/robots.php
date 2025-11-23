<?php
require_once 'includes/platform-config.php';

$baseUrl = getBaseUrl();

header('Content-Type: text/plain; charset=utf-8');
?>
User-agent: *
Allow: /
Disallow: /api/
Disallow: /downloads/
Disallow: /src/
Disallow: /includes/

# Multilingual sitemap
Sitemap: <?php echo $baseUrl; ?>/sitemap.xml
