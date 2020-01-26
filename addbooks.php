<?php session_start(); ?>
<?php require_once('include/connection.php');?> 
<?php require_once('include/functions.php');?> 

<?php 
//check for the session
 if(!isset($_SESSION['librarian_id']))
	 {
		 header('Location: librarianmenu.php');
	 }

$errors=array();//to save errors in the form
//Keep entered data in fields after making an error
//variables empty at the start
$isbn='';
$lid='';
$title='';
$category='';
$author='';
$publisher='';
$price='';
$availability='';

if(isset($_POST['submit']))//checking the click event of the submit button
{
	$isbn=$_POST['isbn'];
	$lid=$_POST['lid'];
	$title=$_POST['title'];
	$category=$_POST['category'];
	$author=$_POST['author'];
	$publisher=$_POST['publisher'];
	$price=$_POST['price'];
	$availability=$_POST['available'];//assign field value to variables
	
	//Passing field status in to a function
	$req_fields=array('isbn','lid','title','category','author','publisher','price','available'); 
	//checkRequiredFields($req_fields) //function created in functions.php
	$errors=array_merge($errors,checkRequiredFields($req_fields)); //$errors array merging with function generated array 
		
	//checking number of characters in the field
	$max_len_fields=array('isbn'=>10,'lid'=>10,'title'=>50,'category'=>20,'author'=>50,'publisher'=>50,'price'=>10,'available'=>10); 
	$errors=array_merge($errors,checkMaxLen($max_len_fields)); //$errors array merging with function generated array 

	
	//checking for isbn duplicates
	$isbn=mysqli_real_escape_string($connection,$_POST['isbn']); //sanitizing isbn
	$query="SELECT* FROM book WHERE isbn='{$isbn}' LIMIT 1";
	$resultSet=mysqli_query($connection,$query); 

	if($resultSet) //if query is successfull
	{
		if(mysqli_num_rows($resultSet)==1)//if found a similar title in the table
		{
			$errors[]='isbn already exists';
		}
	}
	
	if(empty($errors))
	{
		$isbn=mysqli_real_escape_string($connection,$_POST['isbn']); 
		$lid=mysqli_real_escape_string($connection,$_POST['lid']);
		$title=mysqli_real_escape_string($connection,$_POST['title']);
		$category=mysqli_real_escape_string($connection,$_POST['category']);
		$author=mysqli_real_escape_string($connection,$_POST['author']);
		$publisher=mysqli_real_escape_string($connection,$_POST['publisher']);
		$price=mysqli_real_escape_string($connection,$_POST['price']);
        $availability=mysqli_real_escape_string($connection,$_POST['available']);

		$query="INSERT INTO book (isbn,lid,title,category,author,publisher,price,available,isDeleted)";
		$query.="VALUES('{$isbn}','{$lid}','{$title}','{$category}','{$author}','{$publisher}','{$price}','{$availability}','0')";
		$result=mysqli_query($connection,$query);
		if($result)
		{
			header('Location: booksdetails.php?book_added=true ');//query successful
		}
		else
		{
			echo "failed to add a new record";//query failed
		}
	}
}
?>

<html>
	<head>
		<title>Add new book</title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		
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
			<DIV class="loggedIn"><a href="booksdetails.php"><img src="img/back.png" alt="Cinque Terre" width="30" height="30"></a> </DIV>
		</header>
		
		<h3 align="center">Hi! <?php echo $_SESSION['librarian_name']; ?>, Add new book.</h3>
		
		<br><br>
		
		<h1 align="center">Add New Book</h1>

	
				
		<?php
		if(!empty($errors))
		{
			displayErrors($errors);// calling for the function & passing the errors array
		}
		?>
		
	
		<form action="addbooks.php" method="POST" class="memberForm">
			<p>
				<label for="">ISBN: </label>
				<input type="int" name="isbn" <?php echo 'value="'.$isbn.'"';?>> 
			</p>
			<p>
				<label for="">Librarian ID: </label>
				<input type="int" name="lid"<?php echo 'value="'.$lid.'"';?>>
			</p>
			<p>
				<label for="">Title: </label>
				<input type="text" name="title"<?php echo 'value="'.$title.'"';?>>
			</p>
			<p>
				<label for="">Category: </label>
				<input type="text" name="category"<?php echo 'value="'.$category.'"';?>>
			</p>
			<p>
				<label for="">Author: </label>
				<input type="text" name="author"<?php echo 'value="'.$author.'"';?>>
			</p>
			<p>
				<label for="">Publisher: </label>
				<input type="text" name="publisher"<?php echo 'value="'.$publisher.'"';?>>
			</p>
			<p>
				<label for="">Price: </label>
				<input type="text" name="price"<?php echo 'value="'.$price.'"';?>>
			</p>
			<p>
				<label for="">Availability: </label>
				<input type="text" name="available"<?php echo 'value="'.$availability.'"';?>>
			</p>
			<p align="right">
				<label for="">&nbsp;</label>
				<button type="submit" name="submit">Save</button>
			</p>
		</form>

		

		
		</article>
		</section>	
		
		
	</body>
</html>
