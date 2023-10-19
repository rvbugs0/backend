<?php
// Include your database connection code

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $role_id = $_POST["role_id"];

    // Validation checks
    if (strlen($first_name) < 2 || strlen($last_name) < 2) {
        $response["success"] = false;
        $response["message"] = "First name and last name should be at least 2 characters each.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["success"] = false;
        $response["message"] = "Email should be in a valid email format.";
    } elseif (strlen($phone) != 10 || !ctype_digit($phone)) {
        $response["success"] = false;
        $response["message"] = "Phone should be exactly 10 digits and contain only numbers.";
    } elseif (strlen($_POST["password"]) < 8) {
        $response["success"] = false;
        $response["message"] = "Password should be at least 8 characters.";
    } elseif (!is_numeric($role_id) || $role_id <= 0) {
        $response["success"] = false;
        $response["message"] = "Role ID should be a positive integer.";
    } else {
        // $sql = "INSERT INTO users (first_name, last_name, phone, email, password, role_id) VALUES (?, ?, ?, ?, ?, ?)";

        // Execute the SQL statement with appropriate bindings
        // Handle errors and success messages
        // Assuming $success and $error are variables indicating success and failure
        $success = true;
        $randomValue = (rand(0, 1) == 1);

        if ($randomValue) {
            $success= true;
        } else {
            $success = false;
        }


        if ($success) {
            $response["success"] = true;
            $response["message"] = "Registration successful.";
        } else {
            $response["success"] = false;
            $response["message"] = "Registration failed. Please try again.";
        }
    }

    echo json_encode($response);
}
?>