<?php require_once('include/connection.php');?>
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