<?php
include "../../backend/session.php";
include "../../backend/db.php";

if ($_POST) {
  $conn->query("
    CALL book_ticket(
      {$_SESSION['user_id']},
      {$_POST['schedule_id']},
      {$_POST['seat_id']},
      1200,
      '{$_POST['method']}'
    )
  ");
  header("Location: booking-history.php"); exit;
}
?>
<link rel="stylesheet" href="/ticktap/ui/common/style.css">
<div class="card" style="width:400px;margin:100px auto;">
<h2>Payment</h2>
<form method="POST">
<input type="hidden" name="seat_id" value="<?= $_GET['seat_id'] ?>">
<input type="hidden" name="schedule_id" value="<?= $_GET['schedule_id'] ?>">
<select name="method"><option>CARD</option><option>MOBILE</option></select><br><br>
<button>Confirm</button>
</form>
</div>
