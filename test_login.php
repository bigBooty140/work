<?php
require_once 'config/database.php';

$database = new Database();
$conn = $database->getConnection();

// Test: Check if users table exists and has data
$result = $conn->query("SELECT COUNT(*) as count FROM users");
$row = $result->fetch_assoc();
echo "Total users in database: " . $row['count'] . "<br>";

// Test: Show recent users with their password hashes
$result = $conn->query("SELECT email, first_name, password FROM users LIMIT 5");
echo "<h3>Recent Users:</h3>";
echo "<table border='1'>";
echo "<tr><th>Email</th><th>Name</th><th>Password Hash</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
    echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
    echo "<td>" . htmlspecialchars($row['password']) . "</td>";
    echo "</tr>";
}
echo "</table>";

// Test: Password verification
echo "<h3>Test Password Verification:</h3>";
$test_password = "test123";
$test_hash = password_hash($test_password, PASSWORD_DEFAULT);
echo "Test password: $test_password<br>";
echo "Test hash: $test_hash<br>";

// Check if this hash exists
$stmt = $conn->prepare("SELECT email FROM users WHERE password = ?");
$stmt->bind_param("s", $test_hash);
$stmt->execute();
$result = $stmt->get_result();
echo "Users with this hash: " . $result->num_rows . "<br>";
?>
