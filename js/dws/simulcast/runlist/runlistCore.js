/* global jalert */

window.Runlist = window.Runlist || {};
window.Runlist.components = window.Runlist.components || {};

window.Runlist.RunListCore = function (params) {
    if (params.widgetOptions.isVir360Enable) {
        this.vir360Player = new window.Vir360ExternalButton({
            isMinimizeBtnHidden: true,
        });
    }

    this.init(params);
};

window.Runlist.RunListCore.prototype = {
    asyncComponentList: {
        videoBox: '/js/vue/vehicle-video/vehicleVideo.js',
        namaGradingContainer: '/js/vue-common-components/namaGrading/namaGradingContainer.js',
        stockwaveVehicleInfo: '/js/vue-common-components/stockwave/stockwaveVehicleInfo.js',
    },
    init: async function (params) {
        this.vueMixins = {
            isUserLoggedIn: params.isUserLoggedIn,
            widgetOptions: params.widgetOptions,
            simulcastSettings: params.simulcastSettings,
            widgetConstants: params.widgetConstants,
        };

        this.prepareAsyncComponents(params);

        Vue.mixin(new window.Runlist.Mixins(this.vueMixins));

        await this.initializeAsyncComponents();
        this.setLocalizationSettings(params.localization);
        this.addComponentsToVue();

        this.vm = new Vue(new window.Runlist.RunListMain(params));
        this.vm.$runListCore = this;

        if (params.allowMultipleDealers) {
            this.openDealersModal();
        }
    },
    addComponentsToVue: function () {
        var componentsNames = Object.keys(window.Runlist.components);

        Vue.component('popper', window.VuePopper);
        Vue.use(window.ScrollSync);

        componentsNames.forEach(function (name) {
            Vue.component(name, window.Runlist.components[name]);
        });
    },
    async prepareAsyncComponents(params) {
        if (params?.widgetOptions?.showNamaGrading) {
            this.vueMixins.namaGradingClient = await this.createNamaGradingClient();
        } else {
            delete this.asyncComponentList.namaGradingContainer;
        }

        if (!params?.widgetOptions?.stockwaveEnabled) {
            delete this.asyncComponentList.stockwaveVehicleInfo;
        }
    },
    /**
     * Dynamically imports and registers Vue components.
     *
     * @async
     * @function addAsyncComponents
     * @param {Object.<string, string>} components - An object where the keys are component names and
     * the values are URLs to import the components from.
     * @return {Promise<void>} A promise that resolves when all components have been imported and registered.
     * @throws {Error} Throws an error if any component fails to load or register.
     */
    async addAsyncComponents(components) {
        const importPromises = Object.entries(components)
            .map(async ([name, url]) => {
                const component = (await import(url)).default;

                window.Vue.component(name, component);
            });

        await Promise.all(importPromises);
    },

    /**
     * Initializes the asynchronous loading and registration of Vue components.
     *
     * @async
     * @function initializeAsyncComponents
     * @return {Promise<void>} A promise that resolves when all components have been loaded and registered successfully.
     * @throws {Error} Throws an error if any component fails to load or register.
     */
    async initializeAsyncComponents() {
        try {
            await this.addAsyncComponents(this.asyncComponentList);
        } catch (error) {
            const errorMessage = 'An error occurred while loading components: ' + error.message;

            if (this.logger.error) {
                this.logger.error(errorMessage);
            } else {
                throw new Error(errorMessage);
            }
        }
    },
    async createNamaGradingClient() {
        const api = (await import(System.addCacheBuster('/js/api/index.js')));
        const NamaGradingClientFactory
            = (await import(System.addCacheBuster(
                '/js/vue-common-components/namaGrading/namaGradingClient/NamaGradingClientFactory.js',
            ))).NamaGradingClientFactory;

        const initialVehicleIds = [];
        const gradingClientFactory = new NamaGradingClientFactory(initialVehicleIds, api.vehicles);
        const namaGradingClient = gradingClientFactory.createClient();

        return namaGradingClient;
    },
    setLocalizationSettings: function (localization) {
        window.Simulcast.data = window.Simulcast.data || {};
        window.Simulcast.data.settings = window.Simulcast.data.settings || {};
        window.Simulcast.data.settings.localization = localization;
    },
    openDealersModal: async function () {
        var forceDealerSelection = (await import(System.addCacheBuster(
            '/js/dws/dwsApi/simulcastDealers/forceDealerSelection.js',
        ))).default;

        forceDealerSelection.forceDealerSelect({
            container: 'modul-r-simulcast-runlist',
        });
    },
};
