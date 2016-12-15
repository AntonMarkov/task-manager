<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>|Login</title>
    <link rel="icon"href="http://kenga-bg.info/tony/favicon.ico"/>
    <link rel="stylesheet" href="../system/css/login.css">
    <link rel="stylesheet" href="../system/font-awesome/css/font-awesome.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){

        $(".register-text").click(function(){
          $(".login").hide();
          $(".body").show();
        });
        $(".fa-times").click(function(){
          $(".body").hide();
          $(".login").show();
        });
        $("#e-mail").keyup(function(){
          var email = $("#e-mail").val();
          var filter = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
          if (filter.test(email))
          {
            $(".warning").hide();
            $(".check").show();
            $(".submit").prop("type", "submit");

          }
          else
          {
            $(".check").hide();
            $(".warning").show();
            $(".submit").prop("type", "button");
          }
        });
        $(".check").hide();
        $(".warning").hide();
        $(".confirm").hide();

      });
    </script>
  </head>
  <body>
    <div class="body">
      <center>
        <div class="register">
          <form action="register.php" method="post"  style="margin: 10px;">
            <table>
              <tr>
                <td>Username:</td>
                <td><input type="text" name="username" value="" style="margin-top: 3px;" autocomplete="off" required></td>
              </tr>
              <tr>
                <td>Password:</td>
                <td><input type="password" name="password" value="" style="margin-top: 3px;" autocomplete="off" required></td>
              </tr>
              <tr>
                <td>E-mail:</td>
                <td><input type="text" id="e-mail" name="email" value="" style="margin-top: 3px;" autocomplete="off" required></td>
                <td>
                  <i text="Incorrect e-mail!!" style="color: red; margin-top: 7px;" class="warning fa fa-exclamation-triangle" aria-hidden="true"></i>
                  <i class="fa fa-check check" style="color: green; margin-top: 7px;" aria-hidden="true" ></i>
                </td>
            </table>
            <input type="submit" class="btn submit" name="submit" value="Ok" style="margin-top: 3px;">
          </form>
        </div>
      </center>
      <i aria-hidden="true" class="fa fa-times fa-2x" style="right: 50px; top: 50px; position: absolute; color: white; cursor: pointer;"></i>
    </div>
    <center>
      <div class="login">
        <form class="" action="login.php" method="post">
          <input type="text" name="username" value="" style="margin-top: 3px;" placeholder="Username:"></br>
          <input type="password" name="password" value="" autocomplete="off" style="margin-top: 3px;" placeholder="Password:"></br>
          <input type="submit" class="btn" name="btn" value="Ok" style="margin-top: 3px;"> или <span class="register-text">Регистрация</span>
        </form>
      </div>
    </center>
  </body>
</html>
<?php
if($_SESSION['fails'] >= 3)
{
  ?>
  <script type="text/javascript">
    var sub = confirm("Иска те ли да си смените паролата?");
    if(sub == true)
    {
      window.location.href = "change.password.php";
    }
  </script>
  <?php
}
if(isset($_GET['out']))
{
  unset($_SESSION);
}
