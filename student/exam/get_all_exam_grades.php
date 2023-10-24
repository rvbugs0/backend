<?php
// Include your database connection code

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $student_id = $_GET["student_id"];

    // Check if student_id is a positive integer
    if (!is_numeric($student_id) || $student_id <= 0 || $student_id != intval($student_id)) {
        echo json_encode(["success" => false, "message" => "Student ID should be a positive integer."]);
    } else {
        $sql = "SELECT exam.id AS exam_id, exam.exam_name, exam.schedule, exam.max_score, exam_grade.grade
                FROM exam
                LEFT JOIN student_exam_grade AS exam_grade ON exam.id = exam_grade.exam_id AND exam_grade.student_id = ?
                ORDER BY exam.id";

        // Execute the SQL statement with appropriate bindings

        // Example of fetching data (you may need to customize this based on your database library):
        $examsWithGrades =  array(
            array(
                "exam_id" => 1,
                "exam_name" => "Midterm Exam",
                "schedule" => "2023-10-20 09:00:00",
                "max_score" => 100,
                "grade" => 85,
                "instructor_feedback" => "Good job on this exam!",
            ),
            array(
                "exam_id" => 2,
                "exam_name" => "Final Exam",
                "schedule" => "2023-10-25 14:30:00",
                "max_score" => 90,
                "grade" => 92,
                "instructor_feedback" => "Excellent performance in the final exam!",
            ),
            array(
                "exam_id" => 3,
                "exam_name" => "Quiz 1",
                "schedule" => "2023-11-02 10:00:00",
                "max_score" => 80,
                "grade" => 78,
                "instructor_feedback" => "Work on improving your quiz performance.",
            ),
            // Add more exam results with instructor feedback as needed
        );
        
        
        // while ($row = $result->fetch_assoc()) {
        //     $examsWithGrades[] = $row;
        // }

        echo json_encode(["success" => true, "exams_with_grades" => $examsWithGrades]);
    }
}
?>
