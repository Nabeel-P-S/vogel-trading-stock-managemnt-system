<?php
include '../connect.php';
include("../main/navbar.php");
$from_date='2020-06-10';
$to_date=$date;
$sales_sql = "SELECT sales.profit,sales.total,sales.paid,sales.invoice_no,sales.sales,sales.sales_id,sales.customer_id,sales.sales_date,customers.customer_name,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from sales 
LEFT join customers on customers.customer_id=sales.customer_id 

LEFT join staffs on staffs.staff_id=sales.staff_id 
LEFT join branches on branches.branch_id=staffs.branch_id where sales.category=1 order by sales_id desc";

 $category=" ";
 if (!empty($_GET["value"])) 
    {
          $value = $_GET['value'];
     
          $name=$_GET['name'];
 
       $category ="OF"." "." ".$value;
       // $cat
       // egory ="OF"." ".strtoupper($_GET['name'])." ".$value;;

$sales_sql = "SELECT sales.profit,sales.total,sales.paid,sales.invoice_no,sales.sales,sales.sales_id,sales.customer_id,sales.sales_date,customers.customer_name,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from sales 
        LEFT join customers on customers.customer_id=sales.customer_id 

        LEFT join staffs on staffs.staff_id=sales.staff_id 
        LEFT join branches on branches.branch_id=staffs.branch_id  where sales.$name ='$value' AND sales.category=1 order by sales_id desc";
    } 
  if (!empty($_GET["from_date"])) 
    {
         $from_date = $_GET['from_date'];
         $to_date = $_GET['to_date'];
     
        

          $sales_sql="SELECT sales.profit,sales.paid,sales.invoice_no,sales.sales,sales.sales_id,sales.customer_id,sales.sales_date,customers.customer_name,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from sales 
    LEFT join customers on customers.customer_id=sales.customer_id 
     
    LEFT join staffs on staffs.staff_id=sales.staff_id 
    LEFT join branches on branches.branch_id=staffs.branch_id WHERE sales_date BETWEEN '$from_date' AND '$to_date' AND sales.category=1";
    } 
  
?>

<!DOCTYPE html>
<html>
<head>
  <title>sales<?php echo date("d-m-Y", strtotime($date))."-".$time;?></title>
</head>
<style type="text/css">
.table-hover tbody tr:hover td {
    /*background:#6f8787;*/
    /*color: #017874;*/
    color: black;
    font-weight: bold;
}
</style>
<body>


     <div class="col-lg-2" ><input  placeholder="Search" id="myInput" type="text" style="width: 12vw;color: black;margin-bottom: 1vw;">   </div>
     <div class="col-lg-10" >
 
      <!-- <a class="btn btn-danger"  href="../print/sales_print.php">PRINT</a> -->



<table>
  <tr>
       <td style="display: none;">
        <input list="articles" id="article_id"  style="width: 12vw;" onkeyup="refresh_again1(this.value,'staff_id');" name="article_id" placeholder="SEARCH ARTICLE" >
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
    </td>
    <td>
        <input list="staffs" id="staff_id"  style="width: 12vw;" onkeyup="refresh_again1(this.value,'staff_id');" name="staff_id" placeholder="SEARCH STAFF" >
<datalist id="staffs">
   <option style="color: grey" value="" >SELECT STAFF</option>
                  <?php

$query = mysqli_query($conn, "SELECT * from staffs");
while ($fetch = mysqli_fetch_array($query))
{
?>
                    <option value="<?php echo $fetch['staff_id']; ?>"><?php echo $fetch['staff_name']; ?> </option>
                        <?php
}
?> 
</datalist> 
    </td>
    <td>
          <input list="branches" id="branch_id" onkeyup="refresh_again1(this.value,'branch_id');" name="branch_id" placeholder="SEARCH BRANCH" >


<datalist id="branches">
   <option style="color: grey" value="" >select Branch</option>
                  <?php
$query = mysqli_query($conn, "SELECT * from branches");
while ($fetch = mysqli_fetch_array($query))
{
?>
                    <option value="<?php echo $fetch['branch_id']; ?>"><?php echo $fetch['branch_name']; ?> </option>
                        <?php
}
?> 
</datalist>
    </td>
    <td>
     
 
<input  type="date" name="from_date" value="<?php echo $from_date;?>" id="from_date">
<input  type="date" name="to_date" value="<?php echo $to_date;?>" id="to_date">
<button class="btn btn-md" onclick="date_filter();">OK </button>
<button class="btn btn-danger"  onclick="print_page()">PRINT SALES</button>
<a class="btn btn-primary" href="../view/full_sales.php"> Full SALES</a>

    </td>
  </tr>
</table>
   

</div> 



    <div id="printableArea"  class="col-md-12" style="overflow: auto; ">
      <h3 style="text-align: center;"><b>DIRECT SALES </b></h3>
      <table border="1" class="table table-hover "  id="kit_table" style="font-size: 1vw;width: 100%;">
        <!-- <thead class="thead-dark" style="background-color: green;"> -->


         <tr class="active info">
<!-- <th >NO</th> -->

<th style="text-align: center;" >NO</th>
<th style="text-align: center;" >Date</th>
<!-- <th style="text-align: center;">CUSTOMER  </th> -->
<th style="text-align: center;">BRANCH  </th>
<th style="text-align: center;">STAFF </th>
<th style="text-align: center;">ARTICLES </th>
<th style="text-align: center;">SALES</th>
<th style="text-align: center;">PROFIT</th>
<th style="text-align: center;">PAID</th>
<th style="text-align: center;">BALANCE</th>
<th></th>



<!-- <th style="text-align: center;"> </th>
 -->
</tr>


<tbody id="table">
  <?php
  $query = mysqli_query($conn, $sales_sql);

  $qty_sum = 0;
  $sales_sum = 0;
  $total_sum = 0;
  $margin_sum = 0;
  $paid_sum = 0;
  $balance_sum = 0;
  $margin_sum = 0;


  $order_count = 0;
  if (!$query) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
  }
  while ($fetch = mysqli_fetch_array($query))
  {

    $sales_id = $fetch["sales_id"];
    $invoice_no = $fetch["invoice_no"];
    $paid = $fetch["paid"];

    $sales_date = $fetch["sales_date"];
    $total = $fetch["total"];

    $sales_date = date("d/m/Y", strtotime($sales_date));

    $customer_name = $fetch["customer_name"];
    $customer_id = $fetch["customer_id"];
    $branch_name = $fetch["branch_name"];
    $staff_name = $fetch["staff_name"];
    $branch_id = $fetch["branch_id"];
    $staff_id = $fetch["staff_id"];
    $sales = $fetch["sales"];
    $profit = $fetch["profit"];

    $sales_sum+=$sales;
    $total_sum+=$total;

    $paid_sum+=$paid;
    $margin_sum+=$profit;
    $balance=$total-$paid;
    $balance_sum+=$balance;

    $order_count++;

    ?>
   <tr class="table_row" style="cursor: pointer;">
     <!-- <td onclick= "open_size_list('<?php echo $sales_id;?>');"> <?php echo $sales_id; ?> </td> -->
         <td ><a href="../forms/add_grv.php?sales_id=<?php echo $sales_id;?>"> <?php echo $invoice_no; ?> </a></td>

     <td onclick="delete_sale('<?php echo $sales_id;?>')"> <?php echo $sales_date; ?> </td>
    <!-- <td onclick="refresh_again1('<?php echo $customer_id;?>','customer_id')"> <?php echo $customer_name; ?> </td> -->
     <td onclick="refresh_again1('<?php echo $branch_id;?>','branch_id')">  <?php echo $branch_name;?> </td>
     <td ><a >  <?php echo $staff_name; ?></a></td>
     <td onclick= "open_size_list('<?php echo $sales_id;?>');"><a >
       
       <table  ><tr>
        
          <?php
              $query2=mysqli_query($conn,"SELECT sales_articles.sales_id, sales_articles.article_id,sales_articles.article_qty,articles.article_no,articles.article_price,articles.sales_price, sales_articles.id,articles.article_name FROM `sales_articles` left join `articles` on articles.article_id=sales_articles.article_id  WHERE sales_articles.sales_id='$sales_id'");
                 $sleno=1;
             $cost_total=0;
             $mrp_total=0;

                while ($fetch2=mysqli_fetch_array($query2))
                 
                 {
                 $id=$fetch2['id'];
            
         
                $article_name=$fetch2['article_name'];
                 $article_no=$fetch2['article_no'];
                 $sales_price=$fetch2['sales_price'];
                 $article_qty=$fetch2['article_qty'];
                 $article_qty=$fetch2['article_qty'];
                 $article_price=$fetch2['article_price'];

                 $mrp=$sales_price*$article_qty;
                 $cost=$article_price*$article_qty;

   
         $mrp_total+=$mrp;
         $cost_total+=$cost;
          ?>

           <td> <?php echo $article_no; ?></td>
          <td>    -  </td>
<td> <?php echo  $article_qty.","." "?></td>


     
      <?php
$sleno++;
  }
$margin=$mrp_total-$cost_total;
  
    ?></tr>
 
  </table>
     </a></td>
     <td> <a 
  > <?php echo $sales; ?> </a></td>
     <td> <a href="../print/delivery_order.php?sales_id=<?php echo $sales_id;?>"> <?php echo $profit; ?> </a></td>
     <td > <a ><?php echo $paid; ?></a></td>
     <td> <?php echo $balance; ?></td>
 <td>
      <a class=" btn-success" href="../print/invoice_bill.php?sales_id=<?php echo $sales_id;?>">Print </a>
      <a class=" btn-info" href="../forms/add_grv.php?sales_id=<?php echo $sales_id;?>">GRV </a>
      <a ><button class=" btn-danger" onclick="delete_invoice('<?php echo $sales_id;?>')">Delete</button> </a>
    </td>
   </tr>
 
    <tr >
    <td colspan="10" style="padding: 0;">
     <div style="display: none;" id="size_td<?php echo $sales_id; ?>">

      <table class="table" >
       
         <tr class="info">
           <td >SL NO:</td>
           <td style="text-align: center;">  NO </td>
           <td style="text-align: center;">  NAME </td>
           <td style="text-align: center;">  PRICE </td>
           <td style="text-align: center;"> SGST % </td>
           <td style="text-align: center;"> SGST  </td>
           <td style="text-align: center;"> CGST % </td>
           <td style="text-align: center;"> CGST  </td>
           <td style="text-align: center;"> IGST % </td>
           <td style="text-align: center;"> IGST  </td>


           <td style="text-align: center;">  QTY</td>
           <td style="text-align: center;">COST</td>
           <td style="text-align: center;">TAX</td>
           <td style="text-align: center;">MRP</td>


         </tr>
    
       <?php
       $query2=mysqli_query($conn,"SELECT sales_articles.sales_id, sales_articles.article_id,sales_articles.article_qty,articles.article_no,articles.sales_price,articles.sgst,articles.cgst,articles.igst, sales_articles.id,articles.article_name FROM `sales_articles` left join `articles` on articles.article_id=sales_articles.article_id  WHERE sales_articles.sales_id='$sales_id'");
       $sleno=1;
       $count=0;
       $total_sales_price=0;
       $qty_total=0;
       $order_cost=0;
       $order_tax=0;
       $order_mrp=0;
       while ($fetch2=mysqli_fetch_array($query2))
       {
         $id=$fetch2['id'];

         
         $article_name=$fetch2['article_name'];
         $article_id=$fetch2['article_id'];
         $article_no=$fetch2['article_no'];
         $sales_price=$fetch2['sales_price'];
     
         $sales_price=$fetch2['sales_price'];
         $total_sales_price+=$sales_price;
         $article_qty=$fetch2['article_qty'];
         $qty_total+=$article_qty;
             $sgst=$fetch2['sgst'];
         $cgst=$fetch2['cgst'];
         $igst=$fetch2['igst'];
         if($igst==""){
        $igst=0;
         }
         if($cgst==""){
        $cgst=0;
         }
         if($igst==""){
        $igst=0;
         }
         $sgst_amount=($sgst/100)*$sales_price;
         $cgst_amount=($cgst/100)*$sales_price;
         $igst_amount=($igst/100)*$sales_price;
         $tax_amount= $sgst_amount+ $cgst_amount+ $igst_amount;
         $total_tax_amount=$tax_amount*$article_qty;
         $order_tax+=$total_tax_amount;
         $cost=$sales_price*$article_qty;
       $order_cost+= $cost;
         $article_mrp=$cost+$total_tax_amount;
         $order_mrp+=$article_mrp;
$count++;
         ?>


         <tr class="table_row">

          <td> <?php echo $sleno; ?></td>
          <td> <?php echo $article_no." "."(".$article_id.")"; ?></td>
          <td> <?php echo $article_name; ?></td>
          <td> <?php echo $sales_price; ?></td>
          <td> <?php echo $sgst."%"; ?></td>
          <td> <?php echo $sgst_amount; ?></td>
          <td> <?php echo $cgst."%";?></td>
           <td> <?php echo $cgst_amount; ?></td>
          <td> <?php echo $igst."%"; ?></td>
           <td> <?php echo $igst_amount; ?></td>
          <td> <?php echo $article_qty; ?></td>
          <td> <?php echo $cost; ?></td>
          <td> <?php echo $total_tax_amount; ?></td>
          <td> <?php echo $article_mrp; ?></td>
          

        </tr>



        <?php
        $sleno++;
      }
      ?>
<tr style="color: red;">
  <td colspan="2">No of Items :</td>
  <td colspan="1"><?php echo $count;?></td>
  <td colspan="7"><?php echo $total_sales_price;?></td>
  <td><?php echo $qty_total;?></td>
  <td style="font-weight:  bold;"><?php echo $order_cost;?></td>
  <td><?php echo $order_tax;?></td>
  <td style="font-weight:bold;"><?php echo $order_mrp;?></td>
</tr>
<?php 

$order_mrp=vround($order_mrp);

mysqli_query($conn,"UPDATE `sales` SET `total`='$order_mrp'  WHERE sales_id='$sales_id'");
?>
    </table>
  </div>
</td>
</tr>
    <?php
}
?>
  <tr class="table_summary" >    

      <th colspan="2">ORDERS : <?php echo $count; ?> </th>
      <th colspan="2">SALES : <?php echo $sales_sum; ?> Rs</th>
      <th colspan="2">MARGIN : <?php echo $margin_sum; ?> Rs</th>
      <th colspan="2">PAID : <?php echo $paid_sum; ?> Rs</th>
      <th colspan="2">BALANCE : <?php echo $balance_sum; ?> Rs</th>
     
      <!-- <th colspan="2">Margin : <?php echo $margin_sum; ?> Rs</th> -->
     
      
     </tr>
</tbody>
</table>
</div>

</div>
<script type="text/javascript">
  function open_size_list(sales_id)
  {

if (document.getElementById("size_td"+sales_id).style.display=="block")
{
  document.getElementById("size_td"+sales_id).style.display="none";
  }
  else
  {
   document.getElementById("size_td"+sales_id).style.display="block"; 
  }
}
</script>
<script type="text/javascript">

  function refresh_again1(value,name)
  {
// alert(value+name);
window.location="view_sales.php?value=" + value + "&name=" + name;

  }

</script>
<script type="text/javascript">

  function item_sales(value)
  {
// alert(value+name);
window.location="item_sales.php?value=" + value;

  }

</script>



<script type="text/javascript">
  function delete_invoice(sales_id)
   {
swal({
  title: "Are you sure?  DELETE SALES BILL..!?",
  text: "Once deleted, you will not be able to recover this sales!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Poof!  sales deleted!", {

      icon: "success",
    });
     $.ajax({
      type:"POST",
      url:"../delete/delete_sale.php",
      data:{
        sales_id:sales_id
      
      },
      success:function(data)
      {


        location.href = "../view/view_sales.php";
        
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
window.location="view_sales.php?from_date=" + from_date + "&to_date=" + to_date;
}
</script>
</body>

</html>