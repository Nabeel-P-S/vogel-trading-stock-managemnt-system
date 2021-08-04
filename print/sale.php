<?php
include '../connect.php';
 // include("../main/navbar.php") 
?>
<!DOCTYPE html>
<html>
<head>
  <title>ARTICLE SALES</title>
</head>
</head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

  <script type="text/javascript">

        window.onload=window.print();
    </script>
<body>

  <div id="printableArea" class="container" style="height: 42vw;">
   

<div><h3 style="text-align: center;"><b>ARTICLE SALES</b></h3> </div>


    <div  class="col-md-12">
      <table border="1" class="table"   id="kit_table">
        <thead class="thead-dark" >



          

          <tr>
<th>ARTICLE NO:</th>
<th>ARTICLE NAME:</th>
<th>SELL QTY:</th>


</tr>

</thead>
<tbody id="table">
  <?php
  $query=mysqli_query($conn,"SELECT articles.article_no, articles.article_name,sales_articles.article_id,SUM(sales_articles.article_qty) as total FROM sales_articles LEFT JOIN articles on articles.article_id=sales_articles.article_id GROUP BY sales_articles.article_id");
  while($fetch=mysqli_fetch_array($query))
  {
   $article_name=$fetch["article_name"];
   $article_qty=$fetch["total"];
   $article_no=$fetch["article_no"];

   
  
   
   ?>
   <tr class="table_row">
     <td style="cursor: pointer;" > <?php echo $article_no;?> </td>
     <td style="cursor: pointer;"> <?php echo $article_name;?> </td>
     <td style="cursor: pointer;"> <?php echo $article_qty;?> </td>
     
     
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