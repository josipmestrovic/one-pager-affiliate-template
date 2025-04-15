<?php
// Register custom fields programmatically for the One-Pager Affiliate Landing Page Plugin

function opalp_register_custom_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_one_pager_fields',
            'title' => 'One-Pager Fields',
            'fields' => array(
                array(
                    'key' => 'field_countdown_date',
                    'label' => 'Countdown Date',
                    'name' => 'countdown_date',
                    'type' => 'date_picker',
                    'instructions' => 'Select the date for the countdown.',
                    'return_format' => 'Y-m-d',
                ),
                array(
                    'key' => 'field_header_logo',
                    'label' => 'Header Logo',
                    'name' => 'header_logo',
                    'type' => 'image',
                    'instructions' => 'Upload the logo for the header.',
                    'return_format' => 'url',
                ),
                array(
                    'key' => 'field_hero_video_url',
                    'label' => 'Hero Video URL',
                    'name' => 'hero_video_url',
                    'type' => 'url',
                    'instructions' => 'Enter the YouTube URL for the hero video.',
                ),
                array(
                    'key' => 'field_hero_video_file',
                    'label' => 'Hero Video File',
                    'name' => 'hero_video_file',
                    'type' => 'file',
                    'instructions' => 'Upload the MP4 file for the hero video.',
                    'return_format' => 'url',
                    'mime_types' => 'mp4',
                ),
                array(
                    'key' => 'field_blurb_1_icon_class',
                    'label' => 'Blurb 1 Icon Class',
                    'name' => 'blurb_1_icon_class',
                    'type' => 'text',
                    'instructions' => 'Enter the CSS class for the blurb icon (e.g., Font Awesome class).',
                ),
                array(
                    'key' => 'field_blurb_1_title',
                    'label' => 'Blurb 1 Title',
                    'name' => 'blurb_1_title',
                    'type' => 'text',
                    'instructions' => 'Enter the title for the first blurb.',
                ),
                array(
                    'key' => 'field_blurb_1_text',
                    'label' => 'Blurb 1 Text',
                    'name' => 'blurb_1_text',
                    'type' => 'textarea',
                    'instructions' => 'Enter the text for the first blurb.',
                ),
                array(
                    'key' => 'field_blurb_2_icon_class',
                    'label' => 'Blurb 2 Icon Class',
                    'name' => 'blurb_2_icon_class',
                    'type' => 'text',
                    'instructions' => 'Enter the CSS class for the second blurb icon (e.g., Font Awesome class).',
                ),
                array(
                    'key' => 'field_blurb_2_title',
                    'label' => 'Blurb 2 Title',
                    'name' => 'blurb_2_title',
                    'type' => 'text',
                    'instructions' => 'Enter the title for the second blurb.',
                ),
                array(
                    'key' => 'field_blurb_2_text',
                    'label' => 'Blurb 2 Text',
                    'name' => 'blurb_2_text',
                    'type' => 'textarea',
                    'instructions' => 'Enter the text for the second blurb.',
                ),
                array(
                    'key' => 'field_blurb_3_icon_class',
                    'label' => 'Blurb 3 Icon Class',
                    'name' => 'blurb_3_icon_class',
                    'type' => 'text',
                    'instructions' => 'Enter the CSS class for the third blurb icon (e.g., Font Awesome class).',
                ),
                array(
                    'key' => 'field_blurb_3_title',
                    'label' => 'Blurb 3 Title',
                    'name' => 'blurb_3_title',
                    'type' => 'text',
                    'instructions' => 'Enter the title for the third blurb.',
                ),
                array(
                    'key' => 'field_blurb_3_text',
                    'label' => 'Blurb 3 Text',
                    'name' => 'blurb_3_text',
                    'type' => 'textarea',
                    'instructions' => 'Enter the text for the third blurb.',
                ),
                array(
                    'key' => 'field_testimonial_1_text',
                    'label' => 'Testimonial 1 Text',
                    'name' => 'testimonial_1_text',
                    'type' => 'textarea',
                    'instructions' => 'Enter the text for the first testimonial.',
                ),
                array(
                    'key' => 'field_testimonial_1_author',
                    'label' => 'Testimonial 1 Author',
                    'name' => 'testimonial_1_author',
                    'type' => 'text',
                    'instructions' => 'Enter the author name for the first testimonial.',
                ),
                array(
                    'key' => 'field_testimonial_1_image',
                    'label' => 'Testimonial 1 Author Image',
                    'name' => 'testimonial_1_image',
                    'type' => 'image',
                    'instructions' => 'Upload the image for the first testimonial author.',
                    'return_format' => 'url',
                ),
                array(
                    'key' => 'field_testimonial_2_text',
                    'label' => 'Testimonial 2 Text',
                    'name' => 'testimonial_2_text',
                    'type' => 'textarea',
                    'instructions' => 'Enter the text for the second testimonial.',
                ),
                array(
                    'key' => 'field_testimonial_2_author',
                    'label' => 'Testimonial 2 Author',
                    'name' => 'testimonial_2_author',
                    'type' => 'text',
                    'instructions' => 'Enter the author name for the second testimonial.',
                ),
                array(
                    'key' => 'field_testimonial_2_image',
                    'label' => 'Testimonial 2 Author Image',
                    'name' => 'testimonial_2_image',
                    'type' => 'image',
                    'instructions' => 'Upload the image for the second testimonial author.',
                    'return_format' => 'url',
                ),
                array(
                    'key' => 'field_testimonial_3_text',
                    'label' => 'Testimonial 3 Text',
                    'name' => 'testimonial_3_text',
                    'type' => 'textarea',
                    'instructions' => 'Enter the text for the third testimonial.',
                ),
                array(
                    'key' => 'field_testimonial_3_author',
                    'label' => 'Testimonial 3 Author',
                    'name' => 'testimonial_3_author',
                    'type' => 'text',
                    'instructions' => 'Enter the author name for the third testimonial.',
                ),
                array(
                    'key' => 'field_testimonial_3_image',
                    'label' => 'Testimonial 3 Author Image',
                    'name' => 'testimonial_3_image',
                    'type' => 'image',
                    'instructions' => 'Upload the image for the third testimonial author.',
                    'return_format' => 'url',
                ),
                array(
                    'key' => 'field_button_1_text',
                    'label' => 'Button 1 Text',
                    'name' => 'button_1_text',
                    'type' => 'text',
                    'instructions' => 'Enter the text for the first call-to-action button.',
                ),
                array(
                    'key' => 'field_button_1_url',
                    'label' => 'Button 1 URL',
                    'name' => 'button_1_url',
                    'type' => 'url',
                    'instructions' => 'Enter the URL for the first call-to-action button.',
                ),
                array(
                    'key' => 'field_comparison_chart_image',
                    'label' => 'Comparison Chart Image',
                    'name' => 'comparison_chart_image',
                    'type' => 'image',
                    'instructions' => 'Upload the image for the comparison chart.',
                    'return_format' => 'url',
                ),
                array(
                    'key' => 'field_section_1_title',
                    'label' => 'Section 1 Title',
                    'name' => 'section_1_title',
                    'type' => 'text',
                    'instructions' => 'Enter the title for the first common section.',
                ),
                array(
                    'key' => 'field_section_1_paragraph',
                    'label' => 'Section 1 Paragraph',
                    'name' => 'section_1_paragraph',
                    'type' => 'wysiwyg',
                    'instructions' => 'Enter the paragraph text for the first common section.',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => true,
                ),
                array(
                    'key' => 'field_section_1_image',
                    'label' => 'Section 1 Image',
                    'name' => 'section_1_image',
                    'type' => 'image',
                    'instructions' => 'Upload the image for the first common section.',
                    'return_format' => 'url',
                ),
                array(
                    'key' => 'field_section_2_image',
                    'label' => 'Section 2 Image',
                    'name' => 'section_2_image',
                    'type' => 'image',
                    'instructions' => 'Upload the image for the second common section.',
                    'return_format' => 'url',
                ),
                array(
                    'key' => 'field_section_2_title',
                    'label' => 'Section 2 Title',
                    'name' => 'section_2_title',
                    'type' => 'text',
                    'instructions' => 'Enter the title for the second common section.',
                ),
                array(
                    'key' => 'field_section_2_paragraph',
                    'label' => 'Section 2 Paragraph',
                    'name' => 'section_2_paragraph',
                    'type' => 'wysiwyg',
                    'instructions' => 'Enter the paragraph text for the second common section.',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => true,
                ),
                array(
                    'key' => 'field_product_rating',
                    'label' => 'Product Rating',
                    'name' => 'product_rating',
                    'type' => 'number',
                    'instructions' => 'Set the product rating (1 to 5, with up to one decimal place).',
                    'min' => 1,
                    'max' => 5,
                    'step' => 0.1,
                ),
                array(
                    'key' => 'field_number_of_reviews',
                    'label' => 'Number of Reviews',
                    'name' => 'number_of_reviews',
                    'type' => 'number',
                    'instructions' => 'Enter the number of reviews for the product.',
                    'min' => 0,
                    'step' => 1,
                ),
                array(
                    'key' => 'field_price',
                    'label' => 'Price',
                    'name' => 'price',
                    'type' => 'number',
                    'instructions' => 'Enter the product price.',
                    'min' => 0,
                    'step' => 0.01,
                ),
                array(
                    'key' => 'field_discount_price',
                    'label' => 'Discount Price',
                    'name' => 'discount_price',
                    'type' => 'number',
                    'instructions' => 'Enter the discount price (if applicable).',
                    'min' => 0,
                    'step' => 0.01,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'one-pager-template.php',
                    ),
                ),
            ),
        ));
    }
}
add_action('acf/init', 'opalp_register_custom_fields');