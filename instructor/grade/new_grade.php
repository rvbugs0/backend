<?php
// Include your database connection code
require_once "../../DatabaseConnection.php"; // Replace with your database connection script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["student_id"];
    $exam_id = $_POST["exam_id"];
    $grade = $_POST["grade"];
    $instructor_feedback = $_POST["instructor_feedback"];

    if (!is_numeric($grade) || $grade < 0 || $grade != intval($grade)) {
        echo json_encode(["success" => false, "message" => "Grade can't be less than 0."]);
    } else if (
        !is_numeric($student_id) || $student_id <= 0 || $student_id != intval($student_id) ||
        !is_numeric($exam_id) || $exam_id <= 0 || $exam_id != intval($exam_id)
    ) {
        echo json_encode(["success" => false, "message" => "Student ID and Exam ID should be positive integers."]);
    } else {
          // Check if instructor_feedback is null and replace it with an empty string
          if (is_null($instructor_feedback)) {
            $instructor_feedback = "";
        }
        // Insert or update the grade and feedback into the student_exam_grade table
        $query = "INSERT INTO student_exam_grade (student_id, exam_id, grade, instructor_feedback)
                  VALUES (?, ?, ?, ?)
                  ON DUPLICATE KEY UPDATE grade = VALUES(grade), instructor_feedback = VALUES(instructor_feedback)";

        // Get the database connection
        $conn = DatabaseConnection::getConnection();
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iiis", $student_id, $exam_id, $grade, $instructor_feedback);
        $result = $stmt->execute();

        // Check for success or failure and return a response
        if ($result) {
            echo json_encode(["success" => true, "message" => "Grade and feedback provided successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to provide grade and feedback. ". $stmt->error ]);
        }
    }
}
?>