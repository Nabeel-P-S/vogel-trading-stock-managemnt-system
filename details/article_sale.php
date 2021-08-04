<?php
include ("../connect.php");

 $article_id=$_POST["article_id"];

 $sql="SELECT SUM(article_qty) as total_stock FROM `sales_articles` WHERE article_id='$article_id'";
	$query=mysqli_query($conn,$sql);
	$fetch=mysqli_fetch_array($query);
	 $total_stock=$fetch['total_stock'];
	

 echo json_encode(array('total_stock'=>$total_stock));


			?>

			
