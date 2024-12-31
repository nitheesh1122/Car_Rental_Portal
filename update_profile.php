<?php 
// update_profile.php

session_start();

// Check if User is Logged In
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$host = 'localhost';
$db = 'crs';
$user = 'root';
$password = '1234';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get POST data
    $user_id = $_SESSION['user_id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $mobile = $_POST['mobile'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $drivers_license = $_POST['drivers_license'];

    // Update the user profile
    $sql = "UPDATE users SET full_name = :full_name, username = :username, mobile = :mobile, dob = :dob, email = :email, gender = :gender, drivers_license = :drivers_license WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':full_name', $full_name);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':mobile', $mobile);
    $stmt->bindParam(':dob', $dob);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':drivers_license', $drivers_license);
    $stmt->bindParam(':id', $user_id);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Profile updated successfully!";
        $_SESSION['msg_type'] = "success"; // Set message type to success
    } else {
        $_SESSION['message'] = "Profile update failed. Please try again.";
        $_SESSION['msg_type'] = "danger"; // Set message type to danger
    }

    header("Location: profile.php"); // Redirect to the profile page
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
