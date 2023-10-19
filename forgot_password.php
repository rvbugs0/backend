<?php
// Include your database connection code and other necessary functions

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Validate the email address here (e.g., check if it's in a valid format and exists in your database)

    // Check if the email exists in the database (replace 'users' with your actual users table name)
    $sql = "SELECT * FROM users WHERE email = ?";
    // Execute the SQL statement with the email as a parameter
    // Fetch the user's data
    $user = true;
    if ($user) {
        // Generate a unique token for password reset (you can use random_bytes or a similar method)
        $token = bin2hex(random_bytes(32));

        // Store the token and its expiration time in the database (e.g., in a 'password_reset' table)
        $expiration = date('Y-m-d H:i:s', strtotime('+1 hour')); // Set the expiration time
        $sql = "INSERT INTO password_reset (user_id, token, expiration) VALUES (?, ?, ?)";
        // Execute the SQL statement with appropriate bindings

        // Send a password reset email to the user with the token (you need to create a password reset email template)
        $reset_link = "https://example.com/reset_password.php?token=$token"; // Replace with your actual reset password page URL
        $subject = "Password Reset";
        $message = "Click the following link to reset your password: $reset_link";
        $headers = "From: eg@example.com";

        if (mail($email, $subject, $message, $headers)) {
            echo json_encode(["success" => true, "message" => "Password reset link sent to your email."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to send reset link. Please try again later."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Email address not found."]);
    }
}
?>
