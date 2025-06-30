<?php
session_start();  // Start the session

// Include the database connection
include('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set
    if (isset($_POST['master_name']) && isset($_POST['password'])) {
        // Get the input data
        $master_name = $_POST['master_name'];
        $password = $_POST['password'];

        // Prepare SQL query to select user with the given master_name
        $sql = "SELECT * FROM login WHERE master_name = :master_name LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':master_name', $master_name, PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        // Fetch the user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Compare the entered password with the stored password
        if ($user && $password === $user['password']) {
            // If passwords match, start the session and redirect to destination.html
            $_SESSION['logged_in'] = true;
            $_SESSION['master_name'] = $user['master_name'];

            // Redirect to destination.html after successful login
            header("Location: main_page.html");
            exit;
        } else {
            // Invalid credentials
            echo "Invalid username or password.";
        }
    } else {
        echo "Please provide both username and password.";
    }
}
?>
