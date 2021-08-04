<form class="form-group">
<fieldset>

<!-- Form Name -->
<legend>ADD SALES</legend>
<?php 
include ("connect.php");
    $query=mysqli_query($conn,"select sales_id from saless order by sales_id desc LIMIT 1
     ");
    $fetch=mysqli_fetch_array($query);
     $sales_id=$fetch['sales_id']+1;?>

<!-- Text input-->
<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">sales DATE</span>
    <input id="sales_date" type="text" class="form-control" name="sales_date" value="<?php echo $date?>"  >
  </div></div>
<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">sales NO</span>
    <input id="sales_id" type="text" class="form-control" name="sales_id" value="<?php echo $sales_id?>" >
  </div></div>
<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">ARTICLE NO</span>
    <input id="article_id" type="text" class="form-control" name="article_id" placeholder="articleNO">


  </div></div>
<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon">INVOICE NO</span>
    <input id="invoice_no" type="text" class="form-control" name="invoice_no" placeholder="INVOICE NO">
  </div></div>

<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">customer NO</span>

 <select id="customer_id"  name="customer_id"  class="form-control">
                  <option style="color: grey" value="" >select customer</option>
                  <?php  
                  $query=mysqli_query($conn,"SELECT * from customers");
                  while($fetch=mysqli_fetch_array($query))
                  {
                    ?>
                    <option value="<?php echo $fetch ['customer_id']; ?>"><?php echo $fetch ['customer_name'];?> </option>
                    <?php
                  }
                  ?> 
                </select>    
  </div></div>

<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">sales PRICE</span>
    <input id="sales_price" type="text" class="form-control" name="sales_price" placeholder="sales PRICE"  >
  </div></div>

 
<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">ARTICLE QTY</span>
        <input id="article_qty" type="text" class="form-control" name="article_qty" placeholder="sales Qty"  >

  </div>
</div>
<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">Branch</span>
    <input list="branches" id="branch_id" name="branches" placeholder="Start your search" class="form-control">
<datalist id="branches">
   <option style="color: grey" value="" >select Branch</option>
                  <?php  
                  $query=mysqli_query($conn,"SELECT * from branches");
                  while($fetch=mysqli_fetch_array($query))
                  {
                    ?>
                    <option value="<?php echo $fetch ['branch_id']; ?>"><?php echo $fetch ['branch_name'];?> </option>
                        <?php
                  }
                  ?> 
</datalist>



    <span class="input-group-addon">Staff</span>
   <input list="staffs" id="staff_id" class="form-control" name="myAdventure" placeholder="Start your search" >
<datalist id="staffs">
   <option style="color: grey" value="" >select Staff</option>
                  <?php  
                  $query=mysqli_query($conn,"SELECT * from staffs");
                  while($fetch=mysqli_fetch_array($query))
                  {
                    ?>
                    <option value="<?php echo $fetch ['staff_id']; ?>"><?php echo $fetch ['staff_name'];?> </option>
                        <?php
                  }
                  ?> 
</datalist>   </div></div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="save"></label>
  <div class="col-md-4">
    <br>
    <button id="save" name="save"  onclick="save_sales()" class="btn btn-info">SAVE</button>
  </div>
</div>

</fieldset>
</form>
  <script type="text/javascript">
          function save_sales()
          {

            var sales_date=document.getElementById("sales_date").value;
            var sales_id=document.getElementById("sales_id").value;
            var article_id=document.getElementById("article_id").value;
            var invoice_no=document.getElementById("invoice_no").value;
            var customer_id=document.getElementById("customer_id").value;
            var article_qty=document.getElementById("article_qty").value;
            var branch_id=document.getElementById("branch_id").value;
            var staff_id=document.getElementById("staff_id").value;
            alert(article_qty);
     
            $.ajax( 
            {

              type:"POST",
              url:"insert/sales_insert.php",
              // dataType:"json",
              data:{
                sales_date:sales_date,
                sales_id:sales_id,
                article_id:article_id,
                invoice_no:invoice_no,
                customer_id:customer_id,
                sales_price:sales_price,
                branch_id:branch_id,
                staff_id:staff_id,
                article_qty:article_qty
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


        </script>
