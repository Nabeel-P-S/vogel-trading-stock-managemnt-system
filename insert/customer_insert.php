<?php
include ("../connect.php");
// $addon_number=$_POST["addon_number"];

// 

$customer_name=$_POST["customer_name"];
$customer_address=$_POST["customer_address"];
$customer_phone=$_POST["customer_phone"];
$customer_gst=$_POST["customer_gst"];


$sql="INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_address`, `customer_phone`, `customer_gst`)  VALUES (null,'$customer_name','$customer_address','$customer_phone','$customer_gst')";


if($query=mysqli_query($conn,$sql)) 
{
	echo "success";
}
else
{
	echo mysqli_error($conn);
}
?>


