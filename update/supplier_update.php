<?php
include ("../connect.php");
// $addon_number=$_POST["addon_number"];
$supplier_id=$_POST["supplier_id"];
$supplier_name=$_POST["supplier_name"];
$supplier_address=$_POST["supplier_address"];
$supplier_gst=$_POST["supplier_gst"];
$supplier_phone=$_POST["supplier_phone"];

mysqli_query($conn,"UPDATE `suppliers` SET
 `supplier_name`='$supplier_name', `supplier_address`='$supplier_address', `supplier_gst`='$supplier_gst',`supplier_phone`='$supplier_phone' WHERE supplier_id='$supplier_id'");


?>
