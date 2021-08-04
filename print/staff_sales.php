<?php
include '../connect.php';
 include("../main/navbar.php") 
?>
<!DOCTYPE html>
<html>
<head>
  <title>ARTICLE SALES</title>
</head>
  <script type="text/javascript">
        window.onload=window.print();
    </script>
<body>

  <div id="printableArea" class="container" >
   

<div><h3 style="text-align: center;"><b>STAFF SALES</b></h3> </div>


    <div  class="col-md-12" style="*height: 35.85vw; overflow: auto; ">
      <table border="1" class="table">
        <thead class="thead-dark" >



          

          <tr>
<th>STAFF NO:</th>
<th>STAFF NAME:</th>
<!-- <th>SELL QTY:</th> -->
<th>SALES:</th>
<th>MARGIN:</th>


</tr>

</thead>
<tbody id="table">
  <?php
  $sql="SELECT staffs.staff_id,
       staffs.staff_name,
       Sum(sales.sales) as sales,
       Sum(sales.profit) as profit
FROM   staffs
       LEFT JOIN sales
              ON sales.staff_id = staffs.staff_id
       LEFT JOIN sales_articles
              ON sales_articles.sales_id = sales.sales_id
GROUP  BY staffs.staff_id";
  $query=mysqli_query($conn,$sql);
  while($fetch=mysqli_fetch_array($query))
  {
   $staff_id=$fetch["staff_id"];
   $staff_name=$fetch["staff_name"];
   $sales=$fetch["sales"];
   $profit=$fetch["profit"];

   
  
   
   ?>
   <tr class="table_row">
     <td style="cursor: pointer;" > <?php echo $staff_id;?> </td>
     <td style="cursor: pointer;"> <?php echo $staff_name;?> </td>
     <td style="cursor: pointer;"> <?php echo $sales;?> </td>
     <td style="cursor: pointer;"> <?php echo $profit;?> </td>
     
     
   </tr>
    <?php

}
?>
</tbody>
</table>
</div>
</div>



</body>
</html>










