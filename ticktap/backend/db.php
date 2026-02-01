<?php
$host = "127.0.0.1";   // IMPORTANT: not localhost
$user = "root";
$pass = "";            // empty password
$db   = "ticktap";
$port = 3307;          // change ONLY if your port is different

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli($host, $user, $pass, $db, $port);
$conn->set_charset("utf8mb4");
?>
