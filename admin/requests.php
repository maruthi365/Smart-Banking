<?php
include("dbconnect1.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Banking Portal</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/font-awesome_5.8.1.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <style></style>
    <style type="text/css">
        tr{
            margin-right: 30px;
        }
        .float{
            float: left;
        }
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
.table-responsive{
    float: left;
    margin-top: 0px;
    margin-left: 15px;
}
th{
    text-align: center;
    padding: 10px;
    font-size: 15px;
    font-weight: bold;
}
td{
    padding: 5px;
    width: 400px;
}
 fieldset{
    border: 2px solid white;
    background-color: white;
    padding: 15px 20px;
    margin: 15px;
    border-radius: 5px;
    box-shadow: 0 0 10px black;
}
</style>
</head>
<?php
$servername = "localhost";
$username="root";
$password="";
$dbname="banking";
$id="";
$name="";
$email="";
$phone="";
$aadhar="";
$accountnumber="";
$message="";

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
    $data[7]=$_POST['id'];
    $data[1]=$_POST['name'];
    $data[2]=$_POST['email'];
    $data[3]=$_POST['phone'];
    $data[4]=$_POST['aadhar'];
    $data[5]=$_POST['accountnumber'];
    $data[6]=$_POST['message'];
    return $data;
}
//search
if(isset($_POST['search']))
{
    $info = getData();
    $search_query="SELECT * FROM userrequest WHERE id = '$info[0]'";
    $search_result=mysqli_query($conn, $search_query);
        if($search_result)
        {
            if(mysqli_num_rows($search_result))
            {
                while($rows = mysqli_fetch_array($search_result))
                {
                    $data[7]=$_POST['id'];
                    $data[1]=$_POST['name'];
                    $data[2]=$_POST['email'];
                    $data[3]=$_POST['phone'];
                    $data[4]=$_POST['aadhar'];
                    $data[5]=$_POST['accountnumber'];
                    $data[6]=$_POST['message'];
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
    $insert_query="INSERT INTO `userrequest`('id', `name`, `email`, `phone`, 'aadhar', 'accountnumber', `message`) VALUES ('$info[1]','$info[2]','$info[3]','$info[4]',,'$info[5]','$info[6]','$info[7]')";
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
    $delete_query = "DELETE FROM `userrequest` WHERE id = '$info[0]'";
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
            <a href="requests.php" class="active">
          <i class="fas fa-rupee-sign"></i> Users Requests</a>
          <a href="request_beneficiary.php">
          <i class="fas fa-rupee-sign"></i> Beneficiary Request</a>   
    </div>
</nav>
<?php
$connection=mysqli_connect("localhost","root","");
$db=mysqli_select_db($connection,'banking');
error_reporting(0);

if (isset($_POST['delete'])) 
{

$id=$_POST['id'];
$query = "DELETE FROM 'userrequest' WHERE id = '$id' ";

$query_run=mysqli_query($connection,$query);

if($query_run)
{
    echo "Record Deleted";
}
else{
    echo "Failed to delete";
}
}
?>
   <div class="panel-body">
                            <div class="panel-group" id="accordion">
                            
                            <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            <button class="btn btn-default" type="button">
                                                 Deposit Requests  <span class="badge"><?php echo $c ; ?></span>
                                            </button>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse in" style="height: auto;">
                                        <div class="panel-body">
                                           <div class="panel panel-default">
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                               <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "banking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id,name,email,phone,aadhar,accountnumber,message FROM userrequest";
$result = $conn->query($sql);
echo "<table border='0'>
<tr>
<th> Id </th>
<th> Name </th>
<th> Email </th>
<th> Mobile Number </th>
<th> Aadhar Number </th>
<th> Account Number </th>
<th> Text Field </th>
<th> Approval </th>
<th> Remove </th>
</tr>";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      echo "<tr>";
      echo "<td>" . $row['id'] . "</td>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['phone'] . "</td>";
echo "<td>" . $row['aadhar'] . "</td>";
echo "<td>" . $row['accountnumber'] . "</td>";
echo "<td>" . $row['message'] . "</td>";
echo "<td><a href='newsletter.php?id=$row[id]'><button class='btn btn-primary'> <i class='fa fa-edit' ></i> Permission</button></td></td>";
echo "<td><a href='deleterequests.php?id=$row[id]'><button class='btn btn-danger'> <i class='fa fa-edit' ></i> Delete </button></td></td>";
echo "</tr>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
                                        
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
 <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
</body>
</html>