<?php

include ("../connect.php");

mysqli_query($conn,"TRUNCATE `sales`;");
mysqli_query($conn,"TRUNCATE `articles`;");
mysqli_query($conn,"TRUNCATE `branches`;");
mysqli_query($conn,"TRUNCATE `customers`;");
mysqli_query($conn,"TRUNCATE `sales_articles`;");
mysqli_query($conn,"TRUNCATE `suppliers`;");
mysqli_query($conn,"TRUNCATE `stocks`;");
mysqli_query($conn,"TRUNCATE `staffs`;");
echo "<br>";
 echo  "DATABASE CLEARED";



// =================== ONLY STOCK AND SALES ------------------------------------------
// mysqli_query($conn,"TRUNCATE `sales`;");
// mysqli_query($conn,"TRUNCATE `sales_articles`;");
// mysqli_query($conn,"TRUNCATE `stocks`;");
// mysqli_query($conn,"UPDATE `articles` SET `article_stock`=0");
// echo "sales and stock deleted";

// =================== ONLY STOCK AND SALES ------------------------------------------


?>