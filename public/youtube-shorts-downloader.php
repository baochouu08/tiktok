<?php
require_once 'includes/platform-config.php';
require_once 'includes/languages.php';

$platform = 'youtube';
$config = getPlatformConfig($platform);

$pageTitle = "YouTube Shorts Downloader - Download Shorts Video HD 2025";
$metaDescription = "Download YouTube Shorts videos in HD quality. Save Shorts to your device without watermark. Free YouTube Shorts downloader - works on iPhone, Android, PC!";
$metaKeywords = "youtube shorts downloader, download youtube shorts, shorts video downloader, save youtube shorts, download shorts hd, youtube shorts saver, shorts downloader online";
$canonicalUrl = getBaseUrl() . "/youtube-shorts-downloader.php";

include 'includes/header.php';
?>

<div class="platform-header">
    <h1 class="title">YouTube <span class="highlight">Shorts Downloader</span></h1>
    <p class="subtitle">Download YouTube Shorts videos in HD - Free, fast & unlimited Shorts downloads</p>
</div>

<div class="search-box">
    <input type="text" id="videoUrl" class="search-input" placeholder="Paste YouTube Shorts link (https://youtube.com/shorts/...)..." autocomplete="off" data-platform="<?php echo $platform; ?>">
    <button id="parseBtn" class="btn-start">📥 Download Shorts</button>
</div>

<div id="loading" class="loading" style="display: none;"><p>Processing YouTube Shorts...</p></div>
<div id="videoResult" class="video-result" style="display: none;"></div>

<section style="background: linear-gradient(135deg, #1C8576 0%, #15685E 100%); color: white; padding: 35px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h2 style="margin-bottom: 15px;">🎬 Download YouTube Shorts Easily</h2>
    <p>Save your favorite YouTube Shorts videos in HD quality. Download Shorts to watch offline, share, or create compilations!</p>
</section>

<section class="platform-features">
    <div class="feature-card"><h3>📱 HD Shorts</h3><p>Download YouTube Shorts in full HD quality without compression.</p></div>
    <div class="feature-card"><h3>⚡ Fast Downloads</h3><p>Save Shorts in seconds with lightning-fast processing.</p></div>
    <div class="feature-card"><h3>🆓 100% Free</h3><p>Unlimited YouTube Shorts downloads at no cost.</p></div>
    <div class="feature-card"><h3>🎵 With Audio</h3><p>Download Shorts with original audio and music included.</p></div>
</section>

<div style="background: #F2F4F6; padding: 30px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h3 style="margin-bottom: 15px; color: #171A26;">More YouTube Downloaders</h3>
    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
        <a href="/download-youtube.php" style="color: #1C8576; text-decoration: none; font-weight: 600;">YouTube Downloader</a>
        <a href="/youtube-to-mp3.php" style="color: #1C8576; text-decoration: none; font-weight: 600;">YouTube to MP3</a>
        <a href="/youtube-hd-downloader" style="color: #1C8576; text-decoration: none; font-weight: 600;">YouTube HD</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/app.js"></script>
