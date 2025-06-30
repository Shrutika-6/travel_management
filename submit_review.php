<?php
// Start the session (optional, for keeping track of users or sending session-based messages)
session_start();

// Include the database connection file
include('conn.php');  // Make sure this file contains your database connection details

// Check if the form is submitted via POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the form data and sanitize it to prevent SQL injection
    $name = htmlspecialchars(trim($_POST['name']));
    $review = htmlspecialchars(trim($_POST['review']));
    $rating = (int) $_POST['rating'];

    // Check if the rating is valid (1-5)
    if ($rating >= 1 && $rating <= 5) {

        try {
            // Prepare the SQL query to insert the review into the database
            $sql = "INSERT INTO review (name, review, rating) VALUES (:name, :review, :rating)";
            $stmt = $pdo->prepare($sql);

            // Bind the parameters to the query
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':review', $review, PDO::PARAM_STR);
            $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);

            // Execute the query
            if ($stmt->execute()) {
                // Redirect to a success page (or display a success message)
                $_SESSION['message'] = "Thank you for your review, $name!";
                header('Location: allreview.php');  // Redirect to the Thank You page
                exit();
            } else {
                $_SESSION['message'] = "Sorry, there was an error submitting your review. Please try again.";
            }
        } catch (PDOException $e) {
            // If there is a database error
            $_SESSION['message'] = "Error: " . $e->getMessage();
        }
    } else {
        $_SESSION['message'] = "Please provide a rating between 1 and 5.";
    }
} else {
    // If the form is not submitted correctly
    $_SESSION['message'] = "Invalid form submission.";
}

// Redirect back to the form if there's an error or no data is submitted
header('Location: review.html');
exit();

?>
