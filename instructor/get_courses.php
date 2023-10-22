<?php
// Include your database connection code

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sql = "SELECT * FROM course";
    // Execute the SQL statement and fetch the results

    // Example of fetching data (you may need to customize this based on your database library):
    // $courses = array();
    // while ($row = $result->fetch_assoc()) {
    //     $courses[] = $row;
    // }

    $user_id = $_POST["user_id"];

    // Check if instructor_id is a positive integer
    if (!is_numeric($user_id) || $user_id <= 0 || $user_id != intval($user_id)) {
        echo json_encode(["success" => false, "message" => "Instructor ID should be a positive integer."]);
        return;
    } 

    


    $courses = array(
        array(
            "id" => 1,
            "name" => "Introduction to Programming",
            "code" => "CS101",
            "schedule" => "MWF 9:00 AM - 10:30 AM",
            "user_id" => 1,
        ),
        array(
            "id" => 2,
            "name" => "Web Development Fundamentals",
            "code" => "WEB101",
            "schedule" => "TTH 2:00 PM - 3:30 PM",
            "user_id" => 2,
        ),
        array(
            "id" => 3,
            "name" => "Data Structures and Algorithms",
            "code" => "CS201",
            "schedule" => "MWF 1:00 PM - 2:30 PM",
            "user_id" => 3,
        ),
        // Add more courses as needed
    );
    

    echo json_encode(["success" => true, "courses" => $courses]);
}
?>
