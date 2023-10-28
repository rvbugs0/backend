<?php
// Include your database connection code
require_once '../../DatabaseConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];
    $schedule = $_POST["schedule"];
    $max_score = $_POST["max_score"];
    $exam_name = $_POST["exam_name"];
    $course_id = $_POST["course_id"];

    $conn = DatabaseConnection::getConnection();

    // Check if course_id is a positive integer
    if (!is_numeric($course_id) || $course_id <= 0 || $course_id != intval($course_id)) {
        echo json_encode(["success" => false, "message" => "Course ID should be a positive integer."]);
        return;  // Exit the script
    }

    // Check if user_id is a positive integer
    if (!is_numeric($user_id) || $user_id <= 0 || $user_id != intval($user_id)) {
        echo json_encode(["success" => false, "message" => "User ID should be a positive integer."]);
        return;  // Exit the script
    }

    // Check if schedule is a valid date and time
    if (empty($schedule) ) {
        echo json_encode(["success" => false, "message" => "Invalid schedule format. Use a valid date and time format."]);
        return;  // Exit the script
    }

    // Check if max_score is a positive integer
    if (!is_numeric($max_score) || $max_score < 0 || $max_score != intval($max_score)) {
        echo json_encode(["success" => false, "message" => "Max score should be a positive integer."]);
        return;  // Exit the script
    }

    // Check if exam_name meets the length requirement
    if (strlen($exam_name) < 1 || strlen($exam_name) > 255) {
        echo json_encode(["success" => false, "message" => "Exam name should be between 1 and 255 characters."]);
        return;  // Exit the script
    }

    $sql = "INSERT INTO exam (user_id, schedule, max_score, exam_name, course_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isisi", $user_id, $schedule, $max_score, $exam_name, $course_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Exam created successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to create the exam. ". $stmt->error]);
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}
?>
