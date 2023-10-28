<?php
// Include your database connection code
require_once "../DatabaseConnection.php"; // Replace with your database connection script

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Query the database to get the number of policies created by course code
    $query = "SELECT c.code AS course_code, COUNT(p.id) AS policy_count
              FROM course c
              LEFT JOIN policy p ON c.id = p.course_id
              GROUP BY c.code";
    
    // Get the database connection
    $conn = DatabaseConnection::getConnection();
    $result = $conn->query($query);

    if ($result) {
        $coursePolicies = [];

        while ($row = $result->fetch_assoc()) {
            $coursePolicies[] = $row;
        }

        echo json_encode(["success" => true, "course_policies" => $coursePolicies]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to retrieve course policies".$stmt->error]);
    }
}
?>
