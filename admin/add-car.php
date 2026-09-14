<?php
require_once '../config/database.php';
require_once '../inc/admin-header.php';

$database = new Database();
$conn = $database->getConnection();

$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate inputs
    $year_model = isset($_POST['year_model']) ? trim($_POST['year_model']) : '';
    $make = isset($_POST['make']) ? trim($_POST['make']) : '';
    $model = isset($_POST['model']) ? trim($_POST['model']) : '';
    $variant = isset($_POST['variant']) ? trim($_POST['variant']) : '';
    $body_style = isset($_POST['body_style']) ? trim($_POST['body_style']) : '';
    $doors = isset($_POST['doors']) ? trim($_POST['doors']) : '';
    $fuel_type = isset($_POST['fuel_type']) ? trim($_POST['fuel_type']) : '';
    $drive_type = isset($_POST['drive_type']) ? trim($_POST['drive_type']) : '';
    $exterior = isset($_POST['exterior']) ? trim($_POST['exterior']) : '';
    $interior = isset($_POST['interior']) ? trim($_POST['interior']) : '';
    $odometer = isset($_POST['odometer']) ? trim($_POST['odometer']) : '';
    $price = isset($_POST['price']) ? trim($_POST['price']) : '';
    $stock = isset($_POST['stock']) ? trim($_POST['stock']) : '';
    $vin = isset($_POST['vin']) ? trim($_POST['vin']) : '';
    $announcements = isset($_POST['announcements']) ? trim($_POST['announcements']) : '';
    $image_base = isset($_POST['image_base']) ? trim($_POST['image_base']) : '';
    $engine = isset($_POST['engine']) ? trim($_POST['engine']) : '';
    $transmission = isset($_POST['transmission']) ? trim($_POST['transmission']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $trade_value = isset($_POST['trade_value']) ? trim($_POST['trade_value']) : '';
    
    // Validate required fields
    if (empty($year_model) || empty($make) || empty($model) || empty($image_base)) {
        $message = "Please fill in all required fields (Year, Make, Model, and Image Base).";
        $message_type = "danger";
    } else {
        // Insert into database
        $sql = "INSERT INTO cars (
            title, make, model, variant, body_style, year_model, seller, doors, odometer, 
            drive_type, exterior, stock, announcements, engine, transmission, interior, 
            `fuel-type`, description, vin, trade_value, image
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $title = $make . ' ' . $model;
            
            // Ensure doors is not empty
            if (empty($doors)) {
                $doors = '';
            }
            
            $seller = 'MFC AUCTION HOUSE';
            $stmt->bind_param(
                "sssssssssssssssssssss",
                $title, $make, $model, $variant, $body_style, $year_model, $seller, $doors, $odometer, $drive_type, $exterior, $stock, $announcements, $engine, $transmission, $interior, $fuel_type, $description, $vin, $trade_value, $image_base
            );
            
            if ($stmt->execute()) {
                $message = "Car added successfully!";
                $message_type = "success";
                
                // Clear form
                $_POST = array();
            } else {
                $message = "Error adding car: " . $stmt->error;
                $message_type = "danger";
            }
            $stmt->close();
        } else {
            $message = "Error preparing statement: " . $conn->error;
            $message_type = "danger";
        }
    }
}

// Get existing makes for dropdown
$makes = [];
$result = $conn->query("SELECT DISTINCT make FROM cars ORDER BY make");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $makes[] = $row['make'];
    }
}

$database->closeConnection();
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Add New Car</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show" role="alert">
                        <?php echo $message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <form method="POST" class="needs-validation" novalidate>
                    <div class="row">
                        <!-- Basic Information -->
                        <div class="col-md-12 mb-4">
                            <h6><i class="fas fa-info-circle me-2"></i>Basic Information</h6>
                            <hr>
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="year_model" class="form-label">Year Model *</label>
                            <input type="number" class="form-control" id="year_model" name="year_model" 
                                   value="<?php echo htmlspecialchars($_POST['year_model'] ?? ''); ?>" required min="1900" max="2100">
                            <div class="invalid-feedback">Please provide a valid year.</div>
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="make" class="form-label">Make *</label>
                            <input type="text" class="form-control" id="make" name="make" 
                                   value="<?php echo htmlspecialchars($_POST['make'] ?? ''); ?>" required
                                   placeholder="Enter car make (e.g., Toyota, BMW, Ford)">
                            <div class="form-text">Type the make directly or select from suggestions below</div>
                            <div class="invalid-feedback">Please provide a make.</div>
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="model" class="form-label">Model *</label>
                            <input type="text" class="form-control" id="model" name="model" 
                                   value="<?php echo htmlspecialchars($_POST['model'] ?? ''); ?>" required>
                            <div class="invalid-feedback">Please provide a model.</div>
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="variant" class="form-label">Variant</label>
                            <input type="text" class="form-control" id="variant" name="variant" 
                                   value="<?php echo htmlspecialchars($_POST['variant'] ?? ''); ?>">
                        </div>
                        
                        <!-- Vehicle Details -->
                        <div class="col-md-12 mb-4">
                            <h6><i class="fas fa-car me-2"></i>Vehicle Details</h6>
                            <hr>
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="body_style" class="form-label">Body Style</label>
                            <select class="form-control" id="body_style" name="body_style">
                                <option value="">Select Body Style</option>
                                <option value="Hatchback" <?php echo (isset($_POST['body_style']) && $_POST['body_style'] == 'Hatchback') ? 'selected' : ''; ?>>Hatchback</option>
                                <option value="Sedan" <?php echo (isset($_POST['body_style']) && $_POST['body_style'] == 'Sedan') ? 'selected' : ''; ?>>Sedan</option>
                                <option value="SUV" <?php echo (isset($_POST['body_style']) && $_POST['body_style'] == 'SUV') ? 'selected' : ''; ?>>SUV</option>
                                <option value="Coupe" <?php echo (isset($_POST['body_style']) && $_POST['body_style'] == 'Coupe') ? 'selected' : ''; ?>>Coupe</option>
                                <option value="Convertible" <?php echo (isset($_POST['body_style']) && $_POST['body_style'] == 'Convertible') ? 'selected' : ''; ?>>Convertible</option>
                                <option value="Pickup" <?php echo (isset($_POST['body_style']) && $_POST['body_style'] == 'Pickup') ? 'selected' : ''; ?>>Pickup</option>
                                <option value="Van" <?php echo (isset($_POST['body_style']) && $_POST['body_style'] == 'Van') ? 'selected' : ''; ?>>Van</option>
                                <option value="Wagon" <?php echo (isset($_POST['body_style']) && $_POST['body_style'] == 'Wagon') ? 'selected' : ''; ?>>Wagon</option>
                                <option value="Other" <?php echo (isset($_POST['body_style']) && $_POST['body_style'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="doors" class="form-label">Doors</label>
                            <select class="form-control" id="doors" name="doors">
                                <option value="">Select Doors</option>
                                <option value="2" <?php echo (isset($_POST['doors']) && $_POST['doors'] == '2') ? 'selected' : ''; ?>>2</option>
                                <option value="3" <?php echo (isset($_POST['doors']) && $_POST['doors'] == '3') ? 'selected' : ''; ?>>3</option>
                                <option value="4" <?php echo (isset($_POST['doors']) && $_POST['doors'] == '4') ? 'selected' : ''; ?>>4</option>
                                <option value="5" <?php echo (isset($_POST['doors']) && $_POST['doors'] == '5') ? 'selected' : ''; ?>>5</option>
                                <option value="6" <?php echo (isset($_POST['doors']) && $_POST['doors'] == '6') ? 'selected' : ''; ?>>6</option>
                            </select>
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="fuel_type" class="form-label">Fuel Type</label>
                            <select class="form-control" id="fuel_type" name="fuel_type">
                                <option value="">Select Fuel Type</option>
                                <option value="Petrol" <?php echo (isset($_POST['fuel_type']) && $_POST['fuel_type'] == 'Petrol') ? 'selected' : ''; ?>>Petrol</option>
                                <option value="Diesel" <?php echo (isset($_POST['fuel_type']) && $_POST['fuel_type'] == 'Diesel') ? 'selected' : ''; ?>>Diesel</option>
                                <option value="Hybrid" <?php echo (isset($_POST['fuel_type']) && $_POST['fuel_type'] == 'Hybrid') ? 'selected' : ''; ?>>Hybrid</option>
                                <option value="Electric" <?php echo (isset($_POST['fuel_type']) && $_POST['fuel_type'] == 'Electric') ? 'selected' : ''; ?>>Electric</option>
                                <option value="LPG" <?php echo (isset($_POST['fuel_type']) && $_POST['fuel_type'] == 'LPG') ? 'selected' : ''; ?>>LPG</option>
                            </select>
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="drive_type" class="form-label">Drive Type</label>
                            <select class="form-control" id="drive_type" name="drive_type">
                                <option value="">Select Drive Type</option>
                                <option value="FWD" <?php echo (isset($_POST['drive_type']) && $_POST['drive_type'] == 'FWD') ? 'selected' : ''; ?>>FWD</option>
                                <option value="RWD" <?php echo (isset($_POST['drive_type']) && $_POST['drive_type'] == 'RWD') ? 'selected' : ''; ?>>RWD</option>
                                <option value="AWD" <?php echo (isset($_POST['drive_type']) && $_POST['drive_type'] == 'AWD') ? 'selected' : ''; ?>>AWD</option>
                                <option value="4WD" <?php echo (isset($_POST['drive_type']) && $_POST['drive_type'] == '4WD') ? 'selected' : ''; ?>>4WD</option>
                            </select>
                        </div>
                        
                        <!-- Colors and Condition -->
                        <div class="col-md-12 mb-4">
                            <h6><i class="fas fa-palette me-2"></i>Colors and Condition</h6>
                            <hr>
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="exterior" class="form-label">Exterior Color</label>
                            <input type="text" class="form-control" id="exterior" name="exterior" 
                                   value="<?php echo htmlspecialchars($_POST['exterior'] ?? ''); ?>">
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="interior" class="form-label">Interior Color</label>
                            <input type="text" class="form-control" id="interior" name="interior" 
                                   value="<?php echo htmlspecialchars($_POST['interior'] ?? ''); ?>">
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="odometer" class="form-label">Odometer (km)</label>
                            <input type="number" class="form-control" id="odometer" name="odometer" 
                                   value="<?php echo htmlspecialchars($_POST['odometer'] ?? ''); ?>" min="0">
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" 
                                   value="<?php echo htmlspecialchars($_POST['price'] ?? ''); ?>" min="0" step="0.01">
                        </div>
                        
                        <!-- Additional Information -->
                        <div class="col-md-12 mb-4">
                            <h6><i class="fas fa-info me-2"></i>Additional Information</h6>
                            <hr>
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="stock" class="form-label">Stock Number</label>
                            <input type="text" class="form-control" id="stock" name="stock" 
                                   value="<?php echo htmlspecialchars($_POST['stock'] ?? ''); ?>">
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="vin" class="form-label">VIN Number</label>
                            <input type="text" class="form-control" id="vin" name="vin" 
                                   value="<?php echo htmlspecialchars($_POST['vin'] ?? ''); ?>">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="announcements" class="form-label">Announcements</label>
                            <textarea class="form-control" id="announcements" name="announcements" rows="2"><?php echo htmlspecialchars($_POST['announcements'] ?? ''); ?></textarea>
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="engine" class="form-label">Engine</label>
                            <input type="text" class="form-control" id="engine" name="engine" 
                                   value="<?php echo htmlspecialchars($_POST['engine'] ?? ''); ?>">
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="transmission" class="form-label">Transmission</label>
                            <input type="text" class="form-control" id="transmission" name="transmission" 
                                   value="<?php echo htmlspecialchars($_POST['transmission'] ?? ''); ?>">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="trade_value" class="form-label">Trade Value</label>
                            <input type="text" class="form-control" id="trade_value" name="trade_value" 
                                   value="<?php echo htmlspecialchars($_POST['trade_value'] ?? ''); ?>">
                        </div>
                        
                        <!-- Image Information -->
                        <div class="col-md-12 mb-4">
                            <h6><i class="fas fa-image me-2"></i>Image Information</h6>
                            <hr>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="image_base" class="form-label">Image Base Name *</label>
                            <input type="text" class="form-control" id="image_base" name="image_base" 
                                   value="<?php echo htmlspecialchars($_POST['image_base'] ?? ''); ?>" required
                                   placeholder="e.g., 30071">
                            <div class="form-text">Enter the base name for images (without extension). Images should be named: base_0.jpg, base_1.jpg, etc.</div>
                            <div class="invalid-feedback">Please provide an image base name.</div>
                        </div>
                        
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Add Car
                            </button>
                            <a href="manage-cars.php" class="btn btn-secondary">
                                <i class="fas fa-list me-2"></i>View All Cars
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Form validation is handled by Bootstrap
</script>

<?php require_once '../inc/admin-footer.php'; ?>
