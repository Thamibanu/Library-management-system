<?php session_start(); ?>
<?php require_once('include/connection.php');?>
<?php require_once('include/functions.php');?>

<!--////////////////////////////////////////////////////////////////////////////////////////-->
<?php
if(!isset($_SESSION['librarian_id']))
	{
	header('Location: librarianmenu.php');
	}
$errors=array(); //to save errors in the form
//////////////////////////////Keep entered data in fields after making an error
//variables empty at the start
$mid='';
$isbn='';
$reserveDate='';
$issueDate='';
$returnDate='';
$dueDate='';

if (isset($_POST['submit']))//checking the click event of the submit button
{
	$mid=$_POST['mid'];
	$isbn=$_POST['isbn'];
	$reserveDate=$_POST['reserveDate'];
	$issueDate=$_POST['issueDate'];
	$returnDate=$_POST['returnDate'];
	$dueDate=$_POST['dueDate'];
	//assign field value to variables
	
	///////// Passingfield status in to a function////////
	$req_fields=array('mid','isbn','reserveDate','issueDate','returnDate','dueDate');
	//checkRequiredFields($req_fields)//function created in functions.php
	$errors=array_merge($errors,checkRequiredFields($req_fields));
	
	//check number of characters in the field
	$max_len_fields=array('mid'=>10,'isbn'=>10,'reserveDate'=>5,'issueDate'=>5,'returnDate'=>5,'dueDate'=>5);
	$errors=array_merge($errors,checkMaxLen($max_len_fields));//$errors array merging
	
	
	//////////////////////checking for mid duplicates//////////////////////
	$mid=mysqli_real_escape_string($connection,$_POST['mid']);
	$query="SELECT* FROM reserveissuereturn WHERE mid='{$mid}' LIMIT 1";
	$resultSet=mysqli_query($connection,$query);
	
	if($resultSet) //if query is successful
	{
		if(mysqli_num_rows($resultSet)==1) //if found similar Member ID in the table
		{
			$errors[]='Member ID address already exists';
		}
	}
	//////////////////////////insert data////////////////////////////////
	if(empty($errors)) //if array is empty
	{
		$mid=mysqli_real_escape_string($connection,$_POST['mid']);
		//$hashedPassword=sha1(Password);
		$isbn=mysqli_real_escape_string($connection,$_POST['isbn']);
		$reserveDate=mysqli_real_escape_string($connection,$_POST['reserveDate']); //sanitizing
		$issueDate=mysqli_real_escape_string($connection,$_POST['issueDate']);
		$returnDate=mysqli_real_escape_string($connection,$_POST['returnDate']);
		$dueDate=mysqli_real_escape_string($connection,$_POST['dueDate']);
		
		$query="INSERT INTO reserveissuereturn (mid,isbn,reserveDate,issueDate,returnDate,dueDate,isDeleted)";
		$query.="VALUE('{$mid}','{$isbn}','{$reserveDate}','{$issueDate}','{$returnDate}','{$dueDate}','0')";
		$result=mysqli_query($connection,$query);
		if($result)
		{
			header('Location: rir-details.php?rir_added=true ');
		}
		else
		{
			echo "failed to add a new record";
		}
	}
}
?>
	

<html>
	<head>
		<title>Add New Details</title>
		<link rel="stylesheet" type="text/css" href="CSS/main.css">
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
	width:100%;
}

form{
	width:300%;
	position: center;
}

</style>
	</head>
	
	<body>
	
		<header>
			<DIV class="appName"><h2>Lowa State University Library<h2></DIV>
			<DIV class="loggedIn"><a href="rir-details.php"><img src="img/back.png" alt="Cinque Terre" width="30" height="30"></a> &nbsp;&nbsp; <a href="logout.php"onclick="return deleteask();"><img src="img/logout.png" alt="Cinque Terre" width="30" height="30"></a></DIV>
		</header>
		<h3 align="center">Hi! <?php echo $_SESSION['librarian_name']; ?>, Add book reservation details.</h3>
		
		<br><br>
		
		<h1 align="center">Add Reservation Book Details</h1>

		<main>
		
		<?php
		if(!empty($errors))
		{
			displayErrors($errors); //calling for the function & passing the errors array 
		}
		?>
		
	<table >
	<tr>
	<td width=45%>
	</td>
	<td width=100%>
		
		
		<form action="add-rir-details.php" method="POST" >
			<p>
				<label for="">Member ID: </label>
				<input type="int" name="mid"<?php echo 'value="'.$mid.'"';?>>
			</p>
			<p>
				<label for="">ISBN: </label>
				<input type="int" name="isbn"<?php echo 'value="'.$isbn.'"';?>>
			</p>
			<p>
				<label for="">Reserve Date: </label>
				<input type="datetime" name="reserveDate" <?php echo 'value="'.$reserveDate.'"';?>> 
			</p>
			<p>
				<label for="">Issue Date: </label>
				<input type="date" name="issueDate"<?php echo 'value="'.$issueDate.'"';?>>
			</p>
			<p>
				<label for="">Return Date: </label>
				<input type="date" name="returnDate"<?php echo 'value="'.$returnDate.'"';?>>
			</p>	
			<p>
				<label for="">Due Date: </label>
				<input type="date" name="dueDate"<?php echo 'value="'.$dueDate.'"';?>>
			</p>
			<p>
				<label for="">&nbsp;</label>
				<button type="Submit" name="submit">Save</button>
			</p>

		</form>
		
		</td>
		</tr>
		</table>
		
		</main>
	</body>
</html>