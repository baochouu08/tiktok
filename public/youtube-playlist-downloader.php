<?php
require_once 'includes/platform-config.php';
require_once 'includes/languages.php';

$platform = 'youtube';
$config = getPlatformConfig($platform);

$pageTitle = "YouTube Playlist Downloader - Download Entire Playlist Free 2025";
$metaDescription = "Download entire YouTube playlist at once. Save all videos from YouTube playlist in HD. Free bulk downloader - download multiple videos simultaneously!";
$metaKeywords = "youtube playlist downloader, download youtube playlist, bulk youtube downloader, download multiple youtube videos, youtube playlist to mp4, batch youtube downloader";
$canonicalUrl = getBaseUrl() . "/youtube-playlist-downloader.php";

include 'includes/header.php';
?>

<div class="platform-header">
    <h1 class="title">YouTube <span class="highlight">Playlist Downloader</span></h1>
    <p class="subtitle">Download entire YouTube playlists - Save all videos at once, bulk download</p>
</div>

<div class="search-box">
    <input type="text" id="videoUrl" class="search-input" placeholder="Paste YouTube playlist link..." autocomplete="off" data-platform="<?php echo $platform; ?>">
    <button id="parseBtn" class="btn-start">📥 Download Playlist</button>
</div>

<div id="loading" class="loading" style="display: none;"><p>Processing YouTube playlist...</p></div>
<div id="videoResult" class="video-result" style="display: none;"></div>

<section style="background: linear-gradient(135deg, #1C8576 0%, #15685E 100%); color: white; padding: 35px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h2 style="margin-bottom: 15px;">📂 Bulk Download YouTube Playlists</h2>
    <p>Save entire YouTube playlists with one click. Download all videos from music playlists, courses, series - no manual copying needed!</p>
</section>

<section class="platform-features">
    <div class="feature-card"><h3>📂 Batch Download</h3><p>Download all videos from a playlist simultaneously.</p></div>
    <div class="feature-card"><h3>⚡ Fast Processing</h3><p>Process entire playlists quickly with parallel downloads.</p></div>
    <div class="feature-card"><h3>🎵 Music Playlists</h3><p>Perfect for saving music playlists and albums.</p></div>
    <div class="feature-card"><h3>📚 Course Downloads</h3><p>Download educational playlists and tutorial series.</p></div>
</section>

<div style="background: #F2F4F6; padding: 30px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h3 style="margin-bottom: 15px; color: #171A26;">Related YouTube Tools</h3>
    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
        <a href="/download-youtube.php" style="color: #1C8576; text-decoration: none; font-weight: 600;">YouTube Downloader</a>
        <a href="/youtube-to-mp3.php" style="color: #1C8576; text-decoration: none; font-weight: 600;">YouTube to MP3</a>
        <a href="/youtube-hd-downloader" style="color: #1C8576; text-decoration: none; font-weight: 600;">YouTube HD</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/app.js"></script>
