<?php
require_once "config.php";
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaction History</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <style type="text/css">
        body{ font: 14px sans-serif;
        text-align: center;
        background: white; }
        .wrapper{ width: 1500px; padding: 20px; }
        .wrapper1{ width: 300px; padding: 20px; }
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
        <li><a href="t_history.php" class="active">
            <i class="fas fa-history"></i> Transaction History</a></li>
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
                <label>Account number</label>
                <select class="form-control" name="accno">
                <?php
                require_once ('api/SbiDB.php');
                require_once ('api/AxisDB.php');
                require_once('api/KotakDB.php');
                $s=$_SESSION['ssn'];
                $db=new SbiDB();
                $db->Lis($s);
                $db=new AxisDB();
                $db->Lis($s);
                $db1=new KotakDB();
                $db1->Lis($s); 
                ?>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="History">
            </div>
            <p>Go back to <a href="welcome.php">dashboard</a>.</p>
        </form>
        <?php
            require_once "config.php";
            $acc="";
            if($_SERVER["REQUEST_METHOD"] == "POST"){
            $acc=trim($_POST['accno']);
            $sql = "SELECT * from transaction where tto=$acc or tfrom=$acc";
            if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result) > 0){
            echo "<div class='container'><div class='table-responsive'><table class='table'>";
            echo "<tr>";
            echo "<td>Account number</td>";
            echo "<td>To Account number</td>";
            echo "<td>Amount</td>";
            echo "</tr>";
            while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>" . $row['tfrom'] . "</td>";
            echo "<td>" . $row['tto'] . "</td>";
            echo "<td>" . $row['amount'] . "</td>";
            echo "</tr>";
            }
            echo "</table></div></div></div>";
            mysqli_free_result($result);
            } 
            }
            mysqli_close($link);
            }
        ?>
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