<?php
include ("../connect.php");


$date=$_POST['date'];

$present_array=json_decode($_POST['present_array_json']);
$absent_array=json_decode($_POST['absent_array_json']);


for ($i=0; $i <sizeof($present_array) ; $i++)
 { 

 	 	mysqli_query($conn,"UPDATE `attendance` SET  `attend`= '1' WHERE attend_date='$date' AND staff_id='$present_array[$i]'");
						
}
for ($i=0; $i <sizeof($absent_array) ; $i++)
 { 

 	mysqli_query($conn,"UPDATE `attendance` SET  `attend`= '0' WHERE attend_date='$date' AND staff_id='$absent_array[$i]'");


							
}

?>
