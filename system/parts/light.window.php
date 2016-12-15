<div class="light_window">
    <div class="form_for_task" style="text-align: center;">

      <br>
      <b style="font-size: 25px; margin-top: 20px;">
        Нов запис:
      </b>

      <div class="form_for_task">
        <form class="" action="#" method="post">
          <input type="text" name="task_name" value="" id="task_name"><br/>

          <select class="" name="category" id="category" required>
            <option value="" disabled selected>Категория:</option>
            <?php
            while($row = mysqli_fetch_array($gategory_options))
            {
              ?>
              <option value="<?php echo $row['num']; ?>"><?php echo $row['name']; ?></option>
              <?php
            }
            ?>
          </select>
          <br/>

          <input type="submit" style="top: 50px; position: absolute;" class="btn-add" name="submit" value="Ok" id="submit-task">
          <input type="text" style="display: none;" name="task-id" value="ok" id="task_id">
        </form>
      </div>
    </div>
    <i id="light_close" style="cursor: pointer; top: 50px; right: 50px; color: white; position: absolute;" class="fa fa-times fa-2x" aria-hidden="true"></i>
</div>
