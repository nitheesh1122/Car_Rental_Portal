<?php
// update_privacy_settings.php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'db_connection.php'; // Include your database connection

// Initialize variables and sanitize input
$profile_visibility = isset($_POST['profile_visibility']) && $_POST['profile_visibility'] === 'public' ? 'public' : 'private';
$search_visibility = isset($_POST['search_visibility']) && $_POST['search_visibility'] === 'enabled' ? 'enabled' : 'disabled';
$third_party_sharing = isset($_POST['third_party_sharing']) && $_POST['third_party_sharing'] === 'enabled' ? 'enabled' : 'disabled';

// Validate input values
$valid_profile_visibility = ['public', 'private'];
$valid_search_visibility = ['enabled', 'disabled'];
$valid_third_party_sharing = ['enabled', 'disabled'];

if (!in_array($profile_visibility, $valid_profile_visibility) ||
    !in_array($search_visibility, $valid_search_visibility) ||
    !in_array($third_party_sharing, $valid_third_party_sharing)) {
    // Invalid input detected
    $_SESSION['error'] = "Invalid input for privacy settings.";
    header("Location: privacy_settings.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Prepare and bind
$stmt = $conn->prepare("UPDATE users SET profile_visibility = ?, search_visibility = ?, third_party_sharing = ? WHERE id = ?");
$stmt->bind_param("sssi", $profile_visibility, $search_visibility, $third_party_sharing, $user_id);

if ($stmt->execute()) {
    $_SESSION['success'] = "Privacy settings updated successfully.";
} else {
    $_SESSION['error'] = "Error updating privacy settings. Please try again.";
}

$stmt->close();
$conn->close();

// Redirect back to privacy settings page
header("Location: privacy_settings.php");
exit();
?>
