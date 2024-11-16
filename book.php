<?php
// Include the database connection
include 'config.php'; // Your database connection details file
session_start(); // Start the session to access user data

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the input data from the form
    $user_id = $_SESSION['user_id'];  // The user ID from the session
    $pickup_address = $_POST['pickup_address'];
    $delivery_address = $_POST['delivery_address'];
    $weight = $_POST['weight'];
    $description = $_POST['description'];
    $delivery_date = $_POST['delivery_date'];

    // Prepare the SQL query to insert the booking details into the database
    $sql = "INSERT INTO bookings (user_id, pickup_address, delivery_address, weight, description, delivery_date) 
            VALUES (:user_id, :pickup_address, :delivery_address, :weight, :description, :delivery_date)";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);

    try {
        // Bind parameters and execute the query
        $stmt->execute([
            ':user_id' => $user_id,
            ':pickup_address' => $pickup_address,
            ':delivery_address' => $delivery_address,
            ':weight' => $weight,
            ':description' => $description,
            ':delivery_date' => $delivery_date
        ]);
        
        // Success message
        $success_message = "Your courier has been booked successfully!";
    } catch (Exception $e) {
        // Error message
        $error_message = "Error booking your courier. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Courier - ONCS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    Book a Courier - ONCS
</header>

<div class="page-container">
    <h1>Book a Courier</h1>

    <!-- Display success or error messages -->
    <?php if (isset($success_message)): ?>
        <div class="success-message"><?php echo $success_message; ?></div>
    <?php elseif (isset($error_message)): ?>
        <div class="form-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <!-- Courier booking form -->
    <form method="POST">
        <input type="text" name="pickup_address" placeholder="Pickup Address" required>
        <input type="text" name="delivery_address" placeholder="Delivery Address" required>
        <input type="number" name="weight" placeholder="Package Weight (kg)" required>
        <textarea name="description" placeholder="Package Description" rows="4" required></textarea>
        <input type="date" name="delivery_date" required>
        <button type="submit">Book Courier</button>
    </form>

</div>

<footer>
    © 2024 ONCS - Online Courier Services. All Rights Reserved.
</footer>

</body>
</html>
