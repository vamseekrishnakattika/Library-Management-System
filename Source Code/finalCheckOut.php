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
$bookId=$_SESSION['bookId'];
$cardNo=$_POST['cardId'];

$query=mysqli_query($con,"select card_no from borrower where card_no=$cardNo;");
if(mysqli_num_rows($query)==0){
	echo "<span class='fail'>Borrower doesn't exist. Please Sign Up</span>";
}
else{

$sql="select count(*) as count from book_loans where date_in is null and card_no=$cardNo group by card_no; ";
$result=mysqli_query($con,$sql);

if(mysqli_num_rows($result)>0){
	while($row=mysqli_fetch_array($result))
		$num=$row["count"];
	}
if($num>2){
	
	echo "<span class='fail'>The borrower has reached the limit of 3 books. Please return any book and check out a new book</span>";
}
else{
	
$sql1="select date_out,date_in from book_loans where book_id='$bookId'; ";
$result1=mysqli_query($con,$sql1);

if(mysqli_num_rows($result1)>0){
while($row1=mysqli_fetch_array($result1)){
	$date_out=$row1["date_out"];
	$date_in=$row1["date_in"];
	
	}
	
	if(!($date_in)){
		echo "<span class='fail'>The book requested has already been checked out</span>";	
	}
	else{
	
	$sql2="INSERT INTO BOOK_LOANS(book_id,card_no,date_out,due_date,date_in) VALUES('$bookId','$cardNo',current_date(),date_add(current_date(), interval 14 day), NULL);";
	$result2=mysqli_query($con,$sql2);
	echo "<span class='success'>Checked out successfully</span>";
}
}
else{
	
	$sql2="INSERT INTO BOOK_LOANS(book_id,card_no,date_out,due_date,date_in) VALUES('$bookId','$cardNo',current_date(),date_add(current_date(), interval 14 day), NULL);";
	$result2=mysqli_query($con,$sql2);
	echo "<span class='success'>Checked out successfully</span>";
}



}
}
?>

<div class="footer">
	<h5>Copyright &copy; Vamseekrishna Kattika @ October 2017</h5>
</div>
</body>
</html>
