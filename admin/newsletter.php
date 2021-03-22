<?php

include ('dbconnect1.php');
$id = $_GET['id'];
$approval ="Allowed";
$napproval="Not Allowed";

$view="select * from userrequest where id = '$id' ";
$re = mysqli_query($db_connect,$view);
while ($row=mysqli_fetch_array($re))
{
	$id =$row['approval'];

}

if($id=="Not Allowed")
{
	$sql ="UPDATE `` SET `approval`= '$approval' WHERE id = '$id' ";
	if(mysqli_query($db_connect,$sql))
	{
		echo '<script>alert("New Room Added") </script>' ;
		header("Location: requests.php");
	}
}
else {
$sql ="UPDATE `userrequest` SET `approval`= '$napproval' WHERE id = '$id' ";
	if(mysqli_query($db_connect,$sql))
	{
		echo '<script>alert("New Room Added") </script>' ;
		header("Location: requests.php");
	}



}
?>