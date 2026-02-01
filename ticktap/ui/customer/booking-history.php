<?php
include "../../backend/config.php";
include "../../backend/session.php";
include "../../backend/db.php";

$user_id = $_SESSION['user_id'];

$history = $conn->query("
    SELECT
        b.booking_id,
        b.status,
        sc.schedule_date,
        v.vehicle_name,
        IFNULL(t.price, 0) AS price
    FROM booking b
    JOIN schedule sc ON b.schedule_id = sc.schedule_id
    JOIN vehicle v ON sc.vehicle_id = v.vehicle_id
    LEFT JOIN ticket t ON b.booking_id = t.booking_id
    WHERE b.customer_id = (
        SELECT customer_id
        FROM customer
        WHERE user_id = $user_id
        LIMIT 1
    )
");



include ROOT_PATH . "/ui/common/layout-header.php";
?>

<div class="dashboard-layout">
<aside class="sidebar">
    <a href="dashboard.php">Dashboard</a>
    <a href="booking-history.php" class="active">Booking History</a>
</aside>

<main class="dashboard-content">

<h2>Your Bookings</h2>

<table class="data-table">
<tr>
    <th>ID</th>
    <th>Vehicle</th>
    <th>Date</th>
    <th>Price</th>
    <th>Status</th>
</tr>

<?php while ($b = $history->fetch_assoc()): ?>
<tr>
    <td>#<?= $b['booking_id'] ?></td>
    <td><?= $b['vehicle_name'] ?></td>
    <td><?= $b['schedule_date'] ?></td>
    <td><?= $b['price'] ?> ৳</td>
    <td><?= $b['status'] ?></td>
</tr>
<?php endwhile; ?>

</table>

</main>
</div>

<?php include ROOT_PATH . "/ui/common/layout-footer.php"; ?>
