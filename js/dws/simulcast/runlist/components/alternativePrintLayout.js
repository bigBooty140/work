window.Runlist.components.alternativePrintLayout = {
    template: '#component-alternative-print-layout',
    props: {
        vehicle: Object,
        columnList: Array,
        fieldsNaming: Object,
    },
    computed: {
        alternativePrintColumnList: function () {
            return this.columnList.filter(function (item) {
                return item.alternativePrint;
            });
        },
    },
    methods: {
        getFieldText: function (fieldId) {
            var fieldText;

            switch (fieldId) {
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
        getNamedFieldLabel(field, defaultLabel) {
            return this.fieldsNaming[field] ?? defaultLabel;
        },
    },
};
