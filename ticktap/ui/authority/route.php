<?php
include "../../backend/config.php";
include "../../backend/session.php";
include "../../backend/db.php";

/* =====================
   ADD ROUTE
   ===================== */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $source = $_POST['source_station_id'];
    $destination = $_POST['destination_station_id'];
    $distance = $_POST['distance_km'];

    if ($source != $destination) {
        $conn->query("
            INSERT INTO route (source_station_id, destination_station_id, distance_km)
            VALUES ($source, $destination, $distance)
        ");
    }
}

/* =====================
   FETCH STATIONS
   ===================== */
$stations = $conn->query("
    SELECT station_id, name, city
    FROM station
    ORDER BY name
");

/* =====================
   FETCH ROUTES
   ===================== */
$routes = $conn->query("
    SELECT
        r.route_id,
        s1.name AS source,
        s2.name AS destination,
        r.distance_km
    FROM route r
    JOIN station s1 ON r.source_station_id = s1.station_id
    JOIN station s2 ON r.destination_station_id = s2.station_id
    ORDER BY r.route_id DESC
");

include ROOT_PATH . "/ui/common/layout-header.php";
?>

<div class="dashboard-layout">

<aside class="sidebar">
    <h3 class="sidebar-title">Authority Panel</h3>
    <a href="dashboard.php">Dashboard</a>
    <a href="vehicle.php">Vehicles</a>
    <a href="route.php" class="active">Routes</a>
    <a href="schedule.php">Schedules</a>
    <a href="../auth/logout.php">Logout</a>
</aside>

<main class="dashboard-content">

<h2>Manage Routes</h2>

<div class="card">
<form method="POST">
    <label>Source Station</label>
    <select name="source_station_id" required>
        <?php while ($s = $stations->fetch_assoc()): ?>
            <option value="<?= $s['station_id'] ?>">
                <?= $s['name'] ?> (<?= $s['city'] ?>)
            </option>
        <?php endwhile; ?>
    </select>

    <label>Destination Station</label>
    <select name="destination_station_id" required>
        <?php
        $stations->data_seek(0);
        while ($s = $stations->fetch_assoc()):
        ?>
            <option value="<?= $s['station_id'] ?>">
                <?= $s['name'] ?> (<?= $s['city'] ?>)
            </option>
        <?php endwhile; ?>
    </select>

    <label>Distance (KM)</label>
    <input type="number" step="0.01" name="distance_km" required>

    <button>Add Route</button>
</form>
</div>

<br>

<table class="data-table">
<tr>
    <th>ID</th>
    <th>Source</th>
    <th>Destination</th>
    <th>Distance (KM)</th>
</tr>

<?php while ($r = $routes->fetch_assoc()): ?>
<tr>
    <td><?= $r['route_id'] ?></td>
    <td><?= $r['source'] ?></td>
    <td><?= $r['destination'] ?></td>
    <td><?= $r['distance_km'] ?></td>
</tr>
<?php endwhile; ?>

</table>

</main>
</div>

<?php include ROOT_PATH . "/ui/common/layout-footer.php"; ?>
