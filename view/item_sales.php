<?php
include '../connect.php';
include("../main/navbar.php");
$from_date='2020-06-10';
$to_date=$date;
$value=1;
if (!empty($_GET["value"])) 
    {
          $value = $_GET['value'];
     
          // $name=$_GET['name'];
 } 
 $article_id=$value;
 $item_sql="SELECT articles.sales_price,staffs.staff_name,estimation.invoice_no,estimation.sales_date,estimation_articles.sales_id, estimation_articles.article_qty FROM `estimation_articles` LEFT JOIN estimation on estimation.sales_id=estimation_articles.sales_id left JOIN staffs ON staffs.staff_id=estimation.staff_id LEFT JOIN articles ON articles.article_id='$value' WHERE estimation_articles.article_id='$value'";
$article_sql="SELECT articles.sales_price,staffs.staff_name,sales.invoice_no,sales.total,sales.sales_date,sales_articles.sales_id, sales_articles.article_qty FROM `sales_articles` LEFT JOIN sales on sales.sales_id=sales_articles.sales_id left JOIN staffs ON staffs.staff_id=sales.staff_id LEFT JOIN articles ON articles.article_id='$value' WHERE sales_articles.article_id='$value'";
if (!empty($_GET["from_date"])) 
    {
         $from_date = $_GET['from_date'];
         $to_date = $_GET['to_date'];
     $value = $_GET['value'];
        

          $article_sql="SELECT articles.sales_price,staffs.staff_name,sales.invoice_no,sales.total,sales.sales_date,sales_articles.sales_id, sales_articles.article_qty FROM `sales_articles` LEFT JOIN sales on sales.sales_id=sales_articles.sales_id left JOIN staffs ON staffs.staff_id=sales.staff_id LEFT JOIN articles ON articles.article_id='$value' WHERE sales_articles.article_id='$value' and sales_date BETWEEN '$from_date' AND '$to_date'";
          $item_sql="SELECT articles.sales_price,staffs.staff_name,estimation.invoice_no,estimation.sales_date,estimation_articles.sales_id, estimation_articles.article_qty FROM `estimation_articles` LEFT JOIN estimation on estimation.sales_id=estimation_articles.sales_id left JOIN staffs ON staffs.staff_id=estimation.staff_id LEFT JOIN articles ON articles.article_id='$value' WHERE estimation_articles.article_id='$value' AND sales_date BETWEEN '$from_date' AND '$to_date'";
    } 
  

  $sql="SELECT * FROM `articles` WHERE article_id='$value'";
  $query=mysqli_query($conn,$sql);
  $fetch=mysqli_fetch_array($query);
 $total_stock=$fetch['article_stock'];
   $article_price=$fetch['article_price'];
   $sales_price=$fetch['sales_price'];
   $article_name=$fetch['article_name'];
   $article_no=$fetch['article_no'];
  
?>
<!DOCTYPE html>
<html>
<head>
  <title>  <?php echo$value?>sales<?php echo date("d-m-Y", strtotime($date))."-".$time;?></title>

</head>
<body>


 <!-- ---------------------- TABLE HEAD------------------------------ -->
 <div class="col-md-12">
   <div class="col-lg-3">           <input   list="articles" id="article_id" class="form-control"   style="width: 13vw;" onchange="item_sales(this.value);" name="article_id" placeholder="SELECT ARTICLE" >
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
</datalist></div>

  <div class="col-lg-2" ><input class="form-control" placeholder="Search" id="myInput" type="text" style="width: 10vw; color: black;">   </div>
  <div class="col-lg-2" ><button class="btn btn-success"   onclick="print_page()">PRINT </button>
  </div>

  <div class="col-lg-5" style="*text-align: right;">
    <table class="table"><tr>

   
    
    <td>
     <input type="hidden" id="article_value" value="<?php echo $value;?>" >
      <input  type="date"  class="form-control" style="*width: 10vw;" name="from_date" value="<?php echo $from_date;?>" id="from_date"></td><td>
        <input  type="date" class="form-control"  style="*width: 10vw;" name="to_date" value="<?php echo $to_date;?>" id="to_date"></td><td>
          <button class="btn  btn-primary" onclick="date_filter();">FILTER </button></td>
        </tr></table>
      </div>

    </div>

    <!-- ---------------------- TABLE HEAD------------------------------ -->
    <div class="col-md-12" style="font-size: .85vw;"  id="printableArea">

      <!-- ------------------------------------------ STAFF ESTIMATION BILLS-------------------------------------------- -->

      <div class="col-xs-3">
        <!-- required for floating -->
        <!-- Nav tabs -->
        <legend><?php echo $article_no;?></legend>
                <span><?php echo $article_name;?></span>
        <ul class="nav nav-tabs tabs-left">
          <li><a href="#details" data-toggle="tab">EDIT DETAILS</a></li>
          <li  class="active"><a href="#overview" data-toggle="tab">OVERVIEW</a></li>
          <li ><a href="#estimation" data-toggle="tab">ESTIMATION BILLS</a></li>
          <li><a href="#sales" data-toggle="tab"> TOTAL SALES</a></li>
          <li ><a href="#stock" data-toggle="tab"> TOTAL STOCK</a></li>
          <li><a href="#dailySales" data-toggle="tab"> DAILY SALES</a></li>
          <li><a href="#stocks" data-toggle="tab"> DAILY   STOCKS</a></li>
          <li><a href="#grv" data-toggle="tab"> GRV   STOCKS</a></li>

        </ul>
      </div>
      <div class="col-xs-9">
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- ==================================================  OVER VIEW ============================================= -->


    <div class="tab-pane active " id="overview">
      
    
  <?php
    $sql="SELECT articles.article_id,
           articles.article_name,
           articles.hsn_no,
           articles.sgst,
           articles.cgst,
           articles.igst,
           articles.cess,
           articles.article_no,
             articles.article_price,
            sum(stocks.article_qty) as in_stock,
             articles.sales_price,
               articles.article_stock AS available,
          articles.sold,
          articles.dsold,
          articles.fsold,

        
           articles.staff_stock as staff_stock,
            articles.article_stock as main_stock,
              suppliers.supplier_name from articles  
                     LEFT JOIN stocks
                  ON stocks.article_id = articles.article_id
              left JOIN suppliers
               ON suppliers.supplier_id=articles.supplier_id
       WHERE  articles.article_id='$article_id'";
  $query=mysqli_query($conn,$sql);
  $count=0;
  $qty_sum=0;
  $mrp=0;
  $price=0;
  $staff_stock_total=0;
  $sales_total=0;

  $fetch=mysqli_fetch_array($query);
  
   $article_no=$fetch["article_no"];
   $article_id=$fetch["article_id"];
       $article_name=$fetch["article_name"];
       $article_price=$fetch["article_price"];
       $hsn_no=$fetch["hsn_no"];
       $sgst=$fetch["sgst"];
       $cgst=$fetch["cgst"];
       $igst=$fetch["igst"];
       $cess=$fetch["cess"];
       $sales_price=$fetch["sales_price"];
       $sold=$fetch["sold"];
       $dsold=$fetch["dsold"];
       $fsold=$fetch["fsold"];
       $in_stock=$fetch["in_stock"];
       $main_stock=$fetch["main_stock"];
       $staff_stock=$fetch["staff_stock"];
       // $sales=$fetch["sales"];
       $available=$fetch["available"];
       $supplier_name=$fetch["supplier_name"];

     $qty_sum=$qty_sum+$main_stock;
     $staff_stock_total+=$staff_stock;
     // $sales_total+=$sales;
     $count++;
     $mrp+=$sales_price;
     $price+=$article_price;
   
   
   ?>
  
      
    
     
   </tr>
 </tbody></table>
 <?php
 $sql1="SELECT sum(article_qty) as est_qty FROM `estimation_articles`  WHERE article_id='$article_id'";
 $sql2="SELECT sum(article_qty) as sls_qty FROM `sales_articles`  WHERE article_id='$article_id'";
 $sql3="SELECT SUM(article_qty) as grv_qty FROM `staff_grv_articles` WHERE article_id='$article_id'";
  $query1=mysqli_query($conn,$sql1);
  $query2=mysqli_query($conn,$sql2);
  $query3=mysqli_query($conn,$sql3);
  $fetch1=mysqli_fetch_array($query1);
  $fetch2=mysqli_fetch_array($query2);
  $fetch3=mysqli_fetch_array($query3);
   $est_qty=$fetch1['est_qty'];
   $sls_qty=$fetch2['sls_qty'];
   $grv_qty=$fetch3['grv_qty'];



   ?>
   <table class="table" style="font-size: 1.3vw;">
     <tr>
     <td>STOCK ENTERED  : <?php echo $in_stock;?></td></tr><tr>

     <td>ESTIMATION QTY : <?php echo $est_qty;?></td>
      <td>SALES QTY : <?php echo $sls_qty;?></td></tr><tr>
      <td>GRV QTY : <?php echo $grv_qty;?></td></tr><tr>
     <td>STAFF QTY : <?php echo $staff_stock;?></td></tr><tr>
     <td>STAFF SOLD QTY : <?php echo $sold;?></td></tr><tr>
     <td>DIRECT SOLD QTY : <?php echo $dsold;?></td></tr><tr>
     <td>FREE SOLD QTY : <?php echo $fsold;?></td></tr><tr>
     <td style=" <?php
     $nabeel=$in_stock-$est_qty-$dsold-$fsold;
      if ($available!=$nabeel)
      {
        echo  "background-color: red;";
      } 
      else
        { echo  "background-color: yellow;";}
          ?> ">AVAILABLE QTY : <?php echo $available;?></td></tr><tr>

  
     </tr>
   </table>
    </div>


<!-- ==================================================  DETAILS ============================================= -->

    <div class="tab-pane " id="grv">
       <table border="1" class=" table table-condensed table-hover "  id="kit_table"  >



          <tr class="btn-primary" >
<th >NO</th>
<th style="text-align: center;" >Date</th>
<th style="text-align: center;">STAFF </th>
<th style="text-align: center;">ARTICLES </th>
<th style="text-align: center;">COST</th>
<!-- <th style="text-align: center;">MARGIN</th> -->
<th> </th>

</tr>


<tbody id="table">
  <?php
$query = mysqli_query($conn, "SELECT staff_grv.grv_id,estimation.sales_id,staff_grv.grv_date,staff_grv.profit,estimation.invoice_no,staff_grv.sales,estimation.sales_date,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from staff_grv 
    LEFT join estimation on estimation.sales_id=staff_grv.sales_id 
       LEFT join staffs on staffs.staff_id=estimation.staff_id
       LEFT join staff_grv_articles on staff_grv_articles.grv_id=staff_grv.grv_id
  
    LEFT join branches on branches.branch_id=staffs.branch_id  where staff_grv_articles.article_id='$article_id'
  order by grv_id desc");

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
  // sales sales_id  sales_date  customer_id customer_name branch_name staff_name  staff_id  branch_id 

    $sales_id = $fetch["sales_id"];
    $invoice_no = $fetch["invoice_no"];
    // $sales_qty = $fetch["sales_qty"];
    // $sales_price = $fetch["sales_price"];
    $sales_date = $fetch["sales_date"];
      $sales_date = date("d-m-Y", strtotime($sales_date));
    // $article_name = $fetch["article_name"];
    // $article_id = $fetch["article_id"];
    // $article_price = $fetch["article_price"];

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
   <tr  style="cursor: pointer;">
     <td > <?php echo $grv_id; ?> </td>
    
     <td > <?php echo $grv_date; ?> </td>

  
     <td onclick="refresh_again2('<?php echo $staff_id;?>','staff_id')">  <?php echo $staff_name; ?> </td>
     <td >
       
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
                    $qty_sum+=$article_qty;
                    $cost=$sales_price*$article_qty;


                    ?>


                    <td> <?php echo $article_no; ?></td>
                    <td>    -  </td>
                    <td> <?php echo  $article_qty.","." "?></td>

                    <?php
                    $sleno++;
                }
    ?>
    
  </table>
    </td>
  <td>  <?php echo $sales; ?> </td>
     <!-- <td> <a > <?php echo $profit; ?> </a></td> -->
     <td><a class="btn-danger" href="../print/staff_grv_bill.php?grv_id=<?php echo $grv_id;?>"> print</a></td>

     
   </tr>
 
    <?php
}
?>
  <tr style="display: none;">    

      <!-- <th colspan="2">TOTAL </th> -->
      <th colspan="2"> BILLS : <?php echo $count; ?> </th>
      <th colspan="1">Qty : <?php echo $qty_sum; ?> </th>
      <th colspan="1">COST : <?php echo $sales_sum; ?> Rs</th>
      <th colspan="3">MARGIN : <?php echo $margin_sum; ?> Rs</th>
     
      <!-- <th colspan="2">Margin : <?php echo $margin_sum; ?> Rs</th> -->
     
      
     </tr>
</tbody>
</table>
    </div>
    <div class="tab-pane  " id="details">
      <?php
include("../view/article_edit.php");
?>
    </div>

    <!-- ------------------------------------------ STAFF ESTIMATION BILLS-------------------------------------------- -->

    <div class="tab-pane" id="estimation">


       <legend>  ESTIMATION BILLS</legend>
       <?php 

       ?>
       <table border="1" class="table table-condensed table-hover" >

        <tr class="btn-primary">

          <th>SL NO </th>
          <th>DATE</th>
          <th>INVOICE</th>
          <th>EXECUTIVE </th>

          <!-- <th>SALES ID</th> -->
          <th>QUANTITY</th>
          <!-- <th>AMOUNT</th> -->



        </tr>


        <tbody id="table">
          <?php
          $query=mysqli_query($conn,$item_sql);
          $slno=0;
          $qty_sum=0;
          $amount_sum=0;
          while($fetch=mysqli_fetch_array($query))
          {
           $staff_name=$fetch["staff_name"];
           $invoice_no=$fetch["invoice_no"];
           $sales_date=$fetch["sales_date"];
           $sales_price=$fetch["sales_price"];
           $sales_date= date("d-m-Y", strtotime($sales_date));


           $sales_id=$fetch["sales_id"];
           $article_qty=$fetch["article_qty"];
         // $amount=$fetch["sales"];
           $qty_sum+=$article_qty;
         // $amount_sum+=$amount;
        // $amount=$article_qty*$sales_price;
           $slno++;


           ?>
           <tr class="table_row">
            <td style="cursor: pointer;"> <?php echo $slno;?> </td>
            <td style="cursor: pointer;"> <?php echo $sales_date;?> </td>
            <td style="cursor: pointer;"> <?php echo $invoice_no;?> </td>
            <td style="cursor: pointer;"> <?php echo $staff_name;?> </td>

            <!-- <td style="cursor: pointer;"> <?php echo $sales_id;?> </td> -->
            <td style="cursor: pointer;"> <?php echo $article_qty;?> </td>
            <!-- <td style="cursor: pointer;"> <?php echo $amount;?> </td> -->


          </tr>
          <?php

        }
        ?>
        <tr class="info">
          <td colspan="2">
            Count: <?php echo $slno;?>
          </td>
          <td colspan="2">
            QTY : <?php echo $qty_sum;?>
          </td>
          <td colspan="1">
            Sales : <?php echo $amount_sum;?>
          </td>
        </tr>
      </tbody>
      </table>
</div>
<!-- ------------------------------------------------------------------------------------- ARTICLE SALE STATEMENT    --------------------------------------- -->
  <div class="tab-pane " id="sales">
      <span >  SALES STATEMENT </span>  <p style="float:  right;"><?php
  

      echo  date("d/m/Y", strtotime($from_date)) ?> - <?php echo date("d/m/Y", strtotime($to_date)) ?></p> 
      <table border="1" class="table table-condensed table-hover" >

        <tr class="btn-success">

          <th>SL NO </th>
          <th>DATE</th>
          <th>INVOICE</th>
          <th>EXECUTIVE </th>

          <!-- <th>SALES ID</th> -->
          <th>QUANTITY</th>
          <th>AMOUNT</th>



        </tr>


        <tbody id="table">
          <?php
          $query=mysqli_query($conn,$article_sql);
          $slno=0;
          $qty_sum=0;
          $amount_sum=0;
          while($fetch=mysqli_fetch_array($query))
          {
           $staff_name=$fetch["staff_name"];
           $invoice_no=$fetch["invoice_no"];
           $sales_date=$fetch["sales_date"];
           $sales_price=$fetch["sales_price"];
           $sales_date= date("d-m-Y", strtotime($sales_date));


           $sales_id=$fetch["sales_id"];
           $article_qty=$fetch["article_qty"];
           $amount=$fetch["total"];
           $qty_sum+=$article_qty;
           $amount_sum+=$amount;
      // $amount=$article_qty*$sales_price;
           $slno++;


           ?>
           <tr class="table_row">
            <td style="cursor: pointer;"> <?php echo $slno;?> </td>
            <td style="cursor: pointer;"> <?php echo $sales_date;?> </td>
            <td style="cursor: pointer;"> <?php echo $invoice_no;?> </td>
            <td style="cursor: pointer;"> <?php echo $staff_name;?> </td>

            <!-- <td style="cursor: pointer;"> <?php echo $sales_id;?> </td> -->
            <td style="cursor: pointer;"> <?php echo $article_qty;?> </td>
            <td style="cursor: pointer;"> <?php echo $amount;?> </td>


          </tr>
          <?php

        }
        ?>
        <tr class="info">
          <td colspan="2">
            Count: <?php echo $slno;?>
          </td>
          <td colspan="2">
            QTY : <?php echo $qty_sum;?>
          </td>
          <td colspan="2">
            Sales : <?php echo $amount_sum;?>
          </td>
        </tr>
      </tbody>
    </table>
</div>


  <div class="tab-pane " id="stock">
      <span> STAFF TOTAL STOCK</span>

      <table border="1" class="table  table-hover" >

        <tr class="btn-warning">
          <th>STAFF </th>
          <th>STOCK</th>
        </tr>
        <tbody id="table">
          <?php
    
          $sql3="SELECT staffs.staff_name,SUM(staff_articles.staff_stock) as staff_stock FROM `staff_articles`   LEFT JOIN staffs on staffs.staff_id=staff_articles.staff_id WHERE article_id='$value'  GROUP BY staff_articles.staff_id";
          $query=mysqli_query($conn,$sql3);
          $total_staff_stock=0;
          while($fetch=mysqli_fetch_array($query))
          {
           $staff_name=$fetch["staff_name"];

           $staff_stock=$fetch["staff_stock"];
           $total_staff_stock+=$staff_stock;


           ?>
           <tr class="table_row">
             <td style="cursor: pointer;"> <?php echo $staff_name;?> </td>
             <td style="cursor: pointer;"> <?php echo $staff_stock;?> </td>
           </tr>
           <?php

         }
         ?>
         <tr class="success"><td colspan="2"> Total : <?php echo $total_staff_stock?> </td></tr>
       </tbody>
     </table>
</div>


  <div class="tab-pane " id="dailySales">
      <span> DAILY TOTAL SALES</span>
      <table border="1" class="table table-condensed table-hover" >

        <tr class="btn-primary">
          <th>DATE </th>
          <th>QUANTITY</th>
        </tr>

        <tbody id="table">
          <?php
          $query=mysqli_query($conn,"SELECT sales.sales_date,SUM(sales_articles.article_qty) as sales FROM `sales` LEFT JOIN sales_articles ON sales_articles.sales_id=sales.sales_id where sales_articles.article_id='$value'   GROUP  BY sales.sales_date");
          while($fetch=mysqli_fetch_array($query))
          {
           $sales_date=$fetch["sales_date"];
           $sales_date= date("d-m-Y", strtotime($sales_date));


           $sales=$fetch["sales"];



           ?>
           <tr class="table_row">
             <td style="cursor: pointer;"> <?php echo $sales_date;?> </td>
             <td style="cursor: pointer;"> <?php echo $sales;?> </td>
           </tr>
           <?php

         }
         ?>
       </tbody>
     </table>
</div>
<!-- ===================================================== stocks ---------------------------- -->
<div class="tab-pane " id="stocks">
  <span>DAILY TOTAL  STOCKS</span>
     <table border="1" class="table table-hover" >
        
              <tr class="btn-danger">
<!-- <th>STOCK ID </th> -->
<th>DATE </th>
<th>QUANTITY</th>
</tr>
<tbody id="table">
  <?php
  $query=mysqli_query($conn,"SELECT * FROM `stocks` WHERE article_id='$value'");
  while($fetch=mysqli_fetch_array($query))
  {
   $stock_id=$fetch["stock_id"];
   $stock_date=$fetch["stock_date"];
     $stock_date= date("d-m-Y", strtotime($stock_date));
   $article_qty=$fetch["article_qty"];

    
   
   ?>
   <tr class="table_row">
     <!-- <td style="cursor: pointer;"> <?php echo $stock_id;?> </td> -->
     <td style="cursor: pointer;"> <?php echo $stock_date;?> </td>
      <td style="cursor: pointer;"> <?php echo $article_qty;?> </td>
        </tr>
    <?php

}
?>
</tbody>
</table>
</div>

</div>
</div>
</div>


</body>
</html>
<script type="text/javascript">

  function item_sales(value)
  {
// alert(value+name);
window.location="item_sales.php?value=" + value;

  }

</script>
<script type="text/javascript">
  function date_filter()
  {
    alert("yes");
    var from_date=document.getElementById("from_date").value;
    var to_date=document.getElementById("to_date").value;
    var article_value=document.getElementById("article_value").value;
    alert(from_date+to_date+article_value);
window.location="item_sales.php?from_date=" + from_date + "&to_date=" + to_date + "&value=" + article_value;
}
</script>
