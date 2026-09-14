window.Runlist.components.vehicleImage = {
    template: '#component-vehicle-image',
    props: {
        src: {
            type: String,
            default: '/images/no_photo_w170.jpg',
        },
        title: String,
        lazyLoading: Boolean,
    },
    data: function () {
        return {
            imageLoaded: false,
        };
    },
    methods: {
        loadHandler: function () {
            this.imageLoaded = true;
        },
    },
};
