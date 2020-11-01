<?php
  include "connection.php";
  include "start.php";

  if(isset($_POST['login'])){
    $name = $_POST['Name'];
    $pw = $_POST['pw'];
    $stmt = $conn->prepare("SELECT * FROM admin WHERE Name='$name'");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$result){
      echo "wrong login";
    }
    else{
      if(password_verify($pw,$result['Password'])){
        echo "login true";
        $_SESSION['cred'] = "admin";
        header('Location: index.php');
        exit;
      }
      else{
        echo"wrong login details";
      }
    }
    $conn = null;

  }

?>
  <form action="" method="post">
    <input type="text" name="Name"><br>
    <input type="password" name="pw"><br>
    <input type="submit" name="login">
  </form>
<?
  include "end.php"
 ?>
