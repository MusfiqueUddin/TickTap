<?php
include "../../backend/db.php";
if ($_POST) {
    $conn->query("
      INSERT INTO user(email,password,role_id)
      VALUES('{$_POST['email']}','{$_POST['password']}',1)
    ");
    header("Location: login.php");
}
?>
<form method="POST">
  <input name="email" placeholder="Email">
  <input name="password" type="password">
  <button>Register</button>
</form>
