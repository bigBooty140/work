var FormValidatorResponsive = (function () {
    return {
        /**
         * Setting default settings for jQuery validator
         */
        setDefaultValidators: function () {
            $.validator.setDefaults({
                highlight: function (element) {
                    $(element).closest('.form-group')
                        .addClass('has-error');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-group')
                        .removeClass('has-error');
                },
            });
        },
        /**
         * Cleaning messages for jQuery validate
         *
         * @param {object} validationData Validation data
         */
        cleanMessagesObj: function (validationData) {
            $.each(validationData.rules, function (ruleName, ruleData) {
                if ('object' === typeof(ruleData)) {
                    validationData.messages[ruleName] = {};
                    $.each(validationData.rules[ruleName], function (key) {
                        validationData.messages[ruleName][key] = '';
                    });
                } else {
                    validationData.messages[ruleName] = '';
                }
            });
        },
    };
}());

FormValidatorResponsive.setDefaultValidators();
