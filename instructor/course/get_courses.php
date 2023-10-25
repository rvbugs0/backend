<?php
// Include your database connection code
require_once '../../DatabaseConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $user_id = $_GET["user_id"];

    // Check if user_id is a positive integer
    if (!is_numeric($user_id) || $user_id <= 0 || $user_id != intval($user_id)) {
        echo json_encode(["success" => false, "message" => "Instructor ID should be a positive integer."]);
        return;
    }

    // Get the database connection
    $conn = DatabaseConnection::getConnection();

    // Prepare and execute the SQL statement
    $sql = "SELECT * FROM course WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $courses = array();

    // Fetch course data
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }

    $stmt->close();
    $conn->close();

    echo json_encode(["success" => true, "courses" => $courses]);
}
?>
