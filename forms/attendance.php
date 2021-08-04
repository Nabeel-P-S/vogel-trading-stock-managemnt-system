     <?php 
     include("../main/navbar.php"); ?>
     <div id="printableArea"  class="col-md-12" >
      <h3 style="text-align: center;"><b>STAFF ATTENDANCE</b></h3>
      <table border="1" class="table-condensed table table-hover " >

        <tbody id="table">
          <tr ><td></td>
            <?php 
            $wsql="select * from staffs";
            $query=mysqli_query($conn,$wsql);
            $i=0;
            while($fetch=mysqli_fetch_array($query))
            {
              $i++;
              ?> <td style="*transform: rotate(90deg);"><?php echo $fetch["staff_name"] ?></td><?php
              $sum[$i]=0;
            }
            ?>
            <td class="info" style="color: black;">present</td>
          </tr>

          <?php
          $sql="SELECT COUNT(DISTINCT attend_date) as total_days FROM attendance";
          $query=mysqli_query($conn,$sql);
          $fetch=mysqli_fetch_array($query);
          $total_days=$fetch['total_days'];
          $sql="SELECT count(staff_id) as total_staff FROM `staffs`";
          $query=mysqli_query($conn,$sql);
          $fetch=mysqli_fetch_array($query);
          $total_staff=$fetch['total_staff'];
          $sql88="SELECT DISTINCT attend_date FROM `attendance` ORDER BY attend_date desc ";
          $query=mysqli_query($conn,$sql88);
          
          while($fetch=mysqli_fetch_array($query))
          {
$daily_sum=0;
            $attend_date=$fetch["attend_date"];
          
            ?>
            <tr><td> <?php echo date('d/M', strtotime($attend_date));?></td>
              <?php
              for($j=1;$j<=$total_staff;$j++)
              {
               $sqld="SELECT attend  FROM attendance where attend_date='$attend_date' AND staff_id='$j'";
               $queryd=mysqli_query($conn,$sqld);
               $fetchd=mysqli_fetch_array($queryd);
               ?>
               
                <?php if ($fetchd["attend"]==0)
                {
                  ?><td class="danger">A</td><?php
                } 
                else
                  {
                   ?><td >P</td><?php
                    $daily_sum=$daily_sum+1;
                    $sum[$j]++;

                   }
             
             } ?>
             <td><?php echo $daily_sum;?></td>
           </tr>

         <?php }

         ?>
<tr class="info" >    

      <th >TOTAL  </th>
      <?php
    for ($i=1;$i<=$total_staff;$i++)
        {
          ?>
          <th>
          <?php
            echo $sum[$i];
                 
                
           
          ?>
     </th>
      <?php
  }
  
    ?></tr>
       </tbody>
     </table>

   </div>