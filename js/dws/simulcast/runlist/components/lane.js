window.Runlist.components.lane = {
    template: '#component-lane',
    props: {
        lane: Object,
        columnList: Array,
        sort: Object,
        mountedActive: Boolean,
        eventId: [String, Number],
        template: String,
        laneIndex: Number,
        lastLaneIndex: Number,
        laneButtonsData: Array,
        userBadges: Array,
        eventDate: String,
        runListFilters: Object,
        fieldsNaming: Object,
        sellerNameToShow: String,
    },
    computed: {
        isFullViewModeComputed: function () {
            return this.widgetOptions.viewMode === this.constants.VIEW_MODE_FULL;
        },
        showEventHeaderComputed: function () {
            return this.isFullViewModeComputed
                || (this.laneIndex === 0);
        },
        showEventFooterComputed: function () {
            return this.isFullViewModeComputed
                || (this.laneIndex === this.lastLaneIndex);
        },
        laneDateComputed: function () {
            return this.lane.date || this.eventDate;
        },
    },
};
