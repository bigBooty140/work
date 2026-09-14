window.Runlist.components.headerButtons = {
    template: '#component-header-buttons',
    props: {
        columnList: Array,
        template: String,
        laneButtonsData: Array,
        laneIndex: Number,
    },
    data: function () {
        return {
            showLaneBox: false,
        };
    },
    computed: {
        columnCountComputed: function () {
            var result = this.columnList.length;

            if (this.template === this.constants.TEMPLATE_PRINT) {
                result = this.columnList.filter(function (item) {
                    return item.print;
                }).length;
            }

            return result;
        },
        isMobileModeComputed: function () {
            return (
                this.widgetOptions.isMobile
                && this.widgetOptions.viewMode === this.constants.VIEW_MODE_COMPACT
                && this.widgetOptions.mobileLayout === this.constants.MOBILE_LAYOUT_LIST
            );
        },
        joinLaneContainerSettings: function () {
            var colSizeClass = this.widgetOptions.additionalJoinLaneButtonEnabled
                ? 'col-xs-6'
                : 'col-xs-12';
            var joinLaneContainerSettings = [
                {
                    alignClass: 'text-right',
                    colSizeClass: colSizeClass,
                },
            ];

            if (this.widgetOptions.additionalJoinLaneButtonEnabled) {
                joinLaneContainerSettings.unshift({
                    alignClass: 'text-left',
                    colSizeClass: colSizeClass,
                });
            }

            return joinLaneContainerSettings;
        },
    },
    methods: {
        getDate: function (item) {
            return (item.date) ? item.date : item.parentDate;
        },
        closeModal: function () {
            this.showLaneBox = false;
        },
        openModal: function () {
            this.showLaneBox = true;
        },
    },
};
