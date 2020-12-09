<?php
  include "start.php";
  include "connection.php";
  $criteria = array("Name", "Teamwork", "Quality", "Quantity", "Realibility");
  $group = $_GET['gid'];
  $sql = $conn->prepare("SELECT * FROM student WHERE Group_id = $group");
  $sql -> execute();
  echo "<table>";
  echo "<tr>";
  for($i = 0; $i < count($criteria); $i++){
    echo "<td>".$criteria[$i] . "</td>";
  }
  echo "</tr>";
  while($row = $sql->fetch()){
    $id = $row['idStudent'];
  $stmt =$conn->prepare("SELECT AVG(Grade1), AVG(Grade2), AVG(Grade3), AVG(Grade4) FROM evaluation WHERE `Evaluation_target_ID`= $id");
    echo "<td>" .$row['First_Name'] . " " . $row['Last_Name']."</td><td> ";
    $stmt -> execute();
    while($row = $stmt->fetch()){
      echo $row['AVG(Grade1)']."</td><td> ".$row['AVG(Grade2)']."</td><td> ".$row['AVG(Grade3)']. "</td><td> ".$row['AVG(Grade4)'] . "</td></tr>";
    }
  }
  echo "</table>";
  $conn = null;
 ?>
