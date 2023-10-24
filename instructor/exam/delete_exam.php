<?php
// Include your database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $exam_id = $_POST["exam_id"];

    // Check if exam_id is a positive integer
    if (!is_numeric($exam_id) || $exam_id <= 0 || $exam_id != intval($exam_id)) {
        echo json_encode(["success" => false, "message" => "Exam ID should be a positive integer."]);
    } else {
        $sql = "DELETE FROM exam WHERE id = ?";


        $success = true;
        $randomValue = (rand(0, 1) == 1);
    
        if ($randomValue) {
            $success = true;
        } else {
            $success = false;
        }
        // Execute the SQL statement with appropriate bindings
        // Handle errors and success messages
        if ($success) {
            echo json_encode(["success" => true, "message" => "Exam deleted successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to delete the exam. Please try again later."]);
        }
    }
}
?>
