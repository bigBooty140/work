/* global $SESSIONDATA */
var MenuAdvanced = (function (params) {
    var count = 0,
        $window = $(window),
        $document = $(document),
        $body;

    function MenuAdvanced (menu, params) {
        /* if constructor will use out of closure - add checking for parameters */

        if (!(this instanceof MenuAdvanced)) {
            return new MenuAdvanced(menu);
        }

        $.extend(this, params);

        this.$widget = $(menu);
        this.$container = $(this.wrapperClass);

        if (this.ajaxMode) {
            this.ajaxOptionInit();
        } else {
            this.init();
        }

        return this;
    }

    MenuAdvanced.prototype.init = function () {
        var self, resizeTimer, scrollTimer,
            clear = {
                'height': '',
                'overflow': '',
            };

        $body = $('body');
        self = this;
        ++count;

        this.$navBar = this.$widget.find('.navbar-collapse');
        this.$navbarNav = this.$widget.find('.navbar-nav');
        this.$topLevelItems = this.$widget.find('.level-top');
        this.$dropItemButton = this.$widget.find('.hide-item');
        this.$droppedItems = this.$widget.find('.list-collapse').children('li');
        this.$spacer = this.$widget.next('.spacer');
        this.$header = this.$widget.find('.menu-header');
        this.$navbarHeader = this.$widget.find('.navbar-header');
        this.$dropdown = this.$widget.find('.dropdown');
        this.$dropdownToggle = this.$topLevelItems.children('.dropdown-toggle')
            .add(this.$dropItemButton.find('.dropdown-toggle'));
        this.eventPoint = ('menu-advanced-' + count);
        this.windowWidth = null;
        this.height = null;
        this.delay = 150;
        this.flags = {
            isMobile: null,
            isAlternative: this.$widget.hasClass('module-r-menu-advanced-alternative'),
            isFixedTop: this.$widget.hasClass('navbar-fixed-top'),
            isResponsivePlus: this.$widget.hasClass('module-r-menu-advanced-plus'),
        };
        this.toggledClass = '';

        this.updateProperties();
        this.reInitHandlers();
        this.modify();

        if (this.flags.isAlternative) {
            this.changeHeader();

            $window.on('scroll', function () {
                clearTimeout(scrollTimer);
                scrollTimer = setTimeout(function () {
                    self.changeHeader();
                }, self.delay);
            });
        }

        $window.on('resize load', function (event) {
            if (
                self.height
                && window.innerWidth >= $SESSIONDATA['sm_width']
            ) {
                self.$navbarNav.css({
                    'height': self.height + 'px',
                    'overflow': 'hidden',
                });
            } else {
                self.$navbarNav.css(clear);
            }

            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                self.$navbarNav.css(clear);
                self.updateProperties();
                self.clearDropdown();

                if (
                    event.type === 'load'
                    || (event.type === 'resize'
                    && (self.windowWidth !== window.innerWidth)) // fix for iOS
                ) {
                    self.windowWidth = window.innerWidth;
                    self.modify();
                }

                self.reInitHandlers();

                if (self.flags.isAlternative) {
                    self.changeHeader();
                }
            }, self.delay);
        });

        $document.on('click touchstart', function (event) {
            var isMenu = $(event.target).closest(self.$widget).length;

            if (
                !isMenu
                && (window.innerWidth < $SESSIONDATA['sm_width'])
            ) {
                self.$navBar.collapse('hide');
            }
        });

        self.$navBar.on('show.bs.collapse', function () {
            $(this).siblings('.collapse.in')
                .collapse('hide');
        });
    };

    MenuAdvanced.prototype.ajaxOptionInit = function () {
        var self = this;
        $.ajax({
            url: '/ajax',
            type: 'post',
            dataType: 'json',
            data: {
                oper: 'get_widget',
                widget: 'menu_advanced',
                preview: 0,
                params: self.widgetParams,
                dws_page_id: self.pageId,
                request_params: self.requestParams,
            },
            success: function (data) {
                var scripts;
                var html;
                var div;
                var inlineScripts;
                var $wrapper;
                var scriptsNumber;
                var $logo;
                var i;

                if (!$.isEmptyObject(data)) {
                    self.flags = {
                        isResponsivePlus: self.$widget.hasClass('module-r-menu-advanced-plus'),
                    };
                    html = data.html;
                    div = document.createElement('div');
                    inlineScripts = [];
                    $wrapper = $(self.wrapperClass);
                    div.innerHTML = html;
                    div.innerHTML = div.querySelector(self.wrapperClass).innerHTML;
                    scripts = div.getElementsByTagName('script');
                    scriptsNumber = scripts.length;

                    /* loading widget scripts  */
                    // TODO: utilize window.jsScriptLoader from control_responsive.js?
                    self.loadScripts(data.scripts);

                    for (i = 0; i < scriptsNumber; i++) {
                        if (!scripts[0].type || scripts[0].type === 'text/javascript') {
                            if (inlineScripts.indexOf(scripts[0].innerHTML) === -1) {
                                inlineScripts.push(scripts[0].innerHTML);
                            }

                            scripts[0].parentNode.removeChild(scripts[0]);
                        }
                    }

                    if (data.links.length) {
                        self.loadStyles(data.links);
                    }

                    $wrapper.html(div.innerHTML);
                    $logo = $wrapper.find('.navbar-brand').find('img');

                    window.setTimeout(function () {
                        /* execute inline scripts after loading widget scripts*/
                        $.globalEval(inlineScripts.join(';'));
                    }, 1000);

                    /* If menu contains logo we are waiting for image to load */
                    if ($logo.length) {
                        $logo.on('load', function () {
                            self.init();
                        });
                    } else {
                        self.init();
                    }
                }
            },
        });
    };

    MenuAdvanced.prototype.loadScripts = function (scripts) {
        var self = this;
        var scriptsCode = '';

        if (scripts.length > 0) {
            $.each(scripts, function (key, val) {
                if (!self.checkDuplicateScript(val)) {
                    scriptsCode += '<script src="' + val + '"></script>';
                }
            });

            $('head').append(scriptsCode);
        }
    };

    MenuAdvanced.prototype.checkDuplicateScript = function (url) {
        var scripts = document.getElementsByTagName('script');
        var duplicateFlag = false;
        var i;

        // Detect if the <script> tag with the same SRC already exists in <head>
        for (i = 0; i < scripts.length; i++) {
            duplicateFlag = duplicateFlag || !!(~scripts[i].src.indexOf(url));
        }

        // Detect if the script is present in global loadedScriptLinks array
        if (typeof window.loadedScriptLinks === 'object') {
            duplicateFlag = duplicateFlag || !!(~window.loadedScriptLinks.indexOf(url));
        }

        return duplicateFlag;
    };

    MenuAdvanced.prototype.loadStyles = function (links) {
        var self = this;
        var linksCode = '';

        if (links.length > 0) {
            $.each(links, function (key, val) {
                if (!self.checkDuplicateStyle(val)) {
                    linksCode += '<link rel="stylesheet" href="' + val + '">';
                }
            });

            $('head').append(linksCode);
        }
    };

    MenuAdvanced.prototype.checkDuplicateStyle = function (url) {
        var links = document.getElementsByTagName('link');
        var duplicateFlag = false;
        var i;

        // Detect if the <link> tag with the same href already exists in <head>
        for (i = 0; i < links.length; i++) {
            duplicateFlag = duplicateFlag || !!(~links[i].href.indexOf(url));
        }

        // Detect if the style is present in global loadedStyleLinks array
        if (typeof window.loadedStyleLinks === 'object') {
            duplicateFlag = duplicateFlag || !!(~window.loadedStyleLinks.indexOf(url));
        }

        return duplicateFlag;
    };

    MenuAdvanced.prototype.checkPosition = function ($target) {
        var self = this,
            compareHeight = Math.max(
                self.$dropItemButton.outerHeight(true),
                $target.height()
            ),
            result = (
                (self.$navBar.height() > compareHeight)
                && $target.is(':visible')
            );

        return result;
    };

    MenuAdvanced.prototype.modify = function () {
        var self = this,
            hasHiddenItem = false,
            $lastVisibleItem;

        self.$topLevelItems.show();
        self.$droppedItems.hide();
        self.$dropItemButton.hide();

        if (window.innerWidth >= $SESSIONDATA['sm_width']) {
            if (self.flags.isAlternative) {
                self.$widget
                    .addClass('no-transition')
                    .removeClass('minified');
            }

            $(self.$topLevelItems.get().reverse()).each(function () {
                var $this = $(this),
                    itemIndex = $this.index();

                if (self.checkPosition($this)) {
                    $this.hide();
                    self.$droppedItems.eq(itemIndex).show();
                    hasHiddenItem = true;
                }
            });

            if (hasHiddenItem) {
                self.$dropItemButton.show();
                $lastVisibleItem = self.$topLevelItems.filter(':visible').last();

                if (self.checkPosition($lastVisibleItem)) {
                    $lastVisibleItem.hide();
                    self.$droppedItems.eq($lastVisibleItem.index()).show();
                }
            }

            if (!self.height) {
                self.height = self.$navbarNav.children('li').first().outerHeight();
            }

            if (self.flags.isAlternative) {
                self.$widget
                    .addClass('minified')
                    .removeClass('no-transition');
            }
        }

        self.changeSpacer();
    };

    MenuAdvanced.prototype.reInitHandlers = function () {
        var self = this,
            isMobile = (
                (window.innerWidth < $SESSIONDATA['sm_width'])
                || $body.hasClass('mobile')
            );

        if (isMobile !== self.flags.isMobile) {
            self.$dropdown.off('mouseenter.' + self.eventPoint
                + ' mouseleave.' + self.eventPoint);
            self.$dropdownToggle.off('click.' + self.eventPoint);

            if (isMobile) {
                self.$dropdownToggle
                    .on('click.' + self.eventPoint, function () {
                        var $this = $(this),
                            $parent = $this.parent();

                        $parent.siblings('.multi-level-open').removeClass(self.toggledClass);

                        if (self.flags.isResponsivePlus && window.innerWidth > $SESSIONDATA['xs_width']) {
                            var dropdown = $(this).parent();
                            self.dropdownPosition(dropdown);
                        }

                        if ($parent.hasClass('hide-item')) {
                            $parent.toggleClass('multi-level-open');
                            return false;
                        } else {
                            $parent.toggleClass(self.toggledClass);
                            return false;
                        }
                    });

                if (window.innerWidth < $SESSIONDATA['sm_width']) {
                    self.$dropdown.find('.visible-mobile.pull-left')
                        .on('click', function () {
                            $(this).prev(self.$dropdownToggle).focus();
                        });
                } else {
                    self.$dropdownToggle.next('.visible-mobile')
                        .on('click', function () {
                            $(this).prev(self.$dropdownToggle).focus();
                        });
                }

                $document.on('click.bs.dropdown.data-api', function () {
                    self.clearDropdown();
                });
            } else {
                self.$dropdown
                    .on('mouseenter.' + self.eventPoint, function () {
                        var $this = $(this);

                        $this.addClass(self.toggledClass);
                        self.dropdownPosition($this);
                    })
                    .on('mouseleave.' + self.eventPoint, function () {
                        $(this).removeClass(self.toggledClass);
                        self.$dropItemButton.addClass('active');
                    });
            }

            self.flags.isMobile = isMobile;
        }
    };

    MenuAdvanced.prototype.changeSpacer = function () {
        var height;

        if (!this.flags.isFixedTop) {
            return;
        }

        if (this.flags.isAlternative) {
            if (window.innerWidth >= $SESSIONDATA['sm_width']) {
                height = this.$widget.outerHeight();
            } else {
                height = this.$header.outerHeight() + this.$navbarHeader.outerHeight();
            }
        } else {
            height = this.$widget.height();
        }

        this.$spacer.height(height);
    };

    MenuAdvanced.prototype.changeHeader = function () {
        if ($document.scrollTop() > 5) {
            this.$widget.css({
                'margin-top': -this.$header.outerHeight(),
            }).addClass('minified');
        } else {
            this.$widget.css({
                'margin-top': ''
            }).removeClass('minified');
        }
    };

    MenuAdvanced.prototype.dropdownPosition = function ($obj) {
        var $dropdown = $obj.find('.dropdown-menu'),
            dropdownWidth = $dropdown.width(),
            objLeft = $obj.position().left,
            parentWidth = $obj.closest('.navbar-collapse').innerWidth();

        $dropdown.toggleClass(
            'dropdown-menu-right',
            parentWidth <= dropdownWidth + objLeft
        );
    };

    MenuAdvanced.prototype.updateProperties = function () {
        this.toggledClass = 'multi-level-open active';
        this.toggledClass += (window.innerWidth < $SESSIONDATA['sm_width']) ? ' open' : '';
    };

    MenuAdvanced.prototype.clearDropdown = function () {
        this.$widget.find('.dropdown').removeClass(this.toggledClass);
        this.$widget.find('.hide-item').addClass('active');
    };

    return MenuAdvanced;
})();
