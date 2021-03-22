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
      th{
    text-align: center;
    padding: 15px;
}
td{
    padding: 2px;
}
        body{
         font: 14px sans-serif; 
        text-align: center; 
        padding: 0px;
        margin: 0px;
        height: 100%;
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
  .pagewrapper{
    height: 100%;
  }
  fieldset{
    border: 2px solid white;
    background-color: white;
    padding: 5px 10px;
    margin: px;
    border-radius: 5px;
    box-shadow: 0 0 10px black;
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
            <li><a href="register.php">
            <i class="fa fa-user-plus"></i> User Registration</a></li>
            <li> <a href="requests.php">
          <i class="fa fa-paper-plane"></i> Users Requests</a></li>
          <li><a href="mailto:p.maruthi365@gmail.com?subject=Reg:Login Details">
            <i class="fa fa-envelope"></i> Mail</a></li>
       <li> <a href="deposit.php">
          <i class="fas fa-rupee-sign"></i> Deposit</a></li>
            <li><a href="contact.php">
            <i class="fa fa-phone"></i> Contact Us</a></li>
            <li><a href="reset-password.php"  class="reset-password">
            <i class="fas fa-key"></i> Reset password</a></li>
            <li><a href="logout.php" class="logout">
            <i class="fas fa-sign-out-alt"></i> Logout</a></li>
            <li class="maruthi"><a href=""><i class="fas fa-user"></i> 
              <?php echo htmlspecialchars($_SESSION["username"]);?> 
              <i class="" style="font-size: .8em"></i></a>
              <div class="sub-menu-1">
          <ul>
        </ul>
        </div>
    </li>
 </ul>
</div>
</nav>
</head>
<body class="pagewrapper">
  <div>
  <div class="news"><marquee behavior="alternate"><b>WELCOME ADMIN(SMART BANKING)</b></marquee></div>
  <div class="header">    
  <head>
  <div>
    <fieldset>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hack";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id,name,fname,email,phone,state,qualification,branch,rollno,gender,birth FROM smash";
$result = $conn->query($sql);

echo "<table border='1'>
<tr>
<th>Search ID</th>
<th>Name</th>
<th>Father Name</th>
<th>Email</th>
<th>Phone</th>
<th>State</th>
<th>Qualification</th>
<th>branch</th>
<th>roll no</th>
<th>gender</th>
<th>birth</th>
<th>Delete</th>

</tr>";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      echo "<tr>";
echo "<td>" . $row['id'] . "</td>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['fname'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['phone'] . "</td>";
echo "<td>" . $row['state'] . "</td>";
echo "<td>" . $row['qualification'] . "</td>";
echo "<td>" . $row['branch'] . "</td>";
echo "<td>" . $row['rollno'] . "</td>";
echo "<td>" . $row['gender'] . "</td>";
echo "<td>" . $row['birth'] . "</td>";
echo "<td><a href='deleteusers.php?id=$row[id]'><button class='btn btn-secondary btn-sm'> <i class='fa fa-edit' ></i> Delete </button></td></td>";

echo "</tr>";


    }
} else {
    echo "0 results";
}

$conn->close();
?>
</fieldset>
  </div>
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<script src="layout/scripts/jquery.placeholder.min.js"></script>
</body>
</html>
