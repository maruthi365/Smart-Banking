<?php
include('config.php');

$id=$_GET['id'];
if($id=="")
{
echo '<script>alert("Sorry ! Wrong Entry") </script>' ;
		header("Location: requests.php");


}

else{
$view="DELETE FROM `smash` WHERE id ='$id' ";
echo "$view";
	if($result = mysqli_query($conn,$view))
	{
		 echo "$re";
		echo '<script>alert("News Letter Subscriber Remove") </script>' ;
		header("Location: welcome.php");
	}


}


?>