<?php
/**
 * Template part for Glass Selection Step in Window Builder
 * Step 7: Glass & Upgrades
 * 
 * @package Astra Child
 */

// Get images directory
$images_dir = get_stylesheet_directory_uri() . '/assets/images/bifolding-windows/';
?>

<!-- Step 7: Glass & Upgrades -->
<div class="wizard-step" data-step="7">
    <div class="step-container">

        <div class="step-title">
            <h2>Glass & Upgrades</h2>
            <p>Choose your glass options and upgrades. Standard double glazing 4/16/4 with argon gas fill is included.</p>
        </div>
        
        <div class="options-container">
            <div class="option-group">                
                <div class="glass-options">

                    <!-- Self-cleaning glass -->
                    <div class="glass-option-card">
                        <input type="radio" name="glass_type" id="window_upgrade_self_cleaning" value="self_cleaning" class="price-option" data-price="299">
                        <label for="window_upgrade_self_cleaning">
                            <div class="glass-image">
                                <img src="<?php echo esc_url($images_dir . 'self-cleaning-glass.png'); ?>" alt="Self-cleaning glass" loading="lazy">
                            </div>
                            <div class="glass-details">
                                <div class="glass-text-content">
                                    <span class="option-name">Self-cleaning glass</span>
                                    <span class="option-price">+£299 <span class="price-vat">(inc. VAT)</span></span>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Integral blinds -->
                    <div class="glass-option-card">
                        <input type="radio" name="glass_type" id="window_upgrade_integral_blinds" value="integral_blinds" class="price-option" data-price="425">
                        <label for="window_upgrade_integral_blinds">
                            <div class="glass-image">
                                <img src="<?php echo esc_url($images_dir . 'integral-blinds.png'); ?>" alt="Integral blinds" loading="lazy">
                            </div>
                            <div class="glass-details">
                                <div class="glass-text-content">
                                    <span class="option-name">Integral blinds</span>
                                    <span class="option-price">£425 <span class="price-vat">(inc. VAT)</span></span>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Obscure glass -->
                    <div class="glass-option-card">
                        <input type="radio" name="glass_type" id="window_upgrade_obscure_glass" value="obscure_glass" class="price-option" data-price="199">
                        <label for="window_upgrade_obscure_glass">
                            <div class="glass-image">
                                <img src="<?php echo esc_url($images_dir . 'obscure-glass.png'); ?>" alt="Obscure glass" loading="lazy">
                            </div>
                            <div class="glass-details">
                                <div class="glass-text-content">
                                    <span class="option-name">Obscure glass</span>
                                    <span class="option-price">+£199 <span class="price-vat">(inc. VAT)</span></span>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Saint-Gobain Planitherm 1.2 U-value upgrade -->
                    <div class="glass-option-card">
                        <input type="radio" name="glass_type" id="window_upgrade_saint_gobain" value="saint_gobain_12" class="price-option" data-price="399">
                        <label for="window_upgrade_saint_gobain">
                            <div class="glass-image">
                                <img src="<?php echo esc_url($images_dir . 'saint-gobain-planitherm.png'); ?>" alt="Saint-Gobain Planitherm 1.2" loading="lazy">
                            </div>
                            <div class="glass-details">
                                <div class="glass-text-content">
                                    <span class="option-name">Saint-Gobain Planitherm 1.2 U-value upgrade</span>
                                    <span class="option-price">+£399 <span class="price-vat">(inc. VAT)</span></span>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- No Thanks Option (Standard Glass) -->
                    <div class="glass-option-card no-thanks-card">
                        <input type="radio" name="glass_type" id="window_upgrade_no_thanks" value="standard" class="price-option" data-price="0" checked>
                        <label for="window_upgrade_no_thanks">
                            <div class="glass-image no-thanks-image">
                                <div class="no-thanks-placeholder">
                                    <span class="no-thanks-icon">✗</span>
                                </div>
                            </div>
                            <div class="glass-details">
                                <div class="glass-text-content">
                                    <span class="option-name">No Thanks - Standard Glass</span>
                                    <span class="option-price">£0</span>
                                </div>
                            </div>
                        </label>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<script>
jQuery(document).ready(function($) {
    
    // Development logging
    window.isDev = function() {
        return window.location.hostname === 'localhost' || 
               window.location.hostname === '127.0.0.1';
    };
    
    /**
     * Handle radio button changes
     */
    $('.glass-option-card input[type="radio"]').on('change', function() {
        // Remove selected class from all cards
        $('.glass-option-card').removeClass('selected');
        
        // Add selected class to parent card
        $(this).closest('.glass-option-card').addClass('selected');
        
        // Log selection
        if (window.isDev()) {
            console.log('Glass type selected:', $(this).val());
            var price = parseFloat($(this).data('price'));
            console.log('Glass price: £' + price);
        }
        
        // Trigger price update
        if (typeof window.updatePrice === 'function') {
            window.updatePrice();
        }
        
        // Update drawer if function exists
        if (typeof window.updateDrawer === 'function') {
            window.updateDrawer();
        }
    });
    
    /**
     * Handle card click for better UX
     */
    $('.glass-option-card').on('click', function(e) {
        // Don't trigger if clicking directly on radio
        if ($(e.target).is('input[type="radio"]')) {
            return;
        }
        
        // Find and check the radio
        const $radio = $(this).find('input[type="radio"]');
        $radio.prop('checked', true).trigger('change');
    });
    
    // Set initial selected class (No Thanks is checked by default)
    $('#window_upgrade_no_thanks').closest('.glass-option-card').addClass('selected');
    
    if (window.isDev()) {
        console.log('Step 7 (Glass) initialized for Window Builder');
    }
});
</script>

<style>
/* ================================
   Glass Selection Styles - Window Builder
   (Exactly matching Door Builder)
   ================================ */

/* Container alignment */
.step-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Step title */
.step-title {
    text-align: left;
    margin-bottom: 30px;
}

.step-title h2 {
    font-size: 28px;
    color: #222;
    font-weight: 600;
    margin: 0 0 10px 0;
    line-height: 1.3;
}

.step-title p {
    font-size: 16px;
    color: #666;
    margin: 0;
    line-height: 1.5;
    max-width: 800px;
}

/* Glass Options Container - 5 cards in one line */
.glass-options {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 20px;
    margin-top: 30px;
    max-width: 1400px;
    margin-left: auto;
    margin-right: auto;
}

/* Glass Option Card */
.glass-option-card {
    border: 1px solid #e0e0e0;
    overflow: hidden;
    transition: all 0.25s ease;
    cursor: pointer;
    height: 100%;
    background: #fff;
    position: relative;
    width: 100%;
    display: flex;
    flex-direction: column;
}

.glass-option-card:hover {
    border-color: #9c7b4b;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Hide default radio input */
.glass-option-card input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

/* Label styling - full height */
.glass-option-card label {
    display: flex;
    flex-direction: column;
    height: 100%;
    cursor: pointer;
    background: transparent;
    margin: 0;
    padding: 0;
    width: 100%;
    flex: 1;
}

/* Selected state - Card border */
.glass-option-card input:checked + label {
    border: 2px solid #9c7b4b;
    margin: -1px;
}

/* Glass image container */
.glass-image {
    width: 100%;
    height: 180px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f5f5f5;
    padding: 15px;
    border-bottom: 1px solid #f0f0f0;
    flex-shrink: 0;
}

.glass-image img {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    object-fit: contain;
}

/* No Thanks special styling */
.no-thanks-card .glass-image {
    background: #f0f0f0;
}

.no-thanks-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e0e0e0;
    border-radius: 8px;
}

.no-thanks-icon {
    font-size: 48px;
    color: #999;
    font-weight: 300;
}

/* Glass details */
.glass-details {
    padding: 15px;
    background: #fafafa;
    min-height: 70px;
    flex-shrink: 0;
}

.glass-text-content {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    width: 100%;
}

.glass-details .option-name {
    font-weight: 500;
    color: #333;
    display: inline-block;
    text-align: left;
    line-height: 1.3;
    font-size: 13px;
    margin-bottom: 5px;
    padding-left: 24px;
    position: relative;
}

/* Radio indicator */
.glass-details .option-name::before {
    content: "";
    display: inline-block;
    width: 14px;
    height: 14px;
    border: 1.5px solid #222;
    border-radius: 50%;
    margin-right: 10px;
    vertical-align: middle;
    transition: all 0.2s ease;
    box-sizing: border-box;
    flex-shrink: 0;
    position: absolute;
    left: 0;
    top: 2px;
}

/* Option price styling */
.glass-details .option-price {
    font-weight: 600;
    color: #222;
    display: block;
    text-align: left;
    line-height: 1.3;
    font-size: 13px;
    margin-left: 24px;
    display: inline-flex;
    align-items: baseline;
    gap: 2px;
}

/* No Thanks price styling */
.no-thanks-card .option-price {
    color: #4caf50;
}

/* Selected state for radio */
.glass-option-card input:checked + label .glass-details .option-name::before {
    background: #222;
    box-shadow: inset 0 0 0 3px #fafafa;
    border-color: #222;
}

/* Hover effect for radio */
.glass-option-card:hover .glass-details .option-name::before {
    border-color: #9c7b4b;
}

/* Selected card hover state */
.glass-option-card input:checked + label:hover .glass-details .option-name::before {
    border-color: #222;
    background: #222;
    box-shadow: inset 0 0 0 3px #fafafa;
}

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

/* ================================
   Responsive Design
   ================================ */

/* Large Desktop */
@media (min-width: 1400px) {
    .glass-options {
        gap: 25px;
    }
    .glass-image {
        height: 180px;
    }
    .price-vat {
        font-size: 11px;
    }
}

/* Desktop */
@media (min-width: 1025px) and (max-width: 1399px) {
    .glass-options {
        grid-template-columns: repeat(5, 1fr);
        gap: 15px;
    }
    .glass-image {
        height: 160px;
    }
}

/* Small Desktop / Large Tablet */
@media (min-width: 993px) and (max-width: 1024px) {
    .glass-options {
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
    .glass-image {
        height: 160px;
    }
    .price-vat {
        font-size: 9px;
    }
}

/* Tablet */
@media (min-width: 769px) and (max-width: 992px) {
    .glass-options {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    .glass-image {
        height: 160px;
    }
    .price-vat {
        font-size: 9px;
    }
}

/* Mobile */
@media (max-width: 768px) {
    .glass-options {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    .glass-image {
        height: 140px;
    }
    .price-vat {
        font-size: 8px;
    }
}

/* Small mobile */
@media (max-width: 480px) {
    .glass-image {
        height: 120px;
    }
    .price-vat {
        font-size: 7px;
    }
}
</style>