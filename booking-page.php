<?php
include('header.php');
include('db_connection.php');

// Fetching all bookings from the database
$sql = "SELECT id, name, booking_time, status FROM bookings ORDER BY booking_time DESC";
$result = mysqli_query($conn, $sql);

// Check if there are any bookings
if (mysqli_num_rows($result) > 0) {
    $bookings = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $bookings = [];
}
?>

<!-- Booking Page Section -->
<section id="booking-section" class="py-5" style="background-image: url('https://images.pexels.com/photos/3605703/pexels-photo-3605703.jpeg'); background-size: cover; background-position: center center;">
    <div class="container">
        <h2 class="text-center mb-5" style="font-family: 'Lobster', cursive; color: #ff5722; font-size: 3rem;">Your Bookings</h2>

        <?php if (empty($bookings)): ?>
            <div class="alert alert-info text-center py-5" style="background-color: #f9f9f9; border-radius: 10px;">
                <h4 class="mb-4" style="font-size: 1.5rem; color: #555;">You have no bookings yet!</h4>
                <p class="mb-3" style="font-size: 1.1rem; color: #777;">Feel free to make a reservation today.</p>
                <a href="booking-table.php" class="btn btn-lg btn-primary rounded-pill px-5" style="font-size: 1.2rem; background-color: #ff5722; border-color: #ff5722;">Make a Booking</a>
            </div>
        <?php else: ?>
            <!-- Display Bookings -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" style="background-color: #ffffff;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Booking ID</th>
                            <th>Name</th> <!-- Updated from "Full Name" -->
                            <th>Booking Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $booking): ?>
                            <tr>
                                <td><?= $booking['id'] ?></td>
                                <td><?= htmlspecialchars($booking['name']) ?></td> <!-- Updated from "full_name" -->
                                <td><?= date('g:i A', strtotime($booking['booking_time'])) ?></td>
                                <td>
                                    <span class="badge <?= $booking['status'] == 'Confirmed' ? 'badge-success' : 'badge-warning' ?>">
                                        <?= htmlspecialchars($booking['status']) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Footer Section -->
<?php include('footer.php'); ?>
