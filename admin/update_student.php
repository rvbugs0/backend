<?php
// Include your database connection code
include_once('../DatabaseConnection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    // Check if user_id is a positive integer
    if (!is_numeric($user_id) || $user_id <= 0 || $user_id != intval($user_id)) {
        echo json_encode(["success" => false, "message" => "User ID should be a positive integer."]);
    }
    // Check if first name and last name meet the length requirement
    elseif (strlen($first_name) < 2 || strlen($last_name) < 2) {
        echo json_encode(["success" => false, "message" => "First name and last name should be at least 2 characters long."]);
    } elseif (strlen($phone) != 10 || !ctype_digit($phone)) {
        $response["success"] = false;
        $response["message"] = "Phone should be exactly 10 digits and contain only numbers.";
    }
    // Check if the email is in a valid format
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "message" => "Invalid email format."]);
    }
    // Check if the password meets the length requirement
    else {
        
        // Validate and hash the password before updating
        // Get the database connection
        $conn = DatabaseConnection::getConnection();

        // Prepare the SQL statement to update the student's information
        $sql = "UPDATE user SET first_name = ?, last_name = ?, phone = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $first_name, $last_name, $phone, $email, $user_id);

        if ($stmt->execute()) {
            $response["success"] = true;
            $response["message"] = "Student information updated successfully.";
        } else {
            $response["success"] = false;
            $response["message"] = "Failed to update student information. ". $stmt->error;
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    }

    echo json_encode($response);
}
?>