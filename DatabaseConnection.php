<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class DatabaseConnection
{

    public static function getConnection()
    {

        $servername = "localhost:8889";
        $username = "root";
        $password = "password";
        $database = "eduflex";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}


// $db = new DatabaseConnection();
// $con = $db->getConnection();
