<?php
/**
 * Bifolding Window - All Functionality
 * 
 * This file contains all window builder related functions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ============================================================
 * PANEL MAPPINGS & CONFIGURATIONS FOR WINDOWS
 * ============================================================
 */

$bifolding_window_panel_map = array(
    '2_left' => '2 Panels Left',
    '2_right' => '2 Panels Right',
    '3_left' => '3 Panels Left',
    '3_right' => '3 Panels Right',
    '4_left' => '4 Panels Left',
    '4_right' => '4 Panels Right',
    '1_2' => '1 + 2 Panels',
    '2_1' => '2 + 1 Panels',
    '1_3' => '1 + 3 Panels',
    '3_1' => '3 + 1 Panels',
    '2_2' => '2 + 2 Panels',
    '1_4' => '1 + 4 Panels',
    '4_1' => '4 + 1 Panels',
    '2_3' => '2 + 3 Panels',
    '3_2' => '3 + 2 Panels'
);

$bifolding_window_colour_map = array(
    'anthracite_grey' => array('name' => 'Anthracite Grey', 'ral' => '7016'),
    'black' => array('name' => 'Black', 'ral' => '9005'),
    'white' => array('name' => 'White', 'ral' => '9016')
);

$bifolding_window_handle_map = array(
    'white' => 'White',
    'chrome' => 'Chrome',
    'black' => 'Black',
    'silver' => 'Silver'
);

$bifolding_window_glass_map = array(
    'self_cleaning' => 'Self-cleaning glass',
    'obscure_glass' => 'Obscure glass',
    'saint_gobain_12' => 'Saint-Gobain Planitherm 1.2',
    'low_e_argon' => 'Low-E Argon Filled'
);

$bifolding_window_install_map = array(
    'collection' => 'Supply Only - Collection',
    'delivery' => 'Supply Only - Delivery',
    'install_existing' => 'Install into Existing Opening',
    'install_new_build' => 'Install into New Build Opening'
);

/**
 * ============================================================
 * HELPER FUNCTION FOR WINDOWS
 * ============================================================
 */

if (!function_exists('get_window_pane_count')) {
    function get_window_pane_count($panel) {
        if (empty($panel)) return 1;
        preg_match('/(\d+)/', $panel, $matches);
        return isset($matches[1]) ? intval($matches[1]) : 1;
    }
}

/**
 * ============================================================
 * 1. REMOVE DEFAULT ADD TO CART BUTTON
 * ============================================================
 */
add_action('init', 'bifolding_window_remove_add_to_cart_button');
function bifolding_window_remove_add_to_cart_button() {
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
}

/**
 * ============================================================
 * 2. ADD WIZARD DATA TO CART ITEM FOR WINDOWS
 * ============================================================
 */
add_filter('woocommerce_add_cart_item_data', 'bifolding_window_add_wizard_data_to_cart', 10, 3);
function bifolding_window_add_wizard_data_to_cart($cart_item_data, $product_id, $variation_id) {
    global $bifolding_window_panel_map, $bifolding_window_colour_map, $bifolding_window_handle_map, 
           $bifolding_window_glass_map, $bifolding_window_install_map;
    
    // Get form data
    if (isset($_POST['form_data'])) {
        parse_str($_POST['form_data'], $form_data);
    } else {
        $form_data = $_POST;
    }
    
    if (empty($form_data) || !isset($form_data['product_type']) || $form_data['product_type'] !== 'window') {
        return $cart_item_data;
    }
    
    $wizard_data = array();
    $wizard_data['product_type'] = 'window';
    
    // Collect window data
    if (isset($form_data['width']) && isset($form_data['height'])) {
        $wizard_data['width'] = intval($form_data['width']);
        $wizard_data['height'] = intval($form_data['height']);
    }
    
    if (isset($form_data['panel_layout'])) {
        $wizard_data['panels'] = isset($bifolding_window_panel_map[$form_data['panel_layout']]) 
            ? $bifolding_window_panel_map[$form_data['panel_layout']] 
            : $form_data['panel_layout'];
    }
    
    if (isset($form_data['window_colour'])) {
        if ($form_data['window_colour'] === 'custom_ral' && !empty($form_data['custom_colour_select'])) {
            $wizard_data['colour'] = $form_data['custom_colour_select'];
            $wizard_data['ral'] = str_replace('RAL ', '', $form_data['custom_colour_select']);
        } else {
            $colour = isset($bifolding_window_colour_map[$form_data['window_colour']]) 
                ? $bifolding_window_colour_map[$form_data['window_colour']] 
                : array('name' => $form_data['window_colour'], 'ral' => $form_data['window_colour']);
            $wizard_data['colour'] = $colour['name'];
            $wizard_data['ral'] = $colour['ral'];
        }
    }
    
    if (isset($form_data['glass_type'])) {
        $wizard_data['glass'] = isset($bifolding_window_glass_map[$form_data['glass_type']]) 
            ? $bifolding_window_glass_map[$form_data['glass_type']] 
            : $form_data['glass_type'];
    }
    
    if (isset($form_data['handle_colour'])) {
        $wizard_data['handle'] = isset($bifolding_window_handle_map[$form_data['handle_colour']]) 
            ? $bifolding_window_handle_map[$form_data['handle_colour']] 
            : $form_data['handle_colour'];
    }
    
    // Opening type
    if (isset($form_data['opening_type'])) {
        $wizard_data['opening_type'] = $form_data['opening_type'];
    }
    
    // Security features
    if (isset($form_data['security'])) {
        $wizard_data['security'] = $form_data['security'];
    }
    
    // Postcode
    if (isset($form_data['postcode'])) {
        $wizard_data['postcode'] = sanitize_text_field($form_data['postcode']);
    }
    
    // Installation type
    if (isset($form_data['installation_type'])) {
        $install_value = $form_data['installation_type'];
        $wizard_data['installation_type'] = isset($bifolding_window_install_map[$install_value]) 
            ? $bifolding_window_install_map[$install_value] 
            : $install_value;
        $wizard_data['installation_type_value'] = $install_value;
    }
    
    // Customer information
    if (isset($form_data['first_name'])) {
        $wizard_data['first_name'] = sanitize_text_field($form_data['first_name']);
    }
    if (isset($form_data['last_name'])) {
        $wizard_data['last_name'] = sanitize_text_field($form_data['last_name']);
    }
    if (isset($form_data['email'])) {
        $wizard_data['email'] = sanitize_email($form_data['email']);
    }
    if (isset($form_data['phone'])) {
        $wizard_data['phone'] = sanitize_text_field($form_data['phone']);
    }
    
    $wizard_data['unique_id'] = uniqid('window_', true);
    $wizard_data['timestamp'] = time();
    
    $cart_item_data['wizard_data'] = $wizard_data;
    $cart_item_data['unique_key'] = md5(serialize($wizard_data) . time() . rand(1000, 9999));
    
    return $cart_item_data;
}