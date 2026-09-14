<?php include_once "../inc/search/search-head.php" ?>
        <main>
            <div class="layout-container container" data-container="body">
            
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  " data-container="body_0_0" data-size-lg="12"><div class="modul-r-editable nowow">
            <!-- no_designtime_scripts -->
        <dev>
    <script type="text/javascript">
        $(function () {
            var UPDATE_INTERVAL = 10000; // Update interval im ms

            window.customMethodInventoryMD = function (self, $responseHtml) {
                var OPEN_MODAL_BTN_SELECTOR = '.bidhistory-open-modal-btn';
                var PLACE_BID_BTN_SELECTOR = '.place_bid_btn';
                var INPUT_BID_SELECTOR = '.place_bid_input';

                var $modalBtn = self
                    .$container
                    .find(OPEN_MODAL_BTN_SELECTOR)
                    .clone(true);
                var $placeBidBtn = self
                    .$container
                    .find(PLACE_BID_BTN_SELECTOR)
                    .clone(true);
                var newInputPlaceholder = $responseHtml.find(INPUT_BID_SELECTOR).attr('placeholder');

                self.$container.find('.time-remaining').html(
                    $responseHtml.find('.time-remaining').html()
                );

                self.$container.find('.outbided-or-highest-info').html(
                    $responseHtml.find('.outbided-or-highest-info').html()
                );

                self.$container.find('.tm-remaning-box').html(
                    $responseHtml.find('.tm-remaning-box').html()
                );

                self.$container
                    .find(INPUT_BID_SELECTOR)
                    .attr('placeholder', newInputPlaceholder);
                self.$container
                    .find(OPEN_MODAL_BTN_SELECTOR)
                    .replaceWith($modalBtn);
                self.$container
                    .find(PLACE_BID_BTN_SELECTOR)
                    .replaceWith($placeBidBtn);
            };

            System.on('inventory_ajax_complete', function () {
                $('.module_r_vehicle_auction_live')
                    .append('<span class="refresh-timeout" data-refresh-timeout="' + UPDATE_INTERVAL + '"></span>');
                System.trigger('auctionData.refreshAuctionData');
            });
        });
    </script>
</dev>        <!-- endof_no_designtime_scripts -->
    </div>
<div
    class="modul-r-inventoryMD text-left inventory_md_6981ed48d52c2 nowow ajax-mode inventory-md">
    <div class="main-captcha-place"
         style="opacity: 0; position: absolute; width:1px; height:1px; overflow: hidden;">
        <form action="#" method="post">
            <input type="text" class="capcha-catcher-input" name="capcha_catcher_input"/>
                    </form>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="h4">
                <span>Search Results:</span>
                <span class="text-primary">__</span>
                <span>Found</span>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    
                    <div class="hidden-sm hidden-xs hiden-xxs sort-group-wrapper">
    <label class="h5 hidden-xs">Sort By: &nbsp;</label>
    <div class="btn-group btn-group-sm hidden-xs">
                                <a class="btn btn-sm btn-default"
               href="../cars-for-sale_sort_condition-grading_sortord_asc.html"
               data-sort-by="condition-grading"
               data-order="asc"
            >
                Grading            </a>
                                <a class="btn btn-sm btn-default"
               href="../cars-for-sale_sort_year_sortord_asc.html"
               data-sort-by="year"
               data-order="asc"
            >
                Year            </a>
                                <a class="btn btn-sm btn-primary"
               href="../cars-for-sale_sort_make_sortord_desc.html"
               data-sort-by="make"
               data-order="desc"
            >
                Make            </a>
                                <a class="btn btn-sm btn-default"
               href="../cars-for-sale_sort_model_sortord_asc.html"
               data-sort-by="model"
               data-order="asc"
            >
                Model            </a>
                                <a class="btn btn-sm btn-default"
               href="../cars-for-sale_sort_mileage_sortord_asc.html"
               data-sort-by="mileage"
               data-order="asc"
            >
                Odometer            </a>
                                <a class="btn btn-sm btn-default"
               href="../cars-for-sale_sort_price_sortord_asc.html"
               data-sort-by="price"
               data-order="asc"
            >
                Price            </a>
                                <a class="btn btn-sm btn-default"
               href="../cars-for-sale_sort_stock_sortord_asc.html"
               data-sort-by="stock"
               data-order="asc"
            >
                Stock            </a>
                                <a class="btn btn-sm btn-default"
               href="../cars-for-sale_sort_time-remaining_sortord_asc.html"
               data-sort-by="time-remaining"
               data-order="asc"
            >
                Time Remaining            </a>
            </div>
    <div class="btn-group btn-group-sm sort-btn hidden-xs">
        <a href="../cars-for-sale_sort_make_sortord_desc.html"
           class="btn btn-primary change_sort_order "
           title="Change Sorting Order"
           data-sort-by="make"
           data-order="desc"
        >
            &nbsp;<span class="fa fa-sort-amount-asc"></span>&nbsp;
        </a>
    </div>
</div>
<div class="hidden-lg hidden-md visible-sm visible-xs visible-xxs sort-group-wrapper sort-select-wrapper">
    <label class="pull-left h5 visible-sm sort-sm">Sort by: &nbsp;</label>
    <div class="sort-wrapper">
        <label class="visible-xs">Sort by: &nbsp;</label>
        <div class="sort-selection">
            <div class="col-xs-10 sort-select no-padding-left">
                <select class="form-control">
                                            <option value="../cars-for-sale_sort_condition-grading_sortord_asc.html"
                                data-sort-by="condition-grading"
                                data-order="asc"
                                                        >
                            Grading                        </option>
                                            <option value="../cars-for-sale_sort_year_sortord_asc.html"
                                data-sort-by="year"
                                data-order="asc"
                                                        >
                            Year                        </option>
                                            <option value="../cars-for-sale_sort_make_sortord_asc.html"
                                data-sort-by="make"
                                data-order="asc"
                                selected="selected"                        >
                            Make                        </option>
                                            <option value="../cars-for-sale_sort_model_sortord_asc.html"
                                data-sort-by="model"
                                data-order="asc"
                                                        >
                            Model                        </option>
                                            <option value="../cars-for-sale_sort_mileage_sortord_asc.html"
                                data-sort-by="mileage"
                                data-order="asc"
                                                        >
                            Odometer                        </option>
                                            <option value="../cars-for-sale_sort_price_sortord_asc.html"
                                data-sort-by="price"
                                data-order="asc"
                                                        >
                            Price                        </option>
                                            <option value="../cars-for-sale_sort_stock_sortord_asc.html"
                                data-sort-by="stock"
                                data-order="asc"
                                                        >
                            Stock                        </option>
                                            <option value="../cars-for-sale_sort_time-remaining_sortord_asc.html"
                                data-sort-by="time-remaining"
                                data-order="asc"
                                                        >
                            Time Remaining                        </option>
                                    </select>
            </div>
            <div class="sort-btn col-xs-2 no-padding">
                <a href="../cars-for-sale_sort_make_sortord_desc.html"
                   class="btn btn-primary btn-block "
                   data-sort-by="make"
                   data-order="desc"
                >
                    <span class="fa fa-sort-amount-asc"></span>&nbsp;
                </a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
                </div>
            </div>
                            <!-- Loader -->
<div class="loader"></div>

<!-- Layout Dummy -->
<div class="ajax-inventory-preview">
            <div class="thumbnail no-padding">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xxs">
                                <div class="panel panel-default no-box-shadow">
                                    <div class="panel-heading no-padding-left no-border"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Image -->
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 col-xxs-12 text-center">
                                <div class="thumbnail">
                                    <div class="panel panel-default no-margin no-box-shadow">
                                        <div class="panel-heading btn-block image-dummy centered-item-wrapper">
                                            <div class="centered-item text-muted">
                                                <span class="loading-text">Loading&nbsp;</span>
                                                <div class="progress animate-progress no-margin image-dummy-loader">
                                                    <div class="progress-bar animate-progress-bar no-box-shadow"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7 col-xxs-12
                                        no-padding-left-lg no-padding-left-md no-padding-left-sm
                                        no-padding-left-xs left-padding-in-thin"
                            >
                                <div class="visible-xxs"></div>
                                <div class="panel panel-default no-margin no-box-shadow">
                                    <div class="panel-heading no-border">
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br class="hidden-lg hidden-sm">
                                        <br class="visible-xs hidden-xxs">
                                    </div>
                                </div>
                                <div class="hidden-lg spacer-03"></div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-8">
                                <div class="disabled btn btn-sm btn-default hidden-xxs width-15">&nbsp;</div>
                                <div class="disabled btn btn-sm btn-primary full-width-in-thin width-15">&nbsp;</div>
                                <div class="disabled btn btn-sm btn-default hidden-xxs width-15">&nbsp;</div>
                                <div class="disabled btn btn-sm btn-default hidden-xxs width-35">&nbsp;</div>
                                <div class="disabled btn btn-sm btn-default hidden-xxs width-15">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="thumbnail no-padding">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xxs">
                                <div class="panel panel-default no-box-shadow">
                                    <div class="panel-heading no-padding-left no-border"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Image -->
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 col-xxs-12 text-center">
                                <div class="thumbnail">
                                    <div class="panel panel-default no-margin no-box-shadow">
                                        <div class="panel-heading btn-block image-dummy centered-item-wrapper">
                                            <div class="centered-item text-muted">
                                                <span class="loading-text">Loading&nbsp;</span>
                                                <div class="progress animate-progress no-margin image-dummy-loader">
                                                    <div class="progress-bar animate-progress-bar no-box-shadow"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7 col-xxs-12
                                        no-padding-left-lg no-padding-left-md no-padding-left-sm
                                        no-padding-left-xs left-padding-in-thin"
                            >
                                <div class="visible-xxs"></div>
                                <div class="panel panel-default no-margin no-box-shadow">
                                    <div class="panel-heading no-border">
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br class="hidden-lg hidden-sm">
                                        <br class="visible-xs hidden-xxs">
                                    </div>
                                </div>
                                <div class="hidden-lg spacer-03"></div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-8">
                                <div class="disabled btn btn-sm btn-default hidden-xxs width-15">&nbsp;</div>
                                <div class="disabled btn btn-sm btn-primary full-width-in-thin width-15">&nbsp;</div>
                                <div class="disabled btn btn-sm btn-default hidden-xxs width-15">&nbsp;</div>
                                <div class="disabled btn btn-sm btn-default hidden-xxs width-35">&nbsp;</div>
                                <div class="disabled btn btn-sm btn-default hidden-xxs width-15">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="thumbnail no-padding">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xxs">
                                <div class="panel panel-default no-box-shadow">
                                    <div class="panel-heading no-padding-left no-border"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Image -->
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 col-xxs-12 text-center">
                                <div class="thumbnail">
                                    <div class="panel panel-default no-margin no-box-shadow">
                                        <div class="panel-heading btn-block image-dummy centered-item-wrapper">
                                            <div class="centered-item text-muted">
                                                <span class="loading-text">Loading&nbsp;</span>
                                                <div class="progress animate-progress no-margin image-dummy-loader">
                                                    <div class="progress-bar animate-progress-bar no-box-shadow"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7 col-xxs-12
                                        no-padding-left-lg no-padding-left-md no-padding-left-sm
                                        no-padding-left-xs left-padding-in-thin"
                            >
                                <div class="visible-xxs"></div>
                                <div class="panel panel-default no-margin no-box-shadow">
                                    <div class="panel-heading no-border">
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br class="hidden-lg hidden-sm">
                                        <br class="visible-xs hidden-xxs">
                                    </div>
                                </div>
                                <div class="hidden-lg spacer-03"></div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-8">
                                <div class="disabled btn btn-sm btn-default hidden-xxs width-15">&nbsp;</div>
                                <div class="disabled btn btn-sm btn-primary full-width-in-thin width-15">&nbsp;</div>
                                <div class="disabled btn btn-sm btn-default hidden-xxs width-15">&nbsp;</div>
                                <div class="disabled btn btn-sm btn-default hidden-xxs width-35">&nbsp;</div>
                                <div class="disabled btn btn-sm btn-default hidden-xxs width-15">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="thumbnail no-padding">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xxs">
                                <div class="panel panel-default no-box-shadow">
                                    <div class="panel-heading no-padding-left no-border"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Image -->
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 col-xxs-12 text-center">
                                <div class="thumbnail">
                                    <div class="panel panel-default no-margin no-box-shadow">
                                        <div class="panel-heading btn-block image-dummy centered-item-wrapper">
                                            <div class="centered-item text-muted">
                                                <span class="loading-text">Loading&nbsp;</span>
                                                <div class="progress animate-progress no-margin image-dummy-loader">
                                                    <div class="progress-bar animate-progress-bar no-box-shadow"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7 col-xxs-12
                                        no-padding-left-lg no-padding-left-md no-padding-left-sm
                                        no-padding-left-xs left-padding-in-thin"
                            >
                                <div class="visible-xxs"></div>
                                <div class="panel panel-default no-margin no-box-shadow">
                                    <div class="panel-heading no-border">
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br class="hidden-lg hidden-sm">
                                        <br class="visible-xs hidden-xxs">
                                    </div>
                                </div>
                                <div class="hidden-lg spacer-03"></div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-8">
                                <div class="disabled btn btn-sm btn-default hidden-xxs width-15">&nbsp;</div>
                                <div class="disabled btn btn-sm btn-primary full-width-in-thin width-15">&nbsp;</div>
                                <div class="disabled btn btn-sm btn-default hidden-xxs width-15">&nbsp;</div>
                                <div class="disabled btn btn-sm btn-default hidden-xxs width-35">&nbsp;</div>
                                <div class="disabled btn btn-sm btn-default hidden-xxs width-15">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="thumbnail no-padding">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xxs">
                                <div class="panel panel-default no-box-shadow">
                                    <div class="panel-heading no-padding-left no-border"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Image -->
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 col-xxs-12 text-center">
                                <div class="thumbnail">
                                    <div class="panel panel-default no-margin no-box-shadow">
                                        <div class="panel-heading btn-block image-dummy centered-item-wrapper">
                                            <div class="centered-item text-muted">
                                                <span class="loading-text">Loading&nbsp;</span>
                                                <div class="progress animate-progress no-margin image-dummy-loader">
                                                    <div class="progress-bar animate-progress-bar no-box-shadow"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7 col-xxs-12
                                        no-padding-left-lg no-padding-left-md no-padding-left-sm
                                        no-padding-left-xs left-padding-in-thin"
                            >
                                <div class="visible-xxs"></div>
                                <div class="panel panel-default no-margin no-box-shadow">
                                    <div class="panel-heading no-border">
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br class="hidden-lg hidden-sm">
                                        <br class="visible-xs hidden-xxs">
                                    </div>
                                </div>
                                <div class="hidden-lg spacer-03"></div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-8">
                                <div class="disabled btn btn-sm btn-default hidden-xxs width-15">&nbsp;</div>
                                <div class="disabled btn btn-sm btn-primary full-width-in-thin width-15">&nbsp;</div>
                                <div class="disabled btn btn-sm btn-default hidden-xxs width-15">&nbsp;</div>
                                <div class="disabled btn btn-sm btn-default hidden-xxs width-35">&nbsp;</div>
                                <div class="disabled btn btn-sm btn-default hidden-xxs width-15">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                    </div>
    </div>

</div>
    
<script type="text/javascript">
    $(function() {
        var params = {
            uid: '6981ed48d52c2',
            container: '.inventory_md_' + '6981ed48d52c2',
            loadedContainer: '.modul-r-inventoryMD',
            widgetParams: {"corners":"round","style":"default","type":"inventory","filter_condition":"all","items":"20","filter_year":"0","filter_make":"none","imagesize":1,"fontsize":14,"prices":"{\"price_type\":\"default\",\"markdown\":\"\",\"markdown_price\":\"current\",\"discount_top\":\"current\",\"discount_bottom\":\"current\",\"customlabels\":false,\"label_top\":\"Top Price\",\"label_middle\":\"Current Price\",\"label_bottom\":\"Bottom Price\",\"custom_top\":\"CALL\",\"custom_middle\":\"CALL\",\"custom_bottom\":\"CALL\"}","priority_min":"0","priority_max":"","priority_method":"Disabled","search_against":"User","paid":"no","seller_type":"all","page_count":"15","cstm_mileage_value":"","carfax_highlights":"0","show_eprice":"No","title_eprice":"Get ePrice","show_discount":"No","title_discount":"Price Quote","stock":"","multiselect_motorize_type":"{\"data\":{\"1\":{\"id\":16,\"name\":\"AGRICULTURAL EQUIPMENT\"},\"2\":{\"id\":1,\"name\":\"BOAT\"},\"3\":{\"id\":3,\"name\":\"CARS & TRUCKS & VANS\"},\"4\":{\"id\":2,\"name\":\"COMMERCIAL TRUCKS\"},\"5\":{\"id\":4,\"name\":\"LIGHT TRUCK\"},\"6\":{\"id\":14,\"name\":\"MOTORCYCLE\"}},\"not_select\":\"\",\"select\":\"\"}","multiselect_filter_category":"{\"data\":{\"0\":\"None\",\"1\":{\"id\":\"\",\"name\":\"\"},\"2\":{\"id\":\"100 hp to 174 hp\",\"name\":\"100 HP TO 174 HP\"},\"3\":{\"id\":\"175 hp or greater\",\"name\":\"175 HP OR GREATER\"},\"4\":{\"id\":\"40 hp to 99 hp\",\"name\":\"40 HP TO 99 HP\"},\"5\":{\"id\":\"agriculture equipment transport trailer\",\"name\":\"AGRICULTURE EQUIPMENT TRANSPORT TRAILER\"},\"6\":{\"id\":\"air seeders\/air carts\",\"name\":\"AIR SEEDERS\/AIR CARTS\"},\"7\":{\"id\":\"all terrain \/ hydraulic\",\"name\":\"ALL TERRAIN \/ HYDRAULIC\"},\"8\":{\"id\":\"ambulance\",\"name\":\"AMBULANCE\"},\"9\":{\"id\":\"armored trucks\",\"name\":\"ARMORED TRUCKS\"},\"10\":{\"id\":\"asphalt \/ hot oil\",\"name\":\"ASPHALT \/ HOT OIL\"},\"11\":{\"id\":\"attenuator\",\"name\":\"ATTENUATOR\"},\"12\":{\"id\":\"atvs\",\"name\":\"ATVS\"},\"13\":{\"id\":\"auger\",\"name\":\"AUGER\"},\"14\":{\"id\":\"bale accumulators \/ mov\",\"name\":\"BALE ACCUMULATORS \/ MOV\"},\"15\":{\"id\":\"belt trailers\",\"name\":\"BELT TRAILERS\"},\"16\":{\"id\":\"beverage trailers\",\"name\":\"BEVERAGE TRAILERS\"},\"17\":{\"id\":\"beverage trucks\",\"name\":\"BEVERAGE TRUCKS\"},\"18\":{\"id\":\"blade \/ tower trailers\",\"name\":\"BLADE \/ TOWER TRAILERS\"},\"19\":{\"id\":\"blades\/box scrapers\",\"name\":\"BLADES\/BOX SCRAPERS\"},\"20\":{\"id\":\"boom\",\"name\":\"BOOM\"},\"21\":{\"id\":\"boom truck\",\"name\":\"BOOM TRUCK\"},\"22\":{\"id\":\"bottom\",\"name\":\"BOTTOM\"},\"23\":{\"id\":\"box trucks - straight tru\",\"name\":\"BOX TRUCKS - STRAIGHT TRU\"},\"24\":{\"id\":\"box trucks - straight trucks\",\"name\":\"BOX TRUCKS - STRAIGHT TRUCKS\"},\"25\":{\"id\":\"bucket\",\"name\":\"BUCKET\"},\"26\":{\"id\":\"bucket trucks - boom truc\",\"name\":\"BUCKET TRUCKS - BOOM TRUC\"},\"27\":{\"id\":\"bucket trucks - boom trucks\",\"name\":\"BUCKET TRUCKS - BOOM TRUCKS\"},\"28\":{\"id\":\"bucket trucks \/ boom trucks\",\"name\":\"BUCKET TRUCKS \/ BOOM TRUCKS\"},\"29\":{\"id\":\"bus\",\"name\":\"BUS\"},\"30\":{\"id\":\"cab & chassis trucks\",\"name\":\"CAB & CHASSIS TRUCKS\"},\"31\":{\"id\":\"cab chassis\",\"name\":\"CAB CHASSIS\"},\"32\":{\"id\":\"cable dispenser\",\"name\":\"CABLE DISPENSER\"},\"33\":{\"id\":\"cable scrappers\",\"name\":\"CABLE SCRAPPERS\"},\"34\":{\"id\":\"cabover trucks - coe\",\"name\":\"CABOVER TRUCKS - COE\"},\"35\":{\"id\":\"cabover trucks - sleeper\",\"name\":\"CABOVER TRUCKS - SLEEPER\"},\"36\":{\"id\":\"cabover trucks w\/ sleeper\",\"name\":\"CABOVER TRUCKS W\/ SLEEPER\"},\"37\":{\"id\":\"cabover trucks w\/o sleeper\",\"name\":\"CABOVER TRUCKS W\/O SLEEPER\"},\"38\":{\"id\":\"cabover trucks w\/o sleeper -\",\"name\":\"CABOVER TRUCKS W\/O SLEEPER -\"},\"39\":{\"id\":\"car carrier\",\"name\":\"CAR CARRIER\"},\"40\":{\"id\":\"car carrier trailers - enclosed\",\"name\":\"CAR CARRIER TRAILERS - ENCLOSED\"},\"41\":{\"id\":\"car carrier trailers - open\",\"name\":\"CAR CARRIER TRAILERS - OPEN\"},\"42\":{\"id\":\"car carrier trucks\",\"name\":\"CAR CARRIER TRUCKS\"},\"43\":{\"id\":\"cargo van\",\"name\":\"CARGO VAN\"},\"44\":{\"id\":\"carry deck\",\"name\":\"CARRY DECK\"},\"45\":{\"id\":\"catering trucks - food tr\",\"name\":\"CATERING TRUCKS - FOOD TR\"},\"46\":{\"id\":\"catering trucks - food trucks\",\"name\":\"CATERING TRUCKS - FOOD TRUCKS\"},\"47\":{\"id\":\"chemical \/ acid\",\"name\":\"CHEMICAL \/ ACID\"},\"48\":{\"id\":\"chipper trailers\",\"name\":\"CHIPPER TRAILERS\"},\"49\":{\"id\":\"chipper trucks\",\"name\":\"CHIPPER TRUCKS\"},\"50\":{\"id\":\"combination\",\"name\":\"COMBINATION\"},\"51\":{\"id\":\"combines\",\"name\":\"COMBINES\"},\"52\":{\"id\":\"conventional - day cab\",\"name\":\"CONVENTIONAL - DAY CAB\"},\"53\":{\"id\":\"conventional - sleeper tr\",\"name\":\"CONVENTIONAL - SLEEPER TR\"},\"54\":{\"id\":\"conventional - sleeper trucks\",\"name\":\"CONVENTIONAL - SLEEPER TRUCKS\"},\"55\":{\"id\":\"conventional truck\",\"name\":\"CONVENTIONAL TRUCK\"},\"56\":{\"id\":\"conventional trucks w\/ sleeper\",\"name\":\"CONVENTIONAL TRUCKS W\/ SLEEPER\"},\"57\":{\"id\":\"conventional trucks w\/o sleep\",\"name\":\"CONVENTIONAL TRUCKS W\/O SLEEP\"},\"58\":{\"id\":\"conventional trucks w\/o sleepe\",\"name\":\"CONVENTIONAL TRUCKS W\/O SLEEPE\"},\"59\":{\"id\":\"conveyor \/ feeder \/ stacker\",\"name\":\"CONVEYOR \/ FEEDER \/ STACKER\"},\"60\":{\"id\":\"cotton pickers\/strippers\",\"name\":\"COTTON PICKERS\/STRIPPERS\"},\"61\":{\"id\":\"crane trucks\",\"name\":\"CRANE TRUCKS\"},\"62\":{\"id\":\"crawler\",\"name\":\"CRAWLER\"},\"63\":{\"id\":\"crawler \/ dragline\",\"name\":\"CRAWLER \/ DRAGLINE\"},\"64\":{\"id\":\"crew cab\",\"name\":\"CREW CAB\"},\"65\":{\"id\":\"crude oil\",\"name\":\"CRUDE OIL\"},\"66\":{\"id\":\"crusher\",\"name\":\"CRUSHER\"},\"67\":{\"id\":\"curtain side trailers\",\"name\":\"CURTAIN SIDE TRAILERS\"},\"68\":{\"id\":\"cutaway-cube van\",\"name\":\"CUTAWAY-CUBE VAN\"},\"69\":{\"id\":\"delimber\",\"name\":\"DELIMBER\"},\"70\":{\"id\":\"diesel\",\"name\":\"DIESEL\"},\"71\":{\"id\":\"digger derrick\",\"name\":\"DIGGER DERRICK\"},\"72\":{\"id\":\"digger derrick trucks\",\"name\":\"DIGGER DERRICK TRUCKS\"},\"73\":{\"id\":\"disc mowers\",\"name\":\"DISC MOWERS\"},\"74\":{\"id\":\"disks\",\"name\":\"DISKS\"},\"75\":{\"id\":\"dolly trailers\",\"name\":\"DOLLY TRAILERS\"},\"76\":{\"id\":\"double drop trailers\",\"name\":\"DOUBLE DROP TRAILERS\"},\"77\":{\"id\":\"drills\",\"name\":\"DRILLS\"},\"78\":{\"id\":\"drop deck trailers\",\"name\":\"DROP DECK TRAILERS\"},\"79\":{\"id\":\"drop frame van trailers - electronics\",\"name\":\"DROP FRAME VAN TRAILERS - ELECTRONICS\"},\"80\":{\"id\":\"drop frame van trailers - moving\",\"name\":\"DROP FRAME VAN TRAILERS - MOVING\"},\"81\":{\"id\":\"dry van\",\"name\":\"DRY VAN\"},\"82\":{\"id\":\"dry van trailers\",\"name\":\"DRY VAN TRAILERS\"},\"83\":{\"id\":\"dump \/ transfer\",\"name\":\"DUMP \/ TRANSFER\"},\"84\":{\"id\":\"dump chassis trucks\",\"name\":\"DUMP CHASSIS TRUCKS\"},\"85\":{\"id\":\"dump trailers - bottom\",\"name\":\"DUMP TRAILERS - BOTTOM\"},\"86\":{\"id\":\"dump trailers - end\",\"name\":\"DUMP TRAILERS - END\"},\"87\":{\"id\":\"dump trailers - side\",\"name\":\"DUMP TRAILERS - SIDE\"},\"88\":{\"id\":\"dump trucks\",\"name\":\"DUMP TRUCKS\"},\"89\":{\"id\":\"electronics\",\"name\":\"ELECTRONICS\"},\"90\":{\"id\":\"enclosed\",\"name\":\"ENCLOSED\"},\"91\":{\"id\":\"end\",\"name\":\"END\"},\"92\":{\"id\":\"expeditor \/ hot shot trucks\",\"name\":\"EXPEDITOR \/ HOT SHOT TRUCKS\"},\"93\":{\"id\":\"expeditor-hotshot\",\"name\":\"EXPEDITOR-HOTSHOT\"},\"94\":{\"id\":\"extended cab\",\"name\":\"EXTENDED CAB\"},\"95\":{\"id\":\"farm \/ grain trucks\",\"name\":\"FARM \/ GRAIN TRUCKS\"},\"96\":{\"id\":\"farm trucks - grain truck\",\"name\":\"FARM TRUCKS - GRAIN TRUCK\"},\"97\":{\"id\":\"farm trucks - grain trucks\",\"name\":\"FARM TRUCKS - GRAIN TRUCKS\"},\"98\":{\"id\":\"feed grinders\",\"name\":\"FEED GRINDERS\"},\"99\":{\"id\":\"feed\/mixer wagon\",\"name\":\"FEED\/MIXER WAGON\"},\"100\":{\"id\":\"feller buncher\",\"name\":\"FELLER BUNCHER\"},\"101\":{\"id\":\"fertilizer applicators - an\",\"name\":\"FERTILIZER APPLICATORS - AN\"},\"102\":{\"id\":\"fertilizer applicators - dr\",\"name\":\"FERTILIZER APPLICATORS - DR\"},\"103\":{\"id\":\"fertilizer applicators - li\",\"name\":\"FERTILIZER APPLICATORS - LI\"},\"104\":{\"id\":\"field cultivators\",\"name\":\"FIELD CULTIVATORS\"},\"105\":{\"id\":\"fire trucks\",\"name\":\"FIRE TRUCKS\"},\"106\":{\"id\":\"flatbed dump\",\"name\":\"FLATBED DUMP\"},\"107\":{\"id\":\"flatbed trailers\",\"name\":\"FLATBED TRAILERS\"},\"108\":{\"id\":\"flatbed trucks\",\"name\":\"FLATBED TRUCKS\"},\"109\":{\"id\":\"flatbed-dump\",\"name\":\"FLATBED-DUMP\"},\"110\":{\"id\":\"floaters\",\"name\":\"FLOATERS\"},\"111\":{\"id\":\"food trucks\",\"name\":\"FOOD TRUCKS\"},\"112\":{\"id\":\"forage - pull-type\",\"name\":\"FORAGE - PULL-TYPE\"},\"113\":{\"id\":\"forage - self-propelled\",\"name\":\"FORAGE - SELF-PROPELLED\"},\"114\":{\"id\":\"forage wagons\",\"name\":\"FORAGE WAGONS\"},\"115\":{\"id\":\"forwarder\",\"name\":\"FORWARDER\"},\"116\":{\"id\":\"frac\",\"name\":\"FRAC\"},\"117\":{\"id\":\"fuel \/ lube trucks\",\"name\":\"FUEL \/ LUBE TRUCKS\"},\"118\":{\"id\":\"fuel trucks - lube trucks\",\"name\":\"FUEL TRUCKS - LUBE TRUCKS\"},\"119\":{\"id\":\"garbage trucks\",\"name\":\"GARBAGE TRUCKS\"},\"120\":{\"id\":\"garbage trucks - packer\",\"name\":\"GARBAGE TRUCKS - PACKER\"},\"121\":{\"id\":\"garbage trucks - roll-off\",\"name\":\"GARBAGE TRUCKS - ROLL-OFF\"},\"122\":{\"id\":\"gas\",\"name\":\"GAS\"},\"123\":{\"id\":\"gasoline \/ fuel\",\"name\":\"GASOLINE \/ FUEL\"},\"124\":{\"id\":\"glass trucks\",\"name\":\"GLASS TRUCKS\"},\"125\":{\"id\":\"glider kit\",\"name\":\"GLIDER KIT\"},\"126\":{\"id\":\"grain augers\/conveyors\",\"name\":\"GRAIN AUGERS\/CONVEYORS\"},\"127\":{\"id\":\"grain carts\",\"name\":\"GRAIN CARTS\"},\"128\":{\"id\":\"grapple trucks\",\"name\":\"GRAPPLE TRUCKS\"},\"129\":{\"id\":\"gravity wagons\",\"name\":\"GRAVITY WAGONS\"},\"130\":{\"id\":\"hauler\",\"name\":\"HAULER\"},\"131\":{\"id\":\"header trailers\",\"name\":\"HEADER TRAILERS\"},\"132\":{\"id\":\"headers - forage - rotary\",\"name\":\"HEADERS - FORAGE - ROTARY\"},\"133\":{\"id\":\"headers - forage - row crop\",\"name\":\"HEADERS - FORAGE - ROW CROP\"},\"134\":{\"id\":\"headers - forage - windrow\",\"name\":\"HEADERS - FORAGE - WINDROW\"},\"135\":{\"id\":\"headers - platform\",\"name\":\"HEADERS - PLATFORM\"},\"136\":{\"id\":\"headers - rowcrop\",\"name\":\"HEADERS - ROWCROP\"},\"137\":{\"id\":\"hooklift trucks\",\"name\":\"HOOKLIFT TRUCKS\"},\"138\":{\"id\":\"hopper \/ grain trailers\",\"name\":\"HOPPER \/ GRAIN TRAILERS\"},\"139\":{\"id\":\"horizontal\",\"name\":\"HORIZONTAL\"},\"140\":{\"id\":\"horizontal grinder\",\"name\":\"HORIZONTAL GRINDER\"},\"141\":{\"id\":\"horse trailers\",\"name\":\"HORSE TRAILERS\"},\"142\":{\"id\":\"industrial gas\",\"name\":\"INDUSTRIAL GAS\"},\"143\":{\"id\":\"insulator washer\",\"name\":\"INSULATOR WASHER\"},\"144\":{\"id\":\"intermodal \/ container chassis only\",\"name\":\"INTERMODAL \/ CONTAINER CHASSIS ONLY\"},\"145\":{\"id\":\"intermodal \/ container trailers\",\"name\":\"INTERMODAL \/ CONTAINER TRAILERS\"},\"146\":{\"id\":\"land rollers\",\"name\":\"LAND ROLLERS\"},\"147\":{\"id\":\"landfill\",\"name\":\"LANDFILL\"},\"148\":{\"id\":\"landscape trucks\",\"name\":\"LANDSCAPE TRUCKS\"},\"149\":{\"id\":\"less than 40 hp\",\"name\":\"LESS THAN 40 HP\"},\"150\":{\"id\":\"lift trucks\",\"name\":\"LIFT TRUCKS\"},\"151\":{\"id\":\"live floor trailers\",\"name\":\"LIVE FLOOR TRAILERS\"},\"152\":{\"id\":\"livestock\",\"name\":\"LIVESTOCK\"},\"153\":{\"id\":\"livestock trailers\",\"name\":\"LIVESTOCK TRAILERS\"},\"154\":{\"id\":\"loaders\",\"name\":\"LOADERS\"},\"155\":{\"id\":\"log trailers\",\"name\":\"LOG TRAILERS\"},\"156\":{\"id\":\"logging\",\"name\":\"LOGGING\"},\"157\":{\"id\":\"logging trucks\",\"name\":\"LOGGING TRUCKS\"},\"158\":{\"id\":\"lowboy trailers\",\"name\":\"LOWBOY TRAILERS\"},\"159\":{\"id\":\"manure spreaders - dry\",\"name\":\"MANURE SPREADERS - DRY\"},\"160\":{\"id\":\"manure spreaders - liquid\",\"name\":\"MANURE SPREADERS - LIQUID\"},\"161\":{\"id\":\"manure systems\",\"name\":\"MANURE SYSTEMS\"},\"162\":{\"id\":\"mast\",\"name\":\"MAST\"},\"163\":{\"id\":\"material handling\",\"name\":\"MATERIAL HANDLING\"},\"164\":{\"id\":\"mechanics trucks\",\"name\":\"MECHANICS TRUCKS\"},\"165\":{\"id\":\"mega cab\",\"name\":\"MEGA CAB\"},\"166\":{\"id\":\"military\",\"name\":\"MILITARY\"},\"167\":{\"id\":\"mini (up to 12,000 lbs)\",\"name\":\"MINI (UP TO 12,000 LBS)\"},\"168\":{\"id\":\"mini trucks\",\"name\":\"MINI TRUCKS\"},\"169\":{\"id\":\"minibus\",\"name\":\"MINIBUS\"},\"170\":{\"id\":\"miscellaneous\",\"name\":\"MISCELLANEOUS\"},\"171\":{\"id\":\"mixer \/ asphalt \/ concrete tr\",\"name\":\"MIXER \/ ASPHALT \/ CONCRETE TR\"},\"172\":{\"id\":\"mixer \/ asphalt \/ concrete tru\",\"name\":\"MIXER \/ ASPHALT \/ CONCRETE TRU\"},\"173\":{\"id\":\"mixer trucks\",\"name\":\"MIXER TRUCKS\"},\"174\":{\"id\":\"mobility van\",\"name\":\"MOBILITY VAN\"},\"175\":{\"id\":\"motor\",\"name\":\"MOTOR\"},\"176\":{\"id\":\"moving\",\"name\":\"MOVING\"},\"177\":{\"id\":\"moving van\",\"name\":\"MOVING VAN\"},\"178\":{\"id\":\"mower conditioners\/wind\",\"name\":\"MOWER CONDITIONERS\/WIND\"},\"179\":{\"id\":\"mulch finishers\",\"name\":\"MULCH FINISHERS\"},\"180\":{\"id\":\"mulcher\",\"name\":\"MULCHER\"},\"181\":{\"id\":\"multi-engine\",\"name\":\"MULTI-ENGINE\"},\"182\":{\"id\":\"non code\",\"name\":\"NON CODE\"},\"183\":{\"id\":\"oil field trailers\",\"name\":\"OIL FIELD TRAILERS\"},\"184\":{\"id\":\"oil tank trucks\",\"name\":\"OIL TANK TRUCKS\"},\"185\":{\"id\":\"open\",\"name\":\"OPEN\"},\"186\":{\"id\":\"open top trailers\",\"name\":\"OPEN TOP TRAILERS\"},\"187\":{\"id\":\"other\",\"name\":\"OTHER\"},\"188\":{\"id\":\"other trailers\",\"name\":\"OTHER TRAILERS\"},\"189\":{\"id\":\"other trucks\",\"name\":\"OTHER TRUCKS\"},\"190\":{\"id\":\"padfoot\",\"name\":\"PADFOOT\"},\"191\":{\"id\":\"passenger bus\",\"name\":\"PASSENGER BUS\"},\"192\":{\"id\":\"passenger van\",\"name\":\"PASSENGER VAN\"},\"193\":{\"id\":\"personnel\",\"name\":\"PERSONNEL\"},\"194\":{\"id\":\"pick-up trucks\",\"name\":\"PICK-UP TRUCKS\"},\"195\":{\"id\":\"pick-up trucks 2wd - 1 ton\",\"name\":\"PICK-UP TRUCKS 2WD - 1 TON\"},\"196\":{\"id\":\"pick-up trucks 2wd - 1\/2 ton\",\"name\":\"PICK-UP TRUCKS 2WD - 1\/2 TON\"},\"197\":{\"id\":\"pick-up trucks 2wd - 3\/4 ton\",\"name\":\"PICK-UP TRUCKS 2WD - 3\/4 TON\"},\"198\":{\"id\":\"pick-up trucks 2wd - other 2wd\",\"name\":\"PICK-UP TRUCKS 2WD - OTHER 2WD\"},\"199\":{\"id\":\"pick-up trucks 4wd - 1 ton\",\"name\":\"PICK-UP TRUCKS 4WD - 1 TON\"},\"200\":{\"id\":\"pick-up trucks 4wd - 1\/2 ton\",\"name\":\"PICK-UP TRUCKS 4WD - 1\/2 TON\"},\"201\":{\"id\":\"pick-up trucks 4wd - 3\/4 ton\",\"name\":\"PICK-UP TRUCKS 4WD - 3\/4 TON\"},\"202\":{\"id\":\"pick-up trucks 4wd - other 4wd\",\"name\":\"PICK-UP TRUCKS 4WD - OTHER 4WD\"},\"203\":{\"id\":\"pickup trucks\",\"name\":\"PICKUP TRUCKS\"},\"204\":{\"id\":\"planters\",\"name\":\"PLANTERS\"},\"205\":{\"id\":\"plow \/ spreader trucks\",\"name\":\"PLOW \/ SPREADER TRUCKS\"},\"206\":{\"id\":\"plow trucks - spreader tr\",\"name\":\"PLOW TRUCKS - SPREADER TR\"},\"207\":{\"id\":\"plow trucks - spreader trucks\",\"name\":\"PLOW TRUCKS - SPREADER TRUCKS\"},\"208\":{\"id\":\"plows\",\"name\":\"PLOWS\"},\"209\":{\"id\":\"plumber service trucks\",\"name\":\"PLUMBER SERVICE TRUCKS\"},\"210\":{\"id\":\"pneumatic\",\"name\":\"PNEUMATIC\"},\"211\":{\"id\":\"pneumatic \/ dry bulk\",\"name\":\"PNEUMATIC \/ DRY BULK\"},\"212\":{\"id\":\"pole trailers\",\"name\":\"POLE TRAILERS\"},\"213\":{\"id\":\"power units\",\"name\":\"POWER UNITS\"},\"214\":{\"id\":\"processor \/ harvester\",\"name\":\"PROCESSOR \/ HARVESTER\"},\"215\":{\"id\":\"pull\",\"name\":\"PULL\"},\"216\":{\"id\":\"pup trailers\",\"name\":\"PUP TRAILERS\"},\"217\":{\"id\":\"quad cab\",\"name\":\"QUAD CAB\"},\"218\":{\"id\":\"rakes\/tedders\",\"name\":\"RAKES\/TEDDERS\"},\"219\":{\"id\":\"recreational vehicles\",\"name\":\"RECREATIONAL VEHICLES\"},\"220\":{\"id\":\"recycle trucks\",\"name\":\"RECYCLE TRUCKS\"},\"221\":{\"id\":\"reefer trailers\",\"name\":\"REEFER TRAILERS\"},\"222\":{\"id\":\"reefer unit only\",\"name\":\"REEFER UNIT ONLY\"},\"223\":{\"id\":\"reel \/ cable trailers\",\"name\":\"REEL \/ CABLE TRAILERS\"},\"224\":{\"id\":\"refrigerated trucks\",\"name\":\"REFRIGERATED TRUCKS\"},\"225\":{\"id\":\"refuse trailers\",\"name\":\"REFUSE TRAILERS\"},\"226\":{\"id\":\"riding lawn mowers\",\"name\":\"RIDING LAWN MOWERS\"},\"227\":{\"id\":\"rippers\",\"name\":\"RIPPERS\"},\"228\":{\"id\":\"roll off trailers\",\"name\":\"ROLL OFF TRAILERS\"},\"229\":{\"id\":\"roll off trucks\",\"name\":\"ROLL OFF TRUCKS\"},\"230\":{\"id\":\"rollback tow trucks\",\"name\":\"ROLLBACK TOW TRUCKS\"},\"231\":{\"id\":\"rotary mowers\",\"name\":\"ROTARY MOWERS\"},\"232\":{\"id\":\"rotary tillage\",\"name\":\"ROTARY TILLAGE\"},\"233\":{\"id\":\"rough terrain\",\"name\":\"ROUGH TERRAIN\"},\"234\":{\"id\":\"round balers\",\"name\":\"ROUND BALERS\"},\"235\":{\"id\":\"row crop cultivators\",\"name\":\"ROW CROP CULTIVATORS\"},\"236\":{\"id\":\"salvage trucks\",\"name\":\"SALVAGE TRUCKS\"},\"237\":{\"id\":\"sanitary\",\"name\":\"SANITARY\"},\"238\":{\"id\":\"scissor\",\"name\":\"SCISSOR\"},\"239\":{\"id\":\"screen\",\"name\":\"SCREEN\"},\"240\":{\"id\":\"selfloader\",\"name\":\"SELFLOADER\"},\"241\":{\"id\":\"service \/ utility \/ mechanic\",\"name\":\"SERVICE \/ UTILITY \/ MECHANIC\"},\"242\":{\"id\":\"service \/ utility \/ mechanic t\",\"name\":\"SERVICE \/ UTILITY \/ MECHANIC T\"},\"243\":{\"id\":\"sewer trucks\",\"name\":\"SEWER TRUCKS\"},\"244\":{\"id\":\"shredder trucks\",\"name\":\"SHREDDER TRUCKS\"},\"245\":{\"id\":\"side\",\"name\":\"SIDE\"},\"246\":{\"id\":\"single-engine\",\"name\":\"SINGLE-ENGINE\"},\"247\":{\"id\":\"skidder \/ yarder\",\"name\":\"SKIDDER \/ YARDER\"},\"248\":{\"id\":\"sling trucks\",\"name\":\"SLING TRUCKS\"},\"249\":{\"id\":\"smooth drum\",\"name\":\"SMOOTH DRUM\"},\"250\":{\"id\":\"spray trucks\",\"name\":\"SPRAY TRUCKS\"},\"251\":{\"id\":\"sprayers - 3 pt\/mounted\",\"name\":\"SPRAYERS - 3 PT\/MOUNTED\"},\"252\":{\"id\":\"sprayers - pull type\",\"name\":\"SPRAYERS - PULL TYPE\"},\"253\":{\"id\":\"sprayers - self propelled\",\"name\":\"SPRAYERS - SELF PROPELLED\"},\"254\":{\"id\":\"sprinter van\",\"name\":\"SPRINTER VAN\"},\"255\":{\"id\":\"square balers\",\"name\":\"SQUARE BALERS\"},\"256\":{\"id\":\"stake bed\",\"name\":\"STAKE BED\"},\"257\":{\"id\":\"stake trucks\",\"name\":\"STAKE TRUCKS\"},\"258\":{\"id\":\"stalk choppers\/flail mo\",\"name\":\"STALK CHOPPERS\/FLAIL MO\"},\"259\":{\"id\":\"stepvan\",\"name\":\"STEPVAN\"},\"260\":{\"id\":\"stone spreader trucks\",\"name\":\"STONE SPREADER TRUCKS\"},\"261\":{\"id\":\"storage trailers\",\"name\":\"STORAGE TRAILERS\"},\"262\":{\"id\":\"street cleaner\",\"name\":\"STREET CLEANER\"},\"263\":{\"id\":\"super cab\",\"name\":\"SUPER CAB\"},\"264\":{\"id\":\"suv\",\"name\":\"SUV\"},\"265\":{\"id\":\"sweeper\",\"name\":\"SWEEPER\"},\"266\":{\"id\":\"sweeper trucks\",\"name\":\"SWEEPER TRUCKS\"},\"267\":{\"id\":\"tag trailers\",\"name\":\"TAG TRAILERS\"},\"268\":{\"id\":\"tank trailers - asphalt \/ hot oil\",\"name\":\"TANK TRAILERS - ASPHALT \/ HOT OIL\"},\"269\":{\"id\":\"tank trailers - chemical \/ acid\",\"name\":\"TANK TRAILERS - CHEMICAL \/ ACID\"},\"270\":{\"id\":\"tank trailers - crude oil\",\"name\":\"TANK TRAILERS - CRUDE OIL\"},\"271\":{\"id\":\"tank trailers - frac\",\"name\":\"TANK TRAILERS - FRAC\"},\"272\":{\"id\":\"tank trailers - gasoline \/ fuel\",\"name\":\"TANK TRAILERS - GASOLINE \/ FUEL\"},\"273\":{\"id\":\"tank trailers - industrial gas,\",\"name\":\"TANK TRAILERS - INDUSTRIAL GAS,\"},\"274\":{\"id\":\"tank trailers - non code\",\"name\":\"TANK TRAILERS - NON CODE\"},\"275\":{\"id\":\"tank trailers - other\",\"name\":\"TANK TRAILERS - OTHER\"},\"276\":{\"id\":\"tank trailers - pneumatic \/ dry bulk\",\"name\":\"TANK TRAILERS - PNEUMATIC \/ DRY BULK\"},\"277\":{\"id\":\"tank trailers - sanitary\",\"name\":\"TANK TRAILERS - SANITARY\"},\"278\":{\"id\":\"tank trailers - vacuum\",\"name\":\"TANK TRAILERS - VACUUM\"},\"279\":{\"id\":\"tank trailers - waste \/ sludge\",\"name\":\"TANK TRAILERS - WASTE \/ SLUDGE\"},\"280\":{\"id\":\"tank trailers - water\",\"name\":\"TANK TRAILERS - WATER\"},\"281\":{\"id\":\"tank trucks - asphalt \/ hot o\",\"name\":\"TANK TRUCKS - ASPHALT \/ HOT O\"},\"282\":{\"id\":\"tank trucks - asphalt \/ hot oi\",\"name\":\"TANK TRUCKS - ASPHALT \/ HOT OI\"},\"283\":{\"id\":\"tank trucks - chemical \/ acid\",\"name\":\"TANK TRUCKS - CHEMICAL \/ ACID\"},\"284\":{\"id\":\"tank trucks - gasoline \/ fuel\",\"name\":\"TANK TRUCKS - GASOLINE \/ FUEL\"},\"285\":{\"id\":\"tank trucks - lpg\",\"name\":\"TANK TRUCKS - LPG\"},\"286\":{\"id\":\"tank trucks - milk\",\"name\":\"TANK TRUCKS - MILK\"},\"287\":{\"id\":\"tank trucks - sewer rodder \/\",\"name\":\"TANK TRUCKS - SEWER RODDER \/\"},\"288\":{\"id\":\"tank trucks - sewer rodder \/ s\",\"name\":\"TANK TRUCKS - SEWER RODDER \/ S\"},\"289\":{\"id\":\"tank trucks - vacuum\",\"name\":\"TANK TRUCKS - VACUUM\"},\"290\":{\"id\":\"tank trucks - water\",\"name\":\"TANK TRUCKS - WATER\"},\"291\":{\"id\":\"tanker trucks\",\"name\":\"TANKER TRUCKS\"},\"292\":{\"id\":\"telescopic\",\"name\":\"TELESCOPIC\"},\"293\":{\"id\":\"toter\",\"name\":\"TOTER\"},\"294\":{\"id\":\"toter trucks\",\"name\":\"TOTER TRUCKS\"},\"295\":{\"id\":\"tow trucks\",\"name\":\"TOW TRUCKS\"},\"296\":{\"id\":\"tow trucks - roll-back\",\"name\":\"TOW TRUCKS - ROLL-BACK\"},\"297\":{\"id\":\"tow trucks - wrecker\",\"name\":\"TOW TRUCKS - WRECKER\"},\"298\":{\"id\":\"tower\",\"name\":\"TOWER\"},\"299\":{\"id\":\"tower\/tank\",\"name\":\"TOWER\/TANK\"},\"300\":{\"id\":\"track\",\"name\":\"TRACK\"},\"301\":{\"id\":\"tractor\",\"name\":\"TRACTOR\"},\"302\":{\"id\":\"trailer\",\"name\":\"TRAILER\"},\"303\":{\"id\":\"travel trailers\",\"name\":\"TRAVEL TRAILERS\"},\"304\":{\"id\":\"traveling axle trailers\",\"name\":\"TRAVELING AXLE TRAILERS\"},\"305\":{\"id\":\"truck\",\"name\":\"TRUCK\"},\"306\":{\"id\":\"truck bodies only\",\"name\":\"TRUCK BODIES ONLY\"},\"307\":{\"id\":\"truck bodies only - dump\",\"name\":\"TRUCK BODIES ONLY - DUMP\"},\"308\":{\"id\":\"truck bodies only - flatbed\",\"name\":\"TRUCK BODIES ONLY - FLATBED\"},\"309\":{\"id\":\"truck bodies only - other\",\"name\":\"TRUCK BODIES ONLY - OTHER\"},\"310\":{\"id\":\"truck bodies only - reefer\",\"name\":\"TRUCK BODIES ONLY - REEFER\"},\"311\":{\"id\":\"truck bodies only - reefer va\",\"name\":\"TRUCK BODIES ONLY - REEFER VA\"},\"312\":{\"id\":\"truck bodies only - service\",\"name\":\"TRUCK BODIES ONLY - SERVICE\"},\"313\":{\"id\":\"truck bodies only - tank \/ va\",\"name\":\"TRUCK BODIES ONLY - TANK \/ VA\"},\"314\":{\"id\":\"truck bodies only - tank \/ vac\",\"name\":\"TRUCK BODIES ONLY - TANK \/ VAC\"},\"315\":{\"id\":\"truck bodies only - van\",\"name\":\"TRUCK BODIES ONLY - VAN\"},\"316\":{\"id\":\"tub grinder\",\"name\":\"TUB GRINDER\"},\"317\":{\"id\":\"tub grinders\/bale proce\",\"name\":\"TUB GRINDERS\/BALE PROCE\"},\"318\":{\"id\":\"utility \/ light duty trailers (up to 7,\",\"name\":\"UTILITY \/ LIGHT DUTY TRAILERS (UP TO 7,\"},\"319\":{\"id\":\"utility trucks - service\",\"name\":\"UTILITY TRUCKS - SERVICE\"},\"320\":{\"id\":\"utility trucks - service truc\",\"name\":\"UTILITY TRUCKS - SERVICE TRUC\"},\"321\":{\"id\":\"utility trucks - service truck\",\"name\":\"UTILITY TRUCKS - SERVICE TRUCK\"},\"322\":{\"id\":\"utility vehicles\",\"name\":\"UTILITY VEHICLES\"},\"323\":{\"id\":\"vacuum\",\"name\":\"VACUUM\"},\"324\":{\"id\":\"vacuum trucks\",\"name\":\"VACUUM TRUCKS\"},\"325\":{\"id\":\"van\",\"name\":\"VAN\"},\"326\":{\"id\":\"van trucks \/ box trucks - cur\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - CUR\"},\"327\":{\"id\":\"van trucks \/ box trucks - cut\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - CUT\"},\"328\":{\"id\":\"van trucks \/ box trucks - cuta\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - CUTA\"},\"329\":{\"id\":\"van trucks \/ box trucks - dry\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - DRY\"},\"330\":{\"id\":\"van trucks \/ box trucks - mov\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - MOV\"},\"331\":{\"id\":\"van trucks \/ box trucks - pas\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - PAS\"},\"332\":{\"id\":\"van trucks \/ box trucks - pass\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - PASS\"},\"333\":{\"id\":\"van trucks \/ box trucks - ree\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - REE\"},\"334\":{\"id\":\"van trucks \/ box trucks - reef\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - REEF\"},\"335\":{\"id\":\"van trucks \/ box trucks - ste\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - STE\"},\"336\":{\"id\":\"van trucks \/ box trucks - step\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - STEP\"},\"337\":{\"id\":\"van trucks \/ straight trucks -\",\"name\":\"VAN TRUCKS \/ STRAIGHT TRUCKS -\"},\"338\":{\"id\":\"versatile hauler trucks\",\"name\":\"VERSATILE HAULER TRUCKS\"},\"339\":{\"id\":\"vertical\",\"name\":\"VERTICAL\"},\"340\":{\"id\":\"vertical tillage\",\"name\":\"VERTICAL TILLAGE\"},\"341\":{\"id\":\"wagon\",\"name\":\"WAGON\"},\"342\":{\"id\":\"walk\/tow behind\",\"name\":\"WALK\/TOW BEHIND\"},\"343\":{\"id\":\"waste \/ sludge\",\"name\":\"WASTE \/ SLUDGE\"},\"344\":{\"id\":\"waste oil trucks\",\"name\":\"WASTE OIL TRUCKS\"},\"345\":{\"id\":\"water\",\"name\":\"WATER\"},\"346\":{\"id\":\"water tank\",\"name\":\"WATER TANK\"},\"347\":{\"id\":\"water trucks\",\"name\":\"WATER TRUCKS\"},\"348\":{\"id\":\"wheel\",\"name\":\"WHEEL\"},\"349\":{\"id\":\"winch \/ oil field trucks\",\"name\":\"WINCH \/ OIL FIELD TRUCKS\"},\"350\":{\"id\":\"winch trucks\",\"name\":\"WINCH TRUCKS\"},\"351\":{\"id\":\"wood chipper\",\"name\":\"WOOD CHIPPER\"},\"352\":{\"id\":\"wrecker tow trucks\",\"name\":\"WRECKER TOW TRUCKS\"},\"353\":{\"id\":\"yard spotter trucks\",\"name\":\"YARD SPOTTER TRUCKS\"}},\"not_select\":\"\",\"select\":\"\"}","multiselect_vehicle_tags":"{\"data\":{\"1\":{\"id\":31,\"name\":\"ADESA\"},\"2\":{\"id\":29,\"name\":\"Premium Vehicle\"},\"3\":{\"id\":33,\"name\":\"SmartAuction\"},\"-1\":\"None\"},\"not_select\":\"\",\"select\":\"\"}","free_text_position":"in_title","free_text_color":"","show_location":"0","show_lvs":"no","hours_work":"{\"hours_from\":\"9\",\"min_from\":\"00\",\"am_from\":\"am\",\"hours_to\":\"6\",\"min_to\":\"00\",\"am_to\":\"pm\",\"every_day\":\"\",\"monday\":\"1\",\"tuesday\":\"1\",\"wednesday\":\"1\",\"thursday\":\"1\",\"friday\":\"1\",\"saturday\":\"1\",\"sunday\":\"\"}","lvs_image":"","extendedHours":"yes","auction_mode":"1","layout":"responsive","widget_visibility":"all","simulcast_mode":"0","buy_now_enabled":1,"offer_counter":"0","offer_counter_label":"Offers","countdown_timer":"0","use_tags":"0","ajax_loading_vehicles":true,"submit_message":"","text_for_0_search_results":"There are no results found. Please refine your search and try again.","text_for_empty_inventory":"There aren't any registered cars for this sale as yet. Kindly check back later.","simcasts":"1","title_field":"0","display_vin_number":"hide","display_colors":"display","display_price":"display","display_description":"display","display_vehicle_options":"hide","form_to_show_vin_number":"dummy","display_phone_number":"hide","form_to_show_phone_number":"dummy","withimagesonly":"No","withoutimagesonly":"no","lvs_title":"Live Video Streaming","json_mode":0,"default_sorting":"make","default_sorting_auction_mode":"make","showWatchButton":"no","list_of_makes_inventory":"all","filterByUser":"{\"data\":[{\"id\":75183,\"name\":\"Root User [75183] NedbankMFC\"},{\"id\":75185,\"name\":\"&nbsp;&nbsp;[75185] Nedbank Group MFC Auction House\"},{\"id\":75187,\"name\":\"&nbsp;&nbsp;&nbsp;&nbsp;[75187] Z - Auctionstreaming Group LLC\"},{\"id\":75205,\"name\":\"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[75205] Jane Claire\"},{\"id\":75199,\"name\":\"&nbsp;&nbsp;&nbsp;&nbsp;[75199] Clerk\"},{\"id\":75201,\"name\":\"&nbsp;&nbsp;&nbsp;&nbsp;[75201] Test Dealer\"},{\"id\":75203,\"name\":\"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[75203] Mary Jones\"}],\"not_select\":[],\"select\":[\"75183\",\"75185\",\"75187\",\"75205\",\"75199\",\"75201\",\"75203\"],\"unselected_default\":true}","showDocuments":"yes","documentsTitle":"Documents","useShippingCost":"no","showPoliciesButton":"no","showVideoButton":"no","refreshTimeout":"0","mode":"template","gradingType":"virGrading","showGrading":"yes","template":"responsive","colorTheme":"default","wow":"nowow","vehicle_list":null,"vehicle_nav":[],"details_page":0,"gallery_page":0,"carfax":false,"autocheck":false,"layoutName":"inventory-md","revertGrading":false,"isHideVirEnabled":false,"auctions_marketplace_extended_access":true,"widgetId":"inventory_new"},
            page: 1,
            sortBy: "make",
            sortOrder: "asc",
            pageId: 6,
            requestParams: {},
            enableModalWidgets: true,
            loaderShow: new axAjaxWidgetLoader({
                $wrapper: $('.inventory_md_' + '6981ed48d52c2'),
                duration: 1000,
                useScroll: true,
                loaderWrapper: '.loader',
                $scrollingElem: $('html, body')
            })
        };

        new InventoryCommonAjax(params);

    });
</script>
<script>
    window.arrayVehiclesFullList = Array(0);
    if (!Array.isArray(window.arrayVehiclesInventory)) {
        window.arrayVehiclesInventory = [];
    }

    mergeVehicleArray(0, window.arrayVehiclesFullList, window.arrayVehiclesInventory);
    saveParamsInToSotrage(window.localStorage);

    /* Required to preserve workable previous functional without using document.referrer */
    saveParamsInToSotrage(window.sessionStorage);

    /* DELETE GLOBAL VARIABLES */
    window.arrayVehiclesFullList = null;

    /**
     * Get inventory path name without url params.
     * @return {string}
     */
    function getInventoryPagePath () {
        var inventoryPath = document.location.pathname ?
            document.location.pathname.split('.')[0]
            : '';

        inventoryPath = inventoryPath
            ? inventoryPath.split('_')[0]
            : inventoryPath;

        return inventoryPath;
    };

    /**
     * Save needed params into specified type of storage
     * @param {Storage.constructor} storage One of storage types: localStorage or sessionStorage
     */
    function saveParamsInToSotrage(storage) {
        if (storage instanceof window.Storage) {
            storage.setItem('com.autoxloo.inventoryList', JSON.stringify(window.arrayVehiclesFullList));
            storage.setItem('com.autoxloo.vehiclesPerPage', 20);
            storage.setItem('com.autoxloo.widgetParams', JSON.stringify({"corners":"round","style":"default","type":"inventory","filter_condition":"all","items":"20","filter_year":"0","filter_make":"none","imagesize":1,"fontsize":14,"prices":"{\"price_type\":\"default\",\"markdown\":\"\",\"markdown_price\":\"current\",\"discount_top\":\"current\",\"discount_bottom\":\"current\",\"customlabels\":false,\"label_top\":\"Top Price\",\"label_middle\":\"Current Price\",\"label_bottom\":\"Bottom Price\",\"custom_top\":\"CALL\",\"custom_middle\":\"CALL\",\"custom_bottom\":\"CALL\"}","priority_min":"0","priority_max":"","priority_method":"Disabled","search_against":"User","paid":"no","seller_type":"all","page_count":"15","cstm_mileage_value":"","carfax_highlights":"0","show_eprice":"No","title_eprice":"Get ePrice","show_discount":"No","title_discount":"Price Quote","stock":"","multiselect_motorize_type":"{\"data\":{\"1\":{\"id\":16,\"name\":\"AGRICULTURAL EQUIPMENT\"},\"2\":{\"id\":1,\"name\":\"BOAT\"},\"3\":{\"id\":3,\"name\":\"CARS & TRUCKS & VANS\"},\"4\":{\"id\":2,\"name\":\"COMMERCIAL TRUCKS\"},\"5\":{\"id\":4,\"name\":\"LIGHT TRUCK\"},\"6\":{\"id\":14,\"name\":\"MOTORCYCLE\"}},\"not_select\":\"\",\"select\":\"\"}","multiselect_filter_category":"{\"data\":{\"0\":\"None\",\"1\":{\"id\":\"\",\"name\":\"\"},\"2\":{\"id\":\"100 hp to 174 hp\",\"name\":\"100 HP TO 174 HP\"},\"3\":{\"id\":\"175 hp or greater\",\"name\":\"175 HP OR GREATER\"},\"4\":{\"id\":\"40 hp to 99 hp\",\"name\":\"40 HP TO 99 HP\"},\"5\":{\"id\":\"agriculture equipment transport trailer\",\"name\":\"AGRICULTURE EQUIPMENT TRANSPORT TRAILER\"},\"6\":{\"id\":\"air seeders\/air carts\",\"name\":\"AIR SEEDERS\/AIR CARTS\"},\"7\":{\"id\":\"all terrain \/ hydraulic\",\"name\":\"ALL TERRAIN \/ HYDRAULIC\"},\"8\":{\"id\":\"ambulance\",\"name\":\"AMBULANCE\"},\"9\":{\"id\":\"armored trucks\",\"name\":\"ARMORED TRUCKS\"},\"10\":{\"id\":\"asphalt \/ hot oil\",\"name\":\"ASPHALT \/ HOT OIL\"},\"11\":{\"id\":\"attenuator\",\"name\":\"ATTENUATOR\"},\"12\":{\"id\":\"atvs\",\"name\":\"ATVS\"},\"13\":{\"id\":\"auger\",\"name\":\"AUGER\"},\"14\":{\"id\":\"bale accumulators \/ mov\",\"name\":\"BALE ACCUMULATORS \/ MOV\"},\"15\":{\"id\":\"belt trailers\",\"name\":\"BELT TRAILERS\"},\"16\":{\"id\":\"beverage trailers\",\"name\":\"BEVERAGE TRAILERS\"},\"17\":{\"id\":\"beverage trucks\",\"name\":\"BEVERAGE TRUCKS\"},\"18\":{\"id\":\"blade \/ tower trailers\",\"name\":\"BLADE \/ TOWER TRAILERS\"},\"19\":{\"id\":\"blades\/box scrapers\",\"name\":\"BLADES\/BOX SCRAPERS\"},\"20\":{\"id\":\"boom\",\"name\":\"BOOM\"},\"21\":{\"id\":\"boom truck\",\"name\":\"BOOM TRUCK\"},\"22\":{\"id\":\"bottom\",\"name\":\"BOTTOM\"},\"23\":{\"id\":\"box trucks - straight tru\",\"name\":\"BOX TRUCKS - STRAIGHT TRU\"},\"24\":{\"id\":\"box trucks - straight trucks\",\"name\":\"BOX TRUCKS - STRAIGHT TRUCKS\"},\"25\":{\"id\":\"bucket\",\"name\":\"BUCKET\"},\"26\":{\"id\":\"bucket trucks - boom truc\",\"name\":\"BUCKET TRUCKS - BOOM TRUC\"},\"27\":{\"id\":\"bucket trucks - boom trucks\",\"name\":\"BUCKET TRUCKS - BOOM TRUCKS\"},\"28\":{\"id\":\"bucket trucks \/ boom trucks\",\"name\":\"BUCKET TRUCKS \/ BOOM TRUCKS\"},\"29\":{\"id\":\"bus\",\"name\":\"BUS\"},\"30\":{\"id\":\"cab & chassis trucks\",\"name\":\"CAB & CHASSIS TRUCKS\"},\"31\":{\"id\":\"cab chassis\",\"name\":\"CAB CHASSIS\"},\"32\":{\"id\":\"cable dispenser\",\"name\":\"CABLE DISPENSER\"},\"33\":{\"id\":\"cable scrappers\",\"name\":\"CABLE SCRAPPERS\"},\"34\":{\"id\":\"cabover trucks - coe\",\"name\":\"CABOVER TRUCKS - COE\"},\"35\":{\"id\":\"cabover trucks - sleeper\",\"name\":\"CABOVER TRUCKS - SLEEPER\"},\"36\":{\"id\":\"cabover trucks w\/ sleeper\",\"name\":\"CABOVER TRUCKS W\/ SLEEPER\"},\"37\":{\"id\":\"cabover trucks w\/o sleeper\",\"name\":\"CABOVER TRUCKS W\/O SLEEPER\"},\"38\":{\"id\":\"cabover trucks w\/o sleeper -\",\"name\":\"CABOVER TRUCKS W\/O SLEEPER -\"},\"39\":{\"id\":\"car carrier\",\"name\":\"CAR CARRIER\"},\"40\":{\"id\":\"car carrier trailers - enclosed\",\"name\":\"CAR CARRIER TRAILERS - ENCLOSED\"},\"41\":{\"id\":\"car carrier trailers - open\",\"name\":\"CAR CARRIER TRAILERS - OPEN\"},\"42\":{\"id\":\"car carrier trucks\",\"name\":\"CAR CARRIER TRUCKS\"},\"43\":{\"id\":\"cargo van\",\"name\":\"CARGO VAN\"},\"44\":{\"id\":\"carry deck\",\"name\":\"CARRY DECK\"},\"45\":{\"id\":\"catering trucks - food tr\",\"name\":\"CATERING TRUCKS - FOOD TR\"},\"46\":{\"id\":\"catering trucks - food trucks\",\"name\":\"CATERING TRUCKS - FOOD TRUCKS\"},\"47\":{\"id\":\"chemical \/ acid\",\"name\":\"CHEMICAL \/ ACID\"},\"48\":{\"id\":\"chipper trailers\",\"name\":\"CHIPPER TRAILERS\"},\"49\":{\"id\":\"chipper trucks\",\"name\":\"CHIPPER TRUCKS\"},\"50\":{\"id\":\"combination\",\"name\":\"COMBINATION\"},\"51\":{\"id\":\"combines\",\"name\":\"COMBINES\"},\"52\":{\"id\":\"conventional - day cab\",\"name\":\"CONVENTIONAL - DAY CAB\"},\"53\":{\"id\":\"conventional - sleeper tr\",\"name\":\"CONVENTIONAL - SLEEPER TR\"},\"54\":{\"id\":\"conventional - sleeper trucks\",\"name\":\"CONVENTIONAL - SLEEPER TRUCKS\"},\"55\":{\"id\":\"conventional truck\",\"name\":\"CONVENTIONAL TRUCK\"},\"56\":{\"id\":\"conventional trucks w\/ sleeper\",\"name\":\"CONVENTIONAL TRUCKS W\/ SLEEPER\"},\"57\":{\"id\":\"conventional trucks w\/o sleep\",\"name\":\"CONVENTIONAL TRUCKS W\/O SLEEP\"},\"58\":{\"id\":\"conventional trucks w\/o sleepe\",\"name\":\"CONVENTIONAL TRUCKS W\/O SLEEPE\"},\"59\":{\"id\":\"conveyor \/ feeder \/ stacker\",\"name\":\"CONVEYOR \/ FEEDER \/ STACKER\"},\"60\":{\"id\":\"cotton pickers\/strippers\",\"name\":\"COTTON PICKERS\/STRIPPERS\"},\"61\":{\"id\":\"crane trucks\",\"name\":\"CRANE TRUCKS\"},\"62\":{\"id\":\"crawler\",\"name\":\"CRAWLER\"},\"63\":{\"id\":\"crawler \/ dragline\",\"name\":\"CRAWLER \/ DRAGLINE\"},\"64\":{\"id\":\"crew cab\",\"name\":\"CREW CAB\"},\"65\":{\"id\":\"crude oil\",\"name\":\"CRUDE OIL\"},\"66\":{\"id\":\"crusher\",\"name\":\"CRUSHER\"},\"67\":{\"id\":\"curtain side trailers\",\"name\":\"CURTAIN SIDE TRAILERS\"},\"68\":{\"id\":\"cutaway-cube van\",\"name\":\"CUTAWAY-CUBE VAN\"},\"69\":{\"id\":\"delimber\",\"name\":\"DELIMBER\"},\"70\":{\"id\":\"diesel\",\"name\":\"DIESEL\"},\"71\":{\"id\":\"digger derrick\",\"name\":\"DIGGER DERRICK\"},\"72\":{\"id\":\"digger derrick trucks\",\"name\":\"DIGGER DERRICK TRUCKS\"},\"73\":{\"id\":\"disc mowers\",\"name\":\"DISC MOWERS\"},\"74\":{\"id\":\"disks\",\"name\":\"DISKS\"},\"75\":{\"id\":\"dolly trailers\",\"name\":\"DOLLY TRAILERS\"},\"76\":{\"id\":\"double drop trailers\",\"name\":\"DOUBLE DROP TRAILERS\"},\"77\":{\"id\":\"drills\",\"name\":\"DRILLS\"},\"78\":{\"id\":\"drop deck trailers\",\"name\":\"DROP DECK TRAILERS\"},\"79\":{\"id\":\"drop frame van trailers - electronics\",\"name\":\"DROP FRAME VAN TRAILERS - ELECTRONICS\"},\"80\":{\"id\":\"drop frame van trailers - moving\",\"name\":\"DROP FRAME VAN TRAILERS - MOVING\"},\"81\":{\"id\":\"dry van\",\"name\":\"DRY VAN\"},\"82\":{\"id\":\"dry van trailers\",\"name\":\"DRY VAN TRAILERS\"},\"83\":{\"id\":\"dump \/ transfer\",\"name\":\"DUMP \/ TRANSFER\"},\"84\":{\"id\":\"dump chassis trucks\",\"name\":\"DUMP CHASSIS TRUCKS\"},\"85\":{\"id\":\"dump trailers - bottom\",\"name\":\"DUMP TRAILERS - BOTTOM\"},\"86\":{\"id\":\"dump trailers - end\",\"name\":\"DUMP TRAILERS - END\"},\"87\":{\"id\":\"dump trailers - side\",\"name\":\"DUMP TRAILERS - SIDE\"},\"88\":{\"id\":\"dump trucks\",\"name\":\"DUMP TRUCKS\"},\"89\":{\"id\":\"electronics\",\"name\":\"ELECTRONICS\"},\"90\":{\"id\":\"enclosed\",\"name\":\"ENCLOSED\"},\"91\":{\"id\":\"end\",\"name\":\"END\"},\"92\":{\"id\":\"expeditor \/ hot shot trucks\",\"name\":\"EXPEDITOR \/ HOT SHOT TRUCKS\"},\"93\":{\"id\":\"expeditor-hotshot\",\"name\":\"EXPEDITOR-HOTSHOT\"},\"94\":{\"id\":\"extended cab\",\"name\":\"EXTENDED CAB\"},\"95\":{\"id\":\"farm \/ grain trucks\",\"name\":\"FARM \/ GRAIN TRUCKS\"},\"96\":{\"id\":\"farm trucks - grain truck\",\"name\":\"FARM TRUCKS - GRAIN TRUCK\"},\"97\":{\"id\":\"farm trucks - grain trucks\",\"name\":\"FARM TRUCKS - GRAIN TRUCKS\"},\"98\":{\"id\":\"feed grinders\",\"name\":\"FEED GRINDERS\"},\"99\":{\"id\":\"feed\/mixer wagon\",\"name\":\"FEED\/MIXER WAGON\"},\"100\":{\"id\":\"feller buncher\",\"name\":\"FELLER BUNCHER\"},\"101\":{\"id\":\"fertilizer applicators - an\",\"name\":\"FERTILIZER APPLICATORS - AN\"},\"102\":{\"id\":\"fertilizer applicators - dr\",\"name\":\"FERTILIZER APPLICATORS - DR\"},\"103\":{\"id\":\"fertilizer applicators - li\",\"name\":\"FERTILIZER APPLICATORS - LI\"},\"104\":{\"id\":\"field cultivators\",\"name\":\"FIELD CULTIVATORS\"},\"105\":{\"id\":\"fire trucks\",\"name\":\"FIRE TRUCKS\"},\"106\":{\"id\":\"flatbed dump\",\"name\":\"FLATBED DUMP\"},\"107\":{\"id\":\"flatbed trailers\",\"name\":\"FLATBED TRAILERS\"},\"108\":{\"id\":\"flatbed trucks\",\"name\":\"FLATBED TRUCKS\"},\"109\":{\"id\":\"flatbed-dump\",\"name\":\"FLATBED-DUMP\"},\"110\":{\"id\":\"floaters\",\"name\":\"FLOATERS\"},\"111\":{\"id\":\"food trucks\",\"name\":\"FOOD TRUCKS\"},\"112\":{\"id\":\"forage - pull-type\",\"name\":\"FORAGE - PULL-TYPE\"},\"113\":{\"id\":\"forage - self-propelled\",\"name\":\"FORAGE - SELF-PROPELLED\"},\"114\":{\"id\":\"forage wagons\",\"name\":\"FORAGE WAGONS\"},\"115\":{\"id\":\"forwarder\",\"name\":\"FORWARDER\"},\"116\":{\"id\":\"frac\",\"name\":\"FRAC\"},\"117\":{\"id\":\"fuel \/ lube trucks\",\"name\":\"FUEL \/ LUBE TRUCKS\"},\"118\":{\"id\":\"fuel trucks - lube trucks\",\"name\":\"FUEL TRUCKS - LUBE TRUCKS\"},\"119\":{\"id\":\"garbage trucks\",\"name\":\"GARBAGE TRUCKS\"},\"120\":{\"id\":\"garbage trucks - packer\",\"name\":\"GARBAGE TRUCKS - PACKER\"},\"121\":{\"id\":\"garbage trucks - roll-off\",\"name\":\"GARBAGE TRUCKS - ROLL-OFF\"},\"122\":{\"id\":\"gas\",\"name\":\"GAS\"},\"123\":{\"id\":\"gasoline \/ fuel\",\"name\":\"GASOLINE \/ FUEL\"},\"124\":{\"id\":\"glass trucks\",\"name\":\"GLASS TRUCKS\"},\"125\":{\"id\":\"glider kit\",\"name\":\"GLIDER KIT\"},\"126\":{\"id\":\"grain augers\/conveyors\",\"name\":\"GRAIN AUGERS\/CONVEYORS\"},\"127\":{\"id\":\"grain carts\",\"name\":\"GRAIN CARTS\"},\"128\":{\"id\":\"grapple trucks\",\"name\":\"GRAPPLE TRUCKS\"},\"129\":{\"id\":\"gravity wagons\",\"name\":\"GRAVITY WAGONS\"},\"130\":{\"id\":\"hauler\",\"name\":\"HAULER\"},\"131\":{\"id\":\"header trailers\",\"name\":\"HEADER TRAILERS\"},\"132\":{\"id\":\"headers - forage - rotary\",\"name\":\"HEADERS - FORAGE - ROTARY\"},\"133\":{\"id\":\"headers - forage - row crop\",\"name\":\"HEADERS - FORAGE - ROW CROP\"},\"134\":{\"id\":\"headers - forage - windrow\",\"name\":\"HEADERS - FORAGE - WINDROW\"},\"135\":{\"id\":\"headers - platform\",\"name\":\"HEADERS - PLATFORM\"},\"136\":{\"id\":\"headers - rowcrop\",\"name\":\"HEADERS - ROWCROP\"},\"137\":{\"id\":\"hooklift trucks\",\"name\":\"HOOKLIFT TRUCKS\"},\"138\":{\"id\":\"hopper \/ grain trailers\",\"name\":\"HOPPER \/ GRAIN TRAILERS\"},\"139\":{\"id\":\"horizontal\",\"name\":\"HORIZONTAL\"},\"140\":{\"id\":\"horizontal grinder\",\"name\":\"HORIZONTAL GRINDER\"},\"141\":{\"id\":\"horse trailers\",\"name\":\"HORSE TRAILERS\"},\"142\":{\"id\":\"industrial gas\",\"name\":\"INDUSTRIAL GAS\"},\"143\":{\"id\":\"insulator washer\",\"name\":\"INSULATOR WASHER\"},\"144\":{\"id\":\"intermodal \/ container chassis only\",\"name\":\"INTERMODAL \/ CONTAINER CHASSIS ONLY\"},\"145\":{\"id\":\"intermodal \/ container trailers\",\"name\":\"INTERMODAL \/ CONTAINER TRAILERS\"},\"146\":{\"id\":\"land rollers\",\"name\":\"LAND ROLLERS\"},\"147\":{\"id\":\"landfill\",\"name\":\"LANDFILL\"},\"148\":{\"id\":\"landscape trucks\",\"name\":\"LANDSCAPE TRUCKS\"},\"149\":{\"id\":\"less than 40 hp\",\"name\":\"LESS THAN 40 HP\"},\"150\":{\"id\":\"lift trucks\",\"name\":\"LIFT TRUCKS\"},\"151\":{\"id\":\"live floor trailers\",\"name\":\"LIVE FLOOR TRAILERS\"},\"152\":{\"id\":\"livestock\",\"name\":\"LIVESTOCK\"},\"153\":{\"id\":\"livestock trailers\",\"name\":\"LIVESTOCK TRAILERS\"},\"154\":{\"id\":\"loaders\",\"name\":\"LOADERS\"},\"155\":{\"id\":\"log trailers\",\"name\":\"LOG TRAILERS\"},\"156\":{\"id\":\"logging\",\"name\":\"LOGGING\"},\"157\":{\"id\":\"logging trucks\",\"name\":\"LOGGING TRUCKS\"},\"158\":{\"id\":\"lowboy trailers\",\"name\":\"LOWBOY TRAILERS\"},\"159\":{\"id\":\"manure spreaders - dry\",\"name\":\"MANURE SPREADERS - DRY\"},\"160\":{\"id\":\"manure spreaders - liquid\",\"name\":\"MANURE SPREADERS - LIQUID\"},\"161\":{\"id\":\"manure systems\",\"name\":\"MANURE SYSTEMS\"},\"162\":{\"id\":\"mast\",\"name\":\"MAST\"},\"163\":{\"id\":\"material handling\",\"name\":\"MATERIAL HANDLING\"},\"164\":{\"id\":\"mechanics trucks\",\"name\":\"MECHANICS TRUCKS\"},\"165\":{\"id\":\"mega cab\",\"name\":\"MEGA CAB\"},\"166\":{\"id\":\"military\",\"name\":\"MILITARY\"},\"167\":{\"id\":\"mini (up to 12,000 lbs)\",\"name\":\"MINI (UP TO 12,000 LBS)\"},\"168\":{\"id\":\"mini trucks\",\"name\":\"MINI TRUCKS\"},\"169\":{\"id\":\"minibus\",\"name\":\"MINIBUS\"},\"170\":{\"id\":\"miscellaneous\",\"name\":\"MISCELLANEOUS\"},\"171\":{\"id\":\"mixer \/ asphalt \/ concrete tr\",\"name\":\"MIXER \/ ASPHALT \/ CONCRETE TR\"},\"172\":{\"id\":\"mixer \/ asphalt \/ concrete tru\",\"name\":\"MIXER \/ ASPHALT \/ CONCRETE TRU\"},\"173\":{\"id\":\"mixer trucks\",\"name\":\"MIXER TRUCKS\"},\"174\":{\"id\":\"mobility van\",\"name\":\"MOBILITY VAN\"},\"175\":{\"id\":\"motor\",\"name\":\"MOTOR\"},\"176\":{\"id\":\"moving\",\"name\":\"MOVING\"},\"177\":{\"id\":\"moving van\",\"name\":\"MOVING VAN\"},\"178\":{\"id\":\"mower conditioners\/wind\",\"name\":\"MOWER CONDITIONERS\/WIND\"},\"179\":{\"id\":\"mulch finishers\",\"name\":\"MULCH FINISHERS\"},\"180\":{\"id\":\"mulcher\",\"name\":\"MULCHER\"},\"181\":{\"id\":\"multi-engine\",\"name\":\"MULTI-ENGINE\"},\"182\":{\"id\":\"non code\",\"name\":\"NON CODE\"},\"183\":{\"id\":\"oil field trailers\",\"name\":\"OIL FIELD TRAILERS\"},\"184\":{\"id\":\"oil tank trucks\",\"name\":\"OIL TANK TRUCKS\"},\"185\":{\"id\":\"open\",\"name\":\"OPEN\"},\"186\":{\"id\":\"open top trailers\",\"name\":\"OPEN TOP TRAILERS\"},\"187\":{\"id\":\"other\",\"name\":\"OTHER\"},\"188\":{\"id\":\"other trailers\",\"name\":\"OTHER TRAILERS\"},\"189\":{\"id\":\"other trucks\",\"name\":\"OTHER TRUCKS\"},\"190\":{\"id\":\"padfoot\",\"name\":\"PADFOOT\"},\"191\":{\"id\":\"passenger bus\",\"name\":\"PASSENGER BUS\"},\"192\":{\"id\":\"passenger van\",\"name\":\"PASSENGER VAN\"},\"193\":{\"id\":\"personnel\",\"name\":\"PERSONNEL\"},\"194\":{\"id\":\"pick-up trucks\",\"name\":\"PICK-UP TRUCKS\"},\"195\":{\"id\":\"pick-up trucks 2wd - 1 ton\",\"name\":\"PICK-UP TRUCKS 2WD - 1 TON\"},\"196\":{\"id\":\"pick-up trucks 2wd - 1\/2 ton\",\"name\":\"PICK-UP TRUCKS 2WD - 1\/2 TON\"},\"197\":{\"id\":\"pick-up trucks 2wd - 3\/4 ton\",\"name\":\"PICK-UP TRUCKS 2WD - 3\/4 TON\"},\"198\":{\"id\":\"pick-up trucks 2wd - other 2wd\",\"name\":\"PICK-UP TRUCKS 2WD - OTHER 2WD\"},\"199\":{\"id\":\"pick-up trucks 4wd - 1 ton\",\"name\":\"PICK-UP TRUCKS 4WD - 1 TON\"},\"200\":{\"id\":\"pick-up trucks 4wd - 1\/2 ton\",\"name\":\"PICK-UP TRUCKS 4WD - 1\/2 TON\"},\"201\":{\"id\":\"pick-up trucks 4wd - 3\/4 ton\",\"name\":\"PICK-UP TRUCKS 4WD - 3\/4 TON\"},\"202\":{\"id\":\"pick-up trucks 4wd - other 4wd\",\"name\":\"PICK-UP TRUCKS 4WD - OTHER 4WD\"},\"203\":{\"id\":\"pickup trucks\",\"name\":\"PICKUP TRUCKS\"},\"204\":{\"id\":\"planters\",\"name\":\"PLANTERS\"},\"205\":{\"id\":\"plow \/ spreader trucks\",\"name\":\"PLOW \/ SPREADER TRUCKS\"},\"206\":{\"id\":\"plow trucks - spreader tr\",\"name\":\"PLOW TRUCKS - SPREADER TR\"},\"207\":{\"id\":\"plow trucks - spreader trucks\",\"name\":\"PLOW TRUCKS - SPREADER TRUCKS\"},\"208\":{\"id\":\"plows\",\"name\":\"PLOWS\"},\"209\":{\"id\":\"plumber service trucks\",\"name\":\"PLUMBER SERVICE TRUCKS\"},\"210\":{\"id\":\"pneumatic\",\"name\":\"PNEUMATIC\"},\"211\":{\"id\":\"pneumatic \/ dry bulk\",\"name\":\"PNEUMATIC \/ DRY BULK\"},\"212\":{\"id\":\"pole trailers\",\"name\":\"POLE TRAILERS\"},\"213\":{\"id\":\"power units\",\"name\":\"POWER UNITS\"},\"214\":{\"id\":\"processor \/ harvester\",\"name\":\"PROCESSOR \/ HARVESTER\"},\"215\":{\"id\":\"pull\",\"name\":\"PULL\"},\"216\":{\"id\":\"pup trailers\",\"name\":\"PUP TRAILERS\"},\"217\":{\"id\":\"quad cab\",\"name\":\"QUAD CAB\"},\"218\":{\"id\":\"rakes\/tedders\",\"name\":\"RAKES\/TEDDERS\"},\"219\":{\"id\":\"recreational vehicles\",\"name\":\"RECREATIONAL VEHICLES\"},\"220\":{\"id\":\"recycle trucks\",\"name\":\"RECYCLE TRUCKS\"},\"221\":{\"id\":\"reefer trailers\",\"name\":\"REEFER TRAILERS\"},\"222\":{\"id\":\"reefer unit only\",\"name\":\"REEFER UNIT ONLY\"},\"223\":{\"id\":\"reel \/ cable trailers\",\"name\":\"REEL \/ CABLE TRAILERS\"},\"224\":{\"id\":\"refrigerated trucks\",\"name\":\"REFRIGERATED TRUCKS\"},\"225\":{\"id\":\"refuse trailers\",\"name\":\"REFUSE TRAILERS\"},\"226\":{\"id\":\"riding lawn mowers\",\"name\":\"RIDING LAWN MOWERS\"},\"227\":{\"id\":\"rippers\",\"name\":\"RIPPERS\"},\"228\":{\"id\":\"roll off trailers\",\"name\":\"ROLL OFF TRAILERS\"},\"229\":{\"id\":\"roll off trucks\",\"name\":\"ROLL OFF TRUCKS\"},\"230\":{\"id\":\"rollback tow trucks\",\"name\":\"ROLLBACK TOW TRUCKS\"},\"231\":{\"id\":\"rotary mowers\",\"name\":\"ROTARY MOWERS\"},\"232\":{\"id\":\"rotary tillage\",\"name\":\"ROTARY TILLAGE\"},\"233\":{\"id\":\"rough terrain\",\"name\":\"ROUGH TERRAIN\"},\"234\":{\"id\":\"round balers\",\"name\":\"ROUND BALERS\"},\"235\":{\"id\":\"row crop cultivators\",\"name\":\"ROW CROP CULTIVATORS\"},\"236\":{\"id\":\"salvage trucks\",\"name\":\"SALVAGE TRUCKS\"},\"237\":{\"id\":\"sanitary\",\"name\":\"SANITARY\"},\"238\":{\"id\":\"scissor\",\"name\":\"SCISSOR\"},\"239\":{\"id\":\"screen\",\"name\":\"SCREEN\"},\"240\":{\"id\":\"selfloader\",\"name\":\"SELFLOADER\"},\"241\":{\"id\":\"service \/ utility \/ mechanic\",\"name\":\"SERVICE \/ UTILITY \/ MECHANIC\"},\"242\":{\"id\":\"service \/ utility \/ mechanic t\",\"name\":\"SERVICE \/ UTILITY \/ MECHANIC T\"},\"243\":{\"id\":\"sewer trucks\",\"name\":\"SEWER TRUCKS\"},\"244\":{\"id\":\"shredder trucks\",\"name\":\"SHREDDER TRUCKS\"},\"245\":{\"id\":\"side\",\"name\":\"SIDE\"},\"246\":{\"id\":\"single-engine\",\"name\":\"SINGLE-ENGINE\"},\"247\":{\"id\":\"skidder \/ yarder\",\"name\":\"SKIDDER \/ YARDER\"},\"248\":{\"id\":\"sling trucks\",\"name\":\"SLING TRUCKS\"},\"249\":{\"id\":\"smooth drum\",\"name\":\"SMOOTH DRUM\"},\"250\":{\"id\":\"spray trucks\",\"name\":\"SPRAY TRUCKS\"},\"251\":{\"id\":\"sprayers - 3 pt\/mounted\",\"name\":\"SPRAYERS - 3 PT\/MOUNTED\"},\"252\":{\"id\":\"sprayers - pull type\",\"name\":\"SPRAYERS - PULL TYPE\"},\"253\":{\"id\":\"sprayers - self propelled\",\"name\":\"SPRAYERS - SELF PROPELLED\"},\"254\":{\"id\":\"sprinter van\",\"name\":\"SPRINTER VAN\"},\"255\":{\"id\":\"square balers\",\"name\":\"SQUARE BALERS\"},\"256\":{\"id\":\"stake bed\",\"name\":\"STAKE BED\"},\"257\":{\"id\":\"stake trucks\",\"name\":\"STAKE TRUCKS\"},\"258\":{\"id\":\"stalk choppers\/flail mo\",\"name\":\"STALK CHOPPERS\/FLAIL MO\"},\"259\":{\"id\":\"stepvan\",\"name\":\"STEPVAN\"},\"260\":{\"id\":\"stone spreader trucks\",\"name\":\"STONE SPREADER TRUCKS\"},\"261\":{\"id\":\"storage trailers\",\"name\":\"STORAGE TRAILERS\"},\"262\":{\"id\":\"street cleaner\",\"name\":\"STREET CLEANER\"},\"263\":{\"id\":\"super cab\",\"name\":\"SUPER CAB\"},\"264\":{\"id\":\"suv\",\"name\":\"SUV\"},\"265\":{\"id\":\"sweeper\",\"name\":\"SWEEPER\"},\"266\":{\"id\":\"sweeper trucks\",\"name\":\"SWEEPER TRUCKS\"},\"267\":{\"id\":\"tag trailers\",\"name\":\"TAG TRAILERS\"},\"268\":{\"id\":\"tank trailers - asphalt \/ hot oil\",\"name\":\"TANK TRAILERS - ASPHALT \/ HOT OIL\"},\"269\":{\"id\":\"tank trailers - chemical \/ acid\",\"name\":\"TANK TRAILERS - CHEMICAL \/ ACID\"},\"270\":{\"id\":\"tank trailers - crude oil\",\"name\":\"TANK TRAILERS - CRUDE OIL\"},\"271\":{\"id\":\"tank trailers - frac\",\"name\":\"TANK TRAILERS - FRAC\"},\"272\":{\"id\":\"tank trailers - gasoline \/ fuel\",\"name\":\"TANK TRAILERS - GASOLINE \/ FUEL\"},\"273\":{\"id\":\"tank trailers - industrial gas,\",\"name\":\"TANK TRAILERS - INDUSTRIAL GAS,\"},\"274\":{\"id\":\"tank trailers - non code\",\"name\":\"TANK TRAILERS - NON CODE\"},\"275\":{\"id\":\"tank trailers - other\",\"name\":\"TANK TRAILERS - OTHER\"},\"276\":{\"id\":\"tank trailers - pneumatic \/ dry bulk\",\"name\":\"TANK TRAILERS - PNEUMATIC \/ DRY BULK\"},\"277\":{\"id\":\"tank trailers - sanitary\",\"name\":\"TANK TRAILERS - SANITARY\"},\"278\":{\"id\":\"tank trailers - vacuum\",\"name\":\"TANK TRAILERS - VACUUM\"},\"279\":{\"id\":\"tank trailers - waste \/ sludge\",\"name\":\"TANK TRAILERS - WASTE \/ SLUDGE\"},\"280\":{\"id\":\"tank trailers - water\",\"name\":\"TANK TRAILERS - WATER\"},\"281\":{\"id\":\"tank trucks - asphalt \/ hot o\",\"name\":\"TANK TRUCKS - ASPHALT \/ HOT O\"},\"282\":{\"id\":\"tank trucks - asphalt \/ hot oi\",\"name\":\"TANK TRUCKS - ASPHALT \/ HOT OI\"},\"283\":{\"id\":\"tank trucks - chemical \/ acid\",\"name\":\"TANK TRUCKS - CHEMICAL \/ ACID\"},\"284\":{\"id\":\"tank trucks - gasoline \/ fuel\",\"name\":\"TANK TRUCKS - GASOLINE \/ FUEL\"},\"285\":{\"id\":\"tank trucks - lpg\",\"name\":\"TANK TRUCKS - LPG\"},\"286\":{\"id\":\"tank trucks - milk\",\"name\":\"TANK TRUCKS - MILK\"},\"287\":{\"id\":\"tank trucks - sewer rodder \/\",\"name\":\"TANK TRUCKS - SEWER RODDER \/\"},\"288\":{\"id\":\"tank trucks - sewer rodder \/ s\",\"name\":\"TANK TRUCKS - SEWER RODDER \/ S\"},\"289\":{\"id\":\"tank trucks - vacuum\",\"name\":\"TANK TRUCKS - VACUUM\"},\"290\":{\"id\":\"tank trucks - water\",\"name\":\"TANK TRUCKS - WATER\"},\"291\":{\"id\":\"tanker trucks\",\"name\":\"TANKER TRUCKS\"},\"292\":{\"id\":\"telescopic\",\"name\":\"TELESCOPIC\"},\"293\":{\"id\":\"toter\",\"name\":\"TOTER\"},\"294\":{\"id\":\"toter trucks\",\"name\":\"TOTER TRUCKS\"},\"295\":{\"id\":\"tow trucks\",\"name\":\"TOW TRUCKS\"},\"296\":{\"id\":\"tow trucks - roll-back\",\"name\":\"TOW TRUCKS - ROLL-BACK\"},\"297\":{\"id\":\"tow trucks - wrecker\",\"name\":\"TOW TRUCKS - WRECKER\"},\"298\":{\"id\":\"tower\",\"name\":\"TOWER\"},\"299\":{\"id\":\"tower\/tank\",\"name\":\"TOWER\/TANK\"},\"300\":{\"id\":\"track\",\"name\":\"TRACK\"},\"301\":{\"id\":\"tractor\",\"name\":\"TRACTOR\"},\"302\":{\"id\":\"trailer\",\"name\":\"TRAILER\"},\"303\":{\"id\":\"travel trailers\",\"name\":\"TRAVEL TRAILERS\"},\"304\":{\"id\":\"traveling axle trailers\",\"name\":\"TRAVELING AXLE TRAILERS\"},\"305\":{\"id\":\"truck\",\"name\":\"TRUCK\"},\"306\":{\"id\":\"truck bodies only\",\"name\":\"TRUCK BODIES ONLY\"},\"307\":{\"id\":\"truck bodies only - dump\",\"name\":\"TRUCK BODIES ONLY - DUMP\"},\"308\":{\"id\":\"truck bodies only - flatbed\",\"name\":\"TRUCK BODIES ONLY - FLATBED\"},\"309\":{\"id\":\"truck bodies only - other\",\"name\":\"TRUCK BODIES ONLY - OTHER\"},\"310\":{\"id\":\"truck bodies only - reefer\",\"name\":\"TRUCK BODIES ONLY - REEFER\"},\"311\":{\"id\":\"truck bodies only - reefer va\",\"name\":\"TRUCK BODIES ONLY - REEFER VA\"},\"312\":{\"id\":\"truck bodies only - service\",\"name\":\"TRUCK BODIES ONLY - SERVICE\"},\"313\":{\"id\":\"truck bodies only - tank \/ va\",\"name\":\"TRUCK BODIES ONLY - TANK \/ VA\"},\"314\":{\"id\":\"truck bodies only - tank \/ vac\",\"name\":\"TRUCK BODIES ONLY - TANK \/ VAC\"},\"315\":{\"id\":\"truck bodies only - van\",\"name\":\"TRUCK BODIES ONLY - VAN\"},\"316\":{\"id\":\"tub grinder\",\"name\":\"TUB GRINDER\"},\"317\":{\"id\":\"tub grinders\/bale proce\",\"name\":\"TUB GRINDERS\/BALE PROCE\"},\"318\":{\"id\":\"utility \/ light duty trailers (up to 7,\",\"name\":\"UTILITY \/ LIGHT DUTY TRAILERS (UP TO 7,\"},\"319\":{\"id\":\"utility trucks - service\",\"name\":\"UTILITY TRUCKS - SERVICE\"},\"320\":{\"id\":\"utility trucks - service truc\",\"name\":\"UTILITY TRUCKS - SERVICE TRUC\"},\"321\":{\"id\":\"utility trucks - service truck\",\"name\":\"UTILITY TRUCKS - SERVICE TRUCK\"},\"322\":{\"id\":\"utility vehicles\",\"name\":\"UTILITY VEHICLES\"},\"323\":{\"id\":\"vacuum\",\"name\":\"VACUUM\"},\"324\":{\"id\":\"vacuum trucks\",\"name\":\"VACUUM TRUCKS\"},\"325\":{\"id\":\"van\",\"name\":\"VAN\"},\"326\":{\"id\":\"van trucks \/ box trucks - cur\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - CUR\"},\"327\":{\"id\":\"van trucks \/ box trucks - cut\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - CUT\"},\"328\":{\"id\":\"van trucks \/ box trucks - cuta\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - CUTA\"},\"329\":{\"id\":\"van trucks \/ box trucks - dry\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - DRY\"},\"330\":{\"id\":\"van trucks \/ box trucks - mov\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - MOV\"},\"331\":{\"id\":\"van trucks \/ box trucks - pas\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - PAS\"},\"332\":{\"id\":\"van trucks \/ box trucks - pass\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - PASS\"},\"333\":{\"id\":\"van trucks \/ box trucks - ree\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - REE\"},\"334\":{\"id\":\"van trucks \/ box trucks - reef\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - REEF\"},\"335\":{\"id\":\"van trucks \/ box trucks - ste\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - STE\"},\"336\":{\"id\":\"van trucks \/ box trucks - step\",\"name\":\"VAN TRUCKS \/ BOX TRUCKS - STEP\"},\"337\":{\"id\":\"van trucks \/ straight trucks -\",\"name\":\"VAN TRUCKS \/ STRAIGHT TRUCKS -\"},\"338\":{\"id\":\"versatile hauler trucks\",\"name\":\"VERSATILE HAULER TRUCKS\"},\"339\":{\"id\":\"vertical\",\"name\":\"VERTICAL\"},\"340\":{\"id\":\"vertical tillage\",\"name\":\"VERTICAL TILLAGE\"},\"341\":{\"id\":\"wagon\",\"name\":\"WAGON\"},\"342\":{\"id\":\"walk\/tow behind\",\"name\":\"WALK\/TOW BEHIND\"},\"343\":{\"id\":\"waste \/ sludge\",\"name\":\"WASTE \/ SLUDGE\"},\"344\":{\"id\":\"waste oil trucks\",\"name\":\"WASTE OIL TRUCKS\"},\"345\":{\"id\":\"water\",\"name\":\"WATER\"},\"346\":{\"id\":\"water tank\",\"name\":\"WATER TANK\"},\"347\":{\"id\":\"water trucks\",\"name\":\"WATER TRUCKS\"},\"348\":{\"id\":\"wheel\",\"name\":\"WHEEL\"},\"349\":{\"id\":\"winch \/ oil field trucks\",\"name\":\"WINCH \/ OIL FIELD TRUCKS\"},\"350\":{\"id\":\"winch trucks\",\"name\":\"WINCH TRUCKS\"},\"351\":{\"id\":\"wood chipper\",\"name\":\"WOOD CHIPPER\"},\"352\":{\"id\":\"wrecker tow trucks\",\"name\":\"WRECKER TOW TRUCKS\"},\"353\":{\"id\":\"yard spotter trucks\",\"name\":\"YARD SPOTTER TRUCKS\"}},\"not_select\":\"\",\"select\":\"\"}","multiselect_vehicle_tags":"{\"data\":{\"1\":{\"id\":31,\"name\":\"ADESA\"},\"2\":{\"id\":29,\"name\":\"Premium Vehicle\"},\"3\":{\"id\":33,\"name\":\"SmartAuction\"},\"-1\":\"None\"},\"not_select\":\"\",\"select\":\"\"}","free_text_position":"in_title","free_text_color":"","show_location":"0","show_lvs":"no","hours_work":"{\"hours_from\":\"9\",\"min_from\":\"00\",\"am_from\":\"am\",\"hours_to\":\"6\",\"min_to\":\"00\",\"am_to\":\"pm\",\"every_day\":\"\",\"monday\":\"1\",\"tuesday\":\"1\",\"wednesday\":\"1\",\"thursday\":\"1\",\"friday\":\"1\",\"saturday\":\"1\",\"sunday\":\"\"}","lvs_image":"","extendedHours":"yes","auction_mode":"1","layout":"responsive","widget_visibility":"all","simulcast_mode":"0","buy_now_enabled":1,"offer_counter":"0","offer_counter_label":"Offers","countdown_timer":"0","use_tags":"0","ajax_loading_vehicles":true,"submit_message":"","text_for_0_search_results":"There are no results found. Please refine your search and try again.","text_for_empty_inventory":"There aren't any registered cars for this sale as yet. Kindly check back later.","simcasts":"1","title_field":"0","display_vin_number":"hide","display_colors":"display","display_price":"display","display_description":"display","display_vehicle_options":"hide","form_to_show_vin_number":"dummy","display_phone_number":"hide","form_to_show_phone_number":"dummy","withimagesonly":"No","withoutimagesonly":"no","lvs_title":"Live Video Streaming","json_mode":0,"default_sorting":"make","default_sorting_auction_mode":"make","showWatchButton":"no","list_of_makes_inventory":"all","filterByUser":"{\"data\":[{\"id\":75183,\"name\":\"Root User [75183] NedbankMFC\"},{\"id\":75185,\"name\":\"&nbsp;&nbsp;[75185] Nedbank Group MFC Auction House\"},{\"id\":75187,\"name\":\"&nbsp;&nbsp;&nbsp;&nbsp;[75187] Z - Auctionstreaming Group LLC\"},{\"id\":75205,\"name\":\"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[75205] Jane Claire\"},{\"id\":75199,\"name\":\"&nbsp;&nbsp;&nbsp;&nbsp;[75199] Clerk\"},{\"id\":75201,\"name\":\"&nbsp;&nbsp;&nbsp;&nbsp;[75201] Test Dealer\"},{\"id\":75203,\"name\":\"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[75203] Mary Jones\"}],\"not_select\":[],\"select\":[\"75183\",\"75185\",\"75187\",\"75205\",\"75199\",\"75201\",\"75203\"],\"unselected_default\":true}","showDocuments":"yes","documentsTitle":"Documents","useShippingCost":"no","showPoliciesButton":"no","showVideoButton":"no","refreshTimeout":"0","mode":"template","gradingType":"virGrading","showGrading":"yes","template":"responsive","colorTheme":"default","wow":"nowow","vehicle_list":null,"vehicle_nav":[],"details_page":0,"gallery_page":0,"carfax":false,"autocheck":false,"layoutName":"inventory-md","revertGrading":false,"isHideVirEnabled":false,"auctions_marketplace_extended_access":true,"widgetId":"inventory_new"}));
            storage.setItem('com.autoxloo.requestParams', JSON.stringify({}));
            storage.setItem('com.autoxloo.inventoryPath', getInventoryPagePath());
        }
    }
</script>

<div class="btn-r-custom nowow btn-6981ed48d5805 corner-yes pos-center imAlig-center text-center">
    <div class="btn
                btn-default                                notransition"
         style="
                                               text-align: center;
                              "
                      data-toggle="modal" data-target="#btn-modal-6981ed48d5805"
         >
       <span> Filters</span>
    </div>
    <div class="clearfix"></div>
</div>

    <div class="modal fade" id="btn-modal-6981ed48d5805">
        <div class="modal-dialog popup-mobile">
            <div class="modal-content">
                                <div class="modal-body">
                                                                                </div>
                                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                            </div>
        </div>
    </div>

    <script type="text/javascript">
        /* fix carousels in popup (if any) */
        var $btnWidgetModal = $('#btn-modal-6981ed48d5805');

        $btnWidgetModal.on('shown.bs.modal', function () {
            var $this = $(this);
            $this.find('form input[type!="hidden"], textarea, select').first().trigger('focus');
        });

        $(function () {
            /* if form successfully send  */
            if ($btnWidgetModal.find('[data-success="1"]').length) {
                $btnWidgetModal.modal('show');
            }
        });
    </script>
</div></div>
 </div>
        </main>
        <footer>
            <div class="layout-container container" data-container="footer">

            
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  " data-container="footer_0_0" data-size-lg="12">
<div class="modul-r-container
            container-6981ed48d5834                        nowow"
    >
    <div>
                    <style type="text/css"></style>
    <div>
            <div class="layout-container" data-container="body">
            
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  " data-container="body_0_0" data-size-lg="12"><div class="widget-spacer">
	  <div 
			style="height:10px;"
	  	>
    &nbsp;
    </div>
</div></div></div>
 
   <div class="row"><div class="ax-container empty col-lg-3 col-md-3 col-sm-6 col-xs-6  thin" data-container="body_1_0" data-size-lg="3"><div class="modul-r-editable nowow">
            <!-- no_designtime_scripts -->
        <dev>
<section class="footer-links">
    <header>
        <h3>BUY</h3>
    </header>
    <ul>
      <li><a href="../simulcast-calendar.html">Auctions</a></li>
        <li><a href="../media/dealer_101/storage/docs/Auction_Calculator.pdf" target="_blank">Auction Calculator</a></li>
        <li><a href="..//#" id="js-searchLink" data-toggle="modal" >Search</a> </li>
        <li><a href="../terms-and-conditions.html">Terms and conditions</a></li>
        <li><a href="../frequently-asked-questions.html">FAQ</a></li>
        <li><a href="../our-banking-details.php">Banking details</a></li>
    </ul>
</section>
<script type="text/javascript">
  $(function(){
    var targetLink = $('.js-headerSearch').parents('.btn').data().target;
    
    $('#js-searchLink').attr('data-target', targetLink);
  });
</script>
</dev>        <!-- endof_no_designtime_scripts -->
    </div></div><div class="ax-container empty col-lg-3 col-md-3 col-sm-6 col-xs-6  thin" data-container="body_1_1" data-size-lg="3"><div class="modul-r-editable nowow">
            <!-- no_designtime_scripts -->
        <dev>
<section class="footer-links">
    <header>
        <h3>QUICK LINKS</h3>
    </header>
    <ul>
         <li><a href="https://www.mfc.co.za/budget-calculator" target="_blank">Budget calculator</a></li>
         <li><a href="../simulcast-calendar.html">Upcoming auctions</a></li>
         <li><a href="../media/dealer_101/storage/docs/STEP_BY_STEP_ONLINE_AUCTION_GUIDE__1_.pdf" target="_blank">Step-by-step guide</a></li>
         <li><a href="../media/dealer_101/storage/docs/MFC_Auction_House_Directions_GPS.pdf" target="_blank">Map and directions</a></li>
      <li><a href="https://www.mfc.co.za/finance-options" target="_blank">Finance options</a></li>
    </ul>
</section>
</dev>        <!-- endof_no_designtime_scripts -->
    </div></div><div class="ax-container empty col-lg-3 col-md-3 col-sm-6 col-xs-6  thin" data-container="body_1_2" data-size-lg="3"><div class="modul-r-editable nowow">
            <!-- no_designtime_scripts -->
        <dev>
<section class="footer-links">
    <header>
        <h3>Contact Us</h3>
    </header>
    <ul class="footer-phones">
		<li><a href="tel:081 003 2073"><i class="fa fa-phone" aria-hidden="true"></i>081 003 2073</a></li>
      <li><a href="mailto:MFCAuctionhouse@mfc.co.za"><i class="fa fa-envelope" aria-hidden="true"></i>Get in touch</a></li>
    </ul>
</section>
</dev>        <!-- endof_no_designtime_scripts -->
    </div></div><div class="ax-container empty col-lg-3 col-md-3 col-sm-6 col-xs-6  thin" data-container="body_1_3" data-size-lg="3"><div class="modul-r-editable nowow">
            <!-- no_designtime_scripts -->
        <dev>
  <style>
  .footer-socials{
            display:flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 210px;
        }
        .footer-socials img{
            height:100%;
            width: 20px;
            max-height: 20px;
            filter: invert(1);
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }
        .footer-socials a:hover > img{
            filter: invert(1);
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }
    .footer-socials a{
      background: #cfcfd0;
      color: #fff;
      width: 36px;
      height: 36px;
      margin-right: 3px;
      display: flex;
      justify-content: center;
      align-items: center;
      transition: all 0.3s ease;
    }
    .footer-socials a.footer-icn-facebook{
      background:#1877F2;
      transition: all 0.3s ease;
    }
    .footer-socials a.footer-icn-twitter{
      background:#000;
      transition: all 0.3s ease;
    }
    .footer-socials a.footer-icn-youtube{
      background:#ff0000;
      transition: all 0.3s ease;
    }
    .footer-socials a.footer-icn-linkedin{
      background:#00A0DC;
      transition: all 0.3s ease;
    }
    .footer-socials a.footer-icn-instagram{
      background: linear-gradient(to bottom, #833ab4 0%,#fd1d1d 50%,#fcaf45 100%);
      transition: all 0.3s ease;
    }
    .footer-socials a.footer-icn-instagram:hover{
      background: linear-gradient(to bottom, #195e4a 0%,#195e4a 50%,#195e4a 100%);
      transition: all 0.3s ease;
    } 
    .footer-socials a:hover{
      background:#195e4a;
      transition: all 0.3s ease;
    }
  </style>
<section class="footer-links">
    <header>
        <h3>STAY CONNECTED</h3>
    </header>
   <section class="footer-socials">
        <a href="https://www.facebook.com/MFCSouthAfrica" class="footer-icn-facebook" target="_blank" title="We are on Facebook">
            <img src="https://autoxloo.com/landing/social_ico/foo-icn-facebook.svg">
        </a>
        <a href="https://twitter.com/mfc_sa"  class="footer-icn-twitter" target="_blank" title="Follow Us on Twitter">
            <img src="https://autoxloo.com/landing/social_ico/foo-icn-twitter.svg">
        </a>
        <a href="http://www.youtube.com/channel/UCeXBKw_dfIV51ZiXFaLURHg" class="footer-icn-youtube" target="_blank" title="Watch Us on Youtube">
            <img src="https://autoxloo.com/landing/social_ico/foo-icn-youtube.svg">
        </a>
        <a href="https://www.linkedin.com/company/mfc-a-division-of-nedbank" class="footer-icn-linkedin" target="_blank" title="Send your CV">
            <img src="https://autoxloo.com/landing/social_ico/foo-icn-linkedin.svg">
        </a>
        <a href="https://www.instagram.com/mfc_sa" class="footer-icn-instagram" target="_blank" title="We are on Instagram">
            <img src="https://autoxloo.com/landing/social_ico/foo-icn-instagram.svg">
        </a>
    </section>

</section>
</dev>
        <!-- endof_no_designtime_scripts -->
    </div></div></div>
 
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  hidden-lg hidden-md hidden-sm hidden-xs thin" data-container="body_2_0" data-size-lg="12" data-hidden-lg="1" data-hidden-md="1" data-hidden-sm="1" data-hidden-xs="1"><div class="widget-spacer">
	  <div 
			style="height:20px;"
	  	>
    &nbsp;
    </div>
</div><div class="modul-r-editable nowow">
            <!-- no_designtime_scripts -->
        <dev>
  <style>
    .footer-partners{
    list-style-type:none;
    margin:0px;
    padding:0px;
    display:flex;
    justify-content:space-evenly;
    align-items:center;
    filter: grayscale(1);
	opacity: 0.6;
    }
  </style>
<section>
    <ul class="footer-partners">
    <li>
      	<a href="https://auctionstreaming.com/" target = "_blank">
        	<img alt="auctionstreaming" src="../media/dealer_101/storage/webstorage/partner-auctionstreaming.svg" alt="Auctionstreaming"/>
      	</a>
      </li>
<!--
    <li>
      <a href="https://www.nextgearcapital.com" target = "_blank">
        <img src="/media/dealer_101/storage/webstorage/partner-nextgear.svg" alt="Nextgear" />
      </a>
      </li>
    <li>
      <a href="https://www.autocheck.com" target = "_blank">
        <img src="/media/dealer_101/storage/webstorage/partner-autocheck.svg" alt="Autocheck" />
      </a>
      </li>
-->
    </ul>
</section>
</dev>
        <!-- endof_no_designtime_scripts -->
    </div></div></div>
 
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  " data-container="body_3_0" data-size-lg="12"><div class="widget-spacer">
	  <div 
			style="height:20px;"
	  	>
    &nbsp;
    </div>
</div></div></div>
 
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  " data-container="body_4_0" data-size-lg="12"><div class="modul-r-editable nowow">
            <!-- no_designtime_scripts -->
        <dev>
<style>
  .footer-links h3{
    font-size:15px;
    font-weight:bold;
    text-transform:uppercase;
    color:#004d36;
  }
  .footer-links ul{
    list-style-type:none;
    margin:0px;
    padding:0px;
  }
  .footer-links li{
	font-size: 14px;
    color: #58585A;
    padding-bottom: 5px;
    display: flex;
    align-items: center;
  }
  .footer-links li a{
    color:#58585A;
    text-decoration:none;
  }
  .footer-links li a:hover{
    color:#004d36;
  }
  .footer-links li a:visited{
    color:#58585A;
    text-decoration:none;
  }
  .footer-phones .fa{
	background: #cfcfd0;
    color: #fff;
    font-size: 18px;
    width: 36px;
    height: 36px;
    margin-right: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: all 0.3s ease;
  }
  .footer-phones li a{
    display: flex;
    align-items: center;
  }
  .footer-phones li a:hover > .fa{
    background: #006341;
    transition: all 0.3s ease;
  }
  .footer-partners li {
    margin:0 0 10px;
  }
  .footer-partners img{
    max-width:170px;
    max-height:70px;
  }
  .modul-copyright{
    font-size:12px;
    padding: 10px 0 0;
    position:relative;
    color: #f5f5f5;
  }
  .modul-copyright a{
    color:#00b388;
  }
  .modul-copyright a:hover{
    color: #03f4a9;
  }

  footer{
    background: #006341;
    position:relative;
  }
  footer:before{
    position:absolute;
    content:'';
    width:100%;
    height:38px;
    background:#006341;
    left:0px;
    bottom:0px;
    z-index:0;
  }
  footer:after{
    position:absolute;
    content:'';
    z-index:1;
    top:0;
    width:100%;
    height:10px;
    background: #f2f9f5; 
}
  .footer-no {
    display:flex;
    flex-direction: row-reverse;
    align-items: center;
    margin: 10px 0 0;
    justify-content: space-between;
  }
  .footer-no p{
    font-size:14px;
    color:#f5f5f5;
    text-align:right;
    margin-bottom: 0px;
    margin-right:-380px;
  }
  .footer-no img{
    max-width:70px;
    margin: 0 0 0 25px;
  }
      .footer-no a.as-logo img{
      max-width:170px;
    }
  @media all and (max-width:1279px){
    footer:before {
    height: 60px;
	}
    .footer-no p {
    margin-right: -240px;
}
  }
    @media all and (max-width:1199px){
    .footer-no p {
    margin-right: -190px;
}
  }
     @media all and (max-width:1023px){
   .footer-no p {
    margin-right: 0px;
    text-align: center;
}
  }
      @media all and (max-width:768px){
    footer:before {
    height: 100px;
}
.footer-no {
    flex-direction: column;
    }
     .footer-no p {
    margin: 20px 0;
}
    .footer-no a.as-logo img {
    margin: 0 0 20px 0;
}
  }
  </style>
</dev>

        <!-- endof_no_designtime_scripts -->
    </div></div></div>
 </div>
    </div>
            </div>
    <div class="clearfix"></div>
</div>

<script>
    var screenSize = screenSize || function (width) {
        var currentSize;

        if (width < $SESSIONDATA.sm_width) {
            currentSize = 'xs';
        } else if (width < $SESSIONDATA.md_width) {
            currentSize = 'sm';
        } else if (width < $SESSIONDATA.lg_width) {
            currentSize = 'md';
        } else {
            currentSize = 'lg';
        }

        return currentSize;
    };

    $(function() {
        var fullWidth = false,
            data = {"active_tab":"lg","lg":{"inherited":"none","bg_filling":"full_width","background-image":"","background-color":"rgba(242,249,245,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"},"md":{"inherited":"lg","bg_filling":"full_width","background-image":"","background-color":"rgba(242,249,245,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"},"sm":{"inherited":"lg","bg_filling":"full_width","background-image":"","background-color":"rgba(242,249,245,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"},"xs":{"inherited":"lg","bg_filling":"full_width","background-image":"","background-color":"rgba(242,249,245,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"}},
            $module = $('.container-6981ed48d5834'),
            isFluidWrapper = !$module.closest('.layout-container').hasClass('container-fluid'),
            $window = $(window),
            sizes = [],
            resizeTimer;

        if (fullWidth && !data) {
            if (isFluidWrapper) {
                $module.children().addClass('container');
            }
        } else if (data) {
            // Determine sizes
            for (var size in data) {
                if (data.hasOwnProperty(size) && data[size]['bg_filling'] === 'full_width') {
                    sizes.push(size);
                }
            }

            if (sizes.length) {
                windowResize();

                $window.on('resize', function () {
                    clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(windowResize, 250);
                });
            }
        }

        function windowResize() {
            var currentSize = screenSize(window.innerWidth);

            if (sizes.indexOf(currentSize) !== -1) {
                $module.addClass('container-full-width');

                if (isFluidWrapper) {
                    $module.children().addClass('container');
                }
            } else {
                $module.removeClass('container-full-width');

                if (isFluidWrapper) {
                    $module.children().removeClass('container');
                }
            }
        }
    });
</script>
</div></div>
 
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  " data-container="footer_1_0" data-size-lg="12">
<div class="modul-r-container
            container-6981ed48d5862                        nowow"
    >
    <div>
                    <style type="text/css"></style>
    <div>
            <div class="layout-container" data-container="body">
            
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  " data-container="body_0_0" data-size-lg="12"><div class="modul-r-editable nowow">
            <!-- no_designtime_scripts -->
        <dev>
<section class="footer-no">
  <a href="https://personal.nedbank.co.za/home.html" target = "_blank">
  <img src="https://www.mfc.co.za/content/dam/nedbank/icons/resources/logo.svg" alt="NedBank">
  </a>
  <p>
Nedbank Ltd Reg. No 1951/000009/06<br>
Authorised financial services and registered credit provider (NCRCP16)
  </p>
  <a class="as-logo" href="https://auctionstreaming.com/" target = "_blank">
  	<img alt="auctionstreaming" src="../media/dealer_101/storage/webstorage/partner-auctionstreaming.svg" alt="Auctionstreaming"/>
  </a>
  </section>
</dev>        <!-- endof_no_designtime_scripts -->
    </div></div></div>
 </div>
    </div>
            </div>
    <div class="clearfix"></div>
</div>

<script>
    var screenSize = screenSize || function (width) {
        var currentSize;

        if (width < $SESSIONDATA.sm_width) {
            currentSize = 'xs';
        } else if (width < $SESSIONDATA.md_width) {
            currentSize = 'sm';
        } else if (width < $SESSIONDATA.lg_width) {
            currentSize = 'md';
        } else {
            currentSize = 'lg';
        }

        return currentSize;
    };

    $(function() {
        var fullWidth = false,
            data = {"active_tab":"lg","lg":{"inherited":"none","bg_filling":"full_width","background-image":"","background-color":"rgba(0,99,65,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"},"md":{"inherited":"lg","bg_filling":"full_width","background-image":"","background-color":"rgba(0,99,65,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"},"sm":{"inherited":"lg","bg_filling":"full_width","background-image":"","background-color":"rgba(0,99,65,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"},"xs":{"inherited":"lg","bg_filling":"full_width","background-image":"","background-color":"rgba(0,99,65,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"}},
            $module = $('.container-6981ed48d5862'),
            isFluidWrapper = !$module.closest('.layout-container').hasClass('container-fluid'),
            $window = $(window),
            sizes = [],
            resizeTimer;

        if (fullWidth && !data) {
            if (isFluidWrapper) {
                $module.children().addClass('container');
            }
        } else if (data) {
            // Determine sizes
            for (var size in data) {
                if (data.hasOwnProperty(size) && data[size]['bg_filling'] === 'full_width') {
                    sizes.push(size);
                }
            }

            if (sizes.length) {
                windowResize();

                $window.on('resize', function () {
                    clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(windowResize, 250);
                });
            }
        }

        function windowResize() {
            var currentSize = screenSize(window.innerWidth);

            if (sizes.indexOf(currentSize) !== -1) {
                $module.addClass('container-full-width');

                if (isFluidWrapper) {
                    $module.children().addClass('container');
                }
            } else {
                $module.removeClass('container-full-width');

                if (isFluidWrapper) {
                    $module.children().removeClass('container');
                }
            }
        }
    });
</script>
</div></div>
 
        <div class="modul-copyright  nowow cprt__hover_null mcprt_font-s_12">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-left text-xs-center text-xxs-center">
                                  <p>Auction Management Solutions By: <a class="mcprt-link" href="https://auctionstreaming.com/" rel="nofollow" target="_blank">Auction Streaming</a></p>

                            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-right text-xs-center text-xxs-center pull-right ">
                                  <p>Powered by: <a class="mcprt-link" href="https://webxloo.com/" rel="nofollow" target="_blank">Webxloo</a></p>

                            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
                                <a class="mcprt-link" href="..//">
                    2026 &copy; NedbankMFC</a>
                            </div>
        </div>
    </div>

    
</div>
        </footer>
    </div>
</body>
<!--0.69972705841064-->

<!-- Mirrored from www.mfcauctions.co.za/search/advance-search-test by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 03 Feb 2026 12:43:42 GMT -->
</html>