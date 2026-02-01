<?php
session_start();

// If already logged in, redirect by role
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'CUSTOMER') {
        header("Location: customer/dashboard.php");
    } elseif ($_SESSION['role'] === 'AUTHORITY') {
        header("Location: authority/dashboard.php");
    } elseif ($_SESSION['role'] === 'ADMIN') {
        header("Location: admin/dashboard.php");
    }
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>TickTap – National E-Ticketing System</title>
    <link rel="stylesheet" href="common/style.css">
</head>
<body class="home-body">

<!-- NAVBAR -->
<nav class="navbar">
    <div class="logo">Tick<span>Tap</span></div>
    <div class="nav-links">
        <a href="auth/login.php">Login</a>
        <a href="auth/register.php" class="btn">Register</a>
    </div>
</nav>

<!-- HERO SECTION -->
<section class="hero">
    <h1>One Platform. All Tickets.</h1>
    <p>
        Buy Bus, Train & Flight tickets anywhere in Bangladesh  
        with real-time seat availability and secure booking.
    </p>
    <a href="auth/login.php" class="cta-btn">Get Started</a>
</section>

<!-- FEATURES -->
<section class="features">
    <div class="feature">
        <h3>🚌 Bus Tickets</h3>
        <p>Nationwide bus ticket booking with live seat status.</p>
    </div>

    <div class="feature">
        <h3>🚆 Train Tickets</h3>
        <p>Intercity train schedules with secure reservations.</p>
    </div>

    <div class="feature">
        <h3>✈️ Flight Tickets</h3>
        <p>Domestic flight booking with instant confirmation.</p>
    </div>
</section>

<!-- SYSTEM HIGHLIGHTS -->
<section class="highlights">
    <h2>Why TickTap?</h2>
    <ul>
        <li>✔ Fully DBMS-driven system</li>
        <li>✔ ACID-compliant booking transactions</li>
        <li>✔ Role-based access (Customer, Authority, Admin)</li>
        <li>✔ Real-time availability using database views</li>
        <li>✔ Audit logs & revenue analytics</li>
    </ul>
</section>

<!-- FOOTER -->
<footer class="footer">
    <p>TickTap © 2026 | National E-Ticketing System</p>
</footer>

</body>
</html>
