/* global bsAlert */

var Vir360ExternalButton = function (params) {
    this.isMinimizeBtnHidden = params.isMinimizeBtnHidden;
    this.unbind360Button();
    this.bind360Button();
};

Vir360ExternalButton.prototype = {
    buttonClickEventName: 'click.vir360ExternalButton',
    unbind360Button: function () {
        $('body').off(this.buttonClickEventName);
    },
    bind360Button: function () {
        $('body').on(this.buttonClickEventName, '.open-360-player-btn', function () {
            var imageId = $(this).data('vir-360-id');

            if (
                typeof window.vir360PlayerInstance !== 'undefined'
                && typeof window.vir360PlayerInstance.openFullscreenImageById === 'function'
            ) {
                window.vir360PlayerInstance.openFullscreenImageById(imageId, this.isMinimizeBtnHidden);
            } else {
                bsAlert('Something was wrong, 360 player is unavailable');
            }
        });
    },
};
