<?php
include ("connect.php");

mysqli_query($conn,"ALTER TABLE `articles` ADD `cess` DECIMAL(11,2) NOT NULL DEFAULT '1' AFTER `fsold`;");
	mysqli_query($conn,"ALTER TABLE `staffs` ADD `staff_ta` DECIMAL(11,2) NOT NULL AFTER `credit_amount`, ADD `staff_allowance` DECIMAL(11,2) NOT NULL AFTER `staff_ta`, ADD `staff_incentive` DECIMAL(11,2) NOT NULL AFTER `staff_allowance`, ADD `advance_limit` DECIMAL(11,2) NOT NULL AFTER `staff_incentive`, ADD `area` VARCHAR(250) NOT NULL AFTER `advance_limit`, ADD `category` INT NOT NULL AFTER `area`, ADD `first_name` VARCHAR(250) NOT NULL AFTER `category`;");
	mysqli_query($conn,"CREATE TABLE `stock2`.`attendance` ( `id` INT NOT NULL AUTO_INCREMENT , `staff_id` INT NOT NULL , `attend` INT NOT NULL , `attend_date` DATE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");

		 mysqli_query($conn,"ALTER TABLE `voucher` CHANGE `voucher_amount` `voucher_amount` DECIMAL(11,2) NOT NULL;");




echo "<h1>..!!!...CLOSE THIS TAB <br>DELETE amjath.php FILE IN STOCK2 FOLDER</h1>";
?>