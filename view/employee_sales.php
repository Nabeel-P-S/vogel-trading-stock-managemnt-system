<?php
include '../connect.php';
include("../main/navbar.php");
$from_date='2020-08-01';
$to_date=$date;
$value=2;
if (!empty($_GET["value"])) 
{
  $value = $_GET['value'];

                // $name=$_GET['name'];
} 
$staff_sql="SELECT sales.profit,sales.total,sales.paid,sales.invoice_no,sales.sales,sales.sales_id,sales.customer_id,sales.sales_date,customers.customer_name,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from sales 
LEFT join customers on customers.customer_id=sales.customer_id 
LEFT join staffs on staffs.staff_id=sales.staff_id 
LEFT join branches on branches.branch_id=staffs.branch_id 
WHERE sales.staff_id='$value' and sales.category=0 order by sales_id desc";
if (!empty($_GET["from_date"])) 
{
 $from_date = $_GET['from_date'];
 $to_date = $_GET['to_date'];
 $value = $_GET['value'];


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
$staff_id=$value;
?>
<!DOCTYPE html>
<html>
<head>
  <title> SALE LIST</title>
  <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
  <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> -->
  <!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
</head>
<body>



 <!-- ---------------------- TABLE HEAD------------------------------ -->
 <div class="col-md-12">
   <div class="col-lg-3">         <input  class="form-control" list="staffs" id="staff_id6"  style="width: 12vw; color: black;float: right;" onchange="item_sales(this.value);" name="staff_id" placeholder="SELECT STAFF" >
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
  </datalist></div>

  <div class="col-lg-2" ><input class="form-control" placeholder="Search" id="myInput" type="text" style="width: 10vw; color: black;">   </div>
  <div class="col-lg-2" ><button class="btn btn-success"   onclick="print_page()">PRINT </button>
  </div>

  <div class="col-lg-5" style="*text-align: right;">
    <table class="table"><tr>

      <!-- <h3 style="margin-left: 10vw;*font-family: serif;font-weight: bold;color: #333;">STAFF ANALYSIS - <?php echo $staff_name;?></h3> -->
    </td>
    
    <td>
      <input type="hidden" id="staff_value" value="<?php echo $value;?>" >
      <input  type="date"  class="form-control" onkeyup="date_filter()"style="*width: 10vw;" name="from_date" value="<?php echo $from_date;?>" id="from_date"></td><td>
        <input  type="date" class="form-control" onkeyup="date_filter()" style="*width: 10vw;" name="to_date" value="<?php echo $to_date;?>" id="to_date"></td><td>
          <button class="btn  btn-primary" onclick="date_filter();">FILTER </button></td>
        </tr></table>
      </div>

    </div>

    <!-- ---------------------- TABLE HEAD------------------------------ -->
    <div class="col-md-12" style="font-size: .85vw;"  id="printableArea">

      <!-- ------------------------------------------ STAFF ESTIMATION BILLS-------------------------------------------- -->

      <div class="col-xs-2">
        <!-- required for floating -->
        <!-- Nav tabs -->
        <legend><?php echo $staff_name;?></legend>
        <ul class="nav nav-tabs tabs-left">
          <li class="active"><a href="#details" data-toggle="tab">DETAILS</a></li>
          <li><a href="#settings" data-toggle="tab"> STOCKS</a></li>
          <li ><a href="#home" data-toggle="tab"> ESTIMATION BILLS</a></li>
          <li><a href="#invoice" data-toggle="tab"> INVOICE BILLS</a></li>
          <li><a href="#profile" data-toggle="tab"> GOODS RETURN</a></li>
          <li><a href="#voucher" data-toggle="tab"> VOUCHER BILLS</a></li>
          <li ><a href="#final" data-toggle="tab">OVERVIEW</a></li>
        </ul>
      </div>
      <div class="col-xs-10">
        <!-- Tab panes -->
        <div class="tab-content">
<!-- ==================================================  DETAILS ============================================= -->
         <div class="tab-pane active" id="details">
           <?php
           include("../view/staff_edit.php");
           ?>
         </div>

          <!-- =================================== FINAL OVERVIEW ----------------------- -->
          <div class="tab-pane" id="final" style="overflow-x: auto;">


            <table  border="1" id="staff_table" class="table-condensed table table-hover table-stiped ">
             <!-- <h3 style="text-align: center;"><b>FINAL STAFF STATEMENT  </b></h3> -->
             <?php 
             $sql5="SELECT * FROM `staffs` where staff_id='$staff_id'";
             $query5=mysqli_query($conn,$sql5);
             $fetch5=mysqli_fetch_array($query5);
             $staff_name=$fetch5['staff_name'];
             ?>
             <tr ><td><table><tr><td>Details</td></tr><tr><td><h4><?php echo $staff_name;?></h4></td></tr></table></td>
             <?php 
             $sql="SELECT count(article_id) as total_article FROM `articles`";
             $query=mysqli_query($conn,$sql);
             $fetch=mysqli_fetch_array($query);
             $total_article=$fetch['total_article'];
             $sql="SELECT count(staff_id) as total_staff FROM `staffs`";
             $query=mysqli_query($conn,$sql);
             $fetch=mysqli_fetch_array($query);
             $total_staff=$fetch['total_staff'];

             $wsql="select * from articles";
             $query=mysqli_query($conn,$wsql);
             $i=1;
             $est_total=0;
             $price_sum=0;
             while($fetch=mysqli_fetch_array($query))
             {
              ?> <td> <table> <tr> <td>
                <?php
                $item_price[$i]=$fetch["sales_price"];
                $price_sum+=$fetch["sales_price"];


                $item_sum[$i]=0;

                $est_qty[$i]=0;
                $est_mrp[$i]=0;
                $sls_qty[$i]=0;
                $sls_mrp[$i]=0;

                echo $fetch["article_no"]; ?>

              </td></tr><tr><td>
               <?php echo $fetch["sales_price"];
               ?></td> </tr></table></td>
               <?php 
               $i++;
             }
             ?>
             <td  >
              <table>
                <tr>
                  <td>TOTAL</td>
                </tr>
                <tr><td>   
                 <?php  echo $price_sum;?></td></tr>
               </table>

             </td>
           </tr>
           <tr>
            <td>Total Estimation Quantity</td>
            <?php



            for($j=1;$j<=$total_article;$j++)
            {

             $sql11="SELECT SUM(estimation_articles.article_qty) as est_sum FROM `estimation_articles` LEFT JOIN estimation on estimation.sales_id=estimation_articles.sales_id where estimation_articles.article_id='$j' and estimation.staff_id='$staff_id' AND estimation.sales_date BETWEEN '$from_date' AND '$to_date'";


             $query11=mysqli_query($conn,$sql11);

             $fetch11=mysqli_fetch_array($query11);
             ?>
             <td ><?php
             if (isset($fetch11["est_sum"])) { 

             } else
             {
              $fetch11["est_sum"]=0;
            }

            echo $fetch11["est_sum"];
            $est_total+= $fetch11["est_sum"];
            $est_qty[$j]=$fetch11["est_sum"];
           // $sum1+=  $est_qty[$j];
            ?></td>
            <?php
          }
          ?><td class="info"><?php echo $est_total;?></td>
        </tr>
        <tr>
          <td>Total Estimation Amount (Rupees)</td>
          <?php

          $est_mrp_total=0;

          for($j=1;$j<=$total_article;$j++)
          {





           ?>
           <td >
            <?php
            $est_mrp[$j]=$est_qty[$j]* $item_price[$j];
                     // echo $est_qty[$j]* $item_price[$j];
            echo $est_mrp[$j];
            $est_mrp_total+=$est_mrp[$j];

            ?></td>
            <?php
          }
          ?><td class="info"><?php echo number_format($est_mrp_total,2);?> </td>
        </tr>
        <tr>
          <td>Total Invoice Quantity</td>
          <?php


          $sales_total=0;
          for($j=1;$j<=$total_article;$j++)
          {

           $sql1="SELECT SUM(sales_articles.article_qty) as sls_sum FROM `sales_articles` LEFT JOIN sales on sales.sales_id=sales_articles.sales_id where sales.category=0 and sales_articles.article_id='$j' and sales.staff_id='$staff_id' AND sales.sales_date BETWEEN '$from_date' AND '$to_date'";



           $query1=mysqli_query($conn,$sql1);

           $fetch1=mysqli_fetch_array($query1);
           ?>
           <td ><?php
           if (isset($fetch1["sls_sum"])) { 

           } else
           {
            $fetch1["sls_sum"]=0;
          }

          echo $fetch1["sls_sum"];
          $sales_total+= $fetch1["sls_sum"];
          $sls_qty[$j]=$fetch1["sls_sum"];
          ?></td>
          <?php
        }
        ?><td class="info"><?php echo $sales_total;?></td>
      </tr>
      <tr>
        <td>Total Invoice   Amount (Rupees)</td>
        <?php

        $sls_mrp_total=0;

        for($j=1;$j<=$total_article;$j++)
        {





         ?>
         <td >
          <?php
          $sls_mrp[$j]=$sls_qty[$j]* $item_price[$j];

          echo $sls_mrp[$j];
          $sls_mrp_total+= $sls_mrp[$j];
                     // echo $sls_qty[$j]* $item_price[$j];
          
          ?></td>
          <?php
        }
        ?><td class="info"><?php echo number_format($sls_mrp_total,2);?> </td>
      </tr>
      <tr>
        <td>Estimation Stock Quantity</td>
        <?php
        

        $diff_qty_sum=0;
        for($j=1;$j<=$total_article;$j++)
        {


         ?>
         <td ><?php
         $diff_qty=$est_qty[$j]-$sls_qty[$j];
         echo $diff_qty;
         $diff_qty_sum+=$diff_qty
         ?></td>
         <?php
       }
       ?><td class="info"><?php echo $diff_qty_sum;?></td>
     </tr>
     <tr>
      <td>Estimation Stock Amount(Rupees)</td>
      <?php

      $diff_mrp_sum=0;

      for($j=1;$j<=$total_article;$j++)
      {





       ?>
       <td >
        <?php
        $diff_mrp=$est_mrp[$j]-$sls_mrp[$j];
         // echo $diff_mrp;
        echo number_format($diff_mrp,2);

        $diff_mrp_sum+=$diff_mrp

        ?></td>
        <?php
      }
      ?><td class="info"><?php echo number_format($diff_mrp_sum,2);?> </td>
    </tr>

  </table>
</div>

<div class="tab-pane " id="home">
 <legend> STAFF ESTIMATION BILLS</legend>
 <?php 
 $sales_sql1="SELECT estimation.profit,estimation.invoice_no,estimation.sales,estimation.sales_id,estimation.sales_date,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from estimation 
 LEFT JOIN staffs 
 ON staffs.staff_id = estimation.staff_id 
 LEFT join branches on branches.branch_id=staffs.branch_id WHERE estimation.staff_id='$value'  AND sales_date BETWEEN '$from_date' AND '$to_date' order by sales_id desc";
 ?>

 <table border="1" class="table table-striped table-hover"  >

  <tr >
    <!-- <td >NO</td> -->

    <td style="text-align: center;" >Bill</td>
    <td style="text-align: center;" >Date</td>


    <td style="text-align: center;">Items</td>
    <td style="text-align: center;">Total</td>
    <td style="text-align: center;">Margin</td>

  </tr>


  <tbody id="table">
    <?php
    $query = mysqli_query($conn, $sales_sql1);

    $qty_sum = 0;
    $sales_sum = 0;
    $margin_sum = 0;
    $qty_total=0;
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
           $qty_total+=$article_qty;
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
       <td> <a href="../print/delivery_order.php?sales_id=<?php echo $sales_id;?>"> <?php echo $profit; ?> </a></td>


     </tr>


     <?php
   }
   ?>
   <tr class="info" >    

    <td colspan="2">ORDERS : <?php echo $count; ?> </td>
    <td colspan="1">Estimation : <?php echo $sales_sum; ?> Rs</td>
    <td colspan="2">QTY : <?php echo $qty_total; ?> </td>




  </tr>
</tbody>
</table></div>
<div class="tab-pane" id="profile"><legend>STAFF GRV LIST</legend>


  <table border="1" class="table table-striped table-hover"  >

    <tr >
      <td>NO</td>
      <td>Date</td>
      <td>STAFF</td>
      <td>ARTICLES</td>
      <td>COST</td>

    </tr>
    <?php

    $sales_sql = "SELECT staff_grv.grv_id,estimation.sales_id,staff_grv.grv_date,staff_grv.profit,estimation.invoice_no,staff_grv.sales,estimation.sales_date,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from staff_grv 
    LEFT join estimation on estimation.sales_id=staff_grv.sales_id 
    LEFT join staffs on staffs.staff_id=estimation.staff_id

    LEFT join branches on branches.branch_id=staffs.branch_id where estimation.staff_id='$value' AND grv_date BETWEEN '$from_date' AND '$to_date' order by grv_id desc";
    $query = mysqli_query($conn, $sales_sql);

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
      $invoice_no = $fetch["invoice_no"];
      $sales_date = $fetch["sales_date"];
      $sales_date = date("d-m-Y", strtotime($sales_date));
      $branch_name = $fetch["branch_name"];
      $staff_name = $fetch["staff_name"];
      $branch_id = $fetch["branch_id"];
      $staff_id = $fetch["staff_id"];
      $sales = $fetch["sales"];
      $profit = $fetch["profit"];
      $grv_id = $fetch["grv_id"];
      $grv_date = $fetch["grv_date"];
      $grv_date = date("d-m-Y", strtotime($grv_date));

      $profit = $fetch["profit"];

      $sales_sum+=$sales;
      $margin_sum+=$profit;

      $count++;

      ?>
      <tr class="table_row" style="cursor: pointer;">
       <td> <?php echo $grv_id; ?> </td>

       <td> <?php echo $grv_date; ?> </td>

       <td >  <?php echo $staff_name; ?> </a></td>
       <td ><a >

         <table  >

          <?php
          $query2=mysqli_query($conn,"SELECT staff_grv_articles.grv_id, staff_grv_articles.article_id,staff_grv_articles.article_qty,articles.article_no,articles.sales_price, staff_grv_articles.id,articles.article_name FROM `staff_grv_articles` left join `articles` on articles.article_id=staff_grv_articles.article_id  WHERE staff_grv_articles.grv_id='$grv_id'");
          $sleno=1;
          while ($fetch2=mysqli_fetch_array($query2))
          {
           $id=$fetch2['id'];


           $article_name=$fetch2['article_name'];
           $article_no=$fetch2['article_no'];
           $sales_price=$fetch2['sales_price'];
           $article_qty=$fetch2['article_qty'];
           $cost=$sales_price*$article_qty;


           ?>

           <tr>
            <td> <?php echo $article_no; ?></td>
            <td>   -   </td>
            <!-- <td style="color: #017874;"> <?php echo $article_name; ?></td> -->
            <td> <?php echo  $article_qty." "."Qty"; ?></td>


          </tr>
          <?php
          $sleno++;
        }
        ?>

      </table>
    </a></td>
    <td>  <?php echo $sales; ?> </td>
    


  </tr>

  <?php
}
?>
<tr class="table_summary" >    

  <!-- <td colspan="2">TOTAL </td> -->
  <td colspan="2">GRV BILLS : <?php echo $count; ?> </td>
  <td colspan="2">COST : <?php echo $sales_sum; ?> Rs</td>
  <td colspan="2">MARGIN : <?php echo $margin_sum; ?> Rs</td>

  <!-- <td colspan="2">Margin : <?php echo $margin_sum; ?> Rs</td> -->


</tr>

</table></div>
<div class="tab-pane" id="invoice">
  <legend > STAFF INVOICE BILLS </legend>

  <table border="1" class="table table-striped table-hover"  >

    <tr >

      <td>INVOICE NO </td>

      <td>DATE</td>

      <td>ARTICLES</td>
      <td>SALES</td>
      <td>PAID</td>
      <td>BALANCE</td>



    </tr>

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
        $paid = $fetch["paid"];

        $sales_date = $fetch["sales_date"];
        $sales_date = date("d/m/Y", strtotime($sales_date));

        $customer_name = $fetch["customer_name"];
        $customer_id = $fetch["customer_id"];
        $branch_name = $fetch["branch_name"];
        $staff_name = $fetch["staff_name"];
        $branch_id = $fetch["branch_id"];
        $staff_id = $fetch["staff_id"];
        $sales = $fetch["total"];
        $profit = $fetch["profit"];

        $sales_sum+=$sales;
        $margin_sum+=$profit;
        $balance=$sales-$paid;
        $balance=round($balance,2);
        $balance_sum+=$balance;
        $paid_sum+=$paid;
        $count++;

        ?>
        <tr class="table_row">

         <td style="cursor: pointer;"> <?php echo $invoice_no;?> </td>
         <td style="cursor: pointer;"> <?php echo $sales_date;?> </td>
<!--      <td style="cursor: pointer;"> <?php echo $customer_name;?> </td>
 <td style="cursor: pointer;"> <?php echo $branch_name;?> </td> -->
 <td onclick= "open_size_list('<?php echo $sales_id;?>');"><a >

   <table  ><tr>

    <?php
    $query2=mysqli_query($conn,"SELECT sales_articles.sales_id, sales_articles.article_id,sales_articles.article_qty,articles.article_no,articles.article_price,articles.sales_price, sales_articles.id,articles.article_name FROM `sales_articles` left join `articles` on articles.article_id=sales_articles.article_id  WHERE sales_articles.sales_id='$sales_id';");
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
     $qty_sum+=$article_qty;
                 // $article_qty=$fetch2['article_qty'];
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
<td style="cursor: pointer;"> <?php echo $sales;?> </td>
<td style="cursor: pointer;"> <?php echo $paid;?> </td>
<td style="cursor: pointer;"> <?php echo $balance;?> </td>



</tr>
<?php

}
?>
<tr class="warning" >    



  <td colspan="2">SALES : <?php echo $sales_sum; ?> Rs</td>
  <td colspan="2">PAID : <?php echo $paid_sum; ?> </td>
  <td colspan="">BALANCE : <?php echo $balance_sum; ?> Rs</td>
  <td colspan="">QTY : <?php echo $qty_sum; ?></td>

  <!-- <td colspan="2">Margin : <?php echo $margin_sum; ?> Rs</td> -->


</tr>
</tbody>
</table></div>
<div class="tab-pane" id="settings">
  <legend> STAFF STOCK</legend>

  <table border="1" class="table table-striped table-hover"  >

    <tr >
      <!-- <td>ARTICLE</td> -->
      <!-- <td>Article Name</td> -->
      <td>Article No</td>
      <td>STOCK</td>
      <td>Stock Limit</td>
    </tr>

    <?php 
    $sql="SELECT staff_articles.staff_id,staff_articles.staff_stock,staff_articles.article_limit,staff_articles.article_id,articles.article_name,articles.article_no FROM `staff_articles` LEFT JOIN articles on articles.article_id=staff_articles.article_id where staff_articles.staff_id='$value'";
    $query=mysqli_query($conn,$sql);
    $staff_stock_total=0;
    while($fetch=mysqli_fetch_array($query))
    {
      $article_id=$fetch['article_id'];
      $article_name=$fetch['article_name'];
      $article_no=$fetch['article_no'];
      $article_limit=$fetch['article_limit'];
      $staff_stock=$fetch['staff_stock'];

      ?>
      <tr>
        <!-- <td> <input style="border: none;width: 3vw;" readonly="1" type="text" name="article_id" value="<?php echo $article_id;?>"></td> -->
        <!-- <td><?php echo $article_name;?></td> -->
        <td><?php echo $article_no;?></td>
        <td><?php echo $staff_stock;?></td>
        <td><?php echo $article_limit;?></td>

        <!-- <td ><input style="*border: none;width: 8vw;" class="form-control" type="text" name="article_limit" value="<?php echo $article_limit;?>"></td> -->
      </tr>
      <?php 
      $staff_stock_total+=$staff_stock;
    } ?>
    <tr>
     <td colspan="4"><b>TOTAL STOCK : <?php echo $staff_stock_total;?></b></td>
   </tr>
 </table>
 <!--  -->
 <legend> DAILY TOTAL SALES</legend>
 <table border="1" class="table-condensed" >
  <thead >
    <tr class="table_head">
      <td>DATE </td>
      <td>QUANTITY</td>
    </tr>
  </thead>
  <tbody id="table">
    <?php
    $query=mysqli_query($conn,"SELECT sales.sales_date,SUM(sales_articles.article_qty) as article_qty FROM `sales_articles` LEFT JOIN sales on sales.sales_id=sales_articles.sales_id  WHERE sales.staff_id='$value' GROUP  BY sales.sales_date");
    while($fetch=mysqli_fetch_array($query))
    {
     $sales_date=$fetch["sales_date"];
     $sales_date= date("d-m-Y", strtotime($sales_date));


     $article_qty=$fetch["article_qty"];



     ?>
     <tr class="table_row">
       <td style="cursor: pointer;"> <?php echo $sales_date;?> </td>
       <td style="cursor: pointer;"> <?php echo $article_qty;?> </td>
     </tr>
     <?php

   }
   ?>
 </tbody>
</table></div>
<div class="tab-pane" id="voucher"><legend>STAFF VOUCHER BILLS</legend>


  <table border="1" class="table table-striped table-hover"  >

    <tr >
      <td>VOUCHER NO</td>
      <td>VOUCHER DATE</td>
      <td>VOUCHER DETAILS </td>
      <td>VOUCHER AMOUNT</td>

    </tr>
  </thead>
  <?php 
  $sql="SELECT voucher.voucher_id,voucher.voucher_date,voucher.voucher_time,voucher.voucher_amount,staffs.staff_name from voucher left JOIN staffs on staffs.staff_id=voucher.staff_id where voucher.staff_id='$value' AND voucher_date BETWEEN '$from_date' AND '$to_date'";
  $query=mysqli_query($conn,$sql);
// $staff_stock_total=0;
  if (!$query) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();}
    while($fetch=mysqli_fetch_array($query))
    {

      $voucher_id = $fetch["voucher_id"];
      $voucher_date = $fetch["voucher_date"];
      $voucher_time = $fetch["voucher_time"];
      $voucher_amount = $fetch["voucher_amount"];
      $voucher_date = date("d/m/Y", strtotime($voucher_date));
      ?>
      <tr>
        <td><?php echo $voucher_id;?></td>
        <td><?php echo $voucher_date;?></td>
        <td>
          <table  ><tr>

            <?php
            $query2=mysqli_query($conn,"SELECT voucher_details.invoice_no,voucher_details.paid,voucher_details.method from voucher_details where voucher_details.voucher_id= '$voucher_id'");
            $sleno=1;
            $cost_total=0;
            $mrp_total=0;
            if (!$query2) {
              printf("Error: %s\n", mysqli_error($conn));
              exit();
            }
            while ($fetch2=mysqli_fetch_array($query2))

            {



              $invoice_no=$fetch2['invoice_no'];
              $method=$fetch2['method'];
              $paid=$fetch2['paid'];
              if ($method=='1') {$method="CASH"; } 
              else   if ($method=='2') {$method="ONLINE"; } 
              else {$method="BANK"; } 




              ?>

              <td> <?php echo $invoice_no; ?></td>
              <td>    -  </td>
              <td>   <?php echo $method; ?></td>
              <td>    -  </td>
              <td> <?php echo  $paid." "."rs".","." "?></td>



              <?php
              $sleno++;
            }
            $margin=$mrp_total-$cost_total;
            ?></tr>

          </table>
        </td>
        <td><?php echo round($voucher_amount,2);?></td>
      </tr>
    <?php }?>
  </table></div>
</div>
</div>



<!-- 
<div class="col-md-9">
-->


<!-- --------------------------------------------------------------- STAFF GRV LIST ------------------------------------- -->




<!-- ----------------------------------------------------- STAFF INVOICE BILLS ------------------------------------------------------ -->


<!-- ----------------------------------------------------------- STAFF VOUCHER BILLS ----------------------------------------- -->



</div>




<!-- --------------------------------- EXECUTIVE TRANSACTION LIST ----------------------------------------------------------- -->










<!-- ------------------------------------------------------------- -DAILY TOTAL SALES--------------------------------------- -->

<div   class="col-md-3" style="display: none;">
  <!-- -------------------------------------------------------------- STAFF STOCK DETAILS--------------------------------------- -->

</div>
<!-- ============================================     =================================== -->




</div>


</body>
</html>
<script type="text/javascript">

  function item_sales(value)
  {
// alert(value+name);
window.location="employee_sales.php?value=" + value;

}

</script>
<script type="text/javascript">
  function date_filter()
  {
    var from_date=document.getElementById("from_date").value;
    var to_date=document.getElementById("to_date").value;
    var staff_value=document.getElementById("staff_value").value;
    window.location="employee_sales.php?from_date=" + from_date + "&to_date=" + to_date + "&value=" + staff_value;
  }
</script>

