<?php 
include_once "inc/search/search-head.php";

// Database connection
require_once 'config/database.php';

$database = new Database();
$conn = $database->getConnection();

// Query to get car data
$sql = "SELECT * FROM cars ORDER BY year_model DESC";
$result = $conn->query($sql);
?>
        <main>
            <div class="layout-container container" data-container="body">
            
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  " data-container="body_0_0" data-size-lg="12">
<div id="modul_r_inventory_6981ed319ce9d" class="modul-r-inventory nowow layout-inherit">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Car Search Results</h4>
                </div>
                <div class="panel-body">
                    <p class="h4">
                        Search Results: <span class="label label-primary"><?php echo $result ? $result->num_rows : 0; ?></span> Found
                    </p>
                    
                    <div class="row vehicles-list">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php if ($result && $result->num_rows > 0): ?>
                                <?php while($row = $result->fetch_assoc()): ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                                        <div class="panel panel-default no-margin vehicle-img-wrapper">
                                                            <div class="panel-heading no-padding">
                                                                <a class="embed-responsive embed-responsive-4by3" href="car-details.php?id=<?php echo $row['id']; ?>">
                                                                    <img class="embed-responsive-item vehicle-img"
                                                                         src="/image/<?php echo $row['image']; ?>_0.jpg?nocache=<?php echo time(); ?>"
                                                                         alt="<?php echo htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model']); ?>"
                                                                    >
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                                        <div class="vehicle-info">
                                                            <h4>
                                                                <a href="car-details.php?id=<?php echo $row['id']; ?>" class="text-primary">
                                                                    <?php echo htmlspecialchars($row['year_model'] . ' ' . $row['make'] . ' ' . $row['model'] . ' ' . $row['variant']); ?>
                                                                </a>
                                                            </h4>
                                                            <p><strong>Stock:</strong> <?php echo htmlspecialchars($row['stock']); ?></p>
                                                            <p><strong>Odometer:</strong> <?php echo number_format($row['odometer']) . " km"; ?></p>
                                                            <p><strong>Price:</strong> <?php echo htmlspecialchars($row['trade_value'] ? $row['trade_value'] : 'CALL'); ?></p>
                                                            <p><strong>Specification:</strong> <?php echo htmlspecialchars(strtoupper($row['exterior']) . ', ' . strtoupper($row['body_style']) . ', ' . strtoupper($row['doors']) . " DOORS"); ?></p>
                                                            
                                                            <div class="btn-group">
                                                                <a href="car-details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">
                                                                    <i class="fa fa-eye"></i> Details
                                                                </a>
                                                                <a href="car-details.php?id=<?php echo $row['id']; ?>" class="btn btn-default btn-sm">
                                                                    <i class="fa fa-qrcode"></i> QR Code
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <div class="alert alert-info">
                                    <h4>No cars found</h4>
                                    <p>No vehicles found in the database. Please add cars using the admin panel.</p>
                                    <p><a href="admin/login.php" class="btn btn-primary">Go to Admin Panel</a></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        </main>
        
        <footer>
            <div class="layout-container container" data-container="footer">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                        <p>&copy; 2026 NedbankMFC. All rights reserved.</p>
                        <p><a href="admin/login.php">Admin Login</a></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
