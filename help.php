  <?php
  
  if (!$query) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}


 $sales_date = date("d-m-Y", strtotime($sales_date));
?>



SELECT estimation.sales_id as estimation_no, estimation.sales_date as estimation_date,  estimation.sales as estimation_amount,sales.sales_id as invoice_no, sales.sales_date, sales.sales as invoice_amount FROM `estimation`  LEFT JOIN sales ON sales.sales_date=estimation.sales_date  UNION ALL SELECT estimation.sales_id as estimation_no, estimation.sales_date as estimation_date,  estimation.sales as estimation_amount,sales.sales_id as invoice_no, sales.sales_date, sales.sales as invoice_amount FROM `estimation` RIGHT JOIN sales ON sales.sales_date=estimation.sales_date









select estimation.sales_id as estimation_no, estimation.sales_date as estimation_date,  estimation.sales as estimation_amount,sales.sales_id as invoice_no, sales.sales_date, sales.sales as invoice_amount,voucher.voucher_id,voucher.voucher_date,voucher_amount
from (select sales_date from estimation union 
      select sales_date from sales union
      select voucher_date from voucher 
     ) main left outer join
     estimation
     on main.sales_date = estimation.sales_date left outer join
     sales
     on main.sales_date = sales.sales_date left outer join
     voucher
     on main.sales_date = voucher.voucher_date .




     select estimation.sales_id as estimation_no, estimation.sales_date as estimation_date,  estimation.sales as estimation_amount,sales.sales_id as invoice_no, sales.sales_date, sales.sales as invoice_amount,voucher.voucher_id,voucher.voucher_date,voucher_amount
from (select * from estimation union 
      select * from sales union
      select * from voucher 
     ) main left outer join
     estimation
     on main.sales_date = estimation.sales_date left outer join
     sales
     on main.sales_date = sales.sales_date left outer join
     voucher
     on main.sales_date = voucher.voucher_date




     http://localhost/stock1/forms/add_staff_grv.php?sales_date=07-08-2020&grv_date=2020-08-18&invoice_no=1&sales_id=1&branch_id=THRISSUR&staff_name=ANTONY+N+B&staff_id=1&sales_article_id=4&art_name=M3N301&art_name=MASKEE+3+LAYER+NET+MASK&art_cost=12.50&art_price=17.00&item_qnty1=1&price_total=12.5&art_total=17&profit=4.5&cost_total=12.5&sales_total=17








     TRUNCATE `articles`;
TRUNCATE `customers`;
TRUNCATE `estimation`;
TRUNCATE `estimation_articles`;
TRUNCATE `foc`;
TRUNCATE `foc_articles`;
TRUNCATE `grv`;
TRUNCATE `grv_articles`;
TRUNCATE `sales`;
TRUNCATE `sales_articles`;
TRUNCATE `staffs`;
TRUNCATE `staff_articles`;
TRUNCATE `staff_grv`;
TRUNCATE `staff_grv_articles`;
TRUNCATE `stocks`;
TRUNCATE `trs`;
TRUNCATE `voucher`;
TRUNCATE `voucher_details`;