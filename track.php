<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['tracking_id'])) {
    $tracking_id = $_GET['tracking_id'];

    $sql = "SELECT * FROM bookings WHERE tracking_id = :tracking_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':tracking_id' => $tracking_id]);
    $booking = $stmt->fetch();

    if ($booking) {
        $status = $booking['status'];
        $package_details = $booking['package_details'];
    } else {
        $error = "No package found with this Tracking ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Package - ONCS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    Track Your Package - ONCS
</header>

<div class="page-container track-form">
    <h1>Track Your Package</h1>
    
    <form method="GET">
        <input type="text" name="tracking_id" placeholder="Enter Tracking ID" required>
        <button type="submit">Track</button>
    </form>

    <?php if (isset($status)): ?>
        <h3>Tracking ID: <?php echo $tracking_id; ?></h3>
        <p>Package Details: <?php echo $package_details; ?></p>
        <p>Status: <?php echo $status; ?></p>
    <?php elseif (isset($error)): ?>
        <div class="track-error"><?php echo $error; ?></div>
    <?php endif; ?>
</div>

<footer>
    © 2024 ONCS - Online Courier Services. All Rights Reserved.
</footer>

</body>
</html>
