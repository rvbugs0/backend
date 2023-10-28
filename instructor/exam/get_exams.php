<?php
// Include your database connection code
require_once '../../DatabaseConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // $user_id = $_GET["user_id"];
    $course_id = $_GET["course_id"];

    // Check if course_id is a positive integer
    if (!is_numeric($course_id) || $course_id <= 0 || $course_id != intval($course_id)) {
        echo json_encode(["success" => false, "message" => "Course ID should be a positive integer."]);
        return;  // Exit the script
    }

    // // Check if user_id is a positive integer
    // if (!is_numeric($user_id) || $user_id <= 0 || $user_id != intval($user_id)) {
    //     echo json_encode(["success" => false, "message" => "User ID should be a positive integer."]);
    //     return;  // Exit the script
    // }

    $conn = DatabaseConnection::getConnection();

    $sql = "SELECT * FROM exam WHERE course_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $course_id);  // "i" represents an integer

    // Execute the statement
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $exams = array();

        while ($row = $result->fetch_assoc()) {
            $exams[] = $row;
        }

        echo json_encode(["success" => true, "exams" => $exams]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to fetch exams. Please try again later."]);
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}
?>
