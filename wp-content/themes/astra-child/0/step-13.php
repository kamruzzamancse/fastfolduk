<?php
/**
 * Template part for Customer Information Step in Window Builder
 * Step 13: Complete the form to view your quote
 *
 * @package Astra Child
 */
?>

<!-- Step 13: Customer Information Form -->
<div class="wizard-step" data-step="13">
    <div class="step-container customer-container">
        
        <!-- Header with title -->
        <div class="step-title customer-header">
            <h2 class="customer-title">Complete the form to view your quote</h2>
        </div>

        <!-- Features with tickboxes (checkboxes) -->
        <div class="customer-features">
            <div class="feature-item">
                <label class="feature-checkbox-label">
                    <input type="checkbox" class="feature-checkbox" checked disabled>
                    <span class="feature-checkmark"></span>
                    <span class="feature-text">10 year guarantee</span>
                </label>
            </div>
            <div class="feature-item">
                <label class="feature-checkbox-label">
                    <input type="checkbox" class="feature-checkbox" checked disabled>
                    <span class="feature-checkmark"></span>
                    <span class="feature-text">Download your quote</span>
                </label>
            </div>
            <div class="feature-item">
                <label class="feature-checkbox-label">
                    <input type="checkbox" class="feature-checkbox" checked disabled>
                    <span class="feature-checkmark"></span>
                    <span class="feature-text">Secure checkout</span>
                </label>
            </div>
        </div>

        <!-- Horizontal Divider -->
        <hr class="customer-divider">

        <!-- Customer Form - Two column layout -->
        <div class="customer-form-wrapper">
            <form class="customer-form" id="customer-info-form">
                
                <!-- First Row: First Name and Last Name side by side -->
                <div class="form-row">
                    <div class="form-field">
                        <label for="window_first_name">FIRST NAME</label>
                        <input 
                            type="text" 
                            name="first_name" 
                            id="window_first_name" 
                            class="customer-input" 
                            placeholder="John" 
                            value="" 
                            required
                        >
                    </div>

                    <div class="form-field">
                        <label for="window_last_name">LAST NAME</label>
                        <input 
                            type="text" 
                            name="last_name" 
                            id="window_last_name" 
                            class="customer-input" 
                            placeholder="Smith" 
                            value="" 
                            required
                        >
                    </div>
                </div>

                <!-- Second Row: Mobile Number and Email side by side -->
                <div class="form-row">
                    <div class="form-field">
                        <label for="window_mobile_number">MOBILE NUMBER</label>
                        <input 
                            type="tel" 
                            name="mobile_number" 
                            id="window_mobile_number" 
                            class="customer-input" 
                            placeholder="e.g. 07935566384" 
                            value="" 
                            required
                        >
                    </div>

                    <div class="form-field">
                        <label for="window_email_address">EMAIL ADDRESS</label>
                        <input 
                            type="email" 
                            name="email_address" 
                            id="window_email_address" 
                            class="customer-input" 
                            placeholder="sales@fastfolduk.co.uk" 
                            value="" 
                            required
                        >
                    </div>
                </div>

                <!-- Marketing Consent Text -->
                <div class="form-consent">
                    <p class="consent-text">By completing this form you agree to receive marketing communications</p>
                </div>

                <!-- Hidden field to store form completion status -->
                <input type="hidden" name="customer_info_complete" id="window_customer_info_complete" value="0">
            </form>
        </div>

    </div>
</div>

<style>
/* ================================
   Customer Information Step Styles
   For Window Builder
   ================================ */

.customer-container {
    max-width: 1400px;
    padding: 20px;
}

/* Header Section */
.customer-header {
    text-align: left;
    margin-bottom: 30px;
}

.customer-title {
    font-size: 32px;
    color: #222;
    font-weight: 600;
    margin: 0;
    line-height: 1.3;
}

/* Features Row - with checkboxes */
.customer-features {
    display: flex;
    gap: 40px;
    flex-wrap: wrap;
    margin: 0 0 30px 0;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 8px;
}

.feature-checkbox-label {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}

.feature-checkbox {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.feature-checkmark {
    width: 18px;
    height: 18px;
    background: #fff;
    border: 2px solid #2e7d32;
    border-radius: 4px;
    display: inline-block;
    position: relative;
}

.feature-checkbox:checked + .feature-checkmark::after {
    content: "✓";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 12px;
    color: #2e7d32;
    font-weight: bold;
}

.feature-text {
    font-size: 16px;
    color: #FFF;
    font-weight: 500;
}

/* Divider */
.customer-divider {
    border: none;
    border-top: 1px solid #e0e0e0;
    margin: 30px 0 30px 0;
}

/* Form Styling */
.customer-form-wrapper {
    max-width: 100%;
    margin: 0;
}

.customer-form {
    width: 100%;
}

/* Form Rows - Two columns side by side */
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-bottom: 25px;
}

/* Form Fields */
.form-field {
    display: flex;
    flex-direction: column;
}

.form-field label {
    font-size: 14px;
    font-weight: 600;
    color: #FFF;
    margin-bottom: 8px;
    letter-spacing: 0.5px;
}

.customer-input {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: none;
    border-bottom: 1px solid #ddd;
    background: #FFF;
    color: #333;
    outline: none;
    transition: all 0.25s ease;
}

.customer-input:hover {
    border-bottom-color: #9c7b4b;
}

.customer-input:focus {
    border-bottom-color: #9c7b4b;
    box-shadow: none;
}

.customer-input::placeholder {
    color: #aaa;
    font-weight: 400;
    opacity: 1;
}

/* Marketing Consent Text */
.form-consent {
    margin-top: 30px;
}

.consent-text {
    font-size: 14px;
    color: #FFF;
    line-height: 1.5;
    margin: 0;
}

/* Error state for validation */
.customer-input.error {
    border-bottom-color: #dc3545;
}

/* Responsive Design */
@media (max-width: 768px) {
    .customer-container {
        padding: 30px 15px 40px;
    }
    
    .customer-title {
        font-size: 26px;
    }
    
    .customer-features {
        gap: 20px;
        flex-direction: column;
    }
    
    .feature-item {
        width: 100%;
    }
    
    .form-row {
        grid-template-columns: 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .customer-input {
        font-size: 15px;
    }
    
    .consent-text {
        font-size: 13px;
    }
}

@media (max-width: 480px) {
    .customer-title {
        font-size: 24px;
    }
    
    .feature-text {
        font-size: 14px;
    }
    
    .form-field label {
        font-size: 13px;
    }
}
</style>

<script>
/**
 * Step 13 - Customer Information Form for Window Builder
 */
jQuery(document).ready(function($) {
    
    // ===== STORE PRICE COMPONENTS =====
    let priceComponents = {
        basePrice: 0,
        outsideColourPrice: 0,
        insideColourPrice: 0,
        glassPrice: 0,
        ventsPrice: 0,
        installationPrice: 0,
        deliveryPrice: 0,
        total: 0
    };
    
    /**
     * Helper function to get current step
     */
    function getCurrentStep() {
        if (typeof window.currentStep !== 'undefined') {
            return window.currentStep;
        }
        return $('.wizard-step.active').index();
    }
    
    /**
     * Get pane count for windows
     */
    function getWindowPaneCount() {
        if (typeof window.getWindowPaneCount === 'function') {
            return window.getWindowPaneCount();
        }
        
        const selectedPanel = $('input[name="window_panel_layout"]:checked').val();
        if (!selectedPanel) return 1;
        
        let paneCount = 1;
        
        if (selectedPanel.includes('_')) {
            const parts = selectedPanel.split('_');
            if (parts.length === 2 && !isNaN(parseInt(parts[0])) && !isNaN(parseInt(parts[1]))) {
                paneCount = parseInt(parts[0]) + parseInt(parts[1]);
            } else {
                const match = selectedPanel.match(/^(\d+)/);
                if (match) paneCount = parseInt(match[1]);
            }
        } else {
            const match = selectedPanel.match(/^(\d+)/);
            if (match) paneCount = parseInt(match[1]);
        }
        
        return Math.max(1, paneCount);
    }
    
    /**
     * Calculate all price components for windows
     */
    function calculateAllPriceComponents() {
        const paneCount = getWindowPaneCount();
        
        // Base price from step 1
        priceComponents.basePrice = parseFloat($('#base_price_value').val()) || 0;
        
        // Outside Colour (Step 4)
        const outsideColour = $('input[name="window_colour"]:checked').val();
        const customRalValue = $('#custom_window_colour_select').val();
        
        if (outsideColour === 'custom_ral' && customRalValue && customRalValue !== '') {
            priceComponents.outsideColourPrice = 195;
        } else if (outsideColour && outsideColour !== 'custom_ral' && 
                   outsideColour !== 'anthracite_grey' && outsideColour !== 'black' && outsideColour !== 'white') {
            priceComponents.outsideColourPrice = 195;
        } else {
            priceComponents.outsideColourPrice = 0;
        }
        
        // Inside Colour (Step 5)
        const insideColour = $('input[name="window_inside_colour"]:checked').val();
        const customInsideRalValue = $('#custom_window_inside_colour_select').val();
        
        if (insideColour === 'custom_ral' && customInsideRalValue && customInsideRalValue !== '') {
            priceComponents.insideColourPrice = 195;
        } else if (insideColour && insideColour !== 'custom_ral' && 
                   insideColour !== 'anthracite_grey' && insideColour !== 'black' && insideColour !== 'white') {
            priceComponents.insideColourPrice = 195;
        } else {
            priceComponents.insideColourPrice = 0;
        }
        
        // Check for free dual colour
        const isFreeDualColour = (outsideColour === 'anthracite_grey' && insideColour === 'white');
        if (isFreeDualColour) {
            priceComponents.outsideColourPrice = 0;
            priceComponents.insideColourPrice = 0;
        }
        
        // Glass (Step 7)
        const glassValue = $('input[name="glass_type"]:checked');
        if (glassValue.length && glassValue.val() !== 'standard') {
            priceComponents.glassPrice = parseFloat(glassValue.data('price')) || 0;
        } else {
            priceComponents.glassPrice = 0;
        }
        
        // Trickle Vents (Step 8)
        const ventsValue = $('input[name="trickle_vents"]:checked').val();
        priceComponents.ventsPrice = (ventsValue === 'yes_trickle') ? 85 : 0;
        
        // Installation (Step 11)
        const installType = $('input[name="window_installation_type"]:checked').val();
        if (installType === 'install_existing') {
            priceComponents.installationPrice = 299;
        } else if (installType === 'install_new_build') {
            priceComponents.installationPrice = 499;
        } else if (installType === 'delivery') {
            priceComponents.installationPrice = parseFloat($('#window_delivery_price').val()) || 0;
        } else {
            priceComponents.installationPrice = 0;
        }
        
        // Calculate total
        priceComponents.total = priceComponents.basePrice + 
                                 priceComponents.outsideColourPrice + 
                                 priceComponents.insideColourPrice + 
                                 priceComponents.glassPrice + 
                                 priceComponents.ventsPrice +
                                 priceComponents.installationPrice;
        
        console.log('Step 13 - Price components saved for Window:', priceComponents);
        return priceComponents;
    }
    
    /**
     * Save current price when entering Step 13
     */
    function saveCurrentPrice() {
        calculateAllPriceComponents();
        console.log('Step 13: Price saved for Window - Total:', priceComponents.total);
    }
    
    /**
     * Restore price when leaving Step 13
     */
    function restorePrice() {
        // Recalculate to be sure
        calculateAllPriceComponents();
        
        // Update all price displays
        $('#final_price_input').val(priceComponents.total.toFixed(2));
        $('#final-price-confirm').text('£' + priceComponents.total.toFixed(2));
        $('#submit-price').text('£' + priceComponents.total.toFixed(2));
        
        console.log('Step 13: Price restored for Window - Total:', priceComponents.total);
    }
    
    /**
     * Check if form is complete
     */
    function isCustomerFormComplete() {
        const firstName = $('#window_first_name').val().trim();
        const lastName = $('#window_last_name').val().trim();
        const mobile = $('#window_mobile_number').val().trim();
        const email = $('#window_email_address').val().trim();
        
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const isValidEmail = emailRegex.test(email);
        
        const mobileRegex = /^[0-9]{10,11}$/;
        const isValidMobile = mobileRegex.test(mobile.replace(/\s/g, ''));
        
        return firstName && lastName && mobile && email && isValidEmail && isValidMobile;
    }
    
    /**
     * Update Next button state
     */
    function updateNextButtonState() {
        const currentStep = getCurrentStep();
        
        // Step 13 is index 12 (0-based indexing)
        if (currentStep !== 12) {
            return;
        }
        
        const isComplete = isCustomerFormComplete();
        const $nextBtn = $('.next-step');
        
        if (isComplete) {
            $nextBtn.removeClass('inactive').prop('disabled', false);
            $('#window_customer_info_complete').val('1');
        } else {
            $nextBtn.addClass('inactive').prop('disabled', true);
            $('#window_customer_info_complete').val('0');
        }
    }
    
    // ===== STEP CHANGE HANDLER =====
    $(document).on('stepChanged', function(event, stepIndex) {
        console.log('Step changed to:', stepIndex);
        
        if (stepIndex === 12) { // Entering Step 13
            console.log('Entering Step 13 - Saving price');
            saveCurrentPrice();
            updateNextButtonState();
        }
        
        if (stepIndex === 13) { // Entering Step 14 (Summary)
            console.log('Entering Step 14 - Restoring price');
            restorePrice();
        }
    });
    
    // Form input handlers
    $('#window_first_name, #window_last_name, #window_mobile_number, #window_email_address').on('input', function() {
        updateNextButtonState();
        
        // Remove error class on input
        $(this).removeClass('error');
    });
    
    // Blur validation for email and mobile
    $('#window_email_address').on('blur', function() {
        const email = $(this).val().trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (email && !emailRegex.test(email)) {
            $(this).addClass('error');
        } else {
            $(this).removeClass('error');
        }
        updateNextButtonState();
    });
    
    $('#window_mobile_number').on('blur', function() {
        const mobile = $(this).val().trim();
        const mobileRegex = /^[0-9]{10,11}$/;
        
        if (mobile && !mobileRegex.test(mobile.replace(/\s/g, ''))) {
            $(this).addClass('error');
        } else {
            $(this).removeClass('error');
        }
        updateNextButtonState();
    });
    
    // Initial check
    setTimeout(function() {
        const currentStep = getCurrentStep();
        if (currentStep === 12) {
            console.log('Initial check for Step 13');
            saveCurrentPrice();
            updateNextButtonState();
        }
    }, 500);
});
</script>