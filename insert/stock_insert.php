<?php
include ("../connect.php");

$stock_date=$_POST["stock_date"];
$stock_id=$_POST["stock_id"];
$article_id=$_POST["article_id"];
$invoice_no=$_POST["invoice_no"];

$lr_no=$_POST["lr_no"];
$cargo=$_POST["cargo"];
$article_qty=$_POST["article_qty"];

$sql="INSERT INTO `stocks` (`stock_id`, `article_id`, `article_qty`, `invoice_no`,  `stock_date`, `lr_no`, `cargo`)  VALUES (null,'$article_id','$article_qty','$invoice_no','$stock_date','$lr_no','$cargo')";


if($query=mysqli_query($conn,$sql)) 
{
	echo "success";
}
else
{
	echo mysqli_error($conn);
}


mysqli_query($conn,"UPDATE articles SET article_stock = article_stock + '$article_qty' WHERE article_id='$article_id'");

?>

