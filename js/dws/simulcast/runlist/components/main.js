window.Runlist.RunListMain = function (params) {
    this.el = '#runlistWrapper';
    this.template = '#component-main';
    this.data = {
        eventList: params.eventList,
        columnList: params.columnList,
        sorting: params.defaultSort,
        vehicleCount: params.vehicleCount,
        eventSelectList: params.eventSelectList,
        runListFilters: params.runListFilters,
        laneSelectList: params.laneSelectList,
        template: params.template,
        fieldsNaming: params.fieldsNaming,

        scrollSync: {
            isShow: true,
            clientWidth: null,
            scrollWidth: null,
        },
    };
};

window.Runlist.RunListMain.prototype = {
    computed: {
        mappedSortingComputed: function () {
            var ABSENT_FIELD = 'empty';
            var sorting = {
                sortId: this.sorting.sortId,
                method: this.sorting.method,
            };
            var sortIdMap = {
                runnumber: 'run_number',
                watched: 'isWatched',
                image: ABSENT_FIELD,
                make: 'str_make',
                model: 'str_model',
                trim: 'str_trim',
                grading: 'condition_grading',
                body: ABSENT_FIELD,
                enginecyl: ABSENT_FIELD,
                stocknumber: ABSENT_FIELD,
                color: 'str_exterior',
                transmission: ABSENT_FIELD,
                drivetype: ABSENT_FIELD,
            };

            if (sortIdMap.hasOwnProperty(this.sorting.sortId)) {
                sorting.sortId = sortIdMap[this.sorting.sortId];
            }

            return sorting;
        },
    },
    methods: {
        prepareAndPrint: function () {
            this.template = this.constants.TEMPLATE_PRINT;

            setTimeout(function () {
                window.print();
            }, 50);
        },
    },
    created: function () {
        var self = this;

        window.addEventListener('beforeprint', function () {
            self.template = self.constants.TEMPLATE_PRINT;
        });

        window.addEventListener('afterprint', function () {
            setTimeout(function () {
                self.template = self.constants.TEMPLATE_DEFAULT;
            }, 50);
        });

        this.eventBus.$on(this.constants.EVENT_CHANGE_SORT, function (cellId, method) {
            self.sorting.sortId = cellId;
            self.sorting.method = method;
        });

        this.eventBus.$on(this.constants.EVENT_PRINT_RUNLIST, this.prepareAndPrint);
    },
};
