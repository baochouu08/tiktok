# 🌍 Multi-Language SEO Content Generator with Gemini AI

Hệ thống tạo nội dung SEO đa ngôn ngữ tự động sử dụng Gemini 2.5 Pro với tính năng tìm kiếm Google Search tích hợp.

## ✨ Tính năng chính

- 🔍 **Tìm kiếm từ khóa tự động** với Google Search
- 🌐 **10 ngôn ngữ phổ biến**: EN, VI, ZH, ES, FR, DE, JA, KO, PT, RU
- 📝 **Nội dung như người bản địa** - không robot, không dịch máy
- 🎯 **SEO 100%**: Từ khóa ngắn + dài phân bố đều
- 🚀 **Gemini 2.5 Pro** với thinking mode không giới hạn

## 🚀 Cách sử dụng

### 1. Thiết lập API Key

```bash
export GEMINI_API_KEY="your-gemini-api-key-here"
```

### 2. Chạy lệnh tạo nội dung

#### Tạo nội dung cho 1 ngôn ngữ + 1 platform:
```bash
npm run seo <language> <platform>

# Ví dụ:
npm run seo vi tiktok        # Tiếng Việt cho TikTok
npm run seo en youtube        # English cho YouTube
npm run seo zh instagram      # 中文 cho Instagram
```

#### Tạo nội dung cho nhiều ngôn ngữ (5 ngôn ngữ phổ biến):
```bash
npm run seo:multi
# Tạo: EN, VI, ZH, ES, FR cho TikTok, Instagram, YouTube
```

#### Tạo tất cả ngôn ngữ + tất cả platform:
```bash
npm run seo:all
# Tạo: 10 ngôn ngữ × 3 platforms = 30 files
```

#### Chạy version đơn giản:
```bash
npm run seo:simple
# hoặc với custom prompt:
npm run seo:simple "your custom prompt here"
```

## 🌍 Ngôn ngữ được hỗ trợ

| Code | Ngôn ngữ | Native Name |
|------|----------|-------------|
| `en` | English | English |
| `vi` | Vietnamese | Tiếng Việt |
| `zh` | Chinese | 中文 |
| `es` | Spanish | Español |
| `fr` | French | Français |
| `de` | German | Deutsch |
| `ja` | Japanese | 日本語 |
| `ko` | Korean | 한국어 |
| `pt` | Portuguese | Português |
| `ru` | Russian | Русский |

## 📱 Platforms được hỗ trợ

- `tiktok` - TikTok video downloader
- `instagram` - Instagram downloader
- `youtube` - YouTube downloader
- `general` - General multi-platform

## 📋 Cấu trúc nội dung được tạo

Mỗi file được tạo sẽ bao gồm:

1. **Keywords Research**
   - Short-tail keywords (1-2 từ)
   - Long-tail keywords (3-5 từ)
   - LSI keywords & semantic keywords

2. **SEO Meta Tags**
   - Page Title (55-60 chars)
   - Meta Description (150-160 chars)
   - H1 Heading (khác với title)

3. **Content Structure**
   - Introduction paragraph (100-150 words)
   - Main sections với H2/H3 headings
   - FAQ section (5-7 questions)
   - Conclusion với Call-to-Action

## 🎯 Đặc điểm Prompt chuyên nghiệp

### ✅ Nội dung NATIVE - KHÔNG ROBOT

- **Tiếng Việt**: Tự nhiên, đời thường, gần gũi
- **English**: Conversational, engaging, American style
- **中文**: 自然流畅，不生硬
- **Español**: Natural, coloquial, internacional
- **Français**: Naturel, conversationnel
- **Deutsch**: Natürlich, gesprächig
- **日本語**: 自然で読みやすい
- **한국어**: 자연스럽고 읽기 쉬운
- **Português**: Natural, brasileiro
- **Русский**: Естественный, разговорный

### 🔍 Keyword Research tự động

Gemini sẽ tự động:
1. Tìm kiếm trending keywords 2025
2. Phân tích user search intent
3. Tìm long-tail + short-tail keywords
4. Phân bố keywords đều khắp nội dung (1-2% density)

### 📊 SEO Optimization 100%

- Title tag có primary keyword
- Meta description actionable
- H1 khác title, có keyword
- H2/H3 có secondary keywords
- First paragraph có keyword trong 100 từ đầu
- Internal linking opportunities
- CTA phrases rõ ràng

## 📂 Output Structure

```
seo-generator/
├── output/
│   ├── en/
│   │   ├── tiktok_en_1234567890.md
│   │   ├── instagram_en_1234567890.md
│   │   └── youtube_en_1234567890.md
│   ├── vi/
│   │   ├── tiktok_vi_1234567890.md
│   │   └── ...
│   ├── zh/
│   └── ...
├── config/
│   └── prompts.js
├── index.js
├── generate.js
└── README.md
```

## 🔧 Cấu hình nâng cao

### Tùy chỉnh Prompt

Edit file `seo-generator/config/prompts.js`:

```javascript
export const LANGUAGE_PROMPTS = {
  en: {
    name: 'English',
    searchQuery: 'your custom search query',
    prompt: `Your custom prompt here...`
  },
  // ...
};
```

### Thêm Platform mới

Edit file `seo-generator/config/prompts.js`:

```javascript
export const PLATFORM_CONTEXTS = {
  yourplatform: {
    en: 'Your Platform - description',
    vi: 'Platform của bạn - mô tả',
    // ...
  }
};
```

## 💡 Tips & Best Practices

1. **Keyword Density**: Giữ ở 1-2%, không quá 3%
2. **Content Length**: 800-1500 từ cho trang chính
3. **Headings**: H1 (1 cái), H2 (3-5 cái), H3 (5-10 cái)
4. **FAQ**: 5-7 câu hỏi người dùng thực sự tìm kiếm
5. **CTA**: Rõ ràng, hấp dẫn, ở nhiều vị trí

## 🚨 Lưu ý quan trọng

- Cần `GEMINI_API_KEY` để chạy
- Gemini 2.5 Pro có thinking budget unlimited (-1)
- Google Search tích hợp để tìm keywords real-time
- Mỗi lần chạy tốn ~2-5 phút/ngôn ngữ
- Output lưu với timestamp để không bị ghi đè

## 📝 Example Usage

```bash
# Tạo tiếng Việt cho TikTok
npm run seo vi tiktok

# Tạo English cho Instagram  
npm run seo en instagram

# Tạo 中文 cho YouTube
npm run seo zh youtube

# Tạo 5 ngôn ngữ phổ biến
npm run seo:multi

# Tạo tất cả
npm run seo:all
```

## 🎉 Kết quả mong đợi

Sau khi chạy, bạn sẽ có:

✅ Nội dung SEO hoàn chỉnh
✅ Keywords research đầy đủ  
✅ Meta tags tối ưu
✅ Content structure chuẩn
✅ FAQ section hữu ích
✅ Native tone - không robot

## 🔗 Resources

- [Gemini AI Documentation](https://ai.google.dev/)
- [SEO Best Practices 2025](https://developers.google.com/search/docs)
- [Keyword Research Guide](https://ahrefs.com/keyword-research)

---

Made with ❤️ using Gemini 2.5 Pro
