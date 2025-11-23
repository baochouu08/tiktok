(function() {
    let currentData = null;
    let isLoading = false;
    
    const elements = {
        urlInput: null,
        parseBtn: null,
        loading: null,
        result: null,
        cover: null,
        title: null,
        author: null,
        plays: null,
        likes: null,
        duration: null,
        downloadVideoBtn: null,
        downloadMusicBtn: null
    };
    
    function initElements() {
        elements.urlInput = document.getElementById('videoUrl');
        elements.parseBtn = document.getElementById('parseBtn');
        elements.loading = document.getElementById('loading');
        elements.result = document.getElementById('videoResult');
        elements.cover = document.getElementById('videoCover');
        elements.title = document.getElementById('videoTitle');
        elements.author = document.getElementById('videoAuthor');
        elements.plays = document.getElementById('videoPlays');
        elements.likes = document.getElementById('videoLikes');
        elements.duration = document.getElementById('videoDuration');
        elements.downloadVideoBtn = document.getElementById('downloadVideoBtn');
        elements.downloadMusicBtn = document.getElementById('downloadMusicBtn');
        
        if (elements.parseBtn) {
            elements.parseBtn.addEventListener('click', handleParse);
        }
        if (elements.urlInput) {
            elements.urlInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') handleParse();
            });
        }
        if (elements.downloadVideoBtn) {
            elements.downloadVideoBtn.addEventListener('click', downloadVideo);
        }
        if (elements.downloadMusicBtn) {
            elements.downloadMusicBtn.addEventListener('click', downloadMusic);
        }
        
        console.log('[Douyin] Initialized');
    }
    
    async function handleParse() {
        if (isLoading) return;
        
        const url = elements.urlInput?.value?.trim();
        
        if (!url) {
            return;
        }
        
        isLoading = true;
        console.log('[Douyin] Parsing:', url);
        
        if (elements.loading) elements.loading.style.display = 'block';
        if (elements.result) elements.result.style.display = 'none';
        
        try {
            const response = await fetch('/api/parse.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ 
                    url: url,
                    platform: 'douyin'
                })
            });
            
            if (!response.ok) {
                throw new Error(`API error: ${response.status}`);
            }
            
            const result = await response.json();
            
            const apiInfo = result.data?.apiUsed ? ` (${result.data.apiUsed} API)` : '';
            const primaryError = result.data?.primaryError ? ` - Primary error: ${result.data.primaryError}` : '';
            console.log('[Douyin] API Response:', result.data?.apiUsed || 'unknown', primaryError);
            
            if (elements.loading) elements.loading.style.display = 'none';
            
            if (!result.success || !result.data) {
                return;
            }
            
            const data = result.data;
            currentData = data;
            
            if (elements.title) {
                elements.title.textContent = data.title || 'Douyin Video';
            }
            if (elements.author) {
                elements.author.textContent = '@' + (data.author || 'douyin');
            }
            if (elements.cover && data.cover) {
                elements.cover.src = `/api/proxy-image.php?url=${encodeURIComponent(data.cover)}`;
                elements.cover.style.display = 'block';
            }
            
            if (elements.downloadVideoBtn) {
                elements.downloadVideoBtn.style.display = data.videoUrl ? 'inline-flex' : 'none';
            }
            if (elements.downloadMusicBtn) {
                elements.downloadMusicBtn.style.display = data.audioUrl ? 'inline-flex' : 'none';
            }
            
            if (elements.result) {
                elements.result.style.display = 'block';
                setTimeout(() => {
                    elements.result.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }, 100);
            }
            
        } catch (error) {
            console.error('[Douyin] Error:', error);
            if (elements.loading) elements.loading.style.display = 'none';
        } finally {
            isLoading = false;
        }
    }
    
    function downloadVideo() {
        if (!currentData || !currentData.videoUrl) {
            return;
        }
        
        const filename = 'douyin_video.mp4';
        const downloadUrl = `/api/download.php?url=${encodeURIComponent(currentData.videoUrl)}&filename=${encodeURIComponent(filename)}`;
        const a = document.createElement('a');
        a.href = downloadUrl;
        a.download = filename;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }
    
    function downloadMusic() {
        if (!currentData || !currentData.audioUrl) {
            return;
        }
        
        const filename = 'douyin_audio.mp3';
        const downloadUrl = `/api/download.php?url=${encodeURIComponent(currentData.audioUrl)}&filename=${encodeURIComponent(filename)}`;
        const a = document.createElement('a');
        a.href = downloadUrl;
        a.download = filename;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initElements);
    } else {
        initElements();
    }
})();
