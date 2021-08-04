<?php 
      include ("../connect.php");
session_start();
 $user_id = $_SESSION["id"];
  $user_name = $_SESSION["username"];
  date_default_timezone_set('Asia/Kolkata');
   $date = date("Y-m-d");?>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins"> 
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="shortcut icon" href="../images/logo.jpg">
  <link rel="stylesheet" href="../css/w3.css">
  <link rel="stylesheet" type="text/css" href="../css/sweetalert.css"><label hidden="">invalid</label>
  <script src="../sweetalert.min.js"></script>
  <style type="text/css">

<?php include ("../css/mycss.php")
 
?>
#main_div
{
   background: transparent url(../images/logo.png) scroll no-repeat 0 0;


}
  </style>
	<title>STOCK MANAGEMENT</title>
<style>
	#main_ddiv {

  background-image: url('../images/logo.png');
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
  <div class="col-lg-12" style="background-color: #333;">
  
 <a class="w3-bar-item w3-button w3-hover-yellow navoption" href="../staff/home2.php" >ADD  INVOICE   </a>
    <a class="w3-bar-item w3-button w3-hover-yellow navoption" href="../staff/view_sales.php" > VIEW INVOICE BILL  </a>
    <a class="w3-bar-item w3-button w3-hover-yellow navoption" href="../staff/home3.php" > ADD VOUCHER </a>
    <a class="w3-bar-item w3-button w3-hover-yellow navoption" href="../staff/vouchers.php" > VIEW VOUCHER </a>
    <a class="w3-bar-item w3-button w3-hover-yellow navoption" href="../staff/ds.php" > DIRECT SALES </a>
        <a class="w3-bar-item w3-button w3-hover-yellow navoption" href="../staff/ds_view.php" > VIEW DSALES </a>

    <a class="w3-bar-item w3-button w3-hover-white navoption" href="../logout.php" style="float: right;" >  LOG OUT &nbsp <?php echo $user_name; ?>   </a>
  </div>
  <div class="col-md-12" style="margin-top: 1vw;">
  <?php
include("../forms/sales.php");

?>
</body>



    
</html>