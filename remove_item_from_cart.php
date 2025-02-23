<?php
include('header.php');
include('db_connection.php');

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the item ID is provided
if (isset($_GET['item_id'])) {
    $item_id = $_GET['item_id'];

    // Remove the item from the cart
    unset($_SESSION['order'][$item_id]);

    // Redirect back to the cart page after removal
    header("Location: cart.php");
    exit();
}
?>
