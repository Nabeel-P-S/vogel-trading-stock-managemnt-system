     <?php

 include("../main/navbar.php");

   if (!empty($_GET["sales_id"])) 
    {
$sales_id = $_GET['sales_id'];
 }
 
 else{
  $sales_id=1;
 }

include('../print/sales_details.php'); 

  
   
?>
  <div class="container-fluid">
  <div class="col-lg-12">
<form class="form-group">
<fieldset>

<!-- Form Name -->
<!-- <b>ADD SALES    <p style="float: right;">No : <?php echo $sales_id ?> </p> </b>     -->



<!-- Text input-->
<table class="table" style="*font-weight: bold;*font-family:cursive;">  
<b style="animation:forwards 5s infinite;margin-left: 30vw;font-size: 2vw;color: black;*background-color: brown;">EDIT SALES BILL</b>
<tr>
  <td>
    <div class="input-group"  >
    <span class="input-group">SALES DATE</span>
    <input id="sales_date"  class="form-control" readonly="1" name="sales_date" value="<?php echo $sales_date ?>"  >
       <span class="input-group">TODAY</span>
    <input id="grv_date" type="date" readonly="1" class="form-control" name="grv_date" value="<?php echo $date ?>"  >
  </div>
  </td>
  <td>
 <div class="input-group">
    <span class="input-group">INVOICE NO</span>
    <input id="sales_invoice_no" type="text" class="form-control" value="<?php echo $invoice_no ?>" name="invoice_no" >
       <span class="input-group">SALES ID</span>
    <input id="sales_id" type="text" class="form-control" readonly="1" value="<?php echo $sales_id ?>" name="sales_id" >
  </div>
  </td>
<td>
 <div class="input-group">
    <span class="input-group">BRANCH</span>
  

      <input type="text" id="branch_id" name="branch_id" readonly="1"  value="<?php echo $branch_name ?>"  class="form-control">





    <span class="input-group">STAFF</span>
   <input value="<?php echo $staff_name ?>" id="staff_id" readonly="1" class="form-control" name="staff_id" placeholder="SEARCH STAFF" >
  </div></td></tr>


<tr>
  <td colspan="4">

<div id="customer_div"> 

     <span class="input-group">CUSTOMER DETAILS</span>
<table class="table-condensed">
  <tr >
    <td> 
  

    <input id="customer_id" readonly="1" class="form-control" readonly="1" name="customer_id" value=" <?php echo $customer_id;?>"  >



</td>
<td>

       <input id="customer_name" type="text" class="form-control" readonly="1" name="customer_name" value=" <?php echo $customer_name;?>" >
</td>
  <td>


    <input id="customer_address" type="text" class="form-control" readonly="1" name="customer_address" value=" <?php echo $customer_address;?>"  >

  </td>
  <td>

    
    <input id="customer_phone" type="number" class="form-control" readonly="1" name="customer_phone" value=" <?php echo $customer_phone;?>" >

  </td>
  <td>


    <input id="customer_gst" type="text" class="form-control" readonly="1" name="customer_gst"value=" <?php echo $customer_gst;?>" >
  </td>
  </tr>
</table>

</div>





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

  <td>QTY</td>
  <td>Price Total</td>
  <td style="display: <?php if ($user_name=="shybi")
       echo "block"; else echo "none"; ?>;color: green;">Mrp Total</td>

</tr>
<?php
  $last_id=0;
while($fetch_article=mysqli_fetch_array($article_query))
      {
        $last_id+=1;
         $article_name=$fetch_article["article_name"];
        $article_no=$fetch_article["article_no"];
        $article_id=$fetch_article["article_id"];
        $article_quantity=$fetch_article["article_qty"];
        $sales_price=$fetch_article["sales_price"];
        $article_price=$fetch_article["article_price"];

        ?>

        <tr>
          <td style="*width: 10VW;">
           <div class="fill">
           
              <input list="articles" id="sales_article_id<?php echo $last_id;?>" readonly="1"  name="sales_article_id" value="<?php echo $article_id;?>"  class="form-control">
              
          </div>
       </td>
        <td  >  
         
          <input id="art_no<?php echo $last_id;?>" type="text" readonly="1" class="form-control" name="art_name" value="<?php echo $article_no;?>">
      </td>

        <td  style="width: 18VW;">  
         
          <input id="art_name<?php echo $last_id;?>" readonly="1" type="text" class="form-control" name="art_name" value="<?php echo $article_name;?>" >
      </td>
         <td style="display: <?php if ($user_name=="shybi")
       echo "block"; else echo "none"; ?>;color: green;"> 

       <input id="art_cost<?php echo $last_id;?>"  type="text" readonly="1" class="form-control" name="art_cost" value="<?php echo $article_price;?>" >
         </td>

     <td> 

       <input id="art_price<?php echo $last_id;?>" type="text" readonly="1" class="form-control" name="art_price" value="<?php echo $sales_price?>">
    
       <td>   
          
         <input id="art_qty<?php echo $last_id;?>" type="text" onchange="display_total(this.value,<?php echo $last_id;?>);" class="form-control" name="item_qnty1" value="<?php echo $article_quantity;?>">
    
      </td>
        <td style="display: <?php if ($user_name=="shybi")
       echo "block"; else echo "none"; ?>;color: green;" >   
          
         <input id="price_total<?php echo $last_id;?>" type="text"  class="form-control" value="<?php echo $article_quantity*$article_price;?>" name="price_total" placeholder="price Total">
    
      </td>
       <td>   

         <input id="art_total<?php echo $last_id;?>" name="art_total" style="color: red;" type="text"   class="form-control"  value="<?php echo $article_quantity*$sales_price;?>">
       
      </td>
     <td>
       <button id="add" name="add"  class="btn btn-warning" onclick="delete_rowf(this)">-</button>
     </td>
        </tr> 
      <?php 

    }?>
                <input  type="hidden" value="1" id="last_id" >

    <td colspan="5">    
     <button type="button"  id="add" name="add" class="btn btn-success" onclick="add_row(this,'article_table')">+ ADD</button>
</td> 

<!-- 
<td style="display: <?php if ($user_name=="shybi")
       echo "block"; else echo "none"; ?>;color: blue;float: right;"><b >MARGIN</b> </td> -->
<td style="display: <?php if ($user_name=="shybi")
       echo "block"; else echo "none"; ?>;color: blue;" colspan="0"> <input id="profit_total" value="<?php echo $profit;?>" style="color: blue;font-weight: bold;" readonly="1" name="profit" class="form-control">
</td>

<td > <input id="cost_total" style="display: <?php if ($user_name=="shybi")
       echo "block"; else echo "none"; ?>;color: green;" readonly="1" name="cost_total" class="form-control" >
</td>

<td > <input id="sales_total" style="color: red;font-weight: bold;" readonly="1" value="<?php echo $sales;?>"  name="sales_total" class="form-control" >
</td>

   </table>


  <div >
    
    
    <button  style="margin-left: 30vw;width: 20vw;" onclick="update_sales()"  class="btn-primary btn">UPDATE BALANCE</button>
 <span style="margin-left: 6vw">PAID</span>   <input style="font-size: 2vw;width: 8vw;"   id="paid" type="text"    value="<?php echo $paid;?>" name="paid" >
    <!-- <span>BALANCE</span>     <input id="balance" type="text"   value="<?php echo $sales-$paid;?>" name="balance" > -->
 
  </div>

    </div>
    </td>
  </tr>
</table>










<!-- Button -->


</fieldset>
</form>

  </div>
  <div style="display: none;" class="col-md-2"> 


              <div class="input-group">
              <legend>FIND GRV STOCK</legend>
              <input list="articles" id="article_id1" style="font-size: 1vw;" name="article_id" onkeyup="display_article_sale();" placeholder="SELECT BILL" class="form-control">
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
              <a class="btn btn-primary"  href="../print/sale.php">PRINT ARTICLE SALES</a>
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
cell7.innerHTML ='<input id="art_qty'+last_id+'" onchange="display_total(this.value,'+last_id+');" name="item_qnty1"  class="form-control" placeholder="QTY"   type="text">';

cell8.innerHTML ='<input id="price_total'+last_id+'" class="form-control" placeholder="Price Total" name="price_total"   type="text">';
cell9.innerHTML ='<input id="art_total'+last_id+'" style="color:red;"  class="form-control" placeholder="Mrp Total" name="art_total"   type="text">';

cell10.innerHTML = '<button id="add" name="add"  class="btn btn-warning" onclick="delete_rowf(this)">-</button></td>';



}

</script>
<script>
  function  delete_rowf(element) {
    var row_id = element.parentNode.parentNode.rowIndex;
    // alert(row_id);
    document.getElementById("article_table").deleteRow(row_id);
    // add_total();
  }
</script>
<script>
          function display_article_stock(article_id,last_id)
          {

    

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
function update_sales()
{

  // alert("editing");
            var sales_id=document.getElementById("sales_id").value;
            var paid=document.getElementById("paid").value;
 // alert(sales_id+paid);
        $.ajax( 
            { 

              type:"POST",
              url:"../update/sales_update.php",
              // dataType:"json",
              data:{
               
                sales_id:sales_id,
                paid:paid
              },

              success: function(data)

              {
             
                  // alert(data); 
                 window.location="../view/view_sales.php";
                          
                     }   
          });

             
              
                 
                 
 
         
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
          function display_article_grv()
          {
        

          var article_id=document.getElementById("article_id1").value;
       
          $.ajax(
          {
            type:"POST",
            url:"../details/grv_sale.php",
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
         
                  // var last_id=document.getElementById("last_id").value;
                  // var sales_total=document.getElementById("sales_total").value;
                  // var profit=document.getElementById("profit_total").value;
   // if (sales_total=="")
   //          sales_total=0;
   //        if (profit=="")
   //          profit=0;
          var id3="art_total"+last_id;
          var id6="price_total"+last_id;
          var id2="art_price"+last_id;
          var id1="art_qty"+last_id;
     
          var id4="art_stock"+last_id;
          var id5="art_cost"+last_id;

             var qty=qty;
             var mrp=document.getElementById(id2).value;
             var price=document.getElementById(id5).value;
          
     
            
             var amount=qty*parseFloat(mrp);
             var cost=qty*parseFloat(price);
             document.getElementById(id3).value=amount;
             document.getElementById(id6).value=cost;
       
             add_total();
        
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
  // alert(sum);
  


              document.getElementById("sales_total").value=sum;
              document.getElementById("cost_total").value=cost_sum;
              document.getElementById("profit_total").value=profit;


}

</script>
<script type="text/javascript">
  function grv_refresh(sales_id)
  {
    // alert(invoice_no);
    // document.getElementById("sales_id").value=invoice_no;
window.location="view_sales.php?sales_id=" + sales_id;
  }
</script>