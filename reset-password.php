<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    if(empty($new_password_err) && empty($confirm_password_err)){
        $sql = "UPDATE users SET password = ? WHERE ssn =".$_SESSION['ssn'];
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_password);
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            if(mysqli_stmt_execute($stmt)){
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
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
        <li><a href="reset-password.php" class="active">
            <i class="fas fa-key"></i> Reset password</a></li>
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
    <div class="wrapper">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link" href="welcome.php">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>