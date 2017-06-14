<!-- queries, check connect -->
<?php
	session_start();

	require_once('connect.php'); //db login
	$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die ('Your DB connection is misconfigured. Enter the correct values and try again.');
	
	if(isset($_SESSION['user_id'])) {
		$eid = $_SESSION['user_id'];
		$stmt= mysqli_prepare($link, "SELECT FIRST_NAME, LAST_NAME, EMAIL, PHONE_NUMBER, HIRE_DATE, JOB_ID, SALARY, DEPARTMENT_ID from employees where EMPLOYEE_ID =?");
		mysqli_stmt_bind_param($stmt, "i", $eid);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $fname, $lname, $email, $phone, $jdate, $jid, $salary, $dnum);
		mysqli_stmt_fetch($stmt);
		
		$stmt= mysqli_prepare($link, "SELECT JOB_TITLE FROM jobs WHERE JOB_ID = ?");
		mysqli_stmt_bind_param($stmt, "s", $jid);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $jtitle);
		mysqli_stmt_fetch($stmt);
		
		//$stmt= mysqli_prepare($link, " update employees set
		//PHONE_NUMBER=?, EMAIL=? Where employee_id =?");
		//$phone=$_POST[‘phone’]; //or _GET
		//$email=$_POST[‘email’]; //or _GET
		//mysqli_stmt_bind_param($stmt, "ssi", $phone, $email, $eid);
		//mysqli_stmt_execute($stmt);
		//mysqli_stmt_close($stmt);
		
		$stmt= mysqli_prepare($link, "SELECT street_address, postal_code, city, state_province, country_id FROM departments as d join locations as l on d.LOCATION_ID = l.LOCATION_ID where DEPARTMENT_ID =?");
		mysqli_stmt_bind_param($stmt, "i", $did);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $address, $postal, $city, $stateprov, $country);
		mysqli_stmt_fetch($stmt);
		
		//phone email update 
		//if(isset($_POST['submit'])) {
			//$stmt= mysqli_prepare($link, "update employees set
			//PHONE_NUMBER=?, EMAIL=? Where employee_id =?");
			//$phone=$_POST['phone'];
			//$email=$_POST['email']; 
			//mysqli_stmt_bind_param($stmt, "ssi", $phone, $email, $eid);
			//mysqli_stmt_execute($stmt);
			//mysqli_stmt_close($stmt);
		//}
		
		//update salary from tutorial example
		if(isset($_POST['salaryupdate'])){
			$stmt= mysqli_prepare($link, " update employees set SALARY=?
			Where employee_id =?");
			$salary=$_POST[‘salary’]; 
			mysqli_stmt_bind_param($stmt, $salary);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);	
		}
		
		//delete employee from 
		//if(isset($_POST['fire'])){
			//$stmt= mysqli_prepare($link, " delete employees set SALARY=?
			//Where employee_id =?");
			//$salary=$_POST[‘salary’]; 
			//mysqli_stmt_bind_param($stmt, "di", $salary $eid);
			//mysqli_stmt_execute($stmt);
			//mysqli_stmt_close($stmt);	
	

?>
<html>
    <head>
        <title>Subordinate Page</title>
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
	<!-- from tutorial -->
		<?php
			if ($_SESSION['user_id'] != '') {
				echo '<ul class="nav navbar-nav navbar-right">';
				echo '<li class="navbar-text">'.$_SESSION['user_id'].'</li>';
				echo '<li><a href="logout.php">Logout</a></li>';
				echo '</ul>';
			}
			
			//sub page if user is a sub --> not working(?)
			if($_SESSION['user_data']['access'] == 1) {
				echo '<ul class="nav navbar-nav navbar-left">';
				echo '<li class="active"><a href="sub.php">Subortinate</a></li>';
				echo '</ul>';
			}
		?>
		
		<!--include 'navigation.php';?> <!-- navigation bar -->
		

		<h1> Welcome </h1><?php echo " ". $fname?> <br><br>


		  <h2>Employee Info:</h2>
		 <form action="sub.php" method="post">
			<ul><li><label for="eid">Employee Name and Number: </label></li><?php echo $fname . " " . $lname . " " . "(" . $eid . ")"?>
				<li><label for="phone">Phone Number: </label></li><?php echo $phone?>
				<li><label for="email">E-mail:</label> </td><?php echo $email?>>@thecompany.com</li>
				<li><label for="jtitle">Job Title:</label> </li><?php echo $jtitle?>
				<li><label for="dname">Department Name:</label> </li><?php echo $dname?>
				<li><label for="salary">Salary:</label> </li><?php echo $salary?>
			</ul>
			<br>
			<ul>
				<li><label for="name">Name:</label> </li><?php echo $fname . ", " . $lname?>
				<li><label for="email">E-mail:</label> </td><?php echo $email?>>@thecompany.com</li>
				<li><label for="salary">Salary:</label> </li><?php echo $salary?>
			</ul>
		</form>	
		<!-- fire employee --> 
		<input type="submit" name="Fire" value="Fire" class="btn btn-default btn-xl wow tada">
		
		<input type="submit" name="UpdateSalary" value="UpdateSalary" class="btn btn-default btn-xl wow tada">
		
			<br><br>
			<h2>Add Employee Info:</h2><ul>
				<li><label for="dnum">Department Number:</label> </li><?php echo $dnum?>
				<li><label for="street">Street:</label> </li><?php echo $street?>
				<li><label for="postal">Postal Code:</label> </li><?php echo $postal?>
				<li><label for="city">City:</label> </li><?php echo $city?>
			</ul>
			<ul>
				<li><label for="dname">Department Name:</label> </li><?php echo $dname?>
				<li><label for="stateprov">State/Prov:</label> </li><?php echo $stateprov?>
				<li><label for="country">Country:</label> <?php echo $country?></li>
				<li><label for="region">Region:</label> <?php echo $region?></li>
			</ul>

		
		
	</body>
</html>