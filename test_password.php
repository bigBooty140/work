<?php
// Test password hashing and verification
$password = "test123";
echo "Testing password: $password<br>";

// Hash the password
$hashed = password_hash($password, PASSWORD_DEFAULT);
echo "Hashed password: $hashed<br>";

// Verify the password
$verify = password_verify($password, $hashed);
echo "Verification result: " . ($verify ? 'SUCCESS' : 'FAILED') . "<br>";

// Test with wrong password
$wrong_password = "wrong123";
$verify_wrong = password_verify($wrong_password, $hashed);
echo "Wrong password verification: " . ($verify_wrong ? 'SUCCESS' : 'FAILED') . "<br>";

echo "<hr>";

// Check database users
require_once 'config/database.php';
$database = new Database();
$conn = $database->getConnection();

$result = $conn->query("SELECT email, password FROM users LIMIT 3");
echo "Users in database:<br>";
while ($row = $result->fetch_assoc()) {
    echo "Email: " . $row['email'] . "<br>";
    echo "Hash: " . $row['password'] . "<br>";
    
    // Test verification with test123
    $test_verify = password_verify("test123", $row['password']);
    echo "Test123 verification: " . ($test_verify ? 'SUCCESS' : 'FAILED') . "<br><hr>";
}
?>
