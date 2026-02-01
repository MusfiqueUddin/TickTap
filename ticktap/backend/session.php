<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /ticktap/ui/auth/login.php");
    exit;
}
?>
