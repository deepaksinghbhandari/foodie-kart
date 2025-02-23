<?php include('header.php'); ?>
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

<!-- Hero Section -->
<section id="hero" class="d-flex justify-content-center align-items-center" 
    style="background-image: url('https://images.pexels.com/photos/260922/pexels-photo-260922.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'); 
    background-size: cover;
    margin-top: 0px;
    height: 600px;
    background-repeat: no-repeat; 
    background-position: center center;">

  <div class="text-center" style="margin-top: 100px;"> <!-- Adjusted margin-top -->
    <!-- Hero Heading -->
    <h1 data-aos="fade-up" data-aos-delay="200" class="display-4 font-weight-bold text-shadow" 
         style="color: #ff5722;
               font-family: 'Lobster', cursive; 
               font-size: 4.5rem; 
               letter-spacing: 3px; 
               text-transform: uppercase; 
               text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); 
               font-weight: 700;">
      Welcome to Foodie Kart
    </h1>
    
    <!-- Subheading Text -->
    <p data-aos="fade-up" data-aos-delay="400" class="lead text-shadow" 
       style="font-size: 2rem; color:white; font-weight: bold; max-width: 800px; margin: 0 auto;">
      Explore the best food in town, delivered right to your doorstep.
    </p>

   <!-- Explore Menu Button -->
   <a href="food-menu.php" class="btn btn-explore" data-aos="fade-up" data-aos-delay="600" aria-label="Explore the food menu">
      Explore Menu
    </a>
  </div>
</section>


<!-- Featured Menu Section -->
<section id="featured" class="py-5" style="background-color: #f8f9fa;">
  <div class="container">
    <h2 data-aos="fade-up" class="text-center mb-4" style="color: #ff5722;">Featured Dishes</h2>
    <div class="row">

    <?php
    // Database connection
    include('db_connection.php'); // Assuming db_connection.php connects to your database

    // Query to fetch menu items
    $query = "SELECT * FROM menu_items LIMIT 3"; // Adjust the LIMIT if needed
    $result = mysqli_query($conn, $query);

    // Check if there are results
    if (mysqli_num_rows($result) > 0) {
        // Loop through the results and display each item
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $image_url = $row['image_url'];
            ?>

            <!-- Featured Dish -->
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card shadow-sm border-0 rounded-lg">
                    <img src="<?php echo $image_url; ?>" class="card-img-top rounded-top" alt="<?php echo $name; ?>" style="max-width: 100%; height: auto;">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #FF6F61;"><?php echo $name; ?></h5>
                        <p class="card-text"><?php echo $description; ?></p>
                        <p class="card-text"><strong>Price:</strong> $<?php echo $price; ?></p>
                        <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-danger rounded-pill py-2 px-4" aria-label="Order <?php echo $name; ?>">Order Now</a>
                    </div>
                </div>
            </div>

            <?php
        }
    } else {
        echo "<p>No featured dishes available.</p>";
    }

    // Close the connection
    mysqli_close($conn);
    ?>

    </div>
  </div>
</section>

<!-- About Us Section -->
<section id="about" class="py-5" style="background-color: #f1f1f1;">
  <div class="container">
    <div class="row">
      <div class="col-md-6" data-aos="fade-right">
        <h2 style="color: #ff5722; font-size: 2.5rem; font-weight: 700;">About Us</h2>
        <p style="font-size: 1.125rem; color: #555;">
          At Foodie Kart, we are passionate about food and delivering the best dining experience directly to your doorstep. We are a team of chefs, food enthusiasts, and customer service professionals who have one goal in mind: to bring the finest meals to our customers, wherever they are.
        </p>
        <p style="font-size: 1.125rem; color: #555;">
          Our menu is carefully crafted to cater to all tastes, offering everything from indulgent pizzas and savory burgers to fresh salads and healthy bowls. Every dish is prepared with the highest quality ingredients to ensure you get not only great taste but also a healthy and satisfying meal.
        </p>
        <p style="font-size: 1.125rem; color: #555;">
          We believe food is more than just fuel - it's an experience to be enjoyed. Whether you're treating yourself after a long day, enjoying a meal with friends, or feeding your family, Foodie Kart is here to make sure every bite is a delight.
        </p>
        <p style="font-size: 1.125rem; color: #555;">
          We are committed to quality, service, and sustainability. Our team works tirelessly to ensure that every meal not only exceeds expectations but also promotes eco-friendly practices. Join us in our mission to make dining an experience worth sharing.
        </p>
      </div>
      <div class="col-md-6" data-aos="fade-left">
        <img src="https://images.pexels.com/photos/3298687/pexels-photo-3298687.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="About Us" class="img-fluid rounded shadow-lg" style="max-height: 100%; object-fit: cover;">
      </div>
    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section id="testimonials" class="py-5" style="background-color: #e9ecef;">
  <div class="container">
    <h2 data-aos="fade-up" class="text-center mb-4" style="color: #ff5722;">Customer Testimonials</h2>
    <div class="row">
      <!-- Testimonial 1 -->
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <p class="card-text">"The best pizza I've ever had! I order from them, and they never disappoint!" goated food </p>
            <footer class="blockquote-footer">John Doe</footer>
          </div>
        </div>
      </div>
      <!-- Testimonial 2 -->
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <p class="card-text">"The quality and freshness of the food are incredible! I love their healthy salad options!"</p>
            <footer class="blockquote-footer">Jane Smith</footer>
          </div>
        </div>
      </div>
      <!-- Testimonial 3 -->
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="600">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <p class="card-text">"Fast delivery and amazing taste! Never fails to impress me with so many options!"</p>
            <footer class="blockquote-footer">Alex Johnson</footer>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer Section (Include footer.php here) -->
<?php include('footer.php'); ?>

<!-- Optional: AOS (animations on scroll) -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();  // Initialize AOS for animation
</script>

<!-- Styles for the button -->
<style>
  .btn-explore {
    padding: 18px 40px;
    font-size: 1.7rem;
    font-weight: bold;
    border-radius: 50px;
    background-color: #ff5722;
    color: white;
    text-transform: uppercase;
    border: none;
    transition: all 0.3s ease;
    text-decoration: none;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    margin-top: 30px; /* Added space above */
  }

  .btn-explore:hover {
    background-color: #e64a19; /* Darker orange on hover */
    color: white;
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
    transform: translateY(-5px) scale(1.05); /* Slight scale effect */
  }

  .btn-explore:active {
    background-color: #d84315; /* Even darker on click */
    transform: translateY(0) scale(1); /* Reset scale effect */
    box-shadow: none;
  }
</style>
