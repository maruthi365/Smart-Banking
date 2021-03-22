<?php
require_once "config.php";
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;

}
require_once "config.php";
$acc=$acc_err= $am=$am_err="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
   $acc=trim($_POST['accno']);
   require_once ('api/AxisDB.php');
    require_once('api/KotakDB.php');
    $db=new AxisDB();
    $db1=new KotakDB();
    if(empty(trim($_POST["accno"]))){
        $acc_err = "Please enter account number";
    } 
    elseif(trim($_POST["accno"])==$acc){
        $acc_err="Invalid transaction";        
        }
    else{
        $acc=trim($_POST["accno"]);
        $x=$db->tan($acc);
        if($x==0){
           $y=$db1->tan($acc);
           if($y==0)
            $acc_err="Account doesnot exist";
        }
    }
    if(empty(trim($_POST["amount"]))){
        $am_err = "Please enter amount";
       }
    elseif(trim($_POST["amount"])<=0)
    {
    	$am_err="please enter valid amount";
    } 
    else{
       $am=trim($_POST["amount"]);
       } 
if( empty($am_err)){
    require_once ('api/SbiDB.php');
    require_once ('api/AxisDB.php');
    require_once('api/KotakDB.php');
    $db2=new SbiDB();
    $db=new AxisDB();
    $db1=new KotakDB();            
    $db->dep($am,$acc);
    $db1->dep($am,$acc);
    $db2->dep($am,$acc);
    if($_SESSION["dep"]==true)
        header("location: welcome.php");
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deposit</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
        .main-header{
   background: white url("images/image5.jpeg") no-repeat scroll center;
    padding: 12px;
    color: white;
    text-align: right;
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
.main-nav a{
    color: white;
    text-decoration: none;
    padding: 10px 25px;
    display: inline-block;
}
.main-nav a:hover{
    background-color: #964e40;
}
.main-nav a.active{
    background-color: darkred;
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
    </style>
</head>
<body>
      <header class="main-header">
    <h1 class="animated slideInRight">Banking Portal</h1>
</header>
      <nav class="main-nav">
    <div class="animated slideInLeft">
        <a href="welcome.php" >
            <i class="fa fa-home"></i> Dashboard</a>
        <a href="deposit.php" class="active">
          <i class="fas fa-rupee-sign"></i> Deposit</a>
    </div>
</nav>
    <div class="wrapper">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($acc_err)) ? 'has-error' : ''; ?>">
                <label>Account number</label>
                <input type="text" name="accno" class="form-control" value="<?php echo $acc; ?>">
                <span class="help-block"><?php echo $acc_err; ?></span>
            </div>   
            <div class="form-group <?php echo (!empty($am_err)) ? 'has-error' : ''; ?>">
                <label>Amount</label>
                <input type="text" name="amount" class="form-control" value="<?php echo $am; ?>">
                <span class="help-block"><?php echo $am_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Deposit">
            </div>
            <p>Go back to <a href="welcome.php">dashboard</a>.</p>
        </form>
    </div>  
         <br>
     <br><br><br><br><br>
     <br><br>&nbsp;
<footer class="main-footer">
    <h3>Copyright &copy; 2020 , Banking Portal</h3>
    <p>All Rights Reserved</p>
    <p>Developed & Maintained by
        <a href="https://github.com/thenaveensaggam" target="_blank">
            <i class="fa fa-users"></i> Banking Ltd.
        </a>
    </p>
</footer>  
</body>
</html>