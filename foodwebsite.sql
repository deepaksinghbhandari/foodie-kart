-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2025 at 04:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodwebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `people` int(11) NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `special_requests` text DEFAULT NULL,
  `booking_time` datetime NOT NULL,
  `status` varchar(50) DEFAULT 'Confirmed',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `email`, `people`, `reservation_date`, `reservation_time`, `special_requests`, `booking_time`, `status`, `user_id`) VALUES
(15, 'suraj', 'surajjoshi@123.com', 9, '2025-01-19', '01:00:00', '', '2025-01-24 14:31:06', 'Confirmed', 0),
(16, 'suraj', 'deepakbhandari8008@gmail.com', 8, '2025-01-31', '01:00:00', '', '2025-01-24 14:35:05', 'Confirmed', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `message`, `submitted_at`) VALUES
(1, 'deepak singh bhandari', 'deepakbhandari8008@gmail.com', 'xcc', '2025-01-24 07:16:21');

-- --------------------------------------------------------

--
-- Table structure for table `email_verification`
--

CREATE TABLE `email_verification` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_verification`
--

INSERT INTO `email_verification` (`id`, `email`, `token`, `created_at`) VALUES
(1, 'deepakbhandari8008@gmail.com', 'd715a74fdfc31776860c045249097f71', '2025-01-23 09:10:30');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `name`, `description`, `price`, `image_url`, `category`) VALUES
(1, 'Delicious Pizza', 'Taste the finest pizza, made with fresh ingredients and baked to perfection.', 8.99, 'https://images.pexels.com/photos/30301975/pexels-photo-30301975/free-photo-of-gourmet-square-pizza-with-meatballs-on-metal-peel.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 'Featured Dishes'),
(2, 'Healthy Salad', 'A refreshing salad with organic greens and a zesty dressing.', 5.99, 'https://images.pexels.com/photos/8995201/pexels-photo-8995201.jpeg', 'Featured Dishes'),
(3, 'Tasty Burger', 'Juicy, grilled burgers with your favorite toppings!', 6.99, 'https://images.pexels.com/photos/18867543/pexels-photo-18867543/free-photo-of-burger-served-in-a-restaurant.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 'Featured Dishes'),
(4, 'Spring Rolls', 'Crispy rolls stuffed with vegetables and served with a sweet dipping sauce.', 5.99, 'https://images.pexels.com/photos/15801051/pexels-photo-15801051/free-photo-of-spring-rolls-and-sauces.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 'Appetizers'),
(5, 'Garlic Bread', 'Freshly baked bread with garlic butter, a perfect starter to any meal!', 4.49, 'https://images.pexels.com/photos/9951852/pexels-photo-9951852.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 'Appetizers'),
(6, 'Mozzarella Sticks', 'Golden, crispy mozzarella sticks served with marinara sauce.', 6.99, 'https://images.pexels.com/photos/29285460/pexels-photo-29285460/free-photo-of-delicious-loaded-fries-with-cheese-and-sauces.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 'Appetizers'),
(7, 'Chicken Curry', 'Tender chicken cooked in a rich and flavorful curry sauce. Served with rice.', 12.99, 'https://images.pexels.com/photos/7426867/pexels-photo-7426867.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 'Main Course'),
(8, 'Grilled Steak', 'Juicy, tender steak grilled to perfection. Served with mashed potatoes.', 18.99, 'https://images.pexels.com/photos/8743944/pexels-photo-8743944.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 'Main Course'),
(9, 'Vegetarian Pasta', 'Pasta with a variety of fresh vegetables in a rich tomato sauce.', 10.99, 'https://images.pexels.com/photos/26597663/pexels-photo-26597663/free-photo-of-close-up-of-pasta-with-meat.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 'Main Course'),
(10, 'Chocolate Cake', 'Rich and decadent chocolate cake, perfect for dessert lovers!', 6.49, 'https://images.pexels.com/photos/2955818/pexels-photo-2955818.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 'Desserts'),
(11, 'Cheesecake', 'A creamy, delicious cheesecake topped with fresh berries.', 7.99, 'https://images.pexels.com/photos/14775030/pexels-photo-14775030.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 'Desserts'),
(12, 'Chocolate Chip Cookie', 'A warm, gooey chocolate chip cookie, fresh out of the oven.', 2.99, 'https://images.pexels.com/photos/1055272/pexels-photo-1055272.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 'Desserts');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `created_at`) VALUES
(1, 1, 4.49, '2025-01-23 16:28:41'),
(2, 1, 70.92, '2025-01-23 17:12:30'),
(3, 1, 6.99, '2025-01-23 17:36:15'),
(4, 1, 16.98, '2025-01-24 12:18:58'),
(5, 1, 5.99, '2025-01-24 12:32:55'),
(6, 1, 5.99, '2025-01-24 12:36:33'),
(7, 1, 7.99, '2025-01-24 13:32:21'),
(8, 1, 35.92, '2025-01-24 13:44:19'),
(9, 2, 5.99, '2025-01-24 17:19:50');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `item_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_name`, `item_price`, `item_quantity`) VALUES
(1, 1, 'Garlic Bread', 4.49, 1),
(2, 2, 'Spring Rolls', 5.99, 1),
(3, 2, 'Cheesecake', 7.99, 3),
(4, 2, 'Delicious Pizza', 8.99, 1),
(5, 2, 'Tasty Burger', 6.99, 1),
(6, 2, 'Grilled Steak', 18.99, 1),
(7, 2, 'Healthy Salad', 5.99, 1),
(8, 3, 'Tasty Burger', 6.99, 1),
(9, 4, 'Healthy Salad', 5.99, 1),
(10, 4, 'Vegetarian Pasta', 10.99, 1),
(11, 5, 'Healthy Salad', 5.99, 1),
(12, 6, 'Healthy Salad', 5.99, 1),
(13, 7, 'Cheesecake', 7.99, 1),
(14, 8, 'Chocolate Chip Cookie', 2.99, 5),
(15, 8, 'Tasty Burger', 6.99, 1),
(16, 8, 'Healthy Salad', 5.99, 1),
(17, 8, 'Cheesecake', 7.99, 1),
(18, 9, 'Healthy Salad', 5.99, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created_at`, `user_id`) VALUES
(1, 'deepakbhandari8008@gmail.com', '$2y$10$jWN9itQn6G4PvFgD9EILheGFPtkjwR8Uf45DBnacN.YJftNZiU56O', '2025-01-23 09:10:30', 1),
(2, 'surajjoshi@123.com', '$2y$10$7GAocdLemHBeuThxkOlRwOLoEWbfEE1bfvhlXxPnR1kYvc3yk/QTC', '2025-01-24 11:49:19', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_verification`
--
ALTER TABLE `email_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_verification`
--
ALTER TABLE `email_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
