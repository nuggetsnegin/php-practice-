<?php

	session_start();

	unset($_SESSION['user_data']);
	setcookie(session_name(), '', time() - 86400);
	session_destroy();

	
	header ("Location: index.php");

?>