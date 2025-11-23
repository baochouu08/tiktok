<?php

function isAllowedDomain($url) {
    $allowedDomains = [
        'tiktokcdn.com',
        'tiktokcdn-us.com',
        'tikcdn.io',
        'v16-coin.tiktokcdn.com',
        'v16-webapp-prime.us.tiktok.com',
        'sf16-ies-music-sg.tiktokcdn.com',
        'api.tiktokv.com',
        'cdninstagram.com',
        'fbcdn.net',
        'instagram.com',
        'facebook.com',
        'googlevideo.com',
        'youtube.com',
        'ytimg.com',
        'twimg.com',
        'video.twimg.com',
        'twitter.com',
        'douyin.com',
        'douyinvod.com',
        'douyincdn.com',
        'douyinstatic.com',
        'bilivideo.com',
        'bilibili.com',
        'xiaohongshu.com',
        'xhscdn.com',
        'weverse.io',
        'weversecdn.com',
        'snapcdn.app',
        'dl.snapcdn.app'
    ];
    
    $parsedUrl = parse_url($url);
    if (!isset($parsedUrl['host'])) {
        return false;
    }
    
    $host = $parsedUrl['host'];
    
    foreach ($allowedDomains as $domain) {
        if ($host === $domain || str_ends_with($host, '.' . $domain)) {
            return true;
        }
    }
    
    return false;
}

function sanitizeFilename($filename) {
    $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);
    $filename = preg_replace('/_+/', '_', $filename);
    $filename = trim($filename, '_');
    return $filename;
}

if (!isset($_GET['url']) || empty($_GET['url'])) {
    http_response_code(400);
    echo 'URL is required';
    exit;
}

$videoUrl = $_GET['url'];

if (!isAllowedDomain($videoUrl)) {
    http_response_code(403);
    echo 'Invalid URL domain. Only trusted CDN URLs are allowed.';
    exit;
}

$filename = isset($_GET['filename']) ? sanitizeFilename($_GET['filename']) : 'video.mp4';

$contentType = 'video/mp4';
if (str_ends_with(strtolower($filename), '.mp3')) {
    $contentType = 'audio/mpeg';
}

$ch = curl_init($videoUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 300);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_REFERER, 'https://savetik.co/');
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');

$data = curl_exec($ch);
$error = curl_error($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($error || $httpCode !== 200 || empty($data)) {
    http_response_code(500);
    echo 'Download error: ' . ($error ?: 'HTTP ' . $httpCode);
    exit;
}

header('Content-Type: ' . $contentType);
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: no-cache');
header('X-Content-Type-Options: nosniff');
header('Content-Length: ' . strlen($data));

echo $data;
