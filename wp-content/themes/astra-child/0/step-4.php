<?php
/**
 * Template part for Colour Selection step in Window Builder
 * 
 * @package Astra Child
 */
?>

<!-- Step 4: Colour Selection -->
<div class="wizard-step" data-step="4">
    <div class="step-container">

        <div class="step-title">
            <h2>What colour would you like for your window frame?</h2>
            <p>Upgrade to a custom RAL colour from £195. There is a huge range of custom colours – if your preferred colour isn't available from the drop down, please get in touch. We may still be able to do it!</p>
        </div>
        
        <div class="options-container">
            <div class="option-group">
                <div class="colour-options-grid">

                    <!-- Anthracite Grey -->
                    <div class="colour-option-card" data-option="anthracite_grey">
                        <input type="radio" name="window_colour" id="window_colour_anthracite" value="anthracite_grey" class="price-option" data-price="0" checked>
                        <label for="window_colour_anthracite">
                            <div class="colour-swatch anthracite"></div>
                            <div class="colour-info">
                                <div class="radio-indicator"></div>
                                <div class="text-content">
                                    <span class="colour-name">Anthracite Grey</span>
                                    <span class="ral-code">RAL 7016</span>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Black -->
                    <div class="colour-option-card" data-option="black">
                        <input type="radio" name="window_colour" id="window_colour_black" value="black" class="price-option" data-price="0">
                        <label for="window_colour_black">
                            <div class="colour-swatch black"></div>
                            <div class="colour-info">
                                <div class="radio-indicator"></div>
                                <div class="text-content">
                                    <span class="colour-name">Black</span>
                                    <span class="ral-code">RAL 9005</span>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- White -->
                    <div class="colour-option-card" data-option="white">
                        <input type="radio" name="window_colour" id="window_colour_white" value="white" class="price-option" data-price="0">
                        <label for="window_colour_white">
                            <div class="colour-swatch white"></div>
                            <div class="colour-info">
                                <div class="radio-indicator"></div>
                                <div class="text-content">
                                    <span class="colour-name">White</span>
                                    <span class="ral-code">RAL 9016</span>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Custom RAL Colour -->
                    <div class="colour-option-card custom-colour-card" data-option="custom_ral">
                        <input type="radio" name="window_colour" id="window_colour_custom" value="custom_ral" class="price-option" data-price="195">
                        <label for="window_colour_custom">
                            <div class="colour-swatch custom"></div>
                            <div class="colour-info">
                                <div class="radio-indicator"></div>
                                <div class="text-content">
                                    <span class="colour-name">Custom RAL Colour</span>
                                    <span class="selected-ral-code">From £195 <span class="price-vat">(inc. VAT)</span></span>
                                </div>
                            </div>
                        </label>
                        
                        <!-- Custom Colour Dropdown -->
                        <div class="custom-colour-dropdown">
                            <select id="custom_window_colour_select" name="custom_window_colour" class="custom_colour_select">
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
/* Step 4: Colour Selection Styles */

.options-container {
    margin-bottom: 120px;
}

.colour-options-grid {
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
.colour-option-card {
    background: #fff;
    transition: all 0.25s ease;
    cursor: pointer;
    overflow: visible;
    border: 1px solid #e0e0e0;
    height: 100%;
    position: relative;
}

/* Hide radio */
.colour-option-card input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

/* Label layout */
.colour-option-card label {
    display: flex;
    flex-direction: column;
    height: 100%;
    cursor: pointer;
}

/* Colour swatch area */
.colour-swatch {
    height: 180px;
    width: 100%;
    transition: all 0.3s ease;
}

/* Specific colour backgrounds */
.colour-swatch.anthracite {
    background: #383e42; /* RAL 7016 Anthracite Grey */
}

.colour-swatch.black {
    background: #0a0a0a; /* RAL 9005 Black */
}

.colour-swatch.white {
    background: #ffffff; /* White */
    border-bottom: 1px solid #e0e0e0;
}

.colour-swatch.custom {
    background: linear-gradient(45deg, 
        #ff3366 0%, #ff3366 20%,
        #33ccff 20%, #33ccff 40%,
        #33ff99 40%, #33ff99 60%,
        #ffcc00 60%, #ffcc00 80%,
        #9933ff 80%, #9933ff 100%);
    position: relative;
}

/* Colour info text area */
.colour-info {
    padding: 18px 15px;
    border-top: 1px solid #f5f5f5;
    display: flex;
    align-items: center;
    gap: 12px;
    min-height: 70px;
}

/* ================================
   RADIO BUTTON STYLES
   ================================ */

/* Custom radio indicator */
.radio-indicator {
    width: 14px;
    height: 14px;
    border: 1.5px solid #222;
    border-radius: 50%;
    flex-shrink: 0;
    position: relative;
    transition: all 0.2s ease;
}

/* Selected state */
.colour-option-card input:checked + label .radio-indicator {
    background: #222;
    box-shadow: inset 0 0 0 3px #fff;
    border-color: #222;
}

/* Remove the inner white dot */
.colour-option-card input:checked + label .radio-indicator::after {
    display: none;
}

/* Hover effect for radio button */
.colour-option-card:hover .radio-indicator {
    border-color: #2e7d32;
}

/* Selected card hover state */
.colour-option-card input:checked + label:hover .radio-indicator {
    border-color: #222;
    background: #222;
    box-shadow: inset 0 0 0 3px #fff;
}

/* ================================
   END RADIO BUTTON UPDATES
   ================================ */

/* Text content - LEFT & RIGHT ALIGNED */
.text-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    gap: 10px;
}

/* Colour name - LEFT ALIGNED */
.colour-name {
    font-size: 16px;
    font-weight: 500;
    color: #333;
    text-align: left;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding-right: 10px;
}

/* RAL code - RIGHT ALIGNED */
.ral-code, .selected-ral-code {
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

/* Custom RAL text styling */
.custom-colour-card .selected-ral-code {
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

/* "From £195" text */
.custom-colour-card .selected-ral-code .price-vat {
    font-size: 9px;
    font-weight: 400;
    color: #666;
    margin-left: 2px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    vertical-align: super;
    white-space: nowrap;
}

/* Custom Colour Specific Styles */
.custom-colour-card {
    position: relative;
}

/* Dropdown container - hidden by default */
.custom-colour-dropdown {
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
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Show dropdown when custom colour radio is checked */
.custom-colour-card input:checked ~ .custom-colour-dropdown {
    display: block;
}

/* Dropdown select styling */
.custom_colour_select {
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

.custom_colour_select:focus {
    outline: none;
    border-color: #2e7d32;
    box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
}

/* Custom colour selected state */
.custom-colour-card input:checked + label .selected-ral-code {
    color: #2e7d32;
    font-weight: 500;
}

/* Selected state - Card border styling */
.colour-option-card input:checked + label {
    border: 2px solid #2e7d32;
}

/* Colour swatch selected checkmark */
.colour-option-card input:checked + label .colour-swatch {
    position: relative;
}

.colour-option-card input:checked + label .colour-swatch::after {
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
}

/* Hover effect */
.colour-option-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
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

/* Container alignment */
.step-container {
    max-width: 1400px;
    margin: 0 auto;
}

/* ================================
   Responsive Styles
   ================================ */

/* Large Desktop */
@media (min-width: 1400px) {
    .colour-options-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 25px;
    }
    
    .colour-swatch {
        height: 200px;
    }
    
    .price-vat {
        font-size: 11px;
    }
}

/* Desktop */
@media (max-width: 1399px) and (min-width: 1025px) {
    .colour-options-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }
    
    .colour-swatch {
        height: 180px;
    }
}

/* Tablet Landscape */
@media (max-width: 1024px) {
    .colour-options-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }
    
    .colour-swatch {
        height: 160px;
    }
    
    .text-content {
        flex-wrap: nowrap;
    }
    
    .radio-indicator {
        width: 14px;
        height: 14px;
    }
    
    .colour-option-card input:checked + label .radio-indicator {
        box-shadow: inset 0 0 0 3px #fff;
    }
    
    .price-vat {
        font-size: 9px;
    }
    
    /* Adjust dropdown for tablet */
    .custom-colour-dropdown {
        position: relative;
        top: 0;
        margin-top: 10px;
        box-shadow: none;
        border: 1px solid #e0e0e0;
    }
    
    .custom-colour-card input:checked ~ .custom-colour-dropdown {
        display: block;
        position: static;
        margin-top: 10px;
    }
}

/* Mobile */
@media (max-width: 768px) {
    .step-container {
        padding: 0 15px;
    }
    
    .step-title h2 {
        font-size: 24px;
    }
    
    .step-title p {
        font-size: 15px;
    }
    
    .colour-options-grid {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    
    .colour-swatch {
        height: 140px;
    }
    
    .colour-info {
        padding: 15px 12px;
        gap: 10px;
        min-height: 60px;
    }
    
    .radio-indicator {
        width: 12px;
        height: 12px;
        border-width: 1.2px;
    }
    
    .colour-option-card input:checked + label .radio-indicator {
        box-shadow: inset 0 0 0 2px #fff;
    }
    
    .colour-name {
        font-size: 15px;
    }
    
    .ral-code, .selected-ral-code {
        font-size: 13px;
    }
    
    .price-vat {
        font-size: 8px;
    }
}

/* Small Mobile */
@media (max-width: 480px) {
    .step-title h2 {
        font-size: 22px;
    }
    
    .colour-swatch {
        height: 120px;
    }
    
    .colour-info {
        padding: 12px 10px;
        gap: 8px;
        min-height: auto;
        flex-direction: column;
        align-items: flex-start;
    }
    
    .radio-indicator {
        width: 12px;
        height: 12px;
        align-self: flex-start;
        margin-top: 2px;
        border-width: 1.2px;
    }
    
    .colour-option-card input:checked + label .radio-indicator {
        box-shadow: inset 0 0 0 2px #fff;
    }
    
    .text-content {
        flex-direction: column;
        align-items: flex-start;
        gap: 4px;
        width: 100%;
    }
    
    .colour-name {
        font-size: 14px;
        padding-right: 0;
        width: 100%;
        text-align: left;
    }
    
    .ral-code, .selected-ral-code {
        font-size: 12px;
        text-align: left;
        width: 100%;
        justify-content: flex-start;
    }
    
    .custom-colour-card .selected-ral-code {
        font-size: 12px;
        text-align: left;
        width: 100%;
        justify-content: flex-start;
    }
    
    .custom-colour-card .selected-ral-code .price-vat {
        font-size: 8px;
    }
}

/* Extra Small Mobile */
@media (max-width: 360px) {
    .colour-info {
        flex-direction: row;
        align-items: center;
    }
    
    .text-content {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        gap: 5px;
    }
    
    .radio-indicator {
        width: 12px;
        height: 12px;
        margin-top: 0;
    }
    
    .colour-name {
        font-size: 13px;
        text-align: left;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        flex: 1;
    }
    
    .ral-code, .selected-ral-code {
        font-size: 11px;
        text-align: right;
        white-space: nowrap;
        flex-shrink: 0;
    }
}
</style>