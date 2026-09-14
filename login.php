<?php
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $database = new Database();
    $conn = $database->getConnection();
    
    // Check if login is email or username
    $sql = "SELECT id, first_name, email, password FROM users WHERE (email = ? OR first_name = ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $login, $login);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['first_name'];
            $_SESSION['user_email'] = $user['email'];
            
            // Return success for AJAX
            echo 'dashboard.php';
            exit();
        }
    }
    
    // Return error for AJAX
    echo 'error';
    exit();
}
?>
