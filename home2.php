<?php 
      include ("connect.php");

  date_default_timezone_set('Asia/Kolkata');
   $date = date("Y-m-d");?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="shortcut icon" href="images/logo.jpg">
  <link rel="stylesheet" href="css/w3.css">
  <style type="text/css">

<?php include ("css/mycss.php")
 
?>
#main_div
{
   background: transparent url(images/logo.png) scroll no-repeat 0 0;


}
  </style>
	<title>STOCK MANAGEMENT</title>
<style>
	#main_ddiv {

  background-image: url('images/logo.png');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-position: 95% 98%;
  background-size: 350px 350px;
  height: 45vw;

}
</style>
</head>
<body>
	<div id="main_ddiv" class="col-lg-12">
  <div class="col-lg-12" style="background-color: #17a36b;">
<!--     <a class="w3-bar-item w3-button w3-hover-green navoption"  href="http://localhost/stock/home.php">STOCK</a>
 -->   
  <!-- <a class="w3-bar-item w3-button w3-hover-red navoption"  href="home2.php">INVOICE</a> -->
    <a class="w3-bar-item w3-button w3-hover-white navoption" href="logout.php" style="float: right;" >  LOG OUT  </a></div>
<br>
<br>
<br>
<br>
 <?php include "forms/line_sales.php"; ?>

</body>


    
</html>