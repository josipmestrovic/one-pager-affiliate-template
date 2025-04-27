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
:root { --primary-button-bg: <?php echo esc_attr($get_primary_btn_color); ?>; }
<?php endif; ?>
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
    .as-seen-on-section .d-flex > div {
        margin: 0 15px !important;
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
        display: block !important;
        text-align: center;
    }
    .video-testimonials .carousel-control-prev,
    .video-testimonials .carousel-control-next {
        position: relative !important;
        display: inline-block !important;
        width: auto !important;
        transform: none !important;
        background: transparent !important;
        margin: 10px 5px 0 !important;
        left: auto !important;
        right: auto !important;
    }
}

/* Facts & Use Inline Overrides */
.facts-use .facts-list ul {
    display: flex !important;
    flex-wrap: nowrap !important;
    list-style: none;
    margin: 0;
    padding: 0;
}
.facts-use .facts-list ul .list-inline-item {
    display: inline-flex !important;
    align-items: center;
}
.facts-use .label-images {
    display: flex !important;
    flex-wrap: nowrap !important;
    gap: 0.5rem;
}
.facts-use .label-images img {
    display: inline-block;
    height: auto;
    max-height: 50px;
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
<div class="top-header-bar" style="background-color: var(--header-footer-bg); color: #FFFFFF; font-size: 20px; padding: 12px 0; width: 100%; text-align: center;">
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
<?php endif; 
// --- End Top Bar Logic ---
?>


<?php 
$hero_video_file = get_field('hero_video_file');
$hero_video_url = get_field('hero_video_url');
$fallback_hero_image = get_field('fallback_hero_image');
$video_description = get_field('video_description');
?>

<div class="container my-5" style="margin-top:0px !important;">
  <div class="row gx-5 align-items-center">
    <div class="col-md-6 desktop-video-wrapper" style="margin-top: -10px;">
      <?php if ($hero_video_file): ?>
        <div class="video-wrapper">
          <video controls class="img-fluid rounded">
            <source src="<?php echo esc_url($hero_video_file); ?>" type="video/mp4">
            Your browser does not support the video tag.
          </video>
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
            <div class="mobile-video-wrapper mb-4">
                <?php if ($hero_video_file): ?>
                    <video controls class="img-fluid rounded">
                        <source src="<?php echo esc_url($hero_video_file); ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                <?php elseif ($hero_video_url): ?>
                    <div class="ratio ratio-16x9">
                        <iframe src="<?php echo esc_url($hero_video_url); ?>" frameborder="0" allowfullscreen class="rounded"></iframe>
                    </div>
                <?php elseif ($fallback_hero_image): ?>
                    <img src="<?php echo esc_url($fallback_hero_image); ?>" alt="" class="img-fluid rounded" />
                <?php endif; ?>
                <?php if ($video_description): ?>
                    <div class="video-description">
                        <p><?php echo esc_html($video_description); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php
            $price = get_field('price');
            $discount_price = get_field('discount_price');
            $discount_percentage = ($price && $discount_price && $price > 0) ? round((($price - $discount_price) / $price) * 100) : null;
            $bonus_offer_text = get_field('bonus_offer_text');
        ?>
        <div class="product-pricing my-4" style="margin-bottom:-18px !important;">
            <?php if ($discount_price && $discount_percentage !== null): ?>
                <div class="d-flex align-items-center">
                    <div class="old-price me-3" style="text-decoration: line-through; font-size: 1.5em !important; font-weight: 700;">
                        $<?php echo esc_html(number_format($price, 2)); ?>
                    </div>
                    <div class="price-arrow-wrapper text-center me-3" style="margin-bottom:30px;">
                        <div class="discount-percentage mb-1" style="margin-left:-35px; margin-bottom: -5px !important; font-size:20px !important; font-weight: 700;">-<?php echo esc_html($discount_percentage); ?>%</div>
                        <svg width="30" height="24" viewBox="0 0 30 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M29.0607 13.0607C29.6464 12.4749 29.6464 11.5251 29.0607 10.9393L19.5147 1.3934C18.9289 0.807611 17.9792 0.807611 17.3934 1.3934C16.8076 1.97919 16.8076 2.92893 17.3934 3.51472L25.8787 12L17.3934 20.4853C16.8076 21.0711 16.8076 22.0208 17.3934 22.6066C17.9792 23.1924 18.9289 23.1924 19.5147 22.6066L29.0607 13.0607ZM0 12V13.5H28V12V10.5H0V12Z" fill="black"/>
                        </svg>
                    </div>
                    <div class="new-price me-3" style="font-size: 1.5em; font-weight: bold;">
                        $<?php echo esc_html(number_format($discount_price, 2)); ?>
                    </div>
                    <?php if ($bonus_offer_text): ?>
                        <span class="bonus-offer"  style="color: #575858 !important;">+ <?php echo esc_html($bonus_offer_text); ?></span>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="d-inline-block" style="font-size: 1.5em; font-weight: bold;">
                    $<?php echo esc_html(number_format($price, 2)); ?>
                </div>
                <?php if ($bonus_offer_text): ?>
                    <span class="bonus-offer ms-2">+ <?php echo esc_html($bonus_offer_text); ?></span>
                <?php endif; ?>
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


<div class="affiliate-landing-page container">
    <?php
        $as_seen_on_title = get_field('as_seen_on_title');
        $as_seen_on_images = array(
            get_field('as_seen_on_image_1'),
            get_field('as_seen_on_image_2'),
            get_field('as_seen_on_image_3'),
        );
    ?>
    <?php if ($as_seen_on_title): ?>
    <section class="as-seen-on-section opalp-bg-featured" style="width:100vw; position:relative; left:50%; right:50%; margin-left:-50vw; margin-right:-50vw; padding:40px 0;">
        <?php if ($as_seen_on_title): ?>
            <h2 class="text-center mb-4"><?php echo esc_html($as_seen_on_title); ?></h2>
        <?php endif; ?>
        <div class="d-flex justify-content-center align-items-center" style="overflow-x:hidden;">
            <?php foreach ($as_seen_on_images as $img): if ($img): ?>
                <div style="flex:0 1 auto; margin:0 65px;">
                    <img src="<?php echo esc_url($img); ?>" alt="" style="max-height:88px; width:auto; aspect-ratio:1/1; object-fit:contain;" />
                </div>
            <?php endif; endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <?php
        // Fetch Short Product About fields
        $short_about_title = get_field('short_about_title');
        $short_about_description = get_field('short_about_description');
        $short_about_image = get_field('short_about_image');
    ?>
    <?php if ($short_about_title || $short_about_description || $short_about_image): ?>
    <section class="short-product-about" style="padding:40px 0;">
        <div class="row align-items-center">
            <div class="col-md-6">
                <?php if ($short_about_title): ?>
                    <h2 class="mb-4"><?php echo esc_html($short_about_title); ?></h2>
                <?php endif; ?>
                <?php if ($short_about_description): ?>
                    <?php echo wp_kses_post($short_about_description); ?>
                <?php endif; ?>
            </div>
            <?php if ($short_about_image): ?>
            <div class="col-md-6 text-center">
                <img src="<?php echo esc_url($short_about_image); ?>" alt="" class="img-fluid" />
            </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <?php
    // Video Testimonials Section
    $videos = array(
        array('file' => get_field('video_testimonial_1_file'), 'description' => get_field('video_testimonial_1_description')),
        array('file' => get_field('video_testimonial_2_file'), 'description' => get_field('video_testimonial_2_description')),
        array('file' => get_field('video_testimonial_3_file'), 'description' => get_field('video_testimonial_3_description')),
    );
    $valid_videos = array_filter($videos, function($v) { return !empty($v['file']); });

    if (!empty($valid_videos)): ?>
    <section class="video-testimonials py-5">
        <div class="container">
            <h2 class="mb-4 text-center">Video Testimonials</h2>
            <?php if (count($valid_videos) > 1): ?>
            <div id="videoTestimonialsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach ($valid_videos as $index => $video): ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <div class="carousel-content-wrapper">
                        <div class="row align-items-center">
                            <div class="col-md-7 mb-3 mb-md-0">
                                <video controls class="img-fluid rounded" style="max-height: 600px; width: 100%; object-fit: contain;">
                                    <source src="<?php echo esc_url($video['file']); ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="col-md-5">
                                <?php if (!empty($video['description'])): ?>
                                <p><?php echo esc_html($video['description']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        </div> <!-- /.carousel-content-wrapper -->
                    </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#videoTestimonialsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#videoTestimonialsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <?php else: // Only one video
                $video = reset($valid_videos); ?>
            <div class="row align-items-center">
                <div class="col-md-7 mb-3 mb-md-0">
                     <video controls class="img-fluid rounded" style="max-height: 600px; width: 100%; object-fit: contain;">
                        <source src="<?php echo esc_url($video['file']); ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="col-md-5">
                    <?php if (!empty($video['description'])): ?>
                    <p><?php echo esc_html($video['description']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>  <!-- end Video Testimonials -->

  
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
          <div class="col-md-6">
            <h2 class="mb-4"><?php echo esc_html($facts_title ?: 'Facts & Use'); ?></h2>
            <?php if ($facts_content): ?>
              <div><?php echo wp_kses_post($facts_content); ?></div>
            <?php endif; ?>
          </div>
          <div class="col-md-6">
            <?php if ($facts_image): ?>
              <div class="mb-4 text-center facts-image-wrapper">
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
              <div class="label-images d-flex flex-wrap align-items-center mb-3">
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


  <!-- What Do Experts Say Section -->
    <?php
    $experts_title = get_field('experts_title');
    $experts = array(
        array('video' => get_field('expert_1_video'), 'image' => get_field('expert_1_image'), 'name' => get_field('expert_1_name'), 'title' => get_field('expert_1_title'), 'text' => get_field('expert_1_text')),
        array('video' => get_field('expert_2_video'), 'image' => get_field('expert_2_image'), 'name' => get_field('expert_2_name'), 'title' => get_field('expert_2_title'), 'text' => get_field('expert_2_text')),
        array('video' => get_field('expert_3_video'), 'image' => get_field('expert_3_image'), 'name' => get_field('expert_3_name'), 'title' => get_field('expert_3_title'), 'text' => get_field('expert_3_text')),
    );
    $expert_videos = array_filter(array_column($experts, 'video'));
    if (!empty($expert_videos)): ?>
    <section class="experts-say py-5">
        <div class="container">
            <?php if ($experts_title): ?><h2 class="mb-4 text-center"><?php echo esc_html($experts_title); ?></h2><?php endif; ?>
            <div id="expertsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach ($experts as $index => $expert): if (empty($expert['video'])) continue; ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <?php if ($expert['image']): ?><img src="<?php echo esc_url($expert['image']); ?>" alt="" class="img-fluid mb-3" /><?php endif; ?>
                                <?php if ($expert['name']): ?><h5><?php echo esc_html($expert['name']); ?></h5><?php endif; ?>
                                <?php if ($expert['title']): ?><h6 class="text-muted"><?php echo esc_html($expert['title']); ?></h6><?php endif; ?>
                                <?php if ($expert['text']): ?><p><?php echo esc_html($expert['text']); ?></p><?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <video controls class="img-fluid rounded"><source src="<?php echo esc_url($expert['video']); ?>" type="video/mp4"></video>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php if (count($expert_videos) > 1): ?>
                <button class="carousel-control-prev" type="button" data-bs-target="#expertsCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                <button class="carousel-control-next" type="button" data-bs-target="#expertsCarousel" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></button>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php elseif ($experts_title || count(array_filter(array_column($experts, 'image')))): ?>
    <section class="experts-say py-5">
        <div class="container">
            <?php if ($experts_title): ?><h2 class="mb-4 text-center"><?php echo esc_html($experts_title); ?></h2><?php endif; ?>
            <div class="row">
                <?php
                $valid = array_filter($experts, function($e){ return $e['image']||$e['name']||$e['title']||$e['text'];});
                $cols = count($valid)?12/count($valid):12;
                foreach ($valid as $expert): ?>
                <div class="col-md-<?php echo esc_attr($cols); ?> mb-4">
                    <?php if ($expert['image']): ?><img src="<?php echo esc_url($expert['image']); ?>" alt="" class="img-fluid mb-3" /><?php endif; ?>
                    <?php if ($expert['name']): ?><h5><?php echo esc_html($expert['name']); ?></h5><?php endif; ?>
                    <?php if ($expert['title']): ?><h6 class="text-muted"><?php echo esc_html($expert['title']); ?></h6><?php endif; ?>
                    <?php if ($expert['text']): ?><p><?php echo esc_html($expert['text']); ?></p><?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

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
<div class="container row align-items-center mb-5" style="margin: 40px auto;">
  <div class="col-md-6">
    <?php if ($more_title_1): ?><h2 class="mb-3"><?php echo esc_html($more_title_1); ?></h2><?php endif; ?>
    <?php if ($more_content_1): ?><div><?php echo wp_kses_post($more_content_1); ?></div><?php endif; ?>
  </div>
  <div class="col-md-6">
    <?php if ($img_top_1): ?><img src="<?php echo esc_url($img_top_1); ?>" alt="<?php echo esc_attr($more_title_1 ?: 'More About Product Image 1 Top'); ?>" class="img-fluid mb-3 rounded" /><?php endif; ?>
    <?php if ($img_bottom_1): ?><img src="<?php echo esc_url($img_bottom_1); ?>" alt="<?php echo esc_attr($more_title_1 ?: 'More About Product Image 1 Bottom'); ?>" class="img-fluid rounded" /><?php endif; ?>
  </div>
</div>
<?php endif; ?>

<?php // More About Product - Section 2 (Images Left, Text Right)
if ($more_title_2 || $more_content_2 || $img_top_2 || $img_bottom_2): ?>
<div class="more-about-section-2 row align-items-center mb-5" style="max-width: 1200px; margin: 40px auto;">
  <div class="col-md-6 order-md-2">
    <?php if ($more_title_2): ?><h2 class="mb-3"><?php echo esc_html($more_title_2); ?></h2><?php endif; ?>
    <?php if ($more_content_2): ?><div><?php echo wp_kses_post($more_content_2); ?></div><?php endif; ?>
  </div>
  <div class="col-md-6 order-md-1">
    <?php if ($img_top_2): ?><img src="<?php echo esc_url($img_top_2); ?>" alt="<?php echo esc_attr($more_title_2 ?: 'More About Product Image 2 Top'); ?>" class="img-fluid mb-3 rounded" /><?php endif; ?>
    <?php if ($img_bottom_2): ?><img src="<?php echo esc_url($img_bottom_2); ?>" alt="<?php echo esc_attr($more_title_2 ?: 'More About Product Image 2 Bottom'); ?>" class="img-fluid rounded" /><?php endif; ?>
  </div>
</div>
<?php endif; ?>

    <!-- Blurbs Section -->
    <div class="blurbs row justify-content-between text-center mb-5" style="max-width: 1200px; margin: 0 auto;">
        <?php for ($i = 1; $i <= 3; $i++): ?>
            <?php 
                $icon_class = get_field("blurb_{$i}_icon_class");
                $title = get_field("blurb_{$i}_title");
                $text = get_field("blurb_{$i}_text");
            ?>
            <?php if ($title && $text): ?>
                <div class="col-md-3 col-sm-6 mb-4 text-start">
                    <div class="blurb">
                        <i class="<?php echo esc_attr($icon_class); ?> fa-3x mb-3"></i>
                        <h3><?php echo esc_html($title); ?></h3>
                        <p><?php echo esc_html($text); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        <?php endfor; ?>
    </div>

    <div class="common-section-1 row align-items-center mb-5" style="max-width: 1200px; margin: 0 auto;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?php echo esc_url(get_field('section_1_image')); ?>" alt="Section 1 Image" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h2><?php echo esc_html(get_field('section_1_title')); ?></h2>
                    <div><?php echo wp_kses_post(get_field('section_1_paragraph')); ?></div>
                    <a href="<?php echo esc_url(get_field('button_1_url')); ?>" class="btn btn-secondary">
                        <?php echo esc_html(get_field('button_1_text')); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="common-section-2 row align-items-center mb-5" style="max-width: 1200px; margin: 0 auto;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-2">
                    <img src="<?php echo esc_url(get_field('section_2_image')); ?>" alt="Section 2 Image" class="img-fluid">
                </div>
                <div class="col-md-6 order-md-1">
                    <h2><?php echo esc_html(get_field('section_2_title')); ?></h2>
                    <div><?php echo wp_kses_post(get_field('section_2_paragraph')); ?></div>
                    <a href="<?php echo esc_url(get_field('button_1_url')); ?>" class="btn btn-secondary">
                        <?php echo esc_html(get_field('button_1_text')); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="testimonials row justify-content-between text-center mb-5" style="max-width: 1200px; margin: 0 auto;">
        <?php for ($i = 1; $i <= 3; $i++): ?>
            <?php 
                $text = get_field("testimonial_{$i}_text");
                $author = get_field("testimonial_{$i}_author");
                $image = get_field("testimonial_{$i}_image");
            ?>
            <?php if ($text): ?>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="testimonial">
                        <?php if ($image): ?>
                            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($author); ?>" class="rounded-circle mb-3" style="width: 80px; height: 80px;">
                        <?php endif; ?>
                        <div class="stars mb-2">
                            <i class="fas fa-star" style="color: #FFD700;"></i>
                            <i class="fas fa-star" style="color: #FFD700;"></i>
                            <i class="fas fa-star" style="color: #FFD700;"></i>
                            <i class="fas fa-star" style="color: #FFD700;"></i>
                            <i class="fas fa-star" style="color: #FFD700;"></i>
                        </div>
                        <blockquote class="blockquote">
                            <p class="mb-0">"<?php echo esc_html($text); ?>"</p>
                            <?php if ($author): ?>
                                <footer class="blockquote-footer mt-2">- <?php echo esc_html($author); ?></footer>
                            <?php endif; ?>
                        </blockquote>
                    </div>
                </div>
            <?php endif; ?>
        <?php endfor; ?>
    </div>

    <div class="text-center mb-5">
        <a href="<?php echo esc_url($button_1_url); ?>" class="btn btn-primary opalp-bg-primary-button btn-lg">
            <?php echo esc_html($button_1_text); ?>
        </a>
    </div>


    <div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Accordion Item #1
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Accordion Item #2
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Accordion Item #3
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
</div>

</div>

<?php
get_footer();
?>

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