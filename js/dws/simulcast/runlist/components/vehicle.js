/* global VehicleNotesPopover */
window.Runlist.components.vehicle = {
    template: '#component-vehicle',
    components: {
        'vehicle-notes': new VehicleNotesPopover(),
    },
    props: {
        vehicle: Object,
        columnList: Array,
        loadingStatus: Object,
        eventId: [String, Number],
        laneId: [String, Number],
        laneName: String,
        laneDate: String,
        template: String,
        transport: Object,
        vehicleState: Object,
        simulcastParams: Object,
        fieldsNaming: Object,
        sellerNameToShow: String,
    },
    computed: {
        imageTitleComputed: function () {
            return [
                this.vehicle.str_make,
                this.vehicle.str_model,
                this.vehicle.str_trim,
            ].join(' ');
        },
        streamData: function () {
            return {
                disableBtn: Number(this.vehicle.runlist_status) > 1,
                vehicleId: this.vehicle.vehicle_id,
            };
        },
        printColumnList: function () {
            return this.columnList.filter(function (item) {
                return item.print;
            });
        },
        alternativePrintColumnList: function () {
            return this.columnList.filter(function (item) {
                return item.alternativePrint;
            });
        },
        columnCountComputed: function () {
            if (this.template === this.constants.TEMPLATE_PRINT) {
                return this.widgetOptions.printMode === this.constants.TEMPLATE_PRINT
                    ? this.alternativePrintColumnList.length
                    : this.printColumnList.length;
            }

            return this.columnList.length;
        },
        isMobileModeComputed: function () {
            return (
                this.widgetOptions.isMobile
                && this.widgetOptions.viewMode === this.constants.VIEW_MODE_COMPACT
                && this.widgetOptions.mobileLayout === this.constants.MOBILE_LAYOUT_LIST
            );
        },
        columnListSeparated: function () {
            var localList = [];

            this.columnList.forEach(function (item) {
                if (item.mobileList) {
                    localList.push(item);
                }
            });

            return localList;
        },
        hasDocuments: function () {
            return (!_.isNull(this.vehicle.documents) && this.vehicle.documents.length > 0);
        },
        metringSuffixComputed: function () {
            return _.get(window.Simulcast, 'settings.localization.metricSystem', '');
        },
        fieldsForExtendedLayoutComputed: function () {
            var self = this;
            var fieldsForExtendedLayout = [
                {
                    label: 'Body Style',
                    value: this.getFieldText('str_body_style'),
                    visible: true,
                },
                {
                    label: this.getFieldLabel('mileage', 'Odometer'),
                    value: [this.getFieldText('mileage'), this.metringSuffixComputed].join(' '),
                    visible: true,
                },
                {
                    label: 'Engine',
                    value: this.getFieldText('str_engine'),
                    visible: true,
                },
                {
                    id: 'vin',
                    label: this.getFieldLabel('vin', 'VIN'),
                    value: this.getFieldText('vin'),
                    visible: this.isColumnAvailable('vin'),
                },
                {
                    label: 'Stock #',
                    value: this.getFieldText('stock'),
                    visible: true,
                },
                {
                    label: 'Seller',
                    value: this.sellerNameComputed,
                    visible: this.visibleIfNotNull(this.getFieldText('seller_name')),
                },
                {
                    label: this.getFieldLabel('str_exterior', 'Сolor'),
                    value: this.getFieldText('str_exterior'),
                    visible: true,
                },
                {
                    label: this.getFieldLabel('str_transmission', 'Transmission'),
                    value: this.getFieldText('str_transmission'),
                    visible: true,
                },
                {
                    label: 'Drive Type',
                    value: this.getFieldText('str_drive_type'),
                    visible: true,
                },
                {
                    id: 'location',
                    label: this.getFieldLabel('location', 'Location'),
                    value: this.getFieldText('location'),
                    visible: true,
                },
            ];

            return fieldsForExtendedLayout
                .filter(function (field) {
                    return (field.id !== 'location' || self.widgetOptions.showLocation);
                });
        },
        sellerNameComputed() {
            if (this.sellerNameToShow === this.widgetConstants.DEALER_ALIAS_NAME) {
                return this.vehicle?.dealer_alias || this.getFieldText('seller_name');
            }

            return this.getFieldText('seller_name');
        },
        formatDateComputed: function () {
            return new Date(this.laneDate).toLocaleDateString();
        },

    },
    methods: {
        getFieldText: function (fieldId) {
            var fieldText;

            switch (fieldId) {
                case 'condition_grading':
                    if (this.vehicle[fieldId] === '-1.0') {
                        fieldText = '-- --';
                    } else {
                        fieldText = this.vehicle[fieldId];
                    }

                    break;
                case 'dekra_condition':
                case 'dekra_diagnostic':
                    fieldText = this.vehicle[fieldId] || 'N';
                    break;
                case 'trade_incl_vat':
                    fieldText = this.vehicle[fieldId] || '--';
                    break;
                default:
                    fieldText = this.vehicle[fieldId];
            }

            return fieldText || '-';
        },

        getFieldLabel(fieldId, defaultLabel) {
            return this.fieldsNaming[fieldId] ?? defaultLabel;
        },

        isCurrentTemplate: function (templateName) {
            return templateName === this.template;
        },
        isColumnAvailable: function (columnId) {
            return this.columnList.some(function (column) {
                return column.id === columnId;
            });
        },
        visibleIfNotNull: function (field) {
            return field !== null && field !== '-';
        },
        setActiveWatchStar: function () {
            if (
                this.simulcastParams.user
                && this.simulcastParams.user.watchlist
                && this.simulcastParams.user.watchlist.indexOf(Number(this.vehicle.run_id)) === -1
            ) {
                this.simulcastParams.user.watchlist.push(Number(this.vehicle.run_id));
            }
        },
        getColumnName: function (columnId) {
            return (this.columnList
                .find(function (column) {
                    return column.id === columnId;
                }) || {})
                .name || '';
        },
    },
};
