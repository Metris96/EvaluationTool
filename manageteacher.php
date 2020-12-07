<?php
include "start.php";
include "connection.php";
$sql = $conn ->prepare ("SELECT `First_Name`, `Last_Name`, `Email` FROM `teacher`") ;
$sql-> execute();
while($row = $sql->fetch()){
  echo $row['First_Name'] . " ". $row['Last_Name']. " ". $row['Email'] . " <button type='manage'>manage</button><br>";
}

include "end.php";
 ?>
