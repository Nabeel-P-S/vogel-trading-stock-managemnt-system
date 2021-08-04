  <?php 
  include("../main/navbar.php");
          $query=mysqli_query($conn,"select tr_id from trs order by tr_id desc LIMIT 1
           ");
          $fetch=mysqli_fetch_array($query);
           $tr_id=$fetch['tr_id']+1;?>
<style type="text/css">
  .nabeel
  {
    border: hidden;
    color: blue;
    background-color: transparent;
  }
</style>
<div class="col-md-3">



      <!-- Form Name -->
<legend>ADVANCE PAYMENT   <p style="float: right;">No : <?php echo $tr_id ?> </p> </legend>    
    
      <!-- Text input-->

            <div class="form-group" >
             <div class="input-group">
                <span class="input-group-addon">TA DATE</span>
                <input id="tr_date" type="date" class="form-control" placeholder="<?php echo $date?>"   name="tr_date" value="<?php echo $date?>" >
              </div></div>
               <div class="form-group" >
             <div class="input-group">
                <span class="input-group-addon">TA TIME</span>
                <input id="tr_time" type="text" class="form-control" readonly="1"  name="tr_time" value="<?php echo $time?>" >
              </div></div>

            <div class="form-group" style="*display: none;">
             <div class="input-group">
                <span class="input-group-addon">TA NO</span>
                <input id="tr_id" type="text" class="form-control" name="tr_id" readonly="1" value="<?php echo $tr_id?>" >
              </div></div>
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon">STAFF </span>
                 <input list="staffs" id="staff_id" style="font-size: 1vw;" name="staff_id"  onchange="display_allowable();"  placeholder="SELECT staff" class="form-control">
      <datalist id="staffs">
         <option  value="" >select /option>
                        <?php  
                        $query=mysqli_query($conn,"SELECT * from staffs");
                        while($fetch=mysqli_fetch_array($query))
                        {
                          ?>
                          <option value="<?php echo $fetch ['staff_id']; ?>"><?php echo $fetch ['staff_name'];?> </option>
                              <?php
                        }
                        ?> 
      </datalist> 
              </div></div>
            
             <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">REASON</span>
                 <td><select id="details" class="form-control"  name="details" >
                
                <option value="TA">TA ADVANCE</option>
                <option value="ADVANCE">SALRY ADVANCE</option>
                <option value="OTHER">OTHER</option>
               </select></td>
               
              </div></div>
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">AMOUNT</span>
                <input id="amount" type="text" class="form-control" name="amount" placeholder="AMOUNT">
              </div></div>


            <!-- Button -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="save"></label>
              <div class="col-md-4">
                <br>
                <button id="save" name="save" onclick="save_tr()" class="btn btn-warning">SAVE tr</button>
              </div>
            </div>

 


   
      </div>
   


 
     
    <div id="printableArea"  class="col-md-9" >
      <div class="col-md-6  ">
  <p>Total Working Days : <input type="text" id="total_days" class="nabeel"></p>
<p>Working Days Passed: <input type="text" id="working_days" class="nabeel"></p>
<p>Basic Salary : <input type="text" id="salary" class="nabeel"></p>
<p>Monthly Staff TA  : <input type="text" id="staff_ta" class="nabeel"></p>
<p>Advance limit  : <input type="text" id="advance_limit" class="nabeel"></p>
<p>Present Days  : <input type="text" id="present_days" class="nabeel"></p>
<p>TA Recieved  : <input type="text" id="ta_recieved" class="nabeel"></p>
<p>Advance Recieved  : <input type="text" id="advance_recieved" class="nabeel"></p>
<p>category   : <input type="text" id="category" class="nabeel"></p>
<p>Allowable TA Advance   : <input type="text" id="ta2" class="nabeel"></p>
<p>Allowable Salary Advance   : <input type="text" id="salary2" class="nabeel"></p>


  
</div>
      <div class="col-md-6">
      <h3 style="text-align: center;"><b>TA LIST </b></h3>
      <table border="1" class="table-condensed" >
        <thead >



          

          <tr class="table_head">
<th>NO</th>
<th>DATE</th>
<th>TIME</th>
<th>STAFF</th>
<th>AMOUNT</th>
<th>REASON</th>



</tr>

</thead>
<tbody id="table">
  <?php
  $query=mysqli_query($conn,"SELECT trs.tr_id,trs.tr_time,trs.details, trs.tr_date,trs.amount,staffs.staff_name FROM `trs` LEFT JOIN staffs on staffs.staff_id=trs.staff_id");
  while($fetch=mysqli_fetch_array($query))
  {
   $tr_id=$fetch["tr_id"];
   $tr_date=$fetch["tr_date"];
   $tr_time=$fetch["tr_time"];
    $tr_date= date("d-m-Y", strtotime($tr_date));   
   $amount=$fetch["amount"];
   $staff_name=$fetch["staff_name"];
   $details=$fetch["details"];

   
  
   
   ?>
   <tr class="table_row">
<!--      <td onclick="delete_supplier('<?php echo $supplier_id;?>')" style="cursor: pointer;" > <?php echo $supplier_id;?> </td>
 -->     <td style="cursor: pointer;"> <?php echo $tr_id;?> </td>
     <td style="cursor: pointer;"> <?php echo $tr_date;?> </td>
     <td style="cursor: pointer;"> <?php echo $tr_time;?> </td>
     <td style="cursor: pointer;"> <?php echo $staff_name;?> </td>
        <td style="cursor: pointer;"> <?php echo $amount;?> </td>
        <td style="cursor: pointer;"> <?php echo $details;?> </td>
<!--  <td><button class="btn-md btn-warning"> <a href="../edit/supplier_edit.php?supplier_id=<?php echo $supplier_id;?>"> EDIT</a></button></td>
 -->     
   </tr>
    <?php

}
?>
</tbody>
</table>

      <h3 style="text-align: center;"><b>DAILY TA </b></h3>
      <table border="1" class="table-condensed" >
        <thead >



          

          <tr class="table_head">

<th>DATE</th>

<th>AMOUNT</th>



</tr>

</thead>
<tbody id="table">
  <?php
 $query=mysqli_query($conn,"SELECT trs.tr_date,SUM(trs.amount) as amount FROM `trs`  GROUP  BY trs.tr_date");
  while($fetch=mysqli_fetch_array($query))
  {
   $tr_date=$fetch["tr_date"];
      $tr_date= date("d-m-Y", strtotime($tr_date));

   
   $amount=$fetch["amount"];

    
   
   ?>
   <tr class="table_row">
     <td style="cursor: pointer;"> <?php echo $tr_date;?> </td>
      <td style="cursor: pointer;"> <?php echo $amount;?> </td>
        </tr>
    <?php

}
?>
</tbody>
</table>

      <h3 style="text-align: center;"><b>STAFF TA </b></h3>
      <table border="1" class="table-condensed" >
        <thead >



          

          <tr class="table_head">

<th>STAFF</th>

<th>AMOUNT</th>



</tr>

</thead>
<tbody id="table">
  <?php
 $query=mysqli_query($conn,"SELECT staffs.staff_name,SUM(trs.amount) as amount FROM `trs` LEFT join staffs on staffs.staff_id=trs.staff_id  GROUP  BY trs.staff_id");
  while($fetch=mysqli_fetch_array($query))
  {
   $staff_name=$fetch["staff_name"];
      

   
   $amount=$fetch["amount"];

    
   
   ?>
   <tr class="table_row">
     <td style="cursor: pointer;"> <?php echo $staff_name;?> </td>
      <td style="cursor: pointer;"> <?php echo $amount;?> </td>
        </tr>
    <?php

}
?>
</tbody>
</table>
</div>
</div>

      <script type="text/javascript">
          function save_tr()
          {

            var tr_date=document.getElementById("tr_date").value;
            var tr_time=document.getElementById("tr_time").value;
            var tr_id=document.getElementById("tr_id").value;
            var staff_id=document.getElementById("staff_id").value;
            var amount=document.getElementById("amount").value;
            var details=document.getElementById("details").value;
     
         
            
            if(staff_id==""||amount=="")
            {       
               // swal("ERROR","Enter Vogel No ","error");
               alert("ENTER FULL DATA");

             }
          
else{
            $.ajax( 
            {

              type:"POST",
              url:"../insert/tr_insert.php",
              // dataType:"json",
              data:{
                tr_date:tr_date,
                details:details,
                tr_time:tr_time,
                tr_id:tr_id,
                staff_id:staff_id,
                amount:amount,
              },

              success: function(data)

              {
                   swal("TA ADDED");
                    // alert(data);
                window.location="tr.php";

                     }    
                   });



          }

          }

     
        </script>


 <script>
          function display_allowable()
          {
        

          var tr_date=document.getElementById("tr_date").value;
          var staff_id=document.getElementById("staff_id").value;
          var details=document.getElementById("details").value;
       //    if (details=="ALLOWANCE")
       //    {
       //      alert("allowable T A advance=")
       //    }
       // else
       //  if (details=="ADVANCE")
       //    {
       //      alert("allowable SALARY advance=")
       //    }
          $.ajax(
          {
            type:"POST",
            url:"../details/advance.php",
             dataType:"json",
            data:{
             
              staff_id:staff_id
            },

            success: function(data)

            {
              var staff_ta=data.staff_ta;
              var advance_limit=data.advance_limit;
              var present_days=data.present_days;
              var ta_recieved=data.ta_recieved;
              var advance_recieved=data.advance_recieved;
              var working_days=data.working_days;
              var total_days=data.total_days;
              var category=data.category;
              var salary=data.salary;

              if (category==1){
    category="STAFF";
  }else
  {
    category="AGENT";
  }
      
          document.getElementById("working_days").value=working_days; 
          document.getElementById("staff_ta").value=staff_ta; 
          document.getElementById("advance_limit").value=advance_limit; 
          document.getElementById("present_days").value=present_days; 
          document.getElementById("ta_recieved").value=ta_recieved; 
          document.getElementById("advance_recieved").value=advance_recieved; 
          document.getElementById("category").value=category; 
          document.getElementById("salary").value=salary; 
          document.getElementById("total_days").value=total_days; 
          var taPer=staff_ta/total_days;
          var ta2=(taPer*present_days)-ta_recieved;
          ta2=ta2.toFixed(2);
          var salary2=(salary/total_days)*present_days;
        salary2=salary2-advance_recieved;
        salary2=salary2*(advance_limit/100);
        salary2=salary2.toFixed(2);
 document.getElementById("ta2").value=ta2; 
          document.getElementById("salary2").value=salary2; 
              
}    
});

        }
      </script>