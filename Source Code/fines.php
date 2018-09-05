<!DOCTYPE html>
<html lang="en">
<head>
<link href="css.css" type="text/css" rel="stylesheet"/>
<meta http-equiv="Content-Type" content="text/html" charset=UTF-8">
<title> Search Results</title>
</head>
<body>
<header>
	<h1>Library Management System</h1>
	<a href="librarymanagement.html">Home</a>
</header>
<div class="header">Update Fines</div>
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

$sql="select loan_id,TIMESTAMPDIFF(Day, due_date,date_in)*0.25 as fine from book_loans where current_date>due_date and date_in is not null; ";
$result=mysqli_query($con,$sql);

if(mysqli_num_rows($result)>0){
	
	while($row=mysqli_fetch_array($result)){
		$loan=$row["loan_id"];
		$fine=$row["fine"];
		$sql1="select loan_id from fines where loan_id=$loan;";
		$result1=mysqli_query($con,$sql1);
		if(mysqli_num_rows($result1)>0)	{
			$sql2="update fines set fine_amt=$fine where loan_id=$loan and paid=0;";
			$result2=mysqli_query($con,$sql2);
		}
		else{
			$sql3="insert into fines (fine_amt,loan_id) values('$fine','$loan');";
			$result3=mysqli_query($con,$sql3);			
		}

	}
	echo "<span class='success'>Fines for each record have been updated</span>";
	
}

$sql4="select loan_id, TIMESTAMPDIFF(Day, due_date,current_date)*0.25 as fine from book_loans where current_date > due_date and date_in is null;";
$result4=mysqli_query($con,$sql4);
if(mysqli_num_rows($result4)>0){
		while($row2=mysqli_fetch_array($result4)){
		$loan=$row2["loan_id"];
		$fine=$row2["fine"];
		
		$sql5="select loan_id from fines where loan_id=$loan;";
		$result5=mysqli_query($con,$sql5);
		if(mysqli_num_rows($result5)>0)	{
			
			$sql6="update fines set fine_amt=$fine where loan_id=$loan and paid=0;";
			$result6=mysqli_query($con,$sql6);
		}
		else{
			
			$sql7="insert into fines (fine_amt,loan_id) values('$fine','$loan');";
			$result7=mysqli_query($con,$sql7);			
		}

	}
	echo "<span class='success'>Fines for each record have been updated</span>";
	
}
if(mysqli_num_rows($result)==0 && mysqli_num_rows($result4)==0){
	echo "<span class='fail'>There is nothing to update</span>";
}

mysqli_close($con);
?>
</table>
<br/>
<br/>
<br/>
<br/>
<div class="footer">
	<h5>Copyright &copy; Vamseekrishna Kattika @ October 2017</h5>
</div>
</body>
</html>
