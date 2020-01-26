<?php session_start(); ?>
<?php require_once('include/connection.php');?>
<?php require_once('include/functions.php');?>

<?php
if(!isset($_SESSION['librarian_id'])) 
	{
	header('Location: librarianmenu.php');
	}
$errors=array(); //to save errors in the form
//Keep entered data in fields after making an error
//variables empty at the start
$librarianEmail='';
$librarianName='';
if (isset($_POST['submit']))//checking the click event of the submit button
{
	$librarianEmail=$_POST['librarianEmail']; //assign field value to variables
	$librarianName=$_POST['librarianName'];
	
	//Passingfield status in to a function
	$req_fields=array('librarianEmail','librarianPassword','librarianName');
	
	//checkRequiredFields($req_fields)//function created in functions.php
	$errors=array_merge($errors,checkRequiredFields($req_fields));
	
	//check number of characters in the field
	$max_len_fields=array('librarianPassword'=>30,'librarianName'=>50);
	$errors=array_merge($errors,checkMaxLen($max_len_fields));//$errors array merging
	
	//checking for librarianEmail duplicates
	$librarianEmail=mysqli_real_escape_string($connection,$_POST['librarianEmail']);
	$query="SELECT* FROM librarian WHERE libEmail='{$librarianEmail}' LIMIT 1";
	$resultSet=mysqli_query($connection,$query);
	
	if($resultSet) //if query is successful
	{
		if(mysqli_num_rows($resultSet)==1) //if found similar email in the table
		{
			$errors[]='email address already exists';
		}
	}
	//insert data
	if(empty($errors)) //if array is empty
	{
		$librarianPassword=mysqli_real_escape_string($connection,$_POST['librarianPassword']); //sanitizing
		$librarianName=mysqli_real_escape_string($connection,$_POST['librarianName']); //sanitizing
		// $hashedPassword=sha1(librarianPassword);
		
		$query="INSERT INTO librarian (libEmail,libPassword,libName,isDeleted)";
		$query.="VALUE('{$librarianEmail}','{$librarianPassword}','{$librarianName}','0')";
		$result=mysqli_query($connection,$query);
		if($result)
		{
			header('Location: librariansdetails.php?user_added=true '); //query successfull
		}
		else
		{
			echo "failed to add a new record";// query failed
		}
	}
}
?>
	

<html>
	<head>
		<title>Add New Librarian</title>
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
		
		h3{
			color: #f52050;}
		
		#color{
			background-color: #111;
		}

	input[type=text] {
	  background-color: white;
	  background-position: 10px 10px; 
	  background-repeat: no-repeat;

	}
	
	button[type=submit] {
	  background-color: black;
	  background-position: center; 
	  background-repeat: no-repeat;
	  color: red;
	  align: right;
	  
	}
	
	input{
		width:100%;
	}

	form{
		width:100%;
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
			<DIV class="loggedIn"><a href="librariansdetails.php"><img src="img/back.png" alt="Cinque Terre" width="30" height="30"></a> </DIV>
		</header>
		<h3 align="center">Hi! <?php echo $_SESSION['librarian_name']; ?>, Add new librarian.</h3>
		<br><br>
		<h1 align="center">Add New Librarian</h1><br><br>
	
		<main>
		<?php
		if(!empty($errors))
		{
			displayErrors($errors); //calling for the function & passing the errors array 
		}
		?>
		
		<form action="addlibrarian.php" method="POST" class="memberForm">
			<p>
				<label for="">Librarian Email: </label>
				<input type="email" name="librarianEmail" <?php echo 'value="'.$librarianEmail.'"';?>>
			</p>
			<p>
				<label for="">Librarian Password: </label>
				<input type="password" name="librarianPassword">
			</p>
			<p>
				<label for="">Librarian Name: </label>
				<input type="text" name="librarianName" <?php echo 'value="'.$librarianName.'"';?>>
			</p>
			<p align="right">
				<label for="">&nbsp;</label>
				<button type="Submit" name="submit">Save</button>
			</p>
		</form>
		
		</main>
		
		</article>
		</section>

		
	</body>
</html>