<?php
include '../connect.php';
include("../main/navbar.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>SUPPLIER LIST</title>
</head>
<body>

  <div class="container">
   
     <!-- ---------------------- TABLE HEAD------------------------------ -->
    <div class="col-md-12">
    <div class="container">
    <div class="col-lg-4" ><input class="form-control" placeholder="Search" id="myInput" type="text" style="width: 10vw; *background-color: white; margin-top: 1vw; color: black;">   </div>
    <div class="col-lg-6" > </div>
    <div class="col-lg-8" style="text-align:  right;"><button class="btn btn-danger"  onclick="print_page()">PRINT SUPPLIERS</button>
    </div> 
    </div>
    </div>
    <!-- ---------------------- TABLE HEAD------------------------------ -->

    <div id="printableArea"  class="col-md-12" >
      <h3 style="text-align: center;"><b>SUPPLIER LIST </b></h3>
      <table border="1" class="table-condensed table table-hover" >
        <thead >



          

          <tr class="table_head">
<th style="*width: 5vw;">SUPPLIER NO:</th>
<th style="*width: 5vw;">SUPPLIER NAME:</th>
<th style="*width: 5vw;">SUPPLIER ADDRESS:</th>
<th style="*width: 5vw;">SUPPLIER PHONE:</th>
<th style="*width: 5vw;">SUPPLIER GST:</th>
<th></th>

</tr>

</thead>
<tbody id="table">
  <?php
  $query=mysqli_query($conn,"SELECT * FROM `suppliers`");
  while($fetch=mysqli_fetch_array($query))
  {
   $supplier_id=$fetch["supplier_id"];
   $supplier_name=$fetch["supplier_name"];
   $supplier_address=$fetch["supplier_address"];
   $supplier_phone=$fetch["supplier_phone"];
   $supplier_gst=$fetch["supplier_gst"];
   
  
   
   ?>
   <tr class="table_row">
     <td onclick="delete_supplier('<?php echo $supplier_id;?>')" style="cursor: pointer;" > <?php echo $supplier_id;?> </td>
     <td style="cursor: pointer;"> <?php echo $supplier_name;?> </td>
     <td style="cursor: pointer;"> <?php echo $supplier_address;?> </td>
     <td style="cursor: pointer;"> <?php echo $supplier_phone;?> </td>
     <td style="cursor: pointer;"> <?php echo $supplier_gst;?> </td>
 <td><button class="btn-md btn-warning"> <a href="../edit/supplier_edit.php?supplier_id=<?php echo $supplier_id;?>"> EDIT</a></button></td>
     
   </tr>
    <?php

}
?>
</tbody>
</table>
</div>
</div>


</body>
</html>
<script type="text/javascript">
  function edit_supplier(supplier_id)
   {
    // alert(vendor_id);
    $.ajax({
      type:"POST",
      url:"../edit/supplier_edit.php",
      data:{
        supplier_id:supplier_id
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
  function delete_supplier(supplier_id)
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
    swal("Poof!  supplier deleted!", {

      icon: "success",
    });
     $.ajax({
      type:"POST",
      url:"../delete/delete_supplier.php",
      data:{
        supplier_id:supplier_id
      },
      success:function(data)
      {


        location.href = "http://localhost/stock/view/view_supplier.php";
        
      }

    });
  } 
  else {
    swal("Your detail is safe!");
  }
});

   
  }
</script>