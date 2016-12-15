<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>|Login</title>
    <link rel="icon"href="http://kenga-bg.info/tony/favicon.ico"/>
    <link rel="stylesheet" href="../system/css/login.css">
    <link rel="stylesheet" href="../system/font-awesome/css/font-awesome.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
  </head>
  <body>
    <center>
      <div class="login">
        <form class="" action="#" method="post">
          <span style="color: orange;"><b>Въведете е-мейл или потребителско име за да ги проверим.</b></span>
          <input type="text" name="query" value="" style="margin-top: 3px;" placeholder="Е-мейл или потребителско име:" required></br>
          <input type="submit" class="btn" name="btn" value="Ok" style="margin-top: 3px;">
        </form>
      </div>
    </center>
  </body>
</html>
<?php
$_query = $_POST['query'];
if(isset($_query))
{
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
  $mysqli = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('can`t connect to the server');//connect to de database
  $find = mysqli_query($mysqli, "SELECT * FROM users WHERE username LIKE '%" . $_query . "%' OR email LIKE '%" . $_query . "%'");
  $find = mysqli_fetch_array($find);
  $to = $find['email'];
  $subject = 'Account:';
  $headers = "From: tony@kenga-bg.info\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
  $message = "Your password is:\r\n";
  $message .= $find['password'] . "<br/>";
  $message .= "Your username is:\r\n";
  $message .= $find['username'] . "\r\n";
  mail($to, $subject, $message, $headers);
  $_SESSION['fails'] = 0;
  ?>
  <script type="text/javascript">
    window.history.back();
  </script>
  <?php
}
