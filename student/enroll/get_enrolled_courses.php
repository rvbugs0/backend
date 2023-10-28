<?php
// Include your database connection code

require_once '../../DatabaseConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $student_id = $_GET["student_id"];

    // Check if student_id is a positive integer
    if (!is_numeric($student_id) || $student_id <= 0 || $student_id != intval($student_id)) {
        echo json_encode(["success" => false, "message" => "Student ID should be a positive integer."]);
    } else {
        $conn = DatabaseConnection::getConnection();

        // Modify the SQL statement to retrieve enrolled courses and instructor name
        $sql = "SELECT c.*, CONCAT(u.first_name, ' ', u.last_name) AS instructor
                FROM course c
                INNER JOIN course_enrollment ce ON c.id = ce.course_id
                INNER JOIN user u ON c.user_id = u.id
                WHERE ce.student_id = ?";
        


                // Example of fetching data (you may need to customize this based on your database library):
                // $courses =  array(
                //     array(
                //         "id" => 1,
                //         "name" => "Introduction to Programming",
                //         "code" => "CS101",
                //         "schedule" => "MWF 9:00 AM - 10:30 AM",
                //         "instructor" => "John Smith",
                //     ),
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $student_id);  // "i" represents an integer

        // Execute the statement
        if ($stmt->execute()) {
            // Fetch the results
            $result = $stmt->get_result();
            $courses = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode(["success" => true, "courses" => $courses]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to retrieve enrolled courses. Please try again later."]);
        }

        // Close the statement and the database connection
        $stmt->close();
        $conn->close();
    }
}
?>


