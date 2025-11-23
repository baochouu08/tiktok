<?php
require_once 'includes/platform-config.php';
require_once 'includes/languages.php';

$platform = 'instagram';
$config = getPlatformConfig($platform);

$pageTitle = "Instagram Reels Downloader - Download Reels Video HD Free 2025";
$metaDescription = "Download Instagram Reels videos in HD quality. Save Reels to your device without watermark. Free Instagram Reels downloader - works on iPhone, Android, PC. No app needed!";
$metaKeywords = "instagram reels downloader, download instagram reels, reels video downloader, save instagram reels, download reels hd, instagram reels saver, ig reels downloader, reels download online";
$canonicalUrl = getBaseUrl() . "/instagram-reels-downloader.php";

$schemaMarkup = json_encode([
    "@context" => "https://schema.org",
    "@graph" => [
        ["@type" => "HowTo", "name" => "Download Instagram Reels", "step" => [
            ["@type" => "HowToStep", "text" => "Open Instagram, find Reels, tap ... > Copy Link"],
            ["@type" => "HowToStep", "text" => "Paste Reels link here"],
            ["@type" => "HowToStep", "text" => "Download Reels video to device"]
        ]],
        ["@type" => "FAQPage", "mainEntity" => [
            ["@type" => "Question", "name" => "How do I download Instagram Reels?", 
             "acceptedAnswer" => ["@type" => "Answer", "text" => "Copy the Instagram Reels link, paste it into our downloader, and click Download. The Reels video will be saved to your device in HD quality."]]
        ]]
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

include 'includes/header.php';
?>

<div class="platform-header">
    <h1 class="title">Instagram <span class="highlight">Reels Downloader</span></h1>
    <p class="subtitle">Download Instagram Reels videos in HD - Free, fast & unlimited Reels downloads on all devices</p>
</div>

<div class="search-box">
    <input type="text" id="videoUrl" class="search-input" placeholder="Paste Instagram Reels link here (https://www.instagram.com/reel/...)..." autocomplete="off" data-platform="<?php echo $platform; ?>">
    <button id="parseBtn" class="btn-start">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z" fill="currentColor"/></svg>
        Download Reels
    </button>
</div>

<div id="loading" class="loading" style="display: none;"><p>Processing Instagram Reels...</p></div>
<div id="videoResult" class="video-result" style="display: none;"></div>

<section style="background: linear-gradient(135deg, #1C8576 0%, #15685E 100%); color: white; padding: 40px 30px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h2 style="font-size: 28px; margin-bottom: 15px;">🎬 Best Instagram Reels Downloader 2025</h2>
    <p style="font-size: 16px; opacity: 0.95;">Save your favorite Instagram Reels videos in full HD quality. Download Reels to watch offline, share, or create compilations. 100% free and unlimited!</p>
</section>

<section class="platform-features">
    <div class="feature-card">
        <h3>🎥 HD Quality Reels</h3>
        <p>Download Instagram Reels in full 1080p HD quality without compression or quality loss.</p>
    </div>
    <div class="feature-card">
        <h3>⚡ Super Fast</h3>
        <p>Download Reels in seconds with our optimized processing engine. No waiting time!</p>
    </div>
    <div class="feature-card">
        <h3>📱 All Devices</h3>
        <p>Works on iPhone, Android, PC, Mac, iPad. Download Reels from any device, anywhere.</p>
    </div>
    <div class="feature-card">
        <h3>🆓 100% Free</h3>
        <p>Unlimited Reels downloads. No registration, no payment, no hidden fees - totally free!</p>
    </div>
    <div class="feature-card">
        <h3>🔒 Private & Secure</h3>
        <p>We don't store your downloads or data. Complete privacy with SSL encryption.</p>
    </div>
    <div class="feature-card">
        <h3>🎵 With Audio</h3>
        <p>Download Reels with original audio, music, and sound effects included.</p>
    </div>
</section>

<div class="instructions">
    <h2 style="text-align: center; margin-bottom: 30px;">How to Download Instagram Reels</h2>
    <div class="instruction-item">
        <div class="instruction-number step-1">1</div>
        <div class="instruction-text"><strong>Copy Reels Link</strong><br>Open Instagram app, find the Reels video, tap the three dots (...) and select "Copy Link"</div>
    </div>
    <div class="instruction-item">
        <div class="instruction-number step-2">2</div>
        <div class="instruction-text"><strong>Paste Link Here</strong><br>Return to this page and paste the Instagram Reels URL into the input box above</div>
    </div>
    <div class="instruction-item">
        <div class="instruction-number step-3">3</div>
        <div class="instruction-text"><strong>Download Reels Video</strong><br>Click "Download Reels" button and save the HD video to your device - enjoy offline!</div>
    </div>
</div>

<section class="faq-section">
    <h2 class="faq-title">Instagram Reels Download FAQ</h2>
    <div class="faq-item">
        <button class="faq-question">How do I download Instagram Reels?<svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5" stroke="currentColor" stroke-width="2"/></svg></button>
        <div class="faq-answer"><p>Copy the Instagram Reels link by tapping the three dots on any Reels video and selecting "Copy Link". Paste it into our downloader above and click Download to save the Reels video to your device.</p></div>
    </div>
    <div class="faq-item">
        <button class="faq-question">Can I download Reels on iPhone?<svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5" stroke="currentColor" stroke-width="2"/></svg></button>
        <div class="faq-answer"><p>Yes! Our Instagram Reels downloader works perfectly on iPhone and iPad using Safari or any iOS browser. No app installation needed - just paste the link and download.</p></div>
    </div>
    <div class="faq-item">
        <button class="faq-question">Is it free to download Instagram Reels?<svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5" stroke="currentColor" stroke-width="2"/></svg></button>
        <div class="faq-answer"><p>Absolutely free! Download unlimited Instagram Reels videos without any charges, registration, or subscription. 100% free forever.</p></div>
    </div>
</section>

<div style="background: #F2F4F6; padding: 30px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h3 style="margin-bottom: 15px; color: #171A26;">More Instagram Downloaders</h3>
    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
        <a href="/download-instagram.php" style="color: #1C8576; text-decoration: none; font-weight: 600;">Instagram Downloader</a>
        <a href="/instagram-story-downloader" style="color: #1C8576; text-decoration: none; font-weight: 600;">Story Downloader</a>
        <a href="/instagram-video-downloader" style="color: #1C8576; text-decoration: none; font-weight: 600;">Video Downloader</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/app.js"></script>
