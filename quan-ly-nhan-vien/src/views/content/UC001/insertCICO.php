<link rel="stylesheet" href="<?= $host_name ?>/public/css/insertDocument.css">

<div>
  <form action="https://guarded-island-72965.herokuapp.com/enter-check-in-check-out" method="POST" id="form" target='_blank'>
    <?php
      $param = $_SESSION['id'];
      echo "<input type='hidden' name='EMPLOYEE_ID' value=$param>";
    ?>
    Date (DD-MM-YYYY): <input type="text" name="DATE"><br>
    Check In : <input type="text" name="TIME_IN"><br>
    Check Out : <input type="text" name="TIME_OUT"><br>
    Duration : <input type="text" name="DURATION"><br>
    <input type="submit" value="submit">
  </form>
</div>