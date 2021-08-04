<form class="form-group">
<fieldset>

<!-- Form Name -->
<legend>ADD SALES</legend>
<?php 
include ("connect.php");
    $query=mysqli_query($conn,"select sales_id from sales order by sales_id desc LIMIT 1");
    $fetch=mysqli_fetch_array($query);
     $sales_id=$fetch['sales_id']+1;
     ?>

<!-- Text input-->
<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">SALES DATE</span>
    <input id="sales_date" type="text" class="form-control" name="sales_date" value="<?php echo $date?>"  >
  </div></div>
<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">SALES NO</span>
    <input id="sales_id" type="text" class="form-control" name="sales_id" value="<?php echo $sales_id?>" >
  </div></div>
<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">ARTICLE NO</span>

 <select id="sales_article_id"  name="sales_article_id"  class="form-control">
                  <option style="color: grey" value="" >SELECT ARTICLE</option>
                  <?php  
                  $query=mysqli_query($conn,"SELECT * from articles");
                  while($fetch=mysqli_fetch_array($query))
                  {
                    ?>
                    <option value="<?php echo $fetch ['article_id']; ?>"><?php echo $fetch ['article_name'];?> </option>
                    <?php
                  }
                  ?> 
                </select>   

  </div></div>
<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon">INVOICE NO</span>
    <input id="sales_invoice_no" type="text" class="form-control" name="invoice_no" placeholder="INVOICE NO">
  </div></div>

<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">CUSTOMER</span>

 <select id="sales_customer_id"  name="customer_id"  class="form-control">
                  <option style="color: grey" value="" >SELECT CUSTOMER</option>
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
    <span class="input-group-addon">SALES PRICE</span>
    <input id="sales_price" type="text" class="form-control" name="sales_price" placeholder="SALES PRICE"  >
  </div></div>

 
<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">ARTICLE QTY</span>
        <input id="sales_article_qty" type="text" class="form-control" name="article_qty" placeholder="SALES Qty"  >

  </div>
</div>

<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">BRANCH</span>
    <input list="branches" id="branch_id" name="branch_id" placeholder="SEARH BRANCH" class="form-control">
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



    <span class="input-group-addon">STAFF</span>
   <input list="staffs" id="staff_id" class="form-control" name="staff_id" placeholder="SEARCH STAFF" >
<datalist id="staffs">
   <option style="color: grey" value="" >SELECT STAFF</option>
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
  <div class="col-md-2">
    <br>
    <button id="save" name="save"  onclick="save_sales()" class="btn btn-danger">SAVE SALES</button>
  </div>  
  <div class="col-md-2">
    <br>
    <button id="save" name="save"  class="btn btn-default"> <a href="print/sales_bill.php" >PRINT</a></button>
  </div>
</div>

</fieldset>
</form>
  <script type="text/javascript">
          function save_sales()
          {

            var sales_date=document.getElementById("sales_date").value;
            var sales_id=document.getElementById("sales_id").value;
            var sales_article_id=document.getElementById("sales_article_id").value;
            var sales_invoice_no=document.getElementById("sales_invoice_no").value;
            var sales_customer_id=document.getElementById("sales_customer_id").value;
            var sales_article_qty=document.getElementById("sales_article_qty").value;
            var sales_price=document.getElementById("sales_price").value;
          
            var branch_id=document.getElementById("branch_id").value;
            var staff_id=document.getElementById("staff_id").value;
              // alert(sales_date+"id "+sales_id+' '+sales_article_id+sales_invoice_no+sales_customer_id+sales_article_qty+sales_price+branch_id+staff_id);
                $.ajax( 
            { 

              type:"POST",
              url:"../insert/sales_insert.php",
              // dataType:"json",
              data:{
                sales_date:sales_date,
                sales_id:sales_id,
                sales_article_id:sales_article_id,
                sales_invoice_no:sales_invoice_no,
                sales_customer_id:sales_customer_id,
                sales_price:sales_price,
                sales_article_qty:sales_article_qty,   
                 branch_id:branch_id,
                staff_id:staff_id
              },

              success: function(data)

              {
                    alert(data);
                     alert("success");


                    // document.getElementById('item_id').value=data.item_id;
                       // alert(data.item_id);
                      

                     }   
          });
}

        </script>
