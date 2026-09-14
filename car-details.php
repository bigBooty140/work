<?php
require_once 'config/database.php';

$database = new Database();
$conn = $database->getConnection();

// Get car ID from URL
$car_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query to get specific car data
$sql = "SELECT * FROM cars WHERE id = $car_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Car not found");
}

include_once "inc/car-head.php";
?>

       <main>
            <div class="layout-container container" data-container="body">
            
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  " data-container="body_0_0" data-size-lg="12"><div class="widget-spacer">
	  <div 
			class="h3"
	  	>
    &nbsp;
    </div>
</div><script type="application/ld+json">{"@context":"https:\/\/schema.org","@type":"Vehicle","offers":{"@type":"Offer","name":"<?php echo htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']); ?> <?php echo htmlspecialchars($row['body_style']); ?> <?php echo htmlspecialchars($row['exterior'] ?: 'OTHER'); ?> SA","description":"<?php echo htmlspecialchars($row['description'] ?: ''); ?>","priceSpecification":{"@type":"PriceSpecification","price":"<?php echo htmlspecialchars($row['price'] ?: '0.00'); ?>","priceCurrency":"R"},"url":"https:\/\/mfcauctions.co.za\/vehicle_vid_<?php echo $row['id']; ?>.html"},"brand":"<?php echo htmlspecialchars($row['make']); ?>","gtin":"<?php echo htmlspecialchars($row['stock']); ?>","driveWheelConfiguration":{"@type":"DriveWheelConfigurationValue","description":"<?php echo htmlspecialchars($row['drive_type']); ?>"},"fuelType":"<?php echo htmlspecialchars($row['fuel-type']); ?>","mileageFromOdometer":{"@type":"QuantitativeValue","unitCode":"km","description":<?php echo htmlspecialchars($row['odometer']); ?>},"numberOfDoors":"<?php echo htmlspecialchars($row['doors']); ?>","vehicleConfiguration":"<?php echo htmlspecialchars($row['body_style']); ?>","vehicleEngine":{"@type":"EngineSpecification","description":"<?php echo htmlspecialchars($row['engine']); ?>"},"vehicleIdentificationNumber":"<?php echo htmlspecialchars($row['vin']); ?>","vehicleTransmission":"<?php echo htmlspecialchars($row['transmission']); ?>","color":"<?php echo htmlspecialchars($row['exterior']); ?>","sku":"<?php echo htmlspecialchars($row['stock']); ?>","description":"<?php echo htmlspecialchars($row['description'] ?: ''); ?>","image":{"@type":"ImageObject","contentUrl":"https:\/\/mfcauctions.co.za\/image\/<?php echo $row['id']; ?>.jpg"},"name":"<?php echo htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']); ?>"}</script>
    <script xmlns="http://www.w3.org/1999/html">
        quotePrinterEnable = 1;
        vdRsp = 1;
    </script>


    
    <!--------START OF NEW MARKUP--------->
    
    
    <div id="modul_r_details_6981ed6fa95d6" class="modul-r-details text-left layout-default nowow">
        <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel
                        panel-default                                        ">
                    <div class="panel-heading watchlist-container">
                                                <div class="row ">
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
                                <div class="h4 panel-title">
                                                                                                            <h2><b><?php echo htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']); ?></b></h2>
                                </div>
                                                            </div>
                                                                                        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 text-right priceWrap">
                                    <div class="panel-title no-padding-left-xs ">
                                        <strong></strong>
                                    </div>
                                                                    </div>
                                                                                                            </div>
                        <div class="row">
                                                            <div class="text-right col-lg-12 col-md-12 col-sm-12 col-xs-12 priceWrap">
                                                                            <div class="h6 no-margin-bottom">
                                            <div class="panel-title">
                                                                                                                                                                                                                                                                                                                <span class="price">
                                                    TRADE VALUE:                                                        <?php echo htmlspecialchars($row['trade_value'] ?: 'CALL'); ?>                                                    &nbsp;                                                </span>
                                                                                            </div>
                                        </div>
                                                                    </div>
                                                    </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                                                                                                                                                                <p class="no-margin">
                                    <strong>Odometer:</strong> <?php echo htmlspecialchars($row['odometer']); ?> km                                </p>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                                <div class="btn-group-sm pull-lg-right pull-md-right pull-sm-right key-block ">
                                    <button type="button"
                    style="display: none;"
                    class="btn btn-success vd_save_vehicle half-width-in-thin"
                    title="Save This Car"
                    data-vehicle-id="<?php echo $row['id']; ?>"
                    data-saved="0"
            >
                <i class="fa fa-car"></i>&nbsp; <span>Save</span>
            </button>
                        <button type="button"
                class="btn btn-warning btn-favorite half-width-in-thin"
                title="Add vehicle to favorites"
                onclick="detail_bookmarksite()"
        >
            <i class="fa fa-star"></i>&nbsp; Favorite        </button>
    
            <button type="button"
                class="btn btn-primary mdet-code half-width-in-thin"
                title="Show QR code link"
        >
            <i class="fa fa-qrcode"></i>&nbsp; QR
            <span class="popup-qr-code" style="display:none">
                <!-- responsive -->
<div class="modul-r-qrcode nowow">
    <div class="panel panel-default no-margin">
        <div class="panel-body bg-default">
                <div class="text-center">
                    <img class="img-responsive inline" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALEAAACxAQMAAACx586GAAAABlBMVEX///8AAABVwtN+AAAACXBIWXMAAA7EAAAOxAGVKw4bAAADdElEQVRYha2XzY21OBBFjbzwDhJAchrsnBIkwE8CkJJ3pGGJBGDnBXo1p5j5RpqlrXl6atGnW8blqrq3bMz/9PEipjXvOFx7kNvZ26VF3nLeGwe39yBrSPxDl9MILOfLyU8zB9nONA92kzRJJW+d/IzfdbdecjVncbuad5Hr58xsKjnxduc75X50Iud1iPn3HEo4599P53++f/JSxPnY52ST/naELEdMf0qijHdnauL1C5ewbPCPGBMqOAdun8hu3y76dXi/qCs4q2ke74H1ZXV9Oxjj3nKuBdCJ7IFEXGswM7XhUgV/2NXQN9EfHH72T7ye3Jdzuw88m3mgyP3PXRIJOZVzM4nfTlLZd/Ht5EtrrODskDCvm4czcWij7vwt5/4OIvm6QzKD3U3q4nUPfTk3UzYLbYIaOM3FHPzuKrh9xO+DWTgu449oj/w2Zw3fhy9eRwu/0+nXQO+kcm4a9IQMqr7BKVH7ZFPO++VrOtptDu8kVLv/+qWUW6q6DfagLMVukV/7Jr/lnCJPnL86iL5LvmIwFbwN/ahvMa17+S5nmr71CznlfUnWJKL/xqVJ+6Uv5/YQfRjVFtF/+WEl2i/FHHFbNZuEfG0id+gbqeD4Ef1L0+mJdahlRlX6cm4lUlQJrR6Rx0FNpJEKbhri1X7Rito4eY23hi+RlbGzdyanzq8uNZ+vFXJUyNMgk9gf9oqSBI6xgqMnKJKa43FaNOoO/sipnPfUJzLbZLrvXaLXKUvXL+ZNhLN+ak41gknS7Ew5t2uQ3WlNNmpG75L7WfW2lJM72QStpipMJwx+1z6kck6/4GWYmtYVizfk4tOlQs6JoQPUdhqZP5m1Mll4y7kWeRtkNRw7BJVTWSjnBIiVfOqNBUQO7e3OCq6uSqS8YovqbrTwN3+WclVplL81DFeYYz8zPLgKTnlTUdeGwyKS+NHwTx8VcgIUBqGWqCNqecmJ1ZoKPoZvYuRFch0oyee55ZwKJ1712T0w+Nkt64xUzpk21alnnYfJKW3IeJNqOJaEHw1pdHr7oB4YtMo5EzXjItOI3hSALQ/RlHPGKi1RUXdDtHkL678VHD86sjxR/8Qg8cjf8VZwcsddzP8GFZNfsPune+WctjXYPRcHBPzJnyuVc+IVvbnYDavNyCbyUsH1Pj6pH6lO4nF6h3WmnP9Pn78Au1gaT2e2pfIAAAAASUVORK5CYII=" alt="" />
                </div>
        </div>
    </div>
</div>

            </span>
        </button>
                <button type="button"
                class="btn btn-primary mdet-print half-width-in-thin"
                title="Print this vehicle"
                    >
            <i class="fa fa-print"></i>&nbsp; Print        </button>
            </div>                            </div>
                        </div>
                        <hr>
                        <div>&nbsp;</div>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                <div class="js-first-picture">
    <img class="img-responsive btn-block"
         src="image/<?php echo htmlspecialchars($image_base); ?>_w640_h480_0.jpg"
         alt="BUY <?php echo htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']); ?>, NedbankMFC"
         title="<?php echo htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']); ?>, NedbankMFC, <?php echo htmlspecialchars($row['body_style']); ?>, <?php echo htmlspecialchars($row['exterior'] ?: 'OTHER'); ?>, MFC AH"
    >
</div>
<div class="wrap-slider slider-for slider-top"
     data-prev-title="Previous (Left arrow key)"
     data-next-title="Next (Right arrow key)"
>
<?php
// Loop through 12 images (0-11)
for ($i = 0; $i <= 11; $i++) {
    // Extract just the base image ID (remove any existing path prefixes)
    $image_base = basename($row['image']);
    $image_w1920 = 'image/' . htmlspecialchars($image_base) . '_' . $i . '.jpg';
    $image_w640 = 'image/' . htmlspecialchars($image_base) .  "_" . $i . '.jpg';
    $alt_text = 'BUY ' . htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ', NedbankMFC';
    $title_text = htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ', NedbankMFC, ' . htmlspecialchars($row['body_style']) . ', ' . htmlspecialchars($row['exterior'] ?: 'OTHER') . ', MFC AH';
    
    if ($i == 0) {
        $alt_text = 'BUY ' . htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ', NedbankMFC';
    } elseif ($i == 1) {
        $alt_text = htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ' AT BEST PRICE, NedbankMFC';
    } elseif ($i == 2) {
        $alt_text = 'AFFORDABLE ' . htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ', NedbankMFC';
    } elseif ($i == 3) {
        $alt_text = htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ' IN GOOD CONDITION, NedbankMFC';
    } elseif ($i == 4) {
        $alt_text = 'GREAT ' . htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ', NedbankMFC';
    } elseif ($i == 5) {
        $alt_text = htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ' FOR SALE, NedbankMFC';
    } elseif ($i == 6) {
        $alt_text = 'GREAT DEAL ' . htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ', NedbankMFC';
    } elseif ($i == 7) {
        $alt_text = 'GREAT OFFER ' . htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ', NedbankMFC';
    } else {
        $alt_text = htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ', NedbankMFC, image-' . ($i + 1);
    }
?>
                                        <a href="<?php echo $image_w1920; ?>">
                <div class="slider-for">
                    <div class="in-border center-vertical">
                        <img class="img-responsive btn-block"
                             src="<?php echo $image_w640; ?>"
                             alt="<?php echo $alt_text; ?>"
                             title="<?php echo $title_text . ($i > 0 ? ', image-' . ($i + 1) : ''); ?>"
                        >
                    </div>
                </div>
            </a>
<?php
}
?>
            </div>
            <div class="wrap-slider slider-nav center-block">
<?php
// Loop through 12 thumbnail images (0-11)
for ($i = 0; $i <= 11; $i++) {
    $image_w100 = 'image/' . htmlspecialchars($image_base) . '_' . $i . '.jpg';
    $alt_text = 'BUY ' . htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ', NedbankMFC';
    $title_text = htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ', NedbankMFC, ' . htmlspecialchars($row['body_style']) . ', ' . htmlspecialchars($row['exterior'] ?: 'OTHER') . ', MFC AH';
    
    if ($i == 0) {
        $alt_text = 'BUY ' . htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ', NedbankMFC';
    } elseif ($i == 1) {
        $alt_text = htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ' AT BEST PRICE, NedbankMFC';
    } elseif ($i == 2) {
        $alt_text = 'AFFORDABLE ' . htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ', NedbankMFC';
    } elseif ($i == 3) {
        $alt_text = htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ' IN GOOD CONDITION, NedbankMFC';
    } elseif ($i == 4) {
        $alt_text = 'GREAT ' . htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ', NedbankMFC';
    } elseif ($i == 5) {
        $alt_text = htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ' FOR SALE, NedbankMFC';
    } elseif ($i == 6) {
        $alt_text = 'GREAT DEAL ' . htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ', NedbankMFC';
    } elseif ($i == 7) {
        $alt_text = 'GREAT OFFER ' . htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ', NedbankMFC';
    } else {
        $alt_text = htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']) . ', NedbankMFC, image-' . ($i + 1);
    }
?>
                            <div style="padding: 0 10px;">
                    <div class="in-border center-vertical">
                        <img class="img-responsive btn-block"
                             src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                             data-lazy="<?php echo $image_w100; ?>"
                             alt="<?php echo $alt_text; ?>"
                             title="<?php echo $title_text . ($i > 0 ? ', image-' . ($i + 1) : ''); ?>"
                        >
                    </div>
                </div>
<?php
}
?>
                    </div>
        <div class="visible-sm text-center form-group">
        <span class="fa fa-long-arrow-left"></span>
        <span class="fa fa-lg fa-hand-o-up "></span>
        <span class="fa fa-long-arrow-right"></span>
    </div>
    <div class="visible-xs hidden-xxs text-center form-group">
        <span class="fa fa-long-arrow-left"></span>
        <span class="fa fa-lg fa-hand-o-up "></span>
        <span class="fa fa-long-arrow-right"></span>
    </div>
    <div class="visible-xxs text-center form-group">
        <span class="fa fa-long-arrow-left"></span>
        <span class="fa fa-lg fa-hand-o-up "></span>
        <span class="fa fa-long-arrow-right"></span>
    </div>
                            </div>
                            <div id="btnGroupContainer_2"></div>
                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 no-padding-left-lg specifications">
                                <div class="row">
                                    <div>
    <div id="specification">
        <fieldset class="specification"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><legend class="text-primary h4 no-margin-top">
            SPECIFICATIONS OF THIS
            
                 <?php echo htmlspecialchars($row['make'] . ' ' . $row['model'] . ' ' . $row['variant']); ?>  
             <!----></legend></div> <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><div class="list-group-item no-padding grid-field"><span>Title</span> <span title="" class="text-right truncate-string"><?php echo htmlspecialchars($row['title'] ?: 'OTHER'); ?></span></div> <div><!----><div class="list-group-item no-padding grid-field"><b class="text-uppercase">TRADE VALUE:</b> <b class="text-right"><?php echo htmlspecialchars($row['trade_value'] ?: 'CALL'); ?></b></div></div> <div class="list-group-item no-padding grid-field"><span>Body Style</span> <span title="" class="text-right truncate-string"><?php echo htmlspecialchars($row['body_style']); ?></span></div> <div class="list-group-item no-padding grid-field"><span>Odometer</span> <span title="" class="text-right truncate-string"><?php echo htmlspecialchars($row['odometer']); ?></span></div> <div class="list-group-item no-padding grid-field"><span>Engine</span> <span title="" class="text-right truncate-string"><?php echo htmlspecialchars($row['engine']); ?></span></div> <div class="list-group-item no-padding grid-field"><span>Transmission</span> <span title="" class="text-right truncate-string"><?php echo htmlspecialchars($row['transmission']); ?></span></div> <div class="list-group-item no-padding grid-field"><span>Stock</span> <span title="" class="text-right truncate-string"><?php echo htmlspecialchars($row['stock']); ?></span></div> <!----> <div class="list-group-item no-padding grid-field"><span>Seller</span> <span title="" class="text-right truncate-string"><?php echo htmlspecialchars($row['seller']); ?></span></div></div> <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><div class="list-group-item no-padding grid-field">
            <?php if ($row['vin']): ?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h3>VIN # <span><?php echo htmlspecialchars($row['vin']); ?></span></h3>
                    </div>
                </div>
            <?php endif; ?>
            </div> <div class="list-group-item barcode-box"><svg width="176px" height="50px" x="0px" y="0px" viewBox="0 0 176 50" xmlns="http://www.w3.org/2000/svg" version="1.1" style="transform: translate(0,0)"><rect x="0" y="0" width="176" height="50" style="fill:#ffffff;"></rect><g transform="translate(10, 10)" style="fill:#000000;"><rect x="0" y="0" width="2" height="30"></rect><rect x="3" y="0" width="1" height="30"></rect><rect x="6" y="0" width="1" height="30"></rect><rect x="11" y="0" width="3" height="30"></rect><rect x="15" y="0" width="2" height="30"></rect><rect x="20" y="0" width="1" height="30"></rect><rect x="22" y="0" width="1" height="30"></rect><rect x="24" y="0" width="1" height="30"></rect><rect x="28" y="0" width="2" height="30"></rect><rect x="33" y="0" width="2" height="30"></rect><rect x="38" y="0" width="1" height="30"></rect><rect x="40" y="0" width="3" height="30"></rect><rect x="44" y="0" width="1" height="30"></rect><rect x="46" y="0" width="3" height="30"></rect><rect x="50" y="0" width="4" height="30"></rect><rect x="55" y="0" width="1" height="30"></rect><rect x="59" y="0" width="1" height="30"></rect><rect x="61" y="0" width="4" height="30"></rect><rect x="66" y="0" width="2" height="30"></rect><rect x="69" y="0" width="2" height="30"></rect><rect x="73" y="0" width="2" height="30"></rect><rect x="77" y="0" width="2" height="30"></rect><rect x="80" y="0" width="2" height="30"></rect><rect x="84" y="0" width="2" height="30"></rect><rect x="88" y="0" width="1" height="30"></rect><rect x="91" y="0" width="2" height="30"></rect><rect x="96" y="0" width="1" height="30"></rect><rect x="99" y="0" width="2" height="30"></rect><rect x="104" y="0" width="1" height="30"></rect><rect x="108" y="0" width="1" height="30"></rect><rect x="110" y="0" width="1" height="30"></rect><rect x="113" y="0" width="3" height="30"></rect><rect x="118" y="0" width="2" height="30"></rect><rect x="121" y="0" width="3" height="30"></rect><rect x="125" y="0" width="1" height="30"></rect><rect x="129" y="0" width="2" height="30"></rect><rect x="132" y="0" width="2" height="30"></rect><rect x="138" y="0" width="1" height="30"></rect><rect x="141" y="0" width="1" height="30"></rect><rect x="143" y="0" width="2" height="30"></rect><rect x="148" y="0" width="3" height="30"></rect><rect x="152" y="0" width="1" height="30"></rect><rect x="154" y="0" width="2" height="30"></rect></g></svg></div> <div class="list-group-item no-padding grid-field"><span>Doors</span> <span title="" class="text-right truncate-string"><?php echo htmlspecialchars($row['doors']); ?></span></div> <div class="list-group-item no-padding grid-field"><span>Fuel Type</span> <span title="" class="text-right truncate-string"><?php echo htmlspecialchars($row['fuel-type']); ?></span></div> <div class="list-group-item no-padding grid-field"><span>Drive Type</span> <span title="" class="text-right truncate-string"><?php echo htmlspecialchars($row['drive_type']); ?></span></div> <div class="list-group-item no-padding grid-field"><span>Exterior</span> <span class="text-right">
            <?php echo htmlspecialchars($row['exterior'] ?: 'WHITE'); ?>
            &nbsp;<span class="badge ext-color" style="background-color: <?php echo htmlspecialchars($row['exterior'] ?: 'WHITE'); ?>;">&nbsp;&nbsp;&nbsp;</span></span></div> <div class="list-group-item no-padding grid-field"><span>Interior</span> <span class="text-right">
            
            <?php echo htmlspecialchars($row['interior'] ?: ''); ?>
            <!----></span></div> <!----></div> <div class="col-lg-12 col-xs-12 flag-wrapper"><div class="list-group-item no-padding grid-field announcement"><span>Announcements</span> <?php echo htmlspecialchars($row['announcements'] ?: ''); ?></div> <!----></div></fieldset>
    </div>

    
    </div>                                </div>
                            </div>
                            <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 no-padding-left-lg padding-md-left pull-right">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            </div>
                                    
                                </div>
                            </div>
                                                            <div id="btnGroupContainer_1">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 btnGroupWrap">
                                        <div class="form-group">
                                                                                        <div class="mdet-option-keys-box">
                                                



    <button
        type="button"
        class="btn btn-sm btn-primary full-width-in-thin mdet-option-keys"
        data-toggle="modal" data-target="#emailModal"
        title="Tell your friend about this <?php echo htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']); ?>">
        <div><span class="mdet-icon mdet-icon-emfriend"></span>Email a Friend</div>
    </button>














    <a
        href="dekra-reports/<?php echo htmlspecialchars($row['vin']); ?>.pdf"
        class="btn btn-sm btn-primary full-width-in-thin mdet-option-keys"
        target="_blank"
    >
        <i class="fa fa-file-pdf-o"></i>&nbsp;
        Dekra Condition Report    </a>
    <a
        href="dekra-reports/DIG<?php echo htmlspecialchars($row['vin']); ?>.pdf"
        class="btn btn-sm btn-primary full-width-in-thin mdet-option-keys"
        target="_blank"
    >
        <i class="fa fa-file-pdf-o"></i>&nbsp;
        Dekra Diagnostic Report    </a>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <p></p>
                                    </div>
                                </div>
                                                                                    
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <fieldset>
                    <legend class="text-primary h4">
                DESCRIPTION OF THIS <?php echo htmlspecialchars($row['make'] . ' ' . $row['model'] . ' ' . $row['variant']); ?>            </legend>
            <p class="text-justify"><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
            </fieldset>
</div>
                            
                            
                                                                                </div>
                    </div>
                                    </div>
            </div>
                    </div>
    </div>

    <!-- FORMS -->
    




    <div class="modal fade focusout"
     id="emailModal"
     tabindex="-1"
     role="dialog"
     aria-hidden="true"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Email a Friend</h4>
            </div>
            <div class="modal-body">
                <div class="content">
                    <div class="modul-r-email_friend text-left nowow">
                        <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full-width-in-thin ">
                                                        <form class="form-horizontal email_friend_form row"
                                  action="#"
                                  target="_self"
                                  method="post"
                                                              >
                                <input type="hidden" name="form_id" value="emailfriend"/>
                                <input type="text" name="isvalid" value="" class="hidden"/>
                                <input type="hidden" name="action" value="email_friend"/>
                                <fieldset>
                                    <div class="full-width-in-thin col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group has-feedback">
                                            <label class="col-lg-4 col-md-4 control-label">
                                                Friend's Email:                                            </label>
                                            <div class="col-lg-8 col-md-8">
                                                <span class="glyphicon glyphicon-asterisk form-control-feedback text-danger" aria-hidden="true"></span>
                                                <input class="form-control" type="text" name="fr_email"/>
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label class="col-lg-4 col-md-4 control-label">
                                                Friend's Name:                                            </label>
                                            <div class="col-lg-8 col-md-8">
                                                <span class="glyphicon glyphicon-asterisk form-control-feedback text-danger" aria-hidden="true"></span>
                                                <input class="form-control" type="text" name="fr_name"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="full-width-in-thin col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group has-feedback">
                                            <label class="col-lg-4 col-md-4 control-label">
                                                Your Email:                                            </label>
                                            <div class="col-lg-8 col-md-8">
                                                <span class="glyphicon glyphicon-asterisk form-control-feedback text-danger" aria-hidden="true"></span>
                                                <input class="form-control" type="text" name="yr_email"/>
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label class="col-lg-4 col-md-4 control-label">
                                                Your Name:                                            </label>
                                            <div class="col-lg-8 col-md-8">
                                                <span class="glyphicon glyphicon-asterisk form-control-feedback text-danger" aria-hidden="true"></span>
                                                <input class="form-control" type="text" name="yr_name"/>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                                                <div class="text-center">
                                    <p class="text-muted text-center">
                                        <span class="glyphicon glyphicon-asterisk text-danger"></span>
                                        - indicates required fields                                    </p>
                                    <button type="button" class="btn btn-primary btn-submit">
                                        <span class="fa fa-check"></span>&nbsp;<span>Submit</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
    </div>


    <script>
        $(function() {
            EmailFriendResponsive.init();
        });
    </script>

                </div>
            </div>
        </div>
    </div>
</div>






    <div class="modal fade focusout"
     id="show_printModal"
     tabindex="-1"
     role="dialog"
     aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Print this page</h4>
            </div>
            <div class="modal-body">
                <div class="content">
                                            <style type="text/css">
    #printForm, #printFormSimple {visibility:hidden;}
</style>
    <script type="text/javascript">
        if ('function' !== typeof(quotePrinter)) {
            function quotePrinter(action, params, tmpValue, operValue, singleTemplateForcePrint) {
                var $moduleBrochure = $('.modul-r-ebrochure select');

                $moduleBrochure.each(function (ind) {
                    var defaultTemplate = $(this).val();

                    if ($(this).hasClass('print_simple')) {
                        defaultTemplate = (defaultTemplate) ? defaultTemplate : '001a';
                    } else if ($(this).hasClass('print_heavy')) {
                        defaultTemplate = (defaultTemplate)
                            ? defaultTemplate
                            : '001a';
                    }

                    $(this)
                        .closest('.modul-r-ebrochure')
                        .find('form[name="printForm"] input[name="tpl"]')
                        .val(defaultTemplate);
                });

                switch (action) {
                    case 'open':
                        /* open printer dialog */
                        $('.ebr-quoteprinter-template').show();
                        $('.ebr-quoteprinter-edit').hide();
                        break;

                    case 'close':
                        /* close printer dialog */
                        $('.ebr-quoteprinter').show();
                        break;
                    case 'edit':
                        var form = $('#printForm');
                        $('input[name="editmode"]', form).val(1);
                        $('input[name="format"]', form).val('html');
                        form.submit();
                        break;
                    case 'print':
                        var form = $('.modul-r-ebrochure:visible form[name="printForm"]:first');
                        $('input[name="editmode"]', form).val(0);
                        $('input[name="format"]', form).val(params);
                        form.submit();
                        break;
                    case 'forcePrint':
                        
                        var form = $('.modul-r-ebrochure form[name="printForm"]:first');
                        $('input[name="editmode"]', form).val(0);
                        $('input[name="format"]', form).val(params);
                        $('form[name="printForm"] input[name="tpl"]').val(tmpValue);
                        $('form[name="printForm"] input[name="oper"]').val(operValue);
                        if (1 === singleTemplateForcePrint) {
                            $('form[name="printForm"] input[name="singleTemplateForcePrint"]').val(singleTemplateForcePrint);
                        } 
                        form.submit();
                        break;
                    case 'printDefault':
                        var form = $('.modul-r-ebrochure:visible form[name="printForm"]:first');

                        $('input[name="editmode"]', form).val(0);
                        $('input[name="format"]', form).val(params);
                        form.submit();
                        break;
                }
            }
        }

        $(function() {
            var $moduleBrochure = $('.modul-r-ebrochure select');

            $moduleBrochure.change(function() {
                var value = $(this).val();

                $(this).closest('.modul-r-ebrochure').find('form[name="printForm"] input[name="tpl"]').val(value);

                if ($("option:selected", this).hasClass('custom-tpl')) {
                    $('.btn-edit-tpl').addClass('disabled').css('opacity', 0.6);
                } else {
                    $('.btn-edit-tpl').removeClass('disabled').css('opacity', 1);
                }
            });
            $moduleBrochure.trigger('change');
        });
    </script>

<div class="modul-r-ebrochure nowow">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="ebr-quoteprinter-step ebr-quoteprinter-template" style="text-align:center;">
                                <label class="control-label">Select a Template:</label>
                                
    <select id="ebr-quoteprinter-select" class="form-control print_simple">
                                                <optgroup label="Cars">
                                                                                            <option value="001a">Template 001 (Cars)</option>
                                                                                                <option value="001ba">Template 001 (Cars + featured)</option>
                                                                                                <option value="002a">Template 002 (Cars)</option>
                                                                                                <option value="003a">Template 003 (Cars)</option>
                                                                                                <option value="004a">Template 004 (Cars)</option>
                                                                                                <option value="007a">Template 007 (Cars)</option>
                                                                                                <option value="009a">Template 009 (Cars)</option>
                                                                                                                                                                                                                                                                                                                                                                                </optgroup>
                                        <optgroup label="Trucks">
                                                                                                                                                                                                                                                                                                                                                                                                                <option value="001">Template 001 (Trucks)</option>
                                                                                                <option value="001b">Template 001 (Trucks + featured)</option>
                                                                                                <option value="002">Template 002 (Trucks)</option>
                                                                                                <option value="003">Template 003 (Trucks)</option>
                                                                                                <option value="004">Template 004 (Trucks)</option>
                                                                                                <option value="007">Template 007 (Trucks)</option>
                                                                                                <option value="009">Template 009 (Trucks)</option>
                                                            </optgroup>
                                    </select>

<script type="text/javascript">
    $(function () {
        $('#ebr-quoteprinter-select').on('input', function () {
            $('#printForm input[name="tpl"]').val($(this).val());
        });
    });
</script>
                            </div>

                            <div class="ebr-quoteprinter-buttons " style="text-align:center;padding:10px;">
                                                                                                    <button class="btn btn-primary navbar-btn no-margin-bottom" style="padding:4px;" onclick="quotePrinter('print', 'html');">
                                        Print
                                    </button>
                                                            </div>
                            <form name="printForm"
                                  id="printFormSimple"
                                  target="_blank" method="POST" action="https://www.mfcauctions.co.za/ajax">
                                <input hidden name="oper" value="print_simple"/>
                                <input hidden name="format" value="html"/>
                                <input hidden name="editmode" value="0"/>
                                <input hidden name="vehicle" value="2021"/>
                                <input hidden name="user" value="75183"/>
                                <input hidden name="tpl" value=""/>
                                <input hidden name="singleTemplateForcePrint" value="0"/>
                                <input hidden name="auction_mode" value="0"/>
                                <input hidden name="show_price" value="1"/>
                                                            </form>

                        </div>
                    </div>
                            </div>
    </div>
</div>
    <script type="text/javascript">
        $(document).ready(function(){
                    
                var singleTemplateForcePrint = 0;
                        var paramPrintTemplate = $('select.print_simple optgroup[label="Make-A-Template"]').find('option').length;
            var paramPrintCars = $('select.print_simple optgroup[label="Cars"]').find('option').length;
            var paramPrintTruck = $('select.print_simple optgroup[label="Trucks"]').find('option').length;
            
            var summPrint = paramPrintTemplate + paramPrintCars + paramPrintTruck;
            
            if (summPrint == 1) {
                if (paramPrintTemplate == 1) {
                    var tmpValueS = $('select.print_simple optgroup[label="Make-A-Template"]').find('option').val();
                } else if (paramPrintCars == 1) {
                    var tmpValueS = $('select.print_simple optgroup[label="Cars"]').find('option').val();
                } else if (paramPrintTruck == 1){
                    var tmpValueS = $('select.print_simple optgroup[label="Trucks"]').find('option').val();
                } else {
                    var tmpValueS = '';
                }
                
                var operValueS = 'print_simple';
                
                setTimeout(function(){
                    $('#vehicleDetailsTruckPrint').unbind('click').click(function(){
                        quotePrinter('forcePrint', 'html', tmpValueS, operValueS, singleTemplateForcePrint);
                     })
                 }, 1000);
                
                setTimeout(function(){
                    $('.vdta-print-btn').unbind('click').click(function(){
                    quotePrinter('forcePrint', 'html', tmpValueS, operValueS, singleTemplateForcePrint);
                    })
                }, 1000);
                
            }
            
            if ($('select.print_simple optgroup[label="Make-A-Template"]').find('option').length == 0) {
               $('select.print_simple optgroup[label="Make-A-Template"]').remove(); 
            } 
        
            if ($('select.print_simple optgroup[label="Cars"]').find('option').length == 0) {
                $('select.print_simple optgroup[label="Cars"]').remove();
            }
            
            if ($('select.print_simple optgroup[label="Trucks"]').find('option').length == 0) {
                $('select.print_simple optgroup[label="Trucks"]').remove()
            }
            
            if ($('select.print_heavy optgroup[label="Make-A-Template"]').find('option').length == 0) {
                $('select.print_heavy optgroup[label="Make-A-Template"]').remove();
            }
            
            if ($('select.print_heavy optgroup[label="Cars"]').find('option').length == 0) {
                $('select.print_heavy optgroup[label="Cars"]').remove();
            }
            
            if ($('select.print_heavy optgroup[label="Trucks"]').find('option').length == 0) {
                $('select.print_heavy optgroup[label="Trucks"]').remove();
            }
            
                        
        });
    </script>                        


                                    </div>
            </div>
        </div>
    </div>
</div>
    <!-- #End FORMS -->

    

<script type="text/javascript">
    var $vehicleDetailsWrapper = $('#modul_r_details_' + '6981ed6fa95d6');

    var enableMasonry = true;
    var optionIconsEnabled = false;
    var masonryInitialized = false;

    $vehicleDetailsWrapper.find('.slider-nav').on('init', function() {
        var $this = $(this);
        System.on('styler.ready.after', function (){
            $this.add($vehicleDetailsWrapper.find('.slider-top'))
                .slick('refresh');
        });
    });

    $(function() {
        var uid = '6981ed6fa95d6';
        var $vehicleDetailsWrapper = $('#modul_r_details_' + uid).eq(0);
        var $sliderTop = $vehicleDetailsWrapper.find('.slider-top').eq(0);
        var $sliderFor = $vehicleDetailsWrapper.find('.slider-nav').eq(0);

        $('.slider-top, .slider-nav').fadeIn('slow');

        $sliderTop
            .on('init', function () {
                $vehicleDetailsWrapper.find('.js-first-picture').hide();
            })
            .slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.slider-nav',
                lazyLoad: 'ondemand',
                            })
            .on('setPosition', function () {
                var $sliderFor = $('#modul_r_details_' + uid + ' .slider-for');
                var imgWidth = $sliderFor.find('.slick-slide').width();
                var imgHeight = Math.floor(imgWidth * 0.75 + 1);

                $sliderFor.find('.in-border').css({'height': imgHeight});
            });

        $sliderFor.slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-top',
            dots: false,
            centerMode: false,
            focusOnSelect: true,
            lazyLoad: 'ondemand',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        arrows: false,
                        centerMode: false
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        arrows: false,
                        centerMode: false
                    }
                },
                {
                    breakpoint: 450,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        arrows: false,
                        centerMode: false
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        }).on('setPosition', function () {
            var $sliderNav = $('#modul_r_details_' + uid + ' .slider-nav');
            var imgWidth = $sliderNav.find('.slick-slide').width();
            var imgHeight = Math.ceil(imgWidth * 0.75);

            $sliderNav.find('.in-border').css({'height': imgHeight});
        });

        // change key position
        $(window).on('load resize', function() {
            var windowInnerWidth = window.innerWidth,
                $btnCont1 = $('#btnGroupContainer_1', $vehicleDetailsWrapper),
                $btnCont2 = $('#btnGroupContainer_2', $vehicleDetailsWrapper);

            if (windowInnerWidth < 992) {
                $btnCont2.append($btnCont1.children('div'));
            }
            else {
                $btnCont1.append($btnCont2.children('div'));
            }

            var $item = $('.grid', $vehicleDetailsWrapper);

            if (windowInnerWidth < $SESSIONDATA['sm_width']) {
                $item
                    .filter('.is-active')
                    .masonry('destroy')
                    .removeClass('is-active');
            }
            else {
                $item
                    .not('.is-active')
                    .masonry({
                        itemSelector: '#modul_r_details_6981ed6fa95d6 .grid-item',
                        columnWidth: '#modul_r_details_6981ed6fa95d6 .grid-item',
                        percentPosition: true
                    })
                    .addClass('is-active');
            }
        });

        $vehicleDetailsWrapper.find('.wrap-slider a[href]').magnificPopup({
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            image: {verticalFit: true},
            gallery: {
                enabled: true,
                arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"><span class="fa fa-chevron-%dir%"></span></button>', // markup of an arrow button
                tPrev: $sliderTop.data('prevTitle') || 'Previous',
                tNext: $sliderTop.data('nextTitle') || 'Next'
            }
        });

        $('#show360ViewModal').on('shown.bs.modal', function (e) {
            var event = $.Event('360ViewEventListener');

            $(window).trigger(event);
        });

            });
</script>

    <script type="text/javascript">
        window.logisticsErrorMessage = "Unable to calculate cost estimation.";

        var arrayVehiclesDetails = [{"id":"2021","vin":"ZAR94000007411755","url":"https:\/\/www.mfcauctions.co.za\/alfa-romeo-giulietta-1-8t-quad-verde-tct-5dr-hatchback-other-sa_vid_2021_rf_pi.html","vurl":"https:\/\/www.mfcauctions.co.za\/alfa-romeo-giulietta-1-8t-quad-verde-tct-5dr-hatchback-other-sa_vid_2021_rf_pi.html","currency":"R","strPrice":" CALL ","price":0,"vcaption":"2016 ALFA ROMEO GIULIETTA 1.8T QUAD VERDE TCT 5DR HATCHBACK ","photo_array":["\/image\/2021_w640_h480_0.jpg","#\/image\/2021_w640_h480_1.jpg","#\/image\/2021_w640_h480_2.jpg","#\/image\/2021_w640_h480_3.jpg","#\/image\/2021_w640_h480_4.jpg","#\/image\/2021_w640_h480_5.jpg","#\/image\/2021_w640_h480_6.jpg","#\/image\/2021_w640_h480_7.jpg","#\/image\/2021_w640_h480_8.jpg","#\/image\/2021_w640_h480_9.jpg","#\/image\/2021_w640_h480_10.jpg","\/image\/2021_w640_h480_11.jpg"],"auction":""}];
        var alertOffer = "By confirming this offer you agree to <a href="/" target=\"_blank\">Terms and Conditions<\/a>.";
        var alertBuynow = "By confirming this purchase you agree to <a href="/" target=\"_blank\">Terms and Conditions<\/a>.";
        var alertBid = "By confirming this bid you agree to <a href="/" target=\"_blank\">Terms and Conditions<\/a>.";
        idVehicle = '2021';

        function detail_bookmarksite(title, url) {
            if (!url) {
                url = window.location
            }
            if (!title) {
                title = document.title
            }
            var browser = navigator.userAgent.toLowerCase();
            if (window.sidebar && 'undefined' !== typeof(window.sidebar.addPanel)) { // Mozilla, Firefox, Netscape, -> FF under v23
                window.sidebar.addPanel(title, url, "");
            } else if (window.external) { /* IE or chrome */
                if (-1 === browser.indexOf('chrome') && 'undefined' !== typeof(window.external.AddFavorite)) { /* ie */
                    window.external.AddFavorite(url, title);
                } else { /* chrome || FF after v23 */
                    alert('Please Press CTRL+D (or Command+D for macs) to bookmark this page');
                }
            } else if (window.opera && window.print) { /* Opera - automatically adds to sidebar if rel=sidebar in the tag */
                return true;
            } else if (-1 !== browser.indexOf('konqueror')) { /* Konqueror */
                alert('Please press CTRL+B to bookmark this page.');
            } else if (-1 !== browser.indexOf('webkit')) { /* safari */
                alert('Please press CTRL+B (or Command+D for macs) to bookmark this page.');
            } else {
                alert('Your browser cannot add bookmarks using this link. Please add this link manually.')
            }
        }

        $(function () {
            var params = {
                uid: "6981ed6fa95d6",
                vehicleId: "2021",
                widgetParams: {"corners":"round","style":"default","condition":"enabled","warranty":"yes","layout":"default","buttons":{"back":false,"approved":true,"testdrive":{"active":false,"caption":"Test Drive","form":""},"emailfried":true,"contactus":false,"livechat":false,"offer":false,"bidnow":false,"buynow":false,"showvideo":true,"shareit":false,"spin360":false,"videostreaming":false,"eprice":false,"discount":false,"documents":{"active":true,"caption":"Documents"},"dekraConditionReport":true,"dekraDiagnosticReport":true,"playaudio":false},"hours_work":"{\"hours_from\":\"9\",\"min_from\":\"00\",\"am_from\":\"am\",\"hours_to\":\"6\",\"min_to\":\"00\",\"am_to\":\"pm\",\"every_day\":\"\",\"monday\":\"1\",\"tuesday\":\"1\",\"wednesday\":\"1\",\"thursday\":\"1\",\"friday\":\"1\",\"saturday\":\"1\",\"sunday\":\"\"}","price_settings":"{\"price_new\":\"\",\"price_user1_new\":1,\"price_user2_new\":\"\",\"price_user3_new\":\"\",\"label_price_new\":\"TRADE VALUE\",\"label_price_user1_new\":\"TRADE VALUE\",\"label_price_user2_new\":\"\",\"label_price_user3_new\":\"\",\"source_price_user1_new\":\"estTradeValue\",\"source_price_user2_new\":\"user2\",\"source_price_user3_new\":\"user3\",\"price_used\":\"\",\"price_user1_used\":1,\"price_user2_used\":\"\",\"price_user3_used\":\"\",\"label_price_used\":\"TRADE VALUE\",\"label_price_user1_used\":\"TRADE VALUE\",\"label_price_user2_used\":\"\",\"label_price_user3_used\":\"\",\"source_price_user1_used\":\"estTradeValue\",\"source_price_user2_used\":\"user2\",\"source_price_user3_used\":\"user3\",\"price\":\"\",\"price_user1\":\"CALL\",\"price_user2\":\"CALL\",\"price_user3\":\"CALL\"}","panel":"none","display_options":"1","position_options":"1","addon_vote":"no","type_metrik":"default","convert_coefficient":"236","lable_suystem_metrik":"","cstm_mileage_value":"","image_size":[245,184,169],"thumb_mode":"multiple","thumb_size":[90,60],"slide_time":"0","vehicle_type":0,"printing_template":"no","allowBrochureEdit":"no","allowMAT":"no","allowForPrivateSeller":"yes","allowBrochureForAllUsers":"no","btn_style":"default","fuel_show":"show","lvs_image":"","lvs_title":"Live Video Streaming","extendedHours":"yes","formatViewOptions":"table","locationViewOptions":"below","auction_mode":"0","buy_now_enabled":"1","submit_message":"","show_print_button":"1","offer_counter":"0","refresh_timeout":"0","offer_counter_label":"Offers","countdown_timer":"0","use_tags":"0","show_dealer_ribbon":"no","displayCondition":"no","show_vir_grading":"0","vir_grading_redirect":"anchor","hide_vir_pictures":"no","title_field":"0","simulcast_mode":"0","simulcast_template":"seller","simulcast_options":[],"show_simulcast_pagination_buttons":"1","show_sold_vehicles":"no","show_announcements":"no","showSimulcastFlags":"no","showPrevNextNavigation":"no","showWatchButton":"no","showLogisticsCost":"no","offerFormMode":"0","displayOfferFormButton":false,"marketplaceLayout":"no","showBarcode":"yes","showVirHeader":"no","show_location":"1","showAuctionBlock":true,"useShippingCost":"no","showSaveVehicleButton":true,"showRunListButton":"yes","showCarfaxButton":"yes","hideDisclaimer":"yes","showAmmr":"no","runListNavigationPosition":"right","showSeller":"yes","showPhoneNumber":"yes","showCity":"yes","gradingType":"virGrading","namaCrUriTemplate":"https:\/\/ebca-media.kfsnet.co.uk\/i_folder\/{reg_no}\/Vehicle.pdf","sellerNameToShow":"dealerName","replaceVinOnMMcode":"no","template":"responsive","colorTheme":"default","wow":"nowow"},
                requestParams: {"id":"2021"},
                usePrevNextButtons: false,
                showWatchButton: false,
                isAuthorized: false,
                auctionMode: 0,
                watchListText: {
                    addWatch: 'Watch',
                    removeWatch: 'Remove',
                    saveText: 'Saving Vehicle...',
                    removeText: 'Removing Vehicle...',
                },
                vehicleCookiesFlag: false,
                showLogisticsCost: false,
                                showNamaGrading: null,
                licensePlate: null,
                isDefaultLayout: true,
                isUkLayout: null,
                isAlternativeLayout: false,
                wizardUrl: "",
                vehiclePrices: [[],{"caption":"TRADE VALUE","price":"CALL"}],
                isShowPrice: true,
                specificationLabels: {"blockLabel":"SPECIFICATIONS OF THIS","servHistory":"Serv. History","regNo":"Reg No","mot":"MOT","v5":"V5","vatStatus":"Vat Status","bodyStyle":"Body Style","odometer":"Odometer","engine":"Engine","transmission":"Transmission","stock":"Stock","directFrom":"Direct From","ammr":"AMMR","condition":"Condition","fstReg":"1st Reg","vin":"VIN #","doors":"Doors","fuelType":"Fuel Type","driveType":"Drive Type","exterior":"Exterior","interior":"Interior","announcements":"Announcements","title":"Title","seller":"Seller","inspector":"Inspector","mmCode":"M&M Code"},
                sellerNameToShow: "dealerName",
                isShowSeller: true,
            };

            new VehicleDetailsWidget(params);
        });
    </script>

    

<div class="widget-spacer">
	  <div 
			class="h3"
	  	>
    &nbsp;
    </div>
</div></div></div>
 </div>
        </main>
        <footer>
            <div class="layout-container container" data-container="footer">

            
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  " data-container="footer_0_0" data-size-lg="12">
<div class="modul-r-container
            container-6981ed6fac578                        nowow"
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
      <li><a href="simulcast-calendar.html">Auctions</a></li>
        <li><a href="media/dealer_101/storage/docs/Auction_Calculator.pdf" target="_blank">Auction Calculator</a></li>
        <li><a href="index.html#" id="js-searchLink" data-toggle="modal" >Search</a> </li>
        <li><a href="terms-and-conditions.html">Terms and conditions</a></li>
        <li><a href="frequently-asked-questions.html">FAQ</a></li>
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
         <li><a href="simulcast-calendar.html">Upcoming auctions</a></li>
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
            data = {"active_tab":"lg","lg":{"inherited":"none","bg_filling":"full_width","background-image":"","background-color":"rgba(242,249,245,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"},"md":{"inherited":"lg","bg_filling":"full_width","background-image":"","background-color":"rgba(242,249,245,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"},"sm":{"inherited":"lg","bg_filling":"full_width","background-image":"","background-color":"rgba(242,249,245,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"},"xs":{"inherited":"lg","bg_filling":"full_width","background-image":"","background-color":"rgba(242,249,245,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"}},
            $module = $('.container-6981ed6fac578'),
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
            container-6981ed6fac5a9                        nowow"
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
            $module = $('.container-6981ed6fac5a9'),
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
                                <a class="mcprt-link" href="/">
                    2026 &copy; NedbankMFC</a>
                            </div>
    <?php
include_once "inc/footer.php";

// Close database connection
$conn->close();
?>
        </div>
    </div>

    
</div>
        </footer>
    </div>
</body>
<!--0.46634793281555-->

<!-- Mirrored from www.mfcauctions.co.za/alfa-romeo-giulietta-1-8t-quad-verde-tct-5dr-hatchback-other-sa_vid_2021 by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 03 Feb 2026 12:47:50 GMT -->
</html>
