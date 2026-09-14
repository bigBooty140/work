/*
* Plugin which show alerts at the top of a page.
* Dependencies: Bootstrap 3 styles
*/

/* global setTimeout, clearTimeout */

((function ($) {
    var bsAlertToast = {

        /* Default options can be customised while function call */
        options: {
            containerSelector: 'body', /* Valid css selector of element in which alert will be embedded */
            type: 'danger', /* Can be: success, info, warning, danger */
            icon: '', /* Glyphicon name suffix, eg: alert, ok-sign, */
            customIcon: '', /* Icon in valid HTML or SVG format */
            caption: '', /* Alert message caption: any string */
            text: '', /* Alert message text: any string */
            textAlign: 'center', /* Can be: left, right, center */
            delay: 0, /* Delay before alert close. Value in milliseconds, 0 - sticky */
            dismissible: false, /* Can alert be dismissible.*/
            blockAll: false, /* Block all page content by overlay. If true 'dismissible' always 'false' */
            elementId: 'bsSystemAlertToast', /* Elements container id */
            classList: '', /* Additional classes for alert element */
            forceClose: false, /* Force remove element from DOM without animation */
            detectSpacer: true, /* Use detection of other widgets on page with elements position: fixed */
            isSpacerPresent: function () {
                /* Check is Buyers Tool Panel or Menu Advanced Alternative widgets present */
                return !!(
                    $('.modul-r-buyers-spacer').length
                    || ($('.module-r-menu-advanced-alternative').length && $('.spacer').length)
                );
            },
            templates: {

                /* Parts of alertElement */
                closeButtonElement: '<button class="close" type="button" data-dismiss="alert" aria-label="Close">'
                + '<span aria-hidden="true">&times;</span></button>',
                captionElement: '<strong>{{caption}}</strong> ',
                textElement: '<span class="message">{{text}}</span>',
                glyphiconElement: '<span class="glyphicon glyphicon-{{icon}}" aria-hidden="true"></span>&nbsp;',
                customIconElement: '<span class="custom-icon-wrapper">{{customIcon}}</span>',
                classList: 'alert alert-{{type}} {{dismissible}}text-{{align}}',

                /* Parts of mainElement */
                alertElement: '<div class="{{classList}}" role="alert">{{closeButtonElement}}'
                + '<h4 class="no-margin-bottom">'
                + '{{glyphiconElement}}{{customIconElement}}{{captionElement}}{{text}}</h4></div>',
                overlayElement: '<div class="block-all"></div>',
                spacerElement: '<div class="bs-alert-toast-spacer"></div>',

                /* Final Element*/
                mainElement: '<div id="{{idValue}}">'
                + '<div class="bs-alert-toast fade">{{alertElement}}{{overlayElement}}</div>{{spacerElement}}</div>',
            },
        },

        timer: null,
        removeElementTimer: null,
        replaceExistingElement: false,

        DELAY_FADEIN_EL_AFTER_APPEND: 50,
        DELAY_REMOVE_EL_BEFORE_CLOSE: 500,
        AFFIX_OFFSET_TOP: 25,

        show: function (message) {
            var self = this;
            var alert = {};
            var $elem;
            var $alertElem;

            if (typeof (message) === 'object') {
                $.extend(true, alert, self.options, message);
            } else {
                $.extend(alert, self.options);
                alert.text = message || '&nbsp;';
            }

            /* Remove existing element if is available */
            $elem = $('#' + alert.elementId);

            if ($elem.length) {
                closeElement(true);

                if (this.timer) {
                    clearTimeout(this.timer);
                }

                this.timer = null;
                this.replaceExistingElement = true;
            }

            $(alert.containerSelector).prepend(renderElement(alert));

            /* Lookup for the new appended element */
            $elem = $('#' + alert.elementId).find('.bs-alert-toast');
            $alertElem = $elem.find('.alert');

            if (this.replaceExistingElement) {
                $elem.addClass('in');
                this.replaceExistingElement = false;
            } else {
                setTimeout(function () {
                    $elem.addClass('in');
                }, self.DELAY_FADEIN_EL_AFTER_APPEND);
            }

            if (alert.dismissible && !alert.blockAll) {
                $alertElem.on('closed.bs.alert', function () {
                    closeElement(true);
                });
            }

            if (alert.delay) {
                self.timer = setTimeout(closeElement, alert.delay);
            }

            $alertElem
                .affix({offset: self.AFFIX_OFFSET_TOP})
                .affix('checkPosition');

            function closeElement(force) {
                self.close({elementId: alert.elementId, forceClose: force});
            }

            function renderElement(alert) {
                var EMPTY_ELEMENT = '';
                var closeButtonEl;
                var captionEl;
                var textEl;
                var classList;
                var glyphiconEl;
                var mainEl;
                var alertEl;
                var overlayEl;
                var spacerEl;
                var customIconEl;

                closeButtonEl = alert.dismissible && !alert.blockAll
                    ? alert.templates.closeButtonElement
                    : EMPTY_ELEMENT;

                captionEl = alert.caption
                    ? alert.templates.captionElement.replace('{{caption}}', alert.caption)
                    : EMPTY_ELEMENT;

                textEl = alert.templates.textElement.replace('{{text}}', alert.text);

                glyphiconEl = alert.icon
                    ? alert.templates.glyphiconElement.replace('{{icon}}', alert.icon)
                    : EMPTY_ELEMENT;

                customIconEl = alert.customIcon
                    ? alert.templates.customIconElement.replace('{{customIcon}}', alert.customIcon)
                    : EMPTY_ELEMENT;

                classList = alert.templates.classList
                    .replace('{{type}}', alert.type)
                    .replace('{{dismissible}}', alert.dismissible ? 'alert-dismissible ' : '')
                    .replace('{{align}}', alert.textAlign);

                if (alert.classList) {
                    classList = classList + ' ' + alert.classList;
                }

                overlayEl = alert.blockAll
                    ? alert.templates.overlayElement
                    : EMPTY_ELEMENT;

                spacerEl = !(alert.detectSpacer && alert.isSpacerPresent())
                    ? alert.templates.spacerElement
                    : EMPTY_ELEMENT;

                alertEl = alert.templates.alertElement
                    .replace('{{classList}}', classList)
                    .replace('{{closeButtonElement}}', closeButtonEl)
                    .replace('{{glyphiconElement}}', glyphiconEl)
                    .replace('{{captionElement}}', captionEl)
                    .replace('{{text}}', textEl)
                    .replace('{{customIconElement}}', customIconEl);

                mainEl = alert.templates.mainElement
                    .replace('{{idValue}}', alert.elementId)
                    .replace('{{alertElement}}', alertEl)
                    .replace('{{overlayElement}}', overlayEl)
                    .replace('{{spacerElement}}', spacerEl);

                return mainEl;
            }
        },

        close: function (options) {
            var self = this;
            var alert = {};
            var $elem;

            $.extend(true, alert, this.options, options);
            $elem = $('#' + alert.elementId);

            if (alert.forceClose) {
                if (this.removeElementTimer) {
                    clearTimeout(this.removeElementTimer);
                }

                this.removeElementTimer = null;
                $elem.remove();
            } else {
                $elem.removeClass('in');
                this.removeElementTimer = setTimeout(function () {
                    $elem.remove();
                }, self.DELAY_REMOVE_EL_BEFORE_CLOSE);
            }
        },
    };

    $.bsAlertToast = function (message) {
        if (message !== false) {
            bsAlertToast.show(message);
        } else {
            bsAlertToast.close();
        }
    };
})(jQuery));
