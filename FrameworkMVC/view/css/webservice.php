<?php



if($_SERVER['REQUEST_METHOD'] == "POST"){

	
	$email = isset($_POST['email']) ? mysql_real_escape_string($_POST['email']) : "";
	$password = isset($_POST['pwd']) ? mysql_real_escape_string($_POST['pwd']) : "";
	
	
	
	

}



?>
