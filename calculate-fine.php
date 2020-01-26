<?php session_start(); ?>
<?php require_once('include/connection.php');?>
<?php require_once('include/functions.php');?>

<!--////////////////////////////////////////////////////////////////////////////////////////-->
<?php
if(!isset($_SESSION['librarian_id']))
	{
	header('Location: librarian-page.php');
	}
$errors=array(); //to save errors in the form
//////////////////////////////Keep entered data in fields after making an error
//variables empty at the start
$issueDate='';
$returnDate='';
$dueDate='';
$lateDays='';
$fine='';

// $borrowdate = new Datetime($row['date_return']);
// $returndate = new Datetime($row['due_date']); 
// $currentdate = new Datetime();        
// $fines = 0;
if($returnDate > $dueDate){
     $lateDays = $issueDate->diff($dueDate ?? $returnDate, true)->lateDays;
     echo $fine = $lateDays > 0 ? intval(floor($lateDays)) * 10 : 0;
     // $fi = $row['rir_id'];
     // mysqli_query($dbcon,"update reserve_issue_return set fine='$fines' where borrow_details_id = '$fi'");
}

if (isset($_POST['submit']))//checking the click event of the submit button
{
	$returnDate=$_POST['returnDate'];
	$dueDate=$_POST['dueDate'];
	//assign field value to variables
	
	///////// Passingfield status in to a function////////
	$req_fields=array('returnDate','dueDate');
	//checkRequiredFields($req_fields)//function created in functions.php
	$errors=array_merge($errors,checkRequiredFields($req_fields));
	
	//check number of characters in the field
	$max_len_fields=array('returnDate'=>5,'dueDate'=>5);
	$errors=array_merge($errors,checkMaxLen($max_len_fields));//$errors array merging
}
?>
	

<html>
	<head>
		<title>Calculate Fine</title>
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
		<h3 align="center">Hi! <?php echo $_SESSION['librarian_name']; ?>, Reserved Book Fine Calculation.</h3>
		
		<br><br>
		
		<h1 align="center">Add Fine Details</h1>

	
	
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
		
		<form action="calculate-fine.php" method="POST">
			<p>
				<label for="">Return Date: </label>
				<input type="date" name="returnDate"<?php echo 'value="'.$returnDate.'"';?>>
			</p>	
			<p>
				<label for="">Due Date: </label>
				<input type="date" name="dueDate"<?php echo 'value="'.$dueDate.'"';?>>
			</p>
            <p>
				<label for="">Fine: </label>
				<input type="int" name="fine"<?php echo 'value="'.$fine.'"';?>>
			</p>
			<p>
				<label for="">&nbsp;</label>
				<button type="Submit" name="submit">Calculate Fine</button>
			</p>

		</form>
		
		</td>
		</tr>
		</table>
		</main>
	</body>
</html>