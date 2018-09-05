<!DOCTYPE html>
<html lang="en">
<head>
<link href="css.css" type="text/css" rel="stylesheet"/>
<meta charset="utf-8">
<title> Search Results</title>
</head>
<body>
<header>
	<h1>Library Management System</h1>
	<a href="librarymanagement.html">Home</a>
</header>
<div class="header">Borrower Management</div>
<?php 
$servername = "localhost";
$username = "root";
$password = "root";
$database = "librarymanagement";

// Create connection
$con = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$fname=$_REQUEST['fname'];
$lname=$_REQUEST['lname'];
$email=$_REQUEST['email'];
$address=$_REQUEST['address'];
$city=$_REQUEST['city'];
$state=$_REQUEST['state'];
$phone=$_REQUEST['phone'];

$sql="SELECT email,phone FROM borrower";
$result=mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0){
	while($row=mysqli_fetch_array($result)){
		$emailArr[]=$row["email"];
		$phoneArr[]=$row["phone"];
	}
}

if((!in_array($email,$emailArr))&&(!in_array($phone,$phoneArr)))
{
$sql1="INSERT INTO borrower (fname, lname,email,address,city,state,Phone) VALUES ('$fname', '$lname','$email','$address','$city','$state','$phone');";
$result1=mysqli_query($con,$sql1);
$sql2="SELECT card_no From borrower WHERE email='$email';";
$result2=mysqli_query($con,$sql2);

while($row1=mysqli_fetch_array($result2)){
		
		$newCard=$row1["card_no"];
		
	}
echo "<span class='success'>Sign up successful. New card number is ".$newCard."</span>";
}

else{
	$sql2="SELECT card_no From borrower WHERE email='$email';";
	$result2=mysqli_query($con,$sql2);

	while($row1=mysqli_fetch_array($result2)){
		
		$newCard=$row1["card_no"];
		
	}
	
	echo "<span class='fail'>Email or phone already exits with card number ".$newCard."</span>";
	
}



mysqli_close($con);
?>

<div class="footer">
	<h5>Copyright &copy; Vamseekrishna Kattika @ October 2017</h5>
</div>
</body>
</html>
