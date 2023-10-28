<?php
// Include your database connection code
require_once '../../DatabaseConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enrollment_id = $_POST["enrollment_id"];

    // Check if enrollment_id is a positive integer
    if (!is_numeric($enrollment_id) || $enrollment_id <= 0 || $enrollment_id != intval($enrollment_id)) {
        echo json_encode(["success" => false, "message" => "Enrollment ID should be a positive integer."]);
    } else {
        $conn = DatabaseConnection::getConnection();

        // Prepare the SQL statement
        $sql = "DELETE FROM course_enrollment WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $enrollment_id);  // "i" represents an integer

        // Execute the SQL statement
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Enrollment deleted successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to delete the enrollment. Please try again later."]);
        }

        // Close the statement and the database connection
        $stmt->close();
        $conn->close();
    }
}
?>
