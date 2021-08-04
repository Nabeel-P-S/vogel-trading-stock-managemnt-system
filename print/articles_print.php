<?php
include '../connect.php';
 include("../main/navbar.php") 
?>
<!DOCTYPE html>
<html>
<head>
  <title>ARTICLE list</title>
</head>
  <script type="text/javascript">
        window.onload=window.print();
    </script>
<body>

  <div id="printableArea" class="container" style="height: 42vw;">
   

<div ><h3 style="text-align: center;"><b>ARTICLE LIST</b></h3> </div>


    <div class="col-md-12" style="height: 35.85vw; overflow: auto; ">
      <table border="1" class="table-condensed table table-striped"  id="kit_table" style="border-width: 2px; *color: black;">
        <thead class="thead-dark" style="*background-color: #008080; *color: black;">



          

          <tr>
<th>ARTICLE NO:</th>
<th>ARTICLE NAME:</th>
<th>ARTICLE PRICE:</th>
<th>ARTICLE STOCK:</th>


</tr>

</thead>
<tbody id="table">
  <?php
  $query=mysqli_query($conn,"SELECT * FROM `articles`");
  while($fetch=mysqli_fetch_array($query))
  {
   $article_id=$fetch["article_id"];
   $article_name=$fetch["article_name"];
   $article_price=$fetch["article_price"];
   $article_stock=$fetch["article_stock"];

   
  
   
   ?>
   <tr onclick= "edit_category('<?php echo $article_id;?>');">
     <td style="cursor: pointer;" > <?php echo $article_id;?> </td>
     <td style="cursor: pointer;"> <?php echo $article_name;?> </td>
     <td style="cursor: pointer;"> <?php echo $article_price;?> </td>
     <td style="cursor: pointer;"> <?php echo $article_stock;?> </td>
     
     
   </tr>
    <?php

}
?>
</tbody>
</table>
</div>
</div>

<script type="text/javascript">
  function edit_category(color_id)
   {
    // alert(vendor_id);
    $.ajax({
      type:"POST",
      url:"edit/color_edit.php",
      data:{
        color_id:color_id
      },
      success:function(data)
      {
        // alert(data);
        $("#total_div").html(data);
      }

    })
  }


</script>

</body>
</html>