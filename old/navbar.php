<!DOCTYPE html>
<html>
<head>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="shortcut icon" href="images/logo.jpg" />
  <style type="text/css">
legend
{
color: #ab002e;
}
span
{
color: red;
}
.navbar
{
  background-color: ;
  color:black;
}
a
{
  color: white;
}

  </style>
  <title>Vogel Stock Management</title>
</head>
<body>
<nav class="navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"> <img src="../images/logo.jpeg" style="height: 4vw;width: 10vw;"></a>
    </div>
    <ul style="background-color:#ab002e;width: 80vw;" class="nav navbar-nav">
      <li ><a href="http://localhost/stock/main/add.php">ADD</a></li>
      <li ><a href="http://localhost/stock/main/erp.php">ERP</a></li>
      <li ><a href="http://localhost/stock/view/view_stock.php">STOCK</a></li>
      <li><a href="http://localhost/stock/view/view_sales.php">SALES</a></li>
      <li><a href="http://localhost/stock/view/view_article.php">ARTICLES</a></li>
      <li><a href="http://localhost/stock/view/view_supplier.php">SUPPLIERS</a></li>
      <li><a href="http://localhost/stock/view/view_customer.php">CUSTOMERS</a></li>
      <li><a href="http://localhost/stock/view/view_branch.php">BRANCHES</a></li>
      <li><a href="http://localhost/stock/view/view_staff.php">EMPLOYESS</a></li>
      
    </ul>
   <!--  <img src="images/logo.png" > -->
  </div>
</nav>
 <div class="col-md-12" style="background-image: url('images/logo.jpeg'); background-repeat: no-repeat;
  background-attachment: fixed; 
  background-position: bottom;height: 45vw;"> 
</body>
</html>
<script type="text/javascript">
     $(document).ready(function(){

  $("#myInput").on("keyup", function()

   {

    var value = $(this).val().toLowerCase();

    $("#table tr").filter(function() {

      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

    });

  });

});
</script>



