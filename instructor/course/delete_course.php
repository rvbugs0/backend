<?php
// Include your database connection code
require_once '../../DatabaseConnection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = $_POST["course_id"];
    $conn = DatabaseConnection::getConnection();

    // Check if course_id is a positive integer
    if (!is_numeric($course_id) || $course_id <= 0 || $course_id != intval($course_id)) {
        echo json_encode(["success" => false, "message" => "Course ID should be a positive integer."]);
        return;
    } else {
        $sql = "DELETE FROM course WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $course_id);  // "i" represents an integer
    
        $stmt->execute();
    
        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Course deleted successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to delete the course. ".$stmt->error]);
        }
    
        // Close the statement and the database connection
        $stmt->close();
        $conn->close();
    }

}
?>
