<?php
 $sales_sql="SELECT sales.sales_id, 
       sales.invoice_no, 
       sales.sales_date, 
       grv.grv_date, 
       customers.customer_name, 
       customers.customer_id, 
       customers.customer_address, 
       customers.customer_phone, 
       customers.customer_gst, 
       branches.branch_name, 
       staffs.staff_name, 
       grv.sales, 
       grv.grv_id, 
       grv.profit,
       sales.paid
FROM   sales 
       LEFT JOIN customers 
              ON customers.customer_id = sales.customer_id 
       LEFT JOIN staffs 
              ON staffs.staff_id = sales.staff_id 
       LEFT JOIN branches 
              ON branches.branch_id = staffs.branch_id  
        LEFT JOIN grv 
              ON grv.sales_id = sales.sales_id 
WHERE  grv.grv_id = '$grv_id' ";


       $article_sql="SELECT articles.article_id, 
             articles.article_no, 
             articles.article_name, 
             articles.article_price, 
             articles.sales_price, 
             grv_articles.article_qty 
      FROM   grv_articles 
             LEFT JOIN articles 
                    ON articles.article_id = grv_articles.article_id 
                    
      WHERE  grv_articles.grv_id ='$grv_id' ";

    $query=mysqli_query($conn,$sales_sql);
    $article_query=mysqli_query($conn,$article_sql);
    $article_query2=mysqli_query($conn,$article_sql);
    $fetch=mysqli_fetch_array($query);
    $sales_id=$fetch["sales_id"];
   $sales_date=$fetch["sales_date"];
   $grv_date=$fetch["grv_date"];
     $sales_date = date("d-m-Y", strtotime($sales_date));
     $grv_date = date("d-m-Y", strtotime($grv_date));
   $invoice_no=$fetch["invoice_no"];
   $sales=$fetch["sales"];
   $grv_id=$fetch["grv_id"];
   $profit=$fetch["profit"];
     // $amount= getIndianCurrency($sales);
     // $amount= getIndianCurrency(1000.5);
   $customer_name=$fetch["customer_name"];
   $customer_id=$fetch["customer_id"];
   $customer_phone=$fetch["customer_phone"]; 
   $customer_gst=$fetch["customer_gst"];
   $branch_name=$fetch["branch_name"];
   $staff_name=$fetch["staff_name"];
   $sales_id=$fetch["sales_id"];
  
   $invoice_no=$fetch["invoice_no"];
   $sales=$fetch["sales"];
   $paid=$fetch["paid"];
    $qty=0;
   $staff_name=$fetch["staff_name"];
   $branch_name=$fetch["branch_name"];
       $customer_address=$fetch["customer_address"];


?>