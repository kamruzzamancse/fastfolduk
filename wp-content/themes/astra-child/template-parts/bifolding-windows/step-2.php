<?php
/**
 * Template part for Panel Configuration step in Window Builder
 * 
 * @package Astra Child
 */

// Get images directory
$images_dir = get_stylesheet_directory_uri() . '/assets/images/bifolding-windows/';
?>

<!-- Step 2: Panels Configuration -->
<div class="wizard-step" data-step="2">
    <div class="step-container">

        <div class="step-title">
            <h2>Select the number of panels and configuration of your windows</h2>
            <p>The configuration and number of panels available is dependent on the size of your window.</p>
        </div>
        
        <div class="options-container">
            <div class="option-group">
                <div class="panel-options">

                    <!-- ================== 2 PANELS ================== -->
                    <!-- 2 Panels Left -->
                    <div class="panel-option-card panel-2" data-base-price="0">
                        <input type="radio" name="window_panel_layout" id="panel_2_left" value="2_left" class="price-option" data-price="0" data-pane-count="2">
                        <label for="panel_2_left">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '2_Panel_Left_500x.webp'); ?>" alt="2 Panels Left" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">2 Panels Left</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 2 Panels Right -->
                    <div class="panel-option-card panel-2" data-base-price="0">
                        <input type="radio" name="window_panel_layout" id="panel_2_right" value="2_right" class="price-option" data-price="0" data-pane-count="2">
                        <label for="panel_2_right">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '2_Panel_Right_500x.webp'); ?>" alt="2 Panels Right" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">2 Panels Right</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- ================== 3 PANELS ================== -->
                    <!-- 3 Panels Left -->
                    <div class="panel-option-card panel-3"
                        data-min-width="2001"
                        data-max-width="2600"
                        data-price-2001="1190"
                        data-price-2200="1190"
                        data-price-2400="1290"
                        data-price-2600="1390">

                        <input type="radio" name="window_panel_layout"
                            id="panel_3_left"
                            value="3_left"
                            class="price-option panel3-option"
                            data-pane-count="3">

                        <label for="panel_3_left">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '3_Panel_Left_500x.webp'); ?>" alt="3 Panels Left" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">3 Panels Left</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 3 Panels Right -->
                    <div class="panel-option-card panel-3"
                        data-min-width="2001"
                        data-max-width="2600"
                        data-price-2001="1190"
                        data-price-2200="1190"
                        data-price-2400="1290"
                        data-price-2600="1390">

                        <input type="radio" name="window_panel_layout"
                            id="panel_3_right"
                            value="3_right"
                            class="price-option panel3-option"
                            data-pane-count="3">

                        <label for="panel_3_right">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '3_Panel_Right_500x.webp'); ?>" alt="3 Panels Right" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">3 Panels Right</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 1 + 2 Panels -->
                    <div class="panel-option-card panel-3"
                        data-min-width="2001"
                        data-max-width="2600"
                        data-price-2001="1190"
                        data-price-2200="1190"
                        data-price-2400="1290"
                        data-price-2600="1390">

                        <input type="radio" name="window_panel_layout" id="panel_1_2"
                            value="1_2"
                            class="price-option panel3-option"
                            data-pane-count="3">

                        <label for="panel_1_2">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '1_2_Panel_500x.webp'); ?>" alt="1 + 2 Panels" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">1 + 2 Panels</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 2 + 1 Panels -->
                    <div class="panel-option-card panel-3"
                        data-min-width="2001"
                        data-max-width="2600"
                        data-price-2001="1190"
                        data-price-2200="1190"
                        data-price-2400="1290"
                        data-price-2600="1390">

                        <input type="radio" name="window_panel_layout" id="panel_2_1"
                            value="2_1"
                            class="price-option panel3-option"
                            data-pane-count="3">

                        <label for="panel_2_1">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '2_1_Panel_500x.webp'); ?>" alt="2 + 1 Panels" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">2 + 1 Panels</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- ================== 4 PANELS ================== -->
                    <!-- 1 + 3 Panels -->
                    <div class="panel-option-card panel-4"
                        data-min-width="2601"
                        data-max-width="3400"
                        data-price-2601="1690"
                        data-price-3000="1790"
                        data-price-3400="1890">

                        <input type="radio" name="window_panel_layout" id="panel_1_3"
                            value="1_3"
                            class="price-option panel4-option"
                            data-pane-count="4">

                        <label for="panel_1_3">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '1_3_Panel_500x.webp'); ?>" alt="1 + 3 Panels" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">1 + 3 Panels</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 3 + 1 Panels -->
                    <div class="panel-option-card panel-4"
                        data-min-width="2601"
                        data-max-width="3400"
                        data-price-2601="1690"
                        data-price-3000="1790"
                        data-price-3400="1890">

                        <input type="radio" name="window_panel_layout" id="panel_3_1"
                            value="3_1"
                            class="price-option panel4-option"
                            data-pane-count="4">

                        <label for="panel_3_1">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '3_1_Panel_500x.webp'); ?>" alt="3 + 1 Panels" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">3 + 1 Panels</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 4 Panels Left -->
                    <div class="panel-option-card panel-4"
                        data-min-width="2601"
                        data-max-width="3400"
                        data-price-2601="1690"
                        data-price-3000="1790"
                        data-price-3400="1890">

                        <input type="radio" name="window_panel_layout" id="panel_4_left"
                            value="4_left"
                            class="price-option panel4-option"
                            data-pane-count="4">

                        <label for="panel_4_left">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '4_Panel_Left_500x.webp'); ?>" alt="4 Panels Left" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">4 Panels Left</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 4 Panels Right -->
                    <div class="panel-option-card panel-4"
                        data-min-width="2601"
                        data-max-width="3400"
                        data-price-2601="1690"
                        data-price-3000="1790"
                        data-price-3400="1890">

                        <input type="radio" name="window_panel_layout" id="panel_4_right"
                            value="4_right"
                            class="price-option panel4-option"
                            data-pane-count="4">

                        <label for="panel_4_right">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '4_Panel_Right_500x.webp'); ?>" alt="4 Panels Right" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">4 Panels Right</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 2 + 2 Panels -->
                    <div class="panel-option-card panel-4"
                        data-min-width="2601"
                        data-max-width="3400"
                        data-price-2601="1690"
                        data-price-3000="1790"
                        data-price-3400="1890">

                        <input type="radio" name="window_panel_layout" id="panel_2_2"
                            value="2_2"
                            class="price-option panel4-option"
                            data-pane-count="4">

                        <label for="panel_2_2">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '2_2_Panel_500x.webp'); ?>" alt="2 + 2 Panels" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">2 + 2 Panels</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- ================== 5 PANELS ================== -->
                    <!-- 1 + 4 Panels -->
                    <div class="panel-option-card panel-5"
                        data-min-width="3401"
                        data-max-width="4200"
                        data-price-3401="2190"
                        data-price-3800="2290"
                        data-price-4200="2390">

                        <input type="radio" name="window_panel_layout" id="panel_1_4" 
                               value="1_4" 
                               class="price-option panel5-option"
                               data-pane-count="5">

                        <label for="panel_1_4">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '1_4_Panels_500x.webp'); ?>" alt="1 + 4 Panels" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">1 + 4 Panels</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 4 + 1 Panels -->
                    <div class="panel-option-card panel-5"
                        data-min-width="3401"
                        data-max-width="4200"
                        data-price-3401="2190"
                        data-price-3800="2290"
                        data-price-4200="2390">

                        <input type="radio" name="window_panel_layout" id="panel_4_1" 
                               value="4_1" 
                               class="price-option panel5-option"
                               data-pane-count="5">

                        <label for="panel_4_1">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '4_1_Panels_500x.webp'); ?>" alt="4 + 1 Panels" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">4 + 1 Panels</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 5 Panels Left -->
                    <div class="panel-option-card panel-5"
                        data-min-width="3401"
                        data-max-width="4200"
                        data-price-3401="2190"
                        data-price-3800="2290"
                        data-price-4200="2390">

                        <input type="radio" name="window_panel_layout" id="panel_5_left" 
                               value="5_left" 
                               class="price-option panel5-option"
                               data-pane-count="5">

                        <label for="panel_5_left">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '5_Panel_Left_500x.webp'); ?>" alt="5 Panels Left" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">5 Panels Left</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 5 Panels Right -->
                    <div class="panel-option-card panel-5"
                        data-min-width="3401"
                        data-max-width="4200"
                        data-price-3401="2190"
                        data-price-3800="2290"
                        data-price-4200="2390">

                        <input type="radio" name="window_panel_layout" id="panel_5_right" 
                               value="5_right" 
                               class="price-option panel5-option"
                               data-pane-count="5">

                        <label for="panel_5_right">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '5_Panel_Right_500x.webp'); ?>" alt="5 Panels Right" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">5 Panels Right</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 2 + 3 Panels -->
                    <div class="panel-option-card panel-5"
                        data-min-width="3401"
                        data-max-width="4200"
                        data-price-3401="2190"
                        data-price-3800="2290"
                        data-price-4200="2390">

                        <input type="radio" name="window_panel_layout" id="panel_2_3" 
                               value="2_3" 
                               class="price-option panel5-option"
                               data-pane-count="5">

                        <label for="panel_2_3">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '2_3_Panels_500x.webp'); ?>" alt="2 + 3 Panels" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">2 + 3 Panels</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 3 + 2 Panels -->
                    <div class="panel-option-card panel-5"
                        data-min-width="3401"
                        data-max-width="4200"
                        data-price-3401="2190"
                        data-price-3800="2290"
                        data-price-4200="2390">

                        <input type="radio" name="window_panel_layout" id="panel_3_2" 
                               value="3_2" 
                               class="price-option panel5-option"
                               data-pane-count="5">

                        <label for="panel_3_2">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '3_2_Panels_500x.webp'); ?>" alt="3 + 2 Panels" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">3 + 2 Panels</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- ================== 6 PANELS ================== -->
                    <!-- 2 + 4 Panels -->
                    <div class="panel-option-card panel-6"
                        data-min-width="4201"
                        data-max-width="5800"
                        data-price-4201="2690"
                        data-price-4600="2790"
                        data-price-5000="2890"
                        data-price-5400="3090"
                        data-price-5800="3290">

                        <input type="radio" name="window_panel_layout" id="panel_2_4" 
                               value="2_4" 
                               class="price-option panel6-option"
                               data-pane-count="6">

                        <label for="panel_2_4">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '2_4_Panel_500x.avif'); ?>" alt="2 + 4 Panels" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">2 + 4 Panels</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 3 + 3 Panels -->
                    <div class="panel-option-card panel-6"
                        data-min-width="4201"
                        data-max-width="5800"
                        data-price-4201="2690"
                        data-price-4600="2790"
                        data-price-5000="2890"
                        data-price-5400="3090"
                        data-price-5800="3290">

                        <input type="radio" name="window_panel_layout" id="panel_3_3" 
                               value="3_3" 
                               class="price-option panel6-option"
                               data-pane-count="6">

                        <label for="panel_3_3">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '3_3_Panel_500x.avif'); ?>" alt="3 + 3 Panels" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">3 + 3 Panels</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 4 + 2 Panels -->
                    <div class="panel-option-card panel-6"
                        data-min-width="4201"
                        data-max-width="5800"
                        data-price-4201="2690"
                        data-price-4600="2790"
                        data-price-5000="2890"
                        data-price-5400="3090"
                        data-price-5800="3290">

                        <input type="radio" name="window_panel_layout" id="panel_4_2" 
                               value="4_2" 
                               class="price-option panel6-option"
                               data-pane-count="6">

                        <label for="panel_4_2">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '4_2_Panel_500x.avif'); ?>" alt="4 + 2 Panels" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">4 + 2 Panels</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 6 Panels Left -->
                    <div class="panel-option-card panel-6"
                        data-min-width="4201"
                        data-max-width="5800"
                        data-price-4201="2690"
                        data-price-4600="2790"
                        data-price-5000="2890"
                        data-price-5400="3090"
                        data-price-5800="3290">

                        <input type="radio" name="window_panel_layout" id="panel_6_left" 
                               value="6_left" 
                               class="price-option panel6-option"
                               data-pane-count="6">

                        <label for="panel_6_left">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '6_Panel_Left_500x.avif'); ?>" alt="6 Panels Left" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">6 Panels Left</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 6 Panels Right -->
                    <div class="panel-option-card panel-6"
                        data-min-width="4201"
                        data-max-width="5800"
                        data-price-4201="2690"
                        data-price-4600="2790"
                        data-price-5000="2890"
                        data-price-5400="3090"
                        data-price-5800="3290">

                        <input type="radio" name="window_panel_layout" id="panel_6_right" 
                               value="6_right" 
                               class="price-option panel6-option"
                               data-pane-count="6">

                        <label for="panel_6_right">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '6_Panel_Right_500x.avif'); ?>" alt="6 Panels Right" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">6 Panels Right</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 1 + 5 Panels -->
                    <div class="panel-option-card panel-6"
                        data-min-width="4201"
                        data-max-width="5800"
                        data-price-4201="2690"
                        data-price-4600="2790"
                        data-price-5000="2890"
                        data-price-5400="3090"
                        data-price-5800="3290">

                        <input type="radio" name="window_panel_layout" id="panel_1_5" 
                               value="1_5" 
                               class="price-option panel6-option"
                               data-pane-count="6">

                        <label for="panel_1_5">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '1_5_Panel_500x.avif'); ?>" alt="1 + 5 Panels" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">1 + 5 Panels</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 5 + 1 Panels -->
                    <div class="panel-option-card panel-6"
                        data-min-width="4201"
                        data-max-width="5800"
                        data-price-4201="2690"
                        data-price-4600="2790"
                        data-price-5000="2890"
                        data-price-5400="3090"
                        data-price-5800="3290">

                        <input type="radio" name="window_panel_layout" id="panel_5_1" 
                               value="5_1" 
                               class="price-option panel6-option"
                               data-pane-count="6">

                        <label for="panel_5_1">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '5_1_Panel_500x.avif'); ?>" alt="5 + 1 Panels" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">5 + 1 Panels</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Step 2 - Panel Configuration Styles */

.options-container {
    margin-bottom: 120px;
}

.panel-options {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-top: 20px;
    max-width: 1400px;
    margin-left: auto;
    margin-right: auto;
}

/* Panel Option Card */
.panel-option-card {
    border: 1px solid #e5e0d8;
    border-radius: 2px;
    overflow: hidden;
    transition: all 0.25s ease;
    cursor: pointer;
    height: 100%;
    background: #faf7f2;
}

.panel-option-card:hover {
    border-color: #cbbfa9;
    box-shadow: 0 4px 10px rgba(0,0,0,0.06);
}

/* Hide radio input */
.panel-option-card input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

/* Panel label */
.panel-option-card label {
    display: flex;
    flex-direction: column;
    height: 100%;
    padding: 18px;
    cursor: pointer;
    transition: all 0.25s ease;
    background: transparent;
}

/* Selected state */
.panel-option-card input:checked + label {
    background: #f3efe8;
    box-shadow: inset 0 0 0 1px #222;
}

/* Panel image container */
.panel-image {
    margin-bottom: 16px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 150px;
    flex: 1;
    background: #fff;
    border: 1px solid #e5e0d8;
    padding: 12px;
    border-radius: 2px;
}

.panel-image img {
    max-width: 100%;
    max-height: 150px;
    width: auto;
    height: auto;
    object-fit: contain;
}

/* When selected, image frame darker */
.panel-option-card input:checked + label .panel-image {
    border-color: #222;
}

/* Panel details section */
.panel-details {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    border-top: 1px solid #e5e0d8;
    padding-top: 12px;
    margin-top: 10px;
}

/* Option name styling */
.panel-details .option-name {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 15px;
    font-weight: 500;
    color: #222;
    line-height: 1.3;
}

/* Fake radio circle */
.panel-details .option-name::before {
    content: "";
    width: 14px;
    height: 14px;
    border: 1.5px solid #222;
    border-radius: 50%;
    display: inline-block;
    box-sizing: border-box;
}

/* Price styling */
.panel-details .option-price {
    font-size: 12px;
    font-weight: 600;
    color: #222;
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

/* VAT text styling */
.price-vat {
    font-size: 10px;
    font-weight: 400;
    color: #666;
    margin-left: 2px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    vertical-align: super;
}

/* Selected state - fill the circle */
.panel-option-card input:checked + label .panel-details .option-name::before {
    background: #222;
    box-shadow: inset 0 0 0 3px #faf7f2;
}

/* ================================
   Responsive Design
   ================================ */

@media (max-width: 1024px) {
    .panel-options {
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        padding: 0 20px;
    }
    
    .panel-image {
        min-height: 130px;
    }
    
    .panel-image img {
        max-height: 130px;
    }
}

@media (max-width: 768px) {
    .panel-options {
        grid-template-columns: 1fr;
        gap: 15px;
        padding: 0 15px;
    }
    
    .panel-option-card label {
        padding: 15px;
    }
    
    .panel-image {
        min-height: 120px;
    }
    
    .panel-image img {
        max-height: 120px;
    }
    
    .panel-details .option-name {
        font-size: 14px;
    }
    
    .panel-details .option-price {
        font-size: 12px;
    }
    
    .price-vat {
        font-size: 9px;
    }
}

@media (min-width: 1400px) {
    .panel-options {
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }
    
    .panel-option-card label {
        padding: 30px 25px;
    }
    
    .panel-image {
        min-height: 160px;
    }
    
    .panel-image img {
        max-height: 160px;
    }
    
    .panel-details .option-name {
        font-size: 17px;
    }
    
    .panel-details .option-price {
        font-size: 12px;
    }
}

/* Container alignment for consistency */
.step-container {
    max-width: 1400px;
    margin: 0 auto;
}

/* Step title styles */
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

<script>
/**
 * Window Builder - Step 2: Panel Configuration
 * Handles panel selection, price calculation, and dynamic panel visibility based on width
 */

jQuery(document).ready(function($) {
    
    /**
     * Get accurate pane count from selected window panel
     */
    window.getWindowPaneCount = function() {
        const $selectedPanel = $('input[name="window_panel_layout"]:checked');
        
        if (!$selectedPanel.length) {
            return 1;
        }
        
        let paneCount = $selectedPanel.data('pane-count');
        
        if (!paneCount) {
            const selectedPanel = $selectedPanel.val();
            
            if (selectedPanel.match(/^\d+_\d+$/)) {
                const parts = selectedPanel.split('_');
                paneCount = parseInt(parts[0]) + parseInt(parts[1]);
            }
            else if (selectedPanel.match(/^\d+_[a-z]+$/)) {
                const match = selectedPanel.match(/^(\d+)/);
                paneCount = match ? parseInt(match[1]) : 1;
            }
            else {
                paneCount = 1;
            }
        }
        
        return paneCount < 1 ? 1 : paneCount;
    };
    
    /**
     * Update panel options based on window width
     */
    function updateWindowPanelOptions() {
        const width = parseInt($('#window_width').val());
        const height = parseInt($('#window_height').val());
        const $allPanels = $('.panel-option-card');

        $allPanels.hide();
        
        if (isNaN(width) || isNaN(height)) {
            if (window.editMode) {
                const selectedPanel = $('input[name="window_panel_layout"]:checked').val();
                if (selectedPanel) {
                    $(`input[name="window_panel_layout"][value="${selectedPanel}"]`).closest('.panel-option-card').show();
                }
            }
            return;
        }

        let activeClass = '';
        
        if (width >= 1600 && width <= 2000) {
            activeClass = 'panel-2';
        }
        else if (width >= 2001 && width <= 2600) {
            activeClass = 'panel-3';
        }
        else if (width >= 2601 && width <= 3400) {
            activeClass = 'panel-4';
        }
        else if (width >= 3401 && width <= 4200) {
            activeClass = 'panel-5';
        }
        else if (width >= 4201 && width <= 5800) {
            activeClass = 'panel-6';
        }

        if (activeClass) {
            $('.' + activeClass).show();
            
            if (activeClass === 'panel-3') {
                updatePanel3Price(width);
            } else if (activeClass === 'panel-4') {
                updatePanel4Price(width);
            } else if (activeClass === 'panel-5') {
                updatePanel5Price(width);
            } else if (activeClass === 'panel-6') {
                updatePanel6Price(width);
            }
        }

        if (!window.editMode) {
            $('input[name="window_panel_layout"]:checked').not(':visible').prop('checked', false);
        } else {
            const selectedPanel = $('input[name="window_panel_layout"]:checked').val();
            if (selectedPanel) {
                const $selectedCard = $(`input[name="window_panel_layout"][value="${selectedPanel}"]`).closest('.panel-option-card');
                if ($selectedCard.is(':hidden')) {
                    $('input[name="window_panel_layout"]:checked').prop('checked', false);
                }
            }
        }

        updatePriceAndPaneCount();
    }
    
    /**
     * Update price display for 3-panel options
     */
    function updatePanel3Price(width) {
        let price = 1190;
        if (width <= 2200) {
            price = 1190;
        } else if (width <= 2600) {
            price = 1290;
        } else {
            price = 1390;
        }
        
        $('.panel-3 .panel-details .option-price').html('+ £' + price + ' <span class="price-vat">(inc. VAT)</span>');
        $('.panel-3 .price-option').data('price', price);
    }
    
    /**
     * Update price display for 4-panel options
     */
    function updatePanel4Price(width) {
        let price = 1690;
        if (width <= 3000) {
            price = 1690;
        } else if (width <= 3400) {
            price = 1790;
        } else {
            price = 1890;
        }
        
        $('.panel-4 .panel-details .option-price').html('+ £' + price + ' <span class="price-vat">(inc. VAT)</span>');
        $('.panel-4 .price-option').data('price', price);
    }
    
    /**
     * Update price display for 5-panel options
     */
    function updatePanel5Price(width) {
        let price = 2190;
        if (width <= 3800) {
            price = 2190;
        } else if (width <= 4200) {
            price = 2290;
        } else {
            price = 2390;
        }
        
        $('.panel-5 .panel-details .option-price').html('+ £' + price + ' <span class="price-vat">(inc. VAT)</span>');
        $('.panel-5 .price-option').data('price', price);
    }
    
    /**
     * Update price display for 6-panel options (width up to 5800mm)
     */
    function updatePanel6Price(width) {
        let price = 2690;
        if (width <= 4600) {
            price = 2690;
        } else if (width <= 5000) {
            price = 2790;
        } else if (width <= 5400) {
            price = 2890;
        } else {
            price = 2990;
        }
        
        $('.panel-6 .panel-details .option-price').html('+ £' + price + ' <span class="price-vat">(inc. VAT)</span>');
        $('.panel-6 .price-option').data('price', price);
    }
    
    /**
     * Update price and pane count after panel changes
     */
    function updatePriceAndPaneCount() {
        if (typeof window.updateWindowPrice === 'function') {
            window.updateWindowPrice();
        }
        
        if (typeof window.updateDrawer === 'function') {
            window.updateDrawer();
        }
    }
    
    /**
     * Trigger update when panel changes
     */
    $(document).on('change', 'input[name="window_panel_layout"]', function() {
        const paneCount = window.getWindowPaneCount();
        $(document).trigger('windowPanelChanged', [paneCount]);
        
        setTimeout(function() {
            updatePriceAndPaneCount();
        }, 100);
    });
    
    /**
     * Trigger panel update when width changes
     */
    $(document).on('input blur', '#window_width, #window_height', function() {
        updateWindowPanelOptions();
    });
    
    // Listen to size change from step 1
    $(document).on('windowSizeChanged', function(event, data) {
        updateWindowPanelOptions();
    });
    
    // Initial setup
    setTimeout(function() {
        updateWindowPanelOptions();
        
        if ($('input[name="window_panel_layout"]:checked').length > 0) {
            updatePriceAndPaneCount();
        }
    }, 500);
    
});
</script>