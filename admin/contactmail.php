<?php

include("dbconnect.php");

$name=$_REQUEST['name'];
$email=$_REQUEST['email'];
$subject=$_REQUEST['subject'];
$message=$_REQUEST['message'];

$quer=mysqli_query($db_connect, "INSERT INTO user(name,email,subject,message) VALUES('$name','$email','$subject','$message')") or die(mysqli_error($db_connect));

mysqli_connect($db_connect);

header("location:contact.php?note=success");


?>