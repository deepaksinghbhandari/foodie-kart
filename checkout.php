<?php
// Include necessary files
include('header.php');
include('db_connection.php');

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if cart is empty
if (empty($_SESSION['order'])) {
    header("Location: cart.php");
    exit();
}

// Calculate the total price
$total_price = 0;
foreach ($_SESSION['order'] as $item_id => $item) {
    if (!isset($item['price'], $item['quantity']) || $item['price'] <= 0 || $item['quantity'] <= 0) {
        echo "Invalid item detected in the cart. Please review your cart.";
        exit();
    }
    $total_price += $item['price'] * $item['quantity'];
}

// Prepare to insert the order into the database
$user_id = $_SESSION['user_id'];

// Start a database transaction
mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);

try {
    // Insert order details into the `orders` table
    $query = "INSERT INTO orders (user_id, total_price, created_at) VALUES (?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "id", $user_id, $total_price);

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Failed to insert order: " . mysqli_stmt_error($stmt));
    }

    $order_id = mysqli_insert_id($conn);

    // Insert order items into the `order_items` table
    foreach ($_SESSION['order'] as $item_id => $item) {
        $item_query = "INSERT INTO order_items (order_id, item_name, item_price, item_quantity) VALUES (?, ?, ?, ?)";
        $item_stmt = mysqli_prepare($conn, $item_query);
        mysqli_stmt_bind_param($item_stmt, "isdi", $order_id, $item['name'], $item['price'], $item['quantity']);

        if (!mysqli_stmt_execute($item_stmt)) {
            throw new Exception("Failed to insert order items: " . mysqli_stmt_error($item_stmt));
        }

        mysqli_stmt_close($item_stmt); // Close statement to free resources
    }

    // Commit the transaction
    mysqli_commit($conn);

    // Clear the cart after successful order
    unset($_SESSION['order']);

    // Close the main prepared statement
    mysqli_stmt_close($stmt);

    // Redirect to the order confirmation page
    header("Location: order-confirmation.php?order_id=$order_id");
    exit();

} catch (Exception $e) {
    // Rollback the transaction on error
    mysqli_roll_back($conn);

    // Log the error
    error_log("Order Error: " . $e->getMessage(), 3, "error_log.txt");

    // Display a user-friendly error message
    echo "<div style='text-align: center; margin-top: 50px; color: red; font-size: 20px;'>An error occurred while processing your order. Please try again later.</div>";
}

// Close the database connection
mysqli_close($conn);
?>
