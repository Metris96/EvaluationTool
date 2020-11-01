<?php
include "start.php";
$evaluator = $_GET['name'];
$criteria = array("Name", " Teamwork", "Quality", "Quantity", "Realibility");
  echo "Hello " .  $evaluator;
  echo "<table>";
  for($i = 0; $i < 6; $i++){
    echo "<tr>";
    for($j = 0; $j < 5; $j++){
      if($i == 0){
        echo "<td>" . $criteria[$j] . "</td>";
      }
      else{
        if($j == 0){
          if($i== 1){
            echo "<td>$evaluator</dt>";
          }
          else{
            echo "<td>Name " . $i . "</td>";
          }
        }
        else{
          echo "<td> <input type='number'value='$j'></input></td>";
        }

      }
  }
}
  echo "</tr>";
  echo "</table>";


  include "end.php";
?>
