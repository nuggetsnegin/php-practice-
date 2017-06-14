		<?php 
			$eid = $_POST[‘eid’];
			/* create a prepared statement */
			$stmt= mysqli_prepare($link, " Select password from user_access where employee_id =?");
			mysqli_stmt_bind_param($stmt, "i", $eid);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt,$pwd);
			mysqli_stmt_fetch($stmt);
			if ($pwd == sha1($_POST['password'])) {
				$_SESSION['user_id'] = $eid;
			}
			mysqli_stmt_close($stmt);
		?>
		
		
		
		