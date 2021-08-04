<?php
include ("../connect.php");


$staff_id=$_POST["staff_id"];

mysqli_query($conn,"DELETE FROM `staffs` WHERE staff_id='$staff_id'");


?>
