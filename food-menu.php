<?php
session_start(); // Start the session

// Include the database connection
include('db_connection.php');

// Initialize the order if it doesn't exist
if (!isset($_SESSION['order'])) {
    $_SESSION['order'] = [];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Menu</title>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-image: url('https://images.pexels.com/photos/260922/pexels-photo-260922.jpeg'); background-size: cover; background-position: center center;">

<?php include('header.php'); ?>

<!-- Food Menu Section -->
<section id="food-menu" class="py-5">
  <div class="container">
    <h2 class="text-center mb-4" style="font-family: 'Lobster', cursive; color: #FF6F61;" data-aos="fade-up">Our Menu</h2>
    <p class="text-center mb-5" data-aos="fade-up" data-aos-delay="200" style="font-size: 1.2rem; color: white;">
      Explore our delicious food menu! We offer a wide variety of mouthwatering dishes, from appetizers to desserts.
    </p>

    <!-- Featured Dishes -->
    <div class="featured-dishes mb-5">
      <h3 class="text-center mb-4" data-aos="fade-up" style="color:  #FF6F61;">Featured Dishes</h3>
      <div class="row">
        <!-- Featured Dish 1 -->
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
          <div class="card shadow-sm border-0 rounded-lg">
            <img src="https://images.pexels.com/photos/30301975/pexels-photo-30301975/free-photo-of-gourmet-square-pizza-with-meatballs-on-metal-peel.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top rounded-top" alt="Delicious Pizza">
            <div class="card-body">
              <h5 class="card-title" style="color: #FF6F61;">Delicious Pizza</h5>
              <p class="card-text">Taste the finest pizza, made with fresh ingredients and baked to perfection.</p>
              <a href="order.php?food_id=1" class="btn btn-danger rounded-pill py-2 px-4">Order Now</a>
            </div>
          </div>
        </div>

        <!-- Featured Dish 2 -->
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="400">
          <div class="card shadow-sm border-0 rounded-lg">
            <img src="https://images.pexels.com/photos/8995201/pexels-photo-8995201.jpeg" class="card-img-top rounded-top" alt="Healthy Salad">
            <div class="card-body">
              <h5 class="card-title" style="color: #FF6F61;">Healthy Salad</h5>
              <p class="card-text">A refreshing salad with organic greens and a zesty dressing.</p>
              <a href="order.php?food_id=2" class="btn btn-danger rounded-pill py-2 px-4">Order Now</a>
            </div>
          </div>
        </div>

        <!-- Featured Dish 3 -->
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="600">
          <div class="card shadow-sm border-0 rounded-lg">
            <img src="https://images.pexels.com/photos/18867543/pexels-photo-18867543/free-photo-of-burger-served-in-a-restaurant.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top rounded-top" alt="Tasty Burger">
            <div class="card-body">
              <h5 class="card-title" style="color: #FF6F61;">Tasty Burger</h5>
              <p class="card-text">Juicy, grilled burgers with your favorite toppings!</p>
              <a href="order.php?food_id=3" class="btn btn-danger rounded-pill py-2 px-4">Order Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Menu Categories -->
    <div class="row">
      <!-- Appetizers -->
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
        <div class="card shadow rounded-lg">
          <img src="https://images.pexels.com/photos/21856002/pexels-photo-21856002/free-photo-of-food-selection-on-plate.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top rounded-top" alt="Appetizers">
          <div class="card-body">
            <h5 class="card-title">Appetizers</h5>
            <p class="card-text">Start your meal with our delicious appetizers. Perfect to kick off any meal!</p>
            <a href="#appetizers" class="btn btn-primary rounded-pill py-2 px-4">View Menu</a>
          </div>
        </div>
      </div>

      <!-- Main Course -->
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="400">
        <div class="card shadow rounded-lg">
          <img src="https://images.pexels.com/photos/17650193/pexels-photo-17650193/free-photo-of-food-on-a-table.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top rounded-top" alt="Main Course">
          <div class="card-body">
            <h5 class="card-title">Main Course</h5>
            <p class="card-text">Satisfy your hunger with a perfect balance of flavors!</p>
            <a href="#main-course" class="btn btn-primary rounded-pill py-2 px-4">View Menu</a>
          </div>
        </div>
      </div>

      <!-- Desserts -->
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="500">
        <div class="card shadow rounded-lg">
          <img src="https://images.pexels.com/photos/11719203/pexels-photo-11719203.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top rounded-top" alt="Desserts">
          <div class="card-body">
            <h5 class="card-title">Desserts</h5>
            <p class="card-text">End your meal on a sweet note with our delectable desserts. Treat yourself!</p>
            <a href="#desserts" class="btn btn-primary rounded-pill py-2 px-4">View Menu</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Menu Details (Appetizers, Main Course, Desserts) -->
    <div id="appetizers" class="menu-category mt-5">
      <h3 class="text-center mb-5" style="color: #FF6F61;" data-aos="fade-up">Appetizers</h3>
      <div class="row">
        <!-- Appetizer Item 1 -->
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="600">
          <div class="card shadow">
            <img src="https://images.pexels.com/photos/15801051/pexels-photo-15801051/free-photo-of-spring-rolls-and-sauces.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Spring Rolls">
            <div class="card-body">
              <h5 class="card-title">Spring Rolls</h5>
              <p class="card-text">Crispy rolls stuffed with vegetables and served with a sweet dipping sauce.</p>
              <p class="price">$5.99</p>
              <a href="order.php?food_id=4" class="btn btn-danger rounded-pill py-2 px-4">Order Now</a>
            </div>
          </div>
        </div>

        <!-- Appetizer Item 2 -->
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="650">
          <div class="card shadow">
            <img src="https://images.pexels.com/photos/9951852/pexels-photo-9951852.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Garlic Bread">
            <div class="card-body">
              <h5 class="card-title">Garlic Bread</h5>
              <p class="card-text">Freshly baked bread with garlic butter, a perfect starter to any meal!</p>
              <p class="price">$4.49</p>
              <a href="order.php?food_id=5" class="btn btn-danger rounded-pill py-2 px-4">Order Now</a>
            </div>
          </div>
        </div>

        <!-- Appetizer Item 3 -->
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="700">
          <div class="card shadow">
            <img src="https://images.pexels.com/photos/29285460/pexels-photo-29285460/free-photo-of-delicious-loaded-fries-with-cheese-and-sauces.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Mozzarella Sticks">
            <div class="card-body">
              <h5 class="card-title">Mozzarella Sticks</h5>
              <p class="card-text">Golden, crispy mozzarella sticks served with marinara sauce.</p>
              <p class="price">$6.99</p>
              <a href="order.php?food_id=6" class="btn btn-danger rounded-pill py-2 px-4">Order Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Course Section -->
    <div id="main-course" class="menu-category mt-5">
      <h3 class="text-center mb-5" style="color: #FF6F61;" data-aos="fade-up">Main Course</h3>
      <div class="row">
        <!-- Main Course Item 1 -->
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="700">
          <div class="card shadow">
            <img src="https://images.pexels.com/photos/7426867/pexels-photo-7426867.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Chicken Curry">
            <div class="card-body">
              <h5 class="card-title">Chicken Curry</h5>
              <p class="card-text">Tender chicken cooked in a rich and flavorful curry sauce. Served with rice.</p>
              <p class="price">$12.99</p>
              <a href="order.php?food_id=7" class="btn btn-danger rounded-pill py-2 px-4">Order Now</a>
            </div>
          </div>
        </div>

        <!-- Main Course Item 2 -->
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="750">
          <div class="card shadow">
            <img src="https://images.pexels.com/photos/8743944/pexels-photo-8743944.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Grilled Steak">
            <div class="card-body">
              <h5 class="card-title">Grilled Steak</h5>
              <p class="card-text">Juicy, tender steak grilled to perfection. Served with mashed potatoes.</p>
              <p class="price">$18.99</p>
              <a href="order.php?food_id=8" class="btn btn-danger rounded-pill py-2 px-4">Order Now</a>
            </div>
          </div>
        </div>

        <!-- Main Course Item 3 -->
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="800">
          <div class="card shadow">
            <img src="https://images.pexels.com/photos/26597663/pexels-photo-26597663/free-photo-of-close-up-of-pasta-with-meat.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Vegetarian Pasta">
            <div class="card-body">
              <h5 class="card-title">Vegetarian Pasta</h5>
              <p class="card-text">Pasta with a variety of fresh vegetables in a rich tomato sauce.</p>
              <p class="price">$10.99</p>
              <a href="order.php?food_id=9" class="btn btn-danger rounded-pill py-2 px-4">Order Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Desserts Section -->
    <div id="desserts" class="menu-category mt-5">
      <h3 class="text-center mb-5" style="color: #FF6F61;" data-aos="fade-up">Desserts</h3>
      <div class="row">
        <!-- Dessert Item 1 -->
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="900">
          <div class="card shadow">
            <img src="https://images.pexels.com/photos/2955818/pexels-photo-2955818.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Chocolate Cake">
            <div class="card-body">
              <h5 class="card-title">Chocolate Cake</h5>
              <p class="card-text">Rich and decadent chocolate cake, perfect for dessert lovers!</p>
              <p class="price">$6.49</p>
              <a href="order.php?food_id=10" class="btn btn-danger rounded-pill py-2 px-4">Order Now</a>
            </div>
          </div>
        </div>

        <!-- Dessert Item 2 -->
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="950">
          <div class="card shadow">
            <img src="https://images.pexels.com/photos/14775030/pexels-photo-14775030.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Cheesecake">
            <div class="card-body">
              <h5 class="card-title">Cheesecake</h5>
              <p class="card-text">A creamy, delicious cheesecake topped with fresh berries.</p>
              <p class="price">$7.99</p>
              <a href="order.php?food_id=11" class="btn btn-danger rounded-pill py-2 px-4">Order Now</a>
            </div>
          </div>
        </div>

        <!-- Dessert Item 3 -->
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="1000">
          <div class="card shadow">
            <img src="https://images.pexels.com/photos/1055272/pexels-photo-1055272.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Chocolate Chip Cookies">
            <div class="card-body">
              <h5 class="card-title">Chocolate Chip Cookies</h5>
              <p class="card-text">Soft and chewy cookies filled with rich chocolate chips.</p>
              <p class="price">$4.99</p>
              <a href="order.php?food_id=12" class="btn btn-danger rounded-pill py-2 px-4">Order Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<?php include('footer.php'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
