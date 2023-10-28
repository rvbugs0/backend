<?php
// Include your database connection code
require_once "../../DatabaseConnection.php"; // Replace with your database connection script



if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Get the selected exam ID from the form
    $exam_id = $_GET["exam_id"]; // Replace with the selected exam ID

    // Query to retrieve student grades and feedback for the selected exam
    $query = "SELECT u.id AS student_id, CONCAT(u.first_name, ' ', u.last_name) AS student_name, seg.grade,seg.exam_id, seg.instructor_feedback
              FROM student_exam_grade seg
              JOIN user u ON seg.student_id = u.id
              WHERE seg.exam_id = ?";
    $conn = DatabaseConnection::getConnection();
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $exam_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $studentData = $result->fetch_all(MYSQLI_ASSOC);

    if (count($studentData) > 0) {
        echo json_encode(["success" => true, "data" => $studentData]);
    } else {
        echo json_encode(["success" => false, "message" => "No data found for Exam ID: " . $exam_id]);
    }
}
?>