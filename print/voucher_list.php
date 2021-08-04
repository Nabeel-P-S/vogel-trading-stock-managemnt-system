<?php
include '../connect.php';
  date_default_timezone_set('Asia/Kolkata');
   $date = date("d-m-Y");
$from_date='2020-06-10';
$to_date=$date;
$sales_sql = "SELECT voucher.voucher_id,voucher.voucher_date,voucher.voucher_time,voucher.voucher_amount,staffs.staff_name from voucher left JOIN staffs on staffs.staff_id=voucher.staff_id  order by voucher_id desc";

 
  if (!empty($_GET["from_date"])) 
    {
         $from_date = $_GET['from_date'];
         $to_date = $_GET['to_date'];
     
        

          $sales_sql="SELECT voucher.voucher_id,voucher.voucher_date,voucher.voucher_time,voucher.voucher_amount,staffs.staff_name from voucher left JOIN staffs on staffs.staff_id=voucher.staff_id  WHERE voucher_date BETWEEN '$from_date' AND '$to_date'";
    } 
  
?>

<!DOCTYPE html>
<html>
<head>
  <title>Voucher List</title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/w3.css">
</head>
  <style type="text/css">

<?php include ("../css/mycss.php")
 
?>

  </style>
<style type="text/css">
.table-hover tbody tr:hover td {
    /*background:#6f8787;*/
    /*color: #017874;*/
    color: black;
    font-weight: bold;
}
</style>
<body>


     <!-- <div class="col-lg-2" ><input  placeholder="Search" id="myInput" type="text" style="width: 12vw;color: black;margin-bottom: 1vw;">   </div> -->
     <div class="col-lg-10" >
 
      <!-- <a class="btn btn-danger"  href="../print/sales_print.php">PRINT</a> -->



<table style="float: right;">
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
    <td style="display: none;">
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
    <td style="display: none;">
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
  <!--    
 
<input  type="date" name="from_date" value="<?php echo $from_date;?>" id="from_date">
<input  type="date" name="to_date" value="<?php echo $to_date;?>" id="to_date">
<button class="btn btn-md" onclick="date_filter();">OK </button> -->
<!-- <button style="margin-left: 3vw;width: 10vw;" class="btn btn-primary"  onclick="print_page()">PRINT </button> -->
<!-- <a class="btn btn-primary" href="../view/full_sales.php"> Full SALES</a> -->

    </td>
  </tr>
</table>
   

</div> 



    <div id="printableArea"  class="col-md-12" style="overflow: auto; ">
      <h3 style="text-align: center;"><b>VOUCHERS LIST   </b></h3>
      <table border="1" class="table"  id="kit_table" style="font-size: 1vw;width: 100%;">
        <thead class="thead-dark">



          <tr class="table_head" >
<!-- <th >NO</th> -->

<th style="text-align: center;" >NO</th>
<th style="text-align: center;" >Date</th>
<th style="text-align: center;" >TIME</th>

<!-- <th style="text-align: center;">BRANCH  </th> -->
<th style="text-align: center;">AMOUNT </th>
<th style="text-align: center;">STAFF </th>
<th style="text-align: center;">DETAILS </th>




<!-- <th style="text-align: center;"> </th>
 -->
</tr>

</thead>
<tbody id="table">
  <?php
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


    $voucher_id = $fetch["voucher_id"];
    $voucher_date = $fetch["voucher_date"];
    $voucher_time = $fetch["voucher_time"];
       $voucher_amount = $fetch["voucher_amount"];
      $voucher_date = date("d/m/Y", strtotime($voucher_date));
       $staff_name = $fetch["staff_name"];
  

?>
   <tr class="table_row" style="cursor: pointer;">
  
         <td ><a style="width: 100%"
     href="../print/voucher_receipt.php?voucher_id=<?php echo $voucher_id;?>"> <?php echo $voucher_id; ?> </a></td>

     <td > <?php echo $voucher_date; ?> </td>
    <td > <?php echo $voucher_time; ?> </td>
     <td >  <?php echo $voucher_amount;?> </td>
     <td >  <?php echo $staff_name; ?></td>
     <td><a >
       
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
     </a></td>

   
   </tr>
 
   <tr >
  <td colspan="9" style="padding: 0;">
     <div style="display: none;" id="size_td<?php echo $sales_id; ?>">

      <table class="table" >
        <thead class="table_head" style="background-color:#009e52;color: white;">
   <tr >
           <th >SL NO:</th>
           <th style="text-align: center;"> ARTICLE NO </th>
           <th style="text-align: center;"> ARTICLE NAME </th>
           <th style="text-align: center;"> ARTICLE PRICE </th>
            <th style="text-align: center;"> ARTICLE QUANTITY</th>
            <th style="text-align: center;">COST</th>

          </tr>
        </thead>
    <?php
              $query2=mysqli_query($conn,"SELECT sales_articles.sales_id, sales_articles.article_id,sales_articles.article_qty,articles.article_no,articles.sales_price, sales_articles.id,articles.article_name FROM `sales_articles` left join `articles` on articles.article_id=sales_articles.article_id  WHERE sales_articles.sales_id='$sales_id'");
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
     

<tr class="table_row">

          <td> <?php echo $sleno; ?></td>
          <td> <?php echo $article_no; ?></td>
          <td> <?php echo $article_name; ?></td>
          <td> <?php echo $sales_price; ?></td>
          <td> <?php echo $article_qty; ?></td>
          <td> <?php echo $cost; ?></td>
          

        </tr>



<?php
$sleno++;
  }
    ?>
    
  </table>
      </div>
    </td>
  </tr>
    <?php
}
?>
 
      
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
  function delete_sale(sales_id)
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
window.location="view_vouchers.php?from_date=" + from_date + "&to_date=" + to_date;
}
</script>
</body>

</html>