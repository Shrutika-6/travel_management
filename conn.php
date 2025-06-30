<?php
// Database connection details
$host = 'localhost';        // Localhost if running MySQL locally
$dbname = 'tms';            // Database name
$username = 'root';         // Default MySQL username in XAMPP
$password = '';             // Default password is empty for XAMPP

// Create the PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Enable error handling
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();  // Error message if connection fails
    exit();
}
?>
