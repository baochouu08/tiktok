
<?php
require_once 'includes/platform-config.php';
require_once 'includes/languages.php';
require_once 'includes/blog-data.php';

$currentLang = getCurrentLanguage();
$blogPosts = getTranslatedBlogPosts($currentLang);

$pageTitle = pt('blog_meta_title');
$metaDescription = pt('blog_meta_description');
$metaKeywords = pt('blog_meta_keywords');

// Build canonical URL
if ($currentLang === 'en') {
    $canonicalUrl = getBaseUrl() . '/blog';
} else {
    $canonicalUrl = getBaseUrl() . '/' . $currentLang . '/blog';
}

include 'includes/header.php';
?>

<div class="hero-section">
    <h1 class="hero-title"><?php echo pt('blog_hero_title'); ?></h1>
    <p class="hero-subtitle"><?php echo pt('blog_hero_subtitle'); ?></p>
</div>

<style>
.hero-section {
    text-align: center;
    margin-bottom: 30px;
}

.hero-title {
    font-size: 32px;
    font-weight: 700;
    color: #171A26;
    margin-bottom: 12px;
    line-height: 1.3;
}

.hero-subtitle {
    font-size: 16px;
    color: #171A26;
    opacity: 0.8;
    line-height: 1.6;
}

.blog-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 24px;
    margin: 40px 0;
}

.blog-card {
    background: #FFFFFF;
    border: 1px solid #E5E7EB;
    border-radius: 12px;
    overflow: hidden;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.blog-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
    border-color: #1C8576;
}

.blog-featured-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    background: linear-gradient(135deg, #1C8576 0%, #15685E 100%);
}

.blog-card-content {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.blog-tags {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin-bottom: 12px;
}

.blog-tag {
    display: inline-block;
    background: #F3F4F6;
    color: #374151;
    font-size: 11px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 6px;
    text-transform: capitalize;
}

.blog-card h2 {
    font-size: 19px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 12px 0;
    line-height: 1.4;
    flex: 1;
}

.blog-card p {
    font-size: 14px;
    color: #6B7280;
    line-height: 1.6;
    margin-bottom: 16px;
}

.blog-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 16px;
    border-top: 1px solid #E5E7EB;
}

.blog-authors {
    display: flex;
    align-items: center;
    gap: 4px;
}

.blog-avatar {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1C8576 0%, #15685E 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    border: 2px solid white;
    margin-left: -8px;
}

.blog-avatar:first-child {
    margin-left: 0;
}

.blog-date {
    font-size: 13px;
    color: #9CA3AF;
    display: flex;
    align-items: center;
    gap: 4px;
}

@media (max-width: 768px) {
    .hero-section {
        margin-bottom: 20px;
        padding: 0 15px;
    }
    
    .hero-title {
        font-size: 24px;
        margin-bottom: 10px;
    }
    
    .hero-subtitle {
        font-size: 14px;
    }
    
    .blog-grid {
        grid-template-columns: 1fr;
        gap: 20px;
        margin: 20px 0;
        padding: 0 15px;
    }
    
    .blog-featured-image {
        height: 180px;
    }
    
    .blog-card h2 {
        font-size: 17px;
    }
    
    .blog-card-content {
        padding: 15px;
    }
    
    .blog-meta {
        font-size: 12px;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 20px;
    }
    
    .hero-subtitle {
        font-size: 13px;
    }
    
    .blog-grid {
        grid-template-columns: 1fr;
        gap: 15px;
        margin: 15px 0;
        padding: 0 12px;
    }
    
    .blog-card h2 {
        font-size: 16px;
    }
    
    .blog-tag {
        font-size: 10px;
        padding: 3px 8px;
    }
}
</style>

<div class="blog-grid">
    <?php foreach ($blogPosts as $post): ?>
    <a href="<?php echo getUrlWithLang('/blog/' . $post['slug'] . '.php'); ?>" class="blog-card">
        <img src="<?php echo $post['featured_image']; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="blog-featured-image" loading="lazy">
        
        <div class="blog-card-content">
            <div class="blog-tags">
                <?php foreach (array_slice($post['tags'], 0, 3) as $tag): ?>
                <span class="blog-tag"><?php echo $tag; ?></span>
                <?php endforeach; ?>
            </div>
            
            <h2><?php echo htmlspecialchars($post['title']); ?></h2>
            <p><?php echo htmlspecialchars($post['excerpt']); ?></p>
            
            <div class="blog-meta">
                <div class="blog-authors">
                    <?php foreach ($post['authors'] as $author): ?>
                    <div class="blog-avatar" title="<?php echo htmlspecialchars($author['name']); ?>">
                        <?php echo $author['avatar']; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="blog-date">
                    <span>📅</span>
                    <span><?php echo date('M d, Y', strtotime($post['date'])); ?></span>
                </div>
            </div>
        </div>
    </a>
    <?php endforeach; ?>
</div>

<div style="background: #F9FAFB; padding: 40px; border-radius: 12px; margin: 60px 0; text-align: center; border: 1px solid #E5E7EB;">
    <h3 style="margin-bottom: 20px; color: #111827; font-size: 20px; font-weight: 600;"><?php echo pt('blog_popular_tools'); ?></h3>
    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
        <a href="<?php echo getUrlWithLang('/download-tiktok'); ?>" style="color: #1C8576; text-decoration: none; font-weight: 600; padding: 8px 16px; border: 1px solid #C8ECE8; border-radius: 8px; background: white; transition: all 0.3s;">TikTok Downloader</a>
        <a href="<?php echo getUrlWithLang('/download-instagram'); ?>" style="color: #1C8576; text-decoration: none; font-weight: 600; padding: 8px 16px; border: 1px solid #C8ECE8; border-radius: 8px; background: white; transition: all 0.3s;">Instagram Downloader</a>
        <a href="<?php echo getUrlWithLang('/download-youtube'); ?>" style="color: #1C8576; text-decoration: none; font-weight: 600; padding: 8px 16px; border: 1px solid #C8ECE8; border-radius: 8px; background: white; transition: all 0.3s;">YouTube Downloader</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
