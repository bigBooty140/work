/* global ThreeSixty */

var Vir360Player = function (params) {
    /**
     * Here must be listed all params passed into constructor for store them
     */
    // TODO: Add documentation comments for params
    var playerParams = {
        containerId: '',
        imageId: '',
        path: '',
        type: '.jpg',
        totalFrames: '',
        list_tags: [],
        tags_details: [],
        list_damages: [],
        conditionReportData: {},
        exteriorGrading: null,
        reviewCount: null,
        fullscreenOnly: false,
        allowFullscreen: true,
        legacyFullscreen: false,
        autoloadThreeSixty: false,
        autoPlay: false,
        widgetParams: {},
        pageId: '',
        fullscreenContainerTemplate: '<div class="{{CONTAINER_CLASS}}">'
            + '<div class="vir360-fullscreen-container">'
            + '<div class="{{CONTENT_CLASS}}"></div>'
            + '</div></div>',
    };

    var damageParams = {
        damage: '',
        partCost: '',
        severity: '',
        laborHours: '',
        description: '',
        paintHours: '',
        result: '',
        metalHours: '',
        flatRateCost: '',
        estimatedRepairCost: '',
        paintMeter: '',
    };

    $.each(params, function (key, value) {
        if ('undefined' !== typeof(playerParams[key])) {
            playerParams[key] = value || playerParams[key];
        }
    });

    this.playerParams = playerParams;
    this.damageParams = damageParams;
    this.tagIds = [];
    this.damageTagIds = [];

    this.preselectDomElements(this.playerParams.containerId);

    if (!this.playerParams.fullscreenOnly && this.playerParams.imageId) {
        this.initMain();
    }
};

Vir360Player.prototype = {
    /**
     * Doing main steps to prepare the working condition
     */
    initMain: function () {
        this.preselectDomElements(this.playerParams.containerId);
        this.get360ImageParams(this.playerParams);
        this.inFullscreen = false;
    },

    /**
     * Reinit player with new image id and open it in fullscreen
     * @param {string} imageId
     * @param {boolean} isMinimizeBtnHidden
     */
    openFullscreenImageById: function (imageId, isMinimizeBtnHidden) {
        if (imageId === this.playerParams.imageId) {
            this.toggleFullScreen(isMinimizeBtnHidden);
        } else if (imageId) {
            this.reloadPlayer(imageId, true);
        }

        $(this.elementSelector.OPEN_360_PLAYER_BTN).prop('disabled', true);
    },

    /**
     * Reload widget layout with new image ID
     * @param {string} imageId
     * @param {boolean} autoloadThreeSixty
     */
    reloadPlayer: function (imageId, autoloadThreeSixty) {
        var self = this;
        var widgetParams = this.playerParams.widgetParams;
        var $container = this.$playerContainer;

        this.threeSixtyInstance && this.threeSixtyInstance.destroyImgLoadingQueue();

        this.playerParams.imageId = imageId;
        this.playerParams.autoloadThreeSixty = autoloadThreeSixty || false;
        widgetParams.embedded360ImageId = imageId;

        window.statusOpen('Loading...', 0);

        $.ajax({
            url: '/ajax',
            type: 'post',
            dataType: 'json',
            data: {
                oper: 'get_widget',
                widget: 'vir360_player',
                preview: 0,
                params: widgetParams,
                dws_page_id: this.playerParams.pageId,
            },
            success: function (data) {
                var html = data.html;
                var content = $(html)
                    .find(self.elementSelector.VIR360_PLAYER_MODUL)
                    .html();

                $container.html(content);
                self.initMain();

                if (self.playerParams.fullscreenOnly) {
                    self.toggleFullScreen(true);
                }
            },
            error: function () {
                window.bsAlert('Something was wrong, 360 player is unavailable');
            },
            complete: function () {
                window.statusRemove();
            },
        });
    },


    /**
     * Get 360 image params by AJAX and resolve data
     * @param {object} playerParams
     */
    get360ImageParams: function (playerParams) {
        var self = this;

        this.$threesixtyPreview.toggleClass('loading', true);

        $.ajax({
            url: '/ajax',
            type: 'post',
            dataType: 'json',
            data: {
                ajax_controller: 'Vir360/Media',
                oper: 'get_360_image_params',
                imageId: playerParams.imageId,
            },
            success: function (data) {
                data = data.result;

                playerParams.path = data.link_360_img;
                playerParams.totalFrames = data.count_img;
                playerParams.type = data.file_type;
                playerParams.list_tags = data.list_tags;
                playerParams.tags_details = data.tags_details;
                playerParams.list_damages = data.list_damages;
                playerParams.conditionReportData = data.conditionReportData.damages || {};
                playerParams.exteriorGrading = data.conditionReportData.grading.exterior;
                playerParams.reviewCount = data.reviewCount;

                self.$threesixtyPreview.toggleClass('loading', false);
                self.init(playerParams);
            },
            error: function () {
                self.$threesixtyPreview.toggleClass('loading', false);
                self.$threesixtyPreview.toggleClass('loading-error', true);

                window.console.error('360 Image data loading error.');
            },
        });
    },

    /**
     * Collection of selectors for player elements and main blocks
     */
    elementSelector: {
        BODY: 'body',
        VIR360_PLAYER_MODUL: '.modul-r-vir360-player',
        FULLSCREEN_MODAL_CONTAINER: '.modul-r-vir360-player-fullscreen-modal',
        FULLSCREEN_MODAL_CONTENT: '.vir360-fullscreen-content',
        THREESIXTY_PREVIEW: '.threesixty-preview',
        VIR360_IMAGE: '.vir360-image',
        ROTATION_CONTAINER: '.rotation-container',
        VIR360_TAGS_CONTAINER: '.vir-360-tags-container',
        VIR360_TAG_CONTENT_MODAL: '.vir-360-tag-content-modal',
        PREVIEW_IMAGE: '.preview-picture',
        TAG_MEDIA_IMG: '.tag-media-images',
        TAG_INFO_TEXT: '.tag-info-text',
        TAG_INSPECTED_DAMAGE: '.tag-inspected-damage',
        THREESIXTY_CURRENT_IMAGE: '.threesixty_images .current-image',
        ID_VIR360_TAG: '#vir-360-tag_',
        ID_VIR360_PULSE: '#vir-360-pulse_',
        ID_VIR360_DAMAGE_TAG: '#vir-360-damage-tag_',
        VIR360_TAG: '.vir-360-tag',
        VIR360_DAMAGE_TAG: '.vir-360-damage-tag',
        CLOSE_TAG_CONTENT: '.close-tag-content',
        TAG_MEDIA_THUMBNAIL: '.tag-media-images .thumbnail',
        CLICK_N_DRAG_BACKDROP: '.vir-360-click-n-drag',
        BTN_TOGGLE_FULLSCREEN_MODE: '.toggle-fullscreen-mode',
        BTN_CLOSE_FULLSCREEN_MODE: '.vir360-fullscreen-close-btn',
        BTN_TOGGLE_TAGS: '.toggle-tags-mode',
        EXTERIOR_GRADING: '.exterior-grading',
        VIR360_REVIEW_QTY: '.vir-360-review-qty',
        BTN_PREV_TAG: '.vir-360-heading-left',
        BTN_NEXT_TAG: '.vir-360-heading-right',
        BTN_TAG_NAVIGATION_BUTTONS: '.tag-navigation',
        VIR360_HEADING_TEXT: '.vir-360-heading-text',
        VIR360_FULLSCREEN_CLOSE_BTN: '.vir360-fullscreen-close-btn',
        VIR360_FULLSCREEN_RIGHT_BTN: '.vir360-fullscreen-right-btn',
        VIR360_FULLSCREEN_LEFT_BTN: '.vir360-fullscreen-left-btn',
        VIR360_DRAG_ICON: '.vir360-drag-icon',
        OPEN_360_PLAYER_BTN: '.open-360-player-btn',
    },

    /**
     * Initializes 360 player
     * @param {object} playerParams
     */
    init: function (playerParams) {
        var threeSixtyParams = {
            totalFrames: playerParams.totalFrames, // total number of images you have for 360 slider
            endFrame: playerParams.totalFrames, // end frame for the auto spin animation
            conditionReportData: playerParams.conditionReportData, // condition report data for damage tags
            exteriorGrading: playerParams.exteriorGrading, // exterior grading
            reviewCount: playerParams.reviewCount, // count of the vir 360 video
            currentFrame: 1, // the start frame for auto spin
            imgList: '.threesixty_images', // selector for image list
            progress: '.spinner', // selector to show the loading progress
            imagePath: playerParams.path, // path to the images
            imgArray: [], // images array to load 360 player images
            filePrefix: this.getFileNamePrefix(playerParams.totalFrames), // file prefix if any
            ext: playerParams.type, // extension for the assets
            height: 0, // height of images
            width: 0, // width of images
            navigation: false, // default navigation controls
            position: 'bottom-center', // position of controls
            disableSpin: false, // if you want to disable the auto spin
            responsive: true, // full aspect ratio responsiveness
            fullscreen: true, // fullscreen capabilities
            fSBackgroundColor: '#000000', // fullscreen background color
            autoplayDirection: 1, // direction of play
            zeroPadding: true, // if your images are padded to the same number of characters by 0
        };
        var count = playerParams.totalFrames;
        var imageNameLength = 3;

        for (count; count > 0; count--) {
            threeSixtyParams.imgArray.push(
                playerParams.path + String(count)
                    .padStart(imageNameLength, '0') + playerParams.type
            );
        }

        if (!playerParams.allowFullscreen) {
            this.$fullscreenButton.hide();
        }

        this.imageFrames = this.sortTagsByFrame(playerParams.list_tags);
        this.damageFrames = this.sortTagsByFrame(playerParams.list_damages);
        this.tagsContent = playerParams.tags_details;
        this.frameId = 0;

        this.bindEvents(threeSixtyParams);
    },

    /**
     * Find and store needed player DOM elements
     * @param {string} containerId
     */
    preselectDomElements: function (containerId) {
        var es = this.elementSelector;

        this.$body = $(es.BODY);
        this.$playerBox = $('#' + containerId);
        this.$playerContainer = this.$playerBox.find(es.VIR360_PLAYER_MODUL);

        this.$threesixtyPreview = this.$playerContainer.find(es.THREESIXTY_PREVIEW);
        this.$threeSixtyContainer = this.$playerContainer.find(es.VIR360_IMAGE);
        this.$rotationContainer = this.$playerContainer.find(es.ROTATION_CONTAINER);
        this.$fullscreenButton = this.$rotationContainer.find(es.BTN_TOGGLE_FULLSCREEN_MODE);
        this.$fullscreenCloseButton = this.$rotationContainer.find(es.BTN_CLOSE_FULLSCREEN_MODE);
        this.$toggleTagsButton = this.$rotationContainer.find(es.BTN_TOGGLE_TAGS);
        this.$exteriorGrading = this.$rotationContainer.find(es.EXTERIOR_GRADING);
        this.$reviewCount = this.$rotationContainer.find(es.VIR360_REVIEW_QTY);
        this.$loadNextTagButton = this.$rotationContainer.find(es.BTN_NEXT_TAG);
        this.$loadPrevTagButton = this.$rotationContainer.find(es.BTN_PREV_TAG);
        this.$tagNavigationButtons = this.$rotationContainer.find(es.BTN_TAG_NAVIGATION_BUTTONS);
        this.$tagHeadingText = this.$rotationContainer.find(es.VIR360_HEADING_TEXT);
        this.$tagContainer = this.$threeSixtyContainer.find(es.VIR360_TAGS_CONTAINER);
        this.$tagsContentContainer = this.$threeSixtyContainer.find(es.VIR360_TAG_CONTENT_MODAL);
        this.$previewImage = this.$threesixtyPreview.find(es.PREVIEW_IMAGE);
        this.$tagMediaImg = this.$playerContainer.find(es.TAG_MEDIA_IMG);
        this.$tagInfoText = this.$playerContainer.find(es.TAG_INFO_TEXT);
        this.$tagInspectedDamage = this.$playerContainer.find(es.TAG_INSPECTED_DAMAGE);
        this.$clickDragBackdrop = this.$playerContainer.find(es.CLICK_N_DRAG_BACKDROP);
        this.$dragClickIcon = this.$playerContainer.find(es.VIR360_DRAG_ICON);
    },

    /**
     * Initialize ThreeSixty module
     * @param {object} threeSixtyParams
     */
    initThreeSixty: function (threeSixtyParams) {
        var self = this;

        threeSixtyParams.height = this.$previewImage.height();
        threeSixtyParams.width = this.$previewImage.width();

        this.$reviewCount.find('span').text(threeSixtyParams.reviewCount);
        // eslint-disable-next-line new-cap
        this.threeSixtyInstance = this.$threeSixtyContainer.ThreeSixty(threeSixtyParams);

        this.$threeSixtyContainer.on('threesixty.imagesLoaded', function () {
            self.$rotationContainer.toggleClass('preview', false);

            if (self.playerParams.autoPlay) {
                self.threeSixtyInstance.play();
                self.$clickDragBackdrop.hide();
                self.$fullscreenCloseButton.hide();
            }
        });

        this.$threeSixtyContainer.on('threesixty.showCurrentFrame', function (event, data) {
            self.frameId = data.frameId;
            self.addTags(self.imageFrames[self.frameId]);
            self.addDamageTags(self.damageFrames[self.frameId]);
            self.updateTags(self.imageFrames[self.frameId], self.damageFrames[self.frameId]);
        });

        $(window).on('resize', function () {
            self.updateTags(self.imageFrames[self.frameId], self.damageFrames[self.frameId]);
        });
    },

    /**
     * Bind 360 Player Events
     * @param {object} threeSixtyParams
     */
    bindEvents: function (threeSixtyParams) {
        var self = this;
        var CLICK_EVENTS = 'click touchstart touchmove';

        self.filterTagIds();

        this.$tagContainer.on(CLICK_EVENTS, this.elementSelector.VIR360_TAG, function () {
            var contentId = $(this).data('contentid');

            self.loadTag(contentId);
            self.$tagsContentContainer.removeClass('damage-content');
        });

        this.$tagContainer.on(CLICK_EVENTS, this.elementSelector.VIR360_DAMAGE_TAG, function () {
            var contentId = $(this).data('contentid');

            self.loadDamageTag(contentId);
            self.$tagsContentContainer.addClass('damage-content');
        });

        this.$tagsContentContainer.on(CLICK_EVENTS, this.elementSelector.CLOSE_TAG_CONTENT, function () {
            if (self.$tagMediaImg.children().length) {
                self.$tagMediaImg.slick('unslick');
            }

            self.$tagsContentContainer.toggleClass('show', false);
            self.$tagContainer.toggleClass('hide', false);
        });

        this.$tagsContentContainer.on(CLICK_EVENTS, function (event) {
            event.stopPropagation();
        });

        this.$loadNextTagButton.on(CLICK_EVENTS, function () {
            self.loadNextTag(self.currentTagId);
        });

        this.$loadPrevTagButton.on(CLICK_EVENTS, function () {
            self.loadPrevTag(self.currentTagId);
        });

        this.$clickDragBackdrop.one(CLICK_EVENTS + ' mousedown', function () {
            self.$clickDragBackdrop.hide();
            self.$toggleTagsButton.show();
            self.$dragClickIcon.show();

            if (self.playerParams.exteriorGrading) {
                self.$exteriorGrading.show();
                self.$exteriorGrading.find('span')
                    .addClass('grading_' + Math.floor(self.playerParams.exteriorGrading))
                    .text(parseFloat(self.playerParams.exteriorGrading).toFixed(1));
            }
        });

        this.$toggleTagsButton.on(CLICK_EVENTS, function () {
            self.$toggleTagsButton.toggleClass('tags-on tags-off');
            self.$tagContainer.toggleClass('hidden', self.$toggleTagsButton.hasClass('tags-off'));
        });

        this.$fullscreenButton.on(CLICK_EVENTS, function () {
            if (self.playerParams.legacyFullscreen && self.threeSixtyInstance) {
                self.threeSixtyInstance.fullscreen();
            } else {
                self.toggleFullScreen();
            }
        });

        this.$fullscreenCloseButton.on(CLICK_EVENTS, function () {
            self.fullscreenClose();
        });

        this.$threeSixtyContainer.on('threesixty.toggleFullscreen', function () {
            self.updateTags(self.imageFrames[self.frameId], self.damageFrames[self.frameId]);
        });

        if (this.playerParams.autoloadThreeSixty) {
            this.initThreeSixty(threeSixtyParams);
        } else {
            this.$threesixtyPreview.one(CLICK_EVENTS, function () {
                self.initThreeSixty(threeSixtyParams);
            });
        }
    },

    /**
     * Determine and store natural and scaled 360 image sizes
     */
    loadImageSizes: function () {
        var $currentImage = this.$playerContainer.find(this.elementSelector.THREESIXTY_CURRENT_IMAGE);

        this.imageNaturalSize = {
            width: $currentImage.prop('naturalWidth'),
            height: $currentImage.prop('naturalHeight'),
        };
        this.imageScaledSize = {
            width: $currentImage.prop('width'),
            height: $currentImage.prop('height'),
        };
    },

    /**
     * get filtered tag ids from imageFrames
     */
    filterTagIds: function () {
        var self = this;

        self.imageFrames.forEach(function (tag) {
            tag.forEach(function (item) {
                if (self.tagIds.indexOf(item.tagId) === -1) {
                    self.tagIds.push(item.tagId);
                }
            });
        });
        self.damageFrames.forEach(function (tag) {
            tag.forEach(function (item) {
                if (
                    self.playerParams.conditionReportData
                    && self.playerParams.conditionReportData.hasOwnProperty(item.damage)
                    && self.playerParams.conditionReportData[item.damage].val > -1
                    && self.damageTagIds.indexOf(item.damage) === -1
                ) {
                    self.damageTagIds.push(item.damage);
                }
            });
        });
    },

    /**
     * Collects tags into their corresponding frames
     * @param {array} tagsList
     * @return {[]}
     */
    sortTagsByFrame: function (tagsList) {
        var collectInFrame = function (tag) {
            var frameNumber = parseInt(tag.photo) - 1;

            if (frameNumber) {
                sortedTags[frameNumber] = sortedTags[frameNumber] || [];
                sortedTags[frameNumber].push(tag);
            }
        };
        var collectInDamageFrame = function (tag) {
            var frameNumber = parseInt(tag.photo_name) - 1;

            if (frameNumber) {
                sortedTags[frameNumber] = sortedTags[frameNumber] || [];
                sortedTags[frameNumber].push(tag);
            }
        };
        var sortedTags = [];

        if (Array.isArray(tagsList) && tagsList.length) {
            tagsList.forEach(tagsList[0].damage ? collectInDamageFrame : collectInFrame);
        }

        return sortedTags.reverse();
    },

    /**
     * Add tags elements on image
     * @param {array} tagsParam
     */
    addTags: function (tagsParam) {
        var tagsContent = '';

        if (tagsParam) {
            tagsContent = tagsParam
                .map(this.createTag)
                .join('');
        }

        this.$tagContainer.html(tagsContent);
    },

    /**
     * Add tags elements on image
     * @param {object} tagsParam
     */
    addDamageTags: function (tagsParam) {
        var tagsContent = '';

        if (tagsParam && Array.isArray(tagsParam)) {
            tagsContent = tagsParam
                .map(this.createDamageTag)
                .join('');
        }

        if (tagsContent) {
            this.$tagContainer.html(
                this.$tagContainer.html() + tagsContent
            );
        }
    },

    /**
     * Create tag element layout
     * @param {object} params
     * @param {string} params.id
     * @param {string} params.tagId
     * @return {string}
     */
    createTag: function (params) {
        var TAG_TEMPLATE = '<span class="vir-360-tag"'
            + ' id="vir-360-tag_{ID}"'
            + ' data-contentid="{CONTENT_ID}"'
            + ' aria-hidden="true"></span>'
            + '<span class="vir-360-pulse" id="vir-360-pulse_{ID}"></span>';

        return TAG_TEMPLATE
            .replace(/{ID}/g, params.id)
            .replace('{CONTENT_ID}', params.tagId);
    },

    /**
     * Create damage tag element layout
     * @param {object} params
     * @param {string} params.damage
     * @return {string}
     */
    createDamageTag: function (params) {
        var currentDamage;
        var TAG_TEMPLATE;

        if (params.damage) {
            currentDamage = this.vir360PlayerInstance.playerParams.conditionReportData[params.damage];
        } else {
            return;
        }

        if (currentDamage && parseInt(currentDamage.val) > -1) {
            TAG_TEMPLATE = '<span class="vir-360-damage-tag damage-val_{VAL}"'
                + ' id="vir-360-damage-tag_{ID}"'
                + ' data-contentid="{ID}"'
                + ' aria-hidden="true">'
                + '<span class="damage-tag"></span>'
                + '<span class="vir-360-damage-value">' + parseFloat(currentDamage.val).toFixed(1) + '</span>'
                + '</span>';

            return TAG_TEMPLATE
                .replace(/{ID}/g, params.damage)
                .replace(/{VAL}/g, Math.floor(currentDamage.val));
        }
    },

    /**
     * Set tag position on image
     * @param {number|string} tagId
     * @param {number} coordX
     * @param {number} coordY
     */
    setTagPosition: function (tagId, coordX, coordY) {
        var $tag = this.$playerContainer.find(this.elementSelector.ID_VIR360_TAG + tagId);
        var $tagPulse = this.$playerContainer.find(this.elementSelector.ID_VIR360_PULSE + tagId);
        var $damageTag = this.$playerContainer.find(this.elementSelector.ID_VIR360_DAMAGE_TAG + tagId);
        var HALF_DAMAGE_TAG_HEIGHT_IN_PX = 20;

        coordX = this.normalizeCoordinate(coordX, this.imageNaturalSize.width, this.imageScaledSize.width);
        coordY = this.normalizeCoordinate(coordY, this.imageNaturalSize.height, this.imageScaledSize.height);

        $tag.css('transform', 'translate(' + coordX + 'px, ' + coordY + 'px)');
        $tagPulse.css('transform', 'translate(' + coordX + 'px, ' + coordY + 'px)');
        $damageTag.css('transform', 'translate(' + coordX + 'px, ' + (coordY - HALF_DAMAGE_TAG_HEIGHT_IN_PX) + 'px)');
    },

    /**
     * Determine scale factor and convert coordinate from real image size to scaled image size
     * @param {number} coord
     * @param {number} imageRealSize
     * @param {number} imageScaledSize
     * @return {number}
     */
    normalizeCoordinate: function (coord, imageRealSize, imageScaledSize) {
        var normalizedCoord;
        var scaleFactor = imageScaledSize / imageRealSize;
        var tagIconHeight = 24;

        normalizedCoord = Math.round(coord * scaleFactor) - (tagIconHeight / 2);

        return normalizedCoord;
    },

    /**
     * Update tags scale factor and position
     * @param {array} tags
     * @param {array} damageTags
     */
    updateTags: function (tags, damageTags) {
        var self = this;

        if (Array.isArray(tags) || Array.isArray(damageTags)) {
            this.loadImageSizes();
        }

        if (Array.isArray(tags)) {
            tags.forEach(function (tag) {
                self.setTagPosition(tag.id, tag.x, tag.y);
            });
        }

        if (Array.isArray(damageTags)) {
            damageTags.forEach(function (tag) {
                self.setTagPosition(tag.damage, tag.x, tag.y);
            });
        }
    },

    /**
     * Find and load tag content by ID
     * @param {number|string} contentId
     * @param {boolean} isDamage
     */
    loadTagContent: function (contentId, isDamage) {
        var self = this;
        var getContentParams = function (contentId) {
            var params = null;

            if (Array.isArray(self.tagsContent)) {
                params = self.tagsContent.filter(function (contentElement) {
                    return contentElement.id === contentId;
                });

                params = params[0] || null;
            }

            return params;
        };
        var tagContent = getContentParams(contentId);
        var damageContent = self.playerParams.conditionReportData[contentId];
        var damageImages = [];

        this.clearModalContent();

        if (tagContent) {
            this.addTagImages(tagContent.tag_photos_links, tagContent.tag_video_link);
            this.addTagInformationText(tagContent.description);
        }

        this.$tagNavigationButtons.css({
            display: self[isDamage ? 'damageTagIds' : 'tagIds']
                .length > 1 ? 'block' : 'none',
        });

        if (isDamage) {
            this.$tagHeadingText.html(
                damageContent.description
                + '<span class="vir360-grading_' + Math.floor(damageContent.val) + '">'
                + parseFloat(damageContent.val).toFixed(1)
                + '</span>'
            );
            this.addTagDamage(damageContent);


            if (damageContent.images) {
                damageImages = damageContent.images.map(function (elem) {
                    var imgWithHeight = elem.desktop.split('.');

                    imgWithHeight[0] = imgWithHeight[0] + '_w900_h625';
                    imgWithHeight = imgWithHeight.join('.');

                    return imgWithHeight;
                });
                this.addTagImages(damageImages);
            }
        } else {
            this.$tagHeadingText.text('Tag Content');
        }
    },

    /**
     * Clear all previous content in tag modal
     */
    clearModalContent: function () {
        this.$tagMediaImg.html('');
        this.$tagInfoText.html('');
        this.$tagInspectedDamage.html('');
    },

    /**
     * Add images to tag content modal
     * @param {array} imagesArray
     * @param {string} videoLink
     */
    addTagImages: function (imagesArray, videoLink) {
        var IMAGE_TEMPLATE = '<a href="{HREF}" class="thumbnail">'
            + '<img class="img-responsive" src="{SRC}" alt="Image in tag">'
            + '</a>';
        var VIDEO_TEMPLATE = '<a href="#tag-video" id="tag-video-link" class="thumbnail">'
            + '<div class="tag-video-overlay"></div><div id="tag-video">'
            + '<span class="fullscreen-overlay"></span>'
            + '<video><source src="{SRC}" type="video/mp4">'
            + ' Your browser does not support the video tag.'
            + '</video></div></a>';
        var images = [];
        var video = videoLink ? VIDEO_TEMPLATE.replace('{SRC}', videoLink) : '';

        images = imagesArray.map(function (link) {
            return IMAGE_TEMPLATE.replace('{SRC}', link).replace('{HREF}', link);
        });

        this.$tagMediaImg.html(
            this.$tagMediaImg.html() + video + images.join('')
        );
    },

    /**
     * Add a text to tag content modal
     * @param {string} text
     */
    addTagInformationText: function (text) {
        var TEXT_BLOCK_TEMPLATE = '<p>{TEXT}</p>';
        var previousContent;

        if (text) {
            previousContent = this.$tagInfoText.html().trim();

            if (previousContent) {
                previousContent = previousContent + '<br>';
            }

            this.$tagInfoText.html(previousContent + TEXT_BLOCK_TEMPLATE.replace('{TEXT}', text));
        }
    },

    /**
     * Add inspected damage to tag content modal
     * @param {object} data
     */
    addTagDamage: function (data) {
        var damageTemplate = [];
        var inputTemplate;
        var optionsKey;
        var options = {
            condition: 'Damage:',
            part_cost: 'Material / Part Cost ($):',
            comments: 'Severity:',
            labour_hours: 'Repair / Labor Hours:',
            descriptionnew: 'Description:',
            paint_hours: 'Paint Hours:',
            severity: 'On-Board Diagnostic Result:',
            metal_hours: 'Metal Hours:',
            flat_rate_cost: 'Flat Rate Cost ($):',
            repair_cost: 'Estimated Repair Cost ($):',
            paint_meter: 'Paint Meter:',
        };

        for (optionsKey in options) {
            if (options.hasOwnProperty(optionsKey)) {
                inputTemplate = optionsKey === 'paint_meter'
                    ? '<label class="paint-meter"><span>' + options[optionsKey] + '</span>'
                    + '<textarea id="' + optionsKey + '" rows="5" disabled>'
                    + this.getFormattedValue(data[optionsKey], optionsKey) + '</textarea></label>'
                    : '<label><span>' + options[optionsKey] + '</span>'
                    + '<input id="' + optionsKey + '" type="text" disabled value="'
                    + this.getFormattedValue(data[optionsKey], optionsKey) + '"></label>';
                damageTemplate.push(inputTemplate);
            }
        }

        this.$tagInspectedDamage.html(
            this.$tagInspectedDamage.html() + '<form class="damage-form">' + damageTemplate.join('') + '</form>'
        );
    },

    /**
     * @param {string} value
     * @param {string} key
     * @return {string}
    */
    getFormattedValue: function (value, key) {
        var formattedValue = value || '-';

        switch (key) {
            case 'comments':
                formattedValue = value.replace(/"/g, '&quot;');
                break;
            case 'labour_hours':
            case 'paint_hours':
            case 'metal_hours':
                formattedValue = value / 60;
                break;
            default:
                break;
        }

        return formattedValue;
    },

    /**
     * Calculate and set width and height of fullscreen modal width 360 image
     */
    setSizeForFullscreenModal: function () {
        var VIEWPORT_PADDING = 25;
        var EDGING_SIZE = 40;
        var PERCENTS_DIMENSION = '%';
        var PIXELS_DIMENSION = 'px';
        var $fullscreenModal = $(this.elementSelector.FULLSCREEN_MODAL_CONTAINER);
        var $fullscreenContent = $fullscreenModal.find(this.elementSelector.FULLSCREEN_MODAL_CONTENT);

        var windowWidth = document.documentElement.clientWidth - (VIEWPORT_PADDING * 2);
        var windowHeight = document.documentElement.clientHeight - (VIEWPORT_PADDING * 2);
        var fullscreenImgWidth;
        var scaleHeight;
        var vir360Height;

        this.loadImageSizes();

        vir360Height = this.imageNaturalSize.height + (EDGING_SIZE * 2);

        if (windowWidth > this.imageNaturalSize.width && windowHeight > vir360Height) {
            fullscreenImgWidth = this.imageNaturalSize.width + PIXELS_DIMENSION;
        }

        if (vir360Height > windowHeight) {
            scaleHeight = windowHeight / vir360Height;
            fullscreenImgWidth = (scaleHeight * 100) + PERCENTS_DIMENSION;
        }

        $fullscreenContent.css(
            {
                width: 'calc(' + fullscreenImgWidth + ' - ' + (VIEWPORT_PADDING * 2) + PIXELS_DIMENSION + ')',
                height: 'auto',
            }
        );
    },

    /**
     * Open 360 player in fullscreen mode
     */
    fullscreenOpen: function () {
        var self = this;
        var fullscreenContainerClass = this.elementSelector
            .FULLSCREEN_MODAL_CONTAINER.replace('.', '');
        var fullscreenContentClass = this.elementSelector
            .FULLSCREEN_MODAL_CONTENT.replace('.', '');
        var fullscreenContainerTemplate = this.playerParams.fullscreenContainerTemplate
            .replace('{{CONTAINER_CLASS}}', fullscreenContainerClass)
            .replace('{{CONTENT_CLASS}}', fullscreenContentClass);
        var $vir360Img = $('.modul-r-details .vir360-img');
        var $fullscreenLeft;
        var $fullscreenRight;

        this.$body.append(fullscreenContainerTemplate);

        this.setSizeForFullscreenModal();
        this.dragElement(this.$playerContainer);

        this.$playerContainer.appendTo(
            [this.elementSelector.FULLSCREEN_MODAL_CONTAINER, this.elementSelector.FULLSCREEN_MODAL_CONTENT].join(' ')
        );

        this.triggerDeferredWindowEvent('resize');

        $(this.elementSelector.VIR360_FULLSCREEN_CLOSE_BTN).one('click', function () {
            self.toggleFullScreen();
        });

        if ($vir360Img.siblings().length) {
            $fullscreenLeft = $(this.elementSelector.VIR360_FULLSCREEN_LEFT_BTN);
            $fullscreenRight = $(this.elementSelector.VIR360_FULLSCREEN_RIGHT_BTN);

            $fullscreenLeft.one('click', function () {
                self.toggleFullScreen();
                $vir360Img.siblings()
                    .last()
                    .click();
            });
            $fullscreenRight.one('click', function () {
                self.toggleFullScreen();
                $vir360Img.next()
                    .click();
            });
            $fullscreenLeft.css('visibility', 'visible');
            $fullscreenRight.css('visibility', 'visible');
        }
    },

    /**
     * Close 360 player fullscreen mode
     */
    fullscreenClose: function () {
        this.$playerContainer.appendTo(this.$playerBox);

        $(this.elementSelector.FULLSCREEN_MODAL_CONTAINER).remove();

        this.triggerDeferredWindowEvent('resize');
        $(this.elementSelector.OPEN_360_PLAYER_BTN).prop('disabled', false);
    },

    /**
     * Handler for toggle between fullscreen and base mode
     * @param {boolean} isMinimizeBtnHidden
     */
    toggleFullScreen: function (isMinimizeBtnHidden) {
        if (this.inFullscreen) {
            this.fullscreenClose();
        } else {
            this.fullscreenOpen();
        }

        this.inFullscreen = !this.inFullscreen;

        if (this.playerParams.fullscreenOnly) {
            this.$playerContainer.toggleClass('hidden', !this.inFullscreen);
        }

        this.$fullscreenButton.toggleClass('vir-360-maximize vir-360-minimize');
        this.$fullscreenButton.addClass(isMinimizeBtnHidden ? 'hidden' : '');
    },

    /**
     * Handler for load the inspected damage tag
     * @param {number} tagId
     */
    loadDamageTag: function (tagId) {
        this.loadTag(tagId, true);
    },
    dragElement: function ($container) {
        var currentPosX = 0;
        var currentPosY = 0;
        var newPosX = 0;
        var newPosY = 0;
        var element = $container[0];

        if ($container.find('.modul-r-vir360-player-edging').length) {
            // if present, the header is where you move the DIV from:
            $container.find('.modul-r-vir360-player-edging')[0].addEventListener('mousedown', dragMouseDown);
        } else {
            // otherwise, move the DIV from anywhere inside the DIV:
            element.addEventListener('mousedown', dragMouseDown);
        }

        function dragMouseDown(e) {
            e = e || window.event;

            e.preventDefault();
            // get the mouse cursor position at startup:
            newPosX = e.clientX;
            newPosY = e.clientY;
            document.addEventListener('mouseup', closeDragElement);
            // call a function whenever the cursor moves:
            document.addEventListener('mousemove', elementDrag);
        }

        function elementDrag(e) {
            e = e || window.event;
            e.preventDefault();
            // calculate the new cursor position:
            currentPosX = newPosX - e.clientX;
            currentPosY = newPosY - e.clientY;
            newPosX = e.clientX;
            newPosY = e.clientY;
            // set the element's new position:
            element.style.top = (element.offsetTop - currentPosY) + 'px';
            element.style.left = (element.offsetLeft - currentPosX) + 'px';
        }

        function closeDragElement() {
            // stop moving when mouse button is released:
            document.removeEventListener('mouseup', closeDragElement);
            document.removeEventListener('mousemove', elementDrag);
        }
    },
    /**
     * Handler for load the tag
     * @param {number} tagId
     * @param {boolean} isDamage
     */
    loadTag: function (tagId, isDamage) {
        var self = this;
        var $visibleSliderImages;
        var $videoThumbnail;
        var magnificPopupParams = {
            mainClass: 'vir360-magnific-popup',
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            image: {
                verticalFit: true,
            },
            gallery: {
                enabled: true,
                arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%">'
                    + '<span class="fa fa-chevron-%dir%"></span></button>', // markup of an arrow button
                tPrev: self.$tagMediaImg.data('prevTitle') || 'Previous',
                tNext: self.$tagMediaImg.data('nextTitle') || 'Next',
            },
        };
        var magnificPopupVideoParams = {
            type: 'inline',
            mainClass: 'vir360-magnific-video-popup',
            callbacks: {
                open: function () {
                    var $videoContainer = $(this.content).find('video');
                    var $video = $videoContainer[0];

                    $video.play();
                    $videoContainer.on('click', function () {
                        $video[$video.paused ? 'play' : 'pause']();
                        $('.fullscreen-overlay').css('visibility', $video.paused ? 'visible' : 'hidden');
                    });
                },
                close: function () {
                    $(this.content).removeClass('mfp-hide')
                        .find('video')
                        .first()
                        .off('click')
                        .load();
                },
            },
        };
        var slickParams = {
            infinite: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            adaptiveHeight: true,
            dots: true,
            dotsClass: 'tag-slick-dots slick-dots',
        };
        var addImageOverlay = function () {
            $visibleSliderImages = $('.thumbnail.slick-active').not('#tag-video-link');
            $videoThumbnail = $('#tag-video-link video');

            $('.thumbnail').removeClass('centralImage');
            $visibleSliderImages.eq($visibleSliderImages.length > 2 ? 1 : 0)
                .addClass('centralImage');
        };

        if (self.$tagMediaImg.children().length) {
            self.$tagMediaImg.slick('unslick');
        }

        self.loadTagContent(tagId, isDamage);
        self.$tagsContentContainer.toggleClass('show', true);
        self.$tagContainer.toggleClass('hide', true);

        if (self.$tagMediaImg.children().length) {
            self.$tagMediaImg.slick(slickParams);
            addImageOverlay();
            self.$tagMediaImg.on('afterChange', function () {
                addImageOverlay();
            });
            self.$tagMediaImg
                .find('.slick-track')
                .children()
                .not('a#tag-video-link')
                .magnificPopup(magnificPopupParams);
            self.$tagMediaImg.find('a#tag-video-link').magnificPopup(magnificPopupVideoParams);
        }


        if ($videoThumbnail) {
            setTimeout(function () {
                $videoThumbnail.css('height', $('.centralImage').height());
            }, 400);
        }

        self.currentTagId = tagId;
    },

    /**
     * Handler for load the next tag
     * @param {number|string} id
     */
    loadNextTag: function (id) {
        var self = this;
        var nextTag;
        var tagIds;

        if (typeof id === 'string') {
            tagIds = self.damageTagIds;
            nextTag = tagIds.indexOf(id) === tagIds.length - 1 ? tagIds[0] : tagIds[tagIds.indexOf(id) + 1];
        } else {
            tagIds = self.tagIds;
            nextTag = tagIds.indexOf(id) === tagIds.length - 1 ? tagIds[0] : tagIds[tagIds.indexOf(id) + 1];
        }

        this.loadTag(nextTag, typeof id === 'string');
    },

    /**
     * Handler for load the prev tag
     * @param {number|string} id
     */
    loadPrevTag: function (id) {
        var self = this;
        var prevTag;
        var tagIds;

        if (typeof id === 'string') {
            tagIds = self.damageTagIds;
            prevTag = tagIds.indexOf(id) === 0 ? tagIds[tagIds.length - 1] : tagIds[tagIds.indexOf(id) - 1];
        } else {
            tagIds = self.tagIds;
            prevTag = tagIds.indexOf(id) === 0 ? tagIds[tagIds.length - 1] : tagIds[tagIds.indexOf(id) - 1];
        }

        this.loadTag(prevTag, typeof id === 'string');
    },

    /**
     * Calculates prefix with needed count of zeros before frame file name,
     * due all frame filenames must be in 3 digit format.
     * @param {number} totalFrames
     * @return {string}
     */
    getFileNamePrefix: function (totalFrames) {
        var prefix = (totalFrames < 10) ? '00' : '0';

        if (totalFrames >= 100) {
            prefix = '';
        }

        return prefix;
    },

    /**
     * Trigger passed event on window object after timeout
     * @param {string} eventName
     * @param {number} delay
     */
    triggerDeferredWindowEvent: function (eventName, delay) {
        var DEFAULT_DELAY = 200;

        if (eventName) {
            window.setTimeout(function () {
                $(window).trigger(eventName);
            }, delay || DEFAULT_DELAY);
        }
    },
};
