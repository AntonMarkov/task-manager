<?php
include '../config.php';
$id__ = $_GET['id'];
$user__ = $_GET['user'];
$done = "done";
if(isset($id__))
{
  mysqli_query($mysqli, "UPDATE `task` SET `status`='$done' WHERE `id`='$id__' AND `user`='$user__'");
}
?>
<script>
  window.history.back();
</script>
