
<?php
require_once 'includes/platform-config.php';
require_once 'includes/languages.php';

$platform = 'douyin';
$config = getPlatformConfig($platform);

$pageTitle = pt('page_title_' . $platform);
$metaDescription = $config['metaDescription'];
$metaKeywords = $config['metaKeywords'];
$canonicalUrl = getBaseUrl() . "/download-douyin.php";

$howToSchema = generateHowToSchema($platform, $config);
$faqSchema = generateFAQSchema($config);
$combinedSchema = json_encode([
    "@context" => "https://schema.org",
    "@graph" => [
        json_decode($howToSchema, true),
        json_decode($faqSchema, true)
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

$schemaMarkup = $combinedSchema;

include 'includes/header.php';
?>

<style>
.platform-badge {
    background: <?php echo $config['color']; ?>;
    color: white;
}
</style>

<div class="platform-header">
    <h1 class="title">
        <?php echo pt('h1_' . $platform); ?>
    </h1>
    <p class="subtitle"><?php echo pt('subtitle_' . $platform); ?></p>
</div>

<div class="search-box">
    <input 
        type="text" 
        id="videoUrl" 
        class="search-input" 
        placeholder="<?php echo pt('placeholder_' . $platform); ?>"
        autocomplete="off"
        data-platform="<?php echo $platform; ?>"
    >
    <button id="parseBtn" class="btn-start">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
            <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z" fill="currentColor"/>
        </svg><?php echo pt('download_button'); ?></button>
</div>

<div id="loading" class="loading" style="display: none;">
    <div class="spinner"></div>
    <p><?php echo pt('processing_video'); ?></p>
</div>

<div id="videoResult" class="video-result" style="display: none;">
    <div class="result-card">
        <img id="videoCover" class="video-cover" src="" alt="Video cover">
        <div class="video-info">
            <h3 id="videoTitle" class="video-title"></h3>
            <p id="videoAuthor" class="video-author"></p>
            <div class="video-stats">
                <span id="videoPlays" class="stat">👁️ 0</span>
                <span id="videoLikes" class="stat">❤️ 0</span>
                <span id="videoDuration" class="stat">⏱️ 0s</span>
            </div>
            <div class="download-buttons">
                <button id="downloadVideoBtn" class="btn-download btn-primary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z" fill="currentColor"/>
                    </svg>
                    <?php echo pt('download_video'); ?>
                </button>
                <button id="downloadMusicBtn" class="btn-download btn-secondary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z" fill="currentColor"/>
                    </svg>
                    <?php echo pt('download_audio'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="instructions" id="instructions">
    <h2 style="text-align: center; margin-bottom: 30px; font-size: 24px;"><?php echo sprintf(pt('how_to_download'), $config['name']); ?></h2>
    <div class="instruction-item">
        <div class="instruction-number step-1">1</div>
        <div class="instruction-text">
            <strong><?php echo pt('step_1_generic'); ?></strong>
        </div>
    </div>
    <div class="instruction-item">
        <div class="instruction-number step-2">2</div>
        <div class="instruction-text">
            <strong><?php echo pt('step_2_generic'); ?></strong>
        </div>
    </div>
    <div class="instruction-item">
        <div class="instruction-number step-3">3</div>
        <div class="instruction-text">
            <strong><?php echo pt('step_3_generic'); ?></strong>
        </div>
    </div>
</div>

<div class="platform-features">
    <div class="feature-card">
        <h3>✨ <?php echo pt('feature_no_watermark'); ?></h3>
        <p><?php echo pt('feature_no_watermark_desc'); ?></p>
    </div>
    <div class="feature-card">
        <h3>🎵 <?php echo pt('feature_audio_download'); ?></h3>
        <p><?php echo pt('feature_audio_download_desc'); ?></p>
    </div>
    <div class="feature-card">
        <h3>📱 <?php echo pt('feature_mobile_friendly'); ?></h3>
        <p><?php echo pt('feature_mobile_friendly_desc'); ?></p>
    </div>
    <div class="feature-card">
        <h3>🚀 <?php echo pt('feature_super_fast'); ?></h3>
        <p><?php echo pt('feature_super_fast_desc'); ?></p>
    </div>
</div>

<section class="seo-content">
    <h2><?php echo pt('seo_main_title'); ?></h2>
    
    <div class="seo-section">
        <h3><?php echo pt('seo_section_1_title'); ?></h3>
        <p><?php echo pt('seo_section_1_p1'); ?></p>
        <p><?php echo pt('seo_section_1_p2'); ?></p>
    </div>

    <div class="seo-section">
        <h3><?php echo pt('seo_section_2_title'); ?></h3>
        <p><?php echo pt('seo_section_2_p1'); ?></p>
        <p><?php echo pt('seo_section_2_p2'); ?></p>
    </div>

    <div class="seo-section">
        <h3><?php echo pt('seo_section_3_title'); ?></h3>
        <p><?php echo pt('seo_section_3_p1'); ?></p>
        <p><?php echo pt('seo_section_3_p2'); ?></p>
    </div>

    <div class="seo-section">
        <h3><?php echo pt('seo_section_4_title'); ?></h3>
        <p><?php echo pt('seo_section_4_p1'); ?></p>
        <p><?php echo pt('seo_section_4_p2'); ?></p>
    </div>

    <div class="seo-section">
        <h3><?php echo pt('seo_section_5_title'); ?></h3>
        <ul class="seo-list">
            <?php 
            $features = pt('seo_features_list');
            if (is_array($features)) {
                foreach ($features as $feature) {
                    $parts = explode(':', $feature, 2);
                    if (count($parts) === 2) {
                        echo '<li><strong>' . htmlspecialchars(trim($parts[0])) . ':</strong> ' . htmlspecialchars(trim($parts[1])) . '</li>';
                    } else {
                        echo '<li>' . htmlspecialchars($feature) . '</li>';
                    }
                }
            }
            ?>
        </ul>
    </div>

    <div class="seo-section">
        <h3><?php echo pt('seo_section_6_title'); ?></h3>
        <p><?php echo pt('seo_usecase_creators'); ?></p>
        <p><?php echo pt('seo_usecase_marketing'); ?></p>
        <p><?php echo pt('seo_usecase_education'); ?></p>
        <p><?php echo pt('seo_usecase_personal'); ?></p>
    </div>

    <div class="seo-section">
        <h3><?php echo pt('seo_section_7_title'); ?></h3>
        <p><?php echo pt('seo_tip_copyright'); ?></p>
        <p><?php echo pt('seo_tip_quality'); ?></p>
        <p><?php echo pt('seo_tip_offline'); ?></p>
        <p><?php echo pt('seo_tip_organize'); ?></p>
    </div>

    <div class="seo-section">
        <h3><?php echo pt('seo_related_platforms_title'); ?></h3>
        <p><?php echo pt('seo_related_platforms_intro'); ?></p>
    </div>
</section>

<section class="faq-section" id="faq">
    <h2 class="faq-title">❓ <?php echo sprintf(pt('faq_title'), $config['name']); ?></h2>
    
    <div class="faq-item">
        <button class="faq-question">
            <span><?php echo pt('faq_how_download'); ?></span>
            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M7 10l5 5 5-5z" fill="currentColor"/>
            </svg>
        </button>
        <div class="faq-answer">
            <p><?php echo pt('faq_how_download_ans'); ?></p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">
            <span><?php echo pt('faq_is_free'); ?></span>
            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M7 10l5 5 5-5z" fill="currentColor"/>
            </svg>
        </button>
        <div class="faq-answer">
            <p><?php echo pt('faq_is_free_ans'); ?></p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">
            <span><?php echo pt('faq_video_quality'); ?></span>
            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M7 10l5 5 5-5z" fill="currentColor"/>
            </svg>
        </button>
        <div class="faq-answer">
            <p><?php echo pt('faq_video_quality_ans'); ?></p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">
            <span><?php echo pt('faq_mobile_support'); ?></span>
            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M7 10l5 5 5-5z" fill="currentColor"/>
            </svg>
        </button>
        <div class="faq-answer">
            <p><?php echo pt('faq_mobile_support_ans'); ?></p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">
            <span><?php echo pt('faq_audio_mp3'); ?></span>
            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M7 10l5 5 5-5z" fill="currentColor"/>
            </svg>
        </button>
        <div class="faq-answer">
            <p><?php echo pt('faq_audio_mp3_ans'); ?></p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">
            <span><?php echo pt('faq_need_account'); ?></span>
            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M7 10l5 5 5-5z" fill="currentColor"/>
            </svg>
        </button>
        <div class="faq-answer">
            <p><?php echo pt('faq_need_account_ans'); ?></p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">
            <span><?php echo pt('faq_is_safe'); ?></span>
            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M7 10l5 5 5-5z" fill="currentColor"/>
            </svg>
        </button>
        <div class="faq-answer">
            <p><?php echo pt('faq_is_safe_ans'); ?></p>
        </div>
    </div>
    
    <div class="faq-item">
        <button class="faq-question">
            <span><?php echo pt('faq_private_videos'); ?></span>
            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M7 10l5 5 5-5z" fill="currentColor"/>
            </svg>
        </button>
        <div class="faq-answer">
            <p><?php echo pt('faq_private_videos_ans'); ?></p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">
            <span><?php echo pt('faq_video_formats'); ?></span>
            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M7 10l5 5 5-5z" fill="currentColor"/>
            </svg>
        </button>
        <div class="faq-answer">
            <p><?php echo pt('faq_video_formats_ans'); ?></p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">
            <span><?php echo pt('faq_storage_duration'); ?></span>
            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M7 10l5 5 5-5z" fill="currentColor"/>
            </svg>
        </button>
        <div class="faq-answer">
            <p><?php echo pt('faq_storage_duration_ans'); ?></p>
        </div>
    </div>
</section>

<script src="/assets/js/douyin-standalone.js?v=<?php echo time(); ?>"></script>

<style>
.seo-content {
    max-width: 900px;
    margin: 60px auto;
    padding: 0 20px;
}

.seo-content h2 {
    font-size: 28px;
    font-weight: 700;
    text-align: center;
    margin-bottom: 40px;
    color: #0f1419;
}

.seo-section {
    margin-bottom: 40px;
}

.seo-section h3 {
    font-size: 22px;
    font-weight: 600;
    color: #0f1419;
    margin-bottom: 16px;
}

.seo-section p {
    font-size: 16px;
    line-height: 1.8;
    color: #0f1419;
    opacity: 0.8;
    margin-bottom: 16px;
    text-align: justify;
}

.seo-list {
    list-style: none;
    padding: 0;
}

.seo-list li {
    font-size: 16px;
    line-height: 1.8;
    color: #0f1419;
    opacity: 0.8;
    margin-bottom: 12px;
    padding-left: 24px;
    position: relative;
}

.seo-list li:before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #b85c44;
    font-weight: bold;
}

@media (max-width: 768px) {
    .seo-content h2 {
        font-size: 24px;
    }
    
    .seo-section h3 {
        font-size: 20px;
    }
    
    .seo-section p, .seo-list li {
        font-size: 15px;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
