var VehicleVideoResponsive = {
    init: function() {
        Date.firstDayOfWeek = 0;
        Date.format = 'mmm dd, yyyy';

        var form = $('#vehicle-video-form');

        if (!form.length) {
            return;
        }

        jQuery.validator.addMethod("number_char", function (value, element) {
            return this.optional(element) || /^(?:[A-Z0-9]{1,}|[A-Z0-9]{0,})?$/.test(value);
        }, "Please enter only numbers or chars");

        jQuery.validator.addMethod("maskedinput", function (value, element, mask) {
            var regExStr = $.map(String(mask).split(''), function (val) {
                return $.mask.definitions[val] || '(.)';
            }).join('');
            var regex = new RegExp(regExStr, 'i');
            var coincides = regex.test(value);
            return this.optional(element) || coincides;
        }, "Please enter a valid phone number");

    form.find(':text:not(.motion-captcha input, #vvf_date)').val("");

    var dateShift = new Date();
    dateShift.addDays(5);
    var $dateInput = $('#vvf_date');

    $dateInput.val(dateShift.asString());
    $dateInput.datepicker('remove');
    $dateInput.datepicker({
        format: 'M dd, yyyy',
        weekStart: 0,
        startDate: "today",
        autoclose: true,
        todayBtn: true,
        todayHighlight: true
    });

        $dateInput.on('keypress tab', function() {
            $('.modul-r-vehVideo').find('[name="phone"]').focus();
        });

        form.find('.btn-submit').on('click', function() {
            checkForm(this);
        });

        $('#vvf_success .btn-message-ok').click(function() {
            $('#vvf_success').hide();
            $('#vVid-player').closest('.video_wrapper').show();
            form.show();

            // reinit video
            if (typeof vVidInit === 'function') {
                vVidInit();
            }
        });

        // do not allow text input
        $('#vvf_date').bind('keypress cut paste', function(e) {
            e.preventDefault();
            return false;
        });

        var validationRules = {
            First_name: {
                required: true,
                maxlength: 30
            },
            Last_name: {
                required: true,
                maxlength: 30
            },
            email: FormValidator.getEmailRules(),
            phone: {
                required: true,
                maskedinput: validatePhone.mask
            }
        };

        form.find('[name="phone"]').mask(validatePhone.mask);

        form.validate({
            rules: validationRules,
            messages: FormValidator.cleanMessages(validationRules),
            errorClass: "error",
            errorPlacement: function (error, element) {},
            submitHandler: function () {
                VehicleVideoResponsive.getData();
                return false;
            },
            focusInvalid: false,
            focusCleanup: true
        });

        if (window.flagChackValidatePhone) {
            var phone = form.find('[name^=phone]');
            for (var i = 0; i < phone.length; i++) {
                $(phone[i]).rules('remove');
                $(phone[i]).rules('add', {required: true});
            }
        }
    },

    getData: function() {
        var form = $('#vehicle-video-form');
        var params = {};

        params.oper = "testdrive_lead";

        $.each(form.serializeArray(), function (index, row) {
            params[row.name] = row.value;
        });

        $('.motion-captcha input[name]', form).each(function () {
            var name = $(this).attr('name');
            params[name] = $(this).val();
        });

        statusOpen('Loading...', 0);

        $.ajax({
            url: '/ajax',
            data: params,
            type: "POST",
            success: function (data) {
                statusRemove();
                if (data == 'true' || data == true) {
                    form.find(':text:not(.motion-captcha input, #vvf_date)').val('');
                    form.hide();
                    $('#vVid-player').empty().closest('.video_wrapper').hide();
                    $('#vvf_success').show();
                } else {
                    alert('Some error occured');
                }
            },
            error: function () {
                statusRemove();
                alert("error", 2);
            },
            complete: function () {
                form.find('.captcha_fields').remove();
                reloadCaptcha();
            }
        });
    }
};