<?php

if (!isset($_GET['url']) || empty($_GET['url'])) {
    http_response_code(400);
    echo 'URL is required';
    exit;
}

$imageUrl = $_GET['url'];

$ch = curl_init($imageUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');

$imageData = curl_exec($ch);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

if ($error || $httpCode !== 200) {
    header('Content-Type: image/svg+xml');
    echo '<svg width="300" height="200" xmlns="http://www.w3.org/2000/svg"><rect width="300" height="200" fill="#f0f0f0"/><text x="50%" y="50%" text-anchor="middle" fill="#999" font-family="Arial" font-size="14">No Image</text></svg>';
    exit;
}

header('Content-Type: ' . $contentType);
header('Cache-Control: public, max-age=86400');
header('Access-Control-Allow-Origin: *');

echo $imageData;
