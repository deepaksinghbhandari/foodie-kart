<?php 
// Include header
include('header.php');

// Check if a session is already active before starting a new one
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


?>

<!-- Booking Table Section -->
<section id="table-booking" class="py-5" style="background-image: url('https://images.pexels.com/photos/260922/pexels-photo-260922.jpeg'); background-size: cover; background-position: center center; margin-top: -20px;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow-lg border-0 rounded-lg">
          <div class="card-body p-5">
            <h2 class="text-center mb-4" style="font-family: 'Lobster', cursive; color: #FF6F61;">Book a Table</h2>
            <p class="text-center mb-5" style="font-size: 1rem;">Reserve your table at Foodie Kart for a delightful dining experience.</p>

            <!-- Booking Form -->
            <form action="booking-confirmation.php" method="POST">
    
    <div class="form-group mb-3">
        <label for="name">Full Name</label>
        <input type="text" class="form-control" id="name" name="name" required placeholder="Enter your name" aria-label="Full Name">
    </div>
    <div class="form-group mb-3">
        <label for="email">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email" aria-label="Email Address">
    </div>
    <div class="form-group mb-3">
        <label for="people">Number of People</label>
        <input type="number" class="form-control" id="people" name="people" required min="1" placeholder="Enter number of people" aria-label="Number of People">
    </div>
    <div class="form-group mb-3">
        <label for="date">Reservation Date</label>
        <input type="date" class="form-control" id="date" name="date" required aria-label="Reservation Date">
    </div>
    <div class="form-group mb-3">
        <label for="time">Reservation Time</label>
        <div class="d-flex">
            <select class="form-control" id="hour" name="hour" style="border-radius: 5px; font-size: 1rem; width: 40%; margin-right: 10px;">
                <?php for ($i = 1; $i <= 12; $i++): ?>
                    <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                <?php endfor; ?>
            </select>
            <select class="form-control" id="minute" name="minute" style="border-radius: 5px; font-size: 1rem; width: 40%; margin-right: 10px;">
                <?php for ($i = 0; $i < 60; $i += 5): ?>
                    <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                <?php endfor; ?>
            </select>
            <select class="form-control" id="ampm" name="ampm" style="border-radius: 5px; font-size: 1rem; width: 20%;">
                <option value="AM">AM</option>
                <option value="PM">PM</option>
            </select>
        </div>
    </div>
    <div class="form-group mb-4">
        <label for="requests">Special Requests</label>
        <textarea class="form-control" id="requests" name="requests" rows="3" placeholder="Add special requests (optional)" aria-label="Special Requests"></textarea>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-lg" style="background: linear-gradient(45deg, #FF6F61, #FF9A8B); color: white; font-weight: 600; padding: 15px 40px; border-radius: 30px; width: 200px; font-size: 18px; border: none; transition: all 0.3s ease; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
            Book Now
        </button>
    </div>
</form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<?php include('footer.php'); ?>
