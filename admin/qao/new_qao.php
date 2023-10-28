<?php
// Include your database connection code
include_once('../../DatabaseConnection.php');

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $role_id = 4; // Assuming Role ID 4 for QAO
    
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
    } else {
        // Get the database connection
        $conn = DatabaseConnection::getConnection();

        // Prepare the SQL statement to insert a new student
        $sql = "INSERT INTO user (first_name, last_name, phone, email, password, role_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $first_name, $last_name, $phone, $email, $password, $role_id);

        if ($stmt->execute()) {
            $response["success"] = true;
            $response["message"] = "Instructor added successfully.";
        } else {
            $response["success"] = false;
            $response["message"] = "Failed to add Instructor. ". $stmt->error;
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    }

    echo json_encode($response);
}
?>
