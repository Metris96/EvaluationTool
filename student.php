<?php
//include "start.php";
include "connection.php";
if(isset($_POST['evaluate'])){
  $count = $_POST['lnames'];
  $crit = $_POST['crit'];
  $evalid = $_POST['stuid'];
  $evaluator = $_POST['evalid'];
  $values = "";
  for($i = 0; $i < count($count); $i++){
    for($j = 1; $j < count($crit); $j++){
      $cell = $count[$i].$crit[$j];
      //echo $_POST[$cell];
      $values .= "'$_POST[$cell]',";
    }
    $values .= " '$evaluator', '$evalid[$i]'";
    $sql = "INSERT INTO `evaluation`(Grade1, Grade2, Grade3, Grade4, Evaluator_ID, Evaluation_target_ID) VALUES($values)";
    $conn -> exec($sql);
    $values = "";
  }
}
$criteria = array("Name", "Teamwork", "Quality", "Quantity", "Realibility");
$id = $_GET['sid'];
$Fnames = array();
$Lnames = array();
$stuid = array();
$stmt = $conn->prepare("SELECT * FROM student WHERE Student_ID='$id'");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$idgroup = $result['Group_id'];
    if(!$result){
      echo "wrong login";
    }
    else{
      $evaluator =  $result['First_Name'] . " " . $result['Last_Name'];
      $evalID = $result['idStudent'];
      echo "<h1>Hello " .  $evaluator . " welcome to the evaluation form </h1>";
      echo "<h2>Grades are between 1-8</h2>";

      //sql lause joka tarkistaa onko arvioitu ja hakee arvioitu
      $stmt = $conn->prepare("SELECT evaluation.`Evaluation_target_ID`, evaluation.`Grade1`,evaluation.`Grade2`,evaluation.`Grade3`,evaluation.`Grade4`, student.`First_Name` , student.`Last_Name` FROM `evaluation` INNER JOIN student ON evaluation.`Evaluation_target_ID` = student.`idStudent` WHERE  evaluation.`Evaluator_ID`= $evalID");
      $stmt->execute();
      $result = $stmt->fetch();
      if($result){

        echo "You have already submitted evaluation, you can view the evaluations here<br>";
        echo "left number is rating you gave and the right one is average from your group";
        echo "<table>";
        echo "<tr>";
        for($i = 0; $i < count($criteria); $i++){
          echo "<td>".$criteria[$i] . "</td>";
        }
        echo "</tr>";
        $stmt->execute();
        while($row = $stmt->fetch()){
          $evalid = $row['Evaluation_target_ID'];
          $avgra =$conn->prepare("SELECT AVG(Grade1), AVG(Grade2), AVG(Grade3), AVG(Grade4) FROM evaluation WHERE `Evaluation_target_ID`= $evalid");
          $avgra->execute();
          $avera = $avgra->fetch();
          echo "<td>".$row['First_Name']." ".$row['Last_Name']." </td><td> " .$row['Grade1']." | " .$avera['AVG(Grade1)']. "</td><td> ".$row['Grade2']." | " .$avera['AVG(Grade2)']."</td><td> ".$row['Grade3']. " | " .$avera['AVG(Grade3)']. "</td><td> ".$row['Grade4'] . " | " .$avera['AVG(Grade4)']."</td></tr>";

        }
        
        echo "</table>";
      }
      else{

        $stmt = $conn->prepare("SELECT * FROM student WHERE `Group_id`=?");
        $stmt->execute([$idgroup]);
          while($row = $stmt -> fetch()){
            array_push($Fnames, $row['First_Name']);
            array_push($Lnames, $row['Last_Name']);
            array_push($stuid, $row['idStudent']);

        }
          $criteria = array("Name", "Teamwork", "Quality", "Quantity", "Realibility");
          echo "<form action='' method='post'>";
          echo "<input type='hidden' value='$evalID' name='evalid'>";
          foreach($Lnames as $name){
            echo "<input type='hidden' name='lnames[]' value='". $name."'>";
          }
          foreach($criteria as $crit){
            echo "<input type='hidden' name='crit[]' value='". $crit."'>";
          }
          foreach($stuid as $sid){
            echo "<input type='hidden' name='stuid[]' value='". $sid."'>";
          }
            echo "<table>";
            for($i = 0; $i < count($Fnames) + 1; $i++){
              echo "<tr>";
              for($j = 0; $j < count($criteria); $j++){
                if($i == 0){
                  echo "<td>".$criteria[$j] ."</td>";
                }
                else{
                  if($j== 0){

                      echo "<td>" . $Fnames[$i -1] . " ". $Lnames[$i - 1] .  "</td>";

                  }
                  else{
                    $k = $i-1;
                    echo "<td> <input type='number' min='1' max='8' name='$Lnames[$k]$criteria[$j]' required></input></td>";
                  }
                }
              }
            }

            echo "</tr>";
            echo "</table>";
            echo "<input type='submit' name='evaluate'>";
            echo "</form>";
      }

}
$conn = null;
  include "end.php";
?>
