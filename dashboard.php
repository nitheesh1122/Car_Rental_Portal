<?php 
// dashboard.php

// **Start Session**
session_start();

// **Check if User is Logged In**
if (!isset($_SESSION['user_id'])) {
    // **User Not Logged In – Redirect to Login Page**
    header("Location: login.php");
    exit();
}

// **Retrieve User Information (Optional)**
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- **Meta Tags** -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - TECH RIDE</title>
    
    <!-- **Bootstrap CSS** -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- **Custom CSS** -->
    <style>
        body {
            background-color: #f8f9fa;
            overflow-x: hidden;
            transition: background-color 0.5s ease;
        }
        .container {
            margin-top: 80px;
            animation: fadeIn 1s ease-in-out;
        }
        /* **Animations** */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* **Header Styles** */
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

        /* **Button Enhancements** */
        .btn-custom {
            background-color: #ff6600;
            color: #fff;
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn-custom:hover {
            background-color: #e65c00;
            transform: scale(1.05);
        }

        /* **Card Enhancements** */
        .card {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        /* **Sidebar Enhancements (Optional) */
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            background-color: #232323;
            transition: left 0.3s;
            padding-top: 60px;
        }
        .sidebar.active {
            left: 0;
        }
        .sidebar a {
            padding: 15px 20px;
            display: block;
            color: #fff;
            text-decoration: none;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background-color: #ff6600;
        }
        .sidebar-toggle {
            position: fixed;
            top: 15px;
            left: 15px;
            font-size: 24px;
            color: #232323;
            cursor: pointer;
            z-index: 1001;
            transition: color 0.3s;
        }
        .sidebar-toggle:hover {
            color: #ff6600;
        }

        /* **Footer Styles** */
        footer {
            background-color: #000; /* Footer background color set to black */
            color: #fff; /* Text color */
            padding: 20px 0;
            text-align: center;
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: 30px;
            transition: background-color 0.5s ease;
        }

        /* **Social Icons Styles** */
        .social-icons {
            margin: 10px 0;
        }

        .social-icon {
            color: #ff6600; /* Icon color */
            font-size: 24px; /* Icon size */
            margin: 0 10px; /* Spacing between icons */
            transition: color 0.3s; /* Transition for hover effect */
        }

        .social-icon:hover {
            color: #e65c00; /* Darker color on hover */
        }

        /* **Responsive Adjustments** */
        @media (max-width: 768px) {
            /* Adjust container margin for smaller screens */
            .container {
                margin-top: 20px;
            }
        }
        
        .list-group-item a {
            color: #ff6600; /* Set link color */
            text-decoration: none; /* Remove underline */
            transition: color 0.3s, text-decoration 0.3s; /* Transition for hover effects */
        }

        .list-group-item a:hover {
            color: #e65c00; /* Darker shade on hover */
            text-decoration: underline; /* Underline on hover */
        }

        .list-group-item {
            border: none; /* Remove default border */
            background-color: transparent; /* Transparent background */
            padding: 15px; /* Add padding */
            transition: background-color 0.3s; /* Transition for hover effects */
        }

        .list-group-item:hover {
            background-color: rgba(255, 102, 0, 0.1); /* Light background on hover */
            border-radius: 5px; /* Rounded corners */
        }
    </style>
</head>
<body>
    <!-- **Sidebar Navigation (Optional) -->
    <div class="sidebar" id="sidebar">
        <a href="#">Profile</a>
        <a href="#">My Rentals</a>
        <a href="#">Settings</a>
        <a href="#">Support</a>
    </div>
    <div class="sidebar-toggle" id="sidebar-toggle">
        <i class="fas fa-bars"></i>
    </div>

    <!-- **Navigation Bar** -->
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
    
    <!-- **Dashboard Content** -->
    <div class="container mt-5 pt-4">
        <h1 class="mb-4">Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        <p class="lead">This is your dashboard. From here, you can manage your account, view rentals, and more.</p>
        
        <!-- **Action Buttons** -->
        <div class="mt-6">
            <a href="profile.php" class="btn btn-custom me-3 mb-3">Manage Profile</a>
            <a href="settings.php" class="btn btn-custom mb-3">Settings</a>
        </div>

        <!-- **Additional Content - Example Cards** -->
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Upcoming Rentals</h5>
                        <p class="card-text">View and manage your upcoming car rentals.</p>
                        <a href="#" class="btn btn-custom">View Rentals</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Rental History</h5>
                        <p class="card-text">Check your past car rentals and transactions.</p>
                        <a href="my_rentals.php" class="btn btn-custom">View History</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Support</h5>
                        <p class="card-text">Need help? Contact our support team.</p>
                        <a href="help_and_support.php" class="btn btn-custom">Contact Support</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- **Notifications Section** -->
        <div class="mt-5">
            <h2>Notifications</h2>
            <div class="alert alert-warning" role="alert">
                You have 2 new notifications! Check your email for details.
            </div>
        </div>

        <!-- **Quick Links Section** -->
        <div class="mt-5">
            <h2>Quick Links</h2>
            <ul class="list-group">
                <li class="list-group-item"><a href="profile.php">Profile</a></li>
                <li class="list-group-item"><a href="my_rentals.ph">My Rentals</a></li>
                <li class="list-group-item"><a href="settings.php">Settings</a></li>
                <li class="list-group-item"><a href="help_and_support.php">Help & Support</a></li>
            </ul>
        </div>
    </div>

    <!-- **Footer** -->
    <footer>
        <div>
            &copy; <?php echo date("Y"); ?> TECH RIDE. All rights reserved.
        </div>
        <div class="social-icons">
            <a href="images/fb.png" class="social-icon"><i class="fab fa-facebook"></i></a>
            <a href="images/x.png" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="images/ig.png" class="social-icon"><i class="fab fa-instagram"></i></a>
        </div>
        <div>
        <a href="faq.php" style="color: #ff6600;">FAQ'S</a> | 
            <a href="privacy_policy.php" style="color: #ff6600;">Privacy Policy</a> | 
            <a href="terms_of_service.php" style="color: #ff6600;">Terms of Service</a>
        </div>
    </footer>

    <!-- **Bootstrap JS and dependencies** -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    
    <!-- **Font Awesome Icons** -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- **Sidebar Toggle Script (Optional)** -->
    <script>
        document.getElementById("sidebar-toggle").onclick = function() {
            var sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("active");
        }
    </script>
</body>
</html>
