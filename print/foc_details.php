<?php
 $foc_sql="SELECT foc.foc_id, 
       foc.invoice_no, 
       foc.foc_date, 
       customers.customer_name, 
       customers.customer_id, 
       customers.customer_address, 
       customers.customer_phone, 
       customers.customer_gst, 
       branches.branch_name, 
       staffs.staff_name, 
       foc.foc, 
       foc.profit,
       foc.paid
FROM   foc 
       LEFT JOIN customers 
              ON customers.customer_id = foc.customer_id 
       LEFT JOIN staffs 
              ON staffs.staff_id = foc.staff_id 
       LEFT JOIN branches 
              ON branches.branch_id = foc.branch_id 
WHERE  foc.foc_id = '$foc_id' ";


       $article_sql="SELECT articles.article_id, 
             articles.article_no, 
             articles.article_name, 
             articles.article_price, 
             articles.sales_price, 
             foc_articles.article_qty 
      FROM   foc_articles 
             LEFT JOIN articles 
                    ON articles.article_id = foc_articles.article_id 
      WHERE  foc_articles.foc_id = '$foc_id' ";

    $query=mysqli_query($conn,$foc_sql);
    $article_query=mysqli_query($conn,$article_sql);
    $article_query2=mysqli_query($conn,$article_sql);
    $fetch=mysqli_fetch_array($query);
    $foc_id=$fetch["foc_id"];
   $foc_date=$fetch["foc_date"];
     $foc_date = date("d-m-Y", strtotime($foc_date));
   $invoice_no=$fetch["invoice_no"];
   $foc=$fetch["foc"];
   $profit=$fetch["profit"];
     // $amount= getIndianCurrency($foc);
     // $amount= getIndianCurrency(1000.5);
   $customer_name=$fetch["customer_name"];
   $customer_id=$fetch["customer_id"];
   $customer_phone=$fetch["customer_phone"]; 
   $customer_gst=$fetch["customer_gst"];
   $branch_name=$fetch["branch_name"];
   $staff_name=$fetch["staff_name"];
   $foc_id=$fetch["foc_id"];
  
   $invoice_no=$fetch["invoice_no"];
   $foc=$fetch["foc"];
   $paid=$fetch["paid"];
    $qty=0;
   $staff_name=$fetch["staff_name"];
   $branch_name=$fetch["branch_name"];
       $customer_address=$fetch["customer_address"];

?>