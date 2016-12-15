<?php
session_start();
?>
<?php
if(isset($_GET['actv']))
{
  $userid = $_SESSION['user_id'];
  $dbhost = "***";//connection hostname
  $dbname = "***";//database name
  $dbuser = "***";//database username
  $dbpass = "***";//database password
  if($_SERVER['REMOTE_ADDR'] == "127.0.0.1"){
    $dbhost = "localhost";//connection hostname
    $dbname = "project";//database name
    $dbuser = "root";//database username
    $dbpass = "";//database password
  }
############################### connect to mysqli ##############################
  $mysqli = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('can`t connect to the server');
################################################################################
  $one = 1;
  $get = $_GET['actv'];
  $get = str_replace("12843AJjjasAjiisadA5524KO25655888", "", $get);
  $code = str_replace("vfggh455gfdgfd555OJB2884", "", $get);
  mysqli_query($mysqli, "UPDATE `users` SET `access`=$one WHERE `user_id`='$code'");
  $access = mysqli_query($mysqli, "SELECT * FROM `users` WHERE `user_id`='$code'");
  $access = mysqli_fetch_array($access);
  $_SESSION[$access['username'] . "_access"] = 1;
}
?>
<script>
  window.location.href = "http://tony.kenga-bg.info";
</script>
