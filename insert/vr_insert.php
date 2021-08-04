<?php
include ("../connect.php");
$vr_date=$_POST["vr_date"];
$vr_time=$_POST["vr_time"];


$staff_id=$_POST["staff_id"];
$total=$_POST["total"];

$sql="INSERT INTO `voucher` (`voucher_id`, `voucher_date`, `voucher_time`, `staff_id`,`voucher_amount`) VALUES (null,'$vr_date','$vr_time','$staff_id','$total')";
// echo $sql;
if($query=mysqli_query($conn,$sql)) 
{
  // echo "Voucher Added";
}
else
{
  echo mysqli_error($conn);
}
$voucher_id = $conn->insert_id;
$article_id_array=json_decode($_POST['article_array_json']) ;
$balance_id_array=json_decode($_POST['balance_array_json']) ;
$price_array_json=json_decode($_POST['price_array_json']);
$method_array_json=json_decode($_POST['method_array_json']);
for ($i=0; $i <sizeof($article_id_array) ; $i++)
 { 
			$sql2="INSERT INTO `voucher_details` (`id`, `voucher_id`, `invoice_no`, `paid`, `method`,`balance`) VALUES  (NULL,$voucher_id,'$article_id_array[$i]','$price_array_json[$i]','$method_array_json[$i]','$balance_id_array[$i]')";


							if($query=mysqli_query($conn,$sql2)) 
							{
							  echo "items inserted success";
							}
							else
							{
							  echo mysqli_error($conn);
							}

							mysqli_query($conn,"UPDATE `sales` SET paid =  paid + '$price_array_json[$i]'  WHERE invoice_no='$article_id_array[$i]'");
						}