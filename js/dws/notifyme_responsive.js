var formNotifyMeResponsive = function (formId, params) {

    var ajaxUrl = '/ajax';
    var $form = $('#' + formId + '.notify_form');
    var $mt = $form.find('.notify_form_motorized_type');
    var $body = $form.find('.notify_form_body_style');
    var $make = $form.find('.notify_form_make');
    var $model = $form.find('.notify_form_model');

    if ("object" !== typeof params){
        params = {};
    }
    if (!params.hasOwnProperty('notifyFormType')) {
        params.notifyFormType = 'vehicle'
    }
    if (!params.hasOwnProperty('notifyFormShortMode')) {
        params.notifyFormShortMode = false
    }
    if (!params.hasOwnProperty('validatePhoneForNotifyForm')) {
        params.validatePhoneForNotifyForm = {"active":true,"mask":"999-999-9999"}
    }
    var notifyFormType = params.notifyFormType;
    var notifyFormShortMode = params.notifyFormShortMode;
    var validatePhoneForNotifyForm = params.validatePhoneForNotifyForm;
    
    var initValidator = function () {
        $.validator.addMethod("maskedinput", function (value, element, mask) {
            var regExStr = $.map(String(mask).split(''), function (val) {
                return $.mask.definitions[val] || '(.)';
            }).join('');
            var regex = new RegExp(regExStr, 'i');
            var coincides = regex.test(value);
            return this.optional(element) || coincides;
        }, "Please enter a valid phone number");

        $.validator.addMethod("check_names", function (value, element) {
            return this.optional(element) || /^[\w ]+$/i.test(value);
        });

        $.validator.addMethod('check_years', function (input, elem) {
            var ymax = Math.round($('select[name="max_year"]', $form).val());
            var ymin = Math.round($('select[name="min_year"]', $form).val());
            if (!ymin || !ymax || (ymax > ymin)) {
                return true;
            }
        });

        $.validator.addMethod("price_check", function (input, elem) {
            var result = true,
                min = $('[name="min_price"]:visible', $form).val(),
                max = $('[name="max_price"]:visible', $form).val(),
                isValidValues = isValidMinMaxValues(min, max);
            if ($(elem).val() < 0 || !isValidValues) {
                result = false;
            }

            return result;
        });

        $.validator.addMethod("odometer_check", function (input, elem) {
            var result = true,
                min = $('[name="min_odometer"]:visible', $form).val(),
                max = $('[name="max_odometer"]:visible', $form).val(),
                isValidValues = isValidMinMaxValues(min, max);
            if ($(elem).val() < 0 || !isValidValues) {
                result = false;
            }

            return result;
        });
    };
    initValidator();
    

    if ($mt.length && $make.length && $model.length) {
        $mt.change(function () {
            var mt = $(this).val();
            if (mt === '') {
                $body.attr('disabled', 'disabled').val('');
            }
            $.ajax({
                url: ajaxUrl,
                dataType: 'json',
                type: 'post',
                data: {oper: 'selectchain', selectchain: 'motorized_type', motorized_type: mt},
                success: function (result) {
                    $make.add($model).find('option[value!=""]').remove();
                    $make.add($model).attr('disabled', 'disabled').val('');
                    if (!$.isEmptyObject(result)) {
                        result = sortSelected(result);
                        for (var i in result) {
                            $make.append('<option value="' + result[i].id + '">' + result[i].name + '</option>');
                        }
                    }
                    $make.has('option[value!=""]').removeAttr('disabled');
                }
            });
            if ($body.length) {
                $.ajax({
                    url: ajaxUrl,
                    dataType: 'json',
                    type: 'post',
                    data: {oper: 'selectchain', selectchain: 'body', motorized_type: mt},
                    success: function (result) {
                        $body.find('optgroup').remove();
                        $body.find('option[value!=""]').remove();
                        $body.val('');
                        if (!$.isEmptyObject(result)) {
                            result = sortSelected(result);
                            for (var i in result) {
                                $body.append('<option value="' + result[i].id + '">' + result[i].name + '</option>');
                            }
                            $body.has('option[value!=""]').removeAttr('disabled');
                            if (2 === Math.round(mt)) { /* motorized_type == 2 (COMMERCIAL TRUCKS & TRAILERS & BUSES) */
                                bodyStyleGrouping($body);
                            }
                        }
                    }
                });
            }
        });
        $make.change(function () {
            var make = $(this).val();
            $.ajax({
                url: ajaxUrl,
                dataType: 'json',
                type: 'post',
                data: {oper: 'selectchain', selectchain: 'make', make: make},
                success: function (result) {
                    $model.find('option[value!=""]').remove();
                    $model.attr('disabled', 'disabled').val('');
                    if (!$.isEmptyObject(result)) {
                        result = sortSelected(result);
                        for (var i in result) {
                            $model.append('<option value="' + result[i].id + '">' + result[i].name + '</option>');
                        }
                    }
                    $model.has('option[value!=""]').removeAttr('disabled');
                }
            });
        });
        if ($body.length && 2 === Math.round($mt.val())) { /* motorized_type == 2 (COMMERCIAL TRUCKS & TRAILERS & BUSES) */
            bodyStyleGrouping($body);
        }
    }

    $form.find('select[name="transmission"] option[value!=""]').each(function () {
        var $option = $(this);
        var textLength = 40;
        var title = $option.text();
        $option.attr('title', title);
        if (title.length > textLength) {
            $option.text(title.substr(0, (textLength - 3)) + '...');
        }
    });

    var $yearfrom = $form.find('select[name="min_year"]:visible');
    var $yearto = $form.find('select[name="max_year"]:visible');
    $yearfrom.add($yearto).change(function () {
        if ('min_year' === this.name && $yearfrom.val() && $yearto.val() && $(this).val() >= $yearto.val()) {
            $yearto.val('').val(parseInt($(this).val()) + 1);
        }
        else if ('max_year' === this.name && $yearfrom.val() && $yearto.val() && $(this).val() <= $yearfrom.val()) {
            $yearfrom.val('').val(parseInt($(this).val()) - 1);
        }
    });

    $form.find('.btn-submit').click(function () {
        $form.find('[name="phone"]').each(function () {
            var value = $(this).val();
            $(this).val(value.toUpperCase());
        });

        checkForm($form);
    });

    var validationData = {
        rules: {},
        messages: {},
        onkeyup: function (elem) {
            var $lable = $(elem).closest('.form-group').find('.label-wrap');
            var $hasFeedback = $(elem).parent();
            if (this.element(elem) === false) {
                $hasFeedback.addClass('has-error');
                $lable.addClass('has-error');
            } else {
                $hasFeedback.removeClass('has-error');
                $lable.removeClass('has-error');
                if ($hasFeedback.siblings().hasClass('has-error')) {
                    $hasFeedback.siblings().find('input').trigger('keyup');
                }
            }
        }
    };
    validationData.rules = {
        min_price: {
            number: true,
            price_check: true,
            maxlength: 10
        },
        max_price: {
            number: true,
            price_check: true,
            maxlength: 10
        },
        min_year: {
            check_years: true
        },
        max_year: {
            check_years: true
        },
        first_name: {
            check_names: true,
            required: true,
            maxlength: 120
        },
        last_name: {
            check_names: true,
            required: true,
            maxlength: 120
        },
        phone: {
            required: true
        },
        email: FormValidator.getEmailRules(),
    };
    if (validatePhoneForNotifyForm.active) {
        validationData.rules.phone['maskedinput'] = validatePhoneForNotifyForm.mask;
        $form.find('[name="phone"]').mask(validatePhoneForNotifyForm.mask);
    }
    if ('truck' === notifyFormType) {
        validationData.rules['min_odometer'] = {
            number: true,
            odometer_check: true,
            maxlength: 9
        };
        validationData.rules['max_odometer'] = {
            number: true,
            odometer_check: true,
            maxlength: 9
        };
    }

    FormValidatorResponsive.cleanMessagesObj(validationData);

    $form.validate(validationData);

    function bodyStyleGrouping($body) {
        var selected = $body.val();
        var groups = [];
        var delimiter = ' - ';
        $body.find('option[value!=""]').each(function () {
            var $option = $(this),
                optText = $option.text().toUpperCase(),
                optParts = optText.split(delimiter),
                groupName = '';

            if (optParts.length > 1) {
                groupName = optParts.shift();
                optText = optParts.join(delimiter);
                $option.text(optText);
            }
            if (!groupName) {
                optParts = optText.split(' ');
                if ($.inArray('TRUCKS', optParts) >= 0) {
                    groupName = 'TRUCKS';
                } else if ($.inArray('TRAILERS', optParts) >= 0) {
                    groupName = 'TRAILERS';
                } else {
                    groupName = 'OTHER';
                }
            }
            if ($.inArray(groupName, groups) === -1) {
                groups.push(groupName);
            }
            $option.attr('optgroup', groupName);
        });
        groups.sort();
        $.each(groups, function (i, group) {
            var $optgroup = $('<optgroup/>').attr('label', group).appendTo($body);
            $body.find('option[optgroup="' + group + '"]').appendTo($optgroup);
        });
        $body.val(selected);
    }

    $('.modul-r-notify .btn-message-ok').click(function () {
        window.location.href = window.location.href.split('#').shift();
    });
    $('.modul-r-notify .btn-unsubscribe').click(function () {
        window.location.href = window.location.protocol + '//' + window.location.host;
    });

    if (notifyFormShortMode) {
        var curentBoxModify = '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"></div>';
        $('#' + formId + '.notify_form .main_fieldset .form-group').hide()
            .has('[name="first_name"]').show().wrap(curentBoxModify).end()
            .has('[name="last_name"]').show().wrap(curentBoxModify).end()
            .has('[name="phone"]').show().wrap(curentBoxModify).end()
            .has('[name="email"]').show().wrap(curentBoxModify).end()
            .has('[name="frequency"]').show().wrap(curentBoxModify).end()
            .has('[name="expires"]').show().wrap(curentBoxModify).end()
            .closest('.form_column')
            .attr('class', 'col-lg-12 col-md-12 col-sm-12 col-xs-12 full-width-in-thin');
    }
};

function addToCookieNotifyingOfVehicle(vehicleId) {
    var cookieName = 'notify_vehicles';
    if (vehicleId) {
        var date = new Date();
        var vehicleDescribing = vehicleId + '~' + date.toISOString();
        if ($.cookie(cookieName)) {
            var cookieValue = $.cookie(cookieName).split(';');
            var exists = false;
            for (var i in cookieValue) {
                var vehicleItem = cookieValue[i].split('~');
                if (vehicleItem[0] === vehicleId) {
                    cookieValue[i] = vehicleDescribing;
                    exists = true;
                }
            }
            if (!exists) {
                cookieValue.push(vehicleDescribing);
            }
            $.cookie(cookieName, cookieValue.join(';'), {expires: date.addYears(5)});
        } else {
            var cookieValue = vehicleDescribing;
            $.cookie(cookieName, cookieValue, {expires: date.addYears(5)});
        }
    }
}

function isValidMinMaxValues(min, max) {
    var result = true,
        minValue = (min === '') ? false : parseFloat(min),
        maxValue = (max === '') ? false : parseFloat(max);
    if (minValue >= maxValue && minValue !== false && maxValue !== false) {
        result = false;
    }

    return result;
}
