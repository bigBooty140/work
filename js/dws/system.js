/* global setInterval */

/**
 * Global system object. Functions:
 *  1) Event aggregator (on, off, trigger)
 *  2) jQuery Validate (setupFormValidation)
 * @type {{events: {}, on: System.on, off: System.off, trigger: System.trigger}}
 */
var System = {
    CACHE_BUSTER_MARK: new Date().setMinutes(0, 0, 0),

    addCacheBuster(url) {
        const separator = url.includes('?') ? '&' : '?';

        return `${url}${separator}v=${this.CACHE_BUSTER_MARK}`;
    },

    /**
     * {
     *   'eventName1': [handlerFn1, handlerFn2],
     *   'eventName2': [handlerFn1]
     * }
     */
    events: {},

    /**
     * data for each form for using as validation rules in jquery.validation
     * {formId_1: data_1, ..., formId_N: data_N}
     */
    formValidationData: {},

    /**
     * Subscribe to event
     * @param events - one or more event names separated with space
     * @param handler - handler function
     * @param once - boolean, use to delete handler after first trigger
     */
    on: function(events, handler, once) {
        var self = this,
            eventsArray;

        if (events && $.isFunction(handler)) {
            eventsArray = events.split(' ');

            $.each(eventsArray, function(index, event) {
                var marker;

                event = $.trim(event).split(':'); // divide to 'event' and 'marker'
                marker = event[1];
                event = event[0];

                if (typeof(self.events[event]) === 'undefined') {
                    self.events[event] = [];
                }

                self.events[event].push({
                    marker: marker,
                    once: once,
                    handler: handler
                });
            });
        } else {
            try {
                console.warn('Empty event name provided!')
            } catch (e) {}
        }
    },

    once: function(events, handler) {
        this.on(events, handler, true);
    },

    /**
     * Unsubscribe
     * @param event - event name
     */
    off: function(event) {
        var marker, unmarkedHandlers;

        event = $.trim(event).split(':'); // divide to 'event' (name) and 'marker'
        marker = event[1];
        event = event[0];

        if (!marker) {
            delete(this.events[event]);
        } else if (this.events[event]) {
            unmarkedHandlers = $.grep(this.events[event], function (data) {
                return data.marker !== marker;
            });

            this.events[event] = unmarkedHandlers;
        }
    },

    /**
     * Broadcast event
     * @param event - event name
     * @param data - any data which will be passed to subscribers
     */
    trigger: function(event, data) {
        var marker,
            toDelete = {};

        event = $.trim(event).split(':'); // divide to 'event' (name) and 'marker'
        marker = event[1];
        event = event[0];

        if ('undefined' !== typeof(this.events[event]) && $.isArray(this.events[event])) {

            $.each(this.events[event], function (index, element) {
                if (
                    (!marker || (element.marker === marker))
                    && $.isFunction(element.handler)
                ) {
                    element.handler(data);

                    if (element.once && $.isFunction(element.handler)) { // check if handler didn't remove itself
                        toDelete[index] = true;
                    }
                }
            });

            if (!$.isEmptyObject(toDelete) && $.type(this.events[event]) === 'array') {
                this.events[event] = $.grep(this.events[event], function (data, index) {
                    return !toDelete[index];
                });
            }
        }
    },

    /**
     * Init jQuery validation rules for form
     * @param {object} $form
     */
    setupFormValidation: function ($form) {
        var validationId;
        var validationData;

        if ($form instanceof Object) {
            validationId = $form.data('validationId');
            validationData = {};

            if (validationId && this.formValidationData[validationId]) {
                validationData = this.formValidationData[validationId];

                if (validationData instanceof Object) {
                    $.each(validationData.rules, function (fieldName) {
                        $form
                            .find('[name="' + fieldName + '"]')
                            .closest('.form-group')
                            .addClass('has-feedback');
                    });
                }
            }

            $form.validate(validationData);
        }
    },

    /**
     * Perform periodical server pings.
     *
     * @param {number} secondsInterval Interval in seconds.
     */
    setupPeriodicalServerPinging: function (secondsInterval) {
        secondsInterval = parseInt(secondsInterval);

        if (secondsInterval > 0) {
            setInterval(function () {
                $.ajax({
                    url: '/ajax',
                    type: 'post',
                    dataType: 'json',
                    data: {oper: 'ping'},
                });
            }, secondsInterval * 1000);
        }
    },
};
