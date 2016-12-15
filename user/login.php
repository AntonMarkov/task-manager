<?php session_start(); ?>
<?php

$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['password'];
$_SESSION['refresh'] = 0;
?>
<link rel="icon" type="img/ico" href="http://kenga-bg.info/tony/favicon.ico"/>
<script>
  window.location.href = "<?php if($_SERVER['REMOTE_ADDR'] == "127.0.0.1"){ echo "http://127.0.0.1/hakaton/"; }else{ echo "http://tony.kenga-bg.info"; }?>";
</script>
