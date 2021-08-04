<?php
include ("../connect.php");


$supplier_id=$_POST["supplier_id"];

mysqli_query($conn,"DELETE FROM `suppliers` WHERE supplier_id='$supplier_id'");


?>
