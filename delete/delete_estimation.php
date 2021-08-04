<?php
include ("../connect.php");


$sales_id=$_POST["sales_id"];
$staff_id=$_POST["staff_id"];

   $query2=mysqli_query($conn,"SELECT estimation_articles.sales_id, estimation_articles.article_id,estimation_articles.article_qty,articles.article_no,articles.sales_price, estimation_articles.id,articles.article_name FROM `estimation_articles` left join `articles` on articles.article_id=estimation_articles.article_id  WHERE estimation_articles.sales_id='$sales_id'");
  while ($fetch2=mysqli_fetch_array($query2))
                 { 
    
            
         
                $article_id=$fetch2['article_id'];
        
                 $article_qty=$fetch2['article_qty'];
               mysqli_query($conn,"UPDATE `articles` SET article_stock =  article_stock + '$article_qty',staff_stock =  staff_stock - '$article_qty' WHERE article_id='$article_id'");
$sql="UPDATE `staff_articles` SET staff_stock =  staff_stock - '$article_qty' WHERE article_id='$article_id' AND staff_id='$staff_id'";
// echo $sql;
	// mysqli_query($conn,$sql);
	if($query=mysqli_query($conn,$sql)) 
{
	echo "success";
}
else
{
	echo mysqli_error($conn);
}
  
             }
mysqli_query($conn,"DELETE FROM `estimation_articles` WHERE sales_id='$sales_id'");
mysqli_query($conn,"DELETE FROM `estimation` WHERE sales_id='$sales_id'");


?>
