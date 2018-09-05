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
<div class="header">Search Books</div>
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
$sql= "select distinct b.book_id,b.title,bl.date_in,bl.date_out from book b JOIN book_authors ba ON b.book_id=ba.isbn JOIN authors a ON ba.author_id=a.author_id
 left join book_loans bl on (b.book_id=bl.book_id and bl.date_in is null) where b.book_id like '%$q%' or b.title like '%$q%' or a.name like '%$q%' group by book_id ;";
$result=mysqli_query($con,$sql);

if (mysqli_num_rows($result) > 0){
	echo "<br/>";
 echo "<table border='1'>
 	<tr><th>ISBN</th>
	<th>Title</th>	
	<th>Author(s)</th>
	<th>Avalability</th></tr>";

  while($row = mysqli_fetch_array($result)) 
	  
  {   	
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
		if(!($row["date_out"])||($row["date_out"]!=null && $row["date_in"]!=null  ))
			echo "<tr><td>".$row["book_id"]."</td><td>".$row["title"]."</td><td>".$name."</td><td>Available</td></tr>";
		else
			echo "<tr><td>".$row["book_id"]."</td><td>".$row["title"]."</td><td>".$name."</td><td>Not Available</td></tr>";
  }
  echo "</table>";
}
else
	echo "<span class='fail'>No results found with the given details</span>";
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
