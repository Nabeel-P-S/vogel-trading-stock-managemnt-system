<?php
$from_date='2020-06-10';
$to_date=$date;
$sales_sql = "SELECT estimation.profit,estimation.invoice_no,estimation.sales,estimation.sales_id,estimation.sales_date,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from estimation 
   LEFT JOIN staffs 
              ON staffs.staff_id = estimation.staff_id 
    LEFT join branches on branches.branch_id=staffs.branch_id 
    order by sales_id desc";

 $category=" ";
  if (!empty($_GET["staff_id"])) 
    {
          $staff_id = $_GET['staff_id'];
     
          $item_id=$_GET['item_id'];

$sales_sql="SELECT estimation.profit,estimation.invoice_no,estimation.sales,estimation.sales_id,estimation.sales_date,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from estimation  LEFT JOIN estimation_articles on estimation_articles.sales_id=estimation.sales_id LEFT JOIN staffs 
              ON staffs.staff_id = estimation.staff_id 
    LEFT join branches on branches.branch_id=staffs.branch_id  where estimation_articles.article_id='$item_id' AND estimation.staff_id='$staff_id'";


        }

 if (!empty($_GET["value"])) 
    {
          $value = $_GET['value'];
     
          $name=$_GET['name'];
 
       $category ="OF"." "." ".$value;
       // $cat
       // egory ="OF"." ".strtoupper($_GET['name'])." ".$value;;

$sales_sql = "SELECT estimation.profit,estimation.invoice_no,estimation.sales,estimation.sales_id,estimation.sales_date,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from estimation 
   LEFT JOIN staffs 
              ON staffs.staff_id = estimation.staff_id 
    LEFT join branches on branches.branch_id=staffs.branch_id   where estimation.$name ='$value' order by sales_id desc";
    } 
  if (!empty($_GET["from_date"])) 
    {
         $from_date = $_GET['from_date'];
         $to_date = $_GET['to_date'];
   
     
        

          $sales_sql="SELECT estimation.profit,estimation.invoice_no,estimation.sales,estimation.sales_id,estimation.sales_date,branches.branch_name,staffs.staff_name,staffs.staff_id,branches.branch_id from estimation 
   LEFT JOIN staffs 
              ON staffs.staff_id = estimation.staff_id 
    LEFT join branches on branches.branch_id=staffs.branch_id WHERE   sales_date BETWEEN '$from_date' AND '$to_date'";
    } 
  
?>

<!DOCTYPE html>
<html>
<head>
  <title>Estimations | <?php echo date("d-m-Y", strtotime($date))."-".$time;?></title>
</head>
<style type="text/css">
.table-hover tbody tr:hover td {
    /*background:#6f8787;*/
    /*color: #017874;*/
    color: black;
    font-weight: bold;
}
</style>
<body>
 <div class="col-lg-2" ><input  placeholder="Search" class="form-control" id="myInput" type="text" style="width: 12vw;color: black;margin-bottom: 1vw;">   </div>
 <div class="col-lg-10" >
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
    </div>
      <input  type="date" name="from_date"  value="<?php echo $from_date;?>" id="from_date">
      <input  type="date" name="to_date"  value="<?php echo $to_date;?>" id="to_date">
      <button class="btn btn-md" onclick="date_filter();">OK </button>
      <button class="btn btn-danger"  onclick="print_page()">PRINT BILLS</button>
      <!-- <a class="btn btn-primary" href="../view/full_sales.php"> Full SALES</a> -->
    </td>
  </tr>
</table>


</div> 



    <div id="printableArea"  class="col-md-12" style="overflow: auto; ">
      <h3 style="text-align: center;"><b>ESTIMATION STATEMENT  </b></h3>
      <table style="font-size: .9vw;" border="1" class="table-condensed table table-hover table-stiped">
        



          <tr  >
<!-- <th >NO</th> -->

<td style="text-align: center;" >NO</td>
<td style="text-align: center;">STAFF </td>
<td style="text-align: center;" >Date</td>
<td style="text-align: center;" >amount (Ex gst)</td>
     <?php
        $sql="SELECT count(article_id) as total_article FROM `articles`";
        $query=mysqli_query($conn,$sql);
        $fetch=mysqli_fetch_array($query);
        $total_article=$fetch['total_article'];

 for ($i=1;$i<=$total_article;$i++)
        {
          ?>
          <td ><?php
          $sql="SELECT * FROM `articles` WHERE article_id='$i'";
          $query=mysqli_query($conn,$sql);
          $fetch=mysqli_fetch_array($query);
          $article_no=$fetch['article_no'];
          $article_price[$i]=$fetch['article_price'];
          $sales_price[$i]=$fetch['sales_price'];

        
          $sgst[$i]=$fetch['sgst'];
          $cgst[$i]=$fetch['cgst'];
          $igst[$i]=$fetch['igst'];
           if($igst[$i]==""){
        $igst[$i]=0;
         }
         if($cgst[$i]==""){
        $cgst[$i]=0;
         }
         if($sgst[$i]==""){
        $sgst[$i]=0;
         }

$tax[$i]=$sgst[$i]+$cgst[$i]+$igst[$i];
         $sum[$i]=0;
     ?> <table >
       <tr><td><?php echo $article_no?></td></tr>
       <tr><td><?php echo $sales_price[$i]?></td></tr>
     </table>
         
          </td>
<?php
}
        ?>





<!-- <th style="text-align: center;"> </th>
 -->
</tr>

<tbody id="table">
  <?php
$query = mysqli_query($conn, $sales_sql);

$qty_sum = 0;
$sales_sum = 0;
$margin_sum = 0;

$count = 0;
if (!$query) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
while ($fetch = mysqli_fetch_array($query))
{
    $sales_id = $fetch["sales_id"];
    $invoice_no = $fetch["invoice_no"];
    $sales_date = $fetch["sales_date"];
      $sales_date = date("d/m/Y", strtotime($sales_date));
     $branch_name = $fetch["branch_name"];
    $staff_name = $fetch["staff_name"];
    $branch_id = $fetch["branch_id"];
    $staff_id = $fetch["staff_id"];
    $sales = $fetch["sales"];
    $profit = $fetch["profit"];
  $sales_sum+=$sales;
  $margin_sum+=$profit;

    $count++;

?>
   <tr class="table_row" style="cursor: pointer;">
         <td > <a href="../print/sales_bill.php?sales_id=<?php echo $sales_id;?>"> <?php echo $invoice_no; ?> </a></td>
     <td onclick="refresh_again1('<?php echo $staff_id;?>','staff_id')"><a >  <?php echo $staff_name; ?></a></td>
     <td > <a href="../forms/add_staff_grv.php?sales_id=<?php echo $sales_id;?>"> <?php echo $sales_date; ?> </td>
     <td >  <?php echo $sales; ?> </a></td>
            <?php
        $sql3="SELECT count(article_id) as total_article FROM `articles`";
        $query3=mysqli_query($conn,$sql3);
        $fetch3=mysqli_fetch_array($query3);
        $total_article=$fetch3['total_article'];

 for ($i=1;$i<=$total_article;$i++)
        {
          ?>
          <td>
          <?php
              $query2=mysqli_query($conn,"SELECT article_qty from estimation_articles  WHERE sales_id='$sales_id' AND article_id='$i'");
           $fetch2=mysqli_fetch_array($query2);
            if (isset($fetch2['article_qty'])) 
            { 
                 echo $fetch2['article_qty'];
                 $sum[$i]+=$fetch2['article_qty'];
                
           }
          ?>
     </td>
      <?php
  }
  
    ?></tr>
 
  

  
    <?php
}
?>
  <tr class="table_summary" >    

      <th colspan="4">TOTAL QUANTITY </th>
      <?php
    for ($i=1;$i<=$total_article;$i++)
        {
          ?>
          <td>
          <?php
            echo $sum[$i];
                 
                
           
          ?>
     </td>
      <?php
  }
  
    ?></tr>
    <tr class="table_summary" ><th colspan="4">TOTAL AMOUNT </th> <?php for ($i=1;$i<=$total_article;$i++){?> <td> <?php echo $sum[$i]*$sales_price[$i];   ?>   </td>    <?php }    ?></tr> 
      <tr class="table_summary" ><th colspan="4">TOTAL GST/TAX </th> <?php for ($i=1;$i<=$total_article;$i++){?> <td> <?php echo $sum[$i]*$tax[$i];   ?>   </td>    <?php }    ?></tr>  
     <tr class="table_summary" ><th colspan="4">TOTAL COST </th> <?php for ($i=1;$i<=$total_article;$i++){?> <td> <?php echo $sum[$i]*$article_price[$i];   ?>   </td>    <?php }    ?></tr>  


     
     
      
   
</tbody>
</table>
<!-- <table></table> -->
</div>

</div>

<script type="text/javascript">

  function refresh_again1(value,name)
  {
// alert(value+name);
window.location="view_estimation.php?value=" + value + "&name=" + name;

  }

  function refresh_again3()
  {
// alert(value+name);
var staff_id=document.getElementById("executive_id").value;
var item_id=document.getElementById("item_id").value;
window.location="view_estimation.php?staff_id=" + staff_id + "&item_id=" + item_id;

  }

</script>
<script type="text/javascript">

  function item_sales(value)
  {
// alert(value+name);
window.location="view_estimation.php?value=" + value;

  }

</script>

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
  function delete_sale(sales_id,staff_id)
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
      url:"../delete/delete_estimation.php",
      data:{
        sales_id:sales_id,
        staff_id:staff_id
      
      },
      success:function(data)
      {
alert(data);

        // location.href = "../view/view_estimation.php";
        
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
  function date_filter()
  {
    var from_date=document.getElementById("from_date").value;
    var to_date=document.getElementById("to_date").value;
window.location="view_estimation.php?from_date=" + from_date + "&to_date=" + to_date;
}
</script>