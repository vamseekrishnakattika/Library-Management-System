<!DOCTYPE html>
<html lang="en">
<head>
<link href="css.css" type="text/css" rel="stylesheet"/>
<meta charset="utf-8">
<title>Check In</title>
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

$query=$_REQUEST['search'];

$sql="select bl.book_id,bl.card_no,concat(b.fname,' ',b.lname) as name from book_loans bl join borrower b on (b.card_no=bl.card_no) 
where bl.date_in is null and (bl.book_id like '%$query%' or bl.card_no like '%$query%' or b.fname like '%$query%' or b.lname like '%$query%'); ";
$result=mysqli_query($con,$sql);
if (mysqli_num_rows($result) == 0){
	echo "<span class='fail'>No results found with the given details</span>";
}
else{

echo "<form action='confirmCheckIn.php' method='post'>
<br/>
 <table border='1'>
 	<tr><th>Book ID</th>
	<th>Card No</th>	
	<th>Name</th>
	<th>Check In</th>
	</tr>" ;
  while($row = mysqli_fetch_array($result)) 
  { 
	$book=$row["book_id"];
	$card=$row["card_no"];
	echo "<tr><td>".$row["book_id"]."</td><td>".$row["card_no"]."</td><td>".$row["name"]."
</td><td><input type='radio' name='bookId' value='$book' onclick='this.form.submit()'/><input type='hidden' name='cardNo' value='$card'/></td></tr>";
  
  }
 echo "</table>";
echo "</form>";
}
mysqli_close($con);
?>

<br/>
<br/>
<br/>
<br/>
<div class="footer">
	<h5>Copyright &copy; Vamseekrishna Kattika @ October 2017</h5>
</div>
</body>
</html>
