<?php
require_once 'includes/platform-config.php';
require_once 'includes/languages.php';

$platform = 'tiktok';
$config = getPlatformConfig($platform);

$pageTitle = "Download TikTok Videos in HD 4K 1080p - High Quality Free 2025";
$metaDescription = "Download TikTok videos in HD 1080p, 4K UHD quality. Get highest resolution TikTok videos for free. Works on all devices - no quality loss, crystal clear downloads.";
$metaKeywords = "tiktok hd download, tiktok 4k downloader, download tiktok 1080p, tiktok high quality, tiktok uhd downloader, tiktok full hd, download tiktok 720p, tiktok best quality";
$canonicalUrl = getBaseUrl() . "/tiktok-hd-4k.php";

$schemaMarkup = json_encode([
    "@context" => "https://schema.org",
    "@graph" => [
        ["@type" => "HowTo", "name" => "Download TikTok in HD 4K", "step" => [
            ["@type" => "HowToStep", "text" => "Copy TikTok video link"],
            ["@type" => "HowToStep", "text" => "Paste link and select HD/4K quality"],
            ["@type" => "HowToStep", "text" => "Download high-resolution video"]
        ]],
        ["@type" => "FAQPage", "mainEntity" => [
            ["@type" => "Question", "name" => "Can I download TikTok in 4K quality?", 
             "acceptedAnswer" => ["@type" => "Answer", "text" => "Yes! If the original TikTok video was uploaded in 4K, our downloader preserves the full 4K UHD resolution. Most TikTok videos are available in HD 1080p or 720p quality."]]
        ]]
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

include 'includes/header.php';
?>

<div class="platform-header">
    <h1 class="title">Download TikTok Videos in <span class="highlight">HD 4K Quality</span></h1>
    <p class="subtitle">Get TikTok videos in 1080p Full HD, 4K UHD, and 720p - Maximum resolution, crystal clear quality</p>
</div>

<div class="search-box">
    <input type="text" id="videoUrl" class="search-input" placeholder="Paste TikTok link to download in HD/4K quality..." autocomplete="off" data-platform="<?php echo $platform; ?>">
    <button id="parseBtn" class="btn-start">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z" fill="currentColor"/></svg>
        Download HD/4K
    </button>
</div>

<div id="loading" class="loading" style="display: none;"></div>
<div id="videoResult" class="video-result" style="display: none;"></div>

<section style="background: linear-gradient(135deg, #1C8576 0%, #15685E 100%); color: white; padding: 40px 30px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h2 style="font-size: 28px; margin-bottom: 15px;">🎬 Professional Quality TikTok Downloads</h2>
    <p style="font-size: 16px; opacity: 0.95;">Download TikTok videos in the highest available resolution - 4K UHD (2160p), Full HD (1080p), or HD (720p). Perfect for big screens, editing, and professional use!</p>
</section>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin: 40px 0;">
    <div style="background: #F2F4F6; padding: 25px; border-radius: 0.5rem; text-align: center;">
        <div style="font-size: 36px; margin-bottom: 10px;">4K</div>
        <h3 style="color: #171A26; margin-bottom: 8px;">Ultra HD Quality</h3>
        <p style="color: #171A26; opacity: 0.7; font-size: 14px;">3840×2160 resolution<br>Best for 4K displays</p>
    </div>
    <div style="background: #F2F4F6; padding: 25px; border-radius: 0.5rem; text-align: center;">
        <div style="font-size: 36px; margin-bottom: 10px;">1080p</div>
        <h3 style="color: #171A26; margin-bottom: 8px;">Full HD Quality</h3>
        <p style="color: #171A26; opacity: 0.7; font-size: 14px;">1920×1080 resolution<br>Perfect balance</p>
    </div>
    <div style="background: #F2F4F6; padding: 25px; border-radius: 0.5rem; text-align: center;">
        <div style="font-size: 36px; margin-bottom: 10px;">720p</div>
        <h3 style="color: #171A26; margin-bottom: 8px;">HD Quality</h3>
        <p style="color: #171A26; opacity: 0.7; font-size: 14px;">1280×720 resolution<br>Faster download</p>
    </div>
</div>

<div style="background: #F2F4F6; padding: 30px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h3 style="margin-bottom: 15px; color: #171A26;">More TikTok Download Options</h3>
    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
        <a href="/download-tiktok.php" style="color: #1C8576; text-decoration: none; font-weight: 600;">TikTok Downloader</a>
        <a href="/tiktok-no-watermark.php" style="color: #1C8576; text-decoration: none; font-weight: 600;">No Watermark</a>
        <a href="/tiktok-to-mp3.php" style="color: #1C8576; text-decoration: none; font-weight: 600;">TikTok to MP3</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/app.js"></script>
