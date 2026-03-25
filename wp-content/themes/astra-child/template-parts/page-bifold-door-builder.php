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
$logo_url = get_theme_mod('custom_logo') ? wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full') : get_stylesheet_directory_uri() . '/assets/images/bifold-doors/fastfold-logo.png';
$banner_url = get_theme_mod('custom_logo') ? wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full') : get_stylesheet_directory_uri() . '/assets/images/bifold-doors/fastfold-trust-banner.png';

// Count total steps
$step_files = glob(get_stylesheet_directory() . '/template-parts/builder/step-*.php');
$total_steps = count($step_files);
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design Your Bifold Door - Fast Fold</title>
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
    <form method="post" class="door-builder-form" id="door-builder-form">
        
        <!-- Hidden inputs -->
        <input type="hidden" name="product_id" value="<?php echo esc_attr($product_id); ?>">
        <input type="hidden" name="variation_id" value="<?php echo esc_attr($variation_id); ?>">
        <input type="hidden" name="final_price" id="final_price_input" value="<?php echo esc_attr($base_price); ?>">
        <input type="hidden" id="base_price_value" value="<?php echo esc_attr($base_price); ?>">
        <input type="hidden" name="builder_checkout" id="builder_checkout_input" value="0">
        <input type="hidden" id="total_steps" value="<?php echo $total_steps; ?>">
        
        <!-- Edit mode hidden fields -->
        <?php if ($edit_mode): ?>
        <input type="hidden" name="edit_mode" id="edit_mode_field" value="1">
        <input type="hidden" name="cart_item_key" id="cart_item_key_field" value="<?php echo esc_js($edit_cart_item); ?>">
        <?php endif; ?>
        
        <?php wp_nonce_field('door_builder_action', 'builder_nonce'); ?>

        <!-- Include all steps -->
        <?php include get_stylesheet_directory() . '/template-parts/builder/step-1.php'; ?>
        <?php include get_stylesheet_directory() . '/template-parts/builder/step-2.php'; ?>
        <?php include get_stylesheet_directory() . '/template-parts/builder/step-3.php'; ?>
        <?php include get_stylesheet_directory() . '/template-parts/builder/step-4.php'; ?>
        <?php include get_stylesheet_directory() . '/template-parts/builder/step-5.php'; ?>
        <?php include get_stylesheet_directory() . '/template-parts/builder/step-6.php'; ?>
        <?php include get_stylesheet_directory() . '/template-parts/builder/step-7.php'; ?>
        <?php include get_stylesheet_directory() . '/template-parts/builder/step-8.php'; ?>
        <?php include get_stylesheet_directory() . '/template-parts/builder/step-9.php'; ?>
        <?php include get_stylesheet_directory() . '/template-parts/builder/step-10.php'; ?>
        <?php include get_stylesheet_directory() . '/template-parts/builder/step-11.php'; ?>
        <?php include get_stylesheet_directory() . '/template-parts/builder/step-12.php'; ?>
        <?php include get_stylesheet_directory() . '/template-parts/builder/step-13.php'; ?>
        <?php include get_stylesheet_directory() . '/template-parts/builder/step-14.php'; ?>

        <!-- Navigation Bar - Footer logo removed -->
        <div class="builder-nav">
            <div class="nav-container">
                <button type="button" class="nav-btn prev-step" disabled>← PREVIOUS</button>
                <button type="button" class="nav-btn next-step">NEXT →</button>
            </div>
        </div>

    </form>

    <!-- SLIDING DRAWER - Right Side -->
    <div class="drawer-container" id="drawerContainer">
        
        <!-- Drawer Toggle Button (Always Visible) -->
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
        
        <!-- Drawer Content (Slides in/out) -->
        <div class="drawer-content" id="drawerContent">
            
            <!-- Drawer Header -->
            <div class="drawer-header">
                <h3>Your Door Configuration</h3>
                <button class="drawer-close" id="drawerClose">✕</button>
            </div>
            
            <!-- Steps List (will be populated by JS) -->
            <div class="drawer-steps-list" id="drawerStepsList">
                <!-- Steps will be dynamically added here -->
            </div>
            
            <!-- Drawer Footer with Total & Actions -->
            <div class="drawer-footer">
                <div class="drawer-total">
                    <span class="total-label">Total Price:</span>
                    <span class="total-price" id="drawer-footer-total">£<?php echo number_format($base_price, 2); ?></span>
                </div>
                
                <!-- Edit Mode Indicator -->
                <div class="drawer-edit-mode" id="drawerEditMode" style="display: <?php echo $edit_mode ? 'block' : 'none'; ?>;">
                    Editing cart item <?php echo $edit_mode ? ' - ' . esc_html($edit_cart_item) : ''; ?>
                </div>
            </div>
            
        </div>
    </div>

</div>

<?php wp_footer(); ?>

<script>
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