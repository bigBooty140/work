var AdvancedSearchHorizontal = function(params) {
    params = params || {};

    this.wrapperClass = params.wrapperClass;
    this.$container = $(params.wrapperClass);
    this.url = params.url;
    this.isFrame = params.isFrame;
    this.loading = params.loading;
    this.ajaxMode = params.ajaxMode;

    if (this.ajaxMode) {
        this.uid = params.uid;
        this.widgetParams = params.widgetParams;
        this.pageId = params.pageId;
        this.requestParams = params.requestParams;
        this.ajaxOptionInit();
    } else {
        this.init();
    }
};

AdvancedSearchHorizontal.prototype = {
    $container: null,

    wrapperClass: '',
    url: '',
    isFrame: false,
    loading: 'Loading...',

    init: function() {
        var self = this;
        if (self.isFrame) {
            $(self.wrapperClass).find('select.make').filtersSelectChain({
                url: self.url,
                targets: ['model', 'body'],
                sources: [
                    'make',
                    'model',
                    'body',
                    'year_from',
                    'year_to',
                    'price_from',
                    'price_to',
                    'mileage_from',
                    'mileage_to',
                    'condition',
                    'owner',
                    'city',
                    'state',
                    'keyword',
                    'children',
                    'citype',
                    'sp',
                    'stock',
                    'motorizedtype',
                    'zip',
                    'ziprange'
                ],
                loading: self.loading,
                sel: 'make',
                wrapper:self.wrapperClass
            });

            $(self.wrapperClass).find('select.model').filtersSelectChain({
                url: self.url,
                targets: ['body'],
                sources: [
                    'make',
                    'model',
                    'year_from',
                    'year_to',
                    'price_from',
                    'price_to',
                    'mileage_from',
                    'mileage_to',
                    'condition',
                    'owner',
                    'city',
                    'state',
                    'keyword',
                    'children',
                    'citype',
                    'sp',
                    'stock',
                    'motorizedtype',
                    'zip',
                    'ziprange'
                ],
                loading: self.loading,
                sel: 'model',
                wrapper:self.wrapperClass
            });

        } else {

            $(self.wrapperClass).find('select.simulcast_auction').filtersSelectChain({
                url: self.url,
                targets: ['simulcast_event', 'simulcast_lane', 'make', 'model', 'body'],
                sources: [
                    'simulcast_auction'
                ],
                loading: self.loading,
                sel: 'simulcast_auction',
                wrapper: self.wrapperClass
            });

            $(self.wrapperClass).find('select.simulcast_event').filtersSelectChain({
                url: self.url,
                targets: ['simulcast_lane', 'make', 'model', 'body'],
                sources: [
                    'simulcast_auction',
                    'simulcast_event'
                ],
                loading: self.loading,
                sel: 'simulcast_event',
                wrapper: self.wrapperClass
            });

            $(self.wrapperClass).find('select.simulcast_lane').filtersSelectChain({
                url: self.url,
                targets: ['make', 'model', 'body'],
                sources: [
                    'simulcast_auction',
                    'simulcast_event',
                    'simulcast_lane'
                ],
                loading: self.loading,
                sel: 'simulcast_lane',
                wrapper: self.wrapperClass
            });

            $(self.wrapperClass).find('select.make').filtersSelectChain({
                url: self.url,
                targets: ['model', 'body'],
                sources: [
                    'make',
                    'model',
                    'body',
                    'year_from',
                    'year_to',
                    'price_from',
                    'price_to',
                    'mileage_from',
                    'mileage_to',
                    'zip',
                    'ziprange'
                ],
                loading: self.loading,
                sel: 'make',
                wrapper:self.wrapperClass
            });

            $(self.wrapperClass).find('select.model').filtersSelectChain({
                url: self.url,
                targets: ['body'],
                sources: [
                    'make',
                    'model',
                    'year_from',
                    'year_to',
                    'price_from',
                    'price_to',
                    'mileage_from',
                    'mileage_to',
                    'zip',
                    'ziprange'
                ],
                loading: self.loading,
                sel: 'model',
                wrapper:self.wrapperClass
            });

            $(self.wrapperClass).find('select.body').filtersSelectChain({
                url: self.url,
                targets: ['make', 'model'],
                sources: ['make', 'model', 'body', 'zip', 'ziprange'],
                loading: self.loading,
                sel: 'body',
                wrapper:self.wrapperClass
            });
        }

        /* reset filters */
        $(self.wrapperClass).find('.reset-search-filters').click(function () {
            var url = dws_alias['cars-for-sale'] ? dws_alias['cars-for-sale'].alias_url : 'cars-for-sale';
            window.location.href = url;
        });

        /* search (submit) */
        self.$container.find('.submit_btn').on('click', function() {
            adv_filter_search(this);
        });
    },
    ajaxOptionInit: function () {
        var self = this;
        $.ajax({
            url: '/ajax',
            type: 'post',
            dataType: 'json',
            data: {
                oper: 'get_widget',
                widget: 'search_advanced_horizontal',
                preview: 0,
                params: self.widgetParams,
                dws_page_id: self.pageId,
                request_params: self.requestParams
            },
            success: function(data) {
                var html = data.html;
                var $template = $(html).find('.row').html();

                $(self.wrapperClass).find('.row').html($template);

                var div = document.createElement('div');
                var inlineScripts = [];
                div.innerHTML = html;
                var scripts = div.getElementsByTagName('script');
                var i = scripts.length;

                while (i--) {
                    scripts[i].type = 'text/javascript';
                    inlineScripts.unshift(scripts[i].outerHTML);
                    scripts[i].parentNode.removeChild(scripts[i]);
                }

                if (inlineScripts.length) {
                    $.each(inlineScripts, function(i, script) {
                        $(self.wrapperClass + ' script').replaceWith($(script));
                    });
                }

                self.init();
            }
        });
    }
};

var emptys1 = {
    'simulcast_auction': 'Any Auction',
    'simulcast_event': 'Any Event',
    'simulcast_lane': 'Any Lane',
    'make': 'Any Make',
    'model': 'Any Model',
    'body': 'Any Style'
};

function filtersSelectChainLoad(settings) {
    var targets = settings.targets;
    var sources = settings.sources;
    if (externalFilters.length) {
        sources = sources.concat(['condition', 'state', 'city', 'year']);
    }
    var url = settings.url;
    var loading = settings.loading;
    //var callback = settings.callback;
    var sel = settings.sel;
    var auctionMode = parseInt(window.searchAdvancedHorizontalAuctionMode) || 0;
    var simulcastMode = parseInt(window.searchAdvancedHorizontalSimulcastMode) || 0;
    var data = {oper: 'selectchain_vehicle', trackbar: true, selectchain_common: sel};
    var $wrapper = $(settings.wrapper);

    if (auctionMode) {
        data['auction_mode'] = 1;
    }

    if (simulcastMode) {
        data['simulcast_mode'] = 1;
    }

    var $listEvent = $wrapper.find('select.simulcast_event');
    var $listLane = $wrapper.find('select.simulcast_lane');
    var $listMake = $wrapper.find('select.make');
    var $listModel = $wrapper.find('select.model');
    var $listStyle = $wrapper.find('select.body');

    var fl = 0;
    if (!$listMake.val() && !$listStyle.val() && (('make' === sel) || ('body' === sel))) {
        fl = 1;
    }

    switch (sel) {
        case 'simulcast_auction':
            $listEvent.val('').prop('disabled', true);
            $listLane.val('').prop('disabled', true);
            $listMake.val('').prop('disabled', true);
            $listModel.val('').prop('disabled', true);
            break;
        case 'make':
            $listModel.val('').attr('disabled', 'disabled');
            if (!$listStyle.val()) {
                $listStyle.val('').attr('disabled', 'disabled');
            }
            break;

        case 'model':
            $listStyle.val('');
            break;

        case 'body':
            var make = $listMake.val();
            var model = $listModel.val();
            if (make && model) {
                return;
            } else if (!model) {
                $listModel.val('').attr('disabled', 'disabled');
            } else {
                $listMake.val('').attr('disabled', 'disabled');
                $listModel.val('').attr('disabled', 'disabled');
            }
            break;
    }

    for (var i = 0; i < sources.length; i++) {
        switch (sources[i]) {

            case 'simulcast_auction':
            case 'simulcast_event':
            case 'simulcast_lane':
                data[sources[i]] = $wrapper.find('select.' + sources[i]).val();
                break;

            case 'make':
            case 'model':
                data[sources[i]] = $wrapper.find('#adv_hor_' + sources[i]).val();
                break;

            case 'body':
                if ($listStyle.val() && 'make' == sel) {
                    data[sources[i]] = $listStyle.val();
                } else {
                    data[sources[i]] = $wrapper.find('#adv_hor_' + sources[i]).val();
                }
                break;

            case 'year_from':
                if ($wrapper.find('#adv_hor_' + sel).val() != '') {
                    data[sources[i]] = year_min;
                }
                break;

            case 'year_to':
                if ($wrapper.find('#adv_hor_' + sel).val() != '') {
                    data[sources[i]] = year_max;
                }
                break;

            case 'mileage_from':
                if ($wrapper.find('#adv_hor_' + sel).val() != '') {
                    data[sources[i]] = odometer_min;
                }
                break;

            case 'mileage_to':
                if ($wrapper.find('#adv_hor_' + sel).val() != '') {
                    data[sources[i]] = odometer_max;
                }
                break;

            case 'price_from':
                if ($wrapper.find('#adv_hor_' + sel).val() != '') {
                    data[sources[i]] = price_min;
                }
                break;

            case 'price_to':
                if ($wrapper.find('#adv_hor_' + sel).val() != '') {
                    data[sources[i]] = price_max;
                }
                break;

            case 'zip':
                data[sources[i]] = zipFromUrl;
                break;

            case 'ziprange':
                data[sources[i]] = zipRangeFromUrl;
                break;
        }

        if (externalFilters.length) {
            switch (sources[i]) {
                case 'condition':
                case 'year':
                    if (adv_hor_all_param[sources[i]]) {
                        data[sources[i]] = adv_hor_all_param[sources[i]].split('~');
                    }
                    break;

                case 'state':
                    if (adv_hor_all_param.state) {
                        data['state_id'] = adv_hor_all_param.state.split('~');
                    }
                    break;

                case 'city':
                    if (adv_hor_all_param.city) {
                        data['city_id'] = adv_hor_all_param.city.split('~');
                    }
                    break;
                case 'body':
                    if (adv_hor_all_param.body && adv_hor_all_param.body.split('~').length > 1) {
                        data[sources[i]] = adv_hor_all_param.body.split('~');
                    }
                    break;
            }
        }

        if (adv_hor_iframe) {
            switch (sources[i]) {

                case 'condition':
                    if (adv_hor_all_param.condition) {
                        data[sources[i]] = adv_hor_all_param.condition;
                    }
                    break;

                case 'owner':
                    if (adv_hor_all_param.owner) {
                        data['user_id'] = adv_hor_all_param.owner;
                    }
                    break;

                case 'children':
                    if (adv_hor_all_param.children) {
                        data['children'] = adv_hor_all_param.children;
                    }
                    break;

                case 'citype':
                    if (adv_hor_all_param.citype) {
                        data['citype'] = adv_hor_all_param.citype;
                    }
                    break;

                case "stock":
                    data['stock'] = stock;
                    break;

                case "motorizedtype":
                    data['motorizedtype'] = motorizedtype;
                    break;

                case 'city':
                    if (adv_hor_all_param.city) {
                        data['city_id'] = adv_hor_all_param.city;
                    }
                    break;

                case 'state':
                    if (adv_hor_all_param.state) {
                        data['state_id'] = adv_hor_all_param.state;
                    }
                    break;

                case 'keyword':
                    if (adv_hor_all_param.keyword) {
                        data['keyword'] = adv_hor_all_param.keyword;
                    }
                    break;

                case'sp':
                    if (sp_param) {
                        data['sp'] = sp_param;
                    }
                    break;
            }

        }
    }
    
    if (window['advSearchVehicleTags']) {
        data['vehicle_tags'] = window['advSearchVehicleTags'];
    }

    $.ajax({
        url: url,
        data: data,
        type: 'post',
        dataType: 'json',
        success: function(j) {
            if (j) {
                for (var k = 0; k < targets.length; k++) {

                    if (j[targets[k]] != undefined && j[targets[k]] != null) {

                        switch (targets[k]) {
                            case 'simulcast_auction':
                            case 'simulcast_event':
                            case 'simulcast_lane':
                            case 'make':
                            case 'model':
                            case 'trim':
                                var $target = $wrapper.find('#adv_hor_' + targets[k]);
                                var s = $target.val();
                                var l = j[targets[k]].length;
                                $target.empty().append("<option value=\"\">" + emptys1[targets[k]] + "</option>");

                                for (var i = 0; i < l; i++) {
                                    if (!j[targets[k]][i]["name"]
                                        || j[targets[k]][i]["name"]
                                        == undefined
                                        || j[targets[k]][i]["name"]
                                        == null) {
                                        continue;
                                    }

                                    var nm = (j[targets[k]][i]["name"] == ''
                                    || j[targets[k]][i]["name"] == null
                                    || j[targets[k]][i]["name"] == undefined)
                                        ? "OTHER"
                                        : j[targets[k]][i]["name"];

                                    var id = j[targets[k]][i]["id"];
                                    var text = nm + " (" + j[targets[k]][i]["count"] + ")";

                                    $target.append("<option value=\"" + id + "\">" + text + "</option>");
                                }

                                if ($wrapper.find('#adv_hor_' + targets[k] + ' option[value="' + s + '"]').size()) {
                                    $target.val(s);
                                } else {
                                    $target.val('');
                                }

                                if ($target.children().length > 1) {
                                    $target.prop('disabled', false);
                                }

                                break;

                            case 'body':
                                var $select = $listStyle;
                                var oldSelectedId = $select.val();

                                $select.empty();
                                $('<option>').attr('value', '').text(emptys1[targets[k]]).appendTo($select);

                                $.each(j['class'], function() {
                                    var name = (this["name"] == '' || this["name"] == null || this["name"] == undefined)
                                        ? "OTHER"
                                        : this["name"];
                                    var id = this["id"];
                                    var text = name + " (" + this["count"] + ")";
                                    $('<option/>').attr('value', id).text(text).appendTo($select);
                                });

                                if ($select.find('option[value="' + oldSelectedId + '"]').length) {
                                    $select.val(oldSelectedId);
                                } else {
                                    $select.val('');
                                }

                                if ($select.children().length > 1) {
                                    $select.prop('disabled', false);
                                }

                                break;

                            case 'year':
                                year_min = j[targets[k]].min;
                                trackbar.getObject('msadvH_year_hor').updateLeftValue(year_min);
                                year_max = j[targets[k]].max;
                                trackbar.getObject('msadvH_year_hor').updateRightValue(year_max);
                                break;

                            case 'mileage':
                                if (fl == 1) {
                                    odometer_min = _odometer_min;
                                    odometer_max = _odometer_max;
                                } else {
                                    odometer_min = j[targets[k]].min;
                                    odometer_max = j[targets[k]].max;
                                }

                                trackbar.getObject('msadvH_odometr_hor').updateLeftValue(odometer_min);
                                trackbar.getObject('msadvH_odometr_hor').updateRightValue(odometer_max);
                                break;

                            case 'price':
                                if (fl == 1) {
                                    price_min = _price_min;
                                    price_max = _price_max;
                                } else {
                                    price_min = j[targets[k]].min;
                                    price_max = j[targets[k]].max;
                                }
                                trackbar.getObject('msadvH_price_hor').updateLeftValue(price_min);
                                trackbar.getObject('msadvH_price_hor').updateRightValue(price_max);
                                break;
                        }

                    } else {
                        $wrapper.find('#adv_hor_' + targets[k]).empty()
                            .append("<option value=\"\">" + emptys1[targets[k]] + "</option>")
                            .attr('disabled', 'disabled');
                    }
                }
            }
            //callback();
        },
        error: function() {
            //jalert("an error occurred",2);
        }
    });
}

$.fn.filtersSelectChain = function() {
    var settings = arguments[0] || {};
    $(this).change(function() {
        filtersSelectChainLoad(settings, this.id);
    });
};

function createUrl(data) {
    var text = "";
    for (key in data) {
        if (text == "") {
            text += key + "=" + data[key];
        } else {
            text += "&" + key + "=" + data[key];
        }
    }

    return text;
}

function adv_filter_search(submitButton) {
    var $module = $(submitButton).closest('.modul-search_adv_hor');
    var validationEnabled = ($module.is('.layout_alt')) ? true : false;
    var $make = $('.make', $module);
    var $model = $('.model', $module);
    var $body = $('.body', $module);
    var keyword = $('.keyword', $module).val() || '';
    var zipCode = $('[name="zip"]', $module).val();
    var zipRange = parseInt($('[name="zip_range"]', $module).val()) || '';
    var region = $('[name="region"]', $module).val();
    var auction = parseInt($('.simulcast_auction', $module).val()) || 0;
    var event = parseInt($('.simulcast_event', $module).val()) || 0;
    var lane = parseInt($('.simulcast_lane', $module).val()) || 0;

    var sch_ar = {};

    $.cookie('global_zip_input', zipCode, {expires: 365 * 12});

    if (adv_hor_iframe) {

        adv_hor_all_param.region = region;
        adv_hor_all_param.make = $make.val() || adv_hor_makelist;
        adv_hor_all_param.model = $model.val();
        adv_hor_all_param.trim = '';
        adv_hor_all_param.makelist = ((!$make.val()) ? "" : adv_hor_makelist);
        adv_hor_all_param.body = $body.val();
        adv_hor_all_param.mileagefrom = odometer_min;
        adv_hor_all_param.mileageto = odometer_max;
        adv_hor_all_param.pricefrom = price_min;
        adv_hor_all_param.priceto = price_max;
        adv_hor_all_param.keyword = encodeURIComponent(keyword.replace('_', ' ').replace('/', ' '));
        adv_hor_all_param.yearfrom = year_min;

        adv_hor_all_param.yearto = year_max;
        adv_hor_all_param.sp = sp_param;
        adv_hor_all_param.stock = stock;

        adv_hor_all_param.motorizedtype = motorizedtype;

        if (zipCode) {
            if (zipRange) {
                adv_hor_all_param.zip = zipCode;
            }
            adv_hor_all_param.ziprange = zipRange;
        }

        sch_ar = adv_hor_all_param;
    } else {
        sch_ar = {
            region: region,
            year_from: year_min,
            year_to: year_max,
            make: $make.val(),
            model: $model.val(),
            trim: '',
            body: $body.val(),
            mileage_from: odometer_min,
            mileage_to: odometer_max,
            price_from: price_min,
            price_to: price_max,
            keyword: encodeURIComponent(keyword.replace('_', ' ').replace('/', ' '))
        };

        if (zipCode) {
            if (zipRange) {
                sch_ar.zip = zipCode;
            }
            sch_ar.ziprange = zipRange;
        }

        if (!sch_ar.price_from && !sch_ar.price_to) {
            delete sch_ar.price_from;
            delete sch_ar.price_to;
        }

        if (externalFilters.length) {
            for (var num in externalFilters) {
                var filter = externalFilters[num];

                if (!adv_hor_all_param[filter]) {
                    continue;
                }
                //if make, model, trim aren't selected
                if (!sch_ar[filter]) {
                    sch_ar[filter] = adv_hor_all_param[filter];
                }
            }
        }
    }

    /* simulcast filters */
    if (auction) {
        sch_ar.auction = auction;
    }

    if (event) {
        sch_ar.event = event;
    }

    if (lane) {
        sch_ar.lane = lane;
    }

    /* BOF remove range search params that equal min and max appropriate  */
    if (_odometer_min === sch_ar.mileage_from  && _odometer_max === sch_ar.mileage_to) {
        /* remove mileage */
        delete sch_ar.mileage_from;
        delete sch_ar.mileage_to;
    }
    if (_price_min === sch_ar.price_from  && _price_max === sch_ar.price_to) {
        /* remove price */
        delete sch_ar.price_from;
        delete sch_ar.price_to;
    }
    if (_year_min === sch_ar.year_from  && _year_max === sch_ar.year_to) {
        /* remove year */
        delete sch_ar.year_from;
        delete sch_ar.year_to;
    }
    /* EOF remove range search params that equal min and max appropriate  */
    
    var adv_params = (adv_hor_iframe == 1)
        ? adv_hor_params.replace('/ajax?', '').replace(/&|=/g, '_').replace('user_id', 'owner')
        : '';

    var valid = true;
    if (validationEnabled) {
        valid = $module.find('form').valid();
    }

    if (valid) {
        advanced_search(sch_ar, adv_hor_status, ((adv_hor_iframe) ? null : adv_params));
    }
}
