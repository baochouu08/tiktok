</main>

        <footer>
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="<?php echo getUrlWithLang('/'); ?>">Home</a></li>
                        <li><a href="<?php echo getUrlWithLang('/download-tiktok'); ?>">TikTok</a></li>
                        <li><a href="<?php echo getUrlWithLang('/download-instagram'); ?>">Instagram</a></li>
                        <li><a href="<?php echo getUrlWithLang('/download-youtube'); ?>">YouTube</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>More Platforms</h3>
                    <ul class="footer-links">
                        <li><a href="<?php echo getUrlWithLang('/download-twitter'); ?>">Twitter/X</a></li>
                        <li><a href="<?php echo getUrlWithLang('/download-facebook'); ?>">Facebook</a></li>
                        <li><a href="<?php echo getUrlWithLang('/download-bilibili'); ?>">Bilibili</a></li>
                        <li><a href="<?php echo getUrlWithLang('/download-douyin'); ?>">Douyin</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>About</h3>
                    <p>GreenVideo - Free video downloader for all major social media platforms</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 GreenVideo. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <div id="toast" class="toast" role="status" aria-live="polite"></div>

    <?php if (empty($skipAppJs)): ?>
    <script src="/assets/js/app.js?v=1" defer></script>
    <?php endif; ?>
</body>
</html>