<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch destination from the database
$sql = "SELECT id, state, country FROM destinations ORDER BY state";
$result = $conn->query($sql);

$destination = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $destination[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Booking - Travel Management System</title>
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
            background-image: url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=1920&q=80');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .container {
            max-width: 900px;
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
        form {
            display: grid;
            gap: 25px;
            grid-template-columns: 1fr 1fr;
        }
        .full-width {
            grid-column: 1 / -1;
        }
        label {
            font-weight: 600;
            color: #4a4a4a;
            display: block;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }
        input, select {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.8);
        }
        input:focus, select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.25);
        }
        button {
            grid-column: 1 / -1;
            padding: 15px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .message {
            grid-column: 1 / -1;
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        @media (max-width: 768px) {
            form {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Book Your Flight</h1>
        <form action="confirm.php" method="post">
            <div>
                <label for="departure">Departure state</label>
                <input type="text" name="departure" id="departure" required placeholder="Enter your departure state">
            </div>
            <div>
                <label for="destination">Destination</label>
                <select name="destination" id="destination" required>
                    <option value="">Select a destination</option>
                    <?php foreach ($destination as $destination): ?>
                        <option value="<?php echo htmlspecialchars($destination['id']); ?>">
                            <?php echo htmlspecialchars($destination['state'] . ', ' . $destination['country']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="departure_date">Departure Date</label>
                <input type="date" name="departure_date" id="departure_date" required>
            </div>
            <div>
                <label for="return_date">Return Date (optional)</label>
                <input type="date" name="return_date" id="return_date">
            </div>
            <div>
                <label for="passengers">Number of Passengers</label>
                <input type="number" name="passengers" id="passengers" min="1" max="10" required placeholder="1">
            </div>
            <div>
                <label for="class">Class</label>
                <select name="class" id="class" required>
                    <option value="">Select a class</option>
                    <option value="Economy">Economy</option>
                    <option value="Business">Business</option>
                    <option value="First Class">First Class</option>
                </select>
            </div>
            <div class="full-width">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" required placeholder="Enter your full name">
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required placeholder="Enter your email">
            </div>
            <div>
                <label for="phone">Phone Number</label>
                <input type="tel" name="phone" id="phone" required placeholder="Enter your phone number">
            </div>
            <button type="submit">Book Your Flight</button>
        </form>
        <?php
        if (isset($_GET['message']) && isset($_GET['messageClass'])) {
            $message = htmlspecialchars($_GET['message']);
            $messageClass = htmlspecialchars($_GET['messageClass']);
            echo "<div class='message $messageClass'>$message</div>";
        }
        ?>
    </div>
    <script>
        document.querySelectorAll('input, select').forEach(element => {
            element.addEventListener('focus', () => {
                element.parentElement.querySelector('label').style.color = '#667eea';
            });
            element.addEventListener('blur', () => {
                element.parentElement.querySelector('label').style.color = '#4a4a4a';
            });
        });
    </script>
</body>
</html>