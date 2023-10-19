<?php
// Include your database connection code
require_once "../constants.php";



if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $role_id = ROLE_STUDENT;


    $sql = "SELECT * FROM users WHERE role_id = ?";
    // Execute the SQL statement with appropriate bindings
    // Fetch and return the results as JSON

    // Example of fetching data (you may need to customize this based on your database library):

    $users = array(
        array(
            "id" => 1,
            "first_name" => "John",
            "last_name" => "Doe",
            "email" => "john@example.com",
            "password" => password_hash("password1", PASSWORD_BCRYPT),
            // Replace with hashed password
            "role_id" => ROLE_STUDENT,
          
        ),
        array(
            "id" => 2,
            "first_name" => "Alice",
            "last_name" => "Smith",
            "email" => "alice@example.com",
            "password" => password_hash("password2", PASSWORD_BCRYPT),
            // Replace with hashed password
            "role_id" => ROLE_STUDENT,
            
        ),
        array(
            "id" => 3,
            "first_name" => "Bob",
            "last_name" => "Johnson",
            "email" => "bob@example.com",
            "password" => password_hash("password3", PASSWORD_BCRYPT),
            // Replace with hashed password
            "role_id" => ROLE_STUDENT,
            
        ),
        
    );


    // while ($row = $result->fetch_assoc()) {
    //     $users[] = $row;
    // }



    echo json_encode(["success" => true, "users" => $users]);

}
?>