<?php session_start(); ?>
<?php require_once('include/connection.php');?>
<?php	
	if(isset($_POST['submit']))//submit button name
	{
			//save username & password in to variables
			$memberEmail = $_POST['memberEmail'];
			$memberPassword = $_POST['memberPassword'];
			
			if(!empty($memberEmail) && !empty($memberPassword))
			{
			//prepare database query
			$query ="SELECT * FROM member 
				WHERE memEmail = '$memberEmail' 
				AND memPassword = '$memberPassword'
				LIMIT 1";
			$result_set = mysqli_query($connection,$query);//sends email and password to database to select a match
			
			if($result_set)// if no errors
			{
				if(mysqli_num_rows($result_set) == 1)//valid member found (match)
				{
					$member=mysqli_fetch_assoc($result_set); //Save email & password in $member
					
					$_SESSION['member_id'] = $member['mid']; //apply to session
					$_SESSION['first_name'] = $member['firstName'];
					
					//updating last login
					$query="UPDATE member SET lastLogin=NOW() WHERE mid = {$_SESSION['member_id']} LIMIT 1";
					$result_set = mysqli_query ($connection,$query);
					
				if(!$result_set) //If query fails
					{
						die('Database query failed');
					}

					header("location: membermenu.php"); //redirect to memberpage.php
				}
				else{
				$errorMsg = "Invalid Username / Password!"; //if there is no match
					}
			}
		else{
			$errorMsg = "Database query failed!"; //if result set has an error
			}
		}
	}
?>

<!-- Librarian aql -->

<?php 
	if(isset($_POST['submit']))
	{	
			//save username & password in to variables
			$librarianEmail = $_POST['libEmail'];
			$librarianPassword = $_POST['libPassword'];
			
			if(!empty($librarianEmail) && !empty($librarianPassword))
			{
			//prepare database query
			$query = "SELECT * FROM librarian
				WHERE libEmail = '$librarianEmail'
				AND libPassword = '$librarianPassword'
				LIMIT 1";// limit 1 prevents errors
			$result_set = mysqli_query($connection,$query);//sends email and password to database to select a match
	
			if ($result_set)// if no errors
			{
				if(mysqli_num_rows($result_set) == 1) //valid librarian found (match)
				{
					$librarian=mysqli_fetch_assoc($result_set); //Save email & password in $librarian
					
					$_SESSION['librarian_id']=$librarian['lid']; //apply to session
					$_SESSION['librarian_name']=$librarian['libName'];
					
					//updating last login
					$query="UPDATE librarian SET lastLogin=NOW() WHERE lid = {$_SESSION['librarian_id']} LIMIT 1";
					$result_set = mysqli_query ($connection,$query);
					
					if(!$result_set) //If query fails
					{
						die('Database query failed');
					}
					
					header('Location:librarianmenu.php'); //redirect to librarianmenu.php
				}
				else { 
					$errorMsg='Invalid username / password'; //if there is no match
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
		<title>Lowa State University Online Library</title>
		<style>
		body{
				background-image: url("img/bg.jpg");
				background-repeat: no-repeat;
				background-size: 100% auto;
				
			}
			
		h1	{
				color: white;
				text-align: center;
				font-family: verdana;
				
				-webkit-animation: mymove 5s infinite; /* Chrome, Safari, Opera */
				animation: mymove 3s infinite;
			}
			
			/* Chrome, Safari, Opera */
		@-webkit-keyframes mymove {
					from {background-color: #525252;}
				to {background-color: #dadada;}
			}
			
		img {
			  width: 10%;
			  height: auto;
			  align: right;
			}
		.center {
				display: block;
				margin-left: auto;
				margin-right: auto;
				width: 10%;
			}
			
		h4	{
				color: white;
				text-align: justify;
				font-family: Comic Sans MS;
				font-size: 20px;
				
		}
		
				
		
			
		input[type=text] {
			  width: 100%;
			  padding: 12px 20px;
			  margin: 8px 0;
			  box-sizing: border-box;
			  border: 3.5px solid #ff9900;
			  border-radius: 10px;
			  color: #414141;
			  background-color: white;
			  
			  
		}
			input[type=password] {
			  width: 100%;
			  padding: 12px 20px;
			  margin: 8px 0;
			  box-sizing: border-box;
			  border: 3.5px solid #ff9900;
			  border-radius: 10px;
			  color: #414141;
			  background-color: white;
		}
			input[type=submit] {
			  background-color: transparent;
			  width: 100%;
			  padding: 12px 20px;
			  margin: 8px 0;
			  box-sizing: border-box;
			  border: 3.5px solid #ff9900;
			  border-radius: 10px;
			  font-size: 20px;
			  background-color: white;
			  color: #414141;
		}
		#footer{
			height:10px;
			margin:auto;
			background-color:transparent;
			margin-bottom:5px;
			width:85%;
			text-align:center;
			font-family:"Arial";
			font-size:14px;
			color: #ffffff;
			line-height: 20px;
			
		}
		
		</style>
	</head>
	<body>
		<br>
		<h1>Lowa State University Online Library</h1>
		
		<br>
		<img src="img/panda.png" alt="panda" class="center">
		
		<table>
			<tr>
			<td width="12%"></td>
				<td width="18%">
					
					<h4>
						Student of Lowa State University can get registered for the online library in the library on weekdays form 9.00 am to 5.00 pm
					</h4>
				</td>
				<td width="1%">
				</td>
				<td width="20%">
					<!-- Member Login -->
					<br>
					<h4 class id="a" align="Center">Member Login</h4>
	
					<form action="index.php" method="post">

					<form class="loginPage">
					
							<div id="input">
								<input type="text" name="memberEmail" required autofocus placeholder="Email Address" >
							</div>
							<div id="password">
								<input type="Password" name="memberPassword" required autofocus placeholder="Password" >
							</div id="submit">
								<input type="submit" name="submit" value="Log In" class="btnLogin">
								<br >
					</form>
					<?php
					  if(isset($errorMsg)){
					 ?>
					  <div class="errorMsg"><?php echo $errorMsg; ?></div>
					<?php	
						}
					?>
					</form>
				</div>
				</td>
				
				<td width="2%">
						
				</td>
				<td width="20%">
						<br>
						<h4 class id="a" align="Center">Librarian Login</h4>
						<form action="index.php" method="post">
		
						<form class="loginPage">
						
								<div id="input">
									<input type="text" name="libEmail" required autofocus placeholder="Email Address" >
								</div>
								<div id="password">
									<input type="Password" name="libPassword" required autofocus placeholder="Password" >
								</div id="submit">
									<input type="submit" name="submit" value="Log In" class="btnLogin">
									<br >
						</form> 
						<?php
						  if(isset($errorMsg)){
						 ?>
						 <div class="errorMsg"><?php echo $errorMsg; ?></div>
						<?php	
							}
						?>
						</form>
				</td>
				<td width="20%"></td>
			</tr>
		</table>
		
		<!-- Footer -->
	  <div id="footer">
	  <em>© Lowa State University. All Rights Reserved.</em>
	  <em>Create By: Thamima</em>
	  </div>
		
	</body>
</html>