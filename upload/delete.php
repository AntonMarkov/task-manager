<?php
if(isset($_GET['name']))
{
  unlink("uploads/" . $_GET['name']);
}
?>
<script>
  window.history.back();
</script>
