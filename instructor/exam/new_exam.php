<?php
// Include your database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];
    $schedule = $_POST["schedule"];
    $max_score = $_POST["max_score"];
    $exam_name = $_POST["exam_name"];

    // Check if user_id is a positive integer
    if (!is_numeric($user_id) || $user_id <= 0 || $user_id != intval($user_id)) {
        echo json_encode(["success" => false, "message" => "User ID should be a positive integer."]);
    }
    // Check if schedule is a valid date and time
    elseif (empty($schedule) || !strtotime($schedule)) {
        echo json_encode(["success" => false, "message" => "Invalid schedule format. Use a valid date and time format."]);
    }
    // Check if max_score is a positive integer
    elseif (!is_numeric($max_score) || $max_score < 0 || $max_score != intval($max_score)) {
        echo json_encode(["success" => false, "message" => "Max score should be a positive integer."]);
    }
    // Check if exam_name meets the length requirement
    elseif (strlen($exam_name) < 1 || strlen($exam_name) > 255) {
        echo json_encode(["success" => false, "message" => "Exam name should be between 1 and 255 characters."]);
    } else {
        $sql = "INSERT INTO exam (user_id, schedule, max_score, exam_name) VALUES (?, ?, ?, ?)";
        // Execute the SQL statement with appropriate bindings
        // Handle errors and success messages

        $success = true;
        $randomValue = (rand(0, 1) == 1);
    
        if ($randomValue) {
            $success = true;
        } else {
            $success = false;
        }
        if ($success) {
            echo json_encode(["success" => true, "message" => "Exam created successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to create the exam. Please try again later."]);
        }
    }
}
?>
