<?php include '../config.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>|</title>
  <link rel="icon" type="img/ico" href="http://kenga-bg.info/tony/favicon.ico"/>
  <link rel="stylesheet" href="../system/css/css.css" media="screen" title="no title"/>
  <script type="text/javascript" src="../system/javascript/basic.js"></script>
  <link rel="stylesheet" type="text/css" href="../system/font-awesome/css/font-awesome.css"/>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  @import "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css";
    .go {
      color: red;
      background: rgb(220, 220, 220);
      height: 50px;
      border: none;
      padding-top: 10px;
    }
    .end {
      background: red;
      color: white;
    }
    * {
      -webkit-box-sizing: content-box;
    }
    body {
      background: rgba(241, 237, 237, 0.75);
    }
    #add_new_item {
      text-decoration: none;
      color: black;
    }
    a {
      text-decoration: none !important;
      line-height: 1.42857143;
      color: #333 !important;
    }

    .no {
      background: rgb(220, 220, 220);
      height: 50px;
      border: none;
      padding-top: 10px;
      color: rgb(71, 37, 4);
    }
    table {
      border-collapse: collapse;
      border-spacing: 0;
      width: 100%;
    }
    tbody {
      font-weight: bold;
    }
  </style>
  <script type="text/javascript">
    $(document).ready(function(){

      $(".text_input").keyup(function(){//get inputed text
         _this = this;
        $.each($(".item"), function() {//get class go and check it
          if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
           $(this).hide();
          else
           $(this).show();
        });
      });
      $(".menu").hide();
      $("#light_close").click(function(){
          $(".light_window").hide();
      });

      $("#add_new_item").click(function(){
        $('.light_window').css({"display":"block"});
      });

      $('.back').hide();

      $('[data-toggle="tooltip"]').tooltip();

      $('.see_expirations').click(function(){
        $('.no').hide();
        $('.back').show();
        $('.see_expirations').hide();
      });

      var numItems = $('.go').length;

      $('.expirations').html("Изтичащи артикули(" + numItems + ")");

      $('.back').click(function(){
        $('.no').show();
        $('.back').hide();
        $('.see_expirations').show();
      });

      $('.edit').click(function(event){
        var id = event.target.id;
        var idName = $("#" + id + "-name").text();
        var idShop = $("#" + id + "-shop").text();
        var idDate = $("#" + id + "-date").text();
        idName = idName.replace(/\s/g, '');
        $("#submit").attr('name', 'btn-edit');
        $('.light_window').css({"display":"block"});
        $("#name").val(idName);
        $("#shop").val(idShop);
        $("#date").val(idDate);
        $("#item_id").val(id);
      });


      $('.fa-bars').click(function(){
        $(".menu").show();
      });

    });
    $(document).mouseup(function (e)
    {
      var cs = $(".menu");
      if (!cs.is(e.target) && cs.has(e.target).length === 0)
      {
        cs.hide();
      }
    });
  </script>
</head>
  <body>
    <!-- navigation -->
    <div class="navigation">
    <div class="user">

      <span class="user_img">
        <img src="../img/user.png" alt="" />
      </span>

      <span class="username">
        <?php echo ucfirst($_SESSION['username']); ?>
        &nbsp;&nbsp;
        <i class="fa fa-bars" aria-hidden="true"></i>
      </span>

      <div id="hour"></div>

      <script type="text/javascript">
        time();
      </script>

    </div>

      <nav>
        <ul>
        </ul>
      </nav>
      <?php include '../system/parts/menu.php'; ?>

    </div>
    <!-- end of navigation -->
      <div class="task_list" style="overflow: auto;">

        <div class="nav-2">
          <span class="date-2">
            <?php echo $date; ?>
          </span>
        </div>

        <div class="search">
          <form class="" action="#" method="post">
            <input type="text" class="text_input" name="search" value="" placeholder="Search...">
            <input type="submit" name="submt" style="display:none;">
          </form>
          <b style="margin-left: 10px; margin-top: 10px; position: absolute; cursor: pointer;" class="expirations see_expirations"></b>
          <b class="back" style="margin-left: 10px; cursor: pointer; margin-top: 10px; position: absolute;">Назад</b>
          <span class="add_or_delete">
            <a href="#" id="add_new_item" title="Add new item">
              <i class="fa fa-plus fa-lg" aria-hidden="true"></i>
              Добави
            </a>
          </span>
        </div>

        <form style="margin-top: 55px;" class="form_tasks" method="post">
          <table>
            <thead>
              <th style="text-align: center; width: 30%; border: 2px solid black;">Артикул</th>
              <th style="text-align: center; width: 10%; border: 2px solid black;">Магазин</th>
              <th style="text-align: center; width: 20%; border: 2px solid black;">Дата</th>
              <th style="text-align: center; width: 5%; border: 2px solid black;">Дни до изтичане</th>
            </thead>
            <tbody style="text-align: center;">
            <?php
              while($row = mysqli_fetch_array($items))
              {
                $time = time();
                $task_date = strtotime($row['date']);
                $diff = $time - $task_date;
                $diff = floor($diff / (60 * 60 * 24));
                if($diff >= "-31" && $diff <= "0")
                {
                  $class = "go";
                  $title = "after";
                }
                else
                {
                  if($diff >= 0)
                  {
                    $class = "go end";
                    $title = "before";
                  }
                  else
                  {
                    $title = "after";
                    $class = "no";
                  }
                }
                $diff = str_replace("-", "",$diff);
            ?>
              <tr style="font-size: 5px;">
                <td>&nbsp;</td>
              </tr>

              <tr class="<?php echo $class; ?> item" data-toggle="tooltip" title="<?php echo $title  . " " . $diff; ?> days">

                <td style="border-top-left-radius: 10px;border-bottom-left-radius: 10px">
                  <a href="../user/delete.item.php?id=<?php echo $row['id']; ?>&user=<?php echo $userid; ?>">
                    <i style="color: black; left: 15px; position: absolute;" class="fa fa-times fa-2x" aria-hidden="true"></i>
                  </a>
                  <a href="#" class="edit">
                    <i id="<?php echo $row['id']; ?>" style="color: black; margin-top: 10px; left: 40px; position: absolute;" class="fa fa-pencil  fa-lg" aria-hidden="true"></i>
                  </a>
                  <span id="<?php echo $row['id']; ?>-name">
                    <?php echo ucfirst($row['name']); ?>
                  </span>
                </td>

                <td id="<?php echo $row['id']; ?>-shop"><?php echo ucfirst($row['shop']); ?></td>

                <td id="<?php echo $row['id']; ?>-date"><?php echo $row['date']; ?></td>

                <td style="border-top-right-radius: 10px;border-bottom-right-radius: 10px"><?php echo $diff; ?></td>
              </tr>
            <?php
              }
            ?>
            </tbody>
          </table>
        </form>
    </div>

    <div class="light_window">

      <div class="form_for_task" style="text-align: center;">
        <br>
        <b style="font-size: 25px; margin-top: 20px;">
        New item:
        </b>

        <div class="form_for_task">
          <form class="" action="#" method="post">
            <label for="name">
              name: <br/>
              <input type="text" name="item_name" value="" id="name">
            </label>
            <br/>

            <label for="name">
              shop: <br/>
              <input type="text" name="item_shop" value="" id="shop">
            </label>
            <br/>

            <label for="name">
              expiration date: <br/>
              <input type="text" name="item_expiration_date" value="" id="date">
            </label>
            <input style="display: none;" type="text" name="item_expiration_id" value="" id="item_id">
            <br/>

            <input type="submit" name="submit-btn" value="ok" id="submit">
          </form>
        </div>
      </div>

      <i id="light_close" style="cursor: pointer; top: 50px; right: 50px; color: white; position: absolute;" class="fa fa-times fa-2x" aria-hidden="true"></i>

    </div>
  </body>
</html>
<?php
if(isset($_POST['submit-btn']))
{
  $item_name = $_POST['item_name'];
  $item_shop = $_POST['item_shop'];
  $item_date = $_POST['item_expiration_date'];
  mysqli_query($mysqli, "INSERT INTO `items`(`name`, `shop`, `date`, `user_id`) VALUES ('$item_name','$item_shop','$item_date','$userid')");
  ?>
  <meta http-equiv="refresh" content="0.1">
  <?php
}
if(isset($_POST['btn-edit']))
{
  $item_name = $_POST['item_name'];
  $item_shop = $_POST['item_shop'];
  $item_date = $_POST['item_expiration_date'];
  $id_item = $_POST['item_expiration_id'];
  mysqli_query($mysqli, "UPDATE `items` SET `name`='$item_name',`shop`='$item_shop',`date`='$item_date' WHERE `id`=$id_item");
  ?>
  <meta http-equiv="refresh" content="0.1">
  <?php
}
