<?php
include "../../backend/config.php";
include "../../backend/session.php";
include ROOT_PATH . "/ui/common/layout-header.php";
?>

<div class="dashboard-layout">

<aside class="sidebar">
    <h3 class="sidebar-title">Authority Panel</h3>
    <a href="dashboard.php" class="active">Dashboard</a>
    <a href="vehicle.php">Vehicles</a>
    <a href="route.php">Routes</a>
    <a href="schedule.php">Schedules</a>
    <a href="../auth/logout.php">Logout</a>
</aside>

<main class="dashboard-content">

<div class="welcome-box">
    <h2>Transport Authority Dashboard</h2>
    <p>Manage vehicles, routes, and schedules.</p>
</div>

<div class="card-grid">

    <div class="feature-card">
        <h3>🚍 Manage Vehicles</h3>
        <p>Add and manage buses, trains, and flights.</p>
        <a href="vehicle.php" class="card-btn">Open</a>
    </div>

    <div class="feature-card">
        <h3>🛣 Manage Routes</h3>
        <p>Define routes between stations.</p>
        <a href="route.php" class="card-btn">Open</a>
    </div>

    <div class="feature-card">
        <h3>🕒 Manage Schedules</h3>
        <p>Publish schedules for customer booking.</p>
        <a href="schedule.php" class="card-btn">Open</a>
    </div>

</div>

</main>
</div>

<?php include ROOT_PATH . "/ui/common/layout-footer.php"; ?>
