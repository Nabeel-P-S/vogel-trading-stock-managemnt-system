<?php
include '../connect.php';
include("../main/navbar.php");
$sql ="SELECT staffs.staff_id
,staffs.salary
,staffs.area
,staffs.first_name
,staffs.category
,staffs.staff_ta
,staffs.staff_allowance
,staffs.advance_limit
,staffs.staff_incentive
,staffs.amount_limit,staffs.credit_amount,staffs.staff_name,staffs.branch_id,branches.branch_name,Sum(sales.sales) as sales, sum(sales.paid) as paid, sum(staff_articles.staff_stock) as staff_stock,
       Sum(sales.profit) as profit FROM staffs 
    
       
       LEFT JOIN sales ON sales.staff_id = staffs.staff_id
      
      LEFT JOIN staff_articles on  staff_articles.staff_id=staffs.staff_id
       left join branches on branches.branch_id=staffs.branch_id 
       GROUP  BY staffs.staff_id order by staff_id desc ";
if (!empty($_GET["branch_id"]))
{
    $branch_id = $_GET['branch_id'];
       $category ="IN"." ".strtoupper($_GET['branch_name']);

    $sql = "SELECT staffs.staff_id,staffs.staff_name,branches.branch_name FROM staffs left join branches on branches.branch_id=staffs.branch_id where staffs.branch_id='$branch_id'";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>staff list</title>
</head>
<body>

  <div>
   
     <!-- ---------------------- TABLE HEAD------------------------------ -->
    <div class="col-md-12">
    <div class="container">
    <div class="col-lg-4" ><input class="form-control" placeholder="Search" id="myInput" type="text" style="width: 10vw; *background-color: white; margin-top: 1vw; color: black;">   </div>
    <div class="col-lg-6" > </div>
    <div class="col-lg-8" style="text-align:  right;"><button class="btn btn-danger"  onclick="print_page()">PRINT ALL STAFF</button>
    </div> 
    </div>
  
    <!-- ---------------------- TABLE HEAD------------------------------ -->

    <div id="printableArea"  class="col-md-12" >
      <h3 style="text-align: center;"><b>EMPLOYEES LIST </b></h3>
      <table border="1" class="table table-hover" style="text-align: center;">
         <tr class="warning active">  
          <th>STAFF NO</th>
          <th>STAFF NAME</th>
          <th>BRANCH </th>
          <th>SALARY </th>
          <th>AMOUNT LIMIT </th>
           <th>CREDIT LIMIT</th>
           <th>STAFF STOCK</th>
           <th>area</th>
           <th>staff_ta</th>
           <th>staff_allowance</th>
           <th>advance_limit</th>
           <th>staff_incentive</th>
           <th>first_name</th>
           <th>category</th>
      <!--     <th>SALES</th>
          <th>MARGIN</th>
          <th>PAID</th>

          <th>BALANCE</th> -->
          <!-- <th> </th> -->
          
         
        </tr>
      
      <tbody id="table">
<?php
      $query=mysqli_query($conn,$sql);

  if (!$query) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
    }
      while($fetch=mysqli_fetch_array($query))
      {
       $staff_id=$fetch["staff_id"];
       $staff_name=$fetch["staff_name"];
       $branch_name=$fetch["branch_name"];
       $branch_id=$fetch["branch_id"];
$salary=$fetch["salary"];
$area=$fetch["area"];
$first_name=$fetch["first_name"];
$category=$fetch["category"];
if($category==1){
  $category="STAFF";
}
else
{
  $category="AGENT";
}
$staff_ta=$fetch["staff_ta"];
$staff_allowance=$fetch["staff_allowance"];
$advance_limit=$fetch["advance_limit"];
$staff_incentive=$fetch["staff_incentive"];
$amount_limit=$fetch["amount_limit"];
$credit_amount=$fetch["credit_amount"];
$staff_stock=$fetch["staff_stock"];
$sales=$fetch["sales"];
$paid=$fetch["paid"];
$balance=$sales-$paid;
   $profit=$fetch["profit"];
      //  $fetch=mysqli_fetch_array(mysqli_query($conn,"SELECT COUNT(staff_id) AS orders FROM sales WHERE staff_id='$staff_id"))
      // $orders=$fetch["orders"];
       
 ?>
   <tr onclick="editStaff('<?php echo $staff_id;?>');">
     <td onclick="delete_staff('<?php echo $staff_id;?>')"> <?php echo $staff_id;?> </td>
     <td> <?php echo $staff_name;?> </td>
     <td>
      <a href="view_staff.php?branch_id=<?php echo $branch_id ?>&branch_name=<?php echo $branch_name?>"> <?php echo $branch_name;?> </a> </td>
      <td style="cursor: pointer;"> <?php echo $salary;?> </td>
      <td style="cursor: pointer;"> <?php echo $amount_limit;?></a> </td>
      <td style="cursor: pointer;"> <?php echo $credit_amount;?> </td>
      <td style="cursor: pointer;"> <?php echo $staff_stock;?> </td>
      <td style="cursor: pointer;"> <?php echo $area;?> </td>
      <td style="cursor: pointer;"> <?php echo $staff_ta;?> </td>
      <td style="cursor: pointer;"> <?php echo $staff_allowance;?> </td>
      <td style="cursor: pointer;"> <?php echo $advance_limit;?> </td>
      <td style="cursor: pointer;"> <?php echo $staff_incentive;?> </td>
      <td style="cursor: pointer;"> <?php echo $first_name;?> </td>
      <td style="cursor: pointer;"> <?php echo $category;?> </td>
<!--       <td style="cursor: pointer;"> <?php echo $sales;?> </td>
     <td style="cursor: pointer;"> <?php echo $profit;?> </td>
     <td style="cursor: pointer;"> <?php echo $paid;?> </td>
     <td style="cursor: pointer;"> <?php echo $balance;?> </td> -->

     
   </tr>
    <?php

}
?>
</tbody>
</table>
</div>
<div class="col-lg-6" style="display: none;"> 
  <h3 style="text-align: center;"><b>STAFF ORDERS <?php  echo $category;?> </b></h3>
      <table border="1" class="table-condensed table table-striped"  id="kit_table" style=" border-width: 2px; ">
        <thead >
         <tr>
          <th>STAFF NO:</th>
          <th>STAFF NAME:</th>
          <th>BRANCH NAME:</th>
          <th>ORDERS:</th>
          <th>SALES:</th>
          <th>MARGIN:</th>
        </tr>
        </thead>
      <tbody id="table">
<?php
      $query=mysqli_query($conn,$sql);

      while($fetch=mysqli_fetch_array($query))
      {
       $staff_id=$fetch["staff_id"];
       $staff_name=$fetch["staff_name"];
       $orders=$fetch["orders"];
       $sales=$fetch["sales"];

       
      
       
 ?>
   <tr onclick= "edit_category('<?php echo $staff_id;?>');">
     <td> <?php echo $staff_id;?> </td>
     <td> <?php echo $staff_name;?> </td>
   
     <td>
      <a href="view_staff.php?branch_id=<?php echo $branch_id ?>&branch_name=<?php echo $branch_name?>"> <?php echo $branch_name;?> </a> 
    
    </td>
       <td> <?php echo $staff_name;?> </td>
     <td> <?php echo $staff_name;?> </td>
     
   </tr>
    <?php

}
?>
</tbody>
</table>
</div>
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
<script type="text/javascript">
  function delete_staff(staff_id)
   {


swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this imaginary file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Poof! Your imaginary file has been deleted!", {

      icon: "success",
    });
     $.ajax({
      type:"POST",
      url:"../delete/delete_staff.php",
      data:{
        staff_id:staff_id
      },
      success:function(data)
      {


        location.href = "http://localhost/stock/view/view_staff.php";
        
      }

    });
  } 
  else {
    swal("Your imaginary file is safe!");
  }
});

   
  }
</script>
<script type="text/javascript">
  function editStaff(staff_id)
  {
    // alert(article_id);
    location.href ="../edit/staff_edit.php?staff_id="+staff_id;
  }
</script>
</body>
</html>