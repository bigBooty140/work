function compareList(){}

compareList.prototype = {

    init: function(params){
        var $this = this;

        this.wrappers = $(
            '.modul-inventory, .modul-inventory_adv_2, .modul-inventoryPlus,' +
            ' .toolbarWrap .recent-cars, .toolbarWrap .saved-cars, .toolbarWrap .price-alerts' +
            '.compare_checkbox_wrap, .compare_buttons_wrap, .modul-r-inventoryMD, .modul-r-inventory, .inventory-r-builder,' +
            ' .inventory_builder, .module-r-comparelist, .buyers-tools-modal, .modul-r-inventoryPlus, .modul-r-inventoryMD2'
        );

        this.remove_id = '[id^="cvid_"]';
        this.cookie_name = 'compare_vehicles';
        this.empty_message_class = '.compare_empty_message';
        this.compare_link = '.compare_link';
        this.print_link = '.print_link';
        this.user_print_link = $('.mcoml-submit').find('.user_print_comparing');
        this.inventory_submit_selector = '.compare_selected';
        this.user_print_submit_selector = '.user_print_comparing';
        this.print_submit_selector = '.print_comparing';
        this.inventory_submit = this.wrappers.find(this.inventory_submit_selector);
        this.user_print_submit = this.wrappers.find(this.user_print_submit_selector);
        this.print_submit = this.wrappers.find(this.print_submit_selector);

        this.clear_link = '.clear_link';
        this.alias_button_props = {
            class_name: 'button-compare-alias',
            custom_selector: '[data-alias="#compare_vehicle_{{VID}}"]',
            checked_class: 'checked'
        }; // Aliases add possibility to use other elements as compare button,
        // if described options will be added to the tag - it will add 'compare button' functionality to this tag
        this.compare_links = this.wrappers.find('[id^="compare_vehicle_"], .compare_checkbox, .' + this.alias_button_props.class_name);
        this.widget_class = '.module-comparelist, .module-r-comparelist';
        
        if (params['widget_id'] != null && params['widget_id'] != '') {
            this.container = $(params['widget_id']);
            this.template = this.container.find('.compare_template').html();
            this.initBinds();
            this.initCompareSubmit();
            this.initUserPrintComparing();
            this.initPrintComparing();
            this.initClearList();
        } else {
            this.container = $('div[id^="compare_list_"]');
            this.template = $('.compare_template:first').html();
            this.initInventoryBinds();
            this.initUserPrintBinds();
            this.initPrintBinds();
        }
    },
    
    checkCookie: function() {
        var vidsFormCookie = $.cookie(this.cookie_name);
        if (vidsFormCookie != null && vidsFormCookie != '' && vidsFormCookie.split(',').length > 0) {
            return true;
        } else {
            return false;
        }
    },
    
    checkToShowButtons: function() {
        var buttonsSelector = [
            this.inventory_submit_selector,
            this.print_submit_selector,
            this.user_print_submit_selector
        ].join();
        var opacity = this.checkCookie() ? 1 : 0.5;
        $(buttonsSelector, this.wrappers).css({opacity: opacity});
    },
    
    initBinds: function() {
        var $this = this;
        var container = $this.container;

        container.find($this.remove_id).click(function(){
            $this.clickRemove($(this).attr('id').replace('cvid_',''));
        });
    },
    
    initInventoryBinds: function() {
        var $this = this;
        var cookies = $.cookie($this.cookie_name);
        if (cookies == null || cookies == '') {
            $this.inventory_submit.addClass("disabled");
        }
        $this.compare_links.unbind('click').click(function(){
            $this.clickAdd($(this));
        });
        $this.inventory_submit.unbind('click').click(function(){
            $this.prepareCookie('redirect', 123);
        });
    },
    
    initUserPrintBinds: function() {
        var $this = this;
        var cookies = $.cookie($this.cookie_name);
        if (cookies == null || cookies == '') {
            $this.user_print_submit.addClass("disabled");
            $this.user_print_link.hide();
        }
        $this.compare_links.unbind('click').click(function(){
            $this.clickAdd($(this));
        });
        $this.user_print_submit.unbind('click').click(function(){
            $this.prepareCookie('user_print', 123);
        });
        $this.user_print_link.unbind('click').click(function(){
            $this.prepareCookie('user_print_link', 123);
        });
    },
    
    initPrintBinds: function() {
        var $this = this;
        var cookies = $.cookie($this.cookie_name);
        if (cookies == null || cookies == '') {
            $this.print_submit.addClass("disabled");
        }
        $this.compare_links.unbind('click').click(function(){
            $this.clickAdd($(this));
            $this.checkToShowButtons();
        });
        $this.checkToShowButtons();
        $this.print_submit.unbind('click').click(function(){
            $this.prepareCookie('print', 123);
        });
    },
    
    clickRemove: function(vid) {
        var $this = this,
            aliasSelector = this.alias_button_props.custom_selector.replace('{{VID}}', vid),
            $buttonAlias = $this.compare_links.filter(aliasSelector);
        $this.container.find('#cvid_'+vid).closest('.compare-list-item').remove();
        $this.prepareCookie('remove', vid);
        if (!$this.container.find($this.remove_id).length) {
            $($this.widget_class).find($this.compare_link).hide();
            $($this.widget_class).find($this.print_link).hide();
            $($this.widget_class).find($this.clear_link).hide();
            $($this.widget_class).find($this.print_submit_selector).hide();
            $($this.widget_class).find($this.empty_message_class).show();
        }

        /* if use $('#compare_vehicle_' + vid), get only one element */
        var checkbox = $('#compare_vehicle_' + vid).length
            ? $('input[id*="compare_vehicle_' + vid + '"]')
            : $('.compare_checkbox[data-vid="' + vid + '"]');

        $buttonAlias.removeClass(this.alias_button_props.checked_class);

        checkbox
            .prop('checked', false)
            .closest('.btn')
            .removeClass('btn-success')
            .addClass('btn-default');
        
        var cookies = $.cookie($this.cookie_name);
        if (cookies == null || cookies == '') {
            $this.print_submit.addClass("disabled");
            $this.user_print_submit.addClass("disabled");
            $this.user_print_link.hide();
            $this.inventory_submit.addClass("disabled");
        }
        $this.checkToShowButtons();
    },
    
    clickAdd: function(checkbox) {       
        var $this = this,
            vid, $buttonAlias, aliasSelector;

        // Alias of standard 'compare' button
        if (checkbox.hasClass($this.alias_button_props.class_name)) {
            checkbox = $this.compare_links.filter(checkbox.data('alias'));
            
            /* take only one checkbox item before create triggers */
            checkbox.splice(1);
            
            checkbox.trigger('click');
        } else {
            vid = checkbox.is('[id^="compare_vehicle_"]')
                ? checkbox.attr('id').replace('compare_vehicle_', '')
                : checkbox.data('vid');

            aliasSelector = this.alias_button_props.custom_selector.replace('{{VID}}', vid);
            $buttonAlias = $this.compare_links.filter(aliasSelector);

            $buttonAlias.addClass(this.alias_button_props.checked_class);

            var cookies = $.cookie($this.cookie_name);
            if (cookies != null || cookies != '') {
                $this.print_submit.removeClass("disabled");
                $this.user_print_submit.removeClass("disabled");
                $this.user_print_link.css({display: "inline-block"});
                $this.inventory_submit.removeClass("disabled");
            }
            if (vid != '' && vid != null && vdata != '' && vdata != null && vdata[vid]) {
                var vcaption = vdata[vid].vcaption,
                    vurl = vdata[vid].vurl,
                    selected = !!checkbox.is(':checked');

                if (!$this.container.find('#cvid_' + vid).length && selected) {
                    var links = [
                        $this.print_link,
                        $this.compare_link,
                        $this.clear_link,
                        $this.print_submit_selector
                    ];

                    $($this.widget_class).find($this.empty_message_class).hide();
                    $($this.widget_class).find(links.join()).show();

                    $this.container.each(function () {
                        var container = $(this).closest('.module-r-comparelist').length
                            ? $(this).find('.compare-list')
                            : $(this);
                        container.append($.tmpl($this.template, {
                            'vid': vid,
                            'vcaption': vcaption,
                            'vurl': 'href="' + vurl + '"'
                        }));
                    });

                    $this.container.find('#cvid_' + vid).click(function () {
                        $this.clickRemove(vid);
                    });

                    $this.prepareCookie('add', vid);
                    /* set all checkboxes with equal in true and add needed style */
                    $('input[id*="compare_vehicle_' + vid + '"]')
                        .prop('checked', true)
                        .closest('.btn')
                        .removeClass('btn-default')
                        .addClass('btn-success');;
                    
                } else {
                    $this.clickRemove(vid);
                }
            }
        }
    },
    
    prepareCookie: function(oper, vid) {
        var $this = this;
        var vids = [];

        if (
            vid != null
            && vid != ''
            && ['add','remove','redirect','user_print','print','user_print_link'].indexOf(oper) >= 0
        ) {
            
            if ((location.href.indexOf('vehicles_') != -1)) {
                if ($.cookie($this.cookie_name) != null && $.cookie($this.cookie_name) != '') {
                    vids = $.cookie($this.cookie_name).split(',');
                }
            }

            if (!vids || vids.length == 0) {
                $('input[id^="compare_vehicle_"], .compare_checkbox').filter(':checked').each(function(i, elem) {
                    var elemVid = $(elem).is('[id^="compare_vehicle_"]')
                        ? $(elem).attr('id').replace('compare_vehicle_', '')
                        : $(elem).data('vid');

                    if (elemVid != vid) {
                        vids.push(elemVid);
                    }
                });
                var vidsFormCookie = $.cookie($this.cookie_name);
                if (vidsFormCookie != null && vidsFormCookie != '' && vidsFormCookie.split(',').length > 0) {
                    vidsFormCookie = vidsFormCookie.split(',');
                    vids = vids.concat(vidsFormCookie);
                    for (var i = 0; i < vids.length; i++) {
                        for (var j = i + 1; j < vids.length;) {
                            if (vids[i] == vids[j]) {
                                vids.splice(j, 1);
                            } else {
                                j++;
                            }
                        }
                    }
                }
            }
            if (!vids || vids.length == 0) {
                if ((location.href.indexOf('vehicles_') != -1)) {
                    var href = document.location.href;
                    href = href.split('_');
                    if (href[2]) {
                        vids = href[2].split('~');
                    }
                }
            }

            switch (oper) {
                case 'add':
                    vids.push(vid);
                    break;
                case 'remove':
                    var _tmp = [];
                    for (var i in vids) {
                        if (vids[i] != vid) {
                            _tmp.push(vids[i]);
                        }
                    }
                    vids = _tmp;
                    break;
                case 'redirect':
                    if (vids.length) {
                        var formatUrl = '';
                        if ('https:' === location.protocol) {
                            var formatUrlArray = location.pathname.split('/');
                            var firstPartOfUrl = String(formatUrlArray[1]);
                            if (
                                -1 !== firstPartOfUrl.indexOf('.')
                                && -1 === firstPartOfUrl.indexOf('.html')
                                && -1 === firstPartOfUrl.indexOf('.htm')
                            ) {
                                formatUrl = firstPartOfUrl + '/';
                            }
                        }
                        var newUrl = '/'
                            + (dws_alias['compare']
                                ? formatUrl + dws_alias['compare'].alias_url + '_vehicles'
                                : formatUrl + 'compare_vehicles')
                                + '_' + vids.join('~');
                        if (location.href.indexOf('compare_vehicles_') == -1) {
                            window.open(newUrl);
                        } else {
                            window.open(newUrl, '_self');
                        }
                    }
                    break;
                case 'user_print':
                case 'user_print_link':
                    if (vids.length) {
                        $('.vehicles_id').val(vids);
                        if ($('#print-compareModal, #compareModal').length) {
                            $('#print-compareModal, #compareModal').first().modal('show');
                        } else {
                            $('.print-compareModal-dialog').first().modal('show');
                        }
                    }
                    break;
                case 'print':
                    var maxCount = 4; /* maximum count vehicles of the default template 001 */
                    if (vids.length) {
                        if (vids.length <= maxCount) {
                            $('.vehicles_id').val(vids);
                            quotePrinter('print', 'html');
                        } else {
                            alert('Max. 4 vehicles');
                        }
                    }
                    break;
            }

            $.cookie($this.cookie_name, vids.join(','));
        } else {
            $this.print_submit.addClass("disabled");
            $this.user_print_submit.addClass("disabled");
            $this.user_print_link.hide();
            $this.inventory_submit.addClass("disabled");
        }
    },
    
    initCompareSubmit: function() {
        var $this = this;
        $($this.widget_class).find($this.compare_link).unbind('click').click(function(){
            $this.prepareCookie('redirect', 123);
        });
    },
    
    initPrintComparing: function() {
        var $this = this;
        $($this.widget_class).find($this.print_link).unbind('click').click(function(){
            $this.prepareCookie('print', 123);
        });
    },
    
    initUserPrintComparing: function() {
        var $this = this;
        $this.user_print_link.unbind('click').click(function(){
            $this.prepareCookie('user_print_link', 123);
        });
    },
    
    initClearList: function() {
        var $this = this;
        $($this.widget_class).find($this.clear_link).unbind('click').click(function(){
            var href = document.location.href.split('_');
            href = href[0] + (href[1] ? '_' + href[1] : '');
            $.cookie($this.cookie_name, null);
            document.location.href = href;
        });
    }
};
