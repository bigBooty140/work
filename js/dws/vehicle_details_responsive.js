/* global sessionStorage, mergeVehicleArray, statusOpen, statusRemove, BuyerToolsPanelResponsive, compareList, WatchList */

$(document).ready(function () {
    var $window = $(window),
        windowInnerWidth = window.innerWidth;

    $('.mdet-back').click(function() {
        if (document.referrer) {
            location.href = document.referrer;
            return false;
        }
    });

    if (
        $('.modul-r-details').length
        && $('#vehicle-notes').length
    ) {
        new Vue({
            el: '#vehicle-notes',
            components: {
                'vehicle-notes-btn': new VehicleNotesButton(),
            },
        });
    }

    /* Print Button */
    if (window.quotePrinterEnable) {
        $('.mdet-print').click(function() {
            $('#show_printModal').modal('show');
        });
    } else {
        $('.mdet-print').click(function() {
            var data = {
                oper: 'print_simple',
                format: 'html',
                vehicle: window.idVehicle,
                tpl: '000a'
            };

            data['auction_mode'] = $(this).data('auction_mode');
            data['show_price'] = $(this).data('show_price');

            var form = document.createElement('form');
            form.action = '/ajax';
            form.method = 'POST';
            form.target = '_blank';
            for (var key in data) {
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = data[key];
                form.appendChild(input);
            }
            form.style.display = 'none';
            document.body.appendChild(form);
            form.submit();
            form.parentNode.removeChild(form);
        });
    }

    if (typeof form_successful !== 'undefined' && form_successful) {
        form_successful();
    }

    $('.mdet-code').click(function() {
        try {
            var $me = $(this),
                $qrPopup = $(this).find('.popup-qr-code');

            /* tweak position only desktop (right-aligned) */
            if ($(window).width() >= $SESSIONDATA.data.layout.width[2]) {
                var minWidth = $me.parent().width() + $me.parent().position().left - $me.position().left;
                $qrPopup.css("min-width", minWidth + 15); //FIXME SOME DAY: hardcoded 15px (padding compensation)
            }
            $qrPopup.slideToggle(200);
        } catch (e) {
            console.error(e.message);
        }
    });

    /* Auction Marketplace */
    var $container = $('.modul-r-details');

    var $priceLoginBtn = $('[role="button"][data-price="wholesale"]', $container);
    $priceLoginBtn.click(function() {
        $(document).trigger('show_login.buyers_toolbar');
    });

    /* VIR button */
    var $conditionWidget = $('.module-vir-responsive');

    $container.find('.vir-btn a').on('click', function(e) {
        var target = $(this).data('target');

        if ('anchor' === target) {
            e.preventDefault();
            if ($conditionWidget.length) {
                location.hash = 'condition';
                $('html, body').animate({scrollTop: $conditionWidget.offset().top}, 1000);
            }
        }
    });

    $('.modul-r-details')
        .find('.cr-flags')
        .find('[data-toggle="tooltip"]')
        .tooltip();

    /* parse location hash on page load */
    $window.load(function() {
        if ('#condition' === location.hash && $conditionWidget.length) {
            $('html, body').animate({scrollTop: $conditionWidget.offset().top}, 1000);
        }
    });

    $window.on('resize', function() {
        if (windowInnerWidth >= $SESSIONDATA['sm_width']) {
            $container.find('.grid').masonry();
        }
    });
});

var VehicleDetailsWidget = function(params) {
    var self = this;

    $.each(params, function(key, value) {
        if ('undefined' !== typeof(self[key])) {
            self[key] = value;
        }
    });

    self.$container = $('#modul_r_details_' + ((params.uid) ? params.uid : ''));
    self.bindEvents();

    if (params.showLogisticsCost) {
        self.initLogisticsInfo(params.pickupZip);
    }

    if (params.usePrevNextButtons) {
        self.initPrevNexButtons();
    }

    if (params.showWatchButton) {
        self.initWatchList();
    }

    if (params.showNamaGrading) {
        this.initNamaGrading(this.vehicleId, params.licensePlate);
    }

    switch (true) {
        case params.isUkLayout:
            this.initSpecificationUk();
            break;

        case params.isAlternativeLayout:
            this.initSpecification('specificationAlt');
            break;

        default:
            this.initSpecification('specification');
            break;
    }
};

VehicleDetailsWidget.prototype = {
    $container: null,
    requestParams: {},
    widgetParams: {},
    vehicleId: '',
    usePrevNextButtons: false,
    showWatchButton: false,
    isAuthorized: false,
    auctionMode: 0,
    showPrice: 0,
    watchListText: {
        addWatch: 'Watch',
        removeWatch: 'Remove',
        saveText: 'Saving Vehicle...',
        removeText: 'Removing Vehicle...',
    },
    statistic: {},
    vehicleCookiesFlag: false,
    dayExpires: 365 * 5,
    watchListInstance: null,
    vue: null,
    wizardUrl: '',
    vehiclePrices: null,
    isShowPrice: false,
    isShowSeller: false,
    specificationLabels: null,
    simulcastFlagsArray: [],

    bindEvents: function() {
        var self = this;

        System.on('quickOffer.complete quickBuyNow.complete', function(data) {
            if (data.vehicleId == self.vehicleId) {
                if (data.response.reloadPage) {
                    $('.mp_modal').on('hidden.bs.modal', function() {
                        location.reload();
                    });
                } else {
                    self.reloadWidget();
                }
            }
        });
    },
    reloadWidget: function() {
        var self = this;

        $.ajax({
            url: '/ajax',
            type: 'post',
            dataType: 'json',
            data: {
                oper: 'get_widget',
                widget: 'vehicle_details',
                params: self.widgetParams,
                request_params: self.requestParams
            },
            success: function(data) {
                if (data && data.hasOwnProperty('html') && data.html) {
                    var $specifications = $($.trim(data.html)).find('div.specifications');
                    var $header = $($.trim(data.html)).find('div.panel-heading');

                    if ($specifications.length > 0) {
                        self.$container.find('.specifications').html($specifications.html());
                    }
                    if ($header.length > 0) {
                        self.$container.find('.panel-heading').html($header.html());
                    }
                }
            }
        });
    },
    initPrevNexButtons: function () {
        var self = this;
        var STORAGE_ITEM_KEYS = {
            listData: 'com.autoxloo.inventoryList',
            widgetParams: 'com.autoxloo.widgetParams',
            requestParams: 'com.autoxloo.requestParams',
            vehiclesPerPage: 'com.autoxloo.vehiclesPerPage',
        };
        var $parentBox = $('.prev-next-box');
        var $prevKey = $parentBox.find('.prev-vehicle');
        var $navCounter = $parentBox.find('.js-nav-counter');
        var $nextKey = $parentBox.find('.next-vehicle');
        var refererInventory = isRefererInventory();
        var vehicleId = Number(window.idVehicle);
        var listData;
        var widgetParams;
        var requestParams;
        var vehiclesPerPage;
        var currentListIndex;

        copyParamsFromLocalToSessionStorage();

        loadStorageParams(window.sessionStorage);

        if (!!listData) {
            try {
                listData = JSON.parse(listData);
            } catch (e) {
                console.error(e);
            }

            /* detect vehicle index in current list */
            $.each(listData, function (index, data) {
                if (data && data.id === vehicleId) {
                    currentListIndex = index;
                    return false;
                }
            });
        }

        if (currentListIndex !== undefined) {
            $navCounter.html(currentListIndex + 1 + ' / ' + listData.length);
            showPrevNextButtons();
        } else {
            $parentBox.hide();
            self.$container
                .find('.panel')
                .eq(0)
                .removeClass('no-margin-bottom');
        }

        /**
         * Load, decode and set needed params from specified type of storage
         * @param {Storage.constructor} storage One of storage types: localStorage or sessionStorage
         */
        function loadStorageParams(storage) {
            if (storage instanceof window.Storage) {
                listData = storage.getItem(STORAGE_ITEM_KEYS.listData);
                widgetParams = JSON.parse(storage.getItem(STORAGE_ITEM_KEYS.widgetParams));
                requestParams = JSON.parse(storage.getItem(STORAGE_ITEM_KEYS.requestParams));
                vehiclesPerPage = +storage.getItem(STORAGE_ITEM_KEYS.vehiclesPerPage);
            }
        }

        /**
         * Make copy of needed params from localStorage to sessionStorage
         */
        function copyParamsFromLocalToSessionStorage() {
            var key;

            if (refererInventory) {
                for (key in STORAGE_ITEM_KEYS) {
                    if (STORAGE_ITEM_KEYS.hasOwnProperty(key)) {
                        window.sessionStorage.setItem(
                            STORAGE_ITEM_KEYS[key],
                            window.localStorage.getItem(STORAGE_ITEM_KEYS[key])
                        );
                    }
                }
            }
        }

        /**
         * Check is page referer page with inventory widget.
         * @return {boolean}
         */
        function isRefererInventory() {
            var DEFAULT_INVENTORY_LINK_MARK = 'cars-for-sale';
            var storedInventoryLinkMark = window.localStorage.getItem('com.autoxloo.inventoryPath');
            var result = !!(
                document.referrer
                && (
                    ~document.referrer.indexOf(DEFAULT_INVENTORY_LINK_MARK)
                || ~document.referrer.indexOf(storedInventoryLinkMark)
                )
            );

            return result;
        }

        function showPrevNextButtons() {
            if (currentListIndex !== 0) {
                if (listData[currentListIndex - 1]) {
                    /* display PREV button */
                    $prevKey.attr('href', listData[currentListIndex - 1].vurl)
                        .removeClass('invisible');
                } else {
                    prepareParams('prev');
                    ajaxGetVehicles(requestParams, widgetParams, function (data) {
                        updateVehicleListButtons(data, requestParams.page);
                    });
                }
            }

            if (currentListIndex !== listData.length - 1) {
                if (listData[currentListIndex + 1]) {
                    /* display NEXT button */
                    $nextKey.attr('href', listData[currentListIndex + 1].vurl)
                        .removeClass('invisible');
                } else {
                    prepareParams('next');
                    ajaxGetVehicles(requestParams, widgetParams, function (data) {
                        updateVehicleListButtons(data, requestParams.page);
                    });
                }
            }
        }

        /**
         * Execute Ajax Request to the server - get the list of vehicles using current search query
         * @param {object} requestParams A set of parameters usually passed via url (filtering, sorting)
         * @param {object} widgetParams A set of widget's internal params (set in MAP2 widget settings)
         * @param {function} callback Callback function to execute when response is ready
         * */
        // TODO: use axWidgetLoader?
        function ajaxGetVehicles(requestParams, widgetParams, callback) {

            requestParams = requestParams || {};
            widgetParams = widgetParams || {};

            $.ajax(
                {
                    url: '/ajax',
                    type: 'post',
                    data: {
                        oper: 'get_widget',
                        widget: 'inventory_new',
                        request_params: requestParams, // vehicle_nav params (from url)
                        params: JSON.stringify($.extend(
                            widgetParams,
                            {
                                json_mode: 1,
                            }
                        )), // widget internal params
                    },
                    error: function (e) {
                        console.error(e);
                    },
                    success: function (response) {
                        if (typeof callback === 'function') {
                            callback(response);
                        }
                    },
                }
            );
        }

        function prepareParams(direction) {
            var nextPage;

            if (direction === 'prev') {
                nextPage = listData[currentListIndex].page - 1;
            }

            if (direction === 'next') {
                nextPage = listData[currentListIndex].page + 1;
            }

            requestParams = $.extend(
                requestParams,
                {
                    page: nextPage,
                }
            );
        }

        function updateVehicleListButtons(data, currentPage) {
            var firstArrayItemCounter = (currentPage - 1) * vehiclesPerPage;
            var includeData = JSON.parse(data.html);

            mergeVehicleArray(firstArrayItemCounter, listData, includeData);
            /* Update vehicle list in sessionStorage */
            sessionStorage.setItem('com.autoxloo.inventoryList', JSON.stringify(listData));
            showPrevNextButtons();
        }
    },
    initWatchList: function () {
        var self = this;
        var watchListParams = {
            vehicleId: self.vehicleId,
            watchListText: self.watchListText,
            watchListText: self.watchListText,
            isAuthorized: self.isAuthorized,
            statistic: self.statistic,
            auctionMode: self.auctionMode,
            showPrice: self.showPrice,
            vehicleCookiesFlag: self.vehicleCookiesFlag,
        };

        if (null === self.watchListInstance && typeof(WatchList) === 'function') {
            self.watchListInstance = new WatchList(watchListParams);
        }

        return self.watchListInstance;
    },

    /**
     * Init and get vehicle logistics information
     * @param {Number|String} pickupZip
     */
    initLogisticsInfo: function (pickupZip) {
        var self = this;

        $(function () {
            var $logistics = self.$container.find('.logistics');

            $.ajax({
                url: '/ajax',
                type: 'get',
                dataType: 'json',
                data: {
                    ajax_controller: 'Logistic/Rates',
                    oper: 'get_rate',
                    pickupZip: pickupZip,
                },
                success: function (data) {
                    if (data.success) {
                        $logistics.find('#rate').text(data.cost);
                        $logistics.find('#distance').text(data.distance);
                        $logistics.find('#pickup').text(data.pickup);
                        $logistics.find('#destination').text(data.destination);
                        $logistics.find('#logistics-info').toggleClass('invisible', false);
                    } else {
                        $logistics.find('#logistics-info')
                            .replaceWith('<span>' + window.logisticsErrorMessage + '</span>');
                    }
                },
                complete: function () {
                    $logistics.find('.fa-spinner').hide();
                },
            });
        });
    },

    initSpecificationUk: async function () {
        const Vue = await this.getVue();
        const specificationUk = (
            await import(System.addCacheBuster('/js/dws/vehicleDetails/specification/specificationUk.js'))
        ).default;
        const props = {
            vehicleId: this.vehicleId,
            widgetParams: this.widgetParams,
            wizardUrl: this.wizardUrl,
            vehiclePrices: this.vehiclePrices,
            isShowPrice: this.isShowPrice,
            isShowSeller: this.isShowSeller,
            labels: this.specificationLabels,
        };

        new Vue({
            el: '#specification-uk',
            render: (h) => h(specificationUk, {
                props,
            }),
        });
    },

    initSpecification: async function (layoutName) {
        const Vue = await this.getVue();
        const specification = (
            await import(System.addCacheBuster(`/js/dws/vehicleDetails/specification/${layoutName}.js`))
        ).default;
        const props = {
            vehicleId: this.vehicleId,
            widgetParams: this.widgetParams,
            wizardUrl: this.wizardUrl,
            vehiclePrices: this.vehiclePrices,
            isShowPrice: this.isShowPrice,
            isShowSeller: this.isShowSeller,
            labels: this.specificationLabels,
            simulcastFlagsArray: this.simulcastFlagsArray,
        };

        new Vue({
            el: '#specification',
            render: (h) => h(specification, {
                props,
            }),
        });
    },

    initNamaGrading: async function (vehicleId, regNo) {
        vehicleId = Number(vehicleId);

        const initialVehicleIds = [vehicleId];
        const Vue = await this.getVue();
        const namaGradingContainer = (
            await import(System.addCacheBuster('/js/vue-common-components/namaGrading/namaGradingContainer.js'))
        ).default;

        const api = (await import(System.addCacheBuster('/js/api/index.js')));
        const NamaGradingClientFactory
            = (await import(System.addCacheBuster(
                '/js/vue-common-components/namaGrading/namaGradingClient/NamaGradingClientFactory.js',
            ))).NamaGradingClientFactory;

        const gradingClientFactory = new NamaGradingClientFactory(initialVehicleIds, api.vehicles);
        const client = gradingClientFactory.createClient();

        const namaCrUriTemplate = this.widgetParams.namaCrUriTemplate;

        new Vue({
            el: '#nama-grading-1',
            render: (h) => h(namaGradingContainer, {
                props: {
                    vehicleId,
                    client,
                    namaCrUriTemplate,
                    regNo,
                },
            }),
        });

        new Vue({
            el: '#nama-grading-2',
            render: (h) => h(namaGradingContainer, {
                class: ['pull-right'],
                props: {
                    vehicleId,
                    client,
                    orientation: 'vertical',
                    namaCrUriTemplate,
                    regNo,
                },
            }),
        });

        new Vue({
            el: '#nama-grading-3',
            render: (h) => h(namaGradingContainer, {
                class: ['pull-right'],
                props: {
                    vehicleId,
                    client,
                    orientation: 'vertical',
                    namaCrUriTemplate,
                    regNo,
                },
            }),
        });
    },

    getVue: async function () {
        if (this.vue) {
            return this.vue;
        }

        const isDevMode = typeof window.isDevMode === 'function' && window.isDevMode();
        this.vue = (
            isDevMode
                ? await import('/js/vue/vue2-esm/vue.esm.browser.js')
                : await import('/js/vue/vue2-esm/vue.esm.browser.min.js')
        ).default;

        return this.vue;
    },
};

function add_vehicle_to_favorites(vehicle_id) {
    favorite_vehicles = $.cookie('favorite_vehicles');
    if (!favorite_vehicles)
        favorite_vehicles = new Array();
    else
        favorite_vehicles = favorite_vehicles.split(',');
    var flag = true;
    for (i in favorite_vehicles)
        if (favorite_vehicles[i] == vehicle_id.toString())
            flag = false;
    if (flag)
        favorite_vehicles.push(vehicle_id);
    url = document.location.pathname.substr(1);
    $.cookie('favorite_vehicles', favorite_vehicles);
    document.location = '__redirect_' + url;
}

if (typeof window.optionIcons !== 'object') {
    window.optionIcons = {};
}

window.optionIcons.rebuildInterval = '';

window.optionIcons.rebuildIconDetails = function () {
    var $optListBorder = $('.option_list_border');
    var filterClass = 'cell_options';
    var alternativeIcons = window.optionIcons.optionEnabled;

    if (alternativeIcons) {
        filterClass = 'option-icon-wrap';
    }

    clearTimeout(window.optionIcons.rebuildInterval);
    window.optionIcons.rebuildInterval = setTimeout(function () {
        var maxWidth = $optListBorder.width();

        if (maxWidth === 0) {
            maxWidth = $optListBorder.parents('fieldset').width();
        }

        $optListBorder.children('.mdet_separator').remove();

        var $items = $optListBorder.children('div').removeClass('margin-left');
        var lineWidth = 0;

        $items.each(function () {
            var $this = $(this);
            var $thisWidth = $this.outerWidth(true);

            lineWidth += $thisWidth;

            if (lineWidth > maxWidth) {
                lineWidth = $thisWidth;
                $this
                    .filter('.' + filterClass)
                    .addClass(($this.prev('.' + filterClass).length) ? 'margin-left' : '')
                    .each(function () {
                        lineWidth += 38;
                        $this
                            .prevAll('.' + filterClass)
                            .eq(0)
                            .after('<span class="mdet_separator list-group-item"></span>');
                    });
            }
        });
    }, 100);
};

$(window).bind('load resize', window.optionIcons.rebuildIconDetails);
