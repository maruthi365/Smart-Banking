<?php
include('dbconnect1.php');

$id=$_GET['id'];
if($id=="")
{
echo '<script>alert("Sorry ! Wrong Entry") </script>' ;
		header("Location: requests.php");


}

else{
$view="DELETE FROM `userrequest` WHERE id ='$id' ";
echo "$view";
	if($re = mysqli_query($db_connect,$view))
	{
		 echo "$re";
		echo '<script>alert("News Letter Subscriber Remove") </script>' ;
		header("Location: requests.php");
	}


}


?>