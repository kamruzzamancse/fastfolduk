<?php
/**
 * Astra Child Theme Functions
 * 
 * @package Astra Child
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Define theme constants
 */
define('ASTRA_CHILD_DIR', get_stylesheet_directory());
define('ASTRA_CHILD_URI', get_stylesheet_directory_uri());

/**
 * ============================================================
 * INCLUDE DELIVERY CALCULATOR
 * ============================================================
 */
require_once ASTRA_CHILD_DIR . '/delivery-calculator.php';

/**
 * ============================================================
 * INCLUDE BIFOLDING DOOR ALL FUNCTIONALITY
 * ============================================================
 */
require_once ASTRA_CHILD_DIR . '/includes/bifolding-doors/bifolding-door-all.php';

/**
 * ============================================================
 * INCLUDE BIFOLDING WINDOWS ALL FUNCTIONALITY
 * ============================================================
 */
require_once ASTRA_CHILD_DIR . '/includes/bifolding-windows/bifolding-window-all.php';

/**
 * ============================================================
 * ENQUEUE PARENT AND CHILD THEME STYLES
 * ============================================================
 */
add_action('wp_enqueue_scripts', 'astra_child_enqueue_scripts');
function astra_child_enqueue_scripts() {
    // Parent and child styles
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', ASTRA_CHILD_URI . '/style.css', array('parent-style'));
    
    // Check if on bifolding door builder page
    if (is_page('bifolding-door-builder')) {
        enqueue_bifolding_door_builder_assets();
    }
    
    // Check if on bifolding window builder page
    if (is_page('bifolding-window-builder')) {
        enqueue_bifolding_window_builder_assets();
    }
}

/**
 * Enqueue bifolding door builder assets
 */
function enqueue_bifolding_door_builder_assets() {
    // Disable theme styles
    wp_dequeue_style('parent-style');
    wp_dequeue_style('child-style');
    wp_dequeue_style('astra-theme-css');
    
    // Dequeue Elementor scripts
    wp_dequeue_script('elementor-frontend');
    wp_dequeue_script('elementor-pro-frontend');
    wp_dequeue_script('elementor');
    wp_dequeue_script('elementor-waypoints');
    wp_dequeue_script('elementor-dialog');
    wp_dequeue_script('elementor-frontend-modules');
    
    // Disable Elementor CSS
    wp_dequeue_style('elementor-frontend');
    wp_dequeue_style('elementor-pro');
    wp_dequeue_style('elementor-global');
    
    // Disable Astra theme additional scripts
    wp_dequeue_script('astra-theme-js');
    
    // Load builder assets
    wp_enqueue_style('door-builder-css', ASTRA_CHILD_URI . '/assets/css/bifolding-door.css');
    wp_enqueue_script('door-builder-js', ASTRA_CHILD_URI . '/assets/js/bifolding-door.js', array('jquery'), null, true);
    
    // Localize script for AJAX
    wp_localize_script('door-builder-js', 'door_builder_vars', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'cart_url' => wc_get_cart_url(),
        'checkout_url' => wc_get_checkout_url(),
        'nonce' => wp_create_nonce('door_builder_ajax'),
    ));
}

/**
 * Enqueue bifolding window builder assets
 */
function enqueue_bifolding_window_builder_assets() {
    // Disable theme styles
    wp_dequeue_style('parent-style');
    wp_dequeue_style('child-style');
    wp_dequeue_style('astra-theme-css');
    
    // ===== DISABLE ELEMENTOR COMPLETELY =====
    wp_dequeue_script('elementor-frontend');
    wp_dequeue_script('elementor-pro-frontend');
    wp_dequeue_script('elementor');
    wp_dequeue_script('elementor-waypoints');
    wp_dequeue_script('elementor-dialog');
    wp_dequeue_script('elementor-frontend-modules');
    
    // Disable Elementor CSS
    wp_dequeue_style('elementor-frontend');
    wp_dequeue_style('elementor-pro');
    wp_dequeue_style('elementor-global');
    wp_dequeue_style('elementor-post-xxx');
    
    // Disable Astra theme additional scripts
    wp_dequeue_script('astra-theme-js');
    
    // Load builder assets
    wp_enqueue_style('window-builder-css', ASTRA_CHILD_URI . '/assets/css/bifolding-window.css');
    wp_enqueue_script('window-builder-js', ASTRA_CHILD_URI . '/assets/js/bifolding-window.js', array('jquery'), null, true);
    
    // Localize script for AJAX
    wp_localize_script('window-builder-js', 'window_builder_vars', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'cart_url' => wc_get_cart_url(),
        'checkout_url' => wc_get_checkout_url(),
        'nonce' => wp_create_nonce('window_builder_ajax'),
    ));
}

/**
 * Completely disable Elementor on builder pages
 */
add_action('template_redirect', 'disable_elementor_on_builder_pages');
function disable_elementor_on_builder_pages() {
    if (is_page('bifolding-window-builder') || is_page('bifolding-door-builder')) {
        // Disable Google fonts
        add_filter('elementor/frontend/print_google_fonts', '__return_false');
        add_filter('elementor/frontend/print_fonts', '__return_false');
        
        // Disable Elementor frontend scripts and styles
        add_action('wp_enqueue_scripts', function() {
            wp_dequeue_script('elementor-frontend');
            wp_dequeue_script('elementor-pro-frontend');
            wp_dequeue_script('elementor');
            wp_dequeue_script('elementor-waypoints');
            wp_dequeue_script('elementor-dialog');
            wp_dequeue_script('elementor-frontend-modules');
            wp_dequeue_style('elementor-frontend');
            wp_dequeue_style('elementor-pro');
            wp_dequeue_style('elementor-global');
        }, 100);
    }
}

/**
 * ============================================================
 * REMOVE DEFAULT ADD TO CART BUTTON
 * ============================================================
 */
add_action('init', 'remove_default_add_to_cart_button');
function remove_default_add_to_cart_button() {
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
}

/**
 * ADD SINGLE DESIGN BUTTON BASED ON PRODUCT SLUG
 */
add_action('woocommerce_single_product_summary', 'add_design_button_based_on_product', 35);

function add_design_button_based_on_product() {
    global $product;

    // Run only on single product page
    if (!is_product() || !$product) {
        return;
    }

    // Prevent multiple execution
    static $executed = false;
    if ($executed) return;
    $executed = true;

    // Get current product slug and ID
    $product_slug = strtolower($product->get_slug());
    $product_id   = $product->get_id();

    // Check for door first, then window to avoid overlap
    if (strpos($product_slug, 'door') !== false) {
        $button_text = 'BUILD YOUR DOOR';
        $builder_url = site_url('/bifolding-door-builder/');
    } elseif (strpos($product_slug, 'window') !== false) {
        $button_text = 'BUILD YOUR WINDOW';
        $builder_url = site_url('/bifolding-window-builder/');
    } else {
        // Normal product — show default WooCommerce Add to Cart
        add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
        return;
    }

    // Build full builder URL with product ID
    $full_url = esc_url(add_query_arg('product_id', $product_id, $builder_url));
    ?>

    <style>
        .design-your-btn {
            display: block !important;
            text-align: center;
            background: #2e7d32 !important;
            color: #fff !important;
            padding: 16px 32px !important;
            font-size: 15px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 1.5px !important;
            border-radius: 4px !important;
            text-decoration: none !important;
            margin: 25px 0 !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1) !important;
            border: none !important;
        }

        .design-your-btn:hover {
            background: #1b5e20 !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 12px rgba(0,0,0,0.15) !important;
            color: #fff !important;
        }

        /* Hide default WooCommerce variation and cart elements */
        .single_variation_wrap,
        .variations_form,
        .woocommerce-variation-add-to-cart,
        .quantity {
            display: none !important;
            visibility: hidden !important;
        }
    </style>

    <!-- Direct href redirect — no JS needed -->
    <a class="button design-your-btn" href="<?php echo $full_url; ?>">
        <?php echo esc_html($button_text); ?>
    </a>

    <?php
}

/**
 * ============================================================
 * CREATE BUILDER PAGES ON THEME ACTIVATION
 * ============================================================
 */
register_activation_hook(__FILE__, 'create_builder_pages');
function create_builder_pages() {
    // Create Bifolding Door Builder page
    if (!get_page_by_path('bifolding-door-builder')) {
        wp_insert_post(array(
            'post_title' => 'Bifolding Door Builder',
            'post_name' => 'bifolding-door-builder',
            'post_content' => '<!-- This page uses custom template -->',
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_author' => 1,
            'page_template' => 'bifolding-door-builder.php'
        ));
    }
    
    // Create Bifolding Window Builder page
    if (!get_page_by_path('bifolding-window-builder')) {
        wp_insert_post(array(
            'post_title' => 'Bifolding Window Builder',
            'post_name' => 'bifolding-window-builder',
            'post_content' => '<!-- This page uses custom template -->',
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_author' => 1,
            'page_template' => 'bifolding-window-builder.php'
        ));
    }
}

/**
 * ============================================================
 * HIDE THEME ELEMENTS ON BUILDER PAGES
 * ============================================================
 */
add_action('wp_head', 'hide_theme_elements_on_builders');
function hide_theme_elements_on_builders() {
    if (is_page('bifolding-door-builder') || is_page('bifolding-window-builder')) {
        ?>
        <style>
            header, footer, .site-header, .site-footer, #masthead, #colophon,
            .ast-header, .ast-footer, nav, .main-header, .main-footer,
            #ast-scroll-top, #wpadminbar {
                display: none !important;
                visibility: hidden !important;
                opacity: 0 !important;
                pointer-events: none !important;
            }
        </style>
        <?php
    }
}

/**
 * Disable Astra scroll to top feature
 */
add_filter('astra_get_option_scroll-to-top', '__return_false');
remove_action('astra_footer_after', 'astra_scroll_to_top', 1);