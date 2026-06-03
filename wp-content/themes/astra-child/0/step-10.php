<?php
/**
 * Template part for Postcode / Zip Code Step in Window Builder
 * Step 10: What's your postcode? (with delivery calculation)
 *
 * @package Astra Child
 */
?>

<!-- Step 10: Postcode Input with Delivery Calculator -->
<div class="wizard-step" data-step="10">
    <div class="step-container postcode-container">
        <div class="step-title postcode-title">
            <h2>What's your postcode?</h2>
            <p class="postcode-description">Please supply your full postcode for delivery calculation</p>
        </div>
       
        <div class="postcode-input-wrapper">
            <input 
                type="text" 
                name="postcode" 
                id="window_postcode" 
                class="postcode-input" 
                placeholder="SW1A 1AA" 
                value="" 
                maxlength="8"
                autocomplete="postal-code"
            >
            
            <!-- Delivery preview container -->
            <div id="window-delivery-preview-container" class="delivery-preview" style="display: none;"></div>
            
            <!-- Hidden fields to store delivery data -->
            <input type="hidden" name="delivery_price" id="window_delivery_price" value="0">
            <input type="hidden" name="delivery_zone" id="window_delivery_zone" value="">
            <input type="hidden" name="delivery_distance" id="window_delivery_distance" value="0">
            <input type="hidden" name="delivery_bespoke" id="window_delivery_bespoke" value="0">
        </div>
    </div>
</div>

<style>
/* ================================
   Postcode Step Styles for Window Builder
   ================================ */
.postcode-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 40px 20px 60px;
}

.postcode-title {
    text-align: center;
    margin-bottom: 40px;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}

.postcode-title h2 {
    font-size: 32px;
    color: #222;
    font-weight: 600;
    margin: 0 0 10px 0;
    line-height: 1.3;
}

.postcode-description {
    font-size: 18px;
    color: #666;
    margin: 0;
    line-height: 1.5;
}

.postcode-input-wrapper {
    max-width: 500px;
    margin: 0 auto;
}

.postcode-input {
    width: 100%;
    padding: 18px 20px;
    font-size: 18px;
    border: 1px solid #9f988c;
    background: #f7f5ef;
    color: #333;
    outline: none;
    transition: all 0.25s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.02);
}

.postcode-input:hover {
    border-color: #9c7b4b;
}

.postcode-input:focus {
    border-color: #9c7b4b;
    box-shadow: 0 0 0 3px rgba(156, 123, 75, 0.15);
}

.postcode-input::placeholder {
    color: #aaa;
    text-transform: none;
    font-weight: 400;
    opacity: 1;
}

/* Delivery Preview Styles */
.delivery-preview {
    margin-top: 25px;
    padding: 20px;
    background: #ffffff;
    border: 1px solid #e8e8e8;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    font-size: 15px;
}

.delivery-preview .loading {
    color: #666;
    font-style: italic;
    text-align: center;
    padding: 15px;
    background: #f9f9f9;
    border-radius: 8px;
}

.delivery-result {
    padding: 15px;
    border-radius: 8px;
}

.delivery-result.free-delivery {
    background: #e8f5e8;
    border-left: 4px solid #4caf50;
}

.delivery-result.paid-delivery {
    background: #f8f8f8;
    border-left: 4px solid #cbbfa9;
}

.delivery-result > div {
    margin: 8px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.delivery-result .delivery-zone {
    font-weight: 600;
    color: #1a1a1a;
    border-bottom: 1px dashed #ddd;
    padding-bottom: 8px;
    margin-bottom: 8px;
}

.delivery-result .delivery-price {
    font-weight: 700;
    color: #1a1a1a;
    font-size: 18px;
    margin-top: 10px;
    padding-top: 10px;
    border-top: 2px solid #e0e0e0;
}

/* VAT text styling */
.vat-text {
    font-size: 10px;
    font-weight: 400;
    color: #666;
    margin-left: 2px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    vertical-align: super;
    white-space: nowrap;
}

.delivery-result.free-delivery .delivery-price {
    color: #2e7d32;
}

.bespoke-warning {
    padding: 20px;
    background: #fff3e0;
    border-left: 4px solid #ff9800;
    border-radius: 8px;
    color: #333;
}

.bespoke-warning strong {
    color: #d32f2f;
    display: block;
    margin-bottom: 12px;
    font-size: 18px;
}

.bespoke-warning .contact-info {
    background: #fff;
    padding: 12px 15px;
    border-radius: 6px;
    margin-top: 10px;
}

.delivery-error {
    padding: 15px;
    background: #ffebee;
    border-left: 4px solid #f44336;
    border-radius: 8px;
    color: #c62828;
}

@media (max-width: 768px) {
    .postcode-container {
        padding: 30px 15px 40px;
    }
    
    .postcode-title h2 {
        font-size: 26px;
    }
    
    .postcode-description {
        font-size: 16px;
    }
    
    .postcode-input {
        font-size: 16px;
        padding: 15px 18px;
    }
    
    .delivery-result > div {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    
    .vat-text {
        font-size: 8px;
    }
}

@media (max-width: 480px) {
    .vat-text {
        font-size: 7px;
    }
}
</style>

<script>
jQuery(document).ready(function($) {
    
    // Flag to prevent multiple simultaneous AJAX calls
    let isAjaxInProgress = false;
    let lastCheckedPostcode = '';
    let debounceTimer = null;
    
    /**
     * Function to trigger price updates across the builder
     */
    function triggerPriceUpdate() {
        // Update main price function if exists
        if (typeof window.updatePrice === 'function') {
            window.updatePrice();
        }
        
        // Update drawer if exists
        if (typeof window.updateDrawer === 'function') {
            window.updateDrawer();
        }
        
        // Update summary if on last step
        if (typeof window.updateSummary === 'function') {
            window.updateSummary();
        }
        
        // Trigger custom event for other components
        $(document).trigger('deliveryDataUpdated');
        $(document).trigger('priceUpdated');
        
        if (window.isDev && window.isDev()) {
            console.log('Price update triggered after delivery calculation');
        }
    }
    
    /**
     * Main function to check delivery and update UI
     */
    function checkDelivery(postcode) {
        // Prevent duplicate calls for same postcode
        if (postcode === lastCheckedPostcode && !isAjaxInProgress) {
            if (window.isDev && window.isDev()) {
                console.log('Duplicate postcode check blocked:', postcode);
            }
            return;
        }
        
        const $previewContainer = $('#window-delivery-preview-container');
        const $nextBtn = $('.next-step');
        const $nextFooterBtn = $('.next-footer-btn');
        
        // Clear any existing content first
        $previewContainer.empty().show();
        $previewContainer.html('<div class="loading">Checking delivery for ' + postcode + '...</div>');
        
        // Set flags
        isAjaxInProgress = true;
        lastCheckedPostcode = postcode;
        
        // Get AJAX URL and nonce from window builder data
        let ajaxUrl = '';
        let nonce = '';
        
        if (typeof window.windowBuilderData !== 'undefined') {
            ajaxUrl = window.windowBuilderData.ajax_url || '';
            nonce = window.windowBuilderData.nonce || '';
        }
        
        if (window.isDev && window.isDev()) {
            console.log('AJAX URL:', ajaxUrl);
            console.log('Postcode:', postcode);
        }
        
        // Make AJAX call
        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {
                action: 'check_window_delivery',
                postcode: postcode,
                security: '<?php echo wp_create_nonce('window_builder_ajax'); ?>'
            },
            success: function(response) {
                if (window.isDev && window.isDev()) {
                    console.log('AJAX Success Response:', response);
                }
                
                // Clear container first
                $previewContainer.empty();
                
                if (response.success) {
                    const data = response.data;
                    
                    if (window.isDev && window.isDev()) {
                        console.log('Delivery Data:', data);
                    }
                    
                    // Store delivery data globally
                    window.windowDeliveryData = data;
                    
                    // Update hidden fields
                    $('#window_delivery_price').val(data.price);
                    $('#window_delivery_zone').val(data.zone);
                    $('#window_delivery_distance').val(data.distance);
                    $('#window_delivery_bespoke').val(data.bespoke ? '1' : '0');
                    
                    if (data.bespoke) {
                        // Bespoke delivery - show warning
                        const message = data.message || 'Bespoke delivery required for ' + data.zone;
                        
                        $previewContainer.html(
                            '<div class="bespoke-warning">' +
                            '<strong>⚠️ Bespoke Delivery Required</strong>' +
                            '<div>' + message + '</div>' +
                            '<div class="contact-info">📞 Call us: <strong>01234 567890</strong></div>' +
                            '</div>'
                        );
                        
                        // Disable next button
                        $nextBtn.addClass('inactive').prop('disabled', true);
                        if ($nextFooterBtn.length) {
                            $nextFooterBtn.addClass('inactive').prop('disabled', true);
                        }
                        
                        // Update all prices (delivery not added)
                        triggerPriceUpdate();
                        
                    } else {
                        // Standard delivery - show price with VAT
                        const priceText = data.price === 0 ? 'FREE' : '£' + parseFloat(data.price).toFixed(2) + ' <span class="vat-text">(inc. VAT)</span>';
                        const zoneClass = data.price === 0 ? 'free-delivery' : 'paid-delivery';
                        
                        // Format distance
                        const distanceDisplay = data.distance ? parseFloat(data.distance).toFixed(1) + ' miles' : '—';
                        
                        // Delivery days estimate based on price
                        let deliveryDays = '';
                        if (data.price === 0) {
                            deliveryDays = '(2-3 working days)';
                        } else if (data.price <= 150) {
                            deliveryDays = '(3-5 working days)';
                        } else if (data.price <= 250) {
                            deliveryDays = '(5-7 working days)';
                        } else {
                            deliveryDays = '(7-10 working days)';
                        }
                        
                        $previewContainer.html(
                            '<div class="delivery-result ' + zoneClass + '">' +
                            '<div class="delivery-zone">📍 Zone: <strong>' + data.zone + '</strong></div>' +
                            '<div class="delivery-distance">📏 Distance: <strong>' + distanceDisplay + '</strong></div>' +
                            '<div class="delivery-price">🚚 Delivery Cost: <strong>' + priceText + '</strong> ' + deliveryDays + '</div>' +
                            '</div>'
                        );
                        
                        // Enable next button
                        $nextBtn.removeClass('inactive').prop('disabled', false);
                        if ($nextFooterBtn.length) {
                            $nextFooterBtn.removeClass('inactive').prop('disabled', false);
                        }
                        
                        // Update all prices with new delivery charge
                        triggerPriceUpdate();
                    }
                    
                } else {
                    // Error response
                    if (window.isDev && window.isDev()) {
                        console.log('AJAX Error Response:', response);
                    }
                    
                    $previewContainer.html(
                        '<div class="delivery-error">❌ ' + (response.data?.message || 'Error checking postcode') + '</div>'
                    );
                    
                    // Disable next button
                    $nextBtn.addClass('inactive').prop('disabled', true);
                    if ($nextFooterBtn.length) {
                        $nextFooterBtn.addClass('inactive').prop('disabled', true);
                    }
                    
                    // Reset delivery data on error
                    window.windowDeliveryData = null;
                    $('#window_delivery_price').val('0');
                    $('#window_delivery_zone').val('');
                    $('#window_delivery_distance').val('0');
                    $('#window_delivery_bespoke').val('0');
                    
                    // Update prices (delivery removed)
                    triggerPriceUpdate();
                }
            },
            error: function(xhr, status, error) {
                if (window.isDev && window.isDev()) {
                    console.log('AJAX Error - Status:', status);
                    console.log('AJAX Error - Message:', error);
                    console.log('AJAX Error - Response:', xhr.responseText);
                }
                
                $previewContainer.html(
                    '<div class="delivery-error">❌ Network error. Please try again.</div>'
                );
                
                $nextBtn.addClass('inactive').prop('disabled', true);
                if ($nextFooterBtn.length) {
                    $nextFooterBtn.addClass('inactive').prop('disabled', true);
                }
                
                // Reset delivery data on error
                window.windowDeliveryData = null;
                $('#window_delivery_price').val('0');
                $('#window_delivery_zone').val('');
                $('#window_delivery_distance').val('0');
                $('#window_delivery_bespoke').val('0');
                
                // Update prices (delivery removed)
                triggerPriceUpdate();
            },
            complete: function() {
                isAjaxInProgress = false;
            }
        });
    }
    
    /**
     * Handle postcode input with debounce
     */
    $('#window_postcode').on('input', function() {
        // Format: uppercase, no spaces
        let val = $(this).val().toUpperCase().replace(/\s+/g, '');
        $(this).val(val);
        
        // Clear previous timer
        if (debounceTimer) {
            clearTimeout(debounceTimer);
        }
        
        // If postcode is empty, hide preview and disable next
        if (val.length === 0) {
            $('#window-delivery-preview-container').fadeOut();
            $('.next-step, .next-footer-btn').addClass('inactive').prop('disabled', true);
            
            // Reset delivery data
            window.windowDeliveryData = null;
            $('#window_delivery_price').val('0');
            $('#window_delivery_zone').val('');
            $('#window_delivery_distance').val('0');
            $('#window_delivery_bespoke').val('0');
            
            // Update prices (delivery removed)
            triggerPriceUpdate();
            return;
        }
        
        // Debounce AJAX call
        debounceTimer = setTimeout(function() {
            checkDelivery(val);
        }, 800); // Wait 800ms after user stops typing
    });
    
    /**
     * Format postcode on blur (for display only)
     */
    $('#window_postcode').on('blur', function() {
        let val = $(this).val().trim().toUpperCase().replace(/\s+/g, '');
        
        // Add space for UK postcodes (e.g., DY28UB → DY2 8UB)
        if (val.length > 3 && val.length <= 7) {
            // Format as "DY2 8UB"
            val = val.substring(0, val.length - 3) + ' ' + val.substring(val.length - 3);
        } else if (val.length === 7) {
            // Format as "SW1A 1AA"
            val = val.substring(0, val.length - 3) + ' ' + val.substring(val.length - 3);
        }
        
        // Only update if value changed
        if ($(this).val() !== val) {
            $(this).val(val);
        }
    });
    
    /**
     * Check if postcode is pre-filled on page load
     */
    const initialPostcode = $('#window_postcode').val().trim();
    if (initialPostcode.length > 0) {
        setTimeout(function() {
            checkDelivery(initialPostcode.replace(/\s+/g, ''));
        }, 500);
    }
    
    /**
     * Edit mode: Restore delivery data if available
     */
    if (window.editMode && window.editData && window.editData.postcode) {
        const savedPostcode = window.editData.postcode;
        $('#window_postcode').val(savedPostcode);
        
        // Trigger delivery check after page loads
        setTimeout(function() {
            $('#window_postcode').trigger('input');
        }, 1000);
    }
    
    /**
     * Global functions for other steps to access delivery data
     */
    window.getWindowDeliveryData = function() {
        return window.windowDeliveryData || {
            price: parseFloat($('#window_delivery_price').val()) || 0,
            zone: $('#window_delivery_zone').val() || '',
            distance: parseFloat($('#window_delivery_distance').val()) || 0,
            bespoke: $('#window_delivery_bespoke').val() === '1'
        };
    };
    
    window.getWindowDeliveryCost = function() {
        const data = window.getWindowDeliveryData();
        if (data.bespoke) return 'Bespoke (call for quote)';
        if (data.price === 0) return 'FREE';
        return '£' + data.price.toFixed(2) + ' (inc. VAT)';
    };
    
    window.getWindowDeliveryPrice = function() {
        const data = window.getWindowDeliveryData();
        return data.bespoke ? 0 : data.price;
    };
    
    window.isWindowDeliveryAllowed = function() {
        const data = window.getWindowDeliveryData();
        return !data.bespoke;
    };
    
    window.isWindowBespokeDelivery = function() {
        const data = window.getWindowDeliveryData();
        return data.bespoke;
    };
    
    // Development logging
    window.isDev = function() {
        return window.location.hostname === 'localhost' || 
               window.location.hostname === '127.0.0.1';
    };
    
    if (window.isDev()) {
        console.log('Step 10 (Postcode) initialized for Window Builder with VAT indicator');
    }
    
});
</script>