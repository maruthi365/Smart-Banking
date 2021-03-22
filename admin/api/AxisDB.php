<?php
class AxisDB{
public function Print($ssn){
$link = mysqli_connect('localhost','root', '', 'axis');
$sql="SELECT * FROM account Where ssn=$ssn";
 $result = mysqli_query($link, $sql);
 while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>Axis</td>";
                echo "<td>" . $row['accno'] . "</td>";
                echo "<td>" . $row['balance'] . "</td>";
            echo "</tr>";
        }
        mysqli_free_result($result);
        mysqli_close($link);
 }
public function Lis($ssn){
$link = mysqli_connect('localhost','root', '', 'axis');
$sql="SELECT accno FROM account Where ssn=$ssn";
 $result = mysqli_query($link, $sql);
 while($row = mysqli_fetch_array($result)){
            echo "<option>";
                echo $row['accno'];
            echo "</option>";
        }
        mysqli_free_result($result);
        mysqli_close($link);
 }
public function dep($amount,$acc){
	$link = mysqli_connect('localhost','root', '', 'axis');
    $sql = "UPDATE account set balance=balance+$amount where accno=$acc";
    if(mysqli_query($link,$sql)){
                $_SESSION["dep"] = true;
                mysqli_close($link);
            } else{
                echo "Something went wrong. Please try again later.";
            }
  
}
public function wd($amount,$acc){
	$link = mysqli_connect('localhost','root', '', 'axis');
    $sql = "UPDATE account set balance=balance-$amount where accno=$acc";
    if(mysqli_query($link,$sql)){
                $_SESSION["wd"] = true;
                mysqli_close($link);
            } else{
                echo "Something went wrong. Please try again later.";
            }
  
}
public function check($amount,$acc){
	$link = mysqli_connect('localhost','root', '', 'axis');
    $sql = "SELECT balance FROM account where accno=$acc";
    if($stmt = mysqli_query($link, $sql)){
                
                if(mysqli_num_rows($stmt) > 0){
                	while($row = mysqli_fetch_array($stmt)){

                	if($row['balance']<=$amount)
                	{
                	$am_err = "Enter valid amount less than ".$row['balance'];
                	return $am_err;
                	}

              }
             return 1;
             }
             else{
             	return 0;
             }
            }
}
public function tan($account){
    $link= mysqli_connect('localhost','root','','axis');
    $sql="SELECT accno FROM account";
    if($stmt=mysqli_query($link,$sql)){
    while($row=mysqli_fetch_array($stmt)){
        if($row['accno']==$account)
        {
            return 1;
        }
    }

}
return 0;
}
public function tto($amount,$acc){
    if($_SESSION['tfrom']==true){
    $link = mysqli_connect('localhost','root', '', 'axis');
    $sql="SELECT accno,balance from account";
    if($stmt=mysqli_query($link,$sql)){
        while($row=mysqli_fetch_array($stmt)){
            if($row['accno']==$acc){
                    $sql1 = "UPDATE account set balance=balance+$amount where accno=$acc";
                    if(mysqli_query($link,$sql1)){
                    $_SESSION["tto"] = true;   
            }
        }
    }
    mysqli_close($link); 
}
}
}
public function tfrom($amount,$acc){
    $link = mysqli_connect('localhost','root', '', 'axis');
    $sql="SELECT accno,balance from account";
    if($stmt=mysqli_query($link,$sql)){
        while($row=mysqli_fetch_array($stmt)){
            if($row['accno']==$acc){
                if($row['balance']>=$amount)
                {
                    $sql1 = "UPDATE account set balance=balance-$amount where accno=$acc";
                    if(mysqli_query($link,$sql1)){
                    $_SESSION["tfrom"] = true;         
                }
            }
        }
    }
  mysqli_close($link);   
}
}
}
?>