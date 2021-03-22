<?php

include("dbconnect1.php");

$name=$_REQUEST['name'];
$email=$_REQUEST['email'];
$phone=$_REQUEST['phone'];
$aadhar=$_REQUEST['aadhar'];
$accountnumber=$_REQUEST['accountnumber'];
$message=$_REQUEST['message'];

$quer=mysqli_query($db_connect, "INSERT INTO userrequest(name,email,phone,aadhar,accountnumber,message) VALUES('$name','$email','$phone','$aadhar','$accountnumber','$message')") or die(mysqli_error($db_connect));

mysqli_connect($db_connect);

header("location:welcome.php?note=success");


?>