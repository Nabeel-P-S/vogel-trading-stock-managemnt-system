<?php
include '../connect.php';
include("../main/navbar.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>ARTICLE list</title>
</head>

<body>



    <!-- ---------------------- TABLE HEAD------------------------------ -->
    <div class="col-md-12" id="printableArea" >
    <div class="container">
    <div class="col-lg-4" id="print_avoid"><input class="form-control" placeholder="Search" id="myInput" type="text" style="width: 10vw; color: black;">   </div>
  <div class="col-lg-4" >
  <legend style="text-align: center;">VOGEL ARTICLES   </legend></div>
    <div class="col-lg-4" style="text-align:  right;"><button class="btn btn-danger" id="print_avoid"  onclick="print_page()">PRINT ARTICLES</button>
    </div> 
    </div>
  
    <!-- ---------------------- TABLE HEAD------------------------------ -->

    <div  class="col-md-12" >

      <table border="1" class="table table-condensed table-hover table-striped"  style="width: 100%;">
      


<tr class="info">
                      <td> SL NO</td>
                      <td> ARTICLE</td>
                      <!-- <td>ARTICLE </td> -->
                      <!-- <td>SUPPLIER </td> -->
                      <td> PRICE:</td>
                      <td> MRP:</td>
                      <td> HSN NO:</td>
                      <td> SGST:</td>
                      <td> CGST:</td>
                      <td> IGST:</td>
                      <td> CESS:</td>
                      <td> IN STOCK:</td>
                      <td>   AVAILABLE:</td>
                      <td> STAFF STOCK:</td>
                        <td>SOLD:</td>
                        <td>D SOLD:</td>
                        <td>F SOLD:</td>
                      <!-- <td> AVAILABLE:</td> -->
                      <!-- <td> </td> -->
                    
                    </tr>

<tbody id="table">
  <?php
    $sql="SELECT articles.article_id,
           articles.article_name,
           articles.hsn_no,
           articles.sgst,
           articles.cgst,
           articles.igst,
           articles.cess,
           articles.article_no,
             articles.article_price,
            sum(stocks.article_qty) as in_stock,
             articles.sales_price,
               articles.article_stock AS available,
          articles.sold,
          articles.dsold,
          articles.fsold,

        
           articles.staff_stock as staff_stock,
            articles.article_stock as main_stock,
              suppliers.supplier_name from articles  
                     LEFT JOIN stocks
                  ON stocks.article_id = articles.article_id
              left JOIN suppliers
               ON suppliers.supplier_id=articles.supplier_id
           GROUP by articles.article_id
     
       
    ";
  $query=mysqli_query($conn,$sql);
  $count=0;
  $qty_sum=0;
  $mrp=0;
  $price=0;
  $staff_stock_total=0;
  $sales_total=0;
  if (!$query) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
  while($fetch=mysqli_fetch_array($query))
  {
   $article_no=$fetch["article_no"];
   $article_id=$fetch["article_id"];
       $article_name=$fetch["article_name"];
       $article_price=$fetch["article_price"];
       $hsn_no=$fetch["hsn_no"];
       $sgst=$fetch["sgst"];
       $cgst=$fetch["cgst"];
       $igst=$fetch["igst"];
       $cess=$fetch["cess"];
       $sales_price=$fetch["sales_price"];
       $sold=$fetch["sold"];
       $dsold=$fetch["dsold"];
       $fsold=$fetch["fsold"];
       $in_stock=$fetch["in_stock"];
       $main_stock=$fetch["main_stock"];
       $staff_stock=$fetch["staff_stock"];
       // $sales=$fetch["sales"];
       $available=$fetch["available"];
       $supplier_name=$fetch["supplier_name"];

     $qty_sum=$qty_sum+$main_stock;
     $staff_stock_total+=$staff_stock;
     // $sales_total+=$sales;
     $count++;
     $mrp+=$sales_price;
     $price+=$article_price;
   
   
   ?>
   <tr class="table_row" onclick="editArticle('<?php echo $article_id;?>');">
     <td style="cursor: pointer;" > <?php echo $article_id;?> </td>
      
     <td style="cursor: pointer;" > <?php echo $article_no;?> </td>
     <!-- <td style="cursor: pointer;"> <?php echo $article_name;?> </td> -->
     <!-- <td style="cursor: pointer;"> <?php echo $supplier_name;?> </td> -->

     <td style="cursor: pointer;"> <?php echo $article_price;?> </td>
     <td style="cursor: pointer;"> <?php echo $sales_price;?> </td>
     <td style="cursor: pointer;"> <?php echo $hsn_no;?> </td>
     <td style="cursor: pointer;"> <?php echo $sgst;?> </td>
     <td style="cursor: pointer;"> <?php echo $cgst;?> </td>
     <td style="cursor: pointer;"> <?php echo $igst;?> </td>
     <td style="cursor: pointer;"> <?php echo $cess;?> </td>
        <td style="cursor: pointer;"> <?php echo $in_stock;?> </td>
          <td style="cursor: pointer;"> <?php echo $main_stock;?> </td>
       
              <td style="cursor: pointer;"> <?php echo $staff_stock;?> </td>
     <!-- <td style="cursor: pointer;"> <?php echo $sales;?> </td>   -->
     <td style="cursor: pointer;"> <?php echo $sold;?> </td>  
     <td style="cursor: pointer;"> <?php echo $dsold;?> </td>  
     <td style="cursor: pointer;"> <?php echo $fsold;?> </td>  
 
 
   
      <!-- <td><button   class="btn-md btn-primary"> <a href="../edit/article_edit.php?article_id=<?php echo $article_id;?>"> EDIT</a></button></td> -->

     
   </tr>
    <?php

}
?>

<!-- ========================== TABLE  SUMMARY ============================================= -->
  <tr class="info"  style="display: none;">    
   
      <td colspan="3">TOTAL : <?php echo $count; ?> </td>
      <td colspan="3">PRICE : <?php echo $price; ?> </td>
    
      <td colspan="3">MAIN STOCK : <?php echo $qty_sum; ?> Pcs</td>
        <td colspan="3">STAFF STOCK : <?php echo $staff_stock_total; ?> </td>
      <td colspan="3">SOLD : <?php echo $sales_total; ?> Pcs</td>
   </tr>
   
<!-- ========================== TABLE  SUMMARY ============================================= -->

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
  function delete_article(article_id)
   {


swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this imaginary file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Poof! Your imaginary file has been deleted!", {

      icon: "success",
    });
     $.ajax({
      type:"POST",
      url:"../delete/delete_article.php",
      data:{
        article_id:article_id
      },
      success:function(data)
      {


        location.href = "http://localhost/stock/view/view_article.php";
        
      }

    });
  } 
  else {
    swal("Your imaginary file is safe!");
  }
});

   
  }
</script>
<script type="text/javascript">
  function editArticle(article_id)
  {
    // alert(article_id);
    location.href ="../edit/article_edit.php?article_id="+article_id;
  }
</script>
</body>
</html>