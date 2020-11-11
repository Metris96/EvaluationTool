<?php
  include "start.php";
  include "connection.php";
  if(isset($_POST['submit'])){
    $Fname = $_POST['Fname'];
    $Lname = $_POST['Lname'];
    $email = $_POST['email'];
    $pw = password_hash($_POST['pw'], PASSWORD_BCRYPT);
    $sql = "INSERT INTO teacher(First_Name, Last_Name, Email, Password) VALUES ('$Fname', '$Lname', '$email', '$pw')";
    $conn->exec($sql);

    $conn = null;
    echo "user added";
  }
  ?>
  <form action="" method="post">
    <input type="text" name="Fname">First Name</br>
    <input type="text" name="Lname">Last Name</br>
    <input type="email" name="email">Email</br>
    <input type="password" name="pw">Password</br>
    <input type="submit" name="submit">
  </form>


  <?php
  include "end.php";
 ?>
