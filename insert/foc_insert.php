<?php
include ("../connect.php");
$foc_date=$_POST["sales_date"];
$foc_time=$_POST["sales_time"];
$foc_total=$_POST["sales_total"];
$profit_total=$_POST["profit_total"];
$customer_id=$_POST["customer_id"];
$paid=$_POST["paid"];
$staff_id=$_POST["staff_id"];


$sql="INSERT INTO `foc` (`foc_id`, `foc_date`, `foc_time`, `customer_id`, `staff_id`, `foc`, `profit`, `paid`) VALUES (null,'$foc_date','$foc_time','$customer_id','$staff_id','$foc_total','$profit_total','$paid')";




echo $sql;
if($query=mysqli_query($conn,$sql)) 
{
  echo "foc bill inserted";
}
else
{
  echo mysqli_error($conn);
}
$foc_id = $conn->insert_id;


// ========================================== ITEMS INSERTING ======================================================================
$article_id_array=json_decode($_POST['article_array_json']) ;
$item_qty_array=json_decode($_POST['item_qty_json']);

for ($i=0; $i <sizeof($article_id_array) ; $i++)
 { 
			$sql2="INSERT INTO `foc_articles`(`id`, `foc_id`, `article_id`,`article_qty`) VALUES (NULL,$foc_id,'$article_id_array[$i]','$item_qty_array[$i]')";

							if($query=mysqli_query($conn,$sql2)) 
							{
							  echo "items inserted success";
							}
							else
							{
							  echo mysqli_error($conn);
							}
				mysqli_query($conn,"UPDATE `articles` SET article_stock =  article_stock - '$item_qty_array[$i]' ,fsold =  fsold + '$item_qty_array[$i]' WHERE article_id='$article_id_array[$i]'");
	

}

?>
