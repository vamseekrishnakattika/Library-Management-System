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
$q=$_REQUEST['search'];
$sql= "select distinct b.book_id,b.title,a.name from book b JOIN book_authors ba ON b.book_id=ba.isbn JOIN authors a ON ba.author_id=a.author_id
 where b.book_id like '%$q%' or b.title like '%$q%' or a.name like '%$q%' group by book_id ;";
$result=mysqli_query($con,$sql);



if (mysqli_num_rows($result) == 0){
	echo "<span class='fail'>No results found with the given details</span>";
}
else{
	echo "<form action='confirmCheckOut.php' method='post'>
	</br>
	<table border='1'>
 	<tr><th>ISBN</th>
	<th>Title</th>	
	<th>Author(s)</th>
	<th>CheckOut</th>
	</tr> ";

  while($row = mysqli_fetch_array($result)) 
	{   
		$val=$row["book_id"];
		$isbn=$row["book_id"];
		$sql2="select distinct author_id from book_authors where isbn='$isbn';";
		$result2=mysqli_query($con,$sql2);
		$name="";
			while($row2=mysqli_fetch_array($result2)){
				
				$author=$row2["author_id"];
				$sql3="select distinct name from authors where author_id='$author';";
				$result3=mysqli_query($con,$sql3);
				
				while($row3=mysqli_fetch_array($result3)){
					$name=$name.$row3["name"].", ";
				}
				
			}
			$name=rtrim($name,', ');
	echo "<tr><td>".$row['book_id']."</td><td>".$row['title']."</td><td>".$name."
</td><td><input type='radio' name='bookId' value='$val' onclick='this.form.submit()'/></td></tr>";
  
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
