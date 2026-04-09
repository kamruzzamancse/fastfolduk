<?php
// Get product details
$product_id   = isset($_GET['product_id']) ? absint($_GET['product_id']) : 0;
$variation_id = isset($_GET['variation_id']) ? absint($_GET['variation_id']) : 0;
$base_price = 0;

// ===== EDIT MODE DETECTION =====
$edit_cart_item = isset($_GET['edit_cart_item']) ? sanitize_text_field($_GET['edit_cart_item']) : '';
$edit_mode = !empty($edit_cart_item);
$edit_data = array();

if ($edit_mode && function_exists('WC')) {
    $cart = WC()->cart->get_cart();
    if (isset($cart[$edit_cart_item]) && isset($cart[$edit_cart_item]['wizard_data'])) {
        $edit_data = $cart[$edit_cart_item]['wizard_data'];
    }
}
// ===============================

if ($variation_id) {
    $variation = wc_get_product($variation_id);
    if ($variation) {
        $base_price = $variation->get_price();
    }
}

// Get site logo
$logo_url = get_theme_mod('custom_logo') ? wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full') : get_stylesheet_directory_uri() . '/assets/images/common/fastfold-logo.png';
$banner_url = get_stylesheet_directory_uri() . '/assets/images/common/fastfold-trust-banner.png';

// Count total steps - CORRECTED PATH
$step_files = glob(get_stylesheet_directory() . '/template-parts/bifolding-doors/step-*.php');
$total_steps = count($step_files);
if ($total_steps == 0) $total_steps = 14; // Default to 14 steps
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design Your Bifolding Door - Fast Fold</title>
    <?php wp_head(); ?>
</head>
<body class="bifold-builder-page">
    
<div class="header-wrapper" style="background: #000;">
    <div class="header-container">
        <div class="builder-logo">
            <img src="<?php echo esc_url($logo_url); ?>" alt="Fast Fold Logo">
        </div>

        <div class="fastfold-trust-banner">
            <img src="<?php echo esc_url($banner_url); ?>" alt="Fast Fold Trust Banner">
        </div>
    </div>
</div>

<!-- Door Builder Wrapper -->
<div class="door-builder-wrapper">

    <!-- Builder Form (Left Side) -->
    <form method="post" class="door-builder-form" id="door-builder-form" enctype="multipart/form-data">
        
        <!-- Hidden inputs -->
        <input type="hidden" name="product_id" value="<?php echo esc_attr($product_id); ?>">
        <input type="hidden" name="variation_id" value="<?php echo esc_attr($variation_id); ?>">
        <input type="hidden" name="final_price" id="final_price_input" value="<?php echo esc_attr($base_price); ?>">
        <input type="hidden" id="base_price_value" value="<?php echo esc_attr($base_price); ?>">
        <input type="hidden" name="builder_checkout" id="builder_checkout_input" value="0">
        <input type="hidden" id="total_steps" value="<?php echo $total_steps; ?>">
        <input type="hidden" name="product_type" value="door">
        
        <!-- Edit mode hidden fields -->
        <?php if ($edit_mode): ?>
        <input type="hidden" name="edit_mode" id="edit_mode_field" value="1">
        <input type="hidden" name="cart_item_key" id="cart_item_key_field" value="<?php echo esc_js($edit_cart_item); ?>">
        <?php endif; ?>
        
        <?php wp_nonce_field('door_builder_action', 'builder_nonce'); ?>

        <!-- Include all steps - CORRECTED PATH -->
        <?php 
        for ($i = 1; $i <= $total_steps; $i++) {
            $step_file = get_stylesheet_directory() . '/template-parts/bifolding-doors/step-' . $i . '.php';
            if (file_exists($step_file)) {
                include $step_file;
            }
        }
        ?>

        <!-- Navigation Bar -->
        <div class="builder-nav">
            <div class="nav-container">
                <button type="button" class="nav-btn prev-step" disabled>← PREVIOUS</button>
                <button type="button" class="nav-btn next-step">NEXT →</button>
            </div>
        </div>

    </form>

    <!-- SLIDING DRAWER - Right Side -->
    <div class="drawer-container" id="drawerContainer">
        
        <!-- Drawer Toggle Button -->
        <div class="drawer-toggle" id="drawerToggle">
            <div class="toggle-content">
                <span class="toggle-icon">📋</span>
                <div class="toggle-price-info">
                    <span class="toggle-label">Total:</span>
                    <span class="toggle-price" id="drawer-total-price">£<?php echo number_format($base_price, 2); ?></span>
                </div>
                <span class="toggle-arrow">◀</span>
            </div>
        </div>
        
        <!-- Drawer Content -->
        <div class="drawer-content" id="drawerContent">
            
            <!-- Drawer Header -->
            <div class="drawer-header">
                <h3>Your Door Configuration</h3>
                <button class="drawer-close" id="drawerClose">✕</button>
            </div>
            
            <!-- Steps List (will be populated by JS) -->
            <div class="drawer-steps-list" id="drawerStepsList">
                <div class="drawer-loading">Loading configuration...</div>
            </div>
            
            <!-- Drawer Footer -->
            <div class="drawer-footer">
                <div class="drawer-total">
                    <span class="total-label">Total Price:</span>
                    <span class="total-price" id="drawer-footer-total">£<?php echo number_format($base_price, 2); ?></span>
                </div>
                
                <div class="drawer-actions">
                    <button type="button" class="add-to-cart-btn" id="drawerAddToCart">Add to Cart</button>
                    <button type="button" class="buy-now-btn" id="drawerCheckout">Buy Now</button>
                </div>
                
                <div class="drawer-edit-mode" id="drawerEditMode" style="display: <?php echo $edit_mode ? 'block' : 'none'; ?>;">
                    ✏️ Editing cart item
                </div>
            </div>
            
        </div>
    </div>

</div>

<?php wp_footer(); ?>

<script>
// Pass PHP variables to JavaScript
window.doorBuilderData = {
    basePrice: <?php echo $base_price; ?>,
    totalSteps: <?php echo $total_steps; ?>,
    editMode: <?php echo $edit_mode ? 'true' : 'false'; ?>,
    editCartKey: '<?php echo esc_js($edit_cart_item); ?>',
    editData: <?php echo json_encode($edit_data); ?>,
    productType: 'door',
    ajaxUrl: '<?php echo admin_url('admin-ajax.php'); ?>',
    cartUrl: '<?php echo wc_get_cart_url(); ?>',
    checkoutUrl: '<?php echo wc_get_checkout_url(); ?>',
    nonce: '<?php echo wp_create_nonce('door_builder_ajax'); ?>'
};

// Initialize base price
jQuery(document).ready(function($) {
    $('#base_price_value').val(<?php echo $base_price; ?>);
});

// Edit mode data
window.editMode = <?php echo $edit_mode ? 'true' : 'false'; ?>;
window.editCartKey = '<?php echo esc_js($edit_cart_item); ?>';
window.editData = <?php echo json_encode($edit_data); ?>;
window.totalSteps = <?php echo $total_steps; ?>;
</script>

</body>
</html>