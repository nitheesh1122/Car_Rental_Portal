<?php
// db_connection.php

$servername = "localhost";
$username_db = "root";
$password_db = "1234";
$dbname = "crs";

// Create connection using MySQLi
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set to UTF-8
$conn->set_charset("utf8mb4");
?>
