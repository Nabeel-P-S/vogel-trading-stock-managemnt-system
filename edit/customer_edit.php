<?php include "../connect.php";
include("../main/navbar.php");
$customer_id=$_GET['customer_id'];
$query=mysqli_query($conn,"SELECT * from customers where customer_id='$customer_id'");
$fetch=mysqli_fetch_array($query);
$customer_id=$fetch['customer_id'];
$customer_name=$fetch['customer_name'];
$customer_address=$fetch['customer_address'];
$customer_phone=$fetch['customer_phone'];
$customer_gst=$fetch['customer_gst'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>customer list</title>
</head>
<body>
<div class="col-md-12">
<div class="col-md-4"><form class="form-group">

  <br>
  <br>
  <br>
<fieldset>

<!-- Form Name -->
<legend>EDIT customer    <p style="float: right;">  <?php echo $customer_id ?> </p> </legend>    


<!-- Text input-->

<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">customer ID </span>
    <input id="customer_id" type="text" class="form-control" name="customer_id" value="<?php echo $customer_id?>" >
  </div></div>





<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">customer NAME</span>
    <input id="customer_name" type="text" class="form-control" name="customer_name" value="<?php echo $customer_name?>" >
 
  </div></div>

<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">customer ADDRESS</span>
    <input id="customer_address" type="text" class="form-control" name="customer_address" value="<?php echo $customer_address?>" >
  
  </div></div>

  <div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">customer PHONE</span>
    <input id="customer_phone" type="number" class="form-control" name="customer_phone" value="<?php echo $customer_phone?>" >
    
  </div></div>
  <div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">customer GST</span>
    <input id="customer_gst" type="text" class="form-control" name="customer_gst" value="<?php echo $customer_gst?>" >
 
  </div></div>
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="save"></label>
  <div class="col-md-4">
    <br>
    <button id="save" name="save" onclick="update_customer()" class="btn btn-danger">SAVE customer</button>
  </div>
</div>

</fieldset>
</form> </div>
<div class="col-md-8"> <div >
   
     <!-- ---------------------- TABLE HEAD------------------------------ -->
    <div class="col-md-12">
    <div class="container">
    <div class="col-lg-4" ><input class="form-control" placeholder="Search" id="myInput" type="text" style="width: 10vw; *background-color: white; margin-top: 1vw; color: black;">   </div>
    <div class="col-lg-6" style="float: right;"><button class="btn btn-danger"  onclick="print_page()">PRINT customerS</button>
    </div>  </div>
  
    </div>
    <!-- ---------------------- TABLE HEAD------------------------------ -->

    <div id="printableArea"  class="col-md-12" >
      <h3 style="text-align: center;"><b>customer LIST </b></h3>
      <table border="1" class="table-condensed table table-hover" >
        <thead >



          

          <tr class="table_head">
<th style="*width: 5vw;"> NO:</th>
<th style="*width: 5vw;">customer :</th>
<th style="*width: 5vw;"> ADDRESS:</th>
<th style="*width: 5vw;"> PHONE:</th>
<th style="*width: 5vw;"> GST:</th>
<th></th>

</tr>

</thead>
<tbody id="table">
  <?php
  $query=mysqli_query($conn,"SELECT * FROM `customers`");
  while($fetch=mysqli_fetch_array($query))
  {
   $customer_id=$fetch["customer_id"];
   $customer_name=$fetch["customer_name"];
   $customer_address=$fetch["customer_address"];
   $customer_phone=$fetch["customer_phone"];
   $customer_gst=$fetch["customer_gst"];
   
  
   
   ?>
   <tr class="table_row">
     <td onclick="delete_customer('<?php echo $customer_id;?>')" style="cursor: pointer;" > <?php echo $customer_id;?> </td>
     <td style="cursor: pointer;"> <?php echo $customer_name;?> </td>
     <td style="cursor: pointer;"> <?php echo $customer_address;?> </td>
     <td style="cursor: pointer;"> <?php echo $customer_phone;?> </td>
     <td style="cursor: pointer;"> <?php echo $customer_gst;?> </td>
 <td><button  " class="btn"> <a href="../edit/customer_edit.php?customer_id=<?php echo $customer_id;?>"> EDIT</a></button></td>
     
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
          function update_customer()
          {
 alert(" CUSTOMER UPDATED");

            var customer_id=document.getElementById("customer_id").value;
            var customer_name=document.getElementById("customer_name").value;
            var customer_address=document.getElementById("customer_address").value;
            var customer_phone=document.getElementById("customer_phone").value;
            var customer_gst=document.getElementById("customer_gst").value;
            
            if(customer_id=="")
            {       
               // swal("ERROR","Enter Vogel No ","error");
               alert("error");

             }
          
else{
            $.ajax( 
            {

              type:"POST",
              url:"../update/customer_update.php",
              // dataType:"json",
              data:{
                customer_id:customer_id,
                customer_name:customer_name,
                customer_address:customer_address,
                customer_gst:customer_gst,
                customer_phone:customer_phone
              },

              success: function(data)

              {
                  
                      
 location.href = "../view/view_customer.php";

                     }    
                   });



          }

          }
        </script>