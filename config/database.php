<?php
// Database configuration
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "mfc";
    
    // --Live server configuration--
    // private $host = "sql105.infinityfree.com";
    // private $username = "if0_41440777";
    // private $password = "9dz5YU8vXnG";
    // private $dbname = "if0_41440777_mfc";
    
    public $conn;
    
    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    
    public function getConnection() {
        return $this->conn;
    }
    
    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>
