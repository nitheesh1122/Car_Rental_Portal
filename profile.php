<?php 
// profile.php

// Start Session
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

    // Retrieve User Information
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT full_name, username, mobile, dob, email, gender, drivers_license FROM users WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Store user data in session
    $_SESSION['full_name'] = $user['full_name'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['mobile'] = $user['mobile'];
    $_SESSION['dob'] = $user['dob'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['gender'] = $user['gender'];
    $_SESSION['drivers_license'] = $user['drivers_license'];

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Assign variables for display
$full_name = htmlspecialchars($user['full_name']);
$username = htmlspecialchars($user['username']);
$mobile = htmlspecialchars($user['mobile']);
$dob = htmlspecialchars($user['dob']);
$email = htmlspecialchars($user['email']);
$gender = htmlspecialchars($user['gender']);
$drivers_license = htmlspecialchars($user['drivers_license']);

// Check for message
$message = '';
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $msg_type = $_SESSION['msg_type'];
    unset($_SESSION['message']); // Clear the message after displaying it
    unset($_SESSION['msg_type']); // Clear the message type
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - TECH RIDE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        .container {
            margin-top: 50px;
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
        .btn-custom {
            background-color: #007bff; /* Bootstrap primary color */
            color: white;
            border: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #0056b3; /* Darker shade on hover */
            transform: scale(1.05); /* Slightly enlarge on hover */
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
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    
<div class="container mt-5 pt-4">
    <h2>Your Profile</h2>
    <?php if ($message): ?>
        <div class="alert alert-<?php echo $msg_type; ?>" role="alert">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <p><strong>Full Name:</strong> <?php echo $full_name; ?></p>
    <p><strong>Username:</strong> <?php echo $username; ?></p>
    <p><strong>Mobile:</strong> <?php echo $mobile; ?></p>
    <p><strong>Date of Birth:</strong> <?php echo $dob; ?></p>
    <p><strong>Email:</strong> <?php echo $email; ?></p>
    <p><strong>Gender:</strong> <?php echo $gender; ?></p>
    <p><strong>Drivers License:</strong> <?php echo $drivers_license; ?></p>
    
    <p> To Update your profile details Click here.</p>
    <div class="btn-group-vertical">
        <a href="settings.php" class="btn btn-custom mb-2">Edit your profile</a>

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
