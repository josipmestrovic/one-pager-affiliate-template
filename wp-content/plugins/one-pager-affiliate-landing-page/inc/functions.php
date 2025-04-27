<?php
// Functions for One-Pager Affiliate Landing Page Plugin

// Function to render the landing page
function render_affiliate_landing_page() {
    ob_start();
    ?>
    <div class="affiliate-landing-page">
        <h1>Welcome to Our Affiliate Program</h1>
        <p>Join us and start earning today!</p>
        <form id="affiliate-form" method="post" action="">
            <input type="text" name="affiliate_email" placeholder="Enter your email" required>
            <button type="submit">Join Now</button>
        </form>
    </div>
    <?php
    return ob_get_clean();
}

// Function to handle form submissions
function handle_affiliate_form_submission() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['affiliate_email'])) {
        $email = sanitize_email($_POST['affiliate_email']);
        // Process the email (e.g., save to database, send confirmation, etc.)
        // This is a placeholder for actual processing logic
        // wp_mail($email, 'Welcome!', 'Thank you for joining our affiliate program!');
    }
}
add_action('init', 'handle_affiliate_form_submission');

// Enqueue styles and scripts
function opalp_enqueue_assets() {
    wp_enqueue_style('opalp-style', plugin_dir_url(__FILE__) . '../assets/css/style.css');
    wp_enqueue_script('opalp-script', plugin_dir_url(__FILE__) . '../assets/js/script.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'opalp_enqueue_assets');

// Enqueue Font Awesome 5
function opalp_enqueue_font_awesome() {
    wp_enqueue_style('font-awesome-5', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4');
}
add_action('wp_enqueue_scripts', 'opalp_enqueue_font_awesome');

// Enqueue Bootstrap CSS and JS
function opalp_enqueue_bootstrap() {
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css', array(), '5.3.0-alpha1');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.0-alpha1', true);
}
add_action('wp_enqueue_scripts', 'opalp_enqueue_bootstrap');

// Enqueue the selected Google Font
function opalp_enqueue_google_font() {
    $font_family = get_option('opalp_font_family', 'Arial, sans-serif');
    $font_name = explode(',', $font_family)[0];
    $font_name = str_replace(' ', '+', $font_name);
    wp_enqueue_style('opalp-google-font', 'https://fonts.googleapis.com/css2?family=' . $font_name . ':wght@400;600;700&display=swap', [], null);
}
add_action('wp_enqueue_scripts', 'opalp_enqueue_google_font');





