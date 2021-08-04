<?php
include '../connect.php';
include("../main/navbar.php")
?>
<!DOCTYPE html>
<html>
<head>
  <title>ARTICLES list</title>
</head>
<body>
 <div class="container">
     
     <!-- ---------------------- TABLE HEAD------------------------------ -->
    <div class="col-md-12">
    <div class="container">
    <div class="col-lg-4" ><input class="form-control" placeholder="Search" id="myInput" type="text" style="width: 10vw;margin-top: 1vw; color: black;">   </div>
    <div class="col-lg-6" > </div>
    <div class="col-lg-8" style="text-align:  right;"><button class="btn btn-danger"  onclick="print_page()">PRINT</button>
    </div> 
    </div>
    </div>
    <!-- ---------------------- TABLE HEAD------------------------------ -->

    <div id="printableArea"  class="col-md-12" >
      <h3 style="text-align: center;"><b>ARTICLES LIST </b></h3>
      <table border="1" class="table" >
        <thead >
                   <tr>
                      <th> NO:</th>
                      <th>ARTICLE NAME:</th>
                      <th> PRICE:</th>
                      <th> MRP:</th>
                      <th> STOCK:</th>
                        <th>SALES:</th>
                      <th> AVAILABLE:</th>
                    
                    </tr>

        </thead>
<tbody id="table">
<?php
        $sql="SELECT articles.article_id,
           articles.article_name,
           articles.article_no,
             articles.article_price,
             articles.sales_price,
               articles.article_stock AS available,
           Sum(sales_articles.article_qty) as sales,
           Sum(stocks.article_qty) as article_stock
                FROM   articles
           LEFT JOIN sales_articles
                  ON sales_articles.article_id = articles.article_id 
            LEFT JOIN stocks
                  ON stocks.article_id = articles.article_id
        GROUP  BY articles.article_id";
      $query=mysqli_query($conn,$sql);
      while($fetch=mysqli_fetch_array($query))
      {
       $article_no=$fetch["article_no"];
       $article_name=$fetch["article_name"];
       $article_price=$fetch["article_price"];
       $sales_price=$fetch["sales_price"];
       $article_stock=$fetch["article_stock"];
       $sales=$fetch["sales"];
       $available=$fetch["available"];

   
  
   
?>
   <tr class="table_row">
     <td style="cursor: pointer;" > <?php echo $article_no;?> </td>
     <td style="cursor: pointer;"> <?php echo $article_name;?> </td>
     <td style="cursor: pointer;"> <?php echo $article_price;?> </td>
     <td style="cursor: pointer;"> <?php echo $sales_price;?> </td>
          <td style="cursor: pointer;"> <?php echo $article_stock;?> </td>
     <td style="cursor: pointer;"> <?php echo $sales;?> </td>  
     <td style="cursor: pointer;"> <?php echo $available;?> </td>
 
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
  function delete_customer(customer_id)
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
    swal("Poof!  customer deleted!", {

      icon: "success",
    });
     $.ajax({
      type:"POST",
      url:"../delete/delete_customer.php",
      data:{
        customer_id:customer_id
      },
      success:function(data)
      {


        location.href = "http://localhost/stock/view/view_customer.php";
        
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