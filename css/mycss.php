
<!-- legend,h3, {color: #333;} -->
legend{color: #b32b53;}
h3,h4{color: #b32b53;}
<!-- span{color:#017839;} -->
span{color:#b32b53;}
table{background-color:white;}
<!-- thead{color:white;background-color:#017874;} -->
thead{color:white;background-color:#b32b53;}

 .navoption{color:white;}

nav{
  background-color:#b32b53;
  <!-- background-color:#a60233; -->
<!--   background-image: linear-gradient(90deg, green,yellow); -->
  font-weight: bold;
}
body
{
  font-family: "Poppins", sans-serif;
  <!-- color:#017874; -->
}
@media print {
  body{
    visibility: hidden;
  }
  #printableArea  {
    visibility: visible;
  }

  #printableArea {
    position: absolute;
    left: 0;
    top: 0;
  }
  #print_btn{
  display: none;;
}
}

  .filter
  {
    width: 9vw;
    display: inline-block;
  }
th{font-size: 15px;text-align: center;}
.table_row{ text-align:center; }
.table_summary{font-size: 15px;}

@media print{
a[href]:after{content:none}

#printPageButton {
    display: none;
  }
  #print_avoid{
  display: none;
}
  }

#main_div
{
    background-image: url('../images/logo1.png');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-position: 95% 98%;
  background-size: 250px 100px;
 
  <!-- height: 45vw; -->
  

}
