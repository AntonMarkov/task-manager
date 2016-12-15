<?php
include '../config.php';
$id__ = $_GET['id'];
if(isset($id__))
{
  mysqli_query($mysqli, "DELETE FROM `task` WHERE `category`='$id__'");
  mysqli_query($mysqli, "DELETE FROM `category` WHERE `num`='$id__'");
}
?>
<script>
  window.history.back();
</script>
