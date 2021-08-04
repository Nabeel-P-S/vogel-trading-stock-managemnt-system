<?php
include '../connect.php';
 include("../main/navbar.php") 
?>
<!DOCTYPE html>
<html>
<head>
  <title>ARTICLE SALES</title>
</head>
  <script type="text/javascript">
        window.onload=window.print();
    </script>
<body>

  <div id="printableArea" class="container" >
   

<div><h3 style="text-align: center;"><b>BRANCH SALES</b></h3> </div>


    <div  class="col-md-12" >
      <table border="1" class="table" >
        <thead >
                   <tr>
                      <th> SL NO:</th>
                      <th>BRANCH NAME:</th>
                      <th> SALES:</th>
                      <th> PROFIT:</th>
                  
                    
                    </tr>

        </thead>
<tbody id="table">
<?php
        $sql="SELECT branches.branch_id,
       branches.branch_name,
       Sum(sales.sales) as sales,
       Sum(sales.profit) as profit
FROM   branches
       LEFT JOIN sales
              ON sales.branch_id = branches.branch_id
       LEFT JOIN sales_articles
              ON sales_articles.sales_id = sales.sales_id
GROUP  BY branches.branch_id";
      $query=mysqli_query($conn,$sql);
      while($fetch=mysqli_fetch_array($query))
      {
       $branch_id=$fetch["branch_id"];
       $branch_name=$fetch["branch_name"];
       $sales=$fetch["sales"];
       $profit=$fetch["profit"];
      

   
  
   
?>
   <tr class="table_row">
     <td style="cursor: pointer;" > <?php echo $branch_id;?> </td>
     <td style="cursor: pointer;"> <?php echo $branch_name;?> </td>
     <td style="cursor: pointer;"> <?php echo $sales;?> </td>
     <td style="cursor: pointer;"> <?php echo $profit;?> </td>
    
 
   </tr>
    <?php

}
?>
</tbody>
</table>
</div>
</div>
</body>
</html>






<!-- 
SELECT branches.branch_id,
       branches.branch_name,
       Sum(sales.sales) as sales,
       Sum(sales.profit) as profit,
       SUM(sales_articles.article_qty) as qty
FROM   branches
       LEFT JOIN sales
              ON sales.branch_id = branches.branch_id
       LEFT JOIN sales_articles
              ON sales_articles.sales_id = sales.sales_id
        LEFT JOIN sales_articles
              ON sales_articles.article_id = articles.article_id      
GROUP  BY branches.branch_id
 -->

