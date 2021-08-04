<?php
include ("../connect.php");
// $addon_number=$_POST["addon_number"];
$customer_id=$_POST["customer_id"];
$customer_name=$_POST["customer_name"];
$customer_address=$_POST["customer_address"];
$customer_gst=$_POST["customer_gst"];
$customer_phone=$_POST["customer_phone"];

mysqli_query($conn,"UPDATE `customers` SET
 `customer_name`='$customer_name', `customer_address`='$customer_address', `customer_gst`='$customer_gst',`customer_phone`='$customer_phone' WHERE customer_id='$customer_id'");


?>
