<?php
// Include your database connection code
require_once "../DatabaseConnection.php"; // Replace with your database connection script

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $student_id = $_GET["student_id"]; // Replace with how you get the student ID

    // Check if student_id is a positive integer
    if (!is_numeric($student_id) || $student_id <= 0 || $student_id != intval($student_id)) {
        echo json_encode(["success" => false, "message" => "Student ID should be a positive integer."]);
    } else {
        // Query the database to get a list of courses with enrollment status
        $query = "SELECT c.*, IF(ce.student_id IS NULL, 0, 1) AS enrolled
                  FROM course c
                  LEFT JOIN course_enrollment ce ON c.id = ce.course_id AND ce.student_id = ?";

        // Get the database connection
        $conn = DatabaseConnection::getConnection();
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            $coursesWithStatus = [];

            while ($row = $result->fetch_assoc()) {
                $coursesWithStatus[] = $row;
            }

            echo json_encode(["success" => true, "courses_with_status" => $coursesWithStatus]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to retrieve courses with enrollment status. Please try again later."]);
        }
    }
}
?>
