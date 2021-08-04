<?php
include '../connect.php';
include("../main/navbar.php");
$sales_sql = "SELECT staff_grv.grv_id,estimation.sales_id,staff_grv.grv_date,staff_grv.profit,estimation.invoice_no,staff_grv.sales,estimation.sales_date,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from staff_grv 
    LEFT join estimation on estimation.sales_id=staff_grv.sales_id 
       LEFT join staffs on staffs.staff_id=estimation.staff_id
  
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

$sales_sql = "SELECT staff_grv.grv_id,estimation.sales_id,staff_grv.grv_date,staff_grv.profit,estimation.invoice_no,staff_grv.sales,estimation.sales_date,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from staff_grv 
    LEFT join estimation on estimation.sales_id=staff_grv.sales_id 
       LEFT join staffs on staffs.staff_id=estimation.staff_id

  
    LEFT join branches on branches.branch_id=staffs.branch_id  where estimation.$name ='$value' order by sales_id desc";
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
      <div class="col-md-7">
      <legend >STAFFS GOODS RETURN VOUCHER  </legend>
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
  <tr >    

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
<div   class="col-md-3">
  <!-- -------------------------------------------------------------- Article Grv -------------------------------------- -->

    <legend> Article Grv</legend>
  <table border="1" class="table-condensed table">
  
    <tr class="btn-success">
      <!-- <td>ARTICLE</td> -->
      <!-- <td>Article Name</td> -->
      <td>Sl No</td>
      <td>Article</td>
      <td>Qty</td>
    </tr>
 
  <?php 
  $sql="SELECT articles.article_id,articles.article_no,SUM(staff_grv_articles.article_qty) as article_grv FROM `staff_grv_articles` LEFT JOIN articles on articles.article_id=staff_grv_articles.article_id GROUP BY staff_grv_articles.article_id
";
  $query=mysqli_query($conn,$sql);
$staff_stock_total=0;
while($fetch=mysqli_fetch_array($query))
      {
        $article_id=$fetch['article_id'];
        $article_no=$fetch['article_no'];
        $article_grv=$fetch['article_grv'];
     
     
        ?>
<tr>

  <td><?php echo $article_id;?></td>
  <td><?php echo $article_no;?></td>
  <td><?php echo $article_grv;?></td>

  <!-- <td ><input style="*border: none;width: 8vw;" class="form-control" type="text" name="article_limit" value="<?php echo $article_limit;?>"></td> -->
</tr>
       <?php 
     $staff_stock_total+=$article_grv;
   } ?>
       <tr class="info">
         <td colspan="4"><b>TOTAL GRV : <?php echo $staff_stock_total;?></b></td>
       </tr>
     </table>
     </div>
     <div   class="col-md-2">
  <!-- -------------------------------------------------------------- Article Grv -------------------------------------- -->

    <legend> STAFF Grv</legend>
  <table border="1" class="table-condensed table">
  
    <tr class="btn-warning">
      <!-- <td>ARTICLE</td> -->
      <!-- <td>Article Name</td> -->
      <td>STAFF</td>
      <td>GRV</td>
     
    </tr>
 
  <?php 
  $sql="SELECT estimation.staff_id,staffs.staff_name,SUM(staff_grv_articles.article_qty) AS staff_grv FROM `staff_grv_articles` lEFT JOIN staff_grv on staff_grv.grv_id=staff_grv_articles.grv_id LEFT JOIN estimation on estimation.sales_id=staff_grv.sales_id LEFT JOIN staffs on staffs.staff_id=estimation.staff_id GROUP BY estimation.staff_id
";
  $query=mysqli_query($conn,$sql);
$article_grv_total=0;
while($fetch=mysqli_fetch_array($query))
      {
        $staff_name=$fetch['staff_name'];
        $staff_grv=$fetch['staff_grv'];
    
     
     
        ?>
<tr>

  <td><?php echo $staff_name;?></td>
  <td><?php echo $staff_grv;?></td>


  <!-- <td ><input style="*border: none;width: 8vw;" class="form-control" type="text" name="article_limit" value="<?php echo $article_limit;?>"></td> -->
</tr>
       <?php 
     $article_grv_total+=$staff_grv;
   } ?>
       <tr class="info">
         <td colspan="4"><b>TOTAL GRV : <?php echo $article_grv_total;?></b></td>
       </tr>
     </table>
     </div>
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
window.location="view_staff_grv.php?value=" + value + "&name=" + name;

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