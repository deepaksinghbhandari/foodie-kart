<?php
// Include the header and database connection
include('header.php');
include('db_connection.php');

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<p class='text-center'>Please log in to view your orders.</p>";
    echo "<div class='text-center'><a href='login.php' class='btn btn-primary'>Log In</a></div>";
    include('footer.php');
    exit();
}

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Fetch all orders for the logged-in user
$query = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC";
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    echo "<p class='text-center'>Error fetching your orders. Please try again later.</p>";
    include('footer.php');
    exit();
}
?>

<!-- View Orders Section -->
<section id="view-orders" class="py-5" style="background-image: url('https://images.pexels.com/photos/70497/pexels-photo-70497.jpeg'); background-size: cover; background-position: center center; margin-top: -20px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4" style="font-family: 'Lobster', cursive; color: #FF6F61;">My Orders</h2>
                        <p class="text-center mb-5" style="font-size: 1rem;">Review your previous orders with Foodie Kart and relish the memories of great food!</p>

                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead style="background: linear-gradient(45deg, #FF6F61, #FF9A8B); color: white;">
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Total Price</th>
                                            <th>Order Date</th>
                                            <th>Items</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($order = mysqli_fetch_assoc($result)): ?>
                                            <tr>
                                                <td>#<?= htmlspecialchars($order['id']) ?></td>
                                                <td>$<?= number_format($order['total_price'], 2) ?></td>
                                                <td><?= date("F j, Y, g:i a", strtotime($order['created_at'])) ?></td>
                                                <td>
                                                    <?php
                                                    // Fetch items for the current order
                                                    $item_query = "SELECT * FROM order_items WHERE order_id = ?";
                                                    $item_stmt = mysqli_prepare($conn, $item_query);
                                                    mysqli_stmt_bind_param($item_stmt, "i", $order['id']);
                                                    mysqli_stmt_execute($item_stmt);
                                                    $item_result = mysqli_stmt_get_result($item_stmt);

                                                    if (mysqli_num_rows($item_result) > 0):
                                                    ?>
                                                        <ul style="list-style: none; padding: 0;">
                                                            <?php while ($item = mysqli_fetch_assoc($item_result)): ?>
                                                                <li style="font-size: 0.9rem;">
                                                                    <?= htmlspecialchars($item['item_name']) ?> - 
                                                                    $<?= number_format($item['item_price'], 2) ?> x 
                                                                    <?= htmlspecialchars($item['item_quantity']) ?>
                                                                </li>
                                                            <?php endwhile; ?>
                                                        </ul>
                                                    <?php
                                                    else:
                                                        echo "No items found.";
                                                    endif;

                                                    mysqli_stmt_close($item_stmt);
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-center">You have not placed any orders yet.</p>
                        <?php endif; ?>

                        <!-- Button to go back to shopping -->
                        <div class="text-center mt-4">
                            <a href="index.php" class="btn btn-lg" style="background: linear-gradient(45deg, #FF6F61, #FF9A8B); color: white; font-weight: 600; padding: 15px 40px; border-radius: 30px; width: 200px; font-size: 18px; border: none; transition: all 0.3s ease; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);

// Include the footer
include('footer.php');
?>
