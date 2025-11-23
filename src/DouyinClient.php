<?php

class DouyinClient {
    
    private $primaryApiUrl = 'https://snapvideotools.com/vi/api/snap';
    private $fallbackApiUrl = 'https://savetik.co/api/ajaxSearch';
    
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
            'Accept-Language: vi-VN,vi;q=0.9,en-US;q=0.8,en;q=0.7',
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
            // Try primary API first
            $result = $this->fetchFromPrimaryApi($url);
            $result['data']['apiUsed'] = 'primary';
            return $result;
        } catch (Exception $e) {
            // Fallback to secondary API
            $errorMsg = '[Primary API Failed] ' . $e->getMessage();
            error_log('Douyin ' . $errorMsg);
            
            try {
                $result = $this->fetchFromFallbackApi($url);
                $result['data']['apiUsed'] = 'fallback';
                $result['data']['primaryError'] = $e->getMessage();
                return $result;
            } catch (Exception $fallbackError) {
                error_log('Douyin [Fallback API Failed] ' . $fallbackError->getMessage());
                throw new Exception('All APIs failed: ' . $errorMsg . ' | Fallback: ' . $fallbackError->getMessage());
            }
        }
    }
    
    private function fetchFromPrimaryApi($url) {
        $this->randomDelay();
        $postData = json_encode(['text' => $url]);
        
        $cookieFile = tempnam(sys_get_temp_dir(), 'curl_cookie_');
        
        $ch = curl_init($this->primaryApiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->buildHeaders('https://snapvideotools.com', 'https://snapvideotools.com/vi/'));
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
        
        if (json_last_error() !== JSON_ERROR_NONE || empty($data['data'])) {
            throw new Exception("Invalid response from primary API");
        }
        
        $apiData = $data['data'];
        $videoUrl = '';
        $audioUrl = '';
        $thumbnail = $apiData['cover'] ?? '';
        $title = $apiData['title'] ?? 'Douyin Video';
        
        // Extract video and audio from mediaUrls
        if (!empty($apiData['mediaUrls']) && is_array($apiData['mediaUrls'])) {
            foreach ($apiData['mediaUrls'] as $media) {
                if (is_array($media) && isset($media['url'])) {
                    $type = strtolower($media['type'] ?? $media['mediaType'] ?? '');
                    if ($type === 'video' && empty($videoUrl)) {
                        $videoUrl = $media['url'];
                    } elseif ($type === 'audio' && empty($audioUrl)) {
                        $audioUrl = $media['url'];
                    }
                }
            }
        }
        
        // Alternative: check for other fields if not found
        if (empty($videoUrl)) {
            if (isset($apiData['downloadUrl'])) {
                $videoUrl = $apiData['downloadUrl'];
            } elseif (isset($apiData['videoUrl'])) {
                $videoUrl = $apiData['videoUrl'];
            }
        }
        
        if (empty($audioUrl)) {
            if (isset($apiData['musicUrl'])) {
                $audioUrl = $apiData['musicUrl'];
            } elseif (isset($apiData['music'])) {
                $audioUrl = $apiData['music'];
            }
        }
        
        return [
            'success' => true,
            'data' => [
                'id' => '',
                'title' => $title,
                'author' => 'douyin',
                'authorName' => 'Douyin User',
                'cover' => $thumbnail,
                'playCount' => 0,
                'likeCount' => 0,
                'commentCount' => 0,
                'shareCount' => 0,
                'duration' => 0,
                'type' => 'video',
                'videoUrl' => $videoUrl,
                'audioUrl' => $audioUrl,
                'url' => $url
            ]
        ];
    }
    
    private function fetchFromFallbackApi($url) {
        $this->randomDelay();
        $postData = 'q=' . urlencode($url) . '&lang=en';
        
        $cookieFile = tempnam(sys_get_temp_dir(), 'curl_cookie_');
        
        $ch = curl_init($this->fallbackApiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
            'Accept-Language: vi-VN,vi;q=0.9,en-US;q=0.8,en;q=0.7',
            'Accept-Encoding: gzip, deflate, br',
            'User-Agent: ' . $this->getRandomUserAgent(),
            'Referer: https://savetik.co/',
            'Origin: https://savetik.co',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Site: same-origin',
            'DNT: 1'
        ]);
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
            throw new Exception("Fallback API error: " . ($curlError ?: "HTTP $httpCode"));
        }
        
        $data = json_decode($response, true);
        
        if (json_last_error() !== JSON_ERROR_NONE || empty($data['data'])) {
            throw new Exception("Invalid response from fallback API");
        }
        
        $html = $data['data'];
        
        $videoUrl = '';
        $videoHdUrl = '';
        $audioUrl = '';
        $title = 'Douyin Video';
        $thumbnail = '';
        
        if (preg_match('/<h3>([^<]+)<\/h3>/', $html, $match)) {
            $title = html_entity_decode($match[1]);
        }
        
        if (preg_match('/<img src="([^"]+)"/', $html, $match)) {
            $thumbnail = html_entity_decode($match[1]);
        }
        
        if (preg_match('/href="(https:\/\/dl\.snapcdn\.app\/get\?token=[^"]+)"[^>]*>.*?Download MP4 HD/s', $html, $match)) {
            $videoHdUrl = html_entity_decode($match[1]);
        }
        
        if (preg_match('/href="(https:\/\/dl\.snapcdn\.app\/get\?token=[^"]+)"[^>]*>.*?Download MP4 \[1\]/s', $html, $match)) {
            $videoUrl = html_entity_decode($match[1]);
        }
        
        if (preg_match('/href="(https:\/\/dl\.snapcdn\.app\/get\?token=[^"]+)"[^>]*>.*?Download MP3/s', $html, $match)) {
            $audioUrl = html_entity_decode($match[1]);
        }
        
        $finalVideoUrl = $videoHdUrl ?: $videoUrl;
        $finalVideoUrl = html_entity_decode($finalVideoUrl);
        $audioUrl = html_entity_decode($audioUrl);
        
        return [
            'success' => true,
            'data' => [
                'id' => '',
                'title' => $title,
                'author' => 'douyin',
                'authorName' => 'Douyin User',
                'cover' => $thumbnail,
                'playCount' => 0,
                'likeCount' => 0,
                'commentCount' => 0,
                'shareCount' => 0,
                'duration' => 0,
                'type' => 'video',
                'videoUrl' => $finalVideoUrl,
                'audioUrl' => $audioUrl,
                'url' => $url
            ]
        ];
    }
}
?>
