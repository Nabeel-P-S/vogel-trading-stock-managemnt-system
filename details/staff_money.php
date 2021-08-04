<?php
include ("../connect.php");

 $staff_id=$_POST["staff_id"];
  $sql="SELECT SUM(estimation.sales) as staff_taken FROM `estimation` WHERE staff_id='$staff_id'";
  $sql1="SELECT SUM(sales.paid) as paid FROM `sales` WHERE staff_id='$staff_id'";
  $sql2="SELECT amount_limit FROM `staffs` WHERE staff_id='$staff_id'";
	$query=mysqli_query($conn,$sql);
	$query1=mysqli_query($conn,$sql1);
	$query2=mysqli_query($conn,$sql2);
	$fetch=mysqli_fetch_array($query);
	$fetch1=mysqli_fetch_array($query1);
	$fetch2=mysqli_fetch_array($query2);
	 $staff_taken=$fetch['staff_taken'];
	 $paid=$fetch1['paid'];
	 $amount_limit=$fetch2['amount_limit'];


	 // $article_stock=$fetch['article_stock'];
	 // $sales_price=$fetch['sales_price'];
	 // $article_name=$fetch['article_name'];
	 // $article_no=$fetch['article_no'];


	 // $sql2="SELECT staff_stock,article_limit from staff_articles where staff_id='$staff_id' and article_id='$article_id'";
	 // $query2=mysqli_query($conn,$sql2);
	 // $fetch2=mysqli_fetch_array($query2);
	 // $staff_stock=$fetch2['staff_stock'];
	 // $article_limit=$fetch2['article_limit'];

	  // echo json_encode(array('article_stock'=>$article_stock,'article_price'=>$article_price,'sales_price'=>$sales_price,'article_name'=>$article_name,'article_no'=>$article_no));

 echo json_encode(array('staff_taken'=>$staff_taken,'paid'=>$paid,'amount_limit'=>$amount_limit));



			?>

			
