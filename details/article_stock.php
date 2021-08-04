<?php
include ("../connect.php");

 $article_id=$_POST["article_id"];
 $staff_id=$_POST["staff_id"];

 // $sql="SELECT SUM(article_qty) as total_stock FROM `stocks` WHERE article_id='$article_id'";
 $sql="SELECT * FROM `articles` WHERE article_id='$article_id'";
 $sql2="SELECT * FROM `staff_articles` WHERE article_id='$article_id' AND staff_id='$staff_id'";

$query2=mysqli_query($conn,$sql2);
$fetch2=mysqli_fetch_array($query2);
 $staff_stock=$fetch2['staff_stock'];
 
 	// $sql1="SELECT articles.article_name,SUM(estimation_articles.article_qty) as article_qty FROM `estimation_articles` LEFT JOIN estimation on estimation.sales_id=estimation_articles.sales_id left JOIN articles ON articles.article_id=estimation_articles.article_id WHERE estimation.staff_id='$staff_id' AND articles.article_id='$article_id'";


	$query=mysqli_query($conn,$sql);
	$fetch=mysqli_fetch_array($query);
	
	 $article_price=$fetch['article_price'];
	 $main_stock=$fetch['article_stock'];
	 $sales_price=$fetch['sales_price'];
	 $sgst=$fetch['sgst'];
	 $cgst=$fetch['cgst'];
	 $igst=$fetch['igst'];
	 $cess=$fetch['cess'];
	 $article_name=$fetch['article_name'];
	 $article_no=$fetch['article_no'];

// $query1=mysqli_query($conn,$sql1);$fetch1=mysqli_fetch_array($query1); $staff_stock=$fetch1['article_qty'];
 echo json_encode(array('staff_stock'=>$staff_stock,'main_stock'=>$main_stock,'article_price'=>$article_price,'sales_price'=>$sales_price,'sgst'=>$sgst,'cgst'=>$cgst,'igst'=>$igst,'cess'=>$cess,'article_name'=>$article_name,'article_no'=>$article_no));



			?>

			
