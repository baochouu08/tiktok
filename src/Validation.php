
<?php

class Validation {
    public static function validateUrl($url, $platform = 'tiktok') {
        if (empty($url)) {
            throw new Exception("URL không được để trống");
        }
        
        $patterns = self::getPatterns($platform);
        
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url)) {
                return true;
            }
        }
        
        throw new Exception("URL {$platform} không hợp lệ");
    }
    
    private static function getPatterns($platform) {
        $allPatterns = [
            'tiktok' => [
                '/(?:vm\.tiktok\.com|vt\.tiktok\.com)\/[A-Za-z0-9]+/',
                '/tiktok\.com\/@[^\/]+\/video\/\d+/',
                '/tiktok\.com\/v\/\d+/',
                '/tiktok\.com\/.*\/video\/\d+/',
            ],
            'instagram' => [
                '/instagram\.com\/(p|reel|tv)\/[A-Za-z0-9_-]+/',
                '/instagram\.com\/stories\/[^\/]+\/\d+/',
            ],
            'youtube' => [
                '/youtube\.com\/watch\?v=[A-Za-z0-9_-]+/',
                '/youtu\.be\/[A-Za-z0-9_-]+/',
                '/youtube\.com\/shorts\/[A-Za-z0-9_-]+/',
            ],
            'twitter' => [
                '/(twitter\.com|x\.com)\/[^\/]+\/status\/\d+/',
            ],
            'facebook' => [
                '/facebook\.com\/.*\/videos\/\d+/',
                '/fb\.watch\/[A-Za-z0-9_-]+/',
                '/facebook\.com\/watch\/\?v=\d+/',
                '/facebook\.com\/reel\/\d+/',
                '/facebook\.com\/share\/v\/[A-Za-z0-9_-]+/',
                '/facebook\.com\/share\/r\/[A-Za-z0-9_-]+/',
            ],
            'douyin' => [
                '/douyin\.com\/video\/\d+/',
                '/v\.douyin\.com\/[A-Za-z0-9]+/',
            ],
            'bilibili' => [
                '/bilibili\.com\/video\/[A-Za-z0-9]+/',
                '/b23\.tv\/[A-Za-z0-9]+/',
            ],
            'rednote' => [
                '/xiaohongshu\.com\/.*\/[A-Za-z0-9]+/',
                '/xhslink\.com\/[A-Za-z0-9]+/',
            ],
            'weverse' => [
                '/weverse\.io\/[^\/]+\/.*/',
            ],
        ];
        
        return isset($allPatterns[$platform]) ? $allPatterns[$platform] : $allPatterns['tiktok'];
    }
    
    // Giữ lại hàm cũ để tương thích ngược
    public static function validateTikTokUrl($url) {
        return self::validateUrl($url, 'tiktok');
    }
    
    public static function sanitizeUrl($url) {
        $url = trim($url);
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return $url;
    }
}
