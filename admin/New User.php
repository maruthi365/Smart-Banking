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
//insert
if(isset($_POST['insert'])){
	$info = getData();
	$insert_query="INSERT INTO `smash`(`name`, `fname`, `email`, `phone`,`state`,`qualification`,`branch`,`rollno`,`gender`,`birth`) VALUES ('$info[1]','$info[2]','$info[3]','$info[4]','$info[5]','$info[6]','$info[7]','$info[8]','$info[9]','$info[10]')";
	try{
		$insert_result=mysqli_query($conn, $insert_query);
		if($insert_result)
		{
			if(mysqli_affected_rows($conn)>0){
				header("location: uploadfiles.php");

			}else{
				echo("data are not inserted");
			}
		}
	}catch(Exception $ex){
		echo("error inserted".$ex->getMessage());
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
      <a class="navbar-brand" href="Welcome.php">Smart Banking</a>
    </div>
     <div class="collapse navbar-collapse" id="nav">
    <ul class="nav navbar-nav">
      <li class="active"><a href="studentform.php"> New Customer</a></li>
      <li><a href="updatestudentdata.php">Update User Data </a></li>
    </ul>
  </div>
</div>
</nav>
      </div>
	<div class="container-fluid">
	  <div class="row">
	    <div class="col-lg-4">

<form method ="post"   action="">
	<h1>ID Number (Use to Search Student data)</h1>
  <input type="number" name="id"  class="form-control" placeholder="ID No. /Automatic Number Genrates" value="<?php echo($id);?>" disabled>
	<div class="form-group row">
	<div class="col-xs-6">
		<h1>Name</h1>
	<input type="text" name="name" class="form-control" placeholder="Enter Student Name" value="<?php echo($name);?>" required>
</div>
<div class="col-xs-6">
	<h1>Father Name</h1>
	<input type="text" name="fname" class="form-control" placeholder="Enter Father Name" value="<?php echo($fname);?>" required>
</div>
</div>
<h1>Email</h1>
	<input type="email" name="email" class="form-control" placeholder="Enter Email" value="<?php echo($email);?>" required>
	<h1>Phone (10-digit)</h1>
	<input type="tel" pattern="^\d{10}$" class="form-control" name="phone"  placeholder="10 digit Phone number" value="<?php echo($phone);?>">
	<div class="form-group row">
	<div class="col-xs-6">
		<h1>Select State</h1>
  <select name="state" class="form-control" value="<?php echo($state);?>">
    <option value="JAMMU and KASHMIR">JAMMU and KASHMIR</option>
    <option value="HIMACHAL PRADESH">HIMACHAL PRADESH</option>
    <option value="PUNJAB">PUNJAB</option>
    <option value="UTTARAKHAND">UTTARAKHAND</option>
    <option value="HARYANA">HARYANA</option>
    <option value="UTTAR PRADESH">UTTAR PRADESH</option>
      <option value="RAJASTHAN">RAJASTHAN</option>
      <option value="GUJRAT">GUJRAT</option>
      <option value="MADHYA PRADESH">MADHYA PRADESH</option>
      <option value="BIHAR">BIHAR</option>
      <option value="JHARKHAND">JHARKHAND</option>
      <option value="GANGTOK">GANGTOK</option>
        <option value="KOLKATA">KOLKATA</option>
        <option value="ARUNACHAL PRADESH">ARUNACHAL PRADESH</option>
        <option value="ASSAM">ASSAM</option>
        <option value="MEGHALAYA">MEGHALAYA</option>
        <option value="NAGALAND">NAGALAND</option>
        <option value="MANIPUR">MANIPUR</option>
          <option value="MIZORAM">MIZORAM</option>
          <option value="AIZAWL">AIZAWL</option>
          <option value="AGARTALA">AGARTALA</option>
          <option value="CHHATTISGARH">CHHATTISGARH</option>
          <option value="MAHARASHTRA">MAHARASHTRA</option>
          <option value="ODISHA">ODISHA</option>
          <option value="GOA">GOA</option>
          <option value="KARNATAKA">KARNATAKA</option>
          <option value="ANDHARA PRADESH">ANDHARA PRADESH</option>
          <option value="KERALA">KERALA</option>
          <option value="TAMIL NADU"></option>

  </select>
</div>
<div class="col-xs-6">
	<h1>Qualification</h1>
<select name="qualification" class="form-control" value="<?php echo($qualification);?>">
    <option value="10th with above 75%">10th with above 75%</option>
    <option value="+2 with above 75%">+2 with above 75%</option>
    <option value="10th %age between 50% to 75%">10th %age between 50% to 75%</option>
    <option value="+2 %age between 50% to 75%">+2 %age between 50% to 75%</option>
  </select>
</div>
</div>
<div class="form-group row">
<div class="col-xs-6">
	<h1>Aadhar Number</h1>
  <input type="number" class="form-control" name="branch" placeholder="Aadhar Number" max="10000000000" value="<?php echo($Aadhar);?>" required>
</div>
<div class="col-xs-6">
	<h1>Pancard Number</h1>
  <input type="number" class="form-control" name="rollno" placeholder="Pancard Number" value="<?php echo($Pancard);?>" required>
</div>
</div>
<div class="form-group row">
<div class="col-xs-6">
	<h1>Gender</h1>
  <select name="gender" class="form-control" value="<?php echo($gender);?>">
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>
</div>
<div class="col-xs-6">
	<h1>Select Birth Year</h1>
 <select name="birth" class="form-control">
      <option value="1999">Year</option>
      <option>1999</option>
      <option>1998</option>
			<option>1997</option>
      <option>1996</option>
			<option>1995</option>
      <option>1994</option>
			<option>1993</option>
      <option>1992</option>
			<option>1991</option>
			<option>1990</option>
    </select>
</div>

</div>
	<div>
		<input type="submit" class="btn btn-success btn-block btn-lg" name="insert" value="Next">
	</div>
	<br>
</form>
</div>
</div>
</div>
</body>
</html>

