<?php
include ("../connect.php");
// $addon_number=$_POST["addon_number"];

$supplier_id=$_POST["supplier_id"];
$supplier_name=$_POST["supplier_name"];
$supplier_address=$_POST["supplier_address"];
$supplier_phone=$_POST["supplier_phone"];
$supplier_gst=$_POST["supplier_gst"];


 $sql="INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_phone`, `supplier_gst`)  VALUES (null,'$supplier_name','$supplier_address','$supplier_phone','$supplier_gst')";


if($query=mysqli_query($conn,$sql)) 
{
	echo "success";
}
else
{
	echo mysqli_error($conn);
}
?>


