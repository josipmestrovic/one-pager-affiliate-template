<?php
/*
Template Name: One-Pager Affiliate Template
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header();

$get_primary_btn_color = get_field('primary_button_color');
?>
<style>
<?php if ($get_primary_btn_color): ?>
:root { 
    --primary-button-bg: <?php echo esc_attr($get_primary_btn_color); ?>; 
}
<?php else: ?>
:root {
}
<?php endif; ?>
/* Fix horizontal scrolling issue caused by nested full-width sections */
body, html {
    overflow-x: hidden; /* Prevent horizontal scrolling */
    width: 100%;
    max-width: 100%;
}
.video-carousel-container {
    width: 100% !important; /* Override the 100vw */
    position: static !important; /* Override the relative position */
    left: auto !important; /* Reset left offset */
    right: auto !important; /* Reset right offset */
    margin-left: 0 !important; /* Reset negative margin */
    margin-right: 0 !important; /* Reset negative margin */
    background-color: var(--featured-bg) !important; /* Use variable instead of hard-coded color */
}
section[style*="background-color: var(--featured-bg)"] {
    width: 100vw !important;
    margin-left: calc(-50vw + 50%) !important;
    margin-right: calc(-50vw + 50%) !important;
    padding-left: 15px;
    padding-right: 15px;
    box-sizing: border-box;
    max-width: none !important;
}

.discount-percentage,
.new-price {
    color: var(--discount-text-color);
}
.payment-logo {
    max-height: 20px;
    width: auto;
    margin-right: 10px;
}

@media (max-width: 1400px) {
    .payment-info {
        flex-wrap: wrap !important;
    }
    .money-back-guarantee {
        width: 100%;
        margin-top: 10px;
    }
}
@media (max-width: 480px) {
    .product-pricing .d-flex {
        flex-wrap: wrap !important;
    }
    .product-pricing .bonus-offer {
        display: block !important;
        flex: 0 0 100% !important;
        width: 100% !important;
        margin: -16px 0px 20px !important;
    }
}
/* Decrease As Seen On gap on small screens */
@media (max-width: 576px) {
    .as-seen-on-section .d-flex > div { /* Corrected class name */
        margin: 0 15px !important;
    }
}

@media (max-width: 450px) {
    .featured-on-section .d-flex > div {
        margin: 0 15px 15px !important; /* Adjust spacing for the container div */
    }
    .featured-on-section .d-flex > div img {
        max-height: 65px !important; /* Decrease image height */
    }
    .approved-featured-container img {
        max-height: 44px !important; /* Set max-height for approved-featured-container images */
    }
}

/* Add responsive gap for top header bar content */
@media (max-width: 1000px) {
    .top-header-content {
        gap: 12px !important;
    }
}

/* Make carousel controls black */
.video-testimonials .carousel-control-prev-icon {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000000'%3e%3cpath d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'/%3e%3c/svg%3e");
}

.video-testimonials .carousel-control-next-icon {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000000'%3e%3cpath d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
}

/* Adjust Video Testimonial Layout */
.video-testimonials .carousel-control-prev,
.video-testimonials .carousel-control-next {
    width: 10%; /* Increased width for larger clickable area */
    opacity: 0.7; /* Make arrows more visible */
     /* Optional: subtle background */
    /* Ensure arrows are positioned at the edges */
    left: 0; /* For prev */
    right: 0; /* For next */
    /* Reset any potential Bootstrap offsets if needed */
    transform: none;
}
.video-testimonials .carousel-control-prev {
    right: auto; /* Override Bootstrap's default if necessary */
}
.video-testimonials .carousel-control-next {
    left: auto; /* Override Bootstrap's default if necessary */
}

.video-testimonials .carousel-control-prev:hover,
.video-testimonials .carousel-control-next:hover {
    opacity: 0.9;
    
}

/* Remove padding from inner container */
.video-testimonials .carousel-inner {
    padding-left: 0;
    padding-right: 0;
}

/* Ensure play buttons appear above video and are clickable */
.video-box .play-button {
    cursor: pointer;
    z-index: 2;
    pointer-events: auto;
}
.hero-play-button, .play-button {
    pointer-events: auto;
}

/* Add border radius to video boxes */
.video-testimonials .video-box {
    border-radius: 20px;
    overflow: hidden; /* Ensure content respects the border radius */
    position: relative; /* Needed for absolute positioning of children like play button */
}
.video-testimonials .video-box video {
    display: block; /* Remove extra space below video */
    width: 100%;
}

/* Add padding to the content wrapper inside each carousel item */
.video-testimonials .carousel-content-wrapper {
    padding-left: 11%; /* arrow width (10%) + 1% gap */
    padding-right: 11%; /* arrow width (10%) + 1% gap */
    width: 100%;
    box-sizing: border-box;
}

/* On small screens (≤600px), move controls below content */
@media (max-width: 600px) {
    #videoTestimonialsCarousel {
        display: flex !important;
        flex-direction: column !important;
        text-align: center;
    }
    
    /* Control wrapper for better positioning */
    .video-testimonials .carousel-controls-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 15px;
    }
    
    .video-testimonials .carousel-control-prev,
    .video-testimonials .carousel-control-next {
        position: relative !important;
        display: inline-block !important;
        width: 40px !important;
        height: 40px !important;
        transform: none !important;
        background-color: transparent !important;
        margin: 0 10px !important;
        left: auto !important;
        right: auto !important;
        opacity: 0.7;
    }
    
    /* Match the style of side arrows */
    .video-testimonials .carousel-control-prev:hover,
    .video-testimonials .carousel-control-next:hover {
        opacity: 0.9;
    }
}

/* Initially hide the prev button on load as we'll always start with first slide active */
#videoTestimonialsCarousel .carousel-control-prev {
    display: none;
}
@media (max-width: 768px) {
    #faqAccordion {
        display: block;
    }
}
*/
/* FAQs accordion equal height columns only on desktop to prevent layout shift */
@media (min-width: 768px) {
    #faqAccordion .row {
        align-items: stretch;
    }
    #faqAccordion .col-md-6 {
        display: flex;
        flex-direction: column;
    }
    #faqAccordion .col-md-6 .accordion {
        flex: 1;
    }
}



/* Fix for mobile carousel controls when they appear below the content */
@media (max-width: 600px) {
  /* Use display none/block instead of visibility for controls */
  #videoTestimonialsCarousel .carousel-controls-wrapper {
    margin-top: 15px;
  }
  
  #videoTestimonialsCarousel .carousel-controls-wrapper button {
    transition: opacity 0.3s;
  }
  
  /* Override any display property set dynamically */
  #videoTestimonialsCarousel .carousel-controls-wrapper button.d-none,
  #videoTestimonialsCarousel .carousel-control-prev[style*="display: none"],
  #videoTestimonialsCarousel .carousel-control-next[style*="display: none"] {
    display: none !important;
  }
}

/* Initially hide the prev button on load as we'll always start with first slide active */
#videoTestimonialsCarousel .carousel-control-prev {
  display: none;
}

/* Video testimonials mobile fixes */
@media (max-width: 600px) {
  /* Make carousel controls more visible and responsive */
  .video-testimonials .carousel-controls-wrapper {
    margin-top: 20px;
    display: flex;
    justify-content: center;
    gap: 20px;
    height: 40px; /* Fixed height to prevent layout shifts */
  }
  
  /* Ensure controls have consistent size and appearance */
  #videoCarouselPrev, #videoCarouselNext {
    position: relative !important;
    width: 40px !important;
    height: 40px !important;
    opacity: 1 !important;
    transition: opacity 0.2s ease-in-out !important;
    display: inline-flex !important;
    align-items: center;
    justify-content: center;
    padding: 0 !important;
    background-color: transparent !important;
    border: none !important;
  }
  
  /* Proper visibility control */
  #videoCarouselPrev.control-hidden,
  #videoCarouselNext.control-hidden {
    pointer-events: none !important;
    opacity: 0.15 !important;
  }

  /* Ensure the right style consistency for slide containers */
  .video-testimonials .mobile-carousel-view .carousel-item {
    transition: transform .6s ease;
  }
}

/* Make carousel arrows more visually consistent */
.video-testimonials .carousel-control-prev-icon,
.video-testimonials .carousel-control-next-icon {
  width: 24px;
  height: 24px;
  background-size: contain;
}

/* Reset carousel control styles that may have been broken */
.video-testimonials .carousel-control-prev,
.video-testimonials .carousel-control-next {
  position: absolute;
  top: 0;
  bottom: 0;
  width: 10%;
  opacity: 0.7;
  display: flex;
  align-items: center;
  justify-content: center;
}

.video-testimonials .carousel-control-prev {
  left: 0;
  right: auto;
}

.video-testimonials .carousel-control-next {
  right: 0;
  left: auto;
}

/* Responsive mobile adjustments */
@media (max-width: 600px) {
  .video-testimonials .carousel-controls-wrapper {
    margin-top: 15px;
    display: flex;
    justify-content: center;
    gap: 15px;
  }
  
  .video-testimonials .carousel-control-prev,
  .video-testimonials .carousel-control-next {
    position: relative !important;
    width: 40px !important;
    height: 40px !important;
    margin: 0 5px;
    transform: none !important;
  }
}

/* Fix for whitespace below footer */

/* Make popovers appear above the sticky element */
.popover {
    z-index: 10000 !important; /* Higher than sticky element's z-index (9999) */
}

/* Remove active state styling from accordion buttons */
.accordion-button:not(.collapsed) {
    color: inherit !important;
    background-color: transparent !important;
    box-shadow: none !important;
}

/* Ensure the arrow icon still rotates */
.accordion-button:not(.collapsed)::after {
    transform: rotate(-180deg);
}

/* Remove all borders except bottom border from FAQ items */
.accordion-item {
    border: none;
    border-bottom: 1px solid rgba(0,0,0,.125);
}

/* Remove border from the last accordion item */
.accordion-item:last-of-type {
    border-bottom: none;
}
</style>
<?php

// Fetch custom fields
$header_logo = get_field('header_logo');
$hero_video_url = get_field('hero_video_url');
$button_1_text = get_field('button_1_text');
$button_1_url = get_field('button_1_url');

// Add a PHP block to fetch the initial visitor count
$initial_visitor_count = isset($_SESSION['visitor_count']) ? $_SESSION['visitor_count'] : rand(60, 200);

// Fetch new custom fields
$product_name = get_field('product_name');
$headline = get_field('headline');
$subheadline = get_field('subheadline');
$payment_images = get_field('payment_images');
$money_back_days = get_field('money_back_days');

// Fetch top bar fields from the group
$header_bar_content = get_field('header_bar_content');
$top_header_text = isset($header_bar_content['top_header_text_string']) ? $header_bar_content['top_header_text_string'] : '';
$countdown_date_str = isset($header_bar_content['countdown_date']) ? $header_bar_content['countdown_date'] : ''; // Expects Y-m-d format from ACF
$show_visitor_count_top = isset($header_bar_content['show_visitor_count_in_top_header']) ? $header_bar_content['show_visitor_count_in_top_header'] : false;

?>

<?php 
// --- Top Bar Logic ---
// Determine if the bar should be displayed at all
$display_top_bar = !empty(trim($top_header_text)) || !empty($countdown_date_str) || $show_visitor_count_top;

if ($display_top_bar): 
?>
<div class="top-header-bar" style="background-color: var(--header-footer-bg); color: #FFFFFF; font-size: 20px; width: 100%; text-align: center;">
    <div class="container" style="    padding: 12px 0 !important;"
 >
        <div class="top-header-content" style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 24px;">
            <?php // Display text only if it's not empty
            if (!empty(trim($top_header_text))): ?>
                <span class="top-header-text"><?php echo esc_html($top_header_text); ?></span>
            <?php endif; ?>

            <?php // Display countdown only if date is set
            if (!empty($countdown_date_str)): ?>
                <span class="top-header-countdown" id="top-countdown"></span>
            <?php endif; ?>

            <?php // Display visitor count only if checkbox is checked
            if ($show_visitor_count_top): ?>
                <span class="top-header-visitors" id="top-visitor-count"><?php echo $initial_visitor_count; ?> People Viewing</span>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; 
// --- End Top Bar Logic ---
?>


<?php 
$hero_video_file = get_field('hero_video_file');
$hero_video_url = get_field('hero_video_url');
$fallback_hero_image = get_field('fallback_hero_image');
$video_description = get_field('video_description');
?>

<div id="hero-container" class="container my-5" style="margin-top:0px !important;">
  <div class="row gx-5 align-items-center">
    <div class="col-md-6 desktop-video-wrapper" style="margin-top: -10px;">
      <?php if ($hero_video_file): ?>
        <?php $hero_video_thumbnail = get_field('hero_video_thumbnail'); ?>
        <div class="video-wrapper position-relative" style="border-radius: 20px; overflow: hidden;">
          <video playsinline muted preload="metadata" class="img-fluid w-100" poster="<?php echo esc_url($hero_video_thumbnail); ?>" style="border-radius: 20px;">
            <source src="<?php echo esc_url($hero_video_file); ?>" type="video/mp4">
            Your browser does not support the video tag.
          </video>
          <div class="hero-play-button position-absolute top-50 start-50 translate-middle" style="cursor:pointer; z-index:2;">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="white" style="filter: drop-shadow(0px 0px 5px rgba(0, 0, 0, 0.5)); background-color: var(--primary-button-bg, #0d6efd); border-radius: 50%; padding: 12px;">
              <path d="M8 5v14l11-7z"/>
            </svg>
          </div>
        </div>
      <?php elseif ($hero_video_url): ?>
        <div class="ratio ratio-16x9 ">
          <iframe src="<?php echo esc_url($hero_video_url); ?>" frameborder="0" allowfullscreen class="rounded"></iframe>
        </div>
      <?php elseif ($fallback_hero_image): ?>
        <div class="video-wrapper">
          <img src="<?php echo esc_url($fallback_hero_image); ?>" alt="" class="img-fluid rounded" />
        </div>
      <?php endif; ?>

      <?php if (($hero_video_file || $hero_video_url) && $video_description): ?>
        <div class="video-description">
          <p><?php echo esc_html($video_description); ?></p>
        </div>
      <?php endif; ?>
    </div>
    <div class="col-md-6">
      <div class="product-header mt-4">
        <?php if ($product_name): ?>
            <?php 
                // Fetch rating fields for inline display
                $product_rating = get_field('product_rating');
                $number_of_reviews = get_field('number_of_reviews');
            ?>
            <div class="d-flex align-items-top">
                <h4 class="mb-0 me-3" style="font-weight:600 !important; "><?php echo esc_html($product_name); ?></h4>
                <div class="product-rating d-flex align-items-center mb-0">
                    <div class="stars me-2" data-rating="<?php echo esc_attr(number_format((float)$product_rating, 1)); ?>">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <div class="star" style="position: relative; display: inline-block; width: 15px; height: 15px;">
                                <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 0; left: 0; z-index: 1;">
                                    <path d="M3.38499 14.6031C3.02311 14.7887 2.61249 14.4634 2.68561 14.0481L3.46374 9.61368L0.160925 6.46743C-0.147512 6.17305 0.0128001 5.63493 0.426238 5.5768L5.01811 4.9243L7.06561 0.86774C7.2503 0.502115 7.74999 0.502115 7.93468 0.86774L9.98218 4.9243L14.5741 5.5768C14.9875 5.63493 15.1478 6.17305 14.8384 6.46743L11.5366 9.61368L12.3147 14.0481C12.3878 14.4634 11.9772 14.7887 11.6153 14.6031L7.49874 12.4881L3.38405 14.6031H3.38499Z" fill="#C4C4C4"/>
                                </svg>
                                <?php if ($i <= floor($product_rating)): ?>
                                    <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 0; left: 0; z-index: 2;">
                                        <path d="M3.38499 14.6031C3.02311 14.7887 2.61249 14.4634 2.68561 14.0481L3.46374 9.61368L0.160925 6.46743C-0.147512 6.17305 0.0128001 5.63493 0.426238 5.5768L5.01811 4.9243L7.06561 0.86774C7.2503 0.502115 7.74999 0.502115 7.93468 0.86774L9.98218 4.9243L14.5741 5.5768C14.9875 5.63493 15.1478 6.17305 14.8384 6.46743L11.5366 9.61368L12.3147 14.0481C12.3878 14.4634 11.9772 14.7887 11.6153 14.6031L7.49874 12.4881L3.38405 14.6031H3.38499Z" fill="#F59E3A"/>
                                    </svg>
                                <?php elseif ($i - 1 < $product_rating && $i > $product_rating): ?>
                                    <?php $percentage = ($product_rating - floor($product_rating)) * 100; ?>
                                    <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 0; left: 0; z-index: 2; clip-path: inset(0 <?php echo 100 - $percentage; ?>% 0 0);">
                                        <path d="M3.38499 14.6031C3.02311 14.7887 2.61249 14.4634 2.68561 14.0481L3.46374 9.61368L0.160925 6.46743C-0.147512 6.17305 0.0128001 5.63493 0.426238 5.5768L5.01811 4.9243L7.06561 0.86774C7.2503 0.502115 7.74999 0.502115 7.93468 0.86774L9.98218 4.9243L14.5741 5.5768C14.9875 5.63493 15.1478 6.17305 14.8384 6.46743L11.5366 9.61368L12.3147 14.0481C12.3878 14.4634 11.9772 14.7887 11.6153 14.6031L7.49874 12.4881L3.38405 14.6031H3.38499Z" fill="#F59E3A"/>
                                    </svg>
                                <?php endif; ?>
                            </div>
                        <?php endfor; ?>
                    </div>
                    <span style="font-weight: 600; color: #575858" class="rating-value me-2"><?php echo esc_html(number_format((float)$product_rating, 1)); ?></span>
                    <span style="font-weight: 600; color: #575858" class="divider me-2">|</span>
                    <span style="font-weight: 600; color: #575858" class="rating-count"><?php echo esc_html($number_of_reviews); ?> Reviews</span>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($headline): ?>
            <h1><?php echo esc_html($headline); ?></h1>
        <?php endif; ?>
        <?php if ($subheadline): ?>
            <p class="subheadline-text" style="    margin: 6px 0 24px 0 !important;">
                <?php echo esc_html($subheadline); ?>
            </p>
        <?php endif; ?>

        <?php // Mobile/video on small/tablet: show between subheadline and pricing ?>
        <?php if ($hero_video_file || $hero_video_url || $fallback_hero_image): ?>
            <div class="mobile-video-wrapper mb-4 position-relative">
                <?php if ($hero_video_file): ?>
                    <?php $hero_video_thumbnail_mobile = get_field('hero_video_thumbnail'); ?>
                    <?php if ($hero_video_thumbnail_mobile): ?>
                        <img src="<?php echo esc_url($hero_video_thumbnail_mobile); ?>" alt="Video Thumbnail" class="img-fluid w-100" style="cursor: pointer; border-radius: 20px;">
                        <video playsinline muted preload="metadata" class="w-100" style="border-radius: 20px; display: none;">
                            <source src="<?php echo esc_url($hero_video_file); ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    <?php else: ?>
                        <video playsinline muted preload="metadata" class="w-100" style="border-radius: 20px;">
                            <source src="<?php echo esc_url($hero_video_file); ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    <?php endif; ?>
                    <div class="hero-play-button position-absolute top-50 start-50 translate-middle" style="cursor:pointer; z-index:2;">
                      <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="white" style="filter: drop-shadow(0px 0px 5px rgba(0, 0, 0, 0.5)); background-color: var(--primary-button-bg, #0d6efd); border-radius: 50%; padding: 12px;">
                        <path d="M8 5v14l11-7z"/>
                      </svg>
                    </div>
                <?php elseif ($hero_video_url): ?>
                    <div class="ratio ratio-16x9">
                        <iframe src="<?php echo esc_url($hero_video_url); ?>" frameborder="0" allowfullscreen class="rounded"></iframe>
                    </div>
                <?php elseif ($fallback_hero_image): ?>
                    <img src="<?php echo esc_url($fallback_hero_image); ?>" alt="" class="img-fluid rounded" />
                <?php endif; ?>
              
            </div>
            <?php if ($video_description): ?>
                    <div class="video-description-mobile">
                        <p><?php echo esc_html($video_description); ?></p>
                    </div>
                <?php endif; ?>
        <?php endif; ?>

        <?php
            $price = get_field('price');
            $discount_price = get_field('discount_price');
            $discount_percentage = ($price && $discount_price && $price > 0) ? round((($price - $discount_price) / $price) * 100) : null;
            $bonus_offer_text = get_field('bonus_offer_text');
            $show_from = get_field('can_from_apply_to_price');
            $cost_per_day = get_field('cost_per_day');
        ?>
        <div class="product-pricing my-4" style="margin-bottom:-18px !important;">
            <?php if ($discount_price && $discount_percentage !== null): ?>
                <div class="d-flex align-items-center">
                    <?php if ($show_from): ?>
                        <div class="from-text me-2" style="font-size: 26px; font-weight: 600;">From</div>
                    <?php endif; ?>
                    <div class="old-price me-3" style="text-decoration: line-through; font-size: 1.5em !important; font-weight: 600;     color: #575858;">
                        $<?php echo esc_html(number_format($price, 2)); ?>
                    </div>
                    <div class="price-arrow-wrapper text-center me-3" style="margin-bottom:30px;">
                        <div class="discount-percentage mb-1" style="margin-left:-35px; margin-bottom: -5px !important; font-size:20px !important; font-weight: 700;">-<?php echo esc_html($discount_percentage); ?>%</div>
                        <svg width="30" height="24" viewBox="0 0 30 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M29.0607 13.0607C29.6464 12.4749 29.6464 11.5251 29.0607 10.9393L19.5147 1.3934C18.9289 0.807611 17.9792 0.807611 17.3934 1.3934C16.8076 1.97919 16.8076 2.92893 17.3934 3.51472L25.8787 12L17.3934 20.4853C16.8076 21.0711 16.8076 22.0208 17.3934 22.6066C17.9792 23.1924 18.9289 23.1924 19.5147 22.6066L29.0607 13.0607ZM0 12V13.5H28V12V10.5H0V12Z" fill="black"/>
                        </svg>
                    </div>
                    <div class="new-price-wrapper position-relative me-3">
                        <?php if (!empty($cost_per_day)): ?>
                            <div class="cost-per-day" style="position: absolute; top: -35px; left: 75%; transform: translateX(-50%); white-space: nowrap; font-size: 16px; color: #575858; background-color: var(--featured-bg); padding: 4px 12px; border-radius: 12px; font-weight: 600;">
                                <?php echo esc_html($cost_per_day); ?>
                            </div>
                        <?php endif; ?>
                        <div class="new-price" style="font-size: 1.5em; font-weight: bold;">
                            $<?php echo esc_html(number_format($discount_price, 2)); ?>
                        </div>
                    </div>
                    <?php if ($bonus_offer_text): ?>
                        <span class="bonus-offer" style="color: #575858 !important; line-height:1.2;">+ <?php echo esc_html($bonus_offer_text); ?></span>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="d-flex align-items-center">
                    <?php if ($show_from): ?>
                        <div class="from-text me-2" style="font-size: 26px; font-weight: 600;">From</div>
                    <?php endif; ?>
                    <div class="regular-price-wrapper position-relative">
                        <?php if (!empty($cost_per_day)): ?>
                            <div class="cost-per-day" style="position: absolute; top: -24px; left: 50%; transform: translateX(-50%); white-space: nowrap; font-size: 16px; color: #575858; background-color: var(--featured-bg); padding: 4px 12px; border-radius: 12px;">
                                <?php echo esc_html($cost_per_day); ?>
                            </div>
                        <?php endif; ?>
                        <div class="regular-price" style="font-size: 1.5em; font-weight: bold;">
                            $<?php echo esc_html(number_format($price, 2)); ?>
                        </div>
                    </div>
                    <?php if ($bonus_offer_text): ?>
                        <span class="bonus-offer ms-2">+ <?php echo esc_html($bonus_offer_text); ?></span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="mt-3">
            <a href="<?php echo esc_url($button_1_url); ?>" class="btn btn-primary opalp-bg-primary-button btn-lg w-100">
                <?php echo esc_html($button_1_text); ?>
            </a>
        </div>
        <!-- Add payment info directly below hero CTA -->
        <div class="payment-info d-flex justify-content-between align-items-center mt-4" style="
    margin-top: 12px !important;" >
            <div class="payment-images d-flex align-items-center">
                <?php if (!empty($payment_images) && is_array($payment_images)): ?>
                    <?php
                        $plugin_root_url = plugin_dir_url(__DIR__ . '/../one-pager-affiliate-landing-page.php');
                        // Prioritize PayPal, GPay, Visa at front
                        $priority_order = array('PayPal-logo.png','GPay-logo.png','Visa50.gif');
                        $sorted_images = array();
                        foreach ($priority_order as $prio) {
                            if (false !== ($idx = array_search($prio, $payment_images))) {
                                $sorted_images[] = $payment_images[$idx];
                                unset($payment_images[$idx]);
                            }
                        }
                        $payment_images = array_merge($sorted_images, $payment_images);
                        $max_display = 3;
                        $count = count($payment_images);
                        $display_images = array_slice($payment_images, 0, $max_display);
                        $remaining_images = array_slice($payment_images, $max_display);
                        foreach ($display_images as $img_file): ?>
                            <img src="<?php echo esc_url($plugin_root_url . 'assets/payments-images/' . $img_file); ?>" class="img-fluid payment-logo me-2">
                        <?php endforeach;
                        if ($count > $max_display):
                            $remaining = $count - $max_display;
                            $popover_content = '';
                            foreach ($remaining_images as $file) {
                                $popover_content .= '<img src=\'' . esc_url($plugin_root_url . 'assets/payments-images/' . $file) . '\' class=\'payment-logo me-2\' />';
                            }
                    ?>
                        <button type="button" class="btn btn-sm btn-outline-secondary payment-more" data-bs-toggle="popover" data-bs-trigger="hover focus click" data-bs-html="true" data-bs-sanitize="false" data-bs-content="<?php echo esc_attr($popover_content); ?>" data-bs-placement="top">
                            <?php echo '+' . esc_html($remaining); ?>
                        </button>
                    <?php endif; ?>
                <?php endif; ?>
                <span class="secure-payments-text" style="font-weight:600">| Secured Payments</span>
            </div>
            <div class="money-back-guarantee">
                <?php if ($money_back_days): ?>
                    <span style="font-weight:700" ><?php echo esc_html($money_back_days); ?> Days Money Back Guarantee</span>
                <?php endif; ?>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div><!-- closing container div before full-width section -->

<?php
    $as_seen_on_title = get_field('as_seen_on_title');
    $as_seen_on_images = array(
        get_field('as_seen_on_image_1'),
        get_field('as_seen_on_image_2'),
        get_field('as_seen_on_image_3'),
        get_field('as_seen_on_image_4'),
        get_field('as_seen_on_image_5'),
        get_field('as_seen_on_image_6'),
    );
    // Filter out any empty values
    $as_seen_on_images = array_filter($as_seen_on_images);
?>
<?php if ($as_seen_on_title): ?>
<section class="featured-on-section mb-4" style="position:relative; padding:40px 0; background-color: var(--featured-bg); ">
    <div class="container" style="background-color: var(--featured-bg);"><!-- Inner container for content alignment -->
        <?php if ($as_seen_on_title): ?>
            <h2 class="text-center mb-4"><?php echo esc_html($as_seen_on_title); ?></h2>
        <?php endif; ?>
        <div class="approved-featured-container d-flex justify-content-center align-items-center flex-wrap" style="overflow-x:hidden;">
            <?php foreach ($as_seen_on_images as $img): if ($img): ?>
                <div style="flex:0 1 auto; margin:0 25px 20px;">
                    <img src="<?php echo esc_url($img); ?>" alt="" style="width:auto; aspect-ratio:1/1; object-fit:contain;" />
                </div>
            <?php endif; endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<div class="affiliate-landing-page container"><!-- opening new container div after full-width section -->
    <?php
        // Fetch Short Product About fields
        $short_about_title = get_field('short_about_title');
        $short_about_description = get_field('short_about_description');
        $short_about_image = get_field('short_about_image');
        
        // Fetch the blurb items
        $blurb_item_1 = get_field('short_about_blurb_1');
        $blurb_item_2 = get_field('short_about_blurb_2');
        $blurb_item_3 = get_field('short_about_blurb_3');
        
        // Check if any blurb items exist
        $has_blurbs = $blurb_item_1 || $blurb_item_2 || $blurb_item_3;
    ?>
  <?php if ($short_about_title || $short_about_description || $short_about_image || $has_blurbs): ?>
<section class="short-product-about" style="padding:60px 0;">
    <div class="row align-items-center">
        <div class="col-md-6">
            <?php if ($short_about_title): ?>
                <h2 class="mb-4"><?php echo esc_html($short_about_title); ?></h2>
            <?php endif; ?>
            
            <!-- Special mobile-only image that only appears on small screens -->
            <?php if ($short_about_image): ?>
            <div class="d-block d-md-none mb-4">
                <img src="<?php echo esc_url($short_about_image); ?>" alt="" class="img-fluid" style="border-radius: 20px;">
            </div>
            <?php endif; ?>
            
            <?php if ($short_about_description): ?>
                <?php echo wp_kses_post($short_about_description); ?>
            <?php endif; ?>
            
            <?php if ($has_blurbs): ?>
            <ul class="blurb-list mt-4" style="list-style: none; padding-left: 0;">
                <?php if ($blurb_item_1): ?>
                <li class="d-flex align-items-start mb-3">
                    <div class="blurb-icon me-2">
                        <svg width="23" height="16" viewBox="0 0 23 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 8L8.36396 14.364L21.0912 1.63599" stroke="var(--blurb-icon-color, #FBCA70)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span><?php echo esc_html($blurb_item_1); ?></span>
                </li>
                <?php endif; ?>
                
                <?php if ($blurb_item_2): ?>
                <li class="d-flex align-items-start mb-3">
                    <div class="blurb-icon me-2">
                        <svg width="23" height="16" viewBox="0 0 23 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 8L8.36396 14.364L21.0912 1.63599" stroke="var(--blurb-icon-color, #FBCA70)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span><?php echo esc_html($blurb_item_2); ?></span>
                </li>
                <?php endif; ?>
                
                <?php if ($blurb_item_3): ?>
                <li class="d-flex align-items-start">
                    <div class="blurb-icon me-2">
                        <svg width="23" height="16" viewBox="0 0 23 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 8L8.36396 14.364L21.0912 1.63599" stroke="var(--blurb-icon-color, #FBCA70)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span><?php echo esc_html($blurb_item_3); ?></span>
                </li>
                <?php endif; ?>
            </ul>
            <?php endif; ?>
        </div>
        <?php if ($short_about_image): ?>
        <div class="col-md-6 text-center d-none d-md-block">
            <img src="<?php echo esc_url($short_about_image); ?>" alt="" class="short-about-image img-fluid" style="border-radius: 20px;">
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

</div><!-- closing affiliate-landing-page container div before testimonial video carousel -->

<?php echo do_shortcode('[testimonial_video_carousel orientation="vertical"]'); ?>

<div class="affiliate-landing-page container"><!-- opening new affiliate-landing-page container div after testimonial video carousel -->
    
    <?php
  
    // Relocated Facts & Use Section
    $facts_title = get_field('facts_use_title');
    $facts_content = get_field('facts_use_content');
    $facts_image = get_field('facts_use_image');
    $refs = array(
        get_field('facts_use_reference_1'),
        get_field('facts_use_reference_2'),
        get_field('facts_use_reference_3'),
    );
    $valid_refs = array_filter($refs);
    if ($facts_title || $facts_content || $facts_image || !empty($valid_refs)): ?>
    <section class="facts-use py-5">
      <div class="container">
        <div class="row">
          <div class="facts-use-content col-md-6">
            <h2 class="mb-4"><?php echo esc_html($facts_title ?: 'Facts & Use'); ?></h2>
            
            
            <?php if ($facts_content): ?>
              <div><?php echo wp_kses_post($facts_content); ?></div>
            <?php endif; ?>
          </div>
          <div class="facts-use-image col-md-6">
            <?php if ($facts_image): ?>
              <div class="mb-4 text-center facts-image-wrapper" style="border-radius:20px;">
                <img src="<?php echo esc_url($facts_image); ?>" alt="Facts Image" class="img-fluid rounded" />
              </div>
            <?php endif; ?>

            <?php
              // Inline Facts List
              $facts_list = array(
                get_field('facts_list_1'),
                get_field('facts_list_2'),
                get_field('facts_list_3'),
              );
              $valid_facts = array_filter($facts_list);
              if (!empty($valid_facts)): ?>
              <div class="facts-list mb-3">
                <ul class="list-inline">
                  <?php foreach ($valid_facts as $fact): ?>
                  <li class="list-inline-item me-3 d-flex align-items-center">
                    <svg class="opalp-text-blurb-icon me-1" width="18" height="13" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M1.75 6.50006L6.52297 11.273L16.0684 1.72705" />
                    </svg>
                    <span><?php echo esc_html($fact); ?></span>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>

            <?php
              // Label Images Inline
              $label_images = array(
                get_field('facts_label_image_1'),
                get_field('facts_label_image_2'),
                get_field('facts_label_image_3'),
              );
              $valid_labels = array_filter($label_images);
              if (!empty($valid_labels)): ?>
              <div class="label-images d-flex flex-wrap align-items-center mb-3" style="
    gap: 20px;
">
                <?php foreach ($valid_labels as $img_url): ?>
                <img src="<?php echo esc_url($img_url); ?>" alt="Label" class="img-fluid me-2" style="max-height: 50px;" />
                <?php endforeach; ?>
              </div>
            <?php endif; ?>

            <?php if (!empty($valid_refs)): ?>
              <h3>References</h3>
              <ul class="list-unstyled">
                <?php foreach ($valid_refs as $ref): ?>
                  <li><?php echo esc_html($ref); ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
    <?php endif; ?>


</div><!-- closing affiliate-landing-page container div before experts section -->

<?php
$experts_title = get_field('experts_title');
$experts = array(
    array('video' => get_field('expert_1_video'), 'image' => get_field('expert_1_image'), 'name' => get_field('expert_1_name'), 'title' => get_field('expert_1_title'), 'text' => get_field('expert_1_text')),
    array('video' => get_field('expert_2_video'), 'image' => get_field('expert_2_image'), 'name' => get_field('expert_2_name'), 'title' => get_field('expert_2_title'), 'text' => get_field('expert_2_text')),
    array('video' => get_field('expert_3_video'), 'image' => get_field('expert_3_image'), 'name' => get_field('expert_3_name'), 'title' => get_field('expert_3_title'), 'text' => get_field('expert_3_text')),
);

// Filter out empty experts
$experts = array_filter($experts, function($expert) {
    return !empty($expert['name']) || !empty($expert['video']) || !empty($expert['image']);
});

if (!empty($experts_title) || !empty($experts)):
?>
<section style="position:relative; padding:40px 0; background-color: var(--featured-bg);">
    <div class="container" style="background-color: var(--featured-bg);"><!-- Inner container for content alignment -->
        <?php if (!empty($experts_title)): ?>
            <h2 class="text-center mb-4"><?php echo esc_html($experts_title); ?></h2>
        <?php endif; ?>
        
        <div class="experts-grid row">
            <?php foreach ($experts as $expert): ?>
                <?php if (!empty($expert['name']) || !empty($expert['video']) || !empty($expert['image'])): ?>
                    <div class="expert-item col-12 col-md-4 mb-4">
                        <div class="expert-content h-100">
                            <?php if (!empty($expert['video'])): ?>
                                <div class="expert-video-container position-relative mb-3" style="aspect-ratio: 16/9; background-color: #f0f0f0; display: block; overflow: hidden; border-radius: 20px;">
                                    <video class="expert-video" playsinline preload="metadata" poster="<?php echo !empty($expert['image']) ? esc_url($expert['image']) : ''; ?>" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                        <source src="<?php echo esc_url($expert['video']); ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <div class="video-play-button position-absolute top-50 start-50 translate-middle" style="cursor: pointer; z-index: 10;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="white" style="filter: drop-shadow(0px 0px 5px rgba(0, 0, 0, 0.5)); background-color: var(--primary-button-bg, #0d6efd); border-radius: 50%; padding: 12px;">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </div>
                                </div>
                            <?php elseif (!empty($expert['image'])): ?>
                                <div class="expert-image-container mb-3" style="aspect-ratio: 16/9; background-color: #f0f0f0; display: block; overflow: hidden; position: relative; border-radius: 20px;">
                                    <img src="<?php echo esc_url($expert['image']); ?>" alt="<?php echo esc_attr($expert['name'] ?? 'Expert'); ?>" class="expert-image" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($expert['name'])): ?>
                                <h3 class="expert-name mb-1"><?php echo esc_html($expert['name']); ?></h3>
                            <?php endif; ?>
                            
                            <?php if (!empty($expert['title'])): ?>
                                <h5 class="expert-title mb-2 text-muted" style="
    font-weight: 600;
" ><?php echo esc_html($expert['title']); ?></h5>
                            <?php endif; ?>
                            
                            <?php if (!empty($expert['text'])): ?>
                                <div class="expert-text"><p><?php echo wp_kses_post($expert['text']); ?></p></div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const expertVideos = document.querySelectorAll('.expert-video');
    const expertPlayButtons = document.querySelectorAll('.expert-video-container .video-play-button');
    
    expertPlayButtons.forEach(function(button, index) {
        button.addEventListener('click', function() {
            const video = expertVideos[index];
            if (video) {
                // Hide play button
                button.style.display = 'none';
                
                // Play video
                video.muted = false;
                video.volume = 1;
                video.autoplay = true;
                video.setAttribute('controls', '');
                video.play().catch(function(err){ 
                    console.error('Playback failed:', err); 
                    // If playback fails, reset the UI
                    button.style.display = 'block';
                    video.removeAttribute('controls');
                });
                
                // Show play button when video ends
                video.addEventListener('ended', function() {
                    button.style.display = 'block';
                    video.removeAttribute('controls');
                });
                
                // Show play button when video paused
                video.addEventListener('pause', function() {
                    button.style.display = 'block';
                });
            }
        });
    });
});
</script>
<?php endif; ?>

<div class="affiliate-landing-page container" style="padding-bottom:0;"><!-- opening new container div after experts section -->

<?php
// More About Product Sections - Fetch Fields
$more_title_1   = get_field('more_about_title_1');
$more_content_1 = get_field('more_about_content_1');
$img_top_1      = get_field('more_about_image_top_1');
$img_bottom_1   = get_field('more_about_image_bottom_1');
$more_title_2   = get_field('more_about_title_2');
$more_content_2 = get_field('more_about_content_2');
$img_top_2      = get_field('more_about_image_top_2');
$img_bottom_2   = get_field('more_about_image_bottom_2');
?>

<?php // More About Product - Section 1 (Text Left, Images Right)
if ($more_title_1 || $more_content_1 || $img_top_1 || $img_bottom_1): ?>
<div class="container row align-items-center mb-5" style="margin: 40px auto;padding-left: 0px !important;padding-right: 0px;">
  <div class="facts-use-content col-md-6">
    <?php if ($more_title_1): ?><h2 class="mb-3"><?php echo esc_html($more_title_1); ?></h2><?php endif; ?>
    <?php if ($more_content_1): ?><div><?php echo wp_kses_post($more_content_1); ?></div><?php endif; ?>
  </div>
  <div class="facts-use-image col-md-6">
    <?php if ($img_top_1): ?><img src="<?php echo esc_url($img_top_1); ?>" alt="<?php echo esc_attr($more_title_1 ?: 'More About Product Image 1 Top'); ?>" class="img-fluid mb-3 rounded" /><?php endif; ?>
    <?php if ($img_bottom_1): ?><img src="<?php echo esc_url($img_bottom_1); ?>" alt="<?php echo esc_attr($more_title_1 ?: 'More About Product Image 1 Bottom'); ?>" class="img-fluid rounded" /><?php endif; ?>
  </div>
</div>
<?php endif; ?>

<?php // More About Product - Section 2 (Images Left, Text Right)
if ($more_title_2 || $more_content_2 || $img_top_2 || $img_bottom_2): ?>
<div class="more-about-section-2 row align-items-center mb-5" style="margin: 40px auto;">
  <div class="facts-use-image  col-md-6 order-md-2">
    <?php if ($more_title_2): ?><h2 class="mb-3"><?php echo esc_html($more_title_2); ?></h2><?php endif; ?>
    <?php if ($more_content_2): ?><div><?php echo wp_kses_post($more_content_2); ?></div><?php endif; ?>
  </div>
  <div class="facts-use-content col-md-6 order-md-1">
    <?php if ($img_top_2): ?><img src="<?php echo esc_url($img_top_2); ?>" alt="<?php echo esc_attr($more_title_2 ?: 'More About Product Image 2 Top'); ?>" class="img-fluid mb-3 rounded" /><?php endif; ?>
    <?php if ($img_bottom_2): ?><img src="<?php echo esc_url($img_bottom_2); ?>" alt="<?php echo esc_attr($more_title_2 ?: 'More About Product Image 2 Bottom'); ?>" class="img-fluid rounded" /><?php endif; ?>
  </div>
</div>
<?php endif; ?>

   
 

<section style="width:100%; position:relative; padding:40px 0; background-color: var(--featured-bg);">
    <div class="remove-padding-x container" style="background-color: var(--featured-bg);"><!-- Inner container for content alignment -->
        <div class="text-center mb-4">
            <?php
            $reviews_title = get_field('reviews_section_title');
            if (empty($reviews_title)) $reviews_title = 'Reviews';
            ?>
            <h2 class="mb-3"><?php echo esc_html($reviews_title); ?></h2>
            <?php
            $product_rating = get_field('product_rating');
            $number_of_reviews = get_field('number_of_reviews');
            ?>
            <div class="d-flex align-items-top justify-content-center mb-3">
                <div class="product-rating d-flex align-items-center mb-0">
                    <div class="stars me-2" data-rating="<?php echo esc_attr(number_format((float)$product_rating, 1)); ?>">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <div class="star" style="position: relative; display: inline-block; width: 15px; height: 15px;">
                                <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 0; left: 0; z-index: 1;">
                                    <path d="M3.38499 14.6031C3.02311 14.7887 2.61249 14.4634 2.68561 14.0481L3.46374 9.61368L0.160925 6.46743C-0.147512 6.17305 0.0128001 5.63493 0.426238 5.5768L5.01811 4.9243L7.06561 0.86774C7.2503 0.502115 7.74999 0.502115 7.93468 0.86774L9.98218 4.9243L14.5741 5.5768C14.9875 5.63493 15.1478 6.17305 14.8384 6.46743L11.5366 9.61368L12.3147 14.0481C12.3878 14.4634 11.9772 14.7887 11.6153 14.6031L7.49874 12.4881L3.38405 14.6031H3.38499Z" fill="#C4C4C4"/>
                                </svg>
                                <?php if ($i <= floor($product_rating)): ?>
                                    <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 0; left: 0; z-index: 2;">
                                        <path d="M3.38499 14.6031C3.02311 14.7887 2.61249 14.4634 2.68561 14.0481L3.46374 9.61368L0.160925 6.46743C-0.147512 6.17305 0.0128001 5.63493 0.426238 5.5768L5.01811 4.9243L7.06561 0.86774C7.2503 0.502115 7.74999 0.502115 7.93468 0.86774L9.98218 4.9243L14.5741 5.5768C14.9875 5.63493 15.1478 6.17305 14.8384 6.46743L11.5366 9.61368L12.3147 14.0481C12.3878 14.4634 11.9772 14.7887 11.6153 14.6031L7.49874 12.4881L3.38405 14.6031H3.38499Z" fill="#F59E3A"/>
                                    </svg>
                                <?php elseif ($i - 1 < $product_rating && $i > $product_rating): ?>
                                    <?php $percentage = ($product_rating - floor($product_rating)) * 100; ?>
                                    <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 0; left: 0; z-index: 2; clip-path: inset(0 <?php echo 100 - $percentage; ?>% 0 0);">
                                        <path d="M3.38499 14.6031C3.02311 14.7887 2.61249 14.4634 2.68561 14.0481L3.46374 9.61368L0.160925 6.46743C-0.147512 6.17305 0.0128001 5.63493 0.426238 5.5768L5.01811 4.9243L7.06561 0.86774C7.2503 0.502115 7.74999 0.502115 7.93468 0.86774L9.98218 4.9243L14.5741 5.5768C14.9875 5.63493 15.1478 6.17305 14.8384 6.46743L11.5366 9.61368L12.3147 14.0481C12.3878 14.4634 11.9772 14.7887 11.6153 14.6031L7.49874 12.4881L3.38405 14.6031H3.38499Z" fill="#F59E3A"/>
                                    </svg>
                                <?php endif; ?>
                            </div>
                        <?php endfor; ?>
                    </div>
                    <span style="font-weight: 600; color: #575858" class="rating-value me-2"><?php echo esc_html(number_format((float)$product_rating, 1)); ?></span>
                    <span style="font-weight: 600; color: #575858" class="divider me-2">|</span>
                    <span style="font-weight: 600; color: #575858" class="rating-count"><?php echo esc_html($number_of_reviews); ?> Reviews</span>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="testimonials row justify-content-center">
                <?php 
                // Get all testimonials and store valid ones in array
                $valid_testimonials = [];
                for ($i = 1; $i <= 24; $i++) {
                    $text = get_field("testimonial_{$i}_text");
                    if ($text) {
                        $valid_testimonials[] = [
                            'text' => $text,
                            'author' => get_field("testimonial_{$i}_author"),
                            'image' => get_field("testimonial_{$i}_image")
                        ];
                    }
                }
                
                // Display testimonials if there are any
                if (!empty($valid_testimonials)):
                    $total_testimonials = count($valid_testimonials);
                    foreach ($valid_testimonials as $index => $testimonial): 
                        // Add classes to hide testimonials beyond the initial display count
                        $mobile_hidden_class = $index >= 3 ? 'mobile-hidden' : '';
                        $desktop_hidden_class = $index >= 6 ? 'desktop-hidden' : '';
                ?>
                    <div class="col-12 col-md-4 mb-4 testimonial-item <?php echo $mobile_hidden_class; ?> <?php echo $desktop_hidden_class; ?>">
                        <div class="testimonial h-100">
                            <?php if ($testimonial['image']): ?>
                                <img src="<?php echo esc_url($testimonial['image']); ?>" alt="<?php echo esc_attr($testimonial['author']); ?>" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                            <?php endif; ?>
                            <div class="stars mb-2">
                                <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" class="me-1">
                                    <path d="M3.38499 14.6031C3.02311 14.7887 2.61249 14.4634 2.68561 14.0481L3.46374 9.61368L0.160925 6.46743C-0.147512 6.17305 0.0128001 5.63493 0.426238 5.5768L5.01811 4.9243L7.06561 0.86774C7.2503 0.502115 7.74999 0.502115 7.93468 0.86774L9.98218 4.9243L14.5741 5.5768C14.9875 5.63493 15.1478 6.17305 14.8384 6.46743L11.5366 9.61368L12.3147 14.0481C12.3878 14.4634 11.9772 14.7887 11.6153 14.6031L7.49874 12.4881L3.38405 14.6031H3.38499Z" fill="#F59E3A"/>
                                </svg>
                                <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" class="me-1">
                                    <path d="M3.38499 14.6031C3.02311 14.7887 2.61249 14.4634 2.68561 14.0481L3.46374 9.61368L0.160925 6.46743C-0.147512 6.17305 0.0128001 5.63493 0.426238 5.5768L5.01811 4.9243L7.06561 0.86774C7.2503 0.502115 7.74999 0.502115 7.93468 0.86774L9.98218 4.9243L14.5741 5.5768C14.9875 5.63493 15.1478 6.17305 14.8384 6.46743L11.5366 9.61368L12.3147 14.0481C12.3878 14.4634 11.9772 14.7887 11.6153 14.6031L7.49874 12.4881L3.38405 14.6031H3.38499Z" fill="#F59E3A"/>
                                </svg>
                                <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" class="me-1">
                                    <path d="M3.38499 14.6031C3.02311 14.7887 2.61249 14.4634 2.68561 14.0481L3.46374 9.61368L0.160925 6.46743C-0.147512 6.17305 0.0128001 5.63493 0.426238 5.5768L5.01811 4.9243L7.06561 0.86774C7.2503 0.502115 7.74999 0.502115 7.93468 0.86774L9.98218 4.9243L14.5741 5.5768C14.9875 5.63493 15.1478 6.17305 14.8384 6.46743L11.5366 9.61368L12.3147 14.0481C12.3878 14.4634 11.9772 14.7887 11.6153 14.6031L7.49874 12.4881L3.38405 14.6031H3.38499Z" fill="#F59E3A"/>
                                </svg>
                                <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" class="me-1">
                                    <path d="M3.38499 14.6031C3.02311 14.7887 2.61249 14.4634 2.68561 14.0481L3.46374 9.61368L0.160925 6.46743C-0.147512 6.17305 0.0128001 5.63493 0.426238 5.5768L5.01811 4.9243L7.06561 0.86774C7.2503 0.502115 7.74999 0.502115 7.93468 0.86774L9.98218 4.9243L14.5741 5.5768C14.9875 5.63493 15.1478 6.17305 14.8384 6.46743L11.5366 9.61368L12.3147 14.0481C12.3878 14.4634 11.9772 14.7887 11.6153 14.6031L7.49874 12.4881L3.38405 14.6031H3.38499Z" fill="#F59E3A"/>
                            </div>  
                            <blockquote class="blockquote">
                                <p class="mb-0">"<?php echo esc_html($testimonial['text']); ?>"</p>
                                <?php if ($testimonial['author']): ?>
                                    <footer class="blockquote-footer mt-2">- <?php echo esc_html($testimonial['author']); ?></footer>
                                <?php endif; ?>
                            </blockquote>
                        </div>
                    </div>
                <?php 
                    endforeach;
                    
                    // Only show the Load More button if there are more testimonials than the initial display count
                    if ($total_testimonials > 3): 
                ?>
                    <div class="col-12 text-center mt-3">
                        <button id="load-more-reviews" class="btn load-more-reviews">Load More Reviews</button>
                    </div>
                <?php 
                    endif;
                endif; 
                ?>
            </div>
        </div>

        <style>
            /* Custom style for Load More Reviews button */
            .load-more-reviews {
                background-color: #272929;
                color: white;
                font-size: 18px;
                letter-spacing: 10%;
                border-radius: 40px !important;
                padding: 6px 40px;
                border: none;
                transition: opacity 0.2s ease;
            }
            
            .load-more-reviews:hover, 
            .load-more-reviews:focus {
                opacity: 0.85;
                background-color: #272929;
                color: white;
                border: none;
                box-shadow: none;
            }
            
            /* Responsive testimonial layout - 3 per row above 700px, 1 per row at or below 700px */
            @media (max-width: 700px) {
                .testimonials .col-md-4 {
                    width: 100% !important;
                }
                /* Hide testimonials beyond the first 3 on mobile */
                .testimonials .testimonial-item.mobile-hidden {
                    display: none;
                }
            }
            @media (min-width: 701px) {
                .testimonials .col-md-4 {
                    width: 33.333% !important;
                }
                /* Hide testimonials beyond the first 6 on desktop */
                .testimonials .testimonial-item.desktop-hidden {
                    display: none;
                }
            }
        </style>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loadMoreBtn = document.getElementById('load-more-reviews');
            if (!loadMoreBtn) return;
            
            loadMoreBtn.addEventListener('click', function() {
                // Check if we're on mobile or desktop view
                const isMobile = window.innerWidth <= 700;
                
                if (isMobile) {
                    // Show all mobile hidden testimonials
                    document.querySelectorAll('.testimonial-item.mobile-hidden').forEach(item => {
                        item.classList.remove('mobile-hidden');
                    });
                } else {
                    // Show all desktop hidden testimonials
                    document.querySelectorAll('.testimonial-item.desktop-hidden').forEach(item => {
                        item.classList.remove('desktop-hidden');
                    });
                }
                
                // Hide the button after showing all testimonials
                loadMoreBtn.style.display = 'none';
            });
            
            // Handle window resize to adjust which testimonials are visible
            window.addEventListener('resize', function() {
                const isMobile = window.innerWidth <= 700;
                const allShown = isMobile ? 
                    document.querySelectorAll('.testimonial-item.mobile-hidden').length === 0 : 
                    document.querySelectorAll('.testimonial-item.desktop-hidden').length === 0;
                
                // Only show the button if there are hidden testimonials
                if (allShown) {
                    loadMoreBtn.style.display = 'none';
                } else {
                    loadMoreBtn.style.display = 'inline-block';
                }
            });
        });
        </script>
    </div>
</section>

<div class="affiliate-landing-page container"><!-- opening new container div after reviews section -->

    <!-- Insert dynamic FAQs accordion using ACF fields -->
<?php
$faqs = [];
for ($i = 1; $i <= 6; $i++) {
    $q = get_field("faq_question_{$i}");
    $a = get_field("faq_answer_{$i}");
    if ($q && $a) {
        $faqs[] = ['question' => $q, 'answer' => $a];
    }
}
if (!empty($faqs)): 
    // Get the FAQ section title
    $faq_section_title = get_field('faq_section_title');
    if (empty($faq_section_title)) {
        $faq_section_title = 'Frequently Asked Questions'; // Default title if none is set
    }
?>
<div class="faq-section my-5">
    <h2 class="text-start mb-4"><?php echo esc_html($faq_section_title); ?></h2>
    
    <style>
    /* Remove active state styling from accordion buttons */
    .accordion-button:not(.collapsed) {
        color: inherit !important;
        background-color: transparent !important;
        box-shadow: none !important;
    }
    
    /* Ensure the arrow icon still rotates */
    .accordion-button:not(.collapsed)::after {
        transform: rotate(-180deg);
    }
    
    /* Remove all borders except bottom border from FAQ items */
    .accordion-item {
        border: none;
        border-bottom: 1px solid rgba(0,0,0,.125);
    }
    
    /* Remove border from the last accordion item */
    .accordion-item:last-of-type {
        border-bottom: none;
    }
    </style>
    
    <!-- Wrap both columns in one accordion container to coordinate toggling -->
    <div class="accordion" id="faqAccordion">
      <div class="row">
        <div class="col-md-6">
          <?php for ($i = 0; $i < 3; $i++): if (!isset($faqs[$i])) break;
            $faq = $faqs[$i];
            $idHeading = "faqHeading{$i}";
            $idCollapse = "faqCollapse{$i}";
            $isFirst = ($i === 0);
          ?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="<?php echo $idHeading; ?>">
              <button class="accordion-button <?php echo $isFirst ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $idCollapse; ?>" aria-expanded="<?php echo $isFirst ? 'true' : 'false'; ?>" aria-controls="<?php echo $idCollapse; ?>">
                <?php echo esc_html($faq['question']); ?>
              </button>
            </h2>
            <div id="<?php echo $idCollapse; ?>" class="accordion-collapse collapse <?php echo $isFirst ? 'show' : ''; ?>" aria-labelledby="<?php echo $idHeading; ?>" data-bs-parent="#faqAccordion">
              <div class="accordion-body"><?php echo wp_kses_post($faq['answer']); ?></div>
            </div>
          </div>
          <?php endfor; ?>
        </div>
        <div class="col-md-6">
          <?php for ($i = 3; $i < 6; $i++): if (!isset($faqs[$i])) break;
            $faq = $faqs[$i];
            $idx = $i - 3;
            $idHeading = "faqHeading{$i}";
            $idCollapse = "faqCollapse{$i}";
          ?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="<?php echo $idHeading; ?>">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $idCollapse; ?>" aria-expanded="false" aria-controls="<?php echo $idCollapse; ?>">
                <?php echo esc_html($faq['question']); ?>
              </button>
            </h2>
            <div id="<?php echo $idCollapse; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo $idHeading; ?>" data-bs-parent="#faqAccordion">
              <div class="accordion-body"><?php echo wp_kses_post($faq['answer']); ?></div>
            </div>
                   </div>
          <?php endfor; ?>
        </div>
      </div>
    </div>
</div>
<?php endif; ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var container = document.getElementById('faqAccordion');
    if (!container) return;
    var cols = container.querySelectorAll('.col-md-6');
    function adjustHeight() {
        // On mobile (<768px), clear any fixed min-height to avoid empty gaps
        if (window.innerWidth < 768) {
            cols.forEach(function(col) { col.style.minHeight = ''; });
            return;
        }
        var max = 0;
        cols.forEach(function(col) {
            col.style.minHeight = '';
            var h = col.offsetHeight;
            if (h > max) max = h;
        });
        cols.forEach(function(col) {
            col.style.minHeight = max + 'px';
        });
    }
    adjustHeight();
    window.addEventListener('resize', adjustHeight);
    container.addEventListener('shown.bs.collapse', adjustHeight);
    container.addEventListener('hidden.bs.collapse', adjustHeight);
});
</script>
<?php if ($display_top_bar && !empty($countdown_date_str)): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const countdownElement = document.getElementById('top-countdown');
    if (!countdownElement) return;

    // Add time component (end of day) and timezone offset
    const countDownDate = new Date("<?php echo $countdown_date_str; ?>T23:59:59").getTime();

    const updateCountdown = () => {
        const now = new Date().getTime();
        const distance = countDownDate - now;

       

        if (distance < 0) {
            countdownElement.innerHTML = "EXPIRED";
            clearInterval(interval);
            // Optionally hide the countdown element or the whole bar section if expired
            // countdownElement.style.display = 'none'; 
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Format output (e.g., "Offer ends in: 1d 5h 30m 15s")
        let countdownText = "Offer ends in: ";
        if (days > 0) countdownText += days + "d ";
        countdownText += hours.toString().padStart(2, '0') + "h ";
        countdownText += minutes.toString().padStart(2, '0') + "m ";
        countdownText += seconds.toString().padStart(2, '0') + "s";
        
        countdownElement.innerHTML = countdownText;
    };

    const interval = setInterval(updateCountdown, 1000);
    updateCountdown(); // Initial call
});
</script>
<?php endif; ?>
<script>
// Keep track of the currently playing video element
let currentlyPlayingVideo = null;

// Function to pause a video and reset its UI
function pauseAndResetVideo(videoElement) {
    if (videoElement && !videoElement.paused) {
        videoElement.pause();
    }
    // Common reset logic for all videos
    videoElement.removeAttribute('controls');
    const container = videoElement.closest('.position-relative');
    if (container) {
        const playButton = container.querySelector('.play-button, .hero-play-button');
        if (playButton) {
            playButton.style.display = 'block'; // Or 'flex' or 'inline-block'
        }
        const testimonialName = container.querySelector('.testimonial-name');
        if (testimonialName) {
            testimonialName.style.display = ''; // Reset display style to default
        }

        // Specific logic for mobile hero video thumbnail
        const mobileHeroThumbnailForReset = container.querySelector('img[alt="Video Thumbnail"]');
        if (container.classList.contains('mobile-video-wrapper') && mobileHeroThumbnailForReset && videoElement === container.querySelector('video')) {
            mobileHeroThumbnailForReset.style.display = 'block'; // Show thumbnail
            videoElement.style.display = 'none'; // Hide video
        }
    }
    if (currentlyPlayingVideo === videoElement) {
         currentlyPlayingVideo = null;
    }
}

document.addEventListener('click', function(e) {
    var btn = e.target.closest('.play-button, .hero-play-button');
    if (!btn) return;
    var container = btn.closest('.position-relative');
    if (!container) return;
    var video = container.querySelector('video');
    if (!video) return;

    // Pause the previously playing video, if any
    if (currentlyPlayingVideo && currentlyPlayingVideo !== video) {
        pauseAndResetVideo(currentlyPlayingVideo);
    }

    // Play the new video
    btn.style.display = 'none';
    
    // Hide testimonial name when playing starts (for testimonial videos)
    const testimonialName = container.querySelector('.testimonial-name');
    if (testimonialName) {
        testimonialName.style.display = 'none';
    }

    // Specific logic for mobile hero video thumbnail
    const mobileHeroThumbnail = container.querySelector('img[alt="Video Thumbnail"]');
    if (container.classList.contains('mobile-video-wrapper') && mobileHeroThumbnail && video === container.querySelector('video')) {
        mobileHeroThumbnail.style.display = 'none'; // Hide thumbnail
        video.style.display = 'block'; // Show video
    }

    video.muted = false;
    video.volume = 1;
    video.autoplay = true;
    video.setAttribute('controls', '');
    video.play().then(() => {
        currentlyPlayingVideo = video; // Update the currently playing video
    }).catch(function(err){ 
        console.error('Playback failed:', err); 
        // If playback fails, reset the UI
        btn.style.display = 'block';
        video.removeAttribute('controls');
        // Restore thumbnail if it was hidden for mobile hero
        if (container.classList.contains('mobile-video-wrapper') && mobileHeroThumbnail && video === container.querySelector('video')) {
            mobileHeroThumbnail.style.display = 'block'; // Show thumbnail
            video.style.display = 'none'; // Hide video again
        }
    });
});

// Add event listener for carousel slide event
const videoCarouselElement = document.getElementById('videoTestimonialsCarousel');
if (videoCarouselElement) {
    videoCarouselElement.addEventListener('slide.bs.carousel', function (event) {
        // event.from is the index of the outgoing slide
        const outgoingSlide = event.target.querySelectorAll('.carousel-item')[event.from];
        if (outgoingSlide) {
            const videosInOutgoingSlide = outgoingSlide.querySelectorAll('video');
            videosInOutgoingSlide.forEach(video => {
                pauseAndResetVideo(video);
            });
        }
    });
}
</script>

<!-- Fix: This ensures the affiliate-landing-page container is properly closed -->
</div><!-- closing affiliate-landing-page container to fix extra whitespace -->

<style>
/* Fix for whitespace below footer */

</style>

<?php
// Get sticky CTA fields
$sticky_cta_text = get_field('sticky_cta_text');
$sticky_button_text = get_field('sticky_button_text');
$button_1_url = get_field('button_1_url');

// Only show the sticky element if we have text for it
if ($sticky_cta_text && $sticky_button_text):
?>
<div id="sticky-cta-element" class="sticky-cta-element" style="position: fixed; bottom: 18px; left: 0; right: 0; width: 100%; z-index: 9999; display: none;">
    <div class="container" style="padding-bottom:0;">
        <div class="sticky-cta-inner" style="background-color: var(--sticky-footer-bg); border-radius: 60px; padding: 15px 30px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            <div class="sticky-cta-left">
                <div class="sticky-cta-text" style="font-weight: 600; font-size: 1.1rem;">
                    <?php echo esc_html($sticky_cta_text); ?>
                </div>
                <div class="sticky-payment-info d-flex align-items-center mt-2">
                    <?php if (!empty($payment_images) && is_array($payment_images)): ?>
                        <?php
                            $plugin_root_url = plugin_dir_url(__DIR__ . '/../one-pager-affiliate-landing-page.php');
                            // Show only up to 3 payment images to save space
                            $max_display = 2;
                            $count = count($payment_images);
                            $display_images = array_slice($payment_images, 0, $max_display);
                            $remaining_images = array_slice($payment_images, $max_display);
                            foreach ($display_images as $img_file): ?>
                                <img src="<?php echo esc_url($plugin_root_url . 'assets/payments-images/' . $img_file); ?>" class="img-fluid payment-logo me-2" style="max-height: 16px;">
                            <?php endforeach;
                            if ($count > $max_display):
                                $remaining = $count - $max_display;
                                $popover_content = '';
                                foreach ($remaining_images as $file) {
                                    $popover_content .= '<img src=\'' . esc_url($plugin_root_url . 'assets/payments-images/' . $file) . '\' class=\'payment-logo me-2\' />';
                                }
                            ?>
                            <button type="button" class="btn btn-sm btn-outline-secondary payment-more" data-bs-toggle="popover" data-bs-trigger="hover focus click" data-bs-html="true" data-bs-sanitize="false" data-bs-content="<?php echo esc_attr($popover_content); ?>" data-bs-placement="top" style="max-height: 20px; display: flex; align-items: center;">
                                <?php echo '+' . esc_html($remaining); ?>
                            </button>
                            <?php endif; ?>
                        <span class="secure-payments-text" style="font-size: 0.8rem; font-weight: 600;">| Secured Payments</span>
                        
                        <?php if ($money_back_days): ?>
                            <span class="money-back-text ms-2" style="font-size: 0.8rem; font-weight: 700;">| <?php echo esc_html($money_back_days); ?> Days Money Back</span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="sticky-cta-right">
                <a href="<?php echo esc_url($button_1_url); ?>" class="btn btn-primary opalp-bg-primary-button" style="white-space: nowrap; padding: 10px 20px; font-weight: 600;">
                    <?php echo esc_html($sticky_button_text); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
/* Responsive adjustments for sticky CTA */
@media (max-width: 768px) {
    .sticky-cta-element {
        max-width: 100%;
        padding: 0 10px;
    }
    
    .sticky-cta-inner {
        padding: 12px 20px;
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
    
    .sticky-cta-text {
        font-size: 0.95rem;
    }
    
    .sticky-payment-info {
        justify-content: center;
        margin-bottom: 8px;
    }
    
    .sticky-cta-right .btn {
        width: 100%;
    }
}

/* Class to show the sticky CTA when user scrolls */
.sticky-cta-element.show {
    display: block !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const stickyCta = document.getElementById('sticky-cta-element');
    if (!stickyCta) {
        console.log('Sticky CTA element not found!');
        return;
    }
    console.log('Sticky CTA element found, initializing scroll detection');
    
    // Show sticky CTA after user scrolls 200px
    const scrollThreshold = 200;
    
    function handleScroll() {
        const scrollY = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollY > scrollThreshold) {
            if (!stickyCta.classList.contains('show')) {
                console.log('Showing sticky CTA', scrollY);
                stickyCta.classList.add('show');
            }
        } else {
            if (stickyCta.classList.contains('show')) {
                console.log('Hiding sticky CTA', scrollY);
                stickyCta.classList.remove('show');
            }
        }
    }
    
    // Add scroll event listener
    window.addEventListener('scroll', handleScroll);
    
    // Initial check in case page is loaded already scrolled
    handleScroll();
    console.log('Initial scroll position:', window.pageYOffset);
});
</script>

<?php endif; ?>

<?php get_footer(); ?>