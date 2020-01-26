<?php session_start(); ?>
<?php require_once('include/connection.php');?>
<?php
//checking if a member is logged in
if(!isset($_SESSION['member_id']))
	{
	header('Location: membermenu.php');
	}

	$book_list='';
	//getting the list of books
	$query="SELECT * FROM book WHERE isDeleted=0 ORDER BY title";//is delete 1 means deleted or 0 means not deleted
	$books=mysqli_query($connection, $query);
	if($books)
	{
		while($book = mysqli_fetch_assoc($books)) //$book = 1 record
		{
			$book_list .="<tr>";
			$book_list .="<td>{$book['isbn']}</td>";
			$book_list .="<td>{$book['lid']}</td>";
			$book_list .="<td>{$book['title']}</td>";
			$book_list .="<td>{$book['category']}</td>";
			$book_list .="<td>{$book['author']}</td>";
			$book_list .="<td>{$book['publisher']}</td>";
			$book_list .="<td>{$book['price']}</td>";
			$book_list .="<td>{$book['available']}</td>";
			$book_list .="<td><a href=bookstore.php><button>Reserve</button></td>";
			$book_list .="</tr>";
		}
	}
	else
	{
		echo "Database query failed"; //query failed
	}
	
?>

<html>
	<head>
		<title>Book Store</title>
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
			  font-size: 25px;
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

		h3{
					color: #f52050;}
				
				#color{
					background-color: #111;
				}


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
</style>
		
</head>

	<body>
	
	<section>
		  <nav>

		<!-- Menue Start --------------------------->
		
		<div id="mySidepanel" class="sidepanel">
		  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
		  <a href="myprofile.php">My Profile</a>
		  <!-- <a href="editmyprofile.php">Edit My Profile</a> -->
		  <a href="bookstore.php">View Book</a>
		  <a href="searchbookstore.php">Search Book</a>
		  <a href="logout.php">Log out</a>
		</div>

		<button class="openbtn" onclick="openNav()" align="center">☰ Click Me <?php echo $_SESSION['first_name']; ?> </button>  
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
			<DIV class="loggedIn"><a href="membermenu.php"><img src="img/back.png" alt="Cinque Terre" width="30" height="30"></a> </DIV>
		</header>
		<h3 align="center">Hi! <?php echo $_SESSION['first_name']; ?>, This is your library book store.</h3>
		<br><br>
		
		<h1 align="center">Book Store</h1>
		
		<link rel="stylesheet" type="text/css" href="css/main.css">
		
		<main>
				
		<table>
			<tr>
				<th>ISBN</th>
				<th>LID</th>
				<th>Title</th>
				<th>Category</th>
				<th>Author</th>
				<th>Publisher</th>
				<th>Price</th>
				<th>Availability</th>
				<th>Reserve</th>
			</tr>
			
			<?php echo $book_list; ?>
		</table>
		</main>
		
		</article>
				
				
	</body>
</html>