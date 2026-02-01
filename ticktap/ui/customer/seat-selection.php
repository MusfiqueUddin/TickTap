<?php
include "../../backend/config.php";
include "../../backend/session.php";
include "../../backend/db.php";

$schedule_id = $_GET['schedule_id'];

$seats = $conn->query("
    SELECT s.seat_id, s.seat_number
    FROM seat s
    WHERE s.seat_id NOT IN (
        SELECT t.seat_id
        FROM ticket t
        JOIN booking b ON t.booking_id = b.booking_id
        WHERE b.schedule_id = $schedule_id
    )
");

include ROOT_PATH . "/ui/common/layout-header.php";
?>

<div class="dashboard-layout">
<aside class="sidebar">
    <a href="dashboard.php">Dashboard</a>
    <a href="search.php" class="active">Search Tickets</a>
</aside>

<main class="dashboard-content">

<h2>Select Seat</h2>

<div class="seat-grid">
<?php while ($seat = $seats->fetch_assoc()): ?>
    <a class="seat-btn"
       href="ticket.php?schedule_id=<?= $schedule_id ?>&seat_id=<?= $seat['seat_id'] ?>">
        <?= $seat['seat_number'] ?>
    </a>
<?php endwhile; ?>
</div>

</main>
</div>

<?php include ROOT_PATH . "/ui/common/layout-footer.php"; ?>
