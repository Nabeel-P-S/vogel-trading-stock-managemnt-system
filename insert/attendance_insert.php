<?php
include ("../connect.php");


$date=$_POST['date'];

$present_array=json_decode($_POST['present_array_json']);
$absent_array=json_decode($_POST['absent_array_json']);
for ($i=0; $i <sizeof($present_array) ; $i++)
 { 
			$sql2="INSERT INTO `attendance` (`id`, `staff_id`, `attend`, `attend_date`) VALUES (NULL, '$present_array[$i]', '1', '$date')";


							if($query=mysqli_query($conn,$sql2)) 
							{
							  echo "p attendance inserted success";
							}
							else
							{
							  echo mysqli_error($conn);
							}

							
}
for ($i=0; $i <sizeof($absent_array) ; $i++)
 { 
			$sql3="INSERT INTO `attendance` (`id`, `staff_id`, `attend`, `attend_date`) VALUES (NULL, '$absent_array[$i]', '0', '$date')";


							if($query3=mysqli_query($conn,$sql3)) 
							{
							  echo "a attendance inserted success";
							}
							else
							{
							  echo mysqli_error($conn);
							}

							
}

?>


