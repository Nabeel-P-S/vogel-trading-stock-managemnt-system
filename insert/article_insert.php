<?php
include ("../connect.php");
// $addon_number=$_POST["addon_number"];

$article_id=$_POST["article_id"];
$article_name=$_POST["article_name"];
$article_price=$_POST["article_price"];
$supplier_id=$_POST["supplier_id"];
$article_no=$_POST["article_no"];
$sales_price=$_POST["sales_price"];
$hsn_no=$_POST["hsn_no"];
$sgst=$_POST["sgst"];
$cess=$_POST["cess"];
$cgst=$_POST["cgst"];
$igst=$_POST["igst"];



 $sql="INSERT INTO `articles` (`article_id`, `article_name`,`article_price`,`supplier_id`,`article_no`,`sales_price`,`hsn_no`,`sgst`,`cgst`,`igst`,`cess`)  VALUES (null,'$article_name','$article_price','$supplier_id','$article_no','$sales_price','$hsn_no','$sgst','$cgst','$igst','$cess')";


if($query=mysqli_query($conn,$sql)) 
{
	echo "success";
}
else
{
	echo mysqli_error($conn);
}
$article_id = $conn->insert_id;
$staff_array=json_decode($_POST['staff_array_json']) ;
$article_limit_array=json_decode($_POST['article_limit_json']);

for ($i=0; $i <sizeof($staff_array) ; $i++)
 { 
			echo $sql2="INSERT INTO `staff_articles`(`id`, `staff_id`, `article_id`,`article_limit`) VALUES (NULL,'$staff_array[$i]','$article_id','$article_limit_array[$i]')";

							if($query=mysqli_query($conn,$sql2)) 
							{
							  echo "limit inserted success";
							}
							else
							{
							  echo mysqli_error($conn);
							}
				
}
?>


