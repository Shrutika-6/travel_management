<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.html");  // Redirect to login page if not logged in
    exit;
}

echo "<h1>Welcome to the Dashboard!</h1>";
echo "<p>Logged in as " . $_SESSION['master_name'] . "</p>";
echo "<a href='logout.php'>Logout</a>";  // Logout link
?>
