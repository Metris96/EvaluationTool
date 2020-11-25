<?php
include "start.php";
include "connection.php";
if(isset($_POST['send'])){
  $string = $_POST['json'];
  $groups = array();
  $grpN = array();
  $values = json_decode($string, true);
  $values = (array_filter($values));
  for($i = 0; $i < count($values); $i++){
    if(in_array($values[$i]['Grp_No'], $groups)){

    }
  else{
    array_push($groups, $values[$i]['Grp_No']);
    //echo $values[$i]['Grp_No'] . " " . $values[$i]['Grp_Name'] ."<br>";
    $number = $values[$i]['Grp_No'];
    $name = $values[$i]['Grp_Name'];
    $teacher = $_SESSION['id'];
    $sql ="INSERT INTO `group`(Group_Name, Group_No, Teacher_id) VALUES ('$name', $number, $teacher)";

    $conn ->exec($sql);

  }
}
foreach($values as $value){
  $grpName = $value['Grp_Name'];
  $fName = $value['First Name'];
  $lName = $value['Familiar Name'];
  $Email = $value['E-Mail'];
  $Student_id = $value['Student_ID'];
  $Class = $value['Class'];
  $groupid = $conn ->prepare ("SELECT idGroup FROM `group` WHERE Group_Name=? LIMIT 1");
  $groupid-> execute([$grpName]);
  $result = $groupid->fetch();

  $groupNo = $result[0];
  $sql = "INSERT INTO `student`(First_Name, Last_Name, `E-Mail`, Student_ID, Class, Group_id) VALUES('$fName', '$lName', '$Email', '$Student_id','$Class' ,'$groupNo')";
  $conn ->exec($sql);
}
$conn = null;
echo "Succesfully added students";
};
?>
