<?php include "../connect.php";
include("../main/navbar.php");
$supplier_id=$_GET['supplier_id'];
$query=mysqli_query($conn,"SELECT * from suppliers where supplier_id='$supplier_id'");
$fetch=mysqli_fetch_array($query);
$supplier_id=$fetch['supplier_id'];
$supplier_name=$fetch['supplier_name'];
$supplier_address=$fetch['supplier_address'];
$supplier_phone=$fetch['supplier_phone'];
$supplier_gst=$fetch['supplier_gst'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>SUPPLIER list</title>
</head>
<body>
<div class="col-md-12">
<div class="col-md-4"><form class="form-group">

  <br>
  <br>
  <br>
<fieldset>

<!-- Form Name -->
<legend>EDIT SUPPLIER    <p style="float: right;">  <?php echo $supplier_id ?> </p> </legend>    


<!-- Text input-->

<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">SUPPLIER ID </span>
    <input id="supplier_id" type="text" class="form-control" name="supplier_id" value="<?php echo $supplier_id?>" >
  </div></div>





<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">SUPPLIER NAME</span>
    <input id="supplier_name" type="text" class="form-control" name="supplier_name" value="<?php echo $supplier_name?>" >
 
  </div></div>

<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">SUPPLIER ADDRESS</span>
    <input id="supplier_address" type="text" class="form-control" name="supplier_address" value="<?php echo $supplier_address?>" >
  
  </div></div>

  <div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">SUPPLIER PHONE</span>
    <input id="supplier_phone" type="number" class="form-control" name="supplier_phone" value="<?php echo $supplier_phone?>" >
    
  </div></div>
  <div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">SUPPLIER GST</span>
    <input id="supplier_gst" type="text" class="form-control" name="supplier_gst" value="<?php echo $supplier_gst?>" >
 
  </div></div>
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="save"></label>
  <div class="col-md-4">
    <br>
    <button id="save" name="save" onclick="update_supplier()" class="btn btn-info">UPDATE SUPPLIER</button>
  </div>
</div>

</fieldset>
</form> </div>
<div class="col-md-8"> <div >
   
     <!-- ---------------------- TABLE HEAD------------------------------ -->
    <div class="col-md-12">
    <div class="container">
    <div class="col-lg-4" ><input class="form-control" placeholder="Search" id="myInput" type="text" style="width: 10vw; *background-color: white; margin-top: 1vw; color: black;">   </div>
    <div class="col-lg-6" style="float: right;"><button class="btn btn-danger"  onclick="print_page()">PRINT SUPPLIERS</button>
    </div>  </div>
  
    </div>
    <!-- ---------------------- TABLE HEAD------------------------------ -->

    <div id="printableArea"  class="col-md-12" >
      <h3 style="text-align: center;"><b>SUPPLIER LIST </b></h3>
      <table border="1" class="table-condensed table table-hover" >
        <thead >



          

          <tr class="table_head">
<th style="*width: 5vw;"> NO:</th>
<th style="*width: 5vw;">SUPPLIER :</th>
<th style="*width: 5vw;"> ADDRESS:</th>
<th style="*width: 5vw;"> PHONE:</th>
<th style="*width: 5vw;"> GST:</th>
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
 <td><button  " class="btn"> <a href="../edit/supplier_edit.php?supplier_id=<?php echo $supplier_id;?>"> EDIT</a></button></td>
     
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
          function update_supplier()
          {

 




            var supplier_id=document.getElementById("supplier_id").value;
            var supplier_name=document.getElementById("supplier_name").value;
            var supplier_address=document.getElementById("supplier_address").value;
            var supplier_gst=document.getElementById("supplier_gst").value;
            var supplier_phone=document.getElementById("supplier_phone").value;
            
            // alert(supplier_id+supplier_name+supplier_gst);
            if(supplier_name=="")
            {       
               // swal("ERROR","Enter Vogel No ","error");
               alert("Enter supplier Name");

             }
          
else{
            $.ajax( 
            {

              type:"POST",
              url:"../update/supplier_update.php",
              // dataType:"json",
              data:{
                supplier_id:supplier_id,
                supplier_name:supplier_name,
                supplier_address:supplier_address,
                supplier_gst:supplier_gst,
                supplier_phone:supplier_phone
              },

              success: function(data)

              {
                   location.href = "../view/view_supplier.php";

          

                     }    
                   });



          }

          }
        </script>