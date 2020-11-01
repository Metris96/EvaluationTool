<?php
  include "start.php";
  include "connection.php";
  if(isset($_POST['submit'])){
    $login = $_POST['login'];
    $pw = password_hash($_POST['pw'], PASSWORD_BCRYPT);
    $sql = "INSERT INTO admin(Name, Password) VALUES ('$login', '$pw')";
    $conn->exec($sql);
    
    $conn = null;
    echo "user added";
  }
  ?>
  <form action="" method="post">
    <input type="text" name="login">
    <input type="password" name="pw">
    <input type="submit" name="submit">
  </form>


  <?php
  include "end.php";
 ?>
