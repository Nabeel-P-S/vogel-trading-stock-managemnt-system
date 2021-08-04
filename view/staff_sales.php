<?php
include '../connect.php';
include("../main/navbar.php")
?>
<!DOCTYPE html>
<html>
<head>
  <title>BRANCH SALES</title>
</head>
<body>
 <div class="container">
     
     <!-- ---------------------- TABLE HEAD------------------------------ -->
    <div class="col-md-12">
    <div class="container">
    <div class="col-lg-4" ><input class="form-control" placeholder="Search" id="myInput" type="text" style="width: 10vw;margin-top: 1vw; color: black;">   </div>
    <div class="col-lg-6" > </div>
    <div class="col-lg-8" style="text-align:  right;"><button class="btn btn-danger"  onclick="print_page()">PRINT</button>
    </div> 
    </div>
    </div>
    <!-- ---------------------- TABLE HEAD------------------------------ -->

    <div id="printableArea"  class="col-md-12" >
      <h3 style="text-align: center;"><b>STAFF SALES </b></h3>
      <table border="1" class="table">
        <thead class="thead-dark" >



          

          <tr>
<th>STAFF NO:</th>
<th>STAFF NAME:</th>
<!-- <th>SELL QTY:</th> -->
<th>SALES:</th>
<th>MARGIN:</th>


</tr>

</thead>
<tbody id="table">
  <?php
  $sql="SELECT staffs.staff_id,
       staffs.staff_name,
       Sum(sales.sales) as sales,
       Sum(sales.profit) as profit
FROM   staffs
       LEFT JOIN sales
              ON sales.staff_id = staffs.staff_id
       LEFT JOIN sales_articles
              ON sales_articles.sales_id = sales.sales_id
GROUP  BY staffs.staff_id";
  $query=mysqli_query($conn,$sql);
  while($fetch=mysqli_fetch_array($query))
  {
   $staff_id=$fetch["staff_id"];
   $staff_name=$fetch["staff_name"];
   $sales=$fetch["sales"];
   $profit=$fetch["profit"];

   
  
   
   ?>
   <tr class="table_row">
     <td style="cursor: pointer;" > <?php echo $staff_id;?> </td>
     <td style="cursor: pointer;"> <?php echo $staff_name;?> </td>
     <td style="cursor: pointer;"> <?php echo $sales;?> </td>
     <td style="cursor: pointer;"> <?php echo $profit;?> </td>
     
     
   </tr>
    <?php

}
?>
</tbody>
</table>
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
  function delete_customer(customer_id)
   {


swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this data!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Poof!  customer deleted!", {

      icon: "success",
    });
     $.ajax({
      type:"POST",
      url:"../delete/delete_customer.php",
      data:{
        customer_id:customer_id
      },
      success:function(data)
      {


        location.href = "http://localhost/stock/view/view_customer.php";
        
      }

    });
  } 
  else {
    swal("Your detail is safe!");
  }
});

   
  }
</script>
</body>
</html>