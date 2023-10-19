<?php
// Include your database connection code

$response = array();
$sql = "SELECT * FROM policies";

// Execute the SQL statement
// Fetch and return the results as JSON
echo json_encode($response);
?>
