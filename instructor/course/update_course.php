<?php
// Include your database connection code
require_once "../../DatabaseConnection.php"; // Replace with your database connection script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = $_POST["course_id"];
    $name = $_POST["name"];
    $code = $_POST["code"];
    $schedule = $_POST["schedule"];
    

    // Check if course_id is a positive integer
    if (!is_numeric($course_id) || $course_id <= 0 || $course_id != intval($course_id)) {
        echo json_encode(["success" => false, "message" => "Course ID should be a positive integer."]);
    }
    // Check if name and code meet the length requirement
    elseif (strlen($name) < 2 || strlen($name) > 255 || strlen($code) < 4 || strlen($code) > 10) {
        echo json_encode(["success" => false, "message" => "Name should be between 2 and 255 characters, and code should be between 4 and 10 characters."]);
    }
     else {
        // Update course details in the database
        $query = "UPDATE course SET name = ?, code = ?, schedule = ? WHERE id = ?";
        
        // Get the database connection
        $conn = DatabaseConnection::getConnection();
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $name, $code, $schedule, $course_id);
        $result = $stmt->execute();

        // Check for success or failure and return a response
        if ($result) {
            echo json_encode(["success" => true, "message" => "Course details updated successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to update course details. Please try again later."]);
        }
    }
}
?>
