<?php
include ("../connect.php");
// $addon_number=$_POST["addon_number"];

$tr_date=$_POST["tr_date"];
$tr_id=$_POST["tr_id"];
$staff_id=$_POST["staff_id"];
$amount=$_POST["amount"];
$tr_time=$_POST["tr_time"];
$details=$_POST["details"];

$sql="INSERT INTO `trs` (`tr_id`, `tr_date`, `staff_id`, `amount`,`tr_time`,`details`) VALUES (NULL, '$tr_date', '$staff_id', '$amount','$tr_time','$details')";
// echo $sql;

if($query=mysqli_query($conn,$sql)) 
{
	echo "TA INSERTED";
}
else
{
	echo mysqli_error($conn);
}
?>


