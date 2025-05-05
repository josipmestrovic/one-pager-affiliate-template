<?php
/**
 * Plugin Name: Testimonial Video Carousel Sidebar Navigation
 * Description: A lightweight and responsive video carousel for testimonials with sidebar thumbnail navigation.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com
 * Text Domain: testimonial-video-carousel-sidebar-navigation
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class Testimonial_Video_Carousel_Sidebar_Navigation {
    
    /**
     * Constructor
     */
    public function __construct() {
        // Register shortcode - note the different shortcode name
        add_shortcode('testimonial_video_carousel_sidebar', array($this, 'render_carousel'));
        
        // Register styles and scripts
        add_action('wp_enqueue_scripts', array($this, 'register_assets'));
    }
    
    /**
     * Register and enqueue styles and scripts
     */
    public function register_assets() {
        // Register the custom CSS
        wp_register_style(
            'testimonial-video-carousel-sidebar-css',
            plugin_dir_url(__FILE__) . 'assets/testimonial-video-carousel.css',
            array(),
            '1.0.0'
        );
        
        // Register the custom JS
        wp_register_script(
            'testimonial-video-carousel-sidebar-js',
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
        wp_enqueue_style('testimonial-video-carousel-sidebar-css');
        wp_enqueue_script('testimonial-video-carousel-sidebar-js');
        
        // Default attributes
        $atts = shortcode_atts(
            array(
                'width' => '100%', // Width of the carousel
                'title' => ' ', // Optional title for the carousel
                'orientation' => 'horizontal', // Video orientation: horizontal (16:9) or vertical (9:16)
            ),
            $atts,
            'testimonial_video_carousel_sidebar'
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
        $carousel_id = 'tvcs_' . uniqid();
        
        ?>
        <div class="testimonial-video-carousel-sidebar-wrapper">
            <?php if (!empty($atts['title'])): ?>
                <h3 class="testimonial-carousel-title"><?php echo esc_html($atts['title']); ?></h3>
            <?php endif; ?>
            
            <div class="video-carousel-container">
                <div class="video-carousel-inner">
                    <div class="video-carousel <?php echo esc_attr($atts['orientation']); ?>" id="<?php echo esc_attr($carousel_id); ?>">
                        <h2 class="mb-4" style="text-align: center;">Testimonials</h2>
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
                </div>
            </div>
        </div>
        <?php
        
        // Return the output buffer content
        return ob_get_clean();
    }
}

// Initialize the plugin
new Testimonial_Video_Carousel_Sidebar_Navigation();