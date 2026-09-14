
var WatchList = function (params) {
    var self = this;

    if (params) {
        $.each(params, function (key, value) {
            if ('undefined' !== typeof(self[key])) {
                self[key] = value;
            }
        });
    }

    /* add current vehicle to cookie recent_vehicle */
    if (
        !self.isAuthorized
        && 'undefined' !== typeof(self.vehicleId)
        && 'undefined' !== typeof(self.vehicleCookiesFlag)
        && self.vehicleCookiesFlag
        && self.method === 'details'
    ) {
        self.setCookies('recent_vehicles', self.vehicleId);
    }

    $('body')
        .on('click', '.js-watch-toggle', function () {
            var saved = !!parseInt($(this).attr('data-saved'));
            var vehicleId = $(this).data('vehicle-id');

            if (!saved) {
                self.addSavedVehicle(vehicleId);
            } else {
                self.removeSavedVehicle(vehicleId);
            }

            self.updateButtons(this, saved);
        })
        .on('watchAdd', function (e, id) {
            var watchButtonList = $('.js-watch-toggle');

            $.each(watchButtonList, function (index, value) {
                if (Number(id) === Number(value.dataset.vehicleId)) {
                    self.updateButtons(this, false);
                }
            });
        })
        .on('watchRemove', function (e, id) {
            var watchButtonList = $('.js-watch-toggle');

            $.each(watchButtonList, function (index, value) {
                if (Number(id) === Number(value.dataset.vehicleId)) {
                    self.updateButtons(this, true);
                }
            });
        });

};

WatchList.prototype = {
    isAuthorized: false,
    vehicleId: '',
    vehicleCookiesFlag: false,
    auctionMode: 0,
    showPrice: 0,
    watchListText: {
        addWatch: 'Watch',
        removeWatch: 'Remove',
        saveText: 'Saving Vehicle...',
        removeText: 'Removing Vehicle...',
    },
    dayExpires: 365 * 5,
    method: 'details',

    addSavedVehicle: function (vehicleId) {
        var self = this;

        if (!self.isAuthorized) {
            self.setCookies('saved_vehicles', vehicleId);
            self.loadSavedVehicles(self.watchListText.saveText);
        } else {
            statusOpen(self.watchListText.saveText, 0);
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
                    window.alert('error');
                    statusRemove();
                },
                success: function (response) {
                    if (response['success'] === true) {
                        self.loadSavedVehicles(self.watchListText.saveText);
                    } else {
                        statusRemove();
                    }
                },
            });
        }
    },

    removeSavedVehicle: function (vehicleId) {
        var self = this;
        var savedVehicles;
        var vehicle;
        var saved = {};
        var savedCookie = '';
        var i;

        if (!self.isAuthorized) {
            savedVehicles = ($.cookie('saved_vehicles')) ? $.cookie('saved_vehicles').split(';') : [];
            for (i in savedVehicles) {
                vehicle = savedVehicles[i].split('~');

                if (Number(vehicle[0]) !== vehicleId) {
                    saved[i] = vehicle[0] + '~' + vehicle[1];
                }
            }
            $.each(saved, function (index, value) {
                savedCookie += value + ';';
            });
            $.cookie('saved_vehicles', savedCookie.slice(0, -1), {expires: self.dayExpires});
            self.loadSavedVehicles(self.watchListText.saveText);
        } else {
            statusOpen(self.watchListText.saveText, 0);
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
                    window.alert('error');
                    statusRemove();
                },
                success: function (response) {
                    if (response['success'] === true) {
                        self.loadSavedVehicles(self.watchListText.saveText);
                    } else {
                        statusRemove();
                    }
                },
            });
        }
    },

    updateButtons: function (obj, saved) {
        var self = this;
        var $obj = $(obj);
        var $watchButton = $obj.eq(0);
        var $watchButtonText = $obj.find('.watch-text').eq(0);

        if (saved) {
            $watchButton
                .removeClass('watch-remove')
                .addClass('watch-saved')
                .attr('data-saved', 0);
            $watchButtonText.text(self.watchListText.addWatch);
        } else {
            $watchButton
                .removeClass('watch-saved')
                .addClass('watch-remove')
                .attr('data-saved', 1);
            $watchButtonText.text(self.watchListText.removeWatch);
        }
    },

    loadSavedVehicles: function (text) {
        var self = this;

        statusOpen(text, 0);
        $.ajax({
            url: '/ajax',
            type: 'post',
            data: {
                oper: 'inventory_items',
                type_pages: 'saved',
                template: 'responsive',
                auction_mode: self.auctionMode,
                show_price: self.showPrice,
            },
            dataType: 'json',
            error: function () {
                window.alert('error');
            },
            success: function (html) {
                var $savedVehiclesList = $(html).find('.saved_vehicles_list');

                if (typeof BuyerToolsPanelResponsive === 'function') {
                    $('.saved_vehicles_list').html($savedVehiclesList.html());
                    $('[data-target="#modalSavedVehicles"]')
                        .closest('li')
                        .find('.badge')
                        .text($savedVehiclesList.data('count'));

                    if (self.isAuthorized) {
                        BuyerToolsPanelResponsive.prototype.convertAllDateTimeFromUtcToLocal();
                    }

                    $('.timeago').timeago();
                    (new compareList()).init({widget_id: null});
                }
            },
            complete: function () {
                statusRemove();
            },
        });
    },

    setCookies: function (cookieName, vehicleId) {
        var self = this;
        var date = new Date();
        var vehicles;
        var currentVehicle;
        var index;

        if ($.cookie(cookieName) === null || $.cookie(cookieName) === '') {
            $.cookie(cookieName, vehicleId + '~' + date.toISOString(), {expires: self.dayExpires});
        } else {
            vehicles = $.cookie(cookieName).split(';');
            for (index in vehicles) {
                currentVehicle = vehicles[index].split('~');

                if (currentVehicle[0] === vehicleId) {
                    vehicles.splice(index, 1);
                }
            }

            vehicles[vehicles.length] = vehicleId + '~' + date.toISOString();
            $.cookie(cookieName, vehicles.join(';'), {expires: self.dayExpires});
        }
    },
};

