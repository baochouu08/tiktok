let currentVideoData = null;

const elements = {
    urlInput: document.getElementById('videoUrl'),
    parseBtn: document.getElementById('parseBtn'),
    loading: document.getElementById('loading'),
    videoResult: document.getElementById('videoResult'),
    videoCover: document.getElementById('videoCover'),
    videoTitle: document.getElementById('videoTitle'),
    videoAuthor: document.getElementById('videoAuthor'),
    videoPlays: document.getElementById('videoPlays'),
    videoLikes: document.getElementById('videoLikes'),
    videoDuration: document.getElementById('videoDuration'),
    downloadVideoBtn: document.getElementById('downloadVideoBtn'),
    downloadMusicBtn: document.getElementById('downloadMusicBtn'),
    toast: document.getElementById('toast')
};

function showToast(message, type = 'info') {
    elements.toast.textContent = message;
    elements.toast.className = `toast show ${type}`;
    
    setTimeout(() => {
        elements.toast.className = 'toast';
    }, 3000);
}

function formatNumber(num) {
    if (num >= 1000000) {
        return (num / 1000000).toFixed(1) + 'M';
    } else if (num >= 1000) {
        return (num / 1000).toFixed(1) + 'K';
    }
    return num.toString();
}

function showLoading() {
    elements.loading.innerHTML = `
        <div class="result-card">
            <div class="skeleton skeleton-cover"></div>
            <div class="skeleton skeleton-title"></div>
            <div class="skeleton skeleton-author"></div>
            <div class="skeleton-stats">
                <div class="skeleton skeleton-stat"></div>
                <div class="skeleton skeleton-stat"></div>
                <div class="skeleton skeleton-stat"></div>
            </div>
            <div class="skeleton-buttons">
                <div class="skeleton skeleton-button"></div>
                <div class="skeleton skeleton-button"></div>
            </div>
        </div>
    `;
    elements.loading.style.display = 'block';
    elements.videoResult.style.display = 'none';
}

function hideLoading() {
    elements.loading.style.display = 'none';
}

function showVideoResult(data) {
    currentVideoData = data;
    
    // Batch DOM writes together
    const fragment = document.createDocumentFragment();
    
    if (data.cover) {
        elements.videoCover.src = `/api/proxy-image.php?url=${encodeURIComponent(data.cover)}`;
    } else {
        elements.videoCover.src = 'https://via.placeholder.com/300x200?text=No+Image';
    }
    
    elements.videoTitle.textContent = data.title || 'No title';
    elements.videoAuthor.textContent = `@${data.author || 'Unknown'}`;
    
    if (elements.videoPlays) {
        elements.videoPlays.textContent = `👁️ ${formatNumber(data.playCount || 0)}`;
    }
    if (elements.videoLikes) {
        elements.videoLikes.textContent = `❤️ ${formatNumber(data.likeCount || 0)}`;
    }
    if (elements.videoDuration) {
        elements.videoDuration.textContent = `⏱️ ${data.duration || 0}s`;
    }
    
    // Display and scroll in single animation frame
    requestAnimationFrame(() => {
        elements.videoResult.style.display = 'block';
        requestAnimationFrame(() => {
            elements.videoResult.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        });
    });
}

async function parseVideo() {
    const url = elements.urlInput.value.trim();
    
    if (!url) {
        showToast('Please enter a video URL', 'error');
        return;
    }
    
    showLoading();
    
    try {
        const platform = elements.urlInput.getAttribute('data-platform') || 'tiktok';
        
        const response = await fetch('/api/parse.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ url, platform })
        });
        
        const result = await response.json();
        
        if (!result.success) {
            // For Rednote, fallback to client-side fetch
            if (platform === 'rednote' && window.fetchRednoteDirectly) {
                const directResult = await window.fetchRednoteDirectly(url);
                if (directResult && directResult.success && (directResult.data.images.length > 0 || directResult.data.videoUrl)) {
                    hideLoading();
                    showVideoResult(directResult.data);
                    showToast('Content parsed successfully! (via browser)', 'success');
                    return;
                }
            }
            throw new Error(result.error || 'Failed to parse video');
        }
        
        hideLoading();
        showVideoResult(result.data);
        showToast('Content parsed successfully!', 'success');
        
    } catch (error) {
        hideLoading();
        showToast(error.message || 'An error occurred', 'error');
        console.error('Parse error:', error);
    }
}

function downloadVideo() {
    if (!currentVideoData || !currentVideoData.videoUrl) {
        showToast('No video available to download', 'error');
        return;
    }
    
    const title = (currentVideoData.title || 'video').substring(0, 30);
    const filename = `${currentVideoData.id || 'video'}_${title}.mp4`;
    const cleanFilename = filename.replace(/[<>:"/\\|?*]/g, '_');
    
    const downloadUrl = `/api/download.php?url=${encodeURIComponent(currentVideoData.videoUrl)}&filename=${encodeURIComponent(cleanFilename)}`;
    
    const a = document.createElement('a');
    a.href = downloadUrl;
    a.download = cleanFilename;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    
    showToast('Download started!', 'success');
}

function downloadMusic() {
    if (!currentVideoData || !currentVideoData.musicUrl) {
        showToast('No audio available to download', 'error');
        return;
    }
    
    const title = (currentVideoData.title || 'audio').substring(0, 30);
    const filename = `${currentVideoData.id || 'audio'}_${title}_audio.mp3`;
    const cleanFilename = filename.replace(/[<>:"/\\|?*]/g, '_');
    const downloadUrl = `/api/download.php?url=${encodeURIComponent(currentVideoData.musicUrl)}&filename=${encodeURIComponent(cleanFilename)}`;
    
    const a = document.createElement('a');
    a.href = downloadUrl;
    a.download = cleanFilename;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    
    showToast('Download started!', 'success');
}

if (elements.parseBtn) {
    elements.parseBtn.addEventListener('click', parseVideo);
}

if (elements.urlInput) {
    elements.urlInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            parseVideo();
        }
    });
}

if (elements.downloadVideoBtn) {
    elements.downloadVideoBtn.addEventListener('click', downloadVideo);
}

if (elements.downloadMusicBtn) {
    elements.downloadMusicBtn.addEventListener('click', downloadMusic);
}

// Menu functionality
const menuBtn = document.getElementById('menuBtn');
const mobileMenu = document.getElementById('mobileMenu');
const menuClose = document.getElementById('menuClose');
const menuOverlay = document.getElementById('menuOverlay');

function openMenu() {
    mobileMenu.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeMenu() {
    mobileMenu.classList.remove('active');
    document.body.style.overflow = '';
}

menuBtn.addEventListener('click', openMenu);
menuClose.addEventListener('click', closeMenu);
menuOverlay.addEventListener('click', closeMenu);

// Close menu when clicking on a link
document.querySelectorAll('.menu-list a').forEach(link => {
    link.addEventListener('click', (e) => {
        closeMenu();
        
        // Smooth scroll to section
        const href = link.getAttribute('href');
        if (href.startsWith('#')) {
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }
    });
});

// FAQ accordion functionality
document.querySelectorAll('.faq-question').forEach(button => {
    button.addEventListener('click', () => {
        const faqItem = button.parentElement;
        const isActive = faqItem.classList.contains('active');
        
        // Close all FAQ items
        document.querySelectorAll('.faq-item').forEach(item => {
            item.classList.remove('active');
        });
        
        // Toggle current item
        if (!isActive) {
            faqItem.classList.add('active');
        }
    });
});

// Language Switcher
const langBtn = document.getElementById('langBtn');
const langDropdown = document.getElementById('langDropdown');
const currentLangEl = document.getElementById('currentLang');
const langOptions = document.querySelectorAll('.lang-option');

const langCodes = {
    'en': 'EN',
    'vi': 'VI',
    'zh': 'ZH',
    'ko': 'KO',
    'ja': 'JA',
    'es': 'ES',
    'fr': 'FR',
    'de': 'DE',
    'ar': 'AR',
    'th': 'TH',
    'id': 'ID'
};

// Get supported languages from HTML data attribute (single source of truth from PHP)
const htmlEl = document.documentElement;
const supportedLangs = JSON.parse(htmlEl.getAttribute('data-supported-languages') || '["en"]');

// Get current language from URL path, query parameter (backward compat), localStorage, or default to English
const urlParams = new URLSearchParams(window.location.search);
const urlLang = urlParams.get('lang');
const pathMatch = window.location.pathname.match(/^\/([a-z]{2})(\/|$)/);
const pathLang = pathMatch ? pathMatch[1] : null;

// Priority: path > query parameter > localStorage > default
let currentLang = pathLang || urlLang || localStorage.getItem('preferredLang') || 'en';

// Validate language is supported
if (!supportedLangs.includes(currentLang)) {
    currentLang = 'en';
}

// Save to localStorage
if (pathLang || urlLang) {
    localStorage.setItem('preferredLang', currentLang);
}

// Initialize language on page load
function initLanguage() {
    currentLangEl.textContent = langCodes[currentLang] || 'EN';
    
    // Mark active language option
    langOptions.forEach(option => {
        if (option.getAttribute('data-lang') === currentLang) {
            option.classList.add('active');
        } else {
            option.classList.remove('active');
        }
    });
}

// Toggle language dropdown
function toggleLangDropdown() {
    langDropdown.classList.toggle('active');
}

function closeLangDropdown() {
    langDropdown.classList.remove('active');
}

// Change language
function changeLanguage(lang) {
    if (lang === currentLang) {
        closeLangDropdown();
        return;
    }
    
    currentLang = lang;
    localStorage.setItem('preferredLang', lang);
    
    // Build new URL with language path prefix
    let currentPath = window.location.pathname;
    const currentSearch = window.location.search;
    const currentHash = window.location.hash;
    
    // Remove existing language prefix from path
    currentPath = currentPath.replace(/^\/([a-z]{2})(\/|$)/, '/');
    
    // Add new language prefix (except for English)
    let newPath;
    if (lang === 'en') {
        newPath = currentPath;
    } else {
        // Remove leading slash and add language prefix
        currentPath = currentPath.replace(/^\//, '');
        newPath = '/' + lang + '/' + currentPath;
    }
    
    // Remove lang query parameter if it exists
    const searchParams = new URLSearchParams(currentSearch);
    searchParams.delete('lang');
    const newSearch = searchParams.toString() ? '?' + searchParams.toString() : '';
    
    // Navigate to new URL
    window.location.href = newPath + newSearch + currentHash;
}

// Event listeners
if (langBtn) {
    langBtn.addEventListener('click', toggleLangDropdown);
}

langOptions.forEach(option => {
    option.addEventListener('click', () => {
        const lang = option.getAttribute('data-lang');
        changeLanguage(lang);
    });
});

// Close dropdown when clicking outside
document.addEventListener('click', (e) => {
    if (!langBtn.contains(e.target) && !langDropdown.contains(e.target)) {
        closeLangDropdown();
    }
});

// Initialize language on page load
initLanguage();
