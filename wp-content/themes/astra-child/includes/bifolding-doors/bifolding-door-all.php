<?php
/**
 * Bifolding Door - All Functionality
 * 
 * This file contains all door builder related functions
 * including cart, checkout, order, installation, and photo handling
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ============================================================
 * PANEL MAPPINGS & CONFIGURATIONS
 * ============================================================
 */

$bifolding_door_panel_map = array(
    '2_left' => '2 Panels Left',
    '2_right' => '2 Panels Right',
    '1_2' => '1 + 2 Panels',
    '2_1' => '2 + 1 Panels',
    '3_left' => '3 Panels Left',
    '3_right' => '3 Panels Right',
    '1_3' => '1 + 3 Panels',
    '3_1' => '3 + 1 Panels',
    '2_2' => '2 + 2 Panels',
    '4_left' => '4 Panels Left',
    '4_right' => '4 Panels Right',
    '1_4' => '1 + 4 Panels',
    '4_1' => '4 + 1 Panels',
    '2_3' => '2 + 3 Panels',
    '3_2' => '3 + 2 Panels',
    '5_left' => '5 Panels Left',
    '5_right' => '5 Panels Right',
    '1_5' => '1 + 5 Panels',
    '2_4' => '2 + 4 Panels',
    '3_3' => '3 + 3 Panels',
    '4_2' => '4 + 2 Panels',
    '5_1' => '5 + 1 Panels',
    '6_left' => '6 Panels Left',
    '6_right' => '6 Panels Right',
    'french' => 'French Doors'
);

$bifolding_door_colour_map = array(
    'anthracite_grey' => array('name' => 'Anthracite Grey', 'ral' => '7016'),
    'black' => array('name' => 'Black', 'ral' => '9005'),
    'white' => array('name' => 'White', 'ral' => '9016')
);

$bifolding_door_handle_map = array(
    'white' => 'White',
    'chrome' => 'Chrome',
    'black' => 'Black',
    'black_white' => 'Black and White'
);

$bifolding_door_glass_map = array(
    'self_cleaning' => 'Self-cleaning glass',
    'integral_blinds' => 'Integral blinds',
    'obscure_glass' => 'Obscure glass',
    'saint_gobain_12' => 'Saint-Gobain Planitherm 1.2'
);

$bifolding_door_install_map = array(
    'collection' => 'Supply Only - Collection',
    'delivery' => 'Supply Only - Delivery',
    'prepared_opening' => 'Installed into Prepared Opening',
    'remove_existing' => 'Remove Existing Doors & Install'
);

/**
 * ============================================================
 * HELPER FUNCTION
 * ============================================================
 */

if (!function_exists('get_pane_count_from_panel_value')) {
    function get_pane_count_from_panel_value($panel) {
        if (empty($panel)) return 1;
        
        if (strpos($panel, 'French') !== false || strpos($panel, 'french') !== false) {
            return 2;
        }
        
        preg_match('/(\d+)/', $panel, $matches);
        return isset($matches[1]) ? intval($matches[1]) : 1;
    }
}

/**
 * ============================================================
 * 1. REMOVE DEFAULT ADD TO CART BUTTON
 * ============================================================
 */
add_action('init', 'bifolding_door_remove_add_to_cart_button');
function bifolding_door_remove_add_to_cart_button() {
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
}

/**
 * ============================================================
 * 2. ADD DESIGN YOUR DOOR BUTTON
 * ============================================================
 */
/* add_action('woocommerce_single_product_summary', 'bifolding_door_add_design_button', 35);
function bifolding_door_add_design_button() {
    global $product;

    if ($product && $product->is_type('variable')) {
        ?>
        <style>
            .design-your-door-btn {
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
            
            .design-your-door-btn:hover {
                background: #1b5B20 !important;
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
        
        <a class="button design-your-door-btn" href="#" id="design-your-door-btn">
            Design your door
        </a>

        <script>
        jQuery(function($){
            $('#design-your-door-btn').on('click', function(e){
                e.preventDefault();
                var url = '<?php echo site_url('/bifolding-door-builder/'); ?>?product_id=<?php echo $product->get_id(); ?>';
                window.location.href = url;
            });
        });
        </script>
        <?php
    }
} */

/**
 * ============================================================
 * 3. ADD WIZARD DATA TO CART ITEM
 * ============================================================
 */
add_filter('woocommerce_add_cart_item_data', 'bifolding_door_add_wizard_data_to_cart', 10, 3);
function bifolding_door_add_wizard_data_to_cart($cart_item_data, $product_id, $variation_id) {
    global $bifolding_door_panel_map, $bifolding_door_colour_map, $bifolding_door_handle_map, 
           $bifolding_door_glass_map, $bifolding_door_install_map;
    
    // Get form data
    if (isset($_POST['form_data'])) {
        parse_str($_POST['form_data'], $form_data);
    } else {
        $form_data = $_POST;
    }
    
    if (empty($form_data)) {
        return $cart_item_data;
    }
    
    $wizard_data = array();
    
    // Step 1: Size
    if (isset($form_data['width']) && isset($form_data['height'])) {
        $wizard_data['width'] = intval($form_data['width']);
        $wizard_data['height'] = intval($form_data['height']);
    }
    
    // Step 2: Panels
    if (isset($form_data['panel_layout'])) {
        $wizard_data['panels'] = isset($bifolding_door_panel_map[$form_data['panel_layout']]) 
            ? $bifolding_door_panel_map[$form_data['panel_layout']] 
            : $form_data['panel_layout'];
    }
    
    // Step 3: Opening Direction
    if (isset($form_data['open_direction'])) {
        $wizard_data['opening'] = $form_data['open_direction'] === 'inwards' ? 'Inwards' : 'Outwards';
    }
    
    // Step 4: Outside Colour
    if (isset($form_data['door_colour'])) {
        if ($form_data['door_colour'] === 'custom_ral' && !empty($form_data['custom_colour_select'])) {
            $wizard_data['outside_colour'] = $form_data['custom_colour_select'];
            $wizard_data['outside_ral'] = str_replace('RAL ', '', $form_data['custom_colour_select']);
            $wizard_data['outside_colour_price'] = 195;
        } else {
            $colour = isset($bifolding_door_colour_map[$form_data['door_colour']]) 
                ? $bifolding_door_colour_map[$form_data['door_colour']] 
                : array('name' => $form_data['door_colour'], 'ral' => $form_data['door_colour']);
            $wizard_data['outside_colour'] = $colour['name'];
            $wizard_data['outside_ral'] = $colour['ral'];
            $wizard_data['outside_colour_price'] = 0;
        }
    }
    
    // Step 5: Inside Colour
    if (isset($form_data['inside_colour'])) {
        $outside_colour = isset($form_data['door_colour']) ? $form_data['door_colour'] : '';
        $custom_outside = isset($form_data['custom_colour_select']) ? $form_data['custom_colour_select'] : '';
        
        $is_free_dual = ($outside_colour === 'anthracite_grey' && $form_data['inside_colour'] === 'white' && empty($custom_outside));
        
        if ($form_data['inside_colour'] === 'custom_ral' && !empty($form_data['custom_inside_colour_select'])) {
            $wizard_data['inside_colour'] = $form_data['custom_inside_colour_select'];
            $wizard_data['inside_ral'] = str_replace('RAL ', '', $form_data['custom_inside_colour_select']);
            $wizard_data['inside_colour_price'] = $is_free_dual ? 0 : 195;
        } else {
            $colour = isset($bifolding_door_colour_map[$form_data['inside_colour']]) 
                ? $bifolding_door_colour_map[$form_data['inside_colour']] 
                : array('name' => $form_data['inside_colour'], 'ral' => $form_data['inside_colour']);
            $wizard_data['inside_colour'] = $colour['name'];
            $wizard_data['inside_ral'] = $colour['ral'];
            $wizard_data['inside_colour_price'] = ($is_free_dual || $outside_colour === $form_data['inside_colour']) ? 0 : 195;
        }
    }
    
    // Step 6: Handle Colour
    if (isset($form_data['handle_colour'])) {
        $wizard_data['handle'] = isset($bifolding_door_handle_map[$form_data['handle_colour']]) 
            ? $bifolding_door_handle_map[$form_data['handle_colour']] 
            : $form_data['handle_colour'];
    }
    
    // Step 7: Glass
    if (isset($form_data['glass_upgrade'])) {
        if ($form_data['glass_upgrade'] === 'no_thanks') {
            $wizard_data['glass'] = 'no_thanks';
        } else {
            $wizard_data['glass'] = isset($bifolding_door_glass_map[$form_data['glass_upgrade']]) 
                ? $bifolding_door_glass_map[$form_data['glass_upgrade']] 
                : $form_data['glass_upgrade'];
        }
    }
    
    // Step 8: Trickle Vents
    if (isset($form_data['trickle_vents'])) {
        $wizard_data['vents'] = $form_data['trickle_vents'] === 'yes_trickle' ? 'With Vents' : 'No Vents';
    }
    
    // Step 9: Cill
    if (isset($form_data['cill'])) {
        if ($form_data['cill'] === 'none') {
            $wizard_data['cill'] = 'No Cill';
        } elseif ($form_data['cill'] === '150mm-aluminium-cill') {
            $wizard_data['cill'] = '150mm Aluminium Cill';
        } elseif ($form_data['cill'] === '150mm-upvc-cill') {
            $wizard_data['cill'] = '150mm uPVC Cill';
        } else {
            $wizard_data['cill'] = $form_data['cill'];
        }
    }
    
    // Step 10: Postcode
    if (isset($form_data['postcode'])) {
        $wizard_data['postcode'] = sanitize_text_field($form_data['postcode']);
    }
    
    // Step 11: Installation Type
    if (isset($form_data['installation_type'])) {
        $install_value = $form_data['installation_type'];
        $wizard_data['installation_type'] = isset($bifolding_door_install_map[$install_value]) 
            ? $bifolding_door_install_map[$install_value] 
            : $install_value;
        $wizard_data['installation_type_value'] = $install_value;
        
        // Calculate installation price
        $pane_count = get_pane_count_from_panel_value($wizard_data['panels'] ?? '');
        
        if ($install_value === 'prepared_opening') {
            $wizard_data['installation_price'] = $pane_count * 200;
        } elseif ($install_value === 'remove_existing') {
            $wizard_data['installation_price'] = ($pane_count * 200) + 550;
        } elseif ($install_value === 'delivery') {
            $wizard_data['installation_price'] = isset($form_data['delivery_price']) ? floatval($form_data['delivery_price']) : 0;
        } else {
            $wizard_data['installation_price'] = 0;
        }
    }
    
    // Delivery data
    if (isset($form_data['delivery_price'])) {
        $wizard_data['delivery_price'] = floatval($form_data['delivery_price']);
    }
    if (isset($form_data['delivery_zone'])) {
        $wizard_data['delivery_zone'] = sanitize_text_field($form_data['delivery_zone']);
    }
    if (isset($form_data['delivery_distance'])) {
        $wizard_data['delivery_distance'] = floatval($form_data['delivery_distance']);
    }
    if (isset($form_data['delivery_bespoke'])) {
        $wizard_data['delivery_bespoke'] = sanitize_text_field($form_data['delivery_bespoke']);
    }
    
    // Step 12: Access Issues
    if (isset($form_data['access_issues'])) {
        if ($form_data['access_issues'] === 'yes_access') {
            $wizard_data['access'] = isset($form_data['access_description']) && !empty($form_data['access_description']) 
                ? sanitize_text_field($form_data['access_description']) 
                : 'Yes';
        } else {
            $wizard_data['access'] = 'No';
        }
    }
    
    // Step 13: Customer Information
    if (isset($form_data['first_name'])) {
        $wizard_data['first_name'] = sanitize_text_field($form_data['first_name']);
    }
    if (isset($form_data['last_name'])) {
        $wizard_data['last_name'] = sanitize_text_field($form_data['last_name']);
    }
    if (isset($form_data['email_address'])) {
        $wizard_data['email'] = sanitize_email($form_data['email_address']);
    }
    if (isset($form_data['mobile_number'])) {
        $wizard_data['phone'] = sanitize_text_field($form_data['mobile_number']);
    }
    
    // Add unique identifiers
    $wizard_data['unique_id'] = uniqid('door_', true);
    $wizard_data['timestamp'] = time();
    
    $cart_item_data['wizard_data'] = $wizard_data;
    $cart_item_data['unique_key'] = md5(serialize($wizard_data) . time() . rand(1000, 9999));
    
    return $cart_item_data;
}

/**
 * ============================================================
 * 4. HANDLE BUILDER FORM SUBMIT
 * ============================================================
 */
add_action('template_redirect', 'bifolding_door_handle_form_submit');
function bifolding_door_handle_form_submit() {
    if (!isset($_POST['product_id'])) {
        return;
    }
    
    if (!isset($_POST['builder_nonce']) || !wp_verify_nonce($_POST['builder_nonce'], 'door_builder_action')) {
        wc_add_notice('Security check failed. Please try again.', 'error');
        wp_safe_redirect(wc_get_cart_url());
        exit;
    }
    
    $product_id = absint($_POST['product_id']);
    $variation_id = isset($_POST['variation_id']) ? absint($_POST['variation_id']) : 0;
    $final_price = isset($_POST['final_price']) ? floatval($_POST['final_price']) : 0;
    $is_checkout = isset($_POST['builder_checkout']) && $_POST['builder_checkout'] == '1';
    
    // Build wizard data from POST
    $wizard_data = array();
    
    $wizard_data['width'] = isset($_POST['width']) ? intval($_POST['width']) : 0;
    $wizard_data['height'] = isset($_POST['height']) ? intval($_POST['height']) : 0;
    $wizard_data['panels'] = isset($_POST['panel_layout']) ? sanitize_text_field($_POST['panel_layout']) : '';
    $wizard_data['opening'] = isset($_POST['open_direction']) ? ($_POST['open_direction'] === 'inwards' ? 'Inwards' : 'Outwards') : '';
    $wizard_data['outside_colour'] = isset($_POST['door_colour']) ? sanitize_text_field($_POST['door_colour']) : '';
    $wizard_data['inside_colour'] = isset($_POST['inside_colour']) ? sanitize_text_field($_POST['inside_colour']) : '';
    $wizard_data['handle'] = isset($_POST['handle_colour']) ? sanitize_text_field($_POST['handle_colour']) : '';
    $wizard_data['glass'] = isset($_POST['glass_upgrade']) ? sanitize_text_field($_POST['glass_upgrade']) : '';
    $wizard_data['vents'] = isset($_POST['trickle_vents']) ? ($_POST['trickle_vents'] === 'yes_trickle' ? 'With Vents' : 'No Vents') : '';
    $wizard_data['cill'] = isset($_POST['cill']) ? sanitize_text_field($_POST['cill']) : '';
    $wizard_data['postcode'] = isset($_POST['postcode']) ? sanitize_text_field($_POST['postcode']) : '';
    $wizard_data['installation_type'] = isset($_POST['installation_type']) ? sanitize_text_field($_POST['installation_type']) : '';
    $wizard_data['access'] = isset($_POST['access_issues']) ? sanitize_text_field($_POST['access_issues']) : '';
    $wizard_data['first_name'] = isset($_POST['first_name']) ? sanitize_text_field($_POST['first_name']) : '';
    $wizard_data['last_name'] = isset($_POST['last_name']) ? sanitize_text_field($_POST['last_name']) : '';
    $wizard_data['email'] = isset($_POST['email_address']) ? sanitize_email($_POST['email_address']) : '';
    $wizard_data['phone'] = isset($_POST['mobile_number']) ? sanitize_text_field($_POST['mobile_number']) : '';
    
    $wizard_data['unique_id'] = uniqid('door_', true);
    $wizard_data['timestamp'] = time();
    
    $cart_item_data = array(
        'wizard_data' => $wizard_data,
        'custom_price' => $final_price,
        'unique_key' => md5(serialize($wizard_data) . time() . rand(1000, 9999))
    );
    
    // Get variation ID if not provided
    if ($variation_id === 0) {
        $product = wc_get_product($product_id);
        if ($product && $product->is_type('variable')) {
            $available_variations = $product->get_available_variations();
            if (!empty($available_variations)) {
                $variation_id = $available_variations[0]['variation_id'];
            }
        }
    }
    
    $added = WC()->cart->add_to_cart($product_id, 1, $variation_id, array(), $cart_item_data);
    
    if ($added) {
        if ($is_checkout) {
            wc_add_notice('Custom door added. Proceeding to checkout.', 'success');
            wp_safe_redirect(wc_get_checkout_url());
        } else {
            wc_add_notice('Custom door added to cart successfully!', 'success');
            wp_safe_redirect(wc_get_cart_url());
        }
    } else {
        wc_add_notice('Failed to add product to cart. Please try again.', 'error');
        wp_safe_redirect(wc_get_cart_url());
    }
    exit;
}

/**
 * ============================================================
 * 5. AJAX HANDLER FOR BUILDER FORM
 * ============================================================
 */
add_action('wp_ajax_process_door_builder', 'bifolding_door_process_ajax');
add_action('wp_ajax_nopriv_process_door_builder', 'bifolding_door_process_ajax');
function bifolding_door_process_ajax() {
    global $bifolding_door_panel_map, $bifolding_door_colour_map, $bifolding_door_handle_map, 
           $bifolding_door_glass_map, $bifolding_door_install_map;
    
    if (!check_ajax_referer('door_builder_ajax', 'security', false)) {
        wp_send_json_error(array('message' => 'Security check failed (AJAX nonce).'));
    }
    
    parse_str($_POST['form_data'], $form_data);
    
    if (!isset($form_data['builder_nonce']) || !wp_verify_nonce($form_data['builder_nonce'], 'door_builder_action')) {
        wp_send_json_error(array('message' => 'Security check failed (Invalid nonce).'));
    }
    
    $product_id = absint($form_data['product_id']);
    $variation_id = isset($form_data['variation_id']) ? absint($form_data['variation_id']) : 0;
    $final_price = isset($form_data['final_price']) ? floatval($form_data['final_price']) : 0;
    $edit_mode = isset($form_data['edit_mode']) && $form_data['edit_mode'] == '1';
    $cart_item_key = isset($form_data['cart_item_key']) ? sanitize_text_field($form_data['cart_item_key']) : '';
    
    // Build wizard data
    $wizard_data = array();
    
    if (isset($form_data['width'])) {
        $wizard_data['width'] = intval($form_data['width']);
        $wizard_data['height'] = intval($form_data['height']);
    }
    
    if (isset($form_data['panel_layout'])) {
        $wizard_data['panels'] = isset($bifolding_door_panel_map[$form_data['panel_layout']]) 
            ? $bifolding_door_panel_map[$form_data['panel_layout']] 
            : $form_data['panel_layout'];
    }
    
    if (isset($form_data['open_direction'])) {
        $wizard_data['opening'] = $form_data['open_direction'] === 'inwards' ? 'Inwards' : 'Outwards';
    }
    
    if (isset($form_data['door_colour'])) {
        if ($form_data['door_colour'] === 'custom_ral' && !empty($form_data['custom_colour_select'])) {
            $wizard_data['outside_colour'] = $form_data['custom_colour_select'];
            $wizard_data['outside_ral'] = str_replace('RAL ', '', $form_data['custom_colour_select']);
            $wizard_data['outside_colour_price'] = 195;
        } else {
            $colour = isset($bifolding_door_colour_map[$form_data['door_colour']]) 
                ? $bifolding_door_colour_map[$form_data['door_colour']] 
                : array('name' => $form_data['door_colour'], 'ral' => $form_data['door_colour']);
            $wizard_data['outside_colour'] = $colour['name'];
            $wizard_data['outside_ral'] = $colour['ral'];
            $wizard_data['outside_colour_price'] = 0;
        }
    }
    
    if (isset($form_data['inside_colour'])) {
        $outside_colour = isset($form_data['door_colour']) ? $form_data['door_colour'] : '';
        $custom_outside = isset($form_data['custom_colour_select']) ? $form_data['custom_colour_select'] : '';
        
        $is_free_dual = ($outside_colour === 'anthracite_grey' && $form_data['inside_colour'] === 'white' && empty($custom_outside));
        
        if ($form_data['inside_colour'] === 'custom_ral' && !empty($form_data['custom_inside_colour_select'])) {
            $wizard_data['inside_colour'] = $form_data['custom_inside_colour_select'];
            $wizard_data['inside_ral'] = str_replace('RAL ', '', $form_data['custom_inside_colour_select']);
            $wizard_data['inside_colour_price'] = $is_free_dual ? 0 : 195;
        } else {
            $colour = isset($bifolding_door_colour_map[$form_data['inside_colour']]) 
                ? $bifolding_door_colour_map[$form_data['inside_colour']] 
                : array('name' => $form_data['inside_colour'], 'ral' => $form_data['inside_colour']);
            $wizard_data['inside_colour'] = $colour['name'];
            $wizard_data['inside_ral'] = $colour['ral'];
            $wizard_data['inside_colour_price'] = ($is_free_dual || $outside_colour === $form_data['inside_colour']) ? 0 : 195;
        }
    }
    
    if (isset($form_data['handle_colour'])) {
        $wizard_data['handle'] = isset($bifolding_door_handle_map[$form_data['handle_colour']]) 
            ? $bifolding_door_handle_map[$form_data['handle_colour']] 
            : $form_data['handle_colour'];
    }
    
    if (isset($form_data['glass_upgrade'])) {
        if ($form_data['glass_upgrade'] === 'no_thanks') {
            $wizard_data['glass'] = 'no_thanks';
        } else {
            $wizard_data['glass'] = isset($bifolding_door_glass_map[$form_data['glass_upgrade']]) 
                ? $bifolding_door_glass_map[$form_data['glass_upgrade']] 
                : $form_data['glass_upgrade'];
        }
    }
    
    if (isset($form_data['trickle_vents'])) {
        $wizard_data['vents'] = $form_data['trickle_vents'] === 'yes_trickle' ? 'With Vents' : 'No Vents';
    }
    
    if (isset($form_data['cill'])) {
        $wizard_data['cill'] = $form_data['cill'] === 'none' ? 'No Cill' : $form_data['cill'];
    }
    
    if (isset($form_data['installation_type'])) {
        $install_value = $form_data['installation_type'];
        $wizard_data['installation_type'] = isset($bifolding_door_install_map[$install_value]) 
            ? $bifolding_door_install_map[$install_value] 
            : $install_value;
        $wizard_data['installation_type_value'] = $install_value;
        
        $pane_count = get_pane_count_from_panel_value($wizard_data['panels'] ?? '');
        
        if ($install_value === 'prepared_opening') {
            $wizard_data['installation_price'] = $pane_count * 200;
        } elseif ($install_value === 'remove_existing') {
            $wizard_data['installation_price'] = ($pane_count * 200) + 550;
        } elseif ($install_value === 'delivery') {
            $wizard_data['installation_price'] = isset($form_data['delivery_price']) ? floatval($form_data['delivery_price']) : 0;
        } else {
            $wizard_data['installation_price'] = 0;
        }
    }
    
    if (isset($form_data['postcode'])) {
        $wizard_data['postcode'] = sanitize_text_field($form_data['postcode']);
    }
    
    if (isset($form_data['delivery_price'])) {
        $wizard_data['delivery_price'] = floatval($form_data['delivery_price']);
    }
    if (isset($form_data['delivery_zone'])) {
        $wizard_data['delivery_zone'] = sanitize_text_field($form_data['delivery_zone']);
    }
    if (isset($form_data['delivery_distance'])) {
        $wizard_data['delivery_distance'] = floatval($form_data['delivery_distance']);
    }
    if (isset($form_data['delivery_bespoke'])) {
        $wizard_data['delivery_bespoke'] = sanitize_text_field($form_data['delivery_bespoke']);
    }
    
    if (isset($form_data['access_issues'])) {
        if ($form_data['access_issues'] === 'yes_access') {
            $wizard_data['access'] = isset($form_data['access_description']) && !empty($form_data['access_description']) 
                ? sanitize_text_field($form_data['access_description']) 
                : 'Yes';
        } else {
            $wizard_data['access'] = 'No';
        }
    }
    
    if (isset($form_data['first_name'])) {
        $wizard_data['first_name'] = sanitize_text_field($form_data['first_name']);
    }
    if (isset($form_data['last_name'])) {
        $wizard_data['last_name'] = sanitize_text_field($form_data['last_name']);
    }
    if (isset($form_data['email_address'])) {
        $wizard_data['email'] = sanitize_email($form_data['email_address']);
    }
    if (isset($form_data['mobile_number'])) {
        $wizard_data['phone'] = sanitize_text_field($form_data['mobile_number']);
    }
    
    $wizard_data['unique_id'] = uniqid('door_', true);
    $wizard_data['timestamp'] = time();
    
    $cart_item_data = array(
        'wizard_data' => $wizard_data,
        'custom_price' => $final_price,
        'unique_key' => md5(serialize($wizard_data) . time() . rand(1000, 9999))
    );
    
    // Get variation ID if not provided
    if ($variation_id === 0) {
        $product = wc_get_product($product_id);
        if ($product && $product->is_type('variable')) {
            $available_variations = $product->get_available_variations();
            if (!empty($available_variations)) {
                $variation_id = $available_variations[0]['variation_id'];
            }
        }
    }
    
    // Handle edit mode or new cart item
    if ($edit_mode && !empty($cart_item_key)) {
        $cart = WC()->cart->get_cart();
        
        if (isset($cart[$cart_item_key])) {
            $cart_item = $cart[$cart_item_key];
            WC()->cart->remove_cart_item($cart_item_key);
            
            WC()->cart->add_to_cart(
                $cart_item['product_id'],
                $cart_item['quantity'],
                $cart_item['variation_id'],
                $cart_item['variation'],
                $cart_item_data
            );
            
            wp_send_json_success(array(
                'message' => 'Cart updated successfully!',
                'cart_url' => wc_get_cart_url(),
                'is_checkout' => false
            ));
        } else {
            wp_send_json_error(array('message' => 'Cart item not found.'));
        }
    } else {
        $added = WC()->cart->add_to_cart($product_id, 1, $variation_id, array(), $cart_item_data);
        
        if ($added) {
            wp_send_json_success(array(
                'message' => 'Added to cart successfully!',
                'cart_url' => wc_get_cart_url(),
                'is_checkout' => false
            ));
        } else {
            wp_send_json_error(array('message' => 'Failed to add product to cart.'));
        }
    }
}

/**
 * ============================================================
 * 6. APPLY CUSTOM PRICE IN CART
 * ============================================================
 */
add_action('woocommerce_before_calculate_totals', 'bifolding_door_apply_custom_price', 9999, 1);
function bifolding_door_apply_custom_price($cart) {
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }
    
    if (did_action('woocommerce_before_calculate_totals') >= 2) {
        return;
    }
    
    foreach ($cart->get_cart() as $cart_item) {
        if (isset($cart_item['custom_price']) && $cart_item['custom_price'] > 0) {
            $cart_item['data']->set_price($cart_item['custom_price']);
        }
    }
}

/**
 * ============================================================
 * 7. ADD DELIVERY CHARGE TO CART
 * ============================================================
 */
add_action('woocommerce_before_calculate_totals', 'bifolding_door_add_delivery_charge', 20, 1);
function bifolding_door_add_delivery_charge($cart) {
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }
    
    if (did_action('woocommerce_before_calculate_totals') >= 2) {
        return;
    }
    
    $has_door_builder = false;
    $delivery_price = 0;
    $delivery_zone = '';
    $delivery_distance = 0;
    $is_bespoke = false;
    
    foreach ($cart->get_cart() as $cart_item) {
        if (isset($cart_item['wizard_data']['postcode']) && !empty($cart_item['wizard_data']['postcode'])) {
            $has_door_builder = true;
            
            if (isset($cart_item['wizard_data']['delivery_price'])) {
                $delivery_price = floatval($cart_item['wizard_data']['delivery_price']);
                $delivery_zone = isset($cart_item['wizard_data']['delivery_zone']) ? $cart_item['wizard_data']['delivery_zone'] : '';
                $delivery_distance = isset($cart_item['wizard_data']['delivery_distance']) ? floatval($cart_item['wizard_data']['delivery_distance']) : 0;
                $is_bespoke = isset($cart_item['wizard_data']['delivery_bespoke']) && $cart_item['wizard_data']['delivery_bespoke'] === '1';
            } else {
                $postcode = $cart_item['wizard_data']['postcode'];
                $calculator = new Delivery_Calculator();
                $delivery_data = $calculator->calculate_delivery($postcode);
                $delivery_price = $delivery_data['price'];
                $delivery_zone = $delivery_data['zone'];
                $delivery_distance = $delivery_data['distance'];
                $is_bespoke = $delivery_data['bespoke'];
            }
            break;
        }
    }
    
    if (!$has_door_builder) {
        return;
    }
    
    WC()->session->set('door_delivery_data', array(
        'price' => $delivery_price,
        'zone' => $delivery_zone,
        'distance' => $delivery_distance,
        'bespoke' => $is_bespoke
    ));
    
    if (!$is_bespoke && $delivery_price > 0) {
        $fee_exists = false;
        foreach ($cart->get_fees() as $fee) {
            if (strpos($fee->name, 'Delivery') !== false) {
                $fee_exists = true;
                break;
            }
        }
        
        if (!$fee_exists) {
            $cart->add_fee(
                __('Delivery', 'woocommerce') . ' (' . $delivery_zone . ' - ' . round($delivery_distance, 1) . ' miles)',
                $delivery_price,
                true
            );
        }
    }
}

/**
 * ============================================================
 * 8. BLOCK CHECKOUT FOR BESPOKE DELIVERY
 * ============================================================
 */
add_action('woocommerce_checkout_process', 'bifolding_door_block_bespoke_checkout');
function bifolding_door_block_bespoke_checkout() {
    $delivery_data = WC()->session->get('door_delivery_data');
    
    if ($delivery_data && isset($delivery_data['bespoke']) && $delivery_data['bespoke']) {
        wc_add_notice(
            sprintf(
                'Bespoke delivery required for %s. Please call our sales team on 01234 567890 to complete your order.',
                $delivery_data['zone']
            ),
            'error'
        );
    }
}

/**
 * ============================================================
 * 9. SAVE WIZARD DATA TO ORDER ITEMS
 * ============================================================
 */
add_action('woocommerce_checkout_create_order_line_item', 'bifolding_door_save_wizard_to_order', 10, 3);
function bifolding_door_save_wizard_to_order($item, $cart_item_key, $values) {
    if (!empty($values['wizard_data'])) {
        foreach ($values['wizard_data'] as $key => $value) {
            if ($key === 'glass') {
                if ($value === 'no_thanks') {
                    $item->add_meta_data('builder_glass', 'No Thanks - Standard Glass', true);
                } else {
                    $item->add_meta_data('builder_glass', $value, true);
                }
            } elseif (in_array($key, array('outside_colour_price', 'inside_colour_price', 'installation_price'))) {
                $item->add_meta_data('builder_' . $key, $value, true);
            } elseif ($key === 'installation_type_value') {
                $item->add_meta_data('builder_installation_value', $value, true);
            } else {
                $item->add_meta_data('builder_' . $key, $value, true);
            }
        }
    }
    
    if (isset($values['custom_price'])) {
        $item->add_meta_data('_custom_price', $values['custom_price'], true);
    }
}

/**
 * ============================================================
 * 10. DISPLAY BUILDER DATA IN CART WITH EDIT BUTTON
 * ============================================================
 */
add_action('woocommerce_after_cart_item_name', 'bifolding_door_display_cart_data', 10, 2);
function bifolding_door_display_cart_data($cart_item, $cart_item_key) {
    if (!isset($cart_item['wizard_data']) || empty($cart_item['wizard_data'])) {
        return;
    }
    
    $wizard = $cart_item['wizard_data'];
    $edit_url = add_query_arg(array(
        'edit_cart_item' => $cart_item_key,
        'product_id' => $cart_item['product_id'],
        'variation_id' => $cart_item['variation_id']
    ), home_url('/bifolding-door-builder/'));
    
    echo '<div class="door-builder-cart-data">';
    echo '<div class="cart-data-header">';
    echo '<h4>Your Custom Door Configuration</h4>';
    echo '<a href="' . esc_url($edit_url) . '" class="edit-config-btn">Edit Configuration</a>';
    echo '</div>';
    echo '<div class="config-details-grid">';
    
    if (!empty($wizard['width']) && !empty($wizard['height'])) {
        echo '<div class="detail-item">';
        echo '<span class="detail-label">Size: </span>';
        echo '<span class="detail-value">' . esc_html($wizard['width'] . ' x ' . $wizard['height'] . ' mm') . '</span>';
        echo '</div>';
    }
    
    if (!empty($wizard['panels'])) {
        echo '<div class="detail-item">';
        echo '<span class="detail-label">Panels: </span>';
        echo '<span class="detail-value">' . esc_html($wizard['panels']) . '</span>';
        echo '</div>';
    }
    
    if (!empty($wizard['opening'])) {
        echo '<div class="detail-item">';
        echo '<span class="detail-label">Opening: </span>';
        echo '<span class="detail-value">' . esc_html($wizard['opening']) . '</span>';
        echo '</div>';
    }
    
    if (!empty($wizard['outside_colour'])) {
        $outside = $wizard['outside_colour'];
        if (!empty($wizard['outside_ral'])) {
            $outside .= ' (' . $wizard['outside_ral'] . ')';
        }
        echo '<div class="detail-item">';
        echo '<span class="detail-label">Outside: </span>';
        echo '<span class="detail-value">' . esc_html($outside) . '</span>';
        echo '</div>';
    }
    
    if (!empty($wizard['inside_colour'])) {
        $inside = $wizard['inside_colour'];
        if (!empty($wizard['inside_ral'])) {
            $inside .= ' (' . $wizard['inside_ral'] . ')';
        }
        echo '<div class="detail-item">';
        echo '<span class="detail-label">Inside: </span>';
        echo '<span class="detail-value">' . esc_html($inside) . '</span>';
        echo '</div>';
    }
    
    if (!empty($wizard['handle'])) {
        echo '<div class="detail-item">';
        echo '<span class="detail-label">Handle: </span>';
        echo '<span class="detail-value">' . esc_html($wizard['handle']) . '</span>';
        echo '</div>';
    }
    
    if (!empty($wizard['glass'])) {
        $glass_display = $wizard['glass'] === 'no_thanks' ? 'Standard Glass' : $wizard['glass'];
        echo '<div class="detail-item">';
        echo '<span class="detail-label">Glass: </span>';
        echo '<span class="detail-value">' . esc_html($glass_display) . '</span>';
        echo '</div>';
    }
    
    if (isset($wizard['vents'])) {
        echo '<div class="detail-item">';
        echo '<span class="detail-label">Vents: </span>';
        echo '<span class="detail-value">' . esc_html($wizard['vents']) . '</span>';
        echo '</div>';
    }
    
    if (!empty($wizard['cill'])) {
        echo '<div class="detail-item">';
        echo '<span class="detail-label">Cill: </span>';
        echo '<span class="detail-value">' . esc_html($wizard['cill']) . '</span>';
        echo '</div>';
    }
    
    if (!empty($wizard['installation_type'])) {
        echo '<div class="detail-item">';
        echo '<span class="detail-label">Installation: </span>';
        echo '<span class="detail-value">' . esc_html($wizard['installation_type']) . '</span>';
        echo '</div>';
    }
    
    if (!empty($wizard['postcode'])) {
        echo '<div class="detail-item">';
        echo '<span class="detail-label">Postcode: </span>';
        echo '<span class="detail-value">' . esc_html($wizard['postcode']) . '</span>';
        echo '</div>';
    }
    
    if (!empty($wizard['access'])) {
        echo '<div class="detail-item">';
        echo '<span class="detail-label">Access: </span>';
        echo '<span class="detail-value">' . esc_html($wizard['access']) . '</span>';
        echo '</div>';
    }
    
    echo '</div>';
    echo '</div>';
}

/**
 * ============================================================
 * 11. CART PAGE CSS
 * ============================================================
 */
add_action('wp_head', 'bifolding_door_cart_css');
function bifolding_door_cart_css() {
    if (!is_cart()) {
        return;
    }
    ?>
    <style>
        .door-builder-cart-data {
            background: #ffffff;
            border: 1px solid #e8e8e8;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }
        
        .cart-data-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #cbbfa9;
        }
        
        .cart-data-header h4 {
            margin: 0;
            color: #1a1a1a;
            font-size: 16px;
            font-weight: 600;
        }
        
        .edit-config-btn {
            background: #2e7d32 !important;
            color: white;
            padding: 6px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            transition: all 0.2s ease;
        }
        
        .edit-config-btn:hover {
            background: #1b5e20 !important;
            color: white;
            transform: translateY(-1px);
        }
        
        .config-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 12px;
        }
        
        .detail-item {
            display: flex;
            align-items: baseline;
            padding: 8px 12px;
            background: #f8f8f8;
            border-radius: 4px;
            font-size: 13px;
        }
        
        .detail-label {
            color: #666;
            font-weight: 500;
            min-width: 70px;
            text-transform: uppercase;
            font-size: 11px;
        }
        
        .detail-value {
            color: #333;
            margin-left: 8px;
        }
        
        @media (max-width: 768px) {
            .config-details-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <?php
}

/**
 * ============================================================
 * 12. AJAX ENDPOINT FOR DELIVERY CALCULATION
 * ============================================================
 */
add_action('wp_ajax_check_delivery', 'bifolding_door_ajax_check_delivery');
add_action('wp_ajax_nopriv_check_delivery', 'bifolding_door_ajax_check_delivery');
function bifolding_door_ajax_check_delivery() {
    $postcode = sanitize_text_field($_POST['postcode']);
    
    if (empty($postcode)) {
        wp_send_json_error(array('message' => 'Postcode required'));
    }

    $calculator = new Delivery_Calculator();
    $result = $calculator->calculate_delivery($postcode);
    
    wp_send_json_success($result);
}

/**
 * ============================================================
 * 13. TECHNICAL SPECIFICATION IMAGE
 * ============================================================
 */
/* add_action('woocommerce_single_product_summary', 'bifolding_door_show_technical_spec', 50);
function bifolding_door_show_technical_spec() {
    if (!is_product()) {
        return;
    }
    
    $image = get_field('technical_specification_image');
    if ($image) {
        echo '<div class="technical-specification-image">';
        echo '<img src="' . esc_url($image) . '" alt="Bi-fold door technical specification">';
        echo '</div>';
    }
} */

add_action('wp_head', 'bifolding_door_tech_spec_css');
function bifolding_door_tech_spec_css() {
    if (!is_product()) {
        return;
    }
    ?>
    <style>
        .technical-specification-image {
            margin-top: 25px;
            margin-bottom: 25px;
        }
        .technical-specification-image img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 6px;
        }
    </style>
    <?php
}

/**
 * ============================================================
 * 14. CUSTOM IMAGE IN CART BASED ON PANEL SELECTION
 * ============================================================
 */
add_filter('woocommerce_cart_item_thumbnail', 'bifolding_door_custom_cart_thumbnail', 10, 3);
function bifolding_door_custom_cart_thumbnail($thumbnail, $cart_item, $cart_item_key) {
    if (!isset($cart_item['wizard_data']['panels'])) {
        return $thumbnail;
    }
    
    $panels = $cart_item['wizard_data']['panels'];
    
    $panel_image_map = array(
        '2 Panels Left' => '2_Panel_Left_500x.webp',
        '2 Panels Right' => '2_Panel_Right_500x.webp',
        '3 Panels Left' => '3_Panel_Left_500x.webp',
        '3 Panels Right' => '3_Panel_Right_500x.webp',
        '1 + 3 Panels' => '1_3_Panel_500x.webp',
        '3 + 1 Panels' => '3_1_Panel_500x.webp',
        '4 Panels Left' => '4_Panel_Left_500x.webp',
        '4 Panels Right' => '4_Panel_Right_500x.webp',
        '5 Panels Left' => '5_Panel_Left_500x.webp',
        '5 Panels Right' => '5_Panel_Right_500x.webp',
        '1 + 5 Panels' => '1_5_Panel_500x.avif',
        '2 + 4 Panels' => '2_4_Panel_500x.avif',
        '3 + 3 Panels' => '3_3_Panel_500x.avif',
        '4 + 2 Panels' => '4_2_Panel_500x.avif',
        '5 + 1 Panels' => '5_1_Panel_500x.avif',
        '6 Panels Left' => '6_Panel_Left_500x.avif',
        '6 Panels Right' => '6_Panel_Right_500x.avif',
        'French Doors' => 'French_Doors_500x.webp',
    );
    
    $image_file = isset($panel_image_map[$panels]) ? $panel_image_map[$panels] : '';
    
    if (!empty($image_file)) {
        $image_url = get_stylesheet_directory_uri() . '/assets/images/bifold-doors/' . $image_file;
        $thumbnail = '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($panels) . '" class="woocommerce-placeholder wp-post-image" width="300" height="300" style="object-fit: contain; background: #f5f5f5; padding: 10px;" />';
    }
    
    return $thumbnail;
}

/**
 * ============================================================
 * 15. DOOR PHOTO UPLOAD HANDLING
 * ============================================================
 */
add_action('wp_ajax_upload_door_photo', 'bifolding_door_handle_photo_upload');
add_action('wp_ajax_nopriv_upload_door_photo', 'bifolding_door_handle_photo_upload');
function bifolding_door_handle_photo_upload() {
    if (!check_ajax_referer('door_builder_ajax', 'security', false)) {
        wp_send_json_error('Security check failed');
    }
    
    if (!isset($_FILES['door_photo']) || empty($_FILES['door_photo']['name'])) {
        wp_send_json_error('No file uploaded');
    }
    
    $uploaded_file = $_FILES['door_photo'];
    
    if ($uploaded_file['error'] !== UPLOAD_ERR_OK) {
        wp_send_json_error('Upload error: ' . $uploaded_file['error']);
    }
    
    $allowed_types = array('image/jpeg', 'image/jpg', 'image/png');
    $file_type = wp_check_filetype($uploaded_file['name']);
    
    if (!in_array($file_type['type'], $allowed_types)) {
        wp_send_json_error('Invalid file type. Only JPG and PNG allowed.');
    }
    
    if ($uploaded_file['size'] > 5 * 1024 * 1024) {
        wp_send_json_error('File too large. Maximum size is 5MB.');
    }
    
    $upload_dir = wp_upload_dir();
    $filename = sanitize_file_name(time() . '_' . $uploaded_file['name']);
    $filepath = $upload_dir['path'] . '/' . $filename;
    
    if (move_uploaded_file($uploaded_file['tmp_name'], $filepath)) {
        $attachment = array(
            'post_mime_type' => $file_type['type'],
            'post_title' => sanitize_file_name($filename),
            'post_content' => '',
            'post_status' => 'inherit',
            'post_author' => get_current_user_id()
        );
        
        $attach_id = wp_insert_attachment($attachment, $filepath);
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attach_data = wp_generate_attachment_metadata($attach_id, $filepath);
        wp_update_attachment_metadata($attach_id, $attach_data);
        
        // Store in session
        if (!session_id()) {
            session_start();
        }
        $_SESSION['door_photo_' . session_id()] = array(
            'id' => $attach_id,
            'url' => wp_get_attachment_url($attach_id),
            'filename' => $filename,
            'original_name' => $uploaded_file['name']
        );
        
        wp_send_json_success(array(
            'id' => $attach_id,
            'url' => wp_get_attachment_url($attach_id),
            'filename' => $filename,
            'original_name' => $uploaded_file['name']
        ));
    } else {
        wp_send_json_error('Failed to move uploaded file');
    }
}

/**
 * ============================================================
 * 16. ENSURE SESSION STARTED FOR PHOTO UPLOAD
 * ============================================================
 */
add_action('init', 'bifolding_door_ensure_session');
function bifolding_door_ensure_session() {
    if (is_page('bifolding-door-builder') && !session_id()) {
        session_start();
    }
}