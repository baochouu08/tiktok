# Hướng Dẫn Tạo Translations Cho Các Platform & Ngôn Ngữ

## Cấu Trúc Thư Mục

Mỗi platform có 1 thư mục riêng:
```
public/includes/
├── translations_common/      # UI chung (buttons, labels, errors)
│   ├── en/common.php
│   ├── vi/common.php
│   └── zh/common.php
├── translations_tiktok/      # TikTok riêng (SEO, FAQ)
│   ├── en/common.php
│   ├── vi/common.php
│   └── zh/common.php (bạn tự làm)
├── translations_youtube/     # YouTube riêng
├── translations_facebook/    # Facebook riêng
└── ... (các platforms khác)
```

## Các Bước Tạo Translation Cho Ngôn Ngữ Mới

### Bước 1: Copy File Mẫu
Lấy file `translations_tiktok/vi/common.php` hoặc `translations_tiktok/en/common.php` làm mẫu.

### Bước 2: Tạo File Mới
Ví dụ cho Chinese (zh):
```bash
mkdir -p public/includes/translations_tiktok/zh
cp public/includes/translations_tiktok/vi/common.php public/includes/translations_tiktok/zh/common.php
```

### Bước 3: Dịch Nội Dung
Mở file mới và dịch các giá trị sang ngôn ngữ target. **Chỉ dịch phần bên phải dấu `=>`, không đổi key!**

**ĐÚNG:**
```php
'page_meta_title' => '下载TikTok视频无水印 2025 - 免费高清TikTok下载器',
```

**SAI:**
```php
'标题' => '下载TikTok视频无水印 2025',  // ❌ KHÔNG đổi key!
```

## Cấu Trúc File Translation

### 1. SEO Meta Tags (BẮT BUỘC - mỗi ngôn ngữ khác nhau)

```php
// ========================================
// SEO META TAGS (unique for each language)
// ========================================
'page_meta_title' => 'Your SEO Title (55-60 chars)',
'page_meta_description' => 'Your meta description (150-160 chars)',
'page_meta_keywords' => 'keyword1, keyword2, keyword3, ...',
```

**Lưu ý:**
- `page_meta_title`: 55-60 ký tự, có từ khóa chính
- `page_meta_description`: 150-160 ký tự, mô tả hấp dẫn
- `page_meta_keywords`: Các từ khóa cách nhau bởi dấu phẩy

### 2. Page Content

```php
// ========================================
// PAGE CONTENT
// ========================================
'page_title_tiktok' => 'Tiêu đề trang (dùng trong H1)',
'h1_tiktok' => 'Heading chính',
'subtitle_tiktok' => 'Mô tả ngắn',
'placeholder_tiktok' => 'Placeholder cho input',
```

### 3. Buttons & Actions

```php
// ========================================
// BUTTONS & ACTIONS
// ========================================
'download_button' => 'Tải Xuống',
'processing_video' => 'Đang xử lý...',
'download_video' => 'Tải Video',
'download_audio' => 'Tải Âm Thanh',
```

### 4. Features

```php
// ========================================
// FEATURES
// ========================================
'feature_no_watermark' => 'Không Có Logo',
'feature_no_watermark_desc' => 'Mô tả chi tiết tính năng',
```

### 5. SEO Content Sections

```php
// ========================================
// SEO CONTENT SECTIONS
// ========================================
'seo_main_title' => 'Tiêu đề SEO chính',
'seo_section_1_title' => 'Tiêu đề section 1',
'seo_section_1_p1' => 'Paragraph 1 của section 1',
'seo_section_1_p2' => 'Paragraph 2 của section 1',
```

### 6. FAQ Section

```php
// ========================================
// FAQ SECTION
// ========================================
'faq_title' => 'Câu Hỏi Thường Gặp - %s Downloader',
'faq_how_download' => 'Câu hỏi?',
'faq_how_download_ans' => 'Câu trả lời chi tiết.',
```

## Tạo Translation Cho Platform Mới

### Ví dụ: YouTube

1. **Tạo thư mục:**
```bash
mkdir -p public/includes/translations_youtube/{en,vi,zh}
```

2. **Copy và chỉnh sửa từ TikTok:**
```bash
cp public/includes/translations_tiktok/vi/common.php public/includes/translations_youtube/vi/common.php
```

3. **Sửa nội dung cho YouTube:**
   - Đổi `tiktok` → `youtube`
   - Đổi "TikTok" → "YouTube" trong tất cả texts
   - Cập nhật meta tags theo keywords của YouTube
   - Cập nhật FAQs cho YouTube-specific

4. **Update file PHP:**
```php
// download-youtube.php
$platform = 'youtube';
$pageTitle = pt('page_meta_title');
$metaDescription = pt('page_meta_description');
$metaKeywords = pt('page_meta_keywords');
```

## Checklist Khi Tạo Translation Mới

- [ ] File có đúng format PHP (`<?php return [ ... ];`)
- [ ] Tất cả keys giữ nguyên (không dịch keys)
- [ ] Meta title: 55-60 ký tự
- [ ] Meta description: 150-160 ký tự
- [ ] Keywords: Phù hợp với ngôn ngữ target
- [ ] Content SEO tự nhiên, không máy móc
- [ ] FAQ có ít nhất 5-7 câu hỏi
- [ ] Không có lỗi cú pháp PHP

## Test Translation Mới

```bash
# Test Vietnamese
curl -s "http://localhost:5000/download-tiktok.php?lang=vi" | grep "<title>"

# Test English
curl -s "http://localhost:5000/download-tiktok.php?lang=en" | grep "<title>"

# Test Chinese
curl -s "http://localhost:5000/download-tiktok.php?lang=zh" | grep "<title>"
```

## Các Ngôn Ngữ Cần Làm

### TikTok Platform
- [x] Vietnamese (vi) - ✅ Đã hoàn thành
- [x] English (en) - ✅ Đã hoàn thành
- [ ] Chinese (zh) - Bạn tự làm
- [ ] Spanish (es) - Bạn tự làm
- [ ] French (fr) - Bạn tự làm
- [ ] German (de) - Bạn tự làm
- [ ] Japanese (ja) - Bạn tự làm
- [ ] Korean (ko) - Bạn tự làm
- [ ] Portuguese (pt) - Bạn tự làm
- [ ] Russian (ru) - Bạn tự làm

### Các Platform Khác
Áp dụng tương tự cho:
- YouTube
- Facebook
- Instagram
- Twitter
- Douyin
- Bilibili
- Rednote
- Weverse

## Lưu Ý Quan Trọng

1. **Không cache**: Hệ thống không dùng cache nên translations sẽ update ngay lập tức
2. **Fallback to English**: Nếu ngôn ngữ không có file, sẽ tự động dùng English
3. **SEO Keywords**: Mỗi ngôn ngữ cần keywords riêng, không dịch máy
4. **Natural Language**: Nội dung phải tự nhiên như người bản xứ viết, không máy móc
5. **Platform-specific**: Mỗi platform có keywords và content riêng

## Ví Dụ Hoàn Chỉnh

Xem file mẫu:
- `public/includes/translations_tiktok/vi/common.php` (Tiếng Việt)
- `public/includes/translations_tiktok/en/common.php` (English)
