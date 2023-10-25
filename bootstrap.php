<?php

// Include the DatabaseConnection class
require_once 'DatabaseConnection.php';

// Get the database connection object
$conn = DatabaseConnection::getConnection();

// Define your SQL statements here
$sql1 = "
CREATE TABLE `role` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `role_name` VARCHAR(255) NOT NULL
);

INSERT INTO `role` (`role_name`) VALUES ('Admin');
INSERT INTO `role` (`role_name`) VALUES ('Student');
INSERT INTO `role` (`role_name`) VALUES ('Instructor');
INSERT INTO `role` (`role_name`) VALUES ('Quality Assurance Officer');
INSERT INTO `role` (`role_name`) VALUES ('Program Coordinator');

CREATE TABLE `user` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `phone` CHAR(10) ,
    `password` VARCHAR(255) NOT NULL,
    `role_id` INT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(`email`),
    FOREIGN KEY (`role_id`) REFERENCES `role`(`id`)
);

CREATE TABLE `course` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `code` VARCHAR(10) NOT NULL,
    `schedule` VARCHAR(200),
    `user_id` INT NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`)
);

CREATE TABLE `policies` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `course_id` INT NOT NULL,
    `description` TEXT,
    `user_id` INT NOT NULL,
    `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`)
);

CREATE TABLE `exam` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `schedule` DATETIME,
    `max_score` INT,
    `exam_name` VARCHAR(255) NOT NULL,
    `course_id` INT NOT NULL,
    FOREIGN KEY (`course_id`) REFERENCES `course`(`id`)
);

CREATE TABLE `course_enrollment` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `student_id` INT NOT NULL,
    `course_id` INT NOT NULL,
    FOREIGN KEY (`student_id`) REFERENCES `user`(`id`),
    FOREIGN KEY (`course_id`) REFERENCES `course`(`id`)
);

CREATE TABLE `student_exam_grade` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `student_id` INT NOT NULL,
    `exam_id` INT NOT NULL,
    `grade` INT,
    `instructor_feedback` TEXT,
    FOREIGN KEY (`student_id`) REFERENCES `user`(`id`),
    FOREIGN KEY (`exam_id`) REFERENCES `exam`(`id`)
);";

// Execute SQL statements and print success or error messages
if ($conn->multi_query($sql1) === TRUE) {
    echo "Tables created successfully<br>";
} else {
    echo "Error creating tables: " . $conn->error . "<br>";
}

// Close the database connection when done
$conn->close();
?>