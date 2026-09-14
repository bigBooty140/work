$(function() {
    var $wrapper = $('#modalRecentVehicles');
    var auctionMode = $wrapper.find('.modul-r-invItems').attr('data-auction-mode');
    var showPrice = $wrapper.find('.modul-r-invItems').attr('data-show-price');

    bindEvents();

    /*  show save/remove buttons inside vehicle details widgets */
    $('.vd_save_vehicle').show();

    /* init compare list */
    BuyerToolsFunctions.initCompareList();

    jQuery.timeago.settings.strings.day = "1 day ";
    if (!isAuthorized) {
        recountVehicles();
    } else {
        var paramsForToolBar = {};
        var buyerToolsPanel = new BuyerToolsPanelResponsive(paramsForToolBar);
    }
    updateButtons();

    if (window.btNotifyFormSuccess && $('#modalPriceAlerts').find('.modal-body').length) {
        showNotifyForm();
    }
    
    /* Show always vehicles list not form */
    $('a[data-target="#modalPriceAlerts"]').on('click', function () {
        $('#modalPriceAlerts')
            .find('.content_default').show().end()
            .find('.content_form').hide();
    });

    /* save/remove saved vehicle inside "Recently Viewed" modal */
    var $vehicleDetailsWidget = $('[id*="modul_r_details"], [id*="module_r_details"], [id*="modul-r-veh_det_truck"]');
    $wrapper.add($vehicleDetailsWidget).on('click', '.save_vehicle, .vd_save_vehicle', function() {
        var saved = !!parseInt($(this).attr('data-saved'));
        var vehicleId = $(this).data('vehicle-id');

        if (!saved) {
            addSavedVehicle(vehicleId);
        } else {
            removeSavedVehicle(vehicleId);
        }

        $('.save_vehicle, .vd_save_vehicle')
            .filter('[data-vehicle-id="' + vehicleId + '"]')
            .attr('data-saved', (saved ? 0 : 1));
        updateButtons();
    });

    /* remove from saved inside "Saved Vehicles" modal */
    var onClickRemove = function() {
        var vehicleId = $(this).data('vehicle-id');
        removeSavedVehicle(vehicleId);
        $('.save_vehicle, .vd_save_vehicle')
            .filter('[data-vehicle-id="' + vehicleId + '"]')
            .attr('data-saved', 0);
        updateButtons();
    };
    $('#modalSavedVehicles').on('click', '.remove_car', onClickRemove);
    $('.vd_remove_vehicle').click(onClickRemove);

    /* hover on buttons with "Saved!" text */
    $wrapper.on({
        mouseenter: function () {
            if (parseInt($(this).attr('data-saved'))) {
                $(this).removeClass('btn-primary btn-success').addClass('btn-danger')
                    .find('span').text(window.btText.btSavedButtonHoverText).end()
                    .find('i').attr('class', 'fa fa-trash');
            }
        },
        mouseleave: function () {
            updateButtons();
        }
    }, '.save_vehicle');

    /* "Get Price Alerts" button */
    $('#modalRecentVehicles, #modalSavedVehicles').on('click', '.price_alerts[data-alerted="0"]', function() {
        var vehicleId = $(this).data('vehicle-id');
        var saveButton = $('.save_vehicle[data-vehicle-id="' + vehicleId + '"]').first();
        var saved = !!parseInt(saveButton.attr('data-saved'));

        if (!saved) {
            saveButton.click();
        }

        showNotifyForm(vehicleId, $(this).closest('.modal'));
    });

    function loadSavedVehicles(text) {
        statusOpen(text, 0);
        $.ajax({
            url: '/ajax',
            type: 'post',
            data: {
                oper: 'inventory_items',
                type_pages: 'saved',
                template: 'responsive',
                auction_mode: auctionMode,
                show_price: showPrice,
            },
            dataType: 'json',
            error: function() {
                alert('error');
            },
            success: function(html) {
                $('.saved_vehicles_list').html($(html).find('.saved_vehicles_list').html());

                $('[data-target="#modalSavedVehicles"]').closest('li').find('.badge').text(
                    $(html).find('.saved_vehicles_list').data('count')
                );

                if (isAuthorized) {
                    buyerToolsPanel.convertAllDateTimeFromUtcToLocal();
                }

                statusRemove();
                $(".timeago").timeago();

                (new compareList()).init({widget_id: null});
            }
        });
    }

    function recountVehicles() {
        if (!isAuthorized) {
            statistic = {
                recent_vehicles: ($.cookie('recent_vehicles')) ? $.cookie('recent_vehicles') : null,
                saved_vehicles: ($.cookie('saved_vehicles')) ? $.cookie('saved_vehicles') : null,
                notify_vehicles: ($.cookie('notify_vehicles')) ? $.cookie('notify_vehicles') : null,
            }
            $.each(statistic, function(index, value){
                if (null !== value) {
                    statistic[index] = value.split(';');
                }
            });
        }


        if (statistic !== null) {
            count = 0;
            if (
                typeof(statistic.recent_vehicles) !== 'undefined'
                && null !== statistic.recent_vehicles
            ) {
                if (Object.keys(statistic.recent_vehicles).length) {
                    count = Object.keys(statistic.recent_vehicles).length;
                }
            }
            $('[data-target="#modalRecentVehicles"] .badge').text(count);

            count = 0;
            if (typeof(statistic.saved_vehicles) !== 'undefined'
                    && null !== statistic.saved_vehicles) {
                if (Object.keys(statistic.saved_vehicles).length) {
                    count = Object.keys(statistic.saved_vehicles).length;
                }
            }
            $('[data-target="#modalSavedVehicles"]').closest('li').find('.badge').text(count);

            count = 0;
            if (typeof(statistic.notify_vehicles) !== 'undefined'
                    && null !== statistic.notify_vehicles) {
                if (Object.keys(statistic.notify_vehicles).length) {
                    count = Object.keys(statistic.notify_vehicles).length;
                }
            }
            $('[data-target="#modalPriceAlerts"] .badge').text(count);
        }

        $(".timeago").timeago();
    }

    function removeSavedVehicle(vehicleId) {
        if (!isAuthorized) {
            var savedVehicles = ($.cookie('saved_vehicles')) ? $.cookie('saved_vehicles').split(';') : [];
            var savedCookie = '';
            var savedVehicle;
            var saved = {};
            var i;

            for (i in savedVehicles) {
                savedVehicle = savedVehicles[i].split('~');
                if (Number(savedVehicle[0]) !== vehicleId) {
                    saved[i] = savedVehicle[0] + '~' + savedVehicle[1];
                }
            }
            $.each(saved, function(index, value) {
                savedCookie += value + ';';
            });
            $.cookie('saved_vehicles', savedCookie.slice(0, -1), {expires: 365 * 5});
            loadSavedVehicles(strRemoving);
            $('body').trigger('watchRemove', vehicleId);
        } else {
            statusOpen(strRemoving, 0);
            $.ajax({
                url: '/ajax',
                type: 'post',
                data: {
                    oper: 'removeFromSaved',
                    ajax_controller: 'WatchList/WatchList',
                    vehicleId: vehicleId,
                },
                dataType: 'json',
                error: function () {
                    alert('error');
                    statusRemove();
                },
                success: function (response) {
                    if (response['success'] === true) {
                        loadSavedVehicles(strRemoving);
                        $('body').trigger('watchRemove', vehicleId);
                    } else {
                        statusRemove();
                    }
                },
            });
        }
    }

    function addSavedVehicle(vehicleId) {
        if (!isAuthorized) {
            BuyerToolsFunctions.setCookies('saved_vehicles', vehicleId);
            loadSavedVehicles(strSaving);
            $('body').trigger('watchAdd', vehicleId);
        } else {
            statusOpen(strSaving, 0);
            $.ajax({
                url: '/ajax',
                type: 'post',
                data: {
                    oper: 'addToSaved',
                    ajax_controller: 'WatchList/WatchList',
                    vehicleId: vehicleId,
                },
                dataType: 'json',
                error: function () {
                    alert('error');
                    statusRemove();
                },
                success: function (response) {
                    if (response['success'] === true) {
                        loadSavedVehicles(strSaving);
                        $('body').trigger('watchAdd', vehicleId);
                    } else {
                        statusRemove();
                    }
                },
            });
        }
    }

    function bindEvents() {
        // if offers counter present on the panel
        if ($('.offers_counter.badge').length) {
            System.on('quickOffer.complete', function () {
                $.get('/ajax', {ajax_controller: 'Marketplace', oper: 'get_offers_count'}, function (count) {
                    $('.offers_counter.badge').text(count);
                });
            });
        }

        // if spending limit present on the panel
        if ($('.spending_limit.badge').length) {
            System.on('quickOffer.complete quickBuyNow.complete placeBid.complete', function () {
                $.get('/ajax', {ajax_controller: 'Marketplace', oper: 'get_spending_limit'}, function (count) {
                    $('.spending_limit.badge').text(count);
                });
            });
        }
    }
    
    $(document).ready(function(){
        if (!isAuthorized) {
            if ('undefined' != typeof(idVehicle) && 'undefined' != typeof(vehicleCookiesFlag) && vehicleCookiesFlag) {
                recountVehicles();
            }
        }
    });
});

function showNotifyForm(vehicleId, currentModal) {

    $(document).trigger('loadRecaptcha');

    vehicleId = vehicleId || false;
    currentModal = currentModal || false;

    if (vehicleId) {
        $('#modalPriceAlerts input[name="vehicle_id"]').val(vehicleId);
    }

    var openModal = function() {
        $('#modalPriceAlerts')
            .find('.content_default').hide().end()
            .find('.content_form').show().end()
            .modal('show')
            .one('shown.bs.modal', function() {
                $(this).find('input:visible:first').focus();
            });
        /*if message OK - add event on close modal*/
        if (0 !== $('#modalPriceAlerts').find('.btn-message-ok').length) {
            $('#modalPriceAlerts').on('hidden.bs.modal', function () {
                window.location.href = window.location.href.split('#').shift();
            });
        }
    };

    if (currentModal) {
        currentModal.modal('hide').one('hidden.bs.modal', openModal);
    } else {
        openModal();
        /* hide "Close" button inside modal */
        $('#modalPriceAlerts .modal-footer').hide();
    }
}

function updateButtons() {
    var t = window.btText;
    var $wrapper = $('#modalRecentVehicles');

    /* save vehicle -> remove vehicle (buyers tools) */
    $('.save_vehicle[data-saved="1"]', $wrapper)
        .removeClass('btn-primary btn-danger').addClass('btn-success')
        .find('span').text(t.btSavedButtonText).end()
        .find('i').attr('class', 'fa fa-check');

    /* remove saved vehicle -> save vehicle (buyers tools) */
    $('.save_vehicle[data-saved="0"]', $wrapper)
        .removeClass('btn-success btn-danger').addClass('btn-primary')
        .find('span').text(t.btSaveButtonText).end()
        .find('i').attr('class', 'fa fa-floppy-o');

    /* save vehicle -> remove vehicle (vehicle details) */
    $('.vd_save_vehicle[data-saved="1"]')
        .removeClass('btn-success').addClass('btn-danger')
        .attr('title', t.vdRemoveButtonTitle)
        .find('span').text(t.vdRemoveButtonText).end()
        .find('i').attr('class', 'fa fa-trash-o');

    /* remove saved vehicle -> save vehicle (vehicle details) */
    $('.vd_save_vehicle[data-saved="0"]')
        .removeClass('btn-danger').addClass('btn-success')
        .attr('title', t.vdSaveButtonTitle)
        .find('span').text(t.vdSaveButtonText).end()
        .find('i').attr('class', 'fa fa-car');
}
