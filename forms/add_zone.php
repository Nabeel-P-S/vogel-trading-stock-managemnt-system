<?php 

    $query=mysqli_query($conn,"select zone_id from zones order by zone_id desc LIMIT 1
     ");
    $fetch=mysqli_fetch_array($query);
     $zone_id=$fetch['zone_id']+1;?>
<form class="form-group">
<fieldset>

<!-- Form Name -->
<legend>ADD zone    <p style="float: right;">No : <?php echo $zone_id ?> </p> </legend>    

<link rel="stylesheet" type="text/css" href="../css/sweetalert.css"><label hidden="">invalid</label>
<script src="../sweetalert.min.js"></script>
<!-- Text input-->

<div class="form-group" style="display: none;">
 <div class="input-group">
    <span class="input-group-addon">zone ID</span>
    <input id="zone_id" type="text" class="form-control" name="zone_id" value="<?php echo $zone_id?>" >
  </div></div>





<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">zone NAME</span>
    <input id="zone_name" type="text" class="form-control" name="zone_name" placeholder=" NAME"  >
  </div></div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="save"></label>
  <div class="col-md-4">
    <br>
    <button id="save" name="save" onclick="save_zone()" class="btn btn-success">SAVE zone</button>
  </div>
</div>

</fieldset>
</form>
  <script type="text/javascript">
          function save_zone()
          {

  alert(" zone INSERTED");

            var zone_id=document.getElementById("zone_id").value;
            var zone_name=document.getElementById("zone_name").value;
         
            swal("zone"+" "+zone_name+" "+"Inserted");
            if(zone_id=="")
            {       
               // swal("ERROR","Enter Vogel No ","error");
               alert("error");

             }
          
else{
            $.ajax( 
            {

              type:"POST",
              url:"../insert/zone_insert.php",
          
              data:{
                zone_id:zone_id,
                zone_name:zone_name
               
              },

              success: function(data)

              {
 
                     
                    // alert("success");

                    // document.getElementById('item_id').value=data.item_id;
                       // alert(data.item_id);
                      

                     }    
                   });



          }

          }
        </script>
