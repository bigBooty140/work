window.Runlist.components.watchStar = {
    template: '#component-watch-star',
    props: {
        vehicleId: [String, Number],
        transport: Object,
        watchlist: Array,
    },
    data: function () {
        return {
            loading: false,
        };
    },
    computed: {
        isInWatchlist: function () {
            return Boolean(
                this.watchlist
                && this.watchlist.length
                && this.watchlist.indexOf(Number(this.vehicleId)) > -1,
            );
        },
        watchStatusClassComputed: function () {
            return this.isInWatchlist ? 'star-active' : 'star-unactive';
        },
    },
    methods: {
        watchToggle: function () {
            var eventType = (this.isInWatchlist) ? 'user.unwatch' : 'user.watch';

            this.setLoadingOn();

            this.transport.send(
                eventType,
                {vehicleId: this.vehicleId},
                this.setLoadingOff,
            );
        },
        setLoadingOn: function () {
            this.loading = true;
        },
        setLoadingOff: function () {
            this.loading = false;
        },
    },
};
