var FormOfferResponsive = {
    init: function() {
    jQuery.validator.addMethod("int_phone", function(value, element) {
        return this.optional(element) || /^[-+A-Z0-9*#()]+$/i.test(value);
    }, "Please enter only numbers or chars");
    jQuery.validator.addMethod("zip_char", function(value, element) {
        return this.optional(element) || /^[a-z0-9\-]+$/i.test(value);
    }, "");
    jQuery.validator.addMethod("maskedinput", function(value, element, mask) {
        var regExStr = $.map(String(mask).split(''), function(val){
            return $.mask.definitions[val] || '(.)';
        }).join('');
        var regex = new RegExp(regExStr, 'i');
        var coincides = regex.test(value);
        return this.optional(element) || coincides;
    }, "Please enter a valid phone number");

	$('.offer_form').each(function(){
		var $container = $(this);

        $container.find('.btn-submit').click(function(){
            $container.find('[name="international_phone"],[name="phone"],[name="zip"]').each(function(){
                var value = $(this).val();
                $(this).closest('form').val(value.toUpperCase());
            });

            checkForm(this);
        });

        var validationData = {
            rules: {},
            messages: {}
        };
        validationData.rules = {
            first_name: {
                required: true,
                maxlength: 30
            },
            last_name: {
                required: true,
                maxlength: 30
            },
            email: FormValidator.getEmailRules(),
            zip: {
                required: true,
                minlength: zipCode.min,
                maxlength: zipCode.max,
                zip_char: true
            },
            phone: {
                required: true
            },
            international_phone: {
                int_phone: true
            },
            dealer: {
                required: true,
                maxlength: 100
            },
            pay: {
                number: true,
                min: 0
            }
        };

        if ($container.find('.has-feedback input[name="pay"]').length) {
            validationData.rules['pay']['required'] = true;
        }
        if (!$container.find('input[name="country"]').length) {
            delete validationData.rules['country'];
        }
        if (!$container.find('input[name="dealer"]').length) {
            delete validationData.rules['dealer'];
        }

        if (zipCode.onlyNumbers) {
            delete validationData.rules.zip['zip_char'];
            validationData.rules.zip['digits'] = true;
        }

        if (zipCode.charSpace) {
            delete validationData.rules.zip['zip_char'];
            validationData.rules.zip['zipCharSpaces'] = true;
        }

        if (validatePhone.active) {
            validationData.rules.phone['maskedinput'] = validatePhone.mask;
            $container.find('[name="phone"]').mask(validatePhone.mask);
        }

        FormValidatorResponsive.cleanMessagesObj(validationData);

        $container.validate(validationData);
    });

    $('.modul-r-offer .btn-message-ok').click(function() {
            window.location.href = window.location.href.split('#').shift();
	});
    }
};
