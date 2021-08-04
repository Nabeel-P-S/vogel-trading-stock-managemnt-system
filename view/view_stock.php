<?php
include '../connect.php';
include("../main/navbar.php");
$from_date='2020-06-10';
$to_date=$date;
$stock_sql="SELECT stocks.stock_id,stocks.invoice_no,stocks.stock_date,stocks.lr_no,articles.article_no,articles.article_price,stocks.cargo,stocks.article_qty,articles.article_id,articles.sales_price,articles.article_name from stocks 
LEFT JOIN articles ON articles.article_id=stocks.article_id ORDER BY stocks.stock_id desc ";
 $category ="";
 if (!empty($_GET["from_date"])) 
    {
         $from_date = $_GET['from_date'];
         $to_date = $_GET['to_date'];
     
        

          $stock_sql="SELECT stocks.stock_id,stocks.invoice_no,stocks.stock_date,stocks.lr_no,articles.article_no,articles.article_price,stocks.cargo,stocks.article_qty,articles.article_id,articles.sales_price,articles.article_name from stocks 
LEFT JOIN articles ON articles.article_id=stocks.article_id WHERE stock_date BETWEEN '$from_date' AND '$to_date'";
    } 
if (!empty($_GET["value"])) 
    {
         $value = $_GET['value'];
     
         $name=$_GET['name'];
      
       $category ="OF"." "." ".$value;
       // $category ="OF"." ".strtoupper($_GET['name'])." ".$value;;

          $stock_sql="SELECT stocks.stock_id,stocks.invoice_no,stocks.stock_date,stocks.lr_no,articles.article_no,articles.article_price,stocks.cargo,stocks.article_qty,articles.article_id,articles.sales_price,articles.article_name from stocks 
LEFT JOIN articles ON articles.article_id=stocks.article_id where stocks.$name ='$value'";
    } 

    // mysqli_error($conn);
  // $query = mysqli_query($conn, $stock_sql) or die("Error: " . mysqli_error($conn));
?>
<!DOCTYPE html>
<html>

  <title>stock<?php echo date("d-m-Y", strtotime($date))."-".$time;?></title>

</head>
<body>

  <div class="col-lg-3" ><input class="form-control" placeholder="Search" id="myInput" type="text" style="width: 12vw;color: black;margin-bottom: 1vw;">   </div>
     <div class="col-lg-9" >
       <input list="articles" id="article_id"  style="width: 12vw;" onkeyup="refresh_again(this.value,'article_id');" name="article_id" placeholder="SEARCH ARTICLE" >
<datalist id="articles">
   <option style="color: grey" value="" >SELECT ARTICLE</option>
                  <?php

$query = mysqli_query($conn, "SELECT * from articles");
while ($fetch = mysqli_fetch_array($query))
{
?>
                    <option value="<?php echo $fetch['article_id']; ?>"><?php echo $fetch['article_no']; ?> </option>
                        <?php
}
?> 
</datalist> 
<input  type="date" name="from_date" value="<?php echo $from_date;?>" id="from_date">
<input  type="date" name="to_date" value="<?php echo $to_date;?>" id="to_date">
<button class="btn btn-primary" onclick="date_filter();">OK </button>
<button class="btn btn-danger"  onclick="print_page()">PRINT STOCK</button>
</div> 



    <div id="printableArea"  class="col-md-10">
      <h3 style="text-align: center;"><b>STOCK LIST <?php echo $category?> </b></h3>

      <table border="1" class="table table-condensed table-hover"  id="kit_table" >
          <tr class="info">
 <th > NO:</th>
<th >INVOICE NO:</th>
<th style="text-align: center;">TRANSPORT </th>

<th style="text-align: center;">LR NO</th>
<th >DATE:</th>
<th style="text-align: center;">ARTICLE NO</th>
<th style="text-align: center;">ARTICLE</th>
<th style="text-align: center;">QTY</th>
<!-- <th style="text-align: center;">COST</th>
<th style="text-align: center;">PRICE</th> -->


</tr>

<tbody id="table">
  <?php
  $query=mysqli_query($conn,$stock_sql);
  
    $stock_total=0;
    $stock_cost=0;
$stock_mrp=0;
    $count=0;
    if (!$query) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
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
       $stock_date = date("d-m-Y", strtotime($stock_date));
$stock_total=$stock_total+$article_qty;
$stock_cost=$stock_cost+($article_price*$article_qty);
$stock_mrp=$stock_mrp+($sales_price*$article_qty);
$count++;
   ?>
   <tr class="table_row">
  <td  style="cursor: pointer;" > <?php echo $stock_id;?> </td>
     <td style="cursor: pointer;"> <?php echo $invoice_no;?> </td>
          <td>  <?php echo $cargo;?> </td>

      <td style="cursor: pointer;" onclick="delete_stock('<?php echo $stock_id?>','<?php echo $article_id;?>','<?php echo $article_qty;?>')">  <?php echo $lr_no;?> </td>
     <td style="cursor: pointer; width: 10vw;" > <?php echo $stock_date;?> </td>
     <td style="cursor: pointer; font-weight: bold;" onclick="refresh_again('<?php echo $article_id;?>','article_id')"> <?php echo $article_no;?> </td>
     <td > <a> <?php echo $article_name; ?> </a></td>
         <td style="cursor: pointer;font-weight: bold;"> <?php echo $article_qty;?> </td>
     <!--      <td style="cursor: pointer;"> <?php echo $article_price;?> </td>
          <td style="cursor: pointer;"> <?php echo $sales_price;?> </td> -->

 
     
    <!-- <td><button class="btn-md btn-success" onclick="delete_stock('<?php echo $stock_id?>','<?php echo $article_id;?>','<?php echo $article_qty;?>')">DLT</button></td> -->
   </tr>
    <?php

}
?>
<tr class="table_summary">    
<th colspan="2">TOTAL </th>
            <th colspan="3"> ORDERS : <?php echo $count;?> Orders</th>
           <th colspan=""><?php echo $stock_total." "."Qty";?> </th>
      <th colspan="">cost : <?php echo $stock_cost;?> </th>
      <th colspan=""> sell :<?php echo $stock_mrp;?> </th>

      
     </tr>
</tbody>
</table>
</div>
<div   class="col-md-2" >
      <h3 style="text-align: center;"><b> Total Stock</b></h3>
    <table border="1" class="table table-condensed table-hover" >
       
                   <tr class="success">
                  
                     
                      <th>No</th>
                      <th>Article</th>
                     
                      <th> Qty</th>
                   <!--    <th>SALES</th>
                   -->
                    
                    </tr>

<tbody id="table">
<?php
      $sql_total="SELECT stocks.article_id,articles.article_no,SUM(stocks.article_qty) as stock FROM `stocks`  left join articles on articles.article_id=stocks.article_id  GROUP  BY stocks.article_id ";
      $query=mysqli_query($conn,$sql_total);
      $total_stock=0;
      while($fetch=mysqli_fetch_array($query))
      {
      
       $article_id=$fetch["article_id"];
       $article_no=$fetch["article_no"];
    
       $stock=$fetch["stock"];
        $total_stock+= $stock;
             // $stock_date = date("d-m-Y", strtotime($stock_date));
  

   
  
   
?>
   <tr class="table_row">

     <td style="cursor: pointer;"> <?php echo $article_id;?> </td>
     <td style="cursor: pointer;"> <?php echo $article_no;?> </td>
     <td style="cursor: pointer;"> <?php echo $stock;?> </td>
     <!-- <td style="cursor: pointer;"> <?php echo $sales;?> </td> -->
  
    
 
   </tr>
    <?php

}
?>
<tr><td colspan="3">  TOTAL : <?php echo $total_stock;?>
</td>
</tr>
</tbody>
</table>
</div>

<script type="text/javascript">
function print_page()
  {
    
    window.print()
  }
</script>
<script type="text/javascript">

  function refresh_again(value,name)
  {

window.location="view_stock.php?value=" + value + "&name=" + name;
// href.location="../view/view_stock.php";
// href.location=view_stock.php?value=value&name=name;


  }

</script>
<script type="text/javascript">
  function delete_stock(stock_id,article_id,article_qty)
   {
swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this data!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Poof!  branch deleted!", {

      icon: "success",
    });
     $.ajax({
      type:"POST",
      url:"../delete/delete_stock.php",
      data:{
        stock_id:stock_id,
        article_id:article_id,
        article_qty:article_qty
      },
      success:function(data)
      {


        location.href = "../view/view_stock.php";
        
      }

    });
  } 
  else {
    swal("Your detail is safe!");
  }
});

   
  }
</script>
<script type="text/javascript">
  function date_filter()
  {
    var from_date=document.getElementById("from_date").value;
    var to_date=document.getElementById("to_date").value;
    // alert(from_date+to_date);
window.location="view_stock.php?from_date=" + from_date + "&to_date=" + to_date;
}
</script>
</body>
</html>