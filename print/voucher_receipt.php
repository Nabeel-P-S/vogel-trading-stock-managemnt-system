<?php
include '../connect.php';
$voucher_id = $_GET['voucher_id'];

 $sales_sql="SELECT voucher.voucher_id,voucher.voucher_date,voucher.voucher_time,voucher.voucher_amount,staffs.staff_name,branches.branch_name from voucher 
 left JOIN staffs on staffs.staff_id=voucher.staff_id
 left JOIN branches on branches.branch_id=staffs.branch_id

  WHERE  voucher.voucher_id='$voucher_id'";
 

    $query=mysqli_query($conn,$sales_sql);
  
   
 $fetch=mysqli_fetch_array($query);

    $voucher_id = $fetch["voucher_id"];
    $voucher_date = $fetch["voucher_date"];
    $voucher_time = $fetch["voucher_time"];
       $voucher_amount = $fetch["voucher_amount"];
      $voucher_date = date("d-m-Y", strtotime($voucher_date));
       $staff_name = $fetch["staff_name"];
       $branch_name = $fetch["branch_name"];
       include("currency.php");
     $amount_words=strtoupper(AmountInWords($voucher_amount))." "."ONLY";


    
?>
<!DOCTYPE html>
<html>
<head>
  <title>Voucher <?php echo $voucher_id; ?><?php echo date("d-m-Y", strtotime($date))."-".$time;?> </title>
</head>
  <script type="text/javascript">
        window.onload=window.print();
    </script>
<body>

<?php include("../navbar.php") ?> 
 <div class="" style="*height: 297mm;">
  
<?php 
    include("../print/voucher_bill_table.php");


    include("../print/voucher_bill_table.php");?>
  


      
    </div>
  

</body>
</html>

