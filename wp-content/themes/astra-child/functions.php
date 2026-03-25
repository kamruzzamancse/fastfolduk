<?php
/**
 * Enqueue parent and child theme styles
 */
add_action( 'wp_enqueue_scripts', 'astra_child_style' );
function astra_child_style() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style') );
}

/**
 * Include delivery calculator class
 */
require_once get_stylesheet_directory() . '/delivery-calculator.php';

/**
 * Enqueue Door Builder assets only on builder page
 */
add_action( 'wp_enqueue_scripts', function() {
    if ( is_page( 'bifold-door-builder' ) ) {
        // Disable theme styles on builder page
        wp_dequeue_style( 'parent-style' );
        wp_dequeue_style( 'child-style' );
        wp_dequeue_style( 'astra-theme-css' );
        
        // === IMPORTANT: Dequeue Elementor scripts to avoid conflicts ===
        wp_dequeue_script( 'elementor-frontend' );
        wp_dequeue_script( 'elementor-pro-frontend' );
        wp_dequeue_script( 'elementor' );
        
        // Load builder CSS and JS
        wp_enqueue_style( 'door-builder-css', get_stylesheet_directory_uri() . '/assets/css/wizard.css' );
        wp_enqueue_script( 'door-builder-js', get_stylesheet_directory_uri() . '/assets/js/wizard.js', ['jquery'], null, true );
        
        // Add inline CSS to hide theme elements
        add_action( 'wp_head', 'hide_theme_elements' );
        
        // Add logo CSS
        add_action( 'wp_head', 'add_builder_logo' );
        
        // Localize script for AJAX
        wp_localize_script( 'door-builder-js', 'door_builder_vars', [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'cart_url' => wc_get_cart_url(),
            'checkout_url' => wc_get_checkout_url(),
            'nonce' => wp_create_nonce( 'door_builder_ajax' ),
        ] );
    }
});

/**
 * Hide theme header and footer on builder page
 */
function hide_theme_elements() {
    if ( is_page( 'bifold-door-builder' ) ) {
        ?>
        <style>
            /* Hide all theme elements */
            header, 
            footer, 
            .site-header, 
            .site-footer, 
            #masthead, 
            #colophon,
            .ast-header,
            .ast-footer,
            nav,
            .main-header,
            .main-footer {
                display: none !important;
            }
            
            /* Hide WordPress admin bar on builder */
            #wpadminbar {
                display: none !important;
            }
        </style>
        <?php
    }
}

/**
 * Add logo to builder header
 */
function add_builder_logo() {
    if ( is_page( 'bifold-door-builder' ) ) {
        ?>
        <style>
            /* .builder-logo {
                position: absolute;
                top: 30px;
                left: 40px;
                height: 40px;
                z-index: 10;
            } */
            
            /* .builder-logo img {
                height: 100%;
                width: auto;
            } */
            
            @media (max-width: 768px) {
                /* .builder-logo {
                    top: 20px;
                    left: 20px;
                    height: 30px;
                } */
            }
        </style>
        <?php
    }
}

/**
 * Remove default WooCommerce Add to Cart button
 */
add_action( 'init', function() {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
});

/**
 * Add "Design your door" button on variable product pages
 */
add_action( 'woocommerce_single_product_summary', function() {
    global $product;

    if ( $product && $product->is_type( 'variable' ) ) {
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
            
            /* Hide default add to cart button and variation dropdown */
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

                let url = '<?php echo site_url('/bifold-door-builder/'); ?>?product_id=<?php echo $product->get_id(); ?>';
                window.location.href = url;
            });
        });
        </script>
        <?php
    }
}, 35 );

/**
 * Helper function to get pane count from panel value
 */
function get_pane_count_from_panel_value($panel) {
    if (empty($panel)) return 1;
    
    if (strpos($panel, 'French') !== false) {
        return 2;
    }
    
    // Extract numbers from panel string (e.g., "2 Panels Left" -> 2)
    preg_match('/(\d+)/', $panel, $matches);
    if (isset($matches[1])) {
        return intval($matches[1]);
    }
    
    return 1;
}

/**
 * Prevent WooCommerce from merging cart items
 */
add_filter( 'woocommerce_add_cart_item_data', 'custom_door_builder_cart_item_data', 10, 3 );
function custom_door_builder_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
    
    if ( isset( $_POST['form_data'] ) ) {
        parse_str( $_POST['form_data'], $form_data );
    } else {
        $form_data = $_POST;
    }
    
    $wizard_data = array();
    
    // STEP 1: Size
    if ( isset( $form_data['width'] ) && isset( $form_data['height'] ) ) {
        $wizard_data['width'] = intval( $form_data['width'] );
        $wizard_data['height'] = intval( $form_data['height'] );
    }
    
    // STEP 2: Panels
    if ( isset( $form_data['panel_layout'] ) ) {
        $panel_value = $form_data['panel_layout'];
        $panel_map = array(
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
        $wizard_data['panels'] = isset( $panel_map[$panel_value] ) ? $panel_map[$panel_value] : $panel_value;
    }
    
    // STEP 3: Opening Direction
    if ( isset( $form_data['open_direction'] ) ) {
        $wizard_data['opening'] = $form_data['open_direction'] === 'inwards' ? 'Inwards' : 'Outwards';
    }
    
    // STEP 4: Outside Colour
    if ( isset( $form_data['door_colour'] ) ) {
        $colour = $form_data['door_colour'];
        
        if ( $colour === 'custom_ral' && isset( $form_data['custom_colour_select'] ) && !empty($form_data['custom_colour_select']) ) {
            $wizard_data['outside_colour'] = $form_data['custom_colour_select'];
            $wizard_data['outside_ral'] = str_replace('RAL ', '', $form_data['custom_colour_select']);
        } else {
            $colour_map = array(
                'anthracite_grey' => 'Anthracite Grey',
                'black' => 'Black',
                'white' => 'White'
            );
            $wizard_data['outside_colour'] = isset( $colour_map[$colour] ) ? $colour_map[$colour] : $colour;
            
            $ral_map = array(
                'anthracite_grey' => '7016',
                'black' => '9005',
                'white' => '9016'
            );
            $wizard_data['outside_ral'] = isset( $ral_map[$colour] ) ? $ral_map[$colour] : $colour;
        }
    }
    
    // STEP 5: Inside Colour
    if ( isset( $form_data['inside_colour'] ) ) {
        $colour = $form_data['inside_colour'];
        
        if ( $colour === 'custom_ral' && isset( $form_data['custom_inside_colour_select'] ) && !empty($form_data['custom_inside_colour_select']) ) {
            $wizard_data['inside_colour'] = $form_data['custom_inside_colour_select'];
            $wizard_data['inside_ral'] = str_replace('RAL ', '', $form_data['custom_inside_colour_select']);
        } else {
            $colour_map = array(
                'anthracite_grey' => 'Anthracite Grey',
                'black' => 'Black',
                'white' => 'White'
            );
            $wizard_data['inside_colour'] = isset( $colour_map[$colour] ) ? $colour_map[$colour] : $colour;
            
            $ral_map = array(
                'anthracite_grey' => '7016',
                'black' => '9005',
                'white' => '9016'
            );
            $wizard_data['inside_ral'] = isset( $ral_map[$colour] ) ? $ral_map[$colour] : $colour;
        }
    }
    
    // STEP 6: Handle Colour
    if ( isset( $form_data['handle_colour'] ) ) {
        $handle = $form_data['handle_colour'];
        $handle_map = array(
            'white' => 'White',
            'chrome' => 'Chrome',
            'black' => 'Black',
            'black_white' => 'Black and White'
        );
        $wizard_data['handle'] = isset( $handle_map[$handle] ) ? $handle_map[$handle] : $handle;
    }
    
    // STEP 7: Glass
    if ( isset( $form_data['glass_upgrade'] ) ) {
        $glass = $form_data['glass_upgrade'];
        
        if ($glass === 'no_thanks') {
            $wizard_data['glass'] = 'no_thanks';
        } else {
            $glass_map = array(
                'self_cleaning' => 'Self-cleaning glass',
                'integral_blinds' => 'Integral blinds',
                'obscure_glass' => 'Obscure glass',
                'saint_gobain_12' => 'Saint-Gobain Planitherm 1.2'
            );
            $wizard_data['glass'] = isset( $glass_map[$glass] ) ? $glass_map[$glass] : $glass;
        }
    }
    
    // STEP 8: Trickle Vents
    if ( isset( $form_data['trickle_vents'] ) ) {
        $wizard_data['vents'] = $form_data['trickle_vents'] === 'yes_trickle' ? 'With Vents' : 'No Vents';
    }
    
    // STEP 9: Cill
    if ( isset( $form_data['cill'] ) ) {
        $cill_value = $form_data['cill'];
        
        if ($cill_value === 'none') {
            $wizard_data['cill'] = 'No Cill';
        } elseif ($cill_value === '150mm-aluminium-cill') {
            $wizard_data['cill'] = '150mm Aluminium Cill';
        } elseif ($cill_value === '150mm-upvc-cill') {
            $wizard_data['cill'] = '150mm uPVC Cill';
        } else {
            $wizard_data['cill'] = $cill_value;
        }
    }
    
    // STEP 10: Postcode
    if ( isset( $form_data['postcode'] ) ) {
        $wizard_data['postcode'] = sanitize_text_field( $form_data['postcode'] );
    }
    
    // STEP 11: Installation Type
    if ( isset( $form_data['installation_type'] ) ) {
        $install_value = $form_data['installation_type'];
        
        $install_map = array(
            'collection' => 'Supply Only - Collection',
            'delivery' => 'Supply Only - Delivery',
            'prepared_opening' => 'Installed into Prepared Opening',
            'remove_existing' => 'Remove Existing Doors & Install'
        );
        
        $wizard_data['installation_type'] = isset( $install_map[$install_value] ) ? $install_map[$install_value] : $install_value;
        $wizard_data['installation_type_value'] = $install_value;
    }
    
    // Delivery data
    if ( isset( $form_data['delivery_price'] ) ) {
        $wizard_data['delivery_price'] = floatval( $form_data['delivery_price'] );
    }
    if ( isset( $form_data['delivery_zone'] ) ) {
        $wizard_data['delivery_zone'] = sanitize_text_field( $form_data['delivery_zone'] );
    }
    if ( isset( $form_data['delivery_distance'] ) ) {
        $wizard_data['delivery_distance'] = floatval( $form_data['delivery_distance'] );
    }
    if ( isset( $form_data['delivery_bespoke'] ) ) {
        $wizard_data['delivery_bespoke'] = sanitize_text_field( $form_data['delivery_bespoke'] );
    }
    
    // STEP 12: Access Issues
    if ( isset( $form_data['access_issues'] ) ) {
        if ( $form_data['access_issues'] === 'yes_access' ) {
            $access_desc = isset( $form_data['access_description'] ) && !empty( $form_data['access_description'] ) 
                ? sanitize_text_field( $form_data['access_description'] ) 
                : 'Yes';
            $wizard_data['access'] = $access_desc;
        } else {
            $wizard_data['access'] = 'No';
        }
    }
    
    // STEP 13: Customer Information
    if ( isset( $form_data['first_name'] ) ) {
        $wizard_data['first_name'] = sanitize_text_field( $form_data['first_name'] );
    }
    if ( isset( $form_data['last_name'] ) ) {
        $wizard_data['last_name'] = sanitize_text_field( $form_data['last_name'] );
    }
    if ( isset( $form_data['email_address'] ) ) {
        $wizard_data['email'] = sanitize_email( $form_data['email_address'] );
    }
    if ( isset( $form_data['mobile_number'] ) ) {
        $wizard_data['phone'] = sanitize_text_field( $form_data['mobile_number'] );
    }
    
    // Door photo for remove existing
    if ( isset( $_FILES['door_photo'] ) && !empty( $_FILES['door_photo']['name'] ) ) {
        $uploaded_file = $_FILES['door_photo'];
        $wizard_data['door_photo'] = sanitize_file_name( $uploaded_file['name'] );
    }
    
    // Add unique identifier
    $wizard_data['unique_id'] = uniqid('door_', true);
    $wizard_data['timestamp'] = time();
    
    $unique_hash = md5( serialize( $wizard_data ) . time() . rand(1000, 9999) );
    
    $cart_item_data['wizard_data'] = $wizard_data;
    $cart_item_data['unique_key'] = $unique_hash;
    
    return $cart_item_data;
}

/**
 * Handle builder form submit
 */
add_action( 'template_redirect', function() {
    if ( isset( $_POST['product_id'] ) ) {
        
        if ( ! isset( $_POST['builder_nonce'] ) || ! wp_verify_nonce( $_POST['builder_nonce'], 'door_builder_action' ) ) {
            wc_add_notice( 'Security check failed. Please try again.', 'error' );
            wp_safe_redirect( wc_get_cart_url() );
            exit;
        }
        
        $product_id   = absint( $_POST['product_id'] );
        $variation_id = isset( $_POST['variation_id'] ) ? absint( $_POST['variation_id'] ) : 0;
        $final_price  = isset($_POST['final_price']) ? floatval( $_POST['final_price'] ) : 0;
        
        $is_checkout = isset( $_POST['builder_checkout'] ) && $_POST['builder_checkout'] == '1';

        $wizard_data = array();
        
        $wizard_data['width'] = isset($_POST['width']) ? intval($_POST['width']) : 
                               (isset($_POST['summary_size']) ? intval(explode(' x ', $_POST['summary_size'])[0]) : 0);
        
        $wizard_data['height'] = isset($_POST['height']) ? intval($_POST['height']) : 
                                (isset($_POST['summary_size']) && strpos($_POST['summary_size'], ' x ') ? 
                                 intval(explode(' x ', $_POST['summary_size'])[1]) : 0);
        
        $wizard_data['panels'] = isset($_POST['panel_layout']) ? sanitize_text_field($_POST['panel_layout']) : 
                                (isset($_POST['summary_panels']) ? sanitize_text_field($_POST['summary_panels']) : '');
        
        $wizard_data['opening'] = isset($_POST['open_direction']) ? 
                                  ($_POST['open_direction'] === 'inwards' ? 'Inwards' : 'Outwards') : 
                                  (isset($_POST['summary_opening']) ? sanitize_text_field($_POST['summary_opening']) : '');
        
        $outside_colour = isset($_POST['door_colour']) ? $_POST['door_colour'] : '';
        $inside_colour = isset($_POST['inside_colour']) ? $_POST['inside_colour'] : '';
        $custom_outside = isset($_POST['custom_colour_select']) ? $_POST['custom_colour_select'] : '';
        $custom_inside = isset($_POST['custom_inside_colour_select']) ? $_POST['custom_inside_colour_select'] : '';
        
        if ( isset($_POST['door_colour']) ) {
            if ( $_POST['door_colour'] === 'custom_ral' && isset($_POST['custom_colour_select']) && !empty($_POST['custom_colour_select']) ) {
                $wizard_data['outside_colour'] = sanitize_text_field($_POST['custom_colour_select']);
                $wizard_data['outside_colour_price'] = 195;
                $wizard_data['outside_ral'] = str_replace('RAL ', '', $_POST['custom_colour_select']);
            } else {
                $colour_map = array(
                    'anthracite_grey' => 'Anthracite Grey',
                    'black' => 'Black',
                    'white' => 'White'
                );
                $wizard_data['outside_colour'] = isset( $colour_map[$_POST['door_colour']] ) ? $colour_map[$_POST['door_colour']] : $_POST['door_colour'];
                
                $ral_map = array(
                    'anthracite_grey' => '7016',
                    'black' => '9005',
                    'white' => '9016'
                );
                $wizard_data['outside_ral'] = isset( $ral_map[$_POST['door_colour']] ) ? $ral_map[$_POST['door_colour']] : $_POST['door_colour'];
                $wizard_data['outside_colour_price'] = 0;
            }
        } else {
            $wizard_data['outside_colour'] = isset($_POST['summary_outside_colour']) ? sanitize_text_field($_POST['summary_outside_colour']) : '';
        }
        
        if ( isset($_POST['inside_colour']) ) {
            $standard_colours = array('anthracite_grey', 'black', 'white');
            
            $is_free_dual = (
                $outside_colour === 'anthracite_grey' && 
                $_POST['inside_colour'] === 'white' && 
                empty($custom_outside) && 
                !isset($_POST['custom_inside_colour_select'])
            );

            $is_same_standard = (
                $outside_colour === $_POST['inside_colour'] && 
                in_array($_POST['inside_colour'], $standard_colours) &&
                empty($custom_outside) && 
                !isset($_POST['custom_inside_colour_select'])
            );

            $is_standard_dual = (
                in_array($outside_colour, $standard_colours) &&
                in_array($_POST['inside_colour'], $standard_colours) &&
                $outside_colour !== $_POST['inside_colour'] &&
                !$is_free_dual && 
                empty($custom_outside) && 
                !isset($_POST['custom_inside_colour_select'])
            );
            
            if ( $_POST['inside_colour'] === 'custom_ral' && isset($_POST['custom_inside_colour_select']) && !empty($_POST['custom_inside_colour_select']) ) {
                $wizard_data['inside_colour'] = sanitize_text_field($_POST['custom_inside_colour_select']);
                
                if ( $is_free_dual ) {
                    $wizard_data['inside_colour_price'] = 0;
                } else {
                    $wizard_data['inside_colour_price'] = 195;
                }
                
                $wizard_data['inside_ral'] = str_replace('RAL ', '', $_POST['custom_inside_colour_select']);
            } else {
                $colour_map = array(
                    'anthracite_grey' => 'Anthracite Grey',
                    'black' => 'Black',
                    'white' => 'White'
                );
                $wizard_data['inside_colour'] = isset( $colour_map[$_POST['inside_colour']] ) ? $colour_map[$_POST['inside_colour']] : $_POST['inside_colour'];
                
                $ral_map = array(
                    'anthracite_grey' => '7016',
                    'black' => '9005',
                    'white' => '9016'
                );
                $wizard_data['inside_ral'] = isset( $ral_map[$_POST['inside_colour']] ) ? $ral_map[$_POST['inside_colour']] : $_POST['inside_colour'];
                
                if ( $is_free_dual || $is_same_standard ) {
                    $wizard_data['inside_colour_price'] = 0;
                } elseif ( $is_standard_dual ) {
                    $wizard_data['inside_colour_price'] = 195;
                } else {
                    $wizard_data['inside_colour_price'] = 0;
                }
            }
        } else {
            $wizard_data['inside_colour'] = isset($_POST['summary_inside_colour']) ? sanitize_text_field($_POST['summary_inside_colour']) : '';
        }
        
        $wizard_data['handle'] = isset($_POST['summary_handle_colour']) ? sanitize_text_field($_POST['summary_handle_colour']) : '';
        
        if (isset($_POST['summary_glass'])) {
            $glass_value = sanitize_text_field($_POST['summary_glass']);
            if ($glass_value === 'No Thanks - Standard Glass') {
                $wizard_data['glass'] = 'no_thanks';
            } else {
                $wizard_data['glass'] = $glass_value;
            }
        } else {
            $wizard_data['glass'] = '';
        }
        
        $wizard_data['vents'] = isset($_POST['trickle_vents']) ? 
                               ($_POST['trickle_vents'] === 'yes_trickle' ? 'With Vents' : 'No Vents') : 
                               (isset($_POST['summary_trickle_vents']) ? 
                                ($_POST['summary_trickle_vents'] === 'Yes, Add Trickle Vent' ? 'With Vents' : 'No Vents') : 'No Vents');
        
        $wizard_data['threshold'] = isset($_POST['summary_threshold']) ? sanitize_text_field($_POST['summary_threshold']) : '';
        $wizard_data['cill'] = isset($_POST['summary_cill']) ? sanitize_text_field($_POST['summary_cill']) : '';
        
        $wizard_data['delivery_price'] = isset($_POST['delivery_price']) ? floatval($_POST['delivery_price']) : 0;
        $wizard_data['delivery_zone'] = isset($_POST['delivery_zone']) ? sanitize_text_field($_POST['delivery_zone']) : '';
        $wizard_data['delivery_distance'] = isset($_POST['delivery_distance']) ? floatval($_POST['delivery_distance']) : 0;
        $wizard_data['delivery_bespoke'] = isset($_POST['delivery_bespoke']) ? sanitize_text_field($_POST['delivery_bespoke']) : '0';
        $wizard_data['postcode'] = isset($_POST['postcode']) ? sanitize_text_field($_POST['postcode']) : 
                                  (isset($_POST['summary_postcode']) ? sanitize_text_field($_POST['summary_postcode']) : '');
        
        $wizard_data['access'] = isset($_POST['summary_access']) ? sanitize_text_field($_POST['summary_access']) : '';
        
        if (isset($_POST['first_name'])) {
            $wizard_data['first_name'] = sanitize_text_field($_POST['first_name']);
        }
        if (isset($_POST['last_name'])) {
            $wizard_data['last_name'] = sanitize_text_field($_POST['last_name']);
        }
        if (isset($_POST['email_address'])) {
            $wizard_data['email'] = sanitize_email($_POST['email_address']);
        }
        if (isset($_POST['mobile_number'])) {
            $wizard_data['phone'] = sanitize_text_field($_POST['mobile_number']);
        }
        
        // Installation Type
        if (isset($_POST['installation_type'])) {
            $install_value = $_POST['installation_type'];
            $install_map = array(
                'collection' => 'Supply Only - Collection',
                'delivery' => 'Supply Only - Delivery',
                'prepared_opening' => 'Installed into Prepared Opening',
                'remove_existing' => 'Remove Existing Doors & Install'
            );
            $wizard_data['installation_type'] = isset($install_map[$install_value]) ? $install_map[$install_value] : $install_value;
            $wizard_data['installation_type_value'] = $install_value;
        }
        
        $wizard_data['unique_id'] = uniqid('door_', true);
        $wizard_data['timestamp'] = time();
        
        $unique_hash = md5( serialize( $wizard_data ) . time() . rand(1000, 9999) );
        
        $cart_item_data = [
            'wizard_data'  => $wizard_data,
            'custom_price' => $final_price,
            'unique_key'   => $unique_hash
        ];

        if ($variation_id === 0) {
            $product = wc_get_product($product_id);
            if ($product && $product->is_type('variable')) {
                $available_variations = $product->get_available_variations();
                if (!empty($available_variations)) {
                    $variation_id = $available_variations[0]['variation_id'];
                }
            }
        }

        $added = WC()->cart->add_to_cart( 
            $product_id, 1, $variation_id, [], $cart_item_data
        );

        if ( $added ) {
            $cart_count = WC()->cart->get_cart_contents_count();
            
            if ( $is_checkout ) {
                wc_add_notice( 'Custom door added. Proceeding to checkout.', 'success' );
                wp_safe_redirect( wc_get_checkout_url() );
            } else {
                wc_add_notice( sprintf( 'Custom door added to cart successfully! Cart now has %d items.', $cart_count ), 'success' );
                wp_safe_redirect( wc_get_cart_url() );
            }
        } else {
            wc_add_notice( 'Failed to add product to cart. Please try again.', 'error' );
            wp_safe_redirect( wc_get_cart_url() );
        }
        exit;
    }
});

/**
 * AJAX handler for builder form submission
 */
add_action( 'wp_ajax_process_door_builder', 'process_door_builder_ajax' );
add_action( 'wp_ajax_nopriv_process_door_builder', 'process_door_builder_ajax' );
function process_door_builder_ajax() {
    
    if ( ! check_ajax_referer( 'door_builder_ajax', 'security', false ) ) {
        wp_send_json_error([ 'message' => 'Security check failed (AJAX nonce).' ]);
    }
    
    parse_str($_POST['form_data'], $form_data);
    
    if ( ! isset( $form_data['builder_nonce'] ) || ! wp_verify_nonce( $form_data['builder_nonce'], 'door_builder_action' ) ) {
        wp_send_json_error([ 'message' => 'Security check failed (Invalid nonce).' ]);
    }
    
    $product_id   = absint( $form_data['product_id'] );
    $variation_id = isset( $form_data['variation_id'] ) ? absint( $form_data['variation_id'] ) : 0;
    $final_price  = isset($form_data['final_price']) ? floatval( $form_data['final_price'] ) : 0;
    
    $edit_mode = isset( $form_data['edit_mode'] ) && $form_data['edit_mode'] == '1';
    $cart_item_key = isset( $form_data['cart_item_key'] ) ? sanitize_text_field( $form_data['cart_item_key'] ) : '';

    $wizard_data = array();
    
    if ( isset( $form_data['width'] ) ) {
        $wizard_data['width'] = intval( $form_data['width'] );
        $wizard_data['height'] = intval( $form_data['height'] );
    }
    
    if ( isset( $form_data['panel_layout'] ) ) {
        $panel_value = $form_data['panel_layout'];
        $panel_map = array(
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
        $wizard_data['panels'] = isset( $panel_map[$panel_value] ) ? $panel_map[$panel_value] : $panel_value;
    }
    
    if ( isset( $form_data['open_direction'] ) ) {
        $wizard_data['opening'] = $form_data['open_direction'] === 'inwards' ? 'Inwards' : 'Outwards';
    }
    
    if ( isset( $form_data['door_colour'] ) ) {
        $colour = $form_data['door_colour'];
        
        if ( $colour === 'custom_ral' && isset( $form_data['custom_colour_select'] ) && !empty($form_data['custom_colour_select']) ) {
            $wizard_data['outside_colour'] = $form_data['custom_colour_select'];
            $wizard_data['outside_colour_price'] = 195;
            $wizard_data['outside_ral'] = str_replace('RAL ', '', $form_data['custom_colour_select']);
        } else {
            $colour_map = array(
                'anthracite_grey' => 'Anthracite Grey',
                'black' => 'Black',
                'white' => 'White'
            );
            $wizard_data['outside_colour'] = isset( $colour_map[$colour] ) ? $colour_map[$colour] : $colour;
            
            $ral_map = array(
                'anthracite_grey' => '7016',
                'black' => '9005',
                'white' => '9016'
            );
            $wizard_data['outside_ral'] = isset( $ral_map[$colour] ) ? $ral_map[$colour] : $colour;
            $wizard_data['outside_colour_price'] = 0;
        }
    }
    
    if ( isset( $form_data['inside_colour'] ) ) {
        $colour = $form_data['inside_colour'];
        $outside_colour = isset( $form_data['door_colour'] ) ? $form_data['door_colour'] : '';
        $custom_outside = isset( $form_data['custom_colour_select'] ) ? $form_data['custom_colour_select'] : '';
        
        $standard_colours = array('anthracite_grey', 'black', 'white');
        
        $is_free_dual = (
            $outside_colour === 'anthracite_grey' && 
            $colour === 'white' && 
            empty($custom_outside) && 
            !isset($form_data['custom_inside_colour_select'])
        );
        
        $is_same_standard = (
            $outside_colour === $colour && 
            in_array($colour, $standard_colours) &&
            empty($custom_outside) && 
            !isset($form_data['custom_inside_colour_select'])
        );
        
        $is_standard_dual = (
            in_array($outside_colour, $standard_colours) &&
            in_array($colour, $standard_colours) &&
            $outside_colour !== $colour &&
            !$is_free_dual && 
            empty($custom_outside) && 
            !isset($form_data['custom_inside_colour_select'])
        );
        
        if ( $colour === 'custom_ral' && isset( $form_data['custom_inside_colour_select'] ) && !empty($form_data['custom_inside_colour_select']) ) {
            $wizard_data['inside_colour'] = $form_data['custom_inside_colour_select'];
            
            if ( $is_free_dual ) {
                $wizard_data['inside_colour_price'] = 0;
            } else {
                $wizard_data['inside_colour_price'] = 195;
            }
            
            $wizard_data['inside_ral'] = str_replace('RAL ', '', $form_data['custom_inside_colour_select']);
        } else {
            $colour_map = array(
                'anthracite_grey' => 'Anthracite Grey',
                'black' => 'Black',
                'white' => 'White'
            );
            $wizard_data['inside_colour'] = isset( $colour_map[$colour] ) ? $colour_map[$colour] : $colour;
            
            $ral_map = array(
                'anthracite_grey' => '7016',
                'black' => '9005',
                'white' => '9016'
            );
            $wizard_data['inside_ral'] = isset( $ral_map[$colour] ) ? $ral_map[$colour] : $colour;
            
            if ( $is_free_dual || $is_same_standard ) {
                $wizard_data['inside_colour_price'] = 0;
            } elseif ( $is_standard_dual ) {
                $wizard_data['inside_colour_price'] = 195;
            } else {
                $wizard_data['inside_colour_price'] = 0;
            }
        }
    }
    
    if ( isset( $form_data['handle_colour'] ) ) {
        $handle = $form_data['handle_colour'];
        $handle_map = array(
            'white' => 'White',
            'chrome' => 'Chrome',
            'black' => 'Black',
            'black_white' => 'Black and White'
        );
        $wizard_data['handle'] = isset( $handle_map[$handle] ) ? $handle_map[$handle] : $handle;
    }
    
    if ( isset( $form_data['glass_upgrade'] ) ) {
        $glass = $form_data['glass_upgrade'];
        
        if ($glass === 'no_thanks') {
            $wizard_data['glass'] = 'no_thanks';
        } else {
            $glass_map = array(
                'self_cleaning' => 'Self-cleaning glass',
                'integral_blinds' => 'Integral blinds',
                'obscure_glass' => 'Obscure glass',
                'saint_gobain_12' => 'Saint-Gobain Planitherm 1.2'
            );
            $wizard_data['glass'] = isset( $glass_map[$glass] ) ? $glass_map[$glass] : $glass;
        }
    }
    
    if ( isset( $form_data['trickle_vents'] ) ) {
        $wizard_data['vents'] = $form_data['trickle_vents'] === 'yes_trickle' ? 'With Vents' : 'No Vents';
    }
    
    if ( isset( $form_data['cill'] ) ) {
        $wizard_data['cill'] = $form_data['cill'] === 'none' ? 'No Cill' : $form_data['cill'];
    }
    
    if ( isset( $form_data['installation_type'] ) ) {
        $install_value = $form_data['installation_type'];
        
        $install_map = array(
            'collection' => 'Supply Only - Collection',
            'delivery' => 'Supply Only - Delivery',
            'prepared_opening' => 'Installed into Prepared Opening',
            'remove_existing' => 'Remove Existing Doors & Install'
        );
        
        $wizard_data['installation_type'] = isset( $install_map[$install_value] ) ? $install_map[$install_value] : $install_value;
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
    
    if ( isset( $form_data['postcode'] ) ) {
        $wizard_data['postcode'] = sanitize_text_field( $form_data['postcode'] );
    }
    
    if ( isset( $form_data['delivery_price'] ) ) {
        $wizard_data['delivery_price'] = floatval( $form_data['delivery_price'] );
    }
    if ( isset( $form_data['delivery_zone'] ) ) {
        $wizard_data['delivery_zone'] = sanitize_text_field( $form_data['delivery_zone'] );
    }
    if ( isset( $form_data['delivery_distance'] ) ) {
        $wizard_data['delivery_distance'] = floatval( $form_data['delivery_distance'] );
    }
    if ( isset( $form_data['delivery_bespoke'] ) ) {
        $wizard_data['delivery_bespoke'] = sanitize_text_field( $form_data['delivery_bespoke'] );
    }
    
    if ( isset( $form_data['access_issues'] ) ) {
        if ( $form_data['access_issues'] === 'yes_access' ) {
            $access_desc = isset( $form_data['access_description'] ) && !empty( $form_data['access_description'] ) 
                ? sanitize_text_field( $form_data['access_description'] ) 
                : 'Yes';
            $wizard_data['access'] = $access_desc;
        } else {
            $wizard_data['access'] = 'No';
        }
    }
    
    if ( isset( $form_data['first_name'] ) ) {
        $wizard_data['first_name'] = sanitize_text_field( $form_data['first_name'] );
    }
    if ( isset( $form_data['last_name'] ) ) {
        $wizard_data['last_name'] = sanitize_text_field( $form_data['last_name'] );
    }
    if ( isset( $form_data['email_address'] ) ) {
        $wizard_data['email'] = sanitize_email( $form_data['email_address'] );
    }
    if ( isset( $form_data['mobile_number'] ) ) {
        $wizard_data['phone'] = sanitize_text_field( $form_data['mobile_number'] );
    }
    
    if ( isset( $_FILES['door_photo'] ) && !empty( $_FILES['door_photo']['name'] ) ) {
        $uploaded_file = $_FILES['door_photo'];
        $wizard_data['door_photo'] = sanitize_file_name( $uploaded_file['name'] );
    }
    
    $wizard_data['unique_id'] = uniqid('door_', true);
    $wizard_data['timestamp'] = time();
    
    $unique_hash = md5( serialize( $wizard_data ) . time() . rand(1000, 9999) );
    
    $cart_item_data = [
        'wizard_data'  => $wizard_data,
        'custom_price' => $final_price,
        'unique_key'   => $unique_hash
    ];

    if ($variation_id === 0) {
        $product = wc_get_product($product_id);
        if ($product && $product->is_type('variable')) {
            $available_variations = $product->get_available_variations();
            if (!empty($available_variations)) {
                $variation_id = $available_variations[0]['variation_id'];
            }
        }
    }

    if ( $edit_mode && !empty( $cart_item_key ) ) {
        $cart = WC()->cart->get_cart();
        
        if ( isset( $cart[$cart_item_key] ) ) {
            $cart_item = $cart[$cart_item_key];
            
            WC()->cart->remove_cart_item($cart_item_key);
            
            WC()->cart->add_to_cart(
                $cart_item['product_id'],
                $cart_item['quantity'],
                $cart_item['variation_id'],
                $cart_item['variation'],
                $cart_item_data
            );
            
            wp_send_json_success([
                'message' => 'Cart updated successfully!',
                'cart_url' => wc_get_cart_url(),
                'is_checkout' => false
            ]);
        } else {
            wp_send_json_error([ 'message' => 'Cart item not found.' ]);
        }
    } else {
        $added = WC()->cart->add_to_cart( $product_id, 1, $variation_id, [], $cart_item_data );

        if ( $added ) {
            wp_send_json_success([
                'message' => 'Added to cart successfully!',
                'cart_url' => wc_get_cart_url(),
                'is_checkout' => false
            ]);
        } else {
            wp_send_json_error([ 'message' => 'Failed to add product to cart.' ]);
        }
    }
}

/**
 * Apply custom price in cart
 */
add_action( 'woocommerce_before_calculate_totals', 'apply_custom_price_to_cart', 9999, 1 );
function apply_custom_price_to_cart( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
        return;
    }

    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 ) {
        return;
    }

    foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
        if ( isset( $cart_item['custom_price'] ) && $cart_item['custom_price'] > 0 ) {
            $cart_item['data']->set_price( $cart_item['custom_price'] );
        }
    }
}

/**
 * Add delivery charge to cart
 */
add_action('woocommerce_before_calculate_totals', 'add_delivery_charge_to_cart', 20, 1);
function add_delivery_charge_to_cart($cart) {
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
    
    foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
        if (isset($cart_item['wizard_data']['postcode']) && !empty($cart_item['wizard_data']['postcode'])) {
            $has_door_builder = true;
            
            if (isset($cart_item['wizard_data']['delivery_price'])) {
                $delivery_price = floatval($cart_item['wizard_data']['delivery_price']);
                $delivery_zone = isset($cart_item['wizard_data']['delivery_zone']) ? $cart_item['wizard_data']['delivery_zone'] : '';
                $delivery_distance = isset($cart_item['wizard_data']['delivery_distance']) ? floatval($cart_item['wizard_data']['delivery_distance']) : 0;
                $is_bespoke = isset($cart_item['wizard_data']['delivery_bespoke']) && $cart_item['wizard_data']['delivery_bespoke'] === '1';
            } else {
                $postcode = $cart_item['wizard_data']['postcode'];
                $calculator = new Door_Delivery_Calculator();
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
    
    WC()->session->set('door_delivery_data', [
        'price' => $delivery_price,
        'zone' => $delivery_zone,
        'distance' => $delivery_distance,
        'bespoke' => $is_bespoke
    ]);
    
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
 * Block checkout for bespoke delivery
 */
add_action('woocommerce_checkout_process', 'block_checkout_for_bespoke_delivery');
function block_checkout_for_bespoke_delivery() {
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
 * Save wizard data to order items
 */
add_action( 'woocommerce_checkout_create_order_line_item', function( $item, $cart_item_key, $values ) {
    if ( ! empty( $values['wizard_data'] ) ) {
        foreach ( $values['wizard_data'] as $key => $value ) {
            if ($key === 'glass') {
                if ($value === 'no_thanks') {
                    $item->add_meta_data( 'builder_glass', 'No Thanks - Standard Glass', true );
                } else {
                    $item->add_meta_data( 'builder_glass', $value, true );
                }
            } 
            elseif ($key === 'outside_colour_price' || $key === 'inside_colour_price' || $key === 'installation_price') {
                $item->add_meta_data( 'builder_' . $key, $value, true );
            }
            elseif ($key === 'installation_type_value') {
                $item->add_meta_data( 'builder_installation_value', $value, true );
            }
            else {
                $item->add_meta_data( 'builder_' . $key, $value, true );
            }
        }
    }
    
    if ( isset( $values['custom_price'] ) ) {
        $item->add_meta_data( '_custom_price', $values['custom_price'], true );
        $item->add_meta_data( '_line_total', $values['custom_price'] );
        $item->add_meta_data( '_line_subtotal', $values['custom_price'] );
    }
}, 10, 3 );

/**
 * Display builder data in cart with edit button
 */
add_action('woocommerce_after_cart_item_name', 'display_builder_data_with_edit_button', 10, 2);
function display_builder_data_with_edit_button($cart_item, $cart_item_key) {
    
    if (!isset($cart_item['wizard_data']) || empty($cart_item['wizard_data'])) {
        return;
    }
    
    $wizard = $cart_item['wizard_data'];
    $base_url = home_url('/bifold-door-builder/');
    
    $edit_url = add_query_arg(array(
        'edit_cart_item' => $cart_item_key,
        'product_id' => $cart_item['product_id'],
        'variation_id' => $cart_item['variation_id']
    ), $base_url);
    
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
        $glass_display = $wizard['glass'];
        if ($glass_display === 'no_thanks') {
            $glass_display = 'Standard Glass';
        }
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
 * Add custom CSS for cart page
 */
add_action('wp_head', function() {
    if (is_cart()) {
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
});

/**
 * Handle cart item update
 */
add_action('template_redirect', 'handle_cart_item_update');
function handle_cart_item_update() {
    if (isset($_POST['edit_mode']) && $_POST['edit_mode'] == '1' && isset($_POST['cart_item_key'])) {
        
        $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
        $cart = WC()->cart->get_cart();
        
        if (isset($cart[$cart_item_key])) {
            
            $cart_item = $cart[$cart_item_key];
            
            parse_str($_POST['form_data'], $form_data);
            
            $wizard_data = array();
            
            $wizard_data['width'] = isset($form_data['width']) ? intval($form_data['width']) : 0;
            $wizard_data['height'] = isset($form_data['height']) ? intval($form_data['height']) : 0;
            $wizard_data['panels'] = isset($form_data['panel_layout']) ? $form_data['panel_layout'] : '';
            $wizard_data['opening'] = isset($form_data['open_direction']) ? ($form_data['open_direction'] === 'inwards' ? 'Inwards' : 'Outwards') : '';
            $wizard_data['outside_colour'] = isset($form_data['door_colour']) ? $form_data['door_colour'] : '';
            $wizard_data['inside_colour'] = isset($form_data['inside_colour']) ? $form_data['inside_colour'] : '';
            $wizard_data['handle'] = isset($form_data['handle_colour']) ? $form_data['handle_colour'] : '';
            
            if (isset($form_data['glass_upgrade'])) {
                $glass = $form_data['glass_upgrade'];
                if ($glass === 'no_thanks') {
                    $wizard_data['glass'] = 'no_thanks';
                } else {
                    $wizard_data['glass'] = $glass;
                }
            }
            
            $wizard_data['vents'] = isset($form_data['trickle_vents']) ? ($form_data['trickle_vents'] === 'yes_trickle' ? 'With Vents' : 'No Vents') : '';
            $wizard_data['cill'] = isset($form_data['cill']) ? $form_data['cill'] : '';
            
            $wizard_data['postcode'] = isset($form_data['postcode']) ? $form_data['postcode'] : '';
            $wizard_data['delivery_price'] = isset($form_data['delivery_price']) ? floatval($form_data['delivery_price']) : 0;
            $wizard_data['delivery_zone'] = isset($form_data['delivery_zone']) ? $form_data['delivery_zone'] : '';
            $wizard_data['delivery_distance'] = isset($form_data['delivery_distance']) ? floatval($form_data['delivery_distance']) : 0;
            $wizard_data['delivery_bespoke'] = isset($form_data['delivery_bespoke']) ? $form_data['delivery_bespoke'] : '0';
            
            $wizard_data['access'] = isset($form_data['access_issues']) ? ($form_data['access_issues'] === 'yes_access' ? 'Yes' : 'No') : '';
            $wizard_data['first_name'] = isset($form_data['first_name']) ? $form_data['first_name'] : '';
            $wizard_data['last_name'] = isset($form_data['last_name']) ? $form_data['last_name'] : '';
            $wizard_data['email'] = isset($form_data['email_address']) ? $form_data['email_address'] : '';
            $wizard_data['phone'] = isset($form_data['mobile_number']) ? $form_data['mobile_number'] : '';
            
            if (isset($form_data['installation_type'])) {
                $install_value = $form_data['installation_type'];
                $install_map = array(
                    'collection' => 'Supply Only - Collection',
                    'delivery' => 'Supply Only - Delivery',
                    'prepared_opening' => 'Installed into Prepared Opening',
                    'remove_existing' => 'Remove Existing Doors & Install'
                );
                $wizard_data['installation_type'] = isset($install_map[$install_value]) ? $install_map[$install_value] : $install_value;
                $wizard_data['installation_type_value'] = $install_value;
            }
            
            $wizard_data['unique_id'] = uniqid('door_', true);
            $wizard_data['timestamp'] = time();
            
            WC()->cart->remove_cart_item($cart_item_key);
            
            WC()->cart->add_to_cart(
                $cart_item['product_id'],
                $cart_item['quantity'],
                $cart_item['variation_id'],
                $cart_item['variation'],
                array(
                    'wizard_data' => $wizard_data,
                    'custom_price' => $form_data['final_price'],
                    'unique_key' => md5(serialize($wizard_data) . time())
                )
            );
            
            wp_redirect(wc_get_cart_url());
            exit;
        }
    }
}

/**
 * Display builder data in checkout
 */
add_filter('woocommerce_checkout_cart_item_quantity', 'display_builder_data_checkout', 10, 3);
function display_builder_data_checkout($quantity_html, $cart_item, $cart_item_key) {
    
    if (!isset($cart_item['wizard_data']) || empty($cart_item['wizard_data'])) {
        return $quantity_html;
    }
    
    $wizard = $cart_item['wizard_data'];
    
    $details_html = '<div class="checkout-door-details">';
    
    if (!empty($wizard['width']) && !empty($wizard['height'])) {
        $details_html .= '<div class="detail-row">';
        $details_html .= '<span class="detail-label-co">Manufacturing Size: </span>';
        $details_html .= '<span class="detail-value-co">' . esc_html($wizard['width'] . ' x ' . $wizard['height'] . ' mm') . '</span>';
        $details_html .= '</div>';
    }
    
    if (!empty($wizard['panels'])) {
        $details_html .= '<div class="detail-row">';
        $details_html .= '<span class="detail-label-co">Panels: </span>';
        $details_html .= '<span class="detail-value-co">' . esc_html($wizard['panels']) . '</span>';
        $details_html .= '</div>';
    }
    
    if (!empty($wizard['opening'])) {
        $details_html .= '<div class="detail-row">';
        $details_html .= '<span class="detail-label-co">Opening Direction: </span>';
        $details_html .= '<span class="detail-value-co">' . esc_html($wizard['opening']) . '</span>';
        $details_html .= '</div>';
    }
    
    if (!empty($wizard['outside_colour'])) {
        $outside = $wizard['outside_colour'];
        if (!empty($wizard['outside_ral'])) {
            $outside .= ' (' . $wizard['outside_ral'] . ')';
        }
        $details_html .= '<div class="detail-row">';
        $details_html .= '<span class="detail-label-co">Outside Colour: </span>';
        $details_html .= '<span class="detail-value-co">' . esc_html($outside) . '</span>';
        $details_html .= '</div>';
    }
    
    if (!empty($wizard['inside_colour'])) {
        $inside = $wizard['inside_colour'];
        if (!empty($wizard['inside_ral'])) {
            $inside .= ' (' . $wizard['inside_ral'] . ')';
        }
        $details_html .= '<div class="detail-row">';
        $details_html .= '<span class="detail-label-co">Inside Colour: </span>';
        $details_html .= '<span class="detail-value-co">' . esc_html($inside) . '</span>';
        $details_html .= '</div>';
    }
    
    if (!empty($wizard['handle'])) {
        $details_html .= '<div class="detail-row">';
        $details_html .= '<span class="detail-label-co">Handle Colour: </span>';
        $details_html .= '<span class="detail-value-co">' . esc_html($wizard['handle']) . '</span>';
        $details_html .= '</div>';
    }
    
    if (!empty($wizard['glass'])) {
        $glass_display = $wizard['glass'];
        if ($glass_display === 'no_thanks') {
            $glass_display = 'Standard Glass';
        }
        $details_html .= '<div class="detail-row">';
        $details_html .= '<span class="detail-label-co">Glass: </span>';
        $details_html .= '<span class="detail-value-co">' . esc_html($glass_display) . '</span>';
        $details_html .= '</div>';
    }
    
    if (isset($wizard['vents'])) {
        $details_html .= '<div class="detail-row">';
        $details_html .= '<span class="detail-label-co">Trickle Vents: </span>';
        $details_html .= '<span class="detail-value-co">' . esc_html($wizard['vents']) . '</span>';
        $details_html .= '</div>';
    }
    
    if (!empty($wizard['cill'])) {
        $details_html .= '<div class="detail-row">';
        $details_html .= '<span class="detail-label-co">Cill: </span>';
        $details_html .= '<span class="detail-value-co">' . esc_html($wizard['cill']) . '</span>';
        $details_html .= '</div>';
    }
    
    if (!empty($wizard['installation_type'])) {
        $details_html .= '<div class="detail-row">';
        $details_html .= '<span class="detail-label-co">Installation: </span>';
        $details_html .= '<span class="detail-value-co">' . esc_html($wizard['installation_type']) . '</span>';
        $details_html .= '</div>';
    }
    
    if (!empty($wizard['postcode'])) {
        $details_html .= '<div class="detail-row">';
        $details_html .= '<span class="detail-label-co">Postcode: </span>';
        $details_html .= '<span class="detail-value-co">' . esc_html($wizard['postcode']) . '</span>';
        $details_html .= '</div>';
    }
    
    if (!empty($wizard['access'])) {
        $details_html .= '<div class="detail-row">';
        $details_html .= '<span class="detail-label-co">Access Issues: </span>';
        $details_html .= '<span class="detail-value-co">' . esc_html($wizard['access']) . '</span>';
        $details_html .= '</div>';
    }
    
    $details_html .= '</div>';
    
    return $quantity_html . $details_html;
}

/**
 * Display builder data in order details
 */
add_action('woocommerce_order_item_meta_end', 'display_builder_data_order_details', 10, 4);
function display_builder_data_order_details($item_id, $item, $order, $plain_text) {
    
    $wizard_data = array();
    
    $meta_data = $item->get_meta_data();
    
    foreach ($meta_data as $meta) {
        if (strpos($meta->key, 'builder_') === 0) {
            $key = str_replace('builder_', '', $meta->key);
            $wizard_data[$key] = $meta->value;
        }
    }
    
    if (empty($wizard_data)) {
        return;
    }
    
    echo '<div class="order-door-details">';
    echo '<strong class="order-door-title">Door Configuration:</strong>';
    
    if (!empty($wizard_data['width']) && !empty($wizard_data['height'])) {
        echo '<div class="order-door-row">';
        echo '<span class="order-door-label">Manufacturing Size:</span>';
        echo '<span class="order-door-value">' . esc_html($wizard_data['width'] . ' x ' . $wizard_data['height'] . ' mm') . '</span>';
        echo '</div>';
    }
    
    if (!empty($wizard_data['panels'])) {
        echo '<div class="order-door-row">';
        echo '<span class="order-door-label">Panels:</span>';
        echo '<span class="order-door-value">' . esc_html($wizard_data['panels']) . '</span>';
        echo '</div>';
    }
    
    if (!empty($wizard_data['opening'])) {
        echo '<div class="order-door-row">';
        echo '<span class="order-door-label">Opening Direction:</span>';
        echo '<span class="order-door-value">' . esc_html($wizard_data['opening']) . '</span>';
        echo '</div>';
    }
    
    if (!empty($wizard_data['outside_colour'])) {
        $outside = $wizard_data['outside_colour'];
        if (!empty($wizard_data['outside_ral'])) {
            $outside .= ' (' . $wizard_data['outside_ral'] . ')';
        }
        echo '<div class="order-door-row">';
        echo '<span class="order-door-label">Outside Colour:</span>';
        echo '<span class="order-door-value">' . esc_html($outside) . '</span>';
        echo '</div>';
    }
    
    if (!empty($wizard_data['inside_colour'])) {
        $inside = $wizard_data['inside_colour'];
        if (!empty($wizard_data['inside_ral'])) {
            $inside .= ' (' . $wizard_data['inside_ral'] . ')';
        }
        echo '<div class="order-door-row">';
        echo '<span class="order-door-label">Inside Colour:</span>';
        echo '<span class="order-door-value">' . esc_html($inside) . '</span>';
        echo '</div>';
    }
    
    if (!empty($wizard_data['handle'])) {
        echo '<div class="order-door-row">';
        echo '<span class="order-door-label">Handle Colour:</span>';
        echo '<span class="order-door-value">' . esc_html($wizard_data['handle']) . '</span>';
        echo '</div>';
    }
    
    if (!empty($wizard_data['glass'])) {
        $glass_display = $wizard_data['glass'];
        if ($glass_display === 'no_thanks') {
            $glass_display = 'Standard Glass';
        }
        echo '<div class="order-door-row">';
        echo '<span class="order-door-label">Glass:</span>';
        echo '<span class="order-door-value">' . esc_html($glass_display) . '</span>';
        echo '</div>';
    }
    
    if (isset($wizard_data['vents'])) {
        echo '<div class="order-door-row">';
        echo '<span class="order-door-label">Trickle Vents:</span>';
        echo '<span class="order-door-value">' . esc_html($wizard_data['vents']) . '</span>';
        echo '</div>';
    }
    
    if (!empty($wizard_data['cill'])) {
        echo '<div class="order-door-row">';
        echo '<span class="order-door-label">Cill:</span>';
        echo '<span class="order-door-value">' . esc_html($wizard_data['cill']) . '</span>';
        echo '</div>';
    }
    
    if (!empty($wizard_data['installation_type'])) {
        echo '<div class="order-door-row">';
        echo '<span class="order-door-label">Installation:</span>';
        echo '<span class="order-door-value">' . esc_html($wizard_data['installation_type']) . '</span>';
        echo '</div>';
    }
    
    if (!empty($wizard_data['postcode'])) {
        echo '<div class="order-door-row">';
        echo '<span class="order-door-label">Postcode:</span>';
        echo '<span class="order-door-value">' . esc_html($wizard_data['postcode']) . '</span>';
        echo '</div>';
    }
    
    if (!empty($wizard_data['access'])) {
        echo '<div class="order-door-row">';
        echo '<span class="order-door-label">Access Issues:</span>';
        echo '<span class="order-door-value">' . esc_html($wizard_data['access']) . '</span>';
        echo '</div>';
    }
    
    echo '</div>';
}

/**
 * AJAX endpoint for real-time delivery calculation
 */
add_action('wp_ajax_check_delivery', 'ajax_check_delivery');
add_action('wp_ajax_nopriv_check_delivery', 'ajax_check_delivery');
function ajax_check_delivery() {
    $postcode = sanitize_text_field($_POST['postcode']);
    
    if (empty($postcode)) {
        wp_send_json_error(['message' => 'Postcode required']);
    }
    
    $calculator = new Door_Delivery_Calculator();
    $result = $calculator->calculate_delivery($postcode);
    
    wp_send_json_success($result);
}

/**
 * Create Bifold Door Builder page on theme activation
 */
register_activation_hook( __FILE__, 'create_bifold_door_builder_page' );
function create_bifold_door_builder_page() {
    $page_exists = get_page_by_path( 'bifold-door-builder' );
    
    if ( ! $page_exists ) {
        $page_data = array(
            'post_title'    => 'Bifold Door Builder',
            'post_name'     => 'bifold-door-builder',
            'post_content'  => '<!-- This page uses custom template -->',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_author'   => 1,
            'page_template' => 'page-bifold-door-builder.php'
        );
        
        wp_insert_post( $page_data );
    }
}

/**
 * Add nonce field for security
 */
add_action( 'wp_head', function() {
    if ( is_page( 'bifold-door-builder' ) ) {
        wp_nonce_field( 'door_builder_action', 'builder_nonce' );
    }
} );

/**
 * Hide Astra scroll to top arrow on builder page
 */
add_action( 'wp_head', 'hide_astra_scroll_top' );
function hide_astra_scroll_top() {
    if ( is_page( 'bifold-door-builder' ) ) {
        ?>
        <style>
            #ast-scroll-top {
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
add_filter( 'astra_get_option_scroll-to-top', '__return_false' );
remove_action( 'astra_footer_after', 'astra_scroll_to_top', 1 );

/**
 * Show Technical Specification Image
 */
add_action('woocommerce_single_product_summary', 'show_technical_specification_image', 25);
function show_technical_specification_image() {
    if (!is_product()) {
        return;
    }
    $image = get_field('technical_specification_image');
    if ($image) {
        echo '<div class="technical-specification-image">';
        echo '<img src="' . esc_url($image) . '" alt="Bi-fold door technical specification">';
        echo '</div>';
    }
}

/**
 * Custom CSS for Technical Specification Image
 */
add_action('wp_head', function() {
    if (is_product()) {
        ?>
        <style>
        .technical-specification-image{
            margin-top:25px;
            margin-bottom:25px;
        }
        .technical-specification-image img{
            width:100%;
            height:auto;
            display:block;
            border-radius:6px;
        }
        </style>
        <?php
    }
});

/**
 * Filter to show custom image in cart based on panel selection
 */
add_filter( 'woocommerce_cart_item_thumbnail', 'custom_cart_item_thumbnail_based_on_panel', 10, 3 );
function custom_cart_item_thumbnail_based_on_panel( $thumbnail, $cart_item, $cart_item_key ) {
    
    if ( isset( $cart_item['wizard_data'] ) && isset( $cart_item['wizard_data']['panels'] ) ) {
        
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
        
        $standard_panels = array(
            '2_left', '2_right', '3_left', '3_right', '1_3', '3_1', 
            '4_left', '4_right', '5_left', '5_right', '1_5', '2_4', 
            '3_3', '4_2', '5_1', '6_left', '6_right', 'french'
        );
        
        if ( in_array( $panels, $standard_panels ) ) {
            $panel_value = $panels;
            $panel_value = str_replace( '_', '-', $panel_value );
            
            if ( $panel_value === 'french' ) {
                $image_file = 'French_Doors_500x.webp';
            } elseif ( strpos( $panel_value, '-' ) !== false ) {
                $parts = explode( '-', $panel_value );
                if ( count( $parts ) == 2 ) {
                    $image_file = $parts[0] . '_' . $parts[1] . '_Panel_500x';
                    if ( in_array( $panel_value, array( '1-5', '2-4', '3-3', '4-2', '5-1', '6-left', '6-right' ) ) ) {
                        $image_file .= '.avif';
                    } else {
                        $image_file .= '.webp';
                    }
                } else {
                    $image_file = $parts[0] . '_Panel_' . ucfirst( $parts[1] ) . '_500x.webp';
                }
            } else {
                $image_file = $panel_value . '_Panel_500x.webp';
            }
        } else {
            $image_file = isset( $panel_image_map[$panels] ) ? $panel_image_map[$panels] : '';
        }
        
        if ( !empty( $image_file ) ) {
            $image_url = get_stylesheet_directory_uri() . '/assets/images/bifold-doors/' . $image_file;
            $thumbnail = '<img src="' . esc_url( $image_url ) . '" 
                               alt="' . esc_attr( $panels ) . '" 
                               class="woocommerce-placeholder wp-post-image" 
                               width="300" 
                               height="300" 
                               style="object-fit: contain; background: #f5f5f5; padding: 10px;" />';
        }
    }
    
    return $thumbnail;
}

/**
 * Filter to show custom image in checkout
 */
add_filter( 'woocommerce_checkout_cart_item_thumbnail', 'custom_checkout_item_thumbnail_based_on_panel', 10, 3 );
function custom_checkout_item_thumbnail_based_on_panel( $thumbnail, $cart_item, $cart_item_key ) {
    
    if ( isset( $cart_item['wizard_data'] ) && isset( $cart_item['wizard_data']['panels'] ) ) {
        
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
        
        $standard_panels = array(
            '2_left', '2_right', '3_left', '3_right', '1_3', '3_1', 
            '4_left', '4_right', '5_left', '5_right', '1_5', '2_4', 
            '3_3', '4_2', '5_1', '6_left', '6_right', 'french'
        );
        
        if ( in_array( $panels, $standard_panels ) ) {
            $panel_value = $panels;
            $panel_value = str_replace( '_', '-', $panel_value );
            
            if ( $panel_value === 'french' ) {
                $image_file = 'French_Doors_500x.webp';
            } elseif ( strpos( $panel_value, '-' ) !== false ) {
                $parts = explode( '-', $panel_value );
                if ( count( $parts ) == 2 ) {
                    $image_file = $parts[0] . '_' . $parts[1] . '_Panel_500x';
                    if ( in_array( $panel_value, array( '1-5', '2-4', '3-3', '4-2', '5-1', '6-left', '6-right' ) ) ) {
                        $image_file .= '.avif';
                    } else {
                        $image_file .= '.webp';
                    }
                } else {
                    $image_file = $parts[0] . '_Panel_' . ucfirst( $parts[1] ) . '_500x.webp';
                }
            } else {
                $image_file = $panel_value . '_Panel_500x.webp';
            }
        } else {
            $image_file = isset( $panel_image_map[$panels] ) ? $panel_image_map[$panels] : '';
        }
        
        if ( !empty( $image_file ) ) {
            $image_url = get_stylesheet_directory_uri() . '/assets/images/' . $image_file;
            $thumbnail = '<img src="' . esc_url( $image_url ) . '" 
                               alt="' . esc_attr( $panels ) . '" 
                               width="50" 
                               height="50" 
                               style="object-fit: contain; background: #f5f5f5; padding: 3px; border-radius: 4px;" />';
        }
    }
    
    return $thumbnail;
}

/**
 * Display custom image in order details
 */
add_action( 'woocommerce_order_item_meta_end', 'display_custom_image_in_order_details', 10, 4 );
function display_custom_image_in_order_details( $item_id, $item, $order, $plain_text ) {
    
    $panels = $item->get_meta( 'builder_panels' );
    
    if ( !empty( $panels ) && !$plain_text ) {
        
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
        
        $image_file = isset( $panel_image_map[$panels] ) ? $panel_image_map[$panels] : '';
        
        if ( !empty( $image_file ) ) {
            $image_url = get_stylesheet_directory_uri() . '/assets/images/' . $image_file;
            echo '<div style="margin-top: 10px;">';
            echo '<img src="' . esc_url( $image_url ) . '" 
                       alt="' . esc_attr( $panels ) . '" 
                       style="max-width: 100px; height: auto; border: 1px solid #ddd; border-radius: 4px; padding: 5px; background: #f9f9f9;" />';
            echo '</div>';
        }
    }
}

/**
 * ============================================================
 * ADDITIONAL CODE FOR COMPLETE FUNCTIONALITY
 * ============================================================
 */

/**
 * 1. STEP 11 INSTALLATION TYPE - COMPLETE DATA STORAGE WITH PRICE
 */
add_filter( 'woocommerce_add_cart_item_data', function( $cart_item_data, $product_id, $variation_id ) {
    if ( isset( $_POST['form_data'] ) ) {
        parse_str( $_POST['form_data'], $form_data );
    } else {
        $form_data = $_POST;
    }
    
    if ( isset( $form_data['installation_type'] ) && !isset( $cart_item_data['wizard_data']['installation_type'] ) ) {
        $install_value = $form_data['installation_type'];
        
        $install_map = array(
            'collection' => 'Supply Only - Collection',
            'delivery' => 'Supply Only - Delivery',
            'prepared_opening' => 'Installed into Prepared Opening',
            'remove_existing' => 'Remove Existing Doors & Install'
        );
        
        $cart_item_data['wizard_data']['installation_type'] = isset( $install_map[$install_value] ) ? $install_map[$install_value] : $install_value;
        $cart_item_data['wizard_data']['installation_type_value'] = $install_value;
        
        // Calculate installation price
        $pane_count = 1;
        if ( isset( $cart_item_data['wizard_data']['panels'] ) ) {
            $pane_count = get_pane_count_from_panel_value( $cart_item_data['wizard_data']['panels'] );
        }
        
        if ($install_value === 'prepared_opening') {
            $cart_item_data['wizard_data']['installation_price'] = $pane_count * 200;
        } elseif ($install_value === 'remove_existing') {
            $cart_item_data['wizard_data']['installation_price'] = ($pane_count * 200) + 550;
        } elseif ($install_value === 'delivery') {
            $cart_item_data['wizard_data']['installation_price'] = isset($form_data['delivery_price']) ? floatval($form_data['delivery_price']) : 0;
        } else {
            $cart_item_data['wizard_data']['installation_price'] = 0;
        }
    }
    
    return $cart_item_data;
}, 20, 3 );

/**
 * 2. DOOR PHOTO UPLOAD HANDLING WITH MEDIA LIBRARY SUPPORT
 */
add_action( 'wp_ajax_upload_door_photo', 'handle_door_photo_upload' );
add_action( 'wp_ajax_nopriv_upload_door_photo', 'handle_door_photo_upload' );
function handle_door_photo_upload() {
    if ( ! check_ajax_referer( 'door_builder_ajax', 'security', false ) ) {
        wp_send_json_error( 'Security check failed' );
    }
    
    if ( isset( $_FILES['door_photo'] ) && !empty( $_FILES['door_photo']['name'] ) ) {
        $uploaded_file = $_FILES['door_photo'];
        
        $upload_dir = wp_upload_dir();
        $filename = sanitize_file_name( time() . '_' . $uploaded_file['name'] );
        $filepath = $upload_dir['path'] . '/' . $filename;
        
        if ( move_uploaded_file( $uploaded_file['tmp_name'], $filepath ) ) {
            $attachment = array(
                'post_mime_type' => $uploaded_file['type'],
                'post_title'     => sanitize_file_name( $filename ),
                'post_content'   => '',
                'post_status'    => 'inherit'
            );
            
            $attach_id = wp_insert_attachment( $attachment, $filepath );
            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            $attach_data = wp_generate_attachment_metadata( $attach_id, $filepath );
            wp_update_attachment_metadata( $attach_id, $attach_data );
            
            wp_send_json_success( array(
                'id' => $attach_id,
                'url' => wp_get_attachment_url( $attach_id ),
                'filename' => $filename
            ));
        } else {
            wp_send_json_error( 'Failed to upload file' );
        }
    } else {
        wp_send_json_error( 'No file uploaded' );
    }
}

/**
 * 3. VALIDATE INSTALLATION DATA BEFORE CHECKOUT
 */
add_action('woocommerce_checkout_process', 'validate_installation_data_before_checkout');
function validate_installation_data_before_checkout() {
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        if ( isset( $cart_item['wizard_data']['installation_type_value'] ) ) {
            $install_type = $cart_item['wizard_data']['installation_type_value'];
            
            if ( $install_type === 'delivery' ) {
                if ( !isset( $cart_item['wizard_data']['delivery_price'] ) || !isset( $cart_item['wizard_data']['delivery_zone'] ) ) {
                    wc_add_notice( 
                        'Delivery information is incomplete. Please remove the item and reconfigure your door.',
                        'error' 
                    );
                }
            }
            
            if ( $install_type === 'remove_existing' ) {
                if ( !isset( $cart_item['wizard_data']['door_photo'] ) && !isset( $cart_item['wizard_data']['door_photo_id'] ) ) {
                    wc_add_notice( 
                        'Photo of existing door is required for Remove & Install option. Please reconfigure your door.',
                        'error' 
                    );
                }
            }
        }
    }
}

/**
 * 4. DISPLAY INSTALLATION PRICE IN CART WITH FORMATTING
 */
add_filter('woocommerce_get_item_data', 'display_installation_price_in_cart', 10, 2);
function display_installation_price_in_cart( $item_data, $cart_item ) {
    if ( isset( $cart_item['wizard_data']['installation_type'] ) && isset( $cart_item['wizard_data']['installation_price'] ) ) {
        $price = floatval( $cart_item['wizard_data']['installation_price'] );
        if ( $price > 0 ) {
            $item_data[] = array(
                'name' => 'Installation Price',
                'value' => '£' . number_format( $price, 2 ) . ' (inc. VAT)',
                'display' => ''
            );
        }
    }
    return $item_data;
}

/**
 * 5. ADMIN ORDER INSTALLATION COLUMN
 */
add_action('woocommerce_admin_order_item_headers', 'add_installation_admin_column_header');
function add_installation_admin_column_header( $order ) {
    echo '<th class="item-installation">Installation</th>';
}

add_action('woocommerce_admin_order_item_values', 'add_installation_admin_column_value', 10, 3);
function add_installation_admin_column_value( $product, $item, $item_id ) {
    if ( !$product ) return;
    
    $installation = $item->get_meta( 'builder_installation_type' );
    $installation_price = $item->get_meta( 'builder_installation_price' );
    
    echo '<td class="item-installation">';
    if ( $installation ) {
        echo '<strong>' . esc_html( $installation ) . '</strong>';
        if ( $installation_price && $installation_price > 0 ) {
            echo '<br><small>+£' . number_format( $installation_price, 2 ) . '</small>';
        }
    } else {
        echo '—';
    }
    echo '</td>';
}

/**
 * 6. EMAIL ORDER INSTALLATION DETAILS
 */
add_action('woocommerce_email_after_order_table', 'add_installation_details_to_emails', 10, 4);
function add_installation_details_to_emails( $order, $sent_to_admin, $plain_text, $email ) {
    $has_installation = false;
    
    foreach ( $order->get_items() as $item_id => $item ) {
        $installation = $item->get_meta( 'builder_installation_type' );
        if ( $installation ) {
            $has_installation = true;
            break;
        }
    }
    
    if ( !$has_installation ) return;
    
    if ( $plain_text ) {
        echo "\n========== INSTALLATION DETAILS ==========\n";
        foreach ( $order->get_items() as $item_id => $item ) {
            $installation = $item->get_meta( 'builder_installation_type' );
            $installation_price = $item->get_meta( 'builder_installation_price' );
            
            if ( $installation ) {
                echo $item->get_name() . ":\n";
                echo "Installation: " . $installation . "\n";
                if ( $installation_price && $installation_price > 0 ) {
                    echo "Installation Price: £" . number_format( $installation_price, 2 ) . "\n";
                }
                echo "\n";
            }
        }
    } else {
        echo '<h3>Installation Details</h3>';
        echo '<table style="width: 100%; border-collapse: collapse;">';
        echo '<thead><tr><th>Product</th><th>Installation</th><th>Price</th></tr></thead>';
        echo '<tbody>';
        
        foreach ( $order->get_items() as $item_id => $item ) {
            $installation = $item->get_meta( 'builder_installation_type' );
            $installation_price = $item->get_meta( 'builder_installation_price' );
            
            if ( $installation ) {
                echo '<tr>';
                echo '<td>' . $item->get_name() . '</td>';
                echo '<td>' . esc_html( $installation ) . '</td>';
                echo '<td>' . ( $installation_price ? '£' . number_format( $installation_price, 2 ) : '—' ) . '</td>';
                echo '</tr>';
            }
        }
        
        echo '</tbody>';
        echo '</table>';
    }
}

/**
 * 7. REST API INSTALLATION DATA
 */
add_action('rest_api_init', function() {
    register_rest_field( 'shop_order', 'installation_details', array(
        'get_callback' => function( $order_arr ) {
            $order = wc_get_order( $order_arr['id'] );
            $installations = array();
            
            foreach ( $order->get_items() as $item_id => $item ) {
                $installation = $item->get_meta( 'builder_installation_type' );
                $installation_price = $item->get_meta( 'builder_installation_price' );
                $installation_value = $item->get_meta( 'builder_installation_value' );
                
                if ( $installation ) {
                    $installations[] = array(
                        'item_id' => $item_id,
                        'product_name' => $item->get_name(),
                        'installation_type' => $installation,
                        'installation_value' => $installation_value,
                        'installation_price' => $installation_price ? floatval( $installation_price ) : 0
                    );
                }
            }
            
            return $installations;
        },
        'schema' => array(
            'description' => 'Door installation details',
            'type' => 'array'
        ),
    ));
});

/**
 * 8. EXPORT INSTALLATION DATA FOR REPORTS
 */
add_filter( 'woocommerce_order_export_headers', 'add_installation_export_headers' );
function add_installation_export_headers( $headers ) {
    $headers['installation_type'] = 'Installation Type';
    $headers['installation_price'] = 'Installation Price';
    return $headers;
}

add_filter( 'woocommerce_order_export_data', 'add_installation_export_data', 10, 2 );
function add_installation_export_data( $data, $order ) {
    $installation_types = array();
    $installation_prices = array();
    
    foreach ( $order->get_items() as $item_id => $item ) {
        $installation = $item->get_meta( 'builder_installation_type' );
        $installation_price = $item->get_meta( 'builder_installation_price' );
        
        if ( $installation ) {
            $installation_types[] = $installation;
            $installation_prices[] = $installation_price ? '£' . number_format( $installation_price, 2 ) : '£0.00';
        }
    }
    
    $data['installation_type'] = implode( ' | ', $installation_types );
    $data['installation_price'] = implode( ' | ', $installation_prices );
    
    return $data;
}

/**
 * 9. EDIT MODE INSTALLATION DATA RESTORATION
 */
add_action( 'wp_ajax_get_installation_data_for_edit', 'get_installation_data_for_edit' );
add_action( 'wp_ajax_nopriv_get_installation_data_for_edit', 'get_installation_data_for_edit' );
function get_installation_data_for_edit() {
    if ( ! check_ajax_referer( 'door_builder_ajax', 'security', false ) ) {
        wp_send_json_error( 'Security check failed' );
    }
    
    $cart_item_key = isset( $_POST['cart_item_key'] ) ? sanitize_text_field( $_POST['cart_item_key'] ) : '';
    
    if ( empty( $cart_item_key ) ) {
        wp_send_json_error( 'No cart item key provided' );
    }
    
    $cart = WC()->cart->get_cart();
    
    if ( isset( $cart[$cart_item_key] ) && isset( $cart[$cart_item_key]['wizard_data'] ) ) {
        $wizard_data = $cart[$cart_item_key]['wizard_data'];
        
        $installation_data = array(
            'installation_type' => isset( $wizard_data['installation_type'] ) ? $wizard_data['installation_type'] : '',
            'installation_type_value' => isset( $wizard_data['installation_type_value'] ) ? $wizard_data['installation_type_value'] : '',
            'installation_price' => isset( $wizard_data['installation_price'] ) ? $wizard_data['installation_price'] : 0,
            'door_photo' => isset( $wizard_data['door_photo'] ) ? $wizard_data['door_photo'] : '',
            'door_photo_id' => isset( $wizard_data['door_photo_id'] ) ? $wizard_data['door_photo_id'] : '',
            'door_photo_url' => isset( $wizard_data['door_photo_url'] ) ? $wizard_data['door_photo_url'] : ''
        );
        
        wp_send_json_success( $installation_data );
    } else {
        wp_send_json_error( 'Cart item not found' );
    }
}

/**
 * 10. CUSTOM CSS FOR INSTALLATION DISPLAY
 */
add_action( 'wp_head', function() {
    if ( is_cart() || is_checkout() || is_order_received_page() || is_account_page() ) {
        ?>
        <style>
            /* Installation Badge Styling */
            .installation-badge {
                display: inline-block;
                background: #2e7d32;
                color: white;
                font-size: 10px;
                font-weight: 600;
                padding: 2px 8px;
                border-radius: 12px;
                margin-left: 5px;
                text-transform: uppercase;
                letter-spacing: 0.3px;
            }
            
            /* Installation Price Highlight */
            .installation-price-note {
                color: #2e7d32;
                font-weight: 600;
                font-size: 11px;
                display: block;
                margin-top: 2px;
            }
            
            /* Cart Item Installation Display */
            .cart-item-installation {
                font-size: 12px;
                color: #666;
                margin-top: 3px;
                padding-left: 10px;
                border-left: 2px solid #2e7d32;
            }
            
            .cart-item-installation strong {
                color: #333;
                font-weight: 600;
            }
            
            /* Checkout Installation Details */
            .checkout-installation-row {
                background: #f9f9f9;
                padding: 8px 12px;
                margin: 5px 0;
                border-radius: 4px;
                font-size: 13px;
            }
            
            .checkout-installation-label {
                color: #555;
                font-weight: 500;
                min-width: 100px;
                display: inline-block;
            }
            
            .checkout-installation-value {
                color: #2e7d32;
                font-weight: 600;
            }
            
            /* Order Details Installation */
            .order-installation-detail {
                background: #f5f5f5;
                padding: 5px 10px;
                margin: 5px 0;
                border-radius: 3px;
            }
            
            .order-installation-label {
                font-weight: 600;
                color: #333;
            }
            
            .order-installation-price {
                color: #2e7d32;
                font-weight: 600;
                margin-left: 10px;
            }
            
            /* Admin Order Page */
            .column-installation {
                text-align: center;
            }
            
            .installation-admin-badge {
                background: #2e7d32;
                color: white;
                padding: 2px 8px;
                border-radius: 12px;
                font-size: 11px;
                display: inline-block;
            }
            
            /* Email Templates */
            .email-installation-table {
                width: 100%;
                border-collapse: collapse;
                margin: 15px 0;
            }
            
            .email-installation-table th {
                background: #f5f5f5;
                padding: 8px;
                text-align: left;
                font-size: 13px;
            }
            
            .email-installation-table td {
                padding: 8px;
                border-bottom: 1px solid #eee;
                font-size: 12px;
            }
            
            /* Mobile Responsive */
            @media (max-width: 768px) {
                .installation-badge {
                    display: block;
                    margin: 5px 0 0 0;
                    width: fit-content;
                }
                
                .cart-item-installation {
                    padding-left: 0;
                    border-left: none;
                    border-top: 1px dashed #2e7d32;
                    padding-top: 5px;
                    margin-top: 5px;
                }
            }
        </style>
        <?php
    }
});

/**
 * 11. INSTALLATION DATA IN ORDER SEARCH
 */
add_filter( 'woocommerce_shop_order_search_results', 'add_installation_to_order_search', 10, 3 );
function add_installation_to_order_search( $order_ids, $term, $search_fields ) {
    global $wpdb;
    
    $order_ids = array_unique( $order_ids );
    $new_orders = array();
    
    foreach ( $order_ids as $order_id ) {
        $order = wc_get_order( $order_id );
        if ( !$order ) continue;
        
        foreach ( $order->get_items() as $item_id => $item ) {
            $installation = $item->get_meta( 'builder_installation_type' );
            if ( stripos( $installation, $term ) !== false ) {
                $new_orders[] = $order_id;
                break;
            }
            
            $install_value = $item->get_meta( 'builder_installation_value' );
            if ( stripos( $install_value, $term ) !== false ) {
                $new_orders[] = $order_id;
                break;
            }
        }
    }
    
    return array_unique( $new_orders );
}

/**
 * 12. INSTALLATION DATA IN ORDER REPORTS
 */
add_filter( 'woocommerce_reports_get_order_report_data_args', 'add_installation_to_reports', 10, 2 );
function add_installation_to_reports( $args, $name ) {
    if ( $name === 'sales_by_product' ) {
        $args['join_installations'] = "
            LEFT JOIN {$wpdb->prefix}woocommerce_order_itemmeta AS install_meta 
            ON order_items.order_item_id = install_meta.order_item_id 
            AND install_meta.meta_key = 'builder_installation_price'
        ";
        
        $args['select_installations'] = ", SUM( CAST( install_meta.meta_value AS DECIMAL(10,2) ) ) as installation_total";
    }
    return $args;
}




/**
 * ============================================================
 * STEP 11 - DOOR PHOTO UPLOAD HANDLING FOR REMOVE & INSTALL OPTION
 * ============================================================
 */

/**
 * 1. HANDLE DOOR PHOTO AJAX UPLOAD
 * Uploads photo to WordPress media library and returns attachment ID
 */
add_action('wp_ajax_upload_door_photo', 'handle_door_photo_upload_ajax');
add_action('wp_ajax_nopriv_upload_door_photo', 'handle_door_photo_upload_ajax');
function handle_door_photo_upload_ajax() {
    // Verify nonce for security
    if (!check_ajax_referer('door_builder_ajax', 'security', false)) {
        wp_send_json_error('Security check failed');
    }
    
    // Check if file was uploaded
    if (!isset($_FILES['door_photo']) || empty($_FILES['door_photo']['name'])) {
        wp_send_json_error('No file uploaded');
    }
    
    $uploaded_file = $_FILES['door_photo'];
    
    // Check for upload errors
    if ($uploaded_file['error'] !== UPLOAD_ERR_OK) {
        wp_send_json_error('Upload error: ' . $uploaded_file['error']);
    }
    
    // Validate file type (only JPG and PNG)
    $allowed_types = array('image/jpeg', 'image/jpg', 'image/png');
    $file_type = wp_check_filetype($uploaded_file['name']);
    
    if (!in_array($file_type['type'], $allowed_types)) {
        wp_send_json_error('Invalid file type. Only JPG and PNG allowed.');
    }
    
    // Validate file size (max 5MB)
    if ($uploaded_file['size'] > 5 * 1024 * 1024) {
        wp_send_json_error('File too large. Maximum size is 5MB.');
    }
    
    // WordPress upload directory
    $upload_dir = wp_upload_dir();
    $filename = sanitize_file_name(time() . '_' . $uploaded_file['name']);
    $filepath = $upload_dir['path'] . '/' . $filename;
    
    // Move uploaded file
    if (move_uploaded_file($uploaded_file['tmp_name'], $filepath)) {
        // Create attachment post
        $attachment = array(
            'post_mime_type' => $file_type['type'],
            'post_title'     => sanitize_file_name($filename),
            'post_content'   => '',
            'post_status'    => 'inherit',
            'post_author'    => get_current_user_id()
        );
        
        $attach_id = wp_insert_attachment($attachment, $filepath);
        
        // Generate attachment metadata
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attach_data = wp_generate_attachment_metadata($attach_id, $filepath);
        wp_update_attachment_metadata($attach_id, $attach_data);
        
        // Store in session for later use
        if (!session_id()) {
            session_start();
        }
        
        $session_id = session_id();
        $_SESSION['door_photo_' . $session_id] = array(
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
 * 2. SAVE DOOR PHOTO DATA TO CART ITEM
 * This function runs during AJAX form submission
 */
add_filter('woocommerce_add_cart_item_data', 'save_door_photo_to_cart_item', 20, 3);
function save_door_photo_to_cart_item($cart_item_data, $product_id, $variation_id) {
    
    // Parse form data
    if (isset($_POST['form_data'])) {
        parse_str($_POST['form_data'], $form_data);
    } else {
        $form_data = $_POST;
    }
    
    // Check if installation type is remove_existing
    if (isset($form_data['installation_type']) && $form_data['installation_type'] === 'remove_existing') {
        
        // Check session for uploaded photo
        if (!session_id()) {
            session_start();
        }
        
        $session_id = session_id();
        $session_key = 'door_photo_' . $session_id;
        
        if (isset($_SESSION[$session_key])) {
            // Get photo data from session
            $photo_data = $_SESSION[$session_key];
            
            // Add to wizard data
            if (!isset($cart_item_data['wizard_data'])) {
                $cart_item_data['wizard_data'] = array();
            }
            
            $cart_item_data['wizard_data']['door_photo_id'] = $photo_data['id'];
            $cart_item_data['wizard_data']['door_photo_url'] = $photo_data['url'];
            $cart_item_data['wizard_data']['door_photo'] = $photo_data['original_name'];
            $cart_item_data['wizard_data']['door_photo_filename'] = $photo_data['filename'];
            $cart_item_data['wizard_data']['door_photo_uploaded'] = current_time('mysql');
            
            // Clear session data
            unset($_SESSION[$session_key]);
        }
        
        // Also check if photo ID was sent directly via form
        if (isset($form_data['door_photo_id']) && !empty($form_data['door_photo_id'])) {
            $photo_id = intval($form_data['door_photo_id']);
            
            if (!isset($cart_item_data['wizard_data'])) {
                $cart_item_data['wizard_data'] = array();
            }
            
            $cart_item_data['wizard_data']['door_photo_id'] = $photo_id;
            $cart_item_data['wizard_data']['door_photo_url'] = wp_get_attachment_url($photo_id);
            $cart_item_data['wizard_data']['door_photo'] = get_the_title($photo_id);
        }
    }
    
    return $cart_item_data;
}

/**
 * 3. VALIDATE DOOR PHOTO BEFORE CHECKOUT
 * Prevents checkout if photo is missing for remove_existing option
 */
add_action('woocommerce_checkout_process', 'validate_door_photo_before_checkout');
function validate_door_photo_before_checkout() {
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        // Check if this is a door builder product
        if (!isset($cart_item['wizard_data'])) {
            continue;
        }
        
        $wizard_data = $cart_item['wizard_data'];
        
        // Check if installation type is remove_existing
        $install_type = isset($wizard_data['installation_type_value']) ? $wizard_data['installation_type_value'] : '';
        
        if ($install_type === 'remove_existing') {
            // Check if photo exists
            $has_photo = false;
            
            if (isset($wizard_data['door_photo_id']) && !empty($wizard_data['door_photo_id'])) {
                $has_photo = true;
            } elseif (isset($wizard_data['door_photo_url']) && !empty($wizard_data['door_photo_url'])) {
                $has_photo = true;
            } elseif (isset($wizard_data['door_photo']) && !empty($wizard_data['door_photo'])) {
                $has_photo = true;
            }
            
            if (!$has_photo) {
                wc_add_notice(
                    'Photo of existing door is required for Remove & Install option. Please remove the item and reconfigure your door.',
                    'error'
                );
            }
        }
    }
}

/**
 * 4. DISPLAY DOOR PHOTO IN CART PAGE
 */
add_filter('woocommerce_get_item_data', 'display_door_photo_in_cart', 10, 2);
function display_door_photo_in_cart($item_data, $cart_item) {
    if (isset($cart_item['wizard_data']['door_photo'])) {
        $item_data[] = array(
            'name' => 'Door Photo',
            'value' => $cart_item['wizard_data']['door_photo']
        );
    }
    return $item_data;
}

/**
 * 5. DISPLAY DOOR PHOTO IN CHECKOUT PAGE
 */
add_filter('woocommerce_checkout_cart_item_quantity', 'display_door_photo_in_checkout', 10, 3);
function display_door_photo_in_checkout($quantity_html, $cart_item, $cart_item_key) {
    if (isset($cart_item['wizard_data']['door_photo'])) {
        $quantity_html .= '<div class="checkout-door-photo" style="font-size: 12px; color: #666; margin-top: 5px;">';
        $quantity_html .= '📷 Photo: ' . esc_html($cart_item['wizard_data']['door_photo']);
        $quantity_html .= '</div>';
    }
    return $quantity_html;
}

/**
 * 6. SAVE DOOR PHOTO TO ORDER ITEM META
 */
add_action('woocommerce_checkout_create_order_line_item', 'save_door_photo_to_order_item', 10, 4);
function save_door_photo_to_order_item($item, $cart_item_key, $values, $order) {
    if (isset($values['wizard_data']['door_photo_id'])) {
        $item->add_meta_data('_door_photo_id', $values['wizard_data']['door_photo_id']);
        $item->add_meta_data('_door_photo_url', $values['wizard_data']['door_photo_url']);
        $item->add_meta_data('_door_photo_name', $values['wizard_data']['door_photo']);
        
        // Also save with builder prefix for consistency
        $item->add_meta_data('builder_door_photo_id', $values['wizard_data']['door_photo_id']);
        $item->add_meta_data('builder_door_photo_url', $values['wizard_data']['door_photo_url']);
        $item->add_meta_data('builder_door_photo', $values['wizard_data']['door_photo']);
    }
}

/**
 * 7. DISPLAY DOOR PHOTO IN ADMIN ORDER PAGE
 */
add_action('woocommerce_after_order_itemmeta', 'display_door_photo_in_admin_order', 10, 3);
function display_door_photo_in_admin_order($item_id, $item, $product) {
    $photo_id = $item->get_meta('builder_door_photo_id');
    $photo_url = $item->get_meta('builder_door_photo_url');
    $photo_name = $item->get_meta('builder_door_photo');
    
    if ($photo_id || $photo_url || $photo_name) {
        echo '<div class="door-photo-admin" style="margin-top: 10px; padding: 10px; background: #f9f9f9; border: 1px solid #ddd;">';
        echo '<strong style="display: block; margin-bottom: 8px;">📷 Existing Door Photo:</strong>';
        
        if ($photo_url) {
            echo '<a href="' . esc_url($photo_url) . '" target="_blank">';
            echo '<img src="' . esc_url($photo_url) . '" style="max-width: 150px; max-height: 150px; border: 1px solid #ccc; padding: 3px; background: #fff;">';
            echo '</a>';
        } else {
            echo '<span>Photo: ' . esc_html($photo_name) . ' (ID: ' . esc_html($photo_id) . ')</span>';
        }
        echo '</div>';
    }
}

/**
 * 8. DISPLAY DOOR PHOTO IN CUSTOMER ORDER PAGE (My Account)
 */
add_action('woocommerce_order_item_meta_end', 'display_door_photo_in_customer_order', 10, 4);
function display_door_photo_in_customer_order($item_id, $item, $order, $plain_text) {
    if ($plain_text) return;
    
    $photo_url = $item->get_meta('builder_door_photo_url');
    $photo_name = $item->get_meta('builder_door_photo');
    
    if ($photo_url || $photo_name) {
        echo '<div class="door-photo-customer" style="margin: 10px 0; padding: 10px; background: #f5f5f5; border-left: 3px solid #2e7d32;">';
        echo '<strong style="display: block; margin-bottom: 8px;">📷 Existing Door Photo:</strong>';
        
        if ($photo_url) {
            echo '<a href="' . esc_url($photo_url) . '" target="_blank">';
            echo '<img src="' . esc_url($photo_url) . '" style="max-width: 100px; max-height: 100px; border: 1px solid #ddd; border-radius: 4px;">';
            echo '</a>';
            echo '<p style="margin: 5px 0 0; font-size: 11px;">Click to view full size</p>';
        } else {
            echo '<span>' . esc_html($photo_name) . '</span>';
        }
        echo '</div>';
    }
}

/**
 * 9. DISPLAY DOOR PHOTO IN ORDER RECEIVED PAGE (Thank You)
 */
add_action('woocommerce_order_details_after_order_table', 'display_door_photo_in_order_received', 10, 1);
function display_door_photo_in_order_received($order) {
    foreach ($order->get_items() as $item_id => $item) {
        $photo_url = $item->get_meta('builder_door_photo_url');
        $photo_name = $item->get_meta('builder_door_photo');
        
        if ($photo_url || $photo_name) {
            echo '<div style="margin: 20px 0; padding: 15px; background: #f0f8f0; border: 1px solid #2e7d32; border-radius: 5px;">';
            echo '<h3 style="margin-top: 0; color: #2e7d32;">📷 Existing Door Photo Uploaded</h3>';
            
            if ($photo_url) {
                echo '<p><a href="' . esc_url($photo_url) . '" target="_blank" style="color: #2e7d32;">Click here to view the uploaded photo</a></p>';
            } else {
                echo '<p>Photo: ' . esc_html($photo_name) . '</p>';
            }
            echo '</div>';
            break;
        }
    }
}

/**
 * 10. ADD PHOTO UPLOAD REMINDER IN CART FOR REMOVE EXISTING OPTION
 */
add_action('woocommerce_after_cart_item_name', 'add_photo_reminder_in_cart', 10, 2);
function add_photo_reminder_in_cart($cart_item, $cart_item_key) {
    if (isset($cart_item['wizard_data']['installation_type_value']) && 
        $cart_item['wizard_data']['installation_type_value'] === 'remove_existing') {
        
        // Check if photo exists
        $has_photo = false;
        if (isset($cart_item['wizard_data']['door_photo_id']) && !empty($cart_item['wizard_data']['door_photo_id'])) {
            $has_photo = true;
        } elseif (isset($cart_item['wizard_data']['door_photo_url']) && !empty($cart_item['wizard_data']['door_photo_url'])) {
            $has_photo = true;
        } elseif (isset($cart_item['wizard_data']['door_photo']) && !empty($cart_item['wizard_data']['door_photo'])) {
            $has_photo = true;
        }
        
        if (!$has_photo) {
            $edit_url = add_query_arg(array(
                'edit_cart_item' => $cart_item_key,
                'product_id' => $cart_item['product_id']
            ), home_url('/bifold-door-builder/'));
            
            echo '<div style="margin-top: 10px; padding: 10px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 4px;">';
            echo '<strong style="color: #856404;">⚠️ Photo Required:</strong> ';
            echo 'Please <a href="' . esc_url($edit_url) . '" style="color: #856404; font-weight: bold; text-decoration: underline;">upload a photo</a> ';
            echo 'of your existing door to complete checkout.';
            echo '</div>';
        } else {
            echo '<div style="margin-top: 10px; padding: 5px 10px; background: #d4edda; border-left: 4px solid #28a745; border-radius: 4px;">';
            echo '<span style="color: #155724;">✅ Photo uploaded: ' . esc_html($cart_item['wizard_data']['door_photo']) . '</span>';
            echo '</div>';
        }
    }
}

/**
 * 11. DEBUG FUNCTION TO CHECK PHOTO DATA IN CART
 * Add ?debug_photo=1 to any page to see photo data
 */
add_action('init', 'debug_door_photo_data');
function debug_door_photo_data() {
    if (isset($_GET['debug_photo']) && current_user_can('administrator')) {
        echo '<pre>';
        echo '=== DOOR PHOTO DEBUG INFO ===' . "\n\n";
        
        echo 'SESSION DATA:' . "\n";
        if (!session_id()) session_start();
        print_r($_SESSION);
        
        echo "\n\nCART DATA:\n";
        if (function_exists('WC')) {
            foreach (WC()->cart->get_cart() as $key => $item) {
                echo "Cart Item: $key\n";
                if (isset($item['wizard_data'])) {
                    echo "Wizard Data:\n";
                    foreach ($item['wizard_data'] as $k => $v) {
                        if (strpos($k, 'photo') !== false) {
                            echo "  $k => " . print_r($v, true) . "\n";
                        }
                    }
                }
                echo "\n";
            }
        }
        
        echo '</pre>';
        exit;
    }
}

/**
 * 12. ENSURE SESSION STARTED FOR PHOTO UPLOAD
 */
add_action('init', 'ensure_session_started_for_photo');
function ensure_session_started_for_photo() {
    if (is_page('bifold-door-builder') && !session_id()) {
        session_start();
    }
}

/**
 * 13. ADD PHOTO UPLOAD SCRIPT TO BUILDER PAGE
 */
add_action('wp_footer', 'add_photo_upload_script_to_builder');
function add_photo_upload_script_to_builder() {
    if (!is_page('bifold-door-builder')) return;
    ?>
    <script>
    jQuery(document).ready(function($) {
        // Store photo data in global variable
        window.uploadedPhotoData = null;
        
        // Override the existing photo change handler
        $('#door_photo').off('change').on('change', function() {
            var file = this.files[0];
            if (file) {
                var fileName = file.name;
                $('#photo-file-name').text(fileName + ' (uploading...)');
                
                var formData = new FormData();
                formData.append('action', 'upload_door_photo');
                formData.append('security', door_builder_vars.nonce);
                formData.append('door_photo', file);
                
                $.ajax({
                    url: door_builder_vars.ajax_url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $('#photo-file-name').text(fileName + ' ✓ Uploaded');
                            
                            // Store in global variable
                            window.uploadedPhotoData = response.data;
                            
                            // Add hidden fields if not exists
                            if (!$('#door_photo_id').length) {
                                $('#photo-upload-section').append(
                                    '<input type="hidden" name="door_photo_id" id="door_photo_id" value="">' +
                                    '<input type="hidden" name="door_photo_url" id="door_photo_url" value="">'
                                );
                            }
                            
                            $('#door_photo_id').val(response.data.id);
                            $('#door_photo_url').val(response.data.url);
                            
                            console.log('Photo uploaded successfully:', response.data);
                        } else {
                            $('#photo-file-name').text(fileName + ' ✗ Upload failed');
                            alert('Upload failed: ' + response.data);
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#photo-file-name').text(fileName + ' ✗ Error');
                        console.error('Upload error:', error);
                    }
                });
            } else {
                $('#photo-file-name').text('No file chosen');
            }
        });
    });
    </script>
    <?php
}

/**
 * ============================================================
 * THANK YOU PAGE - DOOR CONFIGURATION DISPLAY (FIXED VERSION)
 * ============================================================
 */

/**
 * REMOVE RAW META DATA FROM ORDER DETAILS
 */
add_filter('woocommerce_order_item_display_meta_key', 'filter_order_item_display_meta_key', 10, 3);
function filter_order_item_display_meta_key($display_key, $meta, $item) {
    // Hide all builder_ prefixed meta keys
    if (strpos($meta->key, 'builder_') === 0) {
        return false;
    }
    
    // Also hide specific meta keys
    $hidden_keys = array(
        '_door_photo_id', '_door_photo_url', '_door_photo_name',
        'builder_width', 'builder_height', 'builder_panels',
        'builder_opening', 'builder_outside_colour', 'builder_outside_ral',
        'builder_inside_colour', 'builder_inside_ral', 'builder_handle',
        'builder_glass', 'builder_vents', 'builder_cill',
        'builder_postcode', 'builder_installation_type', 'builder_installation_value',
        'builder_delivery_price', 'builder_delivery_zone', 'builder_delivery_distance',
        'builder_delivery_bespoke', 'builder_access', 'builder_first_name',
        'builder_last_name', 'builder_email', 'builder_phone',
        'builder_unique_id', 'builder_timestamp', 'builder_door_photo_id',
        'builder_door_photo_url', 'builder_door_photo', '_custom_price',
        'unique_key', 'wizard_data'
    );
    
    if (in_array($meta->key, $hidden_keys)) {
        return false;
    }
    
    return $display_key;
}

/**
 * FORMAT DOOR CONFIGURATION NICELY ON THANK YOU PAGE
 */
add_action('woocommerce_thankyou', 'display_formatted_door_configuration', 5, 1);
function display_formatted_door_configuration($order_id) {
    $order = wc_get_order($order_id);
    if (!$order) return;
    
    // Remove default meta display
    remove_action('woocommerce_order_item_meta_end', 'display_builder_data_order_details', 10, 4);
    
    foreach ($order->get_items() as $item_id => $item) {
        $meta_data = $item->get_meta_data();
        $config = array();
        
        // Collect all builder meta data
        foreach ($meta_data as $meta) {
            if (strpos($meta->key, 'builder_') === 0) {
                $key = str_replace('builder_', '', $meta->key);
                $config[$key] = $meta->value;
            }
        }
        
        if (!empty($config)) {
            echo '<style>
                .door-config-container {
                    margin: 30px 0;
                    padding: 25px;
                    background: #f9f9f9;
                    border: 1px solid #e0e0e0;
                    border-radius: 8px;
                    font-family: Arial, sans-serif;
                }
                .door-config-title {
                    color: #2e7d32;
                    border-bottom: 2px solid #2e7d32;
                    padding-bottom: 10px;
                    margin-top: 0;
                }
                .door-config-grid {
                    display: grid;
                    grid-template-columns: repeat(2, 1fr);
                    gap: 15px;
                    margin-top: 20px;
                }
                .door-config-item {
                    background: white;
                    padding: 12px 15px;
                    border-radius: 6px;
                    border-left: 4px solid #2e7d32;
                }
                .door-config-label {
                    display: block;
                    color: #555;
                    text-transform: uppercase;
                    font-size: 11px;
                    font-weight: 600;
                    margin-bottom: 5px;
                }
                .door-config-value {
                    font-size: 16px;
                    font-weight: 600;
                    color: #333;
                }
                .door-photo-section {
                    margin-top: 25px;
                    padding: 20px;
                    background: white;
                    border-radius: 8px;
                    border: 1px dashed #2e7d32;
                }
                .door-photo-title {
                    color: #2e7d32;
                    margin-top: 0;
                    margin-bottom: 15px;
                }
                .door-photo-image {
                    max-width: 300px;
                    max-height: 200px;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                    padding: 5px;
                }
                @media (max-width: 768px) {
                    .door-config-grid {
                        grid-template-columns: 1fr;
                    }
                }
            </style>';
            
            echo '<div class="door-config-container">';
            echo '<h2 class="door-config-title">🚪 Your Aluminium Bifold Door Configuration</h2>';
            
            // Product Name
            echo '<p style="font-size: 15px; font-weight: 500; margin-bottom: 15px; color: #2e7d32;">';
            echo $item->get_name();
            echo '</p>';
            
            echo '<div class="door-config-grid">';
            
            // Size
            if (!empty($config['width']) && !empty($config['height'])) {
                echo '<div class="door-config-item">';
                echo '<span class="door-config-label">📏 Manufacturing Size</span>';
                echo '<span class="door-config-value">' . esc_html($config['width'] . ' x ' . $config['height'] . ' mm') . '</span>';
                echo '</div>';
            }
            
            // Panels
            if (!empty($config['panels'])) {
                echo '<div class="door-config-item">';
                echo '<span class="door-config-label">🪟 Panels</span>';
                echo '<span class="door-config-value">' . esc_html($config['panels']) . '</span>';
                echo '</div>';
            }
            
            // Opening Direction
            if (!empty($config['opening'])) {
                echo '<div class="door-config-item">';
                echo '<span class="door-config-label">🚪 Opening Direction</span>';
                echo '<span class="door-config-value">' . esc_html($config['opening']) . '</span>';
                echo '</div>';
            }
            
            // Outside Colour
            if (!empty($config['outside_colour'])) {
                $outside = $config['outside_colour'];
                if (!empty($config['outside_ral'])) {
                    $outside .= ' (RAL ' . $config['outside_ral'] . ')';
                }
                echo '<div class="door-config-item">';
                echo '<span class="door-config-label">🎨 Outside Colour</span>';
                echo '<span class="door-config-value">' . esc_html($outside) . '</span>';
                echo '</div>';
            }
            
            // Inside Colour
            if (!empty($config['inside_colour'])) {
                $inside = $config['inside_colour'];
                if (!empty($config['inside_ral'])) {
                    $inside .= ' (RAL ' . $config['inside_ral'] . ')';
                }
                echo '<div class="door-config-item">';
                echo '<span class="door-config-label">🎨 Inside Colour</span>';
                echo '<span class="door-config-value">' . esc_html($inside) . '</span>';
                echo '</div>';
            }
            
            // Handle Colour
            if (!empty($config['handle'])) {
                echo '<div class="door-config-item">';
                echo '<span class="door-config-label">🔑 Handle Colour</span>';
                echo '<span class="door-config-value">' . esc_html($config['handle']) . '</span>';
                echo '</div>';
            }
            
            // Glass
            if (!empty($config['glass'])) {
                $glass_display = $config['glass'];
                if ($glass_display === 'no_thanks') {
                    $glass_display = 'Standard Glass';
                }
                echo '<div class="door-config-item">';
                echo '<span class="door-config-label">🔍 Glass</span>';
                echo '<span class="door-config-value">' . esc_html($glass_display) . '</span>';
                echo '</div>';
            }
            
            // Trickle Vents
            if (isset($config['vents'])) {
                echo '<div class="door-config-item">';
                echo '<span class="door-config-label">💨 Trickle Vents</span>';
                echo '<span class="door-config-value">' . esc_html($config['vents']) . '</span>';
                echo '</div>';
            }
            
            // Cill
            if (!empty($config['cill'])) {
                echo '<div class="door-config-item">';
                echo '<span class="door-config-label">📐 Cill</span>';
                echo '<span class="door-config-value">' . esc_html($config['cill']) . '</span>';
                echo '</div>';
            }
            
            // Installation Type
            if (!empty($config['installation_type'])) {
                echo '<div class="door-config-item">';
                echo '<span class="door-config-label">🔧 Installation</span>';
                echo '<span class="door-config-value">' . esc_html($config['installation_type']) . '</span>';
                echo '</div>';
            }
            
            // Postcode
            if (!empty($config['postcode'])) {
                echo '<div class="door-config-item">';
                echo '<span class="door-config-label">📍 Postcode</span>';
                echo '<span class="door-config-value">' . esc_html($config['postcode']) . '</span>';
                echo '</div>';
            }
            
            // Access Issues
            if (!empty($config['access'])) {
                echo '<div class="door-config-item">';
                echo '<span class="door-config-label">⚠️ Access Issues</span>';
                echo '<span class="door-config-value">' . esc_html($config['access']) . '</span>';
                echo '</div>';
            }
            
            echo '</div>'; // Close grid
            
            // Door Photo Section
            $photo_shown = false;
            if (!empty($config['door_photo_url']) && !$photo_shown) {
                echo '<div class="door-photo-section">';
                echo '<h3 class="door-photo-title">📷 Existing Door Photo</h3>';
                echo '<a href="' . esc_url($config['door_photo_url']) . '" target="_blank">';
                echo '<img src="' . esc_url($config['door_photo_url']) . '" class="door-photo-image">';
                echo '</a>';
                echo '<p style="margin: 10px 0 0; font-size: 12px; color: #666;">';
                echo 'Filename: ' . esc_html($config['door_photo']);
                echo '</p>';
                echo '</div>';
                $photo_shown = true;
            }
            
            echo '</div>'; // Close main container
        }
    }
}

/**
 * REMOVE DUPLICATE DOOR CONFIGURATION FROM ORDER DETAILS
 */
add_filter('woocommerce_order_item_get_formatted_meta_data', 'remove_duplicate_door_meta', 10, 2);
function remove_duplicate_door_meta($formatted_meta, $item) {
    $filtered_meta = array();
    $seen_keys = array();
    
    foreach ($formatted_meta as $key => $meta) {
        // Skip all builder_ prefixed meta
        if (strpos($meta->key, 'builder_') === 0) {
            continue;
        }
        
        // Skip duplicate door photo entries
        if (in_array($meta->key, ['door_photo', 'door_photo_id', 'door_photo_url'])) {
            if (in_array($meta->key, $seen_keys)) {
                continue;
            }
            $seen_keys[] = $meta->key;
        }
        
        $filtered_meta[$key] = $meta;
    }
    
    return $filtered_meta;
}

/**
 * ============================================================
 * FIX: DISPLAY BUILDER DATA IN ADMIN ORDER DETAILS PAGE
 * ============================================================
 */

/**
 * 1. FORCE DISPLAY BUILDER META DATA IN ADMIN ORDER PAGE
 */
add_action('woocommerce_before_order_itemmeta', 'force_display_builder_data_admin', 1, 3);
function force_display_builder_data_admin($item_id, $item, $product) {
    // Only in admin and for line items
    if (!is_admin() || !$item->is_type('line_item')) {
        return;
    }
    
    // Get all meta data
    $meta_data = $item->get_meta_data();
    $builder_data = array();
    
    // Collect builder_ prefixed meta
    foreach ($meta_data as $meta) {
        if (strpos($meta->key, 'builder_') === 0) {
            $builder_data[$meta->key] = $meta->value;
        }
    }
    
    // Also check for underscore prefixed data
    $door_config = $item->get_meta('_door_config');
    if (!empty($door_config)) {
        $config = json_decode($door_config, true);
        if (is_array($config)) {
            foreach ($config as $key => $value) {
                $builder_data['builder_' . $key] = $value;
            }
        }
    }
    
    // If no builder data, return
    if (empty($builder_data)) {
        return;
    }
    
    // Display builder data in a nice format
    echo '<div style="margin: 15px 0; padding: 15px; background: #f0f8f0; border: 1px solid #2e7d32; border-radius: 5px;">';
    echo '<h4 style="margin-top: 0; color: #2e7d32; border-bottom: 1px solid #2e7d32; padding-bottom: 8px;">🚪 Door Builder Configuration</h4>';
    
    echo '<table style="width: 100%; border-collapse: collapse; font-size: 12px;">';
    
    // Display in organized order
    $display_order = [
        'builder_width' => 'Width',
        'builder_height' => 'Height',
        'builder_panels' => 'Panels',
        'builder_opening' => 'Opening Direction',
        'builder_outside_colour' => 'Outside Colour',
        'builder_outside_ral' => 'Outside RAL',
        'builder_inside_colour' => 'Inside Colour',
        'builder_inside_ral' => 'Inside RAL',
        'builder_handle' => 'Handle Colour',
        'builder_glass' => 'Glass',
        'builder_vents' => 'Trickle Vents',
        'builder_cill' => 'Cill',
        'builder_installation_type' => 'Installation Type',
        'builder_installation_value' => 'Installation Value',
        'builder_postcode' => 'Postcode',
        'builder_access' => 'Access Issues',
        'builder_first_name' => 'First Name',
        'builder_last_name' => 'Last Name',
        'builder_email' => 'Email',
        'builder_phone' => 'Phone',
    ];
    
    foreach ($display_order as $meta_key => $label) {
        if (isset($builder_data[$meta_key]) && !empty($builder_data[$meta_key])) {
            $value = $builder_data[$meta_key];
            
            // Format specific values
            if ($meta_key === 'builder_glass' && $value === 'no_thanks') {
                $value = 'Standard Glass';
            }
            
            echo '<tr>';
            echo '<td style="padding: 6px 8px; font-weight: 600; color: #555; width: 150px;">' . $label . ':</td>';
            echo '<td style="padding: 6px 8px;">' . esc_html($value) . '</td>';
            echo '</tr>';
        }
    }
    
    echo '</table>';
    
    // Display door photo if exists
    if (isset($builder_data['builder_door_photo_url']) && !empty($builder_data['builder_door_photo_url'])) {
        echo '<div style="margin-top: 15px;">';
        echo '<strong style="display: block; margin-bottom: 8px;">📷 Door Photo:</strong>';
        echo '<a href="' . esc_url($builder_data['builder_door_photo_url']) . '" target="_blank">';
        echo '<img src="' . esc_url($builder_data['builder_door_photo_url']) . '" style="max-width: 150px; max-height: 150px; border: 1px solid #ddd; padding: 5px; background: white;">';
        echo '</a>';
        echo '</div>';
    }
    
    echo '</div>';
}

/**
 * 2. ENSURE META DATA IS SAVED PROPERLY
 */
add_action('woocommerce_checkout_create_order_line_item', 'ensure_builder_meta_saved', 5, 4);
function ensure_builder_meta_saved($item, $cart_item_key, $values, $order) {
    if (isset($values['wizard_data'])) {
        // Save each piece of data with builder_ prefix
        foreach ($values['wizard_data'] as $key => $value) {
            if (!empty($value)) {
                $item->add_meta_data('builder_' . $key, $value, true);
            }
        }
        
        // Save complete config as JSON for backup
        $item->add_meta_data('_builder_complete_config', json_encode($values['wizard_data']), true);
    }
}

/**
 * 3. FIX HPOS META DATA VISIBILITY
 */
add_filter('woocommerce_order_item_get_formatted_meta_data', 'fix_builder_meta_visibility', 1, 2);
function fix_builder_meta_visibility($formatted_meta, $item) {
    // Only in admin
    if (!is_admin()) {
        return $formatted_meta;
    }
    
    // Add builder meta to formatted meta
    $meta_data = $item->get_meta_data();
    $added_keys = array();
    
    foreach ($meta_data as $meta) {
        if (strpos($meta->key, 'builder_') === 0 && !isset($added_keys[$meta->key])) {
            $formatted_meta[] = (object) array(
                'key' => $meta->key,
                'value' => $meta->value,
                'display_key' => ucfirst(str_replace('_', ' ', str_replace('builder_', '', $meta->key))),
                'display_value' => $meta->value,
            );
            $added_keys[$meta->key] = true;
        }
    }
    
    return $formatted_meta;
}

/**
 * 4. ADD DEBUG INFO TO ADMIN ORDER PAGE
 */
add_action('admin_footer', 'add_builder_debug_info');
function add_builder_debug_info() {
    $screen = get_current_screen();
    if ($screen->id !== 'shop_order') {
        return;
    }
    ?>
    <script>
    jQuery(document).ready(function($) {
        console.log('Admin order page loaded - checking for builder data');
        if ($('.door-builder-debug').length === 0) {
            $('.woocommerce-order-items').before('<div class="door-builder-debug" style="display:none;">Builder data check enabled</div>');
        }
    });
    </script>
    <?php
}

/**
 * 5. ALTERNATIVE DISPLAY METHOD FOR OLDER WOOCOMMERCE
 */
add_action('woocommerce_order_item_meta_end', 'display_builder_data_admin_alternative', 1, 4);
function display_builder_data_admin_alternative($item_id, $item, $order, $plain_text) {
    // Only in admin
    if (!is_admin()) {
        return;
    }
    
    $builder_data = array();
    $meta_data = $item->get_meta_data();
    
    foreach ($meta_data as $meta) {
        if (strpos($meta->key, 'builder_') === 0) {
            $builder_data[$meta->key] = $meta->value;
        }
    }
    
    if (empty($builder_data)) {
        return;
    }
    
    echo '<div style="margin: 10px 0; padding: 10px; background: #f9f9f9; border-left: 4px solid #2e7d32;">';
    echo '<strong style="display: block; margin-bottom: 8px;">🚪 Door Configuration:</strong>';
    echo '<table style="width: 100%; border-collapse: collapse;">';
    
    foreach ($builder_data as $key => $value) {
        $display_key = ucfirst(str_replace('_', ' ', str_replace('builder_', '', $key)));
        echo '<tr>';
        echo '<td style="padding: 3px 5px; font-weight: 600; width: 150px;">' . $display_key . ':</td>';
        echo '<td style="padding: 3px 5px;">' . esc_html($value) . '</td>';
        echo '</tr>';
    }
    
    echo '</table>';
    echo '</div>';
}

