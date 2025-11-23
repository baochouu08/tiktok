<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

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
    
    $url = $data['url'];
    $retryCount = isset($data['retryCount']) ? (int)$data['retryCount'] : 3;
    
    // Call external API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.rednote-downloader.com/api/extract');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        'url' => $url,
        'retryCount' => $retryCount
    ]));
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);
    
    if ($curlError) {
        throw new Exception("API request failed: " . $curlError);
    }
    
    if ($httpCode !== 200) {
        throw new Exception("API returned status code: " . $httpCode);
    }
    
    $result = json_decode($response, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Invalid JSON response from API");
    }
    
    if (empty($result)) {
        throw new Exception("Empty response from API");
    }
    
    // Normalize response to match our format
    $normalizedResult = [
        'success' => true,
        'data' => [
            'id' => '',
            'title' => $result['title'] ?? 'Rednote Post',
            'author' => 'rednote',
            'authorName' => 'Rednote User',
            'cover' => $result['previewUrl'] ?? (!empty($result['images']) ? $result['images'][0] : ''),
            'playCount' => 0,
            'likeCount' => 0,
            'commentCount' => 0,
            'shareCount' => 0,
            'duration' => 0,
            'type' => !empty($result['videoUrl']) ? 'video' : 'image',
            'videoUrl' => $result['videoUrl'] ?? '',
            'images' => $result['images'] ?? [],
            'url' => $url,
        ]
    ];
    
    echo json_encode($normalizedResult);
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>
