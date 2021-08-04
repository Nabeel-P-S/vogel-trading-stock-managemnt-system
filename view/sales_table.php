     <div class="col-lg-8" ><input class="form-control" placeholder="Search" id="myInput" type="text" style="width: 12vw;color: black;margin-bottom: 1vw;">   </div>
     <div class="col-lg-4" >
 
     <!--  <input type="date" class="form-control filter" id="from_date"  value="<?php echo $date1; ?>"> 
      <input type="date" class="form-control filter" id="to_date" value="<?php echo $date2; ?>"  >
    
<input type="button" class="btn btn-success"  onclick="filter_date()" value="OK" > -->
      <!-- <a class="btn btn-danger"  href="../print/sales_print.php">PRINT</a> -->
<button class="btn btn-danger"  onclick="print_page()">PRINT REPORT</button>
</div> 



    <div id="printableArea"  class="col-md-12" style="*height: 35.85vw; overflow: auto; ">
      <h3 style="text-align: center;"><b>SALES LIST  </b></h3>
      <table border="1" class="table-condensed table table-striped"  id="kit_table" style="border-width: 2px; *color: black;">
        <thead class="thead-dark">



          <tr class="table_head" >
<th style="width: 3vw;">NO</th>

<th style="width: 7vw;">Date</th>

<th style="text-align: center;">CUSTOMER NAME </th>
<th style="text-align: center;">BRANCH NAME </th>
<th style="text-align: center;">STAFF NAME </th>
<th style="text-align: center;">SALES</th>
<th style="text-align: center;">PROFIT</th>


<!-- <th style="text-align: center;"> </th>
 -->
</tr>

</thead>
<tbody id="table">
  <?php
$query = mysqli_query($conn, $sales_sql);

$qty_sum = 0;
$sales_sum = 0;
$margin_sum = 0;

$count = 0;
while ($fetch = mysqli_fetch_array($query))
{
    $sales_id = $fetch["sales_id"];
    $sales_qty = $fetch["sales_qty"];
    $sales_price = $fetch["sales_price"];
    $sales_date = $fetch["sales_date"];
    $article_name = $fetch["article_name"];
    $article_id = $fetch["article_id"];
    $article_price = $fetch["article_price"];
    $customer_name = $fetch["customer_name"];
    $customer_id = $fetch["customer_id"];
     $branch_name = $fetch["branch_name"];
    $staff_name = $fetch["staff_name"];
    $branch_id = $fetch["branch_id"];
    $staff_id = $fetch["staff_id"];
    $sales = $fetch["sales"];

    $qty_sum = $qty_sum + $sales_qty;
    $margin = ($sales_price - $article_price) * $sales_qty;
    $sales_sum = $sales_sum + $sales;

    $count++;

?>
   <tr class="table_row" style="cursor: pointer;">
     <td onclick="delete_sale('<?php echo $sales_id;?>')"> <?php echo $sales_id; ?> </td>
    
     <td onclick= "open_size_list('<?php echo $sales_id;?>');"> <?php echo $sales_date; ?> </td>
<!--      <td> <a href="view_sales.php?article_id=<?php echo $article_id ?>&article_name=<?php echo $article_name?>"> <?php echo $article_name; ?> </a></td>
 -->     <td onclick="refresh_again1('<?php echo $customer_id;?>','customer_id')"> <?php echo $customer_name; ?> </td>
     <td> <a href="view_sales.php?branch_id=<?php echo $branch_id ?>&branch_name=<?php echo $branch_name?>"> <?php echo $branch_name;?> </a></td>
     <td> <a href="view_sales.php?staff_id=<?php echo $staff_id ?>&staff_name=<?php echo $staff_name?>"> <?php echo $staff_name; ?> </a></td>
     <td> <a > <?php echo $sales; ?> </a></td>
     <td> <a > <?php echo $sales; ?> </a></td>
<!--       <td > <?php echo $sales_qty; ?> </td>
     <td> <?php echo $sales_price; ?> </td>
     <td>  <?php echo $margin; ?> </td>
 -->
<!--      <td>  <button class="btn  btn-info"  style="height: 1.5vw;" onclick= "edit_customer('<?php echo $customer_id; ?>');"> Edit </button> <button class="btn  btn-danger"style="height: 1.5vw;" onclick= "edit_customer('<?php echo $customer_id; ?>');"> Delet </button> </td>
 -->     
     
     
   </tr>
 
   <tr >
  <td colspan="7" style="padding: 0;">
     <div style="display: none;" id="size_td<?php echo $sales_id; ?>">

      <table class="table" >
        <thead class="table_head" style="background-color:#009e52;color: white;">
   <tr >
           <th >SL NO:</th>
           <th style="text-align: center;"> ARTICLE NO </th>
           <th style="text-align: center;"> ARTICLE NAME </th>
           <th style="text-align: center;"> ARTICLE PRICE </th>
            <th style="text-align: center;"> ARTICLE QUANTITY</th>
            <th style="text-align: center;">COST</th>

          </tr>
        </thead>
    <?php
              $query2=mysqli_query($conn,"SELECT sales_articles.sales_id, sales_articles.article_id,sales_articles.article_qty,articles.article_no,articles.sales_price, sales_articles.id,articles.article_name FROM `sales_articles` left join `articles` on articles.article_id=sales_articles.article_id  WHERE sales_articles.sales_id='$sales_id'");
                 $sleno=1;
                while ($fetch2=mysqli_fetch_array($query2))
                 {
                 $id=$fetch2['id'];
            
         
                $article_name=$fetch2['article_name'];
                 $article_no=$fetch2['article_no'];
                 $sales_price=$fetch2['sales_price'];
                 $article_qty=$fetch2['article_qty'];
                 $cost=$sales_price*$article_qty;

        
          ?>
     

<tr class="table_row">

          <td> <?php echo $sleno; ?></td>
          <td> <?php echo $article_no; ?></td>
          <td> <?php echo $article_name; ?></td>
          <td> <?php echo $sales_price; ?></td>
          <td> <?php echo $article_qty; ?></td>
          <td> <?php echo $cost; ?></td>
          

        </tr>



<?php
$sleno++;
  }
    ?>
    
  </table>
      </div>
    </td>
  </tr>
    <?php
}
?>
  <tr class="table_summary" >    

      <th colspan="2">TOTAL </th>
      <th colspan="3">ORDERS : <?php echo $count; ?> </th>
      <th colspan="3">SALES : <?php echo $sales_sum; ?> Rs</th>
     
      <!-- <th colspan="2">Margin : <?php echo $margin_sum; ?> Rs</th> -->
     
      
     </tr>
</tbody>
</table>
</div>

</div>
<script type="text/javascript">
  function open_size_list(sales_id)
  {

if (document.getElementById("size_td"+sales_id).style.display=="block")
{
  document.getElementById("size_td"+sales_id).style.display="none";
  }
  else
  {
   document.getElementById("size_td"+sales_id).style.display="block"; 
  }
}
</script>
<script type="text/javascript">

  function refresh_again1(value,name)
  {

window.location="view_sales.php?value=" + value + "&name=" + name;

  }

</script>