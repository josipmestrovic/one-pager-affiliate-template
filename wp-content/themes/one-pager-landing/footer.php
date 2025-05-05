<footer class="site-footer" style="background-color: var(--header-footer-bg); color: #fff; padding: 40px 0 100px; width: 100vw; margin-left: calc(-50vw + 50%); margin-right: calc(-50vw + 50%);">
    <div class="container">
        <div class="row">
            <!-- Left Column: Disclaimer 1 and Disclaimer 2 -->
            <div class="col-md-6 mb-4 mb-md-0 text-start">
                <?php if ($footer_disclaimer_1 = get_field('footer_disclaimer_1')): ?>
                    <div class="footer-disclaimer footer-disclaimer-1">
                        <?php echo wp_kses_post($footer_disclaimer_1); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($footer_disclaimer_2 = get_field('footer_disclaimer_2')): ?>
                    <div class="footer-disclaimer footer-disclaimer-2 mt-4 text-start">
                        <?php echo wp_kses_post($footer_disclaimer_2); ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Right Column: Navigation -->
            <div class="col-md-6 text-start">
                <div class="footer-links">
                    <ul class="list-inline mb-0">
                        <?php if ($terms_url = get_field('terms_url')): ?>
                            <li class="list-inline-item">
                                <a href="<?php echo esc_url($terms_url); ?>" style="color: #fff; text-decoration: underline;">Terms of Use</a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if (($terms_url = get_field('terms_url')) && ($privacy_url = get_field('privacy_url'))): ?>
                            <li class="list-inline-item" style="color: #fff; ">|</li>
                        <?php endif; ?>
                        
                        <?php if ($privacy_url = get_field('privacy_url')): ?>
                            <li class="list-inline-item">
                                <a href="<?php echo esc_url($privacy_url); ?>" style="color: #fff; text-decoration: underline;">Privacy Policy</a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if (($privacy_url = get_field('privacy_url')) && ($support_email = get_field('support_email'))): ?>
                            <li class="list-inline-item" style="color: #fff;">|</li>
                        <?php endif; ?>
                        
                        <?php if ($support_email = get_field('support_email')): ?>
                            <li class="list-inline-item">
                                <a href="mailto:<?php echo esc_attr($support_email); ?>" style="color: #fff; text-decoration: underline;">Contact Support</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <style>

    </style>
</footer>
<?php wp_footer(); ?>
</body>
</html>