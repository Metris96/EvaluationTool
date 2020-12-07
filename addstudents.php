<?php
include "start.php";
include "connection.php";
$subject ="Peerevaluation now avaiable";

$message="Hello";

$headers = "From: Noreply <Noreply@mail.com>\r\n";
$headers .= "Content-type: text/html\r\n";
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
  $message="Hello \r\n You can do the evalution at:http://localhost/peerevaltool/student.php?sid=$Student_id ";
  $groupNo = $result[0];
  $sql = "INSERT INTO `student`(First_Name, Last_Name, `E-Mail`, Student_ID, Class, Group_id) VALUES('$fName', '$lName', '$Email', '$Student_id','$Class' ,'$groupNo')";
  $conn ->exec($sql);
  mail($Email,  $subject, $message, $headers);
}
$conn = null;
echo "Succesfully added students";
};
?>
