    
    <?php
include ("../connect.php");
$staff_id=$_POST["staff_id"];
    ?>
    <table class="table-striped table" ><tr>
               
               <td><label>INVOICE NO</label></td>
               <td><label>INVOICE TOTAL</label></td>
               <td><label>PAID AMOUNT </label></td>
               <td><label>PENDING AMOUNT </label></td>
               <td><label>METHOD</label></td>
               <td><label>PAYING</label></td>
               <td><label>BALANCE</label></td>

             </tr>
             <!-- ============== ONE ROW================== -->
             <?php
             $sql="SELECT * FROM `sales` WHERE staff_id='$staff_id' order by sales_id desc";
               $query2=mysqli_query($conn,$sql);
                 $sleno=1;
                while ($fetch2=mysqli_fetch_array($query2))
                 {
                 $invoice_no=$fetch2['invoice_no'];
                 $sales_id=$fetch2['sales_id'];
                 $total=$fetch2['total'];


                 $sales=$fetch2['sales'];

                 $paid=$fetch2['paid'];
                 
                 $balance=$total-$paid;
            
         
           


             ?>
             <tr >
               <td><input class="w3-input"  type="text" id="invoice_no<?php echo $sleno?>" style="color: blue;font-weight: bold;" name="invoice_no" value="<?php echo $invoice_no;?>"></td>
               <td><input class="w3-border-0" type="text" name="invoice_amount" id="invoice_amount<?php echo $sleno?>"  value="<?php echo $total;?>"></td>
               <td><input class="w3-border-0" type="text" name="invoice_paid" id="invoice_paid<?php echo $sleno?>"  value="<?php echo $paid;?>"></td>
               <td><input class="w3-border-0" type="text" name="invoice_paid" id="invoice_balance<?php echo $sleno?>"  value="<?php echo round($balance,2);?>"></td>
               <td><select class="w3-border-0" name="method" >
               
                <option value="1">CASH</option>
                <option value="2">ONLINE</option>
                <option value="3">BANK</option>
               </select></td>
               <td><input class="form-control" onchange="display_balance(this.value,'<?php echo $sleno;?>');" type="text" id="paid<?php echo $sleno?>" name="paid" placeholder="PAID AMOUNT"></td>
               <td><input class="w3-border-0" type="text" id="balance<?php echo $sleno?>" name="balance" placeholder="BALANCE"></td>
             </tr>
             <?php $sleno++;}?>
             <tr>
                 <tr>
               <td colspan="3"><label>TOTAL</label></td><td><input class="form-control" type="text" id="total" placeholder="TOTAL"></td>
             </tr>
             </tr>