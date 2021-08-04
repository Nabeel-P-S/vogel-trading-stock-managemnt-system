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
  <div class="container-fluid">
  <div class="col-lg-12">
<form class="form-group">
<fieldset>

<!-- Form Name -->
<legend>DIRECT SALES    <p style="float: right;">No : <?php echo $sales_id ?> </p> </legend>    



<!-- Text input-->
<table class="table">  
<tr>
  <td>
    <div class="input-group">
    <span class="input-group">SALES DATE</span>
    <input id="sales_date" type="date" class="form-control" name="sales_date" value="<?php echo $date ?>"  >
       <input id="sales_time" type="hidden" class="form-control" readonly="1"  name="sales_time" value="<?php echo $time?>" >
  </div>
  </td>
  <td>
 <div class="input-group">
    <span class="input-group">INVOICE NO</span>
    <input id="sales_invoice_no" type="text" class="form-control" readonly="1" value="<?php echo $sales_invoice_no ?>" name="invoice_no" >
  </div>
  </td>

<td><div class="input-group">



    <span class="input-group">STAFF</span>
   <input list="staffs" id="staff_id" class="form-control" name="staff_id" value="VOGEL" readonly="1">
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
  <td colspan="4">

<div id="customer_div"> 
<table class="table-condensed">
  <tr >
    <td> 
  

    <input id="customer_id" readonly="1" class="form-control" name="customer_id" value=" <?php echo $customer_id;?>"  >



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
    <td colspan="4">
      <div style="overflow: auto;*height: 33vw; border:1.5px solid white;border-radius: 1vw;">
      <table id="article_table" class="table-striped table" >
          <tr>
  <td>ID</td>
  <td>NO</td>
  <td>NAME</td>
 <td style="display: <?php if ($user_name=="shybi")
       echo "block"; else echo "none"; ?>;color: green;">PRICE</td>
 
  <td>MRP</td>
  <td>STOCK</td>
  <td>QTY</td>
  <td>Price Total</td>
  <td style="display: <?php if ($user_name=="shybi")
       echo "block"; else echo "none"; ?>;color: green;">Mrp Total</td>

<!-- id="invoice_amount<?php echo $i?>" -->
<!-- ============================================= sales table================== -->
<!-- <?php
for($i=1;$i<5;$i++)
{


}
 ?> -->
</tr>
        <tr>
          <td>
           <div class="fill">
           
              <input list="articles" id="sales_article_id"  name="sales_article_id" onkeyup="display_article_stock(this.value,'1');" placeholder="ID" class="form-control">
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
        <td>  
          <input id="art_no1" type="text" readonly="1" class="form-control" name="art_name" placeholder="NO">
      </td>

        <td  style="width: 18VW;">  
         
          <input id="art_name1" readonly="1" type="text" class="form-control" name="art_name" placeholder="ARTICLE NAME"  >
      </td>
         <td style="display: <?php if ($user_name=="shybi")
       echo "block"; else echo "none"; ?>;color: green;"> 

       <input id="art_cost1"  type="text" readonly="1" class="form-control" name="art_cost" placeholder="PRICE">
         </td>

     <td> 

       <input id="art_price1" type="text" readonly="1" class="form-control" name="art_price" placeholder="MRP">
         <td> 
  
       <input id="art_stock1" type="text" readonly="1" class="form-control" name="art_price" placeholder="STOCK">
      </td>
       <td>   
          
         <input id="art_qty1" type="text" onchange="display_total(this.value,'1');" class="form-control" name="item_price1" placeholder="QTY">
    
      </td>
        <td style="display: <?php if ($user_name=="shybi")
       echo "block"; else echo "none"; ?>;color: green;" >   
          
         <input id="price_total1" type="text"  class="form-control" name="price_total" placeholder="price Total">
    
      </td>
       <td>   

         <input id="art_total1" name="art_total" style="color: red;" type="text"   class="form-control"  placeholder="Mrp Total">
       
      </td>
     
        </tr> 
                <input  type="hidden" value="1" id="last_id" >

    <td colspan="4">    
     <button type="button"  id="add" name="add" class="btn btn-success" onclick="add_row(this,'article_table')">+ ADD</button>
</td> 


<!-- <td style="display: <?php if ($user_name=="shybi")
       echo "block"; else echo "none"; ?>;color: blue;float: right;"><b >MARGIN</b> </td> -->
<td style="display: <?php if ($user_name=="shybi")
       echo "block"; else echo "none"; ?>;color: blue;" colspan="0"> <input id="profit_total" style="color: blue;font-weight: bold;" readonly="1" name="profit" class="form-control">
</td>

<td > <input id="cost_total" style="display: <?php if ($user_name=="shybi")
       echo "block"; else echo "none"; ?>;color: green;" readonly="1" name="cost_total" class="form-control" >
</td>

<td colspan="2"> <input id="sales_total" style="color: red;font-weight: bold;font-size: 2vw;" readonly="1" name="sales_total" class="form-control" >
</td>

<tr ><td colspan="6">   <label style="float: right;">PAID AMOUNT</label>     </td><td colspan="3"><input class="form-control" id="paid" type="text"   placeholder="PAID AMOUNT" name="paid" ></td></tr>
   </table>


  <div >
    
    <!-- <span>BALANCE</span>     <input id="balance" type="text"   value="<?php echo $sales-$paid;?>" name="balance" > -->
    <button  onclick="save_sales()" style="width: 20vw;margin-left: 20vw;" class="btn btn-primary">SAVE DIRECT SALES</button>
 

    <button  class="btn btn-warning"> <a href="../print/sales_bill.php?sales_id=<?php echo $sales_id-1;?>" > PREVIOUS INVOICE</a></button>
    <button  class="btn btn-info"> <a href="../print/delivery_order.php?sales_id=<?php echo $sales_id-1;?>" > PREVIOUS DELIVERY  ORDER</a></button>
  </div>

    </div>
    </td>
  </tr>
</table>










<!-- Button -->


</fieldset>
</form>

  </div>
  <div class="col-md-2"> 


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



              <div class="form-group">   <input style="font-size: 2vw;width: 14vw;float: right;border: none;color:green;" class="form-control" id="article_sales" >
              </div>
              <br>
              <br>
              <br>
              <br>
              <a class="btn btn-primary"  href="../print/sale.php"> ARTICLE SOLD LIST</a>
              <br>
              <br>
              <a class="btn btn-warning"  href="../print/view_sales.php"> SALES LIST</a>



              </div>



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
  var cell10 = row.insertCell(9);

  

// var cell7 = row.insertCell(6);
// id="art_name'+last_id+'"

cell1.innerHTML =' <input list="articles" id="sales_article_id" style="font-size: 1vw;" name="sales_article_id" oninput="display_article_stock(this.value,'+last_id+');" placeholder="ID" class="form-control"><datalist id="articles"> <option style="color: grey" value="" >SELECT ARTICLE </option><?php  
            $query=mysqli_query($conn,"SELECT * from articles");
            while($fetch=mysqli_fetch_array($query))
            {
              ?>
              <option value="<?php echo $fetch ['article_id']; ?>"><?php echo $fetch ['article_no'];?> </option><?php
            } 
            ?></datalist> ';

cell2.innerHTML ='<input id="art_no'+last_id+'" readonly=1 class="form-control" name="art_no" placeholder="NO">';

cell3.innerHTML ='<input id="art_name'+last_id+'" readonly=1 class="form-control" name="art_name" placeholder="ARTICLE NAME">';
cell4.innerHTML ='<input id="art_cost'+last_id+'"  readonly=1 class="form-control" name="art_cost" placeholder="COST">';
cell4.style='display: <?php if ($user_name=="shybi") echo "block"; else echo "none"; ?>;color: green;';
cell8.style='display: <?php if ($user_name=="shybi") echo "block"; else echo "none"; ?>;color: green;';
cell5.innerHTML ='<input id="art_price'+last_id+'" readonly=1 class="form-control" name="art_price" placeholder="MRP">';
cell6.innerHTML ='<input id="art_stock'+last_id+'" readonly=1 class="form-control" name="art_stock" placeholder="STOCK">';
cell7.innerHTML ='<input id="art_qty'+last_id+'" onchange="display_total(this.value,'+last_id+');" name="item_price1"  class="form-control" placeholder="QTY"   type="text">';

cell8.innerHTML ='<input id="price_total'+last_id+'" class="form-control" placeholder="Price Total" name="price_total"   type="text">';
cell9.innerHTML ='<input id="art_total'+last_id+'" style="color:red;"  class="form-control" placeholder="Mrp Total" name="art_total"   type="text">';

cell10.innerHTML = '<button id="add" name="add"  class="btn btn-warning" onclick="delete_rowf(this)">-</button></td>';



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
  function  delete_rowf(element) {
    var row_id = element.parentNode.parentNode.rowIndex;
    document.getElementById("article_table").deleteRow(row_id);
    add_total();
  }
</script>
<script>
          function display_article_stock(article_id,last_id)
          {

    // alert("yes");
      
var staff_id=document.getElementById("staff_id").value;
          var id1="art_name"+last_id;
          var id2="art_price"+last_id;
          var id3="art_stock"+last_id;
          var id4="art_no"+last_id;
          var id5="art_cost"+last_id;
       
          $.ajax(
          {
            type:"POST",
            url:"../details/main_stock.php",
             dataType:"json",
            data:{
             
              article_id:article_id,
              staff_id:1
            },

            success: function(data)

            {
              // alert(data);
              var article_stock=data.main_stock;
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
          function save_sales()
          {
      
var customer_name=document.getElementById("customer_name").value;
if (customer_name!="")
{
   var customer_id=document.getElementById("customer_id").value;
            
            var customer_address=document.getElementById("customer_address").value;
            var customer_phone=document.getElementById("customer_phone").value;
            var customer_gst=document.getElementById("customer_gst").value;
           
    
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
                    
                  

                     }    
                   });



}
   else{
    var customer_id=document.getElementById("staff_id").value;
   }        

         save_sales1(customer_id);

   

        }
      </script>
      <script>
function save_sales1(customer_id)
{
   var article_element=document.getElementsByName('sales_article_id');
   var item_qty_element=document.getElementsByName('item_price1');
   var sales_total=document.getElementById("sales_total").value;
   var profit_total=document.getElementById("profit_total").value;
   var article_array=[];
   var item_qty=[];
   var n=0;
   for (var i = 0; i <article_element.length; i++) 
   {
      var article_id=article_element[i].value;
      var item_qty_id=item_qty_element[i].value;
      if (article_id!="")
      {
         article_array[n]=article_id;
         item_qty[n]=item_qty_id;
         // alert(item_qty[n]);
         n++;
      }
   }
   var article_array_json=JSON.stringify(article_array);
   var item_qty_json=JSON.stringify(item_qty);
   var sales_date=document.getElementById("sales_date").value;
   var sales_time=document.getElementById("sales_time").value;
   var sales_invoice_no=document.getElementById("sales_invoice_no").value;
  
   var paid=document.getElementById("paid").value;
   
   var staff_id=1;
   if (staff_id==""||sales_total=="")
      {
       alert("ENTER FULL DATA");
      }
   else
      {  
         alert("invoice added successfully");  
        $.ajax( 
                     { 

                     type:"POST",
                     url:"../insert/dsales_insert.php",
                     // dataType:"json",
                     data:
                        {
                           article_array_json:article_array_json,
                           item_qty_json:item_qty_json, 
                           sales_date:sales_date,
                           sales_time:sales_time,
                           sales_total:sales_total,
                           profit_total:profit_total,
                           sales_invoice_no:sales_invoice_no,
                           customer_id:customer_id,
                       
                           paid:paid,
                           staff_id:staff_id
                        },
                     success: function(data)
                           {
                           alert(data);
                           }   
                     }
               );
     }







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
        function display_total(qty,last_id)
        {

          var id3="art_total"+last_id;
          var id6="price_total"+last_id;
          var id2="art_price"+last_id;
          var id1="art_qty"+last_id;

          var id4="art_stock"+last_id;
          var id5="art_cost"+last_id;

          var qty=qty;
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
            document.getElementById(id6).value=" ";
          }
          else
          {

           var amount=qty*parseFloat(mrp);
           var cost=qty*parseFloat(price);

           document.getElementById(id3).value=amount;
           document.getElementById(id6).value=cost;
           add_total();

         }
         


        }
      </script>
    <script>
        function add_total()
          {
            var sum=0;
            var cost_sum=0;


            // var cost_array=[];
            var art_total=document.getElementsByName('art_total');
            var art_cost=document.getElementsByName('price_total');
            // alert(cost_element);    
            for (var i = 0; i <art_total.length; i++) 
            {
            if (art_total[i].value=="")
            {
            var mrp=0;
            }
            else
            {
            var mrp=art_total[i].value;
            var cost=art_cost[i].value;
            }
            var sum=sum+parseFloat(mrp);
            var cost_sum=cost_sum+parseFloat(cost);
            var profit=sum-cost_sum;
            }
            document.getElementById("sales_total").value=sum;
            document.getElementById("cost_total").value=cost_sum;
            document.getElementById("profit_total").value=profit;

          }

    </script>



  ?>

     