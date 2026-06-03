<?php
/**
 * Template part for Handle Colour Selection step in Window Builder
 * 
 * @package Astra Child
 */

// Get images directory
$images_dir = get_stylesheet_directory_uri() . '/assets/images/bifolding-windows/';
?>

<!-- Step 6: Handle Colour Selection -->
<div class="wizard-step" data-step="6">
    <div class="step-container">

        <div class="step-title">
            <h2>What colour handles do you want?</h2>
            <p>Choose the colour handles you'd like for your window</p>
        </div>
        
        <div class="options-container">
            <div class="option-group">
                <div class="handle-options">

                    <!-- White Handle -->
                    <div class="handle-option-card">
                        <input type="radio" name="window_handle_colour" id="window_handle_white" value="white" class="price-option" data-price="0" checked>
                        <label for="window_handle_white">
                            <div class="handle-image">
                                <img src="<?php echo esc_url($images_dir . 'handle-white.png'); ?>" alt="White Handle" loading="lazy">
                            </div>
                            <div class="handle-details">
                                <span class="option-name">White</span>
                            </div>
                        </label>
                    </div>

                    <!-- Chrome Handle -->
                    <div class="handle-option-card">
                        <input type="radio" name="window_handle_colour" id="window_handle_chrome" value="chrome" class="price-option" data-price="0">
                        <label for="window_handle_chrome">
                            <div class="handle-image">
                                <img src="<?php echo esc_url($images_dir . 'handle-chrome.png'); ?>" alt="Chrome Handle" loading="lazy">
                            </div>
                            <div class="handle-details">
                                <span class="option-name">Chrome</span>
                            </div>
                        </label>
                    </div>

                    <!-- Black Handle -->
                    <div class="handle-option-card">
                        <input type="radio" name="window_handle_colour" id="window_handle_black" value="black" class="price-option" data-price="0">
                        <label for="window_handle_black">
                            <div class="handle-image">
                                <img src="<?php echo esc_url($images_dir . 'handle-black.png'); ?>" alt="Black Handle" loading="lazy">
                            </div>
                            <div class="handle-details">
                                <span class="option-name">Black</span>
                            </div>
                        </label>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<style>
/* ================================
   Handle Colour Selection Styles
   ================================ */

/* Container alignment */
.step-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Step title */
.step-title {
    text-align: left;
    margin-bottom: 30px;
}

.step-title h2 {
    font-size: 28px;
    color: #222;
    font-weight: 600;
    margin: 0 0 10px 0;
    line-height: 1.3;
}

.step-title p {
    font-size: 16px;
    color: #666;
    margin: 0;
    line-height: 1.5;
    max-width: 800px;
}

/* Handle Options Container */
.handle-options {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    margin-top: 30px;
    max-width: 1360px;
    margin-left: auto;
    margin-right: auto;
}

/* Handle Option Card */
.handle-option-card {
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

.handle-option-card:hover {
    border-color: #9c7b4b;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Hide default radio input */
.handle-option-card input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

/* Label styling - full height */
.handle-option-card label {
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

/* Selected state - Card border */
.handle-option-card input:checked + label {
    border: 2px solid #9c7b4b;
    margin: -1px;
}

/* Handle image container */
.handle-image {
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

.handle-image img {
    width: 170px;
    height: auto;
    object-fit: contain;
    max-height: 100%;
}

/* Handle details */
.handle-details {
    padding: 15px;
    background: #fafafa;
    min-height: 60px;
    flex-shrink: 0;
    text-align: center;
}

.handle-details .option-name {
    font-weight: 500;
    color: #333;
    display: inline-block;
    text-align: center;
    line-height: 1.3;
    font-size: 13px;
}

/* Radio indicator */
.handle-details .option-name::before {
    content: "";
    display: inline-block;
    width: 14px;
    height: 14px;
    border: 1.5px solid #222;
    border-radius: 50%;
    margin-right: 10px;
    vertical-align: middle;
    transition: all 0.2s ease;
    box-sizing: border-box;
    flex-shrink: 0;
    position: relative;
}

/* Selected state for radio */
.handle-option-card input:checked + label .handle-details .option-name::before {
    background: #222;
    box-shadow: inset 0 0 0 3px #fafafa;
    border-color: #222;
}

/* Hover effect for radio */
.handle-option-card:hover .handle-details .option-name::before {
    border-color: #9c7b4b;
}

/* Selected card hover state */
.handle-option-card input:checked + label:hover .handle-details .option-name::before {
    border-color: #222;
    background: #222;
    box-shadow: inset 0 0 0 3px #fafafa;
}

/* ================================
   Responsive Design
   ================================ */

/* Large Desktop 1400px+ */
@media (min-width: 1400px) {
    .handle-options {
        gap: 30px;
        max-width: 1360px;
    }
    .handle-image {
        height: 210px;
        padding: 20px;
    }
    .handle-details .option-name {
        font-size: 16px;
    }
    .handle-details .option-name::before {
        width: 15px;
        height: 15px;
        border-width: 2px;
    }
    .handle-option-card input:checked + label .handle-details .option-name::before {
        box-shadow: inset 0 0 0 3.5px #fafafa;
    }
}

/* Desktop 1025px - 1399px */
@media (min-width: 1025px) and (max-width: 1399px) {
    .handle-options {
        gap: 25px;
    }
    .handle-image {
        height: 188px;
        padding: 18px;
    }
    .handle-details .option-name {
        font-size: 15px;
    }
    .handle-details .option-name::before {
        width: 14px;
        height: 14px;
    }
}

/* Small Desktop / Large Tablet 993px - 1024px */
@media (min-width: 993px) and (max-width: 1024px) {
    .handle-options {
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        max-width: 100%;
        padding: 0 20px;
    }
    .handle-image {
        height: 165px;
        padding: 15px;
    }
    .handle-details .option-name {
        font-size: 12px;
    }
    .handle-details .option-name::before {
        width: 13px;
        height: 13px;
    }
}

/* Tablet 769px - 992px */
@media (min-width: 769px) and (max-width: 992px) {
    .handle-options {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        padding: 0 20px;
        max-width: 100%;
    }
    .handle-image {
        height: 165px;
        padding: 15px;
    }
    .handle-details .option-name {
        font-size: 12px;
    }
    .handle-details .option-name::before {
        width: 13px;
        height: 13px;
    }
}

/* Mobile 768px and below */
@media (max-width: 768px) {
    .handle-options {
        grid-template-columns: 1fr;
        gap: 15px;
        padding: 0 15px;
    }
    .handle-image {
        height: 135px;
        padding: 12px;
    }
    .handle-details {
        padding: 12px;
        min-height: 50px;
    }
    .handle-details .option-name {
        font-size: 12px;
    }
    .handle-details .option-name::before {
        width: 12px;
        height: 12px;
        margin-right: 8px;
        border-width: 1.2px;
    }
    .handle-option-card input:checked + label .handle-details .option-name::before {
        box-shadow: inset 0 0 0 2px #fafafa;
    }
}

/* Small mobile 480px and below */
@media (max-width: 480px) {
    .handle-image {
        height: 120px;
        padding: 10px;
    }
    .handle-details {
        padding: 10px;
    }
}
</style>