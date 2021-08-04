<?php
include ("../connect.php");

 $customer_id=$_POST["customer_id"];

 $sql="SELECT * FROM `customers` WHERE customer_id='$customer_id'";
	$query=mysqli_query($conn,$sql);
	$fetch=mysqli_fetch_array($query);
	 $customer_name=$fetch['customer_name'];
	 $customer_address=$fetch['customer_address'];
	 $customer_phone=$fetch['customer_phone'];
	
	 $customer_gst=$fetch['customer_gst'];
	

 echo json_encode(array('customer_name'=>$customer_name,'customer_address'=>$customer_address,'customer_phone'=>$customer_phone,'customer_gst'=>$customer_gst));



			?>

			
