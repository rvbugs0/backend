<?php
// Include your database connection code
require_once "../DatabaseConnection.php"; // Replace with your database connection script

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Query the database to get the number of enrolled students in each course
    $query = "SELECT c.code AS course_code, c.name AS course_name, COUNT(ce.course_id) AS enrolled_students
              FROM course c
              LEFT JOIN course_enrollment ce ON c.id = ce.course_id
              GROUP BY c.id, c.name";
    
    // Get the database connection
    $conn = DatabaseConnection::getConnection();
    $result = $conn->query($query);

    if ($result) {
        $courses = [];

        while ($row = $result->fetch_assoc()) {
            $courses[] = $row;
        }

        echo json_encode(["success" => true, "courses" => $courses]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to retrieve course enrollment data. Please try again later."]);
    }
}
?>
