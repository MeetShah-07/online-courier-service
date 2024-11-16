<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONCS - Online Courier Services</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Header Section -->
<header>
    Welcome to ONCS - Online Courier Services
</header>

<!-- Main Content -->
<div class="container">
    <h1>Fast. Reliable. Trusted Courier Services</h1>
    <p>Your one-stop solution for all your courier needs. Track your packages, book a delivery, and much more!</p>

    <!-- Navigation Links -->
    <div style="margin-top: 20px;">
        <?php if (isset($_SESSION['user_id'])): ?>
            <p>Hello, <strong>User ID: <?php echo $_SESSION['user_id']; ?></strong></p>
            <a class="button" href="book.php">Book a Courier</a>
            <a class="button" href="track.php">Track Your Package</a>
            <a class="button" href="logout.php">Logout</a>
        <?php else: ?>
            <a class="button" href="register.php">Register</a>
            <a class="button" href="login.php">Login</a>
            <a class="button" href="track.php">Track Your Package</a>
        <?php endif; ?>
    </div>
</div>

<!-- Footer Section -->
<footer>
    © 2024 ONCS - Online Courier Services. All Rights Reserved.
</footer>

</body>
</html>
