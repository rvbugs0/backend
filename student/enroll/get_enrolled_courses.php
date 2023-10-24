<?php
// Include your database connection code

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $student_id = $_GET["student_id"];

    // Check if student_id is a positive integer
    if (!is_numeric($student_id) || $student_id <= 0 || $student_id != intval($student_id)) {
        echo json_encode(["success" => false, "message" => "Student ID should be a positive integer."]);
    } else {
        $sql = "SELECT course.id, course.name, course.code, course.schedule FROM course
                JOIN course_enrollment ON course.id = course_enrollment.course_id
                WHERE course_enrollment.student_id = ?";
        // Execute the SQL statement with appropriate bindings

        // Example of fetching data (you may need to customize this based on your database library):
        $courses =  array(
            array(
                "id" => 1,
                "name" => "Introduction to Programming",
                "code" => "CS101",
                "schedule" => "MWF 9:00 AM - 10:30 AM",
                "instructor" => "John Smith",
            ),
            array(
                "id" => 2,
                "name" => "Web Development Fundamentals",
                "code" => "WEB101",
                "schedule" => "TTH 2:00 PM - 3:30 PM",
                "instructor" => "Alice Johnson",
            ),
            array(
                "id" => 3,
                "name" => "Data Structures and Algorithms",
                "code" => "CS201",
                "schedule" => "MWF 1:00 PM - 2:30 PM",
                "instructor" => "Bob Wilson",
            ),
            // Add more enrolled courses with instructor details as needed
        );
        
        // while ($row = $result->fetch_assoc()) {
        //     $courses[] = $row;
        // }

        echo json_encode(["success" => true, "courses" => $courses]);
    }
}
?>
