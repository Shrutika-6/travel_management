<?php
// Include the database connection file
include('conn.php');  // Ensure 'conn.php' has your database connection settings

// Start the session to handle any flash messages if needed
session_start();

// Fetch all reviews from the 'reviews' table
try {
    $sql = "SELECT * FROM review ORDER BY created_at DESC";  // Get all reviews ordered by the latest
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch all reviews as an associative array
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching reviews: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Reviews - Travel Management System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background: linear-gradient(to bottom, #3498db, #2ecc71);
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 20px;
        }
        h1 {
            text-align: center;
            color: #34495e;
            margin-bottom: 30px;
            font-size: 2em;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }
        .review-card {
            display: flex;
            gap: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            align-items: center;
        }
        .review-image {
            flex: 0 0 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid #3498db;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .review-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .review-content {
            flex: 1;
        }
        .review-card h3 {
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .review-card p {
            color: #34495e;
            font-size: 0.95em;
            margin-bottom: 8px;
            line-height: 1.4;
        }
        .rating {
            color: #f39c12;
            font-size: 1.2em;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 1em;
            color: #7f8c8d;
        }
        .footer a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>All Reviews</h1>

        <?php if (count($reviews) > 0): ?>
            <?php foreach ($reviews as $review): ?>
                <div class="review-card">
                    
                    <div class="review-content">
                        <h3><?php echo htmlspecialchars($review['name']); ?></h3>
                        <p><strong>Rating:</strong> 
                            <span class="rating"><?php echo str_repeat('★', $review['rating']); ?><?php echo str_repeat('☆', 5 - $review['rating']); ?></span>
                        </p>
                        <p><strong>Review:</strong> <?php echo nl2br(htmlspecialchars($review['review'])); ?></p>
                        <p><small><em>Submitted on: <?php echo date('F j, Y, g:i a', strtotime($review['created_at'])); ?></em></small></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No reviews found. Be the first to review!</p>
        <?php endif; ?>

        <div class="footer">
        <a href="review.html">Submit Your Review</a>
        </div>
    </div>

</body>  
</html>