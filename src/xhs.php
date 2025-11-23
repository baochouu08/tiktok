<?php
/**
 * Xiaohongshu API - Extract video/image từ share links
 * 
 * Usage: php xhs.php <share_url>
 * 
 * Response format:
 * 
 * Video post:
 * {
 *   "note_id": "6890939a0000000023036dcc",
 *   "title": "这个秋天我要这样穿！！黑色皮衣真的好好看啊 - 小红书", 
 *   "type": "video",
 *   "images": ["http://...thumbnail_url"],
 *   "video": "https://sns-video-bd.xhscdn.com/...no_watermark"
 * }
 * 
 * Image post: 
 * {
 *   "note_id": "6886fec9000000002400acd7",
 *   "title": "#二次元壁纸 - 小红书",
 *   "type": "image", 
 *   "images": ["http://...img1", "http://...img2", "http://...img3"]
 * }
 */

function getHtml($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $html = curl_exec($ch);
    curl_close($ch);
    return $html;
}

function getMeta($html, $name) {
    $pattern = '/<meta[^>]*(?:property|name)=["\']' . preg_quote($name) . '["\'][^>]*content=["\']([^"\']+)["\'][^>]*>/';
    if (preg_match($pattern, $html, $m)) {
        return html_entity_decode($m[1]);
    }
    return null;
}

function getVideoKey($html) {
    if (preg_match('/"originVideoKey":\s*"([^"]+)"/', $html, $m)) {
        return str_replace('\u002F', '/', $m[1]);
    }
    return null;
}

function getImages($html) {
    preg_match_all('/http[^"]*sns-webpic[^"]*!nd_(?:orig|dft)_[^"]*/', $html, $matches);
    
    $groups = [];
    foreach ($matches[0] as $url) {
        $url = str_replace('\/', '/', $url);
        
        if (preg_match('/\/([a-z0-9]+)!nd_/', $url, $m)) {
            $id = $m[1];
            $priority = strpos($url, 'nd_orig') ? 3 : 2;
            
            if (!isset($groups[$id]) || $groups[$id]['p'] < $priority) {
                $groups[$id] = ['url' => $url, 'p' => $priority];
            }
        }
    }
    
    return array_column($groups, 'url');
}

function getNoteId($html) {
    if (preg_match('/\/(?:item|explore)\/([a-f0-9]+)/', $html, $m)) {
        return $m[1];
    }
    return null;
}

// Main
$url = $argv[1] ?? '';
if (!$url) die("Usage: php xhs.php <url>\n");

$html = getHtml($url);
$isVideo = strpos($html, 'originVideoKey') !== false;

$result = [
    'note_id' => getNoteId($html),
    'title' => getMeta($html, 'og:title'),
    'type' => $isVideo ? 'video' : 'image',
    'images' => getImages($html)
];

if ($isVideo) {
    $key = getVideoKey($html);
    if ($key) {
        $result['video'] = "https://sns-video-bd.xhscdn.com/$key";
    }
}

echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

?>
