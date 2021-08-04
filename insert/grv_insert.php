<?php
include ("../connect.php");
$grv_date=$_POST["grv_date"];
$sales_id=$_POST["sales_id"];

$sales_total=$_POST["sales_total"];
$profit_total=$_POST["profit_total"];

$sql="INSERT INTO `grv` (`grv_id`, `sales_id`, `grv_date`, `sales`,`profit`) VALUES (null,'$sales_id','$grv_date','$sales_total','$profit_total')";


mysqli_query($conn,"UPDATE `sales` SET `sales`= sales - '$sales_total',`profit`=profit -'$profit_total'  WHERE sales_id='$sales_id'");

if($query=mysqli_query($conn,$sql)) 
{
  echo "success bill inserted";
}
else
{
  echo mysqli_error($conn);
}

$grv_id = $conn->insert_id;
// ========================================== ITEM ======================================================================

$article_id_array=json_decode($_POST['article_array_json']) ;
$article_qty_array=json_decode($_POST['item_qnty1_json']);

for ($i=0; $i <sizeof($article_id_array) ; $i++)
 { 
		if ($article_id_array[$i]==0 && $article_id_array[$i]=="") 
		{
		echo "failed";
		}
		else
		{
				mysqli_query($conn,"UPDATE `sales_articles` SET `article_qty`= article_qty - '$article_qty_array[$i]'   WHERE article_id='$article_id_array[$i]' AND sales_id='$sales_id;' ");
			
					$sql3="INSERT INTO `grv_articles`(`id`, `grv_id`, `article_id`,`article_qty`) VALUES (NULL,$grv_id,'$article_id_array[$i]','$article_qty_array[$i]')";
					$query=mysqli_query($conn,$sql3);
// echo $sql2;

							if($query=mysqli_query($conn,$sql2)) 
							{
							  echo "items inserted success";
							}
							else
							{
							  echo mysqli_error($conn);
							}

			mysqli_query($conn,"UPDATE `articles` SET article_stock =  article_stock + '$article_qty_array[$i]' WHERE article_id='$article_id_array[$i]'");
			}
}
?>
