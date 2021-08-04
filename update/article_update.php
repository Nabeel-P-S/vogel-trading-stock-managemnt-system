<?php
include ("../connect.php");
// $addon_number=$_POST["addon_number"];
$article_id=$_POST["article_id"];
$article_no=$_POST["article_no"];
$sales_price=$_POST["sales_price"];
$article_name=$_POST["article_name"];
$article_price=$_POST["article_price"];
$supplier_id=$_POST["supplier_id"];
// $article_stock=$_POST["article_stock"];
$hsn_no=$_POST["hsn_no"];
$sgst=$_POST["sgst"];
$cgst=$_POST["cgst"];
$cess=$_POST["cess"];
$igst=$_POST["igst"];


$sql="UPDATE `articles` SET `article_no`='$article_no', `sales_price`='$sales_price', `article_name`='$article_name', `article_price`='$article_price',`hsn_no`='$hsn_no',`sgst`='$sgst',`cgst`='$cgst',`igst`='$igst',`cess`='$cess', `supplier_id`='$supplier_id' WHERE article_id='$article_id'";
echo $sql;
mysqli_query($conn,$sql);

$staff_array=json_decode($_POST['staff_array_json']) ;
$article_limit_array=json_decode($_POST['article_limit_json']);

for ($i=0; $i <sizeof($staff_array) ; $i++)
 { 
 	mysqli_query($conn,"UPDATE `staff_articles` SET  `article_limit`='$article_limit_array[$i]' WHERE article_id='$article_id' AND staff_id='$staff_array[$i]'");
 
				
}

?>
