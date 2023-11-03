<?php
// Include your database connection code
require_once "../../DatabaseConnection.php"; // Replace with your database connection script


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $exam_id = $_POST["exam_id"];
    $user_id = $_POST["user_id"];
    $schedule = $_POST["schedule"];
    $max_score = $_POST["max_score"];
    $exam_name = $_POST["exam_name"];
    $conn = DatabaseConnection::getConnection();

    // Check if exam_id is a positive integer
    if (!is_numeric($exam_id) || $exam_id <= 0 || $exam_id != intval($exam_id)) {
        echo json_encode(["success" => false, "message" => "Exam ID should be a positive integer."]);
    }
    // Check if user_id is a positive integer
    elseif (!is_numeric($user_id) || $user_id <= 0 || $user_id != intval($user_id)) {
        echo json_encode(["success" => false, "message" => "User ID should be a positive integer."]);
    }
    // Check if schedule is a valid date and time
    elseif (empty($schedule) ) {
        echo json_encode(["success" => false, "message" => "Exam schedule can not be empty."]);
    }
    // Check if max_score is a positive integer
    elseif (!is_numeric($max_score) || $max_score < 0 || $max_score != intval($max_score)) {
        echo json_encode(["success" => false, "message" => "Max score should be a positive integer."]);
    }
    // Check if exam_name meets the length requirement
    elseif (strlen($exam_name) < 1 || strlen($exam_name) > 255) {
        echo json_encode(["success" => false, "message" => "Exam name should be between 1 and 255 characters."]);
    } else {
        $sql = "UPDATE exam SET user_id = ?, schedule = ?, max_score = ?, exam_name = ? WHERE id = ?";
        // Execute the SQL statement with appropriate bindings
        // Handle errors and success messages

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isisi", $user_id, $schedule, $max_score, $exam_name, $exam_id);
        $result = $stmt->execute();

        if ($result) {
            echo json_encode(["success" => true, "message" => "Exam details updated successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to update Exam details. Please try again later."]);
        }
    }
}
?>
