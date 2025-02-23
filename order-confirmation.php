<?php
// Include the database connection and header
include('header.php');
include('db_connection.php');

// Get order ID from URL
$order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;

// Check if the order_id is valid
if ($order_id <= 0) {
    header("Location: index.php"); // Redirect to homepage if invalid order ID
    exit();
}

// Fetch order details
$query = "SELECT * FROM orders WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
if (!$stmt) {
    echo "<p class='text-center'>Error preparing statement. Please try again later.</p>";
    include('footer.php');
    exit();
}
mysqli_stmt_bind_param($stmt, "i", $order_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$order = mysqli_fetch_assoc($result);

// Check if the order exists
if (!$order) {
    echo "<p class='text-center'>Order not found. Please check your order ID.</p>";
    include('footer.php');
    exit();
}

// Fetch order items
$item_query = "SELECT * FROM order_items WHERE order_id = ?";
$item_stmt = mysqli_prepare($conn, $item_query);
if (!$item_stmt) {
    echo "<p class='text-center'>Error fetching order items. Please try again later.</p>";
    include('footer.php');
    exit();
}
mysqli_stmt_bind_param($item_stmt, "i", $order_id);
mysqli_stmt_execute($item_stmt);
$item_result = mysqli_stmt_get_result($item_stmt);

// Fetch user details (optional)
$user = null; // Default to null in case user details are unavailable
if (!empty($order['user_id'])) {
    $user_query = "SELECT * FROM users WHERE id = ?";
    $user_stmt = mysqli_prepare($conn, $user_query);
    if ($user_stmt) {
        mysqli_stmt_bind_param($user_stmt, "i", $order['user_id']);
        mysqli_stmt_execute($user_stmt);
        $user_result = mysqli_stmt_get_result($user_stmt);
        $user = mysqli_fetch_assoc($user_result);
        mysqli_stmt_close($user_stmt);
    }
}
?>

<!-- Order Confirmation Section -->
<section id="order-confirmation" class="py-5" style="background-image: url('https://images.pexels.com/photos/260922/pexels-photo-260922.jpeg'); background-size: cover; background-position: center center; margin-top: -20px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4" style="font-family: 'Lobster', cursive; color: #FF6F61;">Order Confirmation</h2>
                        <p class="text-center text-muted">Thank you for your order! Your order ID is #<?= htmlspecialchars($order['id']) ?>.</p>

                        <!-- User Details Section -->
                        <div class="text-center mb-4">
                            <?php if ($user): ?>
                                <p><strong>Order placed by:</strong> <?= htmlspecialchars($user['email']) ?></p>
                            <?php else: ?>
                                <p>User details not available.</p>
                            <?php endif; ?>
                        </div>

                        <!-- Order Details Section -->
                        <div class="mb-4">
                            <h4 class="text-center" style="color: #FF6F61;">Order Details:</h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total Price: <span class="font-weight-bold">$<?= number_format($order['total_price'], 2) ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Order Date: <span class="font-weight-bold"><?= date("F j, Y, g:i a", strtotime($order['created_at'])) ?></span>
                                </li>
                            </ul>
                        </div>

                        <!-- Items List Section -->
                        <div class="mb-4">
                            <h4 class="text-center" style="color: #FF6F61;">Order Items:</h4>
                            <?php if (mysqli_num_rows($item_result) > 0): ?>
                                <ul class="list-group list-group-flush">
                                    <?php while ($item = mysqli_fetch_assoc($item_result)): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= htmlspecialchars($item['item_name']) ?> 
                                            <span class="badge badge-primary badge-pill">$<?= number_format($item['item_price'], 2) ?> x <?= htmlspecialchars($item['item_quantity']) ?></span>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php else: ?>
                                <p class="text-center text-muted">No items found in this order.</p>
                            <?php endif; ?>
                        </div>

                        <!-- Buttons for navigation -->
                        <div class="text-center mt-4">
                            <a href="index.php" class="btn btn-lg" style="background: linear-gradient(45deg, #FF6F61, #FF9A8B); color: white; font-weight: 600; padding: 12px 35px; border-radius: 30px; transition: all 0.3s ease;">
                                Continue Shopping
                            </a>
                            <a href="view-orders.php" class="btn btn-lg mt-2" style="background: #6c757d; color: white; font-weight: 600; padding: 12px 35px; border-radius: 30px; transition: all 0.3s ease;">
                                View My Orders
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Close prepared statements and database connection
mysqli_stmt_close($stmt);
mysqli_stmt_close($item_stmt);
mysqli_close($conn);

// Include footer
include('footer.php');
?>
