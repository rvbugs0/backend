<?php
// Include your database connection code
require_once '../../DatabaseConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["student_id"];
    $course_id = $_POST["course_id"];

    // Check if student_id and course_id are positive integers
    if (!is_numeric($student_id) || $student_id <= 0 || $student_id != intval($student_id) || 
        !is_numeric($course_id) || $course_id <= 0 || $course_id != intval($course_id)) {
        echo json_encode(["success" => false, "message" => "Student ID and Course ID should be positive integers."]);
    } else {
        $conn = DatabaseConnection::getConnection();

        $sql = "INSERT INTO course_enrollment (student_id, course_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $student_id, $course_id);  // "ii" represents two integers

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Student enrolled in the course successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to enroll the student in the course. Please try again later."]);
        }

        // Close the statement and the database connection
        $stmt->close();
        $conn->close();
    }
}
?>
