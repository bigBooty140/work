var BuyerToolsPanelResponsive = function (params) {
    var self = this;
    $.each(params, function(key, value) {
        if ('undefined' !== typeof(self[key])) {
            self[key] = value;
        }
    });
};

BuyerToolsPanelResponsive.prototype = {
    requestParams: {},
    recentVehicles: {},
    savedVehicles: {},
    priceAlerts: {},
    login: {},
    documentHead: document.head || document.getElementsByTagName('head')[0],

    init: function() {
        var self = this;
        var loadedWidget = [];
        $.each(self, function(key, value) {
            if ('undefined' !== typeof(value['widget'])) {
                loadedWidget[value['modal']] = self.getWidget(key);
            }
        });

        $.when(
            loadedWidget[self.recentVehicles.modal],
            loadedWidget[self.savedVehicles.modal]
        ).done(function () {
            self.prepareScripts();
        });

        $.when(
            loadedWidget[self.priceAlerts.modal]
        ).done(function () {
            if (window.btNotifyFormSuccess && ('function' === typeof(showNotifyForm))) {
                showNotifyForm();
            }
        });
    },

    getWidget: function (paramsName) {
        var self = this;
        var settings = self[paramsName];
        var isNotify = (settings.params.type_page === 'notify') ? true : false;
        var params = {
            oper: 'get_widget',
            widget: settings.widget,
            params: settings.params
        };


        if (isNotify) {
            $.extend(params, self.requestParams);
        }

        return $.ajax({
            url: '/ajax',
            type: 'post',
            data: params,
            dataType: 'json',
            success: function (data) {
                if (data) {
                    self.loadWidget(settings.modal, data);
                }
            },
            complete: function () {
                self.unlockModal(settings.modal);
                if (isNotify && window.btNotifyFormSuccess) {
                    statusRemove();
                }
            },
            beforeSend: function () {
                self.lockModal(settings.modal);
                if (isNotify && window.btNotifyFormSuccess) {
                    statusOpen('Loading...', 0);
                }
            }
        });
    },

    loadHeadScript: function (scripts) {
        var self = this;
        if (scripts.length > 0) {
            var html = '//<![CDATA[\n';
            var script = document.createElement("script");
            script.type = "text/javascript";

            $.each(scripts, function (key, val) {
                html += val;
            });

            html += '//]]>';
            $(script).html(html);
            self.documentHead.appendChild(script);
        }
    },


    loadStyles: function (links) {
        var self = this;

        $.each(links, function (index, link) {
            if (!$('link[href="' + link + '"]').length && (loadedStyleLinks.indexOf(link) == -1)) {
                var style = document.createElement('link');
                style.rel = 'stylesheet';
                style.type = 'text/css';
                style.href = link;
                self.documentHead.appendChild(style);
            }
        });
    },

    loadWidget: function (modal, data) {

        /* load scripts and styles for widget */
        if (data.links.length) {
            this.loadStyles(data.links);
        }

        var div = document.createElement('div');
        var inlineScripts = [];
        div.innerHTML = data.html;
        var scripts = div.getElementsByTagName('script');
        var i = scripts.length;
        var $content = $(modal + ' > div > div');

        while (i--) {
            scripts[i].type = 'text/javascript';
            inlineScripts.unshift(scripts[i].outerHTML);
            scripts[i].parentNode.removeChild(scripts[i]);
        }

        /* load head scripts - set basic data */
        this.loadHeadScript(data.head_scripts);

        /* append content without head and inline scripts */
        $content.html(div.innerHTML);

        /* load widget scripts */
        setTimeout(function () {
            window.jsScriptLoader.loadBySrcBatch(
                data.scripts,
                function () {
                    /* append inline scripts after loading widget scripts*/
                    if (inlineScripts.length) {
                        $.each(inlineScripts, function (i, script) {
                            $content.append($(script));
                        });
                    }
                    /* init compare list for ajax mode */
                    BuyerToolsFunctions.initCompareList();
                },
                window.jsScriptLoader.getLoadingMethod()
            );
        }, 500);
    },

    lockModal: function (modal) {
        $('[data-target="' + modal + '"]').closest('li').css('pointer-events', 'none');
    },

    unlockModal: function (modal) {
        $('[data-target="' + modal + '"]').closest('li').css('pointer-events', 'all');
    },

    prepareScripts: function () {
        if ('function' === typeof(updateButtons)) {
            updateButtons();
        }
        if ('function' === typeof(compareList)) {
            (new compareList()).init({widget_id: null});
        }

        this.convertAllDateTimeFromUtcToLocal();
    },

    /**
     * Function for convert UTS dateTime to local.
     *
     * @param dateString
     * @returns dateString
     */
    getConvertedUtcDateStringToLocal: function (dateString) {
        var localTime = moment.utc(dateString).toDate();
        localTime = moment(localTime).format('YYYY-MM-DD HH:mm:ss');

        return localTime;
    },

    /**
     * Search all date-time in widget and convert its time from UTC to local.
     */
    convertAllDateTimeFromUtcToLocal: function () {
        var self = this;

        $('.timeago').each(function () {
            var yourDateString = $(this).attr('title');
            var isConvertedToLocal = $(this).data('local');
            var id = $(this).data('id');
            if (yourDateString && !isConvertedToLocal) {
                var localTime = self.getConvertedUtcDateStringToLocal(yourDateString);

                $(this).text(localTime);
                $(this).attr('title', localTime);
                $(this).attr('data-local', localTime);

            }
        });

        $(".timeago").timeago();
    }
};

/**
 * Service function Buyer Tools Panel
 * @type {{setCookies: BuyerToolsFunctions.setCookies, initCompareList: BuyerToolsFunctions.initCompareList}}
 */
var BuyerToolsFunctions = {

    /**
     * Set cookie by name
     * @param cookieName
     * @param vehicleId
     */
    setCookies: function (cookieName, vehicleId) {
        var date = new Date();
        if ($.cookie(cookieName) == null || $.cookie(cookieName) == '') {
            $.cookie(cookieName, vehicleId + '~' + date.toISOString(), {expires: 365* 5});
        } else {
            var vehicles = $.cookie(cookieName).split(';');
            for (var index in vehicles) {
                vehicle = vehicles[index].split('~');
                if (vehicle[0] == vehicleId) {
                    vehicles.splice(index, 1);
                }
            }
            vehicles[vehicles.length] = vehicleId + '~' + date.toISOString();
            $.cookie(cookieName, vehicles.join(';'),{expires: 365* 5});
        }
    },

    /**
     * Add vehicles from inventory items to window.vdata
     * and init compare manage functional
     */
    initCompareList: function() {

        if ($.isEmptyObject(window.vdata)) {
            vdata = {};
        }

        $('.recent_vehicles_list, .saved_vehicles_list').find('.item').each(function() {
            var vehicleId = $(this).data('vehicle-id');
            vdata[vehicleId] = {
                vcaption: $(this).find('a.vehicle_title').first().text(),
                vurl: $(this).find('a.vehicle_title').attr('href')
            };
        });

        (new compareList()).init({widget_id: null});
    },

}
