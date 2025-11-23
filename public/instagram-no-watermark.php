<?php
require_once 'includes/platform-config.php';
require_once 'includes/languages.php';

$platform = 'instagram';
$config = getPlatformConfig($platform);

$pageTitle = "Instagram Downloader No Watermark - Save Without Logo 2025";
$metaDescription = "Download Instagram videos & Reels without watermark. Remove Instagram logo and save clean content. Free, no watermark downloader for all Instagram content!";
$metaKeywords = "instagram no watermark, instagram downloader no watermark, remove instagram watermark, instagram without logo, download instagram no watermark, reels no watermark";
$canonicalUrl = getBaseUrl() . "/instagram-no-watermark.php";

include 'includes/header.php';
?>

<div class="platform-header">
    <h1 class="title">Instagram <span class="highlight">No Watermark</span></h1>
    <p class="subtitle">Download Instagram content without watermark - Clean, professional videos & Reels</p>
</div>

<div class="search-box">
    <input type="text" id="videoUrl" class="search-input" placeholder="Paste Instagram link..." autocomplete="off" data-platform="<?php echo $platform; ?>">
    <button id="parseBtn" class="btn-start">Download No Watermark</button>
</div>

<div id="loading" class="loading" style="display: none;"></div>
<div id="videoResult" class="video-result" style="display: none;"></div>

<section style="background: linear-gradient(135deg, #1C8576 0%, #15685E 100%); color: white; padding: 35px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h2 style="margin-bottom: 15px;">✨ Crystal Clear Content - No Logo</h2>
    <p>Get professional-looking Instagram videos and Reels without any watermark or logo. Perfect for content creation and social media!</p>
</section>

<section class="platform-features">
    <div class="feature-card"><h3>🎯 No Watermark</h3><p>100% clean content without Instagram logo or branding.</p></div>
    <div class="feature-card"><h3>📹 Reels & Videos</h3><p>Download both Reels and regular videos without watermark.</p></div>
    <div class="feature-card"><h3>🎬 HD Quality</h3><p>Maintain full HD quality while removing watermark.</p></div>
</section>

<div style="background: #F2F4F6; padding: 30px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h3 style="margin-bottom: 15px; color: #171A26;">Related Tools</h3>
    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
        <a href="/instagram-reels-downloader" style="color: #1C8576; text-decoration: none; font-weight: 600;">Reels Downloader</a>
        <a href="/instagram-video-downloader" style="color: #1C8576; text-decoration: none; font-weight: 600;">Video Downloader</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/app.js"></script>
