<?php
/**
 * Template part for Customer Information Step in Door Builder
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

        <!-- Customer Form - Two column layout exactly like 1.png -->
        <div class="customer-form-wrapper">
            <form class="customer-form" id="customer-info-form">
                
                <!-- First Row: First Name and Last Name side by side -->
                <div class="form-row">
                    <div class="form-field">
                        <label for="first_name">FIRST NAME</label>
                        <input 
                            type="text" 
                            name="first_name" 
                            id="first_name" 
                            class="customer-input" 
                            placeholder="John" 
                            value="" 
                            required
                        >
                    </div>

                    <div class="form-field">
                        <label for="last_name">LAST NAME</label>
                        <input 
                            type="text" 
                            name="last_name" 
                            id="last_name" 
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
                        <label for="mobile_number">MOBILE NUMBER</label>
                        <input 
                            type="tel" 
                            name="mobile_number" 
                            id="mobile_number" 
                            class="customer-input" 
                            placeholder="e.g. 07935566384" 
                            value="" 
                            required
                        >
                    </div>

                    <div class="form-field">
                        <label for="email_address">EMAIL ADDRESS</label>
                        <input 
                            type="email" 
                            name="email_address" 
                            id="email_address" 
                            class="customer-input" 
                            placeholder="sales@fastfolduk.co.uk" 
                            value="" 
                            required
                        >
                    </div>
                </div>

                <!-- Marketing Consent Text (no checkbox as per 1.png) -->
                <div class="form-consent">
                    <p class="consent-text">By completing this form you agree to receive marketing communications</p>
                </div>

                <!-- Hidden field to store form completion status -->
                <input type="hidden" name="customer_info_complete" id="customer_info_complete" value="0">
            </form>
        </div>

        <!-- Note: Previous/Next buttons are handled by the main builder navigation -->

    </div>
</div>

<style>
/* ================================
   Customer Information Step Styles
   Exactly matching 1.png design
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

/* Features Row - with empty checkboxes */
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

.feature-checkbox {
    color: #0CBB07;
    font-size: 20px;
    font-weight: normal;
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
    color: #000;
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
 * Step 12 - Customer Information Form
 */
jQuery(document).ready(function($) {
    
    // ===== STORE PRICE COMPONENTS =====
    let priceComponents = {
        basePrice: 0,
        outsideColourPrice: 0,
        insideColourPrice: 0,
        glassPrice: 0,
        ventsPrice: 0,
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
     * Calculate all price components
     */
    function calculateAllPriceComponents() {
        const paneCount = window.getPaneCount ? window.getPaneCount() : 1;
        
        // Base price
        priceComponents.basePrice = parseFloat($('#base_price_value').val()) || 0;
        
        // Outside Colour (Step 4)
        const outsideColour = $('input[name="door_colour"]:checked').val();
        const customRalValue = $('#custom_colour_select').val();
        
        if (outsideColour === 'custom_ral' && customRalValue && customRalValue !== '') {
            const selectedOption = $('#custom_colour_select option:selected');
            priceComponents.outsideColourPrice = (parseFloat(selectedOption.data('price')) || 195) * paneCount;
        } else if (outsideColour && outsideColour !== 'custom_ral' && 
                   outsideColour !== 'anthracite_grey' && outsideColour !== 'black' && outsideColour !== 'white') {
            const selectedOption = $('#custom_colour_select option[value="' + outsideColour + '"]');
            priceComponents.outsideColourPrice = (parseFloat(selectedOption.data('price')) || 195) * paneCount;
        } else {
            priceComponents.outsideColourPrice = 0;
        }
        
        // Inside Colour (Step 5)
        const insideColour = $('input[name="inside_colour"]:checked').val();
        const customInsideRalValue = $('#custom_inside_colour_select').val();
        
        if (insideColour === 'custom_ral' && customInsideRalValue && customInsideRalValue !== '') {
            const selectedOption = $('#custom_inside_colour_select option:selected');
            priceComponents.insideColourPrice = (parseFloat(selectedOption.data('price')) || 195) * paneCount;
        } else if (insideColour && insideColour !== 'custom_ral' && 
                   insideColour !== 'anthracite_grey' && insideColour !== 'black' && insideColour !== 'white') {
            const selectedOption = $('#custom_inside_colour_select option[value="' + insideColour + '"]');
            priceComponents.insideColourPrice = (parseFloat(selectedOption.data('price')) || 195) * paneCount;
        } else {
            priceComponents.insideColourPrice = 0;
        }
        
        // Glass (Step 7)
        const glassValue = $('input[name="glass_upgrade"]:checked');
        if (glassValue.length) {
            const price = parseFloat(glassValue.data('price')) || 0;
            priceComponents.glassPrice = price * paneCount;
        } else {
            priceComponents.glassPrice = 0;
        }
        
        // Trickle Vents (Step 8)
        const ventsValue = $('input[name="trickle_vents"]:checked').val();
        priceComponents.ventsPrice = (ventsValue === 'yes_trickle') ? 85 : 0;
        
        // Calculate total
        priceComponents.total = priceComponents.basePrice + 
                                 priceComponents.outsideColourPrice + 
                                 priceComponents.insideColourPrice + 
                                 priceComponents.glassPrice + 
                                 priceComponents.ventsPrice;
        
        console.log('Step 12 - Price components saved:', priceComponents);
        return priceComponents;
    }
    
    /**
     * Save current price when entering Step 12
     */
    function saveCurrentPrice() {
        calculateAllPriceComponents();
        console.log('Step 12: Price saved - Total:', priceComponents.total);
    }
    
    /**
     * Restore price when leaving Step 12
     */
    function restorePrice() {
        // Recalculate to be sure
        calculateAllPriceComponents();
        
        // Update all price displays
        $('#final_price_input').val(priceComponents.total.toFixed(2));
        $('#final-price-confirm').text('£' + priceComponents.total.toFixed(2));
        $('#submit-price').text('£' + priceComponents.total.toFixed(2));
        
        // Update Step 13 if it's active
        if ($('#summary-total-price').length) {
            $('#summary-total-price').text(priceComponents.total.toFixed(2));
        }
        
        console.log('Step 13: Price restored - Total:', priceComponents.total);
    }
    
    /**
     * Check if form is complete
     */
    function isCustomerFormComplete() {
        const firstName = $('#first_name').val().trim();
        const lastName = $('#last_name').val().trim();
        const mobile = $('#mobile_number').val().trim();
        const email = $('#email_address').val().trim();
        
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
        
        if (currentStep !== 11) { // Step 12 is index 11
            return;
        }
        
        const isComplete = isCustomerFormComplete();
        const $nextBtn = $('.next-step');
        
        if (isComplete) {
            $nextBtn.removeClass('inactive').prop('disabled', false);
            $('#customer_info_complete').val('1');
        } else {
            $nextBtn.addClass('inactive').prop('disabled', true);
            $('#customer_info_complete').val('0');
        }
    }
    
    // ===== STEP CHANGE HANDLER =====
    $(document).on('stepChanged', function(event, stepIndex) {
        console.log('Step changed to:', stepIndex);
        
        if (stepIndex === 11) { // Entering Step 12
            console.log('Entering Step 12 - Saving price');
            saveCurrentPrice();
            updateNextButtonState();
        }
        
        if (stepIndex === 12) { // Entering Step 13
            console.log('Entering Step 13 - Restoring price');
            restorePrice();
        }
    });
    
    // Form input handlers
    $('#first_name, #last_name, #mobile_number, #email_address').on('input', function() {
        updateNextButtonState();
    });
    
    // Initial check
    setTimeout(function() {
        const currentStep = getCurrentStep();
        if (currentStep === 11) {
            console.log('Initial check for Step 12');
            saveCurrentPrice();
            updateNextButtonState();
        }
    }, 500);
});
</script>