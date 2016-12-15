<?php session_start(); ?>
<?php
ob_start();
date_default_timezone_set('Europe/Sofia');//timezone
################################### varibles ###################################
$title = "";//title
$url = "";//url
$folder = "/";//project folder
if($_SERVER['REMOTE_ADDR'] == "127.0.0.1") $folder = "/hakaton/";//set folder of the project if the host is local
if(empty($url)) $url = "http://" . $_SERVER['HTTP_HOST']. $folder;//here I construct the url of the page
$keywords = "";//keywords for site
$description = "";//description for the site
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
$limit = 0;
$username = $_SESSION['username'];//get username from the session and paste it in varible called $username
$password = $_SESSION['password'];//get password from the session and paste it in varible called $password
$task = 0;
$num = 0;
$num_2 = 0;
$tasks_numbers = 0;
$icon = "";
############################### date and hours #################################
$date = date("d.m.Y");//date
############################### connect to mysqli ##############################
$mysqli = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('can`t connect to the server');//connect to de database
################################### arrays #####################################
$users = array();
$id = array();
$errors = array();
################ array with users ##############################################
$users_ = mysqli_query($mysqli, "SELECT * FROM `users`");
while($row = mysqli_fetch_array($users_))
{
  $users[$row['username']] = $row['password'];
  $id[$row['username']] = $row['user_id'];
  $_SESSION[$row['username'] . "_access"] = $row['access'];
}
################################## functions ###################################
function check()//I check password and username
{
  global $users;
  global $username;
  global $password;
  global $id;
  if(isset($users[$username]) && ($users[$username]) === $password && ($_SESSION[$username . "_access"]) >= 1)//check the password and username in array
  {
    $_SESSION['user_id'] = $id[$username];
    $user_id = $id[$username];
    $_SESSION['fails'] = 0;
    return true;
  }
  else
  {
    ++$_SESSION['fails'];
    $_SESSION['user_id'] = "";
    ?>
    <script type="text/javascript">
      window.location.href = "<?php echo $url; ?>/user/";//if is not logged in I send him to the login panel
    </script>
    <?php
    exit;
  }
}
check();
################################## mysql #######################################
$category = mysqli_query($mysqli, "SELECT * FROM `category` WHERE `user_id` = $userid");
$items = mysqli_query($mysqli, "SELECT * FROM `items` WHERE `user_id` = $userid");
$gategory_options = mysqli_query($mysqli, "SELECT * FROM category WHERE `user_id`=$userid");
$uploaded_files = mysqli_query($mysqli, "SELECT * FROM files WHERE `user_id`=$userid");

################################# operations ###################################
// add new task
if(isset($_POST['submit']) && $task < 100)
{
  $task_date = date("d.m.Y");
  $task_hour = date("H:i");
  $task_name = $_POST['task_name'];
  $task_category = $_POST['category'];
  $ip = $_SERVER['REMOTE_ADDR'];
  $get_num = mysqli_query($mysqli, "SELECT * FROM `category` WHERE `num`=$task_category");
  $row_task_num = mysqli_fetch_array($get_num);
  $tasks_numbers = $row_task_num['tasks_num'] + 1;
  mysqli_query($mysqli, "UPDATE `category` SET `tasks_num`=$tasks_numbers WHERE `num`=$task_category");
  mysqli_query($mysqli, "INSERT INTO `task`(`task`, `hour`, `date`, `user`, `status`, `category`, `ip`) VALUES ('$task_name','$task_hour','$task_date','$userid','todo','$task_category','$ip')");
?>
<meta http-equiv="refresh" content="0.1">
<?php
}
if($task >= 100)
{
  ?>
  <script type="text/javascript">
    alert("Вашият лимит от записи е изчерпан!!!");
  </script>
  <?php
}
// add new list
if(isset($_POST['btn-add']))
{
  $name_list = $_POST['list_name'];
  $number = mysqli_query($mysqli,"SELECT * FROM `category`");
  $number = mysqli_num_rows($number);
  mysqli_query($mysqli, "INSERT INTO `category`(`name`, `user_id`, `tasks_num`,`num`) VALUES ('$name_list','$userid','0','$number')");
  ?>
  <meta http-equiv="refresh" content="0.1">
  <?php
}
// refresher
if(!isset($_SESSION['refresh']) || $userid != $id[$username])
{
  $_SESSION['refresh'] = "yes";
  ?>
  <script type="text/javascript">
  $(document).ready(function(){
    $('body').not(".loader").hide();
  });
  </script>
  <meta http-equiv="refresh" content="4">
  <?php
}
// displays category
if(isset($_GET['category']))
{
  $num_category = $_GET['category'];
  $set = mysqli_query($mysqli, "SELECT * FROM `task` WHERE `user` = $userid AND `category`=$num_category ORDER BY `id` DESC ");
}
else
{
  $set = mysqli_query($mysqli, "SELECT * FROM `task` WHERE `user` = $userid ORDER BY `id` DESC ");
}
