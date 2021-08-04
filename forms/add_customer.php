<?php 

    $query=mysqli_query($conn,"select customer_id from customers order by customer_id desc LIMIT 1
     ");
    $fetch=mysqli_fetch_array($query);
     $customer_id=$fetch['customer_id']+1;
     ?>
<form class="form-group">
<fieldset>

<!-- Form Name -->
<legend>ADD CUSTOMER    <p style="float: right;">No : <?php echo $customer_id ?> </p> </legend>    


<!-- Text input-->

<div class="form-group" style="display: none;">
 <div class="input-group">
    <span class="input-group-addon">CUSTOMER ID</span>
    <input id="customer_id" type="text" class="form-control" name="customer_id" value="<?php echo $customer_id?>" >
  </div></div>





<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon"> NAME</span>
    <input id="customer_name" type="text" class="form-control" name="customer_name" placeholder="NAME"  >
  </div></div>

<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon"> ADDRESS</span>
    <input id="customer_address" type="text" class="form-control" name="customer_address" placeholder="ADDRESS"  >
  </div></div>

  <div class="form-group">
 <div class="input-group">
    <span class="input-group-addon"> PHONE</span>
    <input id="customer_phone" type="number" class="form-control" name="customer_phone" placeholder="PHONE"  >
  </div></div>
  <div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">GST NUMBER</span>
    <input id="customer_gst" type="text" class="form-control" name="customer_gst" placeholder="GST No"  >
  </div></div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="save"></label>
  <div class="col-md-4">
    <br>
    <button id="save" name="save" onclick="save_customer()" class="btn btn-success">SAVE CUSTOMER</button>
  </div>
</div>

</fieldset>
</form>
  <script type="text/javascript">
          function save_customer()
          {
 alert(" CUSTOMER INSERTED");

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
              url:"../insert/customer_insert.php",
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
                    alert(data);
                    // alert("success");

                    // document.getElementById('item_id').value=data.item_id;
                       // alert(data.item_id);
                      

                     }    
                   });



          }

          }
        </script>
