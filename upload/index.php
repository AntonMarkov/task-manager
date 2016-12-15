<?php include '../config.php';?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>|File uploader</title>
    <link rel="icon" type="img/ico" href="http://kenga-bg.info/tony/favicon.ico"/>
    <script type="text/javascript" src="../system/javascript/basic.js"></script>
    <link rel="stylesheet" type="text/css" href="../system/font-awesome/css/font-awesome.css"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    body {
      background: url('<?php echo $url; ?>/img/geometry.jpg');
      overflow-x: hidden;
    }
    .file_description {
      width: 1000px;
      border-radius: 8px;
      height: 80px;
      background: white;
      margin-top: 10px;
      border: none;
    }
    .link_and_description {
      font-size: 20px;
      margin-left: 30px;
    }
    .link_and_description a {
      text-decoration: none;
      color: black;
    }
    .params {
      text-align: right;
      float: right;
    }
    </style>
  </head>
  <body>
    <center>
      <form class="" action="#" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="file" value="">
        <input type="submit" name="btn-upload" value="ok">
      </form>
      <?php
        while($row = mysqli_fetch_array($uploaded_files))
        {
          $files_name = $row['name'];
          $row_name = $row['name'];
            $Array_with_img = array(
              'zip' => 'types/zip.jpg',
              'exe' => 'types/exe.jpg',
              'jpg' => 'uploads/' . $row['name'] . '',
              'png' => 'types/png.jpg',
              'msi' => 'types/msi.png',
              'pdf' => 'types/pdf.jpg',
              'apk' => 'types/apk.png',
              '7z' => 'types/7z.png',
              'htm' => 'types/html.jpg',
              'html' => 'types/html.jpg',
              'php' => 'types/php.jpg',
              'psd' => 'types/psd.jpg',
              'gif' => 'types/gif.jpg',
              'ico' => 'uploads/' . $row['name'] . '',
              'jpeg' => 'uploads/' . $row['name'] . '',
              'xml' => 'types/xml.jpg',
              'js' => 'types/js.jpg',
              'css' => 'types/css.jpg',
              'htaccess' => 'types/htaccess.jpg',
              '3gp' => 'types/3gp.jpg',
              'mpeg' => 'types/mpeg.jpg',
              'mpg' => 'types/mpg.jpg',
              'asp' => 'types/asp.jpg',
              'aspx' => 'types/aspx.png',
              'xhtml' => 'types/xhtml.png',
              'ihtml' => 'types/ihtml.png',
              'json' => 'types/json.jpg',
              'mp3' => 'types/mp3.png',
              'mp4' => 'types/mp4.jpg',
              'tmp' => 'types/tmp.png',
              'rar' => 'types/rar.jpg'
            );
            $type = pathinfo($row['name'], PATHINFO_EXTENSION);
            if(isset($Array_with_img[$type]))
            {
              $img = $Array_with_img[$type];
            }
            else
            {
              $img = "types/none.png";
            }
            $row['name'] = explode('_',trim($row['name']));
            $row['name'] = $row['name'][0] . " .... ." . $type;
            if(file_exists("uploads/" .$files_name))
            {
            ?>
            <table class="file_description">
              <tr>
                <td style="width: 100px;">
                  <a href="uploads/index.php?name=<?php echo $row_name; ?>">
                    <img src="<?php echo $img; ?>" style="float: left; border-top-left-radius: 8px; border-bottom-left-radius: 8px;" height="80" alt="" />
                  </a>
                </td>
                <td class="link_and_description">
                  <?php echo ucfirst($row['name']); ?>
                  <a href="<?php echo $row_name; ?>" download="<?php echo $row_name; ?>" title="click to download">
                    <i class="fa fa-download" aria-hidden="true"></i>
                  </a>
                  <a href="delete?name=<?php echo $row_name; ?>">
                    <i class="fa fa-times" aria-hidden="true"></i>
                  </a>
                </td>
                <td class="params">
                  <br>
                  <?php
                  echo $row['date'] . " ";
                  echo $row['hour'] . "<br/>";
                  echo round($row['size'], 2) . " KB";
                  ?>
                </td>
              </tr>
            </table>
            <?php
            $limit = $limit + round($row['size'], 2);
          }
          else
          {
            $row_id = $row['id'];
            mysqli_query($mysqli, "DELETE FROM files WHERE id=$row_id");
          }
        }
        $limit = ($limit/1000000)*100;
        if($limit>0){
          $limit = round($limit, 1);
          if($limit == 0)
          {
            $limit = 1;
          }
        }
      ?>
    </center>
    <div style="left: 0;bottom: 0; width: 100%; height: 50px; position:fixed; text-align:right; font-size: 25px; background:rgba(200, 104, 42, 0.63); color: rgb(0, 255, 18);">
      <b style="margin: 20px;">
        <?php
          echo $limit . "% from  1 GB";
        ?>
      </b>
    </div>
  </body>
</html>
<?php
if($limit >= 90 && $limit <= 85)
{
  ?>
  <script type="text/javascript">
    alert("Наближавате лимита!!!");
  </script>
  <?php
}
if($limit >= 100)
{
  ?>
  <script type="text/javascript">
    alert("Изчерпахте лимита си!!! :-(");
  </script>
  <?php
}
else
{
  if(isset($_POST['btn-upload']))
  {
    $file = mt_rand() . "_" . $_SESSION['username'] . "_" . $_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $folder = "uploads/";
    $file_size = $file_size/1024;//make it in KB
    $new_file_name = strtolower($file);
    $file_hour = date("H:i");
    $final_file = str_replace(' ','_',$new_file_name);
    if(move_uploaded_file($file_loc,$folder.$final_file))
      mysqli_query($mysqli, "INSERT INTO `files`(`size`, `name`, `user_id`, `type`, `date`, `hour`) VALUES ('$file_size','$final_file','$userid','$file_type','$date','$file_hour')");
    {

    }
    ?>
    <meta http-equiv="refresh" content="2">
    <?php
  }
}
