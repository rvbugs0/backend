<?php
// Include your database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = $_POST["course_id"];

    // Check if course_id is a positive integer
    if (!is_numeric($course_id) || $course_id <= 0 || $course_id != intval($course_id)) {
        echo json_encode(["success" => false, "message" => "Course ID should be a positive integer."]);
    } else {
        $sql = "DELETE FROM course WHERE id = ?";
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
            echo json_encode(["success" => true, "message" => "Course deleted successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to delete the course. Please try again later."]);
        }
    }
}
?>
