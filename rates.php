<?php 
// rates.php

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
    <title>Rates - TECH RIDE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Animate.css for additional animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        body {
            background-color: #f8f9fa;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }
        .container {
            margin-top: 80px; /* Adjusted for fixed navbar */
        }
        footer {
            background-color: #000;
            color: #fff;
            padding: 30px 0;
            text-align: center;
            position: relative;
            width: 100%;
            bottom: 0;
        }
        /* Car Card Styles */
        .car-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }
        .car-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .car-card img {
            height: 200px;
            object-fit: cover;
        }
        /* Table Styles */
        .rates-table th, .rates-table td {
            vertical-align: middle;
            text-align: center;
        }
        /* Animation Delay */
        .animate__animated.animate__fadeInUp {
            animation-duration: 1s;
        }
        /* Responsive adjustments */
        @media (max-width: 767.98px) {
            .car-card img {
                height: 150px;
            }
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
                    <a class="nav-link" href="about.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="rates.php">Rates</a>
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
    <h2 class="text-center mb-4">Our Rates</h2>
    
    <!-- Car Types Section -->
    <div class="row">
        <!-- Sedan -->
        <div class="col-md-4 mb-4">
            <div class="card car-card animate__animated animate__fadeInUp">
                <img src="images/cars/sedan.jpg" class="card-img-top" alt="Sedan">
                <div class="card-body">
                    <h5 class="card-title">Sedan</h5>
                    <p class="card-text">Comfortable and efficient for city drives.</p>
                </div>
                <div class="card-footer">
                    <a href="#sedan-rates" class="btn btn-primary">View Rates</a>
                </div>
            </div>
        </div>
        
        <!-- SUV -->
        <div class="col-md-4 mb-4">
            <div class="card car-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                <img src="images/cars/suv.jpg" class="card-img-top" alt="SUV">
                <div class="card-body">
                    <h5 class="card-title">SUV</h5>
                    <p class="card-text">Spacious and powerful for all terrains.</p>
                </div>
                <div class="card-footer">
                    <a href="#suv-rates" class="btn btn-primary">View Rates</a>
                </div>
            </div>
        </div>
        
        <!-- Hatchback -->
        <div class="col-md-4 mb-4">
            <div class="card car-card animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                <img src="images/cars/hatchback.jpg" class="card-img-top" alt="Hatchback">
                <div class="card-body">
                    <h5 class="card-title">Hatchback</h5>
                    <p class="card-text">Compact and easy to maneuver.</p>
                </div>
                <div class="card-footer">
                    <a href="#hatchback-rates" class="btn btn-primary">View Rates</a>
                </div>
            </div>
        </div>
        
        <!-- Convertible -->
        <div class="col-md-4 mb-4">
            <div class="card car-card animate__animated animate__fadeInUp" style="animation-delay: 0.6s;">
                <img src="images/cars/convertible.jpg" class="card-img-top" alt="Convertible">
                <div class="card-body">
                    <h5 class="card-title">Convertible</h5>
                    <p class="card-text">Enjoy the open air with our convertibles.</p>
                </div>
                <div class="card-footer">
                    <a href="#convertible-rates" class="btn btn-primary">View Rates</a>
                </div>
            </div>
        </div>
        
        <!-- Luxury Cars -->
        <div class="col-md-4 mb-4">
            <div class="card car-card animate__animated animate__fadeInUp" style="animation-delay: 0.8s;">
                <img src="images/cars/luxury.jpg" class="card-img-top" alt="Luxury Cars">
                <div class="card-body">
                    <h5 class="card-title">Luxury Cars</h5>
                    <p class="card-text">Experience premium comfort and style.</p>
                </div>
                <div class="card-footer">
                    <a href="#luxury-rates" class="btn btn-primary">View Rates</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Rates Tables -->
    
    <!-- Sedan Rates -->
    <section id="sedan-rates" class="mb-5 animate__animated animate__fadeInUp">
        <h3 class="mb-3">Sedan Rates</h3>
        <div class="table-responsive">
            <table class="table table-bordered rates-table">
                <thead class="table-light">
                    <tr>
                        <th>Fuel Type</th>
                        <th>One Hour</th>
                        <th>One Day</th>
                        <th>Premium One Hour</th>
                        <th>Premium One Day</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Petrol</td>
                        <td>₹300</td>
                        <td>₹3,000</td>
                        <td>₹450</td>
                        <td>₹4,500</td>
                    </tr>
                    <tr>
                        <td>Diesel</td>
                        <td>₹350</td>
                        <td>₹3,500</td>
                        <td>₹525</td>
                        <td>₹5,250</td>
                    </tr>
                    <tr>
                        <td>Electric</td>
                        <td>₹400</td>
                        <td>₹4,000</td>
                        <td>₹600</td>
                        <td>₹6,000</td>
                    </tr>
                    <tr>
                        <td>Hybrid</td>
                        <td>₹350</td>
                        <td>₹3,500</td>
                        <td>₹525</td>
                        <td>₹5,250</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    
    <!-- SUV Rates -->
    <section id="suv-rates" class="mb-5 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
        <h3 class="mb-3">SUV Rates</h3>
        <div class="table-responsive">
            <table class="table table-bordered rates-table">
                <thead class="table-light">
                    <tr>
                        <th>Fuel Type</th>
                        <th>One Hour</th>
                        <th>One Day</th>
                        <th>Premium One Hour</th>
                        <th>Premium One Day</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Petrol</td>
                        <td>₹500</td>
                        <td>₹5,000</td>
                        <td>₹750</td>
                        <td>₹7,500</td>
                    </tr>
                    <tr>
                        <td>Diesel</td>
                        <td>₹600</td>
                        <td>₹6,000</td>
                        <td>₹900</td>
                        <td>₹9,000</td>
                    </tr>
                    <tr>
                        <td>Electric</td>
                        <td>₹700</td>
                        <td>₹7,000</td>
                        <td>₹1,050</td>
                        <td>₹10,500</td>
                    </tr>
                    <tr>
                        <td>Hybrid</td>
                        <td>₹600</td>
                        <td>₹6,000</td>
                        <td>₹900</td>
                        <td>₹9,000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    
    <!-- Hatchback Rates -->
    <section id="hatchback-rates" class="mb-5 animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
        <h3 class="mb-3">Hatchback Rates</h3>
        <div class="table-responsive">
            <table class="table table-bordered rates-table">
                <thead class="table-light">
                    <tr>
                        <th>Fuel Type</th>
                        <th>One Hour</th>
                        <th>One Day</th>
                        <th>Premium One Hour</th>
                        <th>Premium One Day</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Petrol</td>
                        <td>₹200</td>
                        <td>₹2,000</td>
                        <td>₹300</td>
                        <td>₹3,000</td>
                    </tr>
                    <tr>
                        <td>Diesel</td>
                        <td>₹250</td>
                        <td>₹2,500</td>
                        <td>₹375</td>
                        <td>₹3,750</td>
                    </tr>
                    <tr>
                        <td>Electric</td>
                        <td>₹300</td>
                        <td>₹3,000</td>
                        <td>₹450</td>
                        <td>₹4,500</td>
                    </tr>
                    <tr>
                        <td>Hybrid</td>
                        <td>₹250</td>
                        <td>₹2,500</td>
                        <td>₹375</td>
                        <td>₹3,750</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    
    <!-- Convertible Rates -->
    <section id="convertible-rates" class="mb-5 animate__animated animate__fadeInUp" style="animation-delay: 0.6s;">
        <h3 class="mb-3">Convertible Rates</h3>
        <div class="table-responsive">
            <table class="table table-bordered rates-table">
                <thead class="table-light">
                    <tr>
                        <th>Fuel Type</th>
                        <th>One Hour</th>
                        <th>One Day</th>
                        <th>Premium One Hour</th>
                        <th>Premium One Day</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Petrol</td>
                        <td>₹800</td>
                        <td>₹8,000</td>
                        <td>₹1,200</td>
                        <td>₹12,000</td>
                    </tr>
                    <tr>
                        <td>Diesel</td>
                        <td>₹900</td>
                        <td>₹9,000</td>
                        <td>₹1,350</td>
                        <td>₹13,500</td>
                    </tr>
                    <tr>
                        <td>Electric</td>
                        <td>₹1,000</td>
                        <td>₹10,000</td>
                        <td>₹1,500</td>
                        <td>₹15,000</td>
                    </tr>
                    <tr>
                        <td>Hybrid</td>
                        <td>₹900</td>
                        <td>₹9,000</td>
                        <td>₹1,350</td>
                        <td>₹13,500</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    
    <!-- Luxury Cars Rates -->
    <section id="luxury-rates" class="mb-5 animate__animated animate__fadeInUp" style="animation-delay: 0.8s;">
        <h3 class="mb-3">Luxury Cars Rates</h3>
        <div class="table-responsive">
            <table class="table table-bordered rates-table">
                <thead class="table-light">
                    <tr>
                        <th>Model</th>
                        <th>One Hour</th>
                        <th>One Day</th>
                        <th>Premium One Hour</th>
                        <th>Premium One Day</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Mercedes-Benz S-Class</td>
                        <td>₹2,000</td>
                        <td>₹15,000</td>
                        <td>₹3,000</td>
                        <td>₹22,500</td>
                    </tr>
                    <tr>
                        <td>BMW 7 Series</td>
                        <td>₹1,900</td>
                        <td>₹14,000</td>
                        <td>₹2,850</td>
                        <td>₹21,000</td>
                    </tr>
                    <tr>
                        <td>Audi A8</td>
                        <td>₹1,800</td>
                        <td>₹13,000</td>
                        <td>₹2,700</td>
                        <td>₹19,500</td>
                    </tr>
                    <tr>
                        <td>Lexus LS</td>
                        <td>₹1,700</td>
                        <td>₹12,000</td>
                        <td>₹2,550</td>
                        <td>₹18,000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> TECH RIDE. All rights reserved.</p>
    <div>
        <a href="faq.php" style="color: #ff6600; text-decoration: none;">FAQ'S</a> | 
        <a href="privacy_policy.php" style="color: #ff6600; text-decoration: none;">Privacy Policy</a> | 
        <a href="terms_of_service.php" style="color: #ff6600; text-decoration: none;">Terms of Service</a>
    </div>
</footer>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Include jQuery for easier DOM manipulation (optional, Bootstrap 5 doesn't require it) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Fade-in effect on scroll using Intersection Observer
    document.addEventListener('DOMContentLoaded', () => {
        const faders = document.querySelectorAll('.animate__animated');

        const appearOptions = {
            threshold: 0.1,
            rootMargin: "0px"
        };

        const appearOnScroll = new IntersectionObserver(function(entries, appearOnScroll) {
            entries.forEach(entry => {
                if (!entry.isIntersecting) {
                    return;
                } else {
                    entry.target.classList.add('animate__fadeInUp');
                    appearOnScroll.unobserve(entry.target);
                }
            });
        }, appearOptions);

        faders.forEach(fader => {
            appearOnScroll.observe(fader);
        });
    });

    // Optional: Smooth scroll to sections when clicking "View Rates"
    $(document).ready(function(){
        $('a[href^="#"]').on('click', function(event) {
            var target = this.hash;
            var $target = $(target);
            if ($target.length) {
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: $target.offset().top - 70 // Adjust for fixed navbar
                }, 800, function(){
                    window.location.hash = target;
                });
            }
        });
    });
</script>
</body>
</html>
