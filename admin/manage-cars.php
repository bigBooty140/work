<?php
require_once '../config/database.php';
require_once '../inc/admin-header.php';

$database = new Database();
$conn = $database->getConnection();

// Handle delete action
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $car_id = $_GET['delete'];
    
    $sql = "DELETE FROM cars WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $car_id);
    
    if ($stmt->execute()) {
        $message = "Car deleted successfully!";
        $message_type = "success";
    } else {
        $message = "Error deleting car: " . $stmt->error;
        $message_type = "danger";
    }
    $stmt->close();
    
    // Redirect to remove delete parameter
    header("Location: manage-cars.php?message=" . urlencode($message) . "&type=" . $message_type);
    exit();
}

// Handle search and pagination
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 20;
$offset = ($page - 1) * $per_page;

// Build query
$where_clause = "";
$params = [];
$types = "";

if (!empty($search)) {
    $where_clause = "WHERE (make LIKE ? OR model LIKE ? OR variant LIKE ? OR stock LIKE ? OR vin LIKE ? OR title LIKE ?)";
    $search_param = "%$search%";
    $params = array_fill(0, 6, $search_param);
    $types = str_repeat("s", 6);
}

// Get total count
$count_sql = "SELECT COUNT(*) as total FROM cars $where_clause";
$stmt = $conn->prepare($count_sql);
if (!empty($where_clause)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$total_result = $stmt->get_result();
$total_row = $total_result->fetch_assoc();
$total_cars = $total_row['total'];
$total_pages = ceil($total_cars / $per_page);

// Get cars
$sql = "SELECT * FROM cars $where_clause ORDER BY id DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
if (!empty($where_clause)) {
    $params[] = $per_page;
    $params[] = $offset;
    $types .= "ii";
    $stmt->bind_param($types, ...$params);
} else {
    $stmt->bind_param("ii", $per_page, $offset);
}
$stmt->execute();
$result = $stmt->get_result();

// Display message if set
if (isset($_GET['message'])) {
    $message = htmlspecialchars($_GET['message']);
    $message_type = htmlspecialchars($_GET['type'] ?? 'info');
}

$database->closeConnection();
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Manage Cars</h5>
                <div>
                    <a href="add-car.php" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i>Add New Car
                    </a>
                </div>
            </div>
            <div class="card-body">
                <?php if (isset($message)): ?>
                    <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show" role="alert">
                        <?php echo $message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <!-- Search Form -->
                <form method="GET" class="mb-4">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="search" 
                                   value="<?php echo htmlspecialchars($search); ?>" 
                                   placeholder="Search by make, model, variant, stock, or VIN...">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search me-1"></i>Search
                            </button>
                            <a href="manage-cars.php" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i>Clear
                            </a>
                        </div>
                    </div>
                </form>
                
                <!-- Results Summary -->
                <div class="mb-3">
                    <span class="text-muted">
                        Showing <?php echo $offset + 1; ?> to <?php echo min($offset + $per_page, $total_cars); ?> 
                        of <?php echo $total_cars; ?> cars
                    </span>
                </div>
                
                <!-- Cars Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Year</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Variant</th>
                                <th>Body</th>
                                <th>Price</th>
                                <th>Odometer</th>
                                <th>Stock</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo htmlspecialchars($row['year_model']); ?></td>
                                        <td><?php echo htmlspecialchars($row['make']); ?></td>
                                        <td><?php echo htmlspecialchars($row['model']); ?></td>
                                        <td><?php echo htmlspecialchars($row['variant']); ?></td>
                                        <td><?php echo htmlspecialchars($row['body_style']); ?></td>
                                        <td>
                                            <?php if (!empty($row['price'])): ?>
                                                R<?php echo number_format($row['price'], 2); ?>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($row['odometer'])): ?>
                                                <?php echo number_format($row['odometer']); ?> km
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['stock']); ?></td>
                                        <td>
                                            <?php if (!empty($row['image'])): ?>
                                                <img src="../image/<?php echo htmlspecialchars($row['image']); ?>_0.jpg" 
                                                     alt="Car image" style="width: 60px; height: 45px; object-fit: cover;"
                                                     onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'60\' height=\'45\' viewBox=\'0 0 60 45\'%3E%3Crect width=\'60\' height=\'45\' fill=\'%23ddd\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\' fill=\'%23999\' font-size=\'8\'%3ENo Image%3C/text%3E%3C/svg%3E';">
                                            <?php else: ?>
                                                <span class="text-muted">No image</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="../car-details.php?vid=<?php echo $row['id']; ?>" 
                                                   target="_blank" class="btn btn-outline-primary" title="View on site">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="edit-car.php?id=<?php echo $row['id']; ?>" 
                                                   class="btn btn-outline-secondary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-outline-danger" 
                                                        onclick="confirmDelete(<?php echo $row['id']; ?>)" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="11" class="text-center text-muted py-4">
                                        <?php if (!empty($search)): ?>
                                            No cars found matching your search.
                                        <?php else: ?>
                                            No cars found. <a href="add-car.php">Add your first car</a>.
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <?php if ($total_pages > 1): ?>
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <?php if ($page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>">
                                        Previous
                                    </a>
                                </li>
                            <?php endif; ?>
                            
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <?php if ($i == $page): ?>
                                    <li class="page-item active">
                                        <span class="page-link"><?php echo $i; ?></span>
                                    </li>
                                <?php else: ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endfor; ?>
                            
                            <?php if ($page < $total_pages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>">
                                        Next
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this car? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(carId) {
    document.getElementById('confirmDeleteBtn').href = 'manage-cars.php?delete=' + carId;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>

<?php require_once '../inc/admin-footer.php'; ?>
