<script>
function save_sales1(customer_id)
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
   var branch_id=document.getElementById("branch_id").value;
   var staff_id=document.getElementById("staff_id").value;
   if (branch_id==""||staff_id=="")
      {
       alert("ENTER FULL DATA");
      }
   else
      {    
        $.ajax( 
                     { 

                     type:"POST",
                     url:"../insert/sales_insert.php",
                     // dataType:"json",
                     data:
                        {
                           article_array_json:article_array_json,
                           item_price1_json:item_price1_json, 
                           sales_date:sales_date,
                           sales_total:sales_total,
                           profit_total:profit_total,
                           sales_invoice_no:sales_invoice_no,
                           customer_id:customer_id,
                           branch_id:branch_id,
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