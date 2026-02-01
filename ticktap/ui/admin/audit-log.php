<?php
include "../../backend/config.php";
include "../../backend/session.php";
include "../../backend/db.php";

$logs = $conn->query("
    SELECT 
        a.log_id,
        u.email,
        a.action,
        a.log_time
    FROM audit_log a
    LEFT JOIN user u ON a.user_id = u.user_id
    ORDER BY a.log_id DESC
");

include ROOT_PATH . "/ui/common/layout-header.php";
?>

<div class="sidebar">
    <a href="dashboard.php">Dashboard</a><br><br>
    <a href="users.php">Users</a><br><br>
    <a href="revenue.php">Revenue</a>
</div>

<div class="content">
<div class="card">

<h2>Audit Logs</h2>

<table>
<tr>
    <th>ID</th>
    <th>User</th>
    <th>Action</th>
    <th>Time</th>
</tr>

<?php while ($l = $logs->fetch_assoc()): ?>
<tr>
    <td><?= $l['log_id'] ?></td>
    <td><?= $l['email'] ?? 'System' ?></td>
    <td><?= $l['action'] ?></td>
    <td><?= $l['log_time'] ?></td>
</tr>
<?php endwhile; ?>

</table>

<br>
<a href="dashboard.php">⬅ Back to Dashboard</a>

</div>
</div>

<?php include ROOT_PATH . "/ui/common/layout-footer.php"; ?>
