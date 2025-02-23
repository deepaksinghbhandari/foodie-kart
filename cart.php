<?php 
include('header.php'); 

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Handle item removal and quantity updates
if (isset($_GET['remove'])) {
    $item_id = filter_var($_GET['remove'], FILTER_SANITIZE_NUMBER_INT);
    if (isset($_SESSION['order'][$item_id])) {
        unset($_SESSION['order'][$item_id]);
        header("Location: cart.php"); 
        exit;
    }
}

if (isset($_GET['update'])) {
    $item_id = filter_var($_GET['update'], FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_var($_GET['quantity'], FILTER_SANITIZE_NUMBER_INT);
    if ($quantity > 0 && isset($_SESSION['order'][$item_id])) {
        $_SESSION['order'][$item_id]['quantity'] = $quantity; 
        header("Location: cart.php");
        exit;
    }
}

if (!isset($_SESSION['order'])) {
    $_SESSION['order'] = [];
}

$total_price = 0;
if (!empty($_SESSION['order'])) {
    foreach ($_SESSION['order'] as $item_id => $item) {
        $total_price += $item['price'] * $item['quantity'];
    }
}
?>

<!-- Cart Section -->
<section id="cart" class="py-5" style="background-image: url('https://images.pexels.com/photos/260922/pexels-photo-260922.jpeg'); background-size: cover; background-position: center center; margin-top: -20px;">
    <div class="container">
        <h2 class="text-center mb-5" style="font-family: 'Lobster', cursive; color: #ff5722; font-size: 2.5rem;">Your Cart</h2>

        <?php if (empty($_SESSION['order'])): ?>
            <div class="alert alert-info text-center py-5" style="background-color: #f9f9f9; border-radius: 10px;">
                <h4 class="mb-4" style="font-size: 1.5rem; color: #555;">Your cart is currently empty!</h4>
                <p class="mb-3" style="font-size: 1.1rem; color: #777;">Browse our delicious menu and add items to your cart!</p>
                <a href="food-menu.php" class="btn btn-lg btn-primary rounded-pill px-5" style="font-size: 1.2rem; background-color: #ff5722; border-color: #ff5722;">Browse Menu</a>
            </div>
        <?php else: ?>
            <div class="row">
                <!-- Cart Items Section -->
                <div class="col-md-12 col-lg-8 mb-4">
                    <div class="card shadow-lg rounded-lg">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <?php foreach ($_SESSION['order'] as $item_id => $item): ?>
                                    <li class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 p-4 rounded-lg" style="background-color: #ffffff; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                                        <div class="d-flex align-items-center">
                                            <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="img-fluid rounded" width="90" height="90" style="object-fit: cover; margin-right: 15px;">
                                            <div>
                                                <h5 class="mb-1" style="font-size: 1.2rem; font-weight: 600;"><?= htmlspecialchars($item['name']) ?></h5>
                                                <p class="mb-0 text-muted" style="font-size: 1rem;">Price: $<?= number_format($item['price'], 2) ?> x <?= $item['quantity'] ?></p>
                                            </div>
                                        </div>
                                        <div class="text-center text-md-right mt-3 mt-md-0">
                                            <span class="h5 text-primary">$<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                                            <div class="btn-group ml-md-3">
                                                <a href="cart.php?update=<?= $item_id ?>&quantity=<?= max(1, $item['quantity'] - 1) ?>" class="btn btn-outline-secondary btn-sm">
                                                    <i class="fas fa-minus"></i>
                                                </a>
                                                <span class="btn btn-outline-secondary btn-sm"><?= $item['quantity'] ?></span>
                                                <a href="cart.php?update=<?= $item_id ?>&quantity=<?= $item['quantity'] + 1 ?>" class="btn btn-outline-secondary btn-sm">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                            </div>
                                            <a href="cart.php?remove=<?= $item_id ?>" class="btn btn-danger btn-sm mt-2 mt-md-0 ml-md-3" onclick="return confirm('Are you sure you want to remove this item?')">
                                                <i class="fas fa-trash-alt"></i> Remove
                                            </a>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Cart Summary Section -->
                <div class="col-md-12 col-lg-4">
                    <div class="card shadow-lg border-0 rounded-lg p-4 sticky-cart">
                        <h5 class="text-center mb-4" style="font-size: 1.4rem; font-weight: 600;">Total: $<?= number_format($total_price, 2) ?></h5>
                        <a href="checkout.php" class="btn btn-lg btn-success btn-block rounded-pill py-3 mb-3">
                            Proceed to Checkout
                        </a>
                        <a href="food-menu.php" class="btn btn-lg btn-primary btn-block rounded-pill py-3">
                            Add More Items
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Footer Section -->
<?php include('footer.php'); ?>

<!-- AOS Animations -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();  
</script>

<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<!-- Responsive CSS -->
<style>
  @media (max-width: 768px) {
    .btn-group .btn {
      width: 35px;
      padding: 5px;
    }
    .text-md-right {
      text-align: center !important;
    }
  }

  .btn-primary:hover, .btn-success:hover {
    background-color: #2980b9;
    color: white;
  }

  .btn-danger:hover {
    background-color: #e74c3c;
    color: white;
  }

  .list-group-item:hover {
    background-color: #f7f7f7;
    transform: translateY(-3px);
  }

  .card {
    background-color: #ffffff;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
  }

  .sticky-cart {
    position: -webkit-sticky;
    position: sticky;
    top: 10px;
  }
</style>
