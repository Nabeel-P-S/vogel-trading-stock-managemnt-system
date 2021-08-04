<?php
include '../connect.php';
$sales_id = $_GET['sales_id'];
    // $query=mysqli_query($conn,"select sales_id from sales order by sales_id desc LIMIT 1");
    // $fetch1=mysqli_fetch_array($query);
    //  $sales_id=$fetch1['sales_id'];
include('sales_details.php');  
// include('estimation_details.php'); 
 
$invoice_no=  sprintf( "%03d", $sales_id);
?>
<!DOCTYPE html>
<html>
<head>
  <title>VOGEL SALES BILL</title>
</head>
<style type="text/css">
  .amjad{
border: none;
padding-left: 1vw;
  }

  .cash
  {
   
padding-right: 1.5vw;
  }
</style>
  <script type="text/javascript">
        // window.onload=window.print();
    </script>
<body>
  <!-- <button  id="print_btn" onclick="window.print();">print</button> -->

<?php include("../navbar.php") ?> 
 <div  id="printable" style="border: 1px solid black;">


    <div style="*font-size: 1.5vw;padding-left: 0.5vw;">
      <table border="0">
        <tr><td style="color: red;font-weight: bold;width: 40vw;"> VOGEL TRADING</td><td rowspan="7"></td><td></td>
        <td  rowspan="5" >
        <img  style="margin-left:8vw;" src="../images/logo.jpeg" width="200px" height="75px">
        </td> </tr>
        
        <tr><td> A TOWER COMPLEX</td></tr>
        <tr><td> CALVERY JUNCTION</td></tr>
        
        <tr><td> THRISSUR - 680004</td></tr>
        <tr><td> CONTACT: 04847-2383104, 8138913909</td></tr>
        <tr style="font-weight: bold;"><td> GSTNO: 32AKFPJ9211R1ZV</td><td style="width: 40vw;text-align: center;font-size: 2vw;">INVOICE</td><td style="width: 45vw;text-align: center;">INVOICE NO.1909/<?php echo $invoice_no;?></td></tr>
      </table>
    </div>


<div>
  
        <table border="1" style="width: 100%;" >
          <tr><td rowspan="2" style="width: 20%;"> DATE : <?php echo $sales_date;?></td><td colspan="2" style="font-weight: bold;text-align: center;width: 55%;"> TRANSPORT</td><td style="width:25%;font-weight: bold; ">     BILLING ADDRESS</td></tr>
      <tr ><td style="width: 10%;">Transport Method</td><td style="width: 15%;"><input class="amjad" type="text" ></td>  <td  ><?php echo $customer_name;?></td></tr>
      <tr><td ><b>PAYMENT TERMS</b> </td><td>Vehicle No </td> <td><input class="amjad" type="text" ></td> <td><?php echo $customer_address;?></td></tr>
      <tr><td>
        <table><tr><td class="cash">CASH</td><td class="cash"><input type="checkbox" name=""></td> <td class="cash">CHEQUE</td> <td class="cash"><input type="checkbox" name=""></td> </tr></table>
         </td><td>Date Of Supply </td><td><input class="amjad" type="text" ></td>  <td><?php echo $customer_phone;?></td></tr>
      <tr><td >ONLINE PAYMENT  <input style="margin-left: 1.5vw;"  type="checkbox" name="">  </td><td>Place Of Supply</td> <td><input class="amjad" type="text" ></td> <td>GST : <?php echo $customer_gst;?></td></tr>
   
    </table>
     


</div>


<div class="fill" >
  <table class="table-condensed"  style="width: 100%;" border="1">
    <!-- ==========================DETAILS HEADING -------------------------------------------------------- -->
    <tr style="text-align: center;font-weight: bold;">
      <td rowspan="2">SL NO</td>
      <td rowspan="2">Description of Goods</td>
      <td rowspan="2">Article NO</td>
      <td rowspan="2">HSN ACS</td>
      <td rowspan="2">Rate</td>
      <td rowspan="2">QTY</td>
      <td rowspan="2">AMOUNT</td>
      <td rowspan="2">DISCOUNT</td>
      <td rowspan="2">TAXABLE VALUE</td>
      <td colspan="2">CGST</td>
      <td colspan="2">SGST</td>
      <td colspan="2">IGST</td>
      <td colspan="2">CESS</td>
      <td rowspan="2">TOTAL</td>
    </tr>
    <tr>
      <td>%</td>
      <td>Amount</td>

      <td>%</td>
        <td>Amount</td>
      <td>%</td>
        <td>Amount</td>  <td>%</td>
        <td>Amount</td>
    </tr>
    <!-- ==========================DETAILS HEADING -------------------------------------------------------- -->

<?php
     $slno=1;
     $amount_total=0;
     $discount_total=0;
     $cgst_amount_total=0;

     $sgst_amount_total=0;
     $igst_amount_total=0;
     $grand_total=0;
    $get_amount= floatval(5.02);
     $get_amount=AmountInWords( $get_amount);
    while($fetch_article=mysqli_fetch_array($article_query))
          {
             $article_id=$fetch_article["article_id"];
 $article_no=$fetch_article["article_no"];
 $hsn_no=$fetch_article["hsn_no"];
 $sgst=$fetch_article["sgst"];
 $cgst=$fetch_article["cgst"];
 $cess=$fetch_article["cess"];
 if($customer_gst!="")
 {
  $cess=0;
 }
 $igst=$fetch_article["igst"];
 if ($sgst=="") {$sgst=0;}
 if ($cgst=="") {$cgst=0;}
 if ($igst=="") {$igst=0;}
 $article_name=$fetch_article["article_name"];
 $article_name=$fetch_article["article_name"];
 $article_price=$fetch_article["article_price"];
 $sales_price=$fetch_article["sales_price"];
 $article_qty=$fetch_article["article_qty"];
 $total_price=$sales_price*$article_qty;
 $cgst_amount=($cgst/100)*$total_price;
 $cess_amount=($cess/100)*$total_price;
 $sgst_amount=($sgst/100)*$total_price;
 if($igst!=null){
 $igst_amount=($igst/100)*$total_price;
}else 
{
   $igst_amount="0.00";
}
   $amount_total+=$total_price; 
   $cgst_amount_total+=$cgst_amount;     
   $sgst_amount_total+=$sgst_amount;     
   $igst_amount_total+=$igst_amount;  
   $article_total=$total_price+$cgst_amount+$sgst_amount+$igst_amount;  
   $grand_total+= $article_total;
?>
    <tr style="font-size: 1vw;">
      <td><?php echo $slno;?></td>
      <td style="font-size: .9vw;"><?php echo $article_name;?></td>
      <td><?php echo $article_no;?></td>
      <td><?php echo $hsn_no;?></td>
      <td><?php echo $sales_price;?></td>
      <td><?php echo $article_qty;?></td>
   
      <td><?php echo $total_price; ?></td>
      <td></td>
      <td><?php echo $total_price;?></td>
      <td><?php echo $cgst;?></td>
      <td><?php echo $cgst_amount;?></td>
      <td><?php echo $sgst;?></td>
      <td><?php echo $sgst_amount;?></td>
      <td><?php echo $igst;?></td>
      <td><?php echo $igst_amount;?></td>
      <td><?php echo $cess;?></td>
      <td><?php echo $cess_amount;?></td>
  
      <td><?php echo round($article_total,2);?></td>
    </tr>
  <?php $slno++; }?>
<!--   <tr>
    <td><?php echo $slno;?> </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr> -->
    <tr>
      <td colspan="6" style="text-align: right;*font-weight: bold;">TOTAL</td>
      <td><?php echo $amount_total;?></td>
      <td><?php echo $discount_total;?></td>
      <td><?php echo $amount_total;?></td>
      <td></td>
      <td><?php echo $cgst_amount_total;?></td>
      <td></td>
      <td><?php echo $sgst_amount_total;?></td>
      <td></td>
      <td><?php echo $igst_amount_total;?></td>
      <td><?php echo round($grand_total,2); ?> </td>

    </tr>
    <tr style="font-weight: bold;">
          <td colspan="10">Amount In Words : 
       <?php 
       $get_amount=round($grand_total);
       echo AmountInWords($get_amount);?> 
         
       </td>
      <!-- <td colspan="10">Amount In Words : </td> -->
      <td colspan="5"> GRAND TOTAL(Including Tax)</td>
      <td ><?php echo vround($grand_total); ?></td>

    </tr>
    <tr>
      <td colspan="7">GOODS RECIEVED BY :</td>
        <td colspan="9"> for VOGEL TRADING</td>
      </tr>

<tr>
  <td colspan="7">Authorized stamp & signatory</td><td colspan="9" rowspan="2"></td>
</tr>
<tr style="height: 8vw;"><td colspan="7"></td></tr>
  </table>
</div>


 </div>
</body>
</html>