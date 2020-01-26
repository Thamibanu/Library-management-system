<?php session_start(); ?>
<?php require_once('include/connection.php');?>
<?php 
//checking if a librarian is logged in
if(!isset($_SESSION['librarian_id']))
	{
	header('Location: librarianmenu.php');
	}
	
	//Check for form submission - if submit button been clicked
	
	if(isset($_POST['submit']))//submit button name
	{
	//Check if the member ID has been entered
		if(!isset($_POST['memberId']) || strlen(trim($_POST['memberId'])) < 1)//<1 no character
		{
			$errorMsg='member ID is missing or invalid';//error message
		}
	
	//check if there are any errors in the form
		if(empty($errors))//if no errors
		{
			//save memberId into variables
			$memberId = mysqli_real_escape_string($connection, $_POST['memberId']);//to prevent sql injection
			
			//prepare database query
			$query = "SELECT * FROM member
				WHERE mid = '{$memberId}'
				LIMIT 1";// limit 1 prevents errors
			$result_set = mysqli_query($connection,$query);//sends mid and pass to database to select a match
	
			if ($result_set)// if no errors
			{
				if(mysqli_num_rows($result_set) == 1) //valid member found (match)
				{
					$member=mysqli_fetch_assoc($result_set); //fetch result and store into $member
					$_SESSION['member_id']=$member['memberId']; //apply to session
					$_SESSION['memberEmail']=$member['memEmail'];
					
					if(!$result_set)//verifyQuery($result_set);//imported function
					{
						die('Database query failed');
					}
					
				//redirect to foundmember.php
					header('Location:foundmember.php');
				}
				else { 
					$errorMsg='Invalid member ID';//invalid member ID
					}
			}
			else{
				$errorMsg='database query failed';//if result set has an error
				}
	
			
		}
	}
?>
<html>
	<head>
		<title>Log In - Lowa State University</title>
		<link rel="stylesheet" type="text/css" href="CSS/main.css">
	
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
		
		h3{
			color: #f52050;}
		
		#color{
			background-color: #111;
		}

		input[type=text] {
		  background-color: white;
		  background-image: url('searchicon.png');
		  background-position: 10px 10px; 
		  background-repeat: no-repeat;
		  padding-left: 40px;
		  width: 100%;
		}

		button[type=submit] {
			  background-color: black;
			  background-position: center; 
			  background-repeat: no-repeat;
			  color: red;
			  align: center;
			  width: 50%;
		}

		input{
			width:100%;
		}

		form{
			width:60%;
			position: center;
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

		<button class="openbtn" onclick="openNav()" align="center">☰ Click Me </button>  
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
			<DIV class="loggedIn"><a href="membersdetails.php"><img src="img/back.png" alt="Cinque Terre" width="30" height="30"></a> </DIV>
		</header>
		<h3 align="center">Hi! <?php echo $_SESSION['librarian_name']; ?>, Find the member.</h3>
		
		<br><br>

		<div align="Center">
			<form action="searchmember.php" method="post">
			<fieldset>
			<legend><h1>Search</h1></legend>			
			<p>
				<label for="">Member ID:</label>
				<input type="int" name="memberId" id="" placeholder="Member ID">
			</p>
			<p>
				<button type="submit" name="submit">Search</button>
			</p>
			</fieldset>
			</form>
			
			<?php
			if(isset($errorMsg)){
			?>
				<div class="errorMsg"><?php echo $errorMsg; ?></div>
			<?php	
				}
			?>
		</div>
			
		</article>
		</section>

		
	</body>
</html>
<?php mysqli_close($connection);?>