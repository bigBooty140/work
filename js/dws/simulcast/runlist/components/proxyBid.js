window.Runlist.components.proxyBid = {
    template: '#component-proxy-bid',
    props: {
        transport: Object,
        vehicleState: Object,
        simulcastParams: Object,
    },
    data: function () {
        return {
            proxyBid: 0,
            isLoading: false,
            selectBadge: {
                id: null,
                name: null,
            },
            showDropBox: false,
        };
    },
    created: function () {
        var self = this;

        if (this.hasBadgesComputed) {
            this.selectBadge = this.userActiveBadgesComputed[0];
        }

        this.eventBus.$on(this.constants.EVENT_CLOSE_PROXY_POPOVER, function () {
            self.showDropBox = false;
        });
    },
    watch: {
        userActiveBadgesComputed: {
            handler: function () {
                if (this.hasBadgesComputed) {
                    this.selectBadge = this.userActiveBadgesComputed[0];
                }
            },
            deep: true,
        },
        hasCurrentProxyBidComputed: function (hasProxyBid) {
            if (!hasProxyBid) {
                this.proxyBid = 0;
            }
        },
        'selectBadge.id': function () {
            this.proxyBid = this.hasCurrentProxyBidComputed
                ? this.currentProxyBidComputed.amount + this.currentProxyBidComputed.bidIncrement
                : 0;
        },
    },
    computed: {
        simulcastUserIdComputed: function () {
            return this.simulcastParams.user && this.simulcastParams.user.id;
        },

        isMobileListModeComputed: function () {
            return (
                this.widgetOptions.isMobile
                && (this.widgetOptions.widgetLayout === this.constants.WIDGET_LAYOUT_DEFAULT
                    || this.widgetOptions.widgetLayout === this.constants.WIDGET_LAYOUT_DEFAULT_PLUS_STOCKWAVE)
                && this.widgetOptions.viewMode === this.constants.VIEW_MODE_COMPACT
                && this.widgetOptions.mobileLayout === this.constants.MOBILE_LAYOUT_LIST
            );
        },
        userBadgesComputed: function () {
            return this.simulcastParams.userBadges.filter(function (badge) {
                return badge.selected;
            });
        },
        userActiveBadgesComputed: function () {
            var self = this;
            var userActiveBadges = [];

            if (Array.isArray(this.userBadgesComputed) && this.vehicleState) {
                userActiveBadges = this.userBadgesComputed.filter(function (badge) {
                    return Number(badge.id) !== Number(self.vehicleState.sellerId);
                });
            }

            return userActiveBadges;
        },
        proxyDisabledComputed: function () {
            return !this.vehicleState
                || !this.simulcastUserIdComputed
                || this.simulcastUserIdComputed === this.vehicleState.sellerId
                || this.isVehicleSoldComputed
                || !this.hasBadgesComputed;
        },

        hasBadgesComputed: function () {
            return Boolean(this.userActiveBadgesComputed.length);
        },

        isVehicleSoldComputed: function () {
            return this.vehicleState
                && this.simulcastParams.constants
                && (
                    this.vehicleState.status === this.simulcastParams.constants.model.vehicle.STATUS_SOLD
                    || this.vehicleState.status === this.simulcastParams.constants.model.vehicle.STATUS_IF_SALE
                    || this.vehicleState.status === this.simulcastParams.constants.model.vehicle.STATUS_NO_SALE
                );
        },
        currentProxyBidComputed: function () {
            return this.vehicleState
                && this.vehicleState.currentProxy
                && this.vehicleState.currentProxy[this.selectBadge.id];
        },
        badgeNameComputed: function () {
            var result = '';

            if (Object.keys(this.selectBadge).length) {
                result = this.selectBadge.name;
            } else {
                if (this.hasBadgesComputed) {
                    result = this.userActiveBadgesComputed[0].name;
                }
            }

            return result;
        },
        hasCurrentProxyBidComputed: function () {
            return Boolean(this.currentProxyBidComputed && this.currentProxyBidComputed.amount > 0);
        },
        hasProxyBidsComputed: function () {
            var currentProxyBids = this.vehicleState && this.vehicleState.currentProxy;
            var dealers;

            if (
                !currentProxyBids
                || (Array.isArray(currentProxyBids) && !currentProxyBids.length)
            ) {
                return false;
            }

            dealers = Object.keys(currentProxyBids);

            return dealers.some(function (dealer) {
                return currentProxyBids[dealer].amount > 0;
            });
        },
        proxyBidButtonClassesComputed: function () {
            return {
                'btn-warning': this.hasProxyBidsComputed,
                'btn-default': !this.hasProxyBidsComputed,
                disabled: this.proxyDisabledComputed,
            };
        },
        proxyBidLabelComputed: function () {
            return this.hasProxyBidsComputed
                ? 'Change Proxy Bid'
                : 'Set Proxy Bid';
        },
        setProxyBidDisabled: function () {
            return this.hasCurrentProxyBidComputed && this.proxyBid <= this.currentProxyBidComputed.amount;
        },
        dropdownMenuPositionClass: function () {
            return this.isMobileListModeComputed
                ? 'dropdown-menu-left'
                : 'dropdown-menu-right';
        },
    },
    methods: {
        showProxyModal: function () {
            if (!this.showDropBox) {
                if (this.currentProxyBidComputed) {
                    this.proxyBid
                        = this.currentProxyBidComputed.amount + this.currentProxyBidComputed.bidIncrement;
                }

                this.eventBus.$emit(this.constants.EVENT_CLOSE_PROXY_POPOVER);
                this.showDropBox = true;
            } else {
                this.showDropBox = false;
            }
        },
        closeModal: function () {
            this.showDropBox = false;
            this.isLoading = false;
        },
        setBadge: function (item) {
            this.selectBadge = item;
        },
        setProxyBid: function () {
            var self = this;
            var afterProxySet = function () {
                self.isLoading = false;
                self.dropBoxClose();
            };

            if (this.proxyDisabledComputed) {
                return;
            }

            this.isLoading = true;

            this.transport.send(
                'bidding.proxySet',
                {
                    runId: this.vehicleState.id,
                    dealerId: this.selectBadge.id,
                    amount: this.proxyBid,
                },
                afterProxySet,
            );
        },
        dropBoxClose: function () {
            this.showDropBox = false;
        },
        deleteProxyBid: function () {
            this.proxyBid = 0;
            this.setProxyBid();
        },
        getBadgeProxyBidAmount: function (dealerId) {
            return this.vehicleState
                && this.vehicleState.currentProxy
                && this.vehicleState.currentProxy[dealerId]
                && this.vehicleState.currentProxy[dealerId].amount;
        },
    },
};
