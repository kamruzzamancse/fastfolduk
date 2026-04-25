<?php
/**
 * Template part for Order Summary Step in Door Builder
 * Step 14: Your Order Summary - COMPLETE VERSION WITH INSTALLATION TYPE
 *
 * @package Astra Child
 */
?>

<!-- Step 14: Order Summary -->
<div class="wizard-step" data-step="14">
    <div class="step-container summary-container">

        <div class="summary-header">
            <h1 class="summary-title">Aluminium Bifolding Door</h1>
            <div class="summary-price">£<span id="summary-total-price">0.00</span> <span class="price-vat">(inc. VAT)</span></div>
        </div>

        <hr class="summary-divider">

        <div class="summary-section">
            <div class="summary-grid">
                <div class="summary-row"><span class="summary-label">Manufacturing Size (mm):</span><span class="summary-value" id="summary-size">—</span></div>
                <div class="summary-row"><span class="summary-label">Panels:</span><span class="summary-value" id="summary-panels">—</span></div>
                <div class="summary-row"><span class="summary-label">Opening Direction:</span><span class="summary-value" id="summary-opening">—</span></div>
                <div class="summary-row"><span class="summary-label">Outside Colour:</span><span class="summary-value" id="summary-outside-colour">—</span></div>
                <div class="summary-row"><span class="summary-label">Inside Colour:</span><span class="summary-value" id="summary-inside-colour">—</span></div>
                <div class="summary-row"><span class="summary-label">Handle Colour:</span><span class="summary-value" id="summary-handle-colour">—</span></div>
                <div class="summary-row"><span class="summary-label">Glass:</span><span class="summary-value" id="summary-glass">—</span></div>
                <div class="summary-row"><span class="summary-label">Trickle Vents:</span><span class="summary-value" id="summary-trickle-vents">—</span></div>
                <div class="summary-row"><span class="summary-label">Cill:</span><span class="summary-value" id="summary-cill">—</span></div>
                <div class="summary-row"><span class="summary-label">Postcode:</span><span class="summary-value" id="summary-postcode">—</span></div>
                
                <!-- ===== Installation Type Row ===== -->
                <div class="summary-row" id="summary-installation-row">
                    <span class="summary-label">Installation:</span>
                    <span class="summary-value" id="summary-installation">—</span>
                </div>
                
                <div class="summary-row"><span class="summary-label">Access Issues:</span><span class="summary-value" id="summary-access">—</span></div>
                
                <!-- ===== Delivery Row (will be added dynamically) ===== -->
            </div>
        </div>

        <!-- Submit Button -->
        <div class="submit-container">
            <button type="button" class="submit-btn add-to-cart-btn" id="submit-btn">
                ADD TO CART - <span id="submit-price">£0.00</span> <span class="price-vat">(inc. VAT)</span>
            </button>
        </div>

        <!-- Hidden fields -->
        <input type="hidden" name="summary_size" id="summary_size_field" value="">
        <input type="hidden" name="summary_panels" id="summary_panels_field" value="">
        <input type="hidden" name="summary_opening" id="summary_opening_field" value="">
        <input type="hidden" name="summary_outside_colour" id="summary_outside_colour_field" value="">
        <input type="hidden" name="summary_inside_colour" id="summary_inside_colour_field" value="">
        <input type="hidden" name="summary_handle_colour" id="summary_handle_colour_field" value="">
        <input type="hidden" name="summary_glass" id="summary_glass_field" value="">
        <input type="hidden" name="summary_trickle_vents" id="summary_trickle_vents_field" value="">
        <input type="hidden" name="summary_cill" id="summary_cill_field" value="">
        <input type="hidden" name="summary_postcode" id="summary_postcode_field" value="">
        <input type="hidden" name="summary_installation" id="summary_installation_field" value="">
        <input type="hidden" name="summary_access" id="summary_access_field" value="">
        <input type="hidden" name="summary_total_price" id="summary_total_price_field" value="">
    </div>
</div>

<style>
/* ================================
   Order Summary Step Styles
   ================================ */

/* VAT text styling */
.price-vat {
    font-size: 14px;
    font-weight: 400;
    color: #666;
    margin-left: 2px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    vertical-align: middle;
    white-space: nowrap;
}

.wizard-step.active {
    z-index: 1;
    margin-bottom: 40px;
}

.summary-container {
    max-width: 1400px;
    margin: 0 auto;
    background: #133013;
    z-index: 1;
    margin-top: 0;
    padding: 30px;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
    position: relative;
}

/* ===== HEADER SECTION ===== */
.summary-header {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 20px;
}

.summary-title {
    font-size: 32px;
    color: #FFFFFF;
    font-weight: 600;
    margin: 0;
    line-height: 1.3;
    letter-spacing: -0.3px;
}

.summary-price {
    font-size: 28px;
    color: #cbbfa9;
    font-weight: 700;
    background: #f8f5f0;
    padding: 8px 20px;
    border-radius: 40px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.summary-price span {
    color: #1a1a1a;
}

/* ===== DIVIDER ===== */
.summary-divider {
    border: none;
    border-top: 2px solid #eaeaea;
    margin: 25px 0;
}

/* ===== SUMMARY GRID ===== */
.summary-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px 30px;
    max-width: 1000px;
    background: #faf9f7;
    padding: 25px 30px;
    border-radius: 12px;
    border: 1px solid #eaeaea;
    margin-bottom: 20px;
}

/* ===== SUMMARY ROW ===== */
.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    padding: 5px 0;
    border-bottom: 1px dashed #e0e0e0;
}

.summary-row:last-child {
    border-bottom: none;
}

.summary-label {
    font-size: 14px;
    color: #666;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    flex: 0 0 45%;
}

.summary-value {
    font-size: 15px;
    color: #222;
    font-weight: 500;
    text-align: right;
    flex: 0 0 50%;
    word-break: break-word;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    justify-content: flex-end;
}

/* Hover effect on rows */
.summary-row:hover {
    background-color: #f5f5f5;
    margin: 0 -5px;
    padding: 10px 5px;
    border-radius: 4px;
}

/* ===== INSTALLATION ROW ===== */
.summary-row#summary-installation-row {
    border-top: 2px solid #cbbfa9;
    margin-top: 5px;
    padding-top: 10px;
}

.summary-row#summary-installation-row .summary-label {
    color: #333;
    font-weight: 600;
}

/* ===== DELIVERY ROW ===== */
.summary-row#summary-delivery-row {
    border-top: 2px solid #cbbfa9;
    margin-top: 5px;
    padding-top: 15px;
    display: flex !important;
    flex-direction: row !important;
    justify-content: space-between !important;
    align-items: baseline !important;
    width: 100%;
}

.summary-row#summary-delivery-row .summary-label {
    flex: 0 0 45% !important;
    font-size: 14px;
    color: #666;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.summary-row#summary-delivery-row .summary-value {
    flex: 0 0 50% !important;
    font-size: 15px;
    color: #222;
    font-weight: 500;
    text-align: right !important;
    word-break: break-word;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    justify-content: flex-end !important;
    white-space: normal;
    line-height: 1.4;
}

.summary-row#summary-delivery-row .summary-value .price-vat {
    font-size: 10px;
    font-weight: 400;
    color: #666;
    margin-left: 2px;
    vertical-align: baseline;
    white-space: nowrap;
}

.summary-row#summary-delivery-row.bespoke-delivery .summary-value {
    color: #d32f2f;
    font-weight: 600;
}

/* ===== SUBMIT BUTTON ===== */
.submit-container {
    margin-top: 40px;
    text-align: left;
    position: relative;
    z-index: 2;
}

.submit-btn {
    background: #0CBB07;
    color: white;
    border: none;
    padding: 18px 50px;
    font-size: 16px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(203, 191, 169, 0.3);
    min-width: 350px;
    position: relative;
    overflow: hidden;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    margin-bottom: 0;
}

.submit-btn:hover:not(:disabled) {
    background: #0A9E05;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(203, 191, 169, 0.4);
}

.submit-btn:active:not(:disabled) {
    transform: translateY(0);
    box-shadow: 0 4px 15px rgba(203, 191, 169, 0.3);
}

.submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.submit-btn.add-to-cart-btn {
    background: #0CBB07;
}

/* Button loading state */
.submit-btn.loading {
    opacity: 0.8;
    cursor: not-allowed;
}

.submit-btn.loading::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    top: 50%;
    left: 50%;
    margin-left: -10px;
    margin-top: -10px;
    border: 2px solid transparent;
    border-top-color: white;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Loading spinner for button text */
.loading-spinner {
    display: inline-block;
    width: 16px;
    height: 16px;
    border: 2px solid rgba(255,255,255,0.3);
    border-radius: 50%;
    border-top-color: #fff;
    animation: spin 0.8s linear infinite;
    margin-right: 8px;
    vertical-align: middle;
}

/* ===== HIDDEN FIELDS ===== */
input[type="hidden"] {
    display: none;
}

/* ===== NAVIGATION BUTTONS FIX ===== */
.builder-nav {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    background: #133013;
    border-top: 2px solid #2e7d32;
    padding: 12px 20px;
}

/* ===== RESPONSIVE DESIGN ===== */

/* Tablet */
@media (max-width: 1024px) {
    .summary-container {
        padding: 30px 20px 100px 20px;
    }
    
    .summary-title {
        font-size: 28px;
    }
    
    .summary-price {
        font-size: 24px;
        padding: 6px 16px;
    }
    
    .summary-grid {
        grid-template-columns: 1fr;
        gap: 0;
        padding: 20px;
    }
    
    .summary-row {
        padding: 8px 0;
    }
    
    .submit-btn {
        min-width: 300px;
        padding: 16px 40px;
    }
    
    .price-vat {
        font-size: 12px;
    }
}

/* Mobile Landscape */
@media (max-width: 768px) {
    .summary-container {
        padding: 25px 15px 100px 15px;
    }
    
    .summary-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .summary-title {
        font-size: 24px;
    }
    
    .summary-price {
        font-size: 22px;
        padding: 5px 15px;
    }
    
    .summary-grid {
        padding: 15px;
        border-radius: 8px;
    }
    
    .summary-label {
        font-size: 13px;
        flex: 0 0 45%;
    }
    
    .summary-value {
        font-size: 14px;
        flex: 0 0 50%;
    }
    
    .submit-btn {
        min-width: 280px;
        padding: 14px 30px;
        font-size: 15px;
    }
    
    .price-vat {
        font-size: 11px;
    }
    
    /* Installation row mobile fix */
    .summary-row#summary-installation-row {
        flex-direction: row !important;
        padding: 8px 0;
    }
    
    .summary-row#summary-installation-row .summary-label {
        flex: 0 0 45% !important;
        font-size: 13px;
    }
    
    .summary-row#summary-installation-row .summary-value {
        flex: 0 0 50% !important;
        font-size: 14px;
        text-align: right !important;
        justify-content: flex-end !important;
    }
    
    /* Delivery row mobile fix */
    .summary-row#summary-delivery-row {
        flex-direction: row !important;
        padding: 8px 0;
    }
    
    .summary-row#summary-delivery-row .summary-label {
        flex: 0 0 45% !important;
        font-size: 13px;
    }
    
    .summary-row#summary-delivery-row .summary-value {
        flex: 0 0 50% !important;
        font-size: 14px;
        text-align: right !important;
        justify-content: flex-end !important;
    }
}

/* Mobile Portrait */
@media (max-width: 480px) {
    .summary-title {
        font-size: 22px;
    }
    
    .summary-price {
        font-size: 20px;
    }
    
    .summary-grid {
        padding: 12px;
    }
    
    .summary-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
        padding: 10px 0;
    }
    
    .summary-label {
        flex: none;
        width: 100%;
        font-size: 12px;
        margin-bottom: 2px;
    }
    
    .summary-value {
        flex: none;
        width: 100%;
        text-align: left;
        font-size: 13px;
        padding-left: 10px;
        border-left: 2px solid #cbbfa9;
        justify-content: flex-start;
    }
    
    .submit-btn {
        min-width: 100%;
        padding: 14px 20px;
        font-size: 14px;
    }
    
    .price-vat {
        font-size: 10px;
    }
    
    /* Installation row mobile portrait fix */
    .summary-row#summary-installation-row {
        flex-direction: row !important;
        align-items: flex-start !important;
        gap: 5px;
        padding: 10px 0;
    }
    
    .summary-row#summary-installation-row .summary-label {
        flex: 0 0 45% !important;
        font-size: 12px;
        margin-bottom: 0 !important;
    }
    
    .summary-row#summary-installation-row .summary-value {
        flex: 0 0 50% !important;
        font-size: 13px;
        text-align: right !important;
        padding-left: 0 !important;
        border-left: none !important;
        justify-content: flex-end !important;
    }
    
    /* Delivery row mobile portrait fix */
    .summary-row#summary-delivery-row {
        flex-direction: row !important;
        align-items: flex-start !important;
        gap: 5px;
        padding: 10px 0;
    }
    
    .summary-row#summary-delivery-row .summary-label {
        flex: 0 0 45% !important;
        font-size: 12px;
        margin-bottom: 0 !important;
    }
    
    .summary-row#summary-delivery-row .summary-value {
        flex: 0 0 50% !important;
        font-size: 13px;
        text-align: right !important;
        padding-left: 0 !important;
        border-left: none !important;
        justify-content: flex-end !important;
    }
}

/* Extra small mobile */
@media (max-width: 360px) {
    .summary-row#summary-installation-row,
    .summary-row#summary-delivery-row {
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 5px;
    }
    
    .summary-row#summary-installation-row .summary-label,
    .summary-row#summary-delivery-row .summary-label {
        flex: none !important;
        width: 100% !important;
        margin-bottom: 2px;
    }
    
    .summary-row#summary-installation-row .summary-value,
    .summary-row#summary-delivery-row .summary-value {
        flex: none !important;
        width: 100% !important;
        text-align: left !important;
        padding-left: 10px;
        border-left: 2px solid #cbbfa9;
        justify-content: flex-start !important;
    }
}

/* ===== DARK MODE SUPPORT ===== */
@media (prefers-color-scheme: dark) {
    .summary-container {
        background: #1e1e1e;
    }
    
    .summary-title {
        color: #ffffff;
    }
    
    .summary-price {
        background: #2d2d2d;
        color: #cbbfa9;
    }
    
    .summary-price span {
        color: #ffffff;
    }
    
    .summary-grid {
        background: #2a2a2a;
        border-color: #404040;
    }
    
    .summary-row {
        border-bottom-color: #404040;
    }
    
    .summary-row:hover {
        background-color: #333333;
    }
    
    .summary-label {
        color: #b0b0b0;
    }
    
    .summary-value {
        color: #e0e0e0;
    }
    
    .summary-divider {
        border-top-color: #404040;
    }
    
    .price-vat {
        color: #b0b0b0;
    }
}

/* ===== ANIMATIONS ===== */
.summary-row {
    transition: all 0.2s ease;
}

.submit-btn {
    transition: all 0.3s ease;
}

/* ===== PRINT STYLES ===== */
@media print {
    .submit-container {
        display: none;
    }
    
    .summary-container {
        padding: 20px;
    }
    
    .summary-grid {
        break-inside: avoid;
        background: none;
        border: 1px solid #ccc;
    }
}

</style>

<script>
/**
 * Step 14 - Order Summary - COMPLETE VERSION
 */
jQuery(document).ready(function($) {
    
    // ===== DEVELOPMENT MODE CHECK =====
    function isDev() {
        return window.location.hostname === 'localhost' || 
               window.location.hostname === '127.0.0.1';
    }

    // ===== SUBMISSION LOCK =====
    let isSubmitting = false;

    /**
     * Calculate total price including installation
     */
    function calculateTotalPrice() {
        let total = 0;
        
        // Get base price from Step 1
        const basePrice = parseFloat($('#base_price_value').val()) || 0;
        total += basePrice;
        
        // Get pane count from selected panel
        const paneCount = window.getPaneCount ? window.getPaneCount() : 1;
        
        // ===== OUTSIDE COLOUR (STEP 4) =====
        const outsideColour = $('input[name="door_colour"]:checked').val();
        const customRalValue = $('#custom_colour_select').val();
        
        if (outsideColour === 'custom_ral' && customRalValue && customRalValue !== '') {
            const selectedOption = $('#custom_colour_select option:selected');
            const price = parseFloat(selectedOption.data('price')) || 195;
            total += price * paneCount;
        } 
        else if (outsideColour && outsideColour !== 'custom_ral' && 
                 outsideColour !== 'anthracite_grey' && outsideColour !== 'black' && outsideColour !== 'white') {
            const selectedOption = $('#custom_colour_select option[value="' + outsideColour + '"]');
            const price = parseFloat(selectedOption.data('price')) || 195;
            total += price * paneCount;
        }
        
        // ===== INSIDE COLOUR (STEP 5) =====
        const insideColour = $('input[name="inside_colour"]:checked').val();
        const customInsideRalValue = $('#custom_inside_colour_select').val();
        
        if (insideColour === 'custom_ral' && customInsideRalValue && customInsideRalValue !== '') {
            const selectedOption = $('#custom_inside_colour_select option:selected');
            const price = parseFloat(selectedOption.data('price')) || 195;
            total += price * paneCount;
        } 
        else if (insideColour && insideColour !== 'custom_ral' && 
                 insideColour !== 'anthracite_grey' && insideColour !== 'black' && insideColour !== 'white') {
            const selectedOption = $('#custom_inside_colour_select option[value="' + insideColour + '"]');
            const price = parseFloat(selectedOption.data('price')) || 195;
            total += price * paneCount;
        }
        
        // ===== GLASS (STEP 7) =====
        const glassValue = $('input[name="glass_upgrade"]:checked');
        if (glassValue.length) {
            const price = parseFloat(glassValue.data('price')) || 0;
            total += price * paneCount;
        }
        
        // ===== TRICKLE VENTS (STEP 8) =====
        const ventsValue = $('input[name="trickle_vents"]:checked').val();
        if (ventsValue === 'yes_trickle') {
            total += 85;
        }
        
        // ===== INSTALLATION TYPE (STEP 11) =====
        const installType = $('input[name="installation_type"]:checked').val();
        if (installType) {
            if (installType === 'prepared_opening') {
                total += paneCount * 200;
                if (isDev()) console.log('Installation: Prepared Opening - £' + (paneCount * 200));
            } else if (installType === 'remove_existing') {
                total += (paneCount * 200) + 550;
                if (isDev()) console.log('Installation: Remove & Install - £' + ((paneCount * 200) + 550));
            } else if (installType === 'delivery') {
                const deliveryPrice = parseFloat($('#delivery_price').val()) || 0;
                total += deliveryPrice;
                if (isDev()) console.log('Installation: Delivery - £' + deliveryPrice);
            } else {
                if (isDev()) console.log('Installation: Collection - £0');
            }
        }
        
        return total;
    }

    /**
     * Get installation display text
     */
    function getInstallationDisplay() {
        const val = $('input[name="installation_type"]:checked').val();
        if (!val) return '—';
        
        const paneCount = window.getPaneCount ? window.getPaneCount() : 1;
        
        const installMap = {
            'collection': 'Supply Only – Collection',
            'delivery': 'Supply Only – Delivery',
            'prepared_opening': 'Installed into Prepared Opening',
            'remove_existing': 'Remove Existing Doors & Install'
        };
        
        let displayText = installMap[val] || val;
        
        // Add price info
        if (val === 'prepared_opening') {
            displayText += ' (+£' + (paneCount * 200) + ')';
        } else if (val === 'remove_existing') {
            displayText += ' (+£' + ((paneCount * 200) + 550) + ')';
        } else if (val === 'delivery') {
            const deliveryPrice = parseFloat($('#delivery_price').val()) || 0;
            if (deliveryPrice > 0) {
                displayText += ' (+£' + deliveryPrice.toFixed(2) + ')';
            } else if (deliveryPrice === 0 && $('#delivery_bespoke').val() !== '1') {
                displayText += ' (FREE)';
            }
        }
        
        return displayText;
    }

    /**
     * Get delivery information for display
     */
    function getDeliveryInfo() {
        let deliveryInfo = {
            display: '—',
            price: 0,
            zone: '',
            distance: '',
            isBespoke: false
        };
        
        if (window.deliveryData) {
            if (window.deliveryData.bespoke) {
                deliveryInfo.display = 'Bespoke (call for quote)';
                deliveryInfo.isBespoke = true;
            } else {
                const price = parseFloat(window.deliveryData.price) || 0;
                deliveryInfo.price = price;
                const priceText = price === 0 ? 'FREE' : '£' + price.toFixed(2);
                const zone = window.deliveryData.zone || '';
                const distance = window.deliveryData.distance ? parseFloat(window.deliveryData.distance).toFixed(1) + ' miles' : '';
                deliveryInfo.zone = zone;
                deliveryInfo.distance = distance;
                
                if (zone && distance) {
                    deliveryInfo.display = priceText + ' (' + zone + ' - ' + distance + ', <span class="price-vat">INC. VAT</span>)';
                } else if (zone) {
                    deliveryInfo.display = priceText + ' (' + zone + ', <span class="price-vat">INC. VAT</span>)';
                } else {
                    deliveryInfo.display = priceText + ' <span class="price-vat">(INC. VAT)</span>';
                }
            }
        } else {
            const price = parseFloat($('#delivery_price').val()) || 0;
            const isBespoke = $('#delivery_bespoke').val() === '1';
            const zone = $('#delivery_zone').val() || '';
            const distance = $('#delivery_distance').val() ? parseFloat($('#delivery_distance').val()).toFixed(1) + ' miles' : '';
            
            deliveryInfo.price = price;
            deliveryInfo.zone = zone;
            deliveryInfo.distance = distance;
            deliveryInfo.isBespoke = isBespoke;
            
            if (isBespoke) {
                deliveryInfo.display = 'Bespoke (call for quote)';
            } else {
                const priceText = price === 0 ? 'FREE' : '£' + price.toFixed(2);
                if (zone && distance) {
                    deliveryInfo.display = priceText + ' (' + zone + ' - ' + distance + ', <span class="price-vat">INC. VAT</span>)';
                } else if (zone) {
                    deliveryInfo.display = priceText + ' (' + zone + ', <span class="price-vat">INC. VAT</span>)';
                } else {
                    deliveryInfo.display = priceText + ' <span class="price-vat">(INC. VAT)</span>';
                }
            }
        }
        
        return deliveryInfo;
    }

    /**
     * Reset submit button
     */
    function resetSubmitButton() {
        isSubmitting = false;
        const $btn = $('#submit-btn');
        const totalPrice = $('#summary-total-price').text() || '0.00';
        
        $btn.prop('disabled', false).removeClass('loading');
        
        if (window.editMode) {
            $btn.html('UPDATE CART - £' + totalPrice + ' <span class="price-vat">(inc. VAT)</span>');
        } else {
            $btn.html('ADD TO CART - £' + totalPrice + ' <span class="price-vat">(inc. VAT)</span>');
        }
    }

    /**
     * Submit builder form
     */
    window.submitBuilderForm = function() {
        if (isSubmitting) {
            if (isDev()) { console.log('Submission already in progress - blocked'); }
            return;
        }
        
        if (typeof validateStep === 'function' && !validateStep(0)) {
            if (typeof showStep === 'function') showStep(0);
            return;
        }
        
        const isBespoke = (window.deliveryData && window.deliveryData.bespoke) || $('#delivery_bespoke').val() === '1';
        if (isBespoke) {
            alert('Bespoke delivery required. Please call our sales team to complete your order.');
            return;
        }
        
        isSubmitting = true;
        
        const $submitBtn = $('#submit-btn');
        $submitBtn.prop('disabled', true).addClass('loading');
        
        if (window.editMode) {
            $submitBtn.html('<span class="loading-spinner"></span> Updating Cart...');
        } else {
            $submitBtn.html('<span class="loading-spinner"></span> Adding to Cart...');
        }
        
        if (typeof window.populateStep14 === 'function') {
            window.populateStep14();
        }
        
        const formData = $('#door-builder-form').serialize();
        let dataToSend = formData + '&builder_checkout=0';
        
        if (window.editMode) {
            const cartKey = window.editCartKey || $('#cart_item_key_field').val() || '';
            if (cartKey) {
                dataToSend += '&edit_mode=1&cart_item_key=' + encodeURIComponent(cartKey);
                if (isDev()) console.log('Edit mode - Cart Key found:', cartKey);
            } else {
                console.error('No cart key found for edit mode!');
                alert('Error: Cart item key not found. Please try again.');
                resetSubmitButton();
                return;
            }
        }
        
        $.ajax({
            url: door_builder_vars.ajax_url,
            type: 'POST',
            data: {
                action: 'process_door_builder',
                form_data: dataToSend,
                security: door_builder_vars.nonce
            },
            success: function(response) {
                if (response.success) {
                    if (isDev()) console.log('Submission successful - redirecting to cart');
                    window.location.href = door_builder_vars.cart_url;
                } else {
                    alert('Error: ' + (response.data.message || 'Unknown error'));
                    resetSubmitButton();
                }
            },
            error: function(xhr, status, error) {
                if (isDev()) console.log('AJAX Error:', xhr.responseText);
                alert('Network error. Please try again.');
                resetSubmitButton();
            }
        });
        
        setTimeout(function() {
            if (isSubmitting) {
                if (isDev()) console.log('Safety timeout - resetting button');
                resetSubmitButton();
            }
        }, 10000);
    };

    /**
     * Populate Step 14 with all values
     */
    window.populateStep14 = function() {
        // === STEP 1: Manufacturing Size ===
        const width = $('#width').val() || '';
        const height = $('#height').val() || '';
        const sizeText = width && height ? width + ' x ' + height : '—';
        $('#summary-size').text(sizeText);
        $('#summary_size_field').val(sizeText);

        // === STEP 2: Panels ===
        const panelValue = $('input[name="panel_layout"]:checked').val();
        let panelText = '';
        if (panelValue) {
            panelText = $('input[name="panel_layout"]:checked').closest('label').find('.option-name').text().trim();
            if (!panelText) {
                const panelMap = {
                    '2_left': '2 Panels Left',
                    '2_right': '2 Panels Right',
                    '1_2': '1 + 2 Panels',
                    '2_1': '2 + 1 Panels',
                    '3_left': '3 Panels Left',
                    '3_right': '3 Panels Right',
                    '1_3': '1 + 3 Panels',
                    '3_1': '3 + 1 Panels',
                    '2_2': '2 + 2 Panels',
                    '4_left': '4 Panels Left',
                    '4_right': '4 Panels Right',
                    '1_4': '1 + 4 Panels',
                    '4_1': '4 + 1 Panels',
                    '2_3': '2 + 3 Panels',
                    '3_2': '3 + 2 Panels',
                    '5_left': '5 Panels Left',
                    '5_right': '5 Panels Right',
                    '1_5': '1 + 5 Panels',
                    '2_4': '2 + 4 Panels',
                    '3_3': '3 + 3 Panels',
                    '4_2': '4 + 2 Panels',
                    '5_1': '5 + 1 Panels',
                    '6_left': '6 Panels Left',
                    '6_right': '6 Panels Right',
                    'french': 'French Doors'
                };
                panelText = panelMap[panelValue] || panelValue;
            }
        }
        $('#summary-panels').text(panelText || '—');
        $('#summary_panels_field').val(panelText || '—');

        // === STEP 3: Opening Direction ===
        const openingValue = $('input[name="open_direction"]:checked').val();
        const openingText = openingValue ? (openingValue === 'inwards' ? 'Inwards' : 'Outwards') : '—';
        $('#summary-opening').text(openingText);
        $('#summary_opening_field').val(openingText);

        // === STEP 4: Outside Colour ===
        const outsideColour = $('input[name="door_colour"]:checked').val();
        const customRalValue = $('#custom_colour_select').val();
        let outsideText = '—';
        
        if (outsideColour === 'custom_ral' && customRalValue && customRalValue !== '') {
            outsideText = customRalValue;
        } else if (outsideColour && outsideColour !== 'custom_ral' && 
                   outsideColour !== 'anthracite_grey' && outsideColour !== 'black' && outsideColour !== 'white') {
            outsideText = outsideColour;
        } else {
            const colourMap = {
                'anthracite_grey': 'Anthracite Grey',
                'black': 'Black',
                'white': 'White'
            };
            outsideText = colourMap[outsideColour] || outsideColour || '—';
            
            const ralMap = {
                'anthracite_grey': '7016',
                'black': '9005',
                'white': '9016'
            };
            if (ralMap[outsideColour]) {
                outsideText += ' (RAL ' + ralMap[outsideColour] + ')';
            }
        }
        $('#summary-outside-colour').text(outsideText);
        $('#summary_outside_colour_field').val(outsideText);

        // === STEP 5: Inside Colour ===
        const insideColour = $('input[name="inside_colour"]:checked').val();
        const customInsideRalValue = $('#custom_inside_colour_select').val();
        let insideText = '—';
        
        if (insideColour === 'custom_ral' && customInsideRalValue && customInsideRalValue !== '') {
            insideText = customInsideRalValue;
        } else if (insideColour && insideColour !== 'custom_ral' && 
                   insideColour !== 'anthracite_grey' && insideColour !== 'black' && insideColour !== 'white') {
            insideText = insideColour;
        } else {
            const colourMap = {
                'anthracite_grey': 'Anthracite Grey',
                'black': 'Black',
                'white': 'White'
            };
            insideText = colourMap[insideColour] || insideColour || '—';
            
            const ralMap = {
                'anthracite_grey': '7016',
                'black': '9005',
                'white': '9016'
            };
            if (ralMap[insideColour]) {
                insideText += ' (RAL ' + ralMap[insideColour] + ')';
            }
        }
        $('#summary-inside-colour').text(insideText);
        $('#summary_inside_colour_field').val(insideText);

        // === STEP 6: Handle Colour ===
        const handleColour = $('input[name="handle_colour"]:checked').val();
        const handleMap = {
            'white': 'White',
            'chrome': 'Chrome',
            'black': 'Black',
            'black_white': 'Black and White'
        };
        const handleText = handleMap[handleColour] || handleColour || '—';
        $('#summary-handle-colour').text(handleText);
        $('#summary_handle_colour_field').val(handleText);

        // === STEP 7: Glass ===
        const glassValue = $('input[name="glass_upgrade"]:checked').val();
        let glassText = '—';

        if (glassValue) {
            if (glassValue === 'no_thanks') {
                glassText = 'Standard Glass';
            } else {
                glassText = $('input[name="glass_upgrade"]:checked').closest('.glass-option-card').find('.option-name').text().trim();
                if (!glassText) {
                    const glassMap = {
                        'self_cleaning': 'Self-cleaning glass',
                        'integral_blinds': 'Integral blinds',
                        'obscure_glass': 'Obscure glass',
                        'saint_gobain_12': 'Saint-Gobain Planitherm 1.2'
                    };
                    glassText = glassMap[glassValue] || glassValue;
                }
            }
        }
        $('#summary-glass').text(glassText);
        $('#summary_glass_field').val(glassText);

        // === STEP 8: Trickle Vents ===
        const trickleVents = $('input[name="trickle_vents"]:checked').val();
        const trickleText = trickleVents === 'yes_trickle' ? 'Yes, Add Trickle Vent' : 'No';
        $('#summary-trickle-vents').text(trickleText);
        $('#summary_trickle_vents_field').val(trickleText);

        // === STEP 9: Cill ===
        const cillValue = $('input[name="cill"]:checked').val();
        const cillMap = {
            'none': 'No Cill',
            '150mm-aluminium-cill': '150mm Aluminium Cill',
            '150mm-upvc-cill': '150mm uPVC Cill'
        };
        const cillText = cillMap[cillValue] || cillValue || '—';
        $('#summary-cill').text(cillText);
        $('#summary_cill_field').val(cillText);

        // === STEP 10: Postcode ===
        const postcode = $('#postcode').val() || '—';
        $('#summary-postcode').text(postcode);
        $('#summary_postcode_field').val(postcode);

        // === STEP 11: Installation Type ===
        const installationDisplay = getInstallationDisplay();
        $('#summary-installation').text(installationDisplay);
        $('#summary_installation_field').val(installationDisplay);

        // === STEP 12: Access Issues ===
        const accessIssues = $('input[name="access_issues"]:checked').val();
        let accessText = 'No';
        
        if (accessIssues === 'yes_access') {
            const accessDesc = $('#access_description').val();
            accessText = accessDesc && accessDesc.trim() !== '' 
                ? 'Yes, ' + accessDesc 
                : 'Yes (please describe)';
        }
        $('#summary-access').text(accessText);
        $('#summary_access_field').val(accessText);

        // === DELIVERY ROW ===
        if ($('#summary-delivery-row').length === 0) {
            const deliveryRow = `
                <div class="summary-row" id="summary-delivery-row">
                    <span class="summary-label">Delivery:</span>
                    <span class="summary-value" id="summary-delivery">—</span>
                </div>
            `;
            $('#summary-installation-row').after(deliveryRow);
        }

        const deliveryInfo = getDeliveryInfo();
        $('#summary-delivery').html(deliveryInfo.display);
        
        if (deliveryInfo.isBespoke) {
            $('#summary-delivery-row').addClass('bespoke-delivery');
        } else {
            $('#summary-delivery-row').removeClass('bespoke-delivery');
        }

        // === TOTAL PRICE ===
        const totalPrice = calculateTotalPrice();
        const totalPriceFormatted = totalPrice.toFixed(2);
        
        $('#summary-total-price').text(totalPriceFormatted);
        $('#submit-price').html('£' + totalPriceFormatted + ' <span class="price-vat">(inc. VAT)</span>');
        $('#summary_total_price_field').val(totalPriceFormatted);
        
        if ($('#drawer-total-price').length) {
            $('#drawer-total-price').html('£' + totalPriceFormatted + ' <span class="price-vat">(inc. VAT)</span>');
        }
        if ($('#drawer-footer-total').length) {
            $('#drawer-footer-total').html('£' + totalPriceFormatted + ' <span class="price-vat">(inc. VAT)</span>');
        }
        
        if (isDev()) {
            console.log('Step 14 populated - Total: £' + totalPriceFormatted);
            console.log('Installation:', installationDisplay);
            console.log('Delivery:', deliveryInfo.display);
        }
    };

    // ===== EVENT LISTENERS =====
    
    $(document).on('updateSummary', function() {
        window.populateStep14();
    });
    
    $(document).on('stepChanged', function(e, stepIndex) {
        if (stepIndex === 13) { // Step 14 is index 13
            setTimeout(function() {
                window.populateStep14();
            }, 200);
        }
    });

    $(document).on('deliveryDataUpdated', function() {
        if ($('.wizard-step.active').data('step') == 14) {
            const deliveryInfo = getDeliveryInfo();
            $('#summary-delivery').html(deliveryInfo.display);
            
            if (deliveryInfo.isBespoke) {
                $('#summary-delivery-row').addClass('bespoke-delivery');
            } else {
                $('#summary-delivery-row').removeClass('bespoke-delivery');
            }
            
            // Update total price
            const totalPrice = calculateTotalPrice();
            const totalPriceFormatted = totalPrice.toFixed(2);
            $('#summary-total-price').text(totalPriceFormatted);
            $('#submit-price').html('£' + totalPriceFormatted + ' <span class="price-vat">(inc. VAT)</span>');
        }
    });

    $(document).on('updateNavigation', function() {
        const totalPrice = $('#summary-total-price').text() || '0.00';
        if (window.editMode) {
            $('#submit-btn').html('UPDATE CART - £' + totalPrice + ' <span class="price-vat">(inc. VAT)</span>');
        } else {
            $('#submit-btn').html('ADD TO CART - £' + totalPrice + ' <span class="price-vat">(inc. VAT)</span>');
        }
    });
    
    // Installation type change listener
    $(document).on('change', 'input[name="installation_type"]', function() {
        if ($('.wizard-step.active').data('step') == 14) {
            window.populateStep14();
        }
    });
    
    // ===== SUBMIT BUTTON CLICK HANDLER =====
    $(document).on('click', '#submit-btn', function(e) {
        e.preventDefault();
        
        if ($(this).prop('disabled') || isSubmitting) {
            return false;
        }
        
        if (typeof window.submitBuilderForm === 'function') {
            window.submitBuilderForm();
        } else {
            console.error('submitBuilderForm function not found');
            $('#door-builder-form').submit();
        }
    });

    $(window).on('beforeunload', function() {
        if (isSubmitting) {
            return undefined;
        }
    });

    // ===== INITIAL CHECK FOR EDIT MODE =====
    if (window.editMode) {
        const totalPrice = $('#summary-total-price').text() || '0.00';
        $('#submit-btn').html('UPDATE CART - £' + totalPrice + ' <span class="price-vat">(inc. VAT)</span>');
        
        if (window.editCartKey) {
            $('#cart_item_key_field').val(window.editCartKey);
        }
    }

    // ===== INITIAL POPULATE IF STEP 14 IS ACTIVE =====
    if ($('.wizard-step.active').data('step') == 14) {
        setTimeout(function() {
            window.populateStep14();
        }, 200);
    }

    // ===== MAKE FUNCTIONS GLOBALLY AVAILABLE =====
    window.getInstallationDisplay = getInstallationDisplay;
    window.getDeliveryInfo = getDeliveryInfo;
    window.calculateTotalPrice = calculateTotalPrice;
    
    if (isDev()) {
        console.log('Step 14 script loaded successfully');
    }

});
</script>