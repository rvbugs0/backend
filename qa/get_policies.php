<?php
// Include your database connection code

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $user_id = $_GET["user_id"]; // You should validate and sanitize user input here

    // Check if user_id is a positive integer
    if (!is_numeric($user_id) || $user_id <= 0 || $user_id != intval($user_id)) {
        echo json_encode(["success" => false, "message" => "User ID should be a positive integer."]);
    } else {
        $sql = "SELECT * FROM policies WHERE user_id = ?";
        // Execute the SQL statement with appropriate bindings
        // Fetch and return the results as JSON

        // Example of fetching data (you may need to customize this based on your database library):
        $policies = array(
            array(
                "id" => 1,
                "title" => "Policy 1",
                "course_id" => 101,
                "description" => "This is the description for Policy 1.",
                "user_id" => 1,
                "timestamp" => "2023-10-19 12:00:00"
            ),
            array(
                "id" => 2,
                "title" => "Policy 2",
                "course_id" => 102,
                "description" => "This is the description for Policy 2.",
                "user_id" => 2,
                "timestamp" => "2023-10-19 14:30:00"
            ),
            array(
                "id" => 3,
                "title" => "Policy 3",
                "course_id" => 103,
                "description" => "This is the description for Policy 3.",
                "user_id" => 1,
                "timestamp" => "2023-10-19 15:45:00"
            ),
            // Add more policies as needed
        );
        
        // while ($row = $result->fetch_assoc()) {
        //     $policies[] = $row;
        // }

        echo json_encode(["success" => true, "policies" => $policies]);
    }
}
?>
