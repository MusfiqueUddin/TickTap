<?php
include "../../backend/config.php";
include "../../backend/session.php";
include "../../backend/db.php";

/* Add vehicle */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['vehicle_name'];
    $type = $_POST['vehicle_type'];
    $seats = $_POST['total_seats'];

    $conn->query("
        INSERT INTO vehicle (authority_id, vehicle_type, vehicle_name, total_seats)
        VALUES (
            (SELECT authority_id FROM transport_authority WHERE user_id = {$_SESSION['user_id']}),
            '$type','$name',$seats
        )
    ");
}

$vehicles = $conn->query("SELECT * FROM vehicle");

include ROOT_PATH . "/ui/common/layout-header.php";
?>

<div class="dashboard-layout">
<aside class="sidebar">
    <a href="dashboard.php">Dashboard</a>
    <a href="vehicle.php" class="active">Vehicles</a>
    <a href="route.php">Routes</a>
    <a href="schedule.php">Schedules</a>
</aside>

<main class="dashboard-content">

<h2>Manage Vehicles</h2>

<div class="card">
<form method="POST">
    <label>Vehicle Name</label>
    <input name="vehicle_name" required>

    <label>Vehicle Type</label>
    <select name="vehicle_type">
        <option>BUS</option>
        <option>TRAIN</option>
        <option>FLIGHT</option>
    </select>

    <label>Total Seats</label>
    <input type="number" name="total_seats" required>

    <button>Add Vehicle</button>
</form>
</div>

<br>

<table class="data-table">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Type</th>
    <th>Total Seats</th>
</tr>

<?php while ($v = $vehicles->fetch_assoc()): ?>
<tr>
    <td><?= $v['vehicle_id'] ?></td>
    <td><?= $v['vehicle_name'] ?></td>
    <td><?= $v['vehicle_type'] ?></td>
    <td><?= $v['total_seats'] ?></td>
</tr>
<?php endwhile; ?>
</table>

</main>
</div>

<?php include ROOT_PATH . "/ui/common/layout-footer.php"; ?>
