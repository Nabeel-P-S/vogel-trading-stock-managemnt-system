<?php
include ("../connect.php");
$sales_time=$_POST["sales_time"];
$sales_date=$_POST["sales_date"];
$invoice_no=$_POST["sales_invoice_no"];
$customer_id=$_POST["customer_id"];
$sales_total=$_POST["sales_total"];
$invoice_total=$_POST["invoice_total"];
function vround( $number)
{
  $whole = floor($number);     
  $fraction = $number - $whole;
  if (( $fraction <= 0.54 && $fraction>0.04))    
  {
    $result= $whole+.50;
  }
  else if (( $fraction > 0.54 ))  
  {
    $result=$whole+1;
  }
  else{
    $result=$whole;
  }
  return ($result);
}
$invoice_total=vround($invoice_total);

$paid=$_POST["paid"];
$category=0;
$profit_total=$_POST["profit_total"];

$staff_id=$_POST["staff_id"];


$sql="INSERT INTO `sales` (`sales_id`, `invoice_no`, `sales_date`,`sales_time`, `customer_id`, `staff_id`, `sales`,`profit`,`paid`,`category`,`total`) VALUES (null,'$invoice_no','$sales_date','$sales_time','$customer_id','$staff_id','$sales_total','$profit_total','$paid','$category','$invoice_total')";
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
mysqli_query($conn,"UPDATE `sales` SET `invoice_no`= (SELECT sales_id)+1000");

// ========================================== ITEMS INSERTING ======================================================================
$article_id_array=json_decode($_POST['article_array_json']) ;
$item_qty_array=json_decode($_POST['item_qty_json']);

for ($i=0; $i <sizeof($article_id_array) ; $i++)
 { 
			$sql2="INSERT INTO `sales_articles`(`id`, `sales_id`, `article_id`,`article_qty`) VALUES (NULL,$sales_id,'$article_id_array[$i]','$item_qty_array[$i]')";

							if($query=mysqli_query($conn,$sql2)) 
							{
							  // echo "items inserted success";
							}
							else
							{
							  echo mysqli_error($conn);
							}
							
				mysqli_query($conn,"UPDATE `articles` SET staff_stock =  staff_stock - '$item_qty_array[$i]',sold =  sold + '$item_qty_array[$i]' WHERE article_id='$article_id_array[$i]'");
	mysqli_query($conn,"UPDATE `staff_articles` SET staff_stock =  staff_stock - '$item_qty_array[$i]' WHERE article_id='$article_id_array[$i]' AND staff_id='$staff_id'");

}

?>
