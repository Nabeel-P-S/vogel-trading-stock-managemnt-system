<?php
include '../connect.php';
include("../main/navbar.php");
mysqli_query($conn,"ALTER TABLE `articles` ADD `cess` DECIMAL(11,2) NOT NULL DEFAULT '1' AFTER `fsold`;");
  mysqli_query($conn,"ALTER TABLE `staffs` ADD `staff_ta` DECIMAL(11,2) NOT NULL AFTER `credit_amount`, ADD `staff_allowance` DECIMAL(11,2) NOT NULL AFTER `staff_ta`, ADD `staff_incentive` DECIMAL(11,2) NOT NULL AFTER `staff_allowance`, ADD `advance_limit` DECIMAL(11,2) NOT NULL AFTER `staff_incentive`, ADD `area` VARCHAR(250) NOT NULL AFTER `advance_limit`, ADD `category` INT NOT NULL AFTER `area`, ADD `first_name` VARCHAR(250) NOT NULL AFTER `category`;");
  mysqli_query($conn,"CREATE TABLE `stock2`.`attendance` ( `id` INT NOT NULL AUTO_INCREMENT , `staff_id` INT NOT NULL , `attend` INT NOT NULL , `attend_date` DATE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");

     mysqli_query($conn,"ALTER TABLE `voucher` CHANGE `voucher_amount` `voucher_amount` DECIMAL(11,2) NOT NULL;");


 ?> 

<!DOCTYPE html>
<html>
<head>
  <title>branch list</title>
</head>
<body>

 <div class="container" style="height: 42vw;">
    
     <!-- ---------------------- TABLE HEAD------------------------------ -->
    <div class="col-md-12">
    <div class="container">
    <div class="col-lg-4" ><input class="form-control" placeholder="Search" id="myInput" type="text" style="width: 10vw; *background-color: white; margin-top: 1vw; color: black;">   </div>
    <div class="col-lg-6" > </div>
    <div class="col-lg-8" style="text-align:  right;"><button class="btn btn-danger"  onclick="print_page()">PRINT BRANCHES</button>
    </div> 
    </div>
    </div>
    <!-- ---------------------- TABLE HEAD------------------------------ -->

    <div id="printableArea"  class="col-md-12" >
      <h3 style="text-align: center;"><b>BRANCHES</b></h3>
    <table border="1" class="table" >
        <thead >
                   <tr>
                      <th> SL NO:</th>
                      <th>BRANCH NAME:</th>
                    <!--   <th> SALES:</th>
                      <th> PROFIT:</th>
                   -->
                    
                    </tr>

        </thead>
<tbody id="table">
<?php
        $sql="SELECT branch_id,branch_name FROM branches";
      $query=mysqli_query($conn,$sql);
      while($fetch=mysqli_fetch_array($query))
      {
       $branch_id=$fetch["branch_id"];
       $branch_name=$fetch["branch_name"];
       // $sales=$fetch["sales"];
       // $profit=$fetch["profit"];
      
// ,
//        Sum(sales.sales) as sales,
//        Sum(sales.profit) as profit

//        LEFT JOIN staffs
//               ON staffs.staff_id = sales.staff_id
//        LEFT JOIN sales
//               ON sales.staff_id = staffs.branch_id
//        LEFT JOIN sales_articles
//               ON sales_articles.sales_id = sales.sales_id
// GROUP  BY branches.branch_id"
   
  
   
?>
   <tr class="table_row">
     <td style="cursor: pointer;" > <?php echo $branch_id;?> </td>
     <td style="cursor: pointer;"> <?php echo $branch_name;?> </td>
<!--      <td style="cursor: pointer;"> <?php echo $sales;?> </td>
     <td style="cursor: pointer;"> <?php echo $profit;?> </td>
     -->
 
   </tr>
    <?php

}
?>
</tbody>
</table>
</div>
</div>

<script type="text/javascript">
  function edit_category(color_id)
   {
    // alert(vendor_id);
    $.ajax({
      type:"POST",
      url:"edit/color_edit.php",
      data:{
        color_id:color_id
      },
      success:function(data)
      {
        // alert(data);
        $("#total_div").html(data);
      }

    })
  }
</script>
<script type="text/javascript">
  function delete_branch(branch_id)
   {


swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this data!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Poof!  branch deleted!", {

      icon: "success",
    });
     $.ajax({
      type:"POST",
      url:"../delete/delete_branch.php",
      data:{
        branch_id:branch_id
      },
      success:function(data)
      {


        location.href = "../view/view_branch.php";
        
      }

    });
  } 
  else {
    swal("Your detail is safe!");
  }
});

   
  }
</script>
</body>
</html>