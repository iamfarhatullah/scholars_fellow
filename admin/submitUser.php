<?php  
require_once('include/connection.php');
if (isset($_POST['submitUser'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['newPassword'];
	$permission = $_POST['permissions'];
	$userType = 1;
	if ($permission == 1) {
		$userType = 3;
	}elseif ($permission == 2) {
		$userType = 2;
	} elseif ($permission == 3) {
		$userType = 1;
	}elseif ($permission == 4) {
		$userType = 4;
	}

	$checkEmail = "SELECT * FROM tbl_users WHERE user_email='$email'";
	$resultCheckEmail = mysqli_query($conn, $checkEmail);

	$checkUsername = "SELECT * FROM tbl_users WHERE user_username='$username'";
	$resultCheckUsername = mysqli_query($conn, $checkUsername);
	
	if (mysqli_num_rows($resultCheckEmail)> 0 || mysqli_num_rows($resultCheckUsername)>0) {
		header('Location: createUser.php?userExist');
	}else{
		$sql = "INSERT INTO `tbl_users`(`user_username`, `user_email`, `user_password`, `user_permissions`, `user_type_FK`) VALUES ('$username','$email','$password','$permission','$userType')";
		$result = mysqli_query($conn, $sql);
		if ($result) {
			header("Location: createUser.php?userCreated");
		}else{
			header('Location: createUser.php?errorMsg');
		}
	}

}
?>