<?php session_start(); ?>
<?php require_once('include/connection.php');?>
<?php 
//checking if a member is logged in
if(!isset($_SESSION['member_id']))
	{
	header('Location: membermenu.php');
	}
	//Check for form submission - if submit button been clicked
	if(isset($_POST['submit']))//submit button name
	{
	//Check if the category have been entered
		if(!isset($_POST['category']) || strlen(trim($_POST['category'])) < 1)//<1 no character
		{
			$errorMsg='Category is missing or invalid';//error
		}
	//check if there are any errors in the form
	
		if(empty($errors))//if no errors
		{
			//save Category in to variables
			$category = mysqli_real_escape_string($connection, $_POST['category']);//to prevent sql injection
			
			//prepare database query
			$query = "SELECT * FROM book
				WHERE category = '{$category}'
				LIMIT 1";// limit 1 prevents errors
			$result_set = mysqli_query($connection,$query);//sends category and pass to database to select a match
	
			if ($result_set)// if no errors
			{
				if(mysqli_num_rows($result_set) == 1) //valid book found (match)
				{
					$book=mysqli_fetch_assoc($result_set); //Save category in $book
					$_SESSION['category']=$book['category']; //apply to session
					
					if(!$result_set)//varifyQuery($result_set);//imported function
					{
						die('Database query failed');
					}
					
				//redirect to foundbook.php
					header('Location:foundbook.php');
				}
				else { 
					$errorMsg='Invalid Book category'; //Error message if invalid book category
					}
			}
			else{
				$errorMsg='Database query failed';//if result set has an error
				}
		}
	}
?>
<html>
	<head>
		<title>Log In - Lowa State University</title>
		<link rel="stylesheet" type="text/css" href="CSS/main.css">
	</head>
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
			width:60%;
		}

		form{
			width:60%;
			position: center;
		}


</style>
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

	
		<header id="color" >
			<DIV class="appName"><h2>Lowa State University Library<h2></DIV>
			<DIV class="loggedIn"><a href="bookstore.php"><img src="img/back.png" alt="Cinque Terre" width="30" height="30"></a> </DIV>
		</header>
		<h3 align="center">Hi! <?php echo $_SESSION['first_name']; ?>, This is your library book store.</h3>
		<br><br>

		<div class = "input" align="center">
			<form action="searchbookstore.php" method="post" >
			<fieldset>
			<legend><h1>Search</h1></legend>
			<br>			
			<p>
				<label for="">Book Category:</label>
				<input type="text" name="category" id="" placeholder="Category">
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

	</body>
</html>
<?php mysqli_close($connection);?>