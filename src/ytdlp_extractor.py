#!/usr/bin/env python3
import yt_dlp
import json
import sys

def get_video_info(url):
    try:
        ydl_opts = {
            'quiet': True,
            'no_warnings': True,
            'extract_flat': False,
        }
        
        with yt_dlp.YoutubeDL(ydl_opts) as ydl:
            info = ydl.extract_info(url, download=False)
            
            dl_url = info.get('url')
            if not dl_url:
                formats = info.get('formats', [])
                for f in reversed(formats):
                    if f.get('url'):
                        dl_url = f['url']
                        break
            
            result = {
                "success": True,
                "data": {
                    "id": str(info.get('id', '')),
                    "title": info.get('title', ''),
                    "cover": info.get('thumbnail', ''),
                    "author": info.get('uploader', ''),
                    "authorName": info.get('uploader', ''),
                    "playCount": info.get('view_count', 0),
                    "likeCount": info.get('like_count', 0),
                    "commentCount": info.get('comment_count', 0),
                    "shareCount": 0,
                    "duration": info.get('duration', 0),
                    "videoUrl": dl_url or '',
                    "musicUrl": '',
                    "platform": info.get('extractor', '')
                }
            }
            
            return result
            
    except Exception as e:
        return {
            "success": False,
            "error": str(e)
        }

if __name__ == '__main__':
    if len(sys.argv) < 2:
        print(json.dumps({"success": False, "error": "URL is required"}))
        sys.exit(1)
    
    url = sys.argv[1]
    result = get_video_info(url)
    print(json.dumps(result, ensure_ascii=False))
