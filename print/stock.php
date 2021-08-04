<?php
include '../connect.php';
  date_default_timezone_set('Asia/Kolkata');
   $date = date("d-m-Y");
?>
<!DOCTYPE html>
<html>
<head>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="shortcut icon" href="../images/logo.jpg">
  <link rel="stylesheet" href="../css/w3.css">
  <style type="text/css">

<?php include ("../css/mycss.php")
 
?>

  </style>

  <title>Vogel Stock Management</title>
</head>
  <script type="text/javascript">
        // window.onload=window.print();
    </script>
<body>

  <div id="printableArea" class="container" style="height: 42vw;">
   

<div><h3 style="text-align: center;"><b>ARTICLE STOCK ON <?php echo $date;?></b></h3> </div>


    <div  class="col-md-12" style="overflow: auto; ">
      <table border="1" class="table-condensed table table-striped"  id="kit_table" style="border-width: 2px; *color: black;">
        <thead class="thead-dark" style="*background-color: #008080; *color: black;">



          

          <tr>
<th>ARTICLE NO:</th>
<th>ARTICLE NAME:</th>
<th>CURRENT STOCK:</th>


</tr>

</thead>
<tbody id="table">
  <?php
  $query=mysqli_query($conn,"SELECT stocks.article_id,articles.article_no,articles.article_name,SUM(article_qty) as total FROM `stocks`LEFT JOIN articles on articles.article_id=stocks.article_id GROUP BY article_id");
  while($fetch=mysqli_fetch_array($query))
  {
   $article_name=$fetch["article_name"];
   $article_qty=$fetch["total"];
   $article_id=$fetch["article_no"];

   
  
   
   ?>
   <tr onclick= "edit_category('<?php echo $article_id;?>');">
     <td style="cursor: pointer;" > <?php echo $article_id;?> </td>
     <td style="cursor: pointer;"> <?php echo $article_name;?> </td>
     <td style="cursor: pointer;"> <?php echo $article_qty;?> </td>
     
     
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