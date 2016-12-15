<?php
include '../config.php';
if($_SESSION[$_SESSION['username'] . "_access"] <= 1)
{
  ?>
  <script>
    alert("You don\'t have access for this page!!!");
    window.history.back();
  </script>
  <?php
  exit;
}
?>
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
    * {
      -webkit-box-sizing: content-box;
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

    .user_info {
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
        $.each($(".user_info"), function() {//get class go and check it
          if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
           $(this).css({"display" : "none"});
          else
           $(this).show();
        });
      });

      $(".menu").hide();

      $('.fa-bars').click(function(){
        $('.fa-bars').hide();
        $(".menu").show();
      });

      $("#e-mail").keyup(function(){
        var email = $("#e-mail").val();
        var filter = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        if (filter.test(email))
        {
          $(".warning").hide();
          $(".check").show();
        }
        else
        {
          $(".check").hide();
          $(".warning").show();
        }
      });

    });
    $(document).mouseup(function (e)
    {
      var cs = $(".menu");
      if (!cs.is(e.target) && cs.has(e.target).length === 0)
      {
        cs.hide();
        $('.fa-bars').show();
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
        </div>

        <form style="margin-top: 55px;" class="form_tasks" method="post">
          <table>
            <thead>
              <th style="text-align: center; width: 30%; border: 2px solid black;">Име</th>
              <th style="text-align: center; width: 10%; border: 2px solid black;">Код</th>
              <th style="text-align: center; width: 20%; border: 2px solid black;">Имейл</th>
              <th style="text-align: center; width: 5%; border: 2px solid black;">Права</th>
            </thead>
            <tbody style="text-align: center;">
              <form class="form" action="#" method="post">
                <tr style="font-size: 10px;">
                  <td>&nbsp;</td>
                </tr>
                <tr class="user_info">
                  <td style="border-top-left-radius: 10px;border-bottom-left-radius: 10px;">
                    <input type="submit" name="submit-3" style="float: left; width: 30px; height: 30px; border: none; border-radius: 10px; background: orange; color: white; margin-top: 5px; margin-left: 10px; cursor: pointer;" value="Ok">
                    username: <input type="text" name="username" value="" required><br>
                    password: <input type="password" name="password" value="" required>
                  </td>
                  <td>
                    <select class="" name="generator"  required>
                      <option value=""selected disabled>Код</option>
                      <option value="<?php echo rand(0, 99999999) . rand(0, 99999); ?>"><?php echo rand(0, 99999999) . rand(0, 99999); ?></option>
                      <option value="<?php echo rand(0, 99999999) . rand(0, 99999); ?>"><?php echo rand(0, 99999999) . rand(0, 99999); ?></option>
                      <option value="<?php echo rand(0, 99999999) . rand(0, 99999); ?>"><?php echo rand(0, 99999999) . rand(0, 99999); ?></option>
                      <option value="<?php echo rand(0, 99999999) . rand(0, 99999); ?>"><?php echo rand(0, 99999999) . rand(0, 99999); ?></option>
                      <option value="<?php echo rand(0, 99999999) . rand(0, 99999); ?>"><?php echo rand(0, 99999999) . rand(0, 99999); ?></option>
                    </select>
                  </td>
                  <td>
                    <input type="text" name="e-mail" value="" id="e-mail">
                    <i text="Incorrect e-mail!!" style="display: none; color: red; margin-top: 7px;" class="warning fa fa-exclamation-triangle" aria-hidden="true"></i>
                    <i class="fa fa-check check" style="display: none; color: green; margin-top: 7px;" aria-hidden="true" ></i>

                  </td>
                  <td style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;">
                    <select class="" name="access" required>
                      <option value="" selected disabled>Права:</option>
                      <option value="">Никакви</option>
                      <option value="1">Ограничени</option>
                      <option value="2">Неограничени</option>
                    </select>
                  </td>
                </tr>
              </form>

              <?php
              $all_users = mysqli_query($mysqli, "SELECT * FROM `users`");
              while($row = mysqli_fetch_array($all_users))
              {
                if($row['access'] >= 2)
                {
                  $access__ = "Неограничени";
                }
                else
                {
                  $access__ = "Ограничени";
                  if($row['access'] == null)
                  {
                    $access__ = "Никакви";
                  }
                }
                if($row['email'] == null)
                {
                  $row['email'] = "Няма";
                }
              ?>
              <tr style="font-size: 10px;">
                <td>&nbsp;</td>
              </tr>
              <tr class="user_info">
                <td style="border-top-left-radius: 10px;border-bottom-left-radius: 10px;">
                  <span style="float: left;">
                    <?php
                    if($_SESSION[$_SESSION['username'] . "_access"] > $row['access']){
                      ?>
                      <a href="user.delete.php?id=<?php echo $row['id']; ?>&code=<?php echo $row['user_id']; ?>">
                        <i class="fa fa-times fa-lg" aria-hidden="true"></i>
                      </a>
                      <a href="login.with.user.php?id=<?php echo $row['id']; ?>">
                        <i class="fa fa-user fa-lg" aria-hidden="true"></i>
                      </a>
                      <?php
                    }
                    ?>

                  </span>
                  <?php echo $row['username'] ?>
                </td>
                <td><?php echo $row['user_id'] ?></td>
                <td>
                  <a href="mailto:<?php echo $row['email'] ?>">
                    <?php echo $row['email'] ?>
                  </a>
                </td>
                <td style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;"><?php echo $access__; ?></td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
        </form>
    </div>
  </body>
</html>
<?php
if(isset($_POST['submit-3']))
{
  $username__ = $_POST['username'];
  $password__ = $_POST['password'];
  $e_mail = $_POST['e-mail'];
  $generator = $_POST['generator'];
  $access = $_POST['access'];
  mysqli_query($mysqli, "INSERT INTO `users`(`user_id`, `username`, `password`, `email`,`access`) VALUES ('$generator','$username__','$password__','$e_mail','$access')");
?>
<script>
  window.location.href = window.location.href;
</script>
<?php
}
