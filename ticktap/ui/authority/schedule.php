<?php
include "../../backend/config.php";
include "../../backend/session.php";
include "../../backend/db.php";

/* =====================
   ADD SCHEDULE
   ===================== */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $vehicle = $_POST['vehicle_id'];
    $route = $_POST['route_id'];
    $date = $_POST['schedule_date'];
    $depart = $_POST['departure_time'];
    $arrive = $_POST['arrival_time'];

    $conn->query("
        INSERT INTO schedule
        (vehicle_id, route_id, departure_time, arrival_time, schedule_date)
        VALUES
        ($vehicle, $route, '$depart', '$arrive', '$date')
    ");
}

/* =====================
   FETCH VEHICLES
   ===================== */
$vehicles = $conn->query("
    SELECT vehicle_id, vehicle_name, vehicle_type
    FROM vehicle
");

/* =====================
   FETCH ROUTES
   ===================== */
$routes = $conn->query("
    SELECT
        r.route_id,
        s1.name AS source,
        s2.name AS destination
    FROM route r
    JOIN station s1 ON r.source_station_id = s1.station_id
    JOIN station s2 ON r.destination_station_id = s2.station_id
");

/* =====================
   FETCH SCHEDULES
   ===================== */
$schedules = $conn->query("
    SELECT
        sc.schedule_id,
        v.vehicle_name,
        v.vehicle_type,
        s1.name AS source,
        s2.name AS destination,
        sc.schedule_date,
        sc.departure_time,
        sc.arrival_time
    FROM schedule sc
    JOIN vehicle v ON sc.vehicle_id = v.vehicle_id
    JOIN route r ON sc.route_id = r.route_id
    JOIN station s1 ON r.source_station_id = s1.station_id
    JOIN station s2 ON r.destination_station_id = s2.station_id
    ORDER BY sc.schedule_id DESC
");

include ROOT_PATH . "/ui/common/layout-header.php";
?>

<div class="dashboard-layout">

<aside class="sidebar">
    <h3 class="sidebar-title">Authority Panel</h3>
    <a href="dashboard.php">Dashboard</a>
    <a href="vehicle.php">Vehicles</a>
    <a href="route.php">Routes</a>
    <a href="schedule.php" class="active">Schedules</a>
    <a href="../auth/logout.php">Logout</a>
</aside>

<main class="dashboard-content">

<h2>Manage Schedules</h2>

<div class="card">
<form method="POST">

    <label>Vehicle</label>
    <select name="vehicle_id" required>
        <?php while ($v = $vehicles->fetch_assoc()): ?>
            <option value="<?= $v['vehicle_id'] ?>">
                <?= $v['vehicle_name'] ?> (<?= $v['vehicle_type'] ?>)
            </option>
        <?php endwhile; ?>
    </select>

    <label>Route</label>
    <select name="route_id" required>
        <?php while ($r = $routes->fetch_assoc()): ?>
            <option value="<?= $r['route_id'] ?>">
                <?= $r['source'] ?> → <?= $r['destination'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label>Date</label>
    <input type="date" name="schedule_date" required>

    <label>Departure Time</label>
    <input type="datetime-local" name="departure_time" required>

    <label>Arrival Time</label>
    <input type="datetime-local" name="arrival_time" required>

    <button>Add Schedule</button>
</form>
</div>

<br>

<table class="data-table">
<tr>
    <th>ID</th>
    <th>Vehicle</th>
    <th>Route</th>
    <th>Date</th>
    <th>Departure</th>
    <th>Arrival</th>
</tr>

<?php while ($s = $schedules->fetch_assoc()): ?>
<tr>
    <td><?= $s['schedule_id'] ?></td>
    <td><?= $s['vehicle_name'] ?> (<?= $s['vehicle_type'] ?>)</td>
    <td><?= $s['source'] ?> → <?= $s['destination'] ?></td>
    <td><?= $s['schedule_date'] ?></td>
    <td><?= date('H:i', strtotime($s['departure_time'])) ?></td>
    <td><?= date('H:i', strtotime($s['arrival_time'])) ?></td>
</tr>
<?php endwhile; ?>

</table>

</main>
</div>

<?php include ROOT_PATH . "/ui/common/layout-footer.php"; ?>
