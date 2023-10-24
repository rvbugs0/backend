<?php
// Include your database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["student_id"];
    $exam_id = $_POST["exam_id"];
    $grade = $_POST["grade"];
    $instructor_feedback = $_POST["instructor_feedback"];



    if (!is_numeric($grade) || $grade < 0 || $grade != intval($grade)){

        echo json_encode(["success" => false, "message" => "Grade can't be less than 0."]);

    }  
    // Check if student_id and exam_id are positive integers
    else if (!is_numeric($student_id) || $student_id <= 0 || $student_id != intval($student_id) || 
        !is_numeric($exam_id) || $exam_id <= 0 || $exam_id != intval($exam_id)) {
        echo json_encode(["success" => false, "message" => "Student ID and Exam ID should be positive integers."]);
    } else {
        // Insert or update the grade and feedback into the student_exam_grade table
        $sql = "INSERT INTO student_exam_grade (student_id, exam_id, grade, instructor_feedback)
                VALUES (?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE grade = VALUES(grade), instructor_feedback = VALUES(instructor_feedback)";

        // Execute the SQL statement with appropriate bindings
        $success = true;
        $randomValue = (rand(0, 1) == 1);
    
        if ($randomValue) {
            $success = true;
        } else {
            $success = false;
        }
        // Check for success or failure and return a response
        if ($success) {
            echo json_encode(["success" => true, "message" => "Grade and feedback provided successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to provide grade and feedback. Please try again later."]);
        }
    }
}
?>
