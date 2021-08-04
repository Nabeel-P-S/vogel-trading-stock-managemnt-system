<?php
include ("../connect.php");
$paid=$_POST["paid"];
$sales_id=$_POST["sales_id"];



mysqli_query($conn,"UPDATE `sales` SET `paid`='$paid'  WHERE sales_id='$sales_id'");


?>
