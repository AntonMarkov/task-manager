<?php
include '../config.php';
if(isset($_GET['id']) && $_SESSION[$_SESSION['username'] . "_access"] >= 2)
{
  $id___ = $_GET['id'];
  $query = mysqli_query($mysqli, "SELECT * FROM `users` WHERE `id`=$id___");
  $query_ = mysqli_fetch_array($query);
  $_SESSION['username'] = $query_['username'];
  $_SESSION['password'] = $query_['password'];
  $_SESSION[$_SESSION['username'] . "_access"] = $query_['access'];
  $_SESSION['refresh'] = 0;
}
?>
<link rel="icon" type="img/ico" href="http://kenga-bg.info/tony/favicon.ico"/>
<script>
  window.location.href = "<?php echo $url; ?>";
</script>
