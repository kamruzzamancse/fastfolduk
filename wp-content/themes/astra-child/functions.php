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
    
    // Dequeue Elementor scripts
    wp_dequeue_script('elementor-frontend');
    wp_dequeue_script('elementor-pro-frontend');
    wp_dequeue_script('elementor');
    
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
 * ============================================================
 * REMOVE DEFAULT ADD TO CART BUTTON
 * ============================================================
 */
add_action('init', 'remove_default_add_to_cart_button');
function remove_default_add_to_cart_button() {
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
}

/**
 * ============================================================
 * ADD SINGLE DESIGN BUTTON BASED ON PRODUCT URL/SLUG
 * ============================================================
 */
add_action('woocommerce_single_product_summary', 'add_design_button_based_on_product', 35);
function add_design_button_based_on_product() {
    global $product;
    
    if (!$product || !$product->is_type('variable')) {
        return;
    }
    
    $product_id = $product->get_id();
    $product_slug = $product->get_slug();
    $product_name = strtolower($product->get_name());
    
    // Check if this is a door product
    $is_door = (strpos($product_slug, 'door') !== false) || (strpos($product_name, 'door') !== false);
    
    // Check if this is a window product
    $is_window = (strpos($product_slug, 'window') !== false) || (strpos($product_name, 'window') !== false);
    
    // If still not detected, check current URL
    if (!$is_door && !$is_window) {
        $current_url = $_SERVER['REQUEST_URI'];
        $is_door = (strpos($current_url, 'door') !== false);
        $is_window = (strpos($current_url, 'window') !== false);
    }
    
    // Determine which button to show
    $button_text = '';
    $builder_url = '';
    
    if ($is_door) {
        $button_text = 'DESIGN YOUR DOOR';
        $builder_url = site_url('/bifolding-door-builder/');
    } elseif ($is_window) {
        $button_text = 'DESIGN YOUR WINDOW';
        $builder_url = site_url('/bifolding-window-builder/');
    } else {
        return; // No button - not a door or window product
    }
    
    ?>
    <style>
        .design-your-btn {
            display: inline-block !important;
            background: #2e7d32 !important;
            color: white !important;
            padding: 15px 30px !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 2px !important;
            border: none !important;
            border-radius: 4px !important;
            cursor: pointer !important;
            text-decoration: none !important;
            margin-top: 20px !important;
            transition: background 0.3s !important;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1) !important;
        }
        
        .design-your-btn:hover {
            background: #1b5e20 !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 12px rgba(0,0,0,0.15) !important;
        }
        
        .single_variation_wrap .woocommerce-variation-add-to-cart,
        table.variations,
        .variations_form .variations,
        .single-product form.variations_form {
            display: none !important;
        }
    </style>
    
    <a class="button design-your-btn" href="#" id="design-your-btn">
        <?php echo $button_text; ?>
    </a>

    <script>
    jQuery(function($){
        $('#design-your-btn').on('click', function(e){
            e.preventDefault();
            var url = '<?php echo $builder_url; ?>?product_id=<?php echo $product_id; ?>';
            window.location.href = url;
        });
    });
    </script>
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