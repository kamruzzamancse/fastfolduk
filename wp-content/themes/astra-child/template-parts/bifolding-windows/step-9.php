<?php
/**
 * Template part for Cill Selection Step in Window Builder
 * Step 9: Do you require a cill?
 *
 * @package Astra Child
 */
$images_dir = get_stylesheet_directory_uri() . '/assets/images/bifolding-windows/';
$placeholder = $images_dir . 'placeholder_threshold.webp';
?>

<!-- Step 9: Cill Selection -->
<div class="wizard-step" data-step="9">
    <div class="step-container cill-container">
        <div class="step-title cill-title">
            <h2>Do you require a cill?</h2>
            <p class="cill-description">Please choose below for your window</p>
        </div>
       
        <div class="cill-wrapper">
            <div class="cill-options">
               
                <!-- 150mm Aluminium Cill -->
                <div class="cill-card" data-price="0">
                    <input type="radio" name="cill" id="150mm_aluminium_cill" value="150mm-aluminium-cill" class="price-option" data-price="0">
                    <label for="150mm_aluminium_cill">
                        <div class="cill-image">
                            <img src="<?php echo esc_url($images_dir . '150mm-upvc-cill.png'); ?>"
                                alt="150mm Aluminium Cill for Window"
                                loading="lazy"
                                onerror="this.src='<?php echo esc_url($placeholder); ?>'">
                        </div>
                        <div class="cill-details">
                            <div class="cill-text-content">
                                <span class="cill-radio-indicator"></span>
                                <span class="option-name">150mm Aluminium Cill</span>
                            </div>
                        </div>
                    </label>
                </div>

                <!-- 150mm uPVC Cill -->
                <div class="cill-card" data-price="0">
                    <input type="radio" name="cill" id="150mm_upvc_cill" value="150mm-upvc-cill" class="price-option" data-price="0">
                    <label for="150mm_upvc_cill">
                        <div class="cill-image">
                            <img src="<?php echo esc_url($images_dir . '82mm-cill.png'); ?>"
                                alt="150mm uPVC Cill for Window"
                                loading="lazy"
                                onerror="this.src='<?php echo esc_url($placeholder); ?>'">
                        </div>
                        <div class="cill-details">
                            <div class="cill-text-content">
                                <span class="cill-radio-indicator"></span>
                                <span class="option-name">150mm uPVC Cill</span>
                            </div>
                        </div>
                    </label>
                </div>
               
                <!-- No Cill -->
                <div class="cill-card no-cill-card" data-price="0">
                    <input type="radio" name="cill" id="cill_none" value="none" class="price-option" data-price="0" checked>
                    <label for="cill_none">
                        <div class="cill-image">
                            <img src="<?php echo esc_url($images_dir . '150mm-aluminium-cill.png'); ?>"
                                 alt="No Cill for Window"
                                 loading="lazy"
                                 onerror="this.src='<?php echo esc_url($placeholder); ?>'">
                        </div>
                        <div class="cill-details">
                            <div class="cill-text-content">
                                <span class="cill-radio-indicator"></span>
                                <span class="option-name">No Cill</span>
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
   Cill Selection Styles - FULLY RESPONSIVE
   FIXED: 50px space below last card
   ================================ */

.cill-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
    padding-bottom: 100px; /* Space for footer */
}

/* Title styling */
.cill-title {
    text-align: left;
    margin-bottom: 30px;
}

.cill-title h2 {
    font-size: 28px;
    color: #1a1a1a;
    font-weight: 600;
    margin: 0 0 10px 0;
    line-height: 1.3;
}

.cill-description {
    font-size: 16px;
    color: #666;
    margin: 0;
    line-height: 1.5;
    max-width: 800px;
}

/* ===== GRID CONTAINER - 4 CARDS IN DESKTOP ===== */
.cill-options {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    margin-top: 30px;
    max-width: 1360px;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 50px; /* 50px space below grid */
}

/* ===== CARD STYLING ===== */
.cill-card {
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

.cill-card:hover {
    border-color: #2e7d32;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* No Cill card - same as others */
.no-cill-card {
    max-width: 100%;
    width: 100%;
}

/* Hide default radio */
.cill-card input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

/* Label styling */
.cill-card label {
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

/* Selected state for card */
.cill-card input:checked + label {
    border: 2px solid #2e7d32;
    margin: -1px;
}

/* ===== IMAGE CONTAINER ===== */
.cill-image {
    width: 100%;
    height: 210px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f5f5f5;
    padding: 20px;
    border-bottom: 1px solid #f0f0f0;
    flex-shrink: 0;
}

.cill-image img {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    object-fit: contain;
    display: block;
}

/* ===== DETAILS CONTAINER ===== */
.cill-details {
    padding: 15px;
    background: #fafafa;
    min-height: 70px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
}

/* Text content container */
.cill-text-content {
    display: flex;
    align-items: center;
    width: 100%;
    gap: 8px;
}

/* ===== RADIO INDICATOR ===== */
.cill-radio-indicator {
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
.cill-card input:checked + label .cill-radio-indicator {
    background: #222;
    box-shadow: inset 0 0 0 3px #fafafa;
    border-color: #222;
}

/* Hover effect */
.cill-card:hover .cill-radio-indicator {
    border-color: #2e7d32;
}

/* Option name */
.option-name {
    font-weight: 500;
    color: #333;
    display: inline-block;
    text-align: left;
    line-height: 1.3;
    font-size: 14px;
    flex: 1;
}

/* No Cill card specific */
.no-cill-card .cill-image {
    background: #f0f0f0;
}

/* ===== FOOTER FIX ===== */
.window-builder-form {
    padding-bottom: 0px !important;
}

.builder-nav {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    background: #0a0a0a;
    min-height: 80px;
}

/* ===== RESPONSIVE STYLES ===== */

/* Large Desktop (1400px+) */
@media (min-width: 1400px) {
    .cill-options {
        gap: 30px;
        max-width: 1360px;
    }
    
    .cill-image {
        height: 230px;
    }
    
    .cill-radio-indicator {
        width: 16px;
        height: 16px;
        border-width: 2px;
    }
    
    .option-name {
        font-size: 15px;
    }
}

/* Desktop (1025px - 1399px) */
@media (min-width: 1025px) and (max-width: 1399px) {
    .cill-options {
        gap: 25px;
        max-width: 1100px;
    }
    
    .cill-image {
        height: 200px;
        padding: 18px;
    }
    
    .option-name {
        font-size: 14px;
    }
}

/* Small Desktop / Large Tablet (993px - 1024px) */
@media (min-width: 993px) and (max-width: 1024px) {
    .cill-options {
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        padding: 0 20px;
        max-width: 100%;
    }
    
    .cill-image {
        height: 170px;
        padding: 15px;
    }
    
    .cill-radio-indicator {
        width: 14px;
        height: 14px;
    }
    
    .option-name {
        font-size: 13px;
    }
}

/* Tablet (769px - 992px) - 2 columns */
@media (min-width: 769px) and (max-width: 992px) {
    .cill-options {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        padding: 0 20px;
        max-width: 100%;
        margin-bottom: 50px;
    }
    
    .cill-image {
        height: 180px;
        padding: 15px;
    }
    
    .cill-details {
        min-height: 65px;
        padding: 12px;
    }
    
    .cill-radio-indicator {
        width: 14px;
        height: 14px;
    }
    
    .option-name {
        font-size: 14px;
    }
}

/* ===== MOBILE (max-width: 768px) ===== */
@media (max-width: 768px) {
    .cill-container {
        padding: 15px;
        padding-bottom: 120px; /* Space for footer */
    }
    
    .cill-title h2 {
        font-size: 24px;
        padding: 0;
    }
    
    .cill-description {
        font-size: 14px;
        padding: 0;
    }
    
    /* 1 column on mobile */
    .cill-options {
        grid-template-columns: 1fr;
        gap: 20px;
        padding: 0;
        max-width: 100%;
        margin-bottom: 50px; /* 50px space below grid */
    }
    
    /* Each card full width */
    .cill-card {
        width: 100%;
        height: auto;
    }
    
    /* Last card gets 0 margin bottom - only grid margin provides space */
    .cill-card:last-child {
        margin-bottom: 0;
    }
    
    .cill-image {
        height: 180px !important;
        padding: 15px;
    }
    
    .cill-details {
        padding: 15px;
        min-height: 70px;
    }
    
    .cill-text-content {
        gap: 10px;
    }
    
    .cill-radio-indicator {
        width: 16px;
        height: 16px;
        border-width: 2px;
    }
    
    .cill-card input:checked + label .cill-radio-indicator {
        box-shadow: inset 0 0 0 4px #fafafa;
    }
    
    .option-name {
        font-size: 15px;
    }
}

/* Small Mobile (max-width: 480px) */
@media (max-width: 480px) {
    .cill-container {
        padding-bottom: 120px;
    }
    
    .cill-options {
        margin-bottom: 50px; /* Keep 50px space */
        gap: 15px;
    }
    
    .cill-image {
        height: 160px !important;
        padding: 12px;
    }
    
    .cill-details {
        padding: 12px;
        min-height: 65px;
    }
    
    .cill-text-content {
        gap: 8px;
    }
    
    .cill-radio-indicator {
        width: 14px;
        height: 14px;
    }
    
    .cill-card input:checked + label .cill-radio-indicator {
        box-shadow: inset 0 0 0 3px #fafafa;
    }
    
    .option-name {
        font-size: 14px;
    }
}

/* Extra Small Mobile (max-width: 360px) */
@media (max-width: 360px) {
    .cill-image {
        height: 140px !important;
        padding: 10px;
    }
    
    .cill-details {
        padding: 10px;
        min-height: 60px;
    }
    
    .cill-radio-indicator {
        width: 12px;
        height: 12px;
    }
    
    .option-name {
        font-size: 13px;
    }
}

/* Very Small Mobile (max-width: 320px) */
@media (max-width: 320px) {
    .cill-image {
        height: 120px !important;
    }
    
    .cill-text-content {
        flex-wrap: wrap;
    }
    
    .cill-radio-indicator {
        margin-bottom: 5px;
    }
    
    .option-name {
        width: 100%;
        margin-left: 0;
    }
}

/* Loading state for images */
.cill-image img[loading="lazy"] {
    transition: opacity 0.3s;
}

.cill-image img.loaded {
    opacity: 1;
}
</style>

<script>
jQuery(document).ready(function($) {

    /**
     * Handle radio change
     */
    $('.cill-card input[type="radio"]').on('change', function() {

        $('.cill-card').removeClass('selected');

        $(this).closest('.cill-card').addClass('selected');

        console.log('Cill selected:', $(this).val());

        // Trigger price update if needed
        if (typeof updatePrice === 'function') {
            updatePrice();
        }
        
        // Update drawer if function exists
        if (typeof updateDrawer === 'function') {
            updateDrawer();
        }
    });

    /**
     * Set initial selection
     */
    $('.cill-card input[type="radio"]:checked').each(function() {
        $(this).closest('.cill-card').addClass('selected');
    });

    /**
     * Card click support
     */
    $('.cill-card').on('click', function(e) {

        if ($(e.target).is('input')) return;

        const radio = $(this).find('input[type="radio"]');

        radio.prop('checked', true).trigger('change');

    });

});
</script>