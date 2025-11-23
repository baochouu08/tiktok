<?php

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['url'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'URL is required']);
    exit;
}

$url = $input['url'];

// First, resolve short URLs
$finalUrl = resolveUrl($url);

if (!$finalUrl) {
    echo json_encode(['success' => false, 'error' => 'Failed to resolve URL']);
    exit;
}

// Extract note ID
$noteId = extractNoteId($finalUrl);
if (!$noteId) {
    echo json_encode(['success' => false, 'error' => 'Invalid Rednote URL']);
    exit;
}

// Fetch page content
$html = fetchPageContent($finalUrl);
if (!$html) {
    echo json_encode(['success' => false, 'error' => 'Failed to fetch content']);
    exit;
}

// Parse content
$result = parseContent($html, $noteId, $url);
echo json_encode($result);

// ===== HELPER FUNCTIONS =====

function resolveUrl($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
    
    curl_exec($ch);
    $finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    curl_close($ch);
    
    return $finalUrl ?: $url;
}

function extractNoteId($url) {
    if (preg_match('/\/(?:item|explore)\/([a-zA-Z0-9]+)/', $url, $match)) {
        return $match[1];
    }
    if (preg_match('/xhslink\.com.*id=([a-zA-Z0-9]+)/', $url, $match)) {
        return $match[1];
    }
    return null;
}

function fetchPageContent($url) {
    // Try direct fetch first
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    
    $html = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode === 200 && $html) {
        return $html;
    }
    
    // Fallback to CORS proxy
    $proxyUrl = 'https://api.allorigins.win/raw?url=' . urlencode($url);
    $ch = curl_init($proxyUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $html = curl_exec($ch);
    curl_close($ch);
    
    return $html ?: null;
}

function parseContent($html, $noteId, $originalUrl) {
    // Parse images
    $images = [];
    $imageRegex = '/https?:\/\/[^"\']*sns-webpic[^"\']*!nd_(?:orig|dft|prv)[^\'"]*(?=["\'\s])/';
    
    if (preg_match_all($imageRegex, $html, $matches)) {
        $seen = [];
        foreach ($matches[0] as $imgUrl) {
            // Extract unique identifier
            if (preg_match('/\/([a-z0-9]+)!nd_/', $imgUrl, $idMatch)) {
                $uniqueId = $idMatch[1];
                if (!isset($seen[$uniqueId])) {
                    $seen[$uniqueId] = true;
                    $images[] = trim($imgUrl);
                }
            }
        }
    }
    
    // Parse title
    $title = 'Xiaohongshu Post';
    if (preg_match('/<meta\s+property=["\']og:title["\'][^>]*content=["\']([^"\']+)["\']/', $html, $match)) {
        $title = html_entity_decode($match[1]);
    }
    
    // Check for video
    $hasVideo = strpos($html, 'originVideoKey') !== false;
    $videoUrl = '';
    if ($hasVideo && preg_match('/"originVideoKey":\s*"([^"]+)"/', $html, $match)) {
        $key = str_replace('\\u002F', '/', $match[1]);
        $videoUrl = 'https://sns-video-bd.xhscdn.com/' . $key;
    }
    
    // Get preview
    $previewUrl = !empty($images) ? $images[0] : ($videoUrl ?: '');
    
    // Determine type
    $type = ($hasVideo && $videoUrl) ? 'video' : 'image';
    
    return [
        'success' => true,
        'id' => $noteId,
        'title' => $title,
        'author' => 'rednote',
        'type' => $type,
        'previewUrl' => $previewUrl,
        'videoUrl' => $videoUrl,
        'images' => $images,
        'url' => $originalUrl
    ];
}
