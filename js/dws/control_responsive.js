// JavaScript Document

function resize_page(){
    console.warn('WARNING! resize_page() function is deprecated and should not be used in responsive Make-A-Page 2 widgets.');

    if( window['matchMedia'] instanceof Function
        && window.matchMedia("print") instanceof Object
        && !window.matchMedia("print").matches){
        var shrinkedMode = $('body').hasClass('responsive');// && ($(window).width()<1000);  /// 1000px is the small device limit
        var	max_height = 0;
        var	max_height_def = 0;
        var mass_block = new Array ("m-left","m-center","m-right");
        for(var i in mass_block){
            try{
                document.getElementById(mass_block[i]).style.height="auto";
                document.getElementById(mass_block[i]).style.minHeight=10+"px";


                /* do not force the block height if we are watching shrinked version (small device) */
                max_height_def = shrinkedMode
                    ?  0
                    : document.getElementById(mass_block[i]).offsetHeight;

                if(max_height_def>max_height){max_height = max_height_def};
            }
            catch(e){}
        }

//	alert(max_height)
        for(var i in mass_block){
            try{
                document.getElementById(mass_block[i]).style.minHeight = max_height-10+"px";
                document.getElementById("m-body").style.minHeight = max_height+"px";
            }
            catch(e){}
        }
    }
}

function detail_bookmarksite(title,url){
	if (!url) {url = window.location}
	if (!title) {title = document.title}
	var browser=navigator.userAgent.toLowerCase();
	if (window.sidebar) { // Mozilla, Firefox, Netscape
		window.sidebar.addPanel(title, url,"");
	} else if( window.external) { // IE or chrome
		if (browser.indexOf('chrome')==-1){ // ie
			window.external.AddFavorite( url, title);
		} else { // chrome
			alert('Please Press CTRL+D (or Command+D for macs) to bookmark this page');
		}
	}
	else if(window.opera && window.print) { // Opera - automatically adds to sidebar if rel=sidebar in the tag
		return true;
	}
	else if (browser.indexOf('konqueror')!=-1) { // Konqueror
		alert('Please press CTRL+B to bookmark this page.');
	}
	else if (browser.indexOf('webkit')!=-1){ // safari
		alert('Please press CTRL+B (or Command+D for macs) to bookmark this page.');
	} else {
		alert('Your browser cannot add bookmarks using this link. Please add this link manually.')
	}
}

function statusOpen(text,el_id)
{
    setTimeout(function() {
	if ($('#'+el_id+':visible').length || el_id == 0)
	{
		if ($('#idBackRect').length)
		{
			$('#idBackRect').remove();
		}

		var myWidth = 0;
		var myHeight = 0;
		if (el_id == 0)
		{
			myWidth = $(window).width();
			myHeight = $(document).height();
		}
		else
		{
			myWidth = $('#'+el_id).width();
			myHeight = $('#'+el_id).height();
		}

		var left = 0;
		var top = 0;
		if (el_id != 0)
		{
			offset = $('#'+el_id).offset();
			left = offset.left;
			top = offset.top;
		}

		var top2 = $(document).scrollTop()+($(window).height()/2);
		var elem_top = (myHeight/2)-20;
                var imageGifSrc = 'data:image/gif;base64,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';
                var imageBackground = 'url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAAwklEQVRYhe3XXQqDMBhE0dtsIKvNwrOC+mIhTfNrlAzlm0eR4ShomFcI4U2WGGN+6Sfe++49d/S5O8tKWe37AqrhIAEq4uAEquIAnDIOCh/JStkTD9sE7sZB4w0q4KACVMFBAaiEgwyohoMEqIiDE6iKA3DKOBj4Uc+UPfGwQ8Cdx2EXuPusbgJ346ABVMBBBaiCA9sktknmyj6xTXK1zDbJalkrtklGykqxTTJTlsY2yZUysE2yVjYa2yS1sl7+cpMcegPyrqBRcaoAAAAASUVORK5CYII=)';

                var idBackRect = '<div id="idBackRect" style="z-index:10001;padding:0px;margin:0px;position:absolute;left:'+left+'px;top:'+top+'px;width:100%;height:100%;">'+
			'<div id="idBackCont" style="text-align:center;padding-top:'+(el_id == 0 ? top2 : elem_top)+'px"><img border="0"  width="32" height="32" src="' + imageGifSrc + '"/><br/><font style="font-size:24px;color:#000">'+text+'</font></div>'+
			'<div style="background:' + imageBackground + ' repeat #AAAAAA;padding:0px;margin:0px;width:100%;height:100%;position:absolute;filter:progid:DXImageTransform.Microsoft.Alpha(opacity=30);-moz-opacity: 0.3;-khtml-opacity: 0.3;opacity: 0.3;zoom: 1;left:0px;top:0px"></div>'+
                        '</div>';

		$('BODY').append(idBackRect);
		if (el_id != 0)
			$('#idBackRect').data('in_elem',el_id);
		else
			$('#idBackRect').data('in_elem',false);
		$('#idBackRect').css('width', ''+myWidth+'px');
		$('#idBackRect').css('height',''+myHeight+'px');
	}
    }, 1);
}

function statusRemove() {
    setTimeout(function() {
    $('#idBackRect').remove();
    }, 1);
}

/*
* Function which use to to restrict input only symbols matched by RegEx
* If RegEx not passed by default restrict only number symbols.
*/

function restrictInputValueByRegExp(element, regex) {
    var $element;

    if (typeof jQuery === 'function') {
        $element = $(element);
        regex = regex || '[0-9]';

        $element.on('keypress', keypressHandler);
        $element.on('paste', pasteHandler);
        $element.on('change', changeHandler); // Fallback for Android devices
    }

    function keypressHandler(e) {
        var re = new RegExp(regex);
        var char = String.fromCharCode(e.charCode);

        if (
            e.ctrlKey === false
            && e.which > 31 // Except control characters
            && !char.match(re)
        ) {
            e.preventDefault();
        }
    }

    function pasteHandler(e) {
        var $this = $(this);
        var clipboardData = e.originalEvent.clipboardData || window.clipboardData;
        var re = new RegExp(regex, 'g');
        var oldValue = $this.val();
        var restrictedText;

        if (clipboardData) {
            restrictedText = clipboardData.getData('text').match(re);
            e.preventDefault();
        }

        if (restrictedText) {
            restrictedText = restrictedText.join('');

            restrictedText = $this[0].selectionStart
                ? oldValue.slice(0, $this[0].selectionStart) + restrictedText + oldValue.slice($this[0].selectionEnd)
                : restrictedText;
            $this.val(restrictedText);
        }
    }

    function changeHandler(e) {
        var $this = $(this);
        var re = new RegExp(regex, 'g');
        var newValue = $this.val().match(re);

        e.preventDefault();
        $this.val(newValue ? newValue.join('') : '');
    }
}

window.matchMedia || (window.matchMedia = function() {
    "use strict";
// For browsers that support matchMedium api such as IE 9 and webkit
    var styleMedia = (window.styleMedia || window.media);
// For those that don't support matchMedium
    if (!styleMedia) {
        var style = document.createElement('style'),
                script = document.getElementsByTagName('script')[0],
                info = null;
        style.type = 'text/css';
        style.id = 'matchmediajs-test';
        script.parentNode.insertBefore(style, script);
// 'style.currentStyle' is used by IE <= 8 and 'window.getComputedStyle' for all other browsers
        info = ('getComputedStyle' in window) && window.getComputedStyle(style, null) || style.currentStyle;
        styleMedia = {
            matchMedium: function(media) {
                var text = '@media ' + media + '{ #matchmediajs-test { width: 1px; } }';
// 'style.styleSheet' is used by IE <= 8 and 'style.textContent' for all other browsers
                if (style.styleSheet) {
                    style.styleSheet.cssText = text;
                } else {
                    style.textContent = text;
                }
// Test if media query is true or false
                return info.width === '1px';
            }
        };
    }
    return function(media) {
        return {
            matches: styleMedia.matchMedium(media || 'all'),
            media: media || 'all'
        };
    };
}());


/* find all $target objects, get the MAX height among them and set it to all $target objects */
function axEqualHeight($target, options) {

	if (!(this instanceof axEqualHeight)) {
		return new axEqualHeight($target, options);
	}

	var self = this,
		$window = $(window),
		tmr,

	// default options
		_options = {
			trackWindowResize: true, // trigger height update on window resize automatically?
			mobileWidth: 430, // screen size to treat as mobile
			disableOnMobile: true // reset heights on mobile devices
		};

	options = (options instanceof Object)
		? $.extend(_options, options)
		: _options;


	if ($target instanceof jQuery && $target.length) {

		this.update = function () {
			var maxHeight = 0;

			/* reset heights*/
			$target.css("height", "auto");

			/* check for mobile settings */
			if (options.disableOnMobile
				&& $window.width() <= options.mobileWidth) {
				return;
			}

			/* find maximum height first */
			$target.each(function () {
				maxHeight = Math.max(maxHeight, $(this).innerHeight());
			});

			/* set new height for all items */
			$target.height(maxHeight);
		};

		this.update();

		if(options.trackWindowResize) {
			$window.resize(function () {
				window.clearTimeout(tmr);
				tmr = window.setTimeout(self.update, 200);
			});
		}
	}
	return this;
}

/**
 * Calls callback function when all images inside $target block will be loaded
 * If there are no images inside - callback function will be called immediately
 * @param $target - block with images inside or image (jQuery object)
 * @param callback
 */
function onLoadImages($target, callback) {
    var $images = ($target.is('img')) ? $target : $target.find('img');
    var total = $images.length;
    var loaded = 0;

    var onLoad = function() {
        loaded++;

        if (loaded === total) {
            callback();
        }
    };

    if (total) {
        $images.each(function() {
            var img = this;

            if (img.complete) {
                onLoad();
            } else {
                img.addEventListener('load', onLoad);
            }
        });
    } else {
        callback();
    }
}

/**
 * Create class for bsDialog function that open bootstrap modal dialog
 *
 * @param Object | null templates - template that used for creating modal4
 * @param function | null beforeRemove - function that call before remove of modal
 * * @param Object params - {
 *   title: 'Some dialog title',
 *   content: 'Question? Here can be HTML.',
 *   buttons: {
 *     Ok: function($modal) {}, // - callback function
 *     Cancel: '' // - standard close button
 *   },
 *   closeButton: true, // close dialog button in the top right corner,
 *   size: 'md',
 *   container: 'body', // container for modal window markup
 *   backdrop: true, // true or 'static'
 *   onCloseCallback: function() {}, // will be called after closing dialog
 *   onShown: function() {}, // will be called after modal will be opened
 *   manualClosing: false // if true - modal will not be closed automatically after click on some button from 'buttons' param
 *                        // in this case you should close it manually by calling $modal.modal('hide') from your callback function
 *   checkBackgroundModal: false // boolean if true then use checkBackgroundProcess
 * }
 */
function bsDialogClass() {
	this.templates = null;
	this.beforeRemove = null;
	this.params = {};
}
bsDialogClass.prototype = {
	/* Set template for modal */
	initTemplate: function(template) {
		this.templates = template;
	},
	/* set all params that need to process modal */
	initParams: function(params) {
		var self = this;
		var params = $.extend({}, {
			title: '',
			content: '',
			buttons: {
				Ok: function ($modal) {},
				Cancel: ''
			},
			closeButton: true,
			size: 'md',
			container: 'body',
			backdrop: true,
			onCloseCallback: false,
			modalId: '',
			modalClass: '',
			onShown: function() {},
			manualClosing: false
		}, params);

		if (-1 === ['lg', 'md', 'sm'].indexOf(params.size)) {
			params.size = 'md';
		}

		self.modal = $(self.templates.base);
		self.modal.modal({
			backdrop: params.backdrop
		})

		// set modal id
		if (params.modalId) {
			self.modal.attr('id', params.modalId);
		}

		// set modal class
		if (params.modalClass) {
			self.modal.addClass(params.modalClass);
		}

		self.modal.find('.modal-dialog').addClass('modal-' + params.size);

		if (!params.title) {
			self.modal.find('.modal-header').remove();
		} else {
			self.modal.find('.modal-title').html(params.title);

			if (params.closeButton) {
				self.modal.find('.modal-title').before(self.templates.closeButton);
			}
		}

		self.modal.find('.modal-body .content').html(params.content);

		if ('function' === typeof(params.onShown)) {
			self.modal.one('shown.bs.modal', function() {
				params.onShown(self.modal);
			});
		}

		/* save whole params to object */
		self.params = params;
	},
	/* show modal */
	process: function() {
		var self = this;
		var params = self.params;
		var $modal = self.modal;
		//$backgroundModal = $backgroundModal || false;

		var buttons = [];
		$.each(params.buttons, function(title, callback) {
			var $button = $(self.templates.button).text(title);

			/* on click */
			$button.click(function() {
				/* hide modal */
				if (!params.manualClosing) {
					$modal.modal('hide');
				}

				if ('function' === typeof(callback)) {
					callback($modal);
				}
			});

			buttons.push($button);
		});

		$modal.find('.modal-footer').html(buttons);

		/* remove modal markup from the page after it was closed */
		$modal.one('hidden.bs.modal', function() {
			/* Before remove dialog run function beforeRemove if it is isset */
			if ('function' === typeof(self.beforeRemove)) {
				self.beforeRemove();
			}

			$modal.remove();
		});

		$(params.container).append($modal);
		$modal.modal('show');
	},
	/* show modal with check of background */
	checkBackgroundProcess: function () {
		var self = this;
		var $modal = self.modal;
		var params = self.params;
		var $backgroundModal = $('.modal:visible');
		if ($backgroundModal.length) {
			$backgroundModal.modal('hide').one('hidden.bs.modal', function() {
				self.beforeRemove = function () {
					if ($backgroundModal) {
						$backgroundModal.modal('show');
					}

					if ('function' === typeof(params.onCloseCallback)) {
						params.onCloseCallback($modal);
					}
				};
				self.process();
			});
		}
	}
}
/**
 * Create and open bootstrap modal dialog
 *
 * @param params - {
 *   title: 'Some dialog title',
 *   content: 'Question? Here can be HTML.',
 *   buttons: {
 *     Ok: function($modal) {}, // - callback function
 *     Cancel: '' // - standard close button
 *   },
 *   closeButton: true, // close dialog button in the top right corner,
 *   size: 'md',
 *   container: 'body', // container for modal window markup
 *   backdrop: true, // true or 'static'
 *   onCloseCallback: function() {}, // will be called after closing dialog
 *   onShown: function() {}, // will be called after modal will be opened
 *   manualClosing: false // if true - modal will not be closed automatically after click on some button from 'buttons' param
 *                        // in this case you should close it manually by calling $modal.modal('hide') from your callback function
 *   checkBackgroundModal: false // boolean if true then use checkBackgroundProcess
 * }
 */
function bsDialog(params) {
	var bsDialogObj = new bsDialogClass();
	bsDialogObj.initTemplate({
		base: [
			'<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">',
			'<div class="modal-dialog">',
			'<div class="modal-content">',
			'<div class="modal-header">',
			'<h4 class="modal-title"></h4>',
			'</div>',
			'<div class="modal-body">',
			'<div class="content"></div>',
			'</div>',
			'<div class="modal-footer"></div>',
			'</div>',
			'</div>',
			'</div>'
		].join('\n'),
		closeButton: '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
		button: '<button type="button" class="btn btn-default"></button>'
	});
	bsDialogObj.initParams(params);
	/* Base process strategy */
    var processStrategy = function() {
		return bsDialogObj.process();
	};

    // there may be opened another bs modal
    // in this case we should hide it and show again after currently builded modal will be closed
	// only if we need to show it again
	if (true == params.checkBackgroundModal) {
		processStrategy = function() {
			return bsDialogObj.checkBackgroundProcess();
		}
	}

	return processStrategy();
}

/**
 * Simple confirm dialog with buttons "Yes" and "No"
 * If pressed "Yes" - callback will be called
 * Based on bsDialog function
 *
 * text.alternativeButtons - true can be passed to change Yes/No buttons to OK/CANCEL
 *
 * @param text - text or object with bsDialog params
 * @param yesCallback
 * @param noCallback
 */
function bsConfirm(text, yesCallback, noCallback) {
    noCallback = noCallback || false;

    var params = {
        content: text,
        buttons: {
            Yes: yesCallback,
            No: ('function' === typeof(noCallback)) ? noCallback : 'close'
        },
        size: 'sm',
        closeButton: false
    };

    if ('object' === typeof(text)) {
        delete(params.content);

        if (text.alternativeButtons) {
            params.buttons = {
                OK: yesCallback,
                CANCEL: ('function' === typeof(noCallback)) ? noCallback : 'close'
            };
        }

        $.extend(params, text);
    }

    bsDialog(params);
}

/**
 * Simple alert dialog based on bsDialog function
 * Callback will be called after closing dialog
 *
 * @param data - string or object with bsDialog params
 * @param callback
 */
function bsAlert(data, callback) {
    var params = {
        content: data,
        buttons: {
            OK: callback
        },
        size: 'sm',
        closeButton: false,
        onCloseCallback: callback
    };

    if ('object' === typeof(data)) {
        delete(params.content);
        $.extend(params, data);
    }

	bsDialog(params);
}

/**
 * Set currency like V9_VehiclePrice::setCurrency
 * @param price
 * @param currency - string
 * @param position - 0 | 1
 * @returns {*}
 */
function setCurrency(price, currency, position) {
	var currencyPositionLeft = 0;
	var currencyPositionRight = 1;

	var result = price;

	switch (position) {
		case currencyPositionRight:
			result = price + currency;
			break;
		case currencyPositionLeft:
		default:
			result = currency + price;
			break;
	}

	return result;
}

function isInViewport($element) {
    var $window = $(window),
        elementTop = $element.offset().top,
        elementBottom = elementTop + $element.outerHeight(),
        viewportTop = $window.scrollTop(),
        viewportBottom = viewportTop + $window.height();

    return elementBottom > viewportTop && elementTop < viewportBottom;
};

/**
 * Helper function to correctly set up the prototype chain for subclasses
 *
 * @param {Object} childProps
 *
 * @returns {function} Created child constructor function
 */
function extend(childProps) {
    var parent = this;
    var ChildConstructor;

    if (childProps && _.has(childProps, 'constructor')) {
        ChildConstructor = childProps.constructor;
    } else {
        ChildConstructor = function () {
            return parent.apply(this, arguments);
        };
    }

    ChildConstructor.prototype = Object.create(parent.prototype);
    _.assign(ChildConstructor.prototype, childProps);
    ChildConstructor.constructor = ChildConstructor;

    return ChildConstructor;
}

window.transitionData = (function (){
    var i, jsStyle;
    var transitions = [
        {'jsStyle': 'transition', 'cssStyle': 'transition', 'event': 'transitionend'},
        //{'jsStyle': 'OTransition', 'cssStyle': '-o-transition', 'event': 'oTransitionEnd otransitionend'}, // outdated
        {'jsStyle': 'MsTransition', 'cssStyle': '-ms-transition', 'event': 'MSTransitionEnd MsTransitionEnd'},
        {'jsStyle': 'MozTransition', 'cssStyle': '-moz-transition', 'event': 'mozTransitionEnd'},
        {'jsStyle': 'WebkitTransition', 'cssStyle': '-webkit-transition', 'event': 'webkitTransitionEnd'}
    ];
    var node = document.createElement('div');

    for(i=0; i<transitions.length; i++) {
        jsStyle = transitions[i]['jsStyle'];
        if(node.style[jsStyle] != null) {
            return transitions[i];
        }
    }
    return {'jsStyle': null, 'cssStyle': null, 'event': null};
})();

/**
 * Script loader functions
 * @type {{loadBySrcBatch: Window.jsScriptLoader.loadBySrcBatch, loadBySrc: Window.jsScriptLoader.loadBySrc}}
 */
window.jsScriptLoader = {
    /**
     * Loads and adds batch js scripts by path in head block if script not exists yet.
     * Only after loading scripts launches callback function
     * @param {array} scriptPaths array of script src
     * @param {callback} callback function
     * @param {string} loadingType
     */
    loadBySrcBatch: function (scriptPaths, callback, loadingType) {
        var countScriptsLoaded = 0;

        if ('function' !== typeof callback) {
            callback = function() {};
        }

        function counter() {
            countScriptsLoaded++;
            if (scriptPaths.length === countScriptsLoaded) {
                callback();
            }
        }

        if (scriptPaths.length > 0) {
            $.each(scriptPaths, function (i, path) {
                jsScriptLoader.loadBySrc(path, function () {
                    counter();
                }, loadingType);
            });
        } else {
            callback();
        }

    },

    /**
     * Loads and adds js script by path in head block if script not exists yet.
     * Only after loading script launches callback function
     * @param {string} scriptPath script src
     * @param {callback} callback function
     * @param {string} loadingType
     */
    loadBySrc: function(scriptPath, callback, loadingType) {
        var head = document.head || document.getElementsByTagName('head')[0];
        var LOADING_TYPE_ASYNC = 'async';
        var LOADING_TYPE_DEFER = 'defer';
        /**
         * is script already loaded - by default false
         * @type {boolean}
         */
        var scriptExists = false;

        if ('function' !== typeof callback) {
            callback = function() {};
        }

        /**
         * check exist loaded script in var loadedScriptLinks
         * loadedScriptLinks - global array of merged scripts to jsPack
         */
        if (
            "undefined" !== typeof window.loadedScriptLinks
            && $.isArray(window.loadedScriptLinks)
            && -1 !== $.inArray(scriptPath, window.loadedScriptLinks)
        ) {
            scriptExists = true;
        }

        /* check exist script in head block */
        if (!scriptExists) {
            scriptExists = $('script[src*="' + scriptPath + '"]', head).length;
        }

        /* loads script if needed */
        if (!scriptExists) {
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.setAttribute('data-mode', 'load');
            script.src = scriptPath;
            script.async = false;

            if (loadingType === LOADING_TYPE_DEFER) {
                script.defer = true;
            }

            if (loadingType === LOADING_TYPE_ASYNC) {
                script.async = true;
            }

            script.onload = callback;
            script.onerror = callback;
            head.appendChild(script);
        } else {
            /* script is already loaded */
            callback();
        }
    },

    /**
     * Get snippet loading method
     * @returns {{async: boolean, defer: boolean}}
     */
    getLoadingMethod: function () {
        return window.$SESSIONDATA.snippetLoadingMethod;
    },
};

/**
 *	MERGE 2 ARRAY IN ONE WITH REPLACE
 *  firstItemCounter - start count for replace
 *  arrayVehiclesFullList - final array after merge
 *  arrayVehiclesPartList - part array
 */
function mergeVehicleArray(firstItemCounter, arrayVehiclesFullList, arrayVehiclesPartList) {
    Array.prototype.splice.apply(
        arrayVehiclesFullList,
        [firstItemCounter, arrayVehiclesPartList.length].concat(arrayVehiclesPartList)
    );
}

$(function () {

    if (
        window.System
        && $.isFunction(System.on)
    ) { // checking if the current version is MAP2

        System.on('styler.ready.after', function () {
            var elementIndex;

            if ($('body').hasClass('mobile')) {
                return;
            }

            // affects forms located on a page directly (not in modals)
            $('[data-autofocus]').each(function (index) {
                // detect if the input field is fully visible within current viewport
                if (isInViewport($(this))) {
                    elementIndex = index;
                }
            }).eq(elementIndex).trigger('focus');

            // replace prototype Modal for form with event focusout
            $.fn.modal.Constructor.prototype.enforceFocus = function () {
                var $this = this.$element;

                $(document)
                    .off('.replaceEnforceFocus') // guard against infinite focus loop
                    .on('focusin.replaceEnforceFocus', function (event) {
                        var $activeElement = $(document.activeElement);

                        if (
                            !(
                                document == event.target
                                || $this.is($activeElement)
                                || $this.has($activeElement).length
                            )
                        ) {
                            $this.trigger('focus');
                        }
                    });

                $this
                    .off('.replaceEnforceFocus')
                    .on('focusout.replaceEnforceFocus', function () {
                        window.setTimeout(function () {
                            var $activeElement = $(document.activeElement);

                            if (
                                $activeElement.length
                                && !(
                                    $this.is($activeElement)
                                    || $this.has($activeElement).length
                                )
                            ) {
                                $this
                                    .trigger('focus')
                                    .find(':enabled')
                                    .not(':hidden')
                                    .eq(0)
                                    .trigger('focus');
                            }
                        }, 10);
                    });
            };

            // set focus on first visible input in forms located in modals and closer than 250 px from modal top border
            $('.modal.focusout').on('shown.bs.modal', function () {
                var $this = $(this),
                    dialogOffset = $this.find('.modal-dialog').offset(),
                    $firstInput = $this.find('input:visible').eq(0),
                    inputOffset = $firstInput.offset(),
                    maxDistance = 250; // max distance to modal top border when first input need to get autofocus

                if (
                    $firstInput.length
                    && dialogOffset
                    && inputOffset
                    && ((inputOffset.top - dialogOffset.top) <= maxDistance)
                ) {
                    $firstInput.trigger('focus');
                } else {
                    $this
                        .trigger('focus')
                        .find('.modal-content')
                        .scrollTop(0);
                }
            });
        });
    }

    $('body.mobile')
        .on(['paste', 'keyup', 'keydown', 'change'].join(' '), 'input[maxlength], textarea[maxlength]', function(){
            var $this = $(this),
                val = $this.val(),
                maxLength = $this.attr('maxlength');

            if(val.length > maxLength) {
                $this.val(val.substr(0, maxLength));
            }
        });

    /* manual activate modal task#16142 */
    $(document).on('click', '.js-toggle-modal', function (e) {
        var target = $(this).data('target');

        $(target).modal();
        e.preventDefault();
    });
});

/**
 * Check is page has dev mode flag in url
 * @return {boolean}
 */
function isDevMode() {
    return ('#DEV' === window.location.hash.toUpperCase());
}
