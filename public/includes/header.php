<?php
require_once __DIR__ . '/languages.php';
$currentLang = getCurrentLanguage();

// Helper function to create URL with current language
function getUrlWithLang($path) {
    $lang = getCurrentLanguage();
    // Remove .php extension if present
    $path = preg_replace('/\.php$/', '', $path);
    if ($lang === 'en') {
        return $path;
    }
    // Remove leading slash from path if present to avoid double slash
    $path = ltrim($path, '/');
    return '/' . $lang . '/' . $path;
}
?>
<!DOCTYPE html>
<html lang="<?php echo $currentLang; ?>" data-supported-languages='<?php echo json_encode(getSupportedLanguages()); ?>'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="author" content="GreenVideo">
    <?php if(isset($pageTitle)): ?>
    <title><?php echo $pageTitle; ?></title>
    <?php endif; ?>

    <?php if(isset($metaDescription)): ?>
    <meta name="description" content="<?php echo $metaDescription; ?>">
    <?php endif; ?>

    <?php if(isset($metaKeywords)): ?>
    <meta name="keywords" content="<?php echo $metaKeywords; ?>">
    <?php endif; ?>

    <?php if(isset($canonicalUrl)): ?>
    <link rel="canonical" href="<?php echo $canonicalUrl; ?>">
    <?php endif; ?>

    <!-- Hreflang Tags for Multilingual SEO -->
    <?php 
    $hreflangLinks = generateHreflangLinks();
    foreach ($hreflangLinks as $link): 
    ?>
    <link rel="alternate" hreflang="<?php echo $link['lang']; ?>" href="<?php echo htmlspecialchars($link['url']); ?>" />
    <?php endforeach; ?>

    <!-- Open Graph -->
    <?php if(isset($pageTitle)): ?>
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <?php endif; ?>
    <?php if(isset($metaDescription)): ?>
    <meta property="og:description" content="<?php echo htmlspecialchars($metaDescription); ?>">
    <?php endif; ?>
    <meta property="og:image" content="<?php echo getBaseUrl(); ?>/assets/images/og-image.svg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <?php if(isset($canonicalUrl)): ?>
    <meta property="og:url" content="<?php echo $canonicalUrl; ?>">
    <?php endif; ?>
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="GreenVideo">
    <meta property="og:locale" content="<?php echo str_replace('-', '_', $currentLang); ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <?php if(isset($pageTitle)): ?>
    <meta name="twitter:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <?php endif; ?>
    <?php if(isset($metaDescription)): ?>
    <meta name="twitter:description" content="<?php echo htmlspecialchars($metaDescription); ?>">
    <?php endif; ?>
    <meta name="twitter:image" content="<?php echo getBaseUrl(); ?>/assets/images/og-image.svg">
    <meta name="twitter:site" content="@greenvideo">
    <meta name="twitter:creator" content="@greenvideo">

    <!-- Additional SEO -->
    <meta name="theme-color" content="#1C8576">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/apple-touch-icon.png">

    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- DNS Prefetch for APIs and CDNs -->
    <link rel="dns-prefetch" href="https://api.tikwm.com">
    <link rel="dns-prefetch" href="https://tiktokcdn.com">
    <link rel="dns-prefetch" href="https://cdninstagram.com">

    <!-- Performance & SEO -->
    <meta name="google-site-verification" content="your-google-verification-code">
    <link rel="manifest" href="/manifest.json">
    <meta name="mobile-web-app-capable" content="yes">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Preload critical resources -->
    <link rel="preload" href="/assets/css/style.min.css?v=1" as="style">

    <!-- Google Fonts with font-display swap -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet"></noscript>

    <link rel="stylesheet" href="/assets/css/style.min.css?v=1">
    <link rel="icon" type="image/svg+xml" href="/assets/images/og-image.svg">

    <!-- WebP Support Detection -->
    <script>
    document.documentElement.className += (function(){var e=new Image;e.src="data:image/webp;base64,UklGRiQAAABXRUJQVlA4IBgAAAAwAQCdASoBAAEAAwA0JaQAA3AA/vuUAAA=";return e.complete?e.height===1?" webp":" no-webp":""})();
    </script>

    <?php if(isset($schemaMarkup)): ?>
    <script type="application/ld+json">
    <?php echo $schemaMarkup; ?>
    </script>
    <?php endif; ?>

    <!-- Organization Schema (Global) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "GreenVideo",
        "url": "<?php echo getBaseUrl(); ?>",
        "logo": "<?php echo getBaseUrl(); ?>/assets/images/og-image.svg",
        "sameAs": [
            "https://www.facebook.com/greenvideo",
            "https://twitter.com/greenvideo"
        ],
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "Customer Support",
            "availableLanguage": ["en", "vi", "zh", "ja", "ko", "es"]
        }
    }
    </script>

    <!-- WebSite Schema với SearchAction -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "GreenVideo",
        "url": "<?php echo getBaseUrl(); ?>",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "<?php echo getBaseUrl(); ?>/?s={search_term_string}",
            "query-input": "required name=search_term_string"
        }
    }
    </script>
</head>
<style>
    .menu-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
    }
    .faq-question:hover {
        background: #1c8576;
        color: white;
    }


    .feature-card {
        background: #F2F4F6;
        padding: 20px;
        border-radius: 0.5rem;
        border-left: 4px solid #1C8576;
    }
</style>

<body>
    <div class="container">
        <header>
            <div class="logo">
                <a href="<?php echo getUrlWithLang('/'); ?>" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
                    <svg width="24" height="24" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                      <!-- hàng 1 -->
                      <rect width="6" height="6" x="0" y="0" fill="#1C8576"/>
                      <rect width="6" height="6" x="6" y="0" fill="white"/>
                      <rect width="6" height="6" x="12" y="0" fill="#1C8576"/>
                      <!-- hàng 2 -->
                      <rect width="6" height="6" x="0" y="6" fill="white"/>
                      <rect width="6" height="6" x="6" y="6" fill="#1C8576"/>
                      <rect width="6" height="6" x="12" y="6" fill="white"/>
                      <!-- hàng 3 -->
                      <rect width="6" height="6" x="0" y="12" fill="#1C8576"/>
                      <rect width="6" height="6" x="6" y="12" fill="white"/>
                      <rect width="6" height="6" x="12" y="12" fill="#1C8576"/>
                    </svg>

                    <span class="logo-text">Green</span>
                </a>
            </div>
            <div class="header-actions">
                <button class="lang-btn" id="langBtn" title="Change Language" aria-label="Change Language">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12.87 15.07l-2.54-2.51.03-.03c1.74-1.94 2.98-4.17 3.71-6.53H17V4h-7V2H8v2H1v1.99h11.17C11.5 7.92 10.44 9.75 9 11.35 8.07 10.32 7.3 9.19 6.69 8h-2c.73 1.63 1.73 3.17 2.98 4.56l-5.09 5.02L4 19l5-5 3.11 3.11.76-2.04zM18.5 10h-2L12 22h2l1.12-3h4.75L21 22h2l-4.5-12zm-2.62 7l1.62-4.33L19.12 17h-3.24z" fill="currentColor"/>
                    </svg>
                    <span class="lang-current" id="currentLang"><?php 
                        $metadata = getLanguageMetadata();
                        echo $metadata[$currentLang]['code'] ?? strtoupper($currentLang);
                    ?></span>
                </button>
                <button class="menu-btn" id="menuBtn" aria-label="Open Menu" aria-expanded="false">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" fill="currentColor"/>
                    </svg>
                </button>
            </div>

            <!-- Language Dropdown -->
            <div class="lang-dropdown" id="langDropdown">
                <div class="lang-dropdown-content">
                    <?php 
                    $supportedLanguages = getSupportedLanguages();
                    $languageMetadata = getLanguageMetadata();
                    foreach ($supportedLanguages as $lang):
                        $metadata = $languageMetadata[$lang] ?? ['label' => strtoupper($lang), 'flag' => '', 'code' => strtoupper($lang)];
                    ?>
                    <button class="lang-option" data-lang="<?php echo $lang; ?>">
                        <span class="flag"><?php echo $metadata['flag']; ?></span>
                        <span><?php echo $metadata['label']; ?></span>
                    </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </header>

        <nav class="mobile-menu" id="mobileMenu">
            <div class="menu-overlay" id="menuOverlay"></div>
            <div class="menu-content">
                <div class="menu-header">
                    <div class="logo">
                        <a href="<?php echo getUrlWithLang('/'); ?>" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
                            <svg width="24" height="24" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                              <!-- hàng 1 -->
                              <rect width="6" height="6" x="0" y="0" fill="#1C8576"/>
                              <rect width="6" height="6" x="6" y="0" fill="white"/>
                              <rect width="6" height="6" x="12" y="0" fill="#1C8576"/>
                              <!-- hàng 2 -->
                              <rect width="6" height="6" x="0" y="6" fill="white"/>
                              <rect width="6" height="6" x="6" y="6" fill="#1C8576"/>
                              <rect width="6" height="6" x="12" y="6" fill="white"/>
                              <!-- hàng 3 -->
                              <rect width="6" height="6" x="0" y="12" fill="#1C8576"/>
                              <rect width="6" height="6" x="6" y="12" fill="white"/>
                              <rect width="6" height="6" x="12" y="12" fill="#1C8576"/>
                            </svg>

                            <span class="logo-text">Green Video</span>
                        </a>
                    </div>
                    <button class="menu-close" id="menuClose" aria-label="Close Menu">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" fill="currentColor"/>
                        </svg>
                    </button>
                </div>
                <ul class="menu-list">
                    <li><a href="<?php echo getUrlWithLang('/'); ?>">Home</a></li>
                    <li><a href="<?php echo getUrlWithLang('/download-tiktok.php'); ?>"><img src="/assets/images/platforms/tiktok.svg" class="menu-icon" alt="TikTok" loading="lazy" width="20" height="20"> TikTok</a></li>
                    <li><a href="<?php echo getUrlWithLang('/download-instagram.php'); ?>"><img src="/assets/images/platforms/instagram.svg" class="menu-icon" alt="Instagram" loading="lazy" width="20" height="20"> Instagram</a></li>
                    <li><a href="<?php echo getUrlWithLang('/download-youtube.php'); ?>"><img src="/assets/images/platforms/youtube.svg" class="menu-icon" alt="YouTube" loading="lazy" width="20" height="20"> YouTube</a></li>
                    <li><a href="<?php echo getUrlWithLang('/download-twitter.php'); ?>"><img src="/assets/images/platforms/twitter.svg" class="menu-icon" alt="Twitter" loading="lazy" width="20" height="20"> Twitter/X</a></li>
                    <li><a href="<?php echo getUrlWithLang('/download-facebook.php'); ?>"><img src="/assets/images/platforms/facebook.svg" class="menu-icon" alt="Facebook" loading="lazy" width="20" height="20"> Facebook</a></li>
                    <li><a href="<?php echo getUrlWithLang('/download-douyin.php'); ?>"><img src="/assets/images/platforms/douyin.svg" class="menu-icon" alt="Douyin" loading="lazy" width="20" height="20"> Douyin</a></li>
                    <li><a href="<?php echo getUrlWithLang('/download-bilibili.php'); ?>"><img src="/assets/images/platforms/bilibili.svg" class="menu-icon" alt="Bilibili" loading="lazy" width="20" height="20"> Bilibili</a></li>
                    <li><a href="<?php echo getUrlWithLang('/download-rednote.php'); ?>"><img src="/assets/images/platforms/rednote.svg" class="menu-icon" alt="Rednote"> Rednote</a></li>
                    <li><a href="<?php echo getUrlWithLang('/download-weverse.php'); ?>"><img src="/assets/images/platforms/weverse.png" class="menu-icon" alt="Weverse" loading="lazy" width="20" height="20"> Weverse</a></li>
                </ul>
            </div>
        </nav>

        <main>
    <!-- Service Worker for Offline Support -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/service-worker.js', { scope: '/' })
                    .then(reg => console.log('✅ SW registered'))
                    .catch(err => console.log('SW error:', err));
            });
        }
    </script>
</main>
</body>
</html>