=======================================================================
SEACH WITH DROPDOWN

<input list="adventure" name="myAdventure" placeholder="Start your search" class="form-control">


<datalist id="adventure">

</datalist>

 <option value="Location - Azad Kashmir">


 	====================================

 	SELECT DROPDOWN
 	
 	  <select id="supplier_id"  name="supplier_id" onchange="display_stock();" class="form-control">
                  <option style="color: grey" value="" >select Supplier</option>
                  <?php  
                  $query=mysqli_query($conn,"SELECT * from suppliers");
                  while($fetch=mysqli_fetch_array($query))
                  {
                    ?>
                    <option value="<?php echo $fetch ['supplier_id']; ?>"><?php echo $fetch ['supplier_name'];?> </option>
                    <?php
                  }
                  ?> 
                </select> 

                ================================
                join table

    SELECT order_quantity.id, order_quantity.order_id,order_quantity.order_quantity, order_quantity.size_id,sizes.size FROM `order_quantity` left join `sizes` on sizes.size_id=order_quantity.size_id  WHERE order_id='$order_id'


     <select id="article_id"  name="article_id"  class="form-control">
                  <option style="color: grey" value="" >select Article</option>
                  <?php  
                  $query=mysqli_query($conn,"SELECT * from articles");
                  while($fetch=mysqli_fetch_array($query))
                  {
                    ?>
                    <option value="<?php echo $fetch ['article_id']; ?>"><?php echo $fetch ['article_name'];?> </option>
                    <?php
                  }
                  ?> 
                </select> 