window.Runlist.components.emptyLine = {
    template: '#component-empty-line',
    props: {
        columnList: Array,
        laneIndex: Number,
        template: String,
    },
    computed: {
        numberOfColumnsComputed: function () {
            var result = this.columnList.length;

            if (this.template === this.constants.TEMPLATE_PRINT) {
                result = this.columnList.filter(function (item) {
                    return item.print;
                }).length;
            }

            return result;
        },
    },
};
