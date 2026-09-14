var FormValidator = (function () {
    var validateConfig = {
        email_no_http_www: [
            'String must not contain "www" or "http"',
            function (value, element) {
                return !/(http|www)/.test(value);
            },
        ],
        email_characters_allowed: [
            'Allowed characters "A-z", "0-9", "@", ".", "_", "-", "+"',
            function (value, element) {
                var selectionStart;
                var selectionEnd;
                var elementObj;

                if (/[A-Z]+/.test(value)) {
                    selectionStart = element.selectionStart;
                    selectionEnd = element.selectionEnd;
                    elementObj = $(element);
                    elementObj.val(elementObj.val().toLowerCase());
                    element.selectionStart = selectionStart;
                    element.selectionEnd = selectionEnd;
                }

                return this.optional(element) || /^[a-z0-9@'\._\+-]+$/.test(value.toLowerCase());
            },
        ],
        email_3_in_a_row: [
            'More than 3 identical symbols in a row',
            function (value, element) {
                var identicalSymbolsCount;
                var pattern;

                identicalSymbolsCount = 3 || parseInt(element.dataset['validator-param-symbols'], 10);
                pattern = new RegExp('(.){1}\\1{' + identicalSymbolsCount + ',}');

                return !pattern.test(value);
            },
        ],
        email_domains_count_no_more_7: [
            'The count of domains can\'t be more than 7',
            function (value, element) {
                var exprResult = value.match(/@(.)+$/ig);
                var maxCount;
                var result;

                maxCount = 7 || parseInt(element.dataset['validator-param-domains'], 10);

                if (exprResult !== null) {
                    result = this.optional(element) || !(exprResult[0].split('.').length > maxCount);
                } else {
                    result = this.optional(element) || true;
                }

                return result;
            },
        ],
        emailMoreOneDot: [
            'Please enter a valid email address',
            function (value, element) {
                return !/\.\./.test(value);
            },
        ],
        zipCharSpaces: [
            "Allowed characters 'A-z', '0-9', 'space', '-'",
            function(value, element){
                return  /^[A-Za-z0-9 \-]+$/.test(value);
            }
        ],
    };

    return {
        /**
         * Add new method to jQuery validator
         */
        fillValidators: function () {
            $.each(validateConfig, function (name, value) {
                $.validator.addMethod(name, value[1], value[0]);
            });
        },
        /**
         * Cleaning messages for jQuery validate
         *
         * @param {object} validationRules Validation rules
         * @param {array} keepRules Rules where no need delete messages
         * @return {object}
         */
        cleanMessages: function (validationRules, keepRules) {
            var validationMessages = {};
            var i;
            var j;

            for (i in validationRules) {
                if (typeof(validationRules[i]) === 'object') {
                    if ($.inArray(i, keepRules) === -1) {
                        validationMessages[i] = {};

                        for (j in validationRules[i]) {
                            validationMessages[i][j] = '';
                        }
                    }
                } else {
                    validationMessages[i] = '';
                }
            }

            return validationMessages;
        },
        /**
         * Getting email rules
         *
         * @param {object} customRules Rules that no use in all modules
         * @return {object}
         */
        getEmailRules: function (customRules) {
            var emailRules;
            var defaultEmailRules = {
                required: true,
                maxlength: 255,
                email_no_http_www: true,
                email_characters_allowed: true,
                email_3_in_a_row: true,
                email_domains_count_no_more_7: true,
                emailMoreOneDot: true,
                email: true,
            };

            if (!customRules) {
                customRules = {};
            }

            emailRules = $.extend({}, defaultEmailRules, customRules);

            return emailRules;
        },
    };
}());

FormValidator.fillValidators();


