# GreenVideo - Multi-Platform Video Downloader

## Overview

A modern multi-platform web application for downloading videos from major social media platforms including TikTok, Instagram, YouTube, Twitter/X, Facebook, Douyin, Bilibili, Rednote, and Weverse. Each platform has its own dedicated page with unique SEO optimization.

**Core Purpose**: Provide a comprehensive, SEO-optimized web interface for downloading videos from multiple social platforms with professional design and robust backend processing.

**Latest Update (Nov 22, 2025)**: 
- Migrated from query parameter (?lang=vi) to path-based URL structure (/vi/, /es/, etc.)
- Implemented single source of truth for supported languages (getSupportedLanguages())
- Created router.php for PHP built-in server to handle URL rewriting with arbitrary path depth
- Dynamic language dropdown generation from centralized language metadata
- All components (PHP backend, JavaScript, UI) synchronized from single configuration

**Previous Update (Nov 18, 2025)**: 
- Implemented multilingual SEO system with separate translations for each platform and language
- Each platform page now has unique meta tags (title, description, keywords) per language
- Clean separation: translations_common/ for shared UI, translations_{platform}/ for platform-specific SEO

**Previous Update (Oct 4, 2025)**: 
- Expanded from single TikTok downloader to multi-platform service with individual SEO-optimized pages for each platform
- Added AI-powered SEO Content Generator supporting 10 languages with native-quality output

## User Preferences

Preferred communication style: Simple, everyday language (Vietnamese/English).

## System Architecture

### Application Type
- **Web Application**: Multi-platform PHP/HTML/CSS/JS solution
- **Architecture**: MVC-inspired structure with separated concerns and reusable components
- **Deployment**: PHP built-in server for development (production-ready with proper web server)

### Directory Structure
```
router.php        # URL rewriter for PHP built-in server

public/           # Web root
├── index.php     # Homepage with platform selector
├── download-*.php # Individual platform pages (9 pages)
├── includes/     # Shared components
│   ├── header.php        # Shared header with dynamic language dropdown
│   ├── footer.php        # Shared footer with links
│   ├── languages.php     # Single source of truth for languages
│   ├── platform-config.php # Platform configurations
│   ├── TRANSLATION_GUIDE.md # Guide for creating translations
│   ├── translations_common/  # Common UI translations
│   │   ├── en/common.php
│   │   ├── vi/common.php
│   │   └── zh/common.php
│   ├── translations_tiktok/  # TikTok-specific SEO
│   │   ├── en/common.php
│   │   ├── vi/common.php
│   │   └── zh/common.php (to be added)
│   ├── translations_youtube/ # YouTube-specific SEO
│   ├── translations_facebook/ # Facebook-specific SEO
│   └── ... (other platforms)
├── api/          # API endpoints
│   ├── parse.php     # Video info extraction
│   └── download.php  # Secure file proxy
├── assets/       # Static resources
│   ├── css/      # Stylesheets
│   └── js/       # Client-side scripts
├── sitemap.xml   # SEO sitemap
└── robots.txt    # Search engine directives

src/              # Backend logic
├── TikwmClient.php   # API integration
└── Validation.php    # Input validation

downloads/        # Video storage (gitignored)

seo-generator/    # AI SEO Content Generator (New!)
├── config/
│   └── prompts.js        # Multi-language prompts for 10 languages
├── output/               # Generated SEO content (gitignored)
├── index.js              # Main generator with platform support
├── generate.js           # Simple generator
├── quick-start.sh        # Interactive CLI
└── README.md             # Full documentation
```

### Platform Pages (SEO Optimized)

Each platform has its own dedicated page with unique SEO:

1. **TikTok** (`/download-tiktok.php`)
   - Title: "Download TikTok Videos Without Watermark - TikTok Video Downloader HD"
   - Features: No watermark, HD quality, audio extraction
   - Schema: HowTo + FAQPage

2. **Instagram** (`/download-instagram.php`)
   - Title: "Download Instagram Videos, Photos & Reels - Instagram Downloader Free"
   - Features: Reels, Stories, IGTV, Photos
   - Schema: HowTo + FAQPage

3. **YouTube** (`/download-youtube.php`)
   - Title: "Download YouTube Videos MP4 - Free YouTube Video Downloader"
   - Features: 4K, HD, MP3 conversion
   - Schema: HowTo + FAQPage

4. **Twitter/X** (`/download-twitter.php`)
   - Title: "Download Twitter Videos - X Video Downloader Free"
   - Features: Videos and GIFs
   - Schema: HowTo + FAQPage

5. **Facebook** (`/download-facebook.php`)
   - Title: "Download Facebook Videos - Facebook Video Downloader HD"
   - Features: Reels, Stories, Videos
   - Schema: HowTo + FAQPage

6. **Douyin** (`/download-douyin.php`)
   - Title: "Download Douyin Videos Without Watermark - Douyin Video Downloader"
   - Features: Chinese TikTok support, no watermark
   - Schema: HowTo + FAQPage

7. **Bilibili** (`/download-bilibili.php`)
   - Title: "Download Bilibili Videos - B Station Video Downloader Free"
   - Features: HD quality, anime support
   - Schema: HowTo + FAQPage

8. **Rednote** (`/download-rednote.php`)
   - Title: "Download Rednote Videos & Photos - Xiaohongshu Downloader Free"
   - Features: Xiaohongshu videos and photos
   - Schema: HowTo + FAQPage

9. **Weverse** (`/download-weverse.php`)
   - Title: "Download Weverse Videos & Media - Weverse Content Downloader"
   - Features: K-pop artist content
   - Schema: HowTo + FAQPage

### SEO Implementation

#### Multilingual SEO System (NEW)
Each platform page supports multiple languages with unique SEO meta tags:
- **Language-Specific Meta Tags**: Each language has its own title, description, keywords
- **Translation Structure**: 
  - `translations_common/` - Shared UI elements (buttons, labels, errors)
  - `translations_{platform}/` - Platform-specific SEO content per language
- **No Caching**: Translations load fresh per request to ensure accuracy
- **Fallback System**: Missing languages automatically fallback to English
- **Supported Languages**: en, vi, zh (more can be added following TRANSLATION_GUIDE.md)

Example structure:
```
translations_tiktok/
├── en/common.php  # English SEO: title, description, keywords, content
├── vi/common.php  # Vietnamese SEO: tiêu đề, mô tả, từ khóa riêng
└── zh/common.php  # Chinese SEO (to be added)
```

#### Per-Page Optimization
Each platform page includes:
- **Unique Title Tags**: Platform-specific, keyword-optimized, per language
- **Unique Meta Descriptions**: Highlighting platform-specific features, per language
- **Unique Meta Keywords**: Long-tail keywords optimized for each language
- **Unique H1/H2 Headers**: Natural language, keyword-rich
- **Unique Content**: Platform-specific instructions, FAQs, features
- **Canonical URLs**: Self-referencing to avoid duplicate content
- **Schema Markup**: HowTo and FAQPage structured data
- **Platform-specific Keywords**: Long-tail keyword targeting

#### Shared Components (Brand Consistency)
- Logo and header design
- Navigation menu with all platforms
- Footer with quick links
- Color scheme and styling
- Call-to-action buttons

#### SEO Files
- **sitemap.xml**: All pages indexed with priority levels
- **robots.txt**: Proper crawl directives, API exclusion

### Frontend Architecture

#### Design System
- **Inspired by**: GreenVideo commercial design
- **Color Scheme**: 
  - Primary: #00D566 (Green)
  - Platform-specific accent colors (configurable per platform)
- **Typography**: System fonts (-apple-system, Roboto, sans-serif)
- **Responsive**: Mobile-first design with breakpoints

#### Key Components
1. **Homepage**: Platform grid selector
2. **Platform Pages**: Search interface, results, FAQs
3. **Shared Header**: Logo, navigation
4. **Shared Footer**: Multi-column with links
5. **Platform Config**: Centralized configuration system

### Backend Architecture

#### Platform Configuration System
- Centralized config in `platform-config.php`
- Each platform has:
  - Name, icon, color theme
  - SEO metadata (title, description, keywords)
  - FAQ items (unique per platform)
  - How-to instructions
  - Schema markup generation

#### API Endpoints

**POST /api/parse.php**
- Accepts: `{"url": "video_url", "platform": "platform_name"}`
- Returns: Video metadata (id, title, author, stats, download URLs)
- Validation: Platform-aware URL pattern matching
- Error handling: JSON error responses with HTTP status codes

**GET /api/download.php**
- Params: `url` (CDN link), `filename` (sanitized)
- Returns: Video/audio file stream
- Security: Domain whitelist, filename sanitization
- Content-Type: Auto-detection (mp4/mp3)

### JavaScript Enhancements

#### Multi-Platform Support
- Dynamic platform detection via `data-platform` attribute
- Conditional element display (stats, audio buttons)
- Platform-aware error messages
- Shared menu and FAQ functionality

### SEO Strategy

#### Long-tail Keyword Targeting
Each page targets specific keyword variations:
- TikTok: "download tiktok without watermark", "tiktok video downloader hd"
- Instagram: "download instagram reels", "instagram photo downloader"
- YouTube: "youtube to mp4", "download youtube 4k"
- And more platform-specific variations

#### Content Uniqueness
- No duplicate content across pages
- Platform-specific FAQs
- Unique feature descriptions
- Tailored user instructions

#### Technical SEO
- Proper heading hierarchy (H1 > H2)
- Semantic HTML structure
- Fast page load times
- Mobile-responsive design
- Schema.org structured data

## AI SEO Content Generator

### Overview
Multi-language SEO content generator powered by Gemini 2.5 Pro with integrated Google Search for keyword research.

### Supported Languages (10)
- **English** (en) - American style
- **Tiếng Việt** (vi) - Vietnamese native
- **中文** (zh) - Simplified Chinese
- **Español** (es) - International Spanish
- **Français** (fr) - International French
- **Deutsch** (de) - German
- **日本語** (ja) - Japanese
- **한국어** (ko) - Korean
- **Português** (pt) - Brazilian Portuguese
- **Русский** (ru) - Russian

### Key Features
- 🔍 **Automatic Keyword Research** with Google Search integration
- 🌐 **Native-Quality Content** - no robotic/translated text
- 🎯 **SEO Optimization 100%** - Title, Meta, H1-H3, FAQ structure
- 📊 **Long-tail + Short-tail Keywords** evenly distributed
- 🚀 **Gemini 2.5 Pro** with unlimited thinking budget

### Usage Commands
```bash
# Single language + platform
npm run seo vi tiktok           # Vietnamese for TikTok
npm run seo en instagram        # English for Instagram
npm run seo zh youtube          # Chinese for YouTube

# Multiple popular languages
npm run seo:multi               # EN, VI, ZH, ES, FR

# All languages and platforms
npm run seo:all                 # 10 languages × 3 platforms

# Interactive mode
./seo-generator/quick-start.sh

# Simple version
npm run seo:simple "your custom prompt"
```

### Content Output Structure
1. Keywords List (short-tail + long-tail)
2. Page Title (55-60 chars)
3. Meta Description (150-160 chars)
4. H1 Heading
5. Introduction Paragraph (100-150 words)
6. Main Content Sections (H2/H3)
7. FAQ Section (5-7 questions)
8. Conclusion with CTA

### Technical Stack
- **AI Model**: Gemini 2.5 Pro (gemini-2.5-pro)
- **Search**: Google Search integration
- **Runtime**: Node.js 20 with ES Modules
- **Output**: Markdown files with timestamp
- **API**: GEMINI_API_KEY (configured in Replit Secrets)

## External Dependencies

#### Third-Party APIs
- **TikWM API** (https://www.tikwm.com/api/)
  - Currently supports TikTok/Douyin
  - Will need additional APIs for other platforms

#### Backend (PHP 8.2+)
- **cURL**: HTTP client for API requests
- **JSON**: Native PHP JSON handling
- **Regex**: URL pattern matching

#### Frontend (Vanilla JS)
- **Fetch API**: AJAX requests
- **DOM Manipulation**: Dynamic UI updates

## Production Considerations

### SEO Checklist
- ✅ Unique title tags per page
- ✅ Unique meta descriptions per page
- ✅ Canonical URLs configured
- ✅ Schema markup (HowTo + FAQPage)
- ✅ Sitemap.xml created
- ✅ Robots.txt configured
- ✅ Mobile-responsive design
- ✅ Fast page load times

### Security Checklist
- ✅ SSRF protection via domain whitelist
- ✅ Input sanitization and validation
- ✅ Safe filename handling
- ✅ CORS properly configured
- ✅ SSL verification enabled
- ✅ No sensitive data logging

### Deployment Notes
- Use production web server (Apache/Nginx)
- Configure proper CORS for production domain
- Set up rate limiting for API endpoints
- Implement platform-specific API integrations
- Add Google Analytics / Search Console
- Submit sitemap to search engines
- Monitor SEO performance per platform

### Future Enhancements
- Implement actual API integrations for all platforms
- Add quality selection (HD/SD/4K)
- Batch download support
- Download history
- User accounts and favorites
- Admin dashboard
- API rate limiting
- Redis caching for API responses
- A/B testing for conversion optimization
