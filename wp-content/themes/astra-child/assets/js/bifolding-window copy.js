/**
 * Bifolding Window Builder - Main JavaScript (Steps 1-7)
 */

jQuery(function($){

    // Keep track of the current step index
    let currentStep = 0;
    const steps = $('.wizard-step');
    const totalSteps = steps.length;
    const prevBtn = $('.prev-step');
    const nextBtn = $('.next-step');
    const submitContainer = $('.submit-container');
    const nextFooterBtn = $('.next-footer-btn');
    const submitBtn = $('#submit-btn');

    // Edit mode variables
    let editMode = false;
    let editCartKey = '';

    // ===== STEP MAPPING FOR WINDOWS (Updated to Step 7) =====
    const stepMap = {
        0: 'size',           // Step 1: Window Size
        1: 'panels',         // Step 2: Panel Configuration
        2: 'opening',        // Step 3: Opening Direction
        3: 'outside_colour', // Step 4: Outside Colour
        4: 'inside_colour',  // Step 5: Inside Colour
        5: 'handle_colour',  // Step 6: Handle Colour
        6: 'glass'           // Step 7: Glass Type
    };

    // Track selected outside colour for inside colour options
    let selectedOutsideColour = 'anthracite_grey';

    /**
     * Prefill form data in edit mode
     */
    function prefillFormData(data) {
        if (!data || Object.keys(data).length === 0) {
            if (isDev()) console.log('No data to prefill');
            return;
        }
        
        if (isDev()) console.log('Prefilling form data:', data);

        // === STEP 1: Window Size ===
        if (data.width) $('#window_width').val(data.width);
        if (data.height) $('#window_height').val(data.height);
        
        // === STEP 2: Panels ===
        if (data.panels) {
            const panelMap = {
                '2 Panels Left': '2_left',
                '2 Panels Right': '2_right',
                '1 + 2 Panels': '1_2',
                '2 + 1 Panels': '2_1',
                '3 Panels Left': '3_left',
                '3 Panels Right': '3_right',
                '1 + 3 Panels': '1_3',
                '3 + 1 Panels': '3_1',
                '2 + 2 Panels': '2_2',
                '4 Panels Left': '4_left',
                '4 Panels Right': '4_right',
                '1 + 4 Panels': '1_4',
                '4 + 1 Panels': '4_1',
                '2 + 3 Panels': '2_3',
                '3 + 2 Panels': '3_2',
                '5 Panels Left': '5_left',
                '5 Panels Right': '5_right',
                '2 + 4 Panels': '2_4',
                '3 + 3 Panels': '3_3',
                '4 + 2 Panels': '4_2',
                '6 Panels Left': '6_left',
                '6 Panels Right': '6_right',
                '1 + 5 Panels': '1_5',
                '5 + 1 Panels': '5_1'
            };
            
            let panelValue = panelMap[data.panels];
            
            if (!panelValue) {
                const possibleValues = ['2_left', '2_right', '3_left', '3_right', '4_left', '4_right', 
                    '1_2', '2_1', '1_3', '3_1', '2_2', '1_4', '4_1', '2_3', '3_2',
                    '5_left', '5_right', '2_4', '3_3', '4_2', '6_left', '6_right', '1_5', '5_1'];
                
                if (possibleValues.includes(data.panels)) {
                    panelValue = data.panels;
                }
            }
            
            if (panelValue) {
                setTimeout(function() {
                    $(`input[name="window_panel_layout"][value="${panelValue}"]`).prop('checked', true).trigger('change');
                    if (typeof window.getWindowPaneCount === 'function') {
                        window.getWindowPaneCount();
                    }
                }, 200);
            }
        }
        
        // === STEP 3: Opening Direction ===
        if (data.opening) {
            const openingValue = data.opening === 'Inwards' ? 'inwards' : 'outwards';
            $(`input[name="open_direction"][value="${openingValue}"]`).prop('checked', true);
        }
        
        // === STEP 4: Outside Colour ===
        if (data.outside_colour) {
            if (data.outside_colour.startsWith('RAL ')) {
                $('#window_colour_custom').prop('checked', true).trigger('change');
                $('#custom_window_colour_select').val(data.outside_colour).trigger('change');
            } else {
                const colourMap = {
                    'Anthracite Grey': 'anthracite_grey',
                    'Black': 'black',
                    'White': 'white'
                };
                let colourValue = colourMap[data.outside_colour] || 'custom_ral';
                $(`input[name="window_colour"][value="${colourValue}"]`).prop('checked', true).trigger('change');
            }
        }

        // === STEP 5: Inside Colour ===
        if (data.inside_colour) {
            setTimeout(function() {
                if (data.inside_colour.startsWith('RAL ')) {
                    $('#window_inside_colour_custom').prop('checked', true).trigger('change');
                    $('#custom_window_inside_colour_select').val(data.inside_colour).trigger('change');
                } else {
                    const colourMap = {
                        'Anthracite Grey': 'anthracite_grey',
                        'Black': 'black',
                        'White': 'white'
                    };
                    let colourValue = colourMap[data.inside_colour] || 'custom_ral';
                    const $option = $(`input[name="window_inside_colour"][value="${colourValue}"]`);
                    if ($option.length && $option.closest('.inside-colour-option').is(':visible')) {
                        $option.prop('checked', true).trigger('change');
                    }
                }
            }, 300);
        }
        
        // === STEP 6: Handle Colour ===
        if (data.handle) {
            const handleMap = {
                'White': 'white',
                'Chrome': 'chrome',
                'Black': 'black',
                'Silver': 'silver'
            };
            let handleValue = handleMap[data.handle] || 'white';
            $(`input[name="window_handle_colour"][value="${handleValue}"]`).prop('checked', true);
        }
        
        // === STEP 7: Glass Type ===
        if (data.glass) {
            const glassMap = {
                'Standard Glass': 'standard',
                'Self-cleaning glass': 'self_cleaning',
                'Integral blinds': 'integral_blinds',
                'Obscure glass': 'obscure_glass',
                'Saint-Gobain Planitherm 1.2 U-value upgrade': 'saint_gobain_12'
            };
            
            let glassValue = glassMap[data.glass] || data.glass;
            
            if (glassValue) {
                setTimeout(function() {
                    if (glassValue === 'standard') {
                        $('#window_upgrade_no_thanks').prop('checked', true).trigger('change');
                    } else if (glassValue === 'self_cleaning') {
                        $('#window_upgrade_self_cleaning').prop('checked', true).trigger('change');
                    } else if (glassValue === 'integral_blinds') {
                        $('#window_upgrade_integral_blinds').prop('checked', true).trigger('change');
                    } else if (glassValue === 'obscure_glass') {
                        $('#window_upgrade_obscure_glass').prop('checked', true).trigger('change');
                    } else if (glassValue === 'saint_gobain_12') {
                        $('#window_upgrade_saint_gobain').prop('checked', true).trigger('change');
                    }
                }, 300);
            }
        }
        
        setTimeout(function() {
            if (typeof updatePrice === 'function') {
                updatePrice();
            }
            if (typeof updateDrawer === 'function') {
                updateDrawer();
            }
            $(document).trigger('stepChanged', [currentStep]);
            
            if (isDev()) console.log('Prefill complete');
        }, 500);
    }

    // Check if running in development environment
    function isDev() {
        return window.location.hostname === 'localhost' || 
               window.location.hostname === '127.0.0.1';
    }

    /**
     * Initialize wizard on page load
     */
    function initWizard() {
        if (steps.length) {
            
            if (typeof window.editMode !== 'undefined' && window.editMode) {
                editMode = true;
                editCartKey = window.editCartKey || '';
                
                if (editCartKey) {
                    $('#cart_item_key_field').val(editCartKey);
                }
                
                if (isDev()) {
                    console.log('Edit Mode Active - Cart Key:', editCartKey);
                }
                
                updatePanelOptions();
                
                if (window.editData) {
                    prefillFormData(window.editData);
                }
                
                setTimeout(function() {
                    if (typeof updateDrawer === 'function') {
                        updateDrawer();
                    }
                }, 600);
            } 
            else {
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('edit_cart_item')) {
                    editMode = true;
                    editCartKey = urlParams.get('edit_cart_item');
                    $('#cart_item_key_field').val(editCartKey);
                    window.editCartKey = editCartKey;
                }
            }
            
            window.editMode = editMode;
            
            showStep(currentStep);
            updateNavigation();
            updatePrice();
            validateCurrentStep();
            
            initCustomColourDropdowns();
            initOutsideColourTracking();
            updateInsideColourOptions();
            
            const savedPostcode = $('#window_postcode').val();
            if (savedPostcode && savedPostcode.length > 0) {
                setTimeout(function() {
                    $('#window_postcode').trigger('input');
                }, 1000);
            }
            
            // Initialize inside colour based on initial outside colour
            setTimeout(function() {
                const initialOutsideColour = $('input[name="window_colour"]:checked').val();
                if (initialOutsideColour) {
                    autoSelectMatchingInsideColour(initialOutsideColour);
                }
            }, 200);
        }
    }

    // Track outside colour changes to update inside colour options
    function initOutsideColourTracking() {
        const initialSelected = $('input[name="window_colour"]:checked');
        if (initialSelected.length) {
            selectedOutsideColour = getOutsideColourCategory(initialSelected.val());
            autoSelectMatchingInsideColour(initialSelected.val());
        }
        
        $(document).on('change', 'input[name="window_colour"]', function() {
            const colourValue = $(this).val();
            selectedOutsideColour = getOutsideColourCategory(colourValue);
            updateInsideColourOptions(colourValue);
            validateInsideColourSelection();
            updatePrice();
            autoSelectMatchingInsideColour(colourValue);
        });
        
        $(document).on('change', '#custom_window_colour_select', function() {
            if ($('#window_colour_custom').is(':checked')) {
                updateInsideColourOptions('custom_ral');
                updatePrice();
                autoSelectMatchingInsideColour('custom_ral');
            }
        });
    }

    // Get the category of outside colour (standard or custom)
    function getOutsideColourCategory(colourValue) {
        if (colourValue && colourValue.startsWith('RAL ')) {
            return 'custom_ral';
        }
        if (colourValue === 'anthracite_grey' || colourValue === 'black' || colourValue === 'white') {
            return colourValue;
        }
        return 'custom_ral';
    }

    // Automatically select matching inside colour based on outside colour
    function autoSelectMatchingInsideColour(outsideColourValue) {
        if (!outsideColourValue) return;
        
        let matchingInsideValue = null;
        
        if (outsideColourValue === 'custom_ral') {
            const customRalValue = $('#custom_window_colour_select').val();
            if (customRalValue && customRalValue !== '') {
                matchingInsideValue = 'custom_ral';
            }
        }
        else if (outsideColourValue === 'anthracite_grey') {
            matchingInsideValue = 'anthracite_grey';
        }
        else if (outsideColourValue === 'black') {
            matchingInsideValue = 'black';
        }
        else if (outsideColourValue === 'white') {
            matchingInsideValue = 'white';
        }
        else {
            matchingInsideValue = 'white';
        }
        
        if (matchingInsideValue) {
            const $matchingOption = $(`input[name="window_inside_colour"][value="${matchingInsideValue}"]`);
            const $parentCard = $matchingOption.closest('.inside-colour-option');
            
            if ($parentCard.is(':visible')) {
                $matchingOption.prop('checked', true).trigger('change');
                if (matchingInsideValue === 'custom_ral') {
                    const customOutsideValue = $('#custom_window_colour_select').val();
                    if (customOutsideValue) {
                        $('#custom_window_inside_colour_select').val(customOutsideValue).trigger('change');
                        $('.selected-inside-ral-code').text(customOutsideValue);
                        $('#window_inside_colour_custom').val(customOutsideValue);
                    }
                }
            } else {
                const $firstVisibleOption = $('.inside-colour-option:visible input[name="window_inside_colour"]');
                if ($firstVisibleOption.length) {
                    $firstVisibleOption.prop('checked', true).trigger('change');
                }
            }
        }
    }

    // Update which inside colour options are visible based on outside colour
    function updateInsideColourOptions(selectedOutsideValue) {
        if (!selectedOutsideValue) {
            selectedOutsideValue = $('input[name="window_colour"]:checked').val();
        }
        
        const $anthracite = $('#window_inside_colour_anthracite').closest('.inside-colour-option');
        const $black = $('#window_inside_colour_black').closest('.inside-colour-option');
        const $white = $('#window_inside_colour_white').closest('.inside-colour-option');
        const $custom = $('#window_inside_colour_custom').closest('.inside-colour-option');
        
        $anthracite.hide();
        $black.hide();
        $white.hide();
        $custom.hide();
        
        switch(selectedOutsideValue) {
            case 'anthracite_grey':
                $anthracite.show();
                $white.show();
                $custom.show();
                break;
            case 'black':
                $black.show();
                $custom.show();
                break;
            case 'white':
                $white.show();
                $custom.show();
                break;
            case 'custom_ral':
                $white.show();
                $custom.show();
                break;
            default:
                $white.show();
                $custom.show();
                break;
        }
        
        setTimeout(function() {
            autoSelectMatchingInsideColour(selectedOutsideValue);
        }, 50);
        
        validateInsideColourSelection();
        updateInsideColourGridLayout();
    }

    // Update grid layout based on number of visible inside colour options
    function updateInsideColourGridLayout() {
        const visibleOptions = $('.inside-colour-option:visible').length;
        const $grid = $('.colour-inside-options-grid');
        
        if (visibleOptions === 1) {
            $grid.css('grid-template-columns', '1fr');
        } else if (visibleOptions === 2) {
            $grid.css('grid-template-columns', 'repeat(2, 1fr)');
        } else if (visibleOptions === 3) {
            $grid.css('grid-template-columns', 'repeat(3, 1fr)');
        } else {
            $grid.css('grid-template-columns', 'repeat(4, 1fr)');
        }
        
        if ($(window).width() <= 1024) {
            $('.colour-inside-options-grid').css('grid-template-columns', 'repeat(2, 1fr)');
        }
        if ($(window).width() <= 768) {
            $('.colour-inside-options-grid').css('grid-template-columns', '1fr');
        }
    }

    // Validate that a visible inside colour is selected
    function validateInsideColourSelection() {
        const $selectedInsideColour = $('input[name="window_inside_colour"]:checked');
        
        if ($selectedInsideColour.length) {
            const selectedValue = $selectedInsideColour.val();
            const $selectedCard = $selectedInsideColour.closest('.inside-colour-option');
            
            if (!$selectedCard.is(':visible')) {
                const outsideValue = $('input[name="window_colour"]:checked').val();
                autoSelectMatchingInsideColour(outsideValue);
            }
        } else {
            const outsideValue = $('input[name="window_colour"]:checked').val();
            if (outsideValue) {
                autoSelectMatchingInsideColour(outsideValue);
            } else {
                const $whiteOption = $('#window_inside_colour_white');
                if ($whiteOption.length && $whiteOption.closest('.inside-colour-option').is(':visible')) {
                    $whiteOption.prop('checked', true).trigger('change');
                }
            }
        }
        
        $('input[name="window_inside_colour"]:checked').trigger('change');
    }

    // Initialize custom colour dropdowns for outside and inside colours
    function initCustomColourDropdowns() {
        // Outside colour dropdown
        const customColourSelect = $('#custom_window_colour_select');
        const customColourRadio = $('#window_colour_custom');
        const customColourCard = $('.custom-colour-card');
        const customColourDropdown = $('.custom-colour-dropdown');
        
        if (customColourCard.length) {
            customColourCard.on('click', function(e) {
                if (!$(e.target).closest('.custom-colour-dropdown').length) {
                    customColourRadio.prop('checked', true);
                    customColourDropdown.show();
                    customColourRadio.trigger('change');
                }
            });
            
            customColourSelect.on('change', function() {
                if ($(this).val()) {
                    customColourRadio.val($(this).val());
                    const selectedOption = $(this).find('option:selected');
                    const price = selectedOption.data('price') || 195;
                    customColourRadio.data('price', price);
                    customColourRadio.trigger('change');
                    
                    if (currentStep === 3) {
                        validateCurrentStep();
                    }
                }
            });
            
            $('input[name="window_colour"]').on('change', function() {
                if ($(this).attr('id') !== 'window_colour_custom' && $(this).is(':checked')) {
                    customColourSelect.val('');
                    customColourRadio.val('custom_ral');
                    customColourDropdown.hide();
                    
                    if (currentStep === 3) {
                        validateCurrentStep();
                    }
                }
            });
        }
        
        // Inside colour dropdown
        const customInsideColourSelect = $('#custom_window_inside_colour_select');
        const customInsideColourRadio = $('#window_inside_colour_custom');
        const customInsideColourCard = $('.custom-inside-colour-card');
        const customInsideColourDropdown = $('.custom-inside-colour-dropdown');
        
        if (customInsideColourCard.length) {
            customInsideColourCard.on('click', function(e) {
                if (!$(e.target).closest('.custom-inside-colour-dropdown').length) {
                    customInsideColourRadio.prop('checked', true);
                    customInsideColourDropdown.show();
                    customInsideColourRadio.trigger('change');
                }
            });
            
            customInsideColourSelect.on('change', function() {
                if ($(this).val()) {
                    customInsideColourRadio.val($(this).val());
                    const selectedOption = $(this).find('option:selected');
                    const price = selectedOption.data('price') || 195;
                    customInsideColourRadio.data('price', price);
                    customInsideColourRadio.trigger('change');
                    
                    if (currentStep === 4) {
                        validateCurrentStep();
                    }
                }
            });
            
            $('input[name="window_inside_colour"]').on('change', function() {
                if ($(this).attr('id') !== 'window_inside_colour_custom' && $(this).is(':checked')) {
                    customInsideColourSelect.val('');
                    customInsideColourRadio.val('custom_ral');
                    customInsideColourDropdown.hide();
                    
                    if (currentStep === 4) {
                        validateCurrentStep();
                    }
                }
            });
        }
        
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.custom-colour-card').length && 
                !$(e.target).closest('.custom-colour-dropdown').length) {
                customColourDropdown.hide();
            }
            
            if (!$(e.target).closest('.custom-inside-colour-card').length && 
                !$(e.target).closest('.custom-inside-colour-dropdown').length) {
                customInsideColourDropdown.hide();
            }
        });
        
        $(window).on('resize', function() {
            updateInsideColourGridLayout();
        });
    }

    // Display the current step
    function showStep(index) {
        if (index < 0 || index >= totalSteps) return;
        
        steps.removeClass('active');
        steps.eq(index).addClass('active');
        
        currentStep = index;
        window.currentStep = currentStep;
        
        updateNavigation();
        
        if (index === totalSteps - 1) {
            submitContainer.show();
        } else {
            submitContainer.hide();
        }
        
        if (index === 0) {
            prevBtn.prop('disabled', true);
        } else {
            prevBtn.prop('disabled', false);
        }
        
        // Step 4 (Outside Colour) validation
        if (index === 3) {
            setTimeout(function() {
                validateCurrentStep();
            }, 100);
        }

        // Step 5 (Inside Colour) validation
        if (index === 4) {
            setTimeout(function() {
                const selectedOutside = $('input[name="window_colour"]:checked').val();
                if (selectedOutside) {
                    updateInsideColourOptions(selectedOutside);
                }
                validateInsideColourSelection();
                validateCurrentStep();
            }, 200);
        }
        
        // Step 6 (Handle Colour) validation
        if (index === 5) {
            setTimeout(function() {
                validateCurrentStep();
            }, 100);
        }
        
        // Step 7 (Glass) validation
        if (index === 6) {
            setTimeout(function() {
                validateCurrentStep();
            }, 100);
        }
        
        if ($(window).width() <= 768) {
            $('html, body').animate({
                scrollTop: $('.window-builder-form').offset().top - 20
            }, 300);
        }
        
        if (isDev()) {
            console.log('Step changed to:', index, '(', stepMap[index], ')');
        }
    }

    // Update navigation button states and text
    function updateNavigation() {
        if (currentStep === 0) {
            prevBtn.prop('disabled', true);
        } else {
            prevBtn.prop('disabled', false);
        }
        
        if (currentStep === totalSteps - 1) {
            if (editMode) {
                nextBtn.text('UPDATE CART');
                if(nextFooterBtn.length) nextFooterBtn.text('UPDATE CART →');
            } else {
                nextBtn.text('ADD TO CART');
                if(nextFooterBtn.length) nextFooterBtn.text('ADD TO CART →');
            }
        } else {
            nextBtn.text('NEXT');
            if(nextFooterBtn.length) nextFooterBtn.text('NEXT →');
        }
        
        if (currentStep === totalSteps - 1) {
            prevBtn.prop('disabled', false);
        }
    }

    // Validate the current step and update next button state
    function validateCurrentStep() {
        const isValid = validateStep(currentStep);

        if (currentStep < totalSteps - 1) {
            if (isValid) {
                nextBtn.removeClass('inactive').prop('disabled', false);
                if(nextFooterBtn.length) nextFooterBtn.removeClass('inactive').prop('disabled', false);
                
                if (isDev()) console.log('Step', currentStep, 'valid - Next button enabled');
            } else {
                nextBtn.addClass('inactive').prop('disabled', true);
                if(nextFooterBtn.length) nextFooterBtn.addClass('inactive').prop('disabled', true);
                
                if (isDev()) console.log('Step', currentStep, 'invalid - Next button disabled');
            }
        }

        return isValid;
    }

    // Validate individual step based on step index
    function validateStep(stepIndex) {
        // Step 1: Window Size
        if (stepIndex === 0) {
            const width = $('#window_width').val();
            const height = $('#window_height').val();
            let isValid = true;
            
            if (!width) {
                $('#width-error').text('Width is required.').show();
                isValid = false;
            } else {
                const widthNum = parseInt(width);
                if (isNaN(widthNum)) {
                    $('#width-error').text('Width must be a valid number.').show();
                    isValid = false;
                } else if (widthNum < 1600) {
                    $('#width-error').text('Width must be at least 1600 mm.').show();
                    isValid = false;
                } else if (widthNum > 5800) {
                    $('#width-error').text('Width cannot exceed 5800 mm.').show();
                    isValid = false;
                } else {
                    $('#width-error').hide();
                }
            }
            
            if (!height) {
                $('#height-error').text('Height is required.').show();
                isValid = false;
            } else {
                const heightNum = parseInt(height);
                if (isNaN(heightNum)) {
                    $('#height-error').text('Height must be a valid number.').show();
                    isValid = false;
                } else if (heightNum < 700) {
                    $('#height-error').text('Height must be at least 700 mm.').show();
                    isValid = false;
                } else if (heightNum > 1650) {
                    $('#height-error').text('Height cannot exceed 1650 mm.').show();
                    isValid = false;
                } else {
                    $('#height-error').hide();
                }
            }
            
            return isValid;
        }

        // Step 2: Panel Configuration
        if (stepIndex === 1) {
            return $('input[name="window_panel_layout"]:checked').length > 0;
        }

        // Step 3: Opening Direction
        if (stepIndex === 2) {
            return $('input[name="open_direction"]:checked').length > 0;
        }

        // Step 4: Outside Colour
        if (stepIndex === 3) {
            const selectedColour = $('input[name="window_colour"]:checked').val();
            if (selectedColour === 'custom_ral' || (selectedColour && selectedColour.startsWith('RAL '))) {
                const customRalValue = $('#custom_window_colour_select').val();
                return customRalValue && customRalValue !== '';
            }
            return $('input[name="window_colour"]:checked').length > 0;
        }

        // Step 5: Inside Colour
        if (stepIndex === 4) {
            const hasSelection = $('input[name="window_inside_colour"]:checked').length > 0;
            if (!hasSelection) return false;
            
            const selectedValue = $('input[name="window_inside_colour"]:checked').val();
            
            if (selectedValue === 'custom_ral' || (selectedValue && selectedValue.startsWith('RAL '))) {
                const customRalValue = $('#custom_window_inside_colour_select').val();
                return customRalValue && customRalValue !== '';
            }
            
            const $selectedCard = $(`input[name="window_inside_colour"][value="${selectedValue}"]`).closest('.inside-colour-option');
            return $selectedCard.is(':visible');
        }

        // Step 6: Handle Colour
        if (stepIndex === 5) {
            return $('input[name="window_handle_colour"]:checked').length > 0;
        }

        // Step 7: Glass Type
        if (stepIndex === 6) {
            return $('input[name="glass_type"]:checked').length > 0;
        }

        return true;
    }

    // Calculate and update total price
    function updatePrice() {
        let base = parseFloat($('#base_price_value').val());
        if (isNaN(base)) base = 0;

        let extra = 0;
        
        // Get pane count from panel selection
        let paneCount = 1;
        const selectedPanel = $('input[name="window_panel_layout"]:checked').val();
        if (selectedPanel) {
            if (selectedPanel.includes('_')) {
                const parts = selectedPanel.split('_');
                if (parts.length === 2 && !isNaN(parseInt(parts[0])) && !isNaN(parseInt(parts[1]))) {
                    paneCount = parseInt(parts[0]) + parseInt(parts[1]);
                } else {
                    const match = selectedPanel.match(/^(\d+)/);
                    if (match) paneCount = parseInt(match[1]);
                }
            } else {
                const match = selectedPanel.match(/^(\d+)/);
                if (match) paneCount = parseInt(match[1]);
            }
        }
        
        // Outside colour pricing
        const outsideColour = $('input[name="window_colour"]:checked').val();
        const insideColour = $('input[name="window_inside_colour"]:checked').val();
        const customRalValue = $('#custom_window_colour_select').val();
        const customInsideRalValue = $('#custom_window_inside_colour_select').val();
        
        const standardColours = ['anthracite_grey', 'black', 'white'];
        
        // Check if outside colour is standard or custom
        let isOutsideStandard = false;
        let isOutsideCustom = false;
        
        if ((outsideColour === 'custom_ral' || (outsideColour && outsideColour.startsWith('RAL '))) && customRalValue && customRalValue !== '') {
            isOutsideCustom = true;
        } else if (outsideColour && !standardColours.includes(outsideColour) && outsideColour !== 'custom_ral') {
            isOutsideCustom = true;
        } else if (outsideColour && standardColours.includes(outsideColour)) {
            isOutsideStandard = true;
        }
        
        // Check if inside colour is standard or custom
        let isInsideStandard = false;
        let isInsideCustom = false;
        
        if ((insideColour === 'custom_ral' || (insideColour && insideColour.startsWith('RAL '))) && customInsideRalValue && customInsideRalValue !== '') {
            isInsideCustom = true;
        } else if (insideColour && !standardColours.includes(insideColour) && insideColour !== 'custom_ral') {
            isInsideCustom = true;
        } else if (insideColour && standardColours.includes(insideColour)) {
            isInsideStandard = true;
        }
        
        // Check for free dual colour (Anthracite outside + White inside)
        const isFreeDualColour = (
            outsideColour === 'anthracite_grey' && 
            insideColour === 'white' &&
            !isOutsideCustom && 
            !isInsideCustom
        );
        
        // Check if same standard colour (no extra charge)
        const isSameStandardColour = (
            outsideColour === insideColour && 
            standardColours.includes(outsideColour) &&
            !isOutsideCustom && 
            !isInsideCustom
        );
        
        let outsideColourPrice = 0;
        let insideColourPrice = 0;
        
        if (isFreeDualColour || isSameStandardColour) {
            outsideColourPrice = 0;
            insideColourPrice = 0;
        } 
        else {
            // Custom RAL charges: £195 each
            if (isOutsideCustom) {
                outsideColourPrice = 195;
            }
            if (isInsideCustom) {
                insideColourPrice = 195;
            }
        }
        
        extra += outsideColourPrice;
        extra += insideColourPrice;
        
        // Glass pricing (Window - fixed price)
        const glassType = $('input[name="glass_type"]:checked');
        if (glassType.length && glassType.val() !== 'standard') {
            let glassPrice = parseFloat(glassType.data('price')) || 0;
            extra += glassPrice;
        }

        let total = base + extra;

        $('#final-price-confirm').text('£' + total.toFixed(2));
        $('#submit-price').text('£' + total.toFixed(2));
        $('#final_price_input').val(total.toFixed(2));
        
        window.lastCalculatedPrice = total.toFixed(2);
        
        return total;
    }

    // Go to next step
    function goNextStep() {
        if (!validateCurrentStep()) {
            return;
        }

        if (currentStep < totalSteps - 1) {
            let nextIndex = currentStep + 1;
            showStep(nextIndex);
        } else {
            submitBuilderForm();
        }
    }

    // Go to previous step
    function goPrevStep() {
        if (currentStep > 0) {
            let prevIndex = currentStep - 1;
            showStep(prevIndex);
            
            if (isDev()) {
                console.log('Going to previous step:', prevIndex);
            }
        }
    }

    // Submit the builder form
    function submitBuilderForm() {
        if (!validateStep(0)) {
            showStep(0);
            return;
        }
        
        if (typeof window.submitBuilderForm === 'function') {
            window.submitBuilderForm();
        } else {
            $('#window-builder-form').submit();
        }
    }

    // Event handlers
    $(document).on('input', '#window_width, #window_height', function() {
        updatePrice();
        validateCurrentStep();
        updatePanelOptions();
    });

    $(document).on('change', 'input[name="window_panel_layout"]', function() {
        validateCurrentStep();
        updatePrice();
        updatePanelOptions();
    });

    $(document).on('change', 'input[name="open_direction"]', function() {
        validateCurrentStep();
        updatePrice();
    });

    $(document).on('change', 'input[name="window_colour"]', function() {
        validateCurrentStep();
        updatePrice();
    });

    $(document).on('change', 'input[name="window_inside_colour"]', function() {
        validateCurrentStep();
        updatePrice();
    });

    $(document).on('change', 'input[name="window_handle_colour"]', function() {
        validateCurrentStep();
        updatePrice();
    });

    $(document).on('change', 'input[name="glass_type"]', function() {
        validateCurrentStep();
        updatePrice();
        
        // Update drawer if function exists
        if (typeof updateDrawer === 'function') {
            updateDrawer();
        }
    });

    $(document).on('change', '#custom_window_colour_select', function() {
        if (currentStep === 3) {
            validateCurrentStep();
            updatePrice();
        }
    });

    $(document).on('change', '#custom_window_inside_colour_select', function() {
        if (currentStep === 4) {
            validateCurrentStep();
            updatePrice();
        }
    });

    $(document).on('click', '.next-step', goNextStep);
    $(document).on('click', '.prev-step', goPrevStep);
    
    if(nextFooterBtn.length) {
        nextFooterBtn.on('click', goNextStep);
    }

    initWizard();

    // Update panel options based on window width
    function updatePanelOptions() {
        const width = parseInt($('#window_width').val());
        const height = parseInt($('#window_height').val());
        const $allPanels = $('.panel-option-card');

        $allPanels.hide();
        if (isNaN(width) || isNaN(height)) {
            if (window.editMode) {
                const selectedPanel = $('input[name="window_panel_layout"]:checked').val();
                if (selectedPanel) {
                    const $selectedCard = $(`input[name="window_panel_layout"][value="${selectedPanel}"]`).closest('.panel-option-card');
                    $selectedCard.show();
                }
            }
            return;
        }

        let activeClass = '';
        let panelCount = 0;
        let basePrice = 0;

        if (width >= 1600 && width <= 2000) {
            activeClass = 'panel-2';
            panelCount = 2;
            basePrice = 1390;
        }
        else if (width >= 2001 && width <= 2600) {
            activeClass = 'panel-3';
            panelCount = 3;
            if (width <= 2200) basePrice = 1520;
            else if (width <= 2600) basePrice = 1650;
            else basePrice = 1790;
        }
        else if (width >= 2601 && width <= 3400) {
            activeClass = 'panel-4';
            panelCount = 4;
            if (width <= 3000) basePrice = 2100;
            else basePrice = 2290;
        }
        else if (width >= 3401 && width <= 4200) {
            activeClass = 'panel-5';
            panelCount = 5;
            if (width <= 3800) basePrice = 2920;
            else basePrice = 3010;
        }
        else if (width >= 4201 && width <= 5800) {
            activeClass = 'panel-6';
            panelCount = 6;
            if (width <= 5000) basePrice = 3750;
            else basePrice = 3990;
        }

        let heightExtra = 0;
        
        if (!isNaN(height) && panelCount > 0) {
            if (height >= 700 && height <= 900) heightExtra = 0;
            else if (height >= 901 && height <= 1200) heightExtra = 60 * panelCount;
            else if (height >= 1201 && height <= 1650) heightExtra = 100 * panelCount;
        }

        const displayPrice = basePrice + heightExtra;

        if (activeClass) {
            const $activePanels = $('.' + activeClass);
            $activePanels.show();
            
            $activePanels.each(function() {
                const $priceSpan = $(this).find('.panel-details .option-price');
                $priceSpan.html('+ £' + displayPrice + ' <span class="price-vat">(inc. VAT)</span>');
                $(this).find('.price-option').attr('data-price', 0);
                $(this).attr('data-display-price', displayPrice);
            });
        }

        if (!window.editMode) {
            $('input[name="window_panel_layout"]:checked').not(':visible').prop('checked', false);
        }

        updatePrice();
        
        if (typeof window.getWindowPaneCount === 'function') {
            window.getWindowPaneCount();
        }
    }

    $(document).on('input blur', '#window_width, #window_height', function () {
        updatePanelOptions();
    });

    // ========================================
    // SLIDING DRAWER FUNCTIONS
    // ========================================

    // Step definitions for drawer display (Updated to Step 7)
    const stepDefinitions = [
        {
            number: 1,
            name: 'Window Size',
            getValue: function() {
                const w = $('#window_width').val();
                const h = $('#window_height').val();
                return (w && h) ? w + ' x ' + h + 'mm' : '—';
            },
            getPrice: function() {
                return parseFloat($('#base_price_value').val()) || 0;
            }
        },
        {
            number: 2,
            name: 'Panels',
            getValue: function() {
                const panelValue = $('input[name="window_panel_layout"]:checked').val();
                if (!panelValue) return '—';
                
                let panelText = $('input[name="window_panel_layout"]:checked')
                    .closest('.panel-option-card, label')
                    .find('.option-name').text().trim();
                
                if (!panelText) {
                    const panelMap = {
                        '2_left': '2 Panels Left', '2_right': '2 Panels Right',
                        '1_2': '1 + 2 Panels', '2_1': '2 + 1 Panels',
                        '3_left': '3 Panels Left', '3_right': '3 Panels Right',
                        '1_3': '1 + 3 Panels', '3_1': '3 + 1 Panels',
                        '2_2': '2 + 2 Panels',
                        '4_left': '4 Panels Left', '4_right': '4 Panels Right',
                        '1_4': '1 + 4 Panels', '4_1': '4 + 1 Panels',
                        '2_3': '2 + 3 Panels', '3_2': '3 + 2 Panels',
                        '5_left': '5 Panels Left', '5_right': '5 Panels Right',
                        '2_4': '2 + 4 Panels', '3_3': '3 + 3 Panels', '4_2': '4 + 2 Panels',
                        '6_left': '6 Panels Left', '6_right': '6 Panels Right',
                        '1_5': '1 + 5 Panels', '5_1': '5 + 1 Panels'
                    };
                    panelText = panelMap[panelValue] || panelValue;
                }
                return panelText;
            },
            getPrice: function() { return 0; }
        },
        {
            number: 3,
            name: 'Opening',
            getValue: function() {
                const val = $('input[name="open_direction"]:checked').val();
                return val ? (val === 'inwards' ? 'Inwards' : 'Outwards') : '—';
            },
            getPrice: function() { return 0; }
        },
        {
            number: 4,
            name: 'Outside Colour',
            getValue: function() {
                const val = $('input[name="window_colour"]:checked').val();
                if (!val) return '—';
                
                if (val && val.startsWith('RAL ')) {
                    return val;
                }
                
                if (val === 'custom_ral') {
                    const selectedRal = $('#custom_window_colour_select').val();
                    return selectedRal || 'Custom RAL';
                }
                
                const colourMap = {
                    'anthracite_grey': 'Anthracite Grey',
                    'black': 'Black',
                    'white': 'White'
                };
                return colourMap[val] || val;
            },
            getPrice: function() {
                const val = $('input[name="window_colour"]:checked').val();
                const insideColour = $('input[name="window_inside_colour"]:checked').val();
                
                const isFreeDual = (val === 'anthracite_grey' && insideColour === 'white');
                if (isFreeDual) return 0;
                
                if (val === 'custom_ral' || (val && val.startsWith('RAL '))) {
                    return 195;
                }
                
                return 0;
            }
        },
        {
            number: 5,
            name: 'Inside Colour',
            getValue: function() {
                const val = $('input[name="window_inside_colour"]:checked').val();
                if (!val) return '—';
                
                if (val && val.startsWith('RAL ')) {
                    return val;
                }
                
                if (val === 'custom_ral') {
                    const selectedRal = $('#custom_window_inside_colour_select').val();
                    return selectedRal || 'Custom RAL';
                }
                
                const colourMap = {
                    'anthracite_grey': 'Anthracite Grey',
                    'black': 'Black',
                    'white': 'White'
                };
                return colourMap[val] || val;
            },
            getPrice: function() {
                const val = $('input[name="window_inside_colour"]:checked').val();
                const outsideColour = $('input[name="window_colour"]:checked').val();
                
                const isFreeDual = (outsideColour === 'anthracite_grey' && val === 'white');
                if (isFreeDual) return 0;
                
                if (val === 'custom_ral' || (val && val.startsWith('RAL '))) {
                    return 195;
                }
                
                return 0;
            }
        },
        {
            number: 6,
            name: 'Handle',
            getValue: function() {
                const val = $('input[name="window_handle_colour"]:checked').val();
                if (!val) return '—';
                
                const handleMap = {
                    'white': 'White',
                    'chrome': 'Chrome',
                    'black': 'Black',
                    'silver': 'Silver'
                };
                return handleMap[val] || val;
            },
            getPrice: function() { return 0; }
        },
        {
            number: 7,
            name: 'Glass',
            getValue: function() {
                const val = $('input[name="glass_type"]:checked').val();
                if (!val) return '—';
                
                const glassMap = {
                    'standard': 'Standard Glass',
                    'self_cleaning': 'Self-cleaning glass',
                    'integral_blinds': 'Integral blinds',
                    'obscure_glass': 'Obscure glass',
                    'saint_gobain_12': 'Saint-Gobain Planitherm 1.2'
                };
                return glassMap[val] || val;
            },
            getPrice: function() {
                const val = $('input[name="glass_type"]:checked');
                if (val.length && val.val() !== 'standard') {
                    return parseFloat(val.data('price')) || 0;
                }
                return 0;
            }
        }
    ];

    // Build drawer steps HTML
    function buildDrawerSteps() {
        let html = '';
        
        stepDefinitions.forEach(step => {
            const value = step.getValue();
            const price = step.getPrice();
            const priceDisplay = price > 0 ? '£' + price.toFixed(2) : '£0';
            const completedClass = (value !== '—') ? 'completed' : '';
            
            html += `
                <div class="drawer-step-item ${completedClass}" data-step="${step.number}">
                    <div class="step-label">
                        <span class="step-number">${step.number}</span>
                        <span class="step-name">${step.name}</span>
                    </div>
                    <div class="step-value" title="${value}">${value}</div>
                    <div class="step-price">${priceDisplay}</div>
                </div>
            `;
        });
        
        $('#drawerStepsList').html(html);
    }

    // Update drawer content and prices
    function updateDrawer() {
        let totalPrice = 0;
        
        stepDefinitions.forEach(step => {
            const value = step.getValue();
            const price = step.getPrice();
            
            let priceDisplay = '';
            if (price > 0) {
                priceDisplay = '£' + price.toFixed(2);
            } else {
                priceDisplay = '£0';
            }
            
            const $stepItem = $(`.drawer-step-item[data-step="${step.number}"]`);
            if ($stepItem.length) {
                $stepItem.find('.step-value').text(value).attr('title', value);
                $stepItem.find('.step-price').text(priceDisplay);
                
                if (value !== '—') {
                    $stepItem.addClass('completed');
                } else {
                    $stepItem.removeClass('completed');
                }
            }
            
            totalPrice += price;
        });
        
        const totalDisplay = '£' + totalPrice.toFixed(2);
        $('#drawer-total-price').text(totalDisplay);
        $('#drawer-footer-total').text(totalDisplay);
        $('#final_price_input').val(totalPrice.toFixed(2));
        
        updateDrawerButtons();
        
        if (isDev()) {
            console.log('Drawer updated - Total:', totalPrice.toFixed(2));
        }
    }

    // Update drawer button states
    function updateDrawerButtons() {
        $('#drawerAddToCart, #drawerCheckout').removeClass('disabled').prop('disabled', false);
        $('#drawerAddToCart').text('ADD TO CART');
    }

    // Toggle drawer open/close
    function toggleDrawer(open) {
        const $drawerContent = $('#drawerContent');
        
        if (open) {
            $drawerContent.addClass('open');
            $('.toggle-arrow').text('▶');
        } else {
            $drawerContent.removeClass('open');
            $('.toggle-arrow').text('◀');
        }
    }

    // Initialize drawer
    function initDrawer() {
        buildDrawerSteps();
        
        setTimeout(function() {
            updateDrawer();
        }, 500);
        
        $('#drawerToggle').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            toggleDrawer(true);
        });
        
        $('#drawerClose').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            toggleDrawer(false);
        });
        
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#drawerContent').length && 
                !$(e.target).closest('#drawerToggle').length) {
                toggleDrawer(false);
            }
        });
        
        $(document).on('change input', 
            '#window_width, #window_height, ' +
            'input[name="window_panel_layout"], input[name="open_direction"], ' +
            'input[name="window_colour"], input[name="window_inside_colour"], ' +
            'input[name="window_handle_colour"], input[name="glass_type"], ' +
            '#custom_window_colour_select, #custom_window_inside_colour_select',
            function() {
                updateDrawer();
            }
        );
        
        $('#drawerAddToCart').on('click', function() {
            if ($(this).hasClass('disabled')) {
                return;
            }
            
            if (typeof submitBuilderForm === 'function') {
                submitBuilderForm();
            } else {
                $('#window-builder-form').submit();
            }
        });
        
        $('#drawerCheckout').on('click', function() {
            if ($(this).hasClass('disabled')) {
                return;
            }
            
            $('#builder_checkout_input').val('1');
            
            if (typeof submitBuilderForm === 'function') {
                submitBuilderForm();
            } else {
                $('#window-builder-form').submit();
            }
        });
        
        if (window.editMode) {
            $('#drawerEditMode').show().text('Editing cart item: ' + (window.editCartKey || ''));
        }
    }

    if ($('.drawer-container').length) {
        initDrawer();
    }

    // Make functions available globally
    window.updateDrawer = updateDrawer;
    window.getWindowPaneCount = function() {
        const selectedPanel = $('input[name="window_panel_layout"]:checked').val();
        if (!selectedPanel) return 1;
        
        let paneCount = 1;
        
        if (selectedPanel.includes('_')) {
            const parts = selectedPanel.split('_');
            if (parts.length === 2 && !isNaN(parseInt(parts[0])) && !isNaN(parseInt(parts[1]))) {
                paneCount = parseInt(parts[0]) + parseInt(parts[1]);
            } else {
                const match = selectedPanel.match(/^(\d+)/);
                if (match) paneCount = parseInt(match[1]);
            }
        } else {
            const match = selectedPanel.match(/^(\d+)/);
            if (match) paneCount = parseInt(match[1]);
        }
        
        return Math.max(1, paneCount);
    };
    window.toggleDrawer = toggleDrawer;
    window.validateStep1 = validateStep;
    window.updatePrice = updatePrice;
    window.validateCurrentStep = validateCurrentStep;

});