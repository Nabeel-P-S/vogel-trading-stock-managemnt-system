<!DOCTYPE html>
<?php
include ("connect.php");
date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d H:i:s");?>

<html>
<head>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<title>Vogel Stock Management</title>
</head>
<body>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<?php include("navbar.php") ?>
 <div class="col-md-12"> 
 <div class="col-md-3"> <?php include "forms/add_supplier.php"; ?></div>
 <div class="col-md-9"> <?php
include "view/view_supplier.php";
?>
	
</div></div>

</body>
</html>