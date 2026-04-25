<?php
/**
 * Template part for Inside Colour Selection step in Window Builder
 * 
 * @package Astra Child
 */
?>

<!-- Step 5: Inside Colour Selection -->
<div class="wizard-step" data-step="5">
    <div class="step-container">

        <div class="step-title">
            <h2>What colour would you like on the inside?</h2>
            <p>Upgrade to a custom RAL colour from £195. There is a huge range of custom colours – if your preferred colour isn't available from the drop down, please get in touch. We may still be able to do it!</p>
        </div>
        
        <div class="options-container">
            <div class="option-group">
                <div class="colour-inside-options-grid">

                    <!-- Anthracite Grey -->
                    <div class="colour-inside-option-card inside-colour-option">
                        <input type="radio" name="window_inside_colour" id="window_inside_colour_anthracite" value="anthracite_grey" class="price-option" data-price="0">
                        <label for="window_inside_colour_anthracite">
                            <div class="colour-inside-swatch inside-anthracite"></div>
                            <div class="colour-inside-info">
                                <div class="radio-inside-indicator"></div>
                                <div class="inside-text-content">
                                    <span class="colour-inside-name">Anthracite Grey</span>
                                    <span class="inside-ral-code">RAL 7016</span>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Black -->
                    <div class="colour-inside-option-card inside-colour-option">
                        <input type="radio" name="window_inside_colour" id="window_inside_colour_black" value="black" class="price-option" data-price="0">
                        <label for="window_inside_colour_black">
                            <div class="colour-inside-swatch inside-black"></div>
                            <div class="colour-inside-info">
                                <div class="radio-inside-indicator"></div>
                                <div class="inside-text-content">
                                    <span class="colour-inside-name">Black</span>
                                    <span class="inside-ral-code">RAL 9005</span>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- White -->
                    <div class="colour-inside-option-card inside-colour-option">
                        <input type="radio" name="window_inside_colour" id="window_inside_colour_white" value="white" class="price-option" data-price="0">
                        <label for="window_inside_colour_white">
                            <div class="colour-inside-swatch inside-white"></div>
                            <div class="colour-inside-info">
                                <div class="radio-inside-indicator"></div>
                                <div class="inside-text-content">
                                    <span class="colour-inside-name">White</span>
                                    <span class="inside-ral-code">RAL 9016</span>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Custom RAL -->
                    <div class="colour-inside-option-card custom-inside-colour-card inside-colour-option">
                        <input type="radio" name="window_inside_colour" id="window_inside_colour_custom" value="custom_ral" class="price-option" data-price="195">
                        <label for="window_inside_colour_custom">
                            <div class="colour-inside-swatch inside-custom"></div>
                            <div class="colour-inside-info">
                                <div class="radio-inside-indicator"></div>
                                <div class="inside-text-content">
                                    <span class="colour-inside-name">Custom RAL Colour</span>
                                    <span class="selected-inside-ral-code">From £195 <span class="price-vat">(inc. VAT)</span></span>
                                </div>
                            </div>
                        </label>
                        
                        <!-- Custom Colour Dropdown -->
                        <div class="custom-inside-colour-dropdown">
                            <select id="custom_window_inside_colour_select" name="custom_window_inside_colour" class="custom_inside_colour_select">
                                <option value="" selected disabled>Select a RAL colour</option>
                                <option data-price="195" value="RAL 1002">RAL 1002</option>
                                <option data-price="195" value="RAL 1013">RAL 1013</option>
                                <option data-price="195" value="RAL 1015">RAL 1015</option>
                                <option data-price="195" value="RAL 1019">RAL 1019</option>
                                <option data-price="195" value="RAL 3004">RAL 3004</option>
                                <option data-price="195" value="RAL 3009">RAL 3009</option>
                                <option data-price="195" value="RAL 3015">RAL 3015</option>
                                <option data-price="195" value="RAL 3020">RAL 3020</option>
                                <option data-price="195" value="RAL 5002">RAL 5002</option>
                                <option data-price="195" value="RAL 5005">RAL 5005</option>
                                <option data-price="195" value="RAL 5007">RAL 5007</option>
                                <option data-price="195" value="RAL 5008">RAL 5008</option>
                                <option data-price="195" value="RAL 5010">RAL 5010</option>
                                <option data-price="195" value="RAL 5011">RAL 5011</option>
                                <option data-price="195" value="RAL 5012">RAL 5012</option>
                                <option data-price="195" value="RAL 5014">RAL 5014</option>
                                <option data-price="195" value="RAL 5017">RAL 5017</option>
                                <option data-price="195" value="RAL 6000">RAL 6000</option>
                                <option data-price="195" value="RAL 6002">RAL 6002</option>
                                <option data-price="195" value="RAL 6005">RAL 6005</option>
                                <option data-price="195" value="RAL 6009">RAL 6009</option>
                                <option data-price="195" value="RAL 6019">RAL 6019</option>
                                <option data-price="195" value="RAL 6021">RAL 6021</option>
                                <option data-price="195" value="RAL 6026">RAL 6026</option>
                                <option data-price="195" value="RAL 7000">RAL 7000</option>
                                <option data-price="195" value="RAL 7001">RAL 7001</option>
                                <option data-price="195" value="RAL 7004">RAL 7004</option>
                                <option data-price="195" value="RAL 7005">RAL 7005</option>
                                <option data-price="195" value="RAL 7009">RAL 7009</option>
                                <option data-price="195" value="RAL 7011">RAL 7011</option>
                                <option data-price="195" value="RAL 7012">RAL 7012</option>
                                <option data-price="195" value="RAL 7013">RAL 7013</option>
                                <option data-price="195" value="RAL 7015">RAL 7015</option>
                                <option data-price="195" value="RAL 7021">RAL 7021</option>
                                <option data-price="195" value="RAL 7022">RAL 7022</option>
                                <option data-price="195" value="RAL 7023">RAL 7023</option>
                                <option data-price="195" value="RAL 7024">RAL 7024</option>
                                <option data-price="195" value="RAL 7026">RAL 7026</option>
                                <option data-price="195" value="RAL 7030">RAL 7030</option>
                                <option data-price="195" value="RAL 7031">RAL 7031</option>
                                <option data-price="195" value="RAL 7032">RAL 7032</option>
                                <option data-price="195" value="RAL 7033">RAL 7033</option>
                                <option data-price="195" value="RAL 7034">RAL 7034</option>
                                <option data-price="195" value="RAL 7035">RAL 7035</option>
                                <option data-price="195" value="RAL 7036">RAL 7036</option>
                                <option data-price="195" value="RAL 7037">RAL 7037</option>
                                <option data-price="195" value="RAL 7038">RAL 7038</option>
                                <option data-price="195" value="RAL 7042">RAL 7042</option>
                                <option data-price="195" value="RAL 7043">RAL 7043</option>
                                <option data-price="195" value="RAL 7045">RAL 7045</option>
                                <option data-price="195" value="RAL 7047">RAL 7047</option>
                                <option data-price="195" value="RAL 78003">RAL 78003</option>
                                <option data-price="195" value="RAL 8011">RAL 8011</option>
                                <option data-price="195" value="RAL 8014">RAL 8014</option>
                                <option data-price="195" value="RAL 8015">RAL 8015</option>
                                <option data-price="195" value="RAL 8016">RAL 8016</option>
                                <option data-price="195" value="RAL 8017">RAL 8017</option>
                                <option data-price="195" value="RAL 8019">RAL 8019</option>
                                <option data-price="195" value="RAL 8022">RAL 8022</option>
                                <option data-price="195" value="RAL 8028">RAL 8028</option>
                                <option data-price="195" value="RAL 9001">RAL 9001</option>
                                <option data-price="195" value="RAL 9002">RAL 9002</option>
                                <option data-price="195" value="RAL 9003">RAL 9003</option>
                                <option data-price="195" value="RAL 9004">RAL 9004</option>
                                <option data-price="195" value="RAL 9010">RAL 9010</option>
                                <option data-price="195" value="RAL 9012">RAL 9012</option>
                                <option data-price="195" value="RAL 9017">RAL 9017</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<style>
/* Step 5: Inside Colour Selection Styles - FULLY RESPONSIVE */

.options-container {
    margin-bottom: 120px;
}

/* ===== GRID LAYOUT - RESPONSIVE ===== */
.colour-inside-options-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    margin-top: 10px;
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
    white-space: nowrap;
}

/* Card */
.colour-inside-option-card {
    background: #fff;
    transition: all 0.25s ease;
    cursor: pointer;
    overflow: visible;
    border: 1px solid #e0e0e0;
    height: 100%;
    position: relative;
    display: flex;
    flex-direction: column;
}

/* Hide radio */
.colour-inside-option-card input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

/* Label layout */
.colour-inside-option-card label {
    display: flex;
    flex-direction: column;
    height: 100%;
    cursor: pointer;
    flex: 1;
}

/* Colour swatch area */
.colour-inside-swatch {
    height: 180px;
    width: 100%;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

/* Specific colour backgrounds */
.colour-inside-swatch.inside-anthracite {
    background: #383e42;
}

.colour-inside-swatch.inside-black {
    background: #0a0a0a;
}

.colour-inside-swatch.inside-white {
    background: #ffffff;
    border-bottom: 1px solid #e0e0e0;
}

.colour-inside-swatch.inside-custom {
    background: linear-gradient(45deg, 
        #ff3366 0%, #ff3366 20%,
        #33ccff 20%, #33ccff 40%,
        #33ff99 40%, #33ff99 60%,
        #ffcc00 60%, #ffcc00 80%,
        #9933ff 80%, #9933ff 100%);
    position: relative;
}

/* Colour info text area */
.colour-inside-info {
    padding: 18px 15px;
    border-top: 1px solid #f5f5f5;
    display: flex;
    align-items: center;
    gap: 12px;
    min-height: 70px;
    flex: 1;
}

/* ================================
   RADIO BUTTON STYLES
   ================================ */

/* Custom radio indicator */
.radio-inside-indicator {
    width: 14px;
    height: 14px;
    border: 1.5px solid #222;
    border-radius: 50%;
    flex-shrink: 0;
    position: relative;
    transition: all 0.2s ease;
}

/* Selected state */
.colour-inside-option-card input:checked + label .radio-inside-indicator {
    background: #222;
    box-shadow: inset 0 0 0 3px #fff;
    border-color: #222;
}

/* Hover effect */
.colour-inside-option-card:hover .radio-inside-indicator {
    border-color: #2e7d32;
}

/* ================================
   TEXT CONTENT
   ================================ */

.inside-text-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    gap: 10px;
}

.colour-inside-name {
    font-size: 16px;
    font-weight: 500;
    color: #333;
    text-align: left;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding-right: 10px;
}

.inside-ral-code, .selected-inside-ral-code {
    font-size: 14px;
    color: #666;
    text-align: right;
    white-space: nowrap;
    flex-shrink: 0;
    font-weight: 400;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.custom-inside-colour-card .selected-inside-ral-code {
    font-size: 14px;
    color: #666;
    text-align: right;
    white-space: nowrap;
    flex-shrink: 0;
    font-weight: 400;
    display: inline-flex;
    align-items: center;
    gap: 2px;
}

.custom-inside-colour-card .selected-inside-ral-code .price-vat {
    font-size: 9px;
    font-weight: 400;
    color: #666;
    margin-left: 2px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    vertical-align: super;
    white-space: nowrap;
}

/* ================================
   CUSTOM COLOUR DROPDOWN
   ================================ */

.custom-inside-colour-card {
    position: relative;
}

.custom-inside-colour-dropdown {
    display: none;
    position: absolute;
    top: calc(100% + 5px);
    left: 0;
    right: 0;
    z-index: 100;
    background: white;
    border: 1px solid #e0e0e0;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    padding: 15px;
    animation: fadeInInside 0.3s ease;
}

@keyframes fadeInInside {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.custom-inside-colour-card input:checked ~ .custom-inside-colour-dropdown {
    display: block;
}

.custom_inside_colour_select {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    font-size: 14px;
    color: #333;
    background: white;
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 12px;
}

.custom_inside_colour_select:focus {
    outline: none;
    border-color: #2e7d32;
    box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
}

.custom-inside-colour-card input:checked + label .selected-inside-ral-code {
    color: #2e7d32;
    font-weight: 500;
}

/* ================================
   SELECTED STATE STYLES
   ================================ */

.colour-inside-option-card input:checked + label {
    border: 2px solid #2e7d32;
}

.colour-inside-option-card input:checked + label .colour-inside-swatch {
    position: relative;
}

.colour-inside-option-card input:checked + label .colour-inside-swatch::after {
    content: "";
    position: absolute;
    top: 15px;
    right: 15px;
    background: #2e7d32;
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: bold;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white'%3E%3Cpath d='M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: center;
    background-size: 16px;
    z-index: 10;
}

.colour-inside-option-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}

/* ================================
   STEP TITLE STYLES
   ================================ */

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

.step-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
}

/* ================================
   RESPONSIVE STYLES
   ================================ */

@media (min-width: 1400px) {
    .colour-inside-options-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 25px;
    }
    .colour-inside-swatch {
        height: 200px;
    }
}

@media (max-width: 1399px) and (min-width: 1025px) {
    .colour-inside-options-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }
    .colour-inside-swatch {
        height: 180px;
    }
}

@media (max-width: 1024px) and (min-width: 769px) {
    .colour-inside-options-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 20px;
    }
    .colour-inside-swatch {
        height: 160px;
    }
    .custom-inside-colour-dropdown {
        position: relative;
        top: 0;
        margin-top: 10px;
        box-shadow: none;
    }
    .custom-inside-colour-card input:checked ~ .custom-inside-colour-dropdown {
        position: static;
        margin-top: 10px;
    }
}

@media (max-width: 768px) {
    .step-container {
        padding: 0 15px;
    }
    .step-title h2 {
        font-size: 24px;
    }
    .colour-inside-options-grid {
        grid-template-columns: 1fr !important;
        gap: 15px;
    }
    .colour-inside-swatch {
        height: 140px;
    }
    .inside-text-content {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
    .colour-inside-name {
        font-size: 15px;
    }
    .inside-ral-code, .selected-inside-ral-code {
        font-size: 13px;
    }
}

@media (max-width: 480px) {
    .colour-inside-swatch {
        height: 120px;
    }
    .colour-inside-name {
        font-size: 14px;
    }
    .inside-ral-code, .selected-inside-ral-code {
        font-size: 12px;
    }
}
</style>