<?php
require_once __DIR__ . '/platform-config.php';

// Get current language from URL path (subdirectory structure)
// Examples: /vi/download-tiktok.php -> 'vi', /zh/ -> 'zh', / -> 'en'
function getCurrentLanguage() {
    // First check query parameter (for backward compatibility and .htaccess rewrite)
    if (isset($_GET['lang']) && in_array($_GET['lang'], getSupportedLanguages())) {
        return $_GET['lang'];
    }
    
    // Parse from REQUEST_URI path
    $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
    $parsedUrl = parse_url($requestUri);
    $path = $parsedUrl['path'] ?? '/';
    
    // Extract language from path: /{lang}/...
    if (preg_match('#^/([a-z]{2})(/|$)#', $path, $matches)) {
        $lang = $matches[1];
        if (in_array($lang, getSupportedLanguages())) {
            return $lang;
        }
    }
    
    // Default to English
    return 'en';
}

// Load common translations (shared across all platforms)
function loadCommonTranslations($lang) {
    $translationFile = __DIR__ . "/translations_common/{$lang}/common.php";
    if (!file_exists($translationFile)) {
        error_log("Missing common translation file: {$translationFile}");
        return [];
    }
    
    $result = include $translationFile;
    if (!is_array($result)) {
        error_log("Translation file did not return array: {$translationFile}");
        return [];
    }
    
    return $result;
}

// Load platform-specific translations
function loadPlatformTranslations($platform, $lang) {
    if (empty($platform)) {
        return [];
    }
    
    $translationFile = __DIR__ . "/translations_{$platform}/{$lang}/common.php";
    if (!file_exists($translationFile)) {
        error_log("Missing platform translation file: {$translationFile}");
        return [];
    }
    
    $result = include $translationFile;
    if (!is_array($result)) {
        error_log("Platform translation file did not return array: {$translationFile}");
        return [];
    }
    
    return $result;
}

// Get platform translation (merges common + platform-specific)
// Pass $platform explicitly to avoid relying on mutable global state
// No caching to avoid persistence issues in PHP built-in server
function pt($key, $lang = null, $platformOverride = null) {
    if ($lang === null) {
        $lang = getCurrentLanguage();
    }

    // Use explicit platform parameter or fall back to global
    if ($platformOverride !== null) {
        $currentPlatform = $platformOverride;
    } else {
        global $platform;
        $currentPlatform = isset($platform) ? $platform : '';
    }
    
    // Load common translations first (base)
    $commonTranslations = loadCommonTranslations($lang);
    
    // Load platform-specific translations
    $platformTranslations = loadPlatformTranslations($currentPlatform, $lang);
    
    // Merge: platform-specific overrides common
    $translations = array_merge($commonTranslations, $platformTranslations);

    if (isset($translations[$key])) {
        return $translations[$key];
    }

    // Fallback to English if translation not found
    if ($lang !== 'en') {
        $commonEN = loadCommonTranslations('en');
        $platformEN = loadPlatformTranslations($currentPlatform, 'en');
        $translationsEN = array_merge($commonEN, $platformEN);
        
        if (isset($translationsEN[$key])) {
            return $translationsEN[$key];
        }
    }

    // Final fallback: return the key itself
    return $key;
}

// Alias t() to pt() for backward compatibility
function t($key, $lang = null, $platformOverride = null) {
    return pt($key, $lang, $platformOverride);
}

// Get current language code
$currentLang = getCurrentLanguage();

// Get list of supported languages
function getSupportedLanguages() {
    return ['ar', 'de', 'en', 'es', 'fr', 'id', 'ja', 'ko', 'th', 'vi', 'zh'];
}

// Get language metadata (label, flag, code)
function getLanguageMetadata() {
    return [
        'en' => ['label' => 'English', 'flag' => '🇬🇧', 'code' => 'EN'],
        'vi' => ['label' => 'Tiếng Việt', 'flag' => '🇻🇳', 'code' => 'VI'],
        'zh' => ['label' => '中文', 'flag' => '🇨🇳', 'code' => 'ZH'],
        'ko' => ['label' => '한국어', 'flag' => '🇰🇷', 'code' => 'KO'],
        'ja' => ['label' => '日本語', 'flag' => '🇯🇵', 'code' => 'JA'],
        'es' => ['label' => 'Español', 'flag' => '🇪🇸', 'code' => 'ES'],
        'fr' => ['label' => 'Français', 'flag' => '🇫🇷', 'code' => 'FR'],
        'de' => ['label' => 'Deutsch', 'flag' => '🇩🇪', 'code' => 'DE'],
        'ar' => ['label' => 'العربية', 'flag' => '🇸🇦', 'code' => 'AR'],
        'th' => ['label' => 'ไทย', 'flag' => '🇹🇭', 'code' => 'TH'],
        'id' => ['label' => 'Bahasa Indonesia', 'flag' => '🇮🇩', 'code' => 'ID']
    ];
}

// Generate hreflang links for current page
function generateHreflangLinks() {
    $languages = getSupportedLanguages();
    $baseUrl = getBaseUrl();
    
    // Use REQUEST_URI to preserve .php extension and match canonical URLs
    $requestUri = $_SERVER['REQUEST_URI'];
    $parsedUrl = parse_url($requestUri);
    $path = $parsedUrl['path'] ?? '/';
    
    // Remove language prefix from path if present
    $cleanPath = preg_replace('#^/([a-z]{2})(/|$)#', '/', $path);
    if ($cleanPath === '/') {
        $cleanPath = '/index.php';
    }
    
    // Parse existing query parameters (excluding lang)
    $queryParams = [];
    if (isset($parsedUrl['query'])) {
        parse_str($parsedUrl['query'], $queryParams);
    }
    unset($queryParams['lang']);
    
    $hreflangLinks = [];
    
    // Generate hreflang for each language
    foreach ($languages as $lang) {
        $queryString = $queryParams ? '?' . http_build_query($queryParams) : '';
        
        // English uses bare path without lang prefix
        if ($lang === 'en') {
            $url = $baseUrl . $cleanPath . $queryString;
        } else {
            // Other languages use /{lang}/ prefix
            $url = $baseUrl . '/' . $lang . $cleanPath . $queryString;
        }
        
        $hreflangLinks[] = [
            'lang' => $lang,
            'url' => $url
        ];
    }
    
    // Add x-default pointing to English version
    $queryString = $queryParams ? '?' . http_build_query($queryParams) : '';
    $hreflangLinks[] = [
        'lang' => 'x-default',
        'url' => $baseUrl . $cleanPath . $queryString
    ];
    
    return $hreflangLinks;
}

?>
