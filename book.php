<?php
// Start the session (optional)
session_start();

// Include database connection
include('conn.php');  // Ensure this file contains the connection to your database

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $state = htmlspecialchars($_POST['state']);
    $hotel = htmlspecialchars($_POST['hotel']);
    $check_in = htmlspecialchars($_POST['check_in']);
    $check_out = htmlspecialchars($_POST['check_out']);
    $guests = htmlspecialchars($_POST['guests']);
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);

    // Prepare SQL to insert booking into the database
    $sql = "INSERT INTO booking (state, hotel, check_in, check_out, guests, name, email, phone)
            VALUES (:state, :hotel, :check_in, :check_out, :guests, :name, :email, :phone)";
    
    $stmt = $pdo->prepare($sql);
    
    // Bind the parameters to the SQL query
    $stmt->bindParam(':state', $state);
    $stmt->bindParam(':hotel', $hotel);
    $stmt->bindParam(':check_in', $check_in);
    $stmt->bindParam(':check_out', $check_out);
    $stmt->bindParam(':guests', $guests);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    
    // Execute the query and insert the data into the database
    if ($stmt->execute()) {
        // Data inserted successfully, get the last inserted ID (Booking ID)
        $last_id = $pdo->lastInsertId();
        
        // Redirect to the confirmation page with the booking details
        header("Location: confirm.html");
        exit(); // Make sure to exit after redirection
    } else {
        // If the insert failed, show an error message
        echo "There was an error while processing your booking. Please try again.";
        exit();
    }
} else {
    // Redirect to booking page if the form was not submitted
    header("Location: book.html");
    exit();
}
