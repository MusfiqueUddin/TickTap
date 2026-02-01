<?php
include "../../backend/config.php";
include "../../backend/session.php";
include "../../backend/db.php";

$revenue = $conn->query("
    SELECT * FROM vw_daily_revenue
");

include ROOT_PATH . "/ui/common/layout-header.php";
?>

<div class="sidebar">
    <a href="dashboard.php">Dashboard</a><br><br>
    <a href="users.php">Users</a><br><br>
    <a href="audit-log.php">Audit Logs</a>
</div>

<div class="content">
<div class="card">

<h2>Revenue Report</h2>

<table>
<tr>
    <th>Date</th>
    <th>Total Bookings</th>
    <th>Total Revenue</th>
</tr>

<?php while ($r = $revenue->fetch_assoc()): ?>
<tr>
    <td><?= $r['booking_date'] ?></td>
    <td><?= $r['total_bookings'] ?></td>
    <td><?= number_format($r['total_revenue'],2) ?> ৳</td>
</tr>
<?php endwhile; ?>

</table>

<br>
<a href="dashboard.php">⬅ Back to Dashboard</a>

</div>
</div>

<?php include ROOT_PATH . "/ui/common/layout-footer.php"; ?>
