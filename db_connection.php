<?php
// Database connection details
$servername = "localhost";  // Usually 'localhost' or the IP address of your database server
$username = "root";         // Your database username (default for XAMPP is 'root')
$password = "";             // Your database password (default for XAMPP is an empty string)
$dbname = "foodwebsite";    // The name of your database

// Create a connection to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set the character set to UTF-8 to handle any special characters
mysqli_set_charset($conn, "utf8");
?>
