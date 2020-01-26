<?php session_start(); ?>
<?php require_once('include/connection.php');?>
<html>
<head>
<title>Librarian Menu </title>
<link rel="stylesheet" type="text/css" href="CSS/stylemenu.css">

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

		<button class="openbtn" onclick="openNav()" align="center">☰ Click Me <?php echo $_SESSION['librarian_name']; ?></button>  
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
	 
			 <h6 align="center">Hi! <div id="a"><?php echo $_SESSION['librarian_name']; ?></div> 
			 Welcome to your page...</h6>
			
			
		</article>
		</section>

	 
	</body>

</html>