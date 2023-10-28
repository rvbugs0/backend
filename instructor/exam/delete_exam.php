<?php
// Include your database connection code
require_once '../../DatabaseConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $exam_id = $_POST["exam_id"];

    $conn = DatabaseConnection::getConnection();

    // Check if exam_id is a positive integer
    if (!is_numeric($exam_id) || $exam_id <= 0 || $exam_id != intval($exam_id)) {
        echo json_encode(["success" => false, "message" => "Exam ID should be a positive integer."]);
        return;  // Exit the script
    }

    $sql = "DELETE FROM exam WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $exam_id);  // "i" represents an integer

    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(["success" => true, "message" => "Exam deleted successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to delete the exam. ".$stmt->error]);
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}
?>
