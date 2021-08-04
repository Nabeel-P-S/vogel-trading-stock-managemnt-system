  <?php 
  
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  date_default_timezone_set('Asia/Kolkata');
   $time=date("h:i:sa");
   $date = date("Y-m-d");



   ob_start();
include ("../connect.php");

 $user_id = $_SESSION["id"];
  $user_name = $_SESSION["username"];
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../login.php");
  exit;
 
}
else if ($user_id==2)
{
  header("location: ../staff/home.php");
}
else if ($user_id==3)
{
  header("location: ../staff/home1.php");
}
else if ($user_id==4)
{
  header("location: ../staff/home3.php");
}

function vround( $number)
{
  $whole = floor($number);     
  $fraction = $number - $whole;
  if (( $fraction <= 0.54 && $fraction>0.04))    
  {
    $result= $whole+.50;
  }
  else if (( $fraction > 0.54 ))  
  {
    $result=$whole+1;
  }
  else{
    $result=$whole;
  }
  return ($result);
}



   ?>















<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins"> 
  <!-- <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'> -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="shortcut icon" href="../images/logo.jpg">
  <link rel="stylesheet" href="../css/w3.css">
  <link rel="stylesheet" href="../css/tab.css">
  <link rel="stylesheet" type="text/css" href="../css/sweetalert.css"><label hidden="">invalid</label>
  <script src="../sweetalert.min.js"></script>
  
  <style type="text/css">

<?php include ("../css/mycss.php")?>

  </style>
<style>
body {margin:0;}

.navbar {
  overflow: hidden;
  background-image: url("../images/blue.jpeg");
  /*background-size: cover;*/
  /*background-repeat: no-repeat;*/
  /*background-color: #f5d451;*/
  /*background-color: #350D36;*/
  /*background-color: #0379AC;*/

  position: fixed;
  top: 0;
  width: 100%;
}

.navbar a {
  float: left;
  display: block;
  color: white;
  text-align: center;
  padding: 10px 11px;
  text-decoration: none;
  font-size: 13px;
}

.navbar a:hover {
  background:#011647;
 
  /*color: yellow;*/
  font-weight: bold;
}

.main {
  padding: 10px;
  margin-top: 100px;
  /*height: 1500px;*/
  /*overflow: auto;  Used in this example to enable scrolling */
}
#main_div
{
/*transform: translateY(4vw;);*/

}
</style>
</head>
<body >


  <div class="navbar" >
    <a href="../main/home.php">HOME</a>
    <a href="../main/add.php">ADD</a>
    <a  href="../forms/add_article.php">ARTICLE</a>
    <a href="../view/view_article.php">ARTICLE LIST </a>
    <a  href="../forms/add_staff.php">STAFF</a>
    <a href="../view/view_staff.php">STAFF LIST </a>
    <a  href="../forms/add_stock.php">STOCK</a>
    <a  href="../view/view_stock.php">STOCK LIST</a>
    <a  href="../forms/add_line_sales.php">ESTIMATION</a>
    <a href="../view/view_estimation.php">EST BILLS</a>
    <a  href="../forms/add_sales.php">Add INVOICE</a>
    <a  href="../view/view_sales.php">INVOICES</a>
    <a  href="../view/final.php">FINAL</a>
    <a  href="../view/item_sales.php?value=1">ARTICLE STATUS</a>
    <a  href="../view/employee_sales.php?value=2">STAFF STATUS</a>
    <a  href="../view/view_supplier.php">SUPPLIERS</a>
    <a  href="../view/view_customer.php">CUSTOMERS</a>
    <a  href="../view/view_branch.php">BRANCHES</a>
    <!-- <a href="../forms/add_grv.php">ADD GRV</a> -->
    <!-- <a  href="../view/view_grv.php">GRV LIST</a> -->
    <a  href="../view/view_staff_grv.php"> GRV LIST</a>

    <a  href="../forms/voucher.php">ADD VOUCHER</a>
    <a href="../view/view_vouchers.php">VOUCHERS</a>
    <a  href="../forms/add_foc.php">ADD FOC</a>
    <a  href="../view/view_foc.php">FOC LIST </a>
      <a  href="../forms/add_dsales.php">ADD SALES</a>
    <a  href="../view/view_dsales.php">SALES LIST </a>
 
      <a  href="../view/staff_status.php?value=2">EXECUTIVE LIST</a>
      <a  href="../view/staff_stock.php">STAFF STOCK</a>
           <a  href="../forms/ATTE.php">ADD ATTENDNCE</a>
      <a  href="../forms/attendance.php">VIEW ATTENDNCE</a>
     <a  href="../forms/tr.php">ADVANCE</a>
         <a  href="../logout.php">log out</a>
  </div> 


     <!--   <li ><a class="w3-bar-item w3-button w3-hover-pink navoption" href="../main/home.php">HOME</a></li> -->




 <div class="main" id="main_div" style="overflow: auto; height: 42.5vw;"> 

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

      function print_page()
  {
    
    window.print()
  }
</script>



