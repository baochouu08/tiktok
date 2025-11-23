<?php
require_once 'includes/platform-config.php';
require_once 'includes/languages.php';

$platform = 'tiktok';
$config = getPlatformConfig($platform);

$pageTitle = "TikTok to MP3 Converter - Download TikTok Audio & Music Free 2025";
$metaDescription = "Convert TikTok videos to MP3 audio files. Download TikTok sounds, music, and audio in high quality 320kbps. Free MP3 converter - works on iPhone, Android, PC. No app needed.";
$metaKeywords = "tiktok to mp3, tiktok mp3 converter, download tiktok audio, tiktok sound download, tiktok music downloader, convert tiktok to mp3, tiktok audio extractor, tiktok to mp3 320kbps";
$canonicalUrl = getBaseUrl() . "/tiktok-to-mp3.php";

$schemaMarkup = json_encode([
    "@context" => "https://schema.org",
    "@graph" => [
        [
            "@type" => "HowTo",
            "name" => "How to Convert TikTok to MP3",
            "step" => [
                ["@type" => "HowToStep", "name" => "Copy TikTok link", "text" => "Copy the link of the TikTok video with audio you want"],
                ["@type" => "HowToStep", "name" => "Paste and convert", "text" => "Paste the link and click Download MP3"],
                ["@type" => "HowToStep", "name" => "Save audio file", "text" => "Download the MP3 audio file to your device"]
            ]
        ],
        [
            "@type" => "FAQPage",
            "mainEntity" => [
                [
                    "@type" => "Question",
                    "name" => "How do I convert TikTok videos to MP3?",
                    "acceptedAnswer" => ["@type" => "Answer", "text" => "Copy the TikTok video link, paste it into our converter, and click Download MP3. The audio will be extracted and saved as a high-quality MP3 file to your device."]
                ],
                [
                    "@type" => "Question",
                    "name" => "What audio quality can I get from TikTok to MP3?",
                    "acceptedAnswer" => ["@type" => "Answer", "text" => "Our converter supports up to 320kbps MP3 quality, which is the highest standard for MP3 audio. You can also choose 128kbps or 192kbps for smaller file sizes."]
                ]
            ]
        ]
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

include 'includes/header.php';
?>

<style>
.audio-features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin: 40px 0;
}
.audio-feature {
    background: #F2F4F6;
    padding: 25px 20px;
    border-radius: 0.5rem;
    text-align: center;
    border-left: 4px solid #1C8576;
}
.audio-feature h3 {
    font-size: 18px;
    color: #171A26;
    margin-bottom: 10px;
}
.audio-feature p {
    font-size: 14px;
    color: #171A26;
    opacity: 0.7;
}
</style>

<div class="platform-header">
    <h1 class="title">TikTok to <span class="highlight">MP3 Converter</span></h1>
    <p class="subtitle">Extract audio from TikTok videos - Download TikTok sounds & music in 320kbps MP3 quality</p>
</div>

<div class="search-box">
    <input 
        type="text" 
        id="videoUrl" 
        class="search-input" 
        placeholder="Paste TikTok video link to extract audio as MP3..."
        autocomplete="off"
        data-platform="<?php echo $platform; ?>"
    >
    <button id="parseBtn" class="btn-start">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
            <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z" fill="currentColor"/>
        </svg>
        Convert to MP3
    </button>
</div>

<div id="loading" class="loading" style="display: none;">
    <div class="spinner"></div>
    <p>Extracting audio and converting to MP3...</p>
</div>

<div id="videoResult" class="video-result" style="display: none;"></div>

<div class="feature-highlight">
    <h2>🎵 High-Quality TikTok Audio Extraction</h2>
    <p>Download your favorite TikTok sounds, music, and audio clips in crystal-clear MP3 format. Perfect for ringtones, music collections, or offline listening!</p>
</div>

<div class="audio-features">
    <div class="audio-feature">
        <h3>🎧 320kbps Quality</h3>
        <p>Maximum MP3 quality for the best audio experience</p>
    </div>
    <div class="audio-feature">
        <h3>⚡ Fast Conversion</h3>
        <p>Extract audio from TikTok in seconds</p>
    </div>
    <div class="audio-feature">
        <h3>📱 All Devices</h3>
        <p>Works on iPhone, Android, PC, and Mac</p>
    </div>
    <div class="audio-feature">
        <h3>🆓 100% Free</h3>
        <p>Unlimited MP3 conversions at no cost</p>
    </div>
</div>

<section style="background: white; padding: 30px; border-radius: 0.5rem; margin: 40px 0; border: 1px solid #DCE0E4;">
    <h2 style="text-align: center; margin-bottom: 25px; color: #171A26;">Why Convert TikTok to MP3?</h2>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
        <div>
            <h3 style="color: #1C8576; margin-bottom: 10px;">🎼 Save Trending Sounds</h3>
            <p style="color: #171A26; opacity: 0.8; line-height: 1.6;">Keep your favorite TikTok audio clips, songs, and sound effects for offline listening or future use in your own videos.</p>
        </div>
        <div>
            <h3 style="color: #1C8576; margin-bottom: 10px;">📱 Create Ringtones</h3>
            <p style="color: #171A26; opacity: 0.8; line-height: 1.6;">Turn viral TikTok sounds into custom ringtones or notification alerts for your phone.</p>
        </div>
        <div>
            <h3 style="color: #1C8576; margin-bottom: 10px;">🎙️ Content Creation</h3>
            <p style="color: #171A26; opacity: 0.8; line-height: 1.6;">Extract audio for your podcasts, videos, or music production projects.</p>
        </div>
        <div>
            <h3 style="color: #1C8576; margin-bottom: 10px;">💾 Build Music Library</h3>
            <p style="color: #171A26; opacity: 0.8; line-height: 1.6;">Collect TikTok music and sounds to build your personal offline audio collection.</p>
        </div>
    </div>
</section>

<div class="instructions">
    <h2 style="text-align: center; margin-bottom: 30px;">How to Convert TikTok to MP3</h2>
    
    <div class="instruction-item">
        <div class="instruction-number step-1">1</div>
        <div class="instruction-text">
            <strong>Find Your TikTok Audio</strong><br>
            Open TikTok app, find the video with audio you want, tap Share and copy the link
        </div>
    </div>
    
    <div class="instruction-item">
        <div class="instruction-number step-2">2</div>
        <div class="instruction-text">
            <strong>Paste & Convert</strong><br>
            Paste the TikTok link into the box above and click "Convert to MP3"
        </div>
    </div>
    
    <div class="instruction-item">
        <div class="instruction-number step-3">3</div>
        <div class="instruction-text">
            <strong>Download MP3 File</strong><br>
            Save the converted MP3 audio file to your device - ready to listen anywhere!
        </div>
    </div>
</div>

<section class="faq-section">
    <h2 class="faq-title">TikTok to MP3 FAQ</h2>
    
    <div class="faq-item">
        <button class="faq-question">
            How do I convert TikTok videos to MP3?
            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5" stroke="currentColor" stroke-width="2"/></svg>
        </button>
        <div class="faq-answer">
            <p>Copy the TikTok video link, paste it into our converter above, and click "Convert to MP3". The audio will be extracted and saved as a high-quality MP3 file to your device in seconds.</p>
        </div>
    </div>
    
    <div class="faq-item">
        <button class="faq-question">
            What audio quality can I get from TikTok to MP3?
            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5" stroke="currentColor" stroke-width="2"/></svg>
        </button>
        <div class="faq-answer">
            <p>Our converter supports up to 320kbps MP3 quality, which is the highest standard for MP3 audio. You can also choose 128kbps or 192kbps for smaller file sizes while maintaining great sound quality.</p>
        </div>
    </div>
    
    <div class="faq-item">
        <button class="faq-question">
            Can I download TikTok sounds on iPhone?
            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5" stroke="currentColor" stroke-width="2"/></svg>
        </button>
        <div class="faq-answer">
            <p>Yes! Our TikTok to MP3 converter works perfectly on iPhone and iPad using Safari or any iOS browser. No app installation needed - just paste, convert, and download.</p>
        </div>
    </div>
    
    <div class="faq-item">
        <button class="faq-question">
            Is TikTok to MP3 converter free?
            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5" stroke="currentColor" stroke-width="2"/></svg>
        </button>
        <div class="faq-answer">
            <p>Absolutely free! No subscription, no registration required. Convert unlimited TikTok videos to MP3 audio files without any charges or hidden fees.</p>
        </div>
    </div>
</section>

<div style="background: #F2F4F6; padding: 30px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h3 style="margin-bottom: 15px; color: #171A26;">More TikTok Tools</h3>
    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
        <a href="/download-tiktok.php" style="color: #1C8576; text-decoration: none; font-weight: 600;">TikTok Video Downloader</a>
        <a href="/tiktok-no-watermark.php" style="color: #1C8576; text-decoration: none; font-weight: 600;">TikTok No Watermark</a>
        <a href="/tiktok-hd-4k.php" style="color: #1C8576; text-decoration: none; font-weight: 600;">TikTok HD 4K</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script src="assets/js/app.js"></script>
