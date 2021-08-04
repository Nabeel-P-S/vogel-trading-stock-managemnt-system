<fieldset>

<!-- Form Name -->
<legend>ADD CUSTOMER</legend>
<?php 

    $query=mysqli_query($conn,"select customer_id from customers order by customer_id desc LIMIT 1
     ");
    $fetch=mysqli_fetch_array($query);
     $customer_id=$fetch['customer_id']+1;?>

<!-- Text input-->

<div class="form-group">
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
    <button id="save" name="save" onclick="save_customer()" class="btn btn-danger">SAVE CUSTOMER</button>
  </div>
</div>

</fieldset>