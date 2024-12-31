<?php
// config.php
// **Enable Error Reporting for Debugging**
// **Note:** Disable these lines in a production environment to prevent exposing sensitive information.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// **Database Connection Parameters**
$host = 'localhost';
$dbUser = 'root';          // Change if different
$dbPassword = '1234';      // Change to your actual database password
$dbname = 'crs';           // Ensure this database exists

// **Create Database Connection**
$conn = new mysqli($host, $dbUser, $dbPassword, $dbname);

// **Check Database Connection**
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
