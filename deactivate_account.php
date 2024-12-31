<?php
// deactivate_account.php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'db_connection.php'; // Include your database connection

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// CSRF Token Generation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Handle Deactivation Request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF Token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['error'] = "Invalid CSRF token.";
        header("Location: deactivate_account.php");
        exit();
    }

    // Confirm Checkbox
    if (!isset($_POST['confirm'])) {
        $_SESSION['error'] = "You must confirm to deactivate your account.";
        header("Location: deactivate_account.php");
        exit();
    }

    // Optional: Capture the reason for leaving
    $reason = isset($_POST['reason']) ? trim($_POST['reason']) : '';

    // Implement account deactivation logic
    // Update the 'status' field to 'deactivated'
    $stmt = $conn->prepare("UPDATE users SET status = 'deactivated' WHERE id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        // Optionally, log the reason for deactivation
        if (!empty($reason)) {
            // Assuming there's a 'deactivation_reasons' table
            // If not, you can skip this part or create the table as needed
            $stmt_reason = $conn->prepare("INSERT INTO deactivation_reasons (user_id, reason, deactivated_at) VALUES (?, ?, NOW())");
            $stmt_reason->bind_param("is", $user_id, $reason);
            $stmt_reason->execute();
            $stmt_reason->close();
        }

        // Destroy the session and redirect to goodbye page
        session_destroy();
        header("Location: goodbye.php"); // Create this page to inform the user
        exit();
    } else {
        $_SESSION['error'] = "Error deactivating your account. Please try again.";
    }

    $stmt->close();
    $conn->close();

    // Redirect back to deactivation page with error
    header("Location: deactivate_account.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deactivate Account - TECH RIDE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        .container {
            margin-top: 80px;
            max-width: 600px;
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
        <h2>Deactivate Account</h2>
        <p>We're sorry to see you go. Please confirm your decision to deactivate your account.</p>
        
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error']) . '</div>';
            unset($_SESSION['error']);
        }
        ?>
        
        <form action="deactivate_account.php" method="POST">
            <!-- Include CSRF Token -->
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
            
            <div class="mb-3">
                <label for="reason" class="form-label">Reason for leaving</label>
                <textarea class="form-control" id="reason" name="reason" rows="3" placeholder="Optional"></textarea>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="1" id="confirm" name="confirm" required>
                <label class="form-check-label" for="confirm">
                    I understand that deactivating my account is permanent and cannot be undone.
                </label>
            </div>
            <button type="submit" class="btn btn-warning">Deactivate Account</button>
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
