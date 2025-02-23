<?php
session_start();

// Handle logout action
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();

    // Optional: Clear session cookies
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }

    // Redirect after 2 seconds
    header('Refresh: 2; URL=index.php');
    exit();
    if (isset($_GET['logout']) && filter_var($_GET['logout'], FILTER_VALIDATE_BOOLEAN)) {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        .message {
            font-size: 1.5rem;
            color: green;
        }
    </style>
</head>
<body>

    <div class="message">
        <p>You have been successfully logged out!</p>
        <p><a href="index.php">Click here</a> to return to the home page.</p>
    </div>

    <!-- Bootstrap Modal (Visible after logout) -->
    <?php if (isset($_GET['logout'])): ?>
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Logout Successful</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    You have been successfully logged out!
                </div>
                <div class="modal-footer">
                    <a href="index.php" class="btn btn-primary">Go to Home Page</a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Optional: Show the modal after page loads -->
    <script>
        window.onload = function() {
            var modal = new bootstrap.Modal(document.getElementById('logoutModal'));
            modal.show();
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
