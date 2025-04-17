<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
// Include the countdown logic file
require_once WP_PLUGIN_DIR . '/one-pager-affiliate-landing-page/inc/countdown-logic.php';

// Fetch the countdown date from custom fields
$countdown_date = get_field('countdown_date');
?>

<?php if ($countdown_date): ?>
    <div class="countdown-header" style="background-color: #292929; color: #f5f5f5; height:50px; text-align: center; padding: 10px; display: flex; align-items: center; justify-content: center;">
      <span style="margin-right: 5px;">Offer ending in</span>
      <span><?php opalp_render_countdown_script($countdown_date); ?></span>
    </div>
<?php endif; ?>
</body>
</html>
