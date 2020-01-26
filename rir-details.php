<?php session_start(); ?>
<?php require_once('include/connection.php');?>
<?php 
//cheaking if a member in logged in
if(!isset($_SESSION['librarian_id']))
	{
	header('Location: librarianmenu.php');
	}
///////////////////////////////////////////////////////////////////////////////	
	$rir_list='';
	//getting the list of members
	$query="SELECT * FROM reserveissuereturn WHERE isDeleted=0 ORDER BY mid";//is delete 1-deleted or 0-not
	$rirs=mysqli_query($connection, $query);
	if($rirs)
	{
		while($rir = mysqli_fetch_assoc($rirs)) //$rir = 1 record
		{
			$rir_list .="<tr>";
			$rir_list .="<td>{$rir['mid']}</td>";
			$rir_list .="<td>{$rir['isbn']}</td>";
			$rir_list .="<td>{$rir['reserveDate']}</td>";
			$rir_list .="<td>{$rir['issueDate']}</td>";
			$rir_list .="<td>{$rir['returnDate']}</td>";
			$rir_list .="<td>{$rir['dueDate']}</td>";
			$rir_list .="<td><a href=\"update-rir-details.php?rir_id={$rir['mid']}\">Edit</a></td>";
			$rir_list .="<td><a href=\"delete-rir-details.php?rir_id={$rir['mid']}\"onclick=\"return confirm('Are you sure?');\">Delete</a></td>";
			$rir_list .="</tr>";
		}
	}
	else
	{
		echo "Database query failed";
	}
	
?>
<html>
	<head>
		<title>Reserve, Issue and Return Details</title>
		<link rel="stylesheet" type="text/css" href="CSS/main.css">
<script language="Javascript">
function deleteask(){
  if (confirm('Are you sure you want to logout?')){
    return true;
  }else{
    return false;
  }
}
</script>	
<style>
h1{font-family: "Footlight MT Light",Helvetica,Arial,sans-serif;
    font-size: 50px;
	color: #0a0a0a;}
h2{font-family: "Footlight MT Light",Helvetica,Arial,sans-serif;
font-size: 25px;
color: #ac1010;}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #3f3f3f;
  color: white;
}

</style>
			
	</head>
	<body>
	
	<header>
			<DIV class="appName"><h2>Lowa State University Library<h2></DIV>
			<DIV class="loggedIn"><a href="librarianmenu.php"><img src="img/back.png" alt="Cinque Terre" width="30" height="30"></a> &nbsp;&nbsp; <a href="logout.php"onclick="return deleteask();"><img src="img/logout.png" alt="Cinque Terre" width="30" height="30"></a></DIV>
		</header>
		<h3 align="center">Hi! <?php echo $_SESSION['librarian_name']; ?>, This is book reserve, issues and return informaition.</h3>
		<br><br>
		
		<h1 align="center">Reserve, Issue and Return Details</h1>
	
	<p align="center"><span><a href='search-rir-details.php'><img src="img/search.png" alt="Cinque Terre" width="30" height="30"></a>
		&nbsp;&nbsp;<a href='add-rir-details.php'><img src="img/data.png" alt="Cinque Terre" width="30" height="30"></a>
		&nbsp;&nbsp;<a href='calculate-fine.php'><img src="img/cal.png" alt="Cinque Terre" width="30" height="30"></a>
		</span></p>
		<link rel="stylesheet" type="text/css" href="css/main.css">
	
	
		<main>
		
		<table>
			<tr>
				<th>Member ID</th>
				<th>ISBN</th>
				<th>Reserve Date</th>
				<th>Issue Date</th>
				<th>Return Date</th>
				<th>Due Date</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			
			<?php echo $rir_list; ?>
		</table>
		</main>
				
	</body>
	
</html>