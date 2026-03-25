<?php
/**
 * Template part for Access Issues Step in Door Builder
 * Step 12: Are there any access issues for delivering the doors?
 *
 * @package Astra Child
 */

// Get images directory
$images_dir = get_stylesheet_directory_uri() . '/assets/images/bifold-doors/';
?>

<!-- Step 12: Access Issues -->
<div class="wizard-step" data-step="12">
    <div class="step-container access-container">
        <div class="step-title access-title">
            <h2>Are there any access issues for delivering the doors?</h2>
            <p class="access-description">e.g. will the door fit through your house to get to the opening?</p>
        </div>
        
        <div class="access-wrapper">
            <div class="access-options">
                
                <!-- Yes, There Are Access Issues -->
                <div class="access-card" data-price="0">
                    <input type="radio" name="access_issues" id="access_yes" value="yes_access" class="price-option" data-price="0">
                    <label for="access_yes">
                        <div class="access-image">
                            <img src="<?php echo esc_url($images_dir . 'Union_500x.png'); ?>" 
                                srcset="<?php echo esc_url($images_dir . 'Union_500x.png'); ?> 1x, <?php echo esc_url($images_dir . 'Union_500x.png'); ?> 1x"
                                alt="Yes - Access Issues" 
                                class="access-tick-image access-image-toggle">
                        </div>
                        <div class="access-details">
                            <div class="access-text-content">
                                <div class="access-name-line">
                                    <span class="access-radio-indicator"></span>
                                    <span class="option-name">Yes</span>
                                </div>
                            </div>
                        </div>
                    </label>
                    
                    <!-- Textarea for describing access issues (hidden by default) -->
                    <div class="access-textarea-wrapper" style="display: none;">
                        <textarea 
                            name="access_description" 
                            id="access_description" 
                            class="access-textarea" 
                            placeholder="Please describe the access issues..." 
                            rows="3"
                        ></textarea>
                    </div>
                </div>
                
                <!-- No Access Issues -->
                <div class="access-card" data-price="0">
                    <input type="radio" name="access_issues" id="access_no" value="no_access" class="price-option" data-price="0" checked>
                    <label for="access_no">
                        <div class="access-image">
                            <img src="<?php echo esc_url($images_dir . 'Cross_500x.webp'); ?>" 
                                srcset="<?php echo esc_url($images_dir . 'Cross_500x.webp'); ?> 1x, <?php echo esc_url($images_dir . 'CCross_500x.webp'); ?> 1x"
                                alt="No Access Issues" 
                                class="access-cross-image access-image-toggle">
                        </div>
                        <div class="access-details">
                            <div class="access-text-content">
                                <div class="access-name-line">
                                    <span class="access-radio-indicator"></span>
                                    <span class="option-name">No</span>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {

    const $yesRadio = $('#access_yes');
    const $noRadio  = $('#access_no');
    const $yesCard  = $yesRadio.closest('.access-card');
    const $textareaWrapper = $yesCard.find('.access-textarea-wrapper');

    /* ===============================
       SHOW TEXTAREA
    =============================== */
    function showTextarea() {
        $yesRadio.prop('checked', true);
        $yesCard.addClass('textarea-active');
        $textareaWrapper.stop(true,true).slideDown(300);
        $('.access-card').removeClass('selected');
        $yesCard.addClass('selected');
        
        // Trigger validation
        if (typeof validateCurrentStep === 'function') {
            validateCurrentStep();
        }
        
        setTimeout(function(){
            $('#access_description').focus();
        },300);
    }

    /* ===============================
       HIDE TEXTAREA
    =============================== */
    function hideTextarea() {
        $noRadio.prop('checked', true);
        $yesCard.removeClass('textarea-active');
        $textareaWrapper.stop(true,true).slideUp(300);
        $('.access-card').removeClass('selected');
        $noRadio.closest('.access-card').addClass('selected');
        
        // Clear textarea when switching to No
        $('#access_description').val('');
        
        // Trigger validation
        if (typeof validateCurrentStep === 'function') {
            validateCurrentStep();
        }
    }

    /* ===============================
       IMAGE CLICK EVENTS
    =============================== */
    $(document).on('click','.access-tick-image',function(e){
        e.stopPropagation();
        showTextarea();
    });

    $(document).on('click','.access-cross-image',function(e){
        e.stopPropagation();
        hideTextarea();
    });

    /* ===============================
       CARD CLICK
    =============================== */
    $('.access-card').on('click',function(e){
        if($(e.target).is('textarea') ||
           $(e.target).hasClass('access-tick-image') ||
           $(e.target).hasClass('access-cross-image')){
            return;
        }

        const radio = $(this).find('input[type="radio"]');

        if(radio.attr('id') === 'access_yes'){
            showTextarea();
        } else {
            hideTextarea();
        }
    });

    /* ===============================
       TEXTAREA INPUT - VALIDATION
    =============================== */
    $('#access_description').on('input', function() {
        if (typeof validateCurrentStep === 'function') {
            validateCurrentStep();
        }
    });

    /* ===============================
       PREVENT TEXTAREA BUBBLE
    =============================== */
    $('.access-textarea').on('click',function(e){
        e.stopPropagation();
    });

    /* ===============================
       INITIAL STATE (PAGE LOAD)
    =============================== */
    // Default = NO selected
    hideTextarea();

});
</script>

<style>
/* ================================
   Access Issues Selection Styles
   ================================ */

.access-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
}

/* Title styling */
.access-title {
    text-align: left;
    margin-bottom: 30px;
}

.access-title h2 {
    font-size: 28px;
    color: #222;
    font-weight: 600;
    margin: 0 0 10px 0;
    line-height: 1.3;
}

.access-description {
    font-size: 16px;
    color: #666;
    margin: 0;
    line-height: 1.5;
    max-width: 800px;
}

/* Options grid - 2 cards in a row */
.access-options {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
    margin-top: 30px;
    max-width: 1360px!important;
    margin-left: auto;
    margin-right: auto;
}

/* Individual card styling */
.access-card {
    border: 1px solid #e0e0e0;
    overflow: hidden;
    transition: all 0.25s ease;
    cursor: pointer;
    height: auto;
    background: #fff;
    position: relative;
}

.access-card:hover {
    border-color: #9c7b4b;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Hide radio input */
.access-card input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.access-card label {
    display: flex;
    flex-direction: column;
    height: 100%;
    cursor: pointer;
    background: transparent;
}

.access-card input:checked + label {
    border: 2px solid #9c7b4b;
    margin: -1px;
}

/* Image container */
.access-image {
    height: 280px !important;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f5f5f5;
    padding: 25px;
    transition: all 0.3s ease;
}

.access-image img {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    object-fit: contain;
    transition: opacity 0.3s ease, transform 0.2s ease;
    cursor: pointer;
}

.access-image img:hover {
    transform: scale(1.02);
}

/* Hide tick image when textarea is active */
.access-card.textarea-active .access-tick-image {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}

/* Details container */
.access-details {
    padding: 15px;
    border-top: 1px solid #f0f0f0;
    background: #fafafa;
    min-height: 60px;
}

/* Text content container */
.access-text-content {
    display: flex;
    flex-direction: column;
    width: 100%;
}

/* Name line with radio indicator */
.access-name-line {
    display: flex;
    align-items: center;
    margin-bottom: 0;
    width: 100%;
    gap: 8px;
}

/* Radio indicator */
.access-radio-indicator {
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
.access-card input:checked + label .access-radio-indicator {
    background: #222;
    box-shadow: inset 0 0 0 3px #fafafa;
    border-color: #222;
}

/* Hover effect for radio indicator */
.access-card:hover .access-radio-indicator {
    border-color: #9c7b4b;
}

/* Selected card hover state */
.access-card input:checked + label:hover .access-radio-indicator {
    border-color: #222;
    background: #222;
    box-shadow: inset 0 0 0 3px #fafafa;
}

/* Textarea styling */
.access-textarea-wrapper {
    transition: all 0.3s ease;
    padding: 15px;
    background: #f9f9f9;
    border-top: 1px solid #e0e0e0;
}

.access-textarea {
    width: 100%;
    padding: 12px 15px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 6px;
    background: #fff;
    color: #333;
    resize: vertical;
    font-family: inherit;
    outline: none;
    transition: border-color 0.25s ease, box-shadow 0.25s ease;
    line-height: 1.5;
}

.access-textarea:focus {
    border-color: #9c7b4b;
    box-shadow: 0 0 0 2px rgba(156, 123, 75, 0.1);
}

.access-textarea::placeholder {
    color: #999;
    font-style: italic;
}

/* Option name styling */
.option-name {
    font-weight: 500;
    color: #333;
    display: inline-block;
    text-align: left;
    line-height: 1.3;
    font-size: 13px !important;
}

/* ================================
   Responsive Design
   ================================ */

@media (max-width: 768px) {
    .access-title h2 {
        font-size: 22px;
        padding: 0 15px;
    }
    
    .access-description {
        font-size: 14px;
        padding: 0 15px;
    }
    
    .access-options {
        grid-template-columns: 1fr;
        gap: 15px;
        padding: 0 15px;
        max-width: 100%;
    }
    
    .access-image {
        height: 180px !important;
        padding: 15px;
    }
    
    .access-details {
        padding: 12px;
        min-height: 50px;
    }
    
    .access-radio-indicator {
        width: 12px;
        height: 12px;
        border-width: 1.2px;
    }
    
    .access-card input:checked + label .access-radio-indicator {
        box-shadow: inset 0 0 0 2px #fafafa;
    }
    
    .option-name {
        font-size: 12px !important;
    }
    
    .access-textarea {
        font-size: 13px;
        padding: 10px 12px;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .access-options {
        gap: 20px;
        padding: 0 20px;
        max-width: 100%;
    }
    
    .access-image {
        height: 220px !important;
    }
    
    .access-radio-indicator {
        width: 13px;
        height: 13px;
    }
    
    .option-name {
        font-size: 12px !important;
    }
}

@media (min-width: 1025px) and (max-width: 1399px) {
    .access-options {
        gap: 25px;
        max-width: 800px;
    }
    
    .access-image {
        height: 250px !important;
    }
    
    .access-radio-indicator {
        width: 14px;
        height: 14px;
    }
}

@media (min-width: 1400px) {
    .access-options {
        gap: 30px;
        max-width: 900px;
    }
    
    .access-image {
        height: 280px !important;
    }
    
    .access-radio-indicator {
        width: 15px;
        height: 15px;
        border-width: 2px;
    }
    
    .access-card input:checked + label .access-radio-indicator {
        box-shadow: inset 0 0 0 3.5px #fafafa;
    }
}
</style>