<?php 
 error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <script src="bootstrap/bootstrap.min.js"></script>
    <title>Online Job Application Form</title>
    <style type="text/css">
        body{
    background-image: url("images/background1.jpg");
    color: white;
    font-family: "Comic Sans MS",sans-serif;
    background-attachment: fixed;
}
h1{
    font-family: "Old English Text MT",sans-serif;
    text-align: center;
    font-size: 35px;
    text-shadow: 0 0 5px red;
}
fieldset{
    border: 2px solid white;
    background-color: rgba(0,0,0,0.5);
    padding: 15px;
    margin: 15px;
    border-top-right-radius: 20px;
    border-bottom-left-radius: 20px;
    box-shadow: 0 0 10px black;
    width: 600px;
}
legend{
    background-image: url("images/background2.jpg");
    font-family: "Old English Text MT",sans-serif;
    font-size: 18px;
    padding: 14px 25px;
    border: 2px solid white;
    border-top-right-radius: 20px;
    border-bottom-left-radius: 20px;
}
table{
    width: 100%;
}
td{
    font-size: 18px;
    padding: 5px;
}
input[type='text'],
input[type='number'],
input[type='date'],
input[type='month'],
input[type='time']{
    font-size: 18px;
    height: 35px;
    border: none;
    outline: none;
    border-radius: 5px;
}
textarea{
    border: none;
    outline: none;
    width: 200px;
    border-radius: 5px;
}
input[type='text']:focus,
input[type='number']:focus,
input[type='date']:focus,
input[type='month']:focus,
input[type='time']:focus,
textarea:focus{
    box-shadow: 0 0 10px red;
    background-color: #cca886;
}
select{
    font-size: 18px;
    height: 35px;
    width: 210px;
    border: none;
    outline: none;
    border-radius: 5px;
}
.button{
    color: white;
    background-image: url("images/background2.jpg");
    font-family: "Old English Text MT",sans-serif;
    font-size: 20px;
    padding: 12px 55px;
    border: 2px solid white;
    border-top-left-radius: 20px;
    border-bottom-right-radius: 20px;
    outline: none;
}
.button:hover{
    box-shadow: 0 0 10px white;
}
    </style>
</head>
<body>

    <!-- Online Job Application Form -->
    <form action="?" method="POST" enctype="multipart/form-data">
    <div>
        <h1>Smart Banking Application Form</h1>
        <form>
            <fieldset>
                <legend>Other Details</legend>
                <table>
                     <tr>
                         <td>Aadhar Card</td>
                        <td>
                            <input type="file"  name="uploadfile2" required="">
                        </td>
                        
                    </tr>
                    <tr>
                        <td>PANCARD</td>
                        <td>
                            <input type="file" name="uploadfile" required="">
                    </tr>
                    <tr>
                        <td colspan="5">
                            <input type="checkbox" required>
                            <span>I am here declaring that all the above mentioned information is true as per my knowledge.</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                          <input type="submit" onclick="myFunction()" colspan="2" value="Submit" class="button">
                       <a href="logout.php"<button type="submit" name="back" class="btn btn-lg btn-info btn-block">Go Back</button></a> 
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </div>  
</form>
</body>
</html>
<?php 
$filename = $_FILES["uploadfile"] ["name"];
$tempname = $_FILES["uploadfile"] ["tmp_name"];
$folder="uploads/".$filename;
move_uploaded_file($tempname, $folder);
 ?>
 <?php 
$filename = $_FILES["uploadfile2"] ["name"];
$tempname = $_FILES["uploadfile2"] ["tmp_name"];
$folder="uploads/".$filename;
move_uploaded_file($tempname, $folder);
 ?>
