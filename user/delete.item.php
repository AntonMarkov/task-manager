<?php
include '../config.php';
$id__ = $_GET['id'];
$user__ = $_GET['user'];
if(isset($id__))
{
  mysqli_query($mysqli, "DELETE FROM `items` WHERE `id`='$id__' AND `user_id`='$user__'");
}
?>
<script>
  window.history.back();
</script>
