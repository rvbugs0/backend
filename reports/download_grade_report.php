<?php
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
        // Set response headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="exam_averages.csv"');

        // Output headers
        echo "Exam ID,Exam Name,Average Grade\n";

        // Output data
        while ($row = $result->fetch_assoc()) {
            echo "{$row['exam_id']},{$row['exam_name']},{$row['average_grade']}\n";
        }
        exit;
    } else {
        echo json_encode(["success" => false, "message" => "Failed to retrieve exam averages. Please try again later."]);
    }
}
?>
