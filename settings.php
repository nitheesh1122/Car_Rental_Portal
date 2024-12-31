<?php  
// settings.php

// **Start Session**
session_start();

// **Check if User is Logged In**
if (!isset($_SESSION['user_id'])) {
    // **User Not Logged In – Redirect to Login Page**
    header("Location: login.php");
    exit();
}

// **Retrieve User Information**
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - TECH RIDE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        .container {
            margin-top: 80px; /* Adjusted for fixed navbar */
        }
        footer {
            background-color: #000;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            position: relative;
            width: 100%;
            bottom: 0;
        }
        .card-title.text-danger {
            color: #dc3545 !important;
        }
    </style>
</head>
<body>
<header class="bg-dark text-white py-3">
    <div class="container">
        <h1 class="text-center">TECH RIDE</h1>
    </div>
</header>
    
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">TECH RIDE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="my_rentals.php">My Rentals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="settings.php">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    
<div class="container mt-5 pt-4">
    <h2>Account Settings</h2>
    <p>Manage your account settings below.</p>

    <!-- Edit Profile Section -->
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Edit Profile</h5>
            <p class="card-text">Update your personal information like name and contact details.</p>
            <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>

    <!-- Update Password Section -->
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Change Password</h5>
            <p class="card-text">Keep your account secure by changing your password regularly.</p>
            <a href="update_password.php" class="btn btn-warning">Change Password</a>
        </div>
    </div>

    <!-- Delete Account Section -->
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title text-danger">Delete Account</h5>
            <p class="card-text">Permanently delete your account. This action cannot be undone.</p>
            <a href="delete_account.php" class="btn btn-danger">Delete Account</a>
        </div>
    </div>

    <!-- Notification Preferences Section -->
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Notification Preferences</h5>
            <p class="card-text">Choose how you'd like to receive updates and notifications.</p>
            <a href="notification_preferences.php" class="btn btn-info">Manage Notifications</a>
        </div>
    </div>

    <!-- Privacy Settings Section -->
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Privacy Settings</h5>
            <p class="card-text">Control who can see your profile and manage other privacy-related options.</p>
            <a href="privacy_settings.php" class="btn btn-secondary">Manage Privacy</a>
        </div>
    </div>

    <!-- Activity Logs Section -->
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Account Activity</h5>
            <p class="card-text">Monitor your recent logins and account activity to ensure your account’s security.</p>
            <a href="activity_logs.php" class="btn btn-info">View Activity Logs</a>
        </div>
    </div>

    <!-- Language and Regional Settings Section -->
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Language and Regional Settings</h5>
            <p class="card-text">Set your preferred language and time zone for a better user experience.</p>
            <a href="language_settings.php" class="btn btn-secondary">Edit Language Settings</a>
        </div>
    </div>

    <!-- Download Account Data Section -->
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Download Account Data</h5>
            <p class="card-text">Download a copy of your data for your records or for legal purposes.</p>
            <a href="download_account_data.php" class="btn btn-dark">Download Data</a>
        </div>
    </div>

    <!-- Deactivate Account Section -->
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Deactivate Account</h5>
            <p class="card-text">Temporarily deactivate your account. You can reactivate it later by logging in.</p>
            <a href="deactivate_account.php" class="btn btn-warning">Deactivate Account</a>
        </div>
    </div>
</div>
    
<footer>
    <p>&copy; <?php echo date("Y"); ?> TECH RIDE. All rights reserved.</p>
    <div>
        <a href="faq.php" style="color: #ff6600;">FAQ'S</a> | 
            <a href="privacy_policy.php" style="color: #ff6600;">Privacy Policy</a> | 
            <a href="terms_of_service.php" style="color: #ff6600;">Terms of Service</a>
        </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
