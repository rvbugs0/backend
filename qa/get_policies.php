<?php
// Include your database connection code
require_once '../DatabaseConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $user_id = $_GET["user_id"]; // You should validate and sanitize user input here

    // Check if user_id is a positive integer
    if (!is_numeric($user_id) || $user_id <= 0 || $user_id != intval($user_id)) {
        echo json_encode(["success" => false, "message" => "User ID should be a positive integer."]);
    } else {
        // Get the database connection
        $conn = DatabaseConnection::getConnection();

        // Prepare and execute the SQL statement to select policies for the user
        
        $sql = "SELECT * FROM policy WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        
        // Execute the statement
        $stmt->execute();

        // Fetch and return the results as JSON
        $result = $stmt->get_result();
        $policies = array();

        while ($row = $result->fetch_assoc()) {
            $policies[] = $row;
        }


        


        // array(
        //     "id" => 2,
        //     "title" => "Policy 2",
        //     "course_id" => 102,
        //     "description" => "This is the description for Policy 2.",
        //     "user_id" => 2,
        //     "timestamp" => "2023-10-19 14:30:00"
        // ),

        echo json_encode(["success" => true, "policies" => $policies]);

        // Close the database connection
        $stmt->close();
        $conn->close();
    }
}
?>

