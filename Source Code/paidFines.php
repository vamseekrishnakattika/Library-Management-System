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

$sql="select bl.card_no,SUM(fine_amt) as fine, concat(bw.fname,' ',bw.lname) as name  from fines f join book_loans bl ON f.loan_id=bl.loan_id join borrower bw on bl.card_no=bw.card_no where f.paid=1 group by card_no;";
$result=mysqli_query($con,$sql);

if(mysqli_num_rows($result)>0){
echo "<br/>";
echo "<table>
<th>Name</th>
<th>Card No</th>
<th>Fine</th>";
while ($row=mysqli_fetch_array($result)){
	echo "<tr><td>".$row["name"]."</td><td>".$row["card_no"]."</td><td>".$row["fine"]."</td></tr>";
}
echo "</table>";
}
else{
	echo "<span class='fail'>No results found</span>";
}
mysqli_close($con);
?>
<br/>

<div class="footer">
	<h5>Copyright &copy; Vamseekrishna Kattika @ October 2017</h5>
</div>
</body>
</html>
