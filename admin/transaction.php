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
    $db=new AxisDB();
    $db1=new KotakDB();
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
        $_SESSION['tto']=$_SESSION['tfrom']="";
        $db->tfrom($am,$acc);
        $db1->tfrom($am,$acc);
        $db->tto($am,$tacc);
        $db1->tto($am,$tacc);
        if($_SESSION['tto']==true && $_SESSION['tfrom']==true){
        $link = mysqli_connect('localhost','root', '', '');
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Account number</label>
                <select class="form-control" name="accno">
                <?php
                require_once ('api/AxisDB.php');
                require_once('api/KotakDB.php');
                $s=$_SESSION['ssn'];
                $db=new AxisDB();
                $db->Lis($s);
                $db1=new KotakDB();
                $db1->Lis($s); 
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
</body>
</html>