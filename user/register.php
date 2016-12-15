<?php
if(isset($_POST['submit']))
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
  $e_mail = $_POST['email'];
  $username__ = $_POST['username'];
  $password__ = $_POST['password'];
  $query_for_e_mail = mysqli_query($mysqli, "SELECT * FROM `users` WHERE `email` LIKE '%$e_mail%'");
  $query_for_username = mysqli_query($mysqli, "SELECT * FROM `users` WHERE `username` LIKE '%$username__%'");
  $query_for_e_mail = mysqli_fetch_array($query_for_e_mail);
  $query_for_username = mysqli_fetch_array($query_for_username);
  if($query_for_e_mail['email'] != $e_mail && $query_for_username['username'] != $username__)
  {
    $generator = rand(0,99999999) . rand(0,9999);
    mysqli_query($mysqli, "INSERT INTO `users`(`user_id`, `username`, `password`, `email`) VALUES ('$generator','$username__','$password__','$e_mail')");
    $to = $e_mail;
    $subject = 'Activate your account';
    $headers = "From: tony@kenga-bg.info\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $message = "Your activation code is:";
    $message .= "<a href=\"http://tony.kenga-bg.info/user/activate?actv=12843AJjjasAjiisadA5524KO25655888" . $generator . "vfggh455gfdgfd555OJB2884\">here</a>";
    mail($to, $subject, $message, $headers);
    $msg = "Ще ви изпратим е-мейл за да потвърдите вашата регистрация!";
  }
  else
  {
    $msg = "За съжаление вече има потребител с такова име или е-мейл!";
  }
}
?>
<script>
  window.history.back();
  alert("<?php echo $msg; ?>");
</script>
