<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TECH RIDE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f8f9fa;
    }
    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 100%;
        max-width: 400px;
        border-radius: 0.5rem;
    }
    .btn-primary {
        background-image: linear-gradient(to right, #007bff, #0056b3);
        border: none;
        transition: background-color 0.3s, transform 0.3s;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }
    .login-link a {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }
    .login-link a:hover {
        text-decoration: underline;
    }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card">
            <h3 class="text-center mb-4">Login</h3>

            <!-- **Login Form** -->
            <form action="login.php" method="POST">
                <!-- **Username Field** -->
                <div class="mb-3">
                    <label for="user" class="form-label">Username</label>
                    <input type="text" class="form-control" id="user" name="user" placeholder="Enter username" required>
                </div>
                
                <!-- **Password Field** -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                </div>
                
                <!-- **Login Button** -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
            
            <!-- **Additional Links** -->
            <div class="text-center mt-3">
                <a href="#">Forgot Password?</a><br>
                <a href="signup.php">Create an Account</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
