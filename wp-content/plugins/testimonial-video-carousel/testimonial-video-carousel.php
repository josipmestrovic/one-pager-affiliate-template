<?php
/**
 * Plugin Name: Testimonial Video Carousel
 * Description: A lightweight and responsive video carousel for testimonials with thumbnail navigation.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com
 * Text Domain: testimonial-video-carousel
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class Testimonial_Video_Carousel {
    
    /**
     * Constructor
     */
    public function __construct() {
        // Register shortcode
        add_shortcode('testimonial_video_carousel', array($this, 'render_carousel'));
        
        // Register styles and scripts
        add_action('wp_enqueue_scripts', array($this, 'register_assets'));
    }
    
    /**
     * Register and enqueue styles and scripts
     */
    public function register_assets() {
        // Register the custom CSS
        wp_register_style(
            'testimonial-video-carousel-css',
            plugin_dir_url(__FILE__) . 'assets/testimonial-video-carousel.css',
            array(),
            '1.0.0'
        );
        
        // Register the custom JS
        wp_register_script(
            'testimonial-video-carousel-js',
            plugin_dir_url(__FILE__) . 'assets/testimonial-video-carousel.js',
            array('jquery'),
            '1.0.0',
            true
        );
    }
    
    /**
     * Render the carousel shortcode
     * 
     * @param array $atts Shortcode attributes
     * @return string HTML output
     */
    public function render_carousel($atts) {
        // Enqueue the CSS and JS
        wp_enqueue_style('testimonial-video-carousel-css');
        wp_enqueue_script('testimonial-video-carousel-js');
        
        // Default attributes
        $atts = shortcode_atts(
            array(
                'width' => '100%', // Width of the carousel
                'title' => ' ', // Optional title for the carousel
                'orientation' => 'horizontal', // Video orientation: horizontal (16:9) or vertical (9:16)
            ),
            $atts,
            'testimonial_video_carousel'
        );
        
        // Get video files and thumbnails from ACF fields
        $video_files = array();
        $video_thumbnails = array();
        
        if (function_exists('get_field')) {
            // Get all 6 video testimonial files and thumbnails
            for ($i = 1; $i <= 6; $i++) {
                $video_url = get_field('video_testimonial_' . $i . '_file');
                $thumbnail_url = get_field('video_testimonial_' . $i . '_thumbnail');
                
                if (!empty($video_url)) {
                    $video_files[] = $video_url;
                    
                    // Use the custom thumbnail if available, otherwise use a default
                    if (!empty($thumbnail_url)) {
                        $video_thumbnails[] = $thumbnail_url;
                    } else {
                        // Use a default thumbnail
                        $video_thumbnails[] = plugin_dir_url(__FILE__) . 'assets/default-thumbnail.jpg';
                    }
                }
            }
        }
        
        // Start output buffering
        ob_start();
        
        // Generate a unique ID for this carousel instance
        $carousel_id = 'tvc_' . uniqid();
        
        ?>
        <div class="testimonial-video-carousel-wrapper">
            <?php if (!empty($atts['title'])): ?>
                <h3 class="testimonial-carousel-title"><?php echo esc_html($atts['title']); ?></h3>
            <?php endif; ?>
            
            <div class="video-carousel-container">
                <div class="video-carousel-inner">
                    <!-- Mobile Carousel (less than 600px) -->
                    <div class="mobile-carousel video-carousel <?php echo esc_attr($atts['orientation']); ?>" id="<?php echo esc_attr($carousel_id); ?>">
                        <?php 
                        // Get the video testimonials title from ACF
                        $video_testimonials_title = function_exists('get_field') ? get_field('video_testimonials_title') : 'Testimonials';
                        if (empty($video_testimonials_title)) $video_testimonials_title = 'Testimonials';
                        ?>
                        <h2 class="mb-4" style="text-align: center;"><?php echo esc_html($video_testimonials_title); ?></h2>
                        <div class="video-container">
                            <video src="<?php echo esc_url($video_files[0]); ?>" 
                                   class="active-video"
                                   controls
                                   controlsList="nodownload"
                                   playsinline>
                                Your browser does not support the video tag.
                            </video>
                            <div class="video-play-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="white">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                        <span class="video-thumbnails">
                            <?php foreach ($video_files as $index => $video_url): ?>
                            <a href="javascript:void(0);" 
                               data-video-src="<?php echo esc_url($video_url); ?>"
                               class="<?php echo ($index === 0) ? 'active' : ''; ?>">
                                <img src="<?php echo esc_url($video_thumbnails[$index]); ?>" alt="Video thumbnail">
                            </a>
                            <?php endforeach; ?>
                        </span>
                    </div>
                    
                    <!-- Desktop Grid (600px and above) -->
                    <div class="desktop-grid">
                        <h2 class="mb-5" style="text-align: center;"><?php echo esc_html($video_testimonials_title); ?></h2>
                        <div class="video-grid">
                            <?php foreach ($video_files as $index => $video_url): ?>
                                <div class="grid-video-container <?php echo esc_attr($atts['orientation']); ?>">
                                    <video src="<?php echo esc_url($video_url); ?>"
                                           controls
                                           controlsList="nodownload"
                                           playsinline
                                           preload="metadata">
                                        Your browser does not support the video tag.
                                    </video>
                                    <div class="video-play-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="white">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        
        // Return the output buffer content
        return ob_get_clean();
    }
}

// Initialize the plugin
new Testimonial_Video_Carousel();