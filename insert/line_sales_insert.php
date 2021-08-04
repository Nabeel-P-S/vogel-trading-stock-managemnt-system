<?php
include ("../connect.php");
$sales_time=$_POST["sales_time"];
$sales_date=$_POST["sales_date"];
$sales_total=$_POST["sales_total"];

$profit_total=$_POST["profit_total"];

$staff_id=$_POST["staff_id"];


$sql="INSERT INTO `estimation` (`sales_id`, `sales_date`,`sales_time`, `staff_id`, `sales`,`profit`) VALUES (null,'$sales_date','$sales_time','$staff_id','$sales_total','$profit_total')";
echo $sql;

if($query=mysqli_query($conn,$sql)) 
{
  echo "success bill inserted";
}
else
{
  echo mysqli_error($conn);
}

$sales_id = $conn->insert_id;

mysqli_query($conn,"UPDATE `estimation` SET `invoice_no`= (SELECT sales_id)+1000");

// ========================================== ITEMS INSERTING ======================================================================
$article_id_array=json_decode($_POST['article_array_json']) ;
$item_qty_array=json_decode($_POST['item_qty_json']);

for ($i=0; $i <sizeof($article_id_array) ; $i++)
 { 
			$sql2="INSERT INTO `estimation_articles`(`id`, `sales_id`, `article_id`,`article_qty`) VALUES (NULL,$sales_id,'$article_id_array[$i]','$item_qty_array[$i]')";

							if($query=mysqli_query($conn,$sql2)) 
							{
							  echo "items inserted success";
							}
							else
							{
							  echo mysqli_error($conn);
							}
		mysqli_query($conn,"UPDATE `articles` SET article_stock =  article_stock - '$item_qty_array[$i]', staff_stock =  staff_stock + '$item_qty_array[$i]' WHERE article_id='$article_id_array[$i]'");
		
	mysqli_query($conn,"UPDATE `staff_articles` SET staff_stock =  staff_stock + '$item_qty_array[$i]' WHERE article_id='$article_id_array[$i]' AND staff_id='$staff_id'");
}

?>
