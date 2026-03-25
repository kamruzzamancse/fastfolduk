<?php
/**
 * Template Name: Bifold Door Builder
 *
 * @package Astra Child
 */

// Get product details from URL
$product_id   = isset($_GET['product_id']) ? absint($_GET['product_id']) : 0;
$variation_id = isset($_GET['variation_id']) ? absint($_GET['variation_id']) : 0;

// Get product price
$base_price = 0;
if ($variation_id) {
    $variation = wc_get_product($variation_id);
    if ($variation) {
        $base_price = $variation->get_price();
    }
}

// Start output without theme header/footer
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design Your Bifold Door</title>
    
    <!-- Load WordPress scripts -->
    <?php wp_head(); ?>
</head>
<body class="bifold-builder-page">
    <?php
    // Load the builder content directly
    include get_stylesheet_directory() . '/template-parts/page-bifold-door-builder.php';
    ?>
    
    <?php wp_footer(); ?>
</body>
</html>