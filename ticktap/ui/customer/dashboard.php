<?php
include "../../backend/config.php";
include "../../backend/session.php";
include ROOT_PATH . "/ui/common/layout-header.php";
?>

<div class="dashboard-layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h3 class="sidebar-title">Customer Panel</h3>
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="search.php">Search Tickets</a>
        <a href="booking-history.php">Booking History</a>
        <a href="../auth/logout.php">Logout</a>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="dashboard-content">

        <div class="welcome-box">
            <h2>Welcome to TickTap</h2>
            <p>Book Bus, Train & Flight tickets across Bangladesh.</p>
        </div>

        <div class="card-grid">

            <div class="feature-card">
                <h3>🔍 Search Tickets</h3>
                <p>Find available schedules and seat availability.</p>
                <a href="search.php" class="card-btn">Search Now</a>
            </div>

            <div class="feature-card">
                <h3>🎟 Book Tickets</h3>
                <p>Secure booking with real-time seat allocation.</p>
                <a href="search.php" class="card-btn">Book Ticket</a>
            </div>

            <div class="feature-card">
                <h3>📜 Booking History</h3>
                <p>View all your past and current bookings.</p>
                <a href="booking-history.php" class="card-btn">View History</a>
            </div>

        </div>

    </main>
</div>

<?php include ROOT_PATH . "/ui/common/layout-footer.php"; ?>
