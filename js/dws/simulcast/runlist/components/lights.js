window.Runlist.components.lights = {
    template: '#component-lights',
    props: {
        lightData: String,
    },
    computed: {
        lightsComputed: function () {
            const lights = {
                g: 'green-light',
                y: 'yellow-light',
                r: 'red-light',
                b: 'blue-light',
                w: 'white-light',
            };
            const lightList = this.lightData.toLowerCase().split('');

            return lightList.map((item) => {
                return lights[item];
            });
        },
    },
};
