<?php
// Get booking details from the session or database
// This would depend on your existing structure, for now assume it's coming from the session or passed as parameters
$name = $_SESSION['name'];  // Assuming you store the user's name in a session
$hotel = $_SESSION['hotel'];
$check_in = $_SESSION['check_in'];
$check_out = $_SESSION['check_out'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <style>

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.confirmation {
    background-color: white;
    width: 60%;
    margin: 50px auto;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.confirmation h1 {
    color: #0066cc;
}

.confirmation h3 {
    color: #333;
}

.confirmation ul {
    list-style-type: none;
    padding: 0;
}

.confirmation li {
    margin: 10px 0;
}

.confirmation p {
    font-size: 18px;
    color: #555;
}

    </style>
</head>
<body>
    <div class="confirmation">
        <h1>Booking Confirmed</h1>
        <p>Dear <?php echo $name; ?>, your booking has been confirmed.</p>
        <h3>Booking Details</h3>
        <ul>
            <li><strong>Hotel:</strong> <?php echo $hotel; ?></li>
            <li><strong>Check-in:</strong> <?php echo $check_in; ?></li>
            <li><strong>Check-out:</strong> <?php echo $check_out; ?></li>
        </ul>
        <p>Thank you for choosing our Travel Management System!</p>
    </div>
</body>
</html>
