<?php
// Include your database connection code

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validation checks, you can also validate the email format here

    if (empty($email) || empty($password)) {
        $response["success"] = false;
        $response["message"] = "Email and password are required fields.";
    } else {
        $sql = "SELECT id, password, role_id FROM users WHERE email = ?";

        // Execute the SQL statement with the email as a parameter
        // Fetch the user's data
        // Assuming you fetch the data into $user
        $success = true;
        $randomValue = (rand(0, 1) == 1);

        if ($randomValue) {
            $success= true;
        } else {
            $success = false;
        }

        if ($success) {
            $_SESSION["email"] = $email;
            

            $response["success"] = true;
            $response["message"] = "Login successful.";
            $response["role_id"] = 1;
        } else {
            $response["success"] = false;
            $response["message"] = "Invalid email or password.";
        }
    


        // if ($user && password_verify($password, $user["password"])) {
        //     $_SESSION["user_id"] = $user["id"];
        //     $_SESSION["role_id"] = $user["role_id"];

        //     $response["success"] = true;
        //     $response["message"] = "Login successful.";
        //     $response["role_id"] = $user["role_id"];
        // } else {
        //     $response["success"] = false;
        //     $response["message"] = "Invalid email or password.";
        // }
    }

    echo json_encode($response);
}
?>
