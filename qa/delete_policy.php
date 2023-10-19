<?php
// Include your database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $sql = "DELETE FROM policies WHERE id = ?";
    // Execute the SQL statement with appropriate bindings
    // Handle errors and success messages
}
?>
