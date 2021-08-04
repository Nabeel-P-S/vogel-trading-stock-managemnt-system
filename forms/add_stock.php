  <?php 
  include("../main/navbar.php");
          $query=mysqli_query($conn,"select stock_id from stocks order by stock_id desc LIMIT 1
           ");
          $fetch=mysqli_fetch_array($query);
           $stock_id=$fetch['stock_id']+1;?>

<div class="col-md-8">
<form class="form-group">
      <fieldset>

      <!-- Form Name -->
<legend>ADD STOCK    <p style="float: right;">No : <?php echo $stock_id ?> </p> </legend>    
    
      <!-- Text input-->

            <div class="form-group" >
             <div class="input-group">
                <span class="input-group-addon">STOCK DATE</span>
                <input id="stock_date" type="date" class="form-control" placeholder="<?php echo $date?>"   name="stock_date" value="<?php echo $date?>" >
              </div></div>
            <div class="form-group" style="display: none;">
             <div class="input-group">
                <span class="input-group-addon">STOCK NO</span>
                <input id="stock_id" type="text" class="form-control" name="stock_id" value="<?php echo $stock_id?>" >
              </div></div>

                <!-- //article select div -->
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">ARTICLE NO</span>
                    <input list="articles" id="article_id" style="font-size: 1vw;" name="article_id"  placeholder="SELECT ARTICLE" class="form-control">
                       <datalist id="articles">
                      
                            <option  value="" >select /option>
              <?php  
                            $query=mysqli_query($conn,"SELECT * from articles");
                            while($fetch=mysqli_fetch_array($query))
                            {
              ?>
                              <option value="<?php echo $fetch ['article_id']; ?>"><?php echo $fetch ['article_no'];?> </option>
              <?php
                            }
               ?> 
                       

                  </datalist> 
                </div>
          </div>

                <!-- //article select div -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">INVOICE NO</span>
                <input id="invoice_no" type="text" class="form-control" name="invoice_no" placeholder="INVOICE NO">
              </div></div>
               <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">LR NO</span>
                <input id="lr_no" type="text" class="form-control" name="lr_no" placeholder="LR NO">
              </div></div>

           <!--  <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon">SUPPLIER NO*</span>
        <select id="supplier_id"  name="supplier_id" onchange="display_stock();" class="form-control">
                        <option style="color: grey" value="" >SELECT SUPPLIER</option>
                        <?php  
                        $query=mysqli_query($conn,"SELECT * from suppliers");
                        while($fetch=mysqli_fetch_array($query))
                        {
                          ?>
                          <option value="<?php echo $fetch ['supplier_id']; ?>"><?php echo $fetch ['supplier_name'];?> </option>
                          <?php
                        }
                        ?> 
                      </select>         </div></div>

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon">STOCK PRICE</span>
                <input id="stock_price" type="text" class="form-control" name="stock_price" placeholder="STOCK PRICE"  >
              </div></div> -->

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"> QTY</span>
                <input id="article_qty" type="text" class="form-control" name="article_qty" placeholder=" QTY"  >
              </div></div>
         <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"> TRANSPORT</span>
                <input id="cargo" type="text" class="form-control" name="cargo" placeholder=" CARGO"  >
              </div></div>
            <!-- Button -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="save"></label>
              <div class="col-md-4">
                <br>
                <button id="save" name="save" onclick="save_stock()" class="btn btn-success">SAVE STOCK</button>
              </div>
            </div>

      </fieldset>


        
      </form>
      </div>
      <div class="col-md-2">
<div class="form-group">
       <div class="input-group">
         <legend> stock available..</legend>
          <input list="articles" id="article_id1" style="font-size: 1vw;" name="article_id" onkeyup="display_article_stock();" placeholder="SELECT ARTICLE" class="form-control">
      <datalist id="articles">
         <option  value="" >select /option>
                        <?php  
                        $query=mysqli_query($conn,"SELECT * from articles");
                        while($fetch=mysqli_fetch_array($query))
                        {
                          ?>
                          <option value="<?php echo $fetch ['article_id']; ?>"><?php echo $fetch ['article_name'];?> </option>
                              <?php
                        }
                        ?> 
      </datalist> 

       </div></div>
  </div>


      <div class="col-md-4">  <div class="form-group">  <input style="font-size: 2vw;width: 14vw;float: right;border: none;color:green;" class="form-control" id="article_stock" >
     <br>
     <br>
     <br>
     <br>
</div>
<a class="btn btn-info"  href="../print/stock.php">PRINT ALL STOCK</a>

     </div>

      <script type="text/javascript">
          function save_stock()
          {

            var stock_date=document.getElementById("stock_date").value;
            var stock_id=document.getElementById("stock_id").value;
            var article_id=document.getElementById("article_id").value;
            var invoice_no=document.getElementById("invoice_no").value;
     
            var article_qty=document.getElementById("article_qty").value;
            var lr_no=document.getElementById("lr_no").value;
            var cargo=document.getElementById("cargo").value;
            
            if(article_id==""||invoice_no==""||article_qty==""||lr_no==""||cargo=="")
            {       
               // swal("ERROR","Enter Vogel No ","error");
               alert("ENTER FULL DATA");

             }
          
else{
  alert("STOCK INSERTED")
            $.ajax( 
            {

              type:"POST",
              url:"../insert/stock_insert.php",
              // dataType:"json",
              data:{
                stock_date:stock_date,
                stock_id:stock_id,
                article_id:article_id,
                invoice_no:invoice_no,
         
                lr_no:lr_no,
                cargo:cargo,
                article_qty:article_qty
              },

              success: function(data)

              {
                    alert(data);
                    // alert("success");

                    // document.getElementById('item_id').value=data.item_id;
                       // alert(data.item_id);
                      

                     }    
                   });



          }

          }

     
        </script>
 <script>
          function display_article_stock()
          {
        

          var article_id=document.getElementById("article_id1").value;
       
          $.ajax(
          {
            type:"POST",
            url:"../details/main_stock.php",
             dataType:"json",
            data:{
             
              article_id:article_id,
           
           
            },

            success: function(data)

            {
              // alert(data);
              var article_stock=data.main_stock;
              
      if (article_stock==null) {article_stock="No Stock Available;"}
          document.getElementById("article_stock").value=article_stock; 
        

              
}    
});

        }
      </script>
