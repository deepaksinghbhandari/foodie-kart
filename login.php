<?php
session_start(); // Start session at the beginning

// Redirect if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$logout_message = '';
if (isset($_GET['message'])) {
    $logout_message = htmlspecialchars($_GET['message']);
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('db_connection.php');

    // Sanitize and capture form inputs
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    // Check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verify user credentials
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password with password_verify()
        if (password_verify($password, $user['password'])) {
            // Start session and store user information
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            // Redirect to the homepage after successful login
            header("Location: index.php");
            exit();
        } else {
            // Invalid password
            $error_message = "Incorrect password.";
        }
    } else {
        // Email not found
        $error_message = "No user found with this email.";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>

<?php include('header.php'); ?>

<!-- Login Section -->
<section id="login" class="py-5" style="background-image: url('https://images.pexels.com/photos/260922/pexels-photo-260922.jpeg'); background-size: cover; background-position: center; margin-top:-20px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4" style="font-family: 'Lobster', cursive; color: #ff5722;" data-aos="fade-up">Login</h2>
                        <p class="text-center mb-5" data-aos="fade-up" data-aos-delay="200">Log in to access your account.</p>

                        <!-- Error and Logout Messages -->
                        <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger text-center"><?= $error_message; ?></div>
                        <?php endif; ?>

                        <?php if (!empty($logout_message)): ?>
                            <div class="alert alert-success text-center"><?= $logout_message; ?></div>
                        <?php endif; ?>

                        <!-- Login Form -->
                        <form action="login.php" method="POST" data-aos="fade-up" data-aos-delay="300" novalidate>
                            <!-- Email -->
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required placeholder="example@example.com" aria-label="Email Address">
                                <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>

                            <!-- Password -->
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password" aria-label="Password">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" id="togglePassword" style="border-radius: 0 0.25rem 0.25rem 0;">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <small class="form-text text-muted">Password must be 8-16 characters long.</small>
                            </div>

                            <!-- Remember Me -->
                            <div class="form-group form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-lg" style="background: linear-gradient(45deg, #ff7e00, #ffcc00); color: white; font-weight: bold; padding: 15px 40px; border-radius: 30px; font-size: 18px; border: none; transition: all 0.3s ease; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    Login
                                </button>
                            </div>

                            <!-- Links -->
                            <div class="form-group text-center mt-3">
                                <p><a href="forgot-password.php" style="text-decoration: none;">Forgot Password?</a></p>
                                <p>Don't have an account? <a href="sign-up.php" style="text-decoration: none;">Sign up here</a>.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
    AOS.init();

    // Show/Hide Password Functionality
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.className = 'fas fa-eye-slash';
        } else {
            passwordInput.type = 'password';
            icon.className = 'fas fa-eye';
        }
    });
</script>
