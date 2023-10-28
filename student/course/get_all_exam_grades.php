<?php
require_once "../../DatabaseConnection.php"; // Include your database connection code


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $student_id = $_GET["student_id"];
    $course_id = $_GET["course_id"];

    // Check if student_id and course_id are positive integers
    if (!is_numeric($student_id) || $student_id <= 0 || $student_id != intval($student_id) || 
        !is_numeric($course_id) || $course_id <= 0 || $course_id != intval($course_id)) {
        echo json_encode(["success" => false, "message" => "Student ID and Course ID should be positive integers."]);
    } else {
        // Get the exam grades, feedback, and exam names for the student
        $conn = DatabaseConnection::getConnection(); // Replace with your database connection

        // Define the SQL query to retrieve exam grades, feedback, and exam names
        $sql = "SELECT e.exam_name, seg.grade, seg.instructor_feedback , e.max_score
                FROM student_exam_grade seg
                JOIN exam e ON seg.exam_id = e.id
                WHERE seg.student_id = ? AND e.course_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $student_id, $course_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch the data into an array
        $examData = array();
        while ($row = $result->fetch_assoc()) {
            $examData[] = $row;
        }

        if (empty($examData)) {
            echo json_encode(["success" => true, "exams" => []]);
        } else {
            echo json_encode(["success" => true, "exams" => $examData]);
        }

        $stmt->close();
        $conn->close();
    }
}
?>
