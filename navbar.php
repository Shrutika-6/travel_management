<!-- navbar.php -->
<nav>
    <div class="navbar">
        <div class="navbar-logo">
            <a href="index.php">Travel Management</a>
        </div>
        <div class="navbar-links">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="book.html">Book Your Trip</a></li>
                <li><a href="reviews.php">All Reviews</a></li>
                <li><a href="review.html">Submit Your Review</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Include the following CSS for the navbar styling -->
<style>
    nav {
        background-color: #333;
        padding: 10px 0;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .navbar-logo a {
        color: #fff;
        font-size: 24px;
        font-weight: bold;
        text-decoration: none;
    }

    .navbar-links ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
    }

    .navbar-links ul li {
        margin-left: 20px;
    }

    .navbar-links ul li a {
        color: #fff;
        text-decoration: none;
        font-size: 18px;
        padding: 10px;
    }

    .navbar-links ul li a:hover {
        background-color: #555;
        border-radius: 5px;
    }

    @media (max-width: 768px) {
        .navbar {
            flex-direction: column;
            text-align: center;
        }

        .navbar-links ul {
            flex-direction: column;
        }

        .navbar-links ul li {
            margin: 10px 0;
        }
    }
</style>
