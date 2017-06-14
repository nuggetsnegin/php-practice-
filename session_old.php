<?php
require('connect.php');

session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysqli_query($conn, "select `EMPLOYEE_ID` from user_access where `EMPLOYEE_ID`='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['EMPLOYEE_ID'];
if(!isset($login_session)){
	mysqli_close($conn); // Closing Connection
	header('Location: index.php'); // Redirecting To Home Page
	}
?>