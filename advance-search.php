<?php 
include_once "inc/search/search-head.php";

// Database connection
require_once 'config/database.php';

$database = new Database();
$conn = $database->getConnection();

// Pagination settings
$items_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

// Get total count
$count_sql = "SELECT COUNT(*) as total FROM cars";
$count_result = $conn->query($count_sql);
$total_items = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_items / $items_per_page);

// Query to get car data with pagination
$sql = "SELECT * FROM cars ORDER BY year_model DESC LIMIT $offset, $items_per_page";
$result = $conn->query($sql);
?>
        <main>
            <div class="layout-container container" data-container="body">
            
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  " data-container="body_0_0" data-size-lg="12"><script type="application/ld+json">{"@context":"https:\/\/schema.org","@type":"AutoDealer","currenciesAccepted":"R","openingHours":"","address":{"@type":"PostalAddress","addressCountry":"SOUTH AFRICA","addressRegion":"SA","postalCode":"","streetAddress":"M57 Pretoria Rd, Glen marais, Kempton Park, 1619"},"name":"NedbankMFC","url":"https:\/\/mfcauctions.co.za","telephone":"","priceRange":"$$$$","image":{"@type":"ImageObject","contentUrl":"https:\/\/mfcauctions.co.za\/media\/dealer_101\/Logo\/logo3.png?nocache=64fb77782f5c6","url":"https:\/\/mfcauctions.co.za\/media\/dealer_101\/Logo\/logo3.png?nocache=64fb77782f5c6"}}</script><div id="modul_r_inventory_6981ed319ce9d"
     class="modul-r-inventory nowow layout-inherit"
>
    <div class="row">
                            <div class="main-captcha-place"
                 style="opacity: 0; position: absolute; width:1px; height:1px; overflow: hidden;">
                <form action="#" method="post">
                    <input type="text" class="capcha-catcher-input" name="capcha_catcher_input"/>
                                    </form>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <nav>
        <ul class="pagination pagination-sm pull-right no-margin hidden-xs hidden-in-thin">
            <?php
            // Generate pagination links
            $max_links = 5;
            $start_page = max(1, $page - floor($max_links / 2));
            $end_page = min($total_pages, $start_page + $max_links - 1);
            
            // Adjust start page if we're near the end
            if ($end_page - $start_page < $max_links - 1) {
                $start_page = max(1, $end_page - $max_links + 1);
            }
            
            // Previous link
            if ($page > 1):
            ?>
                <li><a href="?page=<?php echo $page - 1; ?>" data-page="<?php echo $page - 1; ?>">&laquo;</a></li>
            <?php
            endif;
            
            // Page numbers
            for ($i = $start_page; $i <= $end_page; $i++):
            ?>
                <li class="<?php echo $i == $page ? 'active' : ''; ?>">
                    <a href="?page=<?php echo $i; ?>" data-page="<?php echo $i; ?>">
                        <?php echo $i; ?>
                        <?php if ($i == $page): ?>
                            <span class="sr-only">(current)</span>
                        <?php endif; ?>
                    </a>
                </li>
            <?php
            endfor;
            
            // Show dots if there are more pages
            if ($end_page < $total_pages):
            ?>
                <li><a href="javascript:void(0)">...</a></li>
                <li><a href="?page=<?php echo $total_pages; ?>" data-page="<?php echo $total_pages; ?>"><?php echo $total_pages; ?></a></li>
            <?php
            endif;
            
            // Next link
            if ($page < $total_pages):
            ?>
                <li class="next">
                    <a href="?page=<?php echo $page + 1; ?>" data-page="<?php echo $page + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php
            endif;
            ?>
                    </ul>
    </nav>
                <p class="h4">
                    Search Results: <span class="label label-primary"><?php echo $total_items; ?></span> Found                </p>
                        <nav>
        <ul class="pager visible-xs visible-in-thin">
            <?php if ($page > 1): ?>
                <li class="previous">
                    <a href="?page=<?php echo $page - 1; ?>" data-page="<?php echo $page - 1; ?>">
                        <span aria-hidden="true">&larr;</span>
                        Previous
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($page < $total_pages): ?>
                <li class="next">
                    <a href="?page=<?php echo $page + 1; ?>" data-page="<?php echo $page + 1; ?>">
                        Next
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </li>
            <?php endif; ?>
                    </ul>
    </nav>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="btn-group pull-right hidden-xs hidden-in-thin btn-sm compare-box print-group">
                                                                                </div>
                        <div class="btn-group visible-xs visible-in-thin print-group">
                                                                                </div>
                        <div class="clearfix visible-xs visible-in-thin"></div>
                        <div class="hidden-in-thin hidden-sm hidden-xs sort-group-wrapper">
    <label class="h5">Sort by: &nbsp;</label>
    <div class="btn-group sort-btn-group" role="group">
                                                                    <a class="btn btn-default btn-sm desc"
                       href="advance-search-test_items_10_sort_condition-grading_sortord_desc.php"
                       data-sort-by="condition-grading"
                       data-order="desc"
                    >
                        Grading                    </a>
                                                                                                <a class="btn btn-default btn-sm asc"
                       href="advance-search-test_items_10_sort_year_sortord_asc.php"
                       data-sort-by="year"
                       data-order="asc"
                    >
                        Year                    </a>
                                                                                                <a class="btn btn-primary btn-sm desc"
                       href="advance-search-test_items_10_sort_make_sortord_desc.php"
                       data-sort-by="make"
                       data-order="desc"
                    >
                        Make                    </a>
                                                                                                <a class="btn btn-default btn-sm asc"
                       href="advance-search-test_items_10_sort_model_sortord_asc.php"
                       data-sort-by="model"
                       data-order="asc"
                    >
                        Model                    </a>
                                                                                                <a class="btn btn-default btn-sm asc"
                       href="advance-search-test_items_10_sort_mileage_sortord_asc.php"
                       data-sort-by="mileage"
                       data-order="asc"
                    >
                        Odometer                    </a>
                                                                                                <a class="btn btn-default btn-sm asc"
                       href="advance-search-test_items_10_sort_price_sortord_asc.php"
                       data-sort-by="price"
                       data-order="asc"
                    >
                        Price                    </a>
                                                                                                <a class="btn btn-default btn-sm asc"
                       href="advance-search-test_items_10_sort_stock_sortord_asc.php"
                       data-sort-by="stock"
                       data-order="asc"
                    >
                        Stock                    </a>
                                        </div>
    <div class="btn-group btn-group-sm sort-btn hidden-xs">
        <a href="advance-search-test_items_10_sort_make_sortord_desc.php"
           class="btn btn-primary change_sort_order"
           title="Change Sorting Order"
           data-sort-by="make"
           data-order="desc"
        >
        &nbsp;<span class="fa fa-sort-amount-asc"></span>&nbsp;
        </a>
    </div>
</div>
<div class="visible-in-thin visible-sm visible-xs sortWrap sort-group-wrapper sort-select-wrapper">
    <label class="pull-left h5 visible-sm">Sort by: &nbsp;</label>
    <div class="sort-select-box">
        <label class="visible-xs">Sort by: &nbsp;</label>
        <div class="sort-selection">
            <div class="col-xs-10 col-xxs-9 no-padding-left">
                <select class="form-control">
                                                                                                <option value="advance-search-test_items_10_sort_condition-grading_sortord_desc.php"
                                                                    data-sort-by="condition-grading"
                            >
                                Grading                            </option>
                                                                                                                        <option value="advance-search-test_items_10_sort_year_sortord_asc.php"
                                                                    data-sort-by="year"
                            >
                                Year                            </option>
                                                                                                                        <option value="advance-search-test_items_10_sort_make_sortord_desc.php"
                                selected="selected"                                    data-sort-by="make"
                            >
                                Make                            </option>
                                                                                                                        <option value="advance-search-test_items_10_sort_model_sortord_asc.php"
                                                                    data-sort-by="model"
                            >
                                Model                            </option>
                                                                                                                        <option value="advance-search-test_items_10_sort_mileage_sortord_asc.php"
                                                                    data-sort-by="mileage"
                            >
                                Odometer                            </option>
                                                                                                                        <option value="advance-search-test_items_10_sort_price_sortord_asc.php"
                                                                    data-sort-by="price"
                            >
                                Price                            </option>
                                                                                                                        <option value="advance-search-test_items_10_sort_stock_sortord_asc.php"
                                                                    data-sort-by="stock"
                            >
                                Stock                            </option>
                                                            </select>
            </div>
            <div class="sort-btn col-xs-2 col-xxs-3 text-right no-padding">
                <a href="advance-search-test_items_10_sort_make_sortord_desc.php"
                   class="btn btn-primary btn-block change_sort_order"
                   data-sort-by="make"
                   data-order="desc"
                >
                    <span class="fa fa-sort-amount-asc"></span>&nbsp;
                </a>
            </div>
            <div class="clearfix visible-xs"></div>
        </div>
    </div>
</div>
<div class="clearfix"></div>

    <script type="text/javascript">
        $(function() {
            $('.modul-r-inventory').find('.sort-select-wrapper').on('change', 'select', function () {
                window.location.href = $(this).val();
            });
        });
    </script>
                </div>
            </div>
            <div class="panel-body">
                <div class="row vehicles-list">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="loader"></div>
                    </div>

            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="row vehicle-wrapper clearfix" data-id="<?php echo $row['id']; ?>">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xxs-12 no-padding">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-xxs-6 padding-right-xxs-none">
                                        <div class="panel panel-default no-margin no-padding vehicle-img-wrapper">
                                            <div class="panel-heading no-padding">
                                                <a class="embed-responsive embed-responsive-4by3" href="car-details.php?id=<?php echo $row['id']; ?>">
                                                    <img class="embed-responsive-item vehicle-img"
                                                         src="/image/<?php echo $row['image']; ?>_0.jpg?nocache=<?php echo time(); ?>"
                                                         data-src="/image/<?php echo $row['image']; ?>_0.jpg?nocache=<?php echo time(); ?>"
                                                         title="<?php echo htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant'] . ', ' . $row['seller'] . ', ' . $row['body_style'] . ', ' . $row['exterior']); ?>"
                                                         alt="<?php echo htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model']); ?>"
                                                    >
                                                    <div class="centered-item text-muted vehicle-img-loader">
                                                        <div class="progress animate-progress no-margin image-dummy-loader">
                                                            <div class="progress-bar animate-progress-bar"></div>
                                                        </div>
                                                    </div>
                                                </a>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <div class="carId hidden-xxs">
                                            <strong>Stock# <?php echo htmlspecialchars($row['stock']); ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-6 col-xxs-6 padding-left-lg-none padding-left-md-none padding-left-sm-none padding-left-xs-none">
                                    <div class="pull-lg-left pull-md-left pull-sm-left title-wrapper hidden-xxs">
                                        <a class="h4 text-primary vehicle-title hidden-xxs" href="car-details.php?id=<?php echo $row['id']; ?>">
                                            <?php echo htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant'] . ' ' . $row['body_style']); ?>
                                        </a>
                                    </div>
                                    <hr class="hrMargin visible-xs hidden-xxs">
                                    <div class="priceWrap text-right hidden-xxs">
                                        <div class="h4 no-margin inline pull-right">
                                            <div class="h4 no-margin">
                                                <strong>Price:&nbsp;</strong>
                                                <strong><?php echo htmlspecialchars($row['trade_value'] ? $row['trade_value'] : 'CALL'); ?></strong>
                                            </div>
                                            <div class="h5 no-margin-bottom text-right mileage">
                                                <strong><?php echo number_format($row['odometer']) . " km"; ?></strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="description-wrap">
                                        <div class="h6 clearfix no-margin visible-xxs">
                                            <div>
                                                <div class="spacer-03"></div>
                                                <div class="clearfix">
                                                    <span>Price:&nbsp;</span>
                                                    <strong class="pull-right"><?php echo htmlspecialchars($row['trade_value'] ? $row['trade_value'] : 'CALL'); ?></strong>
                                                </div>
                                                <div class="spacer-03"></div>
                                                <div class="clearfix">
                                                    <span class="inline pull-right"><?php echo htmlspecialchars($row['odometer']); ?></span>
                                                </div>
                                            </div>
                                            <div class="spacer-03"></div>
                                            <div class="visible-xs text-right text-xs-left"></div>
                                            <div class="full-width-in-thin btn btn-sm visible-xxs invisible">&nbsp;</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xxs-6 pull-right visible-xxs btn-wrap">
                                    <a href="car-details.php?id=<?php echo $row['id']; ?>" class="full-width-in-thin btn btn-sm btn-primary">
                                        <strong>Details</strong>
                                    </a>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-6 col-xxs-12 padding-left-lg-none padding-left-md-none padding-left-sm-none padding-left-xs-none pull-right hidden-xxs">
                                    <hr class="hrMargin">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                                            <strong class="text-primary">Specification:</strong>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12"><?php echo htmlspecialchars(strtoupper($row['exterior']) . ', ' . strtoupper($row['body_style']) . ', ' . strtoupper($row['doors']) . " DOORS"); ?></div>
                                    </div>
                                    <hr class="no-margin-bottom hrMargin">
                                    <div class="btn-wrapper">
                                        <a href="car-details.php?id=<?php echo $row['id']; ?>" class="full-width-in-thin btn btn-primary navbar-btn no-margin-bottom btn-sm" title="Vehicle Details">
                                            <span class="fa fa-th-list"></span>&nbsp;Details
                                        </a>
                                        <div class="full-width-in-thin btn-group" role="group">
                                            <button type="button" class="inventory_vehicle_qr_code btn btn-primary btn-sm navbar-btn no-margin-bottom dropdown-toggle btn-block" data-toggle="dropdown" aria-expanded="false" title="QR Code">
                                                <span class="fa fa-qrcode"></span>&nbsp;QR <span class="caret"></span>
                                                <div class="qr-code-data hidden" alt="https://www.mfcauctions.co.za/car-details.php?id=<?php echo $row['id']; ?>"></div>
                                            </button>
                                            <div class="dropdown-menu qr" role="menu">
                                                <div class="panel-body">
                                                    <div class="qr-code-container text-center"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="show-gallery btn btn-primary btn-sm navbar-btn no-margin-bottom" data-vehicle-id="<?php echo $row['image']; ?>" data-pics-count="10" title="Photos">
                                            <span class="fa fa-camera"></span>&nbsp;Photos
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                if (typeof arrayVehiclesInventory === 'undefined') {
                    arrayVehiclesInventory = [];
                }
                arrayVehiclesInventory.push({"id":<?php echo $row['id']; ?>,"url":"\/advance-search","vin":"<?php echo $row['vin']; ?>","vcaption":"<?php echo htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']); ?>","vurl":"https:\/\/www.mfcauctions.co.za\/car-details.php?id=<?php echo $row['id']; ?>","url_caption":"<?php echo htmlspecialchars($row['make'] . ' ' . $row['model'] . ' ' . $row['variant'] . ' ' . $row['body_style']); ?>","currency":"R","price":"<?php echo $row['trade_value']; ?>","strPrice":"<?php echo htmlspecialchars($row['trade_value'] ? $row['trade_value'] : 'CALL'); ?>","photoarray": "/image/<?php echo $row['id']; ?>_w250_h190.jpg?nocache=<?php echo time(); ?>"});
            </script>
            <script type="application/ld+json"><?php echo '{"@context":"https:\/\/schema.org","@type":"Product","gtin":"' . $row['vin'] . '","brand":"' . htmlspecialchars($row['make']) . '","color":"' . htmlspecialchars($row['exterior']) . '","itemCondition":{"@type":"OfferItemCondition","alternateName":"Car","description":"OTHER"},"logo":{"@type":"ImageObject","contentUrl":"https:\/\/mfcauctions.co.za\/media\/dealer_101\/Logo\/logo3.png?nocache=64fb77782f5c6","url":"https:\/\/mfcauctions.co.za\/media\/dealer_101\/Logo\/logo3.png?nocache=64fb77782f5c6"},"offers":{"@type":"Offer","name":"' . htmlspecialchars($row['make'] . ' ' . $row['model'] . ' ' . $row['variant'] . ' ' . $row['body_style']) . '","description":"","priceSpecification":{"@type":"PriceSpecification","price":"' . $row['trade_value'] . '","priceCurrency":"R"},"url":"https:\/\/mfcauctions.co.za\/car-details.php?id=' . $row['id'] . '","sku":"' . $row['stock'] . '","description":"","name":"' . htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant'] . ' ' . $row['body_style']) . '","image":{"@type":"ImageObject","contentUrl":"https:\/\/mfcauctions.co.za\/image\/' . $row['id'] . '.jpg"}}'; ?></script>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="alert alert-info">
                        <h4>No cars found</h4>
                        <p>No vehicles match your search criteria.</p>
                    </div>
                </div>
            <?php endif; ?>
                    </div>
                </div>
                <div class="panel-footer" style="margin-top: 20px;">
                            <nav>
        <ul class="pagination pagination-sm pull-right no-margin hidden-xs hidden-in-thin">
            <?php
            // Generate pagination links (same as top)
            $max_links = 5;
            $start_page = max(1, $page - floor($max_links / 2));
            $end_page = min($total_pages, $start_page + $max_links - 1);
            
            if ($end_page - $start_page < $max_links - 1) {
                $start_page = max(1, $end_page - $max_links + 1);
            }
            
            if ($page > 1):
            ?>
                <li><a href="?page=<?php echo $page - 1; ?>" data-page="<?php echo $page - 1; ?>">&laquo;</a></li>
            <?php
            endif;
            
            for ($i = $start_page; $i <= $end_page; $i++):
            ?>
                <li class="<?php echo $i == $page ? 'active' : ''; ?>">
                    <a href="?page=<?php echo $i; ?>" data-page="<?php echo $i; ?>">
                        <?php echo $i; ?>
                        <?php if ($i == $page): ?>
                            <span class="sr-only">(current)</span>
                        <?php endif; ?>
                    </a>
                </li>
            <?php
            endfor;
            
            if ($end_page < $total_pages):
            ?>
                <li><a href="javascript:void(0)">...</a></li>
                <li><a href="?page=<?php echo $total_pages; ?>" data-page="<?php echo $total_pages; ?>"><?php echo $total_pages; ?></a></li>
            <?php
            endif;
            
            if ($page < $total_pages):
            ?>
                <li class="next">
                    <a href="?page=<?php echo $page + 1; ?>" data-page="<?php echo $page + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php
            endif;
            ?>
                    </ul>
    </nav>
                        <div class="hidden-xs hidden-in-thin">
                            <small>&nbsp;</small>
                        </div>
                        <div class="hidden-xs hidden-in-thin">
                            <small>&nbsp;</small>
                        </div>
                                <nav>
        <ul class="pager visible-xs visible-in-thin">
            <?php if ($page > 1): ?>
                <li class="previous">
                    <a href="?page=<?php echo $page - 1; ?>" data-page="<?php echo $page - 1; ?>">
                        <span aria-hidden="true">&larr;</span>
                        Previous
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($page < $total_pages): ?>
                <li class="next">
                    <a href="?page=<?php echo $page + 1; ?>" data-page="<?php echo $page + 1; ?>">
                        Next
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
            </div>
                </div>
            </div>
                <div class="modal fade"
             id="minvR-galleryModal"
             tabindex="-1"
             role="dialog"
             aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Slideshow</h4>
                    </div>
                    <div class="modal-body">
                        <div class="minvRgaleryCont">
                            <div class="minvRgalerySlide"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        
                    <script type="text/javascript">
                function minvRgaleryBuildMagnific(vehicleId, picsCount) {
                    var itemArray = [];
                    //var itemArray = {src: '/image/' + vehicleId + '_w510_h383_' + 0 + '.jpg'}; // change formfactor on 4:3
                    for (var i = 0; i < picsCount; i++) {
                        itemArray.push({src: '/image/' + vehicleId + '_' + i + '.jpg'})
                    }
                    $.magnificPopup.open({
                        closeOnContentClick: false,
                        closeBtnInside: false,
                        items: itemArray,
                        gallery: {
                            enabled: true,
                            arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"><span class="fa fa-chevron-%dir%"></span></button>',
                        },
                        zoom: {
                            enabled: false
                        },
                        type: 'image' // this is default type
                    });
                }

                $(function () {
                    var $body = $('body');

                    new LazyLoad({
                        elements_selector: '.modul-r-inventory .vehicle-img',
                        data_src: 'src',
                        threshold: 0
                    });

                    new ModalWidgets({
                        wrapperClass: 'vehicle-wrapper',
                        style: "default",
                        corners: "round",
                        useQrCode: true,
                    });

                    // slideshow
                    $body.on('click', '.show-gallery', function () {
                        var vehicleId = $(this).data('vehicle-id');
                        var picsCount = $(this).data('pics-count');
                        minvRgaleryBuildMagnific(vehicleId, picsCount);
                        $(window).resize();
                    });

                    $body.on('click', '.fuel_economy', function () {
                        var id = $(this).closest('.vehicle-wrapper').data('id');
                        var dropdown = $(this).siblings('.dropdown-menu');
                        var target = $(dropdown.find('.fe-content'));

                        if (!target.is('.loaded')) {
                            $.ajax({
                                url: '/ajax',
                                type: 'post',
                                data: {
                                    oper: 'fuel_economy',
                                    type_metrik: 'default',
                                    convert_coefficient: '236',
                                    lable_suystem_metrik: '',
                                    label_position: 'right',
                                    labelSystemMetrikEncode: 1,
                                    id: id
                                },
                                dataType: 'json',
                                success: function (data) {
                                    var fuelInfo,
                                        fuelHwy,
                                        fuelCity,
                                        fuelCombPart,
                                        fuelComb,
                                        custLabel,
                                        custLabelData;
                                    dropdown.find('.progress').hide();

                                    if (data !== '' && data !== null) {
                                        fuelInfo = data.split('/');
                                        fuelHwy = fuelInfo[0];
                                        fuelCity = fuelInfo[1];
                                        fuelCombPart = fuelInfo[2];
                                        custLabelData = fuelCombPart.split(' ');
                                        fuelComb = custLabelData.shift();
                                        custLabel = custLabelData.join(' ');
                                        target.removeClass('hidden');
                                        target
                                            .find('.fuel-hwy')
                                            .php(fuelHwy);
                                        target
                                            .find('.fuel-city')
                                            .php(fuelCity);
                                        target
                                            .find('.fuel-comb')
                                            .php(fuelComb);
                                        target
                                            .find('.cust-label')
                                            .php(custLabel);
                                    } else {
                                        target
                                            .text('N/A')
                                            .siblings()
                                            .hide();
                                    }

                                    target
                                        .addClass('loaded')
                                        .closest('.fe-wrapper')
                                        .show();
                                }
                            });
                        }
                    });

                    $body.on('click', '.vir-btn a', function (event) {
                        if ($(this).attr('href') === '#') {
                            event.preventDefault();
                        }
                    });
                });

                
                
                                    $('#modul_r_inventory_6981ed319ce9d .option_list-nw').fadeIn();
                            </script>
            </div>
</div>
</div></div>
 </div>
        </main>
        <footer>
            <div class="layout-container container" data-container="footer">

            
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  " data-container="footer_0_0" data-size-lg="12">
<div class="modul-r-container
            container-6981ed31aa260                        nowow"
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
      <li><a href="simulcast-calendar.php">Auctions</a></li>
        <li><a href="media/dealer_101/storage/docs/Auction_Calculator.pdf" target="_blank">Auction Calculator</a></li>
        <li><a href="/-searchLink" data-toggle="modal" >Search</a> </li>
        <li><a href="terms-and-conditions.php">Terms and conditions</a></li>
        <li><a href="frequently-asked-questions.php">FAQ</a></li>
        <li><a href="our-banking-details.php">Banking details</a></li>
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
         <li><a href="simulcast-calendar.php">Upcoming auctions</a></li>
         <li><a href="media/dealer_101/storage/docs/STEP_BY_STEP_ONLINE_AUCTION_GUIDE__1_.pdf" target="_blank">Step-by-step guide</a></li>
         <li><a href="media/dealer_101/storage/docs/MFC_Auction_House_Directions_GPS.pdf" target="_blank">Map and directions</a></li>
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
        	<img alt="auctionstreaming" src="media/dealer_101/storage/webstorage/partner-auctionstreaming.svg" alt="Auctionstreaming"/>
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
            data = {"active_tab":"lg","lg":{"inherited":"none","bg_filling":"full_width","background-image":"","background-color":"rgba(242,249,245,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"},"md":{"inherited":"lg","bg_filling":"full_width","background-image":"","background-color":"rgba(242,249,245,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"},"sm":{"inherited":"md","bg_filling":"full_width","background-image":"","background-color":"rgba(242,249,245,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"},"xs":{"inherited":"sm","bg_filling":"full_width","background-image":"","background-color":"rgba(242,249,245,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"}},
            $module = $('.container-6981ed31aa260'),
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
            container-6981ed31aa29f                        nowow"
    >
    <div>
                    <style type="text/css"></style>
    <div>
            <div class="layout-container" data-container="body">
            
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  " data-container="body_0_0" data-size-lg="12"><div class="modul-r-editable nowow">
            <!-- no_designtime_scripts -->
        <dev>
<section class="footer-no">
  <a href="https://personal.nedbank.co.za/home.php" target = "_blank">
  <img src="https://www.mfc.co.za/content/dam/nedbank/icons/resources/logo.svg" alt="NedBank">
  </a>
  <p>
Nedbank Ltd Reg. No 1951/000009/06<br>
Authorised financial services and registered credit provider (NCRCP16)
  </p>
  <a class="as-logo" href="https://auctionstreaming.com/" target = "_blank">
  	<img alt="auctionstreaming" src="media/dealer_101/storage/webstorage/partner-auctionstreaming.svg" alt="Auctionstreaming"/>
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
            $module = $('.container-6981ed31aa29f'),
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
                                <a class="mcprt-link" href="/
                    2026 &copy; NedbankMFC</a>
                            </div>
        </div>
    </div>

    
</div>
        </footer>
    </div>
</body>
<!--1.2474322319031-->

<!-- Mirrored from www.mfcauctions.co.za/advance-search-test by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 03 Feb 2026 12:43:33 GMT -->
</html>

<?php
// Close database connection
$conn->close();
?>
