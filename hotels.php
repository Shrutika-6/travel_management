<?php
// Database connection
require_once 'db_connection.php';

// Fetch all states for the dropdown
$states_query = "SELECT DISTINCT state FROM hotel ORDER BY state";
$states_result = mysqli_query($conn, $states_query);

// Handle form submission to fetch hotels by state
$hotels = [];
if (isset($_POST['state'])) {
    $selected_state = $_POST['state'];
    $hotels_query = "SELECT * FROM hotel WHERE state = '$selected_state'";
    $hotels_result = mysqli_query($conn, $hotels_query);
    $hotels = mysqli_fetch_all($hotels_result, MYSQLI_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels</title>
</head>
<body>

<h1>Select State to View Hotels</h1>

<form method="POST" action="hotel.php">
    <select name="state">
        <option value="">Select a State</option>
        <?php while ($row = mysqli_fetch_assoc($states_result)): ?>
            <option value="<?php echo $row['state']; ?>"><?php echo $row['state']; ?></option>
        <?php endwhile; ?>
    </select>
    <button type="submit">View Hotels</button>
</form>

<?php if (!empty($hotels)): ?>
    <h2>Hotels in <?php echo $selected_state; ?>:</h2>
    <ul>
        <?php foreach ($hotels as $hotel): ?>
            <li><?php echo $hotel['hotel_name']; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

</body>
</html>
