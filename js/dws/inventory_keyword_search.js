function inventory_keyword_search(keyword) {
    var url;
    var valueRial = keyword;

    if (keyword_status == 'sold') {
        url = dws_alias['sold'] ? dws_alias['sold'].alias_url : 'sold';
    }
    else {
        url = keywordSearchUrl;
    }

    if (keyword_search_data.zip) {
        url += "_zip_" + keyword_search_data.zip;
    }

    if (keyword_search_data.ziprange) {
        url += "_ziprange_" + keyword_search_data.ziprange;
    }

    if (keyword_search_data.region) {
        url += "_region_" + keyword_search_data.region;
    }

    keyword = encodeURIComponent(keyword.replace('_', ' ').replace('/', ' '));

    if (default_txt != valueRial) {
        url += "_keyword_" + keyword;
    }

    document.location.href = url;
}

var template_value = '';
var skeyword_value = '';

$(document).ready(function () {
    var buf_search = $('.keyword_search_value');
    buf_search.keyup(function (a, b, c) {
        if (a.keyCode == 13) {
            inventory_keyword_search($(this).val());
        }
    });
    if (buf_search.is('.form-control')) {
        return;
    }
    skeyword_value = buf_search.val();
    template_value = buf_search.val();
    buf_search.change(function () {
        skeyword_value = buf_search.val();
    });
    buf_search.focus(function () {
        if (template_value == skeyword_value) {
            $(this).val('');
        }
    });
    buf_search.blur(function () {
        if ($(this).val() == '') {
            $(this).val(default_txt);
            skeyword_value = template_value;
        }
    });

});
