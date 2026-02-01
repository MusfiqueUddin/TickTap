<?php
include "../../backend/config.php";
include "../../backend/session.php";
include "../../backend/db.php";
include ROOT_PATH . "/ui/common/layout-header.php";
?>

<div class="sidebar">
    <a href="dashboard.php">Dashboard</a><br><br>
    <a href="users.php">Users</a><br><br>
    <a href="revenue.php">Revenue</a><br><br>
    <a href="audit-log.php">Audit Logs</a>
</div>

<div class="content">
<div class="card">
    <h2>Admin Dashboard</h2>
    <p>System overview and monitoring panel.</p>
</div>
</div>

<?php include ROOT_PATH . "/ui/common/layout-footer.php"; ?>
