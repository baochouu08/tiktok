#!/bin/bash

echo "🌍 Multi-Language SEO Content Generator"
echo "========================================"
echo ""

if [ -z "$GEMINI_API_KEY" ]; then
    echo "⚠️  GEMINI_API_KEY not found!"
    echo ""
    echo "Please set your Gemini API key:"
    echo "export GEMINI_API_KEY='your-api-key-here'"
    echo ""
    exit 1
fi

echo "✅ GEMINI_API_KEY is set"
echo ""

echo "Choose an option:"
echo "1. Generate Vietnamese for TikTok"
echo "2. Generate English for Instagram"
echo "3. Generate Chinese for YouTube"
echo "4. Generate 5 popular languages (EN, VI, ZH, ES, FR)"
echo "5. Generate ALL languages and platforms"
echo "6. Custom language and platform"
echo ""

read -p "Enter your choice (1-6): " choice

case $choice in
    1)
        echo "🚀 Generating Vietnamese for TikTok..."
        npm run seo vi tiktok
        ;;
    2)
        echo "🚀 Generating English for Instagram..."
        npm run seo en instagram
        ;;
    3)
        echo "🚀 Generating Chinese for YouTube..."
        npm run seo zh youtube
        ;;
    4)
        echo "🚀 Generating 5 popular languages..."
        npm run seo:multi
        ;;
    5)
        echo "🚀 Generating ALL content (this may take 30-60 minutes)..."
        npm run seo:all
        ;;
    6)
        read -p "Enter language code (en/vi/zh/es/fr/de/ja/ko/pt/ru): " lang
        read -p "Enter platform (tiktok/instagram/youtube/general): " platform
        echo "🚀 Generating $lang for $platform..."
        npm run seo $lang $platform
        ;;
    *)
        echo "❌ Invalid choice"
        exit 1
        ;;
esac

echo ""
echo "✅ Generation complete!"
echo "📁 Check output in: seo-generator/output/"
