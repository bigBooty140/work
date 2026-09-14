const compactLayout = (await import(System.addCacheBuster('./components/compact/compactLayout.js'))).default;
const advancedLayout = (await import(System.addCacheBuster('./components/advanced/advancedLayout.js'))).default;
const groupLayout = (await import(System.addCacheBuster('./components/group/groupLayout.js'))).default;
const calendarHeader = (await import(System.addCacheBuster('./components/calendarHeader.js'))).default;

const template = `
<div>
    <calendarHeader
        :filterDates="filterDates"
        :selectedDate="selectedDate"
        :isShowPrintButton="widgetParams.options.isShowPrintButton"
    />
    <compactLayout
        v-if="layout === 'compact'"
        :calendarData="calendarData"
        :colorTheme="widgetParams.colorTheme"
        :showEventDescription="widgetParams.options.showEventDescription"
        :showVehicleCount="widgetParams.options.showVehicleCount"
        :showEventTime="showEventTime"
    />
    <advancedLayout
        v-if="layout === 'advanced'"
        :calendarData="calendarData"
        :colorTheme="widgetParams.colorTheme"
        :showEventDescription="widgetParams.options.showEventDescription"
        :noVehicleMessageHtml="noVehicleMessageHtml"
        :showDealerList="widgetParams.options.showDealerList"
        :showVehicleCount="widgetParams.options.showVehicleCount"
        :showEventTime="showEventTime"
        :isAuthUser="isAuthUser"
        :fieldsNaming="fieldsNaming"
        :isAlternativeWording="isAlternativeWording"
        :sellerNameToShow="sellerNameToShow"
        :widgetConstants="widgetConstants"
    />
    <groupLayout
        v-if="layout === 'group'"
        :calendarData="calendarData"
        :options="widgetParams.options"
        :fieldsNaming="fieldsNaming"
    />
</div>
`;

export default {
    name: 'simulcastCalendar',
    template,
    components: {
        compactLayout,
        advancedLayout,
        groupLayout,
        calendarHeader,
    },
    props: {
        widgetParams: {
            type: Object,
            required: true,
        },
        calendarData: {
            type: Array,
            required: true,
        },
        selectedDate: String,
        filterDates: Object,
        showEventTime: Boolean,
        noVehicleMessageHtml: String,
        isAuthUser: Boolean,
        allowMultipleDealers: Boolean,
        isAlternativeWording: Boolean,
        fieldsNaming: Object,
        sellerNameToShow: String,
        widgetConstants: Object,
    },
    computed: {
        layout() {
            return this.widgetParams.layout;
        },
    },
    methods: {
        async forceDealerSelect() {
            if (this.allowMultipleDealers && this.isAuthUser) {
                const forceDealerSelection = (await import(
                    System.addCacheBuster('/js/dws/dwsApi/simulcastDealers/forceDealerSelection.js')
                )).default;

                await forceDealerSelection.forceDealerSelect({
                    container: 'modul-r-simulcast-calendar',
                });
            }
        },
    },
    mounted() {
        this.forceDealerSelect();
    },
};
