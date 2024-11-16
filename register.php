<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute([':name' => $name, ':email' => $email, ':password' => $password]);
        echo "Registration successful! <a href='login.php'>Login here</a>";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ONCS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    Register for ONCS - Online Courier Services
</header>

<div class="page-container">
    <h1>Create an Account</h1>
    
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>

<footer>
    © 2024 ONCS - Online Courier Services. All Rights Reserved.
</footer>

</body>
</html>
