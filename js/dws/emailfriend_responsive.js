var EmailFriendResponsive = {
    init: function() {
        $('.email_friend_form').each(function(){
            var $container = $(this);

            $container.find('.btn-submit').click(function(){
                checkForm(this);
            });

            var validationData = {
                rules: {},
                messages: {},
                focusInvalid: false
            };
            validationData.rules = {
                fr_name:{
                    required: true,
                    maxlength: 30
                },
                fr_email: FormValidator.getEmailRules(),
                yr_name:{
                    required: true,
                    maxlength: 30
                },
                yr_email: FormValidator.getEmailRules(),
            };

            FormValidatorResponsive.cleanMessagesObj(validationData);

            $container.validate(validationData);
        });

        $('.modul-r-email_friend .btn-message-ok').click(function(){
            window.location.href = window.location.href.split('#').shift();
        });
    }
};
