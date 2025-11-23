<?php
require_once 'includes/platform-config.php';
require_once 'includes/languages.php';

$platform = 'tiktok';
$config = getPlatformConfig($platform);

$pageTitle = "Download TikTok Videos on Android - Free App & Browser 2025";
$metaDescription = "Download TikTok videos on Android phone & tablet. Save to gallery. Works on Samsung, Xiaomi, Huawei, OnePlus. No root needed. Free TikTok downloader for Android!";
$metaKeywords = "download tiktok android, tiktok downloader apk, save tiktok android, tiktok samsung download, download tiktok to gallery android, tiktok android app download";
$canonicalUrl = getBaseUrl() . "/download-tiktok-android.php";

$schemaMarkup = json_encode([
    "@context" => "https://schema.org",
    "@type" => "MobileApplication",
    "name" => "TikTok Downloader for Android",
    "operatingSystem" => "Android",
    "applicationCategory" => "MultimediaApplication"
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

include 'includes/header.php';
?>

<div class="platform-header">
    <h1 class="title">Download TikTok on <span class="highlight">Android</span></h1>
    <p class="subtitle">Save TikTok videos to Android gallery - Works on Samsung, Xiaomi, Huawei, OnePlus & all Android devices</p>
</div>

<div class="search-box">
    <input type="text" id="videoUrl" class="search-input" placeholder="Paste TikTok link here..." autocomplete="off" data-platform="<?php echo $platform; ?>">
    <button id="parseBtn" class="btn-start">📥 Download to Android</button>
</div>

<div id="loading" class="loading" style="display: none;"></div>
<div id="videoResult" class="video-result" style="display: none;"></div>

<section style="background: linear-gradient(135deg, #1C8576 0%, #15685E 100%); color: white; padding: 35px; border-radius: 0.5rem; margin: 40px 0;">
    <h2 style="margin-bottom: 15px;">🤖 Android Compatible</h2>
    <p>Works on all Android versions: Android 8, 9, 10, 11, 12, 13, 14. Compatible with Samsung, Xiaomi, Huawei, OnePlus, Realme, Vivo, Oppo and all Android smartphones!</p>
</section>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin: 40px 0;">
    <div style="background: #F2F4F6; padding: 25px; border-radius: 0.5rem; border-left: 4px solid #1C8576;">
        <h3 style="color: #171A26; margin-bottom: 10px;">✅ No Root Required</h3>
        <p style="color: #171A26; opacity: 0.7;">Download TikTok videos without rooting your Android device. 100% safe and compatible.</p>
    </div>
    <div style="background: #F2F4F6; padding: 25px; border-radius: 0.5rem; border-left: 4px solid #1C8576;">
        <h3 style="color: #171A26; margin-bottom: 10px;">📁 Save to Gallery</h3>
        <p style="color: #171A26; opacity: 0.7;">Videos automatically saved to your Android gallery/downloads folder for easy access.</p>
    </div>
    <div style="background: #F2F4F6; padding: 25px; border-radius: 0.5rem; border-left: 4px solid #1C8576;">
        <h3 style="color: #171A26; margin-bottom: 10px;">🚀 Fast Downloads</h3>
        <p style="color: #171A26; opacity: 0.7;">Lightning-fast download speeds optimized for Android Chrome and mobile browsers.</p>
    </div>
</div>

<div class="instructions">
    <h2 style="text-align: center; margin-bottom: 30px;">How to Download TikTok on Android</h2>
    <div class="instruction-item">
        <div class="instruction-number step-1">1</div>
        <div class="instruction-text"><strong>Copy TikTok Link</strong><br>Open TikTok app on Android, tap Share > Copy Link</div>
    </div>
    <div class="instruction-item">
        <div class="instruction-number step-2">2</div>
        <div class="instruction-text"><strong>Paste Here</strong><br>Open Chrome browser, visit this page, paste the link</div>
    </div>
    <div class="instruction-item">
        <div class="instruction-number step-3">3</div>
        <div class="instruction-text"><strong>Download Video</strong><br>Tap Download button - video saved to Gallery automatically!</div>
    </div>
</div>

<div style="background: #F2F4F6; padding: 30px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h3 style="margin-bottom: 15px; color: #171A26;">Related Tools</h3>
    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
        <a href="/download-tiktok-iphone" style="color: #1C8576; text-decoration: none; font-weight: 600;">TikTok for iPhone</a>
        <a href="/tiktok-no-watermark" style="color: #1C8576; text-decoration: none; font-weight: 600;">No Watermark</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/app.js"></script>
