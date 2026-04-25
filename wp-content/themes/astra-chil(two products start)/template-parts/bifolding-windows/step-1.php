<?php
/**
 * Template part for Size step in Window Builder
 * 
 * @package Astra Child
 */
?>

<!-- Step 1: Size -->
<div class="wizard-step active" data-step="1">
    <div class="step-container">

        <div class="step-title">
            <h2>What size do you require for your bifolding window?</h2>
            <p>This is the overall size of the window, with tolerances allowed for.</p>
        </div>

        <div class="builder-fields">
            <div class="builder-field">
                <label for="window_width">WIDTH (MM)</label>
                <div class="input-wrapper">
                    <input type="number" id="window_width" name="width" placeholder="Max 5800" min="1600" max="5800" required>
                    <span class="unit">mm</span>
                </div>
                <div class="validation-error" id="width-error">
                    Width must be between 1600 and 5800 mm.
                </div>
            </div>

            <div class="builder-field">
                <label for="window_height">HEIGHT (MM)</label>
                <div class="input-wrapper">
                    <input type="number" id="window_height" name="height" placeholder="Max 1650" min="700" max="1650" required>
                    <span class="unit">mm</span>
                </div>
                <div class="validation-error" id="height-error">
                    Height must be between 700 and 1650 mm.
                </div>
            </div>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    
    // Get references to buttons
    const nextBtn = $('.next-step');
    const prevBtn = $('.prev-step');
    
    /**
     * Calculate panel count based on width
     * Width Range: 1600mm - 5800mm
     */
    function getPanelCount(width) {
        if (width >= 1600 && width <= 2000) return 2;
        else if (width >= 2001 && width <= 2600) return 3;
        else if (width >= 2601 && width <= 3400) return 4;
        else if (width >= 3401 && width <= 4200) return 5;
        else if (width >= 4201 && width <= 5000) return 6;
        else if (width >= 5001 && width <= 5800) return 7;
        return 0;
    }
    
    /**
     * Calculate base price based on width and panel count
     */
    function getBasePrice(width, panelCount) {
        if (panelCount === 2) return 990;
        
        else if (panelCount === 3) {
            if (width <= 2200) return 1190;
            else if (width <= 2600) return 1290;
            else return 1390;
        }
        
        else if (panelCount === 4) {
            if (width <= 3000) return 1690;
            else if (width <= 3400) return 1790;
            else return 1890;
        }
        
        else if (panelCount === 5) {
            if (width <= 3800) return 2190;
            else if (width <= 4200) return 2290;
            else return 2390;
        }
        
        else if (panelCount === 6) {
            if (width <= 4600) return 2690;
            else if (width <= 5000) return 2790;
            else return 2890;
        }
        
        else if (panelCount === 7) {
            if (width <= 5400) return 3290;
            else return 3490;
        }
        
        return 0;
    }
    
    /**
     * Calculate height extra based on height and panel count
     * Height Range: 700mm - 1650mm
     */
    function getHeightExtra(height, panelCount) {
        if (height >= 700 && height <= 900) return 0;
        else if (height >= 901 && height <= 1200) return 60 * panelCount;
        else if (height >= 1201 && height <= 1650) return 100 * panelCount;
        return 0;
    }
    
    /**
     * Validate inputs and show error messages
     * Returns true if valid, false otherwise
     */
    function validateInputs() {
        const width = $('#window_width').val();
        const height = $('#window_height').val();
        let isValid = true;
        
        // Width validation
        if (!width || width === '') {
            $('#width-error').text('Width is required.').show();
            isValid = false;
        } else {
            const widthNum = parseInt(width);
            if (isNaN(widthNum)) {
                $('#width-error').text('Width must be a valid number.').show();
                isValid = false;
            } else if (widthNum < 1600) {
                $('#width-error').text('Width must be at least 1600 mm.').show();
                isValid = false;
            } else if (widthNum > 5800) {
                $('#width-error').text('Width cannot exceed 5800 mm.').show();
                isValid = false;
            } else {
                $('#width-error').hide();
            }
        }
        
        // Height validation
        if (!height || height === '') {
            $('#height-error').text('Height is required.').show();
            isValid = false;
        } else {
            const heightNum = parseInt(height);
            if (isNaN(heightNum)) {
                $('#height-error').text('Height must be a valid number.').show();
                isValid = false;
            } else if (heightNum < 700) {
                $('#height-error').text('Height must be at least 700 mm.').show();
                isValid = false;
            } else if (heightNum > 1650) {
                $('#height-error').text('Height cannot exceed 1650 mm.').show();
                isValid = false;
            } else {
                $('#height-error').hide();
            }
        }
        
        // Update Next button state
        if (nextBtn.length) {
            if (isValid) {
                nextBtn.removeClass('inactive').prop('disabled', false);
            } else {
                nextBtn.addClass('inactive').prop('disabled', true);
            }
        }
        
        return isValid;
    }
    
    /**
     * Check if values are valid (without showing errors)
     * Width: 1600-5800mm, Height: 700-1650mm
     */
    function isValidInput() {
        const width = parseInt($('#window_width').val());
        const height = parseInt($('#window_height').val());
        
        return !isNaN(width) && !isNaN(height) && 
               width >= 1600 && width <= 5800 && 
               height >= 700 && height <= 1650;
    }
    
    /**
     * Update instant price display and base price value
     */
    function updateInstantPrice() {
        if (!isValidInput()) {
            $('#instant-price').text('£0.00');
            $('#base_price_value').val(0);
            $('#final_price_input').val('0.00');
            return;
        }
        
        const width = parseInt($('#window_width').val());
        const height = parseInt($('#window_height').val());
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
        
        // Update base price for subsequent steps
        $('#base_price_value').val(totalPrice);
        $('#final_price_input').val(totalPrice.toFixed(2));
        
        // Store in global variable
        window.lastCalculatedPrice = totalPrice.toFixed(2);
        window.basePriceFromStep1 = totalPrice;
        window.windowWidth = width;
        window.windowHeight = height;
        window.windowPanelCount = panelCount;
        
        // Update drawer if available
        if (typeof window.updateDrawer === 'function') {
            window.updateDrawer();
        }
        
        console.log('Step 1 - Width:', width, 'Height:', height, 'Panels:', panelCount, 
                   'Base:', basePrice, 'Extra:', heightExtra, 'Total:', totalPrice);
    }
    
    /**
     * Handle input change - validate and update price
     */
    function handleInputChange() {
        validateInputs();
        updateInstantPrice();
        
        // Trigger step validation for navigation
        if (typeof window.validateCurrentStep === 'function') {
            window.validateCurrentStep();
        }
    }
    
    // Update price and validation on input change
    $('#window_width, #window_height').on('input blur', function() {
        handleInputChange();
    });
    
    // Initial validation and price update
    if ($('#window_width').val() && $('#window_height').val()) {
        handleInputChange();
    } else {
        // Reset base price to 0 if no values
        $('#base_price_value').val(0);
        $('#final_price_input').val('0.00');
        
        // Initially disable next button if no values
        if (nextBtn.length) {
            nextBtn.addClass('inactive').prop('disabled', true);
        }
    }
    
    // Make functions available globally
    window.getWindowPanelCount = getPanelCount;
    window.getWindowBasePrice = getBasePrice;
    window.getWindowHeightExtra = getHeightExtra;
    window.validateWindowInputs = validateInputs;
    window.updateWindowPrice = updateInstantPrice;
    
});
</script>