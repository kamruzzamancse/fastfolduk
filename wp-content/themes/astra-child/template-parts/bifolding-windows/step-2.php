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

                    <!-- ================== 6 PANELS ================== -->
                    <!-- 2 + 4 Panels -->
                    <div class="panel-option-card panel-6"
                        data-min-width="4201"
                        data-max-width="5000"
                        data-price-4201="2690"
                        data-price-4600="2790"
                        data-price-5000="2890">

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
                        data-max-width="5000"
                        data-price-4201="2690"
                        data-price-4600="2790"
                        data-price-5000="2890">

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
                        data-max-width="5000"
                        data-price-4201="2690"
                        data-price-4600="2790"
                        data-price-5000="2890">

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
                        data-max-width="5000"
                        data-price-4201="2690"
                        data-price-4600="2790"
                        data-price-5000="2890">

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
                        data-max-width="5000"
                        data-price-4201="2690"
                        data-price-4600="2790"
                        data-price-5000="2890">

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

                    <!-- ================== 7 PANELS ================== -->
                    <!-- 1 + 6 Panels -->
                    <div class="panel-option-card panel-7"
                        data-min-width="5001"
                        data-max-width="5800"
                        data-price-5001="3290"
                        data-price-5400="3290"
                        data-price-5800="3490">

                        <input type="radio" name="window_panel_layout" id="panel_1_6" 
                               value="1_6" 
                               class="price-option panel7-option"
                               data-pane-count="7">

                        <label for="panel_1_6">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '1_6_Panel_500x.webp'); ?>" alt="1 + 6 Panels" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">1 + 6 Panels</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 2 + 5 Panels -->
                    <div class="panel-option-card panel-7"
                        data-min-width="5001"
                        data-max-width="5800"
                        data-price-5001="3290"
                        data-price-5400="3290"
                        data-price-5800="3490">

                        <input type="radio" name="window_panel_layout" id="panel_2_5" 
                               value="2_5" 
                               class="price-option panel7-option"
                               data-pane-count="7">

                        <label for="panel_2_5">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '2_5_Panel_500x.webp'); ?>" alt="2 + 5 Panels" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">2 + 5 Panels</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 3 + 4 Panels -->
                    <div class="panel-option-card panel-7"
                        data-min-width="5001"
                        data-max-width="5800"
                        data-price-5001="3290"
                        data-price-5400="3290"
                        data-price-5800="3490">

                        <input type="radio" name="window_panel_layout" id="panel_3_4" 
                               value="3_4" 
                               class="price-option panel7-option"
                               data-pane-count="7">

                        <label for="panel_3_4">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '3_4_Panel_500x.webp'); ?>" alt="3 + 4 Panels" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">3 + 4 Panels</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 4 + 3 Panels -->
                    <div class="panel-option-card panel-7"
                        data-min-width="5001"
                        data-max-width="5800"
                        data-price-5001="3290"
                        data-price-5400="3290"
                        data-price-5800="3490">

                        <input type="radio" name="window_panel_layout" id="panel_4_3" 
                               value="4_3" 
                               class="price-option panel7-option"
                               data-pane-count="7">

                        <label for="panel_4_3">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '4_3_Panel_500x.webp'); ?>" alt="4 + 3 Panels" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">4 + 3 Panels</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 5 + 2 Panels -->
                    <div class="panel-option-card panel-7"
                        data-min-width="5001"
                        data-max-width="5800"
                        data-price-5001="3290"
                        data-price-5400="3290"
                        data-price-5800="3490">

                        <input type="radio" name="window_panel_layout" id="panel_5_2" 
                               value="5_2" 
                               class="price-option panel7-option"
                               data-pane-count="7">

                        <label for="panel_5_2">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '5_2_Panel_500x.webp'); ?>" alt="5 + 2 Panels" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">5 + 2 Panels</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 6 + 1 Panels -->
                    <div class="panel-option-card panel-7"
                        data-min-width="5001"
                        data-max-width="5800"
                        data-price-5001="3290"
                        data-price-5400="3290"
                        data-price-5800="3490">

                        <input type="radio" name="window_panel_layout" id="panel_6_1" 
                               value="6_1" 
                               class="price-option panel7-option"
                               data-pane-count="7">

                        <label for="panel_6_1">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '6_1_Panel_500x.webp'); ?>" alt="6 + 1 Panels" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">6 + 1 Panels</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 7 Panels Left -->
                    <div class="panel-option-card panel-7"
                        data-min-width="5001"
                        data-max-width="5800"
                        data-price-5001="3290"
                        data-price-5400="3290"
                        data-price-5800="3490">

                        <input type="radio" name="window_panel_layout" id="panel_7_left" 
                               value="7_left" 
                               class="price-option panel7-option"
                               data-pane-count="7">

                        <label for="panel_7_left">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '7_Panel_Left_500x.webp'); ?>" alt="7 Panels Left" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">7 Panels Left</span>
                                <span class="option-price">+ <span class="price-vat">(inc. VAT)</span></span>
                            </div>
                        </label>
                    </div>

                    <!-- 7 Panels Right -->
                    <div class="panel-option-card panel-7"
                        data-min-width="5001"
                        data-max-width="5800"
                        data-price-5001="3290"
                        data-price-5400="3290"
                        data-price-5800="3490">

                        <input type="radio" name="window_panel_layout" id="panel_7_right" 
                               value="7_right" 
                               class="price-option panel7-option"
                               data-pane-count="7">

                        <label for="panel_7_right">
                            <div class="panel-image">
                                <img src="<?php echo esc_url($images_dir . '7_Panel_Right_500x.webp'); ?>" alt="7 Panels Right" loading="lazy">
                            </div>
                            <div class="panel-details">
                                <span class="option-name">7 Panels Right</span>
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
     * Uses data-pane-count attribute for reliability
     * 
     * @returns {number} Number of panes/panels
     */
    window.getWindowPaneCount = function() {
        const $selectedPanel = $('input[name="window_panel_layout"]:checked');
        
        if (!$selectedPanel.length) {
            if (typeof window.isDev !== 'undefined' && window.isDev()) {
                console.log('No panel selected, default pane count: 1');
            }
            return 1;
        }
        
        // First try to get from data-pane-count attribute
        let paneCount = $selectedPanel.data('pane-count');
        
        // If not available, calculate from value
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
            else if (selectedPanel.match(/^\d+$/)) {
                paneCount = parseInt(selectedPanel);
            }
            else {
                paneCount = 1;
            }
        }
        
        if (paneCount < 1) paneCount = 1;
        
        if (typeof window.isDev !== 'undefined' && window.isDev()) {
            console.log('Window Panel selected:', $selectedPanel.val(), '→ Pane count:', paneCount);
        }
        
        return paneCount;
    };
    
    /**
     * Update panel options based on window width
     * Shows only panels that are available for the current width
     */
    function updateWindowPanelOptions() {
        const width = parseInt($('#window_width').val());
        const height = parseInt($('#window_height').val());
        const $allPanels = $('.panel-option-card');

        // Hide all panels first
        $allPanels.hide();
        
        // If width or height is invalid, handle edit mode
        if (isNaN(width) || isNaN(height)) {
            // In edit mode, show the selected panel even if dimensions are invalid
            if (window.editMode) {
                const selectedPanel = $('input[name="window_panel_layout"]:checked').val();
                if (selectedPanel) {
                    const $selectedCard = $(`input[name="window_panel_layout"][value="${selectedPanel}"]`).closest('.panel-option-card');
                    $selectedCard.show();
                }
            }
            return;
        }

        // Determine which panel class to show based on width
        let activeClass = '';
        
        // Width: 1600mm - 2000mm → 2 panels
        if (width >= 1600 && width <= 2000) {
            activeClass = 'panel-2';
        }
        // Width: 2001mm - 2600mm → 3 panels
        else if (width >= 2001 && width <= 2600) {
            activeClass = 'panel-3';
        }
        // Width: 2601mm - 3400mm → 4 panels
        else if (width >= 2601 && width <= 3400) {
            activeClass = 'panel-4';
        }
        // Width: 3401mm - 4200mm → 5 panels
        else if (width >= 3401 && width <= 4200) {
            activeClass = 'panel-5';
        }
        // Width: 4201mm - 5000mm → 6 panels
        else if (width >= 4201 && width <= 5000) {
            activeClass = 'panel-6';
        }
        // Width: 5001mm - 5800mm → 7 panels
        else if (width >= 5001 && width <= 5800) {
            activeClass = 'panel-7';
        }

        // Show only panels matching the active class
        if (activeClass) {
            $('.' + activeClass).show();
            
            // Update price display for visible panels based on exact width
            if (activeClass === 'panel-3') {
                updatePanel3Price(width);
            } else if (activeClass === 'panel-4') {
                updatePanel4Price(width);
            } else if (activeClass === 'panel-5') {
                updatePanel5Price(width);
            } else if (activeClass === 'panel-6') {
                updatePanel6Price(width);
            } else if (activeClass === 'panel-7') {
                updatePanel7Price(width);
            }
        }

        // In edit mode, if selected panel is not visible, uncheck it
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

        // Update price and pane count after panel visibility changes
        updatePriceAndPaneCount();
    }
    
    /**
     * Update price display for 3-panel options based on width
     */
    function updatePanel3Price(width) {
        let price = 1190; // Default for width <= 2200
        
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
     * Update price display for 4-panel options based on width
     */
    function updatePanel4Price(width) {
        let price = 1690; // Default for width <= 3000
        
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
     * Update price display for 5-panel options based on width
     */
    function updatePanel5Price(width) {
        let price = 2190; // Default for width <= 3800
        
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
     * Update price display for 6-panel options based on width
     */
    function updatePanel6Price(width) {
        let price = 2690; // Default for width <= 4600
        
        if (width <= 4600) {
            price = 2690;
        } else if (width <= 5000) {
            price = 2790;
        } else {
            price = 2890;
        }
        
        $('.panel-6 .panel-details .option-price').html('+ £' + price + ' <span class="price-vat">(inc. VAT)</span>');
        $('.panel-6 .price-option').data('price', price);
    }
    
    /**
     * Update price display for 7-panel options based on width
     */
    function updatePanel7Price(width) {
        let price = 3290; // Default for width <= 5400
        
        if (width <= 5400) {
            price = 3290;
        } else {
            price = 3490;
        }
        
        $('.panel-7 .panel-details .option-price').html('+ £' + price + ' <span class="price-vat">(inc. VAT)</span>');
        $('.panel-7 .price-option').data('price', price);
    }
    
    /**
     * Update price and pane count after panel changes
     */
    function updatePriceAndPaneCount() {
        // Update main price
        if (typeof window.updateWindowPrice === 'function') {
            window.updateWindowPrice();
        }
        
        // Update drawer if exists
        if (typeof window.updateDrawer === 'function') {
            window.updateDrawer();
        }
        
        if (typeof window.isDev !== 'undefined' && window.isDev()) {
            console.log('Window price updated from Step 2');
        }
    }
    
    /**
     * Development logging helper
     */
    window.isDev = function() {
        return window.location.hostname === 'localhost' || 
               window.location.hostname === '127.0.0.1';
    };
    
    /**
     * Trigger update when panel changes
     */
    $(document).on('change', 'input[name="window_panel_layout"]', function() {
        const paneCount = window.getWindowPaneCount();
        
        // Trigger custom event for other components
        $(document).trigger('windowPanelChanged', [paneCount]);
        
        // Force update with slight delay to ensure panel selection is registered
        setTimeout(function() {
            updatePriceAndPaneCount();
        }, 100);
        
        if (typeof window.isDev !== 'undefined' && window.isDev()) {
            console.log('Window Panel changed, pane count:', paneCount);
        }
    });
    
    /**
     * Trigger panel update when width changes
     */
    $(document).on('input blur', '#window_width, #window_height', function() {
        updateWindowPanelOptions();
    });
    
    // Initial setup - update panel options based on current width
    setTimeout(function() {
        updateWindowPanelOptions();
        
        // If a panel is selected, trigger price update
        if ($('input[name="window_panel_layout"]:checked').length > 0) {
            updatePriceAndPaneCount();
        }
    }, 500);
    
    if (window.isDev()) {
        console.log('Window Step 2 initialized');
    }
});
</script>