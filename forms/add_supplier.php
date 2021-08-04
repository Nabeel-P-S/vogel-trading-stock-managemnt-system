<?php 

            $query=mysqli_query($conn,"select supplier_id from suppliers order by supplier_id desc LIMIT 1
             ");
            $fetch=mysqli_fetch_array($query);
             $supplier_id=$fetch['supplier_id']+1;
?>

<form class="form-group">
<fieldset>

<!-- Form Name -->
<legend>ADD SUPPLIER    <p style="float: right;">No : <?php echo $supplier_id ?> </p> </legend>    


<!-- Text input-->

<div class="form-group" style="display: none;">
 <div class="input-group">
    <span class="input-group-addon">SUPPLIER ID </span>
    <input id="supplier_id" type="text" class="form-control" name="supplier_id" value="<?php echo $supplier_id?>" >
  </div></div>





<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">SUPPLIER NAME</span>
    <input id="supplier_name" type="text" class="form-control" name="supplier_name" placeholder="SUPPLIER NAME"  >
  </div></div>

<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">SUPPLIER ADDRESS</span>
    <input id="supplier_address" type="text" class="form-control" name="supplier_address" placeholder="SUPPLIER ADDRESS"  >
  </div></div>

  <div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">SUPPLIER PHONE</span>
    <input id="supplier_phone" type="number" class="form-control" name="supplier_phone" placeholder="SUPPLIER PHONE"  >
  </div></div>
  <div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">SUPPLIER GST</span>
    <input id="supplier_gst" type="text" class="form-control" name="supplier_gst" placeholder="SUPPLIER GST">
  </div></div>
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="save"></label>
  <div class="col-md-4">
    <br>
    <button id="save" name="save" onclick="save_supplier()" class="btn btn-success">SAVE SUPPLIER</button>
  </div>
</div>

</fieldset>
</form>
  <script type="text/javascript">
          function save_supplier()
          {

 alert(" SUPPLIER INSERTED");




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
              url:"../insert/supplier_insert.php",
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
                    alert(data);

          

                     }    
                   });



          }

          }
        </script>
