   <?php
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
<style type="text/css">
  .nabeel1
  {
font-size: 1.5vw;
color: blue;
  }
</style>

  <div class="col-lg-12">
<form class="form-group">
<fieldset>

<!-- Form Name -->
<h4>ADD STAFF INVOICE    <p style="float: right;">No : <?php echo $sales_id ?> </p> </h4>    



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
  <td>SGST</td>
  <td>CGST</td>
  <td>IGST</td>
  <td>CESS</td>
  <td>TAX</td>
  <td>QTY</td>
  <td>COST</td>
  <td>GST</td>
  <td>TOTAL</td>
  <td style="display: <?php if ($user_name=="shybi")
       echo "block"; else echo "none"; ?>;color: green;">Mrp Total</td>

</tr>
<?php
$id=1;
for($i=0;$i<4;$i++)
{
  

?>
        <tr>
          <td style="*width: 10VW;">
           <div class="fill">
           
              <input list="articles" id="sales_article_id<?php echo $id?>"  name="sales_article_id" onchange="display_article_stock(this.value,'<?php echo $id;?>');" placeholder="ID" class="form-control">
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
         
          <input id="art_no<?php echo $id?>" type="text" readonly="1" class="form-control nabeel" name="art_name" placeholder="NO">
      </td>

        <td  style="width: 18VW;">  
         
          <input id="art_name<?php echo $id?>" readonly="1" type="text" class="form-control" name="art_name" placeholder="ARTICLE NAME"  >
      </td>
         <td style="display: <?php if ($user_name=="shybi")
       echo "block"; else echo "none"; ?>;color: green;"> 

       <input id="art_cost<?php echo $id?>"  type="text" readonly="1" class="form-control nabeel" name="art_cost" placeholder="PRICE">
         </td>

     <td> 

       <input id="art_price<?php echo $id?>" type="text" readonly="1" class="form-control nabeel" name="art_price" placeholder="MRP">
         <td> 
  
       <input id="art_stock<?php echo $id?>" style="color: red;font-weight: bold;"  type="text" readonly="1" class="form-control nabeel" name="art_stock"  placeholder="STOCK">
      </td>
         <td> 
  
       <input id="sgst<?php echo $id?>" type="text" readonly="1" class="form-control nabeel" name="sgst" placeholder="SGST">
      </td>
         <td> 
  
       <input id="cgst<?php echo $id?>" type="text" readonly="1" class="form-control nabeel" name="cgst" placeholder="CGST">
      </td>
         <td> 
  
       <input id="igst<?php echo $id?>" type="text" readonly="1" class="form-control nabeel" name="igst" placeholder="IGST">
      </td>
        <td> 
  
       <input id="cess<?php echo $id?>" type="text" readonly="1" class="form-control nabeel" name="cess" placeholder="CESS">
      </td>
          <td> 
  
       <input id="tax<?php echo $id?>" type="text" readonly="1" class="form-control nabeel" name="tax" placeholder="TAX">
      </td>
       <td>   
          
         <input id="art_qty<?php echo $id?>" type="text" style="color: red;" onchange="display_total(this.value,'<?php echo $id;?>');" class="form-control" name="art_qty" placeholder="QTY">
    
      </td>
      
       <td>   

         <input id="art_total<?php echo $id?>" name="art_total"  type="text"   class="form-control"  placeholder="Mrp Total">
       
      </td>
       <td>   

         <input id="gst<?php echo $id?>" name="gst"  type="text"   class="form-control"  placeholder="GST TOTAL">
       
      </td>
        <td>   

         <input id="total<?php echo $id?>" name="total"  type="text"   class="form-control"  placeholder=" TOTAL">
       
      </td>
     
        </tr>
        <?php
        $id++;
        } 
        ?><tr>
                <input  type="hidden" value="4" id="last_id" >
                    <td colspan="10">    
     <button type="button"  id="add" name="add" class="btn btn-success" onclick="add_row(this,'article_table')">+ ADD</button>
</td> 


<td > <input id="qty_total" readonly="1" name="sales_total" class="form-control nabeel1" >
</td>
<td > <input id="sales_total"  readonly="1" name="sales_total" class="form-control nabeel1" >
</td>
<td > <input id="gst_total" readonly="1" name="sales_total" class="form-control nabeel1" >
</td>
<td > <input id="invoice_total" readonly="1" name="invoice_total" class="form-control nabeel1" >
</td></tr>

<tr style="display: none;"><td colspan="6">   <label style="float: right;">PAID AMOUNT</label>     </td><td colspan="3"><input class="form-control" id="paid" type="text"   placeholder="PAID AMOUNT" name="paid" ></td></tr>
   </table>


  <div >
    
    <!-- <span>BALANCE</span>     <input id="balance" type="text"   value="<?php echo $sales-$paid;?>" name="balance" > -->
    <button  onclick="save_sales()" style="width: 20vw;margin-left: 20vw;" class="btn btn-danger">SAVE THIS INVOICE BILL</button>
 

    <button  class="btn btn-warning"> <a href="../print/invoice_bill.php?sales_id=<?php echo $sales_id-1;?>" > PREVIOUS INVOICE</a></button>
    <!-- <button  class="btn btn-info"> <a href="../print/delivery_order.php?sales_id=<?php echo $sales_id-1;?>" > PREVIOUS DELIVERY  ORDER</a></button> -->
  </div>

    </div>
    </td>
  </tr>
</table>










<!-- Button -->


</fieldset>
</form>

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
  var cell11 = row.insertCell(10);
  var cell12 = row.insertCell(11);
  var cell13 = row.insertCell(12);
  var cell14 = row.insertCell(13);
  var cell15 = row.insertCell(14);
  var cell15 = row.insertCell(14);
  // var cell16 = row.insertCell(15);

  

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
cell4.innerHTML ='<input id="art_cost'+last_id+'"   readonly=1 class="form-control" name="art_cost" placeholder="COST">';
cell4.style='display: <?php if ($user_name=="shybi") echo "block"; else echo "none"; ?>;';
// cell8.style='display: <?php if ($user_name=="shybi") echo "block"; else echo "none"; ?>;color: green;';
cell5.innerHTML ='<input id="art_price'+last_id+'" readonly=1 class="form-control" name="art_price" placeholder="MRP">';
cell6.innerHTML ='<input id="art_stock'+last_id+'"  style="color:red;" readonly=1 class="form-control" name="art_stock" placeholder="STOCK">';
cell7.innerHTML ='<input id="sgst'+last_id+'" readonly=1 class="form-control" name="sgst" placeholder="SGST">';
cell8.innerHTML ='<input id="cgst'+last_id+'" readonly=1 class="form-control" name="cgst" placeholder="CGST">';
cell9.innerHTML ='<input id="igst'+last_id+'" readonly=1 class="form-control" name="igst" placeholder="IGST">';
cell10.innerHTML ='<input id="cess'+last_id+'" readonly=1 class="form-control" name="igst" placeholder="CESS">';
cell11.innerHTML ='<input id="tax'+last_id+'" readonly=1 class="form-control" name="tax" placeholder="TAX">';
cell12.innerHTML ='<input id="art_qty'+last_id+'" onchange="display_total(this.value,'+last_id+');" name="art_qty" style="color:red;"   class="form-control" placeholder="QTY"   type="text">';


// cell12.innerHTML ='<input id="price_total'+last_id+'" class="form-control" placeholder="Price Total" name="price_total"   type="text">';
cell13.innerHTML ='<input id="art_total'+last_id+'"   class="form-control" placeholder="Mrp Total" name="art_total"   type="text">';
cell14.innerHTML ='<input id="gst'+last_id+'"  class="form-control" placeholder="Gst Total" name="gst"   type="text">';
cell15.innerHTML ='<input id="total'+last_id+'"  class="form-control" placeholder=" Total" name="total"   type="text">';

cell16.innerHTML = '<button id="add" name="add"  class="btn btn-warning" onclick="delete_rowf(this)">-</button></td>';
// 


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
        var staff_id=document.getElementById("staff_id").value;
        if (staff_id=="")
        {

        swal("select Executive first");

        // document.getElementById("sales_article_id"+last_id).value=null; 

        }
        
         else
         {


          var id1="art_name"+last_id;
          var id2="art_price"+last_id;
          var id3="art_stock"+last_id;
          var id4="art_no"+last_id;
          var id5="art_cost"+last_id;
          var id6="sgst"+last_id;
          var id7="cgst"+last_id;
          var id8="igst"+last_id;
          var id9="cess"+last_id;
       
          $.ajax(
          {
            type:"POST",
            url:"../details/article_stock.php",
             dataType:"json",
            data:{
             
              article_id:article_id,
              staff_id:staff_id
            },

            success: function(data)

            {
              var staff_stock=data.staff_stock;

              var sales_price=data.sales_price;
              var sgst=data.sgst;
              var cgst=data.cgst;
              var igst=data.igst;
              var cess=data.cess;
              var gst=document.getElementById("customer_gst").value;
              if (gst!="")
              {
                cess=0;
              }
              if(igst==""){
        igst=0;
         }
         if(cgst==""){
        cgst=0;
         }
         if(sgst==""){
        sgst=0;
         }
          if(cess==""){
        cess=0;
         }
         sgst=(sgst*sales_price)/100;
         cgst=(cgst*sales_price)/100;
         igst=(igst*sales_price)/100;
         cess=(cess*sales_price)/100;
         sgst=sgst.toFixed(2);
         cgst=cgst.toFixed(2);
         igst=igst.toFixed(2);
         cess=cess.toFixed(2);
              var article_price=data.article_price;
              var article_name=data.article_name;
              var article_no=data.article_no;
    
         // swal("staff stock :"+staff_stock);

      if (staff_stock==null) {staff_stock="No Stock Available;"}
          document.getElementById("article_stock").value=staff_stock; 
          document.getElementById("sales_price").value=sales_price; 
          document.getElementById(id1).value=article_name; 
          document.getElementById(id2).value=sales_price; 
          document.getElementById(id3).value=staff_stock; 
          document.getElementById(id4).value=article_no; 
          document.getElementById(id5).value=article_price; 
          document.getElementById(id6).value=sgst; 
          document.getElementById(id7).value=cgst; 
          document.getElementById(id8).value=igst; 
          document.getElementById(id9).value=cess; 

          document.getElementById("tax"+last_id).value=parseFloat(sgst)+parseFloat(cgst)+parseFloat(igst)+parseFloat(cess); 
             
}    
});
 } 
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
   var item_qty_element=document.getElementsByName('art_qty');
   var sales_total=document.getElementById("sales_total").value;
   var invoice_total=document.getElementById("invoice_total").value;
   var profit_total=0;
   var article_array=[];
   var item_qty=[];
   var n=0;
   for (var i = 0; i <article_element.length; i++) 
   {
      var article_id=article_element[i].value;
      var item_qty_id=item_qty_element[i].value;
      if (item_qty_id!="")
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
  
   var paid=0;
   
   var staff_id=document.getElementById("staff_id").value;
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
                     url:"../insert/sales_insert.php",
                     // dataType:"json",
                     data:
                        {
                           article_array_json:article_array_json,
                           item_qty_json:item_qty_json, 
                           sales_date:sales_date,
                           sales_time:sales_time,
                           sales_total:sales_total,
                           invoice_total:invoice_total,
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

      <script type="text/javascript">
        function display_total(qty,last_id)
        {

          var id3="art_total"+last_id;
          // var id6="price_total"+last_id;
          var id2="art_price"+last_id;
          var id1="art_qty"+last_id;

          var id4="art_stock"+last_id;
          var id5="art_cost"+last_id;

          var qty=qty;
          var mrp=document.getElementById(id2).value;
          var tax=document.getElementById("tax"+last_id).value;
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
            // document.getElementById(id6).value=" ";
          }
          else
          {

           var amount=qty*parseFloat(mrp);
           var gst=qty*parseFloat(tax);
           var cost=qty*parseFloat(price);

           document.getElementById(id3).value=amount.toFixed(2);
           // alert(amount);
           // document.getElementById(id6).value=cost;
           document.getElementById("gst"+last_id).value=gst.toFixed(2);
             var invoice_total33=parseFloat(gst)+parseFloat(amount);
           document.getElementById("total"+last_id).value=invoice_total33.toFixed(2);
         
           add_total();

         }
         


        }
      </script>
    <script>
        function add_total()
          {
            var sum=0;
            var mrp=0;
            var total=0;
            var cost_sum=0;
            var invoice_total=0;
            var qty_total=0;
            var gst_total=0;


            
             art_total=document.getElementsByName('art_total');
             art_qty=document.getElementsByName('art_qty');
             // art_cost=document.getElementsByName('price_total');
             total=document.getElementsByName('total');
              // alert(JSON.stringify(art_total));
            var gst=document.getElementsByName('gst');
            // alert(cost_element);    
            for (var i = 0; i <art_total.length; i++) 
            {
            if (art_total[i].value=="")
           
          {
             mrp=0;
             
             total_price=0;
       
             gst5=0;
             qty5=0;
            //  alert("no");
            }
            else
            {
             mrp=art_total[i].value;
             total_price=total[i].value;
             gst5=gst[i].value;
             qty5=art_qty[i].value;
            //      alert(qty+"qty");
          
          }
                 sum=sum+parseFloat(mrp);
             invoice_total=invoice_total+parseFloat(total_price);
          
             qty_total=qty_total+parseInt(qty5);
             gst_total=gst_total+parseFloat(gst5);
           
            }
            document.getElementById("sales_total").value=sum;
            document.getElementById("qty_total").value=qty_total;
            document.getElementById("gst_total").value=gst_total;
            document.getElementById("invoice_total").value=invoice_total;
 
          }

    </script>