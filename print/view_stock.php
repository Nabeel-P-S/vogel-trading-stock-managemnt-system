<?php
include '../connect.php';
  date_default_timezone_set('Asia/Kolkata');
   $date = date("d-m-Y");
     $stock_sql="SELECT stocks.stock_id,stocks.invoice_no,stocks.stock_date,stocks.lr_no,articles.article_no,articles.article_price,stocks.cargo,stocks.article_qty,articles.article_id,articles.sales_price,articles.article_name from stocks 
LEFT JOIN articles ON articles.article_id=stocks.article_id ORDER BY stocks.stock_id desc";
?>
<!DOCTYPE html>
<html>
<head>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="shortcut icon" href="../images/logo.jpg">
  <link rel="stylesheet" href="../css/w3.css">
  <style type="text/css">

<?php include ("../css/mycss.php")
 
?>

  </style>

  <title>Vogel Stock Management</title>
</head>
  <script type="text/javascript">
      
    </script>
<body>
<button style="float: right;" class="btn btn-success" onclick="window.print();">PRINT</button></div>

  <div id="printableArea" class="container" style="height: 42vw;">
   

<div>
  <h3 style="text-align: center;"><b>STOCK LIST ON <?php echo $date;?></b></h3> 

      <table border="1" class="table"  id="kit_table" style="border-width: 2px; background-color: white;">
        <thead >



          <tr class="table_head">
 <th style="*width: 5vw;"> NO</th>
<th style="*width: 9vw;">INVOICE NO</th>
<th style="text-align: center;">TRANSPORT </th>

<th style="text-align: center;">LR NO</th>
<th style="*width: 5vw;">DATE</th>
<th style="text-align: center;">ARTICLE NO</th>
<th style="text-align: center;">ARTICLE</th>
<!-- <th style="text-align: center;">COST</th>
<th style="text-align: center;">MRP</th> -->
<th style="text-align: center;">QTY</th>

</tr>

</thead>
<tbody id="table">
  <?php
  $query=mysqli_query($conn,$stock_sql);
  
    $stock_total=0;
    $stock_cost=0;
$stock_mrp=0;
    $count=0;
  while($fetch=mysqli_fetch_array($query))
  {
   $stock_id=$fetch["stock_id"];
   $article_no=$fetch["article_no"];
   $article_name=$fetch["article_name"];
   $article_qty=$fetch["article_qty"];
   $article_id=$fetch["article_id"];
   $article_price=$fetch["article_price"];
   $sales_price=$fetch["sales_price"];
   $lr_no=$fetch["lr_no"];
   $cargo=$fetch["cargo"];
   $invoice_no=$fetch["invoice_no"];
  
   $stock_date=$fetch["stock_date"];
 
$stock_total=$stock_total+$article_qty;
$stock_cost=$stock_cost+($article_price*$article_qty);
$stock_mrp=$stock_mrp+($sales_price*$article_qty);
$count++;
   ?>
   <tr class="table_row">
  <td  style="cursor: pointer;" > <?php echo $stock_id;?> </td>
     <td style="cursor: pointer;"> <?php echo $invoice_no;?> </td>
          <td>  <?php echo $cargo;?> </td>

      <td>  <?php echo $lr_no;?> </td>
     <td style="cursor: pointer; width: 10vw;" > <?php echo $stock_date;?> </td>
     <td style="cursor: pointer;" onclick="refresh_again('<?php echo $article_no;?>','article_no')"> <?php echo $article_no;?> </td>
     <td > <a> <?php echo $article_name; ?> </a></td>
       <!--    <td style="cursor: pointer;"> <?php echo $article_price;?> </td>
          <td style="cursor: pointer;"> <?php echo $sales_price;?> </td> -->

     <td style="cursor: pointer;"> <?php echo $article_qty;?> </td>
     
   <!--  <td><button class="btn-md btn-success" onclick="delete_stock('<?php echo $stock_id?>','<?php echo $article_id;?>','<?php echo $article_qty;?>')">DLT</button></td> -->
   </tr>
    <?php

}
?>
<tr class="table_summary">    

                  <th colspan="2">TOTAL : <?php echo $count;?> </th>
      <th colspan="2">STOCK : <?php echo $stock_total;?> </th>
      <th colspan="2">COST : <?php echo $stock_cost;?> </th>
      <th colspan="2">MRP : <?php echo $stock_mrp;?> </th>
     
      
     </tr>
</tbody>
</table>
</div>
</div>



</body>
</html>