<?php
// Include the database connection file
include('C:/xampp/htdocs/foodwebsite/db_connection.php');

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize form data
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate inputs
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email address.";
    } elseif (strlen($password) < 6) {
        $error_message = "Password must be at least 6 characters long.";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Check if the email already exists in the database
        $query = "SELECT id FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            // Email already exists
            $error_message = "This email is already registered.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user into the database
            $query = "INSERT INTO users (email, password) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "ss", $email, $hashed_password);

            if (mysqli_stmt_execute($stmt)) {
                $success_message = "Account created successfully! Please <a href='login.php'>login here</a>.";
            } else {
                $error_message = "An error occurred. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-image: url('https://images.pexels.com/photos/260922/pexels-photo-260922.jpeg');
            background-size: cover;
            background-position: center center;
            font-family: Arial, sans-serif;
        }

        .password-strength {
            display: none;
            margin-top: 5px;
            font-size: 14px;
        }

        .password-strength.weak {
            color: red;
        }

        .password-strength.medium {
            color: orange;
        }

        .password-strength.strong {
            color: green;
        }

        .btn-gradient {
            background: linear-gradient(45deg, #ff7e00, #ffcc00);
            color: white;
            font-weight: 600;
            padding: 15px 40px;
            border-radius: 30px;
            width: 200px;
            font-size: 18px;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-gradient:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>

<!-- Header -->
<?php include('header.php'); ?>

<!-- Sign Up Section -->
<section id="sign-up" class="py-5" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4" style="font-family: 'Lobster', cursive; color: #ff5722;">Sign Up</h2>
                        <p class="text-center mb-5">Create an account to get started.</p>

                        <!-- Error and Success Messages -->
                        <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger"><?= $error_message; ?></div>
                        <?php endif; ?>

                        <?php if (!empty($success_message)): ?>
                            <div class="alert alert-success"><?= $success_message; ?></div>
                        <?php endif; ?>

                        <!-- Sign Up Form -->
                        <form action="sign-up.php" method="POST" novalidate>
                            <!-- Email -->
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email">
                            </div>

                            <!-- Password -->
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required placeholder="Create a password">
                                <div class="password-strength" id="passwordStrength"></div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group mb-4">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required placeholder="Re-enter your password">
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-gradient">Sign Up</button>
                            </div>

                            <!-- Link to Login -->
                            <p class="text-center mt-3">Already have an account? <a href="login.php">Login</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include('footer.php'); ?>

<!-- JS for Password Strength Meter -->
<script>
    const passwordInput = document.getElementById('password');
    const passwordStrength = document.getElementById('passwordStrength');

    passwordInput.addEventListener('input', () => {
        const value = passwordInput.value;
        passwordStrength.style.display = value ? 'block' : 'none';

        if (value.length < 6) {
            passwordStrength.textContent = 'Weak';
            passwordStrength.className = 'password-strength weak';
        } else if (value.length < 10) {
            passwordStrength.textContent = 'Medium';
            passwordStrength.className = 'password-strength medium';
        } else {
            passwordStrength.textContent = 'Strong';
            passwordStrength.className = 'password-strength strong';
        }
    });
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
