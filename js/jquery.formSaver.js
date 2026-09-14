;
// Fix Internet Explorer < 9
if (typeof Object.create !== 'function') {
    Object.create = function (obj) {
        function F() {
        }

        F.prototype = obj;
        return new F();
    };
}

(function ($, window, document, undefined) {
    var FormSaver = {
        //============================================
        //  Public methods
        //============================================

        /**
         * Base plugin initialization
         * @param {Object} options
         * @param {Object} elem
         */
        init: function (options, elem) {
            var self = this;

            self.elem = elem;
            self.$elem = $(elem);
            self.options = $.extend({}, $.fn.formSaver.options, options);
            self.savedOptions = undefined;

            self.storageId = 'formSaver__$url__$extra'
                .replace('$url', location.pathname)
                .replace('$extra', self.$elem.attr('id') || '');

            self.$elem.on("submit", function () {
                self.save();
            });
        },

        /**
         * Save Form values
         */
        save: function () {
            var self = this,
                data = self._extractValues();

            self.reset();
            self._storageSave(data);
        },

        /**
         * Restore Form values
         */
        restore: function () {
            var self = this;

            if (self._storageFetch()) {
                // Set handler as last in the handlers queue
                setTimeout(function () {
                    self._fillWidgets();
                    self.reset();
                }, 0);
            }
        },

        /**
         * Remove data from localStorage or cookie
         */
        reset: function () {
            var self = this;

            if (self._isLocalStorageAvailable()) {
                localStorage.removeItem(self.storageId);
            } else {
                var date = new Date();
                date.setTime(date.getTime() + (-999 * 24 * 60 * 60 * 1000));
                document.cookie = self.storageId + "=; expires=" + date.toUTCString() + "; path=/";
            }
        },

        //============================================
        //  Private methods
        //============================================

        /**
         * Extract values from form
         * @returns {Object}
         * @private
         */
        _extractValues: function () {
            var self = this,
                formData = self.$elem.serializeArray(),
                suffix = self.options.internalParamSuffix,
                preparedData = {};

            $.map(formData, function (n) {
                switch (true) {
                    case n['name'].indexOf(suffix, n['name'].length - suffix.length) !== -1:
                    case n['name'] === "form_id":
                    case n['name'] === "numForm":
                        break;
                    default:
                        preparedData[n['name']] = n['value'];
                }
            });

            return preparedData;
        },

        /**
         * Run _widget<widgetName> for each widget in form
         * @private
         */
        _fillWidgets: function () {
            var self = this,
                $widget,
                widgetName;

            self.$elem.find("div[widget]").each(function () {
                $widget = $(this);
                widgetName = $widget.attr("widget");

                try {
                    switch (widgetName) {
                        case "text_input":
                        case "text_multiline":
                        case "phone_input":
                        case "selectbox":
                            return self._widgetBase($widget);
                        case "checkbox":
                            return self._widgetCheckbox($widget);
                        case "radio":
                            return self._widgetRadio($widget);
                        case "selectbox_list":
                            return self._widgetSelectList($widget);
                        case "date_input":
                            return self._widgetDateInput($widget);
                        case "selectchain":
                            return self._widgetSelectChain($widget);
                        default:
                            return null;
                    }
                } catch (e) {
                    self._debug(e.message, e);
                }
            });
        },

        //============================================
        // Widgets fill methods
        //============================================

        /**
         * @param {jQuery} $widget
         * @private
         */
        _widgetBase: function ($widget) {
            var self = this,
                $field = $widget.find(":input:visible"),
                fieldName = $field.attr("name"),
                fieldValue = self._storageGetValue(fieldName);

            self._debug("fieldName: " + fieldName, fieldValue);
            self._fillInputField($field, fieldValue);
        },

        /**
         * @param {jQuery} $widget
         * @private
         */
        _widgetCheckbox: function ($widget) {
            var self = this,
                $fields = $widget.find(":input:visible"),
                fieldName = $fields.first().attr("class"),
                fieldValue = self._storageGetValue(fieldName);

            self._debug("fieldName: " + fieldName, fieldValue);
            self._fillCheckboxField($fields, fieldValue.split(", "));
        },

        /**
         * @param {jQuery} $widget
         * @private
         */
        _widgetRadio: function ($widget) {
            var self = this,
                $fields = $widget.find(":input:visible"),
                fieldName = $fields.first().attr("name"),
                fieldValue = self._storageGetValue(fieldName);

            self._debug("fieldName: " + fieldName, fieldValue);
            self._fillInputField($fields, [fieldValue]);
        },

        /**
         * @param {jQuery} $widget
         * @private
         */
        _widgetSelectList: function ($widget) {
            var self = this,
                $field = $widget.find(":input:visible").first(),
                fieldName = $field.data("target"),
                fieldValue = self._storageGetValue(fieldName);

            fieldValue = fieldValue.split(",");

            $.each(fieldValue, function (i) {
                fieldValue[i] = fieldValue[i].replace(/^\^|\^$/gm, '')
            });

            self._debug("fieldName: " + fieldName, fieldValue.join(','));
            self._fillInputField($field, fieldValue);
        },

        /**
         * @param {jQuery} $widget
         * @private
         */
        _widgetDateInput: function ($widget) {
            var self = this,
                $fields = $widget.find(":input:visible");

            $fields.each(function () {
                var $field = $(this),
                    fieldName = $field.attr("name"),
                    fieldValue = self._storageGetValue(fieldName);

                self._debug("fieldName: " + fieldName, fieldValue);
                self._fillInputField($field, fieldValue);
            });
        },

        /**
         * @param {jQuery} $widget
         * @private
         */
        _widgetSelectChain: function ($widget) {
            var self = this,
                $fields = $widget.find(":input:visible");

            self._fillChain($fields);
        },

        //============================================
        // Fields fill methods
        //============================================

        /**
         * @param {jQuery} $field
         * @param {*} fieldValue
         * @private
         */
        _fillInputField: function ($field, fieldValue) {
            $field.val(fieldValue)
                .trigger("change")
                .trigger("click");
        },

        /**
         * @param {jQuery} $field
         * @param {Array} fieldValues
         * @private
         */
        _fillCheckboxField: function ($field, fieldValues) {
            $field.each(function () {
                var $checkbox = $(this);

                $checkbox
                    .prop("checked", ($.inArray($checkbox.val(), fieldValues) == -1))
                    .trigger("change")
                    .trigger("click");
            });
        },

        /**
         * @param {jQuery[]} $fieldsPool
         * @private
         */
        _fillChain: function ($fieldsPool) {
            var self = this,
                i,
                $field,
                fieldName,
                fieldValue,
                newPool = [];

            self._debug("Chain pool:", $fieldsPool);

            for (i = 0; i <= $fieldsPool.length; i++) {
                $field = $($fieldsPool[i]);
                fieldName = $field.attr("name");
                fieldValue = self._storageGetValue(fieldName);

                // If field is <input> or field is <select> and have required option
                if ($field.prop("tagName") == "INPUT" || $field.find("option[value='" + fieldValue + "']").length > 0) {
                    self._debug("fieldName: " + fieldName, fieldValue);
                    self._fillInputField($field, fieldValue);
                    $fieldsPool[i] = undefined;
                }
            }

            for (i = 0; i < $fieldsPool.length; i++) {
                if ($fieldsPool[i]) {
                    newPool.push($fieldsPool[i]);
                }
            }

            if (newPool.length) {
                $(document).one("ajaxComplete", function () {
                    self._fillChain(newPool);
                })
            } else {
                self._debug("Chain pool empty");
            }
        },

        //============================================
        //  Storage
        //============================================

        /**
         * Save data to localStorage or cookie
         * @param {Object} data
         * @private
         */
        _storageSave: function (data) {
            var self = this,
                jsonData = JSON.stringify(data);

            if (self._isLocalStorageAvailable()) {
                localStorage.setItem(self.storageId, jsonData);
            } else {
                document.cookie = self.storageId + "=" + jsonData + "; path=/";
            }
        },

        /**
         * Read date from localStorage or cookie
         * @returns {Array|null}
         * @private
         */
        _storageFetch: function () {
            var self = this;

            if (self.savedOptions === undefined) {
                if (self._isLocalStorageAvailable()) {
                    self.savedOptions = JSON.parse(localStorage.getItem(self.storageId));
                } else {
                    var nameEQ = self.storageId + "=",
                        ca = document.cookie.split(';');

                    for (var i = 0; i < ca.length; i++) {
                        var c = ca[i];

                        while (c.charAt(0) == ' ') {
                            c = c.substring(1, c.length);
                        }

                        if (c.indexOf(nameEQ) == 0) {
                            self.savedOptions = JSON.parse(c.substring(nameEQ.length, c.length));
                        }
                    }
                    self.savedOptions = null;
                }
            }

            return self.savedOptions;
        },

        /**
         * @param {string} key
         * @returns {*}
         * @private
         */
        _storageGetValue: function (key) {
            var self = this,
                options = self._storageFetch();

            return options.hasOwnProperty(key)
                ? options[key]
                : null;
        },

        /**
         * Check is localStorage available
         * @returns {boolean} true if available
         * @private
         */
        _isLocalStorageAvailable: function () {
            try {
                return 'localStorage' in window && window['localStorage'] !== null;
            } catch (e) {
                return false;
            }
        },

        _debug: function (message, data) {
            var self = this,
                args = Array.prototype.slice.call(arguments, 1);

            if (self.options.debug) {
                if (typeof message == 'string') {
                    message = "FS: " + message;
                }

                if (args.length) {
                    console.debug(message, args);
                } else {
                    console.info(message);
                }
            }
        }
    };

    $.fn.formSaver = function (method, options) {
        return this.each(function () {
            var formSaver = $(this).data('formSaver');

            if (undefined == formSaver) {
                options = method;
                method = 'init';
                formSaver = Object.create(FormSaver);
                $(this).data('formSaver', formSaver);
            }

            if ('undefined' !== typeof(formSaver[method])) {
                formSaver[method](options, this);
            }
        });
    };

    $.fn.formSaver.options = {
        debug: false,
        internalParamSuffix: "_params" // Skip fields with this name suffix
    };

})(jQuery, window, document);