<?php session_start(); ?>
<?php require_once('include/connection.php');?>
<?php
//checking if a librarian in logged in
if(!isset($_SESSION['librarian_id']))
	{
	header('Location: librarianmenu.php');
	}
	$librarian_list='';
	//getting the list of librarians
	$query="SELECT * FROM librarian WHERE isDeleted=0 ORDER BY lid";//is delete 1-deleted or 0-not
	$librarians=mysqli_query($connection, $query);
	if($librarians)
	{
		while($librarian = mysqli_fetch_assoc($librarians)) //$librarian = 1 record
		{
			$librarian_list .="<tr>";
			$librarian_list .="<td>{$librarian['lid']}</td>";
			$librarian_list .="<td>{$librarian['libEmail']}</td>";
			$librarian_list .="<td>{$librarian['libName']}</td>";
			$librarian_list .="<td>{$librarian['lastLogin']}</td>";
			$librarian_list .="<td><a href=\"modifylibrarian.php?librarian_id={$librarian['lid']}\">Edit</a></td>";
			$librarian_list .="<td><a href=\"delete-librarian.php?librarian_id={$librarian['lid']}\"onclick=\"return confirm('Are you sure?');\">Delete</a></td>";
			$librarian_list .="</tr>";
		}
	}
	else
	{
		echo "Database query failed";
	}
	
?>
<html>
	<head>
		<title>Librarians Details</title>
		<link rel="stylesheet" type="text/css" href="CSS/main.css">	
		
<!-- Javascript code for logout confirmation -->
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

		/* webpage Layouts ------------------------------------*/
		* {
		  box-sizing: border-box;
		}

		body {
		  font-family: Arial, Helvetica, sans-serif;
		}

		/* Create two columns/boxes that floats next to each other */
		nav {
		  float: left;
		  width: 20%;
		  height: 100%; /* only for demonstration, should be removed */
		  background: #111;
		  padding: 20px;
		}
		
		
		/* Style the list inside the menu */
		nav ul {
		  list-style-type: none;
		  padding: 0;
		}

		article {
		  float: left;
		  padding: 20px;
		  width: 80%;
		  background-color: white;
		  height: 100%; /* only for demonstration, should be removed */
		}
		
		

		/* Clear floats after the columns */
		section:after {
		  content: "";
		  display: table;
		  clear: both;
		}

		/* Responsive layout - makes the two columns/boxes stack on top of each other instead of next to each other, on small screens */
		@media (max-width: 600px) {
		  nav, article {
			width: 50%;
			height: auto;
		  }
		}
		
		/* menu --------------------------------------------------------------*/
			body {
			  font-family: "Lato", sans-serif;
			}

			.sidepanel  {
			  width: 0;
			  position: fixed;
			  z-index: 1;
			  height: 100%;
			  top: 0;
			  left: 0;
			  background-color: #111;
			  overflow-x: hidden;
			  transition: 0.4s;
			  padding-top: 60px;
			}

			.sidepanel a {
			  padding: 8px 8px 8px 32px;
			  text-decoration: none;
			  font-size: 16px;
			  color: #818181;
			  display: block;
			  transition: 0.3s;
			}

			.sidepanel a:hover {
			  color: red;
			}

			.sidepanel .closebtn {
			  position: absolute;
			  top: 0;
			  right: 25px;
			  font-size: 36px;
			}

			.openbtn {
			  font-size: 20px;
			  cursor: pointer;
			  background-color: #111;
			  color: white;
			  padding: 10px 15px;
			  border: none;
			}

			.openbtn:hover {
			  background-color:#444;
			}
			
			h6{font-family: "Footlight MT Light",Helvetica,Arial,sans-serif;
				font-size: 60px;
				color: #0a0a0a;
			}
						
			h5{font-family: "Footlight MT Light",Helvetica,Arial,sans-serif;
				font-size: 40px;
				color: #0a0a0a;
				text-align: center;
			}
			
			#a{
				font-family: Calibri Light;
				color: red;
			}
			
			/* other styles -----------------------------------------------------*/

h1{font-family: "Footlight MT Light",Helvetica,Arial,sans-serif;
    font-size: 50px;
	color: #111;}
h2{font-family: "Malgun Gothic Semilight";
font-size: 25px;
color: #fff;}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #a3a3a3}

th {
  background-color: #111;
  color: red;
}

#color{
	background-color: #111;
}
}
</style>

	</head>
	<body>
			<section>
		  <nav>

		<!-- Menue Start --------------------------->
		
		<div id="mySidepanel" class="sidepanel">
		  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
		  <a href="librariansdetails.php">Librarion Profile</a>
		  <a href="searchlibrarian.php">Search Librarian</a> 
		  <a href="addlibrarian.php">Add New Librarian</a>
		  
		  <a href="membersdetails.php">Member Details</a>
		  <a href="searchmember.php">Search Member</a>
		  <a href="addmember.php">Add New Member</a>
		  
		  <a href="booksdetails.php">Book Details</a>
		  <a href="searchbook.php">Search Book</a>
		  <a href="addbooks.php">Add New Book</a>
		  
		  <a href="rir-details.php">Reserve Issue & Return Details</a>
		  <a href="search-rir-details.php">Search Book Reservation</a>
		  <a href="add-rir-details.php">Add Book Reservation Details</a>
		  <a href="calculate-fine.php">Fine Calculate</a>
		  
		  <a href="logout.php">Log out</a>
		</div>

		<button class="openbtn" onclick="openNav()" >☰ Click Me</button>  
		<!-- <h2 align="center">^^^</h2>
		<h2 align="center">Select Your Option</h2> -->
		
		<script>
		function openNav() {
		  document.getElementById("mySidepanel").style.width = "250px";
		}

		function closeNav() {
		  document.getElementById("mySidepanel").style.width = "0";
		}
		</script>
		
		</nav>
		<!-- Menue End --------------------------->
		<article>
	<header id="color">
			<DIV class="appName"><h2>Lowa State University Library<h2></DIV>
			<DIV class="loggedIn"><a href="librarianmenu.php"><img src="img/back.png" alt="Cinque Terre" width="30" height="30"></a></DIV>
	</header>
	<br>
	
		<h1 align="center">Hi! <?php echo $_SESSION['librarian_name']; ?>, This is your details.</h1>
		<br><br>
	
	
		<main>
		
		<table>
			<tr>
				<th>Librarian ID</th>
				<th>Librarian Email</th>
				<th>Librarian Name</th>
				<th>Last Login</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			
			<?php echo $librarian_list; ?>
		</table>
			</main>
		</article>
	</body>
</html>