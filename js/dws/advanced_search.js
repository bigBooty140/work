/* global dws_alias */

$(document).ready(function () {
    $('#adv_s_zip').keyup(function (event) {
        ForInputToUpperceseZip(this, event);
    });
});

function advanced_search(search_values, status, params, getUrl, sameOrigin) {
    var search_array = [], title = [];

    // stay on current page
    if (sameOrigin) {
        title = [window.location.pathname.split('_')[0].slice(1).replace(/.html/g, '')];
    } else {
        if (status != null && status != 'undefined') {
            if (status === 'sold') {
                title = dws_alias['sold'] ? new Array(dws_alias['sold'].alias_url) : new Array('sold');
            } else if (status === 'vehicle_review') {
                title = dws_alias['vehicle-review']
                    ? new Array(dws_alias['vehicle-review'].alias_url)
                    : new Array('vehicle-review');
            } else {
                title = dws_alias['cars-for-sale']
                    ? new Array(dws_alias['cars-for-sale'].alias_url)
                    : new Array('cars-for-sale');
            }
        } else {
            title = dws_alias['cars-for-sale']
                ? new Array(dws_alias['cars-for-sale'].alias_url)
                : new Array('cars-for-sale');
        }
    }
    if (typeof(search_url) != 'undefined' && search_url != '') {
        title = [search_url];
    }

    for (var key in search_values) {
        if (
            (search_values[key] != '')
            && (typeof search_values[key] != 'undefined')
            || (
            (parseInt(search_values[key]) >= 0)
            && (key == 'price_from' || key == 'price_to' || key == 'mileage_from' || key == 'mileage_to')
            )
            || (
                (search_values[key] === 0)
                && (key === 'gradingfrom' || key === 'gradingto')
            )
        ) {
            if (search_values[key].toString().search('__') != -1) {
                var vals = search_values[key].toString().split('__');
                title.push(vals[1].replace(' ', '-'));
                search_array.push(key.replace('_', ''));
                search_array.push(vals[0].toString().replace('_', '').replace('/', ''));
            } else {
                search_array.push(key.replace('_', ''));
                search_array.push(search_values[key].toString().replace('_', '').replace('/', ''));
            }
        }
    }
    if (status == 'featured') {
        search_array.push('type_featured');
    }

    var view = '';
    if (location.pathname.indexOf("thumbnail_view") > 0) {
        view = '_thumbnail_view';
    }
    else if (location.pathname.indexOf("grid_view") > 0) {
        view = '_grid_view';
    }

    if (title.length % 2 == 0) {
        title.push('search');
    }

    var url = title.join('_');
    if (search_array != '') {
        url += view + '_' + search_array.join('_');
    }

    var regEx = /[^a-zA-Z0-9%_.~-]+/g;
    url = url.replace(regEx, "-");
    //custom params smth like: paid, priority, group etc
    if (params != null && params != '' && params != undefined) {
        url += params;
    }

    if (_dws_params_['dname'] != undefined && _dws_params_['dname'] != '') {
        url += '_dname_' + _dws_params_['dname'];
    }

    url = url + '.php';

    if (('undefined' !== typeof(getUrl)) && (true === getUrl)) {
        return url;
    } else {
        document.location.href = url;
    }
}

/**
 * Remove everything that affecting the search, keep only utility parameters like noheader, nofooter.
 * @param {object} params A set of key-value pairs of requestParams
 * @param {boolean} inverted If set, invert results (aka return all but utility classes)
 * @return {object} A filtered set of requestParams (utility only)
 */
advanced_search.cleanupParams = function (params, inverted) {
    // FIXME: hardcoded utility params. Some day this should be passed from backend
    var utilityParams = ['noheader', 'nofooter'];
    var res = {};
    var item;

    for (item in params) {
        if (params.hasOwnProperty(item)) {
            if (inverted && !~utilityParams.indexOf(item)) {
                res[item] = params[item];
            } else if (!inverted && ~utilityParams.indexOf(item)) {
                res[item] = params[item];
            }
        }
    }

    return res;
};

function advanced_search_mobile(search_values, status, params, mobFlag) {
    var search_array = [], title = [];
    if (status != null && status != 'undefined') {
        if (status == 'sold') {
            title = dws_alias['sold'] ? new Array(dws_alias['sold'].alias_url) : new Array('sold');
        }
        else if (status == 'vehicle_review') {
            title = dws_alias['vehicle-review']
                ? new Array(dws_alias['vehicle-review'].alias_url)
                : new Array('vehicle-review');
        }
        else {
            title = dws_alias['cars-for-sale']
                ? new Array(dws_alias['cars-for-sale'].alias_url)
                : new Array('cars-for-sale');
        }
    }
    else {
        title = dws_alias['cars-for-sale']
            ? new Array(dws_alias['cars-for-sale'].alias_url)
            : new Array('cars-for-sale');
    }

    for (var key in search_values) {
        if (search_values[key] != '' && typeof search_values[key] != 'undefined'
            || (parseInt(search_values[key]) >= 0
            && (key == 'price_from' || key == 'price_to' || key == 'mileage_from' || key == 'mileage_to'))
        ) {
            if (search_values[key].toString().search('__') != -1) {
                var vals = search_values[key].toString().split('__');
                /*title.push(vals[1].replace(' ','-'));*/
                search_array.push(key.replace('_', ''));
                search_array.push(vals[0].toString().replace('_', '').replace('/', ''));
            } else {
                search_array.push(key.replace('_', ''));
                search_array.push(search_values[key].toString().replace('_', '').replace('/', ''));
            }
        }
    }
    if (status == 'featured') {
        search_array.push('type_featured');
    }

    var view = '';
    if (location.pathname.indexOf("thumbnail_view") > 0) {
        view = '_thumbnail_view';
    }
    else if (location.pathname.indexOf("grid_view") > 0) {
        view = '_grid_view';
    }

    if (title.length % 2 == 0) {
        title.push('search');
    }

    var url = title.join('_');
    if (search_array != '') {
        url += view + '_' + search_array.join('_');
    }

    var regEx = /[^a-zA-Z0-9_.-~]+/;
    url = url.replace(regEx, "-");
    //custom params smth like: paid, priority, group etc
    if (params != null && params != '' && params != undefined) {
        url += params;
    }

    if (_dws_params_['dname'] != undefined && _dws_params_['dname'] != '') {
        url += '_dname_' + _dws_params_['dname'];
    }

    if (mobFlag) {
        document.location.href = '/' + url + '_all_1.html__(MOBILE)__';
    } else {
        document.location.href = '/' + url + '_all_1.html';
    }
}
