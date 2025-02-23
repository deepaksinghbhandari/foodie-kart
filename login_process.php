<?php
session_start();
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Verify password with password_verify()
        if (password_verify($password, $row['password'])) {
            session_regenerate_id(true); // Regenerate session ID for security
            $_SESSION['user_id'] = $row['id']; // Store the user ID in session
            $_SESSION['username'] = $username; // Store the username in session
            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid username or password!";
            header("Location: login.php?error=1");
            exit();
        }
    } else {
        $_SESSION['error'] = "Invalid username or password!";
        header("Location: login.php?error=1");
        exit();
    }
}
?>
