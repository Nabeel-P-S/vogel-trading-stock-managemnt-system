<?php 
      include ("connect.php");
      include ("main/navbar.php");

  date_default_timezone_set('Asia/Kolkata');
   $date = date("Y-m-d");
   ?>

  <style type="text/css">


#main_div
{
   background: transparent url(images/logo.png) scroll no-repeat 0 0;


}
  </style>
	<title>STOCK MANAGEMENT</title>
<style>
	#main_ddiv {

  background-image: url('images/logo.png');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-position: 95% 98%;
  background-size: 350px 350px;
  height: 45vw;

}
</style>
</head>
<body>
	<div id="main_ddiv" class="col-lg-12">
  <div class="col-lg-12" style="background-color: #06697d;">
  <!--   <a class="w3-bar-item w3-button w3-hover-yelllow navoption"  href="http://localhost/stock/home.php">STOCK</a>
    <a class="w3-bar-item w3-button w3-hover-pink navoption"  href="http://localhost/stock/home2.php">INVOICE</a> -->


    <a class="w3-bar-item w3-button w3-hover-white navoption" href="logout.php" style="float: right;" >  LOG OUT  </a></div>
<br>
<br>
<br>
<br>
<br>
<div class="col-md-12">
     <?php include "../forms/add_stock.php"; ?>
</div>


</body><script type="text/javascript">
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
            $.ajax( 
            {

              type:"POST",
              url:"insert/stock_insert.php",
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
            url:"details/article_stock.php",
             dataType:"json",
            data:{
             
              article_id:article_id
            },

            success: function(data)

            {
              var article_stock=data.total_stock;
              
      if (article_stock==null) {article_stock="No Stock Available;"}
          document.getElementById("article_stock").value=article_stock; 
        

              
}    
});

        }
      </script>
</html>