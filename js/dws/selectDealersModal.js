import * as dwsApi from './dwsApi/index.js';

const template = `
    <div class="modal fade"
        :class="isOpenModal ? 'in' : ''"
        :style="isOpenModal ? 'display: block;' : ''"
        ref="selectDealersModal"
        id="selectDealersModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="selectDealersModalLabel"
        aria-hidden="false"
    >
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title"
                        id="selectDealersModalLabel"
                    >
                        Select Accounts to Bid with Today
                    </h5>
                </div>
                <div v-if="isInProgress.getDealers"
                    class="modal-body select-dealers-modal text-center"
                >
                    <i class="fa fa-spinner fa-pulse"></i>
                </div>
                <div v-else
                    class="modal-body select-dealers-modal"
                    style="max-height: 50vh; overflow-y: auto;"
                >
                    <div class="checkbox">
                        <label class="form-check-label">
                            <input v-model="allDealersSelectedComputed"
                                class="form-check-input"
                                type="checkbox"
                            >
                            Select all
                        </label>
                    </div>
                    <div v-for="dealer in dealersListComputed"
                        :key="dealer.id"
                        class="form-check checkbox"
                    >
                        <label class="form-check-label">
                            <input v-model="dealer.selected"
                                class="form-check-input dealer-checkbox"
                                type="checkbox"
                                :value="dealer.id"
                            >
                            {{ dealer.name }}
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger center-block"
                        :disabled="buttonDisabledComputed"
                        @click="saveDealers"
                    >
                        Continue
                    </button>
                </div>
            </div>
        </div>
    </div>
`;

export default {
    name: 'SelectDealersModal',
    template: template,
    data() {
        return {
            allDealers: [],
            isInProgress: {
                getDealers: false,
                saveDealers: false,
            },
        };
    },
    props: {
        isOpenModal: {
            type: Boolean,
            default: false,
        },
        allDealersList: {
            type: Array,
        },
        token: {
            type: String,
        },
        uuid: {
            type: String,
        },
        sessionId: {
            type: String,
        },
    },
    computed: {
        dealersListComputed() {
            return this.allDealers || [];
        },
        buttonDisabledComputed() {
            return this.isInProgress.saveDealers || this.isInProgress.getDealers;
        },
        allDealersSelectedComputed: {
            get() {
                return this.dealersListComputed.length === this.dealersListComputed
                    .filter((item) => item.selected).length;
            },
            set(value) {
                this.allDealers.forEach((dealer) => {
                    dealer.selected = value;
                });
            },
        },
    },
    methods: {
        async getSelectedDealers() {
            try {
                this.isInProgress.getDealers = true;

                this.allDealers = this.allDealersList || await dwsApi.simulcastDealers.getSelectedDealers({
                    token: this.token,
                    uuid: this.uuid,
                    sessionId: this.sessionId,
                });
            } catch (error) {
                this.showErrorAlert(error);
            }

            this.isInProgress.getDealers = false;
        },
        async saveDealers() {
            if (!this.dealersListComputed.filter((dealer) => dealer.selected).length) {
                if (window.DashboardAppJsInterface && typeof window.DashboardAppJsInterface.click === 'function') {
                    window.DashboardAppJsInterface.click('notSelected', '');
                } else {
                    window.jalert('Please, select at least one account to continue.', 'error', 3000);
                }

                return;
            }

            const savedDealers = this.dealersListComputed
                .filter((dealer) => dealer.selected)
                .map((dealer) => dealer.id);

            this.isInProgress.saveDealers = true;

            try {
                await dwsApi.simulcastDealers.saveSelectedDealers({
                    dealers: savedDealers,
                    token: this.token,
                    uuid: this.uuid,
                    sessionId: this.sessionId,
                });
            } catch (error) {
                this.showErrorAlert(error);
            }

            this.isInProgress.saveDealers = false;

            if (window.System && typeof window.System.trigger === 'function') {
                window.System.trigger('selectedDealersUpdated');
            }

            localStorage.removeItem('isDealersSelected');

            if (window.DashboardAppJsInterface && typeof window.DashboardAppJsInterface.click === 'function') {
                window.DashboardAppJsInterface.click('agreementCancel', '');
            }
        },
        showErrorAlert: function (error) {
            window.jalert(error, 'error');
        },
    },
    mounted() {
        this.getSelectedDealers();
    },
};
