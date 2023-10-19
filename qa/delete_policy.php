<?php
// Include your database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["policy_id"];

    if (!is_numeric($id) || $id <= 0 || $id != intval($id)) {
        echo json_encode(["success" => false, "message" => "Policy ID should be a positive integer."]);
        return;
    } 
    
    $sql = "DELETE FROM policies WHERE id = ?";
    // Execute the SQL statement with appropriate bindings
    // Handle errors and success messages


    $success = true;
    $randomValue = (rand(0, 1) == 1);

    if ($randomValue) {
        $success = true;
    } else {
        $success = false;
    }

    if ($success) {



        $response["success"] = true;
        $response["message"] = "Policy Deleted";

    } else {
        $response["success"] = false;
        $response["message"] = "Error Deleting Policy";
    }


    echo json_encode($response);
}
?>