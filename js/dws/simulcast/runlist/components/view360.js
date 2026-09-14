window.Runlist.components.view360 = {
    template: '#component-view-360',
    props: {
        vehicleId: [String, Number],
        fyusionId: String,
        vir360Id: String,
    },
    data: function () {
        return {
            fyusionPlayer: null,
            fyusionPlayerParams: {
                preload: 1,
                zoom: 1,
                fullscreen: 0,
                tags: 1,
                motion: 1,
                nologo: 1,
                intro: 1,
            },
        };
    },
    computed: {
        fyusionContainerIdComputed: function () {
            return 'fu_' + this.fyusionId + '_' + this.vehicleId;
        },
        isFyusion360Computed: function () {
            return Boolean(
                (this.fyusionId && this.widgetOptions.isFyusion360Enable)
                && (this.widgetOptions.isVir360Enable !== this.widgetOptions.isFyusion360Enable),
            );
        },
        isVir360Computed: function () {
            return Boolean(this.vir360Id && this.widgetOptions.isVir360Enable);
        },
    },
    methods: {
        showFyusion360: function () {
            // eslint-disable-next-line
            this.fyusionPlayer.Fullscreen();
        },
        createFyusionPlayer: function () {
            this.fyusionPlayer = window.FYU.add(
                this.fyusionId,
                this.fyusionContainerIdComputed,
                this.fyusionPlayerParams,
            );
        },
    },
    created: function () {
        if (this.isFyusion360Computed) {
            this.createFyusionPlayer();
        }
    },
};
