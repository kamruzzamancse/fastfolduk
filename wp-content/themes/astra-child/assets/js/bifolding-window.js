/**
 * Bifolding Window Builder - Main JavaScript (All Steps 1-14)
 */

jQuery(function($){

    let isSubmitting = false;

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

    // ===== STEP MAPPING FOR WINDOWS (14 Steps) =====
    const stepMap = {
        0: 'size',           // Step 1: Size
        1: 'panels',         // Step 2: Panels
        2: 'opening',        // Step 3: Opening Direction
        3: 'outside_colour', // Step 4: Outside Colour
        4: 'inside_colour',  // Step 5: Inside Colour
        5: 'handle_colour',  // Step 6: Handle Colour
        6: 'glass',          // Step 7: Glass
        7: 'trickle_vents',  // Step 8: Trickle Vents
        8: 'cill',           // Step 9: Cill
        9: 'postcode',       // Step 10: Postcode
        10: 'installation',  // Step 11: Installation Type
        11: 'access',        // Step 12: Access Issues
        12: 'customer_info', // Step 13: Customer Information
        13: 'summary'        // Step 14: Summary
    };

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
            if (isDev()) console.log('Panel data to restore:', data.panels);
            
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
                '1 + 5 Panels': '1_5',
                '2 + 4 Panels': '2_4',
                '3 + 3 Panels': '3_3',
                '4 + 2 Panels': '4_2',
                '5 + 1 Panels': '5_1',
                '6 Panels Left': '6_left',
                '6 Panels Right': '6_right'
            };
            
            let panelValue = panelMap[data.panels];
            
            if (!panelValue) {
                const possibleValues = [
                    '2_left', '2_right', '1_2', '2_1', '3_left', '3_right', '1_3', '3_1', '2_2',
                    '4_left', '4_right', '1_4', '4_1', '2_3', '3_2', '5_left', '5_right',
                    '1_5', '2_4', '3_3', '4_2', '5_1', '6_left', '6_right'
                ];
                
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
        
        // === STEP 7: Glass ===
        if (data.glass) {
            const glassMap = {
                'Self-cleaning glass': 'self_cleaning',
                'Integral blinds': 'integral_blinds',
                'Obscure glass': 'obscure_glass',
                'Saint-Gobain Planitherm 1.2': 'saint_gobain_12',
                'Low-E Argon Filled': 'low_e_argon'
            };
            
            let glassValue = glassMap[data.glass];
            
            if (!glassValue) {
                const possibleValues = ['self_cleaning', 'integral_blinds', 'obscure_glass', 'saint_gobain_12', 'low_e_argon'];
                if (possibleValues.includes(data.glass)) {
                    glassValue = data.glass;
                }
            }
            
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
                    } else if (glassValue === 'low_e_argon') {
                        $('#window_upgrade_low_e_argon').prop('checked', true).trigger('change');
                    }
                }, 300);
            }
        }
        
        // === STEP 8: Trickle Vents ===
        if (data.vents) {
            const trickleValue = data.vents.includes('With') ? 'yes_trickle' : 'no_trickle';
            $(`input[name="trickle_vents"][value="${trickleValue}"]`).prop('checked', true).trigger('change');
        }
        
        // === STEP 9: Cill ===
        if (data.cill) {
            if (data.cill === 'No Cill') {
                $('input[name="cill"][value="none"]').prop('checked', true);
            } else if (data.cill === '150mm Aluminium Cill') {
                $('input[name="cill"][value="150mm-aluminium-cill"]').prop('checked', true);
            } else if (data.cill === '150mm uPVC Cill') {
                $('input[name="cill"][value="150mm-upvc-cill"]').prop('checked', true);
            } else {
                const validValues = ['150mm-aluminium-cill', '150mm-upvc-cill', 'none'];
                if (validValues.includes(data.cill)) {
                    $(`input[name="cill"][value="${data.cill}"]`).prop('checked', true);
                }
            }
        }
        
        // === STEP 10: Postcode ===
        if (data.postcode) {
            $('#window_postcode').val(data.postcode);
            setTimeout(function() {
                $('#window_postcode').trigger('input');
            }, 500);
        }
        
        // === STEP 11: Installation Type ===
        if (data.installation_type) {
            const installMap = {
                'collection': 'collection',
                'delivery': 'delivery',
                'install_existing': 'install_existing',
                'install_new_build': 'install_new_build'
            };
            
            let installValue = installMap[data.installation_type] || data.installation_type;
            $(`input[name="window_installation_type"][value="${installValue}"]`).prop('checked', true).trigger('change');
        }
        
        // === STEP 12: Access Issues ===
        if (data.access) {
            if (data.access === 'No' || data.access === 'No Access Issues') {
                $('input[name="window_access_issues"][value="no_access"]').prop('checked', true);
            } else {
                $('input[name="window_access_issues"][value="yes_access"]').prop('checked', true);
                if (data.access !== 'Yes') {
                    const desc = data.access.replace('Yes, ', '').replace('Yes', '');
                    if (desc) {
                        $('#window_access_description').val(desc);
                    }
                }
            }
        }
        
        // === STEP 13: Customer Information ===
        if (data.first_name) $('#window_first_name').val(data.first_name);
        if (data.last_name) $('#window_last_name').val(data.last_name);
        if (data.email) $('#window_email_address').val(data.email);
        if (data.phone) $('#window_mobile_number').val(data.phone);
        
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

    let selectedOutsideColour = 'anthracite_grey';

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
            updateSummary();
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

    function initAccessIssuesToggle() {
        $(document).on('change', 'input[name="window_access_issues"]', function() {
            if ($(this).val() === 'yes_access') {
                $('.access-textarea-wrapper').slideDown();
            } else {
                $('.access-textarea-wrapper').slideUp();
                $('#window_access_description').val('');
            }
            validateCurrentStep();
        });
    }

    function initOutsideColourTracking() {
        const initialSelected = $('input[name="window_colour"]:checked');
        if (initialSelected.length) {
            selectedOutsideColour = getOutsideColourCategory(initialSelected.val());
            // Auto-select matching inside colour
            autoSelectMatchingInsideColour(initialSelected.val());
        }
        
        $(document).on('change', 'input[name="window_colour"]', function() {
            const colourValue = $(this).val();
            selectedOutsideColour = getOutsideColourCategory(colourValue);
            updateInsideColourOptions(colourValue);
            validateInsideColourSelection();
            updatePrice();
            
            // Auto-select matching inside colour when outside colour changes
            autoSelectMatchingInsideColour(colourValue);
        });
        
        $(document).on('change', '#custom_window_colour_select', function() {
            if ($('#window_colour_custom').is(':checked')) {
                updateInsideColourOptions('custom_ral');
                updatePrice();
                // Auto-select custom inside colour when custom outside is selected
                autoSelectMatchingInsideColour('custom_ral');
            }
        });
    }

    /**
     * Auto-select matching inside colour based on outside colour selection
     */
    function autoSelectMatchingInsideColour(outsideColourValue) {
        if (!outsideColourValue) return;
        
        let matchingInsideValue = null;
        
        // Handle custom RAL colours
        if (outsideColourValue === 'custom_ral') {
            const customRalValue = $('#custom_window_colour_select').val();
            if (customRalValue && customRalValue !== '') {
                matchingInsideValue = 'custom_ral';
            }
        }
        // Handle standard colours
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
            // For any other value, default to white
            matchingInsideValue = 'white';
        }
        
        // Check if the matching option is visible
        if (matchingInsideValue) {
            const $matchingOption = $(`input[name="window_inside_colour"][value="${matchingInsideValue}"]`);
            const $parentCard = $matchingOption.closest('.inside-colour-option');
            
            if ($parentCard.is(':visible')) {
                $matchingOption.prop('checked', true).trigger('change');
                if (matchingInsideValue === 'custom_ral') {
                    // If custom RAL, also sync the dropdown value
                    const customOutsideValue = $('#custom_window_colour_select').val();
                    if (customOutsideValue) {
                        $('#custom_window_inside_colour_select').val(customOutsideValue).trigger('change');
                        $('.selected-inside-ral-code').text(customOutsideValue);
                        $('#window_inside_colour_custom').val(customOutsideValue);
                    }
                }
            } else {
                // If matching option not visible, select the first visible option
                const $firstVisibleOption = $('.inside-colour-option:visible input[name="window_inside_colour"]');
                if ($firstVisibleOption.length) {
                    $firstVisibleOption.prop('checked', true).trigger('change');
                }
            }
        }
    }

    function getOutsideColourCategory(colourValue) {
        if (colourValue && colourValue.startsWith('RAL ')) {
            return 'custom_ral';
        }
        if (colourValue === 'anthracite_grey' || colourValue === 'black' || colourValue === 'white') {
            return colourValue;
        }
        return 'custom_ral';
    }

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
        
        // Auto-select matching inside colour after updating visibility
        setTimeout(function() {
            autoSelectMatchingInsideColour(selectedOutsideValue);
        }, 50);
        
        validateInsideColourSelection();
        updateInsideColourGridLayout();
    }

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
        
        updateInsideColourResponsiveLayout(visibleOptions);
    }

    function updateInsideColourResponsiveLayout(visibleOptions) {
        if ($(window).width() <= 1024) {
            $('.colour-inside-options-grid').css('grid-template-columns', 'repeat(2, 1fr)');
        }
        if ($(window).width() <= 768) {
            $('.colour-inside-options-grid').css('grid-template-columns', '1fr');
        }
    }

    function validateInsideColourSelection() {
        const $selectedInsideColour = $('input[name="window_inside_colour"]:checked');
        
        if ($selectedInsideColour.length) {
            const selectedValue = $selectedInsideColour.val();
            const $selectedCard = $selectedInsideColour.closest('.inside-colour-option');
            
            // If selected option is not visible, auto-select a visible one
            if (!$selectedCard.is(':visible')) {
                const outsideValue = $('input[name="window_colour"]:checked').val();
                autoSelectMatchingInsideColour(outsideValue);
            }
        } else {
            // No inside colour selected, auto-select based on outside colour
            const outsideValue = $('input[name="window_colour"]:checked').val();
            if (outsideValue) {
                autoSelectMatchingInsideColour(outsideValue);
            } else {
                // Default to white if nothing else
                const $whiteOption = $('#window_inside_colour_white');
                if ($whiteOption.length && $whiteOption.closest('.inside-colour-option').is(':visible')) {
                    $whiteOption.prop('checked', true).trigger('change');
                }
            }
        }
        
        $('input[name="window_inside_colour"]:checked').trigger('change');
    }

    function initCustomColourDropdowns() {
        const customColourSelect = $('#custom_window_colour_select');
        const customColourRadio = $('#window_colour_custom');
        const selectedRalCode = $('.custom-colour-card .selected-ral-code');
        const customColourCard = $('.custom-colour-card');
        const customColourDropdown = $('.custom-colour-dropdown');
        
        const customInsideColourSelect = $('#custom_window_inside_colour_select');
        const customInsideColourRadio = $('#window_inside_colour_custom');
        const selectedInsideRalCode = $('.custom-inside-colour-card .selected-inside-ral-code');
        const customInsideColourCard = $('.custom-inside-colour-card');
        const customInsideColourDropdown = $('.custom-inside-colour-dropdown');
        
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
                    selectedRalCode.text($(this).val());
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
                    selectedRalCode.text('From £195');
                    customColourRadio.val('custom_ral');
                    customColourDropdown.hide();
                    
                    if (currentStep === 3) {
                        validateCurrentStep();
                    }
                }
            });
        }
        
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
                    selectedInsideRalCode.text($(this).val());
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
                    selectedInsideRalCode.text('From £195');
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

    function showStep(index) {
        if (index < 0 || index >= totalSteps) return;
        
        steps.removeClass('active');
        steps.eq(index).addClass('active');
        
        currentStep = index;
        window.currentStep = currentStep;
        
        updateNavigation();
        
        if (index === 13) {
            submitContainer.show();
            updateSummary();
            
            if (typeof window.populateStep13 === 'function') {
                setTimeout(function() {
                    window.populateStep13();
                }, 100);
            }
        } else {
            submitContainer.hide();
        }
        
        if (index === 0) {
            prevBtn.prop('disabled', true);
        } else {
            prevBtn.prop('disabled', false);
        }
        
        // Step 4 validation
        if (index === 3) {
            setTimeout(function() {
                validateCurrentStep();
            }, 100);
        }

        // Step 5 validation
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
        
        // Step 10 (Postcode) validation
        if (index === 9) {
            const postcode = $('#window_postcode').val().trim();
            if (!postcode) {
                nextBtn.addClass('inactive').prop('disabled', true);
                if (nextFooterBtn.length) {
                    nextFooterBtn.addClass('inactive').prop('disabled', true);
                }
            } else {
                setTimeout(function() {
                    $('#window_postcode').trigger('input');
                }, 100);
            }
        }
        
        // Step 11 (Installation) validation
        if (index === 10) {
            const installSelected = $('input[name="window_installation_type"]:checked').length > 0;
            if (!installSelected) {
                nextBtn.addClass('inactive').prop('disabled', true);
            } else {
                nextBtn.removeClass('inactive').prop('disabled', false);
            }
        }
        
        // Step 12 (Access Issues) validation
        if (index === 11) {
            const accessSelected = $('input[name="window_access_issues"]:checked').length > 0;
            if (!accessSelected) {
                nextBtn.addClass('inactive').prop('disabled', true);
            } else {
                nextBtn.removeClass('inactive').prop('disabled', false);
            }
        }
        
        // Step 13 (Customer Information) validation
        if (index === 12) {
            const isValid = validateCustomerForm();
            if (!isValid) {
                nextBtn.addClass('inactive').prop('disabled', true);
                if (nextFooterBtn.length) {
                    nextFooterBtn.addClass('inactive').prop('disabled', true);
                }
            }
        }
        
        // Step 14 (Summary) - ensure previous button enabled
        if (index === 13) {
            if (typeof window.populateStep13 === 'function') {
                window.populateStep13();
            }
            $(document).trigger('updateSummary');
            updatePrice();
            prevBtn.prop('disabled', false);
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

    function updateNavigation() {
        if (currentStep === 0) {
            prevBtn.prop('disabled', true);
        } else {
            prevBtn.prop('disabled', false);
        }
        
        if (currentStep === 13) {
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
        
        if (currentStep === 13) {
            prevBtn.prop('disabled', false);
        }
    }

    function checkAllStepsFilled() {
        const width = $('#window_width').val();
        const height = $('#window_height').val();
        if (!width || !height) return false;
        
        const widthNum = parseInt(width);
        const heightNum = parseInt(height);
        if (isNaN(widthNum) || isNaN(heightNum)) return false;
        if (widthNum < 1600 || widthNum > 5800) return false;
        if (heightNum < 700 || heightNum > 1650) return false;

        if (!$('input[name="window_panel_layout"]:checked').length) return false;
        if (!$('input[name="open_direction"]:checked').length) return false;
        if (!$('input[name="window_colour"]:checked').length) return false;
        if (!$('input[name="window_inside_colour"]:checked').length) return false;
        if (!$('input[name="window_handle_colour"]:checked').length) return false;
        if (!$('input[name="glass_type"]:checked').length) return false;
        if (!$('input[name="trickle_vents"]:checked').length) return false;
        if (!$('input[name="cill"]:checked').length) return false;
        if (!$('input[name="window_installation_type"]:checked').length) return false;

        return true;
    }

    function validateCurrentStep() {
        // Step 10: Postcode validation
        if (currentStep === 9) {
            const postcode = $('#window_postcode').val().replace(/\s+/g, '').trim();
            if (postcode.length === 0) {
                $('.next-step, .next-footer-btn').addClass('inactive').prop('disabled', true);
                return false;
            }
            if (window.windowDeliveryData && window.windowDeliveryData.bespoke) {
                $('.next-step, .next-footer-btn').addClass('inactive').prop('disabled', true);
                return false;
            }
        }

        // Step 11: Installation validation
        if (currentStep === 10) {
            const installSelected = $('input[name="window_installation_type"]:checked').length > 0;
            if (!installSelected) {
                $('.next-step, .next-footer-btn').addClass('inactive').prop('disabled', true);
                return false;
            }
        }

        // Step 12: Access Issues validation
        if (currentStep === 11) {
            const accessSelected = $('input[name="window_access_issues"]:checked').length > 0;
            if (!accessSelected) {
                $('.next-step, .next-footer-btn').addClass('inactive').prop('disabled', true);
                return false;
            }
        }

        // Step 9 (Cill) - Always enable Next button
        if (currentStep === 8) {
            nextBtn.removeClass('inactive').prop('disabled', false);
            if(nextFooterBtn.length) {
                nextFooterBtn.removeClass('inactive').prop('disabled', false);
            }
            return true;
        }

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

    function updateInputErrorState(inputId, hasError) {
        const $input = $('#' + inputId);
        const $wrapper = $input.closest('.input-wrapper');
        
        if (hasError) {
            $wrapper.addClass('error');
        } else {
            $wrapper.removeClass('error');
        }
    }

    function validateStep(stepIndex) {
        // Step 1: Size
        if (stepIndex === 0) {
            const width = $('#window_width').val();
            const height = $('#window_height').val();
            const widthError = $('#width-error');
            const heightError = $('#height-error');
            
            widthError.hide();
            heightError.hide();
            updateInputErrorState('window_width', false);
            updateInputErrorState('window_height', false);

            let isValid = true;

            if (!width) {
                widthError.text('Width is required.').show();
                updateInputErrorState('window_width', true);
                isValid = false;
            } else {
                const widthNum = parseInt(width);
                if (isNaN(widthNum)) {
                    widthError.text('Width must be a valid number.').show();
                    isValid = false;
                } else if (widthNum < 1600 || widthNum > 5800) {
                    widthError.text('Width must be between 1600 and 5800 mm.').show();
                    isValid = false;
                }
            }

            if (!height) {
                heightError.text('Height is required.').show();
                updateInputErrorState('window_height', true);
                isValid = false;
            } else {
                const heightNum = parseInt(height);
                if (isNaN(heightNum)) {
                    heightError.text('Height must be a valid number.').show();
                    isValid = false;
                } else if (heightNum < 700 || heightNum > 1650) {
                    heightError.text('Height must be between 700 and 1650 mm.').show();
                    isValid = false;
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

        // Step 7: Glass
        if (stepIndex === 6) {
            return $('input[name="glass_type"]:checked').length > 0;
        }

        // Step 8: Trickle Vents
        if (stepIndex === 7) {
            return $('input[name="trickle_vents"]:checked').length > 0;
        }

        // Step 9: Cill
        if (stepIndex === 8) {
            return $('input[name="cill"]:checked').length > 0;
        }

        // Step 10: Postcode
        if (stepIndex === 9) {
            const postcode = $('#window_postcode').val().replace(/\s+/g, '').trim();
            if (postcode.length === 0) return false;
            if (window.windowDeliveryData && window.windowDeliveryData.bespoke) return false;
            return true;
        }

        // Step 11: Installation Type (index 10)
        if (stepIndex === 10) {
            const installSelected = $('input[name="window_installation_type"]:checked').length > 0;
            if (!installSelected) return false;
            
            const installValue = $('input[name="window_installation_type"]:checked').val();
            if (installValue === 'install_new_build') {
                const photoFile = $('#window_photo').val();
                const photoUrl = $('#window_photo_url').val();
                if (!photoFile && !photoUrl) {
                    return false;
                }
            }
            
            return true;
        }

        // Step 12: Access Issues
        if (stepIndex === 11) {
            const accessSelected = $('input[name="window_access_issues"]:checked').length > 0;
            if ($('#window_access_yes').is(':checked')) {
                const description = $('#window_access_description').val();
                return accessSelected && description && description.trim() !== '';
            }
            return accessSelected;
        }

        // Step 13: Customer Information
        if (stepIndex === 12) {
            return validateCustomerForm();
        }

        // Step 14: Summary
        if (stepIndex === 13) {
            const isBespoke = (window.windowDeliveryData && window.windowDeliveryData.bespoke) || $('#window_delivery_bespoke').val() === '1';
            if (isBespoke) {
                return false;
            }
            return true;
        }

        return false;
    }

    function validateCustomerForm() {
        const firstName = $('#window_first_name').val().trim();
        const lastName = $('#window_last_name').val().trim();
        const mobile = $('#window_mobile_number').val().trim();
        const email = $('#window_email_address').val().trim();
        
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const isValidEmail = emailRegex.test(email);
        
        const mobileRegex = /^[0-9]{10,11}$/;
        const isValidMobile = mobileRegex.test(mobile.replace(/\s/g, ''));
        
        const isValid = firstName && lastName && mobile && email && isValidEmail && isValidMobile;
        
        return isValid;
    }

    /**
     * Update total price calculation for Window
     */
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
        
        // Glass upgrade price calculation (fixed price, not per pane for windows)
        const glassUpgrade = $('input[name="glass_type"]:checked');
        if (glassUpgrade.length && glassUpgrade.val() !== 'standard') {
            let glassBasePrice = parseFloat(glassUpgrade.data('price')) || 0;
            extra += glassBasePrice;
        }
        
        // Colour pricing
        const outsideColour = $('input[name="window_colour"]:checked').val();
        const insideColour = $('input[name="window_inside_colour"]:checked').val();
        const customRalValue = $('#custom_window_colour_select').val();
        const customInsideRalValue = $('#custom_window_inside_colour_select').val();
        
        const standardColours = ['anthracite_grey', 'black', 'white'];
        
        let isOutsideStandard = false;
        let isOutsideCustom = false;
        
        if ((outsideColour === 'custom_ral' || (outsideColour && outsideColour.startsWith('RAL '))) && customRalValue && customRalValue !== '') {
            isOutsideCustom = true;
        } else if (outsideColour && !standardColours.includes(outsideColour) && outsideColour !== 'custom_ral') {
            isOutsideCustom = true;
        } else if (outsideColour && standardColours.includes(outsideColour)) {
            isOutsideStandard = true;
        }
        
        let isInsideStandard = false;
        let isInsideCustom = false;
        
        if ((insideColour === 'custom_ral' || (insideColour && insideColour.startsWith('RAL '))) && customInsideRalValue && customInsideRalValue !== '') {
            isInsideCustom = true;
        } else if (insideColour && !standardColours.includes(insideColour) && insideColour !== 'custom_ral') {
            isInsideCustom = true;
        } else if (insideColour && standardColours.includes(insideColour)) {
            isInsideStandard = true;
        }
        
        const isFreeDualColour = (
            outsideColour === 'anthracite_grey' && 
            insideColour === 'white' &&
            !isOutsideCustom && 
            !isInsideCustom
        );
        
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
            if (isOutsideCustom) {
                outsideColourPrice = 195;
            }
            if (isInsideCustom) {
                insideColourPrice = 195;
            }
        }
        
        extra += outsideColourPrice;
        extra += insideColourPrice;
        
        // Installation pricing for windows (fixed prices)
        const installType = $('input[name="window_installation_type"]:checked').val();
        if (installType) {
            if (installType === 'install_existing') {
                extra += 299;
            } else if (installType === 'install_new_build') {
                extra += 499;
            } else if (installType === 'delivery') {
                const deliveryPrice = parseFloat($('#window_delivery_price').val()) || 0;
                extra += deliveryPrice;
            }
        }
        
        // Handle trickle vents price (fixed, not per pane)
        const trickleVents = $('input[name="trickle_vents"]:checked').val();
        if (trickleVents === 'yes_trickle') {
            extra += 85;
        }

        let total = base + extra;

        $('#final-price-confirm').text('£' + total.toFixed(2));
        $('#submit-price').text('£' + total.toFixed(2));
        $('#final_price_input').val(total.toFixed(2));
        
        window.lastCalculatedPrice = total.toFixed(2);
        
        return total;
    }

    function updateSummary() {
        if (currentStep === 13) {
            if (typeof window.populateStep13 === 'function') {
                window.populateStep13();
            }
        }
    }

    function updateDeliverySummaryInSummary() {
        // This function is now handled in step-14.js
    }

    function addDeliveryRowToSummary(deliveryDisplay, isBespoke) {
        // This function is now handled in step-14.js
    }

    function updateSubmitButtonWithDelivery(totalPrice) {
        // This function is now handled in step-14.js
    }

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

    function goPrevStep() {
        if (currentStep > 0) {
            let prevIndex = currentStep - 1;
            
            showStep(prevIndex);
            
            if (isDev()) {
                console.log('Going to previous step:', prevIndex);
            }
        }
    }

    function submitBuilderForm() {
        console.log('=== submitBuilderForm called ===');
        
        // Prevent double submission
        if (isSubmitting) {
            console.log('Already submitting - blocked');
            return;
        }
        
        if (!validateStep(0)) {
            showStep(0);
            return;
        }
        
        const isBespoke = (window.windowDeliveryData && window.windowDeliveryData.bespoke) || $('#window_delivery_bespoke').val() === '1';
        if (isBespoke) {
            alert('Bespoke delivery required. Please call our sales team to complete your order.');
            return;
        }
        
        // Set flag to prevent double submission
        isSubmitting = true;
        
        // Get form data
        var formData = $('#window-builder-form').serialize();
        
        // Disable button
        var $submitBtn = $('#submit-btn, #drawerAddToCart');
        $submitBtn.prop('disabled', true).html('<span class="loading-spinner"></span> Adding...');
        
        // Make AJAX call
        $.ajax({
            url: window.windowBuilderData.ajax_url,
            type: 'POST',
            data: {
                action: 'process_window_builder',
                form_data: formData,
                security: window.windowBuilderData.nonce
            },
            success: function(response) {
                console.log('AJAX Success:', response);
                if (response.success) {
                    window.location.href = response.data.cart_url;
                } else {
                    alert('Error: ' + (response.data.message || 'Unknown error'));
                    isSubmitting = false;  // Reset flag on error
                    $submitBtn.prop('disabled', false).html('ADD TO CART');
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error:', error);
                alert('Network error. Please try again.');
                isSubmitting = false;  // Reset flag on error
                $submitBtn.prop('disabled', false).html('ADD TO CART');
            }
        });
    }

    // Event handlers
    $(document).on('input', '#window_first_name, #window_last_name, #window_mobile_number, #window_email_address', function() {
        const fieldId = $(this).attr('id');
        
        if (fieldId === 'window_mobile_number') {
            let val = $(this).val().replace(/\D/g, '');
            $(this).val(val);
        }
        
        if (currentStep === 12) {
            validateCurrentStep();
        }
    });

    $(document).on('blur', '#window_email_address', function() {
        if (currentStep === 12) {
            const email = $(this).val().trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (email && !emailRegex.test(email)) {
                $(this).addClass('error');
            } else {
                $(this).removeClass('error');
            }
            validateCurrentStep();
        }
    });

    $(document).on('blur', '#window_mobile_number', function() {
        if (currentStep === 12) {
            const mobile = $(this).val().trim();
            const mobileRegex = /^[0-9]{10,11}$/;
            
            if (mobile && !mobileRegex.test(mobile)) {
                $(this).addClass('error');
            } else {
                $(this).removeClass('error');
            }
            validateCurrentStep();
        }
    });

    $(document).on('input', '#window_width, #window_height', function() {
        const $input = $(this);
        const value = $input.val();
        const min = parseInt($input.attr('min')) || 1600;
        const max = parseInt($input.attr('max'));
        const isWidth = $input.attr('id') === 'window_width';
        const $error = isWidth ? $('#width-error') : $('#height-error');
        
        $error.hide();
        updateInputErrorState($input.attr('id'), false);
        
        if (value) {
            const numValue = parseInt(value);
            if (isNaN(numValue)) {
                $error.text((isWidth ? 'Width' : 'Height') + ' must be a valid number.').show();
                updateInputErrorState($input.attr('id'), true);
            } else if (numValue < min || numValue > max) {
                $error.text((isWidth ? 'Width' : 'Height') + ' must be between ' + min + ' and ' + max + ' mm.').show();
                updateInputErrorState($input.attr('id'), true);
            }
        }
        
        updatePrice();
        validateCurrentStep();
        
        if (currentStep === 13) {
            updateSummary();
        }
    });

    $(document).on('blur', '#window_width, #window_height', function() {
        const $input = $(this);
        const value = $input.val();
        const min = parseInt($input.attr('min')) || 1600;
        const max = parseInt($input.attr('max'));
        const isWidth = $input.attr('id') === 'window_width';
        const $error = isWidth ? $('#width-error') : $('#height-error');
        
        if (value) {
            const numValue = parseInt(value);
            if (isNaN(numValue)) {
                $error.text((isWidth ? 'Width' : 'Height') + ' must be a valid number.').show();
                updateInputErrorState($input.attr('id'), true);
            } else if (numValue < min || numValue > max) {
                $error.text((isWidth ? 'Width' : 'Height') + ' must be between ' + min + ' and ' + max + ' mm.').show();
                updateInputErrorState($input.attr('id'), true);
            } else {
                $error.hide();
                updateInputErrorState($input.attr('id'), false);
            }
        }
        
        updatePrice();
        validateCurrentStep();
        
        if (currentStep === 13) {
            updateSummary();
        }
    });

    $(document).on('change', 'input[name="window_panel_layout"]', function() {
        validateCurrentStep();
        updatePrice();
        
        if (currentStep === 13) {
            updateSummary();
            updateNavigation();
        }
    });

    $(document).on('change', 'input[name="open_direction"]', function() {
        validateCurrentStep();
        updatePrice();
        
        if (currentStep === 13) {
            updateSummary();
            updateNavigation();
        }
    });

    $(document).on('change', 'input[name="window_colour"]', function() {
        validateCurrentStep();
        updatePrice();
        
        if (currentStep === 13) {
            updateSummary();
            updateNavigation();
        }
    });

    $(document).on('change', 'input[name="window_inside_colour"]', function() {
        validateCurrentStep();
        updatePrice();
        
        if (currentStep === 13) {
            updateSummary();
            updateNavigation();
        }
    });

    $(document).on('change', '#custom_window_colour_select', function() {
        if (currentStep === 3) {
            validateCurrentStep();
        }
    });

    $(document).on('change', '#custom_window_inside_colour_select', function() {
        if (currentStep === 4) {
            validateCurrentStep();
        }
    });

    $(document).on('change', 'input[name="glass_type"]', function() {
        validateCurrentStep();
        updatePrice();
        
        if (currentStep === 13) {
            updateSummary();
            updateNavigation();
        }
    });

    $(document).on('change', 'input[name="trickle_vents"]', function() {
        validateCurrentStep();
        updatePrice();
        
        if (currentStep === 13) {
            updateSummary();
            updateNavigation();
        }
    });

    $(document).on('change', 'input[name="cill"]', function() {
        validateCurrentStep();
        updatePrice();
        
        if (currentStep === 13) {
            updateSummary();
            updateNavigation();
        }
    });

    // Installation type change handler
    $(document).on('change', 'input[name="window_installation_type"]', function() {
        validateCurrentStep();
        updatePrice();
        updateDrawer();
        
        if (currentStep === 13) {
            updateSummary();
            updateNavigation();
        }
    });

    $(document).on('input keyup paste', '#window_postcode', function () {
        let postcode = $(this).val()
            .toUpperCase()
            .replace(/\s+/g, '')
            .trim();

        $(this).val(postcode);

        if (typeof validateCurrentStep === 'function') {
            validateCurrentStep();
        }
        
        if (typeof updatePrice === 'function') {
            updatePrice();
        }
        
        if (currentStep === 13) {
            if (typeof updateSummary === 'function') {
                updateSummary();
            }
            if (typeof updateNavigation === 'function') {
                updateNavigation();
            }
        }
    });

    $(document).on('change', 'input[name="window_access_issues"]', function() {
        validateCurrentStep();
        
        if (currentStep === 13) {
            updateSummary();
            updateNavigation();
        }
    });

    $(document).on('input', '#window_access_description', function() {
        validateCurrentStep();
        
        if (currentStep === 13) {
            updateSummary();
            updateNavigation();
        }
    });

    $(document).on('click', '.next-step', goNextStep);
    $(document).on('click', '.prev-step', goPrevStep);
    
    if(nextFooterBtn.length) {
        nextFooterBtn.on('click', goNextStep);
    }
    
    $(document).on('change', '.price-option', function() {
        updatePrice();
        validateCurrentStep();
        
        if (currentStep === 13) {
            updateSummary();
            updateNavigation();
        }
    });

    $(document).on('change input',
        '#window_width, #window_height, ' +
        'input[name="window_panel_layout"], input[name="open_direction"], ' +
        'input[name="window_colour"], input[name="window_inside_colour"], ' +
        'input[name="window_handle_colour"], input[name="glass_type"], ' +
        'input[name="trickle_vents"], input[name="cill"], ' +
        'input[name="window_installation_type"]',
        function() {
            validateCurrentStep();
            updatePrice();

            if (currentStep === 13) {
                updateSummary();
                updateNavigation();
            }
        }
    );

    initWizard();
    initAccessIssuesToggle();

    // Update panel options based on window width (UPDATED RANGES)
    function updatePanelOptions() {
        if (window.isUpdatingPanelOptions) {
            return;
        }
        window.isUpdatingPanelOptions = true;
        
        const width = parseInt($('#window_width').val());
        const height = parseInt($('#window_height').val());
        const $allPanels = $('.panel-option-card');

        if (isNaN(width) || isNaN(height)) {
            if (window.editMode) {
                const selectedPanel = $('input[name="window_panel_layout"]:checked').val();
                if (selectedPanel) {
                    const $selectedCard = $(`input[name="window_panel_layout"][value="${selectedPanel}"]`).closest('.panel-option-card');
                    $selectedCard.show();
                }
            }
            window.isUpdatingPanelOptions = false;
            return;
        }

        // Hide all panels first
        $allPanels.hide();
        
        // Show 2 panels (1600-2000 mm)
        if (width >= 1600 && width <= 2000) {
            $('.panel-2').show();
        }
        
        // Show 3 panels (1750-3250 mm)
        if (width >= 1750 && width <= 3250) {
            $('.panel-3').show();
        }
        
        // Show 4 panels (3251-4000 mm)
        if (width >= 3251 && width <= 4000) {
            $('.panel-4').show();
        }
        
        // Show 5 panels (4001-5800 mm)
        if (width >= 4001 && width <= 5800) {
            $('.panel-5').show();
        }

        // Handle selected panel visibility
        if (!window.editMode) {
            $('input[name="window_panel_layout"]:checked').each(function() {
                if (!$(this).closest('.panel-option-card').is(':visible')) {
                    $(this).prop('checked', false);
                }
            });
        } else {
            const selectedPanel = $('input[name="window_panel_layout"]:checked').val();
            if (selectedPanel) {
                const $selectedCard = $(`input[name="window_panel_layout"][value="${selectedPanel}"]`).closest('.panel-option-card');
                if ($selectedCard.is(':hidden')) {
                    $('input[name="window_panel_layout"]:checked').prop('checked', false);
                }
            }
        }

        if (typeof updatePrice === 'function') {
            updatePrice();
        }
        
        if (typeof window.getWindowPaneCount === 'function') {
            window.getWindowPaneCount();
        }
        
        window.isUpdatingPanelOptions = false;
    }

    // Use a debounced version to prevent multiple rapid calls
    let panelOptionsTimeout;

    $(document).on('input blur', '#window_width, #window_height', function () {
        clearTimeout(panelOptionsTimeout);
        panelOptionsTimeout = setTimeout(function() {
            updatePanelOptions();
        }, 100);
    });

    function addDeliveryStyles() {
        const style = `
            <style>
                .delivery-summary-details {
                    display: flex;
                    flex-direction: column;
                    gap: 5px;
                    padding: 8px 12px;
                    border-radius: 6px;
                    font-size: 14px;
                }
                
                .delivery-summary-details.free-delivery {
                    background: #e8f5e8;
                }
                
                .delivery-summary-details.paid-delivery {
                    background: #f8f8f8;
                }
                
                .delivery-zone-badge {
                    font-weight: 600;
                    color: #1a1a1a;
                }
                
                .delivery-distance-info {
                    color: #666;
                    font-size: 13px;
                }
                
                .delivery-cost-info {
                    font-weight: 700;
                    color: #1a1a1a;
                    font-size: 16px;
                }
                
                .free-delivery .delivery-cost-info {
                    color: #2e7d32;
                }
                
                .bespoke-btn {
                    background: #ff9800 !important;
                    color: white !important;
                    cursor: not-allowed !important;
                    opacity: 0.8;
                }
                
                .bespoke-btn:hover {
                    background: #f57c00 !important;
                }
                
                #summary-delivery-row.bespoke-delivery .summary-value {
                    color: #d32f2f;
                    font-weight: 600;
                }
                
                .loading-spinner {
                    display: inline-block;
                    width: 16px;
                    height: 16px;
                    border: 2px solid rgba(255,255,255,0.3);
                    border-radius: 50%;
                    border-top-color: #fff;
                    animation: spin 0.8s linear infinite;
                    margin-right: 8px;
                }
                
                @keyframes spin {
                    to { transform: rotate(360deg); }
                }
                
                .delivery-status {
                    font-size: 12px;
                    padding: 4px 8px;
                    border-radius: 4px;
                    margin-left: 10px;
                }
                
                .delivery-status.free {
                    background: #e8f5e8;
                    color: #2e7d32;
                }
                
                .delivery-status.paid {
                    background: #fff3e0;
                    color: #f57c00;
                }
                
                .delivery-status.bespoke {
                    background: #ffebee;
                    color: #d32f2f;
                }
            </style>
        `;
        
        $('head').append(style);
    }

    addDeliveryStyles();
    updatePanelOptions();

    // ========================================
    // SLIDING DRAWER FUNCTIONS
    // ========================================

    // Step definitions for Window (14 Steps)
    const stepDefinitions = [
        {
            number: 1,
            name: 'Size',
            getValue: function() {
                const width = $('#window_width').val();
                const height = $('#window_height').val();
                return (width && height) ? width + ' x ' + height + 'mm' : '—';
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
                
                const panelMap = {
                    '2_left': '2 Panels Left',
                    '2_right': '2 Panels Right',
                    '3_left': '3 Panels Left',
                    '3_right': '3 Panels Right',
                    '4_left': '4 Panels Left',
                    '4_right': '4 Panels Right',
                    '5_left': '5 Panels Left',
                    '5_right': '5 Panels Right'
                };
                return panelMap[panelValue] || panelValue;
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
                
                if (val && val !== 'custom_ral' && val !== 'anthracite_grey' && val !== 'black' && val !== 'white') {
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
                
                if (val && val !== 'custom_ral' && val !== 'anthracite_grey' && val !== 'black' && val !== 'white') {
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
                
                if (val === 'standard') {
                    return 'Standard Glass';
                } else if (val === 'self_cleaning') {
                    return 'Self-cleaning glass';
                } else if (val === 'integral_blinds') {
                    return 'Integral blinds';
                } else if (val === 'obscure_glass') {
                    return 'Obscure glass';
                } else if (val === 'saint_gobain_12') {
                    return 'Saint-Gobain 1.2';
                } else if (val === 'low_e_argon') {
                    return 'Low-E Argon Filled';
                }
                
                let text = $('input[name="glass_type"]:checked')
                    .closest('.glass-option-card')
                    .find('.option-name').text().trim();
                
                if (!text) {
                    const glassMap = {
                        'self_cleaning': 'Self-cleaning',
                        'integral_blinds': 'Integral Blinds',
                        'obscure_glass': 'Obscure',
                        'saint_gobain_12': 'Saint-Gobain 1.2',
                        'low_e_argon': 'Low-E Argon'
                    };
                    text = glassMap[val] || val;
                }
                
                return text;
            },
            getPrice: function() {
                const val = $('input[name="glass_type"]:checked');
                if (!val.length) return 0;
                
                if (val.val() === 'standard') return 0;
                
                const basePrice = parseFloat(val.data('price')) || 0;
                return basePrice;
            }
        },
        {
            number: 8,
            name: 'Trickle Vents',
            getValue: function() {
                const val = $('input[name="trickle_vents"]:checked').val();
                return val === 'yes_trickle' ? 'Yes' : (val === 'no_trickle' ? 'No' : '—');
            },
            getPrice: function() {
                const val = $('input[name="trickle_vents"]:checked').val();
                return val === 'yes_trickle' ? 85 : 0;
            }
        },
        {
            number: 9,
            name: 'Cill',
            getValue: function() {
                const val = $('input[name="cill"]:checked').val();
                if (!val) return '—';
                
                const cillMap = {
                    'none': 'No Cill',
                    '150mm-aluminium-cill': 'Aluminium Cill',
                    '150mm-upvc-cill': 'uPVC Cill'
                };
                return cillMap[val] || val;
            },
            getPrice: function() { return 0; }
        },
        {
            number: 10,
            name: 'Postcode',
            getValue: function() {
                const postcode = $('#window_postcode').val().trim().replace(/\s+/g, '');
                return postcode || '—';
            },
            getPrice: function() {
                return 0;
            }
        },
        // ===== STEP 11: INSTALLATION TYPE =====
        {
            number: 11,
            name: 'Installation',
            getValue: function() {
                const val = $('input[name="window_installation_type"]:checked').val();
                if (!val) return '—';
                
                const installMap = {
                    'collection': 'Collection',
                    'delivery': 'Delivery',
                    'install_existing': 'Install Existing Opening',
                    'install_new_build': 'Install New Build'
                };
                return installMap[val] || val;
            },
            getPrice: function() {
                const val = $('input[name="window_installation_type"]:checked').val();
                if (!val) return 0;
                
                if (val === 'collection') {
                    return 0;
                } else if (val === 'delivery') {
                    const deliveryPrice = parseFloat($('#window_delivery_price').val()) || 0;
                    return deliveryPrice;
                } else if (val === 'install_existing') {
                    return 299;
                } else if (val === 'install_new_build') {
                    return 499;
                }
                
                return 0;
            }
        },
        {
            number: 12,
            name: 'Access',
            getValue: function() {
                const val = $('input[name="window_access_issues"]:checked').val();
                if (!val) return '—';
                
                if (val === 'yes_access') {
                    const desc = $('#window_access_description').val();
                    return desc ? 'Yes: ' + desc : 'Yes';
                }
                return 'No';
            },
            getPrice: function() { return 0; }
        },
        {
            number: 13,
            name: 'Customer',
            getValue: function() {
                const firstName = $('#window_first_name').val().trim();
                const lastName = $('#window_last_name').val().trim();
                
                if (firstName || lastName) {
                    return (firstName + ' ' + lastName).trim();
                }
                return '—';
            },
            getPrice: function() { return 0; }
        }
    ];

    // updateDrawer function
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
        
        if (typeof isDev === 'function' && isDev()) {
            console.log('Drawer updated - Total:', totalPrice.toFixed(2));
        }
    }

    // Installation price helper function
    function getInstallationPrice() {
        const val = $('input[name="window_installation_type"]:checked').val();
        if (!val) return 0;
        
        if (val === 'collection') {
            return 0;
        } else if (val === 'delivery') {
            return parseFloat($('#window_delivery_price').val()) || 0;
        } else if (val === 'install_existing') {
            return 299;
        } else if (val === 'install_new_build') {
            return 499;
        }
        
        return 0;
    }

    function getWindowPaneCount() {
        const selectedPanel = $('input[name="window_panel_layout"]:checked').val();
        if (!selectedPanel) return 1;
        
        // Simplified: just extract first number from value like "2_left", "3_right", etc.
        const match = selectedPanel.match(/^(\d+)/);
        const paneCount = match ? parseInt(match[1]) : 1;
        
        return Math.max(1, paneCount);
    }

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

    function updateDrawerButtons() {
        const installType = $('input[name="window_installation_type"]:checked').val();
        const isBespoke = (window.windowDeliveryData && window.windowDeliveryData.bespoke) || $('#window_delivery_bespoke').val() === '1';
        
        // Check if photo is required (for install_new_build)
        const isPhotoRequired = installType === 'install_new_build';
        const photoUploaded = $('#window_photo').val() ? true : false;
        
        if (isBespoke) {
            $('#drawerAddToCart, #drawerCheckout').addClass('disabled').prop('disabled', true);
            $('#drawerAddToCart').text('CONTACT SALES');
        } else if (isPhotoRequired && !photoUploaded) {
            $('#drawerAddToCart, #drawerCheckout').addClass('disabled').prop('disabled', true);
            $('#drawerAddToCart').text('ADD PHOTO');
        } else {
            $('#drawerAddToCart, #drawerCheckout').removeClass('disabled').prop('disabled', false);
            $('#drawerAddToCart').text('ADD TO CART');
        }
    }

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
            'input[name="trickle_vents"], input[name="cill"], ' +
            'input[name="window_installation_type"], #window_postcode, ' +
            'input[name="window_access_issues"], #window_access_description, ' +
            '#custom_window_colour_select, #custom_window_inside_colour_select',
            function() {
                updateDrawer();
            }
        );
        
        $(document).on('deliveryDataUpdated', function() {
            updateDrawer();
        });
        
        $(document).on('stepChanged', function(e, stepIndex) {
            $('.drawer-step-item').removeClass('active-step');
            $(`.drawer-step-item[data-step="${stepIndex + 1}"]`).addClass('active-step');
        });
        
        $('#drawerAddToCart').on('click', function() {
            console.log('Drawer Add to Cart clicked');
            if ($(this).hasClass('disabled')) {
                console.log('Button is disabled');
                return;
            }
            
            // Call the submit function directly
            if (typeof submitBuilderForm === 'function') {
                submitBuilderForm();
            } else {
                console.error('submitBuilderForm not found');
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

    window.updateDrawer = updateDrawer;
    window.getWindowPaneCount = getWindowPaneCount;
    window.toggleDrawer = toggleDrawer;

});