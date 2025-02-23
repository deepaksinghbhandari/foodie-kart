<?php
// Include header and database connection files
include('header.php');
include('db_connection.php'); // Ensure this file contains your database connection details
?>

<section id="booking-confirmation" class="py-5" style="background-image: url('https://images.pexels.com/photos/260922/pexels-photo-260922.jpeg'); background-size: cover; background-position: center center; margin-top: -20px;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow-lg border-0 rounded-lg">
          <div class="card-body p-5">
            <h2 class="text-center mb-4" style="font-family: 'Lobster', cursive; color: #FF6F61;" data-aos="fade-up">Booking Confirmed!</h2>
            <p class="text-center mb-5" data-aos="fade-up" data-aos-delay="200">Thank you for booking with Foodie Kart! Your table is reserved.</p>

            <div class="confirmation-details" data-aos="fade-up" data-aos-delay="400">
              <?php
              // Check if the form was submitted
              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                  // Get form data
                  $name = htmlspecialchars($_POST['name']);
                  $email = htmlspecialchars($_POST['email']);
                  $people = htmlspecialchars($_POST['people']);
                  $date = htmlspecialchars($_POST['date']);
                  $hour = htmlspecialchars($_POST['hour']);
                  $minute = htmlspecialchars($_POST['minute']);
                  $ampm = htmlspecialchars($_POST['ampm']);
                  $requests = htmlspecialchars($_POST['requests']);

                  // Combine hour, minute, and AM/PM into a single time string
                  $time = $hour . ':' . $minute . ' ' . $ampm;

                  // Get current date and time for booking time
                  $booking_time = date("Y-m-d H:i:s"); // e.g., 2025-01-24 14:30:00

                  // Validate form inputs
                  if (empty($name) || empty($email) || empty($people) || empty($date) || empty($time)) {
                      echo "<p class='text-center text-danger'>Please fill in all required fields.</p>";
                      exit();
                  }

                  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                      echo "<p class='text-center text-danger'>Invalid email format.</p>";
                      exit();
                  }

                  if (!is_numeric($people) || $people <= 0) {
                      echo "<p class='text-center text-danger'>Number of people must be a positive number.</p>";
                      exit();
                  }

                  // Insert booking into database, including booking_time
                  $sql = "INSERT INTO bookings (name, email, people, reservation_date, reservation_time, special_requests, booking_time)
                          VALUES (?, ?, ?, ?, ?, ?, ?)";
                  $stmt = $conn->prepare($sql);
                  $stmt->bind_param("ssissss", $name, $email, $people, $date, $time, $requests, $booking_time);

                  if ($stmt->execute()) {
                      // Successfully inserted, show confirmation
                      echo "<ul class='list-unstyled' style='font-size: 18px; color: #333;'>
                                <li><strong>Name:</strong> $name</li>
                                <li><strong>Email:</strong> $email</li>
                                <li><strong>Number of People:</strong> $people</li>
                                <li><strong>Reservation Date:</strong> " . date("F j, Y", strtotime($date)) . "</li>
                                <li><strong>Reservation Time:</strong> $time</li>
                                <li><strong>Special Requests:</strong> " . ($requests ? $requests : 'None') . "</li>
                                <li><strong>Booking Time:</strong> " . date("F j, Y, g:i A", strtotime($booking_time)) . "</li>
                            </ul>";
                  } else {
                      echo "<p class='text-center text-danger'>Failed to save booking. Please try again later.</p>";
                  }

                  $stmt->close();
              } else {
                  echo "<p class='text-center text-danger'>Oops! Something went wrong. Please try again.</p>";
                  header("Refresh: 5; url=index.php");
                  exit();
              }
              ?>
            </div>

            <a href="index.php" class="btn btn-lg" style="background: linear-gradient(45deg, #FF6F61, #FF9A8B); color: white; font-weight: 600; padding: 12px 30px; border-radius: 25px; width: 200px; font-size: 18px; display: block; margin: 20px auto; text-align: center; text-decoration: none; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                Back to Home
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<?php include('footer.php'); ?>
