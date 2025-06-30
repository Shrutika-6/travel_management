<?php
// Include the database connection
require_once 'db_connection.php';

// Check if state is passed through POST
if (isset($_POST['state'])) {
    $state = $_POST['state'];
    $query = "SELECT hotel_name FROM hotel WHERE state = '$state' ORDER BY hotel_name";
    $result = $conn->query($query);
    $hotels = [];
    
    // Fetch results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $hotels[] = $row['hotel_name'];
        }
    }

    // Return the list of hotels in JSON format
    echo json_encode($hotels);
}
?>
