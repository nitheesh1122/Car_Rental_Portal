<?php
// goodbye.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goodbye - TECH RIDE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow-x: hidden;
            text-align: center;
        }
        .container {
            max-width: 600px;
        }
        footer {
            display: none; /* Hide footer on goodbye page */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">We're Sorry to See You Go!</h1>
        <p>Your account has been successfully deactivated. If you change your mind, you can reactivate your account by contacting our support team.</p>
        <a href="login.php" class="btn btn-primary mt-3">Return to Login</a>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
