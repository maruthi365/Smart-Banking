<?php
require_once "config.php";
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$acc= $am =$am_err= $tacc=$tacc_err="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $acc=trim($_POST["accno"]);
    require_once ('api/AxisDB.php');
    require_once('api/KotakDB.php');
    require_once('api/SbiDB.php');
    $db=new AxisDB();
    $db1=new KotakDB();
    $db1=new SbiDB();
    if(empty(trim($_POST["taccno"]))){
        $tacc_err = "Please enter account number";
    } 
    elseif(trim($_POST["taccno"])==$acc){
        $tacc_err="Invalid transaction";        
        }
    else{
        $tacc=trim($_POST["taccno"]);
        $x=$db->tan($tacc);
        if($x==0){
           $y=$db1->tan($tacc);
           if($y==0)
            $tacc_err="Account doesnot exist";
        }
    }
    if(empty(trim($_POST["amount"]))){
        $am_err = "Please enter amount";
    }
    elseif(trim($_POST["amount"])<=0)
    {
        $am_err="Please enter valid amount";
    }
    elseif(trim($_POST['amount'])>100000){
        $am_err="Please enter amount less than 100000";
    } 
    else{
        $am=trim($_POST['amount']);    
        }
    
      if(empty($am_err) && empty($tacc_err)){
        $db->tfrom($am,$acc);
        $db1->tfrom($am,$acc);
        $db->tto($am,$tacc);
        $db1->tto($am,$tacc);
        $db->tto($am,$tacc);
        $db1->tto($am,$tacc);
        if(true){
        $link = mysqli_connect('localhost','root','', 'banking');
        $sql="INSERT into transaction (tfrom,tto,amount) VALUES (?,?,?)";
          if($stmt = mysqli_prepare($link, $sql)){
           mysqli_stmt_bind_param($stmt, "iii", $acc,$tacc,$am);
            if(mysqli_stmt_execute($stmt)){
                $_SESSION["trans"]=true;
            header("location: welcome.php");
            }
             }
            }
            else{
             echo"<script>alert('Transaction unsuccessful.Try again')</script>";
        }
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>transaction</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <style type="text/css">
        body{ font: 14px sans-serif;
         background: white;
         }
        .wrapper{ width: 1500px; padding: 20px; }
        .wrapper1{ width: 300px; padding: 20px; }
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
    </style>
</head>
<body>
  <body class="bg">
    <header class="main-header">
    <h1 class="animated slideInRight">Banking Portal</h1>
</header>
      <nav class="main-nav">
    <div class="animated slideInLeft">
         <ul class="nav">
         <li><a href="welcome.php">
            <i class="fa fa-home"></i> Dashboard</a></li>
        <li><a href="transaction.php" class="active">
           <i class="fas fa-exchange-alt"></i> Transaction</a></li>
        <li><a href="t_history.php"> 
            <li class="maruthi"><a href=""><i class="fas fa-user"></i> 
              <?php echo htmlspecialchars($_SESSION["username"]);?> 
              <i class="fa fa-chevron-down" style="font-size: .8em"></i></a>
          <ul>
        </ul>
        </div>
    </li>
 </ul>
</div>
</nav>
    <div class="wrapper1">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Account number</label>
                <select class="form-control" name="accno">
                <?php
                require_once('api/SbiDB.php');
                require_once ('api/AxisDB.php');
                require_once('api/KotakDB.php');
                $s=$_SESSION['ssn'];
                $db=new AxisDB();
                $db->Lis($s);
                $db1=new KotakDB();
                $db1->Lis($s); 
                $db=new SbiDB();
                $db->Lis($s);
                ?>
                </select>
            </div>    
            <div class="form-group <?php echo (!empty($tacc_err)) ? 'has-error' : ''; ?>">
                <label>Transaction account number</label>
                <input type="text" name="taccno" class="form-control" value="<?php echo $tacc; ?>">
                <span class="help-block"><?php echo $tacc_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($am_err)) ? 'has-error' : ''; ?>">
                <label>Amount</label>
                <input type="text" name="amount" class="form-control" value="<?php echo $am; ?>">
                <span class="help-block"><?php echo $am_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="transaction">
            </div>
            <p>Go back to dashboard <a href="welcome.php">dashboard</a>.</p>
        </form>
    </div> 
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