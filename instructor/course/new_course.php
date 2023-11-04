<?php
// Include your database connection code
require_once '../../DatabaseConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $code = $_POST["code"];
    $schedule = $_POST["schedule"];
    $user_id = $_POST["user_id"];
    $course_content = isset($_POST["course_content"]) ? $_POST["course_content"] : ''; // Set course_content to empty string if not provided
    

    // Check if name and code meet the length requirement
    if (strlen($name) < 2 || strlen($name) > 255 || strlen($code) < 4 || strlen($code) > 10) {
        echo json_encode(["success" => false, "message" => "Name should be between 2 and 255 characters, and code should be between 4 and 10 characters."]);
    }
    // Check if user_id is a positive integer
    elseif (!is_numeric($user_id) || $user_id <= 0 || $user_id != intval($user_id)) {
        echo json_encode(["success" => false, "message" => "User ID should be a positive integer."]);
    } else {
        // Get the database connection
        $conn = DatabaseConnection::getConnection();

        // Prepare and execute the SQL statement
        $sql = "INSERT INTO course (name, code, schedule, user_id,course_content) VALUES (?, ?, ?, ?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssis", $name, $code, $schedule, $user_id, $course_content);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Course created successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to create the course. ". $stmt->error]);
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    }
}
?>
