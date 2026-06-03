<?php
/**
 * Template part for Opening Direction step in Window Builder
 * 
 * @package Astra Child
 */

// Get images directory
$images_dir = get_stylesheet_directory_uri() . '/assets/images/bifolding-windows/';
?>

<!-- Step 3: Opening Direction -->
<div class="wizard-step" data-step="3">
    <div class="step-container">

        <div class="step-title">
            <h2>Which way would you like your windows to open?</h2>
            <p>All drawings shown are viewed from the outside</p>
        </div>
        
        <div class="options-container">
            <div class="option-group">

                <div class="open-options-grid">

                    <!-- Inwards -->
                    <div class="open-option-card">
                        <input type="radio" name="open_direction" id="window_inwards" value="inwards" class="price-option" data-price="0">
                        <label for="window_inwards">
                            <div class="open-image">
                                <img src="<?php echo esc_url($images_dir . 'Inwards_Opening.webp'); ?>" alt="Inwards Opening" loading="lazy">
                            </div>
                            <div class="open-details">
                                <span class="option-name">Inwards</span>
                                <span class="option-price"></span>
                            </div>
                        </label>
                    </div>

                    <!-- Outwards (DEFAULT SELECTED) -->
                    <div class="open-option-card">
                        <input type="radio" name="open_direction" id="window_outwards" value="outwards" class="price-option" data-price="0" checked>
                        <label for="window_outwards">
                            <div class="open-image">
                                <img src="<?php echo esc_url($images_dir . 'Outwards_Opening.webp'); ?>" alt="Outwards Opening" loading="lazy">
                            </div>
                            <div class="open-details">
                                <span class="option-name">Outwards</span>
                                <span class="option-price"></span>
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
   Step-3 Opening Direction Styles
   ================================ */

.options-container {
    margin-bottom: 120px;
}

.open-options-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-top: 20px;
    max-width: 1400px;
    margin-left: auto;
    margin-right: auto;
}

.open-option-card {
    border: 1px solid #e5e0d8;
    border-radius: 2px;
    overflow: hidden;
    transition: all 0.25s ease;
    cursor: pointer;
    height: 100%;
    background: #faf7f2;
}

.open-option-card:hover {
    border-color: #cbbfa9;
    box-shadow: 0 4px 10px rgba(0,0,0,0.06);
}

.open-option-card input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.open-option-card label {
    display: flex;
    flex-direction: column;
    height: 100%;
    padding: 18px;
    cursor: pointer;
    transition: all 0.25s ease;
    background: transparent;
}

.open-option-card input:checked + label {
    background: #f3efe8;
    box-shadow: inset 0 0 0 1px #222;
}

.open-image {
    margin-bottom: 16px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 320px!important;
    flex: 1;
    background: #fff;
    border: 1px solid #e5e0d8;
    padding: 12px;
    border-radius: 2px;
}

.open-image img {
    max-width: 100%;
    max-height: 150px;
    width: auto;
    height: auto;
    object-fit: contain;
}

.open-option-card input:checked + label .open-image {
    border-color: #222;
}

.open-details {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    border-top: 1px solid #e5e0d8;
    padding-top: 12px;
    margin-top: 10px;
}

.open-details .option-name {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 15px;
    font-weight: 500;
    color: #222;
    line-height: 1.3;
}

.open-details .option-name::before {
    content: "";
    width: 14px;
    height: 14px;
    border: 1.5px solid #222;
    border-radius: 50%;
    display: inline-block;
    box-sizing: border-box;
}

.open-details .option-price {
    font-size: 15px;
    font-weight: 600;
    color: #222;
    white-space: nowrap;
}

.open-option-card input:checked + label .open-details .option-name::before {
    background: #222;
    box-shadow: inset 0 0 0 3px #faf7f2;
}

/* Responsive */
@media (max-width: 768px) {
    .open-options-grid {
        grid-template-columns: 1fr;
        gap: 15px;
        padding: 0 15px;
    }
    
    .open-option-card label {
        padding: 15px;
    }
    
    .open-image {
        min-height: 120px;
    }
    
    .open-image img {
        max-height: 120px;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .open-options-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        padding: 0 20px;
    }
    
    .open-image {
        min-height: 130px;
    }
}

@media (min-width: 1400px) {
    .open-options-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
    }
    
    .open-option-card label {
        padding: 30px 25px;
    }
    
    .open-image {
        min-height: 160px;
    }
}

.step-container {
    max-width: 1400px;
    margin: 0 auto;
}

.step-title h2 {
    font-size: 28px;
    color: #1a1a1a;
    margin-bottom: 10px;
    font-weight: 500;
}

.step-title p {
    font-size: 16px;
    color: #666;
    margin-bottom: 30px;
    line-height: 1.6;
}
</style>