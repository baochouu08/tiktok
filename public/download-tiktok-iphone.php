<?php
require_once 'includes/platform-config.php';
require_once 'includes/languages.php';

$platform = 'tiktok';
$config = getPlatformConfig($platform);

$pageTitle = "Download TikTok Videos on iPhone & iPad - iOS Free 2025";
$metaDescription = "Download TikTok videos on iPhone, iPad with iOS Safari. No app needed. Save TikTok to iPhone camera roll. Works on iOS 13, 14, 15, 16, 17. Free & easy!";
$metaKeywords = "download tiktok iphone, tiktok downloader ios, save tiktok to iphone, tiktok ipad download, tiktok safari download, download tiktok ios 17, save tiktok camera roll iphone";
$canonicalUrl = getBaseUrl() . "/download-tiktok-iphone.php";

$schemaMarkup = json_encode([
    "@context" => "https://schema.org",
    "@type" => "HowTo",
    "name" => "Download TikTok Videos on iPhone",
    "step" => [
        ["@type" => "HowToStep", "text" => "Open TikTok app on iPhone, find video, tap Share > Copy Link"],
        ["@type" => "HowToStep", "text" => "Open Safari browser, visit this page, paste TikTok link"],
        ["@type" => "HowToStep", "text" => "Tap Download, then tap and hold video > Save to Photos"]
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

include 'includes/header.php';
?>

<div class="platform-header">
    <h1 class="title">Download TikTok on <span class="highlight">iPhone & iPad</span></h1>
    <p class="subtitle">Save TikTok videos to iPhone camera roll - No app required, works on all iOS devices</p>
</div>

<div class="search-box">
    <input type="text" id="videoUrl" class="search-input" placeholder="Paste TikTok link here..." autocomplete="off" data-platform="<?php echo $platform; ?>">
    <button id="parseBtn" class="btn-start">📥 Download to iPhone</button>
</div>

<div id="loading" class="loading" style="display: none;"></div>
<div id="videoResult" class="video-result" style="display: none;"></div>

<section style="background: linear-gradient(135deg, #1C8576 0%, #15685E 100%); color: white; padding: 35px; border-radius: 0.5rem; margin: 40px 0;">
    <h2 style="margin-bottom: 15px;">📱 iPhone & iPad Compatible</h2>
    <p>Works perfectly on iOS 13, 14, 15, 16, and iOS 17. Download TikTok videos directly to your iPhone camera roll using Safari - no third-party app installation needed!</p>
</section>

<div class="instructions">
    <h2 style="text-align: center; margin-bottom: 30px;">How to Download TikTok on iPhone</h2>
    <div class="instruction-item">
        <div class="instruction-number step-1">1</div>
        <div class="instruction-text"><strong>Copy Link in TikTok App</strong><br>Open TikTok, find your video, tap the Share button (arrow), then tap "Copy Link"</div>
    </div>
    <div class="instruction-item">
        <div class="instruction-number step-2">2</div>
        <div class="instruction-text"><strong>Paste in Safari Browser</strong><br>Open Safari on iPhone, come to this page, paste the TikTok link in the box above</div>
    </div>
    <div class="instruction-item">
        <div class="instruction-number step-3">3</div>
        <div class="instruction-text"><strong>Save to Camera Roll</strong><br>Tap Download, then tap and hold the video > select "Save to Photos" - done!</div>
    </div>
</div>

<section class="faq-section">
    <h2 class="faq-title">iPhone TikTok Download FAQ</h2>
    <div class="faq-item">
        <button class="faq-question">Do I need to install an app on iPhone?<svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5" stroke="currentColor" stroke-width="2"/></svg></button>
        <div class="faq-answer"><p>No! Our TikTok downloader works directly in Safari browser. No app installation needed - just visit this page, paste link, and download.</p></div>
    </div>
    <div class="faq-item">
        <button class="faq-question">Can I save TikTok videos to iPhone camera roll?<svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5" stroke="currentColor" stroke-width="2"/></svg></button>
        <div class="faq-answer"><p>Yes! After downloading, tap and hold the video, then select "Save to Photos" to save it directly to your iPhone camera roll/photo library.</p></div>
    </div>
</section>

<div style="background: #F2F4F6; padding: 30px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h3 style="margin-bottom: 15px; color: #171A26;">Also Available</h3>
    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
        <a href="/download-tiktok-android" style="color: #1C8576; text-decoration: none; font-weight: 600;">TikTok for Android</a>
        <a href="/tiktok-no-watermark" style="color: #1C8576; text-decoration: none; font-weight: 600;">No Watermark</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/app.js"></script>
