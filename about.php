<?php 
// about_us.php

// **Start Session**
session_start();

// **Check if User is Logged In**
if (!isset($_SESSION['user_id'])) {
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
    <title>About Us - TECH RIDE</title>
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
        /* Timeline Styles */
        .timeline {
            position: relative;
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 0;
        }
        .timeline::after {
            content: '';
            position: absolute;
            width: 6px;
            background-color: #0d6efd;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -3px;
        }
        .timeline-item {
            padding: 20px 30px;
            position: relative;
            background-color: inherit;
            width: 50%;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .timeline-item.show {
            opacity: 1;
            transform: translateY(0);
        }
        .timeline-item.left {
            left: 0;
        }
        .timeline-item.right {
            left: 50%;
        }
        .timeline-item::after {
            content: '';
            position: absolute;
            width: 25px;
            height: 25px;
            right: -13px;
            background-color: white;
            border: 4px solid #0d6efd;
            top: 15px;
            border-radius: 50%;
            z-index: 1;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .timeline-item.right::after {
            left: -13px;
        }
        .timeline-item.left::after {
            left: -13px;
        }
        /* Hover Effects */
        .timeline-item:hover::after {
            background-color: #0d6efd;
            transform: scale(1.1);
        }
        /* Certificate Styles */
        .certificate {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .certificate:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .certificate img {
            width: 100%;
            height: auto;
            display: block;
        }
        .certificate h5 {
            margin-top: 10px;
            text-align: center;
            color: #333;
        }
        /* Team Member Styles */
        .team-member {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .team-member:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .team-member img {
            width: 100%;
            height: auto;
            display: block;
        }
        .team-member h5 {
            margin-top: 10px;
            text-align: center;
            color: #333;
        }
        .team-member p {
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
<header class="bg-dark text-white py-3">
    <div class="container">
        <h1 class="text-center">About Us</h1>
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
                    <a class="nav-link active" aria-current="page" href="about_us.php">About Us</a>
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
    <!-- Company Overview -->
    <section class="mb-5">
        <h2 class="text-center mb-4">Welcome to TECH RIDE</h2>
        <p class="lead text-center">At TECH RIDE, we strive to provide the best car rental services with a focus on customer satisfaction, reliability, and affordability. Our mission is to make your travel experiences seamless and enjoyable.</p>
    </section>

    <!-- Timeline Section -->
    <section class="mb-5">
        <h2 class="text-center mb-4">Our Timeline</h2>
        <div class="timeline">
            <!-- Timeline Item 1 -->
            <div class="timeline-item left animate__animated">
                <h5>2010</h5>
                <p>TECH RIDE was established to provide quality transportation services.</p>
            </div>
            <!-- Timeline Item 2 -->
            <div class="timeline-item right animate__animated">
                <h5>2012</h5>
                <p>We expanded our services to include vehicle rentals.</p>
            </div>
            <!-- Timeline Item 3 -->
            <div class="timeline-item left animate__animated">
                <h5>2015</h5>
                <p>Achieved ISO 9001 certification for our quality management system.</p>
            </div>
            <!-- Timeline Item 4 -->
            <div class="timeline-item right animate__animated">
                <h5>2018</h5>
                <p>Launched our user-friendly online platform for bookings.</p>
            </div>
            <!-- Timeline Item 5 -->
            <div class="timeline-item left animate__animated">
                <h5>2021</h5>
                <p>Introduced eco-friendly vehicle options to our fleet.</p>
            </div>
            <!-- Timeline Item 6 -->
            <div class="timeline-item right animate__animated">
                <h5>2023</h5>
                <p>Recognized as a leading transportation service in the region.</p>
            </div>
        </div>
    </section>

    <!-- Mission and Vision -->
    <section class="mb-5">
        <div class="row">
            <div class="col-md-6">
                <h3>Our Mission</h3>
                <p>To deliver reliable and affordable car rental services that exceed our customers' expectations through exceptional customer service and a diverse fleet of vehicles.</p>
            </div>
            <div class="col-md-6">
                <h3>Our Vision</h3>
                <p>To be the most trusted and customer-centric car rental company, leading the industry with innovation, sustainability, and excellence.</p>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section class="mb-5">
        <h2 class="text-center mb-4">Meet Our Team</h2>
        <div class="row">
            <!-- Team Member 1 -->
            <div class="col-md-4 mb-4">
                <div class="team-member animate__animated animate__fadeInUp">
                    <img src="path/to/team_member1.jpg" alt="John Doe" class="img-fluid">
                    <h5>John Doe</h5>
                    <p>Founder & CEO</p>
                </div>
            </div>
            <!-- Team Member 2 -->
            <div class="col-md-4 mb-4">
                <div class="team-member animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                    <img src="path/to/team_member2.jpg" alt="Jane Smith" class="img-fluid">
                    <h5>Jane Smith</h5>
                    <p>Chief Operations Officer</p>
                </div>
            </div>
            <!-- Team Member 3 -->
            <div class="col-md-4 mb-4">
                <div class="team-member animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                    <img src="path/to/team_member3.jpg" alt="Mike Johnson" class="img-fluid">
                    <h5>Mike Johnson</h5>
                    <p>Head of Marketing</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="mb-5">
        <h2 class="text-center mb-4">Our Services</h2>
        <div class="row">
            <!-- Service 1 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 animate__animated animate__zoomIn">
                    <img src="path/to/service1.jpg" class="card-img-top" alt="Wide Range of Vehicles">
                    <div class="card-body">
                        <h5 class="card-title">Wide Range of Vehicles</h5>
                        <p class="card-text">Choose from our extensive fleet of cars, SUVs, and luxury vehicles to suit your needs.</p>
                    </div>
                </div>
            </div>
            <!-- Service 2 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 animate__animated animate__zoomIn" style="animation-delay: 0.2s;">
                    <img src="path/to/service2.jpg" class="card-img-top" alt="24/7 Customer Support">
                    <div class="card-body">
                        <h5 class="card-title">24/7 Customer Support</h5>
                        <p class="card-text">Our dedicated support team is available around the clock to assist you with any queries.</p>
                    </div>
                </div>
            </div>
            <!-- Service 3 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 animate__animated animate__zoomIn" style="animation-delay: 0.4s;">
                    <img src="path/to/service3.jpg" class="card-img-top" alt="Easy Booking Process">
                    <div class="card-body">
                        <h5 class="card-title">Easy Booking Process</h5>
                        <p class="card-text">Book your vehicle quickly and effortlessly through our user-friendly online platform.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Achievements -->
    <section class="mb-5">
        <h2 class="text-center mb-4">Our Achievements</h2>
        <div class="row text-center">
            <div class="col-md-3 mb-4">
                <div class="card animate__animated animate__fadeInUp">
                    <div class="card-body">
                        <h3>500+</h3>
                        <p>Happy Customers</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                    <div class="card-body">
                        <h3>50+</h3>
                        <p>Vehicles in Fleet</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                    <div class="card-body">
                        <h3>10</h3>
                        <p>ISO Certifications</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card animate__animated animate__fadeInUp" style="animation-delay: 0.6s;">
                    <div class="card-body">
                        <h3>5</h3>
                        <p>Awards Won</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Company Certificates -->
    <section class="mb-5">
        <h2 class="text-center mb-4">Company Certificates</h2>
        <div class="row">
            <!-- Certificate 1 -->
            <div class="col-md-4 mb-4">
                <div class="certificate animate__animated animate__fadeInUp">
                    <img src="path/to/iso9001_certificate.jpg" alt="ISO 9001 Certificate">
                    <h5>ISO 9001: Quality Management</h5>
                </div>
            </div>
            <!-- Certificate 2 -->
            <div class="col-md-4 mb-4">
                <div class="certificate animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                    <img src="path/to/iso14001_certificate.jpg" alt="ISO 14001 Certificate">
                    <h5>ISO 14001: Environmental Management</h5>
                </div>
            </div>
            <!-- Certificate 3 -->
            <div class="col-md-4 mb-4">
                <div class="certificate animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                    <img src="path/to/iso45001_certificate.jpg" alt="ISO 45001 Certificate">
                    <h5>ISO 45001: Occupational Health & Safety</h5>
                </div>
            </div>
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
<!-- Include Intersection Observer Polyfill for older browsers -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intersection-observer/0.12.0/intersection-observer.min.js"></script>
<script>
    // Fade-in effect on scroll using Intersection Observer
    document.addEventListener('DOMContentLoaded', () => {
        const faders = document.querySelectorAll('.animate__animated');

        const appearOptions = {
            threshold: 0.1,
            rootMargin: "0px 0px -50px 0px"
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
</script>
</body>
</html>
