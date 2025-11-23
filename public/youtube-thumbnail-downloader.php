<?php
require_once 'includes/platform-config.php';
require_once 'includes/languages.php';

$platform = 'youtube';
$config = getPlatformConfig($platform);

$pageTitle = "YouTube Thumbnail Downloader - Download Thumbnails HD 2025";
$metaDescription = "Download YouTube video thumbnails in HD, Full HD, 4K quality. Get YouTube thumbnail images in all sizes. Free thumbnail downloader - instant download!";
$metaKeywords = "youtube thumbnail downloader, download youtube thumbnail, youtube thumbnail hd, get youtube thumbnail image, youtube thumbnail extractor, download video thumbnail";
$canonicalUrl = getBaseUrl() . "/youtube-thumbnail-downloader.php";

include 'includes/header.php';
?>

<div class="platform-header">
    <h1 class="title">YouTube <span class="highlight">Thumbnail Downloader</span></h1>
    <p class="subtitle">Download YouTube thumbnails in HD, Full HD, 4K - All sizes available</p>
</div>

<div class="search-box">
    <input type="text" id="videoUrl" class="search-input" placeholder="Paste YouTube video link to get thumbnail..." autocomplete="off" data-platform="<?php echo $platform; ?>">
    <button id="parseBtn" class="btn-start">Get Thumbnail</button>
</div>

<div id="loading" class="loading" style="display: none;"></div>
<div id="videoResult" class="video-result" style="display: none;"></div>

<section style="background: linear-gradient(135deg, #1C8576 0%, #15685E 100%); color: white; padding: 35px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h2 style="margin-bottom: 15px;">🖼️ Download YouTube Thumbnails</h2>
    <p>Extract and download YouTube video thumbnails in all available sizes. Perfect for content creators and designers!</p>
</section>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin: 40px 0;">
    <div style="background: #F2F4F6; padding: 20px; border-radius: 0.5rem; text-align: center;">
        <h3 style="color: #171A26; margin-bottom: 10px;">4K (Maxres)</h3>
        <p style="color: #171A26; opacity: 0.7; font-size: 14px;">1280×720 pixels</p>
    </div>
    <div style="background: #F2F4F6; padding: 20px; border-radius: 0.5rem; text-align: center;">
        <h3 style="color: #171A26; margin-bottom: 10px;">HD</h3>
        <p style="color: #171A26; opacity: 0.7; font-size: 14px;">1280×720 pixels</p>
    </div>
    <div style="background: #F2F4F6; padding: 20px; border-radius: 0.5rem; text-align: center;">
        <h3 style="color: #171A26; margin-bottom: 10px;">SD</h3>
        <p style="color: #171A26; opacity: 0.7; font-size: 14px;">640×480 pixels</p>
    </div>
</div>

<section class="platform-features">
    <div class="feature-card"><h3>🖼️ All Sizes</h3><p>Download thumbnails in all available resolutions from SD to 4K.</p></div>
    <div class="feature-card"><h3>⚡ Instant Download</h3><p>Get thumbnails instantly without processing time.</p></div>
    <div class="feature-card"><h3>🎨 For Designers</h3><p>Perfect for content creators and graphic designers.</p></div>
</section>

<div style="background: #F2F4F6; padding: 30px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h3 style="margin-bottom: 15px; color: #171A26;">More YouTube Tools</h3>
    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
        <a href="/download-youtube.php" style="color: #1C8576; text-decoration: none; font-weight: 600;">YouTube Downloader</a>
        <a href="/youtube-to-mp3.php" style="color: #1C8576; text-decoration: none; font-weight: 600;">YouTube to MP3</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/app.js"></script>
