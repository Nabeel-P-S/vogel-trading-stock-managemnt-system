<?php
 $sales_sql="SELECT estimation.sales_id, 
       estimation.invoice_no, 
       estimation.sales_date, 
   
     branches.branch_name,
       branches.branch_name, 
       staffs.staff_name, 
       estimation.staff_id, 
       estimation.sales, 
       estimation.profit
     
FROM   estimation 
       
       LEFT JOIN staffs 
              ON staffs.staff_id = estimation.staff_id 
       LEFT JOIN branches 
              ON branches.branch_id = staffs.branch_id 
WHERE  estimation.sales_id = '$sales_id' ";


       $article_sql="SELECT articles.article_id, 
             articles.article_no, 
             articles.article_name, 
             articles.article_price, 
             articles.sales_price, 
             estimation_articles.article_qty 
      FROM   estimation_articles 
             LEFT JOIN articles 
                    ON articles.article_id = estimation_articles.article_id 
      WHERE  estimation_articles.sales_id = '$sales_id' ";

    $query=mysqli_query($conn,$sales_sql);
    $article_query=mysqli_query($conn,$article_sql);
    $article_query2=mysqli_query($conn,$article_sql);
    $fetch=mysqli_fetch_array($query);
    $sales_id=$fetch["sales_id"];
   $sales_date=$fetch["sales_date"];
     $sales_date = date("d-m-Y", strtotime($sales_date));
   $invoice_no=$fetch["invoice_no"];
   $sales=$fetch["sales"];
   $profit=$fetch["profit"];
     // $amount= getIndianCurrency($sales);
     // $amount= getIndianCurrency(1000.5);


   $branch_name=$fetch["branch_name"];
   $staff_name=$fetch["staff_name"];
   $staff_id=$fetch["staff_id"];
   $sales_id=$fetch["sales_id"];
  
   $invoice_no=$fetch["invoice_no"];
   $sales=$fetch["sales"];
  
    $qty=0;
   $staff_name=$fetch["staff_name"];
   $branch_name=$fetch["branch_name"];
    

   // $branch_id=$fetch["branch_id"];
   // $staff_id=$fetch["staff_id"];

//        function getIndianCurrency(float $number)
// {
//     $decimal = round($number - ($no = floor($number)), 2) * 100;
//     $hundred = null;
//     $digits_length = strlen($no);
//     $i = 0;
//     $str = array();
//     $words = array(0 => '', 1 => 'one', 2 => 'two',
//         3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
//         7 => 'seven', 8 => 'eight', 9 => 'nine',
//         10 => 'ten', 11 => 'eleven', 12 => 'twelve',
//         13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
//         16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
//         19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
//         40 => 'forty', 50 => 'fifty', 60 => 'sixty',
//         70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
//     $digits = array('', 'hundred','thousand','lakh', 'crore');
//     while( $i < $digits_length ) {
//         $divider = ($i == 2) ? 10 : 100;
//         $number = floor($no % $divider);
//         $no = floor($no / $divider);
//         $i += $divider == 10 ? 1 : 2;
//         if ($number) {
//             $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
//             $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
//             $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
//         } else $str[] = null;
//     }
//     $Rupees = strtoupper(implode('', array_reverse($str)));
//     $paise = strtoupper(($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '');
//     return ($Rupees ? $Rupees . 'RUPEES ' : '') . $paise;
// }
?>