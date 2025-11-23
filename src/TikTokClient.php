<?php

class TikTokClient {
    
    private $primaryApiUrl = 'https://api.tiktokv.com/api/fetch/';
    private $fallbackApiUrl = 'https://download.vgasoft.vn/web/c/tiktok/getVideo';
    
    private $userAgents = [
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36',
        'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Linux; Android 13; SM-G991B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (iPhone; CPU iPhone OS 17_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.1 Mobile/15E148 Safari/604.1',
    ];
    
    private function getRandomUserAgent() {
        return $this->userAgents[array_rand($this->userAgents)];
    }
    
    private function buildHeaders($origin, $referer) {
        return [
            'Content-Type: application/json',
            'Accept: application/json',
            'Accept-Language: en-US,en;q=0.9',
            'Accept-Encoding: gzip, deflate, br',
            'User-Agent: ' . $this->getRandomUserAgent(),
            'X-Requested-With: XMLHttpRequest',
            'Origin: ' . $origin,
            'Referer: ' . $referer,
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Site: same-origin',
            'Cache-Control: no-cache',
            'Pragma: no-cache',
            'DNT: 1'
        ];
    }
    
    private function randomDelay() {
        usleep(rand(300, 800) * 1000);
    }
    
    public function getVideoInfo($url) {
        try {
            $result = $this->fetchFromPrimaryApi($url);
            $result['data']['apiUsed'] = 'primary';
            return $result;
        } catch (Exception $e) {
            $errorMsg = '[Primary API Failed] ' . $e->getMessage();
            error_log('TikTok ' . $errorMsg);
            
            try {
                $result = $this->fetchFromFallbackApi($url);
                $result['data']['apiUsed'] = 'fallback';
                $result['data']['primaryError'] = $e->getMessage();
                return $result;
            } catch (Exception $fallbackError) {
                error_log('TikTok [Fallback API Failed] ' . $fallbackError->getMessage());
                throw new Exception('All APIs failed: ' . $errorMsg . ' | Fallback: ' . $fallbackError->getMessage());
            }
        }
    }
    
    private function fetchFromPrimaryApi($url) {
        $this->randomDelay();
        
        $postData = json_encode(['url' => $url]);
        
        $cookieFile = tempnam(sys_get_temp_dir(), 'curl_cookie_');
        
        $ch = curl_init($this->primaryApiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->buildHeaders('https://www.tiktok.com', 'https://www.tiktok.com/'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);
        @unlink($cookieFile);
        
        if ($curlError || $httpCode !== 200) {
            throw new Exception("Primary API error: " . ($curlError ?: "HTTP $httpCode"));
        }
        
        $data = json_decode($response, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Invalid response from primary API");
        }
        
        if (!isset($data['data'])) {
            throw new Exception("Invalid primary API response structure");
        }
        
        $videoData = $data['data'];
        
        return [
            'success' => true,
            'data' => [
                'id' => $videoData['id'] ?? '',
                'title' => $videoData['title'] ?? 'TikTok Video',
                'author' => $videoData['author']['unique_id'] ?? '',
                'authorName' => $videoData['author']['nickname'] ?? 'TikTok User',
                'cover' => $videoData['cover'] ?? '',
                'playCount' => $videoData['play_count'] ?? 0,
                'likeCount' => $videoData['digg_count'] ?? 0,
                'commentCount' => $videoData['comment_count'] ?? 0,
                'shareCount' => $videoData['share_count'] ?? 0,
                'duration' => $videoData['duration'] ?? 0,
                'type' => 'video',
                'videoUrl' => $videoData['play'] ?? '',
                'musicUrl' => $videoData['music'] ?? '',
                'url' => $url
            ]
        ];
    }
    
    private function fetchFromFallbackApi($url) {
        $this->randomDelay();
        
        $apiUrl = $this->fallbackApiUrl . '?link=' . urlencode($url);
        
        $cookieFile = tempnam(sys_get_temp_dir(), 'curl_cookie_');
        
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->buildHeaders('https://download.vgasoft.vn', 'https://download.vgasoft.vn/'));
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);
        @unlink($cookieFile);
        
        if ($curlError || $httpCode !== 200) {
            throw new Exception("Fallback API error: " . ($curlError ?: "HTTP $httpCode"));
        }
        
        $data = json_decode($response, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Invalid JSON response from fallback API");
        }
        
        if (!isset($data['result']) || !is_array($data['result']) || empty($data['result'])) {
            throw new Exception("No result in fallback API response");
        }
        
        $videoData = $data['result'][0];
        
        $videoUrl = $videoData['video']['url'] ?? '';
        $title = $videoData['video']['content'] ?? 'TikTok Video';
        $cover = $videoData['video']['cover'] ?? '';
        $authorName = $videoData['author']['nickname'] ?? 'TikTok User';
        $authorId = $videoData['author']['unique_id'] ?? '';
        $videoId = $videoData['id'] ?? '';
        
        return [
            'success' => true,
            'data' => [
                'id' => $videoId,
                'title' => $title,
                'author' => $authorId,
                'authorName' => $authorName,
                'cover' => $cover,
                'playCount' => 0,
                'likeCount' => 0,
                'commentCount' => 0,
                'shareCount' => 0,
                'duration' => 0,
                'type' => 'video',
                'videoUrl' => $videoUrl,
                'musicUrl' => '',
                'url' => $url
            ]
        ];
    }
}
?>
