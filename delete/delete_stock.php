<?php
include ("../connect.php");


$stock_id=$_POST["stock_id"];
$article_id=$_POST["article_id"];
$article_qty=$_POST["article_qty"];
mysqli_query($conn,"UPDATE `articles` SET article_stock =  article_stock - '$article_qty' WHERE article_id='$article_id'");
mysqli_query($conn,"DELETE FROM `stocks` WHERE stock_id='$stock_id'");


?>
