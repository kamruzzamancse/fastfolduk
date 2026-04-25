<?php
/**
 * Template part for Installation Type Selection step in Window Builder
 * 
 * @package Astra Child
 */

$images_dir = get_stylesheet_directory_uri() . '/assets/images/bifolding-windows/';
?>

<!-- Step 11: Installation Type Selection -->
<div class="wizard-step" data-step="11" id="window-installation-step">
    <div class="step-container">

        <div class="step-title">
            <h2>Supply & Installation</h2>
            <p>Choose your supply and installation option for your window. Base supply only (collection) is included.</p>
        </div>

        <div class="installation-options-container">
            <div class="installation-options-grid">

                <!-- Supply Only - Collection -->
                <div class="installation-option-card">
                    <input type="radio" name="window_installation_type" id="window_install_collection" value="collection" data-price="0" checked>
                    <label for="window_install_collection">
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
                    <input type="radio" name="window_installation_type" id="window_install_delivery" value="delivery" data-price="delivery_calculated">
                    <label for="window_install_delivery">
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

                <!-- Install into Existing Opening -->
                <div class="installation-option-card">
                    <input type="radio" name="window_installation_type" id="window_install_existing" value="install_existing" data-price="299">
                    <label for="window_install_existing">
                        <div class="installation-radio-visual"></div>
                        <div class="installation-image-container">
                            <img src="<?php echo esc_url($images_dir . 'installed-into-prepared-opening.png'); ?>" alt="Install into Existing Opening" loading="lazy">
                        </div>
                        <div class="installation-label-content">
                            <span class="installation-option-title">Install into Existing Opening</span>
                            <div class="installation-price-wrapper">
                                <span class="installation-option-price">+£299</span>
                                <span class="installation-price-vat">(INC. VAT)</span>
                            </div>
                        </div>
                    </label>
                </div>

                <!-- Install into New Build Opening (with photo upload) -->
                <div class="installation-option-card">
                    <input type="radio" name="window_installation_type" id="window_install_new_build" value="install_new_build" data-price="499">
                    <label for="window_install_new_build">
                        <div class="installation-radio-visual"></div>
                        <div class="installation-image-container">
                            <img src="<?php echo esc_url($images_dir . 'remove-existing-install.png'); ?>" alt="Install into New Build Opening" loading="lazy">
                        </div>
                        <div class="installation-label-content">
                            <span class="installation-option-title">Install into New Build Opening</span>
                            <div class="installation-price-wrapper">
                                <span class="installation-option-price">+£499</span>
                                <span class="installation-price-vat">(INC. VAT)</span>
                            </div>
                        </div>
                    </label>
                </div>

            </div>
        </div>

        <!-- Photo Upload Section - Only visible for Install into New Build Opening -->
        <div class="installation-photo-upload" id="window-photo-upload-section" style="display: none;">
            <div class="upload-header">
                <h3>Upload photo of your window area</h3>
                <p>Please provide a clear photo to help our installation team prepare</p>
            </div>
            
            <div class="upload-single">
                <div class="upload-box single">
                    <div class="upload-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#2e7d32" stroke-width="1.5">
                            <rect x="2" y="2" width="20" height="20" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5" fill="#2e7d32"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                    </div>
                    <h4>Window Photo</h4>
                    <p class="upload-help">Upload a clear photo of your existing window area</p>
                    <div class="file-input-wrapper">
                        <input type="file" id="window_photo" name="window_photo" accept="image/jpeg,image/png,image/jpg" class="installation-file-input">
                        <button type="button" class="upload-button" onclick="document.getElementById('window_photo').click();">Choose File</button>
                        <span class="file-name" id="window-photo-file-name">No file chosen</span>
                    </div>
                </div>
            </div>
            
            <!-- Preview Section -->
            <div class="upload-preview" id="window-photo-preview" style="display: none;">
                <div class="preview-header">
                    <h4>Uploaded Photo Preview</h4>
                </div>
                <div class="preview-image-container">
                    <img id="window-photo-preview-img" src="" alt="Photo Preview">
                    <button type="button" class="remove-photo-btn" id="window-remove-photo">✕ Remove</button>
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
    
    let isPhotoUploaded = false;
    let uploadedPhotoId = null;
    let uploadedPhotoUrl = null;
    
    // Show/hide photo upload section based on selection
    $('input[name="window_installation_type"]').on('change', function() {
        var selectedValue = $(this).val();
        
        // Show photo upload section only for 'install_new_build' option
        if (selectedValue === 'install_new_build') {
            $('#window-photo-upload-section').slideDown(300);
        } else {
            $('#window-photo-upload-section').slideUp(300);
        }
        
        // Trigger price update
        if (typeof window.updatePrice === 'function') {
            window.updatePrice();
        }
        
        if (typeof window.updateDrawer === 'function') {
            window.updateDrawer();
        }
        
        // Trigger validation
        if (typeof window.validateCurrentStep === 'function') {
            window.validateCurrentStep();
        }
    });
    
    /**
     * Handle photo upload via AJAX
     */
    $('#window_photo').on('change', function() {
        var file = this.files[0];
        
        if (!file) {
            return;
        }
        
        // Validate file type
        var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!allowedTypes.includes(file.type)) {
            alert('Invalid file type. Please upload JPG or PNG image.');
            $(this).val('');
            $('#window-photo-file-name').text('No file chosen');
            return;
        }
        
        // Validate file size (max 5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert('File too large. Maximum size is 5MB.');
            $(this).val('');
            $('#window-photo-file-name').text('No file chosen');
            return;
        }
        
        // Update file name display
        $('#window-photo-file-name').text(file.name);
        
        // Create FormData for AJAX upload
        var formData = new FormData();
        formData.append('action', 'upload_window_photo');
        formData.append('window_photo', file);
        formData.append('security', window.windowBuilderData?.nonce || '');
        
        // Show loading indicator
        var $uploadBox = $('.upload-box.single');
        $uploadBox.addClass('uploading');
        $uploadBox.find('.upload-button').text('Uploading...').prop('disabled', true);
        
        // Make AJAX call
        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    isPhotoUploaded = true;
                    uploadedPhotoId = response.data.id;
                    uploadedPhotoUrl = response.data.url;
                    
                    // Show preview
                    $('#window-photo-preview-img').attr('src', uploadedPhotoUrl);
                    $('#window-photo-preview').slideDown(300);
                    
                    // Update button text
                    $uploadBox.find('.upload-button').text('Change File');
                    
                    // Store photo URL in hidden field for form submission
                    if ($('#window_photo_url').length === 0) {
                        $('<input>').attr({
                            type: 'hidden',
                            id: 'window_photo_url',
                            name: 'window_photo_url',
                            value: uploadedPhotoUrl
                        }).appendTo('#window-builder-form');
                    } else {
                        $('#window_photo_url').val(uploadedPhotoUrl);
                    }
                    
                    if (window.isDev && window.isDev()) {
                        console.log('Photo uploaded successfully:', response.data);
                    }
                    
                    // Trigger validation
                    if (typeof window.validateCurrentStep === 'function') {
                        window.validateCurrentStep();
                    }
                    
                } else {
                    alert('Upload failed: ' + (response.data || 'Unknown error'));
                    $('#window_photo').val('');
                    $('#window-photo-file-name').text('No file chosen');
                }
            },
            error: function(xhr, status, error) {
                alert('Network error. Please try again.');
                $('#window_photo').val('');
                $('#window-photo-file-name').text('No file chosen');
                if (window.isDev && window.isDev()) {
                    console.log('Upload error:', error);
                }
            },
            complete: function() {
                $uploadBox.removeClass('uploading');
                $uploadBox.find('.upload-button').prop('disabled', false);
                if ($uploadBox.find('.upload-button').text() !== 'Change File') {
                    $uploadBox.find('.upload-button').text('Choose File');
                }
            }
        });
    });
    
    /**
     * Remove uploaded photo
     */
    $('#window-remove-photo').on('click', function() {
        $('#window_photo').val('');
        $('#window-photo-file-name').text('No file chosen');
        $('#window-photo-preview').slideUp(300);
        $('#window-photo-preview-img').attr('src', '');
        
        isPhotoUploaded = false;
        uploadedPhotoId = null;
        uploadedPhotoUrl = null;
        
        if ($('#window_photo_url').length) {
            $('#window_photo_url').val('');
        }
        
        // Trigger validation
        if (typeof window.validateCurrentStep === 'function') {
            window.validateCurrentStep();
        }
    });
    
    // Validation function for installation step
    window.validateWindowInstallationStep = function() {
        var selectedType = $('input[name="window_installation_type"]:checked').val();
        
        // Photo required for 'install_new_build' option
        if (selectedType === 'install_new_build') {
            if (!isPhotoUploaded && !$('#window_photo').val()) {
                return false;
            }
        }
        
        return true;
    };
    
    // Get installation price
    window.getWindowInstallationPrice = function() {
        var selectedType = $('input[name="window_installation_type"]:checked').val();
        
        switch(selectedType) {
            case 'collection': return 0;
            case 'delivery': return parseFloat($('#window_delivery_price').val()) || 0;
            case 'install_existing': return 299;
            case 'install_new_build': return 499;
            default: return 0;
        }
    };
    
    // Get installation display text
    window.getWindowInstallationText = function() {
        var selectedType = $('input[name="window_installation_type"]:checked').val();
        
        switch(selectedType) {
            case 'collection': return 'Supply Only – Collection';
            case 'delivery': return 'Supply Only – Delivery';
            case 'install_existing': return 'Install into Existing Opening';
            case 'install_new_build': return 'Install into New Build Opening';
            default: return '—';
        }
    };
    
    // Check if photo is uploaded
    window.isWindowPhotoUploaded = function() {
        return isPhotoUploaded || !!$('#window_photo').val();
    };
    
    // Get uploaded photo URL
    window.getWindowUploadedPhoto = function() {
        return uploadedPhotoUrl || $('#window_photo_url').val() || '';
    };
    
    if (window.isDev && window.isDev()) {
        console.log('Step 11 (Installation) initialized for Window Builder with Photo Upload');
    }
});
</script>

<style>
/* ================================
   Installation Type Selection Styles
   ================================ */

#window-installation-step .step-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
}

#window-installation-step .step-title {
    text-align: left;
    margin-bottom: 25px;
}

#window-installation-step .step-title h2 {
    font-size: 28px;
    color: #222;
    font-weight: 600;
    margin: 0 0 8px 0;
    line-height: 1.2;
}

#window-installation-step .step-title p {
    font-size: 16px;
    color: #555;
    margin: 0;
    line-height: 1.5;
}

#window-installation-step .installation-options-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 25px;
    margin: 25px 0;
}

#window-installation-step .installation-option-card {
    border: 1px solid #e0e0e0;
    background: #fff;
    position: relative;
    transition: all 0.2s ease;
    cursor: pointer;
}

#window-installation-step .installation-option-card:hover {
    border-color: #2e7d32;
}

#window-installation-step .installation-option-card input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

#window-installation-step .installation-option-card label {
    display: block;
    cursor: pointer;
    padding: 0;
    margin: 0;
    position: relative;
}

#window-installation-step .installation-radio-visual {
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

#window-installation-step .installation-option-card input[type="radio"]:checked + label .installation-radio-visual {
    background: #2e7d32;
    border-color: #2e7d32;
    box-shadow: inset 0 0 0 4px #fff, 0 2px 4px rgba(0,0,0,0.1);
}

#window-installation-step .installation-option-card input[type="radio"]:checked + label {
    outline: 2px solid #2e7d32;
    outline-offset: -1px;
}

#window-installation-step .installation-image-container {
    background: #f5f5f5;
    padding: 25px 20px;
    text-align: center;
    border-bottom: 1px solid #eee;
}

#window-installation-step .installation-image-container img {
    max-width: 100%;
    height: auto;
    max-height: 130px;
    display: block;
    margin: 0 auto;
}

#window-installation-step .installation-label-content {
    padding: 15px 12px;
    text-align: left;
    background: #fff;
}

#window-installation-step .installation-option-title {
    font-weight: 500;
    color: #222;
    display: block;
    margin-bottom: 6px;
    font-size: 14px;
    line-height: 1.4;
}

#window-installation-step .installation-price-wrapper {
    display: flex;
    align-items: baseline;
    flex-wrap: wrap;
    gap: 5px;
}

#window-installation-step .installation-option-price {
    color: #000;
    font-weight: 600;
    font-size: 14px;
}

#window-installation-step .installation-price-vat {
    color: #666;
    font-size: 11px;
    font-weight: 400;
}

/* Photo Upload Section */
#window-installation-step .installation-photo-upload {
    margin-top: 40px;
    padding: 30px;
    background: #fff;
    border: 1px solid #e0e0e0;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    border-radius: 12px;
}

#window-installation-step .upload-header {
    text-align: center;
    margin-bottom: 25px;
}

#window-installation-step .upload-header h3 {
    font-size: 22px;
    color: #222;
    font-weight: 600;
    margin: 0 0 8px 0;
}

#window-installation-step .upload-header p {
    font-size: 15px;
    color: #666;
    margin: 0;
}

#window-installation-step .upload-single {
    display: flex;
    justify-content: center;
}

#window-installation-step .upload-box.single {
    border: 2px dashed #d0d0d0;
    padding: 35px 30px;
    text-align: center;
    background: #fafafa;
    width: 100%;
    max-width: 400px;
    transition: all 0.25s ease;
    border-radius: 12px;
}

#window-installation-step .upload-box.single:hover {
    border-color: #2e7d32;
    background: #fff;
}

#window-installation-step .upload-box.single.uploading {
    opacity: 0.6;
    pointer-events: none;
}

#window-installation-step .upload-icon {
    margin-bottom: 20px;
}

#window-installation-step .upload-box h4 {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin: 0 0 10px 0;
}

#window-installation-step .upload-help {
    font-size: 14px;
    color: #777;
    margin: 0 0 25px 0;
    line-height: 1.5;
}

#window-installation-step .file-input-wrapper {
    position: relative;
}

#window-installation-step .installation-file-input {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

#window-installation-step .upload-button {
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

#window-installation-step .upload-button:hover {
    background: #1e5622;
}

#window-installation-step .file-name {
    display: block;
    margin-top: 15px;
    font-size: 13px;
    color: #666;
    word-break: break-all;
}

/* Preview Section */
.upload-preview {
    margin-top: 20px;
    padding: 15px;
    background: #f9f9f9;
    border-radius: 8px;
    text-align: center;
}

.preview-header h4 {
    font-size: 14px;
    color: #333;
    margin-bottom: 10px;
}

.preview-image-container {
    position: relative;
    display: inline-block;
}

.preview-image-container img {
    max-width: 325px;
    max-height: auto;
    border-radius: 4px;
    border: 1px solid #ddd;
}

.remove-photo-btn {
    position: absolute;
    top: -10px;
    right: -10px;
    background: #dc3545;
    color: white;
    border: none;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    font-size: 12px;
    cursor: pointer;
    transition: background 0.2s;
}

.remove-photo-btn:hover {
    background: #c82333;
}

#window-installation-step .upload-note {
    text-align: center;
    margin-top: 20px;
    color: #999;
    font-style: italic;
    font-size: 13px;
}

/* Responsive */
@media (max-width: 1200px) {
    #window-installation-step .installation-options-grid { gap: 20px; }
    #window-installation-step .installation-image-container img { max-height: 120px; }
}

@media (max-width: 992px) {
    #window-installation-step .installation-options-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }
    #window-installation-step .installation-radio-visual { width: 20px; height: 20px; top: 12px; right: 12px; }
}

@media (max-width: 768px) {
    #window-installation-step .step-title h2 { font-size: 24px; }
    #window-installation-step .installation-options-grid { grid-template-columns: 1fr; gap: 15px; }
    #window-installation-step .installation-image-container { padding: 15px; }
    #window-installation-step .installation-image-container img { max-height: 140px; }
    #window-installation-step .installation-label-content { padding: 12px; }
    #window-installation-step .installation-option-title { font-size: 14px; }
    #window-installation-step .installation-option-price { font-size: 14px; }
    #window-installation-step .installation-price-vat { font-size: 11px; }
    #window-installation-step .installation-radio-visual { width: 18px; height: 18px; top: 10px; right: 10px; border-width: 2px; }
    #window-installation-step .installation-photo-upload { padding: 20px; }
    #window-installation-step .upload-box.single { padding: 25px 20px; }
}

@media (max-width: 480px) {
    #window-installation-step .installation-image-container img { max-height: 120px; }
    .preview-image-container img { max-width: 150px; max-height: 120px; }
}
</style>