<?php
 $sales_sql="SELECT sales.sales_id, 
       sales.invoice_no, 
       sales.sales_date, 
       customers.customer_name, 
       customers.customer_id, 
       customers.customer_address, 
       customers.customer_phone, 
       customers.customer_gst, 
       branches.branch_name, 
       staffs.staff_name, 
       sales.sales, 
       sales.profit,
       sales.paid
FROM   sales 
       LEFT JOIN customers 
              ON customers.customer_id = sales.customer_id 
       LEFT JOIN staffs 
              ON staffs.staff_id = sales.staff_id 
       LEFT JOIN branches 
              ON branches.branch_id = staffs.branch_id 
WHERE  sales.sales_id = '$sales_id' ";


      

    $query=mysqli_query($conn,$sales_sql);
  
    
    $fetch=mysqli_fetch_array($query);
    $sales_id=$fetch["sales_id"];
   $sales_date=$fetch["sales_date"];
     $sales_date = date("d-m-Y", strtotime($sales_date));
   $invoice_no=$fetch["invoice_no"];
   // $sales=1000000;
   $profit=$fetch["profit"];
 
     // $amount= getIndianCurrency($sales);
     // $amount= getIndianCurrency(1000.5);
   $customer_name=$fetch["customer_name"];
   $customer_id=$fetch["customer_id"];
   $customer_phone=$fetch["customer_phone"]; 
   $customer_gst=$fetch["customer_gst"];
   $branch_name=$fetch["branch_name"];
   $staff_name=$fetch["staff_name"];
   $sales_id=$fetch["sales_id"];
  
   $invoice_no=$fetch["invoice_no"];
   $sales=$fetch["sales"];
   $paid=$fetch["paid"];
      
   $staff_name=$fetch["staff_name"];
   $branch_name=$fetch["branch_name"];
       $customer_address=$fetch["customer_address"];

 $article_sql="SELECT articles.article_id, 
             articles.article_no, 
             articles.hsn_no,
             articles.cess,
             articles.sgst,articles.cgst,articles.igst,
             articles.article_name, 
             articles.article_price, 
             articles.sales_price, 
             sales_articles.article_qty 
      FROM   sales_articles 
             LEFT JOIN articles 
                    ON articles.article_id = sales_articles.article_id 
      WHERE  sales_articles.sales_id = '$sales_id' ";
        $article_query=mysqli_query($conn,$article_sql);

function AmountInWords( $amount)
{
   $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
   // Check if there is any number after decimal
   $amt_hundred = null;
   $count_length = strlen($num);
   $x = 0;
   $string = array();
   $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
     3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
     7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
     10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
     13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
     16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
     19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
     40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
     70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $x < $count_length ) {
      $get_divider = ($x == 2) ? 10 : 100;
      $amount = floor($num % $get_divider);
      $num = floor($num / $get_divider);
      $x += $get_divider == 10 ? 1 : 2;
      if ($amount) {
       $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
       $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
       $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
       '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
       '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
        }
   else $string[] = null;
   }
   $implode_to_Rupees = implode('', array_reverse($string));
   $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
   return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
}


function vround( $number)
{
  $whole = floor($number);     
  $fraction = $number - $whole;
  if (( $fraction <= 0.54 && $fraction>0.04))    
  {
    $result= $whole+.50;
  }
  else if (( $fraction > 0.54 ))  
  {
    $result=$whole+1;
  }
  else{
    $result=$whole;
  }
  return ($result);
}

?>