<?php session_start(); ?>
<?php require_once('include/connection.php');?>
<?php 
//cheaking if a librarian in logged in
if(!isset($_SESSION['librarian_id']))
	{
	header('Location: librarianmenu.php');
	}

	//Check for form submission - has submit button been clicked
	
	if(isset($_POST['submit']))//submit=button name
	{
	//Check if the member ID have been entered
		if(!isset($_POST['mid']) || strlen(trim($_POST['mid'])) < 1)//<1 no character
		{
			$errorMsg='member ID is missing or invalid';//errors array
		}
	
	//check if there are any errors in the form
		if(empty($errors))//if array has no errors
		{
			//save memberId in to variables
			$mid = mysqli_real_escape_string($connection, $_POST['mid']);//to prevent sql injection
			
			//prepare database query
			$query = "SELECT * FROM reserveissuereturn
				WHERE mid = '{$mid}'
				LIMIT 1";// limit 1 prevents errors
			$result_set = mysqli_query($connection,$query);//sends mid and pass to db to select a match
	
			if ($result_set)// if no errors
			{
				if(mysqli_num_rows($result_set) == 1) //valid reserve,issue and return details found -match
				{
					$rir=mysqli_fetch_assoc($result_set); //Save mid in $reserve_issue_return
					$_SESSION['rir_id']=$rir['mid']; //apply to session
					$_SESSION['isbn']=$rir['isbn'];
					
					if(!$result_set)//varifyQuery($result_set);//imported function
					{
						die('Database query failed');
					}
					
				//redirect to found-rir-details.php
					header('Location:found-rir-details.php');
				}
				else { //invalid member ID
					$errorMsg='Invalid member ID';//save it in the errors array
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
h1{font-family: "Footlight MT Light",Helvetica,Arial,sans-serif;
    font-size: 50px;
	color: #0a0a0a;
	}
	
h2{font-family: "Footlight MT Light",Helvetica,Arial,sans-serif;
font-size: 25px;
color: #ac1010;
}

input[type=text] {
  background-color: white;
  background-image: url('searchicon.png');
  background-position: 10px 10px; 
  background-repeat: no-repeat;
  padding-left: 40px;
}
input{
	width:50%;
}

form{
	width:250%;
	position: center;
}


</style>
	</head>
	
	<body>
	
	
	<header>
			<DIV class="appName"><h2>Lowa State University Library<h2></DIV>
			<DIV class="loggedIn"><a href="rir-details.php"><img src="img/back.png" alt="Cinque Terre" width="30" height="30"></a> &nbsp;&nbsp; <a href="logout.php"onclick="return deleteask();"><img src="img/logout.png" alt="Cinque Terre" width="30" height="30"></a></DIV>
		</header>
		<h3 align="center">Hi! <?php echo $_SESSION['librarian_name']; ?>, Find the member.</h3>
		<br><br>
		
<table >
<tr>
<td width=65%>
</td>
<td width=100%>
	
	
		<div>
			<form action="search-rir-details.php" method="post">
			<fieldset>
			<legend><h1>Search</h1></legend>
			<p>
				<label for="">Member ID:</label>
				<input type="int" name="mid" id="" placeholder="Member ID">
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
		</td>
		</tr>
		</table>
		
	</body>
</html>
<?php mysqli_close($connection);?>