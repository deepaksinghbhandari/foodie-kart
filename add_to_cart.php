<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the request method is POST and required fields are present
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'], $_POST['item_name'], $_POST['item_price'], $_POST['quantity'], $_POST['image_url'])) {
    $item_id = filter_var($_POST['item_id'], FILTER_SANITIZE_NUMBER_INT);
    $item_name = filter_var($_POST['item_name'], FILTER_SANITIZE_STRING);
    $item_price = filter_var($_POST['item_price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $quantity = filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT);
    $image_url = filter_var($_POST['image_url'], FILTER_SANITIZE_URL);

    // Initialize cart if not already set
    if (!isset($_SESSION['order'])) {
        $_SESSION['order'] = [];
    }

    // Add or update the item in the cart
    if (isset($_SESSION['order'][$item_id])) {
        $_SESSION['order'][$item_id]['quantity'] += $quantity; // Update quantity
    } else {
        $_SESSION['order'][$item_id] = [
            'name' => $item_name,
            'price' => $item_price,
            'quantity' => $quantity,
            'image_url' => $image_url,
        ];
    }

    // Redirect back to cart page
    header("Location: cart.php");
    exit;
}
?>
