<?php
include '../connect.php';
include("../main/navbar.php")
?>
<!DOCTYPE html>
<html>
<head>
  <title>CUSTOMER list</title>
</head>
<body>
 <div class="container" style="*background-image: linear-gradient(180deg, rgb(1, 88, 96,.5), #002437); height: 42vw;">
     
     <!-- ---------------------- TABLE HEAD------------------------------ -->
    <div class="col-md-12">
    <div class="container">
    <div class="col-lg-4" ><input class="form-control" placeholder="Search" id="myInput" type="text" style="width: 10vw; *background-color: white; margin-top: 1vw; color: black;">   </div>
    <div class="col-lg-6" > </div>
    <div class="col-lg-8" style="text-align:  right;"><button class="btn btn-danger"  onclick="print_page()">PRINT CUSTOMERS</button>
    </div> 
    </div>
    </div>
    <!-- ---------------------- TABLE HEAD------------------------------ -->

    <div id="printableArea"  class="col-md-12" >
      <h3 style="text-align: center;"><b>CUSTOMER LIST </b></h3>
      <table border="1" class="table-condensed table table-hover" >
        <thead >



          

          <tr class="table_head">
<th style="*width: 5vw;">CUSTOMER NO:</th>
<th style="*width: 5vw;">CUSTOMER NAME:</th>
<th style="*width: 5vw;">CUSTOMER ADDRESS:</th>
<th style="*width: 5vw;">CUSTOMER PHONE:</th>
<th style="*width: 5vw;">GST</th>
<th></th>

</tr>

</thead>
<tbody id="table">
  <?php
  $query=mysqli_query($conn,"SELECT * FROM `customers` order by customer_id desc");
  while($fetch=mysqli_fetch_array($query))
  {
   $customer_id=$fetch["customer_id"];
   $customer_name=$fetch["customer_name"];
   $customer_address=$fetch["customer_address"];
   $customer_phone=$fetch["customer_phone"];
   $customer_gst=$fetch["customer_gst"];
   
  
   
   ?>
   <tr onclick= "edit_category('<?php echo $customer_id;?>');">
     <td onclick="delete_customer('<?php echo $customer_id;?>')" style="cursor: pointer;" > <?php echo $customer_id;?> </td>
     <td style="cursor: pointer;"> <?php echo $customer_name;?> </td>
     <td style="cursor: pointer;"> <?php echo $customer_address;?> </td>
     <td style="cursor: pointer;"> <?php echo $customer_phone;?> </td>
     <td style="cursor: pointer;"> <?php echo $customer_gst;?> </td>
 <td><button   class="btn"> <a href="../edit/customer_edit.php?customer_id=<?php echo $customer_id;?>"> EDIT</a></button></td>

     
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