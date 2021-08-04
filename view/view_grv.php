<?php
include '../connect.php';
include("../main/navbar.php");
$sales_sql = "SELECT grv.grv_id,sales.sales_id,grv.grv_date,grv.profit,sales.invoice_no,grv.sales,sales.customer_id,sales.sales_date,customers.customer_name,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from grv 
    LEFT join sales on sales.sales_id=grv.sales_id 
       LEFT join staffs on staffs.staff_id=sales.staff_id
    LEFT join customers on customers.customer_id=sales.customer_id 
    LEFT join branches on branches.branch_id=staffs.branch_id 
  order by grv_id desc";

 $category=" ";
 if (!empty($_GET["value"])) 
    {
          $value = $_GET['value'];
     
          $name=$_GET['name'];
 
       $category ="OF"." "." ".$value;
       // $cat
       // egory ="OF"." ".strtoupper($_GET['name'])." ".$value;;

$sales_sql = "SELECT sales.profit,sales.sales,sales.invoice_no,sales.sales_id,sales.customer_id,sales.sales_date,customers.customer_name,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from sales 
    LEFT join customers on customers.customer_id=sales.customer_id 
    LEFT join branches on branches.branch_id=sales.branch_id 
    LEFT join staffs on staffs.staff_id=sales.staff_id  where sales.$name ='$value' order by sales_id desc";
    } 
 
  
?>

<!DOCTYPE html>
<html>
<head>
  <title>VOGEL SALES LIST</title>
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


     <div class="col-lg-4" ><input class="form-control" placeholder="Search" id="myInput" type="text" style="width: 12vw;color: black;margin-bottom: 1vw;">   </div>
     <div class="col-lg-8" >
 
      <!-- <a class="btn btn-danger"  href="../print/sales_print.php">PRINT</a> -->



<table>
  <tr>
       <td style="display: none;">
        <input list="articles" id="article_id" class="form-control" style="width: 12vw;" onkeyup="item_sales(this.value);" name="article_id" placeholder="SEARCH ARTICLE" >
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
        <input list="staffs" id="staff_id" class="form-control" style="width: 12vw;" onkeyup="refresh_again2(this.value,'staff_id');" name="staff_id" placeholder="SEARCH STAFF" >
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
          <input list="branches" id="branch_id" onkeyup="refresh_again2(this.value,'branch_id');" name="branch_id" placeholder="SEARCH BRANCH"  class="form-control">


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
    <td style="padding-left: 45vw;">
     <button class="btn btn-danger"  onclick="print_page()">PRINT GRV</button>
 
    </td>
  </tr>
</table>
   

</div> 



    <div id="printableArea"  class="col-md-12" style="overflow: auto; ">
      <h3 style="text-align: center;"><b>GOODS RETURN VOUCHER  </b></h3>
      <table border="1" class=" table table-hover "  id="kit_table"  >
        <thead class="thead-dark" style="background-color: #29313d;">



          <tr class="table_head" >
<th >NO</th>

<th style="text-align: center;" >Date</th>
<th style="text-align: center;" >INVOICE</th>

<!-- <th style="text-align: center;">CUSTOMER  </th> -->
<!-- <th style="text-align: center;">BRANCH  </th> -->
<th style="text-align: center;">STAFF </th>
<th style="text-align: center;">ARTICLES </th>
<th style="text-align: center;">COST</th>
<th style="text-align: center;">MARGIN</th>



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
    $customer_name = $fetch["customer_name"];
    $customer_id = $fetch["customer_id"];
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
     <td onclick= "open_size_list('<?php echo $sales_id;?>');"> <?php echo $grv_id; ?> </td>
    
     <td onclick="delete_sale('<?php echo $sales_id;?>')"> <?php echo $grv_date; ?> </td>
     <td ><a href="../forms/add_grv.php?sales_id=<?php echo $sales_id;?>"> <?php echo $invoice_no; ?> </a></td>
    <!-- <td onclick="refresh_again1('<?php echo $customer_id;?>','customer_id')"> <?php echo $customer_name; ?> </td> -->
     <!-- <td onclick="refresh_again1('<?php echo $branch_id;?>','branch_id')">  <?php echo $branch_name;?> </a></td> -->
     <td onclick="refresh_again2('<?php echo $staff_id;?>','staff_id')">  <?php echo $staff_name; ?> </a></td>
     <td ><a >
       
       <table  >
        
          <?php
              $query2=mysqli_query($conn,"SELECT grv_articles.grv_id, grv_articles.article_id,grv_articles.article_qty,articles.article_no,articles.sales_price, grv_articles.id,articles.article_name FROM `grv_articles` left join `articles` on articles.article_id=grv_articles.article_id  WHERE grv_articles.grv_id='$grv_id'");
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
  <td> <a 
     href="../print/grv_bill.php?grv_id=<?php echo $grv_id;?>"> <?php echo $sales; ?> </a></td>
     <td> <a > <?php echo $profit; ?> </a></td>
   <!--   <td >
      <button class=" btn-md btn-primary" >Open</button>
      <button onclick="delete_sale('<?php echo $sales_id;?>')" class="btn-md btn-danger">DLT</button>
       <a ><button class=" btn-md btn-warning">Invoice</button></a>
       <a ><button  style="*height: 1.5vw;" class=" btn-md btn-success">Order</button></a>
     </td>
 -->
     
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
              $query2=mysqli_query($conn,"SELECT grv_articles.grv_id, grv_articles.article_id,grv_articles.article_qty,articles.article_no,articles.sales_price, grv_articles.id,articles.article_name FROM `grv_articles` left join `articles` on articles.article_id=grv_articles.article_id  WHERE grv_articles.grv_id='$grv_id'");
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
  <tr class="table_summary" >    

      <!-- <th colspan="2">TOTAL </th> -->
      <th colspan="2">GRV BILLS : <?php echo $count; ?> </th>
      <th colspan="2">COST : <?php echo $sales_sum; ?> Rs</th>
      <th colspan="3">MARGIN : <?php echo $margin_sum; ?> Rs</th>
     
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

  function refresh_again2(value,name)
  {
// alert(value+name);
window.location="view_grv.php?value=" + value + "&name=" + name;

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

</html>