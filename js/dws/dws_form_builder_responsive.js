var CustomForm = (function ($) {

    function CustomForm(params) {
        this.params = params;
        this.$form = $(params.form_id)
            .data("motorized_type", params.motorized_type)
            .data("make", params.make)
            .data("model", params.model)
            .data("trim", params.trim)
            .data("vin", params.vin)
            .data("year", params.year)
            .data("body_style", params.body_style);
        this.$multiForm = null;
        this.validateRules = $.extend({}, params['validate_rules'] || {});
        this.fields = params['fields'] || [];
        this.displayMode = this.$form.data('displayMode') || 'single';

        this.fixTabIndex();

        this.processRules();
        this.bindSelectChain();

        this.initDatePicker();
        this.initPhoneInput();
        this.initFormInputs();

        this.initSignatureInput();

        if (this.$form.hasClass('form-builder-container')) {
            this.$multiForm = this.$form.find('form.form-builder-form');
        }

        this.initSubmit();
    }

    var displayModes = {
        NEXT: 1,
        PREV: 2,
        tabs: function ($step, direction) {
            var href = '#' + $step.attr('id');
            $step.closest('.form-builder-container').find('.nav.nav-tabs a[href="' + href + '"]').tab('show');
        },
        pages: function ($step, direction) {
            switch (direction) {
                case displayModes.NEXT:
                    $step = $step.next();
                    break;
                case displayModes.PREV:
                    $step = $step.prev();
                    break;
            }

            $step
                .parent()
                .children()
                .removeClass('active');

            $step
                .closest('.form-builder-container')
                .find('.bf-pages li')
                .removeClass('active')
                .find('a[href="#' + $step.attr('id') + '"]')
                .parent()
                .addClass('active');

            displayModes.setActiveStep($step);
        },
        progress: function ($step, direction) {
            $step.parent().children().removeClass('active');
            switch (direction) {
                case displayModes.NEXT:
                    $step = $step.next();
                    break;
                case displayModes.PREV:
                    $step = $step.prev();
                    break;
                default:
                    break;
            }

            displayModes.setActiveStep($step);
        },
        slider: function ($step, direction) {
            var $slider = $step.closest('.carousel');

            switch (direction) {
                case displayModes.NEXT:
                    $slider.carousel('next');
                    break;
                case displayModes.PREV:
                    $slider.carousel('prev');
                    break;
                default:
                    $slider.carousel($step.data('index'));
            }

            $slider.on('slid.bs.carousel', function() {
                var $form = $slider.find('.bf-step.item.active form.form-builder-form');
                displayModes.restoreFormData($form);
            });
        },
        setActiveStep: function($step) {
            var formWidgetOffsetTop = $step.closest('.modul-r-formbuilder').offset().top;
            var windowHeight = $(window).height();
            var offsetCorrection = Math.round(windowHeight / 8);

            $step
                .addClass('active')
                .find('.signature-wrapper')
                .trigger('resizejSignature', true);
            /*restore form data*/
            var $form = $step.find('form.form-builder-form');
            displayModes.restoreFormData($form);

            $('html, body').animate({
                scrollTop: (formWidgetOffsetTop <= offsetCorrection)
                    ? formWidgetOffsetTop
                    : formWidgetOffsetTop - offsetCorrection,
            });
        },
        restoreFormData: function($form) {
            if ($form.data('restore') === 1) {
                $form.formSaver('restore');
                $form.data('restore', 0);
            }
        }
    };

    CustomForm.prototype.fixTabIndex = function () {
        var $self = this;
        var tabindexMax = 0;
        this.$form.find('[tabindex], input.captcha_input').each(function () {
            var $this = $(this), tabindex;
            tabindex = (parseInt($this.attr('tabindex'), 10) || 0) + 100;
            if (tabindex > tabindexMax) {
                tabindexMax = tabindex;
            }
            $this.attr('tabindex', ($this.attr('tabindex') ? tabindex : tabindexMax));
        });

        if ('undefined' !== typeof(is_recaptcha_enabled) && is_recaptcha_enabled) {
            this.$form.on('focus', 'input:visible', function () {
                var recaptcha = $self.$form.find('input#recaptcha_response_field');
                if (!recaptcha.attr('tabindex')) {
                    recaptcha.attr('tabindex', tabindexMax + 1);
                }
            });
        }

    };

    CustomForm.prototype.processRules = function () {
        var self = this;
        $.each(this.validateRules, function (id, rules) {
            var len, ftypes, $tempElementById;

            if (rules != null) {
                for (var rule in rules) {
                    switch (rule) {
                        case 'use_website_settings':
                            if (id.search(/phone/i) != -1 && !validatePhone.active) {
                                rules['phone_mask'] = true;
                            }
                            delete(rules['use_website_settings']);
                            break;
                        case 'force_validation':
                            $tempElementById = $('#' + id);
                            len = $tempElementById.length
                                ? $tempElementById.attr('maxlength')
                                : $(self.params.form_id + ' [name="' + id + '"]').attr('maxlength');
                            rules['maxlength'] = len;
                            rules['minlength'] = len;
                            delete(rules['force_validation']);
                            $tempElementById = null;
                            break;
                        case 'filetype':
                            $tempElementById = $('#' + id + '_ftypes');
                            ftypes = $tempElementById.length
                                ? $tempElementById.val()
                                : $(self.params.form_id + ' [data-ftypes="' + id + '"]').val();
                            rules['accept'] = (ftypes ? ftypes : 'jpg,jpeg,png,pdf');
                            delete(rules['filetype']);
                            $tempElementById = null;
                            break;
                        case 'creditcard':
                            rules['maxlength'] = 16;
                            rules['minlength'] = 16;
                            break;

                        case 'e_signature':
                            rules['e_signature'] = 50;
                            break;
                    }
                }
            }
        });
    };

    CustomForm.prototype.initFormInputs = function () {

        var self = this;
        this.$form.find('.fbl-numeric').numeric({decimal: false, negative: false}, function () {
            alert("Positive integers only");
            this.value = "";
            this.focus();
        });

        this.$form.find('input[type=checkbox]').click(function () {
            var cl = $(this).attr('class');
            var d = [];
            self.$form.find('input[type="checkbox"]:checked.' + cl).each(function (index, elem) {
                d.push($(elem).val());
            });
            self.$form.find('[name="' + cl + '"]').val(d.join(', '));
        });

        this.$form.find('select[multiple]').change(function () {
            var target = $(this).data('target');
            var d = [];
            $(this).find('option:selected').each(function (index, elem) {
                d.push($(elem).val());
            });
            self.$form.find('[name="' + target + '"]').val('^' + d.join('^,^') + '^');
        });

        this.$form.find('input[name*="phone"], input[name*="vin"]').on('input', function (event) {
            var value = this.value || '';
            this.value = value.toUpperCase();
        });

        if (this.fields != '' && this.fields != null) {
            for (var i in this.fields) {
                try {
                    if (this.fields[i].search('selectchain') >= 0) {
                        this.bindSelectChain(this.fields[i]);
                    }
                } catch (e) {
                }
            }
        }
    };

    CustomForm.prototype.getValidateData = function () {

        var validateMessages = {};

        if (this.validateRules) {
            $.each(this.validateRules, function (key, rules) {
                validateMessages[key] = "";
                if (typeof(rules) == 'object') {
                    validateMessages[key] = {};
                    var message = '';
                    if ('e_signature' in rules) {
                        message = 'The signature is too short';
                    }
                    $.each(rules, function (rule) {
                        validateMessages[key][rule] = message;
                    });
                }
            });
            this.initValidatorRules();
        } else {
            this.validateRules = {};
        }

        return {
            ignore: '[type="hidden"]:not(.fbr-value)',
            rules: this.validateRules,
            messages: validateMessages,
            highlight: function (element) {
                var $formGroup = $(element).addClass('-error-').closest('.form-group');
                $formGroup.addClass('has-error');
                var $collapse = $formGroup.closest('.collapse:not(.in)');
                if ($collapse.length) {
                    $collapse.collapse('show');
                }
            },
            unhighlight: function (element) {
                var $el = $(element);
                var inputName = $el.attr('data-name');

                var $formGroup = $el.removeClass('-error-').closest('.form-group'),
                    errors = $formGroup.find('.-error-').length;
                if (!errors) {
                    $formGroup.removeClass('has-error');
                }

                if ($el.closest('[widget="date_input"]')) {
                    $el.removeClass('error');
                } else {
                    $el.removeClass('error').closest('.form-group').removeClass('has-error');
                }

                switch (inputName) {

                    case 'e_signature':
                        $el.closest('.e-signature').removeClass('error');
                        $el.closest('.form-group').find('.tooltip').css('opacity', 0);
                        break;

                    default:
                        break;
                }
            },
            errorPlacement: function (error, element) {
                var inputName = element.attr('data-name');
                switch (inputName) {

                    case 'e_signature':
                        if (error.text()) {
                            element.closest('.form-group')
                                .addClass('has-error')
                                .find('.tooltip')
                                .css('opacity', 1)
                                .find('.tooltip-inner')
                                .html(error.text());
                        }
                        element.closest('.e-signature').addClass('error');
                        break;

                    default:
                        if (element.parent('.input-group').length) {
                            error.insertAfter(element.parent());
                        } else {
                            error.insertAfter(element);
                        }
                        break;
                }
            },
            errorElement: 'small',
            errorClass: 'text-right is-error'
        }
    };

    CustomForm.prototype.initSubmit = function () {
        var validateData = this.getValidateData(), _this = this;
        if (this.$multiForm && this.$multiForm.length) {
            this.$multiForm.each(function () {
                $(this).validate(validateData);
            });
        } else {
            this.$form.validate(validateData);
        }

        if (this.$multiForm) {
            this.initNextPrev();
        }

        this.$form.find('.btn-fb-submit').on('click', function () {
            if (_this.$multiForm && _this.$multiForm.length) {
                _this.submitMultiForm(this);
            } else {
                checkForm($(this), null, {handleRspErrors: false});
            }
        });
    };

    CustomForm.prototype.initNextPrev = function () {
        var _this = this;

        this.$form.find('.nav-tabs a').on('shown.bs.tab', function(){
            var $form = _this.$form.find('.bf-step.tab-pane.active form.form-builder-form');
            displayModes.restoreFormData($form);
        });

        _this.$form
            .on('click', '.bf-pages a', function(){
                _this.setStepActive($(this).attr('href'));
                return false;
            });

        this.$form.find('.btn-fb-next').on('click', function () {
            var $step = $(this).closest('.bf-step');
            checkForm(this, function () {
                _this.setStepActive($step, displayModes.NEXT);
            }, {handleRspErrors: false, skipCaptcha: true, disableStatus: true});
        });

        this.$form.find('.btn-fb-prev').on('click', function () {
            _this.setStepActive($(this).closest('.bf-step'), displayModes.PREV);
        });
    };

    CustomForm.prototype.setStepActive = function (stepElement, direction) {
        if (displayModes[this.displayMode] && $.isFunction(displayModes[this.displayMode])) {
            displayModes[this.displayMode].call(this, $(stepElement, this.$form), direction);
        }
    };

    CustomForm.prototype.submitMultiForm = function(submitBtn) {
        var valid = true,
            _this = this,
            $activeForm = null;

        _this.$multiForm.not('.form-builder-submit').each(function() {
            var $thisForm = $(this),
                result;

            if (valid && !$thisForm.has(submitBtn).length) {
                checkForm($thisForm, function(){
                    result = true;
                }, {
                    handleRspErrors: false,
                    skipCaptcha: true,
                    skipCaptchaValidate: true,
                    disableStatus: true,
                    displayMode: _this.displayMode,
                    failCallback: function() {
                        valid = false;
                        result = false;
                        $activeForm = $thisForm.closest('.bf-step');
                    }
                });
            }

            return result;
        });

        if (!valid && $activeForm) {
            _this.setStepActive($activeForm);
        } else if (valid) {
            checkForm(submitBtn, function() {
                var $submitForm = $('form' + _this.params.form_id);

                statusOpen('Loading...', 0);
                _this.$multiForm.each(function() {
                    var $form = $(this),
                        dataArray = $form.serializeArray();

                    $.each(dataArray, function(i, data) {
                        $('<input type="hidden" />')
                            .appendTo($submitForm)
                            .attr({
                                name: data.name,
                                value: data.value
                            });
                    });

                    $form.find('input[type="file"]').each(function() {
                        var $input = $(this);

                        $input.after($input.clone(true));
                        $submitForm.append($input);
                    });
                });

                /*save form data for each step*/
                _this.$multiForm.each(function() {
                    var $form = $(this);
                    $form.formSaver('save');
                });

                $submitForm.submit();
            }, {
                handleRspErrors: false,
                disableStatus: true,
                skipCaptchaValidate: false,
                displayMode: _this.displayMode
            });
        }
    };

    CustomForm.prototype.bindSelectChain = function (field) {
        if (!field) {
            return;
        }

        var href, parts, ajax_link,
            bar = '.' + field + '[name=' + field + '_',
            self = this,
            $vin = $(bar + 'vin]'),
            $year = $(bar + 'year]'),
            $motorized_type = $(bar + 'motorized_type]'),
            $make = $(bar + 'make]'),
            $model = $(bar + 'model]');

        href = document.location.href;
        parts = href.split('/');
        parts.pop();
        ajax_link = parts.join('/') + '/ajax';

        if ($vin.size()) {
            $vin.val(this.$form.data("vin"));
        }

        if ($year.size()) {
            $year.val(this.$form.data("year"));
        }

        if ($motorized_type.size()) {
            $motorized_type.val(this.$form.data("motorized_type"));
            $motorized_type.change(function () {
                CustomForm.filtersSelectChainLoad({
                    url: ajax_link,
                    sel: 'motorized_type',
                    root: bar,
                    sources: ['motorized_type'],
                    targets: ['make']
                }, self.params);
                CustomForm.filtersSelectChainLoad({
                    url: ajax_link,
                    sel: 'body',
                    root: bar,
                    sources: ['motorized_type'],
                    targets: ['body_style']
                }, self.params);
            });
            if (this.$form.data("motorized_type")) {
                $motorized_type.change();
            }
        }

        if ($make.size()) {
            $make.change(function () {
                CustomForm.filtersSelectChainLoad({
                    url: ajax_link,
                    sel: 'make',
                    root: bar,
                    sources: ['make'],
                    targets: ['model']
                }, self.params);
            });
        }

        if ($model.size()) {
            $model.change(function () {
                CustomForm.filtersSelectChainLoad({
                    url: ajax_link,
                    sel: 'model',
                    root: bar,
                    sources: ['model'],
                    targets: ['trim']
                }, self.params);
            });
        }
    };

    CustomForm.prototype.initDatePicker = function () {
        try {
            this.$form.find('input.datepicker').datepicker({
                format: 'M dd, yyyy',
                autoclose: 1,
                startDate: (new Date()).toString()
            });
        } catch (e) {
        }
    };

    CustomForm.prototype.initPhoneInput = function () {
        var _this = this;
        if (validatePhone.active) {
            this.$form.find('input[data-mask]').each(function (i, maskInput) {
                var $maskInput = $(maskInput),
                    phoneMask = $maskInput.attr('data-mask') || validatePhone.mask,
                    name = $maskInput.attr('name');
                if (name && _this.validateRules[name]) {
                    if (_this.validateRules[name]['number']) {
                        phoneMask = phoneMask.replace(/[*]/g, '9');
                        delete _this.validateRules[name]['number'];
                    }
                    _this.validateRules[name]['maskedinput'] = phoneMask;
                }
                $maskInput.mask(phoneMask);
            });
        }
    };

    CustomForm.prototype.initValidatorRules = function () {
        $.validator.addMethod("number_char", function (value, element) {
            return this.optional(element) || /^-?(?:[A-Z0-9 ]+|[A-Z0-9 ]*)?$/i.test(value);
        }, "Please enter only numbers or chars");

        $.validator.addMethod("num_char_space", function (value, element) {
            return this.optional(element) || /^-?(?:[A-Za-z0-9 \-]*)?$/i.test(value);
        }, "Please enter only numbers or chars");

        $.validator.addMethod("maskedinput", function (value, element, mask) {
            var regExStr = $.map(String(mask).split(''), function (val) {
                return $.mask.definitions[val] || '(.)';
            }).join('');
            var regex = new RegExp(regExStr, 'i');
            var coincides = regex.test(value);
            return this.optional(element) || coincides;
        }, "Please enter a valid phone number");
    };

    CustomForm.prototype.initSignatureInput = function () {
        try {
            var _this = this,
                $eSignatureWrappers = _this.$form.find('.signature-wrapper'),
                $formBuilder = $eSignatureWrappers.closest('.form-builder-container'),
                resizeTimeout = 0,
                timeout = 200;

            if ($eSignatureWrappers.length) {

                $.validator.addMethod("e_signature", function (value, element, minPoints) {
                    var
                        data = $(element).siblings('.e-signature').jSignature('getData', 'native'),
                        valid = false,
                        totalPoints = 0;

                    if ($.isArray(data) && data.length) {
                        $.each(data, function (index, row) {
                            totalPoints += row.x.length;
                        });

                        valid = (totalPoints >= minPoints);
                    }

                    return (this.optional(element) || valid);
                }, '');

                //set jSignature instances
                $eSignatureWrappers
                    .each(function() {
                        var $eSignatureWrapper = $(this);
                        var $eSignature = $eSignatureWrapper.find('.e-signature');
                        var $eSignatureInput = $eSignatureWrapper.find('input[data-name="e_signature"]');
                        var $btnClear = $eSignatureWrapper.find('.e_signature_clear_btn');

                        $eSignatureWrapper.on('resizejSignature', function(e, reset) {
                            _this.resizeSignatureInput($eSignatureWrapper, reset);
                        });

                        if (_this.displayMode === 'tabs') {
                            $formBuilder
                                .find('a[href="#' + $eSignatureWrapper.closest('.tab-pane').attr('id') + '"]')
                                .on('shown.bs.tab', function() {
                                    $eSignatureWrapper.trigger('resizejSignature', true);
                                });
                        } else if (_this.displayMode === 'slider') {
                            $eSignatureWrapper
                                .closest('.carousel')
                                .on('slid.bs.carousel', function() {
                                    $eSignatureWrappers.trigger('resizejSignature', true);
                                });
                        }

                        $btnClear.on('click', function() {
                            $eSignature.jSignature('clear');
                        });

                        $eSignature.on('change', function() {
                            var value = '';
                            if ($eSignature.jSignature('getData', 'native').length) {
                                value = $eSignature.jSignature('getData', 'svg');
                            }
                            $eSignatureInput.val(value);

                            if (value) {
                                $eSignatureInput.valid();
                            }
                        });

                    })
                    .trigger('resizejSignature', false);

                $(window).on('resize.jSignature', function() {
                    window.clearTimeout(resizeTimeout);
                    resizeTimeout = window.setTimeout(function() {
                        $eSignatureWrappers.trigger('resizejSignature', true);
                    }, timeout);
                });
            }
        } catch (e) {

        }
    };

    CustomForm.prototype.resizeSignatureInput = function($wrappers, reset) {
        $wrappers
            .filter(':visible')
            .each(function() {
                var $wrapper = $(this),
                    $eSignature = $wrapper.find('.e-signature'),
                    eSignatureBorderWidth = parseInt(($eSignature.css('borderLeftWidth') || 0), 10),
                    eSignatureWidth = $wrapper.width() - eSignatureBorderWidth * 2,
                    canvasDatapair = [];

                if (reset && !$eSignature.is(':empty')) {
                    canvasDatapair = $eSignature.jSignature("getData", "base30");
                    $eSignature.jSignature('reset').empty();
                }

                $eSignature.jSignature({
                    width: eSignatureWidth,
                    height: Math.max(
                        Math.floor(eSignatureWidth / 4),
                        200
                    )
                });

                if (canvasDatapair[1]) {
                    $eSignature.jSignature("setData", "data:" + canvasDatapair.join(","));
                }
            });
    };

    /**
     * Sort object (key => value) by values alphabetically
     * Returns array of objects [{key : key, value: value}]
     */
    CustomForm.processSelectChainData = function(obj) {
        var result = [];

        if ('object' === typeof(obj)) {
            var items = [];
            var item;

            for (var key in obj) {
                item = {};
                item.key = key;
                item.value = obj[key];
                items.push(item);
            }

            result = items.sort(function(x, y) {
                return (x.value > y.value) ? 1 : -1;
            });
        }

        return result;
    };

    CustomForm.filtersSelectChainLoad = function (settings, params) {

        var $form = $(params['form_id']),
            targets = settings.targets,
            sources = settings.sources,
            url = settings.url,
            root = settings.root,
            sel = settings.sel,
            empties = params.chainEmpties || {
                'loading': "Loading...",
                'motorized_type': 'Any Make',
                'make': 'Any Model',
                'model': 'Any Trim',
                'body': 'Any Body Style'
            },
            data = 'oper=selectchain&selectchain=' + sel;

        for (i = 0; i < targets.length; i++) {
            $(params['form_id'] + ' ' + root + targets[i] + ']')
                .empty()
                .append('<option value="">' + empties['loading'] + '</option>');
        }

        for (var i = 0; i < sources.length; i++) {
            data += '&' + sources[i] + '=' + $(root + sources[i] + ']').val();

        }

        $.ajax({
            url: url,
            data: data,
            type: 'post',
            dataType: 'json',
            success: function (response) {
                var s = $(params['form_id'] + ' ' + root  + targets[0] + ']');
                s.empty().append('<option value="">' + empties[sel] + '</option>');

                if (response && $.isPlainObject(response)) {
                    var sortedResponse = CustomForm.processSelectChainData(response);

                    $.each(sortedResponse, function(index, row) {
                        var txt = row.value || 'Other';
                        s.append('<option value="' + row.key + '">' + txt + '</option>');
                    });
                }

                if (sel === 'motorized_type') {
                    $(params['form_id'] + ' ' + root + 'make]').val($form.data('make')).change();
                    $form.data('make', 0);
                }

                if (sel === 'make') {
                    $(params['form_id'] + ' ' + root + 'model]').val($form.data('model')).change();
                    $form.data('model', 0);
                }

                if (sel === 'model') {
                    $(params['form_id'] + ' ' + root + 'trim]').val($form.data('trim'));
                    $form.data('trim', '');
                }

                if (sel === 'body') {
                    $(params['form_id'] + ' ' + root + 'body]').val($form.data('body_style'));
                    $form.data('body_style', '');
                }
            },
            error: function () {
            }
        });
    };

    return CustomForm;
})(jQuery);
