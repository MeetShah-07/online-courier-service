<?php
// Include the database connection
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database for the user
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php"); // Redirect to the homepage after successful login
        exit();
    } else {
        $error_message = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ONCS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    Login to ONCS - Online Courier Services
</header>

<div class="page-container">
    <h1>Login</h1>

    <?php if (isset($error_message)): ?>
        <div class="form-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a></p>
</div>

<footer>
    © 2024 ONCS - Online Courier Services. All Rights Reserved.
</footer>

</body>
</html>
