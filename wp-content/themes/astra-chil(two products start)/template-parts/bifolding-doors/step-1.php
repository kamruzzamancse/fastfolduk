<?php
/**
 * Template part for Size step in Door Builder
 * 
 * @package Astra Child
 */
?>

<!-- Step 1: Size -->
<div class="wizard-step active" data-step="1">
    <div class="step-container">

        <div class="step-title">
            <h2>What size do you require for your bifolding door?</h2>
            <p>This is the overall size of the door, with tolerances allowed for.</p>
        </div>

        <div class="builder-fields">
            <div class="builder-field">
                <label for="width">WIDTH (MM)</label>
                <div class="input-wrapper">
                    <input type="number" id="width" name="width" placeholder="Max 5800" min="1600" max="5800" required>
                    <span class="unit">mm</span>
                </div>
                <div class="validation-error" id="width-error">
                    Width must be between 1600 and 5800 mm.
                </div>
            </div>

            <div class="builder-field">
                <label for="height">HEIGHT (MM)</label>
                <div class="input-wrapper">
                    <input type="number" id="height" name="height" placeholder="Max 2450" min="1950" max="2450" required>
                    <span class="unit">mm</span>
                </div>
                <div class="validation-error" id="height-error">
                    Height must be between 1950 and 2450 mm.
                </div>
            </div>
        </div>
    </div>
</div>

</style>

<script>
jQuery(document).ready(function($) {
    
    /**
     * Calculate panel count based on width
     */
    function getPanelCount(width) {
        if (width >= 1600 && width <= 2000) return 2;
        else if (width >= 1801 && width <= 2600) return 3;
        else if (width >= 2601 && width <= 3600) return 4;
        else if (width >= 3601 && width <= 4400) return 5;
        else if (width >= 4401 && width <= 6000) return 6;
        return 0;
    }
    
    /**
     * Calculate base price based on width and panel count
     */
    function getBasePrice(width, panelCount) {
        if (panelCount === 2) return 1390;
        
        else if (panelCount === 3) {
            if (width <= 2200) return 1520;
            else if (width <= 2700) return 1650;
            else if (width <= 3000) return 1790;
            else return 1820;
        }
        
        else if (panelCount === 4) {
            return width <= 3600 ? 2100 : 2290;
        }
        
        else if (panelCount === 5) {
            if (width <= 4200) return 2920;
            else if (width <= 4500) return 3010;
            else return 3120;
        }
        
        else if (panelCount === 6) {
            return width <= 5300 ? 3750 : 3990;
        }
        
        return 0;
    }
    
    /**
     * Calculate height extra based on height and panel count
     */
    function getHeightExtra(height, panelCount) {
        if (height >= 1950 && height <= 2100) return 0;
        else if (height >= 2101 && height <= 2300) return 90 * panelCount;
        else if (height >= 2301 && height <= 2450) return 120 * panelCount;
        return 0;
    }
    
    /**
     * Check if values are valid
     */
    function isValidInput() {
        const width = parseInt($('#width').val());
        const height = parseInt($('#height').val());
        
        return !isNaN(width) && !isNaN(height) && 
               width >= 1600 && width <= 6000 && 
               height >= 1950 && height <= 2450;
    }
    
    /**
     * Update instant price display and base price value
     */
    function updateInstantPrice() {
        if (!isValidInput()) {
            $('#instant-price').text('£0.00');
            return;
        }
        
        const width = parseInt($('#width').val());
        const height = parseInt($('#height').val());
        const panelCount = getPanelCount(width);
        
        if (panelCount === 0) {
            $('#instant-price').text('£0.00');
            return;
        }
        
        const basePrice = getBasePrice(width, panelCount);
        const heightExtra = getHeightExtra(height, panelCount);
        const totalPrice = basePrice + heightExtra;
        
        // Update display
        $('#instant-price').text('£' + totalPrice.toFixed(2));
        
        // ===== IMPORTANT: Update base price for subsequent steps =====
        $('#base_price_value').val(totalPrice);
        $('#final_price_input').val(totalPrice.toFixed(2));
        
        // Store in global variable
        window.lastCalculatedPrice = totalPrice.toFixed(2);
        window.basePriceFromStep1 = totalPrice;
        
        console.log('Step 1 - Width:', width, 'Height:', height, 'Panels:', panelCount, 
                   'Base:', basePrice, 'Extra:', heightExtra, 'Total:', totalPrice);
    }
    
    // Update price on input change
    $('#width, #height').on('input blur', function() {
        updateInstantPrice();
    });
    
    // Initial update if values exist
    if ($('#width').val() && $('#height').val()) {
        updateInstantPrice();
    } else {
        // Reset base price to 0 if no values
        $('#base_price_value').val(0);
        $('#final_price_input').val('0.00');
    }
});
</script>