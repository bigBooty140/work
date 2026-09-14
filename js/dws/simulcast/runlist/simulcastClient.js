window.Simulcast = window.Simulcast || {};

window.Simulcast.SimulcastClient = function (queryParams, transportParams) {
    this.isShowDisconectMessage = true;

    this.subscribers = [];
    this.transport = {};
    this.state = {};

    this.initTransport(transportParams);
    this.setTransportQueryParams(queryParams);
};

window.Simulcast.SimulcastClient.prototype = {
    fullyUpdateStateProperties: [],

    /**
     * Attach new subscriber
     * @param {Object} subscriber
     * @param {String} updateMethod
     */
    subscribe: function (subscriber, updateMethod) {
        if ('object' === typeof(subscriber) && 'function' === typeof(subscriber[updateMethod])) {
            this.subscribers.push({
                context: subscriber,
                updateMethod: updateMethod,
            });
        }
    },

    initTransport: function (transportParams) {
        this.transport = new window.Simulcast.Transport(
            transportParams.socketServerUri,
            transportParams.isSslOn,
            transportParams.options,
        );

        this.transport.attach(this);
    },

    connect: function () {
        this.transport.connect();
    },

    setTransportQueryParams: function (queryParams) {
        var query;

        for (query in queryParams) {
            if (queryParams.hasOwnProperty(query)) {
                this.transport.setQueryParam(query, queryParams[query]);
            }
        }
    },

    /**
     * Use Gzip-inflate to decompress the state object
     *
     * @param {string} compressedState Compressed and base64-encoded state object
     * @requires RawDeflate
     * @requires jQuery.base64
     *
     * @return {object} Decompressed state
     */
    decompressState: function (compressedState) {
        try {
            return JSON.parse(
                decodeURIComponent(
                    encodeURIComponent(
                        window.RawDeflate.inflate(
                            $.base64.decode(compressedState),
                        ),
                    ),
                ));
        } catch (e) {
            if ('object' === typeof (compressedState)) {
                return compressedState; // threat state as not compressed
            }
        }
    },

    /**
     * Set properties established in fullyUpdateStateProperties to null
     */
    cleanStateProperties: function () {
        var oldState = this.state;
        var fullyUpdateProps;

        if (!this.fullyUpdateStateProperties.length) {
            return;
        }

        fullyUpdateProps = _.map(this.fullyUpdateStateProperties, function (path) {
            return _.split(path, '.');
        });

        _.forEach(fullyUpdateProps, function (pathArray) {
            var propToUpdate = oldState;
            var propName;
            var i;

            for (i = 0; i < pathArray.length; ++i) {
                if (
                    _.isObject(propToUpdate)
                    && (
                        !propName
                        || propToUpdate[propName]
                    )
                ) {
                    propToUpdate = (propName) ? propToUpdate[propName] : propToUpdate;
                    propName = pathArray[i];
                } else {
                    break;
                }

                if (
                    (i === (pathArray.length - 1))
                    && propToUpdate
                    && propName
                ) {
                    propToUpdate[propName] = null;
                }
            }
        });
    },

    getState: function () {
        return this.state;
    },

    /**
     * Main method (and the only way) for set/modify application state
     *
     * @param {Object|function} dataOrFn If an object passed then current state
     * will be extended by that object properties.
     * If passed a callback function then that function should return new state object.
     * Current state object will be passed to that function as first argument.
     * @param {boolean|number} decompress
     */
    setState: function (dataOrFn, decompress) {
        var oldState = this.state;
        var newState;

        switch (true) {
            case ('function' === typeof (dataOrFn)):
                newState = dataOrFn(this.state);
                break;
            case (decompress && 'string' === typeof (dataOrFn)):
                // decompress state if requested
                dataOrFn = this.decompressState(dataOrFn);
            // fallthrough
            case 'object' === typeof (dataOrFn):
                this.cleanStateProperties();
                newState = _.mergeWith({}, oldState, dataOrFn, function (objValue, newValue) {
                    // just replace arrays
                    if (_.isArray(objValue)) {
                        return newValue;
                    }
                });
                break;
        }

        if ('object' === typeof(newState)) {
            this.state = _.cloneDeep(newState); // Important
            newState = null; // for memory leak FIX
        }
    },

    /**
     * Updates all subscribers states
     */
    refreshSubscribersData: function () {
        var self = this;

        this.subscribers.forEach(function (subscriber) {
            subscriber.context[subscriber.updateMethod](self.state);
        });
    },

    /**
     * This function should be called automatically when any notification comes from the server.
     *
     * @param {string} type Notification type
     * @param {Object} data Some notification payload if any
     */
    onNotification: function (type, data) {},

    /**
     * This function should be called automatically when any transport-level events comes.
     *
     * @param {string} eventType Event name
     * @param {Object} data Some event payload if any
     */
    onEvent: function (eventType, data) {
        if (eventType === this.transport.EVENT_MESSAGE) {
            this.onMessageTransportEventHandler(data);
        }

        if (eventType === this.transport.EVENT_NOTIFICATION) {
            this.onNotificationTransportEventHandler(data);
        }

        if (eventType === this.transport.EVENT_ERROR) {
            this.onErrorTransportEventHandler(data);
        }

        this.refreshSubscribersData();
    },
    onMessageTransportEventHandler: function (data) {
        switch (data.type) {
            case 'state':
                this.setState(data.state, window.Simulcast.settings.compression);
                break;
            default:
                break;
        }
    },
    onNotificationTransportEventHandler: function (data) {
        switch (data.type) {
            case 'mutation':
                if (window.Simulcast.settings.compression) {
                    data.state = this.decompressState(data.state);
                }

                if (data.data.type === 'user.watchlist') {
                    if (data.data.payload.watchlist) {
                        this.state.user.watchlist = data.data.payload.watchlist;
                    }
                }

                break;
            default:
                break;
        }
    },
    onErrorTransportEventHandler: function (data) {
        var self = this;

        switch (data.type) {
            case 'auth':
                this.transport.disconnect();

                if (this.isShowDisconectMessage) {
                    this.isShowDisconectMessage = false;
                    window.bsDialog({
                        title: 'Error',
                        content: data.message,
                        buttons: {
                            Ok: function () {
                                self.isShowDisconectMessage = true;
                            },
                        },
                        closeButton: '',
                    });
                }

                console.log('Error:', data.message);
                break;
            default:
                break;
        }

        if (window.jalert && data.type === 'user') {
            window.jalert(data.message, 'error');
        }
    },
};
