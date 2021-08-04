<?php
$query=mysqli_query($conn,"SELECT * from articles where article_id='$article_id'");
$fetch=mysqli_fetch_array($query);
$article_id=$fetch['article_id'];
$article_name=$fetch['article_name'];
$article_price=$fetch['article_price'];
$hsn_no=$fetch['hsn_no'];
$sgst=$fetch['sgst'];
$cgst=$fetch['cgst'];
$igst=$fetch['igst'];
$cess=$fetch['cess'];
$article_no=$fetch['article_no'];
$article_stock=$fetch['article_stock'];
$sales_price=$fetch['sales_price'];
$supplier_id=$fetch['supplier_id'];

?>
<!DOCTYPE html>
<html>
<head>
  <title>article list</title>
</head>
<body>
<form class="col-md-8">
<fieldset>

<!-- Form Name -->
<legend>EDIT  ARTICLE  - <?php echo $article_name ?>    <p style="float: right;">No : <?php echo $article_id ?> </p> </legend>    


<!-- Text input-->

<div class="form-group"  >
 <div class="input-group">
    <span class="input-group-addon">ARTICLE ID</span>
    <input id="article_id5"  class="form-control" readonly="1" name="article_id5" value="<?php echo $article_id ?>" >
  </div></div>



<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">ARTICLE NO</span>
    <input id="article_no" type="text" class="form-control" name="article_no" placeholder="ARTICLE NO" value="<?php echo $article_no ?>"  >
  </div></div>

<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">ARTICLE NAME</span>
    <input id="article_name" type="text" class="form-control" name="article_name" placeholder="ARTICLE NAME" value="<?php echo $article_name ?>"  >
  </div></div>

<div class="form-group"> <div class="input-group">
    <span class="input-group-addon">SUPPLIER NAME</span>
    <input list="suppliers" id="article_supplier_id" name="supplier_id" placeholder="Start your search" class="form-control" value="<?php echo $supplier_id ?>">
<datalist id="suppliers">
   <option  value="" >select SUPPLIER</option>
                  <?php  
                  $query=mysqli_query($conn,"SELECT * from suppliers");
                  while($fetch=mysqli_fetch_array($query))
                  {
                    ?>
                    <option value="<?php echo $fetch ['supplier_id']; ?>"><?php echo $fetch ['supplier_name'];?> </option>
                        <?php
                  }
                  ?> 
</datalist>  </div></div>

<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">PURCHASE COST</span>
    <input id="article_price" type="text" class="form-control" name="article_price" placeholder="PURCHASE COST" value="<?php echo $article_price ?>"  >
  </div></div>

<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">SELLING PRICE</span>
    <input id="sales_price" type="text" class="form-control" name="sales_price" placeholder="SELLING PRICE"  value="<?php echo $sales_price ?>" >
  </div></div>

<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">HSN NO</span>
    <input id="hsn_no" type="text" class="form-control" name="hsn_no" placeholder="HSN NO"  value="<?php echo $hsn_no ?>" >
  </div></div>

<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">SGST</span>
    <input id="sgst" type="text" class="form-control" name="sgst" placeholder="SGST"value="<?php echo $sgst ?>"  >
  </div></div>
<div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">CGST</span>
    <input id="cgst" type="text" class="form-control" name="cgst" placeholder="CGST" value="<?php echo $cgst ?>"  >
  </div></div>
  <div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">IGST</span>
    <input id="igst" type="text" class="form-control" name="igst" placeholder="IGST" value="<?php echo $igst ?>" >
  </div></div>
  <div class="form-group">
 <div class="input-group">
    <span class="input-group-addon">CESS</span>
    <input id="cess" type="text" class="form-control" name="cess" placeholder="CESS" value="<?php echo $cess ?>" >
  </div></div>
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="save"></label>
  <div class="col-md-4">
    <br>
    <button id="save_article" name="save_article" onclick="update_article()" class="btn btn-primary">UPDATE ARTICLE</button>
  </div>
</div>

</fieldset>
</form>
<div class="col-md-4">
  <table class="table">
    <tr>
      <td>No</td>
      <td>Name</td>
      <td>Stock Limit</td>
    </tr>
 
  <?php 
  $sql="SELECT staff_articles.staff_id,staff_articles.article_limit,staff_articles.article_id,staffs.staff_name FROM `staff_articles` LEFT JOIN staffs on staffs.staff_id=staff_articles.staff_id where staff_articles.article_id='$article_id'";
  $query=mysqli_query($conn,$sql);

while($fetch=mysqli_fetch_array($query))
      {
        $staff_id=$fetch['staff_id'];
        $staff_name=$fetch['staff_name'];
        $article_limit=$fetch['article_limit'];
     
        ?>
<tr>
   <input style="border: none;width: 3vw;display: none;" readonly="1" type="text" name="staff_id" id="staff_id3" value="<?php echo $staff_id;?>">

  <td><?php echo $staff_id;?></td>
  <td><?php echo $staff_name;?></td>
  <td ><input style="width: 8vw;text-align: center;" class="form-control" type="text" name="article_limit" id="article_limit" value="<?php echo $article_limit;?>"></td>
</tr>
       <?php } ?>
     </table></div>

 



</body>
</html>

<script type="text/javascript">
  function update_article() {
 // alert(" ARTICLE INSERTED");

  var staff_id_element=document.getElementsByName('staff_id');
 var article_limit=document.getElementsByName('article_limit');

 var staff_id_array=[];
 var article_limit_array=[];
 var n=0;
   for (var i = 0; i <staff_id_element.length; i++) 
   {
      var staff_id=staff_id_element[i].value;
      var article_limit1=article_limit[i].value;
      
      
         staff_id_array[n]=staff_id;
          // alert(article_limit1);
         article_limit_array[n]=article_limit1;
         // alert(item_qty[n]);
         n++;
      
   } 
 var article_id=document.getElementById("article_id5").value;
 var article_no=document.getElementById("article_no").value;
 var sales_price=document.getElementById("sales_price").value;
 var article_name=document.getElementById("article_name").value;
 var supplier_id=document.getElementById("article_supplier_id").value;
 var article_price=document.getElementById("article_price").value;
 var hsn_no=document.getElementById("hsn_no").value;
 var sgst=document.getElementById("sgst").value;
 var cgst=document.getElementById("cgst").value;
 var igst=document.getElementById("igst").value;
 var cess=document.getElementById("cess").value;

   var staff_array_json=JSON.stringify(staff_id_array);
   var article_limit_json=JSON.stringify(article_limit_array); 


            // alert(article_id+article_no+article_name+supplier_id+sales_price+article_price);
                 if(article_name=="")
            {       
               // swal("ERROR","Enter Vogel No ","error");
               swal("enter full data");

             }
          
else{ 
             $.ajax( 
            {

              type:"POST",
               url:"../update/article_update.php",
              // dataType:"json",
              data:{
                staff_array_json:staff_array_json,
                article_limit_json:article_limit_json, 
                article_id:article_id,
                article_no:article_no,
                sales_price:sales_price,
                article_name:article_name,
                article_price:article_price,
                hsn_no:hsn_no,
                sgst:sgst,
                cgst:cgst,
                igst:igst,
                cess:cess,
                supplier_id:supplier_id
               
              },

              success: function(data)

              {
                alert(data);
              // alert("ARTICLE UPADATED");
              //      location.href = "../view/view_article.php";    

                     }    
                   });
           }
           

  }
</script>
