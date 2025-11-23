<?php
require_once 'includes/platform-config.php';
require_once 'includes/languages.php';

$platform = 'youtube';
$config = getPlatformConfig($platform);

$pageTitle = "YouTube HD Downloader - Download YouTube Videos in 4K 1080p 2025";
$metaDescription = "Download YouTube videos in HD 1080p, 4K, 8K quality. Get highest resolution YouTube downloads. Free HD downloader - works on all devices!";
$metaKeywords = "youtube hd downloader, download youtube 4k, youtube 1080p downloader, youtube 8k download, youtube high quality downloader, youtube uhd downloader";
$canonicalUrl = getBaseUrl() . "/youtube-hd-downloader.php";

include 'includes/header.php';
?>

<div class="platform-header">
    <h1 class="title">YouTube <span class="highlight">HD 4K Downloader</span></h1>
    <p class="subtitle">Download YouTube in 1080p, 4K, 8K - Maximum quality, crystal clear videos</p>
</div>

<div class="search-box">
    <input type="text" id="videoUrl" class="search-input" placeholder="Paste YouTube link to download in HD/4K..." autocomplete="off" data-platform="<?php echo $platform; ?>">
    <button id="parseBtn" class="btn-start">Download HD/4K</button>
</div>

<div id="loading" class="loading" style="display: none;"></div>
<div id="videoResult" class="video-result" style="display: none;"></div>

<section style="background: linear-gradient(135deg, #1C8576 0%, #15685E 100%); color: white; padding: 35px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h2 style="margin-bottom: 15px;">🎬 Professional Quality YouTube Downloads</h2>
    <p>Download YouTube videos in the highest available resolution - 8K, 4K UHD, 1080p Full HD. Perfect for big screens!</p>
</section>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin: 40px 0;">
    <div style="background: #F2F4F6; padding: 25px; border-radius: 0.5rem; text-align: center;">
        <div style="font-size: 36px; margin-bottom: 10px;">8K</div>
        <h3 style="color: #171A26; margin-bottom: 8px;">Ultra HD</h3>
        <p style="color: #171A26; opacity: 0.7; font-size: 14px;">7680×4320<br>Ultimate quality</p>
    </div>
    <div style="background: #F2F4F6; padding: 25px; border-radius: 0.5rem; text-align: center;">
        <div style="font-size: 36px; margin-bottom: 10px;">4K</div>
        <h3 style="color: #171A26; margin-bottom: 8px;">UHD</h3>
        <p style="color: #171A26; opacity: 0.7; font-size: 14px;">3840×2160<br>Cinema quality</p>
    </div>
    <div style="background: #F2F4F6; padding: 25px; border-radius: 0.5rem; text-align: center;">
        <div style="font-size: 36px; margin-bottom: 10px;">1080p</div>
        <h3 style="color: #171A26; margin-bottom: 8px;">Full HD</h3>
        <p style="color: #171A26; opacity: 0.7; font-size: 14px;">1920×1080<br>Best balance</p>
    </div>
</div>

<div style="background: #F2F4F6; padding: 30px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h3 style="margin-bottom: 15px; color: #171A26;">More YouTube Tools</h3>
    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
        <a href="/download-youtube.php" style="color: #1C8576; text-decoration: none; font-weight: 600;">YouTube Downloader</a>
        <a href="/youtube-to-mp3.php" style="color: #1C8576; text-decoration: none; font-weight: 600;">YouTube to MP3</a>
        <a href="/youtube-shorts-downloader" style="color: #1C8576; text-decoration: none; font-weight: 600;">Shorts Downloader</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/app.js"></script>
