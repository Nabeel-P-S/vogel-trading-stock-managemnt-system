<?php
include ("../connect.php");


$branch_id=$_POST["branch_id"];

mysqli_query($conn,"DELETE FROM `branchecs` WHERE branch_id='$branch_id'");


?>
