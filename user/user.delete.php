<?php
include '../config.php';
if($_SESSION[$_SESSION['username'] . "_access"] >= 2)
{
  $id_user = $_GET['id'];
  $id_user_code = $_GET['code'];
  mysqli_query($mysqli, "DELETE FROM `users` WHERE `id`=$id_user AND `user_id`=$id_user_code");
}
?>
<script>
  window.history.back();
</script>
