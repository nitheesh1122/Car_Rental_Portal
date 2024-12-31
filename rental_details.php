<?php 
// rental_details.php

// **Start Session**
session_start();

// **Check if User is Logged In**
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// **Retrieve User Information**
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// **Check if Rental ID is Provided**
if (!isset($_GET['rental_id']) || empty($_GET['rental_id'])) {
    $_SESSION['error'] = "Invalid rental ID.";
    header("Location: my_rentals.php");
    exit();
}

$rental_id = intval($_GET['rental_id']);

// **Include Database Connection**
require_once 'db_connection.php';

// **Fetch Rental Details**
$stmt = $conn->prepare("SELECT rental_id, product_name, rental_date, return_date, status, additional_info FROM rentals WHERE rental_id = ? AND user_id = ?");
$stmt->bind_param("ii", $rental_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = "Rental not found.";
    $stmt->close();
    $conn->close();
    header("Location: my_rentals.php");
    exit();
}

$rental = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Details - TECH RIDE</title>
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
        /* Table Styles */
        table th, table td {
            vertical-align: middle;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        .status-current {
            color: #0d6efd;
            font-weight: bold;
        }
        .status-completed {
            color: #198754;
            font-weight: bold;
        }
        .status-canceled {
            color: #dc3545;
            font-weight: bold;
        }
    </style>
</head>
<body>
<header class="bg-dark text-white py-3">
    <div class="container">
        <h1 class="text-center">Rental Details</h1>
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
    <h2>Rental ID: <?php echo htmlspecialchars($rental['rental_id']); ?></h2>
    <p>Detailed information about your rental.</p>
    
    <table class="table table-bordered animate__animated animate__fadeIn">
        <tr>
            <th>Product Name</th>
            <td><?php echo htmlspecialchars($rental['product_name']); ?></td>
        </tr>
        <tr>
            <th>Rental Date</th>
            <td><?php echo htmlspecialchars(date("F j, Y, g:i a", strtotime($rental['rental_date']))); ?></td>
        </tr>
        <tr>
            <th>Return Date</th>
            <td>
                <?php 
                    if ($rental['return_date']) {
                        echo htmlspecialchars(date("F j, Y, g:i a", strtotime($rental['return_date'])));
                    } else {
                        echo 'N/A';
                    }
                ?>
            </td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                <?php 
                    $status = htmlspecialchars($rental['status']);
                    if ($status === 'current') {
                        echo '<span class="status-current">Current</span>';
                    } elseif ($status === 'completed') {
                        echo '<span class="status-completed">Completed</span>';
                    } elseif ($status === 'canceled') {
                        echo '<span class="status-canceled">Canceled</span>';
                    }
                ?>
            </td>
        </tr>
        <?php if (!empty($rental['additional_info'])): ?>
            <tr>
                <th>Additional Information</th>
                <td><?php echo nl2br(htmlspecialchars($rental['additional_info'])); ?></td>
            </tr>
        <?php endif; ?>
    </table>
    
    <a href="my_rentals.php" class="btn btn-secondary">Back to My Rentals</a>
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

    // Handle Cancellation Confirmation
    let rentalIdToCancel = null;

    function confirmCancellation(rentalId) {
        rentalIdToCancel = rentalId;
        var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'), {
            keyboard: false
        });
        confirmModal.show();
    }

    document.getElementById('confirmCancelBtn').addEventListener('click', function() {
        if(rentalIdToCancel){
            window.location.href = `cancel_rental.php?rental_id=${rentalIdToCancel}`;
        }
    });
</script>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-confirm">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Confirm Cancellation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to cancel this rental? This action cannot be undone.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Keep It</button>
        <a href="#" class="btn btn-danger" id="confirmCancelBtn">Yes, Cancel It</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
