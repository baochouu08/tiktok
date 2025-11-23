<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../../src/TikTokClient.php';
require_once __DIR__ . '/../../src/TikwmClient.php';
require_once __DIR__ . '/../../src/MultiPlatformClient.php';
require_once __DIR__ . '/../../src/RednoteClient.php';
require_once __DIR__ . '/../../src/DouyinClient.php';
require_once __DIR__ . '/../../src/Validation.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

try {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    if (!isset($data['url'])) {
        throw new Exception("URL is required");
    }
    
    $url = Validation::sanitizeUrl($data['url']);
    $platform = isset($data['platform']) ? $data['platform'] : 'tiktok';
    Validation::validateUrl($url, $platform);
    
    if ($platform === 'tiktok') {
        $client = new TikTokClient();
        $result = $client->getVideoInfo($url);
        
        if (!$result['success']) {
            throw new Exception($result['error'] ?? 'API Error');
        }
        
        $response = $result;
    } else if ($platform === 'rednote') {
        $client = new RednoteClient();
        $result = $client->getVideoInfo($url);
        
        if (!$result['success']) {
            throw new Exception($result['error'] ?? 'API Error');
        }
        
        $response = $result;
    } else if ($platform === 'douyin') {
        $client = new DouyinClient();
        $result = $client->getVideoInfo($url);
        
        if (!$result['success']) {
            throw new Exception($result['error'] ?? 'API Error');
        }
        
        $response = $result;
    } else {
        $client = new MultiPlatformClient();
        $result = $client->getVideoInfo($url);
        
        if (!$result['success']) {
            throw new Exception($result['error'] ?? 'API Error');
        }
        
        $response = $result;
    }
    
    echo json_encode($response);
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
