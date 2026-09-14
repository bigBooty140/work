/* global System */

/**
 * Be careful when changing this file, because it is being used
 * in Inventory Plus (Inventory List, Inventory List MD, Inventory List MD2,
 * Inventory Builder is coming) (settings "Background Loading of Vehicles")
 *
 * @param params
 * @constructor
 */

var InventoryCommonAjax = function (params) {
    var self = this;
    $.each(params, function (key, value) {
        if ('undefined' !== typeof(self[key])) {
            self[key] = value;
        }
    });

    self.loaderShow.loaderInit();

    self.$container = $(params.container);

    self.initAjaxMode();

    self.bindEvents();
};

InventoryCommonAjax.prototype = {
    $container: null,
    widgetParams: {},
    loadedContainer: '',
    page: 1,
    sortBy: 'make',
    sortOrder: 'asc',
    url: '',
    pageId: '',
    requestParams: {},
    enableModalWidgets: false,
    showOptions: 'no',
    altOptionsEnabled: false,
    preloadImages: true,
    loaderShow: {
        hide: $.noop,
        show: $.noop,
        loaderInit: $.noop,
    },

    bindEvents: function () {
        var self = this;

        // listen if some widget on page wants to know there's an ajax inventory available
        System.on('inventory_ajax_ping', function (pong) {
            // yeah, there is one
            if (typeof pong === 'function') {
                pong();
            }
        });

        // Listen to SEARCH widgets
        System.on('search.go', function (params) {
            params = params || {};

            // update current request params
            self.requestParams = $.extend(true, {}, (params.filters || {}));

            // update current sorting settings
            self.sortBy = self.requestParams.sort;
            self.sortOrder = self.requestParams.sortord;

            // update my current URL setting if sent
            self.url = params.url || self.url;

            // reload page with new filters
            self.loadPage(0, 0, self.requestParams);
        });

        System.on('quickOffer.complete quickBuyNow.complete', function (data) {
            arrayVehiclesInventory.forEach(function (item) {
                if (item && item.id && String(item.id) === String(data.vehicleId) && item.vin) {
                    self.reloadVehicle(item.vin, item.id);
                }
            });
        });

        System.on('vehicle_auction_live.vehicle.time_elapsed', function () {
            self.loadPage(0, true);
        });

        $('body').on('click', '#modal-widgets-modal', function (event) {
            var isModal = $('.modal-content', this).has(event.target).length;
            var isCloseBtn = $(event.target).closest('.close', this).length;

            if (!isModal || isCloseBtn) {
                $(this).modal('hide');
            }
        });
    },

    initPage: function () {
        var self = this;
        var $priceLoginBtn;
        var $images = $('.vehicle-img', self.$container);
        var amount = $images.length;

        self.loaderShow.loaderInit();

        /* make phones clickable on mobile devices */
        if ($('body').is('.mobile')) {
            $('.phone_number', self.$container).each(function () {
                var phone = $(this).text()
                    .replace(/[^\d]/g, '');

                $(this).wrap($('<a>').attr('href', 'tel:' + phone));
            });
        }

        /* Auction Marketplace */
        $priceLoginBtn = $('[role="button"][data-price="wholesale"]', self.$container);
        $priceLoginBtn
            .off('click.show_buyers_toolbar')
            .on('click.show_buyers_toolbar', function () {
                $(document).trigger('show_login.buyers_toolbar');
            });

        /*  Make images show up smoothly */
        if (self.preloadImages) {
            $images.one('load', function () {
                $(this).parent('.vehicle-img-wrapper')
                    .removeClass('is-loading');
            });
        }
        if (self.showOptions === 'yes') {
            $images.each(function (i, img) { // loop over images
                img.onload = function () { // bind the listener
                    amount--; // ok one item was loaded, we decrease the amount

                    if (amount === 0) { // if amount is equal to 0, it means the images are loaded
                        if (self.altOptionsEnabled) {
                            var link = document.createElement('link');

                            link.rel = 'stylesheet';
                            link.href = '/css/dws/shared/vector_option_icons.css';
                            document.head.appendChild(link);
                        }

                        self.$container.find('.option_list-nw').fadeIn();
                    }
                };
            });
        }

        if (self.enableModalWidgets === true) {
            new ModalWidgets({
                wrapperClass: 'vehicle-wrapper',
            });
        }
    },

    initAjaxMode: function () {
        var self = this,
            $captchaForm;

        /* pagination on desktop */
        self.$container.on('click', '.pagination a[data-page], .pagination li.disabled a', function (e) {
            var $this = $(this);

            if (!$this.closest('li').hasClass('disabled')) {
                self.page = parseInt($this.data('page')) || 1;
                self.url = $this.attr('href');

                self.loadPage();
            }
            e.preventDefault();
        });

        /* pagination on mobile devices */
        self.$container.on('click', '.pager a, .pager li.disabled a', function (e) {
            var $this = $(this);

            if (!$this.closest('li').hasClass('disabled')) {
                self.page = parseInt($this.data('page')) || 1;
                self.url = $this.attr('href');

                self.loadPage();
            }
            e.preventDefault();
        });

        /* desktop sorting */
        self.$container.on('click', 'a[data-sort-by], a[data-sort-by].disabled', function (e) {
            var $this = $(this);

            if (!$this.closest('li').hasClass('disabled')) {
                self.sortBy = $this.data('sort-by');
                self.sortOrder = $this.data('order');
                self.url = $this.attr('href');

                self.loadPage();
            }
            e.preventDefault();
        });

        /* mobile sorting */
        self.$container.on('change', '.sort-select-wrapper select', function(e) {
            var $this = $(this),
                $selected = $this.find(':selected');

            e.preventDefault();

            self.sortBy = $selected.data('sort-by');
            self.sortOrder = $selected.data('order');
            self.url = $this.val();

            self.loadPage();
        });

        /* back/forward navigation */
        window.onpopstate = function (e) {
            self.$container.html(e.state.htmlContent);
            setTimeout(function () {
                self.cleanUpData();
                $.globalEval(e.state.inlineScripts);
                System.trigger('inventory_ajax_complete', e.state.requestParams);
            }, 1);
            self.initPage();
        };

        /* move container with rendered captcha */
        self.$container.find('.main-captcha-place').appendTo('body');

        $captchaForm = $('div.main-captcha-place:first').find('form');

        if (!$.data($captchaForm, 'validator')) {
            $captchaForm.validate({
                rules: {capcha_catcher_input: {required: true}},
                messages: {capcha_catcher_input: {required: ''}}
            });
        }

        self.loadPage(true);
    },

    cleanUpData: function () {
        if(window.arrayVehiclesInventory) {
            window.arrayVehiclesInventory = [];
        }
    },

    loadPage: function (initial, silent, customParams) {
        var self = this,
            $sortBtn = self.$container.find('.sort-group-wrapper').find('.btn'),
            $sortLabel = self.$container.find('.sort-group-wrapper').find('label'),
            $pagination = self.$container.find('.pagination').find('li'),
            $pager = self.$container.find('.pager').find('li'),
            $ajaxReloadDisabled = self.$container.find('.ajax-reload-disabled'),
            $sortSelect = self.$container.find('.sort-select-wrapper').find('select'),
            widgetParams;


        initial = initial || false;

        $.extend(self.requestParams, {
            'page': self.page || 1,
            'sort': self.sortBy,
            'sortord': self.sortOrder,
        });

        self.widgetParams['ajax_loading_vehicles'] = 0;

        try {
            widgetParams = JSON.stringify(self.widgetParams);
        } catch (e) {
        }

        self.loaderShow.show(silent);

        /* Disable sort buttons and pagination when widget is loading */
        $sortBtn.add($ajaxReloadDisabled)
            .addClass('disabled')
            .attr('disabled', 'disabled');
        // We need to add .attr 'disabled' because in some bootstrap styles (e.g 'Spacelab')
        // buttons are still clickable in spite of "disabled" design

        $sortSelect.attr('disabled', 'disabled');
        $sortLabel.addClass('text-muted');
        $pager.add($pagination)
            .addClass('disabled');

        /* move container with rendered captcha */
        self.$container.find('.main-captcha-place')
            .appendTo('body');

        $.ajax({
            url: '/ajax',
            type: 'post',
            dataType: 'json',
            data: {
                oper: 'get_widget',
                widget: self.widgetParams['widgetId'],
                preview: 0,
                params: widgetParams,
                dws_page_id: self.pageId,
                request_params: customParams
                    ? $.extend({}, self.requestParams, customParams)
                    : self.requestParams,
            },
            success: function (data) {
                var inlineScripts = [];
                var html = data.html;
                var div = document.createElement('div');
                var scriptPosition = 0;
                var scripts;
                var scriptsLength;
                var i;
                /**
                 * Load needed background scripts if they unavailable previously
                 */
                var loadBackgroundScripts = function () {
                    var jqueryRegExp = /\/js\/jquery\/jquery-[1,2]{1}\.(.+)\.js/;
                    var head = document.head || document.getElementsByTagName('head')[0];
                    var script;
                    var src;
                    var j;

                    if (data.scripts) {
                        for (j in data.scripts) {
                            if (data.scripts.hasOwnProperty(j)) {
                                src = data.scripts[j];

                                if (jqueryRegExp.test(src)) {
                                    continue;
                                }

                                if (
                                    $('head script[src*="' + src + '"]').length === 0
                                    && !(Array.isArray(window.loadedScriptLinks)
                                        && window.loadedScriptLinks.indexOf(src) > -1)
                                ) {
                                    script = document.createElement('script');
                                    script.type = 'text/javascript';
                                    script.src = src;
                                    head.appendChild(script);
                                }
                            }
                        }
                    }
                };
                /**
                 * Load needed background links if they unavailable previously
                 */
                var loadBackgroundLinks = function () {
                    var lesscss;
                    var href;
                    var i;

                    if (data.links) {
                        lesscss = (typeof lesscss_path_base64 !== 'undefined') ? lesscss_path_base64 : '';
                        href = '';

                        for (i in data.links) {
                            if (data.links.hasOwnProperty(i)) {
                                href = lesscss + data.links[i];

                                if (
                                    $('head link[href*="' + href + '"]').length === 0
                                    && !(Array.isArray(window.loadedStyleLinks)
                                        && window.loadedStyleLinks.indexOf(href) > -1)
                                ) {
                                    $('head').append('<link rel="stylesheet" type="text/css" href="' + href + '">');
                                }
                            }
                        }
                    }
                };

                /* Enable sort buttons and pagination when widget has been loaded */
                $sortBtn.add($pagination).removeClass('disabled');

                div.innerHTML = html;
                scripts = div.getElementsByTagName('script');
                scriptsLength = scripts.length;

                for (i = 0; i < scriptsLength; i++) {
                    if (!scripts[scriptPosition].type || scripts[scriptPosition].type === 'text/javascript') {
                        if (inlineScripts.indexOf(scripts[scriptPosition].innerHTML) === -1) {
                            inlineScripts.push(scripts[scriptPosition].innerHTML);
                        }
                        scripts[scriptPosition].parentNode.removeChild(scripts[scriptPosition]);
                    } else {
                        scriptPosition++;
                    }
                }

                html = (div.querySelector(self.loadedContainer).innerHTML || '');

                loadBackgroundLinks();
                loadBackgroundScripts();

                self.loaderShow.hide(function () {
                    var state = {requestParams: self.requestParams, htmlContent: html, inlineScripts: inlineScripts.join(';')};
                    self.$container.html(html).find('.main-captcha-place').remove();

                    setTimeout(function () {
                        self.cleanUpData();
                        $.globalEval(inlineScripts.join(';'));
                        System.trigger('inventory_ajax_complete', self.requestParams);
                    }, 1);

                    if (initial) {
                        window.history.replaceState(state, '', location.href);
                    } else {
                        window.history.pushState(state, '', self.url);
                    }

                    self.initPage();
                });
            },
            error: function (jqXHR) {
                var errorStatusText,
                    errorStatusNum,
                    errorModalHtml;

                if (jqXHR.status === 500) {
                    errorStatusText = 'INTERNAL SERVER ERROR';
                    errorStatusNum = '500';
                } else if (jqXHR.status === 400) {
                    errorStatusText = 'BAD REQUEST';
                    errorStatusNum = '400';
                } else {
                    errorStatusText = 'SOMETHING WENT WRONG.</br>PLEASE RELOAD THE PAGE OR TRY AGAIN LATER';
                    errorStatusNum = '';
                }

                errorModalHtml = '<div class="modal error-modal in" tabindex="-1" role="dialog" style="display: block;">'
                    + '<div class="modal-dialog" role="document">'
                    + '<div class="modal-content">'
                    + '<div class="modal-header">'
                    + '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                    + '<span aria-hidden="true">&times;</span>'
                    + '</button>'
                    + '<h4 class="modal-title text-center">Error ' + errorStatusNum + '</h4>'
                    + '</div>'
                    + '<div class="modal-body text-center">' + errorStatusText + '</div>'
                    + '</div>'
                    + '</div>'
                    + '</div>'
                    + '<div class="modal-backdrop error-modal fade in"></div>';

                $('body').append(errorModalHtml);

                $('.close, .modal.error-modal').on('click', function () {
                    $(this).closest('.modal').remove();
                    $('.modal-backdrop.error-modal').remove();
                });
            }
        });
    },

    reloadVehicle: function (vin, vid) {
        var self = this;

        self.widgetParams['ajax_loading_vehicles'] = 0;
        self.widgetParams['template'] = 'responsive';

        $.ajax({
            url: '/ajax',
            type: 'post',
            dataType: 'json',
            data: {
                oper: 'get_widget',
                widget: self.widgetParams['widgetId'],
                preview: 0,
                params: self.widgetParams,
                dws_page_id: self.pageId,
                request_params: {'vin': vin}
            },
            success: function (data) {
                var html;

                if (data && data.hasOwnProperty('html') && data.html) {
                    html = $(data.html).filter(self.loadedContainer).find('.priceWrap').html();
                    self.$container
                        .find('.vehicle-wrapper[data-id="' + parseInt(vid, 10) + '"] .priceWrap')
                        .html(html || '');
                }
            }
        });
    }
};
