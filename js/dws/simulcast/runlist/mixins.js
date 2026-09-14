window.Runlist = window.Runlist || {};
window.Runlist.mixins = window.Runlist.mixins || {};

window.Runlist.Mixins = function (params) {
    var eventBus = new Vue();

    return {
        data: function () {
            var data = {
                eventBus: eventBus,
                constants: {
                    TEMPLATE_DEFAULT: 'default',
                    TEMPLATE_PRINT: 'print',
                    TEMPLATE_PRINT_ALTERNATIVE: 'print_alternative',

                    SETTING_YES: 'yes',
                    SETTING_NO: 'no',

                    VIEW_MODE_COMPACT: 'compact',
                    VIEW_MODE_FULL: 'full',

                    MOBILE_LAYOUT_LIST: 'list',
                    MOBILE_LAYOUT_TABLE: 'table',

                    WIDGET_LAYOUT_DEFAULT: 'default',
                    WIDGET_LAYOUT_DEFAULT_PLUS_STOCKWAVE: 'default-stockwave',
                    WIDGET_LAYOUT_EXTENDED: 'extended',

                    EVENT_LOGISTICS_LOADED: 'logisticsLoaded',
                    EVENT_CHANGE_SORT: 'changeSort',
                    EVENT_PRINT_RUNLIST: 'printRunlist',
                    EVENT_CLOSE_PROXY_POPOVER: 'closeProxyBid',
                    EVENT_LANE_VEHICLE_COUNT_UPDATED: 'laneVehicleCountUpdated',

                    SORT_ORDER_BY_ASC: 'asc',
                    SORT_ORDER_BY_DESC: 'desc',

                    VIDEO_TYPE_HTML: '2',
                    VIDEO_TYPE_YOUTUBE: '9',
                    VIDEO_TYPE_FILE: '1',
                    VIDEO_EXTERNAL_SERVICE: '5',
                    VIDEO_EXTERNAL_SERVICE2: '7',
                    VIDEO_EXTERNAL_SERVICE3: '8',
                },
            };
            var key;

            for (key in params) {
                if (params.hasOwnProperty(key)) {
                    data[key] = params[key];
                }
            }

            return data;
        },
        methods: {
            getParentKeyByValue: function (parentObject, property, value, erMessage) {
                var result = Object.keys(parentObject).find(function (key) {
                    return parentObject[key][property] === value;
                });

                if (result === undefined) {
                    result = (erMessage || erMessage === null) ? erMessage : '0';
                }

                return result;
            },
            setBsGridClass: function (lg, md, sm, xs, xxs) {
                var setSize = function (size) {
                    return size || 12;
                };

                return [
                    'col-lg-' + setSize(lg),
                    'col-md-' + setSize(md),
                    'col-sm-' + setSize(sm),
                    'col-sx-' + setSize(xs),
                    'col-xxs-' + setSize(xxs),
                ];
            },
        },
    };
};
