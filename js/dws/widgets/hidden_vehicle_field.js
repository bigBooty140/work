var axHiddenVehicleField = (function () {
    var ACTION_MODE_BY_CLICK = 'by_click';
    var ACTION_MODE_BY_FORM_SUBMISSION = 'form_submission';
    var DATA_SELECTOR = '[data-hidden-vehicle-field]';
    var fieldType;
    var element;
    var vehicleId;
    var template = '{{DATA}}';

    return {
        init: function () {
            this.bindEvents();
        },

        bindEvents: function () {
            /* FIXME: we don't really want controller to re-initialize on every click.
             * Also we should not allow multiple ajax requests when SHOW PHONE or other button is clicked */
            $(document).on('click.hidden_vehicle_field', DATA_SELECTOR, this.controller);
        },

        controller: function (event) {
            var $this = $(this);
            var actionMode = $this.data('mode') || '';
            var formId;
            var formName;

            // prevent clicking on disabled elements
            if ($this.hasClass('disabled')) {
                return false;
            }

            fieldType = $this.data('hiddenVehicleField') || '';
            vehicleId = $this.data('vehicleId') || 0;
            template = $this.data('responseTemplate') || template;
            element = this;

            switch (actionMode) {
                case ACTION_MODE_BY_CLICK:
                    processMethod();
                    break;

                case ACTION_MODE_BY_FORM_SUBMISSION:
                    formId = $this.data('formId');
                    formName = $this.data('formName');

                    formSubmission(formId, formName, processMethod);
                    break;
            }

            // prevent passing the click through
            event.preventDefault();
            return false; // avoid page jumping when href=# element is clicked
        },

    };

    /**
     * Define and execute a method to get the value of a hidden field
     */
    function processMethod() {
        switch (fieldType) {
            case 'vin':
                showVin();
                break;

            case 'phone':
            case 'toll_free_phone':
            case 'international_phone':
                showPhone(fieldType);
                break;

            default:
                showError();
                break;
        }
    }

    /**
     * @param {object} response {success, data}
     */
    function processValueFromResponse(response, callback) {
        var $parent;
        var errorMessage;

        if (response.success) {
            if (response.data) {
                $parent = $(element).parent();

                $parent.fadeOut(200, function () {
                    var data = template
                        .replace(/{{DATA}}/g, response.data.toString())
                        .replace(/{{DATA_MOBILE}}/g, response.data_mobile
                            ? response.data_mobile.toString()
                            : response.data.toString());

                    $(element).remove();
                    $parent.append(data).fadeIn(200, callback);
                });
            }
        } else {
            if (response.data) {
                errorMessage = response.data.toString();

                showError(errorMessage);
            } else {
                showError();
            }
        }
    }

    function addSpinner() {
        // TODO: add a real spinner some day
        /* block all data-hidden-field elements from clicking while ajax requests is in progress */
        $(DATA_SELECTOR)
            .addClass('disabled')
            .prop('disabled', true);
    }

    function removeSpinner() {
        $(DATA_SELECTOR)
            .removeClass('disabled')
            .prop('disabled', false);
    }

    /**
     * Method to get VIN
     */
    function showVin() {
        addSpinner();
        $.ajax({
            url: '/ajax',
            data: {
                ajax_controller: 'Vehicle',
                oper: 'getVin',
                vehicleId: vehicleId,
            }, success: function (response) {
                processValueFromResponse(response, removeSpinner);
            }, error: function () {
                showError();
                removeSpinner();
            },
        });
    }

    /**
     * Method to get Phone
     * @param {string} type - a type of a phone number to get: phone, toll_free_phone, international_phone
     */
    function showPhone(type) {
        addSpinner();
        $.ajax({
            url: '/ajax',
            data: {
                ajax_controller: 'Vehicle',
                oper: 'getPhone',
                type: type,
                vehicleId: vehicleId,
            }, success: function (response) {
                processValueFromResponse(response, removeSpinner);
            }, error: function () {
                showError();
                removeSpinner();
            },
        });
    }

    /**
     * If some went wrong
     * @param {string} message - notification contents
     */
    function showError(message) {
        window.bsAlert(message ? message.toString() : 'Some error occurred');
    }

    /**
     * Submission form process
     * @param {string} formId
     * @param {string} formName
     * @param {function} callback execute method after form submission
     */
    function formSubmission(formId, formName, callback) {
        var $form;
        var $modal;

        if ('function' !== typeof callback) {
            callback = function () {
            };
        }

        $form = $('#modal-' + formId + ' form');
        $modal = $('#modal-' + formId);

        /* replace form title */
        if (!formName) {
            formName = ' ';
        }

        $modal.find('.modal-title').html(formName);

        $form
            .off('submit')
            .on('submit', function () {
                $form.ajaxSubmit({
                    resetForm: true,
                    beforeSubmit: function (arr, $form, options) {
                        options.url = 'ajax';
                        arr.push({name: 'ajax_controller', value: 'Forms'});
                        arr.push({name: 'oper', value: 'processCustomForm'});
                        arr.push({name: 'responsive_form', value: formId});
                        arr.push({name: 'template', value: 'responsive'});
                        arr.push({name: 'responseTemplate', value: template});
                    },
                    success: function (data) {
                        if (data.success) {
                            callback();
                        } else {
                            showError();
                        }
                    },
                    error: function () {
                        showError();
                    },
                    complete: function () {
                        $modal.modal('hide');
                        window.statusRemove();
                        window.reloadCaptcha();
                    },
                });

                return false;
            });
    }
}()).init();
