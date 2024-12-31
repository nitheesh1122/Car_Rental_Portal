<?php  
// language_settings.php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// **Fetch Current Language and Time Zone from Database**
// Replace with actual database queries
$current_language = 'English';
$current_timezone = 'UTC';
$languages = ['English', 'Spanish', 'French', 'German', 'Chinese'];
$timezones = [
    'UTC', 'America/New_York', 'America/Los_Angeles', 'Europe/London', 'Asia/Tokyo',
    // Add more time zones as needed
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Language and Regional Settings - TECH RIDE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        .container {
            margin-top: 80px;
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
<?php
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['success']) . '</div>';
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error']) . '</div>';
    unset($_SESSION['error']);
}
?>
    <h2>Language and Regional Settings</h2>
    <p>Customize your language and regional preferences for a better user experience.</p>
    
    <form action="update_language_settings.php" method="POST">
        <div class="mb-3">
            <label for="language" class="form-label">Preferred Language</label>
            <select class="form-select" id="language" name="language" required>
                <?php foreach ($languages as $language): ?>
                    <option value="<?php echo htmlspecialchars($language); ?>" <?php if ($language == $current_language) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($language); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="timezone" class="form-label">Time Zone</label>
            <select class="form-select" id="timezone" name="timezone" required>
                <?php foreach ($timezones as $tz): ?>
                    <option value="<?php echo htmlspecialchars($tz); ?>" <?php if ($tz == $current_timezone) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($tz); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-secondary">Save Settings</button>
    </form>
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
