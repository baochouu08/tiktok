
(function() {
    let currentData = null;
    
    const elements = {
        urlInput: null,
        parseBtn: null,
        loading: null,
        result: null,
        cover: null,
        title: null,
        author: null,
        imagesGallery: null,
        imagesContainer: null,
        downloadVideoBtn: null,
        downloadAllBtn: null
    };
    
    function initElements() {
        elements.urlInput = document.getElementById('videoUrl');
        elements.parseBtn = document.getElementById('parseBtn');
        elements.loading = document.getElementById('loading');
        elements.result = document.getElementById('videoResult');
        elements.cover = document.getElementById('videoCover');
        elements.title = document.getElementById('videoTitle');
        elements.author = document.getElementById('videoAuthor');
        elements.imagesGallery = document.getElementById('imagesGallery');
        elements.imagesContainer = document.getElementById('imagesContainer');
        elements.downloadVideoBtn = document.getElementById('downloadVideoBtn');
        elements.downloadAllBtn = document.getElementById('downloadAllImagesBtn');
        
        if (elements.parseBtn) {
            elements.parseBtn.addEventListener('click', handleParse);
        }
        if (elements.urlInput) {
            elements.urlInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') handleParse();
            });
        }
        if (elements.downloadAllBtn) {
            elements.downloadAllBtn.addEventListener('click', downloadAllImages);
        }
        
        console.log('[Rednote] Initialized');
    }
    
    async function handleParse() {
        const url = elements.urlInput?.value?.trim();
        
        if (!url) {
            return;
        }
        
        console.log('[Rednote] Parsing:', url);
        
        if (elements.loading) elements.loading.style.display = 'block';
        if (elements.result) elements.result.style.display = 'none';
        
        try {
            const response = await fetch('https://www.rednote-downloader.com/api/extract', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ url, retryCount: 3 })
            });
            
            if (!response.ok) {
                throw new Error(`API error: ${response.status}`);
            }
            
            const data = await response.json();
            
            console.log('[Rednote] API Response:', data);
            
            if (elements.loading) elements.loading.style.display = 'none';
            
            if (!data || (!data.images && !data.videoUrl)) {
                return;
            }
            
            currentData = data;
            
            if (elements.title) {
                elements.title.textContent = data.title || 'Xiaohongshu Post';
            }
            if (elements.author) {
                elements.author.textContent = '@rednote';
            }
            
            if (elements.imagesContainer) {
                elements.imagesContainer.innerHTML = '';
            }
            
            if (data.images && data.images.length > 0) {
                console.log('[Rednote] Hiển thị', data.images.length, 'ảnh');
                
                if (elements.imagesGallery) {
                    elements.imagesGallery.style.display = 'block';
                }
                if (elements.downloadAllBtn) {
                    elements.downloadAllBtn.style.display = 'inline-flex';
                }
                
                data.images.forEach((imageUrl, index) => {
                    const item = document.createElement('div');
                    item.style.cssText = `
                        position: relative;
                        border-radius: 8px;
                        overflow: hidden;
                        background: #F8F9FA;
                        display: flex;
                        flex-direction: column;
                    `;
                    
                    const img = document.createElement('img');
                    img.src = `/api/proxy-image.php?url=${encodeURIComponent(imageUrl)}`;
                    img.alt = `Image ${index + 1}`;
                    img.loading = 'lazy';
                    img.style.cssText = `
                        width: 100%;
                        height: auto;
                        object-fit: cover;
                        min-height: 150px;
                        border-radius: 8px 8px 0 0;
                    `;
                    
                    const btn = document.createElement('button');
                    btn.style.cssText = `
                        width: 100%;
                        padding: 10px;
                        background: #1C8576;
                        color: white;
                        border: none;
                        cursor: pointer;
                        font-size: 13px;
                        font-weight: 600;
                        border-radius: 0 0 8px 8px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 6px;
                        transition: background 0.2s;
                    `;
                    btn.innerHTML = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z" fill="currentColor"/></svg>Tải ảnh ${index + 1}`;
                    btn.addEventListener('mouseenter', () => btn.style.background = '#15685E');
                    btn.addEventListener('mouseleave', () => btn.style.background = '#1C8576');
                    btn.addEventListener('click', () => {
                        const filename = `rednote_image_${index + 1}.jpg`;
                        const downloadUrl = `/api/download.php?url=${encodeURIComponent(imageUrl)}&filename=${encodeURIComponent(filename)}`;
                        const a = document.createElement('a');
                        a.href = downloadUrl;
                        a.download = filename;
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);
                    });
                    
                    item.appendChild(img);
                    item.appendChild(btn);
                    elements.imagesContainer.appendChild(item);
                    
                    console.log('[Rednote] Đã thêm ảnh', index + 1);
                });
            } else if (data.videoUrl) {
                console.log('[Rednote] Hiển thị video');
                if (elements.cover) {
                    elements.cover.style.display = 'block';
                    elements.cover.src = data.previewUrl || '';
                }
                if (elements.downloadVideoBtn) {
                    elements.downloadVideoBtn.style.display = 'inline-flex';
                }
            }
            
            if (elements.result) {
                elements.result.style.display = 'block';
                setTimeout(() => {
                    elements.result.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }, 100);
            }
            
        } catch (error) {
            console.error('[Rednote] Error:', error);
        }
    }
    
    function downloadAllImages() {
        if (!currentData || !currentData.images || currentData.images.length === 0) {
            return;
        }
        
        currentData.images.forEach((imageUrl, index) => {
            setTimeout(() => {
                const filename = `rednote_image_${index + 1}.jpg`;
                const downloadUrl = `/api/download.php?url=${encodeURIComponent(imageUrl)}&filename=${encodeURIComponent(filename)}`;
                const a = document.createElement('a');
                a.href = downloadUrl;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            }, index * 500);
        });
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initElements);
    } else {
        initElements();
    }
})();
