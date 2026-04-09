<?php
/**
 * Template part for Inside Colour Selection step in Door Builder
 * 
 * @package Astra Child
 */
?>

<!-- Step 5: Inside Colour Selection -->
<div class="wizard-step" data-step="5">
    <div class="step-container">

        <div class="step-title">
            <h2>What colour would you like on the inside?</h2>
            <p>Upgrade to a custom RAL colour from £195 per panel. There is a huge range of custom colours – if your preferred colour isn't available from the drop down, please get in touch. We may still be able to do it!</p>
        </div>
        
        <div class="options-container">
            <div class="option-group">
                <div class="colour-inside-options-grid">

                    <!-- Anthracite Grey - Always visible -->
                    <div class="colour-inside-option-card inside-colour-option">
                        <input type="radio" name="inside_colour" id="inside_colour_anthracite" value="anthracite_grey" class="price-option" data-price="0">
                        <label for="inside_colour_anthracite">
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

                    <!-- Black - Always visible -->
                    <div class="colour-inside-option-card inside-colour-option">
                        <input type="radio" name="inside_colour" id="inside_colour_black" value="black" class="price-option" data-price="0">
                        <label for="inside_colour_black">
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

                    <!-- White - Always visible -->
                    <div class="colour-inside-option-card inside-colour-option">
                        <input type="radio" name="inside_colour" id="inside_colour_white" value="white" class="price-option" data-price="0">
                        <label for="inside_colour_white">
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

                    <!-- Custom RAL - Always visible -->
                    <div class="colour-inside-option-card custom-inside-colour-card inside-colour-option">
                        <input type="radio" name="inside_colour" id="inside_colour_custom" value="custom_ral" class="price-option" data-price="195">
                        <label for="inside_colour_custom">
                            <div class="colour-inside-swatch inside-custom"></div>
                            <div class="colour-inside-info">
                                <div class="radio-inside-indicator"></div>
                                <div class="inside-text-content">
                                    <span class="colour-inside-name">Custom RAL Colour</span>
                                    <span class="selected-inside-ral-code">From £195 per panel <span class="price-vat">(inc. VAT)</span></span>
                                </div>
                            </div>
                        </label>
                        
                        <!-- Custom Colour Dropdown -->
                        <div class="custom-inside-colour-dropdown">
                            <select id="custom_inside_colour_select" name="custom_inside_colour" class="custom_inside_colour_select">
                                <option value="" selected disabled>Select a RAL colour</option>
                                <option data-price="195" value="RAL 1000">RAL 1000</option>
                                <option data-price="195" value="RAL 1001">RAL 1001</option>
                                <option data-price="195" value="RAL 1002">RAL 1002</option>
                                <option data-price="195" value="RAL 1003">RAL 1003</option>
                                <option data-price="195" value="RAL 1004">RAL 1004</option>
                                <option data-price="195" value="RAL 1005">RAL 1005</option>
                                <option data-price="195" value="RAL 1006">RAL 1006</option>
                                <option data-price="195" value="RAL 1007">RAL 1007</option>
                                <option data-price="195" value="RAL 1011">RAL 1011</option>
                                <option data-price="195" value="RAL 1012">RAL 1012</option>
                                <option data-price="195" value="RAL 1013">RAL 1013</option>
                                <option data-price="195" value="RAL 1014">RAL 1014</option>
                                <option data-price="195" value="RAL 1015">RAL 1015</option>
                                <option data-price="195" value="RAL 1016">RAL 1016</option>
                                <option data-price="195" value="RAL 1017">RAL 1017</option>
                                <option data-price="195" value="RAL 1018">RAL 1018</option>
                                <option data-price="195" value="RAL 1019">RAL 1019</option>
                                <option data-price="195" value="RAL 1020">RAL 1020</option>
                                <option data-price="195" value="RAL 1021">RAL 1021</option>
                                <option data-price="195" value="RAL 1023">RAL 1023</option>
                                <option data-price="195" value="RAL 1024">RAL 1024</option>
                                <option data-price="195" value="RAL 1026">RAL 1026</option>
                                <option data-price="195" value="RAL 1027">RAL 1027</option>
                                <option data-price="195" value="RAL 1028">RAL 1028</option>
                                <option data-price="195" value="RAL 1032">RAL 1032</option>
                                <option data-price="195" value="RAL 1033">RAL 1033</option>
                                <option data-price="195" value="RAL 1034">RAL 1034</option>
                                <option data-price="195" value="RAL 1035">RAL 1035</option>
                                <option data-price="195" value="RAL 1036">RAL 1036</option>
                                <option data-price="195" value="RAL 1037">RAL 1037</option>
                                <option data-price="195" value="RAL 2000">RAL 2000</option>
                                <option data-price="195" value="RAL 2001">RAL 2001</option>
                                <option data-price="195" value="RAL 2002">RAL 2002</option>
                                <option data-price="195" value="RAL 2003">RAL 2003</option>
                                <option data-price="195" value="RAL 2004">RAL 2004</option>
                                <option data-price="195" value="RAL 2005">RAL 2005</option>
                                <option data-price="195" value="RAL 2006">RAL 2006</option>
                                <option data-price="195" value="RAL 2007">RAL 2007</option>
                                <option data-price="195" value="RAL 2008">RAL 2008</option>
                                <option data-price="195" value="RAL 2009">RAL 2009</option>
                                <option data-price="195" value="RAL 2010">RAL 2010</option>
                                <option data-price="195" value="RAL 2011">RAL 2011</option>
                                <option data-price="195" value="RAL 2012">RAL 2012</option>
                                <option data-price="195" value="RAL 2013">RAL 2013</option>
                                <option data-price="195" value="RAL 3000">RAL 3000</option>
                                <option data-price="195" value="RAL 3001">RAL 3001</option>
                                <option data-price="195" value="RAL 3002">RAL 3002</option>
                                <option data-price="195" value="RAL 3003">RAL 3003</option>
                                <option data-price="195" value="RAL 3004">RAL 3004</option>
                                <option data-price="195" value="RAL 3005">RAL 3005</option>
                                <option data-price="195" value="RAL 3007">RAL 3007</option>
                                <option data-price="195" value="RAL 3009">RAL 3009</option>
                                <option data-price="195" value="RAL 3011">RAL 3011</option>
                                <option data-price="195" value="RAL 3012">RAL 3012</option>
                                <option data-price="195" value="RAL 3013">RAL 3013</option>
                                <option data-price="195" value="RAL 3014">RAL 3014</option>
                                <option data-price="195" value="RAL 3015">RAL 3015</option>
                                <option data-price="195" value="RAL 3016">RAL 3016</option>
                                <option data-price="195" value="RAL 3017">RAL 3017</option>
                                <option data-price="195" value="RAL 3018">RAL 3018</option>
                                <option data-price="195" value="RAL 3020">RAL 3020</option>
                                <option data-price="195" value="RAL 3022">RAL 3022</option>
                                <option data-price="195" value="RAL 3024">RAL 3024</option>
                                <option data-price="195" value="RAL 3026">RAL 3026</option>
                                <option data-price="195" value="RAL 3027">RAL 3027</option>
                                <option data-price="195" value="RAL 3028">RAL 3028</option>
                                <option data-price="195" value="RAL 3031">RAL 3031</option>
                                <option data-price="195" value="RAL 3032">RAL 3032</option>
                                <option data-price="195" value="RAL 3033">RAL 3033</option>
                                <option data-price="195" value="RAL 4001">RAL 4001</option>
                                <option data-price="195" value="RAL 4002">RAL 4002</option>
                                <option data-price="195" value="RAL 4003">RAL 4003</option>
                                <option data-price="195" value="RAL 4004">RAL 4004</option>
                                <option data-price="195" value="RAL 4005">RAL 4005</option>
                                <option data-price="195" value="RAL 4006">RAL 4006</option>
                                <option data-price="195" value="RAL 4007">RAL 4007</option>
                                <option data-price="195" value="RAL 4008">RAL 4008</option>
                                <option data-price="195" value="RAL 4009">RAL 4009</option>
                                <option data-price="195" value="RAL 4010">RAL 4010</option>
                                <option data-price="195" value="RAL 4011">RAL 4011</option>
                                <option data-price="195" value="RAL 4012">RAL 4012</option>
                                <option data-price="195" value="RAL 5000">RAL 5000</option>
                                <option data-price="195" value="RAL 5001">RAL 5001</option>
                                <option data-price="195" value="RAL 5002">RAL 5002</option>
                                <option data-price="195" value="RAL 5003">RAL 5003</option>
                                <option data-price="195" value="RAL 5004">RAL 5004</option>
                                <option data-price="195" value="RAL 5005">RAL 5005</option>
                                <option data-price="195" value="RAL 5007">RAL 5007</option>
                                <option data-price="195" value="RAL 5008">RAL 5008</option>
                                <option data-price="195" value="RAL 5009">RAL 5009</option>
                                <option data-price="195" value="RAL 5010">RAL 5010</option>
                                <option data-price="195" value="RAL 5011">RAL 5011</option>
                                <option data-price="195" value="RAL 5012">RAL 5012</option>
                                <option data-price="195" value="RAL 5013">RAL 5013</option>
                                <option data-price="195" value="RAL 5014">RAL 5014</option>
                                <option data-price="195" value="RAL 5015">RAL 5015</option>
                                <option data-price="195" value="RAL 5017">RAL 5017</option>
                                <option data-price="195" value="RAL 5018">RAL 5018</option>
                                <option data-price="195" value="RAL 5019">RAL 5019</option>
                                <option data-price="195" value="RAL 5020">RAL 5020</option>
                                <option data-price="195" value="RAL 5021">RAL 5021</option>
                                <option data-price="195" value="RAL 5022">RAL 5022</option>
                                <option data-price="195" value="RAL 5023">RAL 5023</option>
                                <option data-price="195" value="RAL 5024">RAL 5024</option>
                                <option data-price="195" value="RAL 5025">RAL 5025</option>
                                <option data-price="195" value="RAL 5026">RAL 5026</option>
                                <option data-price="195" value="RAL 6000">RAL 6000</option>
                                <option data-price="195" value="RAL 6001">RAL 6001</option>
                                <option data-price="195" value="RAL 6002">RAL 6002</option>
                                <option data-price="195" value="RAL 6003">RAL 6003</option>
                                <option data-price="195" value="RAL 6004">RAL 6004</option>
                                <option data-price="195" value="RAL 6005">RAL 6005</option>
                                <option data-price="195" value="RAL 6006">RAL 6006</option>
                                <option data-price="195" value="RAL 6007">RAL 6007</option>
                                <option data-price="195" value="RAL 6008">RAL 6008</option>
                                <option data-price="195" value="RAL 6009">RAL 6009</option>
                                <option data-price="195" value="RAL 6010">RAL 6010</option>
                                <option data-price="195" value="RAL 6011">RAL 6011</option>
                                <option data-price="195" value="RAL 6012">RAL 6012</option>
                                <option data-price="195" value="RAL 6013">RAL 6013</option>
                                <option data-price="195" value="RAL 6014">RAL 6014</option>
                                <option data-price="195" value="RAL 6015">RAL 6015</option>
                                <option data-price="195" value="RAL 6016">RAL 6016</option>
                                <option data-price="195" value="RAL 6017">RAL 6017</option>
                                <option data-price="195" value="RAL 6018">RAL 6018</option>
                                <option data-price="195" value="RAL 6019">RAL 6019</option>
                                <option data-price="195" value="RAL 6020">RAL 6020</option>
                                <option data-price="195" value="RAL 6021">RAL 6021</option>
                                <option data-price="195" value="RAL 6022">RAL 6022</option>
                                <option data-price="195" value="RAL 6024">RAL 6024</option>
                                <option data-price="195" value="RAL 6025">RAL 6025</option>
                                <option data-price="195" value="RAL 6026">RAL 6026</option>
                                <option data-price="195" value="RAL 6027">RAL 6027</option>
                                <option data-price="195" value="RAL 6028">RAL 6028</option>
                                <option data-price="195" value="RAL 6029">RAL 6029</option>
                                <option data-price="195" value="RAL 6032">RAL 6032</option>
                                <option data-price="195" value="RAL 6033">RAL 6033</option>
                                <option data-price="195" value="RAL 6034">RAL 6034</option>
                                <option data-price="195" value="RAL 6035">RAL 6035</option>
                                <option data-price="195" value="RAL 6036">RAL 6036</option>
                                <option data-price="195" value="RAL 6037">RAL 6037</option>
                                <option data-price="195" value="RAL 6038">RAL 6038</option>
                                <option data-price="195" value="RAL 7000">RAL 7000</option>
                                <option data-price="195" value="RAL 7001">RAL 7001</option>
                                <option data-price="195" value="RAL 7002">RAL 7002</option>
                                <option data-price="195" value="RAL 7003">RAL 7003</option>
                                <option data-price="195" value="RAL 7004">RAL 7004</option>
                                <option data-price="195" value="RAL 7005">RAL 7005</option>
                                <option data-price="195" value="RAL 7006">RAL 7006</option>
                                <option data-price="195" value="RAL 7007">RAL 7007</option>
                                <option data-price="195" value="RAL 7008">RAL 7008</option>
                                <option data-price="195" value="RAL 7009">RAL 7009</option>
                                <option data-price="195" value="RAL 7010">RAL 7010</option>
                                <option data-price="195" value="RAL 7011">RAL 7011</option>
                                <option data-price="195" value="RAL 7012">RAL 7012</option>
                                <option data-price="195" value="RAL 7013">RAL 7013</option>
                                <option data-price="195" value="RAL 7015">RAL 7015</option>
                                <option data-price="195" value="RAL 7016">RAL 7016</option>
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
                                <option data-price="195" value="RAL 7040">RAL 7040</option>
                                <option data-price="195" value="RAL 7042">RAL 7042</option>
                                <option data-price="195" value="RAL 7043">RAL 7043</option>
                                <option data-price="195" value="RAL 7044">RAL 7044</option>
                                <option data-price="195" value="RAL 7045">RAL 7045</option>
                                <option data-price="195" value="RAL 7046">RAL 7046</option>
                                <option data-price="195" value="RAL 7047">RAL 7047</option>
                                <option data-price="195" value="RAL 7048">RAL 7048</option>
                                <option data-price="195" value="RAL 8000">RAL 8000</option>
                                <option data-price="195" value="RAL 8001">RAL 8001</option>
                                <option data-price="195" value="RAL 8002">RAL 8002</option>
                                <option data-price="195" value="RAL 8003">RAL 8003</option>
                                <option data-price="195" value="RAL 8004">RAL 8004</option>
                                <option data-price="195" value="RAL 8007">RAL 8007</option>
                                <option data-price="195" value="RAL 8008">RAL 8008</option>
                                <option data-price="195" value="RAL 8011">RAL 8011</option>
                                <option data-price="195" value="RAL 8012">RAL 8012</option>
                                <option data-price="195" value="RAL 8014">RAL 8014</option>
                                <option data-price="195" value="RAL 8015">RAL 8015</option>
                                <option data-price="195" value="RAL 8016">RAL 8016</option>
                                <option data-price="195" value="RAL 8017">RAL 8017</option>
                                <option data-price="195" value="RAL 8019">RAL 8019</option>
                                <option data-price="195" value="RAL 8022">RAL 8022</option>
                                <option data-price="195" value="RAL 8023">RAL 8023</option>
                                <option data-price="195" value="RAL 8024">RAL 8024</option>
                                <option data-price="195" value="RAL 8025">RAL 8025</option>
                                <option data-price="195" value="RAL 8028">RAL 8028</option>
                                <option data-price="195" value="RAL 8029">RAL 8029</option>
                                <option data-price="195" value="RAL 9001">RAL 9001</option>
                                <option data-price="195" value="RAL 9002">RAL 9002</option>
                                <option data-price="195" value="RAL 9003">RAL 9003</option>
                                <option data-price="195" value="RAL 9004">RAL 9004</option>
                                <option data-price="195" value="RAL 9005">RAL 9005</option>
                                <option data-price="195" value="RAL 9006">RAL 9006</option>
                                <option data-price="195" value="RAL 9007">RAL 9007</option>
                                <option data-price="195" value="RAL 9010">RAL 9010</option>
                                <option data-price="195" value="RAL 9011">RAL 9011</option>
                                <option data-price="195" value="RAL 9012">RAL 9012</option>
                                <option data-price="195" value="RAL 9016">RAL 9016</option>
                                <option data-price="195" value="RAL 9017">RAL 9017</option>
                                <option data-price="195" value="RAL 9018">RAL 9018</option>
                                <option data-price="195" value="RAL 9022">RAL 9022</option>
                                <option data-price="195" value="RAL 9023">RAL 9023</option>
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

/* Card - Matching Step 4 */
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
    background: #383e42; /* RAL 7016 Anthracite Grey */
}

.colour-inside-swatch.inside-black {
    background: #0a0a0a; /* Black */
}

.colour-inside-swatch.inside-white {
    background: #ffffff; /* White */
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

/* Hover effect for radio button */
.colour-inside-option-card:hover .radio-inside-indicator {
    border-color: #2e7d32;
}

/* Selected card hover state */
.colour-inside-option-card input:checked + label:hover .radio-inside-indicator {
    border-color: #222;
    background: #222;
    box-shadow: inset 0 0 0 3px #fff;
}

/* ================================
   TEXT CONTENT
   ================================ */

/* Text content - Flex container */
.inside-text-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    gap: 10px;
}

/* Colour name */
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

/* RAL code */
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

/* Custom RAL text styling */
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

/* "From £195 per panel" text */
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

/* Custom Colour Specific Styles */
.custom-inside-colour-card {
    position: relative;
}

/* Dropdown container - hidden by default */
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

/* Show dropdown when custom colour radio is checked */
.custom-inside-colour-card input:checked ~ .custom-inside-colour-dropdown {
    display: block;
}

/* Dropdown select styling */
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

/* Custom colour selected state */
.custom-inside-colour-card input:checked + label .selected-inside-ral-code {
    color: #2e7d32;
    font-weight: 500;
}

/* ================================
   SELECTED STATE STYLES
   ================================ */

/* Selected state - Card border styling */
.colour-inside-option-card input:checked + label {
    border: 2px solid #2e7d32;
}

/* Colour swatch selected checkmark */
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

/* Hover effect */
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

/* Container alignment */
.step-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
}

/* ================================
   RESPONSIVE STYLES - FIXED FOR MOBILE
   ================================ */

/* Large Desktop (1400px and above) */
@media (min-width: 1400px) {
    .colour-inside-options-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 25px;
    }
    
    .colour-inside-swatch {
        height: 200px;
    }
    
    .price-vat {
        font-size: 11px;
    }
}

/* Desktop (1025px - 1399px) */
@media (max-width: 1399px) and (min-width: 1025px) {
    .colour-inside-options-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }
    
    .colour-inside-swatch {
        height: 180px;
    }
}

/* Tablet Landscape (769px - 1024px) */
@media (max-width: 1024px) and (min-width: 769px) {
    .colour-inside-options-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 20px;
    }
    
    .colour-inside-swatch {
        height: 160px;
    }
    
    .inside-text-content {
        flex-wrap: wrap;
        gap: 5px;
    }
    
    .colour-inside-name {
        font-size: 15px;
        white-space: normal;
        overflow: visible;
        text-overflow: clip;
        padding-right: 0;
        width: 100%;
    }
    
    .inside-ral-code, .selected-inside-ral-code {
        font-size: 13px;
        text-align: left;
        width: 100%;
        justify-content: flex-start;
    }
    
    .colour-inside-info {
        padding: 15px;
        min-height: 80px;
    }
    
    .custom-inside-colour-dropdown {
        position: relative;
        top: 0;
        margin-top: 10px;
        box-shadow: none;
        border: 1px solid #e0e0e0;
    }
    
    .custom-inside-colour-card input:checked ~ .custom-inside-colour-dropdown {
        display: block;
        position: static;
        margin-top: 10px;
    }
}

/* Mobile (max-width: 768px) */
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
    
    .colour-inside-options-grid {
        grid-template-columns: 1fr !important;
        gap: 15px;
    }
    
    .colour-inside-swatch {
        height: 140px;
    }
    
    .colour-inside-info {
        padding: 15px;
        gap: 10px;
        min-height: 70px;
    }
    
    .radio-inside-indicator {
        width: 16px;
        height: 16px;
        border-width: 2px;
    }
    
    .colour-inside-option-card input:checked + label .radio-inside-indicator {
        box-shadow: inset 0 0 0 4px #fff;
    }
    
    .inside-text-content {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }
    
    .colour-inside-name {
        font-size: 16px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        flex: 1;
    }
    
    .inside-ral-code, .selected-inside-ral-code {
        font-size: 14px;
        text-align: right;
        white-space: nowrap;
        flex-shrink: 0;
    }
    
    .custom-inside-colour-card .selected-inside-ral-code {
        font-size: 14px;
        text-align: right;
    }
    
    .custom-inside-colour-card .selected-inside-ral-code .price-vat {
        font-size: 9px;
    }
    
    .price-vat {
        font-size: 9px;
    }
}

/* Small Mobile (max-width: 480px) */
@media (max-width: 480px) {
    .step-title h2 {
        font-size: 22px;
    }
    
    .step-title p {
        font-size: 14px;
    }
    
    .colour-inside-swatch {
        height: 120px;
    }
    
    .colour-inside-info {
        padding: 12px;
        gap: 8px;
        min-height: 65px;
    }
    
    .radio-inside-indicator {
        width: 14px;
        height: 14px;
        border-width: 1.5px;
    }
    
    .colour-inside-option-card input:checked + label .radio-inside-indicator {
        box-shadow: inset 0 0 0 3px #fff;
    }
    
    .inside-text-content {
        gap: 5px;
    }
    
    .colour-inside-name {
        font-size: 14px;
    }
    
    .inside-ral-code, .selected-inside-ral-code {
        font-size: 12px;
    }
    
    .custom-inside-colour-card .selected-inside-ral-code .price-vat {
        font-size: 8px;
    }
    
    .custom_inside_colour_select {
        padding: 10px 12px;
        font-size: 13px;
        background-position: right 12px center;
        background-size: 10px;
    }
}

/* Extra Small Mobile (max-width: 360px) */
@media (max-width: 360px) {
    .colour-inside-info {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .inside-text-content {
        flex-direction: column;
        align-items: flex-start;
        gap: 3px;
        width: 100%;
    }
    
    .radio-inside-indicator {
        margin-bottom: 5px;
        align-self: flex-start;
    }
    
    .colour-inside-name {
        font-size: 14px;
        width: 100%;
        text-align: left;
    }
    
    .inside-ral-code, .selected-inside-ral-code {
        font-size: 12px;
        text-align: left;
        width: 100%;
        justify-content: flex-start;
    }
    
    .custom-inside-colour-card .selected-inside-ral-code {
        font-size: 12px;
        text-align: left;
        width: 100%;
        justify-content: flex-start;
    }
    
    .custom-inside-colour-card .selected-inside-ral-code .price-vat {
        font-size: 8px;
    }
}

/* Fix for very small devices */
@media (max-width: 320px) {
    .colour-inside-swatch {
        height: 100px;
    }
    
    .colour-inside-name {
        font-size: 13px;
    }
    
    .inside-ral-code, .selected-inside-ral-code {
        font-size: 11px;
    }
}
</style>