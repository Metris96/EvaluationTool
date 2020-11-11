<?php
  include "connection.php";
  include "start.php";

  if(isset($_POST['login'])){
    $email = $_POST['email'];
    $pw = $_POST['pw'];
    $stmt = $conn->prepare("SELECT * FROM teacher WHERE Email='$email'");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$result){
      echo "wrong login";
    }
    else{
      if(password_verify($pw,$result['Password'])){
        echo "login true";
        $_SESSION['id'] = $result['idTeacher'];
        $_SESSION['cred'] = "teacher";
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
    <input type="email" name="email">Email<br>
    <input type="password" name="pw">Password<br>
    <input type="submit" name="login">
  </form>
<?
  include "end.php"
 ?>
