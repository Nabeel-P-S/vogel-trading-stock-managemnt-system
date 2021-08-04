  <div class="col-lg-12">
  <div class="col-lg-8">
<form class="form-group">
<fieldset>

<!-- Form Name -->
<legend>ADD SALES</legend>
<?php

$query = mysqli_query($conn, "select sales_id from sales order by sales_id desc LIMIT 1");
$fetch = mysqli_fetch_array($query);
$sales_id = $fetch['sales_id'] + 1;
?>

<!-- Text input-->
<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">SALES DATE</span>
    <input id="sales_date" type="date" class="form-control" readonly="1" name="sales_date" value="<?php echo $date ?>"  >
  </div></div>
<div class="form-group" style="display: none;">
 <div class="input-group">
    <span class="input-group-addon">SALES NO</span>
    <input id="sales_id" type="text" class="form-control" readonly="1" name="sales_id" value="<?php echo $sales_id ?>" >
  </div></div>
<div class="form-group">
 <div class="col-md-7"><div class="input-group">
    <span class="input-group-addon">ARTICLE NO</span>

          <input list="articles" id="article_id" style="font-size: 1vw;" name="article_id" oninput="display_article_stock();" placeholder="SELECT ARTICLE" class="form-control">
      <datalist id="articles">
         <option  value="" >select /option>
                        <?php
$query = mysqli_query($conn, "SELECT * from articles");
while ($fetch = mysqli_fetch_array($query))
{
?>
                          <option value="<?php echo $fetch['article_id']; ?>"><?php echo $fetch['article_no']; ?> </option>
                              <?php
}
?> 
      </datalist>  

  </div></div>

<div class="col-md-3"><input style="font-size: 1vw;width: 14vw;float: right;" readonly="1" class="form-control"  id="article_stock" placeholder="Stock Available"> </div>

<div class="col-md-2"><button type="button"  id="add" name="add" class="btn btn-success" onclick="add_row(this,'fabric_table')">+ ADD</button> </div>
</div>
<script type="text/javascript">
  function add_row(x,y) {
    
    var last_idf=document.getElementById("last_id_txtf").value;
  // var sum=document.getElementById("total_amount").value;
  last_idf=parseInt(last_idf)+1;
  document.getElementById('last_id_txtf').value=last_idf;
  // document.getElementById('total_amount').value=sum;

  var row_id = x.parentNode.parentNode.rowIndex;
  var x=row_id;
  var table = document.getElementById(y);
  var row = table.insertRow(x);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);
  

// var cell7 = row.insertCell(6);


cell1.innerHTML ='<select id="fabric_id" class="form-control input-md" name="fabric_id"> <option style="color: grey" value="" >select Fabric</option><?php  
            $query=mysqli_query($conn,"SELECT fabric_id,fabric from fabrics");
            while($fetch=mysqli_fetch_array($query))
            {
              ?>
              <option value="<?php echo $fetch ['fabric_id']; ?>"><?php echo $fetch ['fabric'];?> </option><?php
            }
            ?>    </select>';
cell2.innerHTML ='<input name="fabric_cost"  class="form-control input-md" placeholder="Fabric Price"   type="text">';

cell3.innerHTML = '<button id="add" name="add" class="btn btn-warning" onclick="delete_rowf(this)">-</button></td>';



}

</script>

<br>
<br>
<br>
<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon">INVOICE NO</span>
    <input id="sales_invoice_no" type="text" class="form-control" name="invoice_no" placeholder="INVOICE NO">
  </div></div>

<div class="form-group">

 <div class="input-group">
   

   <span class="input-group-addon">CUSTOMER</span>
      <input list="customers" id="sales_customer_id" name="customer_id" placeholder="SEARCH customer" class="form-control">


<datalist id="customers">
   <option style="color: grey" value="" >select customer</option>
                  <?php
$query = mysqli_query($conn, "SELECT * from customers");
while ($fetch = mysqli_fetch_array($query))
{
?>
                    <option value="<?php echo $fetch['customer_id']; ?>"><?php echo $fetch['customer_name']; ?> </option>
                        <?php
}
?> 
</datalist>
                 



  </div></div>
<!--   <div class="col-md-2"><button class="btn btn-info" onclick="customer_box1();"> ADD NEW</button></div>
</div>
 -->


<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">SALES PRICE</span>
    <input id="sales_price" type="text" class="form-control" readonly="1" name="sales_price" placeholder="SALES PRICE"  >
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
  

      <input list="branches" id="branch_id" name="branch_id" placeholder="SEARCH BRANCH" onkeyup="staff_view()" class="form-control">


<datalist id="branches">
   <option style="color: grey" value="" >select Branch</option>
                  <?php
$query = mysqli_query($conn, "SELECT * from branches");
while ($fetch = mysqli_fetch_array($query))
{
?>
                    <option value="<?php echo $fetch['branch_id']; ?>"><?php echo $fetch['branch_name']; ?> </option>
                        <?php
}
?> 
</datalist>



    <span class="input-group-addon">STAFF</span>
   <input list="staffs" id="staff_id" class="form-control" name="staff_id" placeholder="SEARCH STAFF" >
<datalist id="staffs">
   <option style="color: grey" value="" >SELECT STAFF</option>
                  <?php

$query = mysqli_query($conn, "SELECT * from staffs");
while ($fetch = mysqli_fetch_array($query))
{
?>
                    <option value="<?php echo $fetch['staff_id']; ?>"><?php echo $fetch['staff_name']; ?> </option>
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
    <button id="save" name="save"  class="btn btn-default"> <a href="http://localhost/stock/print/sales_bill.php" >PRINT</a></button>
  </div>
</div>

</fieldset>
</form>

  </div>
<div class="col-md-4"> 


       <div class="input-group">
         <legend>Know Stock Saled..</legend>
          <input list="articles" id="article_id1" style="font-size: 1vw;" name="article_id" onkeyup="display_article_sale();" placeholder="SELECT ARTICLE" class="form-control">
      <datalist id="articles">
         <option  value="" >select /option>
                        <?php  
                        $query=mysqli_query($conn,"SELECT * from articles");
                        while($fetch=mysqli_fetch_array($query))
                        {
                          ?>
                          <option value="<?php echo $fetch ['article_id']; ?>"><?php echo $fetch ['article_name'];?> </option>
                              <?php
                        }
                        ?> 
      </datalist> 

       </div>

  <div class="form-group">  <input style="font-size: 1vw;width: 14vw;float: right;" class="form-control" id="article_sales" placeholder="Qty Saled">
     </div><a class="btn btn-primary"  href="../print/sale.php">PRINT ARTICLE SALES</a></div>

     <div   id="customer_box" >
  <fieldset>

<!-- Form Name --><br>
<legend>NEW CUSTOMER</legend>
<?php 

    $query=mysqli_query($conn,"select customer_id from customers order by customer_id desc LIMIT 1
     ");
    $fetch=mysqli_fetch_array($query);
     $customer_id1=$fetch['customer_id']+1;?>

<!-- Text input-->

<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">CUSTOMER ID</span>
    <input id="customer_id1" type="text" class="form-control" name="customer_id1" value="<?php echo $customer_id1?>" >
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
</div>

</div>



</div>



<script type="text/javascript">
  function customer_box1()
  {


  var x = document.getElementById("customer_box");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
  
</script>
<script type="text/javascript">
  staff_view()
  {

  }
</script>
 <script type="text/javascript">
          function save_customer()
          {

            var customer_id=document.getElementById("customer_id1").value;
        document.getElementById("sales_customer_id").value=customer_id;
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
        <script type="text/javascript">
         function staff_view()
         {
      
          var branch_id=document.getElementById("branch_id").value;
          alert(branch_id);
    $.ajax( 
            {

              type:"POST",
              url:"..details/staff_view.php",
              // dataType:"json",
              data:{
              
                branch_id:branch_id
              },

              success: function(data)

              {
                    alert(data);
                    // alert("success");

                    document.getElementById('staff_id').innerHTML =data;
                       // alert(data.item_id);
                      

                     }    
                   });


         } 

        </script>