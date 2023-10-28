<?php
// Include your database connection code
require_once '../DatabaseConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $course_id = $_POST["course_id"];
    $description = $_POST["description"];
    $user_id = $_POST["user_id"];

    // Check if title and description meet the length requirement
    if (strlen($title) < 3 || strlen($description) < 3) {
        echo json_encode(["success" => false, "message" => "Title and description should be at least 3 characters long."]);
        return;
    }

    // Check if course_id is a positive integer
    if (!is_numeric($course_id) || $course_id <= 0 || $course_id != intval($course_id)) {
        echo json_encode(["success" => false, "message" => "Course ID should be a positive integer."]);
        return;
    }

    // Check if user_id is a positive integer
    if (!is_numeric($user_id) || $user_id <= 0 || $user_id != intval($user_id)) {
        echo json_encode(["success" => false, "message" => "User ID should be a positive integer."]);
        return;
    }

    // Get the database connection
    $conn = DatabaseConnection::getConnection();

    // Prepare and execute the SQL statement to insert a new policy
    $sql = "INSERT INTO policy (title, course_id, description, user_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisi", $title, $course_id, $description, $user_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Policy added successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to add policy. ". $stmt->error]);
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
