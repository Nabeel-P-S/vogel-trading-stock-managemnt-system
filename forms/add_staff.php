  <?php 
  include("../main/navbar.php");
  


    $query_article=mysqli_query($conn,"select staff_id from staffs order by staff_id desc LIMIT 1
     ");
    $fetch_article=mysqli_fetch_array($query_article);
     $staff_id=$fetch_article['staff_id'];?>
<form class="col-md-8 ">
<fieldset>

<!-- Form Name -->
<legend>ADD STAFF    <p style="float: right;">No : <?php echo $staff_id+1 ?> </p> </legend>    


<!-- Text input-->


  <div class="w3-half">
    <label>STAFF NAME</label>
    <input class="w3-input w3-border" id="staff_name" name="staff_name" type="text" placeholder="STAFF NAME">
  </div>

  <div class="w3-half">
 <label>AREA</label>
    <input id="staff_area" type="text" class="w3-input w3-border" name="staff_area" placeholder="STAFF AREA"  >
   </div>
 <div class="w3-half">
    <label>BRANCH NAME</label>
    <input list="branches" id="branch_id" name="branch_id" placeholder="Start your search" class="w3-input w3-border">
<datalist id="branches">
   <option  value="" >select BRANCH</option>
                  <?php  
                  $query=mysqli_query($conn,"SELECT * from branches");
                  while($fetch=mysqli_fetch_array($query))
                  {
                    ?>
                    <option value="<?php echo $fetch ['branch_id']; ?>"><?php echo $fetch ['branch_name'];?> </option>
                        <?php
                  }
                  ?> 
</datalist>  </div>


  <div class="w3-half">
 <label>BASIC SALARY</label>
    <input id="salary" type="text" class="w3-input w3-border" name="salary" placeholder="SALARY"  >
  </div> <div class="w3-half">
    <label>STAFF T A</label>
    <input id="ta" type="text" class="w3-input w3-border" name="ta" placeholder="STAFF T A"  >
  </div>

  <div class="w3-half">
 <label>OTHER ALLOWANCE</label>
    <input id="allowance" type="text" class="w3-input w3-border" name="allowance" placeholder="ALLOWANCE"  >
    </div> <div class="w3-half">
    <label>INCENTIVE</label>
    <input id="incentive" type="text" class="w3-input w3-border" name="incentive" placeholder="INCENTIVE"  >
  </div>

  <div class="w3-half">
    <label>ADVANCE LIMIT</label>
    <input id="advance_limit" type="text" class="w3-input w3-border" name="advance_limit" placeholder="ADVANCE LIMIT"  >
 </div> <div class="w3-half">
    <label>AMOUNT LIMIT</label>
    <input id="amount_limit" type="text" class="w3-input w3-border" name="amount_limit" placeholder="AMOUNT LIMIT"  >
  </div>
  <div class="w3-half">
   <label>CREDIT AMOUNT </label>
    <input id="credit_amount" type="text" class="w3-input w3-border" name="credit_amount" placeholder="CREDIT AMOUNT"  >
  </div>
 <div class="w3-half">
   <label>FIRST NAME </label>
    <input id="first_name" type="text" class="w3-input w3-border" name="first_name" placeholder="FIRST NAME"  >
  </div>
   <div class="w3-half">
   <label>SELECT TYPE  </label>
     <select class="form-control" id="category"> 
                  <option value="1" selected>STAFF</option>
                  <option value="0" >AGENT </option>
                </select>
  </div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="save"></label>
  <div class="col-md-4">
    <br>
    <button id="save_article" name="save_article" onclick="save_staff()" class="btn btn-success">SAVE EXECUTIVE</button>
  </div>
</div>

</fieldset>
</form>
<div class="col-md-4">
  <table border="1" class="table">
    <tr>
      <td>No</td>
      <!-- <td>Article Name</td> -->
      <td>Article No</td>
      <td>Stock Limit</td>
    </tr>
 
  <?php 
  $sql="SELECT article_id,article_name,article_no from articles";
  $query=mysqli_query($conn,$sql);

while($fetch=mysqli_fetch_array($query))
      {
        $article_id=$fetch['article_id'];
        $article_name=$fetch['article_name'];
        $article_no=$fetch['article_no'];
     
        ?>
<tr>
  <td> <input style="border: none;width: 3vw;" readonly="1" type="text" name="article_id" value="<?php echo $article_id;?>"></td>
  <!-- <td><?php echo $article_name;?></td> -->
  <td><?php echo $article_no;?></td>
  <td ><input style="*border: none;width: 8vw;" class="form-control"  type="text" name="article_limit" ></td>
</tr>
       <?php } ?>
     </table></div>

<script type="text/javascript">
  function save_staff() {


 var article_id_element=document.getElementsByName('article_id');
 var article_limit=document.getElementsByName('article_limit');
 var article_id_array=[];
 var article_limit_array=[];
 var n=0;
 for (var i = 0; i <article_id_element.length; i++) 
 {
  var article_id=article_id_element[i].value;
  var article_limit1=article_limit[i].value;
  article_id_array[n]=article_id;

  article_limit_array[n]=article_limit1;
  n++;

} 
            var staff_name=document.getElementById("staff_name").value;
            var category=document.getElementById("category").value;
            var first_name=document.getElementById("first_name").value;
            // alert(type);
            var branch_id=document.getElementById("branch_id").value;
            var salary=document.getElementById("salary").value;
            var ta=document.getElementById("ta").value;
            var staff_area=document.getElementById("staff_area").value;
            var allowance=document.getElementById("allowance").value;
            var incentive=document.getElementById("incentive").value;
            var advance_limit=document.getElementById("advance_limit").value;
            var amount_limit=document.getElementById("amount_limit").value;
            var credit_amount=document.getElementById("credit_amount").value;
            

            var article_array_json=JSON.stringify(article_id_array);
            var article_limit_json=JSON.stringify(article_limit_array); 


            // alert(article_id+article_no+article_name+supplier_id+sales_price+article_price);
                 if(staff_name==""||branch_id=="")
            {       
               // swal("ERROR","Enter Vogel No ","error");
               alert("enter full data");

             }
          
else{ 
  alert("staff Inserted");
             $.ajax( 
            {

              type:"POST",
              url:"../insert/staff_insert.php",
              // dataType:"json",
              data:{
                article_array_json:article_array_json,
                article_limit_json:article_limit_json, 
                staff_name:staff_name,
                branch_id:branch_id,
                category:category,
                first_name:first_name,
                salary:salary,
                ta:ta,
                staff_area:staff_area,
                allowance:allowance,
                incentive:incentive,
                advance_limit:advance_limit,
                amount_limit:amount_limit,
                credit_amount:credit_amount
            
               
              },

              success: function(data)

              {
                // alert(data);
              
                      

                     }    
                   });
           }
           

  }
</script>
