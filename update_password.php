<?php 
// update_password.php

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
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Retrieve the current password from the database
    $sql = "SELECT password FROM users WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify the current password
    if (password_verify($current_password, $user['password'])) {
        // Check if the new password and confirm password match
        if ($new_password === $confirm_password) {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the database
            $sql = "UPDATE users SET password = :password WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':id', $user_id);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Password changed successfully!";
                $_SESSION['msg_type'] = "success"; // Set message type to success
            } else {
                $_SESSION['message'] = "Password change failed. Please try again.";
                $_SESSION['msg_type'] = "danger"; // Set message type to danger
            }
        } else {
            $_SESSION['message'] = "New passwords do not match.";
            $_SESSION['msg_type'] = "danger"; // Set message type to danger
        }
    } else {
        $_SESSION['message'] = "Current password is incorrect.";
        $_SESSION['msg_type'] = "danger"; // Set message type to danger
    }

    header("Location: change_password.php"); // Redirect back to change password page
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
