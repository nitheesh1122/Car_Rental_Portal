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
    <title>Privacy Policy - TECH RIDE</title>
    
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
        <h1 class="mb-4">Privacy Policy</h1>
        <p class="lead">At TECH RIDE, we value your privacy. This policy outlines how we collect, use, and protect your information.</p>
        
        <h2>1. Information Collection</h2>
        <p>We collect information from you when you register on our site or fill out a form.</p>
        
        <h2>2. Information Use</h2>
        <p>Your information helps us improve our services and respond to your requests more effectively.</p>
        
        <h2>3. Data Protection</h2>
        <p>We implement a variety of security measures to maintain the safety of your personal information.</p>
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
