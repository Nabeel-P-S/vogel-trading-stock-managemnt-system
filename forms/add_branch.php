<?php 

    $query=mysqli_query($conn,"select branch_id from branches order by branch_id desc LIMIT 1
     ");
    $fetch=mysqli_fetch_array($query);
     $branch_id=$fetch['branch_id']+1;?>
<form class="form-group">
<fieldset>

<!-- Form Name -->
<legend>ADD BRANCH    <p style="float: right;">No : <?php echo $branch_id ?> </p> </legend>    

<link rel="stylesheet" type="text/css" href="../css/sweetalert.css"><label hidden="">invalid</label>
<script src="../sweetalert.min.js"></script>
<!-- Text input-->

<div class="form-group" style="display: none;">
 <div class="input-group">
    <span class="input-group-addon">BRANCH ID</span>
    <input id="branch_id" type="text" class="form-control" name="branch_id" value="<?php echo $branch_id?>" >
  </div></div>





<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">BRANCH NAME</span>
    <input id="branch_name" type="text" class="form-control" name="branch_name" placeholder=" NAME"  >
  </div></div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="save"></label>
  <div class="col-md-4">
    <br>
    <button id="save" name="save" onclick="save_branch()" class="btn btn-success">SAVE BRANCH</button>
  </div>
</div>

</fieldset>
</form>
  <script type="text/javascript">
          function save_branch()
          {

  alert(" BRANCH INSERTED");

            var branch_id=document.getElementById("branch_id").value;
            var branch_name=document.getElementById("branch_name").value;
         
            swal("Branch"+" "+branch_name+" "+"Inserted");
            if(branch_id=="")
            {       
               // swal("ERROR","Enter Vogel No ","error");
               alert("error");

             }
          
else{
            $.ajax( 
            {

              type:"POST",
              url:"../insert/branch_insert.php",
          
              data:{
                branch_id:branch_id,
                branch_name:branch_name
               
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
