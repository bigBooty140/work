/* global extend */
window.Simulcast = window.Simulcast || {};

if (typeof (window.Simulcast.BBCodeParser) === 'function') {
    window.Simulcast.bbCodeParser = window.Simulcast.bbCodeParser || new window.Simulcast.BBCodeParser();
}

window.Simulcast.NotificationComponent = function (params) {
    if (params) {
        if (typeof (params) === 'string') {
            _.mergeWith(this.defaultParams, this.preset[params]);
        } else {
            if (params.preset) {
                _.mergeWith(this.defaultParams, this.preset[params.preset]);
            }

            _.mergeWith(this.defaultParams, params);
        }
    }

    /* init default base/style/positions */
    this.updateDefaultParams(this.defaultParams.initParams);

    this.mutationObserver = null;
    this.mutationTarget = null;
};

window.Simulcast.NotificationComponent.prototype = {
    defaultParams: {
        duration: 3000,
        theme: 'jgrowl_default_alert',
        group: '',
        beforeOpen() {},
        click() {},
        initParams: {
            position: 'top-right',
            closer: true,
            closeTemplate: '&times;',
        },
    },
    preset: {
        warning: {
            theme: 'jgrowl_warning_alert',
        },
        error: {
            header: 'ERROR:',
            theme: 'jgrowl_error_alert',
        },
        desktop: {
            duration: 5000,
            group: 'jalert-notify-event',
        },
        mobile: {
            duration: 10000,
            group: 'jalert-notify-event jalert-notify-mobile',
            initParams: {
                position: 'bottom-center',
                closer: false,
                closeTemplate: '',
            },
            click() {
                $(this).trigger('jGrowl.beforeClose');
            },
            beforeOpen() {
                const SINGLE_NTF_WITH_CLOSE_CLASS = '.single-ntf-with-close-button';
                const $jgrowl = $('.jGrowl-notification').not(SINGLE_NTF_WITH_CLOSE_CLASS);
                const $notifyMessages = $('.jGrowl-notification.jalert-notify-event');

                if ($jgrowl.length > 1 && $notifyMessages.length) {
                    $notifyMessages.eq(1).remove();
                    $jgrowl.trigger('jGrowl.beforeClose');
                }

                $.jGrowl.defaults.closer = $(SINGLE_NTF_WITH_CLOSE_CLASS).length > 0;
            },
        },
        defaultCloseByAnyClick: {
            group: 'jalert-notify-event jalert-notify-quick-close',
            beforeOpen() {
                $(window).one('click', () => {
                    $('.jGrowl-notification.jalert-notify-quick-close').trigger('jGrowl.close');
                });
            },
        },
        singleNtfWithCloseButton: {
            duration: false,
            group: 'single-ntf-with-close-button',
            beforeOpen() {
                const CLOSE_BUTTON_TEMPLATE = '<div>[ close ]</div>';
                const SINGLE_NTF_WITH_CLOSE_CLASS = '.single-ntf-with-close-button';

                if ($(SINGLE_NTF_WITH_CLOSE_CLASS).length) {
                    $.jGrowl.defaults.closer = true;
                }

                if (!this.mutationObserver) {
                    this.mutationObserver = new MutationObserver((mutations) => {
                        for (let mutation of mutations) {
                            if (
                                $(mutation.addedNodes).hasClass('alert')
                                || !mutation.addedNodes.length
                            ) {
                                this.mutationTarget = mutation.target;

                                if (
                                    $(this.mutationTarget).children('.alert').length > 1
                                    || $(this.mutationTarget).children('.jGrowl-closer').length
                                ) {
                                    $('.custom-jGrowl-closer').remove();
                                } else {
                                    if (
                                        $(this.mutationTarget)
                                            .children('.alert')
                                            .not('.jalert-notify-mobile').length === 1
                                        && !$(this.mutationTarget).children('.custom-jGrowl-closer').length
                                    ) {
                                        $(CLOSE_BUTTON_TEMPLATE).appendTo($('#jGrowl'))
                                            .addClass('custom-jGrowl-closer')
                                            .one('click', function () {
                                                /* eslint-disable-next-line no-invalid-this */
                                                $(this).siblings()
                                                    .trigger('jGrowl.beforeClose');
                                            });
                                    }
                                }
                            }
                        }
                    });

                    this.mutationObserver.observe(document.getElementById('jGrowl'), {
                        childList: true,
                        subtree: true,
                    });
                }
            },
            close() {
                if (
                    this.mutationTarget && ($(this.mutationTarget).children('.alert').length < 1
                    || !$(this.mutationTarget).children('.jGrowl-closer').length)
                ) {
                    this.mutationObserver.disconnect();
                    this.mutationObserver = null;
                    this.mutationTarget = null;
                    $('.custom-jGrowl-closer').remove();
                }
            },
        },
        withButton: {
            duration: false,
            group: 'notification-wait',
            glue: 'before',
        },
        okToCloseButton: {
            duration: false,
            group: 'notification-ok-to-close',
            initParams: {
                closer: false,
                closeTemplate: '',
            },
            beforeOpen() {
                const okButton = document.createElement('div');

                okButton.textContent = 'Ok';
                okButton.className = 'btn btn-xs btn-success notification-success';
                okButton.addEventListener('click', () => {
                    this.trigger('jGrowl.close');
                }, {
                    once: true,
                });

                this.append(okButton);
            },
        },
        centeredPopupWithOkToClose: {
            duration: false,
            group: 'notification-centered-popup-with-ok',
            initParams: {
                position: 'center',
                closer: false,
                closeTemplate: '',
            },
            beforeOpen() {
                const okButton = document.createElement('div');

                okButton.textContent = 'Ok';
                okButton.className = 'btn btn-xs btn-success notification-success';
                okButton.addEventListener('click', () => {
                    this.trigger('jGrowl.close');
                }, {
                    once: true,
                });

                this.append(okButton);
            },
        },
    },

    /**
     * Show popoup message
     * @param {string} text
     * @param {object} params position, closeTemplate & closer must be given in initParams:{}
     */
    showNotification(text, params) {
        let localParams = {};
        let messageText = '';

        _.merge(localParams, this.defaultParams);

        if (typeof $.jGrowl === 'function') {
            if (typeof (params) === 'string') {
                _.mergeWith(localParams, this.preset[params]);
            } else {
                if (params.preset) {
                    _.mergeWith(localParams, this.preset[params.preset]);
                }

                _.mergeWith(localParams, params);
            }

            localParams = this.paramsAdapter(localParams);
            messageText = _.escape(text);

            if (window.Simulcast.bbCodeParser && window.Simulcast.bbCodeParser.parse) {
                messageText = window.Simulcast.bbCodeParser.parse(text);
            }

            if (params.initParams || localParams.initParams) {
                this.updateDefaultParams(localParams.initParams);
            }

            $.jGrowl(messageText, localParams);
        } else {
            throw new Error('jGrowl not connected');
        }
    },

    /**
     * Customization params "change duration for jgrowl, support legacy name
     * @param {object} params
     * @return {object}
     */
    paramsAdapter(params) {
        if (params.duration) {
            params.life = params.duration;
        } else {
            params.sticky = true;
        }

        /* add custom group style */
        if (params.addGroup) {
            params.group += ' ' + params.addGroup;
        }

        /* legacy type */
        if (params.type) {
            switch (params.type) {
                case 1:
                case 'warning':
                    params.theme = 'jgrowl_warning_alert';
                    break;
                case 2:
                case 'error':
                    params.theme = 'jgrowl_error_alert';
                    params.header = 'ERROR:';
                    break;
                case 0:
                case 'default':
                default:
                    params.theme = 'jgrowl_default_alert';
                    params.life = params.life || 3000;
            }
        }

        return params;
    },
    updateDefaultParams(params) {
        $.each(params, (key, value) => {
            $.jGrowl.defaults[key] = value;
        });
    },
};

window.Simulcast.NotificationConstants = {
    MESSAGE_TYPE_DEFAULT: 'default',
    MESSAGE_TYPE_WARNING: 'warning',
    MESSAGE_TYPE_ERROR: 'error',
    MESSAGE_TYPE_DESKTOP: 'desktop',
    MESSAGE_TYPE_MOBILE: 'mobile',
    MESSAGE_TYPE_DEFAULT_ANY_CLICK_CLOSE: 'defaultCloseByAnyClick',
    MESSAGE_TYPE_SINGLE_NTF_WITH_CLOSE_BUTTON: 'singleNtfWithCloseButton',
    MESSAGE_TYPE_OK_TO_CLOSE_BUTTON: 'okToCloseButton',
    MESSAGE_TYPE_CENTERED_POPUP_WITH_OK: 'centeredPopupWithOkToClose',
};

window.Simulcast.NotificationComponent.extend = extend;
