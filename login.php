<?php
session_start();
$_SESSION['LAST_ACTIVE_TIME']=time();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: welcome.php");
  exit;
}
$username_err="";
$password_err="";
require_once('config.php');
if(isset($_POST['sub'])){
$uname=htmlspecialchars($_POST['user']);
$pass=htmlspecialchars($_POST['pass']);
if(!empty($uname)&& !empty($pass)){
  $sql = "SELECT ssn, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = $uname;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $ssn, $uname, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($pass, $hashed_password)){
                          session_start();
                         $_SESSION['loggedin']=true;
                         $_SESSION['username']=$uname;
                         $_SESSION['ssn']=$ssn;
                         $_SESSION['trans']="";
                         $_SESSION['wd']="";
                         $_SESSION['dep']="";
                         $_SESSION['tto']="";
                         $_SESSION['tfrom']="";
                        header("location:welcome.php");
                        } else{
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
}
}
?>
<!DOCTYPE html>
<html>
<head>
</div>
<style>
  .news{
    color: red;
  }
  body{
    font-size: 14px;
    margin-top: 10%;
    margin-left: 40%;
    margin-right:40%; 
    margin-bottom: 5%;
    background-image: url("images/background1.jpg");
    color: white;
    font-family: "Comic Sans MS",sans-serif;
    background-attachment: fixed;
  }
 .button{
    color: white;
    background-image: url("images/background2.jpg");
    font-family: "Old English Text MT",sans-serif;
    font-size: 14px;
    padding: 10px 30px;
    border: 1px solid white;
    border-radius: 5px;
    outline: none;
    cursor: pointer;
}
.button:hover{
    box-shadow: 0 0 10px white;
}
 .imp{
  border:1px solid #C1B7AA;
  border-radius: 4.5px;
  width: 220px;
  height: 30px;
 }
 .divider{
    border-bottom: 2px solid white;
    padding: 7px;
}
input[type='text'],
input[type='password']
{
    font-size: 18px;
    height: 45px;
    border: none;
    outline: none;
    border-radius: 5px;
}
textarea{
    border: 3px solid #514640;
    outline: none;
    background: transparent;
    width: 210px;
    border-radius: 5px;
}
input[type='text']:focus,
input[type='password']:focus,
textarea:focus{
    box-shadow: 0 0 10px red;
    background-color: #cca886;
}
::placeholder{
    text-decoration: bold;
}
 legend{
    background-image: url("images/background2.jpg");
    font-family: "Old English Text MT",sans-serif;
    font-size: 18px;
    padding: 12px 30px;
    border: 2px solid white;
    border-top-right-radius: 20px;
    border-bottom-left-radius: 20px;
  }
  fieldset{
    border: 2px solid white;
    background-color: rgba(0,0,0,0.5);
    padding: 15px 20px;
    margin: 15px;
    border-top-right-radius: 20px;
    border-bottom-left-radius: 20px;
    box-shadow: 0 0 10px black;
}
a{
  color: white;
  text-decoration: none;
  color: skyblue;
}
a:hover {
  text-decoration: none;
  color: #a64bf4;
}
</style>
</head>
<body>
  <div class="loginbox-right">
  <form action="" method="POST">
    <fieldset action="" method="POST">
    <legend>Login</legend>
    <div class="news"><marquee behavior="alternate"><b>Please Login Here</b></marquee></div>
    <div>
      <input class="imp" type="text" id="user" name="user" placeholder="Username" required>
      <p style="color: red;" id="demo"><?php echo $username_err?></p>
    </div>
    <div>
      <input class="imp" type="password" id="passw" placeholder="Password" name="pass" required>
      <p style="color: red;" id="demo1"><?php echo $password_err?></p>
    </div>
    <div id="remember" class="checkbox" required>
    <label>
    <input type="checkbox" value="remember-me" name="rememberme" id="rememberme" onclick="return unSetCookie();" > Remember me</label>&nbsp;&nbsp;&nbsp;
    </div>
    <br>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <button id="ver" class="button" name="sub">Login</button><br>
    <div class="divider"></div>
    <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Not a member? <a href="studentform.php">Register</a></p>
    </fieldset>
  </form>
  </div>
  <script>
  document.getElementById("user").addEventListener("input",usrname);
  function usrname(){
  var x=document.getElementById("user").value;
  if(x.length==0){
  document.getElementById("user").style.borderColor="red";
  document.getElementById("demo").innerHTML = "The username cannot be empty";
  x=document.getElementById("ver");
  x.disabled=true;
  x.style.cursor="not-allowed"; 

   }
  else if(x.length>0 && x.length<5)
  {
   document.getElementById("user").style.borderColor="red";
   document.getElementById("demo").innerHTML = "The username should be a minimum of 5 characters";
   x=document.getElementById("ver");
   x.disabled=true;
   x.style.cursor="not-allowed"; 
  }
  else{
  document.getElementById("user").style.borderColor="green";
  document.getElementById("demo").innerHTML = "";
  x=document.getElementById("ver");
  var z=document.getElementById("passw").value;
  if(z.length>=1){
  x.disabled=false;
  x.style.cursor="pointer"; 
  }
}
}
  document.getElementById("passw").addEventListener("input",passwo);
  function passwo(){
    var x=document.getElementById("passw").value;
    if(x.length==0){
    document.getElementById("passw").style.borderColor="red";
    document.getElementById("demo1").innerHTML = "Password cannot be empty";
    x=document.getElementById("ver");
    x.disabled=true;
    x.style.cursor="not-allowed"; 
    }
    else{
  document.getElementById("passw").style.borderColor="green";
  document.getElementById("demo1").innerHTML = "";
  x=document.getElementById("ver");
  var z=document.getElementById("user").value;
  if(z.length>=5){
  x.disabled=false;
  x.style.cursor="pointer"; 
  }
  }
  }
</script>
</body>
</html>