/**
 * Be careful when changing this file, because it is being used in most inventory list widgets
 *
 * AJAX widgets requirements:
 *  1) if loaded widget has JS file - code in that file should not start executing instantly. It should have
 *     some function like init() and this function should be called from widget's template
 *  2) all JS/CSS links of loading widgets should be loaded from another widget (inventory)
 */
var ModalWidgets = function(params) {
    params = params || {};
    var qrCodeWidthDefault = 140;
    var qrCodeClassDefault = 'inventory_vehicle_qr_code';

    this.wrapperClass = params.wrapperClass;

    this.useQrCode = params.useQrCode;
    this.qrCodeClass = params.qrCodeClass || qrCodeClassDefault;
    this.qrCodeWidth = params.qrCodeWidth || qrCodeWidthDefault;

    this.init();
};

ModalWidgets.prototype = {
    lastModalData: {},
    modalTemplate: [
        '<div class="modal fade" id="modal-widgets-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">',
            '<div class="modal-dialog modal-lg">',
                '<div class="modal-content">',
                    '<div class="modal-header">',
                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
                        '<h4 class="modal-title"><!-- title here --></h4>',
                    '</div>',
                    '<div class="modal-body">',
                        '<div class="progress">',
                            '<div class="progress-bar progress-bar-striped active" role="progressbar" style="width: 100%">',
                                '<span>Loading...</span>',
                            '</div>',
                        '</div>',
                        '<div class="content"><!-- html content here --></div>',
                    '</div>',
                '</div>',
            '</div>',
        '</div>'
    ].join('\n'),

    init: function() {
        var self = this;

        if (!$('#modal-widgets-modal').length) {
            $('body').append(self.modalTemplate);
        }

        /* activate reCapcha on hidden form input */
        $(document).ready(function() {
            $('div.main-captcha-place:first').find('form')
                .validate({
                    rules: {capcha_catcher_input: {required: true}},
                    messages: {capcha_catcher_input: {required: ''}}
                }
            );
        });

        /* set qr_code */
        if (this.useQrCode) {
            self.bindQrCode();
        }

        /* Move reCaptcha to inventory captcha place on close modal window */
        $(document.body).on('hidden.bs.modal', function() {
            $('input.capcha-catcher-input:first').trigger('recaptcha');
        });

        if (typeof window.Vir360ExternalButton === 'function') {
            self.vir360PlayerInstance = new window.Vir360ExternalButton({
                isMinimizeBtnHidden: true,
            });
        }

        $('body')
            .off('click.modal_form')
            .on('click.modal_form', '[data-modal-widget]', function() {
                var wrapper = self.wrapperClass ? $(this).closest('.' + self.wrapperClass) : null;
                var modal = $('#modal-widgets-modal');

                var vehicleId = wrapper ? wrapper.data('id') : $(this).data('id');
                var title = $(this).data('title');
                var widgetName = $(this).data('modal-widget');

                /* clear listeners on close modal window */
                if (jQuery.inArray(widgetName, ['vehicle_video']) < 0) {
                    $('#modal-widgets-modal').unbind();
                }

                if (!vehicleId) {
                    try {
                        console.error('Vehicle ID not found!');
                    } catch (e) { }
                    return;
                }

                /* if form already was loaded (user could accidentally close it) - just show it */
                if (
                    self.lastModalData['vehicle_id'] == vehicleId
                    && self.lastModalData['title'] == title
                    && self.lastModalData['submit'] != 1
                ) {
                    modal.modal('show');
                    setTimeout(function () {
                        modal.find('input:visible:first').trigger('recaptcha').trigger('focus');
                    }, 500);
                    return;
                }

                /* Move rechaptcha to inventory temporary place */
                $('input.capcha-catcher-input:first').trigger('recaptcha');

                self.lastModalData['vehicle_id'] = vehicleId;
                self.lastModalData['title'] = title;
                self.lastModalData['submit'] = 0;

                modal.find('.modal-title').text(title);
                modal.find('.progress').show().end().find('.content').empty().hide();
                modal.modal('show');

                var data = {
                    oper: 'get_widget',
                    widget: widgetName,
                    template: 'responsive',
                    params: {
                        vehicle_id: vehicleId,
                        modal: 2
                    }
                };

                var additionalParams = $(this).data('params');
                if (additionalParams) {
                    $.extend(data.params, additionalParams);
                }

                $.ajax({
                    url: '/ajax',
                    type: 'get',
                    dataType: 'json',
                    data: data,
                    success: function (data) {
                        /* move all <script> tags from html to htmlScripts array */
                        var htmlScripts = [];
                        var html = $('<div>').html(data.html).find('script').each(function (index, el) {
                            htmlScripts.push($(el).html());
                        }).remove().end().html();

                        self.cleanScripts();
                        self.headScripts(data.head_scripts);

                        /* inserting html */
                        modal.find('.content').show().end().find('.progress').hide();
                        modal.find('.content').html(html);

                        // add inline scripts to the head
                        self.headScripts(htmlScripts);

                        /* add focus input listener */
                        setTimeout(function () {
                            $(document).trigger('loadRecaptcha');
                            modal.find('input:visible:first').trigger('recaptcha').trigger('focus');
                        }, 500);

                        /* add listener on submit button */
                        modal.find('form:visible:first').submit(function (e) {
                            e.preventDefault();
                            self.submitForm($(this).serializeArray());
                        });

                        statusRemove();
                    }
                });
            });

        if ($('.modul-r-inventory.layout-list').length) {
            $('.modul-r-inventory.layout-list .vehicle-note-btn-wrapper').each(function (index, el) {
                new Vue({
                    el: el,
                    components: {
                        'vehicle-notes-btn': new VehicleNotesButton(),
                    },
                });
            });
        }
    },

    /**
     * Bind qr-code (generate after click on button for show) for each vehicle in inventory
     */
    bindQrCode: function () {
        var self = this;
        var $qrButtons = $('div[class*="modul-r-inventory"] .' + this.wrapperClass + ' .' + this.qrCodeClass);
        $qrButtons.each(function() {
            var $qrBtn = $(this);
            var $qrContainer = $qrBtn.siblings('.dropdown-menu').find('.qr-code-container');
            $qrBtn.click(function() {
                if (!$('canvas', $qrContainer).length) {
                    var data = $qrBtn.find('.qr-code-data').attr('alt');
                    drawQrCode($qrContainer, data, self.qrCodeWidth);
                }
            });
        });
    },

    clearLastModalData: function() {
      var self = this;
      self.lastModalData['submit'] = 1;
    },

    /**
     * Remove scripts, loaded during last ajax widget loading
     * Only scripts from '/js/dws/' directory and scripts without 'src' attribute will be removed
     */
    cleanScripts: function() {
        $('script[data-ajax-loaded="1"]').each(function() {
            var src = $(this).attr('src');
            if (!src || src.indexOf('/js/dws/') !== -1) {
                $(this).remove();
            }
        });
    },

    /**
     * Append scripts content to the head
     * @param scriptsArray
     */
    headScripts: function(scriptsArray) {
        if (!$.isArray(scriptsArray)) {
            scriptsArray = [scriptsArray];
        }

        $.each(scriptsArray, function(index, content) {
            $('head').append($('<script>').attr('data-ajax-loaded', 1).html(content));
        });
    },

    /**
     * Ajax form submit and return submit message
     * @returns html
     */
    submitForm: function(data) {
        var self = this;
        var formName = '';
        var postData = {};
        if (data.length > 0) {
            for (var key in data) {
                if (data[key].name == 'action') {
                    formName = data[key].value;
                }
                postData[data[key].name] = data[key].value;
            }
        }

        postData['oper'] = 'get_widget';
        postData['formType'] = 'responsive';
        postData['formName'] = formName;

        $.ajax({
            url: '/ajax',
            type: 'post',
            dataType: 'json',
            data: postData,
            success: function(res) {
                statusRemove();
                if (res.status && res.html) {
                    var $modal = $('#modal-widgets-modal');
                    $modal.find('.content').html(res.html.html);

                    var $btnOk = $modal.find('.content .btn-message-ok');
                    if ($btnOk.length) {
                        $btnOk.on('click', function (e) {
                            e.preventDefault();
                            $modal.modal('hide');
                        });
                    }

                    $('#modal-widgets-modal').click(function(){
                        self.clearLastModalData();
                    });

                } else {
                    try {
                        console.log('There are some problems when submitting the form.');
                    } catch (e) {}
                }
            },
            error: function(response){
                statusRemove();
                try {
                    console.log('Error ' + response);
                } catch (e) {}
            }
        });
    }
};

