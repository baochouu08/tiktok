import { GoogleGenAI } from '@google/genai';

async function main() {
  const ai = new GoogleGenAI({
    apiKey: process.env.GEMINI_API_KEY,
  });
  
  const tools = [
    {
      googleSearch: {}
    },
  ];
  
  const config = {
    thinkingConfig: {
      thinkingBudget: -1,
    },
    tools,
  };
  
  const model = 'gemini-2.5-pro';
  
  const INPUT_PROMPT = process.argv[2] || `You are a professional native English SEO content writer with expertise in digital marketing.

Task: Create highly optimized, engaging SEO content for a video downloader platform.

Research Phase:
1. Search for trending SEO keywords related to "video downloader" for 2025
2. Find long-tail keywords (3-5 words) and short keywords (1-2 words)
3. Identify user search intent and popular search queries

Content Requirements:
- Write like a native speaker - NOT robotic or overly formal
- Use natural, conversational tone
- Include emotional triggers and persuasive language
- Distribute keywords naturally (keyword density 1-2%)
- Include both short-tail and long-tail keywords evenly

SEO Optimization:
- Title: Include primary keyword, make it compelling (55-60 chars)
- Meta Description: Actionable, benefit-driven (150-160 chars)
- H1: Different from title, include primary keyword
- Content structure: Problem → Solution → Benefits → How-to → FAQ

Output Format:
1. Keywords List (separate short-tail and long-tail)
2. Page Title
3. Meta Description
4. H1 Heading
5. Introduction Paragraph (100-150 words)
6. Main Content Sections with H2/H3 headings
7. FAQ section (5-7 questions)
8. Conclusion with CTA

Platform: Multi-platform video downloader supporting TikTok, Instagram, YouTube, Facebook, Twitter, Bilibili, Douyin, Rednote, Weverse`;
  
  const contents = [
    {
      role: 'user',
      parts: [
        {
          text: INPUT_PROMPT,
        },
      ],
    },
  ];
  
  console.log('🚀 Starting SEO Content Generation with Gemini 2.5 Pro...\n');
  console.log('🔍 Using Google Search for keyword research\n');
  console.log('=' .repeat(80) + '\n');
  
  const response = await ai.models.generateContentStream({
    model,
    config,
    contents,
  });
  
  for await (const chunk of response) {
    process.stdout.write(chunk.text || '');
  }
  
  console.log('\n\n' + '=' .repeat(80));
  console.log('✅ Content generation completed!\n');
}

main().catch(console.error);
