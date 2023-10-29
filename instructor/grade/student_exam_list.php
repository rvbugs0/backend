<?php
// Include your database connection code

require_once "../../DatabaseConnection.php"; // Replace with your database connection script

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $exam_id = $_GET["exam_id"];

    // Check if exam_id is a positive integer
    if (!is_numeric($exam_id) || $exam_id <= 0 || $exam_id != intval($exam_id)) {
        echo json_encode(["success" => false, "message" => "Exam ID should be a positive integer."]);
    } else {
        // Retrieve a list of students who are enrolled in the course associated with the given exam ID
        // and their grades for the specified exam
        $query = "SELECT u.id AS student_id, CONCAT(u.first_name, ' ', u.last_name) AS student_name, seg.exam_id,seg.grade,seg.instructor_feedback
                  FROM student_exam_grade seg
                  JOIN user u ON seg.student_id = u.id
                  WHERE seg.exam_id = ?";

        // Get the database connection
        $conn = DatabaseConnection::getConnection();
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $exam_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check for success or failure and return a response
        if ($result) {
            $students = [];
            while ($row = $result->fetch_assoc()) {
                $students[] = $row;
            }

            echo json_encode(["success" => true, "students" => $students]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to retrieve student grades. Please try again later."]);
        }
    }
}
?>
