<?php

function getBlogPosts() {
    return [
        [
            'slug' => 'best-tiktok-downloader-2025',
            'title_key' => 'blog_post_1_title',
            'excerpt_key' => 'blog_post_1_excerpt',
            'category' => 'TikTok',
            'tags' => ['TikTok', 'Comparison', 'Tools'],
            'featured_image' => '/assets/images/blog/tiktok-downloader-2025.jpg',
            'date' => '2025-11-21',
            'read_time' => 8,
            'authors' => [
                ['name' => 'Sarah Chen', 'avatar' => '👩‍💻'],
                ['name' => 'Mike Johnson', 'avatar' => '👨‍💼']
            ]
        ],
        [
            'slug' => 'download-tiktok-without-watermark',
            'title_key' => 'blog_post_2_title',
            'excerpt_key' => 'blog_post_2_excerpt',
            'category' => 'Tutorial',
            'tags' => ['TikTok', 'Tutorial', 'No Watermark'],
            'featured_image' => '/assets/images/blog/tiktok-no-watermark.jpg',
            'date' => '2025-11-20',
            'read_time' => 5,
            'authors' => [
                ['name' => 'Emma Wilson', 'avatar' => '👩‍🎨']
            ]
        ],
        [
            'slug' => 'instagram-reels-vs-tiktok-2025',
            'title_key' => 'blog_post_3_title',
            'excerpt_key' => 'blog_post_3_excerpt',
            'category' => 'Comparison',
            'tags' => ['Instagram', 'TikTok', 'Comparison'],
            'featured_image' => '/assets/images/blog/reels-vs-tiktok.jpg',
            'date' => '2025-11-18',
            'read_time' => 10,
            'authors' => [
                ['name' => 'David Lee', 'avatar' => '👨‍🎤']
            ]
        ],
        [
            'slug' => 'top-10-video-downloaders-2025',
            'title_key' => 'blog_post_4_title',
            'excerpt_key' => 'blog_post_4_excerpt',
            'category' => 'Reviews',
            'tags' => ['Reviews', 'Comparison', 'Tools'],
            'featured_image' => '/assets/images/blog/top-downloaders-2025.jpg',
            'date' => '2025-11-15',
            'read_time' => 15,
            'authors' => [
                ['name' => 'Lisa Park', 'avatar' => '👩‍💼'],
                ['name' => 'Tom Anderson', 'avatar' => '👨‍💻']
            ]
        ],
    ];
}

function getTranslatedBlogPosts($lang = 'en') {
    $posts = getBlogPosts();
    $translatedPosts = [];
    
    foreach ($posts as $post) {
        $translatedPost = $post;
        $translatedPost['title'] = pt($post['title_key'], $lang);
        $translatedPost['excerpt'] = pt($post['excerpt_key'], $lang);
        $translatedPosts[] = $translatedPost;
    }
    
    return $translatedPosts;
}
