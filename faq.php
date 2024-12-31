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
    <title>FAQs - TECH RIDE</title>
    
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
        
        .faq-item {
            margin-bottom: 20px;
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
        <h1 class="mb-4">Frequently Asked Questions (FAQs)</h1>

        <div class="faq-item">
            <h5>1. What is TECH RIDE?</h5>
            <p>TECH RIDE is a car rental service that provides a wide range of vehicles for personal and business use.</p>
        </div>
        
        <div class="faq-item">
            <h5>2. How can I make a reservation?</h5>
            <p>You can make a reservation through our website by selecting your desired vehicle and filling out the booking form.</p>
        </div>
        
        <div class="faq-item">
            <h5>3. What documents do I need to rent a car?</h5>
            <p>You need a valid driver's license, a credit card for the security deposit, and proof of insurance.</p>
        </div>
        
        <div class="faq-item">
            <h5>4. Can I cancel my reservation?</h5>
            <p>Yes, you can cancel your reservation up to 24 hours before your scheduled pickup time without any penalties.</p>
        </div>

        <div class="faq-item">
            <h5>5. What is the fuel policy?</h5>
            <p>We operate on a full-to-full fuel policy, meaning you should return the car with a full tank.</p>
        </div>
        
        <div class="faq-item">
            <h5>6. Is there a mileage limit?</h5>
            <p>Standard rentals include unlimited mileage, but some special offers may have mileage restrictions. Please check the details when booking.</p>
        </div>
        
        <div class="faq-item">
            <h5>7. Can I extend my rental period?</h5>
            <p>Yes, you can extend your rental period by contacting our customer service team. Additional charges may apply.</p>
        </div>

        <div class="faq-item">
            <h5>8. What happens if I return the car late?</h5>
            <p>If you return the car late, additional charges will apply according to our late return policy.</p>
        </div>

        <div class="faq-item">
            <h5>9. Do you offer insurance options?</h5>
            <p>Yes, we offer various insurance options to protect you during your rental. You can choose to add insurance when making your reservation.</p>
        </div>

        <div class="faq-item">
            <h5>10. How can I contact customer support?</h5>
            <p>You can contact our customer support team via email at support@techride.com or call us at 1-800-555-TECH.</p>
        </div>
    </div>

    <footer>
    <p>&copy; <?php echo date("Y"); ?> TECH RIDE. All rights reserved.</p>
    <div>
            <a href="privacy_policy.php" style="color: #ff6600;">Privacy Policy</a> | 
            <a href="terms_of_service.php" style="color: #ff6600;">Terms of Service</a>
        </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
