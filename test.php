<?php
include("connect.php");

echo "string";

$sum=0;
$item_price1_array[1]=10;
  $query_article=mysqli_query($conn,"SELECT  `article_price` FROM `articles` WHERE  article_id='1'");
  $fetch_article=mysqli_fetch_array($query_article);
  $article_price=$fetch_article["article_price"];

$sum=$sum+($item_price1_array[1]*$article_price);
echo $sum;
?>