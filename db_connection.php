<?php
// Database connection variables
$servername = "localhost";  // Usually "localhost" for XAMPP
$username = "root";         // Default MySQL username in XAMPP
$password = "";             // Default MySQL password in XAMPP (empty by default)
$dbname = "tms";  // Replace with your actual database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
