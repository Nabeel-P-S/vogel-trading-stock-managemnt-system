<?php
include ("../connect.php");
// $addon_number=$_POST["addon_number"];

$branch_id=$_POST["branch_id"];
$branch_name=$_POST["branch_name"];



$sql="INSERT INTO `branches` (`branch_id`, `branch_name`)  VALUES (null,'$branch_name')";


if($query=mysqli_query($conn,$sql)) 
{
	echo "success";
}
else
{
	echo mysqli_error($conn);
}
?>


