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

?>


<div class="affiliate-landing-page container">
    <?php if ($header_logo): ?>
        <div class="header-logo text-center my-4">
            <img src="<?php echo esc_url($header_logo); ?>" alt="Logo" class="img-fluid">
        </div>
    <?php endif; ?>
    <h1 class="text-center my-4" style="margin-top:120px;">Prostate Support by Double Wood</h1>

    <?php if ($hero_video_url): ?>
        <div class="hero-section mb-5" style="margin-top: 100px;">
            <div class="ratio ratio-16x9" style="max-width: 1200px; margin: 0 auto;">
                <iframe src="<?php echo esc_url($hero_video_url); ?>" frameborder="0" allowfullscreen style="border-radius: <?php echo esc_attr(get_option('opalp_video_border_radius', '5px')); ?>;"></iframe>
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