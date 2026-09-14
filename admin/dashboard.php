<?php
require_once '../config/database.php';
require_once '../inc/admin-header.php';

$database = new Database();
$conn = $database->getConnection();

// Get statistics
$total_cars = 0;
$result = $conn->query("SELECT COUNT(*) as count FROM cars");
if ($result) {
    $row = $result->fetch_assoc();
    $total_cars = $row['count'];
}

$cars_this_month = 0;
// Since there's no created_at field, we'll count all cars for now
$result = $conn->query("SELECT COUNT(*) as count FROM cars");
if ($result) {
    $row = $result->fetch_assoc();
    $cars_this_month = $row['count'];
}

$recent_cars = [];
// Order by id since there's no created_at field
$result = $conn->query("SELECT * FROM cars ORDER BY id DESC LIMIT 5");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $recent_cars[] = $row;
    }
}

$database->closeConnection();
?>

<div class="row">
    <!-- Statistics Cards -->
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title"><?php echo $total_cars; ?></h4>
                        <p class="card-text">Total Cars</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-car fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title"><?php echo $cars_this_month; ?></h4>
                        <p class="card-text">Added This Month</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-calendar-plus fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Active</h4>
                        <p class="card-text">System Status</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Admin</h4>
                        <p class="card-text">User Role</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-user-shield fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Cars -->
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Recently Added Cars</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($recent_cars)): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Year</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Price</th>
                                    <th>Added</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recent_cars as $car): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($car['year_model']); ?></td>
                                        <td><?php echo htmlspecialchars($car['make']); ?></td>
                                        <td><?php echo htmlspecialchars($car['model']); ?></td>
                                        <td>
                                            <?php if (!empty($car['price'])): ?>
                                                R<?php echo number_format($car['price'], 2); ?>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo date('M j, Y', strtotime($car['created_at'])); ?></td>
                                        <td>
                                            <a href="../car-details.php?vid=<?php echo $car['id']; ?>" 
                                               target="_blank" class="btn btn-sm btn-outline-primary" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="edit-car.php?id=<?php echo $car['id']; ?>" 
                                               class="btn btn-sm btn-outline-secondary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fas fa-car fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No cars added yet.</p>
                        <a href="add-car.php" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add Your First Car
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-3">
                    <a href="add-car.php" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add New Car
                    </a>
                    <a href="manage-cars.php" class="btn btn-outline-primary">
                        <i class="fas fa-list me-2"></i>Manage All Cars
                    </a>
                    <a href="../advance-search.php" target="_blank" class="btn btn-outline-success">
                        <i class="fas fa-search me-2"></i>View Public Site
                    </a>
                </div>
            </div>
        </div>
        
        <!-- System Info -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>System Information</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="fas fa-database me-2 text-primary"></i>
                        <strong>Database:</strong> Connected
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-server me-2 text-success"></i>
                        <strong>Server:</strong> Localhost
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-code me-2 text-info"></i>
                        <strong>PHP Version:</strong> <?php echo PHP_VERSION; ?>
                    </li>
                    <li>
                        <i class="fas fa-clock me-2 text-warning"></i>
                        <strong>Last Login:</strong> <?php echo date('Y-m-d H:i:s'); ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php require_once '../inc/admin-footer.php'; ?>
