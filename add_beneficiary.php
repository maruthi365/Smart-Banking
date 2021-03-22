<?php

include("dbconnect.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Banking Portal</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/font-awesome_5.8.1.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/stylesheet.css">
    <style></style>
    <style type="text/css">
    body{
     font: 14px sans-serif;
     text-align: center;
     margin: 0; 
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
    .contact-section{
    background: white url("images/image5.jpeg") no-repeat bottom;
    padding: 20px;
}
.contact-article{
    width: 250px;
    text-align: center;
    margin: auto;
    background-color: rgba(0,0,0,0.5);
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0 0 10px black;
}
.contact-article h2{
    color: white;
}
.input-field{
    font-size: 18px;
    text-align: center;
    border: none;
    outline: none;
    margin: 5px;
    height: 35px;
    width: 200px;
    background: transparent;
    border-bottom: 3px solid #514640;
    color: white;
}
textarea{
    border: 3px solid #514640;
    outline: none;
    background: transparent;
    margin: 5px;
    border-radius: 10px;
    width: 180px;
}
textarea:focus{
    border: 3px solid #bca487;
}
::placeholder{
    color: lightgray;
}
.input-field:focus{
    border-bottom: 3px solid #bca487;
}
#submit-btn{
    background-color: #514640;
    color: white;
    border: none;
    font-size: 18px;
    padding: 10px 50px;
    box-shadow: 0 0 10px black;
    border-radius: 50px;
    margin: 10px;
    outline: none;
}
#submit-btn:hover{
    background-color: #bca487;
    color: black;
    cursor: pointer;
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
<?php
$servername = "localhost";
$username="root";
$password="";
$dbname="beneficiary";
$name="";
$Aadhar_Number="";
$account_no="";
$branch_name="";
$ifsc_code="";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

//connect to mysql database
try{
    $conn =mysqli_connect($servername,$username,$password,$dbname);
}catch(MySQLi_Sql_Exception $ex){
    echo("error in connecting");
}
//get data from the form
function getData()
{
    $data = array();

    $data[1]=$_POST['name'];
    $data[2]=$_POST['Aadhar_Number'];
    $data[3]=$_POST['account_no'];
    $data[4]=$_POST['branch_name'];
    $data[5]=$_POST['ifsc_code'];
    return $data;
}
//search
if(isset($_POST['search']))
{
    $info = getData();
    $search_query="SELECT * FROM user WHERE id = '$info[0]'";
    $search_result=mysqli_query($conn, $search_query);
        if($search_result)
        {
            if(mysqli_num_rows($search_result))
            {
                while($rows = mysqli_fetch_array($search_result))
                {
                    $data[1]=$_POST['name'];
                    $data[2]=$_POST['Aadhar_Number'];
                    $data[3]=$_POST['account_no'];
                    $data[4]=$_POST['branch_name'];
                    $data[5]=$_POST['ifsc_code'];
                }
            }else{
                echo("no data are available");
            }
        } else{
            echo("result error");
        }

}
//insert
if(isset($_POST['insert'])){
    $info = getData();
    $insert_query="INSERT INTO `add_beneficiary`(`name`, `Aadhar_Number`, `account_no`, 'branch_name', 'ifsc_code') VALUES ('$info[1]','$info[2]','$info[3]','$info[4]','$info[5]')";
    try{
        $insert_result=mysqli_query($conn, $insert_query);
        if($insert_result)
        {
            if(mysqli_affected_rows($conn)>0){
                header("location: welcome.php");

            }else{
                echo("data are not inserted");
            }
        }
    }catch(Exception $ex){
        echo("error inserted".$ex->getMessage());
    }
}
//delete
if(isset($_POST['delete'])){
    $info = getData();
    $delete_query = "DELETE FROM `user` WHERE id = '$info[0]'";
    try{
        $delete_result = mysqli_query($conn, $delete_query);
        if($delete_result){
            if(mysqli_affected_rows($conn)>0)
            {
                echo("data deleted");
            }else{
                echo("data not deleted");
            }
        }
    }catch(Exception $ex){
        echo("error in delete".$ex->getMessage());
    }
}
?>
<body>
 <header class="main-header">
    <h1 class="animated slideInRight">Banking Portal</h1>
</header>
      <nav class="main-nav">
    <div class="animated slideInLeft">
        <a href="welcome.php" >
            <i class="fa fa-home"></i> Dashboard</a>
        <a href="add_beneficiary.php" class="active">
            <i class="fas fa-history"></i> Beneficiary</a>
    </div>
</nav>
<section class="contact-section">
    <article class="contact-article animated jackInTheBox">
         
              <h2>Add_Beneficiary</h2>
        <form class="contact-form" action="add_beneficiary_process.php" method="POST">
            <input type="text" class="input-field" name="name" placeholder="Payee Name">
            <br>
            <input type="number" class="input-field" name="Aadhar_Number" placeholder="Aadhar Number">
            <br>
            <input type="number" class="input-field" name="account_no" placeholder="Account No">
            <br>
            <input type="text" class="input-field" name="branch_name" placeholder="Branch">
            <br>
            <input type="text" class="input-field" name="ifsc_code" placeholder="Ifsc Code">
            <br>
            <input type="submit" name="submit" value="send request" id="submit-btn">
        </form>
    </article>
</section>
<footer class="main-footer">
    <h3>Copyright &copy; 2020 , Smart Banking</h3>
    <p>All Rights Reserved</p>
    <p>Developed & Maintained by
        <a href="" target="_blank">
            <i class="fa fa-users"></i> Banking Ltd.
        </a>
    </p>
</footer>
</body>
</html>