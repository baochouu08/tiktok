<?php

class TikwmClient {
    private $apiUrl = 'https://www.tikwm.com/api/';
    private $timeout = 30;

    public function getVideoInfo($url) {
        $data = ['url' => $url];
        
        $ch = curl_init($this->apiUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
            'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36'
        ]);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        
        if ($error) {
            throw new Exception("CURL Error: " . $error);
        }
        
        if ($httpCode !== 200) {
            throw new Exception("API Error: HTTP " . $httpCode);
        }
        
        $result = json_decode($response, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("JSON Parse Error: " . json_last_error_msg());
        }
        
        return $result;
    }
}
