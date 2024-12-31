<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service - TECH RIDE</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
            transition: background-color 0.5s ease;
        }
        .container {
            margin-top: 80px;
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .navbar {
            background-color: #000;
            transition: background-color 0.5s ease;
        }
        .navbar a {
            color: #fff;
            transition: color 0.3s;
        }
        .navbar a:hover {
            color: #ff6600;
        }

        footer {
            background-color: #000000;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: 30px;
            transition: background-color 0.5s ease;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">TECH RIDE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container mt-5 pt-4">
        <h1 class="mb-4">Terms of Service</h1>
        <p class="lead">Welcome to TECH RIDE! These terms of service outline the rules and regulations for using our website.</p>
        
        <h2>1. Acceptance of Terms</h2>
        <p>By accessing this website, you accept these terms of service in full.</p>
        
        <h2>2. Changes to Terms</h2>
        <p>We may revise these terms at any time. Any changes will be posted on this page.</p>
        
        <h2>3. User Responsibilities</h2>
        <p>Users are responsible for their actions while using our services.</p>
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
