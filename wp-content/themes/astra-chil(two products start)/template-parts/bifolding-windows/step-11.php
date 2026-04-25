<?php
/**
 * Template part for Installation Type Selection step in Door Builder
 * Place this after postcode step and before final summary
 * 
 * @package Astra Child
 */

// Get images directory
$images_dir = get_stylesheet_directory_uri() . '/assets/images/bifolding-doors/';
?>

<!-- Step 11: Installation Type Selection -->
<div class="wizard-step" data-step="11" id="installation-step">
    <div class="step-container">

        <!-- Main Title -->
        <div class="step-title">
            <h2>Supply & Installation</h2>
            <p>Choose your supply and installation option. Base supply only (collection) is included.</p>
        </div>

        <!-- Options Container -->
        <div class="installation-options-container">
            <div class="installation-options-grid">

                <!-- Supply Only - Collection -->
                <div class="installation-option-card">
                    <input type="radio" name="installation_type" id="install_collection" value="collection" class="installation-price-option" data-price="0" checked>
                    <label for="install_collection">
                        <div class="installation-radio-visual"></div>
                        <div class="installation-image-container">
                            <img src="<?php echo esc_url($images_dir . 'supply-only-collection.png'); ?>" alt="Supply Only - Collection" loading="lazy">
                        </div>
                        <div class="installation-label-content">
                            <span class="installation-option-title">Supply Only – Collection</span>
                            <div class="installation-price-wrapper">
                                <span class="installation-option-price">+£0.00</span>
                                <span class="installation-price-vat">(INC. VAT)</span>
                            </div>
                        </div>
                    </label>
                </div>

                <!-- Supply Only - Delivery -->
                <div class="installation-option-card">
                    <input type="radio" name="installation_type" id="install_delivery" value="delivery" class="installation-price-option" data-price="delivery_calculated">
                    <label for="install_delivery">
                        <div class="installation-radio-visual"></div>
                        <div class="installation-image-container">
                            <img src="<?php echo esc_url($images_dir . 'supply-only-delivery.png'); ?>" alt="Supply Only - Delivery" loading="lazy">
                        </div>
                        <div class="installation-label-content">
                            <span class="installation-option-title">Supply Only – Delivery</span>
                            <div class="installation-price-wrapper">
                                <span class="installation-option-price">Calculated at checkout</span>
                            </div>
                        </div>
                    </label>
                </div>

                <!-- Installed into Prepared Opening -->
                <div class="installation-option-card">
                    <input type="radio" name="installation_type" id="install_prepared" value="prepared_opening" class="installation-price-option" data-price="per_panel" data-base-price="200">
                    <label for="install_prepared">
                        <div class="installation-radio-visual"></div>
                        <div class="installation-image-container">
                            <img src="<?php echo esc_url($images_dir . 'installed-into-prepared-opening.png'); ?>" alt="Installed into Prepared Opening" loading="lazy">
                        </div>
                        <div class="installation-label-content">
                            <span class="installation-option-title">Installed into Prepared Opening</span>
                            <div class="installation-price-wrapper">
                                <span class="installation-option-price" id="prepared-price">+£200 × panels</span>
                                <span class="installation-price-vat">(INC. VAT)</span>
                            </div>
                        </div>
                    </label>
                </div>

                <!-- Remove Existing Doors & Install -->
                <div class="installation-option-card">
                    <input type="radio" name="installation_type" id="install_remove" value="remove_existing" class="installation-price-option" data-price="removal" data-base-price="200" data-removal-fee="550">
                    <label for="install_remove">
                        <div class="installation-radio-visual"></div>
                        <div class="installation-image-container">
                            <img src="<?php echo esc_url($images_dir . 'remove-existing-install.png'); ?>" alt="Remove Existing Doors & Install" loading="lazy">
                        </div>
                        <div class="installation-label-content">
                            <span class="installation-option-title">Remove Existing Doors & Install</span>
                            <div class="installation-price-wrapper">
                                <span class="installation-option-price" id="removal-price">+£200 × panels + £550</span>
                                <span class="installation-price-vat">(INC. VAT)</span>
                            </div>
                        </div>
                    </label>
                </div>

            </div>
        </div>

        <!-- Single Photo Upload Section - Only visible for Remove Existing option -->
        <div class="installation-photo-upload" id="photo-upload-section" style="display: none;">
            <div class="upload-header">
                <h3>Upload photo of your existing door</h3>
                <p>Please provide a clear photo to help our installation team prepare</p>
            </div>
            
            <div class="upload-single">
                <!-- Single Photo Upload -->
                <div class="upload-box single">
                    <div class="upload-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#2e7d32" stroke-width="1.5">
                            <rect x="2" y="2" width="20" height="20" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5" fill="#2e7d32"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                    </div>
                    <h4>Door Photo</h4>
                    <p class="upload-help">Upload a clear photo of your existing door</p>
                    <div class="file-input-wrapper">
                        <input type="file" id="door_photo" name="door_photo" accept="image/jpeg,image/png,image/jpg" class="installation-file-input">
                        <button type="button" class="upload-button" onclick="document.getElementById('door_photo').click();">Choose File</button>
                        <span class="file-name" id="photo-file-name">No file chosen</span>
                    </div>
                </div>
            </div>
            
            <div class="upload-note">
                <small>Accepted formats: JPG, PNG. Max file size: 5MB</small>
            </div>
        </div>

    </div>
</div>

<script>
jQuery(document).ready(function($) {
    // Get panel count
    var panelCount = 1;
    
    // Try to get panel count from various sources
    function getCurrentPanelCount() {
        if (typeof window.getPaneCount === 'function') {
            return window.getPaneCount();
        }
        
        // Try to get from hidden field or global variable
        if (window.panelCount) {
            return window.panelCount;
        }
        
        // Default
        return 1;
    }
    
    // Update panel count when available
    function updatePanelCount() {
        var newCount = getCurrentPanelCount();
        if (newCount !== panelCount) {
            panelCount = newCount;
            updateInstallationPrices();
        }
    }
    
    // Update price displays based on panel count
    function updateInstallationPrices() {
        var preparedPrice = panelCount * 200;
        var removalPrice = (panelCount * 200) + 550;
        
        $('#prepared-price').text('+£' + preparedPrice.toFixed(2));
        $('#removal-price').text('+£' + removalPrice.toFixed(2));
        
        // Store prices in data attributes for other scripts to read
        $('#install_prepared').data('calculated-price', preparedPrice);
        $('#install_remove').data('calculated-price', removalPrice);
    }
    
    // Initialize prices
    updatePanelCount();
    updateInstallationPrices();
    
    // Show/hide photo upload section based on selection
    $('input[name="installation_type"]').on('change', function() {
        var selectedValue = $(this).val();
        
        if (selectedValue === 'remove_existing') {
            $('#photo-upload-section').slideDown(300);
        } else {
            $('#photo-upload-section').slideUp(300);
        }
        
        // ===== IMPORTANT: Trigger price update for drawer and summary =====
        if (typeof window.updatePrice === 'function') {
            window.updatePrice();
        }
        
        if (typeof window.updateDrawer === 'function') {
            window.updateDrawer();
        }
        
        // Trigger custom event for other scripts
        $(document).trigger('installationTypeChanged', [selectedValue]);
    });
    
    // File input change handler for single photo
    $('#door_photo').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $('#photo-file-name').text(fileName || 'No file chosen');
    });
    
    // Validation function
    window.validateInstallationStep = function() {
        var selectedType = $('input[name="installation_type"]:checked').val();
        
        if (selectedType === 'remove_existing') {
            var photoFile = $('#door_photo').val();
            
            if (!photoFile) {
                alert('Please upload a photo of your existing door');
                return false;
            }
        }
        
        return true;
    };
    
    // Listen for panel count updates
    $(document).on('panelCountUpdated', function(e, count) {
        panelCount = count;
        updateInstallationPrices();
    });
    
    // Also listen for step changes to update panel count
    $(document).on('stepChanged', function() {
        updatePanelCount();
        updateInstallationPrices();
    });
    
    // Initial panel count update after a short delay
    setTimeout(function() {
        updatePanelCount();
        updateInstallationPrices();
    }, 500);
});
</script>

<style>
/* ================================
   Installation Type Selection Styles
   With Green Theme Color (#2e7d32)
   ================================ */

/* Step Container */
#installation-step .step-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Step Title */
#installation-step .step-title {
    text-align: left;
    margin-bottom: 25px;
}

#installation-step .step-title h2 {
    font-size: 28px;
    color: #222;
    font-weight: 600;
    margin: 0 0 8px 0;
    line-height: 1.2;
}

#installation-step .step-title p {
    font-size: 16px;
    color: #555;
    margin: 0;
    line-height: 1.5;
}

/* Options Grid */
#installation-step .installation-options-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 25px;
    margin: 25px 0;
}

/* Option Card */
#installation-step .installation-option-card {
    border: 1px solid #e0e0e0;
    background: #fff;
    position: relative;
    transition: all 0.2s ease;
    cursor: pointer;
}

#installation-step .installation-option-card:hover {
    border-color: #2e7d32;
}

/* Radio Input - Hidden but functional */
#installation-step .installation-option-card input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

/* Label */
#installation-step .installation-option-card label {
    display: block;
    cursor: pointer;
    padding: 0;
    margin: 0;
    position: relative;
}

/* VISUAL RADIO BUTTON - Green theme */
#installation-step .installation-radio-visual {
    position: absolute;
    top: 15px;
    right: 15px;
    width: 22px;
    height: 22px;
    border: 2px solid #2e7d32;
    border-radius: 50%;
    background: #fff;
    z-index: 10;
    transition: all 0.2s ease;
    pointer-events: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Selected state for visual radio - Green fill with white center */
#installation-step .installation-option-card input[type="radio"]:checked + label .installation-radio-visual {
    background: #2e7d32;
    border-color: #2e7d32;
    box-shadow: inset 0 0 0 4px #fff, 0 2px 4px rgba(0,0,0,0.1);
}

/* Selected card border - Green */
#installation-step .installation-option-card input[type="radio"]:checked + label {
    outline: 2px solid #2e7d32;
    outline-offset: -1px;
}

/* Image Container */
#installation-step .installation-image-container {
    background: #f5f5f5;
    padding: 25px 20px;
    text-align: center;
    border-bottom: 1px solid #eee;
}

#installation-step .installation-image-container img {
    max-width: 100%;
    height: auto;
    max-height: 130px;
    display: block;
    margin: 0 auto;
}

/* Label Content */
#installation-step .installation-label-content {
    padding: 15px 12px;
    text-align: left;
    background: #fff;
}

#installation-step .installation-option-title {
    font-weight: 500;
    color: #222;
    display: block;
    margin-bottom: 6px;
    font-size: 14px;
    line-height: 1.4;
}

/* Price wrapper */
#installation-step .installation-price-wrapper {
    display: flex;
    align-items: baseline;
    flex-wrap: wrap;
    gap: 5px;
}

#installation-step .installation-option-price {
    color: #000;
    font-weight: 600;
    font-size: 14px;
}

#installation-step .installation-price-vat {
    color: #666;
    font-size: 11px;
    font-weight: 400;
}

/* Single Photo Upload Section */
#installation-step .installation-photo-upload {
    margin-top: 40px;
    padding: 30px;
    background: #fff;
    border: 1px solid #e0e0e0;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

#installation-step .upload-header {
    text-align: center;
    margin-bottom: 25px;
}

#installation-step .upload-header h3 {
    font-size: 22px;
    color: #222;
    font-weight: 600;
    margin: 0 0 8px 0;
}

#installation-step .upload-header p {
    font-size: 15px;
    color: #666;
    margin: 0;
}

#installation-step .upload-single {
    display: flex;
    justify-content: center;
}

#installation-step .upload-box.single {
    border: 2px dashed #d0d0d0;
    padding: 35px 30px;
    text-align: center;
    background: #fafafa;
    width: 100%;
    max-width: 400px;
    transition: all 0.25s ease;
}

#installation-step .upload-box.single:hover {
    border-color: #2e7d32;
    background: #fff;
}

#installation-step .upload-icon {
    margin-bottom: 20px;
}

#installation-step .upload-box h4 {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin: 0 0 10px 0;
}

#installation-step .upload-help {
    font-size: 14px;
    color: #777;
    margin: 0 0 25px 0;
    line-height: 1.5;
}

#installation-step .file-input-wrapper {
    position: relative;
}

#installation-step .installation-file-input {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

#installation-step .upload-button {
    background: #2e7d32;
    color: white;
    border: none;
    padding: 12px 30px;
    cursor: pointer;
    font-size: 15px;
    font-weight: 500;
    display: inline-block;
    border-radius: 4px;
    transition: background 0.2s ease;
}

#installation-step .upload-button:hover {
    background: #1e5622;
}

#installation-step .file-name {
    display: block;
    margin-top: 15px;
    font-size: 13px;
    color: #666;
    word-break: break-all;
}

#installation-step .upload-note {
    text-align: center;
    margin-top: 20px;
    color: #999;
    font-style: italic;
    font-size: 13px;
}

/* Responsive Design */
@media (max-width: 1200px) {
    #installation-step .installation-options-grid {
        gap: 20px;
    }
    
    #installation-step .installation-image-container img {
        max-height: 120px;
    }
}

@media (max-width: 992px) {
    #installation-step .installation-options-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    #installation-step .installation-radio-visual {
        width: 20px;
        height: 20px;
        top: 12px;
        right: 12px;
    }
}

@media (max-width: 768px) {
    #installation-step .step-title h2 {
        font-size: 24px;
    }
    
    #installation-step .installation-options-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    #installation-step .installation-image-container {
        padding: 15px;
    }
    
    #installation-step .installation-image-container img {
        max-height: 140px;
    }
    
    #installation-step .installation-label-content {
        padding: 12px;
    }
    
    #installation-step .installation-option-title {
        font-size: 14px;
    }
    
    #installation-step .installation-option-price {
        font-size: 14px;
    }
    
    #installation-step .installation-price-vat {
        font-size: 11px;
    }
    
    #installation-step .installation-radio-visual {
        width: 18px;
        height: 18px;
        top: 10px;
        right: 10px;
        border-width: 2px;
    }
    
    #installation-step .installation-option-card input[type="radio"]:checked + label .installation-radio-visual {
        box-shadow: inset 0 0 0 3px #fff;
    }
    
    #installation-step .installation-photo-upload {
        padding: 20px;
    }
    
    #installation-step .upload-box.single {
        padding: 25px 20px;
    }
}

@media (max-width: 480px) {
    #installation-step .installation-image-container img {
        max-height: 120px;
    }
}
</style>