<?php
include '../connect.php';
$grv_id = $_GET['grv_id'];

include('grv_details.php');  
?>
<!DOCTYPE html>
<html>
<head>
  <title>GRV Bill <?php echo $grv_id?></title>
</head>
  <script type="text/javascript">
        window.onload=window.print();
    </script>
<body>
  <!-- <button  id="print_btn" onclick="window.print();">print</button> -->
<?php include ("..//navbar.php")?>

  
<div id="printable">
   <div class="container"  style="border: 1px solid black;">
<div class="row">
<table> 
<tr>
      <td style="padding-left: 2vw;">
      <table>

      <tr><td style="color: red;font-weight: bold;"> VOGEL TRADING</td></tr>
      <tr><td> 17/81 #2 GROUND FLOOR</td></tr>
      <tr><td> A TOWER COMPLEX</td></tr>
      <tr><td> CALVERY JUNCTION</td></tr>
      <tr><td> ARANATTUKARA ROAD</td></tr>
      <tr><td> POOTHOL, THRISSUR - 680004</td></tr>
      <tr><td> PHONE: 04847-2383104, 8138913909</td></tr>
      <tr><td> Email: vogeluniforms@gmail.com</td></tr>


      </table>

      </td>
      <td>
      <img  style="margin-left:18vw;" src="../images/logo.jpeg" width="200px" height="100">
      </td>
</tr>

<tr>
        <td colspan="2">
        <p style="margin-left: 30vw;font-size: 2.5vw;font-weight: bold;">GOODS RETURN VOUCHER</p>
        </td>
</tr>
</table>
</div>
<div class="row" style="*border: 1px solid;border-top: solid 1px;">
<!-- <div  style="float:left;width: 50%;border-right: 1px;">  -->


  <!-- ---------------------------- FIRST DATA TABLE------------------------------------ -->
  <table border="0" style="margin-left: 5px;">
 
        <tr><td style="width: 25vw;border: none;">GRV NO :   </td><td style="width: 25vw;"> <b>  <?php echo $grv_id;?></b> </td><td colspan="2" style="width: 50vw;border-left: 1px solid;padding-left: 5px;"> BILLING ADDRESS :</td></tr>
       <tr><td style="width: 15vw;">GRV DATE :</td><td><b> <?php echo $grv_date;?></b></td><td colspan="2" style="border-left: 1px solid;padding-left: 40px;"><b><?php echo $customer_name;?></b>  </td></tr>
     <tr><td style="width: 25vw;">INVOICE NO :</td><td><b> <?php echo $invoice_no;?></b></td><td colspan="2" style="border-left: 1px solid;padding-left: 40px;"><b><?php echo $customer_address;?></b></td></tr>

     <tr><td style="width: 25vw;">INVOICE DATE :</td><td><b> <?php echo $sales_date;?></b></td><td colspan="2" style="border-left: 1px solid;padding-left: 40px;"></td></tr></table>

<!-- --------------------------- PAYMENT TABLE----------------- -->
     <!--      <table border="0" class="table-condensed" >
            <tr><td> <b>PAYMENT </b></td><td style="width: 8vw;text-align: center">CASH</td>
              <td style="width: 5vw;,padding-left: 2vw;"> <div style="width: 28px;height: 23px;border: 1px  solid;"></div> </td>
              <td style="width: 14vw;padding-left: 4.5vw;">CHEQUE</td>
              <td style="width: 2vw;"> <div style="width: 28px;height: 23px;border: 1px  solid;"></div></td></tr></table>

     </td><td style="border-left: 1px solid;" colspan="2"><b> </b> </td></tr></table>
 -->
<!-- -------------------------------------SECOND TABLE ----------- -->

     <table border="1" style="text-align: center;*border-right: none;*border-left: none;">
       <tr><td style="width: 25vw;">BRANCH</td><td style="width: 25vw;">   <?php echo $branch_name; ?>    </td><td style="width: 25vw;">EXECUTIVE NAME</td><td style="width: 25vw;"><?php echo $staff_name;?> </td></tr>
        
   </table>
<!-- -------------------------------------SECOND TABLE ----------- -->
     


          
      </div>



<!-- ------------------------ ITEM LIST TABLE------------------ -->
<div class="row" style="height: 50vw;border-bottom: 1px solid;" >
        <table  class="table" style="width: 100%;text-align: center;">
          <tr  style="font-weight: bold;height: 1vw;">
            <td>SL NO</td>
            <td> ITEM  </td>
            <td>ARTICLE No</td>
            <td> QTY</td>
            <td>RATE</td>
            <td> AMOUNT</td>
          </tr>
 <?php
 $slno=0;
while($fetch_article=mysqli_fetch_array($article_query))
      {
        $article_name=$fetch_article["article_name"];
        $article_no=$fetch_article["article_no"];
        $article_qty=$fetch_article["article_qty"];
        $sales_price=$fetch_article["sales_price"];

        $slno++
        ?>
<tr ><td><?php echo $slno;?></td><td> <?php echo $article_name ;?>  </td><td><?php echo $article_no;?> </td><td> <?php echo $article_qty;?> </td><td><?php echo $sales_price;?> </td><td> <?php echo $article_qty*$sales_price;?>   </td></tr>
 <?php      }
      ?>
      </table>
</div>
<div class="row" >
  <!-- ---------------------- AMOUNT IN WORDS TABLE--------------------- -->

  <div  style="float:left;width: 50%;">
    <div style="font-size: 2vw;">
      <b >Amount in Words :</b> 
      <p style="margin-left: 2vw;"> </p>
      <input  type="text" name="" style="border: none;text-align: center;width: 100%;">
    </div><br>


   </div>

  <div  style="float:right;width: 50%;">
<table border="1"  style="border: none;text-align: center;">
  <tr>    <td> <b>AMOUNT</b></td>    <td><?php echo $sales?></td>  </tr>
  <tr>    <td> <b>TOTAL AMOUNT</b></td>    <td><?php echo $sales?></td>  </tr>
  <tr>    <td> GST</td>    <td><input type="text" name="" style="border: none;text-align: center;"></td>  </tr>
  <tr>    <td> SGST</td>    <td><input type="text" name="" style="border: none;text-align: center;"></td>  </tr>
  <tr>    <td> DISCOUNT</td>    <td> <input type="number" name="" style="border: none;text-align: center;"></td>  </tr>
  <tr>    <td> <b>Grand Total (Including Tax)</b></td>    <td><input type="number" name="" style="border: none;text-align: center;font-weight: bold;"></td>  </tr>
</table>
   </div>
</div>
  <div class="row" style="border: 1px solid;*height: 20vw;*font-family: fantasy;">
    <div  style="float:left;width: 50%;height: 15vw;">  
      <table class="table">
    <tr><td style="width:50vw;"><b >GOODS RECIEVED BY :</b> </td></tr>

<tr> <td><b style="padding-left: 2vw;">Authorized Stamp & Signatory</b></td></tr>
 </table></div>
    <div  style="float:right;width: 50%;border-left: 1px solid;height: 15vw;text-align: center;">
    <h4>for VOGEL TRADING</h4></div>

</div>    
<p style="margin-left: 25vw;">Thank you for your business !!</p>
    </div>



   <!-- ///.......... DELIVERY ORDER ......... ///  -->
     <div style="page-break-before: always" class="" style="height: 42vw;">
  

   <div class="container" style="border: 1px solid black;display: none;">
<div class="row">
<table> 
<tr>
      <td style="padding-left: 2vw;">
      <table>

      <tr><td style="color: red;font-weight: bold;"> VOGEL TRADING</td></tr>
      <tr><td> 17/81 #2 GROUND FLOOR</td></tr>
      <tr><td> A TOWER COMPLEX</td></tr>
      <tr><td> CALVERY JUNCTION</td></tr>
      <tr><td> ARANATTUKARA ROAD</td></tr>
      <tr><td> POOTHOL, THRISSUR - 680004</td></tr>
      <tr><td> PHONE: 04847-2383104, 8138913909</td></tr>
      <tr><td> Email: vogeluniforms@gmail.com</td></tr>


      </table>

      </td>
      <td>
      <img  style="margin-left:18vw;" src="../images/logo.jpeg" width="200px" height="100">
      </td>
</tr>

<tr>
        <td colspan="2">
        <p style="margin-left: 35vw;*font-family: fantasy;font-size: 3vw;font-weight: bold;">GRV DELIVERY ORDER</p>
        </td>
</tr>
</table>
</div>


<div class="row" >

<table class="table-condensed" border="1" style="text-align: center;font-weight: bold;*font-family: fantasy;"> 
<tr> <td>DELIVERY ADDRESS</td ><td colspan="3"><?php echo $customer_name." ".$customer_address?></td></tr>
    <tr><td style="width: 25vw;">GRV NO</td><td style="width: 25vw;">  <?php echo $grv_id; ?> </td ><td style="width: 25vw;">GRV DATE</td><td style="width: 25vw;"> <?php echo $grv_date; ?></td></tr>
      <tr><td style="width: 25vw;">INVOICE NO</td><td style="width: 25vw;">  <?php echo $invoice_no; ?> </td ><td style="width: 25vw;">INVOICE DATE</td><td style="width: 25vw;"> <?php echo $sales_date; ?></td></tr>
    <tr><td>BRANCH</td><td>  <?php echo $branch_name; ?> </td><td>EXECUTIVE NAME</td><td> <?php echo $staff_name; ?></td></tr>

</table>
</div>
<div class="row" style="height: 70vw;">
        <table class="table" border="1"><tr style="text-align: center;font-weight: bold;height: 1vw;">
          <td>SL NO</td><td> ITEM  </td><td>ARTICLE No</td><td> BUNDLE</td><td>QUANTITY</td></tr>
<?php
     $slno=0;
    while($fetch_article2=mysqli_fetch_array($article_query2))
          {

            $slno++
?>
        <tr>
          <td><?php echo $slno;?></td>
          <td> <?php echo $fetch_article2["article_name"];?>  </td>
          <td><?php echo $fetch_article2["article_no"];?> </td>
          <td> </td>
          <td> <?php echo $fetch_article2["article_qty"];?> </td>
        </tr>
 <?php 
              $qty+=$fetch_article2["article_qty"];

             }
      ?>
    
      </table>
</div>
<table class="table" style="font-weight: bold;text-align: center;font-size: 2.5vw;*font-family: serif;">  <tr>
        <td colspan="4" style="float: right;">TOTAL QUANTITY
        </td>
        <td><?php echo $qty;?></td>
      </tr></table>


<div class="row" style="border: 1px solid;height: 20vw;*font-family: fantasy;">
    <div  style="float:left;width: 50%;height: 20vw;">  
      <table class="table">
    <tr><td style="width:50vw;"><b >GOODS RECIEVED BY :</b> </td></tr>

<tr> <td><b style="padding-left: 2vw;">Authorized Stamp & Signatory</b></td></tr>
 </table></div>
    <div  style="float:right;width: 50%;border-left: 1px solid;height: 20vw;text-align: center;">
    <h4>for VOGEL TRADING</h4></div>

</div>


      
    </div>
    </div> 
  
</div>
<script type="text/javascript">
  function edit_category(color_id)
   {
    // alert(vendor_id);
    $.ajax({
      type:"POST",
      url:"edit/color_edit.php",
      data:{
        color_id:color_id
      },
      success:function(data)
      {
        // alert(data);
        $("#total_div").html(data);
      }

    })
  }
</script>

</body>
</html>

