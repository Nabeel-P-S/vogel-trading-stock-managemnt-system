<?php
include ("../connect.php");


$sales_id=$_POST["sales_id"];
  $sql1="SELECT staff_id FROM `sales` WHERE sales_id='$sales_id'";

     $query1=mysqli_query($conn,$sql1);

  $fetch1=mysqli_fetch_array($query1);

   $staff_id=$fetch1['staff_id'];

   $query2=mysqli_query($conn,"SELECT sales_articles.sales_id, sales_articles.article_id,sales_articles.article_qty,articles.article_no,articles.sales_price, sales_articles.id,articles.article_name FROM `sales_articles` left join `articles` on articles.article_id=sales_articles.article_id  WHERE sales_articles.sales_id='$sales_id'");

  while ($fetch2=mysqli_fetch_array($query2))
                 {
    
            
         
                $article_id=$fetch2['article_id'];
        
                 $article_qty=$fetch2['article_qty'];
            

               			mysqli_query($conn,"UPDATE `articles` SET staff_stock =  staff_stock + '$article_qty' ,sold =  sold - '$article_qty'  WHERE article_id='$article_id'");
	mysqli_query($conn,"UPDATE `staff_articles` SET staff_stock =  staff_stock + '$article_qty' WHERE article_id='$article_id' AND staff_id='$staff_id'");
  
             }
mysqli_query($conn,"DELETE FROM `sales_articles` WHERE sales_id='$sales_id'");
mysqli_query($conn,"DELETE FROM `sales` WHERE sales_id='$sales_id'");


?>
