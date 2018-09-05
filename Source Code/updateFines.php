<!DOCTYPE html>
<html lang="en">
<head>
<link href="css.css" type="text/css" rel="stylesheet"/>
<meta http-equiv="Content-Type" content="text/html" charset=UTF-8">
<title>Payment of Fines</title>
<style type="text/css">
table{
	width: 25%;
	margin-left: 550px;
	margin-right: 500px;
}

</style>
</head>
<body>
<header>
	<h1>Library Management System</h1>
	<a href="librarymanagement.html">Home</a>
</header>
<div class="header">Pay Fines</div>
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

$card=$_POST["cardNo"];

$sql="select loan_id from book_loans where card_no=$card and date_in is not null;";
$result=mysqli_query($con,$sql);

if(mysqli_num_rows($result)>0){
	while($row=mysqli_fetch_array($result)){
	$loan=$row["loan_id"];
	$result1=mysqli_query($con,"update fines set paid=1 where loan_id=$loan ;");
	if(mysqli_affected_rows($con)){
			echo "<span class='success'>Payment successful</span>";
		}
	}
}
else{
	echo "<span class='fail'>Unable to pay</span>";
}
mysqli_close($con);
?>
<br/>

<div class="footer">
	<h5>Copyright &copy; Vamseekrishna Kattika @ October 2017</h5>
</div>
</body>
</html>
