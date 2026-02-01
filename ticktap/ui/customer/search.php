<?php
include "../../backend/config.php";
include "../../backend/session.php";
include "../../backend/db.php";

$schedules = $conn->query("
    SELECT
        sc.schedule_id,
        v.vehicle_name,
        v.vehicle_type,
        s1.name AS source,
        s2.name AS destination,
        sc.schedule_date,
        sc.departure_time
    FROM schedule sc
    JOIN vehicle v ON sc.vehicle_id = v.vehicle_id
    JOIN route r ON sc.route_id = r.route_id
    JOIN station s1 ON r.source_station_id = s1.station_id
    JOIN station s2 ON r.destination_station_id = s2.station_id
    ORDER BY sc.schedule_date
");

include ROOT_PATH . "/ui/common/layout-header.php";
?>

<div class="dashboard-layout">
<aside class="sidebar">
    <h3 class="sidebar-title">Customer Panel</h3>
    <a href="dashboard.php">Dashboard</a>
    <a href="search.php" class="active">Search Tickets</a>
    <a href="booking-history.php">Booking History</a>
    <a href="../auth/logout.php">Logout</a>
</aside>

<main class="dashboard-content">

<h2>Available Schedules</h2>

<table class="data-table">
<tr>
    <th>Vehicle</th>
    <th>Route</th>
    <th>Date</th>
    <th>Departure</th>
    <th></th>
</tr>

<?php while ($s = $schedules->fetch_assoc()): ?>
<tr>
    <td><?= $s['vehicle_name'] ?> (<?= $s['vehicle_type'] ?>)</td>
    <td><?= $s['source'] ?> → <?= $s['destination'] ?></td>
    <td><?= $s['schedule_date'] ?></td>
    <td><?= date('H:i', strtotime($s['departure_time'])) ?></td>
    <td>
        <a class="card-btn" href="seat-selection.php?schedule_id=<?= $s['schedule_id'] ?>">
            Book
        </a>
    </td>
</tr>
<?php endwhile; ?>

</table>

</main>
</div>

<?php include ROOT_PATH . "/ui/common/layout-footer.php"; ?>
