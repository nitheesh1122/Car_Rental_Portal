<?php 
// index.php
// **Start Session**
session_start();
// Prevent caching
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
// **Function to Sanitize Output**
function sanitize_output($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}
// **Session Timeout Implementation**
$inactive = 1800; // 30 minutes
if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
$_SESSION['timeout'] = time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- **Meta Tags for Responsiveness and Character Encoding** -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TECH RIDE - Car Rental Service</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- **Bootstrap CSS for Styling (Optional but Recommended)** -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
                /* Carousel Styles */
                .carousel {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            margin: 20px 0;
        }

        .slides {
            display: flex;
            transition: transform 0.5s ease;
        }

        .slide {
            min-width: 100%;
            transition: opacity 0.5s ease;
        }

        .carousel-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }
        .carousel-nav button {
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 24px;
            border-radius: 50%;
            transition: background-color 0.3s;
        }

        .carousel-nav button:hover {
            background-color: rgba(255, 255, 255, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            color: #333;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        header {
            background-color: #232323;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
            position: relative;
            z-index: 1000;
        }

        /* Logo Style */
        .logo img {
            height: 50px;
            width: auto;
            transition: transform 0.3s;
        }

        .logo img:hover {
            transform: scale(1.05);
        }

        nav ul {
            display: flex;
            list-style: none;
            transition: all 0.3s ease;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #ff6600;
        }

        .auth-buttons {
            margin-left: auto;
            display: flex;
            align-items: center;
        }

        .auth-buttons a {
            color: #fff;
            background-color: #ff6600;
            padding: 10px 20px;
            text-decoration: none;
            margin-left: 10px;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            position: relative;
            overflow: hidden;
        }

        .auth-buttons a::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background-color: rgba(255, 255, 255, 0.15);
            transform: translate(-50%, -50%) rotate(45deg);
            transition: all 0.75s ease;
            opacity: 0;
        }

        .auth-buttons a:hover::after {
            width: 0;
            height: 0;
            opacity: 1;
            transition: all 0.75s ease;
        }

        .auth-buttons a:hover {
            background-color: #e65c00;
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        /* Carousel Styles */
        .carousel {
            position: relative;
            width: 100%;
            height: 50vh;  /* Takes up half of the viewport height (50% of the page height) */
            overflow: hidden;
            background-color: #f0f0f0;  /* Optional background color */
        }

        .slides {
            display: flex;
            transition: transform 0.8s ease;
            height: 100%; /* Ensure the slides take up the full height of the carousel */
        }

        .slide {
            min-width: 100%;  /* Ensure the slide takes up the full width of the carousel */
            flex: 0 0 100%;  /* Ensures the image takes up the full width of the screen */
            display: flex;
            justify-content: center;  /* Center the image */
            align-items: center;
            position: relative;
        }

        .slide img {
            width: 100%; /* Make the image take up 100% of the slide width */
            height: auto; /* Keep the image aspect ratio intact */
            object-fit: cover; /* Cover the entire area of the slide */
            transition: transform 0.5s ease;
        }

        .slide:hover img {
            transform: scale(1.05);
        }

        .carousel-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
            z-index: 1;
        }

        #prev, #next {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 50%;
            transition: background-color 0.3s, transform 0.3s;
            font-size: 18px;
        }

        #prev:hover, #next:hover {
            background-color: rgba(0, 0, 0, 0.8);
            transform: scale(1.2);
        }

        /* Services Section */
        .services {
            padding: 60px 20px;
            text-align: center;
        }

        .services h3 {
            font-size: 36px;
            margin-bottom: 40px;
            position: relative;
            display: inline-block;
        }

        .services h3::after {
            content: '';
            width: 50%;
            height: 3px;
            background-color: #ff6600;
            position: absolute;
            left: 25%;
            bottom: -10px;
        }

        .service-cards {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }

        .service-cards .card {
            width: 30%;
            margin-bottom: 20px;
            padding: 20px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s, background-color 0.3s;
            background-color: #fff;
        }

        .service-cards .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
            background-color: #fffae6;
        }

        .service-cards .card img {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }

        .service-cards .card:hover img {
            transform: rotate(10deg);
        }

        .service-cards .card h4 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #232323;
        }

        .service-cards .card p {
            font-size: 16px;
            color: #777;
        }

        /* Featured Cars Section */
        .featured-cars {
            padding: 60px 20px;
            background-color: #f9f9f9;
        }

        .featured-cars h3 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 40px;
            position: relative;
            display: inline-block;
        }

        .featured-cars h3::after {
            content: '';
            width: 50%;
            height: 3px;
            background-color: #ff6600;
            position: absolute;
            left: 25%;
            bottom: -10px;
        }

        .car-list {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }

        .car-list .car {
            width: 30%;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #fff;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .car-list .car:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .car-list .car img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }

        .car-list .car:hover img {
            transform: scale(1.05);
        }

        .car-list .car h4 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #232323;
        }

        .car-list .car p {
            font-size: 16px;
            color: #777;
        }

        /* Footer Section */
        footer {
            background-color: #232323;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        .footer-content ul {
            list-style: none;
            display: flex;
            justify-content: center;
            padding-top: 10px;
            gap: 15px;
        }

        .footer-content ul li a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-content ul li a:hover {
            color: #ff6600;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .service-cards .card, .car-list .car {
                width: 45%;
            }
        }

        @media (max-width: 768px) {
            nav ul {
                flex-direction: column;
                background-color: #232323;
                position: absolute;
                top: 60px;
                right: 0;
                width: 200px;
                display: none;
                padding: 10px 0;
                border-radius: 0 0 10px 10px;
            }

            nav ul.active {
                display: flex;
            }

            nav ul li {
                margin: 10px 0;
                text-align: center;
            }

            .menu-toggle {
                display: block;
                cursor: pointer;
            }

            .auth-buttons {
                margin-left: 0;
                margin-top: 10px;
                flex-direction: column;
                align-items: center;
            }

            .auth-buttons a {
                margin: 5px 0;
            }

            .service-cards .card, .car-list .car {
                width: 100%;
            }
        }

        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .menu-toggle span {
            height: 3px;
            width: 25px;
            background-color: #fff;
            margin-bottom: 4px;
            border-radius: 2px;
            transition: all 0.3s;
        }

        /* Success Message Styling */
        .alert-success-custom {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: none;
            animation: fadeIn 0.5s forwards, fadeOut 0.5s 4.5s forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-20px); }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <a href="index.php"><img src="images/logo.jpg" alt="TECH RIDE"></a>
        </div>
        <nav>
            <!-- **Menu Toggle for Mobile View** -->
            <div class="menu-toggle" id="mobile-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Cars</a></li>
                <li><a href="rates.php">Pricing</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="help_and_support.php">Contact</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li><a href="dashboard.php">Dashboard</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <div class="auth-buttons">
            <?php if (isset($_SESSION['username'])): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="signup.php">Sign Up</a>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </header>

    <!-- **Display Success Message if Set** -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-success-custom" role="alert" id="success-alert">
            <?php echo sanitize_output($_SESSION['success']); ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <!-- Carousel Section -->
    <section class="carousel">
        <div class="slides">
            <div class="slide"><img src="images/new-2.jpg" alt="Slide 1"></div>
            <div class="slide"><img src="images/c6.jpg" alt="Slide 2"></div>
            <div class="slide"><img src="images/c3.jpg" alt="Slide 3"></div>
        </div>
        <div class="carousel-nav">
            <button id="prev">&#10094;</button>
            <button id="next">&#10095;</button>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services">
        <h3>Why Choose TECH RIDE?</h3>
        <div class="service-cards">
            <div class="card">
                <!-- **Image Source Correction:** Ensure the image file has an extension and is placed in the correct directory -->
                <img src="images/affordable.jpg" alt="Affordable Pricing">
                <h4>Affordable Prices</h4>
                <p>We offer the best car rental deals that fit your budget.</p>
            </div>
            <div class="card">
                <img src="images/secure.jpg" alt="Secure Bookings">
                <h4>Secure Bookings</h4>
                <p>Book confidently with our easy and secure payment options.</p>
            </div>
            <div class="card">
                <img src="images/flexible.jpg" alt="Flexible Options">
                <h4>Flexible Options</h4>
                <p>Pick the car of your choice, with flexible time and locations.</p>
            </div>
        </div>
    </section>

    <!-- Featured Cars Section -->
    <section class="featured-cars">
        <h3>Popular Cars for Rent</h3>
        <div class="car-list">
            <div class="car">
                <img src="images/sedan.jpg" alt="Sedan Car">
                <h4>Sedan</h4>
                <p>Comfortable and stylish for city rides.</p>
            </div>
            <div class="car">
                <img src="images/suv.jpg" alt="SUV Car">
                <h4>SUV</h4>
                <p>Spacious and powerful for road trips.</p>
            </div>
            <div class="car">
                <img src="images/hatchback.jpg" alt="Hatchback Car">
                <h4>Hatchback</h4>
                <p>Minimal yet cozy.</p>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="footer-content">
            <p>&copy; 2024 TECH RIDE. All rights reserved.</p>
            <ul class="socials">
                <li><a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                <li><a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i> Twitter</a></li>
                <li><a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i> Instagram</a></li>
            </ul>
        </div>
    </footer>

    <!-- JavaScript for Carousel and Mobile Menu -->
    <script>
        // **Carousel Functionality**
        const slides = document.querySelector('.slides');
        const slide = document.querySelectorAll('.slide');
        const prevBtn = document.getElementById('prev');
        const nextBtn = document.getElementById('next');

        let index = 0;
        const totalSlides = slide.length;

        function showNextSlide() {
            index = (index + 1) % totalSlides;
            slides.style.transform = `translateX(${-index * 100}%)`;
        }

        function showPrevSlide() {
            index = (index - 1 + totalSlides) % totalSlides;
            slides.style.transform = `translateX(${-index * 100}%)`;
        }

        nextBtn.addEventListener('click', showNextSlide);
        prevBtn.addEventListener('click', showPrevSlide);

        // **Auto Slide (Optional)**
        setInterval(showNextSlide, 7000); // Change slide every 7 seconds

        // **Mobile Menu Toggle**
        const mobileMenu = document.getElementById('mobile-menu');
        const navbar = document.getElementById('navbar');

        mobileMenu.addEventListener('click', () => {
            navbar.classList.toggle('active');
            mobileMenu.classList.toggle('open');
        });

        // **Display Success Alert and Auto-hide**
        window.addEventListener('DOMContentLoaded', (event) => {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                successAlert.style.display = 'block';
                // Animation handled via CSS
            }
        });
    </script>

    <!-- **Font Awesome for Social Icons (Optional)**
         Add this if you want to display social media icons.
         Replace or remove if not needed.
    -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- **Bootstrap JS Bundle (Optional for Additional Bootstrap Components)** -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
