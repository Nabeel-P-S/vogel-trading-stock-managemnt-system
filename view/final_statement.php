<?php


$from_date='2020-06-10';
$to_date=$date;
$sales_sql = "SELECT sales.profit,sales.total,sales.paid,sales.invoice_no,sales.sales,sales.sales_id,sales.customer_id,sales.sales_date,customers.customer_name,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from sales 
LEFT join customers on customers.customer_id=sales.customer_id 

LEFT join staffs on staffs.staff_id=sales.staff_id 
LEFT join branches on branches.branch_id=staffs.branch_id where sales.category=0 order by sales_id desc";

$category=" ";

  if (!empty($_GET["staff_id"])) 
    {
          $staff_id = $_GET['staff_id'];
     
          $item_id=$_GET['item_id'];

$sales_sql="SELECT sales.profit,sales.total,sales.paid,sales.invoice_no,sales.sales,sales.sales_id,sales.customer_id,sales.sales_date,customers.customer_name,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from sales 
LEFT join customers on customers.customer_id=sales.customer_id 
LEFT JOIN sales_articles on sales_articles.sales_id=sales.sales_id
LEFT join staffs on staffs.staff_id=sales.staff_id 
LEFT join branches on branches.branch_id=staffs.branch_id where sales.category=0 AND sales_articles.article_id='$item_id' AND sales.staff_id='$staff_id'";


        }
if (!empty($_GET["value"])) 
{
  $value = $_GET['value'];

  $name=$_GET['name'];
  if ($name=="staff_id")
  {
              $sales_sql = "SELECT sales.profit,sales.total,sales.paid,sales.invoice_no,sales.sales,sales.sales_id,sales.customer_id,sales.sales_date,customers.customer_name,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from sales 
        LEFT join customers on customers.customer_id=sales.customer_id 

        LEFT join staffs on staffs.staff_id=sales.staff_id 
        LEFT join branches on branches.branch_id=staffs.branch_id  where sales.$name ='$value' AND sales.category=0 order by sales_id desc";
  }
  else
  {
                  $sales_sql = "SELECT sales.profit,sales.total,sales.paid,sales.invoice_no,sales.sales,sales.sales_id,sales.customer_id,sales.sales_date,customers.customer_name,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from sales 
        LEFT join customers on customers.customer_id=sales.customer_id 

        LEFT join staffs on staffs.staff_id=sales.staff_id 
        LEFT join branches on branches.branch_id=staffs.branch_id  where branches.$name ='$value' AND sales.category=0 order by sales_id desc";
  }

  $category ="OF"." "." ".$value;
       // $cat
       // egory ="OF"." ".strtoupper($_GET['name'])." ".$value;;


} 
if (!empty($_GET["from_date"])) 
{
 $from_date = $_GET['from_date'];
 $to_date = $_GET['to_date'];



 $sales_sql="SELECT sales.profit,sales.total,sales.paid,sales.invoice_no,sales.sales,sales.sales_id,sales.customer_id,sales.sales_date,customers.customer_name,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from sales 
 LEFT join customers on customers.customer_id=sales.customer_id 

 LEFT join staffs on staffs.staff_id=sales.staff_id 
 LEFT join branches on branches.branch_id=staffs.branch_id where sales.category=0 and sales_date BETWEEN '$from_date' AND '$to_date' AND sales.category=0";
} 

?>

<!DOCTYPE html>
<html>
<head>
  <title>sales<?php echo date("d-m-Y", strtotime($date))."-".$time;?></title>
</head>

<body>


 <div class="col-lg-2" ><input  placeholder="Search" id="myInput" type="text" style="width: 12vw;color: black;margin-bottom: 1vw;">   </div>
 <div class="col-lg-10" >

  <!-- <a class="btn btn-danger"  href="../print/sales_print.php">PRINT</a> -->



  <table>
    <tr>
        <td >
      <input list="articles" id="item_id" class="form-control"  style="*width: 12vw;"  name="article_id" placeholder="SEARCH ARTICLE" >
      <datalist id="articles">
        <option style="color: grey" value="" >SELECT ARTICLE</option>
        <?php

        $query = mysqli_query($conn, "SELECT * from articles");
        while ($fetch = mysqli_fetch_array($query))
        {
          ?>
          <option value="<?php echo $fetch['article_id']; ?>"><?php echo $fetch['article_no']; ?> </option>
          <?php
        }
        ?> 
      </datalist> 
    </td>
    <td>
      <input list="staffs" id="executive_id"  class="form-control" style="*width: 12vw;"  name="staff_id" placeholder="SEARCH STAFF" >
      <datalist id="staffs">
        <option style="color: grey" value="" >SELECT STAFF</option>
        <?php

        $query = mysqli_query($conn, "SELECT * from staffs");
        while ($fetch = mysqli_fetch_array($query))
        {
          ?>
          <option value="<?php echo $fetch['staff_id']; ?>"><?php echo $fetch['staff_name']; ?> </option>
          <?php
        }
        ?> 
      </datalist> 
    </td>
<td> <button class="btn btn-primary" onclick="refresh_again3()">Find</button></td>
    <td>

<td>


  <input  type="date" name="from_date" value="<?php echo $from_date;?>" id="from_date">
  <input  type="date" name="to_date" value="<?php echo $to_date;?>" id="to_date">
  <button class="btn btn-md" onclick="date_filter();">OK </button>
  <button class="btn btn-danger"  onclick="print_page()">PRINT SALES</button>

</td>
</tr>
</table>


</div> 



<div id="printableArea"  class="col-md-12" style="overflow: auto; ">
  
      <h3 style="text-align: center;"><b>FINAL STATEMENT  </b></h3>
      <table style="font-size: .9vw;" border="1" class="table-condensed table table-hover table-stiped ">
        <tr class="btn-danger"><td></td>
          <?php 
          $wsql="select * from articles";
          $query=mysqli_query($conn,$wsql);
          $i=1;
          while($fetch=mysqli_fetch_array($query))
          {
            ?> <td><?php echo $fetch["article_no"] ?></td><?php $item_sum[$i]=0;$i++;
          }
          ?>
          <td class="info" style="color: black;">TOTAL</td>
        </tr>

        <?php
        $sql="SELECT count(article_id) as total_article FROM `articles`";
        $query=mysqli_query($conn,$sql);
        $fetch=mysqli_fetch_array($query);
        $total_article=$fetch['total_article'];
        $sql="SELECT count(staff_id) as total_staff FROM `staffs`";
        $query=mysqli_query($conn,$sql);
        $fetch=mysqli_fetch_array($query);
        $total_staff=$fetch['total_staff'];

        for ($i=1;$i<=$total_staff;$i++)
        {
          ?><tr><td class="btn-success"><?php
          $sql="SELECT * FROM `staffs` WHERE staff_id='$i'";
          $query=mysqli_query($conn,$sql);
          $fetch=mysqli_fetch_array($query);
          $staff_name=$fetch['staff_name'];
          echo $staff_name;

          ?></td><?php $article_sum=0;
          for($j=1;$j<=$total_article;$j++)
          {
           $sql="SELECT staff_stock  FROM staff_articles where article_id='$j' AND staff_id='$i'";
           $sql1="SELECT SUM(estimation_articles.article_qty) as est_sum FROM `estimation_articles` LEFT JOIN estimation on estimation.sales_id=estimation_articles.sales_id where estimation_articles.article_id='$j' AND estimation.staff_id='$i'";
           $sql2="SELECT SUM(sales_articles.article_qty) as sales_sum FROM `sales_articles` LEFT JOIN sales on sales.sales_id=sales_articles.sales_id where sales_articles.article_id='$j' AND sales.staff_id='$i'";
           $query=mysqli_query($conn,$sql);
           $query1=mysqli_query($conn,$sql1);
           $query2=mysqli_query($conn,$sql2);
           $fetch=mysqli_fetch_array($query);
           $fetch1=mysqli_fetch_array($query1);
           $fetch2=mysqli_fetch_array($query2);

          
             // $staff_stock= $fetch["staff_stock"];
         // if (!isset($a)) {
              if (isset($fetch["staff_stock"])) { 
                $stock=$fetch["staff_stock"];
                $diff=$fetch1["est_sum"]-$fetch2["sales_sum"];
                 ?>
           <td ><?php
                echo $fetch1["est_sum"];
                // echo $fetch["staff_stock"];
              }
            // }
            ?></td>
           <?php
           if (isset($fetch["staff_stock"])) {
            $article_sum+=$fetch1["est_sum"];
            $item_sum[$j]+=$fetch1["est_sum"];

}


         }
         ?><td class="info"><?php echo $article_sum;?></td></tr><?php
       }
       ?>
       <tr class="info">
         <td>TOTAL</td>

         <?php 
         $staff_sum_total=0;
            for ($i=1;$i<=$total_article;$i++)
        {
          $sql="SELECT SUM(staff_stock) as staff_sum FROM `staff_articles` WHERE article_id='$i'";
          $query=mysqli_query($conn,$sql);
          $fetch=mysqli_fetch_array($query);
          $staff_sum=$fetch['staff_sum'];
          $staff_sum_total+= $staff_sum;
          // echo $staff_sum;
          ?>
          <td> <?php echo $item_sum[$i];?></td>
          <?php
        }
        ?>
        <td><?php echo $staff_sum_total;?></td>
       </tr>
     </table>

</div>

</div>
<script type="text/javascript">
  function open_size_list(sales_id)
  {

    if (document.getElementById("size_td"+sales_id).style.display=="block")
    {
      document.getElementById("size_td"+sales_id).style.display="none";
    }
    else
    {
     document.getElementById("size_td"+sales_id).style.display="block"; 
   }
 }
</script>
<script type="text/javascript">

  function refresh_again1(value,name)
  {
// alert(value+name);
window.location="view_sales.php?value=" + value + "&name=" + name;

}

</script>
<script type="text/javascript">

  function item_sales(value)
  {
// alert(value+name);
window.location="item_sales.php?value=" + value;

}

</script>



<script type="text/javascript">
  function delete_invoice(sales_id)
  {
    swal({
      title: "Are you sure?  DELETE SALES BILL..!?",
      text: "Once deleted, you will not be able to recover this sales!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        swal("Poof!  sales deleted!", {

          icon: "success",
        });
        $.ajax({
          type:"POST",
          url:"../delete/delete_sale.php",
          data:{
            sales_id:sales_id

          },
          success:function(data)
          {


            location.href = "../view/view_sales.php";

          }

        });
      } 
      else {
        swal("Your detail is safe!");
      }
    });


  }
</script>
<script type="text/javascript">
    function refresh_again3()
  {
// alert(value+name);
var staff_id=document.getElementById("executive_id").value;
var item_id=document.getElementById("item_id").value;
window.location="view_sales.php?staff_id=" + staff_id + "&item_id=" + item_id;

  }
</script>
<script type="text/javascript">
  function date_filter()
  {
    var from_date=document.getElementById("from_date").value;
    var to_date=document.getElementById("to_date").value;
    window.location="view_sales.php?from_date=" + from_date + "&to_date=" + to_date;
  }
</script>
</body>

</html>