<?php
include ("../connect.php");

 $date=$_POST["date"];


 // $sql="SELECT SUM(article_qty) as total_stock FROM `stocks` WHERE article_id='$article_id'";
 $sql="SELECT * FROM `attendance` WHERE attend_date='$date'";


	$query=mysqli_query($conn,$sql);
	$fetch=mysqli_fetch_array($query);
	
	 $staff_id=$fetch['staff_id'];
	

 echo json_encode(array('staff_id'=>$staff_id));



			?>

			
