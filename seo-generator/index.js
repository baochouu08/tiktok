import { GoogleGenAI } from '@google/genai';
import { LANGUAGE_PROMPTS, PLATFORM_CONTEXTS } from './config/prompts.js';
import { writeFileSync, mkdirSync } from 'fs';
import { join } from 'path';

async function generateSEOContent(language, platform = 'general') {
  const apiKey = process.env.GEMINI_API_KEY;
  
  if (!apiKey) {
    throw new Error('GEMINI_API_KEY environment variable is required');
  }
  
  const ai = new GoogleGenAI({ apiKey });
  
  const langConfig = LANGUAGE_PROMPTS[language];
  if (!langConfig) {
    throw new Error(`Language ${language} not supported. Available: ${Object.keys(LANGUAGE_PROMPTS).join(', ')}`);
  }
  
  const tools = [
    {
      googleSearch: {}
    }
  ];
  
  const config = {
    thinkingConfig: {
      thinkingBudget: -1,
    },
    tools,
  };
  
  const model = 'gemini-2.5-pro';
  
  const platformContext = platform !== 'general' && PLATFORM_CONTEXTS[platform] 
    ? `\n\nSpecific platform focus: ${PLATFORM_CONTEXTS[platform][language] || PLATFORM_CONTEXTS[platform]['en']}`
    : '';
  
  const fullPrompt = `${langConfig.prompt}${platformContext}

First, search for: "${langConfig.searchQuery}"

Then generate complete SEO content based on your research findings.`;
  
  const contents = [
    {
      role: 'user',
      parts: [
        {
          text: fullPrompt,
        },
      ],
    },
  ];
  
  console.log(`\n🚀 Generating SEO content for ${langConfig.name} (${language})...`);
  console.log(`🔍 Platform: ${platform}`);
  console.log(`📊 Using Gemini 2.5 Pro with Google Search\n`);
  
  const response = await ai.models.generateContentStream({
    model,
    config,
    contents,
  });
  
  let fullContent = '';
  
  for await (const chunk of response) {
    const text = chunk.text || '';
    process.stdout.write(text);
    fullContent += text;
  }
  
  try {
    mkdirSync(join('seo-generator', 'output', language), { recursive: true });
  } catch (err) {
    // Directory already exists
  }
  
  const filename = platform !== 'general' 
    ? `${platform}_${language}_${Date.now()}.md`
    : `general_${language}_${Date.now()}.md`;
  
  const outputPath = join('seo-generator', 'output', language, filename);
  writeFileSync(outputPath, fullContent, 'utf-8');
  
  console.log(`\n\n✅ Content saved to: ${outputPath}\n`);
  
  return {
    language,
    platform,
    content: fullContent,
    outputPath
  };
}

async function generateMultiLanguage(platforms = ['general'], languages = ['en', 'vi', 'zh']) {
  console.log('🌍 Multi-Language SEO Content Generator');
  console.log('=' .repeat(50));
  
  const results = [];
  
  for (const language of languages) {
    for (const platform of platforms) {
      try {
        const result = await generateSEOContent(language, platform);
        results.push(result);
        
        console.log('⏳ Waiting 2 seconds before next generation...\n');
        await new Promise(resolve => setTimeout(resolve, 2000));
      } catch (error) {
        console.error(`❌ Error generating ${language} content for ${platform}:`, error.message);
      }
    }
  }
  
  console.log('\n🎉 All content generated successfully!');
  console.log(`📁 Total files: ${results.length}`);
  
  return results;
}

const args = process.argv.slice(2);
const language = args[0] || 'en';
const platform = args[1] || 'general';

if (args.includes('--all')) {
  const languages = Object.keys(LANGUAGE_PROMPTS);
  const platforms = ['tiktok', 'instagram', 'youtube'];
  generateMultiLanguage(platforms, languages);
} else if (args.includes('--multi')) {
  const languages = ['en', 'vi', 'zh', 'es', 'fr'];
  const platforms = ['tiktok', 'instagram', 'youtube'];
  generateMultiLanguage(platforms, languages);
} else {
  generateSEOContent(language, platform);
}
