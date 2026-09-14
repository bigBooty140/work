class InventoryNewResponsive {
    constructor(params) {
        this.uid = '';
        this.$container = null;
        this.widgetParams = {};
        this.ajaxMode = false;
        this.url ='';
        this.page = 1;
        this.sortBy = 'make';
        this.sortOrder = 'asc';
        this.pageId = '';
        this.requestParams = {};
        this.showNamaGrading = false;
        this.namaCrUriTemplate = '';
        this.isShowGrading = true;
        this.vehiclesIds = [];
        this.isMobile = false;

        this.initParams(params)

        if (params.vehiclesList) {
            this.vehiclesIds = params.vehiclesList.map((vehicle) => Number(vehicle.vehicle_id));
        }

        this.$container = $('.inventory_md_' + params.uid);

        if (this.ajaxMode) {
            this.initAjaxMode();
        } else {
            this.initPage();
        }

        this.bindEvents()
    }

    initParams(params) {
        Object.keys(params).forEach((key) => {
            if (key in this) {
                this[key] = params[key];
            }
        });
    }

    bindEvents() {
        const self = this;

        System.on('quickOffer.complete quickBuyNow.complete', function(data) {
            arrayVehiclesInventory.forEach(function(item, i, arr) {
                if (item && item.id && item.id == data.vehicleId && item.vin) {
                    self.reloadVehicle(item.vin, item.id);
                }
            });
        });
    }

    initPage() {
        /* mobile sorting */
        if (!this.ajaxMode) {
            $('.sort-select select', this.$container).change(function () {
                location.href = $(this).val();
            });
        }

        // make phones clickable on mobile devices
        if (this.isMobile) {
            $('.phone_number', this.$container).each(function() {
                const phone = $(this).text().replace(/[^\d]/g, '');

                $(this).wrap($('<a>').attr('href', 'tel:' + phone));
            });
        }

        new ModalWidgets({
            wrapperClass: 'vehicle-wrapper'
        });

        if (this.isShowGrading && this.showNamaGrading) {
            this.initNamaGrading();
        }
    }

    initAjaxMode() {
        const self = this;
        const $captchaForm = $('div.main-captcha-place:first').find('form');

        // pagination
        this.$container.on('click', '.pagination a[data-page]', function(e) {
            e.preventDefault();

            self.page = parseInt($(this).data('page')) || 1;
            self.url = $(this).attr('href');

            self.loadPage();
        });

        // desktop sorting
        this.$container.on('click', 'a[data-sort-by]', function(e) {
            e.preventDefault();
            self.sortBy = $(this).data('sort-by');
            self.sortOrder = $(this).data('order');
            self.url = $(this).attr('href');

            self.loadPage();
        });

        // mobile sorting
        this.$container.on('change', '.sort-wrapper select', function() {
            const $selected = $(this).find(':selected');

            self.sortBy = $selected.data('sort-by');
            self.sortOrder = $selected.data('order');
            self.url = $(this).val();

            self.loadPage();
        });

        // back/forward navigation
        window.onpopstate = function(e) {
            self.$container.html(e.state.htmlContent);
            self.initPage();
            self.scrollToTop();
        };

        // move container with rendered captcha
        self.$container.find('.main-captcha-place').appendTo('body');

        if (!$.data($captchaForm, 'validator')) {
            $captchaForm.validate({
                    rules: {capcha_catcher_input: {required: true}},
                    messages: {capcha_catcher_input: {required: ''}}
                }
            );
        }

        this.loadPage(true);
    }

    loadPage(initial) {
        const self = this;

        initial = initial || false;

        $.extend(this.requestParams, {
            'page': this.page,
            'sort': this.sortBy,
            'sortord': this.sortOrder
        });

        this.widgetParams['ajax_loading_vehicles'] = 0;

        window.statusOpen('Loading...', 0);

        $.ajax({
            url: '/ajax',
            type: 'post',
            dataType: 'json',
            data: {
                oper: 'get_widget',
                widget: 'inventory_new',
                preview: 0,
                params: this.widgetParams,
                dws_page_id: this.pageId,
                request_params: this.requestParams
            },
            success: function(data) {
                const html = $(data.html).filter('.modul-r-inventoryMD').html();

                self.$container.html(html);

                try {
                    const state = {requestParams: self.requestParams, htmlContent: html};

                    if (initial) {
                        window.history.replaceState(state, '', location.href);
                    } else {
                        window.history.pushState(state, '', self.url);
                    }
                } catch (e) {}

                self.initPage();

                if (!initial) {
                    self.scrollToTop();
                }
            },
            complete: function() {
                statusRemove();
            }
        });
    }

    reloadVehicle(vin, vid) {
        const self = this;

        this.widgetParams['ajax_loading_vehicles'] = 0;
        this.widgetParams['template'] = 'responsive';

        $.ajax({
            url: '/ajax',
            type: 'post',
            dataType: 'json',
            data: {
                oper: 'get_widget',
                widget: 'inventory_new',
                preview: 0,
                params: this.widgetParams,
                dws_page_id: this.pageId,
                request_params: {'vin': vin}
            },
            success: function(data) {
                if (data && data.hasOwnProperty('html') && data.html) {
                    const html = $(data.html).filter('.modul-r-inventoryMD').html();

                    self.$container.find('.vehicle-wrapper[data-id="' + parseInt(vid) + '"] .priceWrap').html(
                        $(html).find('.priceWrap').html()
                    );
                }
            },
            complete: function() {
                statusRemove();
            }
        });
    }

    scrollToTop() {
        const scrollTo = this.$container.offset().top;

        $('html, body').animate({scrollTop: scrollTo}, 500);
    }

    async initNamaGrading() {
        const initialVehicleIds = [...this.vehiclesIds];
        const Vue = (await import('/js/vue/vue2-esm/vue.esm.browser.js')).default;
        const namaGradingContainer = (
            await import(System.addCacheBuster('/js/vue-common-components/namaGrading/namaGradingContainer.js'))
        ).default;

        const api = (await import('/js/api/index.js'));
        const NamaGradingClientFactory
            = (await import(System.addCacheBuster(
            '/js/vue-common-components/namaGrading/namaGradingClient/NamaGradingClientFactory.js',
        ))).NamaGradingClientFactory;

        const gradingClientFactory = new NamaGradingClientFactory([...initialVehicleIds], api.vehicles);
        const client = gradingClientFactory.createClient();

        const namaCrUriTemplate = this.namaCrUriTemplate;
        const orientation = this.widgetParams.layout === 'responsive_compact_plus'
            ? 'vertical'
            : 'horizontal';
        const classes = [];

        if (this.widgetParams.layout === 'responsive') {
            classes.push('btn btn-sm');
        }

        initialVehicleIds.forEach((vehicleId) => {
            const elements = [`#nama-grading-${vehicleId}`];

            if (this.widgetParams.layout === 'responsive_compact') {
                elements.push(`#nama-grading-${vehicleId}-second`);
            }

            elements.forEach((el) => new Vue({
                el,
                render: (h) => h(namaGradingContainer, {
                    class: classes,
                    props: {
                        vehicleId,
                        client,
                        orientation,
                        namaCrUriTemplate,
                    },
                }),
            }));
        });
    }
}

function invNewBuildMagnific(imgArray) {
    const itemArray = [];

    for (var i=0; i < imgArray[1]; i++) {
        itemArray.push({src: `/image/${imgArray[0]}_${i}.jpg`})
    }

    $.magnificPopup.open({
        closeOnContentClick: false,
        closeBtnInside: false,
        items: itemArray,
        gallery: {
            enabled: true,
            arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"><span class="fa fa-chevron-%dir%"></span></button>',
        },
        zoom: {
            enabled: false
        },
        type: 'image' /* this is default type */
    });
}
