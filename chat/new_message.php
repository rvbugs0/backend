<?php
// Include your database connection code
require_once "../DatabaseConnection.php"; // Replace with your database connection script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender_id = $_POST["sender_id"];
    $receiver_id = $_POST["receiver_id"];
    $content = $_POST["content"];

    // Check if sender_id, receiver_id, and content are valid
    if (
        !is_numeric($sender_id) || $sender_id <= 0 || $sender_id != intval($sender_id) ||
        !is_numeric($receiver_id) || $receiver_id <= 0 || $receiver_id != intval($receiver_id) ||
        empty($content)
    ) {
        echo json_encode(["success" => false, "message" => "Invalid sender ID, receiver ID, or content."]);
    } else {
        // Insert the message into the "message" table
        $query = "INSERT INTO message (sender_id, receiver_id, content) VALUES (?, ?, ?)";
        
        // Get the database connection
        $conn = DatabaseConnection::getConnection();
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iis", $sender_id, $receiver_id, $content);
        
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Message sent successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to send the message. ". $stmt->error]);
        }
    }
}
?>
