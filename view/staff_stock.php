<?php
include '../connect.php';
include("../main/navbar.php") ?> 

<!DOCTYPE html>
<html>
<head>
  <title>Staff Stock </title>
</head>
<body>

    
     <!-- ---------------------- TABLE HEAD------------------------------ -->
    <div class="col-md-12">
    <div class="container">
    <div class="col-lg-4" ><input class="form-control" placeholder="Search" id="myInput" type="text" style="width: 10vw; *background-color: white; margin-top: 1vw; color: black;">   </div>
    <div class="col-lg-6" > </div>
    <div class="col-lg-8" style="text-align:  right;"><button class="btn btn-danger"  onclick="print_page()">PRINT STAFF STOCK</button>
    </div> 
    </div>
    </div>
    <!-- ---------------------- TABLE HEAD------------------------------ -->

    <div id="printableArea"  class="col-md-12" >
      <h3 style="text-align: center;"><b>STAFF STOCK</b></h3>
      <table border="1" class="table-condensed table table-hover " >
        
      </thead>
      <tbody id="table">
        <tr class="btn-danger"><td></td>
          <?php 
          $wsql="select * from staffs";
          $query=mysqli_query($conn,$wsql);
          while($fetch=mysqli_fetch_array($query))
          {
            ?> <td><?php echo $fetch["staff_name"] ?></td><?php
          }
          ?>
          <td class="info" style="color: black;">TOTAL</td>
        </tr>

        <?php
        $sql="SELECT count(article_id) as total_article FROM `articles`";
        $query=mysqli_query($conn,$sql);
        $fetch=mysqli_fetch_array($query);
        $total_article=$fetch['total_article'];
        $sql="SELECT count(staff_id) as total_staff FROM `staffs`";
        $query=mysqli_query($conn,$sql);
        $fetch=mysqli_fetch_array($query);
        $total_staff=$fetch['total_staff'];

        for ($i=1;$i<=$total_article;$i++)
        {
          ?><tr><td class="btn-success"><?php
          $sql="SELECT * FROM `articles` WHERE article_id='$i'";
          $query=mysqli_query($conn,$sql);
          $fetch=mysqli_fetch_array($query);
          $article_no=$fetch['article_no'];
          echo $article_no;

          ?></td><?php $article_sum=0;
          for($j=1;$j<=$total_staff;$j++)
          {
           $sql="SELECT staff_stock  FROM staff_articles where article_id='$i' AND staff_id='$j'";
           $query=mysqli_query($conn,$sql);
           $fetch=mysqli_fetch_array($query);
           ?>
           <td><?php
             // $staff_stock= $fetch["staff_stock"];
         // if (!isset($a)) {
              if (isset($fetch["staff_stock"])) { echo $fetch["staff_stock"];}
            // }
            ?></td>
           <?php
           if (isset($fetch["staff_stock"])) {
            $article_sum+=$fetch["staff_stock"];

}


         }
         ?><td class="info"><?php echo $article_sum;?></td></tr><?php
       }
       ?>
       <tr class="info">
         <td>TOTAL</td>

         <?php 
         $staff_sum_total=0;
            for ($i=1;$i<=$total_staff;$i++)
        {
          $sql="SELECT SUM(staff_stock) as staff_sum FROM `staff_articles` WHERE staff_id='$i'";
          $query=mysqli_query($conn,$sql);
          $fetch=mysqli_fetch_array($query);
          $staff_sum=$fetch['staff_sum'];
          $staff_sum_total+= $staff_sum;
          // echo $staff_sum;
          ?>
          <td> <?php echo $staff_sum;?></td>
          <?php
        }
        ?>
        <td><?php echo $staff_sum_total;?></td>
       </tr>
     </tbody>
   </table>
   <!-- <?php echo $staff_sum_total;?> -->
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