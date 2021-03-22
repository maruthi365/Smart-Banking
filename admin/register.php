<?php
$user = $ssn = $pass = $cpass = "";
$username_err= $ssn_err = $password_err = $cpassword_err = "";
require('config.php');
if(isset($_POST['sub'])){
$uname=htmlspecialchars($_POST['user']);
$pass=htmlspecialchars($_POST['pass']);
$cpass=htmlspecialchars($_POST['cpass']);
$ssn=htmlspecialchars($_POST['ssn']);
$sql = "SELECT * FROM users WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $uname);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                }
                else{
                  $sql="SELECT * FROM users where ssn=?";
                  if($stmt=mysqli_prepare($link,$sql)){
                    mysqli_stmt_bind_param($stmt,"s",$ssn);
                    if(mysqli_stmt_execute($stmt)){
                      mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt)==1){
                      $ssn_err="Account already created";
                    }
                    else{
                      if(!empty($uname)&& !empty($pass) && $pass==$cpass){
                        $sql = "INSERT INTO users (username, password,ssn) VALUES (?, ?,?)";
                        if($stmt = mysqli_prepare($link, $sql)){
                        mysqli_stmt_bind_param($stmt, "sss", $uname,$param_password ,$ssn);
                        $param_password = password_hash($pass, PASSWORD_DEFAULT);
                       if(mysqli_stmt_execute($stmt)){
                         header("location: login.php");
                          }
        
                      }
                    }
                    }
                    }
                  }
                }
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
.news{
    color: red;
  }
  body{
    font-size: 14px;
    margin-top: 10%;
    margin-left: 38%;
    margin-right:37%; 
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
    height: 35px;
    width: 250px;
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
<body class="body">
  <form action="" method="POST">
    <fieldset>
      <legend>SignUp</legend>
    <div>
      <input class="imp" type="text" id="ssn" name="ssn" placeholder="Aadhaar Number" required>
      <p style="color: red;" id="demo2"><?php echo $ssn_err?></p>
    </div>
    <div>
      <input class="imp" type="text" id="user" name="user" placeholder="Username" required>
      <p style="color: red;" id="demo"><?php echo $username_err?></p>
    </div>
    <div>
      <input class="imp" type="password" id="passw" name="pass" placeholder="Password" required>
      <p style="color: red;" id="demo1"><?php echo $password_err?></p>
    </div>
    <div>
      <input class="imp" type="password" id="cpassw" name="cpass" placeholder="Confirm Password" required>
      <p style="color: red;" id="demo3"><?php echo $cpassword_err?></p>
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<button id="ver" class="button" name="sub">Submit</button>
    <div class="divider"></div>
    <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New User Registration? <a href="New User.php">Register</a></p>
    </fieldset>
  </form>
  <script>
  document.getElementById("ssn").addEventListener("input",ssn1);
  function ssn1(){
  var x=document.getElementById("ssn").value;
  if(x.length==0){
  document.getElementById("ssn").style.borderColor="red";
  document.getElementById("demo2").innerHTML = "Aadhaar cannot be empty";
  x=document.getElementById("ver");
  x.disabled=true;
  x.style.cursor="not-allowed"; 

   }
   else if(!x.match(/^[0-9]+$/)){
   document.getElementById("ssn").style.borderColor="red";
   document.getElementById("demo2").innerHTML = "Aadhaar only consists of numbers";
   x=document.getElementById("ver");
   x.disabled=true;
   x.style.cursor="not-allowed";
   }
  else if(x.length>0 && x.length<10)
  {
   document.getElementById("ssn").style.borderColor="red";
   document.getElementById("demo2").innerHTML = "Aadhaar should be a minimum of 10 characters";
   x=document.getElementById("ver");
   x.disabled=true;
   x.style.cursor="not-allowed"; 
  }
  else{
  document.getElementById("ssn").style.borderColor="green";
  document.getElementById("demo2").innerHTML = "";
  x=document.getElementById("ver");
  var y=document.getElementById("user").value;
  var z=document.getElementById("passw").value;
  var c=document.getElementById("cpassw").value;
  if(z.length>=1 && y.length>=5 && z==c){
  x.disabled=false;
  x.style.cursor="pointer"; 
  }
}
}
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
  var y=document.getElementById("ssn").value;
  var c=document.getElementById("cpassw").value;
  if(z.length>=1 && y.length>=10 && c==z){
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
  else if(x.match(/[a-z]/g) && x.match(/[A-Z]/g) && x.match(/[0-9]/g) && x.match(/[^a-zA-Z\d]/g) && x.length>=8){
    document.getElementById("passw").style.borderColor="green";
    document.getElementById("demo1").innerHTML = "";
    var b=document.getElementById("ver");
    var z=document.getElementById("user").value;
    var y=document.getElementById("ssn").value;
    var c=document.getElementById("cpassw").value;
    if(z.length>=5 && y.length>=10 && b==c){
    b.disabled=false;
    b.style.cursor="pointer"; 
    }
   }
    else{
    document.getElementById("passw").style.borderColor="red";
    document.getElementById("demo1").innerHTML = "weak password";
    x=document.getElementById("ver");
    x.disabled=true;
    x.style.cursor="not-allowed";
  }
}
  document.getElementById("cpassw").addEventListener("input",cpasswo);
  function cpasswo(){
    var x=document.getElementById("cpassw").value;
    var c=document.getElementById("passw").value;
    if(x!=c ){
    document.getElementById("cpassw").style.borderColor="red";
    document.getElementById("demo3").innerHTML = "Password's did not match";
    x=document.getElementById("ver");
    x.disabled=true;
    x.style.cursor="not-allowed"; 
    }
    else{
  document.getElementById("cpassw").style.borderColor="green";
  document.getElementById("demo3").innerHTML = "";
  var b=document.getElementById("ver");
  var z=document.getElementById("user").value;
  var y=document.getElementById("ssn").value;
  if(z.length>=5 && y.length>=10 && x==c){
  b.disabled=false;
  b.style.cursor="pointer"; 
  }
  }
  }
</script>
</body>
</html>