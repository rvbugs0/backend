<?php
require_once "../constants.php";
// Include your database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];

    // Check if user_id is a positive integer
    if (!is_numeric($user_id) || $user_id <= 0 || $user_id != intval($user_id)) {
        echo json_encode(["success" => false, "message" => "User ID should be a positive integer."]);
    } else {
        $sql = "DELETE FROM users WHERE id = ? and role_id = ?";
        // Execute the SQL statement with appropriate bindings
        // Handle errors and success messages
        $success = true;
        $randomValue = (rand(0, 1) == 1);

        if ($randomValue) {
            $success= true;
        } else {
            $success = false;
        }


        if ($success) {
            echo json_encode(["success" => true, "message" => "User deleted successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to delete user. Please try again later."]);
        }
    }
}
?>
