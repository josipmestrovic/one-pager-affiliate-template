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
    wp_enqueue_style('opalp-google-font', 'https://fonts.googleapis.com/css2?family=' . $font_name . ':wght@400;700&display=swap', [], null);
}
add_action('wp_enqueue_scripts', 'opalp_enqueue_google_font');

// Add dynamic styles for primary color
function opalp_add_dynamic_styles() {
    $primary_color = get_option('opalp_primary_color', '#0073aa');
    echo '<style>
        .btn-primary {
            background-color: ' . esc_attr($primary_color) . ' !important;
            border-color: ' . esc_attr($primary_color) . ' !important;
        }
        .btn-primary:hover {
            background-color: ' . esc_attr($primary_color) . 'cc !important;
        }
    </style>';
}
add_action('wp_head', 'opalp_add_dynamic_styles');

// Add dynamic styles for secondary color
function opalp_add_secondary_dynamic_styles() {
    $secondary_color = get_option('opalp_secondary_color', '#6c757d');
    echo '<style>
        .btn-secondary {
            background-color: ' . esc_attr($secondary_color) . ' !important;
            border-color: ' . esc_attr($secondary_color) . ' !important;
        }
        .btn-secondary:hover {
            background-color: ' . esc_attr($secondary_color) . 'cc !important;
        }
    </style>';
}
add_action('wp_head', 'opalp_add_secondary_dynamic_styles');

// Add dynamic styles for font family
function opalp_add_font_family_styles() {
    $header_font_family = get_option('opalp_header_font_family', 'Arial, sans-serif');
    $paragraph_font_family = get_option('opalp_paragraph_font_family', 'Arial, sans-serif');
    echo '<style>
        h1, h2, h3, h4, h5, h6 {
            font-family: ' . esc_attr($header_font_family) . ' !important;
        }
        p, span, li, .btn {
            font-family: ' . esc_attr($paragraph_font_family) . ' !important;
        }
    </style>';
}
add_action('wp_head', 'opalp_add_font_family_styles');

// Add settings page for the plugin
function opalp_add_settings_page() {
    add_menu_page(
        'One-Pager Settings',
        'One-Pager Settings',
        'manage_options',
        'opalp-settings',
        'opalp_render_settings_page',
        'dashicons-admin-generic',
        80
    );
}
add_action('admin_menu', 'opalp_add_settings_page');

// Render the settings page
function opalp_render_settings_page() {
    ?>
    <div class="wrap">
        <h1>One-Pager Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('opalp_settings_group');
            do_settings_sections('opalp-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings
function opalp_register_settings() {
    register_setting('opalp_settings_group', 'opalp_primary_color');
    register_setting('opalp_settings_group', 'opalp_font_family');
    register_setting('opalp_settings_group', 'opalp_secondary_color');
    register_setting('opalp_settings_group', 'opalp_header_font_family');
    register_setting('opalp_settings_group', 'opalp_paragraph_font_family');

    add_settings_section(
        'opalp_styles_section',
        'Styles Settings',
        null,
        'opalp-settings'
    );

    add_settings_field(
        'opalp_primary_color',
        'Primary Color',
        'opalp_primary_color_callback',
        'opalp-settings',
        'opalp_styles_section'
    );

    add_settings_field(
        'opalp_font_family',
        'Font Family',
        'opalp_google_fonts_callback',
        'opalp-settings',
        'opalp_styles_section'
    );

    add_settings_field(
        'opalp_secondary_color',
        'Secondary Color',
        function() {
            $value = get_option('opalp_secondary_color', '#6c757d');
            echo '<input type="text" name="opalp_secondary_color" value="' . esc_attr($value) . '" placeholder="#6c757d" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$" title="Enter a valid hex color code (e.g., #6c757d)">';
        },
        'opalp-settings',
        'opalp_styles_section'
    );

    add_settings_field(
        'opalp_header_font_family',
        'Header Font Family',
        'opalp_header_font_callback',
        'opalp-settings',
        'opalp_styles_section'
    );

    add_settings_field(
        'opalp_paragraph_font_family',
        'Paragraph Font Family',
        'opalp_paragraph_font_callback',
        'opalp-settings',
        'opalp_styles_section'
    );
}
add_action('admin_init', 'opalp_register_settings');

// Callbacks for settings fields
function opalp_primary_color_callback() {
    $value = get_option('opalp_primary_color', '#0073aa');
    echo '<input type="text" name="opalp_primary_color" value="' . esc_attr($value) . '" placeholder="#6f12cb" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$" title="Enter a valid hex color code (e.g., #6f12cb)">';
}

function opalp_google_fonts_callback() {
    $fonts = [
        'Arial, sans-serif' => 'Arial',
        'Roboto, sans-serif' => 'Roboto',
        'Open Sans, sans-serif' => 'Open Sans',
        'Lato, sans-serif' => 'Lato',
        'Montserrat, sans-serif' => 'Montserrat',
        'Oswald, sans-serif' => 'Oswald',
        'Raleway, sans-serif' => 'Raleway',
        'Poppins, sans-serif' => 'Poppins',
        'Merriweather, serif' => 'Merriweather',
        'Playfair Display, serif' => 'Playfair Display'
    ];

    $selected_font = get_option('opalp_font_family', 'Arial, sans-serif');
    echo '<select name="opalp_font_family">';
    foreach ($fonts as $font_value => $font_name) {
        $selected = $selected_font === $font_value ? 'selected' : '';
        echo '<option value="' . esc_attr($font_value) . '" ' . $selected . '>' . esc_html($font_name) . '</option>';
    }
    echo '</select>';
}

function opalp_font_family_callback() {
    $value = get_option('opalp_font_family', 'Arial, sans-serif');
    echo '<input type="text" name="opalp_font_family" value="' . esc_attr($value) . '">';
}

function opalp_header_font_callback() {
    $fonts = [
        'Arial, sans-serif' => 'Arial',
        'Roboto, sans-serif' => 'Roboto',
        'Open Sans, sans-serif' => 'Open Sans',
        'Lato, sans-serif' => 'Lato',
        'Montserrat, sans-serif' => 'Montserrat',
        'Oswald, sans-serif' => 'Oswald',
        'Raleway, sans-serif' => 'Raleway',
        'Poppins, sans-serif' => 'Poppins',
        'Merriweather, serif' => 'Merriweather',
        'Playfair Display, serif' => 'Playfair Display'
    ];

    $selected_font = get_option('opalp_header_font_family', 'Arial, sans-serif');
    echo '<select name="opalp_header_font_family">';
    foreach ($fonts as $font_value => $font_name) {
        $selected = $selected_font === $font_value ? 'selected' : '';
        echo '<option value="' . esc_attr($font_value) . '" ' . $selected . '>' . esc_html($font_name) . '</option>';
    }
    echo '</select>';
}

function opalp_paragraph_font_callback() {
    $fonts = [
        'Arial, sans-serif' => 'Arial',
        'Roboto, sans-serif' => 'Roboto',
        'Open Sans, sans-serif' => 'Open Sans',
        'Lato, sans-serif' => 'Lato',
        'Montserrat, sans-serif' => 'Montserrat',
        'Oswald, sans-serif' => 'Oswald',
        'Raleway, sans-serif' => 'Raleway',
        'Poppins, sans-serif' => 'Poppins',
        'Merriweather, serif' => 'Merriweather',
        'Playfair Display, serif' => 'Playfair Display'
    ];

    $selected_font = get_option('opalp_paragraph_font_family', 'Arial, sans-serif');
    echo '<select name="opalp_paragraph_font_family">';
    foreach ($fonts as $font_value => $font_name) {
        $selected = $selected_font === $font_value ? 'selected' : '';
        echo '<option value="' . esc_attr($font_value) . '" ' . $selected . '>' . esc_html($font_name) . '</option>';
    }
    echo '</select>';
}

// Enqueue both Google Fonts
function opalp_enqueue_google_fonts() {
    $header_font_family = get_option('opalp_header_font_family', 'Arial, sans-serif');
    $paragraph_font_family = get_option('opalp_paragraph_font_family', 'Arial, sans-serif');

    $header_font_name = explode(',', $header_font_family)[0];
    $header_font_name = str_replace(' ', '+', $header_font_name);

    $paragraph_font_name = explode(',', $paragraph_font_family)[0];
    $paragraph_font_name = str_replace(' ', '+', $paragraph_font_name);

    wp_enqueue_style('opalp-google-font-header', 'https://fonts.googleapis.com/css2?family=' . $header_font_name . ':wght@400;700&display=swap', [], null);
    wp_enqueue_style('opalp-google-font-paragraph', 'https://fonts.googleapis.com/css2?family=' . $paragraph_font_name . ':wght@400;700&display=swap', [], null);
}
add_action('wp_enqueue_scripts', 'opalp_enqueue_google_fonts');

