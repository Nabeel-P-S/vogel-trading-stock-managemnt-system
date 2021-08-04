<?php
include '../connect.php';
$sales_id = $_GET['sales_id'];
    // $query=mysqli_query($conn,"select sales_id from sales order by sales_id desc LIMIT 1");
    // $fetch1=mysqli_fetch_array($query);
    //  $sales_id=$fetch1['sales_id'];
include('sales_details.php');  
?>
<!DOCTYPE html>
<html>
<head>
  <title>VOGEL SALES BILL</title>
</head>
  <script type="text/javascript">
        window.onload=window.print();
    </script>
<body>
  <!-- <button  id="print_btn" onclick="window.print();">print</button> -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins"> 
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="shortcut icon" href="../images/logo.jpg">
  <link rel="stylesheet" href="../css/w3.css">
  <link rel="stylesheet" type="text/css" href="../css/sweetalert.css"><label hidden="">invalid</label>
  <script src="../sweetalert.min.js"></script>
  


  
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
        <p style="margin-left: 40vw;font-size: 4vw;font-weight: bold;">INVOICE</p>
        </td>
</tr>
</table>
</div>
<div class="row" style="border: 1px solid;">
<div  style="float:left;width: 50%;border-right: 1px;"> 
  <table  border="0"  >
 
        <tr><td style="">INVOICE NO :   </td><td>   <?php echo $invoice_no;?> </td></tr>
       <tr><td style="width: 15vw;">DATE :</td><td> <?php echo $sales_date;?></td></tr>
     <tr><td style="width: 25vw;">DELIVERY ORDER NO :</td><td> <?php echo $sales_id;?></td></tr>
     <tr><td> <b>PAYMENT TERMS</b></td></tr></table>
          <table border="1" ><tr><td style="width: 25vw;">CASH</td><td style="width: 8vw;">  </td><td style="width: 25vw;">CHEQUE</td><td style="width: 8vw;"> </td></tr></table>


          
      </div>


<div style="float:right;width:50%;border: solid 1px ;height: 14vw;">
<table>
  <tr><td  style="*width: 105vw;font-weight: bold;padding-left: 2vw;"> BILLING ADDRESS </td></tr>
  <tr><td  style="*width: 105vw;padding-left: 2vw;"> <?php echo $customer_name;?>  </td></tr>
  <tr><td  style="*width: 105vw;padding-left: 2vw;"> <?php echo $customer_address;?>  </td></tr>
</table>
<br>
<br>

</div>

</div>

<div class="row" >
<table border="1" style="text-align: center;"> 
  <tr><td style="width: 25vw;">ONLINE PAYMENT</td><td style="width: 25vw;">  <input type="text" name="" style="border: none;text-align: center;">   </td><td style="width: 25vw;">MOBILE NO</td><td style="width: 25vw;"><?php echo $customer_phone;?> </td></tr>
         <tr><td>DUE DATE</td><td> <input type="text" name="" style="border: none;text-align: center;">   </td><td>GSTIN</td><td> <?php echo $customer_gst;?></td></tr>
            <tr><td>BRANCH</td><td>  <?php echo $branch_name; ?> </td><td>EXECUTIVE NAME</td><td> <?php echo $staff_name; ?></td></tr>

</table>
</div>
<div class="row" style="height: 50vw;">
        <table class="table" border="1"><tr style="text-align: center;font-weight: bold;height: 1vw;"><td>S NO</td><td> ITEM  </td><td>ARTICLE No</td><td> QTY</td><td>Unit Rate</td><td> Amount  </td></tr>
 <?php
 $slno=0;
while($fetch_article=mysqli_fetch_array($article_query))
      {

        $slno++
        ?>
<tr ><td><?php echo $slno;?></td><td> <?php echo $fetch_article["article_name"];?>  </td><td><?php echo $fetch_article["article_no"];?> </td><td> <?php echo $fetch_article["article_qty"];?> </td><td><?php echo $fetch_article["sales_price"];?> </td><td> <?php echo $fetch_article["article_qty"]*$fetch_article["sales_price"];?>   </td></tr>
 <?php      }
      ?>
      </table>
</div>

<div class="row" style="border: 1px solid;">
  <div  style="float:left;width: 50%;">
    <div style="font-size: 2vw;">
      <b >Amount in Words :</b> 
      <p style="margin-left: 2vw;"> </p>
    </div><br>


   </div>
  <div  style="float:right;width: 50%;">
<table  border="1"  style="border: none;text-align: center;">
  <tr>    <td> <b>AMOUNT</b></td>    <td><?php echo $sales?></td>  </tr>
  <tr>    <td> <b>TOTAL</b></td>    <td><?php echo $sales?></td>  </tr>
  <tr>    <td> GST</td>    <td><input type="text" name="" style="border: none;text-align: center;"></td>  </tr>
  <tr>    <td> SGST</td>    <td><input type="text" name="" style="border: none;text-align: center;"></td>  </tr>
  <tr>    <td> DISCOUNT</td>    <td> <input type="number" name="" style="border: none;text-align: center;"></td>  </tr>
  <tr>    <td> <b>Grand Total (Inc Tax)</b></td>    <td><input type="number" name="" style="border: none;text-align: center;font-weight: bold;"></td>  </tr>
</table>
   </div>
</div>
  <div class="row" style="border: 1px solid;*height: 20vw;*font-family: fantasy;">
    <div  style="float:left;width: 50%;*height: 15vw;">  
      <table class="table">
    <tr><td style="width:50vw;"><b >GOODS RECIEVED BY :</b> </td></tr>

<tr> <td><b style="padding-left: 2vw;">Authorized Stamp & Signatory</b></td></tr>
 </table></div>
    <div  style="float:right;width: 50%;border-left: 1px solid;height: 15vw;text-align: center;">
    <h4>for VOGEL TRADING</h4></div>

</div>    
<p style="margin-left: 25vw;">Thank you for your business !!</p>
    </div>
<br>


   <!-- ///.......... DELIVERY ORDER ......... ///  -->
     <div class="" style="height: 42vw;">
  

   <div class="container" style="border: 1px solid black;">
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
        <p style="margin-left: 38vw;*font-family: fantasy;font-size: 3vw;font-weight: bold;">DELIVERY ORDER</p>
        </td>
</tr>
</table>
</div>


<div class="row" >

<table class="table-condensed" border="1" style="text-align: center;font-weight: bold;*font-family: fantasy;"> 
<tr> <td>DELIVERY ADDRESS</td ><td colspan="3"><?php echo $customer_name." ".$customer_address?></td></tr>
    <tr><td style="width: 25vw;">DELIVERY NO</td><td style="width: 25vw;">  <?php echo $sales_id; ?> </td ><td style="width: 25vw;">DATE</td><td style="width: 25vw;"> <?php echo $sales_date; ?></td></tr>
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

