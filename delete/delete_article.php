<?php
include ("../connect.php");


$article_id=$_POST["article_id"];

mysqli_query($conn,"DELETE FROM `articles` WHERE article_id='$article_id'");


?>
