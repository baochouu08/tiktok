<?php
require_once 'includes/platform-config.php';
require_once 'includes/languages.php';

$platform = 'instagram';
$config = getPlatformConfig($platform);

$pageTitle = "Instagram Photo Downloader - Save Instagram Images HD 2025";
$metaDescription = "Download Instagram photos & images in high resolution. Save IG pictures, profile photos, carousel images. Free Instagram photo downloader - no app needed!";
$metaKeywords = "instagram photo downloader, download instagram photos, instagram image downloader, save instagram pictures, ig photo downloader, download instagram images, instagram pic downloader";
$canonicalUrl = getBaseUrl() . "/instagram-photo-downloader.php";

include 'includes/header.php';
?>

<div class="platform-header">
    <h1 class="title">Instagram <span class="highlight">Photo Downloader</span></h1>
    <p class="subtitle">Download Instagram photos & images in full resolution - Save IG pictures easily</p>
</div>

<div class="search-box">
    <input type="text" id="videoUrl" class="search-input" placeholder="Paste Instagram post link..." autocomplete="off" data-platform="<?php echo $platform; ?>">
    <button id="parseBtn" class="btn-start">📥 Download Photo</button>
</div>

<div id="loading" class="loading" style="display: none;"></div>
<div id="videoResult" class="video-result" style="display: none;"></div>

<section style="background: linear-gradient(135deg, #1C8576 0%, #15685E 100%); color: white; padding: 35px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h2 style="margin-bottom: 15px;">📸 High-Resolution Photo Downloads</h2>
    <p>Save Instagram photos in their original quality. Perfect for wallpapers, collections, or offline viewing!</p>
</section>

<section class="platform-features">
    <div class="feature-card"><h3>🖼️ Full Resolution</h3><p>Download Instagram photos in original high-resolution quality.</p></div>
    <div class="feature-card"><h3>📸 Multiple Photos</h3><p>Download all photos from carousel posts at once.</p></div>
    <div class="feature-card"><h3>🎨 Profile Pictures</h3><p>Save Instagram profile pictures in full size.</p></div>
</section>

<div style="background: #F2F4F6; padding: 30px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h3 style="margin-bottom: 15px; color: #171A26;">More Instagram Downloaders</h3>
    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
        <a href="/instagram-video-downloader" style="color: #1C8576; text-decoration: none; font-weight: 600;">Video Downloader</a>
        <a href="/instagram-reels-downloader" style="color: #1C8576; text-decoration: none; font-weight: 600;">Reels Downloader</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/app.js"></script>
