<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
if($_SESSION["trans"]){
    echo "transaction successful";
   $_SESSION["trans"]=false;
}
if($_SESSION["dep"]){
    echo "Deposit successful";
   $_SESSION["dep"]=false;
}
if($_SESSION["wd"]){
    echo "withdrawal successful";
   $_SESSION["wd"]=false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Banking portal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <style type="text/css">
        body{
         font: 14px sans-serif; 
        text-align: center; 
        padding: 0px;
        margin: 0px;
        background: white;
        }
        table, th, td {
            border: 1px solid black;
        }
        html{
            height:100%;
            margin: 0;
        }
        .bg{
            height:100%;
            background-position: center;
            background-repeat: no-repeat;;
            background-size: cover;
        }
        .main-header{
   background: white url("images/image5.jpeg") no-repeat scroll center;
    padding: 12px;
    color: white;
    text-align: right;
    font-family: "Old English Text MT",sans-serif;
    }
        .header{
          padding-bottom: 50px;
        }
        .main-nav{
         text-align: left;
         background-color: black;
         padding: 5px;
         box-shadow: 0 0 10px black;
        }
        .main-nav ul{
          margin: 0px;
          padding: 0px;
          list-style: none;
        }
       .main-nav a{
        color: white;
        text-decoration: none;
       padding: 10px 30px;
       display: inline-block;
    }
      .main-nav ul li{
        float: left;
        position: relative;
      }
      .main-nav ul li ul{
        position: absolute;
        top: 41px;
        right: 0px;
        width: 150px;
        display: none;
      }
      .main-nav ul li a{
        display: block;
      }
      .main-nav ul li:hover ul{
            display: block;
      }
      .main-nav ul li ul li{
        width: 100%;
        background-color: white;
      }
      .main-nav ul li ul li a{
        padding: 10px;
        background-color: black;
        color: #444;
      }
      .main-nav ul li a:hover{
        background-color: #964e40;
      }
      .main-nav ul li ul li a:hover{
        background-color: #964e40;
      }
      .main-nav ul li ul li a.logout{
        color: white;
      }
      .main-nav ul li ul li a.reset-password{
        color: white;
      }
    .main-nav a.active{
    background-color: darkred;
     }
    .main-nav ul li.maruthi{
    float: right;
    margin: 0px;
    padding: 0px;
    position: relative;
    }
.main-footer{
    background: linear-gradient(45deg,#964e40,black,#964e40);
    padding: 12px;
    text-align: center;
    color: white;
    box-shadow: 0 0 10px darkred;
}
.main-footer a{
    color: orange;
}
.news{
    color: darkred;
    font-size: 30px;
    background-color: lightpink;
    text-align: center;
    font-family: "Algerian",sans-serif;
  }
  aside{
    background-image: url("images/background2.jpg");
    float: left;
    width: 250px;
    text-align: center;
    box-shadow: 0 0 10px black;
    top: 0;
    height: 450px;
}
aside a{
    display: block;
    color: whitesmoke;
    text-decoration: none;
    padding: 14px 25px;
    font-size: 18px;
}
aside a:hover{
    background-color: rgba(0,0,0,0.5);
}
</style>
</head>
<body class="bg">
  <header class="main-header">
    <h1 class="animated slideInRight">Banking Portal</h1>
</header>
      <nav class="main-nav">
    <div class="animated slideInLeft">
         <ul class="nav">
         <li><a href="welcome.php" class="active">
            <i class="fa fa-home"></i> Dashboard</a></li>
       <li> <a href="deposit.php">
          <i class="fas fa-rupee-sign"></i> Deposit</a></li>
        <li><a href="withdrawal.php">
          <i class="fas fa-rupee-sign"></i></i> Withdraw</a></li>
        <li><a href="transaction.php">
           <i class="fas fa-exchange-alt"></i> Transaction</a></li>
        <li><a href="t_history.php">
            <i class="fas fa-history"></i> Transaction History</a></li>
            <li><a href="add_beneficiary.php">
            <i class="fas fa-history"></i> Beneficiary</a></li>
        <li><a href="contact.php">
            <i class="fa fa-envelope"></i> Contact Us</a></li>
            <li><a href="reset-password.php"  class="reset-password">
            <i class="fas fa-key"></i> Reset password</a></li>
            <li><a href="logout.php" class="logout">
            <i class="fas fa-sign-out-alt"></i> Logout</a></li>
            <li class="maruthi"><a href=""><i class="fas fa-user"></i>
            <i class="fa fa-user-circle-o" aria-hidden="true"></i> 
              <?php echo htmlspecialchars($_SESSION["username"]);?> 
              <i style="font-size: .8em"></i></a>
              <div class="sub-menu-1">
          <ul>
        </ul>
        </div>
    </li>
  </ul>
</div>
</nav>
</head>
<body>

  <div class="news"><marquee behavior="alternate"><b>WELCOME TO BANKING PORTAL</b></marquee></div>
  <div class="header">
         <head>
  <link rel="stylesheet" type="text/css" href="clock_style.css">
  <script type="text/javascript">
    window.onload = setInterval(clock,1000);

    function clock()
    {
    var d = new Date();
    
    var date = d.getDate();
    
    var month = d.getMonth();
    var montharr =["Jan","Feb","Mar","April","May","June","July","Aug","Sep","Oct","Nov","Dec"];
    month=montharr[month];
    
    var year = d.getFullYear();
    
    var day = d.getDay();
    var dayarr =["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    day=dayarr[day];
    
    var hour =d.getHours();
      var min = d.getMinutes();
    var sec = d.getSeconds();
  
    document.getElementById("date").innerHTML=day+" "+date+" "+month+" "+year;
    document.getElementById("time").innerHTML=hour+":"+min+":"+sec;
    }
  </script>
  <br>
   <b><p id="date"></p></b>
   <p id="time"></p>  
  </div>
    </div class="a">
    <div class="container">
    <div class="table-responsive">
    <table class="table table-bordered">
  <tr>
    <th><center>BANK</center></th>
    <th><center>ACCOUNT NUMBER</center></th>
    <th><center>BALANCE</center></th>
  </tr>
   <?php
   require_once ('api/AxisDB.php');
   require_once('api/KotakDB.php');
   require_once ('api/SbiDB.php');
   $s=$_SESSION['ssn'];
   $db=new AxisDB();
   $db->Print($s);
   $db1=new KotakDB();
   $db1->Print($s); 
   $db=new SbiDB();
   $db->Print($s);
   ?>
</table>
</div>
</div>
     <br>
     <br>
     <br>
    
<div class="wrapper row4">
  <footer id="footer" class="hoc clear"> 
    <div class="one_third first">
      <h6 class="title">Address</h6>
      <ul class="nospace linklist contact">
        <li><i class="fa fa-map-marker"></i>
          <address>
          <p>
          Name        : P Maruthi <br>
          University  : VIT <br>
          Batch       : 2k20 <br>
          Dept        : CSE <br>
          </p>
          </address>
        </li>
      </ul>
    </div>

    <div class="one_third">
      <h6 class="title">Phone</h6>
      <ul class="nospace linklist contact">
        <li><i class="fa fa-phone"></i> 8978944897<br></li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="title">Email</h6>
      <ul class="nospace linklist contact">
        <li><i class="fa fa-envelope-o"></i> p.maruthi365@gmail.com </li>
      </ul>
    </div>
  </footer>
</div>
<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
    <p class="fl_left">Copyright &copy; 2020 - All Rights Reserved - <a href="#">P Maruthi</a></p>
  </div>
</div>
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<script src="layout/scripts/jquery.placeholder.min.js"></script>
</body>
</html>