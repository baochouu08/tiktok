<?php
require_once 'includes/platform-config.php';
require_once 'includes/languages.php';

$platform = 'instagram';
$config = getPlatformConfig($platform);

$pageTitle = "Instagram Story Downloader - Save Stories Anonymously 2025";
$metaDescription = "Download Instagram Stories anonymously. Save Instagram Stories photos & videos without them knowing. Free story saver - works on iPhone, Android. No login required!";
$metaKeywords = "instagram story downloader, download instagram stories, story saver instagram, save instagram stories, ig story downloader, instagram story saver anonymous, download stories without login";
$canonicalUrl = getBaseUrl() . "/instagram-story-downloader.php";

$schemaMarkup = json_encode([
    "@context" => "https://schema.org",
    "@type" => "WebApplication",
    "name" => "Instagram Story Downloader",
    "description" => $metaDescription,
    "applicationCategory" => "MultimediaApplication",
    "offers" => ["@type" => "Offer", "price" => "0"]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

include 'includes/header.php';
?>

<div class="platform-header">
    <h1 class="title">Instagram <span class="highlight">Story Downloader</span></h1>
    <p class="subtitle">Download Instagram Stories anonymously - Save stories photos & videos without them knowing</p>
</div>

<div class="search-box">
    <input type="text" id="videoUrl" class="search-input" placeholder="Paste Instagram Story link or username..." autocomplete="off" data-platform="<?php echo $platform; ?>">
    <button id="parseBtn" class="btn-start">📥 Download Stories</button>
</div>

<div id="loading" class="loading" style="display: none;"></div>
<div id="videoResult" class="video-result" style="display: none;"></div>

<section style="background: linear-gradient(135deg, #1C8576 0%, #15685E 100%); color: white; padding: 35px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h2 style="margin-bottom: 15px;">👻 100% Anonymous Story Viewing</h2>
    <p>View and download Instagram Stories without them knowing. No login required. Your visit stays completely private and anonymous!</p>
</section>

<section class="platform-features">
    <div class="feature-card"><h3>🔒 Anonymous</h3><p>Download Stories without the user knowing. Completely private viewing.</p></div>
    <div class="feature-card"><h3>📸 Photos & Videos</h3><p>Save both Story photos and videos in original quality.</p></div>
    <div class="feature-card"><h3>🚫 No Login</h3><p>No Instagram login required. Download Stories without signing in.</p></div>
    <div class="feature-card"><h3>⏰ 24-Hour Access</h3><p>Save Stories before they disappear after 24 hours.</p></div>
</section>

<div class="instructions">
    <h2 style="text-align: center; margin-bottom: 30px;">Download Instagram Stories Anonymously</h2>
    <div class="instruction-item">
        <div class="instruction-number step-1">1</div>
        <div class="instruction-text"><strong>Get Story Link or Username</strong><br>Copy the Instagram Story link or enter the username</div>
    </div>
    <div class="instruction-item">
        <div class="instruction-number step-2">2</div>
        <div class="instruction-text"><strong>Paste Here</strong><br>Paste the link or username in the box above</div>
    </div>
    <div class="instruction-item">
        <div class="instruction-number step-3">3</div>
        <div class="instruction-text"><strong>Download Anonymously</strong><br>Click Download - save Stories without them knowing!</div>
    </div>
</div>

<div style="background: #F2F4F6; padding: 30px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h3 style="margin-bottom: 15px; color: #171A26;">More Instagram Tools</h3>
    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
        <a href="/instagram-reels-downloader" style="color: #1C8576; text-decoration: none; font-weight: 600;">Reels Downloader</a>
        <a href="/instagram-video-downloader" style="color: #1C8576; text-decoration: none; font-weight: 600;">Video Downloader</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/app.js"></script>
