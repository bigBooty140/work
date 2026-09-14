var LoginFormResponsive = function (params) {
    this.$container = $('.login-' + params.uid);
    this.isTermsConditionRequired = params.isTermsConditionRequired;

    this.authorized = parseInt(this.$container.find('input[name="authorized"]').val()) || 0;
    this.buyersToolbarMode = parseInt(this.$container.find('input[name="type_buyers_tool"]').first()
        .val()) || 0;
    this.auctionMode = parseInt(this.$container.find('input[name="auction_mode"]').val()) || 0;
    this.auctionAccessEnabled = parseInt(this.$container.find('input[name="auction_access_enabled"]').val()) || 0;
    this.completeRegistrationEnabled = parseInt(this.$container.find('input[name="complete_registration_enabled"]')
        .val()) || 0;
    this.connectingExistingAccount = parseInt(this.$container.find('input[name="connecting_existing_account"]')
        .val()) || 0;

    if (this.$container.closest('.modal').length) {
        this.$modal = this.$container.closest('.modal');
    }

    this.initCommonActions();

    if (this.auctionAccessEnabled) {
        this.initAuctionAccessForm();
    }

    if (params.isTermsConditionRequired) {
        this.bindTermsConditionCheck();
    }
};

LoginFormResponsive.prototype = {
    $container: null,
    $modal: null,

    authorized: false, /* determines login form status: user is logged in or not */
    buyersToolbarMode: false, /* is login widget inside buyers tools panel */
    auctionMode: false,
    auctionAccessEnabled: false,
    completeRegistrationEnabled: false,
    currentForm: 'default', /* currently visible form: default or auction_access */

    enterKeyCode: 13,

    initCommonActions: function () {
        var self = this,
            $body;

        if (!self.authorized) {
            /* submit login reset form */
            $('.reset_password', self.$container).on('click', function() {
                var $form = self.$container.find('.reset_pass_form');

                injectCsrfToken($form);
                $form.submit();
            });

            /* hide login errors after login modal from buyers tools panel was closed  */
            if (self.$modal) {
                self.$modal.one('hidden.bs.modal', function() {
                    $(this).find('.errors_block').remove();
                });

                /* Custom fix for wrong caret position for input field
                 inside a fixed position parent on iOS 11. Bug #12046 */
                $body = $('body');

                if (
                    $body.hasClass('mobile')
                    && /(iPad|iPhone).*OS 11_(\d{1,2})/.test(navigator.userAgent)
                ) {
                    $body.addClass('ios-bugfix-caret');
                }
            }

            self.$container.closest('.modal').on('hidden.bs.modal', function() {
                $('.status-messages').text('');
                $('#dws_login_form .dws_login_form_pass, #dws_login_form .dws_login_form_login').val('');
            });

            /* focus "password" field after press "Enter" on the "login" field OR clear error messages on start typing */
            $('input[name="login"], input[name="individual_id"]', self.$container).on('keypress', function(e) {
                if (self.enterKeyCode === e.which) {
                    e.preventDefault();
                    $(this).closest('form').find('input[name="password"], input[name="individual_government_id"]').filter(':visible').focus();
                } else {
                    $('.status-messages', self.$container).empty();
                }
            });

            /* submit form after press "Enter" on the "password" input */
            $('input[name="password"], input[name="individual_government_id"]', self.$container).on('keypress', function(e) {
                $('.status-messages', self.$container).empty();

                if (self.enterKeyCode === e.which) {
                    e.preventDefault();
                    self.submitLoginForm()
                }
            });

            /* submit form */
            $('.login_submit_btn', self.$container).on('click', function() {
                self.submitLoginForm();
            });

            self.$container.find('a[href="#"]').on('click', function(event) {
                event.preventDefault();
            });
        } else {
            /* log out */
            $('.dws_logout_form_submit', self.$container).on('click', function() {
                $(this).parents('form').submit();
                localStorage.removeItem('isDealersSelected')
            });
        }
    },

    initAuctionAccessForm: function () {
        var self = this;

        /* AuctionACCESS form */
        if (!self.authorized) {
            self.currentForm = self.$container.data('display-form') || 'default';

            switch (self.currentForm) {
                case 'default':
                    self.$container.find('.auction_access_fields').hide().end().find('.regular_fields').show();
                    break;
                case 'auction_access':
                    self.$container.find('.regular_fields').hide().end().find('.auction_access_fields').show();
                    break;
                default:
                    break;
            }

            /* "Not an Auction ACCESS Registered Buyer" link */
            $('.show_regular_fields').on('click', function() {
                self.showRegularFields();
            });

            /* "Return to Auction ACCESS Login Page" link */
            $('.show_auction_access_fields').on('click', function() {
                self.showAuctionAccessFields();
            });
        } else {
            /* change auction access dealer after login */
            $('.modul-r-login select[name="auction_access_dealer_id"]').on('change', function() {
                var dealerId = parseInt($(this).val()) || 0;
                var dealerName = $.trim($(this).find(':selected').text());

                $('.modul-r-login select[name="auction_access_dealer_id"]').not(this).val(dealerId);

                if (dealerId) {
                    statusOpen('Loading...', 0);

                    $.ajax({
                        url: '/ajax',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            ajax_controller: 'Portal/Login',
                            oper: 'select_auction_access_dealer',
                            dealer_id: dealerId
                        },
                        success: function(data) {
                            if (data['success']) {
                                $('.btp_user_name').text(data['display_name']);
                                $('.login_user_name, .aa_dealer_name').text(dealerName);
                                $('.aa_dealer_location').text(data['location']);
                            } else {
                                location.reload();
                            }
                        },
                        complete: function() {
                            statusRemove();
                        }
                    });
                }
            });
        }
    },

    showRegularFields: function () {
        var self = this;

        /* clear inputs */
        self.$container.find('.auction_access_fields').find(':text, :password').val('');
        self.$container.find('.status-messages').empty();

        self.$container.find('.auction_access_fields').fadeOut('fast', function() {
            self.$container.find('.regular_fields').fadeIn('fast');
            self.currentForm = 'default';
        });
    },

    showAuctionAccessFields: function () {
        var self = this;

        /* clear inputs */
        self.$container.find('.regular_fields').find(':text, :password').val('');
        self.$container.find('.status-messages').empty();

        self.$container.find('.regular_fields').fadeOut('fast', function() {
            self.$container.find('.auction_access_fields').fadeIn('fast');
            self.currentForm = 'auction_access';
        });
    },

    isLoginFormValid: function () {
        var self = this;
        var login, password, formName, validateToken = true, valid = false;
        var $form = self.$container.find('form.dws_login_form');
        var formId = $form.attr('id');

        /* remove errors from previous form submission */
        self.$container.find('.errors_block, .error_msg').remove();

        // Skip validation for our specific login form
        if (formId === 'dws_login_form_6981ed199ec4b') {
            return true;
        }

        switch (self.currentForm) {
            case 'default':
                token = $('meta[name="csrf-token"]').attr('content');
                login = self.$container.find('input[name="login"]').val();
                password = self.$container.find('input[name="password"]').val();
                formName = self.$container.find('input[name="form_id"]').val();

                var postData = {
                    ajax_controller: 'Portal/Login',
                    oper: 'validateAuth',
                    f_login: login,
                    f_password: password,
                    formname: formName
                };
                postData[window.CSRF_GLOBAL_TOKEN_NAME] = token;

                if (login && password) {
                    $.ajax({
                        url: 'ajax',
                        type: 'post',
                        async: false,
                        data: postData,
                        success: function(result) {
                            if (!$.isEmptyObject(result) && result.valid_token) {
                                valid = true;
                            } else {
                                validateToken = false;
                            }
                        }
                    });
                }

                if (!valid || !validateToken) {
                    self.$container.find('.status-messages').text('Wrong login or password');
                }

                break;
            case 'auction_access':
                var passLength = 4;
                var errors = [];

                login = self.$container.find('input[name="individual_id"]').val();
                password = self.$container.find('input[name="individual_government_id"]').val();

                if (!login || false === /^\d{4,10}$/.test(login)) {
                    errors.push('Invalid Auction ACCESS ID');
                }

                if (passLength !== password.length || false === /^\d+$/.test(password)) {
                    errors.push('Invalid Government ID (must be 4 digits)');
                }

                if (errors.length) {
                    valid = false;
                    self.$container.find('.status-messages').html(errors.join('<br/>'));
                } else {
                    valid = true;
                }

                break;
            default:
                break;
        }

        return valid;
    },

    submitLoginForm: function () {
        var self = this;
        var $form = self.$container.find('form.dws_login_form');
        var $termCondition = $form.find('.terms-condition');

        if (
            this.isTermsConditionRequired
            && $termCondition[0]
            && !$termCondition.prop('checked')
        ) {
            return;
        }

        if (self.isLoginFormValid()) {
            localStorage.setItem('isDealersSelected', 'true');
            refreshCsrfToken(false);
            injectCsrfToken($form);

            switch (self.currentForm) {
                default:
                case 'default':
                    $form.submit();
                    break;
                case 'auction_access':
                    /* clear hidden fields that could be autofilled */
                    $form.find('input[name=login]').val('');
                    $form.find('input[name=password]').val('');

                    if (self.completeRegistrationEnabled && self.connectingExistingAccount) {
                        var individualId = $form.find('[name="individual_id"]').val();
                        var individualGovernmentId = $form.find('[name="individual_government_id"]').val();

                        statusOpen('Validating your Auction Access Account...', 0);

                        $.ajax({
                            url: '/ajax',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                ajax_controller: 'Portal/Login',
                                oper: 'validate_auction_access_identity',
                                individual_id: individualId,
                                individual_government_id: individualGovernmentId
                            },
                            success: function(data) {
                                if (data.valid) {
                                    if (!data.user_id) {
                                        /* user try to login with this AA ID first time */
                                        var showDialog = function() {
                                            var dialogParams = {
                                                title: 'Connecting to an Existing Account',
                                                content: 'Previously registered on ' + window.dealershipName + '?',
                                                size: 'md'
                                            };

                                            bsConfirm(dialogParams, function($dialog) {
                                                /* Yes selected */
                                                $dialog.modal('hide').one('hidden.bs.modal', function() {
                                                    var $changeTitleContext = self.$container;

                                                    if (self.$modal) {
                                                        self.$modal.modal('show');
                                                        $changeTitleContext = self.$modal;
                                                    }

                                                    $changeTitleContext.find('.login_form_title').text('Connecting to an Existing Account');

                                                    /* remove facebook button */
                                                    self.$container.find('.fb-login-button').remove();

                                                    self.showRegularFields();
                                                    $form.find('.show_auction_access_fields, .register_btn').hide();

                                                    var inputs = [
                                                        '<input type="hidden" name="auction_access_connect" value="1">',
                                                        '<input type="hidden" name="individual_id" value="' + individualId + '">',
                                                        '<input type="hidden" name="individual_government_id" value="' + individualGovernmentId + '">'
                                                    ].join('\n');

                                                    /* inputs appended to the end of the form so they will override real inputs with AA data */
                                                    $form.append(inputs);
                                                });
                                            }, function() {
                                                /* No selected */
                                                statusOpen('Authenticating...', 0);
                                                $form.submit();
                                            });
                                        };

                                        if (self.$modal) {
                                            self.$modal.modal('hide').one('hidden.bs.modal', function() {
                                                showDialog();
                                            });
                                        } else {
                                            showDialog();
                                        }
                                    } else {
                                        /* user with specified AuctionACCESS ID found */
                                        $form.submit();
                                    }
                                } else {
                                    $form.submit();
                                }
                            },
                            complete: function() {
                                statusRemove();
                            }
                        });
                    } else {
                        $form.submit();
                    }
                    break;
            }
        }
    },

    bindTermsConditionCheck: function (uid) {
        var $form = this.$container.find('form.dws_login_form');
        var $termCondition = $form.find('.terms-condition');
        var $submitButton = $form.find('.login_submit_btn')[0];

        if (!$submitButton) {
            return;
        }

        $submitButton.setAttribute('disabled', 'disabled');

        $termCondition.on('change', function(){
            if ($(this).prop('checked')) {
                $submitButton.removeAttribute('disabled');
            } else {
                $submitButton.setAttribute('disabled', 'disabled');
            }
        });
    }
};
