<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Student Forms</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"  href="bootstrap/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
<script src="bootstrap/bootstrap.min.js"></script>
<style>
body{
    font-family: Courgette;
}
.submit{
  background-color: purple;
  color:white;
  text-size:24px;
  padding: 6px;
  border-radius: 5px;
  border:1px solid white;
  font-size: 24px;
}
.submit:hover{
  background-color: white;
  color: purple;
  box-shadow: 0px 0px 20px white;
}
h1{
	font-size: 14px;
}

td,th{
  padding: 4px;
  text-align: center;
}
</style>
</head>
<?php
$servername = "localhost";
$username="root";
$password="";
$dbname="hack";
$id="";
$name="";
$fname="";
$email="";
$phone="";
$state="";
$qualification="";
$branch="";
$rollno="";
$gender="";
$birth="birth";

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
	$data[2]=$_POST['fname'];
	$data[3]=$_POST['email'];
	$data[4]=$_POST['phone'];
  $data[5]=$_POST['state'];
  $data[6]=$_POST['qualification'];
  $data[7]=$_POST['branch'];
  $data[8]=$_POST['rollno'];
  $data[9]=$_POST['gender'];
	$data[10]=$_POST['birth'];
	return $data;
}
//search
if(isset($_POST['search']))
{
	$info = getData();
	$search_query="SELECT * FROM smash WHERE id = '$info[0]'";
	$search_result=mysqli_query($conn, $search_query);
		if($search_result)
		{
			if(mysqli_num_rows($search_result))
			{
				while($rows = mysqli_fetch_array($search_result))
				{
					$id = $rows['id'];
					$name = $rows['name'];
					$fname = $rows['fname'];
					$email = $rows['email'];
					$phone = $rows['phone'];
          $state = $rows['state'];
          $qualification = $rows['qualification'];
          $branch = $rows['branch'];
          $rollno = $rows['rollno'];
          $gender = $rows['gender'];
					$birth = $rows['birth'];

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
	$insert_query="INSERT INTO `smash`(`name`, `fname`, `email`, `phone`,`state`,`qualification`,`branch`,`rollno`,`gender`,`birth`) VALUES ('$info[1]','$info[2]','$info[3]','$info[4]','$info[5]','$info[6]','$info[7]','$info[8]','$info[9]','$info[10]')";
	try{
		$insert_result=mysqli_query($conn, $insert_query);
		if($insert_result)
		{
			if(mysqli_affected_rows($conn)>0){
				echo("data inserted successfully");

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
	$delete_query = "DELETE FROM `smash` WHERE id = '$info[0]'";
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
//edit
if(isset($_POST['update'])){
	$info = getData();
	$update_query="UPDATE `smash` SET `name`='$info[1]',fname='$info[2]',email='$info[3]',phone='$info[4]',state='$info[5]',qualification='$info[6]',branch='$info[7]',rollno='$info[8]',rollno='$info[9]',birth='$info[10]' WHERE id = '$info[0]'";
	try{
		$update_result=mysqli_query($conn, $update_query);
		if($update_result){
			if(mysqli_affected_rows($conn)>0){
				echo("data updated");
			}else{
				echo("data not updated");
			}
		}
	}catch(Exception $ex){
		echo("error in update".$ex->getMessage());
	}
}

?>
<body>
	<div class="container-fliud">
        <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav">
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
     </button>
      <a class="navbar-brand" href="welcome.php">Smart Banking System</a>
    </div>
     <div class="collapse navbar-collapse" id="nav">
    <ul class="nav navbar-nav">
      <li class="active"><a href="">User Data</a></li>
      <li><a href="New User.php">New User</a></li>
      <li><a href="updatestudentdata.php">Update User Data </a></li>
    </ul>
  </div>
</div>
</nav>
</div>
<div class="col-lg-8">
<h2>Users Data</h2>
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

echo "</tr>";


    }
} else {
    echo "0 results";
}

$conn->close();
?>
</div>
</div>
</body>
</html>
