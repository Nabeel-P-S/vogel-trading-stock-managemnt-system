<?php
include '../connect.php';include("../main/navbar.php") 
?>
<!DOCTYPE html>
<html>
<head>
  <title>branch list</title>
</head>
  <script type="text/javascript">
        window.onload=window.print();
    </script>
<body>

 <div class="container" style="height: 42vw;">
 

<div><h3 style="text-align: center;"><b>BRANCHES LIST</b></h3> </div>

    <div class="col-md-12" style="height: 35.85vw; overflow: auto; ">
      <table border="1" class="table-condensed table table-striped"  id="kit_table" style="border-width: 2px; *color: black;">
        <thead class="thead-dark" style="*background-color: #008080; *color: black;">



          

          <tr>
<th style="*width: 5vw;">branch NO:</th>
<th style="*width: 5vw;">branch NAME:</th>


</tr>

</thead>
<tbody id="table">
  <?php
  $query=mysqli_query($conn,"SELECT * FROM `branches`");
  while($fetch=mysqli_fetch_array($query))
  {
   $branch_id=$fetch["branch_id"];
   $branch_name=$fetch["branch_name"];

   
  
   
   ?>
   <tr onclick= "edit_category('<?php echo $branch_id;?>');">
     <td style="cursor: pointer;" > <?php echo $branch_id;?> </td>
     <td style="cursor: pointer;"> <?php echo $branch_name;?> </td>
     
     
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