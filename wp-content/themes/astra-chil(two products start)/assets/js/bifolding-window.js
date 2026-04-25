/**
 * Bifolding Window Builder - Main JavaScript
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

    // Edit mode variables
    let editMode = false;
    let editCartKey = '';

    // ===== STEP MAPPING FOR WINDOWS =====
    const stepMap = {
        0: 'size',           // Step 1: Window Size
        1: 'panels',         // Step 2: Panel Configuration
        2: 'frame_colour',   // Step 3: Frame Colour
        3: 'glass_type',     // Step 4: Glass Type
        4: 'handle_colour',  // Step 5: Handle Colour
        5: 'opening_type',   // Step 6: Opening Type
        6: 'security',       // Step 7: Security Features
        7: 'postcode',       // Step 8: Delivery Postcode
        8: 'installation',   // Step 9: Installation Option
        9: 'customer_info'   // Step 10: Contact Details
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
                '3 + 2 Panels': '3_2'
            };
            
            let panelValue = panelMap[data.panels];
            
            if (!panelValue) {
                const possibleValues = ['2_left', '2_right', '3_left', '3_right', '4_left', '4_right', 
                    '1_2', '2_1', '1_3', '3_1', '2_2', '1_4', '4_1', '2_3', '3_2'];
                
                if (possibleValues.includes(data.panels)) {
                    panelValue = data.panels;
                }
            }
            
            if (panelValue) {
                setTimeout(function() {
                    $(`input[name="window_panel_layout"][value="${panelValue}"]`).prop('checked', true).trigger('change');
                }, 200);
            }
        }
        
        // === STEP 3: Frame Colour ===
        if (data.colour) {
            if (data.colour.startsWith('RAL ')) {
                $('#window_colour_custom').prop('checked', true).trigger('change');
                $('#custom_window_colour_select').val(data.colour).trigger('change');
            } else {
                const colourMap = {
                    'Anthracite Grey': 'anthracite_grey',
                    'Black': 'black',
                    'White': 'white'
                };
                let colourValue = colourMap[data.colour] || 'white';
                $(`input[name="window_colour"][value="${colourValue}"]`).prop('checked', true).trigger('change');
            }
        }
        
        // === STEP 4: Glass Type ===
        if (data.glass) {
            const glassMap = {
                'Self-cleaning glass': 'self_cleaning',
                'Obscure glass': 'obscure_glass',
                'Saint-Gobain Planitherm 1.2': 'saint_gobain_12',
                'Low-E Argon Filled': 'low_e_argon'
            };
            
            let glassValue = glassMap[data.glass];
            
            if (!glassValue) {
                const possibleValues = ['self_cleaning', 'obscure_glass', 'saint_gobain_12', 'low_e_argon'];
                if (possibleValues.includes(data.glass)) {
                    glassValue = data.glass;
                }
            }
            
            if (glassValue) {
                setTimeout(function() {
                    $(`input[name="glass_type"][value="${glassValue}"]`).prop('checked', true).trigger('change');
                }, 300);
            }
        }
        
        // === STEP 5: Handle Colour ===
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
        
        // === STEP 6: Opening Type ===
        if (data.opening_type) {
            const openingMap = {
                'Inwards': 'inwards',
                'Outwards': 'outwards',
                'Tilt & Turn': 'tilt_turn'
            };
            let openingValue = openingMap[data.opening_type] || 'inwards';
            $(`input[name="opening_type"][value="${openingValue}"]`).prop('checked', true);
        }
        
        // === STEP 7: Security Features ===
        if (data.security) {
            const securityMap = {
                'Multi-point Locking': 'multipoint_lock',
                'Security Glass': 'security_glass',
                'Both': 'both',
                'None': 'none'
            };
            let securityValue = securityMap[data.security] || 'none';
            $(`input[name="security"][value="${securityValue}"]`).prop('checked', true);
        }
        
        // === STEP 8: Postcode ===
        if (data.postcode) {
            $('#window_postcode').val(data.postcode);
            setTimeout(function() {
                $('#window_postcode').trigger('input');
            }, 500);
        }
        
        // === STEP 9: Installation Type ===
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
        
        // === STEP 10: Customer Information ===
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
            
            const savedPostcode = $('#window_postcode').val();
            if (savedPostcode && savedPostcode.length > 0) {
                setTimeout(function() {
                    $('#window_postcode').trigger('input');
                }, 1000);
            }
        }
    }

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
    }

    function validateCurrentStep() {
        const isValid = validateStep(currentStep);
        
        if (currentStep < totalSteps - 1) {
            if (isValid) {
                nextBtn.removeClass('inactive').prop('disabled', false);
                if(nextFooterBtn.length) nextFooterBtn.removeClass('inactive').prop('disabled', false);
            } else {
                nextBtn.addClass('inactive').prop('disabled', true);
                if(nextFooterBtn.length) nextFooterBtn.addClass('inactive').prop('disabled', true);
            }
        }
        
        return isValid;
    }

    function validateStep(stepIndex) {
        // Step 1: Window Size
        if (stepIndex === 0) {
            const width = $('#window_width').val();
            const height = $('#window_height').val();
            let isValid = true;
            
            // Width validation - 1600 to 5800 mm
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
            
            // Height validation - 700 to 1650 mm
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
            
            // Enable/disable next button based on validation
            if (isValid) {
                nextBtn.removeClass('inactive').prop('disabled', false);
            } else {
                nextBtn.addClass('inactive').prop('disabled', true);
            }
            
            return isValid;
        }
        
        return true;
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
        
        return firstName && lastName && mobile && email && isValidEmail && isValidMobile;
    }

    function updatePrice() {
        let base = parseFloat($('#base_price_value').val());
        if (isNaN(base)) base = 0;
        
        $('#final-price-confirm').text('£' + base.toFixed(2));
        $('#submit-price').text('£' + base.toFixed(2));
        $('#final_price_input').val(base.toFixed(2));
        
        return base;
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
        }
    }

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
    $(document).on('click', '.next-step', goNextStep);
    $(document).on('click', '.prev-step', goPrevStep);
    
    if(nextFooterBtn.length) {
        nextFooterBtn.on('click', goNextStep);
    }

    initWizard();

    // ===== DRAWER FUNCTIONS =====
    const stepDefinitions = [
        { number: 1, name: 'Window Size', getValue: function() { 
            const w = $('#window_width').val(); 
            const h = $('#window_height').val(); 
            return (w && h) ? w + ' x ' + h + 'mm' : '—'; 
        }, getPrice: function() { return 0; } },
        { number: 2, name: 'Panel Config', getValue: function() { return '—'; }, getPrice: function() { return 0; } },
        { number: 3, name: 'Frame Colour', getValue: function() { return '—'; }, getPrice: function() { return 0; } },
        { number: 4, name: 'Glass Type', getValue: function() { return '—'; }, getPrice: function() { return 0; } },
        { number: 5, name: 'Handle Colour', getValue: function() { return '—'; }, getPrice: function() { return 0; } },
        { number: 6, name: 'Opening Type', getValue: function() { return '—'; }, getPrice: function() { return 0; } },
        { number: 7, name: 'Security', getValue: function() { return '—'; }, getPrice: function() { return 0; } },
        { number: 8, name: 'Postcode', getValue: function() { return '—'; }, getPrice: function() { return 0; } },
        { number: 9, name: 'Installation', getValue: function() { return '—'; }, getPrice: function() { return 0; } },
        { number: 10, name: 'Contact', getValue: function() { return '—'; }, getPrice: function() { return 0; } }
    ];

    function buildDrawerSteps() {
        let html = '';
        stepDefinitions.forEach(step => {
            html += `<div class="drawer-step-item" data-step="${step.number}">
                        <div class="step-label">
                            <span class="step-number">${step.number}</span>
                            <span class="step-name">${step.name}</span>
                        </div>
                        <div class="step-value">${step.getValue()}</div>
                        <div class="step-price">£0</div>
                    </div>`;
        });
        $('#drawerStepsList').html(html);
    }

    function updateDrawer() {
        let totalPrice = parseFloat($('#base_price_value').val()) || 0;
        
        stepDefinitions.forEach(step => {
            const value = step.getValue();
            const $stepItem = $(`.drawer-step-item[data-step="${step.number}"]`);
            if ($stepItem.length) {
                $stepItem.find('.step-value').text(value);
                if (value !== '—') {
                    $stepItem.addClass('completed');
                }
            }
        });
        
        $('#drawer-total-price').text('£' + totalPrice.toFixed(2));
        $('#drawer-footer-total').text('£' + totalPrice.toFixed(2));
        $('#final_price_input').val(totalPrice.toFixed(2));
    }

    function initDrawer() {
        buildDrawerSteps();
        updateDrawer();
        
        $('#drawerToggle').on('click', function(e) {
            e.preventDefault();
            $('#drawerContent').addClass('open');
            $('.toggle-arrow').text('▶');
        });
        
        $('#drawerClose').on('click', function(e) {
            e.preventDefault();
            $('#drawerContent').removeClass('open');
            $('.toggle-arrow').text('◀');
        });
        
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#drawerContent').length && 
                !$(e.target).closest('#drawerToggle').length) {
                $('#drawerContent').removeClass('open');
                $('.toggle-arrow').text('◀');
            }
        });
        
        $(document).on('change input', '#window_width, #window_height', function() {
            updateDrawer();
        });
    }
    
    initDrawer();

    window.updateDrawer = updateDrawer;
    window.validateStep1 = validateStep;
});