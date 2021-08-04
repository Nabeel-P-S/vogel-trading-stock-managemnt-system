<?php 
      include ("../connect.php");
session_start();
 $user_id = $_SESSION["id"];
  $user_name = $_SESSION["username"];
  date_default_timezone_set('Asia/Kolkata');
   $date = date("Y-m-d");?>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins"> 
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="shortcut icon" href="../images/logo.jpg">
  <link rel="stylesheet" href="../css/w3.css">
  <link rel="stylesheet" type="text/css" href="../css/sweetalert.css"><label hidden="">invalid</label>
  <script src="../sweetalert.min.js"></script>
  <style type="text/css">

<?php include ("../css/mycss.php")
 
?>
#main_div
{
   background: transparent url(../images/logo.png) scroll no-repeat 0 0;


}
  </style>
	<title>STOCK MANAGEMENT</title>
<style>
	#main_ddiv {

  background-image: url('../images/logo.png');
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
  <div class="col-lg-12" style="background-color: #333;">
<!-- !--     <a class="w3-bar-item w3-button w3-hover-green navoption"  href="http://localhost/stock/home.php">STOCK</a> -->
  
 <a class="w3-bar-item w3-button w3-hover-yellow navoption" href="../staff/home2.php" >ADD  INVOICE   </a>
    <a class="w3-bar-item w3-button w3-hover-yellow navoption" href="../staff/view_sales.php" > VIEW INVOICE BILL  </a>
    <a class="w3-bar-item w3-button w3-hover-yellow navoption" href="../staff/home3.php" > ADD VOUCHER </a>
    <a class="w3-bar-item w3-button w3-hover-yellow navoption" href="../staff/vouchers.php" > VIEW VOUCHER </a>
    <a class="w3-bar-item w3-button w3-hover-yellow navoption" href="../staff/ds.php" > DIRECT SALES </a>
    <a class="w3-bar-item w3-button w3-hover-yellow navoption" href="../staff/ds_view.php" > VIEW DSALES </a>

    <a class="w3-bar-item w3-button w3-hover-white navoption" href="../logout.php" style="float: right;" >  LOG OUT &nbsp <?php echo $user_name; ?>   </a></div>
  <?php

          $query=mysqli_query($conn,"select voucher_id from voucher order by voucher_id desc LIMIT 1
           ");
          $fetch=mysqli_fetch_array($query);
           $vr_id=$fetch['voucher_id']+1;?>

<div class="col-md-12" style="margin-top: 1vw;">

   <?php 

          $query=mysqli_query($conn,"select voucher_id from voucher order by voucher_id desc LIMIT 1
           ");
          $fetch=mysqli_fetch_array($query);
           $vr_id=$fetch['voucher_id']+1; ?>

<div class="col-md-12">



      <!-- Form Name -->
<legend>ADD VOUCHER   <p style="float: right;">No : <?php echo $vr_id ?> </p> </legend>    
    
      <!-- Text input-->
<table class="table">
  <tr>
    <td><div class="form-group" >
             <div class="input-group">
             
<label>DATE</label>
                <!-- <input id="vr_date" type="date" class="w3-input" placeholder="<?php echo $date?>"   name="vr_date" value="<?php echo $date?>" > -->
                <input id="vr_date" type="date" class="form-control" placeholder="<?php echo $date?>"   name="vr_date" value="<?php echo $date?>" >
              </div></div></td>
    <td >     <div class="form-group" >
             <div class="input-group">
               <label>TIME</label>
                <input id="vr_time" type="text" class="form-control" readonly="1"  name="vr_time" value="<?php echo $time ?>" >
              </div></div></td>

    <td><div class="form-group">
             <div class="input-group">
               <label>EXECUTIVE</label>
                 <input list="staffs" id="staff_id" style="font-size: 1vw;"onkeyup="display_staff_invoices(this.value);" name="staff_id"  placeholder="SELECT staff" class="form-control">
      <datalist id="staffs">
         <option  value="" >select /option>
                        <?php  
                        $query=mysqli_query($conn,"SELECT * from staffs");
                        while($fetch=mysqli_fetch_array($query))
                        {
                          ?>
                          <option value="<?php echo $fetch ['staff_id']; ?>"><?php echo $fetch ['staff_name'];?> </option>
                              <?php
                        }
                        ?> 
      </datalist> 
              </div></div></td>
  </tr>

</table>
            
          

           
            

            <div class="form-group" id="staff_invoices">
          

             </div>
           

            <!-- Button -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="save"></label>
              <div class="col-md-4">
                <br>
                 <input  type="hidden" value="1" id="last_id" >
                <button id="" style="width: 35vw;height: 3vw;" onclick="save_voucher()" class="btn btn-primary">SAVE VOUCHER</button>
                <!-- <button id="save" name="save" onclick="add_bill()" class="btn btn-primary">ADD BILL</button> -->
                <!-- <button id="save" name="save" onclick="save_tr()" class="btn btn-success">ADD TA</button> -->
              </div>
            </div>

 


   
      </div>
   
<div class="col-lg-4"></div>


      <script type="text/javascript">
          function save_voucher()
          {

            var vr_date=document.getElementById("vr_date").value;
            var vr_time=document.getElementById("vr_time").value;
           
            var staff_id=document.getElementById("staff_id").value;
            // var method=document.getElementById("method").value;
            var total=document.getElementById("total").value;

            var article_element=document.getElementsByName('invoice_no');
   var price_element=document.getElementsByName('paid');
   var balance_element=document.getElementsByName('balance');
   var method_element=document.getElementsByName('method');
 var article_array=[];
 var balance_array=[];
   var price_array=[];
   var method_array=[];
   var n=0;
   for (var i = 0; i <article_element.length; i++) 
   {
      var article_id=article_element[i].value;
      var price_id=price_element[i].value;
      var method_id=method_element[i].value;
      var balance_id=balance_element[i].value;
      if (price_id!="")
      {
         article_array[n]=article_id;
         price_array[n]=price_id;
         method_array[n]=method_id;
        balance_array[n]=balance_id;
         // alert(price_array[n]);
         n++;
      }
   }
   var article_array_json=JSON.stringify(article_array);
   var balance_array_json=JSON.stringify(balance_array);
   var price_array_json=JSON.stringify(price_array);
   var method_array_json=JSON.stringify(method_array);
     // alert(vr_date+vr_time+staff_id)
      
            
            if(staff_id=="")
            {       
               // swal("ERROR","Enter Vogel No ","error");
               swal("hey..SELECT THE EXECUTIVE ");

             }
          
else{
         
   $.ajax( 
            {

              type:"POST",
              url:"../insert/vr_insert.php",
              // dataType:"json",
              data:{
                article_array_json:article_array_json,
                balance_array_json:balance_array_json,
                price_array_json:price_array_json, 
                method_array_json:method_array_json, 
                vr_date:vr_date,
                vr_time:vr_time,
                staff_id:staff_id,
                total:total
              
              },

              success: function(data)

              {
                  
                    swal("success");
                window.location="../view/view_vouchers.php";

                     }    
                   });


          }

          }

     
        </script>
 <script>
          function display_staff_tr()
          {
        

          var staff_id=document.getElementById("staff_id1").value;
       
          $.ajax(
          {
            type:"POST",
            url:"../details/staff_tr.php",
             dataType:"json",
            data:{
             
              staff_id:staff_id
            },

            success: function(data)

            {
              var staff_tr=data.total_tr;
              
      if (staff_tr==null) {staff_tr="No tr Available;"}
          document.getElementById("staff_tr").value=staff_tr; 
        

              
}    
});

        }
      </script>
  <script>
          function display_invoice_total(invoice_no,last_id)
          {

          var id1="invoice_no"+last_id;
          var id2="invoice_amount"+last_id;
          var id3="invoice_paid"+last_id;
          var id4="invoice_balance"+last_id;
         
          $.ajax(
          {
            type:"POST",
            url:"../details/invoice_total.php",
             dataType:"json",
            data:{
             
              invoice_no:invoice_no
            },

            success: function(data)

            {
              var sales=data.sales;
              var paid=data.paid;
            
       
          document.getElementById(id2).value=sales; 
          document.getElementById(id3).value=paid;   
          document.getElementById(id4).value=sales-paid;   
              
}    
});

        }
      </script>
      <script type="text/javascript">
        function display_balance(paying,last_id)
        {
             
         var id1="invoice_amount"+last_id;
          var id2="invoice_paid"+last_id;
             var id3="balance"+last_id; 
          var id4="invoice_balance"+last_id;
          var id5="paid"+last_id;
                            
             var sales=document.getElementById(id1).value;
             var paid=document.getElementById(id2).value;
             var pending=document.getElementById(id4).value;
             paying=parseFloat(paying);
             pending=parseFloat(pending);
              if (paying=="")
              {
                  paying=0;
              }
              if (paying>pending)
              {
                alert(" !!! AMOUNT MORE THAN TOTAL PENDING");

             document.getElementById(id5).value="";
              }
              else
              {      var balance=sales-paid;
              balance=balance-paying;
            
             document.getElementById(id3).value=balance;
        add_total();
      }
        
}
   
      </script>      

 <script>
      function add_total()
  {
    var sum=0;
      var paid=document.getElementsByName('paid');
   for (var i = 0; i <paid.length; i++) 
  {
      if (paid[i].value=="")
      {
       var mrp=0;
      }
       else
      {
               var mrp=paid[i].value;
           
      }
              var sum=sum+parseFloat(mrp);
      

  }
  
                document.getElementById("total").value=sum;
            
}

</script>
<script type="text/javascript">
  function display_staff_invoices(staff_id)
  {

          $.ajax(
          {
            type:"POST",
            url:"../details/staff_invoices.php",
             // dataType:"json",
            data:{
             
              staff_id:staff_id
            },

            success: function(data_output)

            {
            // $("#display_div").html(data_output);
                $("#staff_invoices").html(data_output);

        

              
}    
});
  }
</script>

