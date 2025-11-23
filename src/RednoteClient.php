<?php

class RednoteClient {
    
    public function getVideoInfo($url) {
        $finalUrl = $this->resolveUrl($url);
        if (!$finalUrl) {
            throw new Exception("Failed to resolve URL");
        }
        
        $noteId = $this->extractNoteId($finalUrl);
        if (!$noteId) {
            throw new Exception("Invalid Rednote URL");
        }
        
        $html = $this->fetchPageContent($finalUrl);
        if (!$html) {
            throw new Exception("Failed to fetch content");
        }
        
        $data = $this->parseContent($html, $noteId, $url);
        
        return [
            'success' => true,
            'data' => [
                'id' => $data['id'] ?? '',
                'title' => $data['title'] ?? 'Rednote Post',
                'author' => 'rednote',
                'authorName' => 'Rednote User',
                'cover' => $data['previewUrl'] ?? '',
                'playCount' => 0,
                'likeCount' => 0,
                'commentCount' => 0,
                'shareCount' => 0,
                'duration' => 0,
                'type' => $data['type'] ?? 'image',
                'videoUrl' => $data['videoUrl'] ?? '',
                'images' => $data['images'] ?? [],
                'url' => $url,
            ]
        ];
    }
    
    private function resolveUrl($url) {
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
    
    private function extractNoteId($url) {
        if (preg_match('/\/(?:item|explore)\/([a-zA-Z0-9]+)/', $url, $match)) {
            return $match[1];
        }
        if (preg_match('/xhslink\.com.*id=([a-zA-Z0-9]+)/', $url, $match)) {
            return $match[1];
        }
        return null;
    }
    
    private function fetchPageContent($url) {
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
        
        $proxyUrl = 'https://api.allorigins.win/raw?url=' . urlencode($url);
        $ch = curl_init($proxyUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $html = curl_exec($ch);
        curl_close($ch);
        
        return $html ?: null;
    }
    
    private function parseContent($html, $noteId, $originalUrl) {
        $images = [];
        $imageRegex = '/https?:\/\/[^"\']*sns-webpic[^"\']*!nd_(?:orig|dft|prv)[^\'"]*(?=["\'\s])/';
        
        if (preg_match_all($imageRegex, $html, $matches)) {
            $seen = [];
            foreach ($matches[0] as $imgUrl) {
                if (preg_match('/\/([a-z0-9]+)!nd_/', $imgUrl, $idMatch)) {
                    $uniqueId = $idMatch[1];
                    if (!isset($seen[$uniqueId])) {
                        $seen[$uniqueId] = true;
                        $images[] = trim($imgUrl);
                    }
                }
            }
        }
        
        $title = 'Xiaohongshu Post';
        if (preg_match('/<meta\s+property=["\']og:title["\'][^>]*content=["\']([^"\']+)["\']/', $html, $match)) {
            $title = html_entity_decode($match[1]);
        }
        
        $hasVideo = strpos($html, 'originVideoKey') !== false;
        $videoUrl = '';
        if ($hasVideo && preg_match('/"originVideoKey":\s*"([^"]+)"/', $html, $match)) {
            $key = str_replace('\\u002F', '/', $match[1]);
            $videoUrl = 'https://sns-video-bd.xhscdn.com/' . $key;
        }
        
        $previewUrl = !empty($images) ? $images[0] : ($videoUrl ?: '');
        $type = ($hasVideo && $videoUrl) ? 'video' : 'image';
        
        return [
            'id' => $noteId,
            'title' => $title,
            'type' => $type,
            'previewUrl' => $previewUrl,
            'videoUrl' => $videoUrl,
            'images' => $images,
        ];
    }
}
?>
