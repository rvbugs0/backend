<?php
// Include your database connection code
require_once '../DatabaseConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["policy_id"];
    $title = $_POST["title"];
    $course_id = $_POST["course_id"];
    $description = $_POST["description"];
    $user_id = $_POST["user_id"];

    // Check if title and description meet the length requirement
    if (strlen($title) < 3 || strlen($description) < 3) {
        echo json_encode(["success" => false, "message" => "Title and description should be at least 3 characters long."]);
    }
    // Check if course_id is a positive integer
    elseif (!is_numeric($course_id) || $course_id <= 0 || $course_id != intval($course_id)) {
        echo json_encode(["success" => false, "message" => "Course ID should be a positive integer."]);
    }
    // Check if user_id is a positive integer
    elseif (!is_numeric($user_id) || $user_id <= 0 || $user_id != intval($user_id)) {
        echo json_encode(["success" => false, "message" => "User ID should be a positive integer."]);
    } else {
        // Get the database connection
        $conn = DatabaseConnection::getConnection();

        // Prepare and execute the SQL statement to update the policy
        $sql = "UPDATE policy SET title = ?, course_id = ?, description = ?, user_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisii", $title, $course_id, $description, $user_id, $id);

        // Execute the statement
        $stmt->execute();

        // Check if the update was successful
        $success = $stmt->affected_rows > 0;

        // Handle success and error messages
        $response = array();

        if ($success) {
            $response["success"] = true;
            $response["message"] = "Policy updated successfully.";
        } else {
            $response["success"] = false;
            $response["message"] = "Failed to update policy. Please try again later.";
        }

        echo json_encode($response);

        // Close the database connection
        $stmt->close();
        $conn->close();
    }
}
?>
