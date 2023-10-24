<?php
// Include your database connection code

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $user_id = $_GET["user_id"];

    // Check if user_id is a positive integer
    if (!is_numeric($user_id) || $user_id <= 0 || $user_id != intval($user_id)) {
        echo json_encode(["success" => false, "message" => "User ID should be a positive integer."]);
    } else {
        $sql = "SELECT * FROM exam WHERE user_id = ?";
        // Execute the SQL statement with appropriate bindings

        // Example of fetching data (you may need to customize this based on your database library):
        // $exams = array();

        $exams = array(
            array(
                "id" => 1,
                "user_id" => 1,
                "schedule" => "2023-10-20 09:00:00",
                "max_score" => 100,
                "exam_name" => "Midterm Exam",
            ),
            array(
                "id" => 2,
                "user_id" => 2,
                "schedule" => "2023-10-25 14:30:00",
                "max_score" => 90,
                "exam_name" => "Final Exam",
            ),
            array(
                "id" => 3,
                "user_id" => 1,
                "schedule" => "2023-11-02 10:00:00",
                "max_score" => 80,
                "exam_name" => "Quiz 1",
            ),
            // Add more exams as needed
        );
        
        // while ($row = $result->fetch_assoc()) {
        //     $exams[] = $row;
        // }

        echo json_encode(["success" => true, "exams" => $exams]);
    }
}
?>
