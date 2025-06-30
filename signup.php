<?php
// Include database connection
include("db_connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the user inputs
    $master_name = $_POST['master_name'];
    $password = $_POST['password'];

    // Basic validation (you can improve this)
    if (empty($master_name) || empty($password)) {
        echo "Please fill all fields.";
        exit;
    }

    // Prepare and bind the SQL query
    $sql = "INSERT INTO login (master_name, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die('MySQL prepare error: ' . mysqli_error($conn));
    }

    // Bind parameters to the SQL query
    mysqli_stmt_bind_param($stmt, "ss", $master_name, $password);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        // Redirect to destination.html after successful signup
        header("Location: main_page.html");
        exit();  // Stop further script execution
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
    // Close the database connection
    mysqli_close($conn);
}
?>
