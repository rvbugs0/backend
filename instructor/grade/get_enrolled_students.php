<?php
// Include your database connection code
require_once "../../DatabaseConnection.php"; // Replace with your database connection script

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $course_id = $_GET["course_id"];

    // Check if course_id is a positive integer
    if (!is_numeric($course_id) || $course_id <= 0 || $course_id != intval($course_id)) {
        echo json_encode(["success" => false, "message" => "Course ID should be a positive integer."]);
    } else {
        // Retrieve a list of all students enrolled in the given course
        $query = "SELECT u.id AS student_id, u.first_name, u.last_name
                  FROM course_enrollment ce
                  JOIN user u ON ce.student_id = u.id
                  WHERE ce.course_id = ?";

        // Get the database connection
        $conn = DatabaseConnection::getConnection();
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $course_id);
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
            echo json_encode(["success" => false, "message" => "Failed to retrieve enrolled students. Please try again later."]);
        }
    }
}
?>
