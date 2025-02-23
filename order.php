<?php
include('header.php');
include('db_connection.php');

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Initialize order session if not already initialized
if (!isset($_SESSION['order'])) {
    $_SESSION['order'] = [];
}

// Check if the food ID is provided in the URL
if (isset($_GET['food_id'])) {
    $food_id = intval($_GET['food_id']); // Ensure food_id is an integer

    // Query to get item details from the menu
    $query = "SELECT * FROM menu_items WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $food_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($item = $result->fetch_assoc()) {
        $item_id = $item['id'];
        $name = $item['name'];
        $price = $item['price'];
        $description = $item['description'];
        $image_url = $item['image_url'];

        // Add or update item in the cart
        if (isset($_SESSION['order'][$item_id])) {
            $_SESSION['order'][$item_id]['quantity']++;
        } else {
            $_SESSION['order'][$item_id] = [
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'quantity' => 1,
                'image_url' => $image_url
            ];
        }

        // Redirect back to the cart page after adding
        header("Location: cart.php");
        exit();
    } else {
        // Redirect with an error message if no item is found
        header("Location: food-menu.php?error=ItemNotFound");
        exit();
    }

    $stmt->close();
} else {
    // Redirect if food_id is missing
    header("Location: food-menu.php?error=MissingFoodID");
    exit();
}
?>
