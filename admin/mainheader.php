<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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
          <ul>
        </ul>
        </div>
    </li>
 </ul>
</div>
</nav>
</head>
</body>
</html>