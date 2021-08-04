<?php

$from_date='2020-06-10';
$to_date=$date;
$sales_sql = "SELECT sales.sales_date,voucher_details.invoice_no,staffs.staff_name,sales.total, voucher.voucher_id,voucher.voucher_date,voucher_details.id,voucher_details.paid,(sales.total-sales.paid) as balance,sales.paid as sales_paid FROM `voucher_details` LEFT JOIN voucher on voucher.voucher_id=voucher_details.voucher_id LEFT JOIN sales on sales.invoice_no=voucher_details.invoice_no LEFT JOIN staffs on staffs.staff_id=sales.staff_id ORDER BY invoice_no DESC,voucher_date asc";

 
  if (!empty($_GET["from_date"])) 
    {
         $from_date = $_GET['from_date'];
         $to_date = $_GET['to_date'];
     
        

          $sales_sql="SELECT sales.sales_date,voucher_details.invoice_no,staffs.staff_name,sales.total, voucher.voucher_id,voucher.voucher_date,voucher_details.id,voucher_details.paid,(sales.total-sales.paid) as balance,sales.paid as sales_paid FROM `voucher_details` LEFT JOIN voucher on voucher.voucher_id=voucher_details.voucher_id LEFT JOIN sales on sales.invoice_no=voucher_details.invoice_no LEFT JOIN staffs on staffs.staff_id=sales.staff_id   WHERE voucher_date BETWEEN '$from_date' AND '$to_date' ORDER BY invoice_no DESC ,voucher_date asc";
    } 
  
?>

<!DOCTYPE html>
<html>
<head>
  <title>Voucher List</title>
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


     <div class="col-lg-2" ><input  placeholder="Search" id="myInput" type="text" class="form-control" style="width: 12vw;color: black;margin-bottom: 1vw;">   </div>
     <div class="col-lg-2" ><a class="btn btn-danger" href="../view/vouchers1.php">Voucher simple list </a></div>
   

     <div class="col-lg-8" >
 
      <!-- <a class="btn btn-danger"  href="../print/sales_print.php">PRINT</a> -->



<table style="float: right;">
  <tr>
       <td style="display: none;">
        <input list="articles" id="article_id"  style="width: 12vw;" onkeyup="refresh_again1(this.value,'staff_id');" name="article_id" placeholder="SEARCH ARTICLE" >
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
    <td style="display: none;">
        <input list="staffs" id="staff_id"  style="width: 12vw;" onkeyup="refresh_again1(this.value,'staff_id');" name="staff_id" placeholder="SEARCH STAFF" >
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
    <td style="display: none;">
          <input list="branches" id="branch_id" onkeyup="refresh_again1(this.value,'branch_id');" name="branch_id" placeholder="SEARCH BRANCH" >


<datalist id="branches">
   <option style="color: grey" value="" >select Branch</option>
                  <?php
$query = mysqli_query($conn, "SELECT * from branches");
while ($fetch = mysqli_fetch_array($query))
{
?>
                    <option value="<?php echo $fetch['branch_id']; ?>"><?php echo $fetch['branch_name']; ?> </option>
                        <?php
}
?> 
</datalist>
    </td>
    <td>
     
 
<input  type="date" name="from_date" value="<?php echo $from_date;?>" id="from_date">
<input  type="date" name="to_date" value="<?php echo $to_date;?>" id="to_date">
<button class="btn btn-md" onclick="date_filter();">OK </button>
<button style="margin-left: 3vw;width: 10vw;" class="btn btn-primary"  onclick="print_page()">PRINT </button>
<!-- <a class="btn btn-primary" href="../view/full_sales.php"> Full SALES</a> -->

    </td>
  </tr>
</table>
   

</div> 



    <div id="printableArea"  class="col-md-12" style="overflow: auto; ">
      <span style="text-align: center;"><h4>VOUCHERS FINAL STATEMENT   </h4> <p style="float: right;"> <?php echo date("d/m/Y", strtotime($from_date));?> TO <?php echo date("d/m/Y", strtotime($to_date));?> </p> </span> 

      <table border="1" class="table  table-hover table-condensed"  style="*font-size: .8vw;" >
       



          <tr class="btn-danger" >
<!-- <td >NO</td> -->

<td style="text-align: center;" >sL no</td>
<!-- <td style="text-align: center;" >id</td> -->
<td style="text-align: center;" >invoice date</td>
<td style="text-align: center;" >invoice no</td>
<td style="text-align: center;">executive name </td>
<td style="text-align: center;" ><p style="float: left;">invoice amount</p><p style="float: right;"> paid</p></td>

<td style="text-align: center;">voucher id  </td>
<td style="text-align: center;">voucher date </td>

<td style="text-align: center;">voucher amount </td>
<td style="text-align: center;">balance </td>
<td id="printPageButton"></td>



<!-- <td style="text-align: center;"> </td>
 -->
</tr>

<tbody id="table">
  <?php
$query = mysqli_query($conn, $sales_sql);
$sum=0;

$value = 0;
$pay = 0;


$slno=1;
if (!$query) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

while ($fetch = mysqli_fetch_array($query))
{


$sales_date= $fetch["sales_date"];
$sales_date = date('M-d ', strtotime($sales_date));

$invoice_no= $fetch["invoice_no"];
$id= $fetch["id"];

$staff_name= $fetch["staff_name"];
$total= $fetch["total"];
$voucher_id= $fetch["voucher_id"];
$sales_paid= $fetch["sales_paid"];
$voucher_date= $fetch["voucher_date"];
$voucher_date = date('d M D', strtotime($voucher_date));
$paid= $fetch["paid"];
$sum+=$paid;


      if ($value==$invoice_no)
      {
        $sales_date= "";
        $invoice_no=  "";
        $staff_name="" ;
        $sales_paid="" ;

        $pay+=$paid;
        $balance=$total-$pay;
        $total= "";
      }
      else
      {
        $value=$invoice_no;
        $pay=$paid;
        $balance=$total-$pay;
      }


      

  

?>
   <tr style="cursor: pointer;">
  
   

     <td > <?php echo $slno; ?> </td>
     <!-- <td > <?php echo $id; ?> </td> -->
     <td > <?php echo $sales_date; ?> </td>
     <td > <?php echo $invoice_no; ?> </td>
     <td > <?php echo $staff_name; ?> </td>
     <td ><p style="float: left;"><?php echo $total; ?></p><p style="float: right;"> <?php echo $sales_paid; ?></p> </td>
     <td > <?php echo $voucher_id; ?> </td>
     <td > <?php echo $voucher_date; ?> </td>
     <td > <?php echo $paid; ?> </td>
     <td > <?php echo round($balance,2); ?> </td>
     <!-- <td > <?php echo $balance; ?> </td> -->
     
   
     </a></td>  <td id="printPageButton"><a class="btn-xs btn-success" style="width: 100%"
     href="../print/voucher_receipt.php?voucher_id=<?php echo $voucher_id;?>"> PRINT </a></td>

   
   </tr>
 

    <?php $slno++;
}
?>
 
      
     </tr> 
     <tr>
       <td colspan="10" style="text-align:  right;">
         Total : <?php echo $sum;?>
       </td>
     </tr>
</tbody>
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
  function delete_sale(sales_id)
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
  function date_filter()
  {
    var from_date=document.getElementById("from_date").value;
    var to_date=document.getElementById("to_date").value;
window.location="view_vouchers.php?from_date=" + from_date + "&to_date=" + to_date;
}
</script>
</body>

</html>