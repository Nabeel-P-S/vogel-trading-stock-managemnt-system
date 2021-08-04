<?php
include '../connect.php';
$sales_sql="SELECT sales.sales_id,sales.sales_qty,sales.sales_price,sales.sales_date,articles.article_name,customers.customer_name,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from sales LEFT JOIN articles on articles.article_id=sales.article_id 
    LEFT join customers on customers.customer_id=sales.customer_id 
    LEFT join branches on branches.branch_id=sales.branch_id 
    LEFT join staffs on staffs.staff_id=sales.staff_id"; 

if (!empty($_GET["branch_id"])) 
    {
       $branch_id=$_GET['branch_id'];

          $sales_sql="SELECT sales.sales_id,sales.sales_qty,sales.sales_price,sales.sales_date,articles.article_name,customers.customer_name,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from sales LEFT JOIN articles on articles.article_id=sales.article_id 
    LEFT join customers on customers.customer_id=sales.customer_id 
    LEFT join branches on branches.branch_id=sales.branch_id 
    LEFT join staffs on staffs.staff_id=sales.staff_id where sales.branch_id='$branch_id'";
    } 
 
   if (!empty($_GET["staff_id"])) 
    {
       $staff_id=$_GET['staff_id'];

          $sales_sql="SELECT sales.sales_id,sales.sales_qty,sales.sales_price,sales.sales_date,articles.article_name,customers.customer_name,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from sales LEFT JOIN articles on articles.article_id=sales.article_id 
    LEFT join customers on customers.customer_id=sales.customer_id 
    LEFT join branches on branches.branch_id=sales.branch_id 
    LEFT join staffs on staffs.staff_id=sales.staff_id where sales.staff_id='$staff_id'";
    }     

?>


<!DOCTYPE html>
<html>
<head>
  <title>VOGEL SALES LIST</title>
<script type="text/javascript">
        window.onload=window.print();
    </script>
<body>
<?php include("../main/navbar.php") ?> 
 <div class="container" style="height: 42vw;">
 

<div><h3 style="text-align: center;"><b>SALES LIST</b></h3> </div>

    <div class="col-md-12" style="height: 35.85vw; overflow: auto; ">
      <table border="1" class="table-condensed table table-striped"  id="kit_table" style="border-width: 2px; *color: black;">
        <thead class="thead-dark" style="*background-color: #008080; *color: black;">



          <tr style="font-size: 1vw;">
<th style="*width: 5vw;">SALES NO:</th>
<th style="*width: 5vw;">SALES QTY:</th>
<th style="*width: 5vw;">SALES Price:</th>
<th style="*width: 5vw;">SALES Date:</th>
<th style="text-align: center;">ARTICLE NAME</th>
<th style="text-align: center;">CUSTOMER NAME </th>
<th style="text-align: center;">BRANCH NAME </th>
<th style="text-align: center;">STAFF NAME </th>


</tr>

</thead>
<tbody id="table">
  <?php
  $query=mysqli_query($conn,$sales_sql);

  $qty_sum=0;
    $sales_sum=0;

    $count=0;
  while($fetch=mysqli_fetch_array($query))
  {
   $sales_id=$fetch["sales_id"];
   $sales_qty=$fetch["sales_qty"];
   $sales_price=$fetch["sales_price"];
   $sales_date=$fetch["sales_date"];
   $article_name=$fetch["article_name"];
   $customer_name=$fetch["customer_name"];
   $branch_name=$fetch["branch_name"];
   $staff_name=$fetch["staff_name"];
   $branch_id=$fetch["branch_id"];
   $staff_id=$fetch["staff_id"];
   
   $qty_sum=$qty_sum+$sales_qty;
    $sales_sum=$sales_sum+$sales_price;
  
    $count++;
   
   ?>
   <tr style="cursor: pointer;">
     <td> <?php echo $sales_id;?> </td>
     <td> <?php echo $sales_qty;?> </td>
     <td> <?php echo $sales_price;?> </td>
     <td> <?php echo $sales_date;?> </td>
     <td> <?php echo $article_name;?> </td>
     <td> <?php echo $customer_name;?> </td>
     <td> <?php echo $branch_name;?> </td>
     <td>  <?php echo $staff_name;?></td>
     
     
     
   </tr>

    <?php

}
?>
  <tr style="color: white;background-color: #D9534F;font-family: fantasy;font-size: 18px;">    

      <th colspan="2">TOTAL </th>
      <th colspan="2">SALES : <?php echo $sales_sum;?> Rupees</th>
      <th colspan="2">QTY : <?php echo $qty_sum;?> Pieces</th>
      <th colspan="3">ORDERS : <?php echo $count;?> Orders</th>
     
      
     </tr>
</tbody>
</table>
</div>
</div>

<script type="text/javascript">
  function branch_sales(branch_id)
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