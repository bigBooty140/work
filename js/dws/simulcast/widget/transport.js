/* global location io extend setTimeout setInterval clearTimeout */
window.Simulcast = window.Simulcast || {};
window.Simulcast.EventBus = window.Simulcast.EventBus || {};
window.Simulcast.settings = window.Simulcast.settings || {};

window.Simulcast.Transport = function (host, isSslOn, options) {
    let protocol = 'ws';

    this.clonePropsFromPrototype(
        this,
        [
            'pingsEnabled',
            'loggingEnabled',
            'socket',
            'url',
            'query',
            'subscribers',
            'eventTypes',
            'debugMode',
            'isReconnecting',
        ],
    );

    if (isSslOn === true) {
        protocol = 'wss';
    }

    if ((options || {}).hasOwnProperty('loggingEnabled')) {
        this.loggingEnabled = options.loggingEnabled;
    }

    this.url = protocol + '://' + host;

    this.eventTypes = [
        window.Simulcast.Transport.prototype.EVENT_MESSAGE,
        window.Simulcast.Transport.prototype.EVENT_NOTIFICATION,
        window.Simulcast.Transport.prototype.EVENT_ERROR,
    ];

    if (typeof window.Simulcast.settings.showDisconnectNotificationTimeout !== 'undefined') {
        this.isShowGuiAlertMessages = !!window.Simulcast.settings.showDisconnectNotificationTimeout;
        this.guiAlertDelay = window.Simulcast.settings.showDisconnectNotificationTimeout * 1000;
    }

    this.setQueryParam('userAgent', window.navigator.userAgent);

    // connect to the server
    this.socket = io(this.url, {
        autoConnect: false,
        query: this.query,
    });

    this.bindEvents();
};

window.Simulcast.Transport.prototype = {
    EVENT_MESSAGE: 'message',
    EVENT_NOTIFICATION: 'notification',
    EVENT_ERROR: 'err',

    vueBusEvents: {
        TRANSPORT_CONNECTED: 'simulcastTransportConnected',
    },

    /** {integer} Ping interval in seconds */
    SERVER_PING_INTERVAL: 50,

    /** {integer} Connect timeout in seconds */
    SOCKET_CONNECT_TIMEOUT: {
        onDisconnect: 1,
        onConnectError: 5,
    },

    /** {bool} Periodical server pinging enabled or not */
    pingsEnabled: true,

    /** {bool} Enable console logs or not */
    loggingEnabled: true,

    /** {io} Socket client instance */
    socket: null,

    /** {string} Connection URL with schema and port. Ex: 'ws://example.com:8080' */
    url: '',

    /** {Object} Query params which will be passed to the server upon connection */
    query: {},

    /** {Array} Events subscribers */
    subscribers: [],

    /** {Array} Possible server events which we can accept */
    eventTypes: [],

    /** {bool} Debug mode. Enables on "Ctrl + Alt + Click" for next query. */
    debugMode: false,

    /** {bool} Flags set if transport use reconnection */
    isReconnecting: {
        byDisconnect: false,
        byConnectError: false,
    },

    /** {Boolean} Flag for enable or disable showing alert messages to user */
    isShowGuiAlertMessages: true,

    /** {Number} Delay in milliseconds before showing alert notifications for user */
    guiAlertDelay: 5000,

    /** {Number} guiAlertTimerId created by setTimeout */
    guiAlertTimerId: null,

    /** {Object} Messages displayed to the user via guiAlert() method, during connection events */
    GUI_ALERT_MESSAGE: {
        connected: {
            caption: 'Connected.',
            text: 'You are online.',
            type: 'success',
            customIcon: '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" '
            + 'xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490.05 490.05" '
            + 'style="enable-background:new 0 0 490.05 490.05;" xml:space="preserve"><g>'
            + '<path d="M418.275,418.275c95.7-95.7,95.7-250.8,0-346.5s-250.8-95.7-346.5,0s-95.7,250.8,0,346.5S322.675,'
            + '513.975,418.275,418.275 z M157.175,207.575l55.1,55.1l120.7-120.6l42.7,42.7l-120.6,120.6l-42.8,'
            + '42.7l-42.7-42.7l-55.1-55.1L157.175,207.575z"/></g></svg>',
            delay: 3500,
            dismissible: true,
        },
        disconnected: {
            caption: 'You are offline.',
            text: 'Reconnecting',
            type: 'danger',
            customIcon: '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" '
            + 'xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 246.027 246.027" '
            + 'style="enable-background:new 0 0 246.027 246.027;" xml:space="preserve"><path d="M242.751,'
            + '196.508L143.937,25.358c-4.367-7.564-12.189-12.081-20.924-12.081c-8.735,0-16.557,4.516-20.924,'
            + '12.081 L3.276,196.508c-4.368,7.564-4.368,16.596,0,24.161s12.189,12.081,20.924,12.081h197.629c8.734,'
            + '0,16.556-4.516,20.923-12.08 C247.119,213.105,247.118,204.073,242.751,196.508z M123.014,204.906c-8.672,'
            + '0-15.727-7.055-15.727-15.727 c0-8.671,7.055-15.726,15.727-15.726s15.727,7.055,15.727,15.726C138.74,'
            + '197.852,131.685,204.906,123.014,204.906z M138.847,137.68 c0,8.73-7.103,15.833-15.833,15.833s-15.833-'
            + '7.103-15.833-15.833V65.013c0-4.142,3.358-7.5,7.5-7.5h16.667 c4.143,0,7.5,3.358,7.5,7.5V137.68z"/></svg>',
            delay: 0,
            dismissible: false,
            templates: {
                textElement: '<span class="message">{{text}}</span><span class="simulcast-transport '
                + 'ellipsis-loading-container"><span class="ellipsis-loading"></span></span>',
            },
        },
    },

    /**
     * Connect to the server with current params
     */
    connect() {
        if (!this.socket.connected) {
            this.socket.connect();

            this.socket.on('connect', () => {
                this.dispatchEventToBus(this.vueBusEvents.TRANSPORT_CONNECTED);
                this.log('Connected.');

                if (this.isReconnecting.byDisconnect || this.isReconnecting.byConnectError) {
                    if (this.guiAlertTimerId) {
                        clearTimeout(this.guiAlertTimerId);
                        this.guiAlertTimerId = null;
                    } else {
                        this.guiAlert(this.GUI_ALERT_MESSAGE.connected);
                    }

                    this.isReconnecting.byDisconnect = false;
                    this.isReconnecting.byConnectError = false;
                }
            });

            // setup reconnection
            this.socket.on('disconnect', (error) => {
                this.log(
                    `Disconnected. Reconnecting in ${this.SOCKET_CONNECT_TIMEOUT.onDisconnect} second.`,
                    error,
                );

                if (!(this.isReconnecting.byDisconnect || this.isReconnecting.byConnectError)) {
                    this.guiAlert(this.GUI_ALERT_MESSAGE.disconnected, this.guiAlertDelay);
                }

                setTimeout(() => {
                    this.socket.connect();
                }, this.SOCKET_CONNECT_TIMEOUT.onDisconnect * 1000);

                this.isReconnecting.byDisconnect = true;
            });

            this.socket.on('connect_error', (error) => {
                this.log(
                    `Connection error. Reconnecting in ${this.SOCKET_CONNECT_TIMEOUT.onConnectError} seconds.`,
                    error,
                );

                if (!(this.isReconnecting.byDisconnect || this.isReconnecting.byConnectError)) {
                    this.guiAlert(this.GUI_ALERT_MESSAGE.disconnected, this.guiAlertDelay);
                }

                setTimeout(() => {
                    this.socket.connect();
                }, this.SOCKET_CONNECT_TIMEOUT.onConnectError * 1000);

                this.isReconnecting.byConnectError = true;
            });

            // setup server pinging
            if (this.pingsEnabled) {
                setInterval(() => {
                    if (this.socket.connected) {
                        this.send('user.ping');
                    }
                }, this.SERVER_PING_INTERVAL * 1000);
            }
        }
    },

    /**
     * Disconnect from the server
     */
    disconnect() {
        this.socket.off('disconnect');
        this.socket.off('connect_error');

        this.socket.disconnect();
    },

    /**
     * Init events
     */
    bindEvents() {
        // bind server events
        // eslint-disable-next-line no-unused-vars
        this.eventTypes.forEach((eventType) => {
            this.socket.on(eventType, (data) => {
                this.log('Socket event:', eventType, data);

                // notify subscribers
                // eslint-disable-next-line no-unused-vars
                this.subscribers.forEach((subscriber) => {
                    subscriber.onEvent(eventType, data);
                });

                // call onNotification method apart if notification comes
                if (this.EVENT_NOTIFICATION === eventType) {
                    // eslint-disable-next-line no-unused-vars
                    this.subscribers.forEach((subscriber) => {
                        subscriber.onNotification(data.type, data.data);
                    });
                }
            });
        });

        // debug mode
        if ('#DEV' === location.hash.toUpperCase()) {
            $(window).on('keydown', (e) => {
                const keyCodeWin = 91;

                if (e.altKey && keyCodeWin === e.which) {
                    this.debugMode = !this.debugMode;

                    if (this.debugMode) {
                        this.log('Transport debug mode enabled');
                        $('body').append(
                            '<button '
                                + 'class="btn btn-danger btn-block btn-sm btn-debug-mode"'
                                + 'style="position: fixed; left: 10px; top: 10px; width: 50px;"'
                            + '>'
                                + '<small>Debug</small>'
                            + '</button>',
                        );
                    } else {
                        this.log('Transport debug mode disabled');
                        $('.btn-debug-mode').remove();
                    }
                }
            });
        }
    },

    /**
     * Set query param
     *
     * @param {string} name
     * @param {string|Number} value
     */
    setQueryParam(name, value) {
        this.query[name] = value;
    },

    /**
     * Subscribe to the server event
     *
     * @param {string} eventName
     * @param {function} callback
     */
    on(eventName, callback) {
        if (eventName && 'function' === typeof(callback)) {
            this.socket.on(eventName, callback);
        }
    },

    /**
     * Send message to the server with 'message' event type
     *
     * @param {string} eventType
     * @param {Object=} data
     * @param {callback} ack Callback function. May be called from the server.
     */
    send(eventType, data, ack) {
        data = data || {};

        const messageData = {
            type: eventType,
            data: data,
        };

        if (this.debugMode) {
            this.log('Sending request in debug mode');

            $.ajax({
                url: '/ajax',
                type: 'post',
                dataType: 'json',
                data: {
                    ajax_controller: 'Simulcast/Simulcast2',
                    oper: 'debugRun',
                    query: this.query,
                    message: messageData,
                },
                success: () => {},
            });
        } else {
            this.socket.send(this.EVENT_MESSAGE, messageData, ack);
        }

        // TODO: only for debug
        this.log('send: ' + eventType, data);
    },

    /**
     * Attach new subscriber
     *
     * @param {object} subscriber
     */
    attach(subscriber) {
        if ('object' === typeof(subscriber) && 'function' === typeof(subscriber.onEvent)) {
            this.subscribers.push(subscriber);
        }
    },

    /**
     * Detach subscriber
     *
     * @param {object} subscriber
     */
    detach(subscriber) {
        const subscriberIndex = this.subscribers.indexOf(subscriber);

        this.subscribers.splice(subscriberIndex, 1);
    },

    /**
     * @return {bool}
     */
    isConnected() {
        return this.socket.connected;
    },

    /**
     * Log to the browser console. You can pass as many arguments as you want.
     */
    log() {
        if (this.loggingEnabled && window.console) {
            window.console.log
                .apply(console, arguments);
        }
    },

    /**
     * Alert to the browser user interface.
     *
     * @param {Object} message Object with parameters for bsAlertToast from control_responsive.js
     * @param {Number} showTimeout Delay in milliseconds before showing alert notifications for user
     */
    guiAlert(message, showTimeout) {
        const displayAlert = () => {
            if ($ && typeof ($.bsAlertToast) === 'function') {
                $.bsAlertToast(message);
            } else {
                this.log('GUI Alert cannot be shown because jQuery or $.bsAlertToast() is unavailable.');
            }
        };

        if (this.isShowGuiAlertMessages) {
            if (this.guiAlertTimerId) {
                clearTimeout(this.guiAlertTimerId);
                this.guiAlertTimerId = null;
            }

            if (showTimeout) {
                this.guiAlertTimerId = setTimeout(() => {
                    displayAlert();
                    this.guiAlertTimerId = null;
                }, showTimeout);
            } else {
                displayAlert();
            }
        }
    },

    /**
     * Dispatch event to Vue EventBus if EventBus is available.
     *
     * @param {String} eventName Event Name
     */
    dispatchEventToBus(eventName) {
        if (typeof window.Simulcast.EventBus.$emit === 'function') {
            window.Simulcast.EventBus.$emit.apply(window.Simulcast.EventBus, arguments);
        }
    },
    clonePropsFromPrototype(self, propsList) {
        self = self || this;

        if (Array.isArray(propsList)) {
            propsList.forEach((prop) => {
                self[prop] = _.cloneDeep(self[prop]);
            });
        }
    },
};

window.Simulcast.Transport.extend = extend;
