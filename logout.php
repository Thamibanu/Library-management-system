<?php

	session_start();
	$_SESSION= array(); //make empty the session array
	
	if(isset($_COOKIE[session_name()]))
	{
		setcookie (session_name(),'',time()-86400,'/'); //cookie name, value,current time
	}
	session_destroy();
	
	header('location: index.php?logout=yes');
?>