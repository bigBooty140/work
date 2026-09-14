window.Runlist.components.laneList = {
    template: '#component-lane-list',
    props: {
        singleEvent: Object,
        columnList: Array,
        sort: Object,
        template: String,
        runListFilters: Object,
        fieldsNaming: Object,
        sellerNameToShow: String,
    },
    data: function () {
        return {
            mountedActive: false,
            scrollData: {},
            userBadges: [],
        };
    },
    computed: {
        eventIdComputed: function () {
            return this.singleEvent.id;
        },
        lanesOrderedByNameComputed: function () {
            return this.singleEvent.lane
                .map(function (lane) {
                    return lane;
                })
                .sort(function (laneA, laneB) {
                    return laneA.name.localeCompare(laneB.name);
                });
        },
        listIdComputed: function () {
            return 'lanelist_' + this.singleEvent.auction_id + '_' + this.singleEvent.id;
        },
        laneButtonsDataComputed: function () {
            var self = this;

            return this.lanesOrderedByNameComputed
                .map(function (item) {
                    var buttonData = {
                        eventName: self.singleEvent.name,
                        name: item.name,
                        date: item.date,
                        parentDate: self.singleEvent.date,
                        description: self.singleEvent.description,
                        linkToCalendar: self.singleEvent.link_to_calendar,
                    };

                    if (self.isUserLoggedIn) {
                        buttonData.link = item['link_to_lane'];
                    }

                    return buttonData;
                });
        },
    },
    methods: {
        setScrollSyncParams: function () {
            var element = null;

            element = document.getElementById(this.listIdComputed);
            /**
             * hard connect to root data
             */
            this.$root.scrollSync.clientWidth = element.clientWidth;
            this.$root.scrollSync.scrollWidth = element.scrollWidth;
            this.$root.scrollSync.isShow = (element.clientWidth < element.scrollWidth);
        },
        getDwsApi: function () {
            return import(System.addCacheBuster('/js/dws/dwsApi/index.js'));
        },
        setUserBadges: async function () {
            var dwsApi = await this.getDwsApi();

            try {
                this.userBadges = await dwsApi.simulcastDealers.getSelectedDealers();
            } catch (error) {
                window.jalert(error, 'error');
            }
        },
        getAllVehiclesId() {
            const vehicleIds = this.singleEvent.lane
                .flatMap((laneItem) => laneItem.vehicles.map((vehicle) => vehicle.vehicle_id));

            return vehicleIds || [];
        },
    },
    created: function () {
        var self = this;

        if (window.Runlist.simulcastClientParams.isEstablishSocketConnection) {
            this.setUserBadges();

            System.on('selectedDealersUpdated', function () {
                self.setUserBadges();
            });
        }

        if (this.widgetOptions.showNamaGrading) {
            this.namaGradingClient.addVehicleIds(this.getAllVehiclesId());
            this.namaGradingClient.fetchStateForVehicles();
        }

        this.$nextTick(function () {
            self.mountedActive = true;
            self.setScrollSyncParams();
        });

        window.addEventListener('resize', _.debounce(this.setScrollSyncParams, 200));
    },
};
