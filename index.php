<?php
// Include your database connection code

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $role_id = $_POST["role"];

    // $sql = "INSERT INTO users (first_name, last_name, phone, email, password, role_id) VALUES (?, ?, ?, ?, ?, ?)";

    // Execute the SQL statement with appropriate bindings
    // Handle errors and success messages
    // Assuming $success and $error are variables indicating success and failure


    // 
    $success = true;

    if ($success) {
        $response["success"] = true;
        $response["message"] = "Registration successful.";
    } else {
        $response["success"] = false;
        $response["message"] = "Registration failed. Please try again.";
    }

    echo json_encode($response);
}
?>