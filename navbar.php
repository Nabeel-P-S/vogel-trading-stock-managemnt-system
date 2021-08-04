<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins"> 

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="images/logo.jpg">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

  <style type="text/css">
legend
{
color: #ab002e;
}
span
{
color: red;
}
.navbar
{
  background-color: ;
  color:black;
}
a
{
  color: white;
}
body
{
  font-family: "Poppins", sans-serif;
  color:#017874;
}

  </style>

  <title>Vogel Stock Management</title>
</head>
<body>
<nav class="navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"> </a>
    </div>
    <ul  class="nav navbar-nav">
      <li ><a class="btn btn-primary" href="../main/home.php">HOME</a></li>
 
    </ul>
    <button style="width: 10vw;margin-top: .8vw;float: right;" class="btn btn-success" onclick="print_page()"> PRINT</button>
   <!--  <img src="images/logo.png" > -->
  </div>
</nav>
 <div class="col-md-12" style="background-image: url('images/logo.jpeg'); background-repeat: no-repeat;
  background-attachment: fixed; 
  background-position: bottom;height: 45vw;"> 
</body>
</html>
<script type="text/javascript">
     $(document).ready(function(){

  $("#myInput").on("keyup", function()

   {

    var value = $(this).val().toLowerCase();

    $("#table tr").filter(function() {

      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

    });

  });

});
</script>

<script type="text/javascript">
  
      function print_page()
  {
    
    window.print()
  }
</script>

