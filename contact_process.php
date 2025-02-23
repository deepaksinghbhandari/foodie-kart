<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process form data (sanitize and validate inputs, store in database, etc.)
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    // Assuming message is sent successfully (you can add your email sending logic here)
    $email_sent = true; // This is just for demonstration. Replace with actual email sending logic.

    if ($email_sent) {
        // Redirect to index.php with a success message
        header("Location: index.php?success=true");
        exit();
    } else {
        // If email failed to send, you can redirect to an error page or display an error message
        echo "Error: Unable to send message.";
    }
}
?>
