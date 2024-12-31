<?php
// update_language_settings.php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'db_connection.php'; // Include your database connection

// Initialize variables and sanitize input
$language = isset($_POST['language']) ? trim($_POST['language']) : 'English';
$timezone = isset($_POST['timezone']) ? trim($_POST['timezone']) : 'UTC';

// Validate input values
$languages = ['English', 'Spanish', 'French', 'German', 'Chinese']; // Should match the options in language_settings.php
$timezones = [
    'UTC', 'America/New_York', 'America/Los_Angeles', 'Europe/London', 'Asia/Tokyo',
    'Asia/Kolkata', 'Australia/Sydney', 'Europe/Berlin', 'America/Sao_Paulo', // Add more as needed
];

if (!in_array($language, $languages)) {
    $_SESSION['error'] = "Invalid language selected.";
    header("Location: language_settings.php");
    exit();
}

if (!in_array($timezone, $timezones)) {
    $_SESSION['error'] = "Invalid timezone selected.";
    header("Location: language_settings.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Prepare and bind
$stmt = $conn->prepare("UPDATE users SET preferred_language = ?, timezone = ? WHERE id = ?");
$stmt->bind_param("ssi", $language, $timezone, $user_id);

if ($stmt->execute()) {
    $_SESSION['success'] = "Language and regional settings updated successfully.";
} else {
    $_SESSION['error'] = "Error updating language and regional settings. Please try again.";
}

$stmt->close();
$conn->close();

// Redirect back to language settings page
header("Location: language_settings.php");
exit();
?>
