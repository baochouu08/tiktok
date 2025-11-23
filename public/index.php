<?php
require_once 'includes/platform-config.php';
require_once 'includes/languages.php';

$pageTitle = pt('page_meta_title');
$metaDescription = pt('page_meta_description');
$metaKeywords = pt('page_meta_keywords');
$canonicalUrl = getBaseUrl() . "/";

$webAppSchema = [
    "@context" => "https://schema.org",
    "@type" => "WebApplication",
    "name" => pt('schema_app_name'),
    "description" => $metaDescription,
    "url" => getBaseUrl(),
    "applicationCategory" => "MultimediaApplication",
    "operatingSystem" => "All",
    "offers" => [
        "@type" => "Offer",
        "price" => "0",
        "priceCurrency" => "USD"
    ],
    "featureList" => [
        pt('schema_feature_tiktok'),
        pt('schema_feature_instagram'),
        pt('schema_feature_youtube'),
        pt('schema_feature_facebook'),
        pt('schema_feature_twitter'),
        pt('schema_feature_bilibili'),
        pt('schema_feature_douyin'),
        pt('schema_feature_rednote'),
        pt('schema_feature_weverse'),
        pt('schema_feature_no_watermark'),
        pt('schema_feature_hd'),
        pt('schema_feature_audio')
    ]
];

$breadcrumbSchema = [
    "@context" => "https://schema.org",
    "@type" => "BreadcrumbList",
    "itemListElement" => [
        [
            "@type" => "ListItem",
            "position" => 1,
            "name" => pt('schema_breadcrumb_home'),
            "item" => getBaseUrl()
        ]
    ]
];

$organizationSchema = [
    "@context" => "https://schema.org",
    "@type" => "Organization",
    "name" => "GreenVideo",
    "url" => getBaseUrl(),
    "logo" => getBaseUrl() . "/assets/images/logo.png",
    "sameAs" => [
        "https://twitter.com/GreenVideo"
    ]
];

$faqPageSchema = [
    "@context" => "https://schema.org",
    "@type" => "FAQPage",
    "mainEntity" => [
        [
            "@type" => "Question",
            "name" => t('faq_is_free'),
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => t('faq_is_free_ans')
            ]
        ],
        [
            "@type" => "Question",
            "name" => t('faq_which_platforms'),
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => t('faq_which_platforms_ans')
            ]
        ],
        [
            "@type" => "Question",
            "name" => t('faq_need_software'),
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => t('faq_need_software_ans')
            ]
        ],
        [
            "@type" => "Question",
            "name" => t('faq_hd_quality'),
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => t('faq_hd_quality_ans')
            ]
        ],
        [
            "@type" => "Question",
            "name" => t('faq_use_phone'),
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => t('faq_use_phone_ans')
            ]
        ],
        [
            "@type" => "Question",
            "name" => t('faq_need_account'),
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => t('faq_need_account_ans')
            ]
        ]
    ]
];

$schemaMarkup = json_encode([
    "@context" => "https://schema.org",
    "@graph" => [
        $webAppSchema,
        $breadcrumbSchema,
        $organizationSchema,
        $faqPageSchema
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

include 'includes/header.php';
?>

<style>
.hero-section {
    text-align: center;
    padding: 40px 0;
}

.hero-title {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 15px;
    line-height: 1.3;
}

.hero-subtitle {
    font-size: 18px;
    color: #171A26;
    opacity: 0.7;
    margin-bottom: 40px;
}

.platform-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    margin: 0px 0;
}

.platform-card {
    background: linear-gradient(135deg, #F8F9FA 0%, #ffffff 100%);
    border: 2px solid #DCE0E4;
    border-radius: 0.5rem;
    padding: 30px 20px;
    text-align: center;
    transition: all 0.3s;
    cursor: pointer;
    text-decoration: none;
    display: block;
}

.platform-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(28, 133, 118, 0.15);
    border-color: #1C8576;
}

.platform-icon {
    margin-bottom: 15px;
}

.platform-icon img {
    width: 64px;
    height: 64px;
    object-fit: cover;
    border-radius: 12px;
}

.platform-name {
    font-size: 20px;
    font-weight: 600;
    color: #171A26;
    margin-bottom: 10px;
}

.platform-description {
    font-size: 14px;
    color: #171A26;
    opacity: 0.7;
    line-height: 1.6;
}

        .feature-icon-box {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #1C8576 0%, #15685E 100%);
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            text-align: center;
            justify-content: center;
            margin: 0 auto;
            margin-bottom: 20px;
            color: white;
        }
    
.features-section {
    margin: 60px 0;
    padding: 40px 0;
    
    border-radius: 0.5rem;
    padding: 0px 0px;
}

.features-title {
    font-size: 28px;
    font-weight: 600;
    text-align: center;
    margin-bottom: 40px;
    color: #333;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}

.feature-item {
    text-align: center;
    background: linear-gradient(135deg, #F8F9FA 0%, #ffffff 100%);
}

.feature-icon {
    font-size: 40px;
    margin-bottom: 15px;
}

.feature-title {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
}

.feature-desc {
    font-size: 14px;
    color: #666;
    line-height: 1.6;
}
                                                    .faq-question:hover {
                                                        background: #C8ECE8;
                                                        color: #171A26;
                                                    }


    .faq-answer p {
        padding-top: 20px !important;
        padding: 0 20px 18px 20px;
        color: #171A26;
        font-size: 15px;
        opacity: 0.7;
        text-align: justify;
        line-height: 1.6;
        margin: 0;
    }
@media (max-width: 600px) {
    .hero-title {
        font-size: 28px;
    }
    
    .platform-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }
    
    .platform-card {
        padding: 20px 15px;
    }
    
    .platform-name {
        font-size: 16px;
    }
    
    .platform-description {
        font-size: 12px;
    }
}
</style>

<div class="hero-section">
    <h1 class="hero-title">
        <span class="highlight">GreenVideo</span><br>
        <?php echo pt('hero_title'); ?>
    </h1>
    <p class="hero-subtitle"><?php echo pt('hero_subtitle'); ?></p>
</div>

<div class="platform-grid">
    <a href="<?php echo getUrlWithLang('/download-tiktok'); ?>" class="platform-card">
        <div class="platform-icon"><img src="/assets/images/platforms/tiktok.svg" alt="TikTok Video Downloader" loading="lazy" width="64" height="64"></div>
        <h2 class="platform-name">TikTok</h2>
        <p class="platform-description"><?php echo pt('tiktok_desc'); ?></p>
    </a>
    
    <a href="<?php echo getUrlWithLang('/download-instagram'); ?>" class="platform-card">
        <div class="platform-icon"><img src="/assets/images/platforms/instagram.svg" alt="Instagram Video Downloader" loading="lazy" width="64" height="64"></div>
        <h2 class="platform-name">Instagram</h2>
        <p class="platform-description"><?php echo pt('instagram_desc'); ?></p>
    </a>
    
    <a href="<?php echo getUrlWithLang('/download-youtube'); ?>" class="platform-card">
        <div class="platform-icon"><img src="/assets/images/platforms/youtube.svg" alt="YouTube Video Downloader" loading="lazy" width="64" height="64"></div>
        <h2 class="platform-name">YouTube</h2>
        <p class="platform-description"><?php echo pt('youtube_desc'); ?></p>
    </a>
    
    <a href="<?php echo getUrlWithLang('/download-twitter'); ?>" class="platform-card">
        <div class="platform-icon"><img src="/assets/images/platforms/twitter.svg" alt="Twitter Video Downloader" loading="lazy" width="64" height="64"></div>
        <h2 class="platform-name">Twitter / X</h2>
        <p class="platform-description"><?php echo pt('twitter_desc'); ?></p>
    </a>
    
    <a href="<?php echo getUrlWithLang('/download-facebook'); ?>" class="platform-card">
        <div class="platform-icon"><img src="/assets/images/platforms/facebook.svg" alt="Facebook Video Downloader" loading="lazy" width="64" height="64"></div>
        <h2 class="platform-name">Facebook</h2>
        <p class="platform-description"><?php echo pt('facebook_desc'); ?></p>
    </a>
    
    <a href="<?php echo getUrlWithLang('/download-douyin'); ?>" class="platform-card">
        <div class="platform-icon"><img src="/assets/images/platforms/douyin.svg" alt="Douyin Video Downloader" loading="lazy" width="64" height="64"></div>
        <h2 class="platform-name">Douyin</h2>
        <p class="platform-description"><?php echo pt('douyin_desc'); ?></p>
    </a>
    
    <a href="<?php echo getUrlWithLang('/download-bilibili'); ?>" class="platform-card">
        <div class="platform-icon"><img src="/assets/images/platforms/bilibili.svg" alt="Bilibili Video Downloader" loading="lazy" width="64" height="64"></div>
        <h2 class="platform-name">Bilibili</h2>
        <p class="platform-description"><?php echo pt('bilibili_desc'); ?></p>
    </a>
    
    <a href="<?php echo getUrlWithLang('/download-rednote'); ?>" class="platform-card">
        <div class="platform-icon"><img src="/assets/images/platforms/rednote.svg" alt="Rednote Video Downloader" loading="lazy" width="64" height="64"></div>
        <h2 class="platform-name">Rednote</h2>
        <p class="platform-description"><?php echo pt('rednote_desc'); ?></p>
    </a>
    
    <a href="<?php echo getUrlWithLang('/download-weverse'); ?>" class="platform-card">
        <div class="platform-icon"><img src="/assets/images/platforms/weverse.png" alt="Weverse Content Downloader" loading="lazy" width="64" height="64"></div>
        <h2 class="platform-name">Weverse</h2>
        <p class="platform-description"><?php echo pt('weverse_desc'); ?></p>
    </a>
</div>

<div class="features-section">
    <h2 class="features-title"><?php echo pt('why_choose'); ?></h2>
    <div class="features-grid">
        <div class="feature-item">
            <div class="feature-icon-box">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                </svg>
            </div>
            <h3 class="feature-title"><?php echo pt('super_fast'); ?></h3>
            <p class="feature-desc"><?php echo pt('super_fast_desc'); ?></p>
        </div>
        
        <div class="feature-item">
            <div class="feature-icon-box">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
            </div>
            <h3 class="feature-title"><?php echo pt('no_watermark'); ?></h3>
            <p class="feature-desc"><?php echo pt('no_watermark_desc'); ?></p>
        </div>
        
        <div class="feature-item">
            <div class="feature-icon-box">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 18V5l12-2v13M9 13c0 1.66-1.34 3-3 3s-3-1.34-3-3 1.34-3 3-3 3 1.34 3 3z"/>
                </svg>
            </div>
            <h3 class="feature-title"><?php echo pt('audio_extraction'); ?></h3>
            <p class="feature-desc"><?php echo pt('audio_extraction_desc'); ?></p>
        </div>
        
        <div class="feature-item">
            <div class="feature-icon-box">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M8 14s1.5 2 4 2 4-2 4-2M9 9h.01M15 9h.01"/>
                </svg>
            </div>
            <h3 class="feature-title"><?php echo pt('free_100'); ?></h3>
            <p class="feature-desc"><?php echo pt('free_100_desc'); ?></p>
        </div>
        
        <div class="feature-item">
            <div class="feature-icon-box">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
            </div>
            <h3 class="feature-title"><?php echo pt('secure_private'); ?></h3>
            <p class="feature-desc"><?php echo pt('secure_private_desc'); ?></p>
        </div>
        
        <div class="feature-item">
            <div class="feature-icon-box">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="5" y="2" width="14" height="20" rx="2" ry="2"/>
                    <line x1="12" y1="18" x2="12.01" y2="18"/>
                </svg>
            </div>
            <h3 class="feature-title"><?php echo pt('all_devices'); ?></h3>
            <p class="feature-desc"><?php echo pt('all_devices_desc'); ?></p>
        </div>
    </div>
</div>

<section class="faq-section" id="faq">
    <h2 class="faq-title">❓ <?php echo pt('faq_general'); ?></h2>
    
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
            <span><?php echo pt('faq_which_platforms'); ?></span>
            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M7 10l5 5 5-5z" fill="currentColor"/>
            </svg>
        </button>
        <div class="faq-answer">
            <p><?php echo pt('faq_which_platforms_ans'); ?></p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">
            <span><?php echo pt('faq_need_software'); ?></span>
            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M7 10l5 5 5-5z" fill="currentColor"/>
            </svg>
        </button>
        <div class="faq-answer">
            <p><?php echo pt('faq_need_software_ans'); ?></p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">
            <span><?php echo pt('faq_hd_quality'); ?></span>
            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M7 10l5 5 5-5z" fill="currentColor"/>
            </svg>
        </button>
        <div class="faq-answer">
            <p><?php echo pt('faq_hd_quality_ans'); ?></p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">
            <span><?php echo pt('faq_use_phone'); ?></span>
            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M7 10l5 5 5-5z" fill="currentColor"/>
            </svg>
        </button>
        <div class="faq-answer">
            <p><?php echo pt('faq_use_phone_ans'); ?></p>
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
</section>

<?php include 'includes/footer.php'; ?>
