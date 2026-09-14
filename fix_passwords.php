<?php
require_once 'config/database.php';

$database = new Database();
$conn = $database->getConnection();

echo "Fixing plain text passwords...<br>";

// Get all users with plain text passwords (short hashes)
$sql = "SELECT id, email, first_name, password FROM users WHERE LENGTH(password) < 20";
$result = $conn->query($sql);

$fixed_count = 0;
while ($row = $result->fetch_assoc()) {
    // Check if password looks like plain text (not starting with $2y$)
    if (substr($row['password'], 0, 3) !== '$2y') {
        // Hash the plain text password
        $hashed_password = password_hash($row['password'], PASSWORD_DEFAULT);
        
        // Update the user record
        $update_sql = "UPDATE users SET password = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("si", $hashed_password, $row['id']);
        $update_stmt->execute();
        
        echo "Fixed user: " . $row['email'] . "<br>";
        $fixed_count++;
    }
}

echo "Fixed $fixed_count users with plain text passwords.<br>";
echo "All passwords should now be properly hashed. Try logging in!<br>";
?>
