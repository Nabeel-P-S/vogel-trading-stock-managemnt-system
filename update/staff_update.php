<?php
include ("../connect.php");
// $addon_number=$_POST["addon_number"];

$staff_id=$_POST["staff_id"];
$staff_name=$_POST["staff_name"];
$branch_id=$_POST["branch_id"];
$salary=$_POST["salary"];
$area=$_POST["area"];
$category=$_POST["category"];
$first_name=$_POST["first_name"];
$staff_ta=$_POST["staff_ta"];
$staff_allowance=$_POST["staff_allowance"];
$advance_limit=$_POST["advance_limit"];
$staff_incentive=$_POST["staff_incentive"];
$amount_limit=$_POST["amount_limit"];
$credit_amount=$_POST["credit_amount"];


$sql="UPDATE `staffs` SET `staff_name`='$staff_name', `branch_id`='$branch_id'
, `salary`='$salary'
, `area`='$area'
, `category`='$category'
, `first_name`='$first_name'
, `staff_ta`='$staff_ta'
, `staff_allowance`='$staff_allowance'
, `advance_limit`='$advance_limit'
, `staff_incentive`='$staff_incentive'
, `amount_limit`='$amount_limit',`credit_amount`='$credit_amount' WHERE staff_id='$staff_id'";
echo $sql;
mysqli_query($conn,$sql);

$article_array=json_decode($_POST['article_array_json']) ;
$article_limit_array=json_decode($_POST['article_limit_json']);

for ($i=0; $i <sizeof($article_array) ; $i++)
 { 
 	mysqli_query($conn,"UPDATE `staff_articles` SET  `article_limit`='$article_limit_array[$i]' WHERE staff_id='$staff_id' AND article_id='$article_array[$i]'");
 
				
}
?>


