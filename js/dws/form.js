$(function(){
    if ('undefined' === typeof(is_captcha_enabled)) {
        is_captcha_enabled = false;
    }
    if ('undefined' === typeof(is_recaptcha_enabled)) {
        is_recaptcha_enabled = false;
    }
    if ('undefined' === typeof(is_motion_captcha_enabled)) {
        is_motion_captcha_enabled = false;
    }
    if ('undefined' === typeof(recaptchaV2Enabled)) {
        recaptchaV2Enabled = false;
    }

    $('.btn-upload-group')
        .on('keypress', 'input', function (e) {
            if (e.which == '13') {
                $(this).trigger('click');
                return false;
            }
        })
        .on('focusin focusout', function (e) {
            $(this).toggleClass('focus', e.type == 'focus' || e.type == 'focusin' ); // IE < 10 e.type allway == focus
        });


    $('.input-group')
        .on('touchstart mousedown', '.file_name', function () {
            $(this)
                .closest('.input-group')
                .find('input[type="file"]')
                .trigger('click');
            return false;
        });


    if ('undefined' === typeof(recaptchaV2Enabled)) {
        recaptchaV2Enabled = false;
    }

    /* need to refresh CSRF token periodically */
    if (!window.scrfRefreshInterval) {
        var tokenLifetime = window.CSRF_GLOBAL_TOKEN_LIFETIME;
        var token = $('meta[name="csrf-token"]').attr('content');

        if (token && tokenLifetime > 0) {
            /* refresh 30 seconds earlier than its expires (interval in ms) */
            var refreshInterval = (tokenLifetime - 30) * 1000;

            if (refreshInterval > 0) {
                window.scrfRefreshInterval = setInterval(function () {
                    refreshCsrfToken();
                }, refreshInterval);
            }
        }
    }

    $('.dataSelect select[name$="_m"], .dataSelect select[name$="_y"]')
        .on('change', function () {
            var numberOfDays = new Date(
                $('.dataSelect select[name$="_y"]').val(),
                $('.dataSelect select[name$="_m"]').val(),
                0
            ).getDate();

            var daySelector = $('.dataSelect select[name$="_d"]');
            var dayValue = daySelector.val();

            var options = '';
            for (var i = 1; i <= numberOfDays; i++) {
                options += '<option value="' + i + '">' + i + '</option>';
            }

            daySelector
                .find('option')
                .remove()
                .end()
                .append(options);

            if (dayValue !== '' && dayValue <= numberOfDays) {
                daySelector.val(dayValue);
            }
    });
});

function checkForm(elm, handlerForm, params) {
    var HEIGHT_VALUE_1 = 130;
    var HEIGHT_VALUE_2 = 150;
    var TIMEOUT = 200;

    var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

    params = params || {};
    params.handleRspErrors = ('undefined' === typeof(params.handleRspErrors)) ? true : params.handleRspErrors;

    var $elm = $(elm);
    var $form = $elm.is('form') ? $elm : $elm.parents('form');
    var isCaptchaValid = false;

    if (!$form.is('form')) {
        $form = $('form:first');
    }

    var $captchaForm = $form.data('captchaForm') ? $($form.data('captchaForm')) : $form;
    if (!$captchaForm.length) {
        $captchaForm = $form;
    }

    var form_captcha = {
        captcha: $('div[class$="capchaB"]', $captchaForm).length,
        recaptcha: $('.recaptcha_div_wrapper', $captchaForm).length,
        motion: $('.motion-captcha', $captchaForm).length,
        recaptchaV2: $('.recaptcha_v2_div_wrapper', $captchaForm).length
    };

    if (window.mobileVersionPro !== undefined) {
        $form.unbind('.validate');
        $form.bind("invalid-form.validate", function (form, validator) {
            var scrollTop = 0;
            if (!validator.numberOfInvalids()) {
                return;
            }

            /* Special offset calculation for detals forms (testdrive, offer, email)*/
            if ('emailfriend' === validator.currentForm[0].defaultValue
                || 'offer' === validator.currentForm[0].defaultValue
                || 'testdrive' === validator.currentForm[0].defaultValue
            ) {
                if ('recaptcha_response_field' === validator.errorList[0].element.name
                    || 'captcha' === validator.errorList[0].element.name
                ) {
                    switch (validator.currentForm[0].defaultValue) {
                        case 'offer':
                            scrollTop = $('.modul-offer').height() + HEIGHT_VALUE_1;
                            break;
                        case 'emailfriend':
                            scrollTop = $('.modul-emfriend').height() + HEIGHT_VALUE_1;
                            break;
                        case 'testdrive':
                            scrollTop = $('.modul-testdrive').height() + HEIGHT_VALUE_1;
                            break;
                    }
                } else {
                    scrollTop = validator.errorList[0].element.offsetTop - HEIGHT_VALUE_2;
                }
            } else {
                if ('recaptcha_response_field' === validator.errorList[0].element.name
                    || 'captcha' === validator.errorList[0].element.name
                ) {
                    scrollTop = parseInt($('.midd')[0].scrollHeight)-Math.abs(parseInt($(validator.errorList[0].element).offset().top));
                } else {
                    scrollTop = parseInt($('.midd')[0].scrollHeight)-Math.abs(parseInt($(validator.errorList[0].element).offset().top))-parseInt($('.midd').css('height'))-HEIGHT_VALUE_1;
                }
            }

            $('.midd').animate({
                scrollTop: scrollTop
            },
            {
                duration: 1000,
                complete: function() {
                    if ('undefined' !== typeof(validator.errorList[0])) {
                        validator.errorList[0].element.focus();
                    }
                }
            });
        });
    } else { /*MOBILE (BASIC, BUSINESS CARD), DESTOP VERSION VALIDATE*/
        $form.unbind('.validate');
        $form.bind("invalid-form.validate", function (form, validator) {
            var scrollTop = 0,
                focusSet = false;

            if (!validator.numberOfInvalids()) {
                return;
            }

            var element = $(validator.errorList[0].element);
            // if its hidden input then we can't get offset properly
            if (!element.is(':visible')) {
                element = element.closest(':visible');
            }

            scrollTop = parseInt(element.offset().top)-parseInt('50');
            var $scrollAnchor = $('html, body');

            if (0 !== $form.parents('div.modal-dialog').length) {/* For responsive forms */
                var margin = 50;
                var contentTop = 0;
                var elementTop = parseInt(element.offset().top);

                var $formParentContent = $form.parents('.content,.modal-content');
                if($formParentContent.length){
                    contentTop = parseInt($formParentContent.offset().top);
                }

                if (contentTop < 0 ) {
                    scrollTop = elementTop + Math.abs(contentTop) + margin;
                } else {
                    scrollTop = elementTop + (margin - contentTop);
                }
                $scrollAnchor = $form.parents('div.modal-dialog').parent('div');
            }

            $scrollAnchor.animate({scrollTop: scrollTop}, {
                duration: 1000,
                complete: function () {
                    if (!focusSet && 'undefined' !== typeof(element)) {
                        element.focus();
                        focusSet = true;
                    }
                }
            });
        });

        if (form_captcha.recaptcha) {
            $captchaForm.bind("invalid-form.validate", function () {
                var $captchaInput = $captchaForm.find("input[type=text]");

                $captchaInput.addClass('error')
                    .on("change", function () {
                        $captchaInput.removeClass("error")
                    });
            });
        }
    }

    var isFormValid = ($captchaForm.valid() & $form.valid()); /* do not change to && */

    /* scan for controls with errors and indicate it (responsive only) */
    if (params.handleRspErrors && $form.closest('[class^="modul-r-"]').length) {
        $('input, select, textarea', $form)
            .add('input', $captchaForm)
            .filter(':not(.no-validate):visible, .validate[type="hidden"]')
            .each(function () {
                var $this = $(this),
                    $isRequired = Boolean($this.closest(".has-feedback").length);

                if ($isRequired && ($this.hasClass('error') || $this.closest('.form-group').hasClass('has-error'))) {
                    $this.closest(".form-group").addClass("has-error");
                } else {
                    $this.closest(".form-group").removeClass("has-error");
                }
            });
    }

    if (isFormValid) {
        if (params.skipCaptchaValidate || $form.data('isCaptchaValid')) {
            isCaptchaValid = true;
        }
        else if (is_captcha_enabled && form_captcha.captcha) {
            isCaptchaValid = captchaValidate($captchaForm);
        }
        else if (is_recaptcha_enabled && form_captcha.recaptcha) {
            isCaptchaValid = reCaptchaValidate($captchaForm);
        }
        else if (recaptchaV2Enabled && form_captcha.recaptchaV2) {
            isCaptchaValid = reCaptchaV2.validate($captchaForm);
        }
        else if (is_motion_captcha_enabled && form_captcha.motion) {
            isCaptchaValid = motionCaptchaValidate($captchaForm);
        }
        else if ((is_captcha_enabled || is_recaptcha_enabled || is_motion_captcha_enabled || recaptchaV2Enabled) && !(params.skipCaptcha === true)) {
            isCaptchaValid = false;
        }
        else {
            isCaptchaValid = true;
        }

        $form.data('isCaptchaValid', isCaptchaValid);
    }

    if (is_motion_captcha_enabled && form_captcha.motion) {
        motionCaptchaValidate($captchaForm);
    }

    if (isFormValid && isCaptchaValid) {
        /* if captcha is placed in separated form - copy captcha inputs to main form */
        if ($form.data('captchaForm')) {
            if (!$form.find('.captcha_fields').length) {
                $form.prepend('<span class="captcha_fields" style="display: none;"></span>');
            }
            $form.find('.captcha_fields').html($captchaForm.find('input, .g-recaptcha-response').clone());

            // workaround for FF < 52
            // see https://bugzilla.mozilla.org/show_bug.cgi?id=230307
            if ($captchaForm.find('.g-recaptcha-response').length) {
                var value = $captchaForm.find('.g-recaptcha-response').val();
                $form.find('.g-recaptcha-response').val(value);
            }
        }

        injectCsrfToken($form);


        if (!params.disableStatus) {
            setTimeout(function () {
                try {
                    statusOpen('Loading...', 0);
                } catch (e) {
                    alert('Error ' + e.name + ":" + e.message + "\n" + e.stack);
                }

            }, 1);
        }

        if (-1 !== $.inArray(params.displayMode, ['tabs', 'pages']) && typeof handlerForm === 'function') {
            /* Without delay for tabs and pages */
            handlerForm();
        } else {
            setTimeout(function () {
                if (typeof handlerForm === 'function') {
                    handlerForm();
                } else {
                    if (isMobile) {
                        $(document.activeElement).blur();
                        setTimeout(function() {
                            $form.submit();
                        }, TIMEOUT);
                    } else {
                        $form.submit();
                    }
                }

                /* refresh global CSRF token */
                if (window.CSRF_GLOBAL_TOKEN_NAME) {
                    refreshCsrfToken();
                }
            }, TIMEOUT);
        }
    } else if(typeof params.failCallback === 'function') {
        params.failCallback();
    }
}

function reloadCaptcha(context) {
    var $context = context ? $(context) : $([]);

    if (is_captcha_enabled) {
        var $captchaContainer = $context.length ? $context.closest('.captcha_container') : $('.captcha_container');
        $captchaContainer.each(function(){
            captcha_refresh($(this));
        });
    }

    if (is_recaptcha_enabled) {
        Recaptcha.reload();
    }

    if (recaptchaV2Enabled) {
        $('.recaptcha-v2-container').each(function() {
            var id = $(this).attr('data-id');
            grecaptcha.reset(id);
        });
    }

    if (is_motion_captcha_enabled) {
        var $captchaCanvas = $context.length ? $context.find('canvas[id^="motion-captcha-canvas-mc"]') : $('canvas[id^="motion-captcha-canvas-mc"]');
        $captchaCanvas.each(function(){
            var $convas = $(this);
            var $form = $(this).parents('form');
            var params = $form.data('motion-captcha-params');
            var $hashField = $('.protected_fields input[name*="hash"]:first', $form);

            $convas.removeClass('mc-invalid mc-valid');
            $convas.removeClass(params.shapes.join(' '));
            $form.find('.protected_fields input[name*="check"]').val('check');
            $form.data('motion-captcha-valid', false);
            $form.motionCaptcha(params);

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/ajax",
                data: {oper: 'motion_captcha_get_hash'},
                success: function(data) {
                    if (data.hash) {
                        $hashField.val(data.hash);
                    }
                }
            });
        });
    }

}

/**
 * Inject CSRF token into the form. You should inject it right before form submit (each time).
 *
 * @param {object} $form jQuery object
 */
function injectCsrfToken($form) {
    if ($form.is('form') && window.CSRF_GLOBAL_TOKEN_NAME) {
        var fieldName = window.CSRF_GLOBAL_TOKEN_NAME;
        var token = $('meta[name="csrf-token"]').attr('content');
        if (token) {
            $form.find('[name="' + fieldName + '"]').remove();
            $form.prepend('<input type="hidden" name="' + fieldName + '" value="' + token + '">');
        }
    }
}

/**
 * Get new CSRF token and replace old token in "csrf-token" meta tag
 *
 * @param {boolean} async
 */
function refreshCsrfToken(async) {

    if (false !== async) {
        async = true;
    }

    $.ajax({
        url: '/ajax',
        type: 'post',
        dataType: 'json',
        async: async,
        data: {
            oper: 'get_csrf_token'
        },
        success: function(data) {
            $('meta[name="csrf-token"]').attr('content', data);
        }
    });
}
