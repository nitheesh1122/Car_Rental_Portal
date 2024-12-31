<?php
// update_notification_preferences.php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'db_connection.php'; // Include your database connection

// Initialize variables and sanitize input
$email_notifications = isset($_POST['email_notifications']) ? $_POST['email_notifications'] : 'disabled';
$sms_notifications = isset($_POST['sms_notifications']) ? $_POST['sms_notifications'] : 'disabled';
$push_notifications = isset($_POST['push_notifications']) ? $_POST['push_notifications'] : 'disabled';

// Validate input values
$valid_options = ['enabled', 'disabled'];
if (!in_array($email_notifications, $valid_options) ||
    !in_array($sms_notifications, $valid_options) ||
    !in_array($push_notifications, $valid_options)) {
    // Invalid input detected
    $_SESSION['error'] = "Invalid input for notification preferences.";
    header("Location: notification_preferences.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Prepare and bind
$stmt = $conn->prepare("UPDATE users SET email_notifications = ?, sms_notifications = ?, push_notifications = ? WHERE id = ?");
$stmt->bind_param("sssi", $email_notifications, $sms_notifications, $push_notifications, $user_id);

if ($stmt->execute()) {
    $_SESSION['success'] = "Notification preferences updated successfully.";
} else {
    $_SESSION['error'] = "Error updating notification preferences. Please try again.";
}

$stmt->close();
$conn->close();

// Redirect back to notification preferences page
header("Location: notification_preferences.php");
exit();
?>
