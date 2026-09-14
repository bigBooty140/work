window.Runlist.components.logistic = {
    template: '#component-logistic',
    props: {
        sellerZip: String,
        loadingStatus: Boolean,
        eventId: [String, Number],
        laneId: [String, Number],
        logisticCost: Object,
    },
    data: function () {
        return {
            showPreload: true,
            popperOptions: {
                trigger: 'clickToOpen',
                placement: 'top',
            },
        };
    },
    created: function () {
        if (this.loadingStatus) {
            this.showPreload = false;
        }
    },
    computed: {
        hasLogisticInfo: function () {
            return Boolean(this.logisticCost && this.logisticCost.success);
        },
    },
    methods: {
        getLogisticsCost: function () {
            var self = this;

            if (!this.sellerZip) {
                this.eventBus.$emit(this.constants.EVENT_LOGISTICS_LOADED, this.laneId, {status: false});
                this.showPreload = false;

                return;
            }

            $.ajax({
                url: '/ajax',
                type: 'post',
                dataType: 'json',
                data: {
                    ajax_controller: 'Logistic/Rates',
                    oper: 'get_rate',
                    pickupZip: self.sellerZip,
                },
                success: function (data) {
                    self.eventBus.$emit(self.constants.EVENT_LOGISTICS_LOADED, self.laneId, data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    window.console.error(textStatus, errorThrown);
                },
                complete: function () {
                    self.showPreload = false;
                },
            });
        },
        closePopper: function () {
            this.$refs.popper.doClose();
        },
    },
    watch: {
        loadingStatus: function () {
            this.getLogisticsCost();
        },
    },
};
