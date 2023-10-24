<?php
// Include your database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enrollment_id = $_POST["enrollment_id"];

    // Check if enrollment_id is a positive integer
    if (!is_numeric($enrollment_id) || $enrollment_id <= 0 || $enrollment_id != intval($enrollment_id)) {
        echo json_encode(["success" => false, "message" => "Enrollment ID should be a positive integer."]);
    } else {
        $sql = "DELETE FROM course_enrollment WHERE id = ?";
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
            echo json_encode(["success" => true, "message" => "Enrollment deleted successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to delete the enrollment. Please try again later."]);
        }
    }
}
?>
