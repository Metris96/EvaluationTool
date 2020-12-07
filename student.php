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
$id = $_GET['sid'];
$Fnames = array();
$Lnames = array();
$stuid = array();
$stmt = $conn->prepare("SELECT * FROM student WHERE Student_ID='$id'");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$result){
      echo "wrong login";
    }
    else{
      $evaluator =  $result['First_Name'] . " " . $result['Last_Name'];
      $evalID = $result['idStudent'];
      echo "<h1>Hello " .  $evaluator . " you are ready to evaluate </h1>";
      echo "<h2>Grades are between 1-8</h2>";
      $idgroup = $result['Group_id'];
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
$conn = null;
  include "end.php";
?>
