




<div class="container" id="printable" style="*border: 1px solid black;height: 138.34mm;text-align: center;">
<div class="row" style="border: 1px solid;">
<table> 
<tr>
   
      <td style="padding-right: 2vw;">

      <table class="table-condensed" style="font-weight: bold;text-align:  left;">

    
    <tr><td style="*width: 25vw;">VOUCHER NO :</td><td style="*width: 25vw;">  <?php echo $voucher_id; ?> </td ></tr>
    <tr><td style="*width: 25vw;">VOUCHER DATE :</td><td style="*width: 25vw;"> <?php echo $voucher_date; ?></td></tr>
    <tr><td>RECIEVED FROM :</td><td> <?php echo $staff_name; ?></td></tr>
    <tr><td>BRANCH</td><td>  <?php echo $branch_name; ?> </td></tr>


      </table>

      </td>
      <td>
      <img  style="margin-left:30vw;" src="../images/logo.jpeg" width="160px" height="80">
      </td>
     
</tr>

<tr>
        <td colspan="2" >
        <p style="margin-left: 10vw;*font-family: fantasy;font-size: 3vw;font-weight: bold;"> RECEIPT VOUCHER</p>
        </td>
</tr>
</table>
</div>



<div class="row" style="*height: 70vw;">
        <table style="width: 100%;text-align: center;" class="table-condensed" border="1"><tr style="font-weight: bold;height: 1vw;"><td>SL NO</td><td> INVOICE NO  </td><td>INVOICE AMOUNT</td><td> METHOD</td><td>PAID</td><td>BALANCE</td></tr>
 <?php


 $slno=0;
 $balance_total=0;
 $article_sql="SELECT sales.sales,sales.paid,sales.total, voucher_details.invoice_no,voucher_details.paid as paying,voucher_details.method from voucher_details  left JOIN sales on sales.invoice_no=voucher_details.invoice_no where voucher_details.voucher_id= '$voucher_id'";
   $article_query1=mysqli_query($conn,$article_sql);
while($fetch_article=mysqli_fetch_array($article_query1))
      {
              $invoice_no=$fetch_article["invoice_no"];
                 $method=$fetch_article['method'];
                 $sales=$fetch_article["sales"];
                 $total=$fetch_article["total"];
                 $paying=$fetch_article["paying"];
                 $balance=$fetch_article["total"]-$fetch_article["paid"];
                $balance_total+=$balance;
                 if ($method=='1') {$method="CASH"; } 
              else   if ($method=='2') {$method="ONLINE"; } 
                else {$method="BANK"; } 

        $slno++
        ?>
<tr >
  <td><?php echo $slno;?> </td>
  <td><?php echo $invoice_no;?> </td>
  <td><?php echo  $total?> </td>
    
     <td> <?php echo $method;?>   </td>
      <td> <?php echo  $paying?> </td>
      <td> <?php echo $balance;?> </td>
    </tr>
 <?php 
 

     }
      ?>
  
    <tr><td colspan="4" style="text-align:  right;"> TOTAL </td><td> <?php echo $voucher_amount;?>  </td><td><?php echo $balance_total;?> </td></tr>
    <tr><td colspan="2" style="text-align:  right;">IN WORDS</td> <td colspan="4" style="text-align:  left;"> <?php echo AmountInWords($voucher_amount) ?> </td></tr>
    <tr style="height: 40px;"><td colspan="2" ></td><td colspan="2" ></td><td colspan="2" ></td></tr>
    <tr><td colspan="2" >EXECUTIVE</td><td colspan="2" >ACCOUNTANT</td><td colspan="2" >RECIEVER</td></tr>
      </table>
</div>

      
    </div>