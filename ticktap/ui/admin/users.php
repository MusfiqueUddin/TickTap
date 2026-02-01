<?php
include "../../backend/config.php";
include "../../backend/session.php";
include "../../backend/db.php";

$users = $conn->query("
    SELECT u.user_id, u.name, u.email, r.role_name, u.created_at
    FROM user u
    JOIN role r ON u.role_id = r.role_id
    ORDER BY u.user_id DESC
");

include ROOT_PATH . "/ui/common/layout-header.php";
?>

<div class="sidebar">
    <a href="dashboard.php">Dashboard</a><br><br>
    <a href="revenue.php">Revenue</a><br><br>
    <a href="audit-log.php">Audit Logs</a>
</div>

<div class="content">
<div class="card">

<h2>All Users</h2>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Created</th>
</tr>

<?php while ($u = $users->fetch_assoc()): ?>
<tr>
    <td><?= $u['user_id'] ?></td>
    <td><?= $u['name'] ?></td>
    <td><?= $u['email'] ?></td>
    <td><?= $u['role_name'] ?></td>
    <td><?= $u['created_at'] ?></td>
</tr>
<?php endwhile; ?>

</table>

<br>
<a href="dashboard.php">⬅ Back to Dashboard</a>

</div>
</div>

<?php include ROOT_PATH . "/ui/common/layout-footer.php"; ?>
