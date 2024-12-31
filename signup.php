<?php
// **Enable Error Reporting for Debugging**
// **Note:** Disable these lines in a production environment to prevent exposing sensitive information.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// **Initialize Variables for Form Data and Error Messages**
$fullName = $username = $mobile = $dob = $email = $confirmEmail = $password = $confirmPassword = $gender = $driversLicense = "";
$errors = [];
$successMessage = "";

// **Database Connection Parameters**
$host = 'localhost';
$dbUser = 'root';          // Change if different
$dbPassword = '1234';      // Change to your actual database password
$dbname = 'crs';           // Ensure this database exists

// **Create Database Connection**
$conn = new mysqli($host, $dbUser, $dbPassword, $dbname);

// **Check Database Connection**
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// **Handle Form Submission**
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // **Sanitize and Validate Inputs**

    // **Full Name**
    $fullName = isset($_POST["fullName"]) ? trim($_POST["fullName"]) : '';
    if (empty($fullName)) {
        $errors['fullName'] = "Full Name is required.";
    }

    // **Username**
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : '';
    if (empty($username)) {
        $errors['username'] = "Username is required.";
    } else {
        // **Check if Username Already Exists**
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $errors['username'] = "Username already exists. Please choose another.";
            }
            $stmt->close();
        } else {
            $errors['database'] = "Database error: " . $conn->error;
        }
    }

    // **Mobile Number**
    $mobile = isset($_POST["mobile"]) ? trim($_POST["mobile"]) : '';
    if (empty($mobile) || !preg_match("/^[0-9]{10}$/", $mobile)) {
        $errors['mobile'] = "Valid Mobile Number is required.";
    }

    // **Date of Birth**
    $dob = isset($_POST["dob"]) ? $_POST["dob"] : '';
    if (empty($dob)) {
        $errors['dob'] = "Date of Birth is required.";
    }

    // **Email Address**
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Valid Email Address is required.";
    } else {
        // **Check if Email Already Exists**
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $errors['email'] = "Email address already registered. Please use another.";
            }
            $stmt->close();
        } else {
            $errors['database'] = "Database error: " . $conn->error;
        }
    }

    // **Confirm Email Address**
    $confirmEmail = isset($_POST["confirmEmail"]) ? trim($_POST["confirmEmail"]) : '';
    if ($confirmEmail !== $email) {
        $errors['confirmEmail'] = "Emails do not match.";
    }

    // **Password**
    $password = isset($_POST["password"]) ? $_POST["password"] : '';
    if (empty($password) || strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters long.";
    }

    // **Confirm Password**
    $confirmPassword = isset($_POST["confirmPassword"]) ? $_POST["confirmPassword"] : '';
    if ($confirmPassword !== $password) {
        $errors['confirmPassword'] = "Passwords do not match.";
    }

    // **Gender**
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : '';
    if (empty($gender)) {
        $errors['gender'] = "Please select your gender.";
    }

    // **Driver's License Number**
    $driversLicense = isset($_POST["driversLicense"]) ? trim($_POST["driversLicense"]) : '';
    if (empty($driversLicense) || !preg_match("/^[A-Za-z0-9]{6,20}$/", $driversLicense)) {
        $errors['driversLicense'] = "Invalid Driver's License Number.";
    }

    // **Insert Data into Database if No Errors**
    if (empty($errors)) {
        // **Prepare SQL Statement**
        $stmt = $conn->prepare("INSERT INTO users (full_name, username, mobile, dob, email, password, gender, drivers_license) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            // **Hash the Password for Security**
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // **Bind Parameters to the SQL Statement**
            $stmt->bind_param("ssssssss", $fullName, $username, $mobile, $dob, $email, $hashedPassword, $gender, $driversLicense);

            // **Execute the Statement**
            if ($stmt->execute()) {
                $successMessage = "Registration successful!";
                // **Clear Form Fields After Successful Registration**
                $fullName = $username = $mobile = $dob = $email = $confirmEmail = $password = $confirmPassword = $gender = $driversLicense = "";
            } else {
                // **Handle Duplicate Entry Errors Gracefully**
                if ($conn->errno === 1062) { // 1062 is MySQL error code for duplicate entry
                    if (strpos($conn->error, 'users.email') !== false) {
                        $errors['email'] = "Email address already registered. Please use another.";
                    } elseif (strpos($conn->error, 'users.username') !== false) {
                        $errors['username'] = "Username already exists. Please choose another.";
                    } else {
                        $errors['database'] = "Duplicate entry detected.";
                    }
                } else {
                    $errors['database'] = "Error: " . $stmt->error;
                }
            }

            // **Close the Statement**
            $stmt->close();
        } else {
            $errors['database'] = "Database error: " . $conn->error;
        }
    }

    // **Close the Database Connection**
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- **Meta Tags for Responsiveness and Character Encoding** -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up for Car Rental Service</title>
    
    <!-- **Bootstrap CSS for Styling** -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- **Custom CSS Styles** -->
    <style>
    body {
        background-color: #f8f9fa;
    }
    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: row;
        margin: 20px 0;
        border-radius: 0.5rem;
    }
    .card-header {
        background-color: #007bff;
        color: white;
        padding: 8px; /* Reduced padding from 10px to 8px */
        border-radius: 0.5rem 0.5rem 0 0;
        text-align: center;
        width: 35%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .card-header h3 {
        font-size: 1.25rem; /* Reduced font size from 1.5rem to 1.25rem */
        font-weight: 500; /* Adjusted font weight */
        margin: 0; /* Remove default margin */
        transition: font-size 0.3s ease;
    }
    .form-control, .form-select {
        border-radius: 0.25rem;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0.25rem rgba(0, 123, 255, 0.25);
    }
    .error-message {
        color: red;
        font-size: 0.875em;
    }
    .success-message {
        color: green;
        font-size: 1em;
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
    .form-column {
        flex: 1;
        padding: 15px;
    }
    .login-link {
        text-align: center;
        margin-top: 20px;
    }
    .login-link a {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }
    .login-link a:hover {
        text-decoration: underline;
    }
    @media (max-width: 768px) {
        .card {
            flex-direction: column;
        }
        .card-header {
            border-radius: 0.5rem 0.5rem 0 0;
        }
    }
    /* **Pop-out Message Styles** */
    .pop-out {
        position: fixed;
        top: 10%;
        right: 10%;
        padding: 15px;
        border-radius: 5px;
        opacity: 0;
        transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
        z-index: 1000;
    }
    .pop-out.show {
        opacity: 1;
        transform: translateY(0);
    }
    .pop-out.hide {
        transform: translateY(-20px);
    }
    </style>
</head>
<body>
    <!-- **Container for Centering the Card** -->
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <!-- **Card Component** -->
        <div class="card" style="width: 100%; max-width: 1000px;">
            <!-- **Card Header** -->
            <div class="card-header">
                <h3>Sign Up</h3>
            </div>
            
            <!-- **Single Form Enclosing All Input Fields** -->
            <form method="POST" action="" class="d-flex flex-row w-100">
                <!-- **First Column of the Form** -->
                <div class="form-column">
                    <!-- **Full Name Field** -->
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="fullName" placeholder="John Doe" required value="<?php echo htmlspecialchars($fullName); ?>">
                        <div class="error-message"><?php echo isset($errors['fullName']) ? htmlspecialchars($errors['fullName']) : ''; ?></div>
                    </div>

                    <!-- **Username Field** -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Choose a username" required value="<?php echo htmlspecialchars($username); ?>">
                        <div class="error-message"><?php echo isset($errors['username']) ? htmlspecialchars($errors['username']) : ''; ?></div>
                    </div>

                    <!-- **Mobile Number Field** -->
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="e.g. 0123456789" required pattern="[0-9]{10}" value="<?php echo htmlspecialchars($mobile); ?>">
                        <div class="error-message"><?php echo isset($errors['mobile']) ? htmlspecialchars($errors['mobile']) : ''; ?></div>
                    </div>

                    <!-- **Date of Birth Field** -->
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" required value="<?php echo htmlspecialchars($dob); ?>">
                        <div class="error-message"><?php echo isset($errors['dob']) ? htmlspecialchars($errors['dob']) : ''; ?></div>
                    </div>

                    <!-- **Gender Selection Field** -->
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="" disabled <?php echo empty($gender) ? 'selected' : ''; ?>>Select your gender</option>
                            <option value="male" <?php echo ($gender == "male") ? "selected" : ""; ?>>Male</option>
                            <option value="female" <?php echo ($gender == "female") ? "selected" : ""; ?>>Female</option>
                        </select>
                        <div class="error-message"><?php echo isset($errors['gender']) ? htmlspecialchars($errors['gender']) : ''; ?></div>
                    </div>
                </div>

                <!-- **Second Column of the Form** -->
                <div class="form-column">
                    <!-- **Email Address Field** -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required value="<?php echo htmlspecialchars($email); ?>">
                        <div class="error-message"><?php echo isset($errors['email']) ? htmlspecialchars($errors['email']) : ''; ?></div>
                    </div>

                    <!-- **Confirm Email Address Field** -->
                    <div class="mb-3">
                        <label for="confirmEmail" class="form-label">Confirm Email Address</label>
                        <input type="email" class="form-control" id="confirmEmail" name="confirmEmail" placeholder="Confirm your email" required value="<?php echo htmlspecialchars($confirmEmail); ?>">
                        <div class="error-message"><?php echo isset($errors['confirmEmail']) ? htmlspecialchars($errors['confirmEmail']) : ''; ?></div>
                    </div>

                    <!-- **Password Field** -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
                        <!-- **Password Strength Indicator** -->
                        <div id="passwordStrength" class="error-message"></div>
                        <div class="error-message"><?php echo isset($errors['password']) ? htmlspecialchars($errors['password']) : ''; ?></div>
                    </div>

                    <!-- **Confirm Password Field** -->
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Re-enter your password" required>
                        <div class="error-message"><?php echo isset($errors['confirmPassword']) ? htmlspecialchars($errors['confirmPassword']) : ''; ?></div>
                    </div>

                    <!-- **Driver's License Number Field** -->
                    <div class="mb-3">
                        <label for="driversLicense" class="form-label">Driver's License Number</label>
                        <input type="text" class="form-control" id="driversLicense" name="driversLicense" placeholder="Driver's License Number" required value="<?php echo htmlspecialchars($driversLicense); ?>">
                        <div class="error-message"><?php echo isset($errors['driversLicense']) ? htmlspecialchars($errors['driversLicense']) : ''; ?></div>
                    </div>

                    <!-- **Register Button** -->
                    <button type="submit" class="btn btn-primary">Register</button>
                    
                    <!-- **Login Link** -->
                    <div class="login-link">
                        <p>Already have an account? <a href="login.php">Log in</a></p>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- **Pop-out Success Message** -->
        <?php if (!empty($successMessage)): ?>
            <div class="pop-out show" id="popOutMessage" style="background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724;">
                <strong>Success!</strong> <?php echo htmlspecialchars($successMessage); ?>
            </div>
        <?php else: ?>
            <div class="pop-out hide" id="popOutMessage">
                <strong>Success!</strong> <?php echo htmlspecialchars($successMessage); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- **JavaScript for Interactive Features** -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // **Handle Pop-out Success Message Display and Auto-hide**
            const popOutMessage = document.getElementById('popOutMessage');
            if (popOutMessage.classList.contains('show')) {
                setTimeout(function () {
                    popOutMessage.classList.remove('show');
                    popOutMessage.classList.add('hide');
                }, 5000); // Hide after 5 seconds
            }
        });

        // **Password Strength Checker**
        const passwordInput = document.getElementById('password');
        const passwordStrength = document.getElementById('passwordStrength');
        if (passwordInput && passwordStrength) {
            passwordInput.addEventListener('input', function () {
                const passwordValue = passwordInput.value;
                let strength = 0;

                // **Criteria for Password Strength**
                if (passwordValue.length >= 8) strength++;
                if (/[A-Z]/.test(passwordValue)) strength++;
                if (/[0-9]/.test(passwordValue)) strength++;
                if (/[^A-Za-z0-9]/.test(passwordValue)) strength++;

                // **Update Password Strength Indicator**
                switch (strength) {
                    case 0:
                        passwordStrength.textContent = '';
                        break;
                    case 1:
                        passwordStrength.textContent = 'Weak';
                        passwordStrength.style.color = 'red';
                        break;
                    case 2:
                        passwordStrength.textContent = 'Moderate';
                        passwordStrength.style.color = 'orange';
                        break;
                    case 3:
                    case 4:
                        passwordStrength.textContent = 'Strong';
                        passwordStrength.style.color = 'green';
                        break;
                }
            });
        }
    </script>
</body>
</html>
