<?php session_start(); ?>
<?php require_once('include/connection.php');?> 
<?php require_once('include/functions.php');?> 

<?php 
if(!isset($_SESSION['member_id']))
	{
		header('Location: membermenu.php');
	}

$errors=array();
$memberId='';//creating an empty variable for the passing id parameter 
$memberEmail='';
$lid='';
$firstName='';
$lastName='';
$memberType='';

if(isset($_GET['member_id'])) 
{
	$memberId=mysqli_real_escape_string($connection,$_GET['member_id']);
	$query = "SELECT * FROM member WHERE mid = {$memberId} LIMIT 1";
	$resultSet=mysqli_query($connection, $query);

	if($resultSet)
	{
		if(mysqli_num_rows($resultSet)==1)
		{
			$result=mysqli_fetch_assoc($resultSet);
			$memberEmail=$result['memEmail'];
			$lid=$result['lid'];
			$firstName=$result['firstName'];
			$lastName=$result['lastName'];
			$memberType=$result['memType'];
		}
		else
		{
			header('Location:myprofile.php?err=memberNotFound');
		}
	}
	else
	{
		header('Location:myprofile.php?err=queryFailed'); //error message
	}
}
if(isset($_POST['submit'])) //when submit button is clicked
{
	$memberId=$_POST['memberId']; 
	$memberEmail=$_POST['memEmail'];
	$lid=$_POST['lid'];
	$firstName=$_POST['firstName'];
	$lastName=$_POST['lastName'];
	$memberType=$_POST['memType']; 
	
	$req_fields=array('memberId','memEmail','lid','firstName','lastName','memType'); //password removed
	
	$errors=array_merge($errors,checkRequiredFields($req_fields)); 
		
	$max_len_fields=array('memEmail'=>30,'lid'=>10,'firstName'=>25,'lastName'=>25,'memType'=>20); //password removed 
	$errors=array_merge($errors,checkMaxLen($max_len_fields)); 
	
	
	$memberEmail=mysqli_real_escape_string($connection,$_POST['memEmail']); 
	$query="SELECT* FROM member WHERE memEmail='{$memberEmail}' AND mid !={$memberId} LIMIT 1"; //check for new memberEmail duplicates
	$resultSet=mysqli_query($connection,$query); 

	if($resultSet) //if query is successfull
	{
		if(mysqli_num_rows($resultSet)==1)//if found a similar memberEmail in the table
		{
			$errors[]='email address already exists';
		}
	}
	
	if(empty($errors))
	{
		$lid=mysqli_real_escape_string($connection,$_POST['lid']);
		$firstName=mysqli_real_escape_string($connection,$_POST['firstName']); 
		$lastName=mysqli_real_escape_string($connection,$_POST['lastName']);
		$memberType=mysqli_real_escape_string($connection,$_POST['memType']);
		//password removed
		
		$query="UPDATE member SET "; //update query
		$query.="memEmail='{$memberEmail}',";
		$query.="lid='{$lid}',";
		$query.="firstName='{$firstName}',";
		$query.="lastName='{$lastName}',";
		$query.="memType='{$memberType}'";
		$query.="WHERE mid='{$memberId}' LIMIT 1";
		$result=mysqli_query($connection,$query);
		if($result)
		{
			header('Location: myprofile.php?member_modified=true '); // update query successful
		}
		else
		{
			echo "failed to modify the record";//query failed
		}
	}
}
?>

<html>
	<head>
		<title>Edit Member Details</title>
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
		
		<article>
			
	<header id="color">
			<DIV class="appName"><h2>Lowa State University Library<h2></DIV>
			<DIV class="loggedIn"><a href="myprofile.php"><img src="img/back.png" alt="Cinque Terre" width="30" height="30"></a> </DIV>
		</header>
		<h3 align="center">Hi! <?php echo $_SESSION['first_name']; ?>, Edit member details.</h3>
		
		<br><br>
		
		<h1 align="center">Edit Member Details</h1>

	
		<main>
		
		<?php 
		if(!empty($errors))
		{
			displayErrors($errors);
		}
		?>
		
		
		
		<form action="editmyprofile.php" method="POST" class="memberForm">
			
			
			<input type="hidden" name="memberId" value="<?php echo $memberId; ?>"> <!--//memberId imported for value //go to view sourse to check applied id-->
			
			<p>
				<label for="">Email address: </label>
				<input type="Email" name="memEmail"<?php echo 'value="'.$memberEmail.'"';?>>
			</p>
			<p>
				<label for="">Password: </label>
				<span>******</span> | <a href="change-my-profile-password.php?member_id=<?php echo $memberId; ?>">Change Password</a>
			</p>
			<p>
				<label for="">Librarian ID: </label>
				<input type="int" name="lid"<?php echo 'value="'.$lid.'"';?>>
			</p>
			<p>
				<label for="">First Name: </label>
				<input type="text" name="firstName" <?php echo 'value="'.$firstName.'"';?>> 
			</p>
			<p>
				<label for="">Last Name: </label>
				<input type="text" name="lastName"<?php echo 'value="'.$lastName.'"';?>>
			</p>
			<p>
				<label for="">Member Type: </label>
				<input type="text" name="memType"<?php echo 'value="'.$memberType.'"';?>>
			</p><br>	
			<p align="right">
				<label for="">&nbsp;</label>
				<button type="submit" name="submit">Save</button>
			</p>
		</form>
		
		
		</main>
		
				</article>
	</body>
</html>