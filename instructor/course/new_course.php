<?php
// Include your database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $code = $_POST["code"];
    $schedule = $_POST["schedule"];
    $user_id = $_POST["user_id"];

    // Check if name and code meet the length requirement
    if (strlen($name) < 2 || strlen($name) > 255 || strlen($code) < 4 || strlen($code) > 10) {
        echo json_encode(["success" => false, "message" => "Name should be between 2 and 255 characters, and code should be between 4 and 10 characters."]);
    }
    // Check if user_id is a positive integer
    elseif (!is_numeric($user_id) || $user_id <= 0 || $user_id != intval($user_id)) {
        echo json_encode(["success" => false, "message" => "User ID should be a positive integer."]);
    } else {


        $sql = "INSERT INTO course (name, code, schedule, user_id) VALUES (?, ?, ?, ?)";
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
            echo json_encode(["success" => true, "message" => "Course created successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to create the course. Please try again later."]);
        }
    }
}
?>
