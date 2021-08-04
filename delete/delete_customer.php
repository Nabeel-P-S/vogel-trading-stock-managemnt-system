<?php
include ("../connect.php");


$customer_id=$_POST["customer_id"];

mysqli_query($conn,"DELETE FROM `customers` WHERE customer_id='$customer_id'");


?>
