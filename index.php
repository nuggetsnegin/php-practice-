<?php
	session_start();
	require_once('connect.php');
	$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die ('Your DB connection is misconfigured. Enter the correct values and try again.');

?>

<html>
    <head>
        <title>HR Database</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="A3, INFX2670">
		<meta name="author" content="Negin Sauermann">
		
		<!-- Bootstrap/CSS Import FrontEnd Framework -->
		<link rel="stylesheet" href="css/bootstrap.css" type="text/css"></head>
		<!-- Custom CSS -->
		<link rel="stylesheet" href="css/creative.css" type="text/css">	
		<!-- Plugin CSS -->
		<link rel="stylesheet" href="css/animate.min.css" type="text/css">

	</head>
	
	<body>

		<?php include 'navigation.php';?>

		<h1> Human Resource Database </h1>
	
		<form method="post">
			<div class="form-field">
				<label for="email">Employee ID: </label>
					<input type="text" id="employeeid" name="employeeid" placeholder="101"/>
				
				<br>
				<label>Password:</label>
					<input type="password" id="password" name="password" placeholder="******"/>
				
				<a href="profile.php" class="btn btn-default btn-xl wow tada" id="login" name="login">
					Login</a>
	
	</body>
</html>
	