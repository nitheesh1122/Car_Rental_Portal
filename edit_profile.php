<?php 
// edit_profile.php

session_start();

// Check if User is Logged In
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Retrieve User Information from Session
$username = $_SESSION['username'];
$full_name = $_SESSION['full_name'];
$mobile = $_SESSION['mobile'];
$dob = $_SESSION['dob'];
$email = $_SESSION['email'];
$gender = $_SESSION['gender'];
$drivers_license = $_SESSION['drivers_license'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - TECH RIDE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        footer {
            background-color: #000;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
<header class="bg-dark text-white py-3">
    <div class="container">
        <h1 class="text-center">Edit Profile</h1>
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
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5 pt-4">
    <h2>Your Profile Information</h2>
    <form action="update_profile.php" method="POST">
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo htmlspecialchars($full_name); ?>" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required readonly>
        </div>
        <div class="mb-3">
            <label for="mobile" class="form-label">Mobile Number</label>
            <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo htmlspecialchars($mobile); ?>" required>
        </div>
        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo htmlspecialchars($dob); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" id="gender" name="gender" required>
                <option value="Male" <?php echo ($gender === 'Male') ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo ($gender === 'Female') ? 'selected' : ''; ?>>Female</option>
                <option value="Other" <?php echo ($gender === 'Other') ? 'selected' : ''; ?>>Other</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="drivers_license" class="form-label">Driver's License</label>
            <input type="text" class="form-control" id="drivers_license" name="drivers_license" value="<?php echo htmlspecialchars($drivers_license); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
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
