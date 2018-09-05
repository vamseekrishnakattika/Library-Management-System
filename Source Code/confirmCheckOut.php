<?php
session_start();
?>
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
<div class="header">Check out a book</div>
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
$q=$_REQUEST['bookId'];
$_SESSION['bookId']=$q;
session_write_close();
?>

<div id="menu">
	<form action="finalCheckOut.php" method="post">
		Enter Card No:<input type="text" name="cardId" placeholder="Enter Card No"/>
		<input type="submit" value="submit">
	</form>
</div>
<div class="footer">
	<h5>Copyright &copy; Vamseekrishna Kattika @ October 2017</h5>
</div>
</body>
</html>
