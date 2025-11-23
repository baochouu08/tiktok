<?php
require_once 'includes/platform-config.php';
require_once 'includes/languages.php';

$platform = 'instagram';
$config = getPlatformConfig($platform);

$pageTitle = "Instagram Video Downloader - Download Instagram Videos HD 2025";
$metaDescription = "Download Instagram videos in HD quality. Save IG videos, IGTV, Reels to your device. Free Instagram video downloader - works on iPhone, Android, PC. No app needed!";
$metaKeywords = "instagram video downloader, download instagram videos, instagram video saver, ig video downloader, save instagram video, download ig videos, instagram downloader online";
$canonicalUrl = getBaseUrl() . "/instagram-video-downloader.php";

$schemaMarkup = json_encode(["@context" => "https://schema.org", "@type" => "WebApplication", "name" => "Instagram Video Downloader"], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
include 'includes/header.php';
?>

<div class="platform-header">
    <h1 class="title">Instagram <span class="highlight">Video Downloader</span></h1>
    <p class="subtitle">Download Instagram videos, IGTV, Reels in HD - Free & unlimited downloads</p>
</div>

<div class="search-box">
    <input type="text" id="videoUrl" class="search-input" placeholder="Paste Instagram video link..." autocomplete="off" data-platform="<?php echo $platform; ?>">
    <button id="parseBtn" class="btn-start">📥 Download Video</button>
</div>

<div id="loading" class="loading" style="display: none;"></div>
<div id="videoResult" class="video-result" style="display: none;"></div>

<section style="background: linear-gradient(135deg, #1C8576 0%, #15685E 100%); color: white; padding: 35px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h2 style="margin-bottom: 15px;">🎬 Download All Instagram Video Types</h2>
    <p>Save Instagram feed videos, IGTV, Reels, Stories - all in one tool. HD quality, fast downloads, 100% free!</p>
</section>

<section class="platform-features">
    <div class="feature-card"><h3>🎥 All Video Types</h3><p>Download feed videos, IGTV, Reels, and Stories in one place.</p></div>
    <div class="feature-card"><h3>📺 HD Quality</h3><p>Save Instagram videos in full HD 1080p quality.</p></div>
    <div class="feature-card"><h3>⚡ Fast & Easy</h3><p>Simple paste & download - no complicated steps.</p></div>
    <div class="feature-card"><h3>🆓 Totally Free</h3><p>Unlimited video downloads with zero cost.</p></div>
</section>

<div style="background: #F2F4F6; padding: 30px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h3 style="margin-bottom: 15px; color: #171A26;">Related Instagram Tools</h3>
    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
        <a href="/instagram-reels-downloader" style="color: #1C8576; text-decoration: none; font-weight: 600;">Reels Downloader</a>
        <a href="/instagram-story-downloader" style="color: #1C8576; text-decoration: none; font-weight: 600;">Story Downloader</a>
        <a href="/instagram-photo-downloader" style="color: #1C8576; text-decoration: none; font-weight: 600;">Photo Downloader</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/app.js"></script>
