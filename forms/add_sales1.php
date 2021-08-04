  <?php

 include("../main/navbar.php");
$query = mysqli_query($conn, "select sales_id from sales order by sales_id desc LIMIT 1");
$fetch = mysqli_fetch_array($query);
$sales_id = $fetch['sales_id'] + 1;
$sales_invoice_no = $sales_id+ 1000;
?>
<?php 

    $query=mysqli_query($conn,"select customer_id from customers order by customer_id desc LIMIT 1
     ");
    $fetch=mysqli_fetch_array($query);
     $customer_id=$fetch['customer_id']+1;
     ?>

  <div class="col-lg-12">
  <div class="col-lg-8">
<form class="form-group">
<fieldset>

<!-- Form Name -->
<legend>ADD SALES    <p style="float: right;">No : <?php echo $sales_id ?> </p> </legend>    



<!-- Text input-->
<table class="table table-striped">  
<tr>
  <td>
    <div class="input-group">
    <span class="input-group-addon">SALES DATE</span>
    <input id="sales_date" type="date" class="form-control" name="sales_date" value="<?php echo $date ?>"  >
  </div>
  </td>
  <td>
 <div class="input-group">
    <span class="input-group-addon">INVOICE NO</span>
    <input id="sales_invoice_no" type="text" class="form-control" readonly="1" value="<?php echo $sales_invoice_no ?>" name="invoice_no" >
  </div>
  </td>
</tr>
<tr><td>
 <div class="input-group">
    <span class="input-group-addon">BRANCH</span>
  

      <input list="branches" id="branch_id" name="branch_id" placeholder="SEARCH BRANCH"  class="form-control">


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
</div></td>
<td><div class="input-group">



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
</datalist>   </div></td></tr>


<tr>
  <td colspan="2">

<div id="customer_div"> 
<table class="table">
  <tr >
    <td> 
  
          <!-- 
              <input id="customer_id" readonly="1" class="form-control" name="customer_id" value=" <?php echo $customer_id;?>"  > -->

           <input list="customers" id="customer_select_id" class="form-control" name="customer_select_id" placeholder="SEARCH CUSTOMER" onchange="display_customer_details(this.value);">
          <datalist id="customers">
             <option style="color: grey" value="" >SELECT CUSTOMER</option>
                            <?php

          $query = mysqli_query($conn, "SELECT * from customers");
          while ($fetch = mysqli_fetch_array($query))
          {
          ?>
                              <option value="<?php echo $fetch['customer_id']; ?>"><?php echo $fetch['customer_name']; ?> </option>
                                  <?php
          }
          ?> 
          </datalist> </div>

</td>
<td>

       <input id="customer_name" type="text" class="form-control" name="customer_name" placeholder="CUSTOMER NAME"  >
</td>
  <td>


    <input id="customer_address" type="text" class="form-control" name="customer_address" placeholder="ADDRESS"  >

  </td>
  <td>

    
    <input id="customer_phone" type="number" class="form-control" name="customer_phone" placeholder="PHONE"  >

  </td>
  <td>


    <input id="customer_gst" type="text" class="form-control" name="customer_gst" placeholder="GST No"  >

  </td>
  </tr>
</table>

</div>





  </td>

</tr>
<tr style="display: none;">
  <td>  
    <div >


   <b >MRP : </b>  <input id="sales_price" style="border: none; background-color: transparent;font-size: 1.5vw;color: blue;font-family: fantasy;" readonly="1"  name="sales_price"   ></div>


</td>
  <td>   <div >

    <b >STOCK AVAILABLE : </b>   <input style="border: none; background-color: transparent;font-size: 1.5vw;color: blue;font-family: fantasy;" readonly="1"   id="article_stock">  </div>


   

</td>
</tr>

<tr>
    <td colspan="2">
      <div style="overflow: auto;*height: 33vw; border:1.5px solid white;border-radius: 1vw;">
      <table id="article_table" class="table-striped table" >
          <tr>
  <td>ID</td>
  <td>NO</td>
  <td>NAME</td>
 
  <td>MRP</td>
  <td>STOCK</td>
  <td>QTY</td>
  <td>TOTAL</td> <td>PRICE</td></tr>
        <tr>
          <td style="*width: 10VW;">
           <div class="fill">
           
              <input list="articles" id="sales_article_id"  name="sales_article_id" onkeyup="display_article_stock(this);item_array(this.value);" placeholder="ID" class="form-control">
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
          </div>
       </td>
        <td  >  
         
          <input id="art_no1" type="text" readonly="1" class="form-control" name="art_name" placeholder="NO">
      </td>
        <td  style="width: 18VW;">  
         
          <input id="art_name1" readonly="1" type="text" class="form-control" name="art_name" placeholder="ARTICLE NAME"  >
      </td>
     
     <td> 

       <input id="art_price1" type="text" readonly="1" class="form-control" name="art_price" placeholder="MRP">
         <td> 
  
       <input id="art_stock1" type="text" readonly="1" class="form-control" name="art_price" placeholder="STOCK">
      </td>
       <td>   
          
         <input id="art_qty1" type="text" onchange="display_total();" class="form-control" name="item_price1" placeholder="QTY">
    
      </td>
       <td>   

         <input id="art_total1" type="text"  class="form-control"  placeholder="TOTAL">
       
      </td>
         <td> 

       <input id="art_cost1" type="text" readonly="1" class="form-control" name="art_cost" placeholder="PRICE">
         </td>
        </tr> 
                <input  type="hidden" value="1" id="last_id" >
                <input  type="hidden" value="0" id="customer_status" >

    <td colspan="3">    
     <button type="button"  id="add" name="add" class="btn btn-success" onclick="add_row(this,'article_table')">+ ADD</button>
</td> 
<td colspan="0"><b style="float: right;">SALES</b> </td>
<td colspan="0"> <input id="sales_total" name="sales_total" class="form-control" >
</td><td colspan="0"><b style="float: right;">PROFIT</b> </td>
<td colspan="0"> <input id="profit_total" name="profit" class="form-control" >
</td>
   </table>

  <div style="float: right;">
    <br>
    <button  onclick="save_sales()" class="btn btn-danger">SAVE SALES</button>

    <button  class="btn btn-warning"> <a href="../print/sales_bill.php?sales_id=<?php echo $sales_id-1;?>" >PRINT INVOICE</a></button>
    <button  class="btn btn-primary"> <a href="../print/delivery_order.php?sales_id=<?php echo $sales_id-1;?>" > DELIVERY ORDER</a></button>
  </div>

    </div>
    </td>
  </tr>
</table>










<!-- Button -->


</fieldset>
</form>

  </div>
<div class="col-md-4"> 


       <div class="input-group">
         <legend>Stock Saled..</legend>
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

  <div class="form-group">   <input style="font-size: 2vw;width: 14vw;float: right;border: none;color:green;" class="form-control" id="article_sales" >
     </div><a class="btn btn-primary"  href="../print/sale.php">PRINT ARTICLE SALES</a></div>



</div>



</div>





        <script type="text/javascript">
  function add_row(x,y) {
    
    var last_id=document.getElementById("last_id").value;
  // var sum=document.getElementById("total_amount").value;
  last_id=parseInt(last_id)+1;
  document.getElementById('last_id').value=last_id;
  // document.getElementById('total_amount').value=sum;

  var row_id = x.parentNode.parentNode.rowIndex;
  var x=row_id;
  var table = document.getElementById(y);
  var row = table.insertRow(x);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);
  var cell5 = row.insertCell(4);
  var cell6 = row.insertCell(5);
  var cell7 = row.insertCell(6);
  var cell8 = row.insertCell(7);
  var cell9 = row.insertCell(8);

  

// var cell7 = row.insertCell(6);
// id="art_name'+last_id+'"

cell1.innerHTML =' <input list="articles" id="sales_article_id" style="font-size: 1vw;" name="sales_article_id" oninput="display_article_stock(this);" placeholder="ID" class="form-control"><datalist id="articles"> <option style="color: grey" value="" >SELECT ARTICLE </option><?php  
            $query=mysqli_query($conn,"SELECT * from articles");
            while($fetch=mysqli_fetch_array($query))
            {
              ?>
              <option value="<?php echo $fetch ['article_id']; ?>"><?php echo $fetch ['article_no'];?> </option><?php
            } 
            ?></datalist> ';

cell2.innerHTML ='<input id="art_no'+last_id+'" readonly=1 class="form-control" name="art_name" placeholder="NO">';
cell3.innerHTML ='<input id="art_name'+last_id+'" readonly=1 class="form-control" name="art_name" placeholder="ARTICLE NAME">';

cell4.innerHTML ='<input id="art_price'+last_id+'" readonly=1 class="form-control" name="art_name" placeholder="PRICE">';
cell5.innerHTML ='<input id="art_stock'+last_id+'" readonly=1 class="form-control" name="art_name" placeholder="STOCK">';
cell6.innerHTML ='<input id="art_qty'+last_id+'" onchange="display_total();" name="item_price1"  class="form-control" placeholder="QTY"   type="text">';
cell7.innerHTML ='<input id="art_total'+last_id+'"  class="form-control" placeholder="TOTAL"   type="text">';
cell8.innerHTML ='<input id="art_cost'+last_id+'" readonly=1 class="form-control" name="art_name" placeholder="COST">';
cell9.innerHTML = '<button id="add" name="add" class="btn btn-warning" onclick="delete_rowf(this)">-</button></td>';



}

</script>
<script>
  function  delete_rowf(element) {
    var row_id = element.parentNode.parentNode.rowIndex;
    document.getElementById("article_table").deleteRow(row_id);
    add_total();
  }
</script>
<script>
          function display_article_stock(article_id)
          {

        var article_id=article_id.value;
        var last_id=document.getElementById("last_id").value;

          var id1="art_name"+last_id;
          var id2="art_price"+last_id;
          var id3="art_stock"+last_id;
          var id4="art_no"+last_id;
          var id5="art_cost"+last_id;
       
          $.ajax(
          {
            type:"POST",
            url:"../details/article_stock.php",
             dataType:"json",
            data:{
             
              article_id:article_id
            },

            success: function(data)

            {
              var article_stock=data.total_stock;
              var sales_price=data.sales_price;
              var article_price=data.article_price;
              var article_name=data.article_name;
              var article_no=data.article_no;
    
         
      if (article_stock==null) {article_stock="No Stock Available;"}
          document.getElementById("article_stock").value=article_stock; 
          document.getElementById("sales_price").value=sales_price; 
          document.getElementById(id1).value=article_name; 
          document.getElementById(id2).value=sales_price; 
          document.getElementById(id3).value=article_stock; 
          document.getElementById(id4).value=article_no; 
          document.getElementById(id5).value=article_price; 
        

              
}    
});

        }
      </script>
      <script type="text/javascript">
        function display_customer_details(customer_id) 
        {
         alert(customer_id);
    $.ajax(
          {
            type:"POST",
            url:"../details/customer_details.php",
             dataType:"json",
            data:{
             
              customer_id:customer_id
            },


            success: function(data)

            {
              var customer_name=data.customer_name;
              var customer_address=data.customer_address;
              var customer_phone=data.customer_phone;
              var customer_gst=data.customer_gst;
       
 
          document.getElementById("customer_name").value=customer_name; 
          document.getElementById("customer_address").value=customer_address; 
          document.getElementById("customer_phone").value=customer_phone; 
          document.getElementById("customer_gst").value=customer_gst; 
          document.getElementById("customer_status").value=1; 
     
      
        

              
}    
});
        }
      </script>
        <script type="text/javascript">
          function save_sales()
          {
      

            var customer_status=document.getElementById("customer_status").value;
            if (customer_status==0) 
            {
              alert("not selected");
            // var customer_id=document.getElementById("customer_id").value;
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
                // customer_id:customer_id,
                customer_name:customer_name,
                customer_address:customer_address,
                customer_gst:customer_gst,
                customer_phone:customer_phone
              },

              success: function(data)

              {
                    
                  

                     }    
                   });



          }
}
        save_sales1();

   

        }
      </script>
      <script type="text/javascript">
function save_sales1()
{

  var article_element=document.getElementsByName('sales_article_id');
    var item_price1_element=document.getElementsByName('item_price1');
     var sales_total=document.getElementById("sales_total").value;
            var profit_total=document.getElementById("profit_total").value;
 var article_array=[];
    var item_price1=[];
  var n=0;
  for (var i = 0; i <article_element.length; i++) 
    {
       var article_id=article_element[i].value;
       var item_price1_id=item_price1_element[i].value;
       alert(item_price1_id);
 if (article_id!="")
        {
          article_array[n]=article_id;
          item_price1[n]=item_price1_id;
    n++;
        }
    }

 var article_array_json=JSON.stringify(article_array);
    var item_price1_json=JSON.stringify(item_price1);

            var sales_date=document.getElementById("sales_date").value;
            
            var sales_invoice_no=document.getElementById("sales_invoice_no").value;
            var sales_customer_id=document.getElementById("customer_id").value;
            
           
          
            var branch_id=document.getElementById("branch_id").value;
            var staff_id=document.getElementById("staff_id").value;
  
  if (branch_id==""||staff_id=="")
   {
    alert("ENTER FULL DATA");


  }
else{         $.ajax( 
            { 

              type:"POST",
              url:"../insert/sales_insert.php",
              // dataType:"json",
              data:{
                 article_array_json:article_array_json,
                        item_price1_json:item_price1_json, 
                sales_date:sales_date,
                sales_total:sales_total,
                profit_total:profit_total,
             
             
                sales_invoice_no:sales_invoice_no,
                sales_customer_id:sales_customer_id,
          
                 branch_id:branch_id,
             
                staff_id:staff_id
              },

              success: function(data)

              {
                  alert(data);
                    


                    // document.getElementById('item_id').value=data.item_id;
                       // alert(data.item_id);
                      

                     }   
          });}

             
              
                 
                 
         
}

        </script>
        <script type="text/javascript"> 
function customer_add()
{
  document.getElementById("customer_div").style.display="block";
}
        </script>
        
<script type="text/javascript">
  function item_array(item)
  {

  item_array.push(item);
  
  alert(item_array);

  }
</script>
 <script>
          function display_article_sale()
          {
        

          var article_id=document.getElementById("article_id1").value;
       
          $.ajax(
          {
            type:"POST",
            url:"../details/article_sale.php",
             dataType:"json",
            data:{
             
              article_id:article_id
            },

            success: function(data)

            {
              var article_stock=data.total_stock;
              
      if (article_stock==null) {article_stock="No  saled"}
          document.getElementById("article_sales").value=article_stock; 
   
        

              
}    
});
}
      </script>
      <script type="text/javascript">
        function display_total()
        {
                  var last_id=document.getElementById("last_id").value;
                  var sales_total=document.getElementById("sales_total").value;
                  var profit=document.getElementById("profit_total").value;
   if (sales_total=="")
            sales_total=0;
          if (profit=="")
            profit=0;
          var id3="art_total"+last_id;
          var id2="art_price"+last_id;
          var id1="art_qty"+last_id;
          var id4="art_stock"+last_id;
          var id5="art_cost"+last_id;

             var qty=document.getElementById(id1).value;
             var mrp=document.getElementById(id2).value;
             var price=document.getElementById(id5).value;
             var stock=document.getElementById(id4).value;
              if (qty=="")
              {
                  qty=0;
              }
              qty=parseInt(qty);
              stock=parseInt(stock);
          
if (qty>stock)
{
  alert("OUT OF STOCK..!!!!!");
  document.getElementById(id1).value=" ";
   document.getElementById(id3).value=" ";
}
else
{

             var amount=qty*mrp;
             var margin=parseFloat(qty)*parseFloat(price);

             document.getElementById(id3).value=amount;
             sales_total=parseFloat(sales_total)+parseFloat(amount);
             profit_total=parseFloat(profit)+parseFloat(margin);
             // profit_total=parseInt(profit)+parseInt(margin);
             // profit_total=profit+margin; 
             
             document.getElementById('sales_total').value=sales_total;
             document.getElementById('profit_total').value=profit_total;

             // sales_total=sales_total+amount;
             // document.getElementById("sales_total").value=sales_total;
}
         


        }
      </script>