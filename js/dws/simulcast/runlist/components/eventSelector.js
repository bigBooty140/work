window.Runlist.components.eventSelector = {
    template: '#component-event-selector',
    props: {
        vehicleCount: Object,
        eventSelectList: Object,
        laneSelectList: Object,
        runListFilters: Object,
        template: String,
    },
    data: function () {
        return {
            currentEvent: null,
            currentLane: null,
            laneVehicleCount: {},
        };
    },
    created: function () {
        this.currentEvent = this.eventSelectList.selected;

        if (this.laneSelectList.selected !== 0) {
            this.currentLane = this.laneSelectList.selected;
        } else {
            this.currentLane = 'all';
        }

        this.eventBus.$on(this.constants.EVENT_LANE_VEHICLE_COUNT_UPDATED, this.updateLaneVehicleCount);
    },
    computed: {
        laneListComputed: function () {
            var laneList = _.cloneDeep(this.laneSelectList.dataList || {});

            laneList.all = {name: 'ALL'};

            return laneList;
        },
        paginationEnabled() {
            return this.widgetOptions.vehicleAmountPerPage > 0;
        },
        filteredVehicleCountComputed() {
            return Object.values(this.laneVehicleCount)
                .reduce((accumulator, currentValue) => accumulator + currentValue, 0);
        },
        vehicleTotalCountComputed() {
            return !this.paginationEnabled && this.runListFilters.onlyWatched.selected
                ? this.filteredVehicleCountComputed
                : this.vehicleCount.totalCount;
        },
    },
    methods: {
        changeEvent: function () {
            var location = window.location.pathname.replace(/#/, '')
                .substr(0, (window.location.pathname + '_').indexOf('_'));

            window.location = location + '_event_' + this.currentEvent;
        },
        changeLane: function () {
            var location = window.location.pathname.replace(/#/, '')
                .substr(0, (function (index) {
                    if (index > 0) {
                        return index;
                    }
                }(window.location.pathname.indexOf('_lane'))))
                .replace(/_page_\d+/, '');
            var targetlane = this.currentLane === 'all' ? '' : '_lane_' + this.currentLane;

            window.location = location + targetlane;
        },
        print: function () {
            this.eventBus.$emit(this.constants.EVENT_PRINT_RUNLIST);
        },
        updateURL() {
            const hash = window.location.hash;
            let newURL = window.location.href.split('#')[0];

            // Remove all occurrences of the onlywatched parameter from the URL
            newURL = newURL.replace(/_onlywatched_[01]/g, '');

            if (this.runListFilters.onlyWatched.selected) {
                newURL += `_onlywatched_1${hash}`;
            } else {
                newURL += `_onlywatched_0${hash}`;
            }

            history.replaceState(null, null, newURL);

            if (this.paginationEnabled) {
                window.location.reload();
            }
        },
        updateLaneVehicleCount(laneId, count) {
            this.$set(this.laneVehicleCount, laneId, count);
        },
    },
    filters: {
        bracket: function (value) {
            return (value)
                ? '(' + value + ')'
                : '';
        },
    },
};
