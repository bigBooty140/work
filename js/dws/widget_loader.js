function axAjaxWidgetLoader(options) {
    var $noopObject = $('**');

    $.extend(this, {
        fixedTopElem: ($('.navbar-fixed-top').height()) || null,
        delay: 5,
        duration: 400,
        useScrollToTop: true,
        scrollTime: 500,
        $wrapper: $noopObject,
        loaderWrapper: '',
        $scrollingElem: $('html, body'),
        $progress: $noopObject,
        initial: false
    }, options);

    if (!this.$wrapper.length || !this.loaderWrapper) {
        return console.error('Please set "$wrapper" and "loaderWrapper" property');
    }

    return this;
}

axAjaxWidgetLoader.prototype.loaderInit = function() {
    this.$progress = $('<div class="progress animate-progress ajax-progress-bar">'
        + '<div class="progress-bar progress-bar-striped animate-progress-bar"></div></div>'
    );
    this.$progress.appendTo(this.$wrapper.find(this.loaderWrapper));
};

axAjaxWidgetLoader.prototype.show = function (silent) {
    if (!silent) {
        $('.ajax-progress-bar', this.$wrapper)
            .addClass('show-loader');
    }

    if (this.useScrollToTop && this.initial && !silent) {
        this.scrollToTop();
    }
};

axAjaxWidgetLoader.prototype.hide = function(callback) {
    setTimeout(function() {
        if (typeof callback === 'function') {
            callback();
        }
    }, 500);

    this.initial = true;
};

axAjaxWidgetLoader.prototype.scrollToTop = function () {
    var positionY = (this.$wrapper.offset().top) - (this.fixedTopElem || 0);

    this.$scrollingElem.animate({scrollTop: positionY}, this.scrollTime);
};
