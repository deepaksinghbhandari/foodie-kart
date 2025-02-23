<?php
// Start session only if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Initialize user and cart variables
$is_logged_in = isset($_SESSION['user_id']);  // Check if user is logged in
$user_name = $is_logged_in && isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "Guest";  // User or Guest
$user_picture = $is_logged_in && isset($_SESSION['user_picture']) ? $_SESSION['user_picture'] : "default-profile.png";  // Profile picture

// Calculate total cart items
$cart_item_count = 0;
if (!empty($_SESSION['order']) && is_array($_SESSION['order'])) {
    foreach ($_SESSION['order'] as $item) {
        $cart_item_count += isset($item['quantity']) ? $item['quantity'] : 0;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Foodie Kart</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="foodie-kart.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    .navbar {
      padding: 0.5rem 1rem;
    }
    .navbar-brand {
      font-family: 'Lobster', cursive;
      font-size: 1.8rem;
      color: #FF6347;
    }
    .cart-icon {
      font-size: 1.2rem;
      position: relative;
    }
    .cart-item-count {
      position: absolute;
      top: -5px;
      right: -10px;
      background-color: red;
      color: white;
      font-size: 0.75rem;
      padding: 3px 6px;
      border-radius: 50%;
      font-weight: bold;
    }
    .dropdown-menu {
      min-width: 200px;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Foodie Kart</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="food-menu.php">Food Menu</a></li>
        <li class="nav-item"><a class="nav-link" href="booking-table.php">Booking Table</a></li>
        <li class="nav-item"><a class="nav-link" href="contacts.php">Contact</a></li>
        <li class="nav-item"><a class="nav-link" href="about-us.php">About Us</a></li>

        <!-- Cart Section -->
        <li class="nav-item">
          <a class="nav-link cart-icon" href="cart.php">
            <i class="fas fa-shopping-cart"></i>
            <?php if ($cart_item_count > 0): ?>
              <span class="cart-item-count"><?= htmlspecialchars($cart_item_count) ?></span>
            <?php endif; ?>
          </a>
        </li>

        <!-- Profile Section -->
        <?php if ($is_logged_in): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="<?= htmlspecialchars($user_picture) ?>" alt="Profile picture" class="rounded-circle" width="30" height="30">
              <?= htmlspecialchars($user_name) ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="view-orders.php">My Orders</a></li>
              <li><a class="dropdown-item" href="booking-page.php">My Bookings</a></li>
              <li><a class="dropdown-item" href="logout.php?logout=true">Logout</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Logout logic -->
<?php
if (isset($_GET['logout']) && filter_var($_GET['logout'], FILTER_VALIDATE_BOOLEAN)) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
