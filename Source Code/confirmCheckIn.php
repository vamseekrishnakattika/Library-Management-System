<!DOCTYPE html>
<html lang="en">
<head>
<link href="css.css" type="text/css" rel="stylesheet"/>
<meta http-equiv="Content-Type" content="text/html" charset=UTF-8">
<title> Check Out</title>
</head>
<body>
<header>
	<h1>Library Management System</h1>
	<a href="librarymanagement.html">Home</a>
</header>
<div class="header">Check in a book</div>
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
$bookId=$_REQUEST['bookId'];
$cardNo=$_REQUEST['cardNo'];
$sql="update book_loans set date_in=current_date() where card_no=$cardNo and book_id='$bookId'; " ;
$result=mysqli_query($con,$sql);
if(mysqli_affected_rows($con)){
echo "<span class='success'>Checked in successfully</span>";
}
?>

<div class="footer">
	<h5>Copyright &copy; Vamseekrishna Kattika @ October 2017</h5>
</div>
</body>
</html>
