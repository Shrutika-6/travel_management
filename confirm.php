<?php
$message = '';
$messageClass = '';
$bookingDetails = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tms";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        $message = "Booking failed. Please try again later.";
        $messageClass = "error";
    } else {
        $departure = $_POST["departure"];
        $destination = $_POST["destination"];
        $departure_date = $_POST["departure_date"];
        $return_date = $_POST["return_date"] ? $_POST["return_date"] : null;
        $passengers = $_POST["passengers"];
        $class = $_POST["class"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];

        $sql = "INSERT INTO flightbookings (departure, destination, departure_date, return_date, passengers, class, name, email, phone) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssissss", $departure, $destination, $departure_date, $return_date, $passengers, $class, $name, $email, $phone);

        if ($stmt->execute()) {
            $message = "Flight Booking Successful!";
            $messageClass = "success";
            $bookingDetails = [
                'departure' => $departure,
                'destination' => $destination,
                'departure_date' => $departure_date,
                'return_date' => $return_date,
                'passengers' => $passengers,
                'class' => $class,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'confirmation_number' => strtoupper(uniqid())
            ];
        } else {
            $message = "Booking failed. Please try again.";
            $messageClass = "error";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - Travel Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }
        h1 {
            text-align: center;
            color: #4a4a4a;
            margin-bottom: 30px;
            font-size: 2.5em;
            font-weight: 600;
        }
        .message {
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 30px;
            font-weight: 600;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .booking-details {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .booking-details h2 {
            color: #4a4a4a;
            margin-bottom: 20px;
        }
        .booking-details p {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
        }
        .booking-details strong {
            color: #667eea;
        }
        .confirmation-number {
            text-align: center;
            font-size: 1.5em;
            color: #4a4a4a;
            margin-bottom: 30px;
        }
        .back-button {
            display: block;
            width: 200px;
            margin: 0 auto;
            padding: 10px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: transform 0.3s ease;
        }
        .back-button:hover {
            transform: translateY(-3px);
        }
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
            h1 {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Booking Confirmation</h1>
        <?php if (!empty($message)): ?>
            <div class="message <?php echo $messageClass; ?>"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <?php if ($bookingDetails): ?>
            <div class="booking-details">
                <h2>Booking Details</h2>
                <p><strong>Departure:</strong> <span><?php echo htmlspecialchars($bookingDetails['departure']); ?></span></p>
                <p><strong>Destination:</strong> <span><?php echo htmlspecialchars($bookingDetails['destination']); ?></span></p>
                <p><strong>Departure Date:</strong> <span><?php echo htmlspecialchars($bookingDetails['departure_date']); ?></span></p>
                <?php if (!empty($bookingDetails['return_date'])): ?>
                    <p><strong>Return Date:</strong> <span><?php echo htmlspecialchars($bookingDetails['return_date']); ?></span></p>
                <?php endif; ?>
                <p><strong>Passengers:</strong> <span><?php echo htmlspecialchars($bookingDetails['passengers']); ?></span></p>
                <p><strong>Class:</strong> <span><?php echo htmlspecialchars($bookingDetails['class']); ?></span></p>
                <p><strong>Name:</strong> <span><?php echo htmlspecialchars($bookingDetails['name']); ?></span></p>
                <p><strong>Email:</strong> <span><?php echo htmlspecialchars($bookingDetails['email']); ?></span></p>
                <p><strong>Phone:</strong> <span><?php echo htmlspecialchars($bookingDetails['phone']); ?></span></p>
            </div>
            <p class="confirmation-number">Confirmation Number: <strong><?php echo $bookingDetails['confirmation_number']; ?></strong></p>
        <?php endif; ?>
        
        <a href="flight.php" class="back-button">Book Another Flight</a>
    </div>
</body>
</html>