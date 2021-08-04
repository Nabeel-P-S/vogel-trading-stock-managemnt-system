<?php
 $sales_sql="SELECT estimation.sales_id, 
     
       estimation.sales_date, 
       staff_grv.grv_date, 

       branches.branch_name, 
       staffs.staff_name, 
       staff_grv.sales, 
       staff_grv.grv_id, 
       staff_grv.profit
FROM   estimation 
     
       LEFT JOIN staffs 
              ON staffs.staff_id = estimation.staff_id 
       LEFT JOIN branches 
              ON branches.branch_id = staffs.branch_id  
        LEFT JOIN staff_grv 
              ON staff_grv.sales_id = estimation.sales_id 
WHERE  staff_grv.grv_id = '$grv_id' ";


       $article_sql="SELECT articles.article_id, 
             articles.article_no, 
             articles.article_name, 
             articles.article_price, 
             articles.sales_price, 
             staff_grv_articles.article_qty 
      FROM   staff_grv_articles 
             LEFT JOIN articles 
                    ON articles.article_id = staff_grv_articles.article_id 
                    
      WHERE  staff_grv_articles.grv_id ='$grv_id' ";

    $query=mysqli_query($conn,$sales_sql);
    $article_query=mysqli_query($conn,$article_sql);
    $article_query2=mysqli_query($conn,$article_sql);
    $fetch=mysqli_fetch_array($query);
    $sales_id=$fetch["sales_id"];
   $sales_date=$fetch["sales_date"];
   $grv_date=$fetch["grv_date"];
     $sales_date = date("d-m-Y", strtotime($sales_date));
     $grv_date = date("d-m-Y", strtotime($grv_date));
   
   $sales=$fetch["sales"];
   $grv_id=$fetch["grv_id"];
   $profit=$fetch["profit"];
     // $amount= getIndianCurrency($sales);
     // $amount= getIndianCurrency(1000.5);
  
   $branch_name=$fetch["branch_name"];
   $staff_name=$fetch["staff_name"];
   $sales_id=$fetch["sales_id"];

    $qty=0;
   $staff_name=$fetch["staff_name"];
   $branch_name=$fetch["branch_name"];
  


?>