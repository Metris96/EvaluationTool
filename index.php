<?php
include "start.php";
include "connection.php";
 echo "Hello! ". $_SESSION['cred'] . " " . $_SESSION['id'];
 if($_SESSION['cred'] == "teacher"){
   ?>
   <div class="studentgroups">
     <h1>Groups added to evaluation</h1>
   <?php
   $sql = $conn ->prepare ("SELECT `Group_Name`, `Group_No`, `idGroup` FROM `group` WHERE `Teacher_id`=?");
   $sql-> execute([$_SESSION['id']]);
   while($row = $sql->fetch()){
     $gid = $row['idGroup'];
     echo $row['Group_Name'] . " ". $row['Group_No'] . " <a href='/peerevaltool/viewevaluations.php?gid=$gid'><button>View evaluations</button></a> <br>";
   }
   ?>
 </div>
   <?php
  }
  $conn = null;
 include "end.php";
 ?>
