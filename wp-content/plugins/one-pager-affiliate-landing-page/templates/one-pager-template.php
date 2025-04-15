<?php
/*
Template Name: One-Pager Affiliate Template
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header();

// Fetch custom fields
$header_logo = get_field('header_logo');
$hero_video_url = get_field('hero_video_url');
$button_1_text = get_field('button_1_text');
$button_1_url = get_field('button_1_url');

// Add a PHP block to fetch the initial visitor count
$initial_visitor_count = isset($_SESSION['visitor_count']) ? $_SESSION['visitor_count'] : rand(60, 200);

?>


<div class="affiliate-landing-page container">
    <?php if ($header_logo): ?>
        <div class="header-logo text-center my-4">
            <img src="<?php echo esc_url($header_logo); ?>" alt="Logo" class="img-fluid">
        </div>
    <?php endif; ?>
    <h1 class="text-center my-4" style="margin-top:120px;">Prostate Support by Double Wood</h1>
    <div class="visitor-count text-center my-4">
        <span id="visitor-count"> <?php echo $initial_visitor_count; ?> People Are Checking Out This Product Right Now</span>
    </div>

    <?php 
        $product_rating = get_field('product_rating');
        $number_of_reviews = get_field('number_of_reviews');
    ?>

    <div class="product-rating text-center my-4">
        <div class="stars" data-rating="<?php echo esc_attr(number_format((float)$product_rating, 1)); ?>">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <div class="star" style="position: relative; display: inline-block; width: 15px; height: 15px;">
                    <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 0; left: 0; z-index: 1;">
                        <path d="M3.38499 14.6031C3.02311 14.7887 2.61249 14.4634 2.68561 14.0481L3.46374 9.61368L0.160925 6.46743C-0.147512 6.17305 0.0128001 5.63493 0.426238 5.5768L5.01811 4.9243L7.06561 0.86774C7.2503 0.502115 7.74999 0.502115 7.93468 0.86774L9.98218 4.9243L14.5741 5.5768C14.9875 5.63493 15.1478 6.17305 14.8384 6.46743L11.5366 9.61368L12.3147 14.0481C12.3878 14.4634 11.9772 14.7887 11.6153 14.6031L7.49874 12.4881L3.38405 14.6031H3.38499Z" fill="#C4C4C4"/>
                    </svg>
                    <?php if ($i <= floor($product_rating)): ?>
                        <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 0; left: 0; z-index: 2;">
                            <path d="M3.38499 14.6031C3.02311 14.7887 2.61249 14.4634 2.68561 14.0481L3.46374 9.61368L0.160925 6.46743C-0.147512 6.17305 0.0128001 5.63493 0.426238 5.5768L5.01811 4.9243L7.06561 0.86774C7.2503 0.502115 7.74999 0.502115 7.93468 0.86774L9.98218 4.9243L14.5741 5.5768C14.9875 5.63493 15.1478 6.17305 14.8384 6.46743L11.5366 9.61368L12.3147 14.0481C12.3878 14.4634 11.9772 14.7887 11.6153 14.6031L7.49874 12.4881L3.38405 14.6031H3.38499Z" fill="#FFDA6A"/>
                        </svg>
                    <?php elseif ($i - 1 < $product_rating && $i > $product_rating): ?>
                        <?php $percentage = ($product_rating - floor($product_rating)) * 100; ?>
                        <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 0; left: 0; z-index: 2; clip-path: inset(0 <?php echo 100 - $percentage; ?>% 0 0);">
                            <path d="M3.38499 14.6031C3.02311 14.7887 2.61249 14.4634 2.68561 14.0481L3.46374 9.61368L0.160925 6.46743C-0.147512 6.17305 0.0128001 5.63493 0.426238 5.5768L5.01811 4.9243L7.06561 0.86774C7.2503 0.502115 7.74999 0.502115 7.93468 0.86774L9.98218 4.9243L14.5741 5.5768C14.9875 5.63493 15.1478 6.17305 14.8384 6.46743L11.5366 9.61368L12.3147 14.0481C12.3878 14.4634 11.9772 14.7887 11.6153 14.6031L7.49874 12.4881L3.38405 14.6031H3.38499Z" fill="#FFDA6A"/>
                        </svg>
                    <?php endif; ?>
                </div>
            <?php endfor; ?>
        </div>
        <div class="rating-info">
            <?php echo esc_html(number_format((float)$product_rating, 1)); ?> | <?php echo esc_html($number_of_reviews); ?> Reviews
        </div>
    </div>

    <?php 
        $price = get_field('price');
        $discount_price = get_field('discount_price');
        $discount_percentage = $discount_price ? round((($price - $discount_price) / $price) * 100) : null;
    ?>

    <?php if ($price): ?>
        <div class="product-pricing text-center my-4">
            <?php if ($discount_price): ?>
                <div class="discount-percentage" style="color: var(--accent-color); font-weight: bold;">
                    -<?php echo esc_html($discount_percentage); ?>%
                </div>
                <div class="old-price" style="text-decoration: line-through;">
                    $<?php echo esc_html(number_format($price, 2)); ?>
                </div>
                <div class="new-price" style="color: var(--accent-color); font-size: 1.5em; font-weight: bold;">
                    $<?php echo esc_html(number_format($discount_price, 2)); ?>
                </div>
            <?php else: ?>
                <div class="price" style="font-size: 1.5em; font-weight: bold;">
                    $<?php echo esc_html(number_format($price, 2)); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php 
        $hero_video_file = get_field('hero_video_file');
    ?>

    <?php if ($hero_video_file): ?>
        <div class="hero-section mb-5" style="margin-top: 100px;">
            <div class="video-wrapper" style="max-width: 1200px; margin: 0 auto;">
                <video controls style="width: 100%; border-radius: 5px;">
                    <source src="<?php echo esc_url($hero_video_file); ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!$hero_video_file && $hero_video_url): ?>
        <div class="hero-section mb-5" style="margin-top: 100px;">
            <div class="ratio ratio-16x9" style="max-width: 1200px; margin: 0 auto;">
                <iframe src="<?php echo esc_url($hero_video_url); ?>" frameborder="0" allowfullscreen style="border-radius: 5px;"></iframe>
            </div>
        </div>
    <?php endif; ?>

    

    <div class="text-center mb-5" style="margin-top:-250px;" >
            <a href="<?php echo esc_url($button_1_url); ?>" class="btn btn-primary btn-lg" style="margin-bottom: 50px;">
                <?php echo esc_html($button_1_text); ?>
            </a>
        </div>

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
        <a href="<?php echo esc_url($button_1_url); ?>" class="btn btn-primary btn-lg">
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