<!DOCTYPE html>
<html>
<head>
	<title>NABEEL</title>
</head>
<body>
<legend>NABEEL P S  </legend>
<?php

			date_default_timezone_set('Asia/Kolkata');
			   $time=date("h:i:sa");
			   $date2 = date("Y-m-d");
			   $date1= date("Y-m-01");
			   $month=date("m");
			   $year=date("Y");
			   // echo $month;
			   echo $year;
function countDays($year, $month, $ignore) {
    $count = 0;
    $counter = mktime(0, 0, 0, $month, 1, $year);
    while (date("n", $counter) == $month) {
        if (in_array(date("w", $counter), $ignore) == false) {
            $count++;
        }
        $counter = strtotime("+1 day", $counter);
    }
    return $count;
}
echo countDays($year, $month, array(0, 7)); // 23
// 4
?>
</body>
</html>
<!-- ALTER TABLE `articles` ADD `cess` DECIMAL(11,2) NOT NULL AFTER `fsold`;

ALTER TABLE `staffs` ADD `staff_ta` DECIMAL(11,2) NOT NULL AFTER `credit_amount`, ADD `staff_allowance` DECIMAL(11,2) NOT NULL AFTER `staff_ta`, ADD `staff_incentive` DECIMAL(11,2) NOT NULL AFTER `staff_allowance`, ADD `advance_limit` DECIMAL(11,2) NOT NULL AFTER `staff_incentive`, ADD `area` VARCHAR(250) NOT NULL AFTER `advance_limit`, ADD `category` INT NOT NULL AFTER `area`, ADD `first_name` VARCHAR(250) NOT NULL AFTER `category`;

CREATE TABLE `stock`.`attendance` ( `id` INT NOT NULL AUTO_INCREMENT , `staff_id` INT NOT NULL , `attend` INT NOT NULL , `attend_date` DATE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
update articles set cess=1;
UPDATE staffs set first_name=staff_name;
ALTER TABLE `voucher` CHANGE `voucher_amount` `voucher_amount` DECIMAL(11,2) NOT NULL; -->

