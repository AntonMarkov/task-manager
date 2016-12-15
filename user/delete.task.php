<?php
include '../config.php';
$id__ = $_GET['id'];
$user__ = $_GET['user'];
if(isset($id__))
{
  $task_category_query = mysqli_query($mysqli, "SELECT * FROM `task` WHERE `id`=$id__");
  $row_get_task_category = mysqli_fetch_array($task_category_query);
  $task_category = $row_get_task_category['category'];
  $get_num = mysqli_query($mysqli, "SELECT * FROM `category` WHERE `num`=$task_category");
  $row_task_num = mysqli_fetch_array($get_num);
  $tasks_numbers = $row_task_num['tasks_num'] - 1;
  mysqli_query($mysqli, "UPDATE `category` SET `tasks_num`=$tasks_numbers WHERE `num`=$task_category");
  mysqli_query($mysqli, "DELETE FROM `task` WHERE `id`=$id__ AND `user`='$user__' LIMIT 1");
}
?>
<script>
  window.history.back();
</script>
