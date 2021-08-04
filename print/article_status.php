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
        // window.onload=window.print();
    </script>
<body>

  <div id="printableArea" class="container" >
   

<div><h3 style="text-align: center;"><b>ARTICLE SALES</b></h3> </div>


    <div  class="col-md-12" >
      <table border="1" class="table" >
        <thead >
                   <tr>
                      <th> NO:</th>
                      <th>ARTICLE NAME:</th>
                      <th> PRICE:</th>
                      <th> MRP:</th>
                      <th> STOCK:</th>
                        <th>SALES:</th>
                      <th> AVAILABLE:</th>
                    
                    </tr>

        </thead>
<tbody id="table">
<?php
        $sql="SELECT articles.article_id,
           articles.article_name,
           articles.article_no,
             articles.article_price,
             articles.sales_price,
               articles.article_stock AS available,
           Sum(sales_articles.article_qty) as sales,
           Sum(stocks.article_qty) as article_stock
                FROM   articles
           LEFT JOIN sales_articles
                  ON sales_articles.article_id = articles.article_id 
            LEFT JOIN stocks
                  ON stocks.article_id = articles.article_id
        GROUP  BY articles.article_id";
      $query=mysqli_query($conn,$sql);
      while($fetch=mysqli_fetch_array($query))
      {
       $article_no=$fetch["article_no"];
       $article_name=$fetch["article_name"];
       $article_price=$fetch["article_price"];
       $sales_price=$fetch["sales_price"];
       $article_stock=$fetch["article_stock"];
       $sales=$fetch["sales"];
       $available=$fetch["available"];

   
  
   
?>
   <tr class="table_row">
     <td style="cursor: pointer;" > <?php echo $article_no;?> </td>
     <td style="cursor: pointer;"> <?php echo $article_name;?> </td>
     <td style="cursor: pointer;"> <?php echo $article_price;?> </td>
     <td style="cursor: pointer;"> <?php echo $sales_price;?> </td>
          <td style="cursor: pointer;"> <?php echo $article_stock;?> </td>
     <td style="cursor: pointer;"> <?php echo $sales;?> </td>  
     <td style="cursor: pointer;"> <?php echo $available;?> </td>
 
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










