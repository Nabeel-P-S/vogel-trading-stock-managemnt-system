
<?php
include ("../connect.php");
include ("navbar.php");

?>

<html>
<head>


</head>
<body>


 
 <div class="col-md-3">

  	  <table border="1" class="table-condensed" style="*font-size: .9vw;">
        <thead >
                   <tr>
                      <th> article</th>
            <!--           <th>ARTICLE NAME:</th> -->
                      <th> price</th>
                      <th> mrp</th>
                      <th> stock:</th>
                   <!--      <th>SALES:</th>
                      <th> AVAILABLE:</th> -->
                    
                    </tr>

        </thead>
<tbody id="table">
<?php
        $sql="SELECT articles.article_id,
           articles.article_name,
           articles.article_no,
             articles.article_price,
             articles.sales_price,
               articles.article_stock AS available,
           Sum(sales_articles.article_qty) as sales,
           Sum(stocks.article_qty) as article_stock
                FROM   articles
           LEFT JOIN sales_articles
                  ON sales_articles.article_id = articles.article_id 
            LEFT JOIN stocks
                  ON stocks.article_id = articles.article_id
        GROUP  BY articles.article_id";
      $query=mysqli_query($conn,$sql);
      while($fetch=mysqli_fetch_array($query))
      {
       $article_no=$fetch["article_no"];
       $article_name=$fetch["article_name"];
       $article_price=$fetch["article_price"];
       $sales_price=$fetch["sales_price"];
       $article_stock=$fetch["article_stock"];
       $sales=$fetch["sales"];
       $available=$fetch["available"];

   
  
   
?>
   <tr class="table_row">
     <td style="cursor: pointer;" > <?php echo $article_no;?> </td>
  <!--    <td style="cursor: pointer;"> <?php echo $article_name;?> </td> -->
     <td style="cursor: pointer;"> <?php echo $article_price;?> </td>
     <td style="cursor: pointer;"> <?php echo $sales_price;?> </td>
          <td style="cursor: pointer;"> <?php echo $article_stock;?> </td>
   <!--   <td style="cursor: pointer;"> <?php echo $sales;?> </td>  
     <td style="cursor: pointer;"> <?php echo $available;?> </td>
  -->
   </tr>
    <?php

}
?>
</tbody>
</table>
  </div>

 <div class="col-md-" style="display: visible;">

  <table border="1" class="table-condensed">
        <thead >



          

          <tr>
<!-- <th>STAFF NO:</th> -->
<th>branch </th>
<!-- <th>SELL QTY:</th> -->
<th>sales</th>
<th>margin</th>


</tr>

</thead>
<tbody id="table">
  <?php
  $sql2="SELECT branches.branch_id,
       branches.branch_name,
       Sum(sales.sales) as sales,
       Sum(sales.profit) as profit
FROM   branches
       LEFT JOIN sales
              ON sales.branch_id = branches.branch_id
       LEFT JOIN sales_articles
              ON sales_articles.sales_id = sales.sales_id
GROUP  BY branches.branch_id";
  $query2=mysqli_query($conn,$sql2);
  if (!$query2) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
  while($fetch=mysqli_fetch_array($query2))
  {
   // $staff_id=$fetch["staff_id"];
   $branch_name=$fetch["branch_name"];
   $sales=$fetch["sales"];
   $profit=$fetch["profit"];

   
  
   
   ?>
   <tr class="table_row">
<!--      <td style="cursor: pointer;" > <?php echo $staff_id;?> </td>
 -->     <td style="cursor: pointer;"> <?php echo $branch_name;?> </td>
     <td style="cursor: pointer;"> <?php echo number_format($sales,2);?> </td>
     <td style="cursor: pointer;"> <?php echo  number_format($profit,2);?> </td>
     
     
   </tr>
    <?php

}
?>
</tbody>
</table>
<?php
include ("../connect.php");
$sql1="SELECT SUM(article_qty) as total_stock FROM `stocks`";
$sql5="SELECT SUM(article_qty) as sold FROM `sales_articles`";
$sql9="SELECT SUM(sales) as total_sales FROM `sales`";
$sql3="SELECT SUM(profit) as total_profit FROM sales";
$sql4="SELECT count(sales_id) as orders FROM sales";

	$query1=mysqli_query($conn,$sql1);
	$query4=mysqli_query($conn,$sql4);
	$query5=mysqli_query($conn,$sql5);
	 $fetch1=mysqli_fetch_array($query1);
	 $fetch4=mysqli_fetch_array($query4);
	 $fetch5=mysqli_fetch_array($query5);
	 $total_stock=$fetch1['total_stock'];
	 $orders=$fetch4['orders'];
	 $sold=$fetch5['sold'];
	$query9=mysqli_query($conn,$sql9);
	 $fetch9=mysqli_fetch_array($query9);
	 $total_sales=$fetch9['total_sales'];
	$query3=mysqli_query($conn,$sql3); 
	$fetch3=mysqli_fetch_array($query3);$total_profit=$fetch3['total_profit'];
	 ?>
	 <br>
<div style="border:4px double #036e64;border-radius: .5vw;text-align:  center;padding: 1vw;">
  	<legend >TOTAL : <?php echo $orders." "."Orders";?></legend>
  	<legend>SALES : <?php echo number_format($total_sales,2)  ;?></legend>
  	<legend>PROFIT : <?php echo number_format($total_profit,2);?> </legend>
  	<legend>STOCK : <?php echo number_format($total_stock)." "."Stock";?></legend> 
  	<legend>SOLD : <?php echo number_format($sold)." "."sold";?></legend> 
</div>
  </div>
<div class="col-md-3">

  <table border="1" class="table-condensed">
        <thead >



          

          <tr>
<!-- <th>STAFF NO:</th> -->
<th>staff</th>
<!-- <th>SELL QTY:</th> -->
<th>sales</th>
<th>margin</th>


</tr>

</thead>
<tbody id="table">
  <?php
  $sql3="SELECT staffs.staff_id,
       staffs.staff_name,
       Sum(sales.sales) as sales,
       Sum(sales.profit) as profit
FROM   staffs
       LEFT JOIN sales
              ON sales.staff_id = staffs.staff_id
       LEFT JOIN sales_articles
              ON sales_articles.sales_id = sales.sales_id
GROUP  BY staffs.staff_id";
  $query3=mysqli_query($conn,$sql3);
  if (!$query3) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
  while($fetch=mysqli_fetch_array($query3))
  {
   // $staff_id=$fetch["staff_id"];
   $staff_name=$fetch["staff_name"];
   $sales=$fetch["sales"];
   $profit=$fetch["profit"];

   
  
   
   ?>
   <tr class="table_row">
<!--      <td style="cursor: pointer;" > <?php echo $staff_id;?> </td>
 -->     <td style="cursor: pointer;"> <?php echo $staff_name;?> </td>
     <td style="cursor: pointer;"> <?php echo number_format($sales,2);?> </td>
     <td style="cursor: pointer;"> <?php echo number_format($profit,2);?> </td>
     
     
   </tr>
    <?php

}
?>
</tbody>
</table>
  	
  </div> 
  <div class="col-md-3" style="display: visible;">

<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="../images/img3.jpeg" style="width:100%">
  <div class="text">Caption Text</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="../images/img2.jpeg" style="width:100%">
  <div class="text">Caption Two</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="../images/img1.jpeg" style="width:100%">
  <div class="text">Caption Three</div>
</div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>
   	

   </div>
   <div class="col-md-6">
     <table>
       <tr>
         <td>
           <div class=""></div>
         </td>
       </tr>
     </table>
   </div>
 
</div>
<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "visible";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>
</body>
</html>
