<?php include 'config.php';?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>|</title>
    <link rel="icon" type="img/ico" href="http://kenga-bg.info/tony/favicon.ico"/>
    <link rel="stylesheet" href="system/css/css.css" media="screen" title="no title"/>
    <script type="text/javascript" src="system/javascript/basic.js"></script>
    <link rel="stylesheet" type="text/css" href="system/font-awesome/css/font-awesome.css"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script type="text/javascript">
      <?php
      include 'system/javascript/jquery.js';
      ?>
    </script>
  </head>
  <body>
    <?php include 'system/parts/navigation.php'; ?>
    <?php include 'system/parts/tasks.list.php'; ?>
    <?php include 'system/parts/search.engine.php'; ?>
    <?php include 'system/parts/tasks.php'; ?>
    <?php include 'system/parts/light.window.php';
    if(!isset($_SESSION['refresh']) || $userid != $id[$username])
    {
  ?>
    <div class="loader" style="background: white; width:">
      <center>
        <span style="top: 40%; position: absolute; font-size: 20px;">
          <i class="fa fa-circle-o-notch fa-spin fa-4x" aria-hidden="true"></i><br>
          Loading...
        </span>
      </center>
    </div>
    <?php
  }
  ?>
  </body>
</html>
<?php
if(isset($_POST['btn-edit-list']))
{
  $list_name = $_POST['list_name'];
  $id_list = $_POST['list-id'];
  mysqli_query($mysqli, "UPDATE `category` SET `name`='$list_name' WHERE `id`=$id_list");
  ?>
  <meta http-equiv="refresh" content="0.1">
  <?php
}
if(isset($_POST['btn-edit']))
{
  $text_task = $_POST['task_name'];
  $id_task = $_POST['task-id'];
  mysqli_query($mysqli, "UPDATE `task` SET `task`='$text_task' WHERE `id`=$id_task");
  ?>
  <meta http-equiv="refresh" content="0.1">
  <?php
}
