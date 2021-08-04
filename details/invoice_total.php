<?php
include ("../connect.php");
 $invoice_no=$_POST["invoice_no"];
 $sql="SELECT * FROM `sales` WHERE invoice_no='$invoice_no'";
  $query=mysqli_query($conn,$sql);
  $fetch=mysqli_fetch_array($query);
   $sales=$fetch['sales'];
   $paid=$fetch['paid'];
  
 echo json_encode(array('sales'=>$sales,'paid'=>$paid));



      ?>

      
