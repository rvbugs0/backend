<?php
// Include your database connection code
require_once "../DatabaseConnection.php"; // Replace with your database connection script

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Query the database to get the average grades of all students for every exam
    $query = "SELECT e.id AS exam_id, e.exam_name, AVG(seg.grade) AS average_grade
              FROM exam e
              LEFT JOIN student_exam_grade seg ON e.id = seg.exam_id
              GROUP BY e.id, e.exam_name";
    
    // Get the database connection
    $conn = DatabaseConnection::getConnection();
    $result = $conn->query($query);

    if ($result) {
        $examAverages = [];

        while ($row = $result->fetch_assoc()) {
            $examAverages[] = $row;
        }

        echo json_encode(["success" => true, "exam_averages" => $examAverages]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to retrieve exam averages. Please try again later."]);
    }
}
?>
