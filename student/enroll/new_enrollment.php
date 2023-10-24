<?php
// Include your database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["student_id"];
    $course_id = $_POST["course_id"];

    // Check if student_id and course_id are positive integers
    if (!is_numeric($student_id) || $student_id <= 0 || $student_id != intval($student_id) || 
        !is_numeric($course_id) || $course_id <= 0 || $course_id != intval($course_id)) {
        echo json_encode(["success" => false, "message" => "Student ID and Course ID should be positive integers."]);
    } else {
        $sql = "INSERT INTO course_enrollment (student_id, course_id) VALUES (?, ?)";
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
            echo json_encode(["success" => true, "message" => "Student enrolled in the course successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to enroll the student in the course. Please try again later."]);
        }
    }
}
?>
