<?php
require_once '../config/database.php';
require_once '../inc/admin-header.php';

$database = new Database();
$conn = $database->getConnection();

$message = '';
$message_type = '';
$car_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($car_id === 0) {
    header('Location: manage-cars.php');
    exit();
}

// Get car data
$sql = "SELECT * FROM cars WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $car_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $message = "Car not found.";
    $message_type = "danger";
} else {
    $car = $result->fetch_assoc();
    $stmt->close();
    
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
        
        // Validate required fields
        if (empty($year_model) || empty($make) || empty($model) || empty($image_base)) {
            $message = "Please fill in all required fields (Year, Make, Model, and Image Base).";
            $message_type = "danger";
        } else {
            // Update database
            $sql = "UPDATE cars SET 
                title = ?, make = ?, model = ?, variant = ?, body_style = ?, year_model = ?, 
                seller = ?, doors = ?, odometer = ?, drive_type = ?, exterior = ?, stock = ?, 
                announcements = ?, engine = ?, transmission = ?, interior = ?, `fuel-type` = ?, 
                description = ?, vin = ?, trade_value = ?, image = ?
                WHERE id = ?";
            
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param(
                    "sssssssssssssssssi",
                    $title, $make, $model, $variant, $body_style, $year_model,
                    'MFC AUCTION HOUSE', $doors, $odometer, $drive_type, $exterior, $stock,
                    $announcements, '', '', $interior, $fuel_type, '', $vin, '', $image_base, $car_id
                );
                
                if ($stmt->execute()) {
                    $message = "Car updated successfully!";
                    $message_type = "success";
                    
                    // Reload updated data
                    $sql = "SELECT * FROM cars WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $car_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $car = $result->fetch_assoc();
                } else {
                    $message = "Error updating car: " . $stmt->error;
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
}

$database->closeConnection();
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Car</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show" role="alert">
                        <?php echo $message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($car)): ?>
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
                                       value="<?php echo htmlspecialchars($car['year_model']); ?>" required min="1900" max="2100">
                                <div class="invalid-feedback">Please provide a valid year.</div>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="make" class="form-label">Make *</label>
                                <select class="form-control" id="make" name="make" required>
                                    <option value="">Select Make</option>
                                    <?php foreach ($makes as $make_option): ?>
                                        <option value="<?php echo htmlspecialchars($make_option); ?>" 
                                                <?php echo ($car['make'] == $make_option) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($make_option); ?>
                                        </option>
                                    <?php endforeach; ?>
                                    <option value="Other" <?php echo ($car['make'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                                </select>
                                <input type="text" class="form-control mt-2" id="make_custom" name="make_custom" 
                                       placeholder="Enter custom make" value="<?php echo htmlspecialchars($car['make']); ?>"
                                       style="display:none;">
                                <div class="invalid-feedback">Please select or enter a make.</div>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="model" class="form-label">Model *</label>
                                <input type="text" class="form-control" id="model" name="model" 
                                       value="<?php echo htmlspecialchars($car['model']); ?>" required>
                                <div class="invalid-feedback">Please provide a model.</div>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="variant" class="form-label">Variant</label>
                                <input type="text" class="form-control" id="variant" name="variant" 
                                       value="<?php echo htmlspecialchars($car['variant']); ?>">
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
                                    <option value="Hatchback" <?php echo ($car['body_style'] == 'Hatchback') ? 'selected' : ''; ?>>Hatchback</option>
                                    <option value="Sedan" <?php echo ($car['body_style'] == 'Sedan') ? 'selected' : ''; ?>>Sedan</option>
                                    <option value="SUV" <?php echo ($car['body_style'] == 'SUV') ? 'selected' : ''; ?>>SUV</option>
                                    <option value="Coupe" <?php echo ($car['body_style'] == 'Coupe') ? 'selected' : ''; ?>>Coupe</option>
                                    <option value="Convertible" <?php echo ($car['body_style'] == 'Convertible') ? 'selected' : ''; ?>>Convertible</option>
                                    <option value="Pickup" <?php echo ($car['body_style'] == 'Pickup') ? 'selected' : ''; ?>>Pickup</option>
                                    <option value="Van" <?php echo ($car['body_style'] == 'Van') ? 'selected' : ''; ?>>Van</option>
                                    <option value="Wagon" <?php echo ($car['body_style'] == 'Wagon') ? 'selected' : ''; ?>>Wagon</option>
                                    <option value="Other" <?php echo ($car['body_style'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                                </select>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="doors" class="form-label">Doors</label>
                                <select class="form-control" id="doors" name="doors">
                                    <option value="">Select Doors</option>
                                    <option value="2" <?php echo ($car['doors'] == '2') ? 'selected' : ''; ?>>2</option>
                                    <option value="3" <?php echo ($car['doors'] == '3') ? 'selected' : ''; ?>>3</option>
                                    <option value="4" <?php echo ($car['doors'] == '4') ? 'selected' : ''; ?>>4</option>
                                    <option value="5" <?php echo ($car['doors'] == '5') ? 'selected' : ''; ?>>5</option>
                                    <option value="6" <?php echo ($car['doors'] == '6') ? 'selected' : ''; ?>>6</option>
                                </select>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="fuel_type" class="form-label">Fuel Type</label>
                                <select class="form-control" id="fuel_type" name="fuel_type">
                                    <option value="">Select Fuel Type</option>
                                    <option value="Petrol" <?php echo ($car['fuel_type'] == 'Petrol') ? 'selected' : ''; ?>>Petrol</option>
                                    <option value="Diesel" <?php echo ($car['fuel_type'] == 'Diesel') ? 'selected' : ''; ?>>Diesel</option>
                                    <option value="Hybrid" <?php echo ($car['fuel_type'] == 'Hybrid') ? 'selected' : ''; ?>>Hybrid</option>
                                    <option value="Electric" <?php echo ($car['fuel_type'] == 'Electric') ? 'selected' : ''; ?>>Electric</option>
                                    <option value="LPG" <?php echo ($car['fuel_type'] == 'LPG') ? 'selected' : ''; ?>>LPG</option>
                                </select>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="drive_type" class="form-label">Drive Type</label>
                                <select class="form-control" id="drive_type" name="drive_type">
                                    <option value="">Select Drive Type</option>
                                    <option value="FWD" <?php echo ($car['drive_type'] == 'FWD') ? 'selected' : ''; ?>>FWD</option>
                                    <option value="RWD" <?php echo ($car['drive_type'] == 'RWD') ? 'selected' : ''; ?>>RWD</option>
                                    <option value="AWD" <?php echo ($car['drive_type'] == 'AWD') ? 'selected' : ''; ?>>AWD</option>
                                    <option value="4WD" <?php echo ($car['drive_type'] == '4WD') ? 'selected' : ''; ?>>4WD</option>
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
                                       value="<?php echo htmlspecialchars($car['exterior']); ?>">
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="interior" class="form-label">Interior Color</label>
                                <input type="text" class="form-control" id="interior" name="interior" 
                                       value="<?php echo htmlspecialchars($car['interior']); ?>">
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="odometer" class="form-label">Odometer (km)</label>
                                <input type="number" class="form-control" id="odometer" name="odometer" 
                                       value="<?php echo htmlspecialchars($car['odometer']); ?>" min="0">
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" name="price" 
                                       value="<?php echo htmlspecialchars($car['price']); ?>" min="0" step="0.01">
                            </div>
                            
                            <!-- Additional Information -->
                            <div class="col-md-12 mb-4">
                                <h6><i class="fas fa-info me-2"></i>Additional Information</h6>
                                <hr>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="stock" class="form-label">Stock Number</label>
                                <input type="text" class="form-control" id="stock" name="stock" 
                                       value="<?php echo htmlspecialchars($car['stock']); ?>">
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="vin" class="form-label">VIN Number</label>
                                <input type="text" class="form-control" id="vin" name="vin" 
                                       value="<?php echo htmlspecialchars($car['vin']); ?>">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="announcements" class="form-label">Announcements</label>
                                <textarea class="form-control" id="announcements" name="announcements" rows="2"><?php echo htmlspecialchars($car['announcements']); ?></textarea>
                            </div>
                            
                            <!-- Image Information -->
                            <div class="col-md-12 mb-4">
                                <h6><i class="fas fa-image me-2"></i>Image Information</h6>
                                <hr>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="image_base" class="form-label">Image Base Name *</label>
                                <input type="text" class="form-control" id="image_base" name="image_base" 
                                       value="<?php echo htmlspecialchars($car['image']); ?>" required
                                       placeholder="e.g., 30071">
                                <div class="form-text">Enter the base name for images (without extension). Images should be named: base_0.jpg, base_1.jpg, etc.</div>
                                <div class="invalid-feedback">Please provide an image base name.</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Current Images</label>
                                <div class="d-flex gap-2">
                                    <?php for ($i = 0; $i <= 2; $i++): ?>
                                        <img src="../image/<?php echo htmlspecialchars($car['image']); ?>_<?php echo $i; ?>.jpg" 
                                             alt="Image <?php echo $i + 1; ?>" 
                                             style="width: 80px; height: 60px; object-fit: cover; border: 1px solid #ddd;"
                                             onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'80\' height=\'60\' viewBox=\'0 0 80 60\'%3E%3Crect width=\'80\' height=\'60\' fill=\'%23ddd\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\' fill=\'%23999\' font-size=\'8\'%3ENo Image%3C/text%3E%3C/svg%3E';">
                                    <?php endfor; ?>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Update Car
                                </button>
                                <a href="manage-cars.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Back to List
                                </a>
                                <a href="../car-details.php?vid=<?php echo $car['id']; ?>" 
                                   target="_blank" class="btn btn-outline-info">
                                    <i class="fas fa-eye me-2"></i>View on Site
                                </a>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
// Handle custom make input
document.getElementById('make').addEventListener('change', function() {
    const customInput = document.getElementById('make_custom');
    if (this.value === 'Other') {
        customInput.style.display = 'block';
        customInput.required = true;
    } else {
        customInput.style.display = 'none';
        customInput.required = false;
    }
});

// Show custom input if current make is not in dropdown
document.addEventListener('DOMContentLoaded', function() {
    const makeSelect = document.getElementById('make');
    const customInput = document.getElementById('make_custom');
    const currentValue = customInput.value;
    
    // Check if current make exists in dropdown
    let existsInDropdown = false;
    for (let option of makeSelect.options) {
        if (option.value === currentValue) {
            existsInDropdown = true;
            break;
        }
    }
    
    if (!existsInDropdown && currentValue) {
        makeSelect.value = 'Other';
        customInput.style.display = 'block';
        customInput.required = true;
    }
});

// Update form submission to use custom make if selected
document.querySelector('form').addEventListener('submit', function(e) {
    const makeSelect = document.getElementById('make');
    const customMake = document.getElementById('make_custom');
    
    if (makeSelect.value === 'Other' && customMake.value) {
        // Create hidden input for custom make
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'make';
        hiddenInput.value = customMake.value;
        this.appendChild(hiddenInput);
        makeSelect.disabled = true;
    }
});
</script>

<?php require_once '../inc/admin-footer.php'; ?>
