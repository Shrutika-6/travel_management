<?php
// Include database connection
require_once 'db_connection.php';  // Assuming you have a file for DB connection

// Collect form data
$name = $_POST['name'];
$email = $_POST['email'];
$hotel = $_POST['hotel'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];

// Insert the booking into the database (assuming you have a bookings table)
$sql = "INSERT INTO booking (name, email, hotel, check_in, check_out) 
        VALUES ('$name', '$email', '$hotel', '$check_in', '$check_out')";

if (mysqli_query($conn, $sql)) {
    // If booking is successful, send confirmation email
    $subject = "Booking Confirmation - Travel Management System";
    $message = "
    <html>
    <head>
        <title>Booking Confirmation</title>
    </head>
    <body>
        <h2>Dear $name,</h2>
        <p>Your booking has been successfully confirmed.</p>
        <p><strong>Booking Details:</strong></p>
        <ul>
            <li><strong>Hotel:</strong> $hotel</li>
            <li><strong>Check-in:</strong> $check_in</li>
            <li><strong>Check-out:</strong> $check_out</li>
        </ul>
        <p>Thank you for choosing our Travel Management System!</p>
    </body>
    </html>
    ";

    // Set Content-type header for HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: no-reply@yourwebsite.com' . "\r\n";

    // Send email
    if (mail($email, $subject, $message, $headers)) {
        echo "Booking confirmed! A confirmation email has been sent to $email.";
    } else {
        echo "Error: Unable to send the confirmation email.";
    }

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);  // Close the database connection
?>
