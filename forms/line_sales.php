
   <?php
 
  $query = mysqli_query($conn, "select sales_id from estimation order by sales_id desc LIMIT 1");
$fetch = mysqli_fetch_array($query);
$sales_id = $fetch['sales_id']+1 ;
?>

  <div class="container-fluid">
  <div class="col-lg-12">
<form class="form-group">
<fieldset>

<!-- Form Name -->
<h2>ESTIMATION BILL   <p style="float: right;">No : <?php echo $sales_id ?> </p> </h2>    



<!-- Text input-->
<table class="table">  
<tr>
  <td>
    <div class="input-group">
    <span class="input-group">SALES DATE</span>
    <input id="sales_date" type="date" class="form-control" name="sales_date" value="<?php echo $date ?>"  >
      
  </div>
  </td>
   <td>
 <div class="input-group">
    <span class="input-group">SALES TIME</span>
     <input id="sales_time" type="time" class="form-control"   name="sales_time" value="<?php echo $time?>" >
  </div>
  </td>
  <td>
 <div class="input-group">
    <span class="input-group">ESTIMATION NO</span>
    <input id="sales_id" type="text" class="form-control" readonly="1" value="<?php echo $sales_id ?>" name="invoice_no" >
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

</tr>
        <tr>
          <td style="*width: 10VW;">
           <div class="fill">
           
              <input list="articles" id="sales_article_id"  name="sales_article_id" onchange="display_article_stock(this.value,'1');" placeholder="ID" class="form-control">
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
        <!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\ HIDDEN FIELDS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->

                <input  type="hidden" value="1" id="last_id" >

                        <!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\ HIDDEN FIELDS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->


    <td colspan="6">    
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

<td > <input id="sales_total" style="color: red;font-weight: bold;" readonly="1" name="sales_total" class="form-control" >
</td>


   </table>


  <div >
    
    <!-- <span>BALANCE</span>     <input id="balance" type="text"   value="<?php echo $sales-$paid;?>" name="balance" > -->
    <button  onclick="save_sales()" style="width: 20vw;margin-left: 20vw;" class="btn btn-success">SAVE ESTIMATION BILL</button>
 

    <button  class="btn btn-warning"> <a href="../print/sales_bill.php?sales_id=<?php echo $sales_id-1;?>" > PREVIOUS Estimation bill</a></button>
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

</div>
   <script type="text/javascript">
     function add_row(x,y) 
     {

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

            $.ajax(
            {
            type:"POST",
            url:"../details/staff_article_stock.php",
            dataType:"json",
            data:{

            article_id:article_id,
            staff_id:staff_id
            },

            success: function(data)

            {

            var article_stock=data.article_stock;
            var staff_stock=data.staff_stock;
            var article_limit=data.article_limit;
          
            var sales_price=data.sales_price;
            var article_price=data.article_price;
            var article_name=data.article_name;
            var article_no=data.article_no;
swal("Staff stock :"+staff_stock+"  "+"\nArticle Limit :"+article_limit);

            if (article_stock==null) {article_stock="No Stock Available;"}
           
            document.getElementById(id1).value=article_name; 
            document.getElementById(id2).value=sales_price; 
            document.getElementById(id3).value=article_stock; 

            document.getElementById(id4).value=article_no; 
            document.getElementById(id5).value=article_price; 



            }    
            });

        }
      }
      </script>
      
      <script>
function save_sales()
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
  
  

   var staff_id=document.getElementById("staff_id").value;
   if (staff_id==""||sales_total=="")
      {
       alert("ENTER FULL DATA");
      }
   else
      {  
         alert("ESTIMATION BILL ADDED ");
       $.ajax( 
                     { 

                     type:"POST",
                     url:"../insert/line_sales_insert.php",
                     // dataType:"json",
                     data:
                        {
                           article_array_json:article_array_json,
                           item_qty_json:item_qty_json, 
                           sales_date:sales_date,
                           sales_time:sales_time,
                           sales_total:sales_total,
                           profit_total:profit_total,
                       
                         
                           staff_id:staff_id
                        },
                     success: function(data)
                           {

                           // alert(data);
                           alert("ESTIMATION BILL ADDED ");  
                           }   
                     }
               );
     }







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

// ==============================================================================================
    var staff_id=document.getElementById("staff_id").value;

            $.ajax(
            {
            type:"POST",
            url:"../details/staff_money.php",
            dataType:"json",
            data:{

            staff_id:staff_id
            },

            success: function(data)

            {
// alert(data);
            var staff_taken=data.staff_taken;
            var paid=data.paid;
            if (paid==null){
              paid=0;
            }
            var amount_limit=data.amount_limit;
          
swal(" Stock Amount Estimated :"+staff_taken+"  "+"\nPaid Amount :"+paid+"\nAmount Limit :"+amount_limit+"\nStock Amount Estimating Now :"+sum);

            



            }    
            });



// ==============================================================================================


            document.getElementById("cost_total").value=cost_sum;
        
            document.getElementById("profit_total").value=profit;

          }

    </script>