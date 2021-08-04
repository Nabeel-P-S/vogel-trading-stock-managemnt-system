<?php


$from_date='2020-08-01';
$to_date=$date;
$staff_id=2;
            
  $sql5="SELECT * FROM `staffs` where staff_id='$staff_id'";
          $query5=mysqli_query($conn,$sql5);
          $fetch5=mysqli_fetch_array($query5);
          $staff_name=$fetch5['staff_name'];
             
  if (!empty($_GET["staff_id"])) 
    {
       $staff_id = $_GET['staff_id'];
     }


     if (!empty($_GET["from_date"])) 
     {
       $from_date = $_GET['from_date'];
       $to_date = $_GET['to_date'];



       
     } 
//       td:nth-child(even) {
//   background-color:#ffedf5;
//   color: black;
// }
//   tr:nth-child(even) {
//   background-color:#ebfffa;
//   color: black;
// }

?>

<!DOCTYPE html>
<html>
<head>
  <title>sales<?php echo date("d-m-Y", strtotime($date))."-".$time;?></title>

</head>
<style type="text/css">

  .total_td
  {
    font-weight: bold;
    font-size:  .9vw;
  }
</style>
<body>


 <div class="col-lg-2" ><input  placeholder="Search" id="myInput" type="text" style="width: 12vw;color: black;margin-bottom: 1vw;">   </div>
 <div class="col-lg-10" >

  <!-- <a class="btn btn-danger"  href="../print/sales_print.php">PRINT</a> -->



  <table>
    <tr>
 
    <td>
      <input list="staffs" id="executive_id"  class="form-control" style="*width: 12vw;" onchange="staff_refresh(this.value);" value="<?php echo $staff_id ?>"  name="staff_id" placeholder="SEARCH STAFF" >
      <datalist id="staffs">
        <option style="color: grey" value="" >SELECT STAFF</option>
        <?php

        $query = mysqli_query($conn, "SELECT * from staffs");
        while ($fetch = mysqli_fetch_array($query))
        {
          ?>
          <option  value="<?php echo $fetch['staff_id']; ?>" ><?php echo $fetch['staff_name']; ?> </option>
          <?php
        }
        ?> 
      </datalist> 
    </td>
<td> 
  <!-- <button class="btn btn-success" id="mode" onclick="refresh_again3()">Change View</button> -->
  <input type="button" id="mode" class="btn btn-success" value="STAFF VIEW" onclick="refresh_again3()">
</td>
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
<div style="width: 50%;float: left;text-align: right;"><legend> FINAL STATEMENT </legend> </div>
<div style="width: 50%;float: right;text-align: right;">DATE : <?php echo  date("d/m/Y", strtotime($from_date)) ?> TO <?php echo date("d/m/Y", strtotime($to_date)) ?></div>

  <!--   <table >
    <tr>

      <td style="text-align:right;"><h3> <b>  </b></h3></td>
      <td style="float: right;"><h4> </h4></td></tr>
  </table>
 -->
      <table style="font-size: .75vw;*display: none;*font-family: unset;" border="1" id="all_table" class="table-condensed table table-hover table-stiped ">
 
        <tr ><td style="width: 1vw;">Details</td>
          <?php 
            $sql="SELECT count(article_id) as total_article FROM `articles`";
          $query=mysqli_query($conn,$sql);
          $fetch=mysqli_fetch_array($query);
          $total_article=$fetch['total_article'];
          $sql="SELECT count(staff_id) as total_staff FROM `staffs`";
          $query=mysqli_query($conn,$sql);
          $fetch=mysqli_fetch_array($query);
          $total_staff=$fetch['total_staff'];

          $wsql="select * from articles";
          $query=mysqli_query($conn,$wsql);
          $i=1;
          $sum=0;
         
$price_sum=0;
          while($fetch=mysqli_fetch_array($query))
          {
            ?> <td> <table> <tr> 
              <?php
              $sgst=0 ;
              $cgst=0 ;
              $igst=0 ;
              $sales_price=$fetch["sales_price"];
              if (is_numeric($fetch["sgst"])) { $sgst= $fetch["sgst"];} else{ $sgst=0 ;}
if (is_numeric($fetch["cgst"])) { $cgst= $fetch["cgst"];}else{$cgst=0 ;}
if (is_numeric($fetch["igst"])) {  $igst= $fetch["igst"];}else{   $igst=0 ;}
$sgst=$sales_price*($sgst/100);
$cgst=$sales_price*($cgst/100);
$igst=$sales_price*($igst/100);
              $item_price[$i]=$fetch["sales_price"]+$sgst+$cgst+$igst;
              $price_sum+=$fetch["sales_price"];


              $item_sum[$i]=0;

              $est_qty[$i]=0;
              $stock_qty[$i]=0;
              $avail_qty[$i]=0;
              $est_mrp[$i]=0;
              $sls_qty[$i]=0;
              $sls_mrp[$i]=0;

              ?>
              <td><?php echo $fetch["article_id"]?></td></tr><tr>
              <td style="font-weight: bold;"><?php echo $fetch["article_no"]; ?>
                 
               </td></tr><tr><td>

               <?php 

 // echo number_format((float)$item_price[$i], 2, '.', '');
               echo round($item_price[$i],2);
               $item_price[$i]=round($item_price[$i],2);

             ?></td> </tr></table></td>
            <?php 
            $i++;
          }
          ?>
          <td  >
<table>
  <tr>
    <td>TOTAL</td>
  </tr>
  <tr><td>   
           </td></tr>
</table>
         
          </td>
        </tr>
          <tr>
          <td>
            Total Stock Entered
          </td>
          
            <?php
            $stock_sum=0;
             for($p=1;$p<=$total_article;$p++)
          {
                     $sql7="SELECT SUM(article_qty) as stock_qty from stocks where article_id='$p' AND stock_date BETWEEN '$from_date' AND '$to_date'";
                         $query7=mysqli_query($conn,$sql7);
  
           $fetch7=mysqli_fetch_array($query7);
           
           
            ?>

           <td ><?php

 $stock_qty[$p]=$fetch7["stock_qty"];
 echo $stock_qty[$p];
           $stock_sum+= $fetch7["stock_qty"];
            ?> 
           </td>
            <?php
          }
          ?>
            <td class="total_td"><?php echo $stock_sum;?></td>
        </tr>
        <tr>

          <td>Total Estimation Quantity</td>
          <?php
        


          for($j=1;$j<=$total_article;$j++)
          {

           $sql1="SELECT SUM(estimation_articles.article_qty) as est_sum FROM `estimation_articles` LEFT JOIN estimation on estimation.sales_id=estimation_articles.sales_id where estimation_articles.article_id='$j' AND estimation.sales_date BETWEEN '$from_date' AND '$to_date'";


           $query1=mysqli_query($conn,$sql1);
  
           $fetch1=mysqli_fetch_array($query1);
           ?>
           <td ><?php
           if (isset($fetch1["est_sum"])) { 
     
          } else
          {
                $fetch1["est_sum"]=0;
          }
         
             echo $fetch1["est_sum"];
            $sum+= $fetch1["est_sum"];
           $est_qty[$j]=$fetch1["est_sum"];
          ?></td>
          <?php
        }
        ?><td class="total_td"><?php echo $sum;?></td>
      </tr>
        <tr>
          <td>Total Estimation Amount (Rupees)</td>
          <?php
       $total_est=0;


          for($j=1;$j<=$total_article;$j++)
          {




        
           ?>
           <td >
            <?php
            $est_mrp[$j]=$est_qty[$j]* $item_price[$j];
                     // echo $est_qty[$j]* $item_price[$j];
            $total_est=$total_est+ $est_mrp[$j];
                     echo $est_mrp[$j];

          
          ?></td>
          <?php
        }
        ?><td class="total_td"><?php echo number_format($total_est,2);?> </td>
      </tr>
       <tr>
          <td>Total Invoice Quantity</td>
          <?php
        

$sales_total=0;
          for($j=1;$j<=$total_article;$j++)
          {

           $sql1="SELECT SUM(sales_articles.article_qty) as sls_sum FROM `sales_articles` LEFT JOIN sales on sales.sales_id=sales_articles.sales_id where sales.category=0 and sales_articles.article_id='$j' AND sales.sales_date BETWEEN '$from_date' AND '$to_date'";


           $query1=mysqli_query($conn,$sql1);
  
           $fetch1=mysqli_fetch_array($query1);
           ?>
           <td ><?php
           if (isset($fetch1["sls_sum"])) { 
     
          } else
          {
                $fetch1["sls_sum"]=0;
          }
         
             echo $fetch1["sls_sum"];
            $sales_total+= $fetch1["sls_sum"];
           $sls_qty[$j]=$fetch1["sls_sum"];
          ?></td>
          <?php
        }
        ?><td class="total_td"><?php echo $sales_total;?></td>
      </tr>
        <tr>
          <td>Total Invoice   Amount (Rupees)</td>
          <?php
       
$total_inv=0;

          for($j=1;$j<=$total_article;$j++)
          {




        
           ?>
           <td >
            <?php
              $sls_mrp[$j]=$sls_qty[$j]* $item_price[$j];
            $total_inv=$total_inv+$sls_mrp[$j];
                     echo $sls_mrp[$j];
                     // echo $sls_qty[$j]* $item_price[$j];
          
          ?></td>
          <?php
        }
        ?><td class="total_td"><?php echo number_format($total_inv,2);?> </td>
      </tr>
       <tr>
          <td>Staff Stock Quantity</td>
          <?php
        

$diff_qty_sum=0;
          for($j=1;$j<=$total_article;$j++)
          {

       
           ?>
           <td ><?php
         $diff_qty=$est_qty[$j]-$sls_qty[$j];
         echo $diff_qty;
         $diff_qty_sum=$diff_qty_sum+$diff_qty;
          ?></td>
          <?php
        }
        ?><td class="total_td"><?php echo $diff_qty_sum;?></td>
      </tr>
        <tr>
          <td>Staff Stock Amount(Rupees)</td>
          <?php
       
$diff_mrp_sum=0;

          for($j=1;$j<=$total_article;$j++)
          {




        
           ?>
           <td >
            <?php
              $diff_mrp=$est_mrp[$j]-$sls_mrp[$j];
         echo $diff_mrp;
         $diff_mrp_sum+=$diff_mrp
          
          ?></td>
          <?php
        }
        ?><td class="total_td"><?php echo number_format($diff_mrp_sum,2);?> </td>
      </tr>
      <tr>
       <td>
          Available Stock
       </td>
<?php   $total_avail_qty=0;
 for($i=1;$i<=$total_article;$i++)
          {?>
            <td>
              <?php 
               
              $avail_qty[$i]= $stock_qty[$i]-$est_qty[$i]; 
  echo $avail_qty[$i];
  $total_avail_qty+=$avail_qty[$i]
              ?>
            </td>
         <?php }?>
         <td class="total_td">
           <?php echo $total_avail_qty;?>
         </td>
      </tr>
     </table>


<!-- =============================== STAFF TABLE ========================================================================================================= -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
  
 
      <table style="font-size: .75vw;display: none;" border="1" id="staff_table" class="table-condensed table table-hover table-striped ">
             <!-- <h3 style="text-align: center;"><b>FINAL STAFF STATEMENT  </b></h3> -->
             <?php 
  $sql5="SELECT * FROM `staffs` where staff_id='$staff_id'";
          $query5=mysqli_query($conn,$sql5);
          $fetch5=mysqli_fetch_array($query5);
          $staff_name=$fetch5['staff_name'];
             ?>
        <tr ><td><table><tr><td>Details</td></tr><tr><td><h4><?php echo $staff_name;?></h4></td></tr></table></td>
          <?php 
            $sql="SELECT count(article_id) as total_article FROM `articles`";
          $query=mysqli_query($conn,$sql);
          $fetch=mysqli_fetch_array($query);
          $total_article=$fetch['total_article'];
          $sql="SELECT count(staff_id) as total_staff FROM `staffs`";
          $query=mysqli_query($conn,$sql);
          $fetch=mysqli_fetch_array($query);
          $total_staff=$fetch['total_staff'];

          $wsql="select * from articles";
          $query=mysqli_query($conn,$wsql);
          $i=1;
          $est_total=0;
$price_sum=0;
          while($fetch=mysqli_fetch_array($query))
          {
            ?> <td> <table> <tr> <td style="font-weight: bold;">
              <?php
              $sgst=0 ;
              $cgst=0 ;
              $igst=0 ;
              $sales_price=$fetch["sales_price"];
              if (is_numeric($fetch["sgst"])) { $sgst= $fetch["sgst"];} else{ $sgst=0 ;}
if (is_numeric($fetch["cgst"])) { $cgst= $fetch["cgst"];}else{$cgst=0 ;}
if (is_numeric($fetch["igst"])) {  $igst= $fetch["igst"];}else{   $igst=0 ;}
$sgst=$sales_price*($sgst/100);
$cgst=$sales_price*($cgst/100);
$igst=$sales_price*($igst/100);
              $item_price[$i]=$fetch["sales_price"]+$sgst+$cgst+$igst;
              $price_sum+=$fetch["sales_price"];


              $item_sum[$i]=0;

              $est_qty[$i]=0;
              $stock_qty[$i]=0;
              $avail_qty[$i]=0;
              $est_mrp[$i]=0;
              $sls_qty[$i]=0;
              $sls_mrp[$i]=0;

               echo $fetch["article_no"]; ?>
                 
               </td></tr><tr><td>

               <?php 

 // echo number_format((float)$item_price[$i], 2, '.', '');
               echo round($item_price[$i],2);
               $item_price[$i]=round($item_price[$i],2);

             ?></td> </tr></table></td>
            <?php 
            $i++;
          }
          ?>
          <td  >
                  <table>
                    <tr>
                      <td>TOTAL</td>
                    </tr>
                    <tr><td>   
                             <?php  echo $price_sum;?></td></tr>
                  </table>
                           
          </td>
        </tr>
        <tr>
          <td>Total Estimation Quantity</td>
          <?php
        


          for($j=1;$j<=$total_article;$j++)
          {

           $sql11="SELECT SUM(estimation_articles.article_qty) as est_sum FROM `estimation_articles` LEFT JOIN estimation on estimation.sales_id=estimation_articles.sales_id where estimation_articles.article_id='$j' and estimation.staff_id='$staff_id' AND estimation.sales_date BETWEEN '$from_date' AND '$to_date'";


           $query11=mysqli_query($conn,$sql11);
  
           $fetch11=mysqli_fetch_array($query11);
           ?>
           <td ><?php
           if (isset($fetch11["est_sum"])) { 
     
          } else
          {
                $fetch11["est_sum"]=0;
          }
         
             echo $fetch11["est_sum"];
            $est_total+= $fetch11["est_sum"];
           $est_qty[$j]=$fetch11["est_sum"];
           // $sum1+=  $est_qty[$j];
          ?></td>
          <?php
        }
        ?><td class="info"><?php echo $est_total;?></td>
      </tr>
        <tr>
          <td>Total Estimation Amount (Rupees)</td>
          <?php
       
$est_mrp_total=0;

          for($j=1;$j<=$total_article;$j++)
          {




        
           ?>
           <td >
            <?php
            $est_mrp[$j]=$est_qty[$j]* $item_price[$j];
                     // echo $est_qty[$j]* $item_price[$j];
                     echo $est_mrp[$j];
                     $est_mrp_total=$est_mrp_total+$est_mrp[$j];
          
          ?></td>
          <?php
        }
        ?><td class="info"><?php echo number_format($est_mrp_total,2);?> </td>
      </tr>
       <tr>
          <td>Total Invoice Quantity</td>
          <?php
        

$sales_total=0;
          for($j=1;$j<=$total_article;$j++)
          {

           $sql1="SELECT SUM(sales_articles.article_qty) as sls_sum FROM `sales_articles` LEFT JOIN sales on sales.sales_id=sales_articles.sales_id where sales.category=0 and sales_articles.article_id='$j' and sales.staff_id='$staff_id' AND sales.sales_date BETWEEN '$from_date' AND '$to_date'";



           $query1=mysqli_query($conn,$sql1);
  
           $fetch1=mysqli_fetch_array($query1);
           ?>
           <td ><?php
           if (isset($fetch1["sls_sum"])) { 
     
          } else
          {
                $fetch1["sls_sum"]=0;
          }
         
             echo $fetch1["sls_sum"];
            $sales_total+= $fetch1["sls_sum"];
           $sls_qty[$j]=$fetch1["sls_sum"];
          ?></td>
          <?php
        }
        ?><td class="info"><?php echo $sales_total;?></td>
      </tr>
        <tr>
          <td>Total Invoice   Amount (Rupees)</td>
          <?php
       
$sls_mrp_total=0;

          for($j=1;$j<=$total_article;$j++)
          {




        
           ?>
           <td >
            <?php
              $sls_mrp[$j]=$sls_qty[$j]* $item_price[$j];

                     echo $sls_mrp[$j];
                     $sls_mrp_total= $sls_mrp_total+$sls_mrp[$j];
                     // echo $sls_qty[$j]* $item_price[$j];
          
          ?></td>
          <?php
        }
        ?><td class="info"><?php echo number_format($sls_mrp_total,2);?> </td>
      </tr>
       <tr>
          <td>Estimation Stock Quantity</td>
          <?php
        

$diff_qty_sum=0;
          for($j=1;$j<=$total_article;$j++)
          {

       
           ?>
           <td ><?php
         $diff_qty=$est_qty[$j]-$sls_qty[$j];
         echo $diff_qty;
         $diff_qty_sum+=$diff_qty
          ?></td>
          <?php
        }
        ?><td class="info"><?php echo $diff_qty_sum;?></td>
      </tr>
        <tr>
          <td>Estimation Stock Amount(Rupees)</td>
          <?php
       
$diff_mrp_sum=0;

          for($j=1;$j<=$total_article;$j++)
          {




        
           ?>
           <td >
            <?php
              $diff_mrp=$est_mrp[$j]-$sls_mrp[$j];
         // echo $diff_mrp;
                  echo number_format($diff_mrp,2);

         $diff_mrp_sum+=$diff_mrp
          
          ?></td>
          <?php
        }
        ?><td class="info"><?php echo number_format($diff_mrp_sum,2);?> </td>
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

if (document.getElementById("all_table").style.display=="none") {
  document.getElementById("all_table").style.display="block";
  document.getElementById("staff_table").style.display="none";
  document.getElementById("mode").value="Staff View";

}
else
{
   document.getElementById("all_table").style.display="none";
  document.getElementById("staff_table").style.display="block";
    document.getElementById("mode").value="All View";

}


  }
</script>
<script type="text/javascript">
    function staff_refresh(staff_id)
  {
 var from_date=document.getElementById("from_date").value;
    var to_date=document.getElementById("to_date").value;
    window.location="final.php?from_date=" + from_date + "&to_date=" + to_date + "&staff_id=" + staff_id;
// window.location="final.php?staff_id=" + staff_id;


  }
</script>
<script type="text/javascript">
  function date_filter()
  {
    var from_date=document.getElementById("from_date").value;
    var to_date=document.getElementById("to_date").value;
    var staff_id=document.getElementById("executive_id").value;
    // window.location="final.php?from_date=" + from_date + "&to_date=" + to_date;
        window.location="final.php?from_date=" + from_date + "&to_date=" + to_date + "&staff_id=" + staff_id;

  }
</script>
</body>

</html>