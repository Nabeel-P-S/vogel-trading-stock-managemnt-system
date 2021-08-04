    
    <?php
include ("../connect.php");
$date=$_POST["date"];
       ?>
       
            <table class="table-striped condensed table" >
    <tr >
    <th>NO</th>
    <th>STAFF</th>
    <th>ATTENDANCE</th>
     <th>NO</th>
    <th>STAFF</th>
    <th>ATTENDANCE</th>
  </tr>  <tr >
  <?php
             $sql="SELECT attendance.staff_id,staffs.staff_name,attendance.attend FROM `attendance` LEFT JOIN staffs on staffs.staff_id=attendance.staff_id WHERE attend_date='$date' ORDER BY staff_id asc";
               $query2=mysqli_query($conn,$sql);
                 $sleno=1;
                 $k=0;
                while ($fetch2=mysqli_fetch_array($query2))
                 {
                 $staff_id=$fetch2['staff_id'];
                 $staff_name=$fetch2['staff_name'];
                 $attend=$fetch2['attend'];
                

    ?>
  
       <input type="hidden" name="staff_id1" id="staff_id" value="<?php echo $staff_id;?>">
        
      <td><?php echo $staff_id;?></td>
      <td><?php echo $staff_name;?></td>
   <td>
                <div class="form-check">
              <input type="checkbox" class="form-control" <?php if ($attend==1){echo "checked";}?> name="attendance_checkbox1" value="<?php echo $staff_id;?>"></div>
              </td>
<!-- 
      <td>
                <select name="status1"> 
                  <option value="1" <?php if ($attend==1){echo "selected";} ?>>PRESENT </option>
                  <option value="0"  <?php if ($attend==0){echo "selected";} ?>><p style="color: red;"> ABSENT</p> </option>
                </select>
             </td> -->

    
    <?php
    $k++;
    if ($k%2==0) {
      ?>
    </tr><tr><?php
    }
  }
  ?>
  <tr>
              <td colspan="4" class="text-center">
                <input type="submit" onclick="update_attendance();" name="submit" class="btn btn-success px-5" value="UPDATE ATTENDANCE">
              </td>
            </tr>
  </table>

  