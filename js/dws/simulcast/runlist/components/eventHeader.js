window.Runlist.components.eventHeader = {
    template: '#component-event-header',
    props: {
        columnList: Array,
        sort: Object,
        eventId: [String, Number],
        template: String,
    },
    computed: {
        hideHeaderComputed: function () {
            return (
                (
                    this.widgetOptions.isMobile
                    && this.widgetOptions.viewMode === this.constants.VIEW_MODE_COMPACT
                    && this.widgetOptions.mobileLayout === this.constants.MOBILE_LAYOUT_LIST
                    && (this.widgetOptions.widgetLayout === this.constants.WIDGET_LAYOUT_DEFAULT
                        || this.widgetOptions.widgetLayout === this.constants.WIDGET_LAYOUT_DEFAULT_PLUS_STOCKWAVE)
                )
                || this.widgetOptions.widgetLayout === this.constants.WIDGET_LAYOUT_EXTENDED
            );
        },
        chevronTypeClassComputed: function () {
            return (this.sort.method === this.constants.SORT_ORDER_BY_ASC)
                ? 'glyphicon-chevron-down'
                : 'glyphicon-chevron-up';
        },
    },
    methods: {
        toggleSort: function (cellId) {
            var sortOrder = this.constants.SORT_ORDER_BY_ASC;

            if (
                this.sort.sortId === cellId
                && this.sort.method === this.constants.SORT_ORDER_BY_ASC
            ) {
                sortOrder = this.constants.SORT_ORDER_BY_DESC;
            }

            this.eventBus.$emit(this.constants.EVENT_CHANGE_SORT, cellId, sortOrder);
        },
        isActiveSortCell: function (cellId) {
            return cellId === this.sort.sortId;
        },
        isCellVisible: function (cell) {
            return Boolean(
                this.template !== this.constants.TEMPLATE_PRINT
                || (cell.print && this.widgetOptions.printMode === 'default')
                || (cell.alternativePrint && this.widgetOptions.printMode === 'alternative'),
            );
        },
        isUnsetWhiteSpace: function (cellId) {
            return Boolean(
                cellId === 'esLog'
                || cellId === 'documents'
                || cellId === 'dekra_condition'
                || cellId === 'dekra_diagnostic'
                || cellId === 'str_drive_type'
                || cellId === 'trade_incl_vat'
                || cellId === 'announcement',
            );
        },
    },
};
