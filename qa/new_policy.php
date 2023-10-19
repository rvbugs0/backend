<?php
// Include your database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        echo json_encode(["success" => false, "message" => "USER ID should be a positive integer."]);
    } 
    
    
    
    else {


        $success = true;
        $randomValue = (rand(0, 1) == 1);

        if ($randomValue) {
            $success= true;
        } else {
            $success = false;
        }


        $sql = "INSERT INTO policies (title, course_id, description) VALUES (?, ?, ?)";
        // Execute the SQL statement with appropriate bindings
        // Handle errors and success messages
        if ($success) {
            echo json_encode(["success" => true, "message" => "Policy added successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to add policy. Please try again later."]);
        }
    }
}
?>
