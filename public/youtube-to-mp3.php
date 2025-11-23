<?php
require_once 'includes/platform-config.php';
require_once 'includes/languages.php';

$platform = 'youtube';
$config = getPlatformConfig($platform);

$pageTitle = "YouTube to MP3 Converter - Download YouTube Music Free 2025";
$metaDescription = "Convert YouTube to MP3 in 320kbps high quality. Free YouTube to MP3 converter. Download YouTube audio, music, songs. Works on iPhone, Android, PC. Fast & unlimited!";
$metaKeywords = "youtube to mp3, youtube mp3 converter, youtube to mp3 converter, convert youtube to mp3, youtube mp3 download, yt to mp3, youtube music downloader, youtube audio downloader, youtube to mp3 320kbps";
$canonicalUrl = getBaseUrl() . "/youtube-to-mp3.php";

$schemaMarkup = json_encode([
    "@context" => "https://schema.org",
    "@graph" => [
        ["@type" => "HowTo", "name" => "Convert YouTube to MP3", "step" => [
            ["@type" => "HowToStep", "text" => "Copy YouTube video URL"],
            ["@type" => "HowToStep", "text" => "Paste link and select MP3 quality"],
            ["@type" => "HowToStep", "text" => "Download MP3 audio file"]
        ]],
        ["@type" => "FAQPage", "mainEntity" => [
            ["@type" => "Question", "name" => "How to convert YouTube to MP3?", 
             "acceptedAnswer" => ["@type" => "Answer", "text" => "Copy the YouTube video URL, paste it into our converter, select MP3 quality (128kbps, 192kbps, or 320kbps), and click Download. The MP3 file will be saved to your device in seconds."]]
        ]]
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

include 'includes/header.php';
?>

<div class="platform-header">
    <h1 class="title">YouTube to <span class="highlight">MP3 Converter</span></h1>
    <p class="subtitle">Convert YouTube videos to MP3 audio - Download YouTube music in 320kbps quality</p>
</div>

<div class="search-box">
    <input type="text" id="videoUrl" class="search-input" placeholder="Paste YouTube video link to convert to MP3..." autocomplete="off" data-platform="<?php echo $platform; ?>">
    <button id="parseBtn" class="btn-start">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z" fill="currentColor"/></svg>
        Convert to MP3
    </button>
</div>

<div id="loading" class="loading" style="display: none;"><p>Converting YouTube to MP3...</p></div>
<div id="videoResult" class="video-result" style="display: none;"></div>

<section style="background: linear-gradient(135deg, #1C8576 0%, #15685E 100%); color: white; padding: 40px 30px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h2 style="font-size: 28px; margin-bottom: 15px;">🎵 Best YouTube to MP3 Converter 2025</h2>
    <p style="font-size: 16px; opacity: 0.95;">Convert YouTube videos to high-quality MP3 audio files. Download YouTube music, songs, podcasts in 320kbps. 100% free, fast, and unlimited conversions!</p>
</section>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin: 40px 0;">
    <div style="background: #F2F4F6; padding: 25px; border-radius: 0.5rem; text-align: center; border-left: 4px solid #1C8576;">
        <div style="font-size: 32px; margin-bottom: 10px;">320kbps</div>
        <h3 style="color: #171A26; margin-bottom: 8px;">Maximum Quality</h3>
        <p style="color: #171A26; opacity: 0.7; font-size: 14px;">Highest MP3 quality<br>Best audio experience</p>
    </div>
    <div style="background: #F2F4F6; padding: 25px; border-radius: 0.5rem; text-align: center; border-left: 4px solid #1C8576;">
        <div style="font-size: 32px; margin-bottom: 10px;">192kbps</div>
        <h3 style="color: #171A26; margin-bottom: 8px;">High Quality</h3>
        <p style="color: #171A26; opacity: 0.7; font-size: 14px;">Great audio quality<br>Smaller file size</p>
    </div>
    <div style="background: #F2F4F6; padding: 25px; border-radius: 0.5rem; text-align: center; border-left: 4px solid #1C8576;">
        <div style="font-size: 32px; margin-bottom: 10px;">128kbps</div>
        <h3 style="color: #171A26; margin-bottom: 8px;">Standard Quality</h3>
        <p style="color: #171A26; opacity: 0.7; font-size: 14px;">Good quality<br>Fastest download</p>
    </div>
</div>

<section class="platform-features">
    <div class="feature-card">
        <h3>🎧 320kbps Quality</h3>
        <p>Convert YouTube to MP3 in maximum 320kbps quality for the best listening experience.</p>
    </div>
    <div class="feature-card">
        <h3>⚡ Lightning Fast</h3>
        <p>Convert YouTube videos to MP3 in seconds. No waiting, instant downloads.</p>
    </div>
    <div class="feature-card">
        <h3>📱 All Devices</h3>
        <p>Works on iPhone, Android, PC, Mac, iPad. Convert anywhere, anytime.</p>
    </div>
    <div class="feature-card">
        <h3>🆓 100% Free</h3>
        <p>Unlimited YouTube to MP3 conversions. No registration, no fees.</p>
    </div>
    <div class="feature-card">
        <h3>🎵 Music & Podcasts</h3>
        <p>Download YouTube music, songs, albums, podcasts as MP3 audio files.</p>
    </div>
    <div class="feature-card">
        <h3>🔒 Safe & Secure</h3>
        <p>SSL encrypted, no data storage. Your downloads are completely private.</p>
    </div>
</section>

<div class="instructions">
    <h2 style="text-align: center; margin-bottom: 30px;">How to Convert YouTube to MP3</h2>
    <div class="instruction-item">
        <div class="instruction-number step-1">1</div>
        <div class="instruction-text"><strong>Copy YouTube URL</strong><br>Open YouTube, find your video/song, click Share and copy the link</div>
    </div>
    <div class="instruction-item">
        <div class="instruction-number step-2">2</div>
        <div class="instruction-text"><strong>Paste & Select Quality</strong><br>Paste the YouTube link above and choose MP3 quality (128kbps, 192kbps, or 320kbps)</div>
    </div>
    <div class="instruction-item">
        <div class="instruction-number step-3">3</div>
        <div class="instruction-text"><strong>Download MP3</strong><br>Click "Convert to MP3" and save the audio file to your device - enjoy offline!</div>
    </div>
</div>

<section class="faq-section">
    <h2 class="faq-title">YouTube to MP3 FAQ</h2>
    <div class="faq-item">
        <button class="faq-question">How to convert YouTube to MP3?<svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5" stroke="currentColor" stroke-width="2"/></svg></button>
        <div class="faq-answer"><p>Copy the YouTube video URL, paste it into our converter above, select your desired MP3 quality (128kbps, 192kbps, or 320kbps), and click "Convert to MP3". The audio file will be downloaded to your device in seconds.</p></div>
    </div>
    <div class="faq-item">
        <button class="faq-question">What's the best quality for YouTube to MP3?<svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5" stroke="currentColor" stroke-width="2"/></svg></button>
        <div class="faq-answer"><p>320kbps is the highest MP3 quality available and provides the best audio experience. For most users, 192kbps offers an excellent balance between quality and file size. 128kbps is good for podcasts or when storage space is limited.</p></div>
    </div>
    <div class="faq-item">
        <button class="faq-question">Can I convert YouTube to MP3 on iPhone?<svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5" stroke="currentColor" stroke-width="2"/></svg></button>
        <div class="faq-answer"><p>Yes! Our YouTube to MP3 converter works perfectly on iPhone and iPad using Safari or any iOS browser. No app installation required - just paste the link, convert, and download.</p></div>
    </div>
    <div class="faq-item">
        <button class="faq-question">Is YouTube to MP3 converter free?<svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5" stroke="currentColor" stroke-width="2"/></svg></button>
        <div class="faq-answer"><p>Completely free! Convert unlimited YouTube videos to MP3 without any charges, registration, or subscription. 100% free forever with no hidden costs.</p></div>
    </div>
</section>

<div style="background: #F2F4F6; padding: 30px; border-radius: 0.5rem; margin: 40px 0; text-align: center;">
    <h3 style="margin-bottom: 15px; color: #171A26;">More YouTube Tools</h3>
    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
        <a href="/download-youtube.php" style="color: #1C8576; text-decoration: none; font-weight: 600;">YouTube Downloader</a>
        <a href="/youtube-shorts-downloader" style="color: #1C8576; text-decoration: none; font-weight: 600;">Shorts Downloader</a>
        <a href="/youtube-hd-downloader" style="color: #1C8576; text-decoration: none; font-weight: 600;">YouTube HD</a>
        <a href="/youtube-playlist-downloader" style="color: #1C8576; text-decoration: none; font-weight: 600;">Playlist Downloader</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/app.js"></script>
