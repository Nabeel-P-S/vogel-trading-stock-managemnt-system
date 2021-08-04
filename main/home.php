
<?php
include ("../connect.php");
include ("navbar.php");

?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Vogel | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>


 
 
<?php
include ("../connect.php");
$sql1="SELECT SUM(article_qty) as total_stock FROM `stocks`";
$sql11="SELECT SUM(article_stock) as available from articles";
$sql19="SELECT SUM(amount) as allowance from trs";
$sql12="SELECT SUM(article_qty) as estimation from estimation_articles";
$sql22="SELECT SUM(sales) as estimation_sales from estimation";
$sql13="SELECT SUM(total) as mrp from sales where category=0";
$sql14="SELECT SUM(total) as dmrp from sales where category=1";
$sql17="SELECT SUM(paid) as paid from sales";


$sql5="SELECT SUM(sales_articles.article_qty) as sold from sales_articles LEFT JOIN sales on sales.sales_id=sales_articles.sales_id WHERE sales.category=0";
$sql15="SELECT SUM(sales_articles.article_qty) as dsold from sales_articles LEFT JOIN sales on sales.sales_id=sales_articles.sales_id WHERE sales.category=1";
$sql16="SELECT SUM(foc_articles.article_qty) as fsold from foc_articles";
$sql9="SELECT SUM(sales) as total_sales FROM `sales`";
$sql3="SELECT SUM(voucher_amount) as voucher_amount FROM voucher";
$sql4="SELECT count(sales_id) as orders FROM sales";

	$query1=mysqli_query($conn,$sql1);
  $query11=mysqli_query($conn,$sql11);
  $query12=mysqli_query($conn,$sql12);
  $query22=mysqli_query($conn,$sql22);
  $query19=mysqli_query($conn,$sql19);
  $query14=mysqli_query($conn,$sql14);
  $query13=mysqli_query($conn,$sql13);
  $query17=mysqli_query($conn,$sql17);
	$query4=mysqli_query($conn,$sql4);
	$query5=mysqli_query($conn,$sql5);
  $query15=mysqli_query($conn,$sql15);
  $query16=mysqli_query($conn,$sql16);
	 $fetch1=mysqli_fetch_array($query1);
   $fetch19=mysqli_fetch_array($query19);
   $fetch11=mysqli_fetch_array($query11);
   $fetch12=mysqli_fetch_array($query12);
   $fetch22=mysqli_fetch_array($query22);
	 $fetch4=mysqli_fetch_array($query4);
	 $fetch5=mysqli_fetch_array($query5);
   $fetch15=mysqli_fetch_array($query15);
   $fetch14=mysqli_fetch_array($query14);
   $fetch13=mysqli_fetch_array($query13);
   $fetch16=mysqli_fetch_array($query16);
   $fetch17=mysqli_fetch_array($query17);
	 $total_stock=$fetch1['total_stock'];
   $allowance=$fetch19['allowance'];
   $available=$fetch11['available'];
   $estimation=$fetch12['estimation'];
   $estimation_sales=$fetch22['estimation_sales'];
   $paid=$fetch17['paid'];

	 $orders=$fetch4['orders'];
	 $sold=$fetch5['sold'];
   $mrp=$fetch13['mrp'];
   $dmrp=$fetch14['dmrp'];
   $dsold=$fetch15['dsold'];
   $fsold=$fetch16['fsold'];
	$query9=mysqli_query($conn,$sql9);
	 $fetch9=mysqli_fetch_array($query9);
	 $total_sales=$fetch9['total_sales'];
	$query3=mysqli_query($conn,$sql3); 
	$fetch3=mysqli_fetch_array($query3);
  $voucher_amount=$fetch3['voucher_amount'];
	 ?>
	 <br>


     <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $total_stock;?></h3>

                <p>In Stock</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="../view/view_stock.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
              <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo  number_format($estimation);?> </h3>
                <h3><?php echo  number_format($estimation_sales,2);?> <sup style="font-size: 20px">₹</sup></h3>

                <p>Estimation</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="../view/view_vouchers.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


               <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                
                <h4>SALES : <?php echo  number_format($mrp+$dmrp,2);?><sup style="font-size: 20px">₹</sup> </h4>
                <h3> <?php echo $sold+$dsold+$fsold;?></h3>
                   <p>Staff Sold Qty: <?php echo $sold;?></p>
                   <p>Direct sold qty: <?php echo $dsold;?></p>
                   <p>free sold qty: <?php echo $fsold;?></p>
              <!--   <h5><?php echo $sold." ".$dsold." ".$fsold;?></h5>

 -->
             
              </div>
           
              <a href="../view/view_sales.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
                <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                
                <h3> <?php echo  number_format($voucher_amount,2);?><sup style="font-size: 20px">₹</sup> </h3>
               


                <p>Vouchers </p>
             
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="../view/view_sales.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

             <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
               <div class="inner">
                <h3><?php echo $available;?></h3>

                <p>Available Stock</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="../view/view_stock.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


             <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $estimation-$sold;?> <sup style="font-size: 20px"></sup></h3>

                <span>Staff Stock</span>
                <p>Estimation Stock : <?php echo $estimation;?></p>
                <p>Invoice  Stock : <?php echo $sold;?></p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="../view/view_sales.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


     <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-active">
              <div class="inner">
                <h3><?php echo  number_format($paid,2);?> <sup style="font-size: 20px">₹</sup></h3>

                <p>Recieved Amount</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="../view/view_vouchers.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

 <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php echo  number_format($allowance,2);?> <sup style="font-size: 20px">₹</sup></h3>

                <p>Allowance</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="../forms/tr.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


 <div class="col-lg-2 col-6">
  <h4 class="success"> Top Executives</h4>
   <table class="table">
     <tr class="info">
       <td>Executive</td>
       <td>Sales</td>
     </tr>
     <?php 
$ssql="SELECT SUM(sales.total) as sales,staffs.staff_name FROM `sales` LEFT JOIN staffs on staffs.staff_id=sales.staff_id GROUP BY sales.staff_id ORDER by sales.total DESC LIMIT 5";

 
      $query=mysqli_query($conn,$ssql);
      while($fetch=mysqli_fetch_array($query))
      {
       $staff_name=$fetch["staff_name"];
       $sales=$fetch["sales"];
?>
   <tr >
     <td> <?php echo $staff_name;?> </td>
     <td> <?php echo $sales;?> </td>

   </tr>
    <?php

}
?>
   </table>
 </div>

 <div class="col-lg-2 col-6">
  <h4 class="success"> Top Articles</h4>
   <table class="table">
     <tr class="info">
       <td>Article</td>
       <td>Qty</td>
     </tr>
     <?php 
$asql="SELECT SUM(sales_articles.article_qty) as qty,articles.article_name FROM `sales_articles` LEFT JOIN articles on articles.article_id=sales_articles.article_id GROUP BY sales_articles.article_id ORDER by qty DESC LIMIT 5";

 
      $query=mysqli_query($conn,$asql);
      while($fetch=mysqli_fetch_array($query))
      {
       $article_name=$fetch["article_name"];
       $qty=$fetch["qty"];
?>
   <tr >
     <td> <?php echo $article_name;?> </td>
     <td> <?php echo $qty;?> </td>

   </tr>
    <?php

}
?>
   </table>
 </div>
</body>
</html>
