  <?php 
  include("../main/navbar.php"); ?>
  <style type="text/css">


  </style>
<div>
  <?php 
  $sql="SELECT * FROM staffs";
  $query=mysqli_query($conn,$sql);
    
  ?>
   <div class="col-lg-6">
    <table >
    <tr>
      <td>  <h3 > <input type="date"  id="date" value="<?php echo $date;?>"></h3>
</td>
      <td>  <span >NOTE : Untick the Checkbox if they are Absent</span>
</td>
    </tr>
  </table>
  <table class="table-striped condensed table" >
    <tr >
    <th>NO</th>
    <th>STAFF</th>
    <th>Action</th>
       <th>NO</th>
    <th>STAFF</th>
    <th>Action</th>
  </tr> <tr >
  <?php
  $k=0;

  while ( $fetch=mysqli_fetch_array($query)) {

  $staff_name=$fetch["staff_name"]; 
  $staff_id=$fetch["staff_id"];
    ?>
   
       <input type="hidden" name="staff_id" id="staff_id" value="<?php echo $staff_id;?>">
        
      <td><?php echo $staff_id;?></td>
      <td><?php echo $staff_name;?></td>
      <td>
                <div class="form-check">
              <input type="checkbox" class="form-control" checked="1"  name="attendance_checkbox" value="<?php echo $staff_id;?>"></div>
              </td>

    
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
                <input type="submit" onclick="save_attendance();" name="submit" class="btn btn-primary px-5" value="Save Attendance">
              </td>
            </tr>
  </table>
  
  
</div>
<div class="col-lg-6">
     <table >
    <tr>
      <td>  <h3 > <input type="date" onchange="view_attendance(this.value);"  id="date1" value="<?php echo $date;?>"></h3>
</td>
      <td>  <span >NOTE : Select Date to VIEW and EDIT Attendance</span>
</td>
    </tr>
  </table>
<div id="attend_view">
  
</div>
</div>

<script type="text/javascript">
  function view_attendance(date)
  {

          $.ajax(
          {
            type:"POST",
            url:"../details/attendance.php",
             // dataType:"json",
            data:{
             
              date:date
            },

            success: function(data_output)

            {
            // $("#display_div").html(data_output);
                $("#attend_view").html(data_output);

        

              
}    
});
  }
</script>
<script type="text/javascript">
  function save_attendance()
  {
    var x=document.getElementsByName("attendance_checkbox");

     var m=0;
     var n=0;
         var present_array=[];
         var absent_array=[];
     for (var i = 0; i <x.length; i++) 
    {
      if (x[i].checked==true)
      {
        present_array[m]=x[i].value;
       
   
        m++;
      }
      else
      {
        absent_array[n]=x[i].value;
      
         n++;
          // alert(absent_array[m]);
      }
    }

    var date=document.getElementById("date").value;

 var present_array_json=JSON.stringify(present_array);
 var absent_array_json=JSON.stringify(absent_array);



 $.ajax(
 {
  type:"POST",
  url:"../details/date_check.php",
  dataType:"json",
  data:{

    date:date,


  },

  success: function(data)

  {
              // alert(data);
              var staff_id=data.staff_id;
              
              if (staff_id==null) 
                  {


                      $.ajax( 
                      {

                        type:"POST",
                        url:"../insert/attendance_insert.php",
                    // dataType:"json",
                    data:{
                      present_array_json:present_array_json,

                      absent_array_json:absent_array_json, 

                      date:date


                    },

                    success: function(data)

                    {

                      // swal("success");
                        swal("ATTENDANCE TAKEN"+" "+date);
                 
                      window.location="../forms/ATTE.php";
             
                  }    
              });
              }
              else

              {
                swal("! Already Entered..SELECT Another DATE");
              }
              
            


              
          }

})}
      </script>
<script type="text/javascript">
  function update_attendance()
  {
var x=document.getElementsByName("attendance_checkbox1");

     var m=0;
     var n=0;
         var present_array=[];
         var absent_array=[];
     for (var i = 0; i <x.length; i++) 
    {
      if (x[i].checked==true)
      {
        present_array[m]=x[i].value;
       
   
        m++;
      }
      else
      {
        absent_array[n]=x[i].value;
      
         n++;
          // alert(absent_array[m]);
      }
    }

    var date=document.getElementById("date1").value;


var present_array_json=JSON.stringify(present_array);
 var absent_array_json=JSON.stringify(absent_array);


              // alert(data);
          


                      $.ajax( 
                      {

                        type:"POST",
                        url:"../update/attendance_update.php",
                    // dataType:"json",
                    data:{
                      present_array_json:present_array_json,

                      absent_array_json:absent_array_json, 

                      date:date


                    },

                    success: function(data)

                    {
// alert(data);
                      swal("success");
                      window.location="../forms/ATTE.php";
// 
                  }    
              });
             
              
            


              
          }


      </script>