window.Runlist.components.vehicleList = {
    template: '#component-vehicle-list',
    props: {
        vehiclesList: Array,
        columnList: Array,
        eventId: [String, Number],
        laneId: [String, Number],
        laneName: String,
        laneDate: String,
        parentMounted: Boolean,
        template: String,
        sort: Object,
        userBadges: Array,
        runListFilters: Object,
        fieldsNaming: Object,
        sellerNameToShow: String,
    },
    data: function () {
        return {
            loadList: [],
            loadLogisticCount: 0,
            transport: null,
            state: {},
        };
    },
    computed: {
        vehiclesListComputed: function () {
            var self = this;
            var vehiclesListComputed = (this.vehiclesList || [])
                .map(function (vehicle) {
                    var mergedVehicle = _.cloneDeep(vehicle);

                    mergedVehicle.isWatched = self.isVehicleInWatchlist(mergedVehicle.run_id);

                    return mergedVehicle;
                });

            return vehiclesListComputed;
        },
        orderedVehiclesListComputed: function () {
            var self = this;
            var orderedVehicles = _.orderBy(this.vehiclesListComputed, function (obj) {
                var cellValue;

                switch (self.sort.sortId) {
                    case 'mileage':
                    case 'condition_grading':
                        cellValue = Number(obj[self.sort.sortId]);
                        break;
                    default:
                        cellValue = obj[self.sort.sortId];
                }

                return cellValue;
            }, self.sort.method);

            if (this.runListFilters.onlyWatched.selected) {
                orderedVehicles = orderedVehicles.filter((vehicle) => vehicle.isWatched);
            }

            return orderedVehicles;
        },
        simulcastRunListComputed: function () {
            return (this.state && this.state.lane && this.state.lane.runList) || [];
        },
        simulcastParamsComputed: function () {
            return {
                constants: this.state && this.state.constants,
                settings: this.state && this.state.settings,
                user: this.state && this.state.user,
                userBadges: this.userBadges,
            };
        },
    },
    methods: {
        getVehicleFromState: function (runId) {
            return this.simulcastRunListComputed.find(function (vehicle) {
                return Number(vehicle.id) === Number(runId);
            }) || {};
        },
        isVehicleInWatchlist: function (runId) {
            return Boolean(
                this.simulcastParamsComputed.user
                && this.simulcastParamsComputed.user.watchlist
                && this.simulcastParamsComputed.user.watchlist.length
                && this.simulcastParamsComputed.user.watchlist.indexOf(Number(runId)) > -1,
            );
        },
        fillLoadList: function () {
            var self = this;

            this.vehiclesList.forEach(function (vehicle) {
                self.loadList.push({
                    vehicleIid: vehicle.vehicle_id,
                    logisticLoad: false,
                    logisticCost: {},
                });
            });
        },
        nextLoadLogisticItem: function (id) {
            if (id === this.laneId) {
                this.loadLogisticCount++;

                if (this.loadLogisticCount < this.loadList.length) {
                    this.loadList[this.loadLogisticCount].logisticLoad = true;
                }
            }
        },
        updateState: function (newState) {
            this.$set(this, 'state', newState);
        },
        addSimulcastClient: function () {
            var clientParams = window.Runlist.simulcastClientParams;
            var queryParams = {
                sessionId: window.phpSessionId,
                siteId: clientParams.siteId,
                eventId: this.eventId,
                laneId: this.laneId,
                agentType: clientParams.agentType,
            };
            var transportSettings = {
                socketServerUri: clientParams.socketServerUris[this.laneId],
                isSslOn: clientParams.isSslOn,
                options: {
                    loggingEnabled: Boolean(window.isDevMode && window.isDevMode()),
                },
            };
            var simulcastClient = new window.Simulcast.SimulcastClient(queryParams, transportSettings);

            simulcastClient.subscribe(this, 'updateState');
            simulcastClient.connect();

            this.$set(this, 'transport', simulcastClient.transport);
        },
    },
    created: function () {
        var self = this;

        if (window.Runlist.simulcastClientParams.isEstablishSocketConnection) {
            this.addSimulcastClient();
        }

        this.fillLoadList();

        this.eventBus.$on(this.constants.EVENT_LOGISTICS_LOADED, function (id, costData) {
            if (id === self.laneId) {
                self.loadList[self.loadLogisticCount].logisticCost = costData;
                self.nextLoadLogisticItem(id);
            }
        });
    },
    watch: {
        /**
         * start fist iteration load image
         */
        parentMounted: function () {
            this.loadList[0].logisticLoad = true;
        },
        orderedVehiclesListComputed() {
            this.eventBus.$emit(
                this.constants.EVENT_LANE_VEHICLE_COUNT_UPDATED,
                this.laneId,
                this.orderedVehiclesListComputed.length,
            );
        },
    },
};
