<?php
include ("../connect.php");
date_default_timezone_set('Asia/Kolkata');
			   $time=date("h:i:sa");
			   $date2 = date("Y-m-d");
			   $date1= date("Y-m-01");
			   $month=date("m");
			   $year=date("Y");

 $staff_id=$_POST["staff_id"];

 $sql="SELECT * FROM `staffs` WHERE staff_id='$staff_id'";
  $query=mysqli_query($conn,$sql);
  $fetch=mysqli_fetch_array($query);
   $staff_ta=$fetch['staff_ta'];
   $advance_limit=$fetch['advance_limit'];
   $category=$fetch['category'];
   $salary=$fetch['salary'];
  $sql2="SELECT sum(attend) as present_days FROM `attendance` where staff_id='$staff_id' AND attend_date BETWEEN '$date1' and ' $date2'";
  $query2=mysqli_query($conn,$sql2);
  $fetch2=mysqli_fetch_array($query2);
   $present_days=$fetch2['present_days'];
    $sql3="SELECT sum(amount) as ta_recieved FROM `trs` where staff_id='$staff_id' AND tr_date BETWEEN '$date1' and ' $date2' and details ='TA'";
  $query3=mysqli_query($conn,$sql3);
  $fetch3=mysqli_fetch_array($query3);
   $ta_recieved=$fetch3['ta_recieved'];
    $sql4="SELECT sum(amount) as advance_recieved FROM `trs` where staff_id='$staff_id' AND tr_date BETWEEN '$date1' and ' $date2' and details ='ADVANCE'";
  $query4=mysqli_query($conn,$sql4);
  $fetch4=mysqli_fetch_array($query4);
   $advance_recieved=$fetch4['advance_recieved'];
 

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
$total_days= countDays($year, $month, array(0, 7)); // 23
// 4
			$start = new DateTime($date1);
			$end = new DateTime($date2);
			// otherwise the  end date is excluded (bug?)
			$end->modify('+1 day');

			$interval = $end->diff($start);

			// total days
			$days = $interval->days;

			// create an iterateable period of date (P1D equates to 1 day)
			$period = new DatePeriod($start, new DateInterval('P1D'), $end);

			// best stored as array, so you can add more than one
			$holidays = array('2012-09-07');

			foreach($period as $dt) {
			    $curr = $dt->format('D');

			    // substract if Saturday or Sunday
			    if ($curr == 'Sun') {
			        $days--;
			    }

			    // (optional) for the updated question
			    elseif (in_array($dt->format('Y-m-d'), $holidays)) {
			        $days--;
			    }
			}


			// echo $days; 
			$working_days=$days;


 echo json_encode(array(
 	'staff_ta'=>$staff_ta,'advance_limit'=>$advance_limit,'present_days'=>$present_days,'ta_recieved'=>$ta_recieved,'advance_recieved'=>$advance_recieved,'working_days'=>$working_days
 	,'category'=>$category
 	,'salary'=>$salary
 	,'total_days'=>$total_days
 ));
      ?>

      
