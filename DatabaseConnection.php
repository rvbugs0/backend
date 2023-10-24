<?php
// Database configuration
define("DB_HOST", "your_database_host");
define("DB_USER", "your_database_username");
define("DB_PASSWORD", "your_database_password");
define("DB_NAME", "your_database_name");

// Include the database configuration
require_once 'config.php';

// Function to establish a database connection
function connectToDatabase() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Check for database connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>
