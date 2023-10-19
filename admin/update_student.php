<?php
// Include your database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];


    // Check if user_id is a positive integer
    if (!is_numeric($user_id) || $user_id <= 0 || $user_id != intval($user_id)) {
        echo json_encode(["success" => false, "message" => "User ID should be a positive integer."]);
    }
    // Check if first name and last name meet the length requirement
    elseif (strlen($first_name) < 2 || strlen($last_name) < 2) {
        echo json_encode(["success" => false, "message" => "First name and last name should be at least 2 characters long."]);
    }
    // Check if the email is in a valid format
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "message" => "Invalid email format."]);
    }
    // Check if the password meets the length requirement
    else {
        // Validate and hash the password before updating


        $sql = "UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE id = ?";
        // Execute the SQL statement with appropriate bindings
        // Handle errors and success messages

        $success = true;
        $randomValue = (rand(0, 1) == 1);

        if ($randomValue) {
            $success = true;
        } else {
            $success = false;
        }


        if ($success) {
            echo json_encode(["success" => true, "message" => "User details updated successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to update user details. Please try again later."]);
        }
    }
}
?>