<?php
include '../connect.php';
include("../main/navbar.php");
  $sql="SELECT articles.article_no,articles.sales_price,staffs.staff_name,branches.branch_name, sales.sales_date,sales.invoice_no,sales_articles.article_qty FROM `sales_articles` LEFT join sales on sales.sales_id=sales_articles.sales_id left join articles on articles.article_id=sales_articles.article_id LEFT JOIN staffs on staffs.staff_id=sales.staff_id 
  LEFT JOIN branches on branches.branch_id=sales.branch_id
  ORDER BY sales_date desc";
$from_date='2020-06-10';
$to_date=$date;
  if (!empty($_GET["from_date"])) 
    {
         $from_date = $_GET['from_date'];
         $to_date = $_GET['to_date'];
     
        

          $sql="SELECT articles.article_no,articles.sales_price,staffs.staff_name, sales.sales_date,sales.invoice_no,sales_articles.article_qty FROM `sales_articles` LEFT join sales on sales.sales_id=sales_articles.sales_id left join articles on articles.article_id=sales_articles.article_id LEFT JOIN staffs on staffs.staff_id=sales.staff_id WHERE sales_date BETWEEN '$from_date' AND '$to_date'";
    } 
 ?> 

<!DOCTYPE html>
<html>
<head>
  <title>sales list</title>
</head>
<body>

 <div class="container" style="height: 42vw;">
    
     <!-- ---------------------- TABLE HEAD------------------------------ -->
    <div class="col-md-12">
    <div class="container">
    <div class="col-lg-4" ><input class="form-control" placeholder="Search" id="myInput" type="text" style="width: 10vw; *background-color: white; margin-top: 1vw; color: black;">   </div>
    <div class="col-lg-6" > </div>
    <div class="col-lg-8" >
 
<input  type="date" name="from_date" value="<?php echo $from_date;?>" id="from_date">
<input  type="date" name="to_date" value="<?php echo $to_date;?>" id="to_date">
<button class="btn btn-md" onclick="date_filter();">OK </button>
      <button class="btn btn-danger"  onclick="print_page()">PRINT </button>
    </div> 
    </div>
    </div>
    <!-- ---------------------- TABLE HEAD------------------------------ -->

    <div id="printableArea"  class="col-md-9" >
      <h3 style="text-align: center;"><b>FULL SALES</b></h3>
    <table border="1" class="table" >
        <thead >
                   <tr>
                  
                      <th> INVOICE</th>
                      <th>DATE</th>
                      <th> EXECUTIVE</th>
                      <th> BRANCH</th>
                      <th> ARTICLE</th>
                      <th> QTY</th>
                      <th> SALES</th>
                  
                    
                    </tr>

        </thead>
<tbody id="table">
<?php
      
      $query=mysqli_query($conn,$sql);
      while($fetch=mysqli_fetch_array($query))
      {
       $article_no=$fetch["article_no"];
       $staff_name=$fetch["staff_name"];
       $branch_name=$fetch["branch_name"];
       $sales_date=$fetch["sales_date"];
             $sales_date = date("d-m-Y", strtotime($sales_date));
       $invoice_no=$fetch["invoice_no"];
       $article_qty=$fetch["article_qty"];
       $sales_price=$fetch["sales_price"];
      

   
  
   
?>
   <tr class="table_row">
     <td style="cursor: pointer;" > <?php echo $invoice_no;?> </td>
     <td style="cursor: pointer;"> <?php echo $sales_date;?> </td>
     <td style="cursor: pointer;"> <?php echo $staff_name;?> </td>
     <td style="cursor: pointer;"> <?php echo $branch_name;?> </td>
     <td style="cursor: pointer;"> <?php echo $article_no;?> </td>
     <td style="cursor: pointer;"> <?php echo $article_qty;?> </td>
     <td style="cursor: pointer;"> <?php echo $article_qty*$sales_price;?> </td>
    
 
   </tr>
    <?php

}
?>
</tbody>
</table>
</div>
<div   class="col-md-3" >
      <h3 style="text-align: center;"><b>Daily Total SALES</b></h3>
    <table border="1" class="table" >
        <thead >
                   <tr>
                  
                     
                      <th>DATE</th>
                     
                      <th> QTY</th>
                      <th>SALES</th>
                  
                    
                    </tr>

        </thead>
<tbody id="table">
<?php
      $sql_total="SELECT sales.sales_date,SUM(sales_articles.article_qty) as qty,SUM(sales.sales) as sales FROM `sales` LEFT JOIN sales_articles ON sales_articles.sales_id=sales.sales_id   GROUP  BY sales.sales_date order by sales_date desc";
      $query=mysqli_query($conn,$sql_total);
      while($fetch=mysqli_fetch_array($query))
      {
      
       $sales_date=$fetch["sales_date"];
       $qty=$fetch["qty"];
       $sales=$fetch["sales"];
             $sales_date = date("d-m-Y", strtotime($sales_date));
  

   
  
   
?>
   <tr class="table_row">

     <td style="cursor: pointer;"> <?php echo $sales_date;?> </td>
     <td style="cursor: pointer;"> <?php echo $qty;?> </td>
     <td style="cursor: pointer;"> <?php echo $sales;?> </td>
  
    
 
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
<script type="text/javascript">
  function date_filter()
  {
    var from_date=document.getElementById("from_date").value;
    var to_date=document.getElementById("to_date").value;
window.location="full_sales.php?from_date=" + from_date + "&to_date=" + to_date;
}
</script>
</body>
</html>