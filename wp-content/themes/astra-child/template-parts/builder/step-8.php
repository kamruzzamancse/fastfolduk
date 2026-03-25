<?php
/**
 * Template part for Trickle Vents Selection Step in Door Builder
 * Step 8: Trickle Vents Selection
 * 
 * @package Astra Child
 */

// Get images directory
$images_dir = get_stylesheet_directory_uri() . '/assets/images/bifold-doors/';
?>

<!-- Preload Trickle Vent Images for Faster Display -->
<link rel="preload" as="image" href="<?php echo esc_url($images_dir . 'Union_500x.png'); ?>">
<link rel="preload" as="image" href="<?php echo esc_url($images_dir . 'Cross_500x.webp'); ?>">

<!-- Step 8: Trickle Vents Selection -->
<div class="wizard-step" data-step="8">
    <div class="step-container trickle-vents-container">

        <div class="step-title trickle-vents-title">
            <h2>Do you need trickle vents on your door?</h2>
            <p class="trickle-vents-description">Trickle vents allow for adequate ventilation of a room. If unsure, please select yes and we will advise you.</p>
        </div>
        
        <div class="trickle-vents-wrapper">
            <div class="trickle-vents-options">
                
                <!-- Yes, Add Trickle Vent Option - WITH PRICE -->
                <div class="trickle-vent-card" data-price="85">
                    <input type="radio" name="trickle_vents" id="trickle_yes" value="yes_trickle" class="price-option" data-price="85" data-per-order="true">
                    <label for="trickle_yes">
                        <div class="trickle-vent-image">
                            <img src="<?php echo esc_url($images_dir . 'Union_500x.png'); ?>" 
                                 alt="Door with Trickle Vent" 
                                 width="800"
                                 height="600"
                                 loading="eager"
                                 decoding="async">
                        </div>
                        <div class="trickle-vent-details">
                            <div class="trickle-vent-text-content">
                                <div class="trickle-vent-name-line">
                                    <span class="trickle-vent-radio-indicator"></span>
                                    <span class="option-name">Yes, Add Trickle Vent</span>
                                    <span class="option-price">+£85 <span class="price-vat">(inc. VAT)</span></span>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
                
                <!-- No, Continue Without Option - FREE -->
                <div class="trickle-vent-card" data-price="0">
                    <input type="radio" name="trickle_vents" id="trickle_no" value="no_trickle" class="price-option" data-price="0" checked>
                    <label for="trickle_no">
                        <div class="trickle-vent-image">
                            <img src="<?php echo esc_url($images_dir . 'Cross_500x.webp'); ?>" 
                                 alt="Door without Trickle Vent" 
                                 width="800"
                                 height="600"
                                 loading="eager"
                                 decoding="async">
                        </div>
                        <div class="trickle-vent-details">
                            <div class="trickle-vent-text-content">
                                <div class="trickle-vent-name-line">
                                    <span class="trickle-vent-radio-indicator"></span>
                                    <span class="option-name">No, Continue Without</span>
                                    <span class="option-price">Free</span>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
                
            </div>
        </div>

    </div>
</div>

<style>
/* ================================
   Trickle Vents Selection Styles
   FULLY RESPONSIVE - FIXED FOR MOBILE
   ================================ */

/* VAT text styling */
.price-vat {
    font-size: 10px;
    font-weight: 400;
    color: #666;
    margin-left: 2px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    vertical-align: super;
    white-space: nowrap;
}

.trickle-vents-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
    padding-bottom: 120px; /* Add padding to prevent footer overlap */
}

.trickle-vents-description {
    font-size: 16px;
    color: #666;
    margin: 0;
    line-height: 1.5;
    max-width: 800px;
}

/* Options grid - 2 cards in a row */
.trickle-vents-options {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
    margin-top: 30px;
    max-width: 1360px !important;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 40px; /* Add bottom margin */
}

/* Individual card styling */
.trickle-vent-card {
    border: 1px solid #e0e0e0;
    overflow: hidden;
    transition: all 0.25s ease;
    cursor: pointer;
    height: 100%;
    background: #fff;
    display: flex;
    flex-direction: column;
}

.trickle-vent-card:hover {
    border-color: #2e7d32;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Hide radio input */
.trickle-vent-card input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.trickle-vent-card label {
    display: flex;
    flex-direction: column;
    height: 100%;
    cursor: pointer;
    background: transparent;
    flex: 1;
}

.trickle-vent-card input:checked + label {
    border: 2px solid #2e7d32;
    margin: -1px;
}

/* Image container */
.trickle-vent-image {
    height: 280px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f5f5f5;
    padding: 25px;
    flex-shrink: 0;
}

.trickle-vent-image img {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    object-fit: contain;
    display: block;
}

/* Details container */
.trickle-vent-details {
    padding: 15px;
    border-top: 1px solid #f0f0f0;
    background: #fafafa;
    min-height: 70px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
}

/* Text content container */
.trickle-vent-text-content {
    display: flex;
    flex-direction: column;
    width: 100%;
}

/* Name line with radio indicator */
.trickle-vent-name-line {
    display: flex;
    align-items: center;
    margin-bottom: 0;
    width: 100%;
    gap: 8px;
    flex-wrap: wrap;
}

/* Radio indicator */
.trickle-vent-radio-indicator {
    display: inline-block;
    width: 14px;
    height: 14px;
    border: 1.5px solid #222;
    border-radius: 50%;
    transition: all 0.2s ease;
    box-sizing: border-box;
    flex-shrink: 0;
}

/* Selected state for radio indicator */
.trickle-vent-card input:checked + label .trickle-vent-radio-indicator {
    background: #222;
    box-shadow: inset 0 0 0 3px #fafafa;
    border-color: #222;
}

/* Hover effect for radio indicator */
.trickle-vent-card:hover .trickle-vent-radio-indicator {
    border-color: #2e7d32;
}

/* Selected card hover state */
.trickle-vent-card input:checked + label:hover .trickle-vent-radio-indicator {
    border-color: #222;
    background: #222;
    box-shadow: inset 0 0 0 3px #fafafa;
}

/* Option name styling */
.option-name {
    font-weight: 500;
    color: #333;
    display: inline-block;
    text-align: left;
    line-height: 1.3;
    font-size: 14px;
    flex: 1;
}

/* Option price styling */
.option-price {
    font-weight: 600;
    color: #222;
    display: inline-flex;
    align-items: baseline;
    gap: 2px;
    margin-left: auto;
    white-space: nowrap;
}

/* No option price styling - Free text in green */
#trickle_no:checked + label .option-price {
    color: #2e7d32;
    font-weight: 600;
}

/* Ensure "Free" text is always visible */
.trickle-vent-card:has(#trickle_no) .option-price {
    color: #2e7d32;
}

/* ================================
   FIX FOR FOOTER OVERLAP ISSUE
   ================================ */
.door-builder-form {
    padding-bottom: 0px !important; /* Add space for footer */
}

.builder-nav {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    background: #0a0a0a;
}

/* ================================
   RESPONSIVE DESIGN - FIXED FOR MOBILE
   ================================ */

/* Large Desktop (1400px+) */
@media (min-width: 1400px) {
    .trickle-vents-options {
        gap: 30px;
        max-width: 1000px;
    }
    
    .trickle-vent-image {
        height: 300px;
    }
    
    .option-name {
        font-size: 16px;
    }
    
    .option-price {
        font-size: 16px;
    }
    
    .price-vat {
        font-size: 11px;
    }
}

/* Desktop (1025px - 1399px) */
@media (min-width: 1025px) and (max-width: 1399px) {
    .trickle-vents-options {
        gap: 25px;
        max-width: 900px;
    }
    
    .trickle-vent-image {
        height: 260px;
    }
    
    .option-name {
        font-size: 15px;
    }
}

/* Tablet (769px - 1024px) */
@media (min-width: 769px) and (max-width: 1024px) {
    .trickle-vents-options {
        gap: 20px;
        padding: 0 20px;
        max-width: 100%;
    }
    
    .trickle-vent-image {
        height: 220px;
        padding: 20px;
    }
    
    .trickle-vent-details {
        padding: 12px;
        min-height: 65px;
    }
    
    .option-name {
        font-size: 14px;
    }
    
    .option-price {
        font-size: 14px;
    }
    
    .trickle-vent-radio-indicator {
        width: 14px;
        height: 14px;
    }
}

/* ===== MOBILE FIXES (max-width: 768px) ===== */
@media (max-width: 768px) {
    .trickle-vents-container {
        padding: 15px;
    }
    
    .trickle-vents-description {
        font-size: 14px;
        padding: 0;
    }
    
    /* Stack cards vertically */
    .trickle-vents-options {
        grid-template-columns: 1fr;
        gap: 25px;
        padding: 0;
        max-width: 100%;
        margin-bottom: 100px; /* Large bottom margin for footer */
    }
    
    /* Make both cards same height and fully visible */
    .trickle-vent-card {
        width: 100%;
        margin-bottom: 0;
    }
    
    /* Fix image height for mobile */
    .trickle-vent-image {
        height: 200px;
        padding: 15px;
    }
    
    .trickle-vent-image img {
        max-height: 170px;
    }
    
    /* Details section - ensure it's fully visible */
    .trickle-vent-details {
        padding: 15px;
        min-height: 80px;
        display: flex;
        align-items: center;
    }
    
    /* Name line - ensure everything fits */
    .trickle-vent-name-line {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: nowrap;
    }
    
    /* Radio indicator */
    .trickle-vent-radio-indicator {
        width: 16px;
        height: 16px;
        border-width: 2px;
        flex-shrink: 0;
    }
    
    .trickle-vent-card input:checked + label .trickle-vent-radio-indicator {
        box-shadow: inset 0 0 0 4px #fafafa;
    }
    
    /* Option name */
    .option-name {
        font-size: 14px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        flex: 1;
    }
    
    /* Option price - always visible */
    .option-price {
        font-size: 14px;
        margin-left: auto;
        white-space: nowrap;
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
    }
    
    /* "Free" text styling */
    .trickle-vent-card:has(#trickle_no) .option-price {
        color: #2e7d32;
        font-weight: 600;
    }
    
    /* VAT text */
    .price-vat {
        font-size: 9px;
    }
    
    /* Force full visibility of second card */
    .trickle-vents-options .trickle-vent-card:last-child {
        margin-bottom: 50px; /* Ensure last card is fully visible */
    }
}

/* Small Mobile (max-width: 480px) */
@media (max-width: 480px) {
    /* .trickle-vents-container {
        padding-bottom: 170px;
    } */
    
    .trickle-vents-options {
        gap: 20px;
        margin-bottom: 120px;
    }
    
    .trickle-vent-image {
        height: 160px;
        padding: 12px;
    }
    
    .trickle-vent-image img {
        max-height: 140px;
    }
    
    .trickle-vent-details {
        padding: 12px;
        min-height: 70px;
    }
    
    .trickle-vent-name-line {
        gap: 8px;
    }
    
    .trickle-vent-radio-indicator {
        width: 14px;
        height: 14px;
    }
    
    .trickle-vent-card input:checked + label .trickle-vent-radio-indicator {
        box-shadow: inset 0 0 0 3px #fafafa;
    }
    
    .option-name {
        font-size: 13px;
    }
    
    .option-price {
        font-size: 13px;
    }
    
    .price-vat {
        font-size: 8px;
    }
}

/* Extra Small Mobile (max-width: 360px) */
@media (max-width: 360px) {
    .trickle-vents-container {
        padding-bottom: 190px;
    }
    
    .trickle-vents-options {
        margin-bottom: 140px;
    }
    
    .trickle-vent-image {
        height: 140px;
        padding: 10px;
    }
    
    .trickle-vent-image img {
        max-height: 120px;
    }
    
    .trickle-vent-details {
        padding: 10px;
        min-height: 65px;
    }
    
    .trickle-vent-name-line {
        gap: 6px;
    }
    
    .trickle-vent-radio-indicator {
        width: 12px;
        height: 12px;
    }
    
    .option-name {
        font-size: 12px;
    }
    
    .option-price {
        font-size: 12px;
    }
    
    .price-vat {
        font-size: 7px;
    }
}

/* Fix for very small devices */
@media (max-width: 320px) {
    .trickle-vents-container {
        padding-bottom: 200px;
    }
    
    .trickle-vent-image {
        height: 120px;
    }
    
    .trickle-vent-name-line {
        flex-wrap: wrap;
    }
    
    .option-price {
        margin-left: 22px;
        width: 100%;
    }
    
    .trickle-vents-options .trickle-vent-card:last-child {
        margin-bottom: 80px;
    }
}

/* Ensure images load properly */
.trickle-vent-image img {
    image-rendering: -webkit-optimize-contrast;
    image-rendering: crisp-edges;
}

/* Loading state for images */
.trickle-vent-image img[loading="lazy"] {
    opacity: 0;
    transition: opacity 0.3s;
}

.trickle-vent-image img[loading="lazy"].loaded {
    opacity: 1;
}
</style>

<script>
jQuery(document).ready(function($) {
    // Add selected state styling when radio is checked
    $('.trickle-vent-card input[type="radio"]').on('change', function() {
        // Remove selected styling from all cards
        $('.trickle-vent-card').removeClass('selected').css({
            'border-color': '#e0e0e0',
            'background': '#fff'
        });
        
        // Add selected styling to the checked card
        $(this).closest('.trickle-vent-card').addClass('selected').css({
            'border-color': '#9c7b4b',
            'background': '#fff'
        });
        
        // Trigger price update if needed
        if (typeof updatePrice === 'function') {
            updatePrice();
        }
    });
    
    // Set initial selected state
    $('.trickle-vent-card input[type="radio"]:checked').each(function() {
        $(this).closest('.trickle-vent-card').addClass('selected').css({
            'border-color': '#9c7b4b',
            'background': '#fff'
        });
    });
    
    // Handle card click for better UX
    $('.trickle-vent-card').on('click', function(e) {
        // Don't trigger if clicking on radio directly
        if ($(e.target).is('input[type="radio"]')) {
            return;
        }
        
        // Find the radio inside this card and check it
        const $radio = $(this).find('input[type="radio"]');
        $radio.prop('checked', true).trigger('change');
    });
    
    // Development logging
    if (window.isDev && window.isDev()) {
        console.log('Step 8 (Trickle Vents) initialized with VAT indicator');
    }
});
</script>