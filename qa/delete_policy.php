<?php
// Include your database connection code
require_once '../DatabaseConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["policy_id"];

    // Check if policy_id is a positive integer
    if (!is_numeric($id) || $id <= 0 || $id != intval($id)) {
        echo json_encode(["success" => false, "message" => "Policy ID should be a positive integer."]);
        return;
    }

    // Get the database connection
    $conn = DatabaseConnection::getConnection();

    // Prepare and execute the SQL statement to delete the policy
    $sql = "DELETE FROM policy WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    // Execute the statement
    $success = $stmt->execute();

    // Check the number of affected rows
    $affectedRows = $stmt->affected_rows;

    // Handle success and error messages
    $response = array();

    if ($affectedRows > 0) {
        $response["success"] = true;
        $response["message"] = "Policy Deleted";
    } else {
        $response["success"] = false;
        $response["message"] = "Policy with ID $id not found or couldn't be deleted.";
    }

    echo json_encode($response);

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>