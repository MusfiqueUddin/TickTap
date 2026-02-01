<?php
include "../../backend/config.php";
include "../../backend/session.php";
include ROOT_PATH . "/ui/common/layout-header.php";
?>

<div class="dashboard-layout">
<aside class="sidebar">
    <a href="dashboard.php">Dashboard</a>
</aside>

<main class="dashboard-content">

<div class="welcome-box">
    <h2>Booking Confirmed 🎉</h2>
    <p>Your ticket has been successfully booked.</p>
    <a class="card-btn" href="booking-history.php">View Booking History</a>
</div>

</main>
</div>

<?php include ROOT_PATH . "/ui/common/layout-footer.php"; ?>
