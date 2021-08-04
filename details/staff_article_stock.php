<?php
include ("../connect.php");

 $article_id=$_POST["article_id"];
 $staff_id=$_POST["staff_id"];
 $sql="SELECT * FROM `articles` WHERE article_id='$article_id'";
 
	$query=mysqli_query($conn,$sql);
	$fetch=mysqli_fetch_array($query);
	
	 $article_price=$fetch['article_price'];
	 $article_stock=$fetch['article_stock'];
	 $sales_price=$fetch['sales_price'];
	 $article_name=$fetch['article_name'];
	 $article_no=$fetch['article_no'];


	 $sql2="SELECT staff_stock,article_limit from staff_articles where staff_id='$staff_id' and article_id='$article_id'";
	 $query2=mysqli_query($conn,$sql2);
	 $fetch2=mysqli_fetch_array($query2);
	 $staff_stock=$fetch2['staff_stock'];
	 $article_limit=$fetch2['article_limit'];

	  // echo json_encode(array('article_stock'=>$article_stock,'article_price'=>$article_price,'sales_price'=>$sales_price,'article_name'=>$article_name,'article_no'=>$article_no));

 echo json_encode(array('article_stock'=>$article_stock,'article_price'=>$article_price,'staff_stock'=>$staff_stock,'article_limit'=>$article_limit,'sales_price'=>$sales_price,'article_name'=>$article_name,'article_no'=>$article_no));



			?>

			
