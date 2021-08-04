<?php
include ("../connect.php");
// $addon_number=$_POST["addon_number"];

$staff_name=$_POST["staff_name"];
$branch_id=$_POST["branch_id"];
$salary=$_POST["salary"];
$ta=$_POST["ta"];
$category=$_POST["category"];
$first_name=$_POST["first_name"];
$staff_area=$_POST["staff_area"];
$allowance=$_POST["allowance"];
$incentive=$_POST["incentive"];
$advance_limit=$_POST["advance_limit"];
$amount_limit=$_POST["amount_limit"];
$credit_amount=$_POST["credit_amount"];



$sql="INSERT INTO `staffs` (`staff_id`, `staff_name`, `branch_id`, `salary`, `amount_limit`, `credit_amount`, `staff_ta`, `staff_allowance`, `staff_incentive`, `advance_limit`, `area`, `category`, `first_name`)VALUES (null,'$staff_name','$branch_id','$salary','$amount_limit','$credit_amount','$ta','$allowance','$incentive','$advance_limit','$staff_area','$category','$first_name')";
$sql0="SELECT branch_name FROM `branches` where branch_id='$branch_id'";
$query0=mysqli_query($conn,$sql0);
$fetch0=mysqli_fetch_array($query0);
 $branch_name=$fetch0['branch_name'];
// echo $sql;


if($query=mysqli_query($conn,$sql)) 
{
	echo "success";
}
else
{
	echo mysqli_error($conn);
}
$staff_id=$conn->insert_id;
$sql5="INSERT INTO `customers` (`customer_id`, `customer_name`,`customer_address`)  VALUES (null,'$staff_name','$branch_name')";
$query5=mysqli_query($conn,$sql5);

$article_array=json_decode($_POST['article_array_json']) ;
$article_limit_array=json_decode($_POST['article_limit_json']);

for ($i=0; $i <sizeof($article_array) ; $i++)
 { 
			 $sql2="INSERT INTO `staff_articles`(`id`, `staff_id`, `article_id`,`article_limit`) VALUES (NULL,'$staff_id','$article_array[$i]','$article_limit_array[$i]')";

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


