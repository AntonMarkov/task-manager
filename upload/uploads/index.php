<?php
include '../../config.php';
$img = $_GET['name'];
if(isset($img))
{

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="icon" type="img/ico" href="http://kenga-bg.info/tony/favicon.ico"/>
    <title>|<?php echo $img; ?></title>
    <style>
      body {
        background: rgb(60, 60, 60);
      }
      img {
        border: 5px solid rgb(70, 70, 70)
      }
    </style>
  </head>
  <body>
    <center>
      <img style="width: 40%; height: auto; margin-top: 50px;" src="<?php echo $img; ?>" alt="" />
    </center>
  </body>
</html>
<?php
}
else
{
  ?>
  <script>
    window.history.back();
  </script>
  <?php
}
