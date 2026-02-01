<?php
session_start();
include "../../backend/db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $q = $conn->query("
        SELECT u.user_id, r.role_name
        FROM user u
        JOIN role r ON u.role_id = r.role_id
        WHERE u.email='$email' AND u.password='$password'
        LIMIT 1
    ");

    if ($q->num_rows === 1) {
        $user = $q->fetch_assoc();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role_name'];

        if ($user['role_name'] === 'CUSTOMER') {
            header("Location: ../customer/dashboard.php");
        } elseif ($user['role_name'] === 'AUTHORITY') {
            header("Location: ../authority/dashboard.php");
        } else {
            header("Location: ../admin/dashboard.php");
        }
        exit;
    } else {
        $error = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login – TickTap</title>
    <link rel="stylesheet" href="../common/style.css">
</head>
<body class="auth-body">

<div class="auth-container">
    <div class="auth-card">
        <h2>Welcome Back</h2>
        <p class="subtitle">Login to continue to TickTap</p>

        <?php if ($error): ?>
            <div class="error-box"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <p class="auth-footer">
            Don’t have an account?
            <a href="register.php">Register</a>
        </p>
    </div>
</div>

</body>
</html>
