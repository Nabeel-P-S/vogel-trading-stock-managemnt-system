<?php
include '../connect.php';
$sales_id = $_GET['sales_id'];
    // $query=mysqli_query($conn,"select sales_id from sales order by sales_id desc LIMIT 1");
    // $fetch1=mysqli_fetch_array($query);
    //  $sales_id=$fetch1['sales_id'];
 $sales_sql="SELECT sales.sales_id,sales.invoice_no,sales.sales_date,customers.customer_name,customers.customer_address,customers.customer_phone,customers.customer_gst,branches.branch_name,staffs.staff_name,sales.sales,sales.profit from sales LEFT JOIN customers on customers.customer_id=sales.customer_id LEFT JOIN staffs ON staffs.staff_id=sales.staff_id LEFT JOIN branches ON branches.branch_id=sales.branch_id where sales.sales_id='$sales_id'";
 $article_sql="SELECT articles.article_id,articles.article_no,articles.article_name,articles.article_price,articles.sales_price, sales_articles.article_qty FROM sales_articles LEFT JOIN articles ON articles.article_id=sales_articles.article_id where sales_articles.sales_id='$sales_id'";

    $query=mysqli_query($conn,$sales_sql);
    $article_query=mysqli_query($conn,$article_sql);


     $fetch=mysqli_fetch_array($query);
       $sales_id=$fetch["sales_id"];

   $sales_date=$fetch["sales_date"];
   $invoice_no=$fetch["invoice_no"];
   $sales=$fetch["sales"];

$qty=0;
   $staff_name=$fetch["staff_name"];
   $branch_name=$fetch["branch_name"];
   $customer_address=$fetch["customer_address"];
   $customer_name=$fetch["customer_name"];
?>
<!DOCTYPE html>
<html>
<head>
  <title>VOGEL SALES BILL</title>
</head>
  <script type="text/javascript">
        window.onload=window.print();
    </script>
<body>
  <!-- <button  id="print_btn" onclick="window.print();">print</button> -->

<?php include("../navbar.php") ?> 
 <div class="" style="height: 42vw;">
  

   <div class="container" id="printable" style="border: 1px solid black;">
<div class="row">
<table> 
<tr>
      <td style="padding-left: 2vw;">
      <table>

      <tr><td style="color: red;font-weight: bold;"> VOGEL TRADING</td></tr>
      <tr><td> 17/81 #2 GROUND FLOOR</td></tr>
      <tr><td> A TOWER COMPLEX</td></tr>
      <tr><td> CALVERY JUNCTION</td></tr>
      <tr><td> ARANATTUKARA ROAD</td></tr>
      <tr><td> POOTHOL, THRISSUR - 680004</td></tr>
      <tr><td> PHONE: 04847-2383104, 8138913909</td></tr>
      <tr><td> Email: vogeluniforms@gmail.com</td></tr>


      </table>

      </td>
      <td>
      <img  style="margin-left:18vw;" src="../images/logo.jpeg" width="200px" height="100">
      </td>
</tr>

<tr>
        <td colspan="2">
        <p style="margin-left: 38vw;*font-family: fantasy;font-size: 3vw;font-weight: bold;">DELIVERY ORDER</p>
        </td>
</tr>
</table>
</div>


<div class="row" >

<table border="1" style="text-align: center;font-weight: bold;*font-family: fantasy;"> 
<tr> <td>DELIVERY ADDRESS</td ><td colspan="3"><?php echo $customer_name." ".$customer_address?></td></tr>
    <tr><td style="width: 25vw;">DELIVERY NO</td><td style="width: 25vw;">  <?php echo $sales_id; ?> </td ><td style="width: 25vw;">DATE</td><td style="width: 25vw;"> <?php echo $sales_date; ?></td></tr>
    <tr><td>BRANCH</td><td>  <?php echo $branch_name; ?> </td><td>EXECUTIVE NAME</td><td> <?php echo $staff_name; ?></td></tr>

</table>
</div>
<div class="row" style="height: 70vw;">
        <table class="table" border="1"><tr style="text-align: center;font-weight: bold;height: 1vw;"><td>S NO</td><td> ITEM  </td><td>ARTICLE No</td><td> BUNDLE</td><td>QUANTITY</td></tr>
 <?php
 $slno=0;
while($fetch_article=mysqli_fetch_array($article_query))
      {

        $slno++
        ?>
<tr ><td><?php echo $slno;?></td><td> <?php echo $fetch_article["article_name"];?>  </td><td><?php echo $fetch_article["article_no"];?> </td><td> </td><td> <?php echo $fetch_article["article_qty"];?> </td></tr>
 <?php 
  $qty+=$fetch_article["article_qty"];

     }
      ?>
    
      </table>
</div>
<table class="table" style="font-weight: bold;text-align: center;font-size: 2.5vw;*font-family: serif;">  <tr>
        <td colspan="4" style="float: right;">TOTAL QUANTITY
        </td>
        <td><?php echo $qty;?></td>
      </tr></table>


<div class="row" style="border: 1px solid;height: 20vw;*font-family: fantasy;">
    <div  style="float:left;width: 50%;height: 20vw;">  
      <table class="table">
    <tr><td style="width:50vw;"><b >GOODS RECIEVED BY :</b> </td></tr>

<tr> <td><b style="padding-left: 2vw;">Authorized Stamp & Signatory</b></td></tr>
 </table></div>
    <div  style="float:right;width: 50%;border-left: 1px solid;height: 20vw;text-align: center;">
    <h4>for VOGEL TRADING</h4></div>

</div>


      
    </div>

  

<script type="text/javascript">
  function edit_category(color_id)
   {
    // alert(vendor_id);
    $.ajax({
      type:"POST",
      url:"edit/color_edit.php",
      data:{
        color_id:color_id
      },
      success:function(data)
      {
        // alert(data);
        $("#total_div").html(data);
      }

    })
  }
</script>

</body>
</html>

