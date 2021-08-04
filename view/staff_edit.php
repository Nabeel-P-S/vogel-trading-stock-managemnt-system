
<?php 

$query=mysqli_query($conn,"SELECT * from staffs where staff_id='$staff_id'");
$fetch=mysqli_fetch_array($query);
$staff_name=$fetch['staff_name'];
$branch_id=$fetch['branch_id'];
$salary=$fetch['salary'];
$amount_limit=$fetch['amount_limit'];
$credit_amount=$fetch['credit_amount'];
$staff_id=$fetch['staff_id'];
$area=$fetch['area'];
$staff_ta=$fetch['staff_ta'];
$category=$fetch['category'];
$first_name=$fetch['first_name'];
$staff_allowance=$fetch['staff_allowance'];
$advance_limit=$fetch['advance_limit'];
$staff_incentive=$fetch['staff_incentive'];


?>

<form class="col-md-8">
<fieldset>

<!-- Form Name -->
<legend>VIEW EXECUTIVE  - <?php echo $staff_name ?>   <p style="float: right;">No : <?php echo $staff_id ?> </p> </legend>    


<!-- Text input-->

<div class="form-group"  >
 <div class="input-group">
    <span class="input-group-addon">STAFF ID</span>
    <input id="staff_id"  class="form-control" readonly="1" name="staff_id" value="<?php echo $staff_id ?>" >
  </div></div>




<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">STAFF NAME</span>
    <input id="staff_name" type="text" class="form-control" name="staff_name" placeholder="STAFF NAME"  value="<?php echo $staff_name;?>">
  </div></div>

<div class="form-group"> <div class="input-group">
    <span class="input-group-addon">BRANCH NAME</span>
    <input list="branches" id="branch_id" name="branch_id" placeholder="Start your search" class="form-control" value="<?php echo $branch_id;?>">
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
</datalist>  </div></div>

<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">SALARY</span>
    <input id="salary" type="text" class="form-control" name="salary" placeholder="SALARY"  value="<?php echo $salary;?>">
  </div></div>


<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">AMOUNT LIMIT</span>
    <input id="amount_limit" type="text" class="form-control" name="amount_limit" placeholder="AMOUNT LIMIT"  value="<?php echo $amount_limit;?>">
  </div></div>

<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">CREDIT AMOUNT</span>
    <input id="credit_amount" type="text" class="form-control" name="credit_amount" placeholder="CREDIT AMOUNT"  value="<?php echo $credit_amount;?>">
  </div></div>

  <div class="w3-half">
 <label>AREA</label>
    <input id="area" type="text" class="w3-input w3-border" name="staff_area" placeholder="STAFF AREA"   value="<?php echo $area;?>">
   </div>
<div class="w3-half">
    <label>STAFF T A</label>
    <input id="staff_ta" type="text" class="w3-input w3-border" name="ta" placeholder="STAFF T A"   value="<?php echo $staff_ta;?>">
  </div>
<div class="w3-half">
 <label>OTHER ALLOWANCE</label>
    <input id="staff_allowance" type="text" class="w3-input w3-border" name="allowance" placeholder="ALLOWANCE"  value="<?php echo $staff_allowance;?>">
    </div>
<div class="w3-half">
    <label>ADVANCE LIMIT</label>
    <input id="advance_limit" type="text" class="w3-input w3-border" name="advance_limit" placeholder="ADVANCE LIMIT"   value="<?php echo $advance_limit;?>">
 </div> 
<div class="w3-half">
    <label>INCENTIVE</label>
    <input id="staff_incentive" type="text" class="w3-input w3-border" name="incentive" placeholder="INCENTIVE" value="<?php echo $staff_incentive;?>">
  </div>

   <div class="w3-half">
   <label>FIRST NAME </label>
    <input id="first_name" type="text" class="w3-input w3-border" name="first_name" placeholder="FIRST NAME" value="<?php echo $first_name;?>"  >
  </div>
   <div class="w3-half">
   <label>SELECT TYPE  </label>
     <select class="form-control" id="category"> 
                  <option value="1" <?php if ($category==1){echo "selected";} ?>>STAFF</option>
                  <option value="0" <?php if ($category==0){echo "selected";} ?> >AGENT </option>
                </select>
  </div>
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="save"></label>
  <div class="col-md-4">
    <br>
    <button id="save_article" name="save_article" onclick="update_staff()" class="btn btn-success">UPDATE EXECUTIVE</button>
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
      <td>STOCK</td>
      <td>Stock Limit</td>
    </tr>
 
  <?php 
  $sql="SELECT staff_articles.staff_id,staff_articles.staff_stock,staff_articles.article_limit,staff_articles.article_id,articles.article_name,articles.article_no FROM `staff_articles` LEFT JOIN articles on articles.article_id=staff_articles.article_id where staff_articles.staff_id='$staff_id'";
  $query=mysqli_query($conn,$sql);

while($fetch=mysqli_fetch_array($query))
      {
        $article_id=$fetch['article_id'];
        $article_name=$fetch['article_name'];
        $article_no=$fetch['article_no'];
        $article_limit=$fetch['article_limit'];
        $staff_stock=$fetch['staff_stock'];
     
        ?>
<tr>
  <td> <input style="border: none;width: 3vw;" readonly="1" type="text" name="article_id" value="<?php echo $article_id;?>"></td>
  <!-- <td><?php echo $article_name;?></td> -->
  <td><?php echo $article_no;?></td>
  <td><?php echo $staff_stock;?></td>
  <td ><input style="*border: none;width: 8vw;" class="form-control" type="text" name="article_limit" value="<?php echo $article_limit;?>"></td>
</tr>
       <?php } ?>
     </table></div>


<script type="text/javascript">
  function update_staff() 
  {

alert("updating");
 var article_id_element=document.getElementsByName('article_id');
 var article_limit_element=document.getElementsByName('article_limit');
 var article_id_array=[];
 var article_limit_array=[];
 var n=0;
 for (var i = 0; i <article_id_element.length; i++) 
 {
  var article_id1=article_id_element[i].value;
  var article_limit1=article_limit_element[i].value;
  article_id_array[n]=article_id1;

  article_limit_array[n]=article_limit1;
  n++;

} 
            var staff_id=document.getElementById("staff_id").value;
            var staff_name=document.getElementById("staff_name").value;
            var branch_id=document.getElementById("branch_id").value;
            var category=document.getElementById("category").value;
            var first_name=document.getElementById("first_name").value;
            var salary=document.getElementById("salary").value;
            var area=document.getElementById("area").value;

            var staff_ta=document.getElementById("staff_ta").value;
            var staff_allowance=document.getElementById("staff_allowance").value;
            var advance_limit=document.getElementById("advance_limit").value;
            var staff_incentive=document.getElementById("staff_incentive").value;
            var amount_limit=document.getElementById("amount_limit").value;
            var credit_amount=document.getElementById("credit_amount").value;
            

            var article_array_json=JSON.stringify(article_id_array);
            var article_limit_json=JSON.stringify(article_limit_array); 


                 if(staff_name=="")
            {       
               // swal("ERROR","Enter Vogel No ","error");
               alert("enter full data");

             }
          
else{ 
             $.ajax( 
            {

              type:"POST",
              url:"../update/staff_update.php",
              // dataType:"json",
              data:{
                article_array_json:article_array_json,
                article_limit_json:article_limit_json, 
                staff_id:staff_id,
                staff_name:staff_name,
                branch_id:branch_id,
                category:category,
                first_name:first_name,
                salary:salary,
                area:area,
                staff_ta:staff_ta,
                staff_allowance:staff_allowance,
                advance_limit:advance_limit,
                staff_incentive:staff_incentive,
                amount_limit:amount_limit,
                credit_amount:credit_amount
            
               
              },

              success: function(data)

              {

              
                // alert("Staff Updated");
              
                       location.href = "../view/view_staff.php"; 
      

                     }    
                   });
           }
           

  
  }
</script>