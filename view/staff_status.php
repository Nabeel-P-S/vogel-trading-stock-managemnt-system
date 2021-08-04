<?php
include '../connect.php';
include("../main/navbar.php");
$from_date='2020-06-10';
$to_date=  $date;




if (!empty($_GET["value"])) 
    {
          $value = $_GET['value'];
     
        $staff_id=$value;
 } 

 $staff_sql="SELECT sales.profit,sales.total,sales.paid,sales.invoice_no,sales.sales,sales.sales_id,sales.customer_id,sales.sales_date,customers.customer_name,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from sales 
    LEFT join customers on customers.customer_id=sales.customer_id 
    LEFT join staffs on staffs.staff_id=sales.staff_id 
        LEFT join branches on branches.branch_id=staffs.branch_id 
WHERE sales.staff_id='$value' and sales_date BETWEEN '$from_date' AND '$to_date'";
    
if (!empty($_GET["from_date"])) 
    {
         $from_date = $_GET['from_date'];
         $to_date = $_GET['to_date'];
     $value = $_GET['value'];
        // echo  $from_date;
          $staff_sql="SELECT sales.profit,sales.total,sales.paid,sales.invoice_no,sales.sales,sales.sales_id,sales.customer_id,sales.sales_date,customers.customer_name,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from sales 
    LEFT join customers on customers.customer_id=sales.customer_id 
    LEFT join staffs on staffs.staff_id=sales.staff_id 
        LEFT join branches on branches.branch_id=staffs.branch_id 
 WHERE sales.staff_id='$value' and sales_date BETWEEN '$from_date' AND '$to_date'";
    } 
  
  $sql="SELECT * FROM `staffs` WHERE staff_id='$value'";
  $query=mysqli_query($conn,$sql);
  $fetch=mysqli_fetch_array($query);

   $staff_name=$fetch['staff_name'];


?>
<!DOCTYPE html>
<html>
<head>
  <title> SALE LIST</title>
</head>
<body>


   
     <!-- ---------------------- TABLE HEAD------------------------------ -->
    <div class="col-md-12">
   
    <div class="col-lg-2" ><input class="form-control" placeholder="Search" id="myInput" type="text" style="width: 10vw; color: black;">   </div>
   
    <div class="col-lg-8" style="*text-align: right;">
      <table><tr>
        <td>
          <input type="hidden" id="staff_value" value="<?php echo $value;?>" >
<input  type="date" onkeyup="date_filter()"style="width: 10vw;" name="from_date" value="<?php echo $from_date;?>" id="from_date"></td><td>
<input  type="date" onkeyup="date_filter()" style="width: 10vw;" name="to_date" value="<?php echo $to_date;?>" id="to_date"></td><td>
<button class="btn  btn-primary" onclick="date_filter();">OK </button></td>
<td> <input  class="form-control" list="staffs" id="staff_id"  style="*margin-left: 2vw;" onchange="item_sales(this.value);" name="staff_id" placeholder="SEARCH STAFF" >
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
</datalist></td><td>      
  <!-- <h3 style="margin-left: 10vw;*font-family: serif;font-weight: bold;color: #333;">STAFF ANALYSIS - <?php echo $staff_name;?></h3> -->
</td>
<td><button class="btn btn-primary" style="margin-left: 5vw;width: 10vw;"  onclick="print_page()">PRINT </button>
    </td></tr></table>
        </div>
 <!-- <div class="col-lg-2" style="*text-align: right;">
      <button class="btn btn-danger"  onclick="print_page()">PRINT </button>
    
    </div>  -->
  </div>
   
    <!-- ---------------------- TABLE HEAD------------------------------ -->
 <div class="col-md-12" style="font-size: .85vw;" >
  <!-- <h3 style="text-align: center;"><b> <?php echo $article_no," ","-"," ",$article_name," ","(",$article_price,"/",$sales_price,")"," ",$total_stock," ","stock" ;?> </b></h3> -->

<!-- ------------------------------------------ STAFF ESTIMATION BILLS-------------------------------------------- -->





<!-- --------------------------------- EXECUTIVE TRANSACTION LIST ----------------------------------------------------------- -->
<div class="col-md-12" id="printableArea" align="center">
  <table width="100%;">
    <tr>
      <td><h4 >NAME : <?php echo $staff_name ?></h4></td>
      <td style="text-align:center;"><h4> <b> EXECUTIVE TRANSACTION LIST </b></h4></td>
      <td style="float: right;"><h4> DATE:<?php echo  date("d-m-Y", strtotime($from_date)) ?> TO <?php echo date("d-m-Y", strtotime($to_date)) ?></h4></td></tr>
  </table>


  <table class="table" border="0">
    <tr>
      <td>
        <div >
         <b> STAFF ESTIMATION BILLS</b>
         <?php 
         $sales_sql1="SELECT estimation.profit,estimation.invoice_no,estimation.sales,estimation.sales_id,estimation.sales_date,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from estimation 
         LEFT JOIN staffs 
         ON staffs.staff_id = estimation.staff_id 
         LEFT join branches on branches.branch_id=staffs.branch_id WHERE estimation.staff_id='$value' AND  sales_date BETWEEN '$from_date' AND '$to_date'";
         ?>
         <table border="1" class="table-condensed" style="width: 100%;">
          <thead >
            <tr class="table_head" >
              <!-- <td >NO</td> -->
              <td style="text-align: center;" >Bill</td>
              <td style="text-align: center;" >Date</td>
              <td style="text-align: center;">Items</td>
              <td style="text-align: center;">Total</td>
              <!-- <td style="text-align: center;">Margin</td> -->
            </tr>
          </thead>
          <tbody id="table">
            <?php
            $query = mysqli_query($conn, $sales_sql1);
            $qty_sum = 0;
            $sales_sum = 0;
            $margin_sum = 0;
            $count = 0;
            if (!$query) {
              printf("Error: %s\n", mysqli_error($conn));
              exit();
            }
            while ($fetch = mysqli_fetch_array($query))
            {
              $sales_id = $fetch["sales_id"];
              $invoice_no = $fetch["invoice_no"];
              $sales_date = $fetch["sales_date"];
              $sales_date = date("d/m/Y", strtotime($sales_date));
              
              
              $branch_name = $fetch["branch_name"];
              $staff_name = $fetch["staff_name"];
              $branch_id = $fetch["branch_id"];
              $staff_id = $fetch["staff_id"];
              $sales = $fetch["sales"];
              $profit = $fetch["profit"];
              $sales_sum+=$sales;
              $margin_sum+=$profit;
              $count++;
              ?>
              <tr class="table_row" style="cursor: pointer;">
               
               <td ><a href="../forms/add_grv.php?sales_id=<?php echo $sales_id;?>"> <?php echo $sales_id; ?> </a></td>
               <td onclick="delete_sale('<?php echo $sales_id;?>')"> <?php echo $sales_date; ?> </td>
               
               <td onclick= "open_size_list('<?php echo $sales_id;?>');"><a >
                 
                 <table  ><tr>
                  
                  <?php
                  $query2=mysqli_query($conn,"SELECT estimation_articles.sales_id, estimation_articles.article_id,estimation_articles.article_qty,articles.article_no,articles.article_price,articles.sales_price, estimation_articles.id,articles.article_name FROM `estimation_articles` left join `articles` on articles.article_id=estimation_articles.article_id  WHERE estimation_articles.sales_id='$sales_id'");
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
               href="../print/sales_bill.php?sales_id=<?php echo $sales_id;?>"> <?php echo $sales; ?> </a></td>
               <!-- <td> <a href="../print/delivery_order.php?sales_id=<?php echo $sales_id;?>"> <?php echo $profit; ?> </a></td> -->
               
             </tr>
             
             
             <?php
           }
           ?>
           <tr >    
            <td colspan="2">ORDERS : <?php echo $count; ?> </td>
            <td colspan="3">Estimation : <?php echo $sales_sum; ?> Rs</td>
            
            
            
            
          </tr>
        </tbody>
      </table>
    </div>
  </td>
  <td>
    
    <!-- ----------------------------------------------------- STAFF INVOICE BILLS ------------------------------------------------------ -->
    <div >
      <b> STAFF INVOICE BILLS </b>

 <table border="1" class="table-condensed" style="width: 100%;">
  <thead >
    <tr class="table_head" >
      <td>INVOICE NO </td>
      <td>DATE</td>
      <!-- <td>ARTICLES</td> -->
      <td>SALES</td>
      <td>PAID</td>
      <td>BALANCE</td>
    </tr>
  </thead>
  <tbody id="table">
    <?php
    $query=mysqli_query($conn,$staff_sql);

    $qty_sum = 0;
    $sales_sum = 0;
    $margin_sum = 0;
    $balance_sum=0;
    $paid_sum=0;
    $count = 0;
    if (!$query) {
      printf("Error: %s\n", mysqli_error($conn));
      exit();
    }
    while ($fetch = mysqli_fetch_array($query))
    {
      $sales_id = $fetch["sales_id"];
      $invoice_no = $fetch["invoice_no"];
      $total = $fetch["total"];
      $paid = $fetch["paid"];
      $sales_date = $fetch["sales_date"];
      $sales_date = date("d/m/Y", strtotime($sales_date));
      
      $customer_name = $fetch["customer_name"];
      $customer_id = $fetch["customer_id"];
      $branch_name = $fetch["branch_name"];
      $staff_name = $fetch["staff_name"];
      $branch_id = $fetch["branch_id"];
      $staff_id = $fetch["staff_id"];
      $sales = $fetch["sales"];
      $profit = $fetch["profit"];
      $sales_sum+=$total;
      $margin_sum+=$profit;
      $balance=$total-$paid;
      $balance_sum+=$balance;
      $paid_sum+=$paid;
      $count++;
      ?>
      <tr class="table_row">
       <td style="cursor: pointer;"> <?php echo $invoice_no;?> </td>
       <td style="cursor: pointer;"> <?php echo $sales_date;?> </td>

<td style="cursor: pointer;"> <?php echo $total;?> </td>
<td style="cursor: pointer;"> <?php echo $paid;?> </td>
<td style="cursor: pointer;"> <?php echo round($balance,2);?> </td>

</tr>
<?php
}
?>
<tr  >    
  
 
  <td colspan="1">INVOICES : <?php echo $count; ?></td>
  <td colspan="2">SALES : <?php echo $sales_sum; ?> Rs</td>
  <td colspan="1">PAID : <?php echo $paid_sum; ?> </td>
  <td colspan="1">BALANCE : <?php echo round($balance_sum); ?> Rs</td>
 
  <!-- <td colspan="2">Margin : <?php echo $margin_sum; ?> Rs</td> -->
  
  
</tr>
</tbody>
</table>
</div>
</td>
<td>
  <!-- ----------------------------------------------------------- STAFF VOUCHER BILLS ----------------------------------------- -->
  <div >
    <b>STAFF VOUCHER BILLS</b>
    <table class="table-condensed" border="1" style="width: 100%;">
      <thead >
        <tr>
          <td>VOUCHER NO</td>
          <td>VOUCHER DATE</td>
          <!-- <td>VOUCHER DETAILS </td> -->
          <td>VOUCHER AMOUNT</td>
        </tr>
      </thead>
      <?php 
      $voucher_sql="SELECT voucher.voucher_id,voucher.voucher_date,voucher.voucher_time,voucher.voucher_amount,staffs.staff_name from voucher left JOIN staffs on staffs.staff_id=voucher.staff_id  WHERE voucher.staff_id='$value' AND  voucher_date BETWEEN '$from_date' AND '$to_date'";
      $orderCount=0;
      $query=mysqli_query($conn,$voucher_sql);

        $total=0;
      if (!$query) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();}
        while($fetch=mysqli_fetch_array($query))

        {
         
          $voucher_id = $fetch["voucher_id"];
          $voucher_date = $fetch["voucher_date"];
          $voucher_time = $fetch["voucher_time"];
          $voucher_amount = $fetch["voucher_amount"];
                $total=$voucher_amount+$total;
                 $orderCount++;

          $voucher_date = date("d/m/Y", strtotime($voucher_date));
          ?>
          <tr>
            <td><?php echo $voucher_id;?></td>
            <td><?php echo $voucher_date;?></td>

            <td><?php echo round($voucher_amount,2);?></td>
          </tr>
          <?php 
        }?>
        <tr>
          <td colspan="2">VOUCHERS : <?php echo $orderCount;?></td>
          <td colspan="2">AMOUNT SUM :
            <?php echo $total;?>
            
          </td>
        </tr>
      </table>
    </div>


  </td>
</tr>
<tr>
  <td></td>
  <td></td>
  <td colspan="0">
<?php

 $sql11="SELECT SUM(sales_articles.article_qty) as total_sold FROM `sales_articles` LEFT JOIN sales on sales.sales_id=sales_articles.sales_id WHERE sales.staff_id='$value'and sales_date BETWEEN '$from_date' AND '$to_date'";
 $sql2="SELECT SUM(total) as total_sales FROM `sales` WHERE staff_id='$value' and sales_date BETWEEN '$from_date' AND '$to_date'";
 $sql3="SELECT SUM(profit) as total_profit FROM `sales` WHERE staff_id='$value' and sales_date BETWEEN '$from_date' AND '$to_date'";
 $sql4="SELECT count(sales) as total_orders FROM `sales` WHERE staff_id='$value' and sales_date BETWEEN '$from_date' AND '$to_date'";
  $sql5="SELECT SUM(sales) as total_estimation FROM `estimation` WHERE staff_id='$value' and sales_date BETWEEN '$from_date' AND '$to_date'";
  $sql6="SELECT SUM(voucher_amount) as total_voucher FROM `voucher` WHERE staff_id='$value' and voucher_date BETWEEN '$from_date' AND '$to_date'";
  $sql7="SELECT SUM(amount) as total_ta FROM `trs` WHERE staff_id='$value' and tr_date BETWEEN '$from_date' AND '$to_date'";

     $query11=mysqli_query($conn,$sql11);
    $query2=mysqli_query($conn,$sql2);
    $query3=mysqli_query($conn,$sql3);
    $query4=mysqli_query($conn,$sql4);
    $query5=mysqli_query($conn,$sql5);
    $query6=mysqli_query($conn,$sql6);
    $query7=mysqli_query($conn,$sql7);
  $fetch11=mysqli_fetch_array($query11);
  $fetch2=mysqli_fetch_array($query2);
  $fetch3=mysqli_fetch_array($query3);
  $fetch4=mysqli_fetch_array($query4);
  $fetch5=mysqli_fetch_array($query5);
  $fetch6=mysqli_fetch_array($query6);
  $fetch7=mysqli_fetch_array($query7);
   $total_sold=$fetch11['total_sold'];
   $total_sales=$fetch2['total_sales'];
   $total_profit=$fetch3['total_profit'];
   $total_orders=$fetch4['total_orders'];
   $total_estimation=$fetch5['total_estimation'];
   $total_voucher=$fetch6['total_voucher'];
   $total_ta=$fetch7['total_ta'];

$workSalary=$total_voucher*(11.2/100);
?>
<table class="table-condensed" border="0" style="font-weight: bold;">
  <tr>
    <tr><td> TOTAL ESTIMATION  </td><td><?php echo $total_estimation;?></td></tr>
     <tr><td> TOTAL INVOICE  </td><td><?php echo $total_sales;?></td></tr>
    <tr><td> TOTAL VOUCHER  </td><td><?php echo round($total_voucher,2);?></td></tr>
    <!-- <tr><td> TOTAL MARGIN  </td><td><?php echo $total_profit;?></td></tr> -->
    <!-- <tr><td> TOTAL SOLD  </td> <td><?php echo $total_sold;?></td></tr> -->
   
    <!-- <tr><td> TOTAL ORDERS  </td><td><?php echo $total_orders;?></td></tr> -->
    <tr><td> TOTAL ALLOWANCE  </td><td><?php echo $total_ta;?></td></tr>
    <tr><td>  SALARY </td><td><?php echo $total_sold;?></td></tr>
    <!-- <tr><td>  WORK SALARY </td><td><?php echo $workSalary;?></td></tr> -->
  </tr>
</table>
  </td>
</tr>
</table>

</div>


</div>


</body>
</html>
<script type="text/javascript">

  function item_sales(value)
  {
// alert(value+name);
window.location="staff_status.php?value=" + value;

  }

</script>
<script type="text/javascript">
  function date_filter()
  {
    var from_date=document.getElementById("from_date").value;
    var to_date=document.getElementById("to_date").value;
    var staff_value=document.getElementById("staff_value").value;
window.location="staff_status.php?from_date=" + from_date + "&to_date=" + to_date + "&value=" + staff_value;
}
</script>