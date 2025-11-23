<?php
// Router for PHP built-in server to handle language-based URL rewriting
// This mimics Apache .htaccess behavior

$requestUri = $_SERVER['REQUEST_URI'];
$parsedUrl = parse_url($requestUri);
$path = $parsedUrl['path'] ?? '/';
$query = $parsedUrl['query'] ?? '';

// Get supported languages from single source of truth
require_once __DIR__ . '/public/includes/languages.php';
$supportedLanguages = getSupportedLanguages();
$languages = implode('|', $supportedLanguages);

// Parse query string into $_GET
if ($query) {
    parse_str($query, $_GET);
}

// Check if path starts with a supported language code
if (preg_match("#^/({$languages})(/.*)?$#", $path, $matches)) {
    $lang = $matches[1];
    $remainingPath = $matches[2] ?? '/';
    
    // Set language parameter
    $_GET['lang'] = $lang;
    
    // Remove leading slash from remaining path
    $remainingPath = ltrim($remainingPath, '/');
    
    // If empty, serve index.php
    if (empty($remainingPath)) {
        $_SERVER['SCRIPT_NAME'] = '/index.php';
        require __DIR__ . '/public/index.php';
        return true;
    }
    
    // Try to serve the file with .php extension
    $targetFile = __DIR__ . '/public/' . $remainingPath;
    
    // If path already has .php extension
    if (pathinfo($targetFile, PATHINFO_EXTENSION) === 'php' && file_exists($targetFile)) {
        $_SERVER['SCRIPT_NAME'] = '/' . $remainingPath;
        require $targetFile;
        return true;
    }
    
    // Try adding .php extension
    if (file_exists($targetFile . '.php')) {
        $_SERVER['SCRIPT_NAME'] = '/' . $remainingPath . '.php';
        require $targetFile . '.php';
        return true;
    }
    
    // If it's a directory, try index.php
    if (is_dir($targetFile) && file_exists($targetFile . '/index.php')) {
        $_SERVER['SCRIPT_NAME'] = '/' . $remainingPath . '/index.php';
        require $targetFile . '/index.php';
        return true;
    }
}

// Handle sitemap.xml specially (rewrite to sitemap.php)
if ($path === '/sitemap.xml') {
    $_SERVER['SCRIPT_NAME'] = '/sitemap.php';
    require __DIR__ . '/public/sitemap.php';
    return true;
}

// If no language route matched, serve the file normally from public directory
$filePath = __DIR__ . '/public' . $path;

// Serve static files directly
if (file_exists($filePath) && is_file($filePath)) {
    return false; // Let PHP built-in server handle it
}

// Serve PHP files from public directory
if (file_exists($filePath) && pathinfo($filePath, PATHINFO_EXTENSION) === 'php') {
    require $filePath;
    return true;
}

// Try adding .php extension for extensionless URLs
if (file_exists($filePath . '.php')) {
    require $filePath . '.php';
    return true;
}

// Default to index.php for directory requests
if (is_dir($filePath) && file_exists($filePath . '/index.php')) {
    require $filePath . '/index.php';
    return true;
}

// 404 - File not found
http_response_code(404);
echo "404 - Not Found";
return true;
