# One-Pager Affiliate Landing Page - Documentation

## Overview

The One-Pager Affiliate Landing Page blueprint creates a professional single-page template specifically designed for affiliate marketers to promote products effectively. The template follows conversion-optimized design principles and includes multiple customizable sections that can be enabled or disabled based on your needs.

## Table of Contents

1. [Installation](#installation)
2. [Creating a Landing Page](#creating-a-landing-page)
3. [Template Sections](#template-sections)
4. [Field Groups](#field-groups)
   - [Top Header](#top-header)
   - [Hero Section](#hero-section)
   - [As Seen On](#as-seen-on)
   - [Short Product About](#short-product-about)
   - [Video Testimonials](#video-testimonials)
   - [Facts & Use](#facts--use)
   - [What Do Experts Say](#what-do-experts-say)
   - [More About Product](#more-about-product)
   - [Reviews](#reviews)
   - [FAQs](#faqs)
   - [Footer](#footer)
   - [Sticky CTA](#sticky-cta)
5. [Dynamic Behavior](#dynamic-behavior)
6. [Color Customization](#color-customization)
7. [Typography System](#typography-system)
8. [Customization Tips](#customization-tips)
9. [Visitor Count Settings](#visitor-count-settings)
10. [Support](#support)
11. [Tab Teaser Plugin](#tab-teaser-plugin)
12. [A/B Test Page Duplicator](#ab-test-page-duplicator)
13. [Future Upgrades](#future-upgrades)
    - [Dynamic Popup](#dynamic-popup)
    - [Newsletter Integration](#newsletter-integration)
    - [Section Reordering](#section-reordering)
14. [Third Party Dependencies](#third-party-dependencies)

## Installation

1. Make a copy of a blueprint
2. Upload a blueprint on a live server

## Creating a Landing Page

1. Create a new Page in WordPress.
2. In the Page Attributes section, select "One-Pager Affiliate Template" from the Template dropdown.
3. Save the page.
4. Fill in the custom fields below the editor to build your landing page.

## Template Sections

The template includes the following sections, which are shown or hidden based on whether content has been entered:

1. **Top Header Bar** - Optional notification bar for time-sensitive offers
2. **Hero Section** - Main product showcase with video/image and CTA
3. **As Seen On** - Brand logos for social proof
4. **Short Product About** - Brief product description
5. **Video Testimonials** - Customer video reviews
6. **Facts & Use** - Product specifications and usage information
7. **What Do Experts Say** - Expert endorsements section
8. **More About Product** - Additional product information
9. **Reviews** - Customer testimonials with images
10. **FAQs** - Frequently asked questions
11. **Footer** - Disclaimers and legal information
12. **Sticky CTA** - Floating call-to-action that appears on scroll

## Field Groups

### Top Header

Fields for creating an attention-grabbing header bar at the top of the page.

| Field Name | Type | Description | Behavior if Empty |
|------------|------|-------------|-------------------|
| `top_header_text_string` | Text | Notification text | Header not displayed if all fields empty |
| `countdown_date` | Date | End date for countdown timer | No countdown shown |
| `show_visitor_count_in_top_header` | Checkbox | Display fake visitor count | No visitor count shown |

### Hero Section

Main product showcase area with flexible media options and comprehensive purchase details.

| Field Name | Type | Description | Behavior if Empty |
|------------|------|-------------|-------------------|
| `hero_video_file` | File | MP4 video for hero section | Falls back to video URL or image |
| `hero_video_url` | URL | YouTube/iframe embed URL | Falls back to image |
| `fallback_hero_image` | Image | Static image if no video | Section shows without media |
| `video_description` | Textarea | Caption under video | No description shown |
| `product_name` | Text | Name of the product | No product name shown |
| `product_rating` | Number | Star rating (1-5) | No rating shown |
| `number_of_reviews` | Number | Number of reviews | No review count shown |
| `headline` | Text | Main H1 headline | No headline shown |
| `subheadline` | Text | Supporting text below headline | No subheadline shown |
| `can_from_apply_to_price` | True/False | Add "From" text before price | No "From" text shown if disabled |
| `price` | Number | Regular price | Required for discount calculation |
| `discount_price` | Number | Sale price | No discount shown |
| `cost_per_day` | Text | Cost per day/use | No per-day cost shown |
| `bonus_offer_text` | Text | Bonus text near price | No bonus shown |
| `button_1_text` | Text | CTA button text | Default "Buy Now" used |
| `button_1_url` | URL | CTA button destination | Button links to # |
| `payment_images` | Checkbox | Payment method logos | No payment methods shown |
| `money_back_days` | Number | Money-back guarantee period | No guarantee shown |

### As Seen On

Logos for brand recognition and credibility.

| Field Name | Type | Description | Behavior if Empty |
|------------|------|-------------|-------------------|
| `as_seen_on_title` | Text | Section heading | Section not displayed if title empty |
| `as_seen_on_image_1` | Image | First brand logo | No logo shown |
| `as_seen_on_image_2` | Image | Second brand logo | No logo shown |
| `as_seen_on_image_3` | Image | Third brand logo | No logo shown |

### Short Product About

Brief product description section.

| Field Name | Type | Description | Behavior if Empty |
|------------|------|-------------|-------------------|
| `short_about_title` | Text | Section heading | Section not shown if all empty |
| `short_about_description` | WYSIWYG | Product description | No description shown |
| `short_about_image` | Image | Product image | No image shown |

### Video Testimonials

Customer video testimonials carousel.

| Field Name (repeated for 1-6) | Type | Description | Behavior if Empty |
|-------------------------------|------|-------------|-------------------|
| `video_testimonials_title` | Text | Section heading | Default "Testimonials" used |
| `video_testimonial_X_file` | File | MP4 video file | Testimonial not shown |
| `video_testimonial_X_thumbnail` | Image | Thumbnail image | Default thumbnail used |
| `video_testimonial_X_description` | Textarea | Video description | No description shown |
| `video_testimonial_X_name` | Text | Reviewer name | No name shown |

### Facts & Use

Product specifications and usage information.

| Field Name | Type | Description | Behavior if Empty |
|------------|------|-------------|-------------------|
| `facts_use_title` | Text | Section heading | Default "Facts & Use" used |
| `facts_use_content` | WYSIWYG | Main content | No content shown |
| `facts_use_image` | Image | Supplement facts image | No image shown |
| `facts_list_1/2/3` | Text | Inline fact points | No list shown |
| `facts_label_image_1/2/3` | Image | Certification labels | No labels shown |
| `facts_use_reference_1/2/3` | Text | Reference citations | No references shown |

### What Do Experts Say

Expert endorsements and testimonials.

| Field Name (repeated for 1-3) | Type | Description | Behavior if Empty |
|-------------------------------|------|-------------|-------------------|
| `experts_title` | Text | Section heading | Section not shown if all empty |
| `expert_X_video` | File | Expert MP4 video | Falls back to image |
| `expert_X_image` | Image | Expert photo | No image shown |
| `expert_X_name` | Text | Expert name | No name shown |
| `expert_X_title` | Text | Expert credentials | No title shown |
| `expert_X_text` | Textarea | Expert testimonial | No text shown |

### More About Product

Additional product information in two alternating layouts.

| Field Name | Type | Description | Behavior if Empty |
|------------|------|-------------|-------------------|
| `more_about_title_1/2` | Text | Section heading | Section not shown if all empty |
| `more_about_content_1/2` | WYSIWYG | Section content | No content shown |
| `more_about_image_top_1/2` | Image | Top image | No image shown |
| `more_about_image_bottom_1/2` | Image | Bottom image | No image shown |

### Reviews

Customer testimonials with photo, name and review text.

| Field Name (repeated for 1-24) | Type | Description | Behavior if Empty |
|--------------------------------|------|-------------|-------------------|
| `reviews_section_title` | Text | Section heading | Default "Reviews" used |
| `testimonial_X_text` | Textarea | Review text | Testimonial not shown |
| `testimonial_X_author` | Text | Reviewer name | No author shown |
| `testimonial_X_image` | Image | Reviewer photo | No image shown |

*Note: The system displays 3 testimonials on mobile and 6 on desktop initially, with a "Load More" button to reveal the rest.*

### FAQs

Accordion-style frequently asked questions.

| Field Name | Type | Description | Behavior if Empty |
|------------|------|-------------|-------------------|
| `faq_section_title` | Text | Section heading | Default "Frequently Asked Questions" used |
| `faq_question_1/2/3/4/5/6` | Text | Question text | FAQ not shown |
| `faq_answer_1/2/3/4/5/6` | Textarea | Answer text | FAQ not shown |

### Footer

Footer information and disclaimers.

| Field Name | Type | Description | Behavior if Empty |
|------------|------|-------------|-------------------|
| `footer_disclaimer_1` | Textarea | Left side disclaimer | No disclaimer shown |
| `footer_disclaimer_2` | Textarea | Right side disclaimer | No disclaimer shown |
| `terms_url` | URL | Terms of Use page link | No link shown |
| `privacy_url` | URL | Privacy Policy page link | No link shown |
| `support_email` | Email | Support email address | No email shown |

### Sticky CTA

Floating call-to-action that appears when scrolling.

| Field Name | Type | Description | Behavior if Empty |
|------------|------|-------------|-------------------|
| `sticky_cta_text` | Text | Main CTA text | Sticky CTA not shown if either field empty |
| `sticky_button_text` | Text | Button text | Sticky CTA not shown if either field empty |

## Dynamic Behavior

### Responsive Layout
- **Empty Sections**: If all fields in a particular section are empty, that section is not displayed at all, creating a cleaner user experience.
- **Responsive Layout**: The page automatically adjusts for mobile, tablet, and desktop screens with specific breakpoints handling different elements:
  - Mobile layout (below 500px)
  - Tablet screens (below 868px)
  - Medium screens (below 1200px)
  - Big screens (more than 1300px)

### Visual Components
- **Responsive Images**: All images maintain their natural aspect ratio while being constrained by maximum dimensions for consistent layout across devices.
- **Video Players**: Videos have play buttons overlaid and properly handle play/pause states with these behaviors:
  - Pausing when another video starts playing
  - Resetting UI when videos end
  - Showing/hiding controls appropriately on interaction
  - Handling mobile and desktop video layouts differently

### Dynamic Calculations
- **Discount Percentage**: Automatically calculated when both original price and discount price are entered, using the formula: `round((($price - $discount_price) / $price) * 100)`
- **Star Ratings**: Dynamically renders star ratings with partial stars supported (e.g., 4.5 stars shows 4 full stars and 1 half-star), using SVG clip paths calculated with: `($product_rating - floor($product_rating)) * 100`
- **Payment Methods Display**: limits display to 3 payment methods with a "+X more" button that shows remaining payment options in a popover + feature that let you pick priority of payement methods (put popular one first)

### Additional Dynamic Elements
- **Countdown Timer**: 
  - Updates in real-time, showing days, hours, minutes, and seconds remaining
  - Runs client-side JavaScript to ensure accurate counting
  - Automatically hides or shows expiration message when countdown ends
  - Has format "Offer ends in: 1d 05h 30m 15s"

- **Visitor Counter**: 
  - Shows dynamic visitor count that fluctuates slightly over time
  - By default, automatically randomizes between 60-200 visitors
  - By defualt, updates every 5 seconds with small variations (-2, -1, 0, +1, or +2)
  - Can be displayed both in top bar and elsewhere on the page

- **Load More Button**:
  - Shows more testimonials when clicked
  - Has different behavior for mobile and desktop views:
    - Mobile: Initially displays 3 testimonials, reveals all on click
    - Desktop: Initially displays 6 testimonials, reveals all on click
  - At first click, showing all testimonials and automatically disappears

- **FAQ Accordion**:
  - Equalizes column heights on desktop but allows natural heights on mobile
  - Recalculates heights on window resize and when items are expanded/collapsed
  - Handles layout changes when screen size changes

### Sticky Elements
- **Sticky CTA**: 
  - Appears after the user scrolls down a certain distance (200px from top)
  - Contains condensed payment options (limited to 2 with popover)
  - Has responsive design that becomes full width on mobile
  - Includes the money back guarantee information in a compact format
  - Shows/hides with smooth animation via CSS transitions


### Responsive Behavior Specifics
- **Mobile-Optimized Controls**: Special handling for video carousel controls on small screens
- **Font Resizing**: Automatically scales text at specific breakpoints for better readability

## Color Customization

The One-Pager Affiliate Landing Page template offers a color customization system through a settings page. This allows you to tailor the visual appearance of your landing pages to match your brand or product aesthetics without writing any custom CSS.

### Dynamic Colors

The template uses CSS variables to control colors throughout the landing page. In future, we will update this to allow users to switch to dark theme, and use ligher colors. The following dynamic colors can be customized:

| Variable | Default | Description |
|---------|---------|-------------|
| `--header-footer-bg` | `#1c2b35` | Background color for header, footer, and notification bars |
| `--primary-button-bg` | `#2f4858` | Background color for main call-to-action buttons |
| `--secondary-button-bg` | `#f9fafa` | Background color for secondary buttons |
| `--featured-bg` | `#f9fafa` | Background color for highlighted fullwidth sections (As Seen On, Expert Reviews) |
| `--sticky-footer-bg` | `#FDEFD5` | Background color for the sticky CTA bar |
| `--blurb-icon-color` | `#fbca70` | Color for icons and accent elements |
| `--discount-text-color` | `#dd1f51` | Color for discount percentages and price reduction indicators |

### Static Text Colors

In addition to the dynamic colors above, the template uses these static text colors for readability:

| Variable | Value | Description |
|---------|---------|-------------|
| `--body-text-color` | `#272929` | Default text color for paragraphs and general content |
| `--title-text-color` | `#0F1111` | Text color for headings and titles |
| `--secondary-text-color` | `#575858` | Text color for less prominent elements like ratings and metadata |

### Settings Page

Access the color settings by navigating to **One-Pager Settings** in your WordPress admin menu. The color picker interface allows you to:

1. Select colors using a visual color picker
2. Enter hex color codes directly
3. Save color schemes as presets (coming soon)
4. Reset to default colors

Changes apply instantly to all pages using the One-Pager Affiliate template, ensuring consistent branding across your landing pages. 

### Per-Page Color Overrides

You can also override the primary button color on individual landing pages:

1. Edit any page using the One-Pager Affiliate template
2. Locate the "Primary Button Color" field 
3. Set a custom color that will apply only to that specific page

This is useful for A/B testing different color schemes or creating product-specific branding.

### CSS Helper Classes

The template also provides helper classes that apply the dynamic colors to custom elements:

- `opalp-border-primary` - Applies primary color to borders
- `opalp-border-secondary` - Applies secondary color to borders

## Typography System

The One-Pager Affiliate Landing Page features a carefully designed typography system that balances readability, aesthetics, and performance across all devices.

### Variable Fonts

The template uses variable fonts, providing flexibility in style. 

### Font Selection

Our template includes a curated selection of fonts specifically chosen for:

1. **Readability** - Easy to read at various sizes and on different devices
2. **Conversion Optimization** - Proven to increase engagement and conversion rates
3. **Modern Aesthetics** - Contemporary look that appeals to today's consumers
4. **Cross-device Performance** - Consistent rendering across all browsers and devices

### Heading Fonts (this should be updated)

The following fonts are available for headings:

| Font Name | Style | Best Use Case |
|-----------|-------|---------------|
| Montserrat | Modern, geometric sans-serif | Clean, contemporary headlines |
| Playfair Display | Elegant serif | Luxury or premium products |
| Roboto | Clean, neutral sans-serif | Technical or straightforward products |
| Lato | Friendly, semi-rounded sans-serif | Approachable, friendly brands |
| Poppins | Modern geometric sans-serif | Contemporary digital products |

### Paragraph Fonts (this should be updated)

For body text, these fonts ensure optimal readability:

| Font Name | Style | Best Use Case |
|-----------|-------|---------------|
| Open Sans | Neutral, humanist sans-serif | Universal readability, digital-first content |
| Source Sans Pro | Balanced sans-serif | Technical documentation and detailed descriptions |
| Nunito | Rounded, friendly sans-serif | Approachable, conversational copy |
| Roboto | Clean, neutral sans-serif | Information-dense content |
| Inter | Modern variable font | Contemporary digital interfaces |

### Typography Settings

Font settings are accessible from the same settings page as colors:

1. Navigate to **One-Pager Settings** in your WordPress admin menu
2. Select the "Typography" tab
3. Choose your preferred heading font
4. Choose your preferred paragraph font
5. Save changes to apply globally

### Responsive Typography (needs to be updated)

The template automatically adjusts typography for different screen sizes:

| Element | Desktop (≥1400px) | Tablet (≥768px) | Mobile (<768px) |
|---------|-----------------|----------------|----------------|
| H1 | 48px / 55px line height | 34px / 38px line height | 30px / 32px line height |
| H2 | 40px / 55px line height | 30px / 36px line height | 26px / 30px line height |
| H3 | 34px / 55px line height | 26px / 32px line height | 22px / 28px line height |
| H4 | 28px / 55px line height | 24px / 30px line height | 22px / 26px line height |
| Body text | 18px / 26px line height | 16px / 24px line height | 16px / 22px line height |

This responsive approach ensures readability across all devices while maintaining visual hierarchy and aesthetics.

### Accessibility Considerations

Our typography system follows WCAG guidelines for accessibility:

- Maintains proper color contrast ratios
- Uses breakpoints for scalable text
- Ensures sufficient line height for readability
- Preserves legible font sizes across all devices

### Custom Font Implementation (future update)

For advanced users who wish to use custom fonts:

1. Navigate to **One-Pager Settings** > **Typography**
2. Select "Custom" from the font dropdown
3. Enter your font name and CSS URL (Google Fonts or other sources)

Note: When using custom fonts, ensure they include appropriate weights (at minimum 400 for body text and 700 for headings) for proper display.

## Additional Tips

1. **Section Order**: The order of sections is fixed in the template file but can be modified by editing the template (require coding). In future, we plan to implement a feature to drag and drop section order. 
2. **Additional CSS**: Add custom CSS through the WordPress Customizer for specialized styling.

## Visitor Count Settings

The Visitor Count feature displays a dynamic number of people supposedly viewing your landing page, creating a sense of social proof and urgency. This number fluctuates automatically within a configurable range to appear realistic and increase conversion rates.

### How It Works

1. When a user first visits your landing page, the system generates a random initial visitor count within your specified minimum and maximum range.
2. At regular intervals (controlled by your update interval setting), the count updates with a small random variation.
3. The variations follow a probability pattern that you control - either small changes (-1, 0, +1) or larger changes (-2, +2).
4. The count is displayed on your landing page with text "People Are Checking Out This Product Right Now" or "People Viewing" in the top header if enabled.
5. The count always stays within your defined minimum and maximum values.

### Settings Configuration

You can fully customize the visitor counter behavior through the WordPress admin panel:

1. Navigate to **Settings > One-Pager Settings**
2. Scroll down to the **Visitor Count Settings** section
3. Configure the following options:

| Setting | Default | Description |
|---------|---------|-------------|
| Minimum Visitor Count | 31 | The lowest possible number of visitors that will be shown |
| Maximum Visitor Count | 112 | The highest possible number of visitors that will be shown |
| Update Interval (seconds) | 1 | How often the visitor count updates in seconds |
| Small Change Probability (%) | 10 | The probability of small changes (-1, 0, +1) occurring |

### Display Options

The visitor count can be displayed in :

1. **Top Header Bar** - Always displays in the notification bar at the top of the page

To enable the visitor count in the top header:
1. Edit your landing page
2. Locate the **Top Header** field group
3. Check the "Show visitor count in top header" option

### Customization Tips

- **Realistic Numbers**: For niche products, use lower ranges (10-50). For mainstream products, higher ranges (50-200) may be more believable.
- **Update Frequency**: Faster updates (1-2 seconds) create a sense of high activity, while slower updates (5-10 seconds) appear more natural for less popular items.
- **Change Probability**: Higher probabilities of small changes (60-80%) create steadier, more predictable visitor counts. Lower probabilities introduce more dramatic fluctuations.

### Technical Notes

- The visitor count is stored in a PHP session variable to maintain consistency across page refreshes
- The counter uses AJAX to update without requiring page reloads
- Visitor counts are simulated and not based on actual traffic
- The initial count is randomly generated within your specified range
- The feature works with or without caching plugins

### Best Practices

1. **Set Realistic Ranges**: Use visitor numbers that are believable for your product type and target audience.
2. **Consider Product Price Point**: Higher-priced items typically benefit from lower visitor counts (exclusivity), while lower-priced items can show higher traffic.
3. **A/B Test Different Settings**: Try different combinations of minimum/maximum counts to see which drives better conversion rates.
4. **Coordinate with Other Urgency Elements**: If using countdown timers or "limited quantity" notices, ensure your visitor count aligns with your overall urgency strategy.

## Tab Teaser Plugin

The Tab Teaser plugin enhances user engagement by dynamically changing the browser tab title and favicon when visitors navigate away from your page. This helps recapture attention and bring users back to your landing page.

### Features

- **Active Tab Title**: Customize the title displayed when the tab is active (visible to the user)
- **Inactive Tab Title**: Set a custom message that appears when the user switches to another tab
- **Normal Favicon**: Upload a custom favicon that will override any existing site favicon
- **Inactive Favicon**: Choose from predefined icons that display when the user is not on your tab
- **Flashing Option**: Enable title and favicon to alternate between active/inactive states for extra attention
- **Flashing Interval**: Control how quickly the tab title and favicon alternate (in seconds)

### How It Works

When a visitor navigates away from your tab:
1. The tab title changes to your custom "inactive" message (e.g., "Don't miss this offer!")
2. The favicon switches to the inactive icon you've selected
3. If flashing is enabled, the title and favicon will alternate between active/inactive states

When the visitor returns to your tab:
1. The tab title reverts to your custom "active" title or the page's original title
2. The favicon reverts to your custom normal favicon or the site's original favicon

### Settings

| Setting | Description | Default |
|---------|-------------|---------|
| Active Tab Title | The title shown when the tab is visible | Current page title |
| Inactive Tab Title | Message shown when user switches tabs | "Return to shopping!" |
| Enable Flashing | Toggle title/favicon flashing when inactive | Off |
| Flashing Interval | Seconds between flashes | 2 |
| Normal Favicon | Upload a custom favicon | None (uses site default) |
| Inactive Favicon | Choose from predefined attention-grabbing icons | None |

### Use Cases

- **Limited-time offers**: Remind users about time-sensitive deals
- **Cart abandonment**: Alert users who've left items in their cart
- **Lead generation**: Prompt users to complete form submissions
- **Sales pages**: Increase conversions by bringing wandering attention back to your offer

This plugin integrates seamlessly with the One-Pager Affiliate Landing Page template to maximize engagement and conversions.

## A/B Test Page Duplicator

The A/B Test Page Duplicator plugin allows you to easily create variants of your landing pages for split testing. This lightweight tool automates the page duplication process while preserving all custom fields and content.

### Features

- **One-Click Duplication**: Create A/B test variants directly from the WordPress Pages list
- **Complete Field Copying**: Duplicates all native WordPress content and custom fields
- **Draft Status**: Creates duplicates as drafts so you can make changes before publishing
- **Clear Labeling**: Automatically appends "(A/B Test)" to the page title for easy identification

### How It Works

1. Navigate to the WordPress Pages list in your admin dashboard
2. Hover over any page you want to test
3. Click the "Create A/B Test" link that appears in the row actions
4. The system creates an exact duplicate of the page (including all custom fields) as a draft
5. You're automatically redirected to the new page's edit screen
6. Make your desired changes to create your variant
7. Publish the variant when ready to begin testing

### Use Cases

- **Layout Testing**: Create versions with different section arrangements
- **Copy Testing**: Test different headlines, calls-to-action, or benefit statements
- **Design Testing**: Experiment with different color schemes or image placements
- **Price Testing**: Test different pricing models, discounts, or bonus offers
- **Social Proof Testing**: Compare different testimonial selections or trust indicators

### Best Practices

1. **Change Only One Element**: For accurate testing, change only one key element between variants
2. **Use Analytics**: Connect to Google Analytics or similar tools to track performance
3. **Allow Sufficient Traffic**: Let each variant receive enough visitors for statistical significance
4. **Document Changes**: Keep track of what you've modified in each variant
5. **Implement Winners**: Once you have a clear winner, implement those changes in your main page

This plugin seamlessly integrates with the One-Pager Affiliate Landing Page template, making it easy to optimize your affiliate marketing campaigns through data-driven testing.

## Future Upgrades

Our development roadmap includes several powerful enhancements to the One-Pager Affiliate Landing Page plugin planned for upcoming releases. These features are designed to further improve conversion rates and customize your landing pages.

### Dynamic Popup

The Dynamic Popup feature will allow you to create attention-grabbing modal popups that appear based on user behavior.

#### Upcoming Features

- **Timed Popups**: Set precisely when your popup appears after page load
- **Custom Content Editor**: Create rich popup content with the WordPress editor
- **Call-to-Action Button**: Include a customizable button with destination URL
- **Design Integration**: Popups that automatically match your landing page styles
- **Mobile-Optimized Display**: Responsive design for all screen sizes

The popup system is designed to capture visitor attention at critical moments without disrupting their browsing experience. It's perfect for newsletter signups, special offers, or important announcements.

### Newsletter Integration

A dedicated newsletter signup system tailored specifically for affiliate landing pages will be included in an upcoming release.

#### Planned Features

- **Multiple Provider Support**: Manual integration with popular email marketing services
- **Inline & Popup Placement Options**: Add forms anywhere on your page
- **Lead Magnet Delivery**: Automatic delivery of downloadable content
- **Analytics Dashboard**: Track signup rates and conversion metrics
- **A/B Testing Capability**: Test different form designs and copy

This feature will help you build your email list while promoting affiliate products, creating a valuable asset that generates ongoing commissions.

### Section Reordering

Future versions will include an intuitive drag-and-drop interface to rearrange the order of sections on your landing page.

#### Upcoming Functionality

- **Visual Section Manager**: Easily drag and drop sections to change their order
- **Device-Specific Arrangements**: Create different section orders for mobile and desktop
- **Section Visibility Controls**: Show or hide sections based on device type
- **Layout Templates**: Save and load your preferred section arrangements
- **Performance Analysis**: Track which arrangements perform best

This flexibility will allow you to experiment with different page structures to find the optimal flow for your specific audience and offers.

## Third Party Dependencies

The One-Pager Affiliate Landing Page template relies on several established technologies to ensure reliability, performance, and extensibility:

| Dependency | Version | Purpose |
|------------|---------|---------|
| WordPress  | 6.3+ | Core content management system providing the foundation for the template |
| Bootstrap  | 5.3.2 | Frontend framework for responsive layout, components, and styling |
| Advanced Custom Fields | Free 6.0+ | Powers the customizable fields and content management interface |

These dependencies are carefully selected to provide a stable foundation while ensuring the template remains compatible with future updates. The blueprint is tested regularly against new versions of these dependencies to maintain compatibility.

## Support

For support or feature requests, please contact support at the email address provided in the plugin settings.


---

© 2025 One-Pager Affiliate Landing Page Plugin made by E-COM