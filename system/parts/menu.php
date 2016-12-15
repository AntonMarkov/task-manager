<span class="menu">
  <a href="<?php echo $url; ?>upload/" style="margin-top: 10px;">
    <i class="fa fa-upload" aria-hidden="true"></i> Файлове
  </a>
  <br>
  <a href="<?php echo $url; ?>expiration_date/" style="margin-top: 10px;">
    <i class="fa fa-file-text-o" aria-hidden="true"></i> Срокове
  </a>
  <?php
  if ($_SESSION[$_SESSION['username'] . "_access"] >= 2)
  {
  ?>
  <hr color="#adaaaa">
  <a href="<?php echo $url; ?>user/list.php" style="margin-top: 10px;">
    <i class="fa fa-user" aria-hidden="true"></i> Потребители
  </a>
  <?php
  }
  else
  {
    ?>
    <br>
    <?php
  }
  ?>
  <hr color="#adaaaa">
  <a href="<?php echo $url; ?>user/index?out=yes">
    <i class="fa fa-user-times" aria-hidden="true"></i> Излизане
  </a>
</span>
